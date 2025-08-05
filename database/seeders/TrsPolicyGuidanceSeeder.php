<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\TrsPolicyGuidance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrsPolicyGuidanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::statement('PRAGMA foreign_keys = OFF;');
        TrsPolicyGuidance::truncate();
        // DB::statement('PRAGMA foreign_keys = ON;');
        $heading = true;
        $input_file = fopen(base_path("csv/trs_policyguidance.csv"), "r");
        while (($record = fgetcsv($input_file, 1000, ",")) !== FALSE)
        {
            if (!$heading)
            {
                $TrsPolicyGuidance = array(
                    "policy_id"=>$record['0'],
                    "guidance_id"=>$record['1'],
                    // "component"=>$record['2'],
                    // "practice_description"=>$record['3'],
                );
                TrsPolicyGuidance::create($TrsPolicyGuidance);
            }
            $heading = false;
        }
        fclose($input_file);
    }
}
