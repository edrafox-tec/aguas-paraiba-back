<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('registration')->unique(); //matricula 
            $table->string('password');
            $table->string('function');
            $table->integer('level');
            $table->string('email');
            $table->string('phone');
            $table->integer('activated')->default(0);
            $table->string('nickname');
            $table->string('signature');
            $table->integer('type_function')->nullable();
            $table->unsignedBigInteger('id_sector')->unsigned()->nullable();
            $table->foreign('id_sector')->references('id')->on('sectors');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
