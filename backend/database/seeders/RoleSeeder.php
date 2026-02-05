<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Roles
        $roles = ['Administrador', 'Moderador', 'Premium', 'Usuario'];

        // Crear roles
        foreach ($roles as $role) {
            \App\Models\Role::create(['name' => $role]);
        }
    }
}
