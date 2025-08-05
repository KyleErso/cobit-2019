<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\TrsSkillGuidance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrsSkillGuidanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::statement('PRAGMA foreign_keys = OFF;');
        TrsSkillGuidance::truncate();
        // DB::statement('PRAGMA foreign_keys = ON;');
        $heading = true;
        $input_file = fopen(base_path("csv/trs_skillguidance.csv"), "r");
        while (($record = fgetcsv($input_file, 1000, ",")) !== FALSE)
        {
            if (!$heading)
            {
                $TrsSkillGuidance = array(
                    "skill_id"=>$record['0'],
                    "guidance_id"=>$record['1'],
                    // "skill"=>$record['2'],
                    // "practice_description"=>$record['3'],
                );
                TrsSkillGuidance::create($TrsSkillGuidance);
            }
            $heading = false;
        }
        fclose($input_file);
    }
}
