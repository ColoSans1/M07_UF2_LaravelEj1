<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmLanguagesTable extends Migration
{
    public function up()
    {
        Schema::create('film_languages', function (Blueprint $table) {
            $table->unsignedBigInteger('film_id');
            $table->unsignedBigInteger('language_id');
            $table->timestamps(); 

            $table->foreign('film_id')->references('id')->on('films')->onDelete('cascade');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');

            $table->primary(['film_id', 'language_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('film_languages');
    }
}