<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Actor;
use Faker\Factory as Faker; 

class ActorFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create(); // 🔹 Ahora Faker está correctamente referenciado

        for ($i = 0; $i < 10; $i++) {
            Actor::create([
                'name' => $faker->firstName(),
                'surname' => $faker->lastName(),
                'birthdate' => $faker->date('Y-m-d', '-20 years'),
                'country' => $faker->country(),
                'img_url' => $faker->imageUrl(200, 300, 'people'),
            ]);
        }
    }
}


