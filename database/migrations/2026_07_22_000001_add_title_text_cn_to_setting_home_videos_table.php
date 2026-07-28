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
            if (!Schema::hasColumn('setting_home_videos', 'title_cn')) {
                $table->string('title_cn')->nullable()->after('title');
            }
            if (!Schema::hasColumn('setting_home_videos', 'text_cn')) {
                $table->string('text_cn')->nullable()->after('text');
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
        Schema::table('setting_home_videos', function (Blueprint $table) {
            $table->dropColumn(['title_cn', 'text_cn']);
        });
    }
}
