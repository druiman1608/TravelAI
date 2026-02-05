<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Paquete' . $this->faker->word(),
            'hotel_id' => \App\Models\Hotel::factory(),
            'flight_id' => \App\Models\Flight::factory(),
            'activity_id' => \App\Models\Activity::factory(),
            'total_price' => $this->faker->randomFloat(2, 500, 3000),
        ];
    }
}
