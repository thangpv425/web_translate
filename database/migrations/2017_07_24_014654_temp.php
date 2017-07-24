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
        Schema::create('wt_temp', function($table){
            $table->increments('temp_id'); 
            /**
             * opCode:
             * 0 - 1 - 2 : Add - Edit - Delete on keyword table
             * 3 - 4 - 5 : A - E - D on meaning table
             */
            $table->smallInteger('opCode');
            $table->integer('old_id')->unsigned(); // use when edit or delete
            $table->string('new_value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('wt_temp');
    }
}
