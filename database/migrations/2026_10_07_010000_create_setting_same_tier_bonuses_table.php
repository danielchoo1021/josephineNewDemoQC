<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingSameTierBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('setting_same_tier_bonuses')) {
            Schema::create('setting_same_tier_bonuses', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('agent_lvl');
                $table->double('comm_amount')->default(0);
                $table->tinyInteger('status')->default(1);
                $table->timestamps();
            });
        }

        if (!Schema::hasColumn('website_settings', 'same_tier_bonus_enable')) {
            Schema::table('website_settings', function (Blueprint $table) {
                $table->tinyInteger('same_tier_bonus_enable')->default(0);
            });
        }

        // Give every permission level that can already use Overriding Hierarchy Bonus
        // the same access to Same Tier Bonus.
        if (Schema::hasTable('permissions')) {
            DB::statement("INSERT INTO permissions (permission_lvl, page, sorting, status, created_at, updated_at)
                           SELECT p.permission_lvl, REPLACE(p.page, 'override-hierarchy-bonus', 'same-tier-bonus'), p.sorting, p.status, NOW(), NOW()
                           FROM permissions p
                           WHERE p.page LIKE 'override-hierarchy-bonus-%'
                           AND NOT EXISTS (
                               SELECT 1 FROM permissions x
                               WHERE x.permission_lvl = p.permission_lvl
                               AND x.page = REPLACE(p.page, 'override-hierarchy-bonus', 'same-tier-bonus')
                           )");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('permissions')->where('page', 'like', 'same-tier-bonus-%')->delete();

        Schema::dropIfExists('setting_same_tier_bonuses');

        if (Schema::hasColumn('website_settings', 'same_tier_bonus_enable')) {
            Schema::table('website_settings', function (Blueprint $table) {
                $table->dropColumn('same_tier_bonus_enable');
            });
        }
    }
}
