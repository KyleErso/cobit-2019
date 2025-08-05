<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\MstEntergoalsmetr;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MstEntergoalsmetrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::statement('PRAGMA foreign_keys = OFF;');
        MstEntergoalsmetr::truncate();
        // DB::statement('PRAGMA foreign_keys = ON;');
        $heading = true;
        $input_file = fopen(base_path("csv/mst_entergoalsmetr.csv"), "r");
        while (($record = fgetcsv($input_file, 1000, ",")) !== FALSE)
        {
            if (!$heading)
            {
                $MstEntergoalsmetr = array(
                    "entergoalsmetr_id"=>$record['0'],
                    "entergoals_id"=>$record['1'],
                    "description"=>$record['2'],
                );
                MstEntergoalsmetr::create($MstEntergoalsmetr);
            }
            $heading = false;
        }
        fclose($input_file);
    }
}
