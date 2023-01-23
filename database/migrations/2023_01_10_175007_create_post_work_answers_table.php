<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostWorkAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_work_answers', function (Blueprint $table) {
            $table->id();
            $table->foreign('id_postWork')->references('id')->on('post_works');
            $table->unsignedBigInteger('id_postWork')->unsigned()->nullable();
            $table->json('form_array');
            $table->timestamps();
            $table->softDeletes();
           /* $table->string('answer')->nullable();
            $table->unsignedBigInteger('id_question')->unsigned()->nullable();
            $table->foreign('id_question')->references('id')->on('questions');
            $table->unsignedBigInteger('id_answer')->unsigned()->nullable();
            $table->foreign('id_answer')->references('id')->on('answers');
            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_work_answers');
    }
}
