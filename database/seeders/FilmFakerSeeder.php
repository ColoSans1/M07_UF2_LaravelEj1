<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FilmFakerSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('films')->insert([
                'title' => $faker->sentence,
                'year' => $faker->year,
                'genre' => $faker->word,
                'country' => $faker->countryCode,
                'duration' => $faker->numberBetween(60, 180),
                'image' => $faker->imageUrl(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
        }
    }
}
