<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\TrsObjectiveGuidance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrsObjectiveGuidanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::statement('PRAGMA foreign_keys = OFF;');
        TrsObjectiveGuidance::truncate();
        // DB::statement('PRAGMA foreign_keys = ON;');
        $heading = true;
        $input_file = fopen(base_path("csv/trs_objectiveguidance.csv"), "r");
        while (($record = fgetcsv($input_file, 1000, ",")) !== FALSE)
        {
            if (!$heading)
            {
                $TrsObjectiveGuidance = array(
                    "objective_id"=>$record['0'],
                    "guidance_id"=>$record['1'],
                    "component"=>$record['2'],
                    // "practice_description"=>$record['3'],
                );
                TrsObjectiveGuidance::create($TrsObjectiveGuidance);
            }
            $heading = false;
        }
        fclose($input_file);
    }
}
