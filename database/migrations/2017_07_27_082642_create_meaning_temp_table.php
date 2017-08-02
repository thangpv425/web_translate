<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeaningTempTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('wt_meaning_temp', function($table){
            $table->increments('id'); 
            /**
             * opCode:
             * 0 - 1 - 2 : Add - Edit - Delete
             */
            $table->smallInteger('opCode');
            $table->integer('keyword_id')->unsigned()->nullable(); // use when add new meaning
            $table->integer('user_id')->unsigned();
            $table->integer('old_meaning_id')->unsigned()->nullable(); // use when edit or delete
            $table->string('new_meaning')->nullable();
            $table->smallInteger('language')->unsigned()->nullable();
            $table->smallInteger('index')->unsigned()->nullable();
            $table->smallInteger('type')->unsigned()->nullable(); // danh tu, dong tu, tinh tu
            $table->smallInteger('status'); // INQUEUE - APPROVED - DECLINED
            $table->mediumText('comment')->nullable();
            $table
                ->foreign('keyword_id')
                ->references('id')
                ->on('wt_keyword')
                ->onDelete('cascade');

            $table->foreign('user_id')->references('id')->on('users');
            $table
            ->foreign('old_meaning_id')
            ->references('id')
            ->on('wt_meaning')
            ->onDelete('cascade');
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
        Schema::drop('wt_meaning_temp');
    }
}
