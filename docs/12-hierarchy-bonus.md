# Hierarchy Bonus (Bonus Manage > Hierarchy Bonus)

A multi-level ("MLM"-style) commission engine. When an order is paid, it walks the
buyer's **upline** (referral chain) and pays each of up to **3 generations** above the
buyer a commission, based on that upline person's type (Member or Agent) and level.

## Where it lives

| Piece | Location |
|---|---|
| Menu | Sidebar > Bonus Manage > Hierarchy Bonus | [sidebar.blade.php:649-654](../resources/views/partial/admin/sidebar.blade.php#L649) |
| Route | `setting_merchant_commission` (GET) / `save_setting_merchant_commission` (POST) | [routes/web.php:467-468](../routes/web.php#L467) |
| Settings controller | `setting_merchant_commission()` / `save_setting_merchant_commission()` | [SettingController.php:230-326](../app/Http/Controllers/Backend/SettingController.php#L230) |
| Settings view | Per-agent-level + per-member rate form | [setting_merchant_commission.blade.php](../resources/views/backend/settings/setting_merchant_commission.blade.php) |
| Payout engine | `GlobalController::heirarchy_commission($code, $transaction_no)` | [GlobalController.php:2156-2455](../app/Http/Controllers/GlobalController.php#L2156) |
| Global on/off switches | Website Setting page, "Hierarchy Bonus" toggles | [website_setting.blade.php:186,244](../resources/views/backend/settings/website_setting.blade.php#L186) |
| Trigger point | Called right after order marked paid, alongside `rebate_commission()` | [HomeController.php:6714](../app/Http/Controllers/HomeController.php#L6714) (+4 more call sites: 7152, 7224, 7336, 7416) |

Note the DB column/variable spelling is inconsistent: `heirarchy` (misspelled, used in
`WebsiteSetting` columns and the function name) vs `hierarchy` (correct, used in route
names, toggle names, and labels). Both spellings coexist in the same function.

## Two independent rate tracks

**Agents** — configured per `AgentLevel`, per generation (1st/2nd/3rd), stored in
`SettingMerchantCommission` keyed by `agent_lvl` (level id) + `level` (generation 1-3).
Each row has `comm_type` (`Percentage` or `Amount`) + `comm_amount`.

**Members** — a single flat rate per generation (not per level), stored directly on
`WebsiteSetting`: `member_heirarchy_{one,two,three}_type` / `_amount`. Only shown/used if
`bonus_member_enable` is on.

Both types support `Percentage` (of `grand_total - shipping_fee`) or a flat `Amount`.

## Gating flags (all on `WebsiteSetting`)

| Flag | Effect |
|---|---|
| `bonus_agent_enable` + `agent_rebate_enable` | Enables agent buyer-identification / order rebate track |
| `bonus_member_enable` + `member_rebate_enable` | Enables member buyer-identification / order rebate track |
| `hierarchy_enable` | Includes agents in the upline payout traversal |
| `member_hierarchy_enable` | Includes members in the upline payout traversal |
| `registration_package_hierarchy_bonus` | Separate switch for registration-product-triggered hierarchy bonus |

**If member hierarchy is off:** the `$affs` query that includes members
([GlobalController.php:2318](../app/Http/Controllers/GlobalController.php#L2318)) never
runs. If agent hierarchy is still on, an inner-join-to-`agents` query is used instead,
which naturally excludes any member from the upline results. If both are off, `$affs`
stays `[]` and the whole payout loop is a no-op — zero hierarchy commissions for that
transaction.

**Known inconsistency:** a separate fallback branch
([GlobalController.php:2198-2258](../app/Http/Controllers/GlobalController.php#L2198)),
only reached when the buyer can't be resolved directly but the transaction has a
cart-linked user, pays a "1st Generation" member commission gated only by
`bonus_member_enable` + `member_rebate_enable` — it does **not** check
`member_hierarchy_enable`. So in that narrow guest/cart-link edge case, a member could
still get paid even with the Member "Hierarchy Bonus" toggle off.

## Payout algorithm

Triggered by `GlobalController::heirarchy_commission($transaction->user_id, $transaction->transaction_no)`
immediately after an order is marked paid, inside the same `DB::beginTransaction()` /
`commit()` / `rollback()` as the order-status update — a failure here rolls back the
order-paid status too.

1. Identify the buyer as a Member or Agent via `$code` (the transaction's `user_id`).
2. Fetch the buyer's entire upline chain from the `Affiliate` table
   (`affiliate_id = buyer's code`, ordered by `sort_level` ascending = generation
   distance), joined against `agents` and/or `users` depending on which hierarchy flags
   are on.
3. Loop through the upline, closest first. A **local counter** (`$sort_level`, starting
   at 1) — not the `Affiliate.sort_level` column — decides which generation's rate to
   apply, and only increments after a payout with `comm_amount > 0` is actually inserted.
   - If the upline person is a **Member** → use the flat
     `member_heirarchy_{one,two,three}` rate for the current counter value.
   - If the upline person is an **Agent** → look up `SettingMerchantCommission` by their
     `agent_lvl` and the current counter value.
   - Compute the amount (percentage of `grand_total - shipping_fee`, or flat amount).
   - If `> 0`, insert an `AffiliateCommission` row: `user_id` = upline person (recipient),
     `user_by` = original buyer, `transaction_no`, `comm_pa_type`, `comm_pa`,
     `comm_amount`, `comm_desc` (e.g. `"Hierarchy Commission - 2nd Generation"`, bilingual
     EN/CN, with a `(Register Product)` suffix if `transaction->register_product == 1`).
   - Payouts stop at generation 3 (`$sort_level <= 3` guard) — the schema doesn't support
     a 4th generation. Also note: since sort_level only increments on a *successful*
     payout, a `0` rate at any generation silently shifts the next ancestor into that
     generation's rate bucket rather than being treated as "this generation pays nothing."
4. `AffiliateCommission` is a plain ledger table with no model events — it does not
   directly update any wallet-balance column. Wallet/report pages (e.g.
   `CashWalletExport`) compute balances by summing `AffiliateCommission` rows at read
   time, filtered by `status` / `claimed` / `burned`.

## Worked example

Config: Member rates = 5% / 3% / RM2 flat (1st/2nd/3rd gen). Agent "Gold" level rates =
8% / 4% / 2%. All relevant flags on.

Buyer **D** (Member) checks out: `grand_total = RM500`, `shipping_fee = RM20` → base =
`RM480`. D's upline chain: **C** (gen 1, Member) → **B** (gen 2, Agent/Gold) → **A**
(gen 3, Member).

| Gen | Recipient | Type | Rate | Amount | Desc |
|---|---|---|---|---|---|
| 1 | C | Member | 5% | RM480 x 5% = **RM24.00** | Hierarchy Commission - 1st Generation |
| 2 | B | Agent (Gold) | 4% | RM480 x 4% = **RM19.20** | Hierarchy Commission - 2nd Generation |
| 3 | A | Member | RM2 flat | **RM2.00** | Hierarchy Commission - 3rd Generation |

Result: 3 `AffiliateCommission` rows created, **RM45.20** total distributed across C, B,
and A. Each recipient sees it reflected the next time their wallet/commission report is
queried (no separate "credit wallet" step happens here).
