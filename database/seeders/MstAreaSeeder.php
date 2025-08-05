<?php

namespace Database\Seeders;

use App\Models\MstArea;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MstAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $heading = true;
        $input_file = fopen(base_path("csv/mst_area.csv"), "r");
        while (($record = fgetcsv($input_file, 1000, ",")) !== FALSE)
        {
            if (!$heading)
            {
                $MstArea = array(
                    "area"=>$record['0'],
                );
                MstArea::create($MstArea);
            }
            $heading = false;
        }
        fclose($input_file);
    }
}
