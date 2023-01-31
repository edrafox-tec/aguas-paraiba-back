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
