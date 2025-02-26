<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FilmActorSeeder extends Seeder
{
    public function run()
    {
        $filmIds = DB::table('films')->pluck('id')->toArray();
        $actorIds = DB::table('actors')->pluck('id')->toArray();

        foreach ($filmIds as $filmId) {
            $numActors = rand(1, 3);
            $selectedActors = array_rand($actorIds, $numActors);

            foreach ((array) $selectedActors as $actorIndex) {
                DB::table('films_actors')->insert([
                    'film_id' => $filmId,
                    'actor_id' => $actorIds[$actorIndex],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}