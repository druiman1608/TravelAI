<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserPreference>
 */
class UserPreferenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => null,
            'travel_type' => $this->faker->randomElement(['Aventura', 'Relax', 'Cultural', 'Familiar']),
            'max_budget' => $this->faker->randomFloat(2, 1000, 5000),
            'fav_weather' => $this->faker->randomElement(['Caluroso', 'Frío', 'Templado', 'Tropical']),
        ];
    }
}
