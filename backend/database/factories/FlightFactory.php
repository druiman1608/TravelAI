<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlightFactory extends Factory
{
    public function definition(): array
    {
        $hours = rand(2, 12);
        $minutes = rand(0, 59);
        $departure = fake()->dateTimeBetween('+1 week', '+2 weeks');
        $arrival = (clone $departure)->modify("+{$hours} hours +{$minutes} minutes");

        return [
            'flight_number' => fake()->bothify('??####'),
            'origin_loc_id' => Location::factory(),
            'destination_loc_id' => Location::factory(),
            'airline' => fake()->randomElement(['Iberia', 'Vueling', 'Ryanair', 'Lufthansa', 'Emirates']),
            'departure'     => $departure,
            'arrival'       => $arrival,
            'duration_time' => "{$hours}h {$minutes}min",
            'stops' => fake()->randomElement([0, 0, 1, 1, 2]),
            'capacity' => fake()->numberBetween(100, 300),
            'price' => fake()->randomFloat(2, 50, 800),
            'image_url' => 'https://picsum.photos/seed/' . rand(1, 1000) . '/600/400',
        ];
    }
}