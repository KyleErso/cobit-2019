<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Bisa diganti
            'jabatan' => 'Administrator',
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Rakhmat Aji Jauhari',
            'email' => 'aji@divusi.com',
            'password' => Hash::make('CobitDivusi147!'),
            'jabatan' => 'Administrator',
            'role' => 'admin',
        ]);

        Schema::disableForeignKeyConstraints();

        $this->call([
            MstObjectiveSeeder::class,
            MstGuidanceSeeder::class,
            MstPolicySeeder::class,
            MstAreaSeeder::class,
            MstPolicySeeder::class,
            MstPracticeSeeder::class,
            MstRolesSeeder::class,
            MstSIASeeder::class,
            TrsDomainSeeder::class,
            TrsPracticeGuidanceSeeder::class,
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
