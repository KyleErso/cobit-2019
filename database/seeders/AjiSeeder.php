<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AjiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Rakhmat Aji Jauhari',
            'email' => 'aji@divusi.com',
            'password' => Hash::make('CobitDivusi147!'),
            'jabatan' => 'Administrator',
            'role' => 'admin',
        ]);
    }
}