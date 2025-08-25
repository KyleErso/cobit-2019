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
        // User::create([
        //     'name' => 'Admin',
        //     'email' => 'admin@example.com',
        //     'password' => Hash::make('password'), // Bisa diganti
        //     'jabatan' => 'Administrator',
        //     'role' => 'admin',
        // ]);

        // User::create([
        //     'name' => 'Rakhmat Aji Jauhari',
        //     'email' => 'aji@divusi.com',
        //     'password' => Hash::make('CobitDivusi147!'),
        //     'jabatan' => 'Administrator',
        //     'role' => 'admin',
        // ]);

        Schema::disableForeignKeyConstraints();

        $this->call([
            MstActivitiesSeeder::class,
            MstAligngoalsSeeder::class,
            MstAligngoalsmetrSeeder::class,
            MstAreaSeeder::class,
            MstEntergoalsSeeder::class,
            MstEntergoalsmetrSeeder::class,
            MstGuidanceSeeder::class,
            MstInfoflowInputSeeder::class,
            MstInfoflowOutputSeeder::class,
            MstPracticeOutputSeeder::class,
            MstKeyCultureSeeder::class,
            MstObjectiveSeeder::class,
            MstPolicySeeder::class,
            MstPracticeMetrSeeder::class,
            MstPracticeSeeder::class,
            MstRolesSeeder::class,
            MstSIASeeder::class,
            MstSkillSeeder::class,
            TrsAligngoalsSeeder::class,
            TrsDomainSeeder::class,
            TrsEntergoalsSeeder::class,
            TrsInfoflowIOSeeder::class,
            TrsKeyCultureGuidanceSeeder::class,
            TrsObjectiveGuidanceSeeder::class,
            TrsPolicyGuidanceSeeder::class,
            TrsPracticeGuidanceSeeder::class,
            TrsPractRolesSeeder::class,
            TrsSkillGuidanceSeeder::class,
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
