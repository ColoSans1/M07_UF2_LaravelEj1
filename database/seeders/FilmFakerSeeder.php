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
                'title' => $faker->sentence(3),
                'year' => $faker->numberBetween(1900, 2024),
                'genre' => $faker->word,
                'country' => $faker->countryCode,
                'duration' => $faker->numberBetween(60, 180),
                'image' => $faker->imageUrl(640, 480, 'film', true),  // Cambié 'img_url' por 'image'
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
