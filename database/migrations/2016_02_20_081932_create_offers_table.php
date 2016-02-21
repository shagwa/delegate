<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers',function(Blueprint $table){
           $table->integer('todo_id')->unsigned()->index();
           $table->integer('provider_id')->unsigned()->index();
           $table->string('price');
           $table->dateTime('end_time');
           $table->timestamps();
           $table->foreign('todo_id')->references('id')->on('todos')->onDelete('cascade');
           $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('offers');
    }
}
