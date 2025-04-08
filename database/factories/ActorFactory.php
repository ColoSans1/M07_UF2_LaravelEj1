<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ActorFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName,
            'birthdate' => $this->faker->date('Y-m-d'),
            'country' => $this->faker->country,
            'img_url' => $this->faker->imageUrl(640, 480, 'people', true),
        ];
    }
}
