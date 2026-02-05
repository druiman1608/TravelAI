<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuarios
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.es',
            'password' => bcrypt('Admin1234?'),
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Moderador',
            'email' => 'mod@mod.es',
            'password' => bcrypt('Mod1234?'),
            'role_id' => 2,
        ]);

        User::create([
            'name' => 'Premium',
            'email' => 'premium@premium.es',
            'password' => bcrypt('Premium1234?'),
            'role_id' => 3,
        ]);

        User::create([
            'name' => 'Usuario',
            'email' => 'user@user.es',
            'password' => bcrypt('Usuario1234?'),
            'role_id' => 4,
        ]);

        User::create([
            'name' => 'Tester',
            'email' => 'tester@tester.es',
            'password' => bcrypt('Tester1234?'),
            'role_id' => 4,
        ]);
    }
}
