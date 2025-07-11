<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\MstAligngoals;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MstAligngoalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('PRAGMA foreign_keys = OFF;');
        MstAligngoals::truncate();
        // DB::statement('PRAGMA foreign_keys = ON;');
        $heading = true;
        $input_file = fopen(base_path("csv/mst_aligngoals.csv"), "r");
        while (($record = fgetcsv($input_file, 1000, ",")) !== FALSE)
        {
            if (!$heading)
            {
                $MstAligngoals = array(
                    // "aligngoalsmetr_id"=>$record['0'],
                    "aligngoals_id"=>$record['0'],
                    "description"=>$record['1'],
                );
                MstAligngoals::create($MstAligngoals);
            }
            $heading = false;
        }
        fclose($input_file);
    }
}
