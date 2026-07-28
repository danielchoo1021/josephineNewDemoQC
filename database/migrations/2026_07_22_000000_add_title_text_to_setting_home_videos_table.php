<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTitleTextToSettingHomeVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('setting_home_videos', function (Blueprint $table) {
            if (!Schema::hasColumn('setting_home_videos', 'title')) {
                $table->string('title')->nullable()->after('image');
            }
            if (!Schema::hasColumn('setting_home_videos', 'text')) {
                $table->string('text')->nullable()->after('title');
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
            $table->dropColumn(['title', 'text']);
        });
    }
}
