<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsReferralVoucherToPromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('promotions', 'is_referral_voucher')) {
            return;
        }

        Schema::table('promotions', function (Blueprint $table) {
            $table->tinyInteger('is_referral_voucher')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('promotions', function (Blueprint $table) {
            $table->dropColumn(['is_referral_voucher']);
        });
    }
}
