<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeywordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wt_keyword', function($table){
            $table->increments('id');
            $table->string('keyword');
            $table->smallInteger('status');
            $table->softDeletes();
            $table->timestamps();
            $table->unique('keyword');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('wt_keyword');
    }
}
