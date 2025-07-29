<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\MstPractice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MstPracticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('PRAGMA foreign_keys = OFF;');
        MstPractice::truncate();
        // DB::statement('PRAGMA foreign_keys = ON;');
        $heading = true;
        $input_file = fopen(base_path("csv/mst_practice.csv"), "r");
        while (($record = fgetcsv($input_file, 1000, ",")) !== FALSE)
        {
            if (!$heading)
            {
                $MstPractice = array(
                    "practice_id"=>$record['0'],
                    "objective_id"=>$record['1'],
                    "practice_name"=>$record['2'],
                    "practice_description"=>$record['3'],
                );
                MstPractice::create($MstPractice);
            }
            $heading = false;
        }
        fclose($input_file);
    }
}
