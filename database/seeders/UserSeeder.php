<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Fumi',
                'email' => 'fumi@mail.com',
                'password' => Hash::make('abc12345'),
                'role_id' => 1,
                'updated_at' => NOW(),
                'created_at' => NOW()
            ],
            [
                'name' => 'Evan',
                'email' => 'evan@mail.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'updated_at' => NOW(),
                'created_at' => NOW()
            ],
            [
                'name' => 'Fred',
                'email' => 'fred@mail.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'updated_at' => NOW(),
                'created_at' => NOW()
            ],
        ];

        User::insert($users);
    }
}
