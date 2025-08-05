<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\TrsAligngoals;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrsAligngoalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::statement('PRAGMA foreign_keys = OFF;');
        TrsAligngoals::truncate();
        // DB::statement('PRAGMA foreign_keys = ON;');
        $heading = true;
        $input_file = fopen(base_path("csv/trs_aligngoals.csv"), "r");
        while (($record = fgetcsv($input_file, 1000, ",")) !== FALSE)
        {
            if (!$heading)
            {
                $TrsAligngoals = array(
                    "objective_id"=>$record['0'],
                    "aligngoals_id"=>$record['1'],
                    // "domain"=>$record['2'],
                );
                TrsAligngoals::create($TrsAligngoals);
            }
            $heading = false;
        }
        fclose($input_file);
    }
}
