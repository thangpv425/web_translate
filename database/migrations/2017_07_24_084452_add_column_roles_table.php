<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->unsignedTinyInteger('status')->default(1);
            $table->text('deleted_by')->nullable();
            $table->text('created_by')->nullable();
            $table->text('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('deleted_by');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
        });
    }
}
