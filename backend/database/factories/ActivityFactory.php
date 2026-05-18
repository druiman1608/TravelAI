<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Location;

class ActivityFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Tour en Helicóptero', 'Buceo Guiado', 'Cena Romántica', 'Senderismo', 'Museo de Arte']),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 20, 150),
            'duration' => fake()->numberBetween(1, 8) . ' horas',
            'type' => fake()->randomElement(['Tour', 'Deporte', 'Cultura', 'Gastronomía']),
            'included_features' => ['Guía bilingüe', 'Transporte', 'Seguro médico', 'Snacks'],
            'location_id' => Location::factory(),
            'images' => [
                'https://picsum.photos/seed/' . rand(1, 1000) . '/800/600',
                'https://picsum.photos/seed/' . rand(1, 1000) . '/800/600',
            ]
        ];
    }
}