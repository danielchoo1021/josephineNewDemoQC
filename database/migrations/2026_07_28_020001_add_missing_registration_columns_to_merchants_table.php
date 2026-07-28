<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMissingRegistrationColumnsToMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchants', function (Blueprint $table) {
            if (!Schema::hasColumn('merchants', 'verify_status')) {
                $table->integer('verify_status')->nullable()->default(1)->after('agent_type');
            }
            if (!Schema::hasColumn('merchants', 'prefer_language')) {
                $table->integer('prefer_language')->nullable()->after('verify_status');
            }
            if (!Schema::hasColumn('merchants', 'cp')) {
                $table->string('cp')->nullable()->after('prefer_language');
            }
            if (!Schema::hasColumn('merchants', 'receive_newsletter')) {
                $table->integer('receive_newsletter')->nullable()->after('cp');
            }
            if (!Schema::hasColumn('merchants', 'register_transaction')) {
                $table->string('register_transaction')->nullable()->after('receive_newsletter');
            }
            if (!Schema::hasColumn('merchants', 'joining_fee')) {
                $table->integer('joining_fee')->nullable()->after('register_transaction');
            }
            if (!Schema::hasColumn('merchants', 'joining_fee_bank_slip')) {
                $table->string('joining_fee_bank_slip')->nullable()->after('joining_fee');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('merchants', function (Blueprint $table) {
            $table->dropColumn([
                'verify_status',
                'prefer_language',
                'cp',
                'receive_newsletter',
                'register_transaction',
                'joining_fee',
                'joining_fee_bank_slip',
            ]);
        });
    }
}
