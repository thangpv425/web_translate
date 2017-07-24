<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Temp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wt_keyword_temp', function($table){
            $table->increments('keyword_temp_id'); 
            /**
             * opCode:
             * 0 - 1 - 2 : Add - Edit - Delete
             */
            $table->smallInteger('opCode');
            $table->interger('user_id')->unsigned(); // current user
            $table->integer('old_keyword_id')->unsigned()->nullable(); // use when edit or delete
            $table->string('new_keyword');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('wt_meaning_temp', function($table){
            $table->increments('meaning_temp_id'); 
            /**
             * opCode:
             * 0 - 1 - 2 : Add - Edit - Delete
             */
            $table->smallInteger('opCode');
            $table->interger('keyword_id')->unsigned()->nullable(); // use when add new meaning
            $table->interger('user_id')->unsigned();
            $table->integer('old_meaning_id')->unsigned()->nullable(); // use when edit or delete
            $table->string('new_meaning');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('wt_keyword_temp');
        Schema::drop('wt_meaning_temp');
    }
}
