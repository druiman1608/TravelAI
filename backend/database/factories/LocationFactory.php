<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'city' => fake()->city(),
            'country' => fake()->country(),
            'continent' => fake()->randomElement(['Europa', 'Asia', 'América', 'África']),
            'weather_type' => fake()->randomElement(['Tropical', 'Templado', 'Frío', 'Caluroso', 'Árido', 'Mediterráneo']),
            'description' => fake()->paragraph(),
            'image_url' => 'https://picsum.photos/seed/' . rand(1, 1000) . '/800/600',
            'status' => true,
        ];
    }
}