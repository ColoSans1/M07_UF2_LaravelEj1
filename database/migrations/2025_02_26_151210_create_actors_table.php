<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActorsTable extends Migration
{
    public function up()
    {
        Schema::create('actors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('birthdate');          
            $table->string('country');           
            $table->string('img_url')->nullable(); 
            $table->timestamps();               
        });
    }

    public function down()
    {
        Schema::dropIfExists('actors');
    }
}
