<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Hotel;
use App\Models\Activity;
use App\Models\Flight;
use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        $type = fake()->randomElement(['hotel', 'activity', 'flight', 'package']);

        return [
            'user_id' => User::inRandomOrder()->first()?->id ?: User::factory(),
            'hotel_id' => $type === 'hotel' ? (Hotel::inRandomOrder()->first()?->id ?: Hotel::factory()) : null,
            'activity_id' => $type === 'activity' ? (Activity::inRandomOrder()->first()?->id ?: Activity::factory()) : null,
            'flight_id' => $type === 'flight' ? (Flight::inRandomOrder()->first()?->id ?: Flight::factory()) : null,
            'package_id' => $type === 'package' ? (Package::inRandomOrder()->first()?->id ?: Package::factory()) : null,
            'rating' => fake()->numberBetween(1, 5),
            'comment' => fake()->sentence(10),
            'status' => fake()->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}