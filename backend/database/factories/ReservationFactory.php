<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
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
            'package_id' => \App\Models\Package::factory(),
            'price' => $this->faker->randomFloat(2, 500, 3000),
            'status' => $this->faker->randomElement(['pendiente', 'confirmada', 'cancelada']),
        ];
    }
}
