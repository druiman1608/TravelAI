<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'continent' => $this->faker->randomElement(['Europa', 'Asia', 'América', 'África']),
            'weather_type' => $this->faker->randomElement(['Caluroso', 'Frío', 'Templado', 'Tropical']),
            'description' => $this->faker->paragraph(),
            'image_url' => 'https://picsum.photos/seed/' . rand(1, 1000) . '/800/600',
            'status' => true,
        ];
    }
}
