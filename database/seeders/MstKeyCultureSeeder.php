<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\MstKeyCulture;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MstKeyCultureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('PRAGMA foreign_keys = OFF;');
        MstKeyCulture::truncate();
        // DB::statement('PRAGMA foreign_keys = ON;');
        $heading = true;
        $input_file = fopen(base_path("csv/mst_keyculture.csv"), "r");
        while (($record = fgetcsv($input_file, 1000, ",")) !== FALSE)
        {
            if (!$heading)
            {
                $MstKeyCulture = array(
                    "keyculture_id"=>$record['0'],
                    "objective_id"=>$record['1'],
                    "element"=>$record['2'],
                    // "practice_description"=>$record['3'],
                );
                MstKeyCulture::create($MstKeyCulture);
            }
            $heading = false;
        }
        fclose($input_file);
    }
}
