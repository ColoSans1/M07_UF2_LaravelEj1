<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Film;
use App\Models\Actor;
use Illuminate\Support\Facades\DB;

class FilmActorSeeder extends Seeder
{

    public function run(): void
    {
        $films = Film::all();
        $actors = Actor::all();

        foreach ($films as $film) {
            $randomActors = $actors->random(rand(1, 3));

            foreach ($randomActors as $actor) {
                DB::table('film_actor')->insert([
                    'film_id' => $film->id,
                    'actor_id' => $actor->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
