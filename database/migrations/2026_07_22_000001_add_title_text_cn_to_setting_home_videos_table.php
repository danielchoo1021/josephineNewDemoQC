<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTitleTextCnToSettingHomeVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('setting_home_videos', function (Blueprint $table) {
            $table->string('title_cn')->nullable()->after('title');
            $table->string('text_cn')->nullable()->after('text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('setting_home_videos', function (Blueprint $table) {
            $table->dropColumn(['title_cn', 'text_cn']);
        });
    }
}
