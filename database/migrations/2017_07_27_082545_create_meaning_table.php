<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeaningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('wt_meaning', function($table){
            $table->increments('id');
            $table->integer('keyword_id')->unsigned();
            $table->string('meaning');
            $table->smallInteger('index')->unsigned();
            $table->boolean('status');
            $table->smallInteger('language')->unsigned();
            $table->smallInteger('type')->unsigned()->nullable();
            $table
                ->foreign('keyword_id')
                ->references('id')
                ->on('wt_keyword')
                ->onDelete('cascade');
            $table->softDeletes();
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
    }
}
