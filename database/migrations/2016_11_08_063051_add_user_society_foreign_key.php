<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserSocietyForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('user_society', function (Blueprint $table) {
            //
            $table->integer('user_id')->unsigned()->change();
            $table->integer('society_id')->unsigned()->change();
            //$table->integer('user_id',10)->change();
            //$table->integer('society_id',10)->change();
            $table->foreign('society_id')->references('id')->on('societies');
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
        Schema::table('user_society', function (Blueprint $table) {
            //
        });
    }
}
