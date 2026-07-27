# Aisoceo WhatsApp Notification Integration

Adds an outbound webhook call to Aisoceo (3rd-party WhatsApp notification service) that
fires when a customer's order payment is confirmed, plus an admin-only on/off toggle for
it. Built 2026-07-24. Use this as a checklist to replicate the same feature in another
project.

## What it does

- When an order's payment is confirmed (gateway callback or admin manual "mark as paid"),
  the app POSTs the order details as JSON to Aisoceo's webhook URL.
- Aisoceo sends the customer a WhatsApp message with their order confirmation.
- A single admin account can toggle this on/off from the backend Settings page.
- If the webhook call fails for any reason (network, bad response, disabled setting), it
  fails silently (logged, not thrown) — it must never roll back the actual payment
  confirmation transaction.

## Prerequisites from Aisoceo

You need, per shop/site:
- Webhook URL, e.g. `https://aisoceo.my/api/ecommerce_webhook.php`
- A `shop_key` (passed as a URL query param, acts like a static API key — there is no
  HMAC/signature verification in this integration, it's a simple authenticated POST)

## 1. Config

Add to `config/services.php`:

```php
'aisoceo' => [
    'webhook_url' => env('AISOCEO_WEBHOOK_URL', 'https://aisoceo.my/api/ecommerce_webhook.php'),
    'shop_key' => env('AISOCEO_SHOP_KEY'),
],
```

Add to `.env` (real value) and `.env.example` (blank placeholder):

```
AISOCEO_WEBHOOK_URL=https://aisoceo.my/api/ecommerce_webhook.php
AISOCEO_SHOP_KEY=<shop key from Aisoceo>
```

## 2. Database — settings toggle column

Migration (adjust table name if the target project's site-settings table is named
differently):

```php
Schema::table('website_settings', function (Blueprint $table) {
    $table->boolean('whatsapp_notification_enable')->default(1);
});
```

Raw SQL equivalent, if applying by hand instead of `php artisan migrate`:

```sql
ALTER TABLE `website_settings`
ADD COLUMN `whatsapp_notification_enable` TINYINT(1) NOT NULL DEFAULT 1;
```

If applied by hand, also record it in the `migrations` table so a later
`php artisan migrate` doesn't try to re-run it and fail on a duplicate column:

```sql
INSERT INTO `migrations` (`migration`, `batch`)
VALUES ('<migration_file_name_without_php_extension>', (SELECT MAX(batch) FROM (SELECT batch FROM migrations) AS m));
```

Add the column to the settings model's `$fillable` array (e.g. `app/WebsiteSetting.php`).

## 3. Helper functions (add to a shared/global controller)

```php
public static function sanitize_whatsapp_phone($country_code, $phone)
{
    $country_code = preg_replace('/\D/', '', (string) $country_code);
    $phone = preg_replace('/\D/', '', (string) $phone);
    $phone = ltrim($phone, '0');

    return $country_code.$phone;
}

public static function send_aisoceo_payment_notification($no)
{
    try {
        $website_setting = WebsiteSetting::find(1);
        if (!empty($website_setting->id) && $website_setting->whatsapp_notification_enable == 0) {
            return 'ok';
        }

        $transaction = Transaction::where('transaction_no', $no)->first();
        if (empty($transaction->id)) {
            throw new \Exception('Error Transaction');
        }

        $transaction_details = TransactionDetail::where('transaction_id', $transaction->id)->get();

        $items = [];
        foreach ($transaction_details as $detail) {
            $items[] = [
                'name' => $detail->product_name,
                'qty' => (int) $detail->quantity,
                'price' => (float) $detail->unit_price,
            ];
        }

        $payload = [
            'order_id' => $transaction->transaction_no,
            'order_number' => $transaction->order_number ?: $transaction->transaction_no,
            'status' => 'paid',
            'total' => (float) $transaction->grand_total,
            'currency' => 'MYR',
            'name' => $transaction->address_name ?: 'Valued Customer',
            'phone' => self::sanitize_whatsapp_phone($transaction->country_code, $transaction->phone),
            'email' => $transaction->email,
            'items' => $items,
        ];

        $webhook_url = config('services.aisoceo.webhook_url').'?shop_key='.config('services.aisoceo.shop_key');

        $curl = curl_init($webhook_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

        $response = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($http_code !== 200) {
            \Log::error('Aisoceo webhook HTTP error ('.$http_code.') for order '.$no.': '.$response);
        } else {
            $res_json = json_decode($response, true);
            if (empty($res_json['status']) || $res_json['status'] !== 'success') {
                \Log::error('Aisoceo webhook business error for order '.$no.': '.($res_json['message'] ?? $response));
            }
        }
    } catch (\Exception $e) {
        \Log::error('Aisoceo webhook exception for order '.$no.': '.$e->getMessage());
    }

    return 'ok';
}
```

Adjust field names (`transaction_no`, `order_number`, `grand_total`, `address_name`,
`country_code`, `phone`, `email`, `product_name`, `quantity`, `unit_price`, `currency`
literal) to match the target project's actual order/transaction schema.

**Important design point**: this function always returns `'ok'` and never throws out of
its own `catch` block. It must not be allowed to roll back the caller's payment
transaction if the WhatsApp send fails — a network hiccup with a 3rd party should never
undo a real payment confirmation.

## 4. Hook points — call it wherever payment status flips to "paid"

In this project that was 5 places:
- 4 payment gateway success callbacks (each gateway's own webhook handler), right after
  the line that sets the order status to "paid" and saves it
- The admin panel's manual "mark as paid" action

Example (drop right after `$transaction->save()` when status was just set to paid):

```php
GlobalController::send_aisoceo_payment_notification($transaction->transaction_no);
```

Do **not** call it at order placement / checkout time — only once payment is actually
confirmed, otherwise customers get notified for unpaid/pending orders.

If the target project has an existing "order placed" WhatsApp notification via a
different provider (this project had one via UltraMsg), decide explicitly whether to
keep it, remove it, or replace it — don't assume either way.

## 5. Admin settings toggle UI

Restrict visibility/editability to one specific admin account by email (adjust the email
to whichever admin should control this per project):

Controller (only persist the field when the specific admin is saving):

```php
if (Auth::user()->email == 'admin@vesson.my') {
    $website_setting->whatsapp_notification_enable = isset($request->whatsapp_notification_enable) ? 1 : 0;
}
```

Blade (toggle switch, only rendered for that same admin):

```blade
@if(Auth::user()->email == 'admin@vesson.my')
<div class="col-md-12">
    <br>
    <span style="font-weight: bold; font-size: 15px; color: #000; display: block; width: 100%; border-bottom: 1px solid #ddd; margin-bottom: 10px;">
        WhatsApp Control
    </span>
</div>
<div class="col-md-6">
    <div class="form-group container-box">
        <div class="row">
            <div class="col-6">
                <span style="font-size: 20px; color: #000;">WhatsApp Message Delivery</span>
            </div>
            <div class="col-6" align="right">
                <label class="switch">
                    <input type="checkbox" name="whatsapp_notification_enable" {{ (!empty($setting->id) && $setting->whatsapp_notification_enable == 1) ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
    </div>
</div>
@endif
```

This reuses whatever `.switch`/`.slider.round` CSS toggle component the project's
settings page already uses — check for one before writing new CSS.

## 6. Testing without a public URL

- The outbound webhook call itself works fine from localhost (any environment with
  internet access can POST to Aisoceo).
- Real payment gateway callbacks are inbound and need a publicly reachable URL (ngrok or
  a real deploy) to test end-to-end.
- Easiest local test: use the admin "mark as paid" action directly — it's a local action
  that still fires the real outbound webhook, no tunnel needed.
- Gotcha: if the test order is already `status = 1` (paid), the "mark as paid" guard
  (`if ($transaction->status != '1')`) skips the whole block, including the
  notification — reset the order to a non-paid status first, or use a fresh order.
- Check `storage/logs/laravel.log` for `Aisoceo webhook` entries to confirm whether the
  call fired and what happened.

## Deploy checklist for a new project

1. Add config + `.env` entries (section 1)
2. Add/apply the settings-toggle column migration (section 2)
3. Add the two helper functions (section 3)
4. Wire the notification call into every "payment confirmed" code path (section 4)
5. Add the admin-only toggle UI (section 5)
6. `php artisan config:cache` (or equivalent) after `.env` changes so they're picked up
7. Test via the admin "mark as paid" path before trusting a real gateway flow
