<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\MstPracticeOutput;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MstPracticeOutputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::statement('PRAGMA foreign_keys = OFF;');
        MstPracticeOutput::truncate();
        // DB::statement('PRAGMA foreign_keys = ON;');
        $heading = true;
        $input_file = fopen(base_path("csv/mst_practiceoutput.csv"), "r");
        while (($record = fgetcsv($input_file, 1000, ",")) !== FALSE)
        {
            if (!$heading)
            {
                $MstPracticeOutput = array(
                    "practiceoutput_id"=>$record['0'],
                    "output_id"=>$record['1'],
                    "practice_id"=>$record['2'],
                    // "to"=>$record['2'],
                    // "description"=>$record['3'],
                    // "practice_description"=>$record['3'],
                );
                MstPracticeOutput::create($MstPracticeOutput);
            }
            $heading = false;
        }
        fclose($input_file);
    }
}
