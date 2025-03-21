<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmActorSeeder extends Seeder
{
    public function run()
    {
        $filmIds = DB::table('films')->pluck('id')->toArray();
        $actorIds = DB::table('actors')->pluck('id')->toArray();

        foreach ($filmIds as $filmId) {
            $numActors = rand(1, 3);
            
            $selectedActors = array_rand($actorIds, $numActors);
            
            if ($numActors > 1) {
                $selectedActors = (array) $selectedActors; 
            } else {
                $selectedActors = [$selectedActors]; 
            }

            foreach ($selectedActors as $actorIndex) {
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
