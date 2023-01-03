<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_themes', function (Blueprint $table) {
            $table->id();
            $table->string('theme');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('id_form')->unsigned()->nullable();
            $table->foreign('id_form')->references('id')->on('forms');
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
        Schema::dropIfExists('form_themes');
    }
}
