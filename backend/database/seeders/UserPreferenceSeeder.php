<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserPreference;

class UserPreferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener usuarios
        $users = \App\Models\User::all();

        // Crear preferencias
        foreach ($users as $user) {
            \App\Models\UserPreference::factory()->create(['user_id' => $user->id]);
        }
    }
}
