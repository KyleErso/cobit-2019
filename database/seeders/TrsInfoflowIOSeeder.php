<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\TrsInfoflowIO;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrsInfoflowIOSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::statement('PRAGMA foreign_keys = OFF;');
        TrsInfoflowIO::truncate();
        // DB::statement('PRAGMA foreign_keys = ON;');
        $heading = true;
        $input_file = fopen(base_path("csv/trs_infoflowio.csv"), "r");
        while (($record = fgetcsv($input_file, 1000, ",")) !== FALSE)
        {
            if (!$heading)
            {
                $TrsInfoflowIO = array(
                    "input_id"=>$record['0'],
                    "output_id"=>$record['1'],
                    // "skill"=>$record['2'],
                    // "practice_description"=>$record['3'],
                );
                TrsInfoflowIO::create($TrsInfoflowIO);
            }
            $heading = false;
        }
        fclose($input_file);
    }
}
