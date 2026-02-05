<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
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
            'name' => $this->faker->randomElement(['Tour por ', 'Entradas a ', 'Cena en ', 'Excursión a ']) . $this->faker->city(),
            'description' => $this->faker->sentence(10),
            'price' => $this->faker->randomFloat(2, 5, 200),
        ];
    }
}
