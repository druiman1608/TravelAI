<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener solo usuarios
        $users = \App\Models\User::where('role_id', 4)->get();

        // Crear reservas
        foreach ($users as $user) {
            \App\Models\Review::factory()->create(['user_id' => $user->id]);
        }
    }
}
