<?php

namespace Database\Seeders;

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
                'rol' => User::ROL_ADMIN,
            ],
            [
                'name' => 'gonza hughes',
                'email' => 'gonza@test.com',
                'password' => Hash::make('apoyo'),
                'rol' => User::ROL_USER,
            ]
        ];

        DB::table('users')->insert($users);
    }
}
