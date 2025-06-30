<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\MstInfoflowInput;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MstInfoflowInputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('PRAGMA foreign_keys = OFF;');
        MstInfoflowInput::truncate();
        // DB::statement('PRAGMA foreign_keys = ON;');
        $heading = true;
        $input_file = fopen(base_path("csv/mst_infoflowinput.csv"), "r");
        while (($record = fgetcsv($input_file, 1000, ",")) !== FALSE)
        {
            if (!$heading)
            {
                $MstInfoflowInput = array(
                    "input_id"=>$record['0'],
                    "practice_id"=>$record['1'],
                    "from"=>$record['2'],
                    "description"=>$record['3'],
                    // "practice_description"=>$record['3'],
                );
                MstInfoflowInput::create($MstInfoflowInput);
            }
            $heading = false;
        }
        fclose($input_file);
    }
}
