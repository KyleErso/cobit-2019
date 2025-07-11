<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\MstEntergoals;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MstEntergoalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('PRAGMA foreign_keys = OFF;');
        MstEntergoals::truncate();
        // DB::statement('PRAGMA foreign_keys = ON;');
        $heading = true;
        $input_file = fopen(base_path("csv/mst_entergoals.csv"), "r");
        while (($record = fgetcsv($input_file, 1000, ",")) !== FALSE)
        {
            if (!$heading)
            {
                $MstEntergoals = array(
                    // "aligngoalsmetr_id"=>$record['0'],
                    "entergoals_id"=>$record['0'],
                    "description"=>$record['1'],
                );
                MstEntergoals::create($MstEntergoals);
            }
            $heading = false;
        }
        fclose($input_file);
    }
}
