<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class UserPreferenceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'travel_type' => fake()->randomElement(['Solo', 'Pareja', 'Familia', 'Negocios']),
            'max_budget' => fake()->randomFloat(2, 500, 5000),
            'fav_weather' => fake()->randomElement(['Caluroso', 'Frío', 'Templado', 'Tropical']),
        ];
    }
}