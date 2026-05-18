<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Package;
use App\Models\Hotel;
use App\Models\Flight;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\HotelRoom;

class ReservationFactory extends Factory
{
    public function definition(): array
    {
        $start = fake()->dateTimeBetween('+1 week', '+3 weeks');
        $nights = rand(2, 7);
        $end = (clone $start)->modify("+{$nights} days");

        return [
            'user_id' => User::inRandomOrder()->first()?->id ?: User::factory(),
            'start_date' => $start->format('Y-m-d'),
            'end_date' => $end->format('Y-m-d'),
            'total_nights' => $nights,
            'package_id' => fake()->boolean(40) ? (Package::inRandomOrder()->first()?->id ?: Package::factory()) : null,
            'hotel_id' => fake()->boolean(50) ? ($hotel = Hotel::inRandomOrder()->first()) ? $hotel->id : null : null,
            'hotel_room_id' => isset($hotel) ? HotelRoom::where('hotel_id', $hotel->id)->inRandomOrder()->first()?->id : null,
            'flight_id' => fake()->boolean(50) ? (Flight::inRandomOrder()->first()?->id ?: Flight::factory()) : null,
            'activity_id' => fake()->boolean(30) ? (Activity::inRandomOrder()->first()?->id ?: Activity::factory()) : null,
            'total_price' => fake()->randomFloat(2, 150, 2500),
            'contact_name' => fake()->name(),
            'contact_dni' => fake()->bothify('########?'),
            'contact_email' => fake()->safeEmail(),
            'contact_phone' => fake()->phoneNumber(),
            'extras' => json_encode(['insurance' => fake()->boolean(), 'late_checkout' => fake()->boolean()]),
            'passengers_data' => json_encode([
                ['name' => fake()->firstName(), 'dni' => fake()->bothify('########?'), 'type' => 'adult']
            ]),
            'status' => fake()->randomElement(['pending', 'confirmed', 'cancelled']),
        ];
    }
}