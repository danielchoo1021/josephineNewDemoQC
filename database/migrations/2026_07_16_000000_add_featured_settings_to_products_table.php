<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFeaturedSettingsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('featured_display_name')->nullable()->after('featured');
            $table->string('featured_point_1')->nullable()->after('featured_display_name');
            $table->string('featured_point_2')->nullable()->after('featured_point_1');
            $table->string('featured_point_3')->nullable()->after('featured_point_2');
            $table->string('featured_image')->nullable()->after('featured_point_3');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['featured_display_name', 'featured_point_1', 'featured_point_2', 'featured_point_3', 'featured_image']);
        });
    }
}
