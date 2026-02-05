<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Location;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Flight;
use App\Models\Activity;
use App\Models\Package;
use App\Models\UserPreference;
use App\Models\AIChatLog;
use App\Models\Reservation;
use App\Models\Review;

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
            ActivitySeeder::class,
            PackageSeeder::class,
            UserPreferenceSeeder::class,
            AIChatLogSeeder::class,
            ReservationSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}
