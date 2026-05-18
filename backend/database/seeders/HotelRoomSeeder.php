<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HotelRoom;

class HotelRoomSeeder extends Seeder
{
    public function run(): void
    {
        $hotelRooms = [
            1 => ['base' => 220, 'rooms' => [['Individual', 1, 0.7], ['Doble Superior', 2, 1.0], ['Suite Real', 4, 1.8]]],
            2 => ['base' => 170, 'rooms' => [['Habitación Classic', 1, 0.7], ['Habitación Deluxe', 2, 1.0], ['Junior Suite', 3, 1.6]]],
            3 => ['base' => 280, 'rooms' => [['Habitación Estándar', 1, 0.7], ['Habitación Superior', 2, 1.0], ['Suite Fuji', 4, 1.9]]],
            4 => ['base' => 260, 'rooms' => [['City View Room', 1, 0.7], ['Empire State Room', 2, 1.0], ['Manhattan Suite', 4, 1.8]]],
            5 => ['base' => 350, 'rooms' => [['Deluxe Room', 2, 0.8], ['Sea View Suite', 2, 1.3], ['Palm Penthouse', 4, 2.5]]],
            6 => ['base' => 130, 'rooms' => [['Garden Villa', 2, 1.0], ['Pool Villa', 2, 1.5], ['Rice Field Suite', 4, 2.0]]],
            7 => ['base' => 145, 'rooms' => [['Classic Room', 1, 0.7], ['Gaudí View Room', 2, 1.0], ['Eixample Suite', 3, 1.7]]],
            8 => ['base' => 140, 'rooms' => [['Garden View', 2, 0.8], ['Ocean View', 2, 1.0], ['Presidential Suite', 4, 2.0]]],
            9 => ['base' => 180, 'rooms' => [['Classic Victorian', 1, 0.7], ['Covent Garden Room', 2, 1.0], ['Crown Suite', 3, 1.6]]],
            10 => ['base' => 230, 'rooms' => [['City Room', 1, 0.7], ['Harbour View Room', 2, 1.0], ['Opera Suite', 4, 1.9]]],
        ];

        foreach ($hotelRooms as $hotelId => $config) {
            foreach ($config['rooms'] as [$type, $capacity, $multiplier]) {
                HotelRoom::create([
                    'hotel_id' => $hotelId,
                    'type'     => $type,
                    'price'    => round($config['base'] * $multiplier, 2),
                    'capacity' => $capacity,
                    'stock'    => rand(5, 15),
                ]);
            }
        }
    }
}
