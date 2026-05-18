<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Administrador', 'Moderador', 'Premium', 'Usuario'] as $name) {
            Role::firstOrCreate(['name' => $name]);
        }
    }
}