<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminUser = User::firstOrCreate(
            ['phone' => '09111111111'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin'),
            ]
        );
        $marketerUser = User::firstOrCreate(
            ['phone' => '09111111112'],
            [
                'name' => 'Marketer',
                'password' => Hash::make('marketer'),
            ]
        );
        $guestUser = User::firstOrCreate(
            ['phone' => '09111111113'],
            [
                'name' => 'Guest',
                'password' => Hash::make('guest'),
            ]
        );

        $adminUser->assignRole('Admin');
        $marketerUser->assignRole('Marketer');
        $guestUser->assignRole('Guest');

    }
}
