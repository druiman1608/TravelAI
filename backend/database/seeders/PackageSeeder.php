<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Package;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener localizaciones
        $locations = \App\Models\Location::all();

        // Crear paquetes
        foreach ($locations as $location) {
            \App\Models\Package::factory()->create([
                'hotel_id' => \App\Models\Hotel::where('location_id', $location->id)->inRandomOrder()->first()->id,
                'flight_id' => \App\Models\Flight::where('location_id', $location->id)->inRandomOrder()->first()->id,
                'activity_id' => \App\Models\Activity::where('location_id', $location->id)->inRandomOrder()->first()->id,
            ]);
        }
    }
}
