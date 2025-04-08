<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Film;
use App\Models\Actor;

class FilmActorSeeder extends Seeder
{
    public function run(): void
    {
        $actorIds = Actor::pluck('id')->toArray();

        Film::all()->each(function ($film) use ($actorIds) {
            $numActors = rand(1, 3);
            $selectedActors = collect($actorIds)->random($numActors);

            $film->actors()->attach($selectedActors);
        });
    }
}
