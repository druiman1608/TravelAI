<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AIChatLogFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()?->id ?: User::factory(),
            'message' => fake()->paragraph(),
            'response' => fake()->paragraph(3),
            'context_data' => json_encode([
                'source' => fake()->randomElement(['web', 'mobile', 'app']),
                'last_page' => fake()->randomElement(['/hoteles', '/vuelos', '/paquetes', '/actividades']),
            ]),
        ];
    }
}