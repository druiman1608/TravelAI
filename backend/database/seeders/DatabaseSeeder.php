<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Location;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Flight;
use App\Models\Package;
use App\Models\Reservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            LocationSeeder::class,
            UserSeeder::class,
            HotelSeeder::class,
            FlightSeeder::class,
            PackageSeeder::class,
            ReservationSeeder::class,
        ]);
    }
}