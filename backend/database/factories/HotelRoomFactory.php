<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Hotel;

class HotelRoomFactory extends Factory
{
    public function definition(): array
    {
        return [
            'hotel_id' => Hotel::factory(),
            'type' => fake()->randomElement(['Individual', 'Doble', 'Suite']),
            'price' => fake()->randomFloat(2, 30, 300),
            'capacity' => fake()->numberBetween(1, 4),
            'stock' => fake()->numberBetween(1, 10),
        ];
    }
}