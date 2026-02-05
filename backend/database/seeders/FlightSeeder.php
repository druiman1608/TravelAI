<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Flight;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener localizaciones
        $locations = \App\Models\Location::all();

        // Crear vuelos
        foreach ($locations as $location) {
            \App\Models\Flight::factory(2)->create(['location_id' => $location->id]);
        }
    }
}
