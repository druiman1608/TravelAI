<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Activity;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener localizaciones
        $locations = \App\Models\Location::all();

        // Crear actividades
        foreach ($locations as $location) {
            \App\Models\Activity::factory(2)->create(['location_id' => $location->id]);
        }
    }
}
