<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeywordTempTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wt_keyword_temp', function($table){
            $table->increments('id'); // PK
            /**
             * opCode:
             * 0 - 1 - 2 : Add - Edit - Delete
             */
            $table->smallInteger('opCode');
            $table->integer('user_id')->unsigned(); // current user
            $table->integer('old_keyword_id')->unsigned()->nullable(); // use when edit or delete
            $table->string('new_keyword')->nullable();
            $table->smallInteger('status'); // INQUEUE - APPROVED - DECLINED
            $table->mediumText('comment')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('old_keyword_id')->references('id')->on('wt_keyword');
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
        Schema::drop('wt_keyword_temp');
    }
}
