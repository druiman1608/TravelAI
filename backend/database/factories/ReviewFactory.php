<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
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
            'hotel_id' => \App\Models\Hotel::factory(),
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->realText(100),
            'status' => $this->faker->randomElement(['pendiente', 'publicada', 'borrada']),
        ];
    }
}
