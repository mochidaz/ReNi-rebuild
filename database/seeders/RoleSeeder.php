<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'name' => 'Admin',
        ];
        $guest = [
            'name' => 'Guest',
        ];

        DB::table('roles')->insert($roles);
        DB::table('roles')->insert($guest);
    }
}
