<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'location_id' => \App\Models\Location::factory(),
            'name' => $this->faker->company() . ' Hotel',
            'description' => $this->faker->text(200),
            'stars' => $this->faker->numberBetween(1, 5),
            'price_per_night' => $this->faker->randomFloat(2, 45, 600),
        ];
    }
}
