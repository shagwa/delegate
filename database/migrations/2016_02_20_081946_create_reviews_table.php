<?php

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
        Schema::create('reviews',function(Blueprint $table){
           $table->increments('id');
           $table->text('review');
           $table->tinyInteger('rate');
           $table->integer('reviewer_id')->unsigned()->index();
           $table->integer('reviewed_id')->unsigned()->index();
           $table->timestamps();
           $table->foreign('reviewer_id')->references('id')->on('users')->onDelete('cascade');
           $table->foreign('reviewed_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reviews');
    }
}
