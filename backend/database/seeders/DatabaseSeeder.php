<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            LocationSeeder::class,
            UserSeeder::class,
            UserPreferenceSeeder::class,
            HotelSeeder::class,
            HotelRoomSeeder::class,
            FlightSeeder::class,
            FlightOfferSeeder::class,
            ActivitySeeder::class,
            PackageSeeder::class,
            ExtraServicesSeeder::class,
            ReservationSeeder::class,
            PassengerSeeder::class,
            ReviewSeeder::class,
            AIChatLogSeeder::class,
        ]);
    }
}