<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\MstSIA;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MstSIASeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('PRAGMA foreign_keys = OFF;');
        MstSIA::truncate();
        DB::statement('PRAGMA foreign_keys = ON;');
        $heading = true;
        $input_file = fopen(base_path("csv/mst_SIA.csv"), "r");
        while (($record = fgetcsv($input_file, 1000, ",")) !== FALSE)
        {
            if (!$heading)
            {
                $MstSIA = array(
                    "sia_id"=>$record['0'],
                    "objective_id"=>$record['1'],
                    "description"=>$record['2'],
                );
                MstSIA::create($MstSIA);
            }
            $heading = false;
        }
        fclose($input_file);
    }
}
