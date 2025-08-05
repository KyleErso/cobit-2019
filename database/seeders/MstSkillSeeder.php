<?php

namespace Database\Seeders;

use App\Models\MstSkill;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MstSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::statement('PRAGMA foreign_keys = OFF;');
        MstSkill::truncate();
        // DB::statement('PRAGMA foreign_keys = ON;');
        $heading = true;
        $input_file = fopen(base_path("csv/mst_skill.csv"), "r");
        while (($record = fgetcsv($input_file, 1000, ",")) !== FALSE)
        {
            if (!$heading)
            {
                $MstSkill = array(
                    "skill_id"=>$record['0'],
                    "objective_id"=>$record['1'],
                    "skill"=>$record['2'],
                    // "practice_description"=>$record['3'],
                );
                MstSkill::create($MstSkill);
            }
            $heading = false;
        }
        fclose($input_file);
    }
}
