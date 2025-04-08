<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmsTable extends Migration
{
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('title');  // Asegúrate de que esta línea esté presente
            $table->year('year');
            $table->string('genre');
            $table->string('country');
            $table->integer('duration');
            $table->string('image')->nullable();
            $table->timestamps();
        });
        
    }
    
    

    public function down()
    {
        Schema::dropIfExists('films');
    }
}