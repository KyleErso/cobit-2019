<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\TrsPractRoles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrsPractRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::statement('PRAGMA foreign_keys = OFF;');
        TrsPractRoles::truncate();
        // DB::statement('PRAGMA foreign_keys = ON;');
        $heading = true;
        $input_file = fopen(base_path("csv/trs_practroles.csv"), "r");
        while (($record = fgetcsv($input_file, 1000, ",")) !== FALSE)
        {
            if (!$heading)
            {
                $TrsPractRoles = array(
                    "practice_id"=>$record['0'],
                    "role_id"=>$record['1'],
                    "r_a"=>$record['2'],
                    // "practice_description"=>$record['3'],
                );
                TrsPractRoles::create($TrsPractRoles);
            }
            $heading = false;
        }
        fclose($input_file);
    }
}
