<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActorsTable extends Migration
{
    public function up()
    {
        Schema::create('actors', function (Blueprint $table) {
            $table->id(); // id, primary key autoincremental
            $table->string('name', 30); // name, as 30 string
            $table->string('surname', 30); // surname, as 30 string
            $table->date('birthdate'); // birthdate, as date YYYY-MM-DD
            $table->string('country', 30); // country, as 30 string
            $table->string('img_url', 255); // img_url, as 255 string
            $table->timestamps(); // created_at, updated_at as timestamp
        });
    }

    public function down()
    {
        Schema::dropIfExists('actors');
    }
}