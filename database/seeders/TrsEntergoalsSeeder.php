<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\TrsEntergoals;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrsEntergoalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('PRAGMA foreign_keys = OFF;');
        TrsEntergoals::truncate();
        DB::statement('PRAGMA foreign_keys = ON;');
        $heading = true;
        $input_file = fopen(base_path("csv/trs_entergoals.csv"), "r");
        while (($record = fgetcsv($input_file, 1000, ",")) !== FALSE)
        {
            if (!$heading)
            {
                $TrsEntergoals = array(
                    "objective_id"=>$record['0'],
                    "entergoals_id"=>$record['1'],
                    // "domain"=>$record['2'],
                );
                TrsEntergoals::create($TrsEntergoals);
            }
            $heading = false;
        }
        fclose($input_file);
    }
}
