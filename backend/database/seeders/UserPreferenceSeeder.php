<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserPreference;

class UserPreferenceSeeder extends Seeder
{
    public function run(): void
    {
        $preferences = [
            ['user_id' => 1, 'travel_type' => 'Cultural',   'max_budget' => 5000.00, 'fav_weather' => 'Mediterráneo'],
            ['user_id' => 2, 'travel_type' => 'Urbano',     'max_budget' => 3000.00, 'fav_weather' => 'Templado'],
            ['user_id' => 3, 'travel_type' => 'Lujo',       'max_budget' => 8000.00, 'fav_weather' => 'Desértico'],
            ['user_id' => 4, 'travel_type' => 'Playa',      'max_budget' => 2000.00, 'fav_weather' => 'Tropical'],
            ['user_id' => 5, 'travel_type' => 'Aventura',   'max_budget' => 2500.00, 'fav_weather' => 'Variable'],
            ['user_id' => 6, 'travel_type' => 'Relajación', 'max_budget' => 3500.00, 'fav_weather' => 'Tropical'],
            ['user_id' => 7, 'travel_type' => 'Aventura',   'max_budget' => 1800.00, 'fav_weather' => 'Templado'],
            ['user_id' => 8, 'travel_type' => 'Cultural',   'max_budget' => 2200.00, 'fav_weather' => 'Mediterráneo'],
        ];

        foreach ($preferences as $pref) {
            UserPreference::create($pref);
        }
    }
}
