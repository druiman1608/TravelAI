<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class HotelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'location_id' => Location::factory(),
            'name' => fake()->company() . ' Hotel',
            'description' => fake()->paragraph(),
            'address' => fake()->streetAddress(),
            'zip_code' => fake()->postcode(),
            'stars' => fake()->numberBetween(1, 5),
            'services' => ['Wifi', 'Piscina', 'Desayuno', 'Parking'],
            'available_rooms' => fake()->numberBetween(5, 100),
            'price_per_night' => fake()->randomFloat(2, 50, 450),
            'images' => [
                'https://picsum.photos/seed/' . rand(1, 1000) . '/800/600',
                'https://picsum.photos/seed/' . rand(1, 1000) . '/800/600',
            ],
        ];
    }
}