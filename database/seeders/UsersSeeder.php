<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            'no_ktp' => '1234567890',
            'name' => 'John Doe',
            'password' => bcrypt('password'),
            'role_id' => 1,
        ];

        DB::table('users')->insert($users);
    }
}
