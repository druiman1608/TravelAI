<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'role_id' => Role::where('name', 'Usuario')->firstOrFail()->id,
            'phone_number' => fake()->phoneNumber(),
            'profile_photo_path' => 'https://i.pravatar.cc/150?u=' . fake()->unique()->safeEmail(),
            'status' => 'active',
        ];
    }

    public function admin(): static
    {
        return $this->state(fn(array $attributes) => [
            'role_id' => Role::where('name', 'Administrador')->firstOrFail()->id,
        ]);
    }
}