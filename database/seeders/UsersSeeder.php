<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'dylan riquelme',
                'email' => 'dylan@test.com',
                'password' => Hash::make('apoyo'),
                'role' => User::ROLE_ADMIN,
            ],
            [
                'name' => 'gonza hughes',
                'email' => 'gonza@test.com',
                'password' => Hash::make('apoyo'),
                'role' => User::ROLE_USER,
            ]
        ];

        DB::table('users')->insert($users);
    }
}
