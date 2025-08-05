<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\MstPracticeMetr;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MstPracticeMetrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::statement('PRAGMA foreign_keys = OFF;');
        MstPracticeMetr::truncate();
        // DB::statement('PRAGMA foreign_keys = ON;');
        $heading = true;
        $input_file = fopen(base_path("csv/mst_practicemetr.csv"), "r");
        while (($record = fgetcsv($input_file, 1000, ",")) !== FALSE)
        {
            if (!$heading)
            {
                $MstPracticeMetr = array(
                    "id"=>$record['0'],
                    "practice_id"=>$record['1'],
                    "description"=>$record['2'],
                    // "practice_description"=>$record['3'],
                );
                MstPracticeMetr::create($MstPracticeMetr);
            }
            $heading = false;
        }
        fclose($input_file);
    }
}
