<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AIChatLog;

class AIChatLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener usuarios
        $users = \App\Models\User::all();

        // Crear logs
        foreach ($users as $user) {
            \App\Models\AIChatLog::factory(3)->create(['user_id' => $user->id]);
        }
    }
}
