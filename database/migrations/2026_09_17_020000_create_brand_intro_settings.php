<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandIntroSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('website_settings', 'brand_intro_eyebrow')) {
            Schema::table('website_settings', function (Blueprint $table) {
                $table->string('brand_intro_eyebrow')->nullable();
                $table->string('brand_intro_heading')->nullable();
                $table->text('brand_intro_body')->nullable();
                $table->string('brand_intro_image')->nullable();
            });
        }

        if (!Schema::hasTable('setting_brand_intro_features')) {
            Schema::create('setting_brand_intro_features', function (Blueprint $table) {
                $table->increments('id');
                $table->string('icon')->nullable();
                $table->string('title')->nullable();
                $table->string('subtitle')->nullable();
                $table->integer('sort_level')->nullable();
                $table->tinyInteger('status')->default(1);
                $table->timestamps();
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
        Schema::table('website_settings', function (Blueprint $table) {
            $table->dropColumn(['brand_intro_eyebrow', 'brand_intro_heading', 'brand_intro_body', 'brand_intro_image']);
        });

        Schema::dropIfExists('setting_brand_intro_features');
    }
}
