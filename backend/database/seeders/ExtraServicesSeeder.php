<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hotel;
use App\Models\Flight;
use App\Models\Activity;

class ExtraServicesSeeder extends Seeder
{
    public function run(): void
    {
        $hotelExtras = [
            'Solo Alojamiento' => 0,
            'Alojamiento y Desayuno' => 15,
            'Media Pensión' => 35,
            'Pensión Completa' => 55,
            'Todo Incluido' => 80
        ];

        Hotel::all()->each(function ($hotel) use ($hotelExtras) {
            $hotel->update(['extras' => $hotelExtras]);
        });

        $flightExtras = [
            'Maleta de mano (10kg)' => 25,
            'Maleta facturada (20kg)' => 45,
            'Asiento con espacio extra' => 18,
            'Embarque prioritario' => 12,
            'Seguro de viaje' => 20
        ];

        Flight::all()->each(function ($flight) use ($flightExtras) {
            $flight->update(['extras' => $flightExtras]);
        });

        $activityExtras = [
            'Seguro de accidentes' => 5,
            'Pack Fotos y Vídeo' => 15,
            'Guía privado (idioma extra)' => 30,
            'Recogida en el hotel' => 10
        ];

        Activity::all()->each(function ($activity) use ($activityExtras) {
            $activity->update(['extras' => $activityExtras]);
        });
    }
}