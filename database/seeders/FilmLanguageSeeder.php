<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmLanguageSeeder extends Seeder
{
    public function run()
    {
        $filmIds = DB::table('films')->pluck('id')->toArray();
        $languageIds = DB::table('languages')->pluck('id')->toArray();

        foreach ($filmIds as $filmId) {
            // Asignar 1 a 3 idiomas por película de forma aleatoria
            $numLanguages = rand(1, 3);
            $selectedLanguages = array_rand($languageIds, $numLanguages);

            foreach ((array) $selectedLanguages as $languageIndex) {
                DB::table('film_languages')->insert([
                    'film_id' => $filmId,
                    'language_id' => $languageIds[$languageIndex],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}