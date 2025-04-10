<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasTable('film_actor')) {
            Schema::create('film_actor', function (Blueprint $table) {
                $table->id();
                $table->foreignId('film_id')->constrained()->onDelete('cascade');
                $table->foreignId('actor_id')->constrained()->onDelete('cascade');
                $table->timestamps();
            });
        }
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('film_actor');
    }
};
