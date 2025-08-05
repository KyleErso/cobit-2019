<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\MstGuidance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MstGuidanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::statement('PRAGMA foreign_keys = OFF;');
        MstGuidance::truncate();
        // DB::statement('PRAGMA foreign_keys = ON;');
        $heading = true;
        $input_file = fopen(base_path("csv/mst_guidance.csv"), "r");
        while (($record = fgetcsv($input_file, 1000, ",")) !== FALSE)
        {
            if (!$heading)
            {
                $MstGuidance = array(
                    "guidance_id"=>$record['0'],
                    "guidance"=>$record['1'],
                    "reference"=>$record['2'],
                );
                MstGuidance::create($MstGuidance);
            }
            $heading = false;
        }
        fclose($input_file);
    }
}
