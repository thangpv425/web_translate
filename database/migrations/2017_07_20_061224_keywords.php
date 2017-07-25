<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class Keywords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wt_keyword', function($table){
            $table->increments('keyword_id');
            $table->string('value');
            $table->smallInteger('status');
            $table->timestamps();

            $table->unique('value');
        });

        Schema::create('wt_meaning', function($table){
            $table->increments('meaning_id');
            $table->integer('keyword_id')->unsigned();
            $table->string('value');
            $table->smallInteger('index')->unsigned();
            $table->boolean('status');
            $table->smallInteger('language')->unsigned();
            $table
                ->foreign('keyword_id')
                ->references('keyword_id')
                ->on('wt_keyword')
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
        Schema::drop('wt_meaning');
        Schema::drop('wt_keyword');
    }
}
