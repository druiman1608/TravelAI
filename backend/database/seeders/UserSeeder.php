<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'role_id'             => 1,
                'name'                => 'Carlos Rodríguez',
                'email'               => 'admin@travelai.com',
                'password'            => Hash::make('Admin1234!'),
                'phone_number'        => '+34 600 000 001',
                'profile_photo_path'  => 'ImagesProduccion/Avatars/Admin/AdminUserAvatar.jpg',
                'status'              => 'active',
                'email_verified_at'   => now(),
            ],
            [
                'role_id'             => 2,
                'name'                => 'Ana Martínez',
                'email'               => 'moderador@travelai.com',
                'password'            => Hash::make('Moderador1234!'),
                'phone_number'        => '+34 600 000 002',
                'profile_photo_path'  => 'ImagesProduccion/Avatars/Mod/ModeratorUserAvatar.jpg',
                'status'              => 'active',
                'email_verified_at'   => now(),
            ],
            [
                'role_id'             => 3,
                'name'                => 'Luis García',
                'email'               => 'premium@travelai.com',
                'password'            => Hash::make('Premium1234!'),
                'phone_number'        => '+34 600 000 003',
                'profile_photo_path'  => 'ImagesProduccion/Avatars/Premium/PremiumUserAvatar.jpg',
                'status'              => 'active',
                'email_verified_at'   => now(),
            ],
            [
                'role_id'             => 4,
                'name'                => 'María López',
                'email'               => 'usuario@travelai.com',
                'password'            => Hash::make('Usuario1234!'),
                'phone_number'        => '+34 600 000 004',
                'profile_photo_path'  => 'ImagesProduccion/Avatars/User/UserAvatar.jpg',
                'status'              => 'active',
                'email_verified_at'   => now(),
            ],
            [
                'role_id'             => 4,
                'name'                => 'Jorge Fernández',
                'email'               => 'jorge.fernandez@email.com',
                'password'            => Hash::make('Password1234!'),
                'phone_number'        => '+34 611 223 344',
                'profile_photo_path'  => 'ImagesProduccion/Avatars/RandomUser1/RandomUser1.jpg',
                'status'              => 'active',
                'email_verified_at'   => now(),
            ],
            [
                'role_id'             => 4,
                'name'                => 'Sofía Torres',
                'email'               => 'sofia.torres@email.com',
                'password'            => Hash::make('Password1234!'),
                'phone_number'        => '+34 622 334 455',
                'profile_photo_path'  => 'ImagesProduccion/Avatars/RandomUser2/RandomUser2.jpg',
                'status'              => 'active',
                'email_verified_at'   => now(),
            ],
            [
                'role_id'             => 4,
                'name'                => 'Pablo Sánchez',
                'email'               => 'pablo.sanchez@email.com',
                'password'            => Hash::make('Password1234!'),
                'phone_number'        => '+34 633 445 566',
                'profile_photo_path'  => 'ImagesProduccion/Avatars/RandomUser3/RandomUser3.jpg',
                'status'              => 'active',
                'email_verified_at'   => now(),
            ],
            [
                'role_id'             => 4,
                'name'                => 'Laura Jiménez',
                'email'               => 'laura.jimenez@email.com',
                'password'            => Hash::make('Password1234!'),
                'phone_number'        => '+34 644 556 677',
                'profile_photo_path'  => 'ImagesProduccion/Avatars/RandomUser4/RandomUser4.jpg',
                'status'              => 'active',
                'email_verified_at'   => now(),
            ],
        ];

        foreach ($users as $data) {
            User::create($data);
        }
    }
}
