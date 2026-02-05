<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AIChatLog>
 */
class AIChatLogFactory extends Factory
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
            'user_question' => $this->faker->sentence() . '?',
            'ai_answer' => 'Basado en tus preferencias, te recomiendo visitar ' . $this->faker->city() . ' debido a su clima ' . $this->faker->word(),
        ];
    }
}
