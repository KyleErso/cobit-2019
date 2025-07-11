<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\TrsDomain;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrsDomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('PRAGMA foreign_keys = OFF;');
        TrsDomain::truncate();
        DB::statement('PRAGMA foreign_keys = ON;');
        $heading = true;
        $input_file = fopen(base_path("csv/trs_domain.csv"), "r");
        while (($record = fgetcsv($input_file, 1000, ",")) !== FALSE)
        {
            if (!$heading)
            {
                $TrsDomain = array(
                    "area"=>$record['0'],
                    "objective_id"=>$record['1'],
                    "domain"=>$record['2'],
                );
                TrsDomain::create($TrsDomain);
            }
            $heading = false;
        }
        fclose($input_file);
    }
}
