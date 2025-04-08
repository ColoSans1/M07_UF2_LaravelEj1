<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FilmFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'year' => $this->faker->year,
            'genre' => $this->faker->word,
            'country' => $this->faker->countryCode,
            'duration' => $this->faker->numberBetween(60, 180),
            'image' => $this->faker->imageUrl(),
        ];
    }
}
