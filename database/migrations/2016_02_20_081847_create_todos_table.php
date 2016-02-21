<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos',function(Blueprint $table){
            $table->increments('id');
            $table->string('todo');
            $table->dateTime('todo_time');
            $table->string('location');
            $table->integer('owner_id')->unsigned()->index();
            $table->string('benefit');
            $table->date('unit');
            $table->boolean('is_price')->default(true);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('todos');
    }
}
