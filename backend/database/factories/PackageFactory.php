<?php

namespace Database\Factories;

use App\Models\Hotel;
use App\Models\Flight;
use App\Models\Activity;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class PackageFactory extends Factory
{
    public function definition(): array
    {
        $location = Location::inRandomOrder()->first() ?: Location::factory()->create();

        $hotel = Hotel::where('location_id', $location->id)->inRandomOrder()->first()
            ?: Hotel::factory()->create(['location_id' => $location->id]);

        $flight = Flight::where('destination_loc_id', $location->id)->inRandomOrder()->first()
            ?: Flight::factory()->create(['destination_loc_id' => $location->id]);

        $activity = Activity::where('location_id', $location->id)->inRandomOrder()->first()
            ?: Activity::factory()->create(['location_id' => $location->id]);

        return [
            'hotel_id' => $hotel->id,
            'flight_id' => $flight->id,
            'activity_id' => $activity->id,
            'name' => 'Experiencia en ' . $location->city,
            'description' => "Disfruta de un viaje inolvidable a {$location->city}. Incluye estancia en el hotel {$hotel->name}, vuelos ida y vuelta y la actividad: {$activity->name}.",
            'itinerary' => [
                "Día 1: Vuelo a {$location->city} y check-in en {$hotel->name}",
                "Día 2: Disfruta de {$activity->name}",
                "Día 3: Tiempo libre en la ciudad",
                "Día 4: Regreso a casa",
            ],
            'total_price' => fake()->randomFloat(2, 1000, 3000),
            'discount_price' => fake()->randomElement([null, fake()->randomFloat(2, 800, 950)]),
            'images' => [
                'https://picsum.photos/seed/' . rand(1, 1000) . '/800/600',
                'https://picsum.photos/seed/' . rand(1, 1000) . '/800/600',
            ],
        ];
    }
}