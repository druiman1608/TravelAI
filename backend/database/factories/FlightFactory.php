<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departure = $this->faker->dateTimeBetween('+1 week', '+2 months');
        return [
            'location_id' => \App\Models\Location::factory(),
            'airline' => $this->faker->randomElement(['Iberia', 'Ryanair', 'Emirates', 'Vueling']),
            'origin' => $this->faker->city(),
            'departure' => $departure,
            'arrival' => (clone $departure)->modify('+' . rand(2, 12) . ' hours'),
            'price' => $this->faker->randomFloat(2, 50, 1000),
        ];
    }
}
