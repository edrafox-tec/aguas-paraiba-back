<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_works', function (Blueprint $table) {
            $table->id();
            $table->integer('id_sector');
            $table->unsignedBigInteger('id_form')->unsigned()->nullable();
            $table->foreign('id_form')->references('id')->on('forms');
            $table->unsignedBigInteger('id_user')->unsigned()->nullable();
            $table->foreign('id_user')->references('id')->on('users');
            $table->integer('conformity')->nullable();
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
        Schema::dropIfExists('post_works');
    }
}
