<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\TrsPracticeGuidance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrsPracticeGuidanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('PRAGMA foreign_keys = OFF;');
        TrsPracticeGuidance::truncate();
        DB::statement('PRAGMA foreign_keys = ON;');
        $heading = true;
        $input_file = fopen(base_path("csv/trs_practiceguidance.csv"), "r");
        while (($record = fgetcsv($input_file, 1000, ",")) !== FALSE)
        {
            if (!$heading)
            {
                $TrsPracticeGuidance = array(
                    "practice_id"=>$record['0'],
                    "guidance_id"=>$record['1'],
                    // "description"=>$record['2'],
                );
                TrsPracticeGuidance::create($TrsPracticeGuidance);
            }
            $heading = false;
        }
        fclose($input_file);
    }
}
