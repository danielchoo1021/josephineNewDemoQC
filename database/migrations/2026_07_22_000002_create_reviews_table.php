<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_name_cn')->nullable();
            $table->text('review_text')->nullable();
            $table->text('review_text_cn')->nullable();
            $table->tinyInteger('rating')->default(5);
            $table->integer('sort_level')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
