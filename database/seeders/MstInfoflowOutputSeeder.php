<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\MstInfoflowOutput;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MstInfoflowOutputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::statement('PRAGMA foreign_keys = OFF;');
        MstInfoflowOutput::truncate();
        // DB::statement('PRAGMA foreign_keys = ON;');
        $heading = true;
        $input_file = fopen(base_path("csv/mst_infoflowoutput.csv"), "r");
        while (($record = fgetcsv($input_file, 1000, ",")) !== FALSE)
        {
            if (!$heading)
            {
                $MstInfoflowOutput = array(
                    "output_id"=>$record['0'],
                    "practice_id"=>$record['1'],
                    "to"=>$record['2'],
                    "description"=>$record['3'],
                    // "practice_description"=>$record['3'],
                );
                MstInfoflowOutput::create($MstInfoflowOutput);
            }
            $heading = false;
        }
        fclose($input_file);
    }
}
