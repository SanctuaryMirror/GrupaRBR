<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'test@test.test'],
            [
                'name' => 'Test User 1',
                'password' => Hash::make('test123')
            ]
        );
        User::updateOrCreate(
            ['email' => 'test@test.com'],
            [
                'name' => 'Test User 2',
                'password' => Hash::make('test123')
            ]
        );
    }
}
