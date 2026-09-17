<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingWhyChooseUsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('setting_why_choose_uses')) {
            return;
        }

        Schema::create('setting_why_choose_uses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image')->nullable();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->integer('sort_level')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });

        if (!Schema::hasColumn('website_settings', 'why_choose_us_eyebrow')) {
            Schema::table('website_settings', function (Blueprint $table) {
                $table->string('why_choose_us_eyebrow')->nullable();
                $table->string('why_choose_us_heading')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting_why_choose_uses');

        Schema::table('website_settings', function (Blueprint $table) {
            $table->dropColumn(['why_choose_us_eyebrow', 'why_choose_us_heading']);
        });
    }
}
