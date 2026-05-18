<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FlightOffer;

class FlightOfferSeeder extends Seeder
{
    public function run(): void
    {
        $offers = [
            ['type' => 'one_way',    'outbound_flight_id' => 1,  'return_flight_id' => null, 'total_price' => 745.00],
            ['type' => 'one_way',    'outbound_flight_id' => 3,  'return_flight_id' => null, 'total_price' => 389.00],
            ['type' => 'one_way',    'outbound_flight_id' => 7,  'return_flight_id' => null, 'total_price' => 285.00],
            ['type' => 'one_way',    'outbound_flight_id' => 15, 'return_flight_id' => null, 'total_price' => 490.00],
            ['type' => 'one_way',    'outbound_flight_id' => 9,  'return_flight_id' => null, 'total_price' => 620.00],
            ['type' => 'one_way',    'outbound_flight_id' => 11, 'return_flight_id' => null, 'total_price' => 72.00],
            ['type' => 'one_way',    'outbound_flight_id' => 13, 'return_flight_id' => null, 'total_price' => 89.00],
            ['type' => 'one_way',    'outbound_flight_id' => 6,  'return_flight_id' => null, 'total_price' => 138.00],
            ['type' => 'one_way',    'outbound_flight_id' => 5,  'return_flight_id' => null, 'total_price' => 145.00],
            ['type' => 'round_trip', 'outbound_flight_id' => 1,  'return_flight_id' => 2,  'total_price' => 1390.00],
            ['type' => 'round_trip', 'outbound_flight_id' => 3,  'return_flight_id' => 4,  'total_price' => 720.00],
            ['type' => 'round_trip', 'outbound_flight_id' => 6,  'return_flight_id' => 5,  'total_price' => 265.00],
            ['type' => 'round_trip', 'outbound_flight_id' => 7,  'return_flight_id' => 8,  'total_price' => 540.00],
            ['type' => 'round_trip', 'outbound_flight_id' => 15, 'return_flight_id' => 16, 'total_price' => 960.00],
            ['type' => 'round_trip', 'outbound_flight_id' => 11, 'return_flight_id' => 12, 'total_price' => 130.00],
            ['type' => 'round_trip', 'outbound_flight_id' => 13, 'return_flight_id' => 14, 'total_price' => 160.00],
        ];

        foreach ($offers as $data) {
            FlightOffer::create($data);
        }
    }
}
