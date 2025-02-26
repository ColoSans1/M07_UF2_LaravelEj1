<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            FilmFakerSeeder::class,
            ActorFakerSeeder::class,
            FilmActorSeeder::class,
        ]);
    }
}