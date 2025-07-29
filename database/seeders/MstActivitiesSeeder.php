<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\MstActivities;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MstActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('PRAGMA foreign_keys = OFF;');
        MstActivities::truncate();
        // DB::statement('PRAGMA foreign_keys = ON;');
        $heading = true;
        $input_file = fopen(base_path("csv/mst_activities.csv"), "r");
        while (($record = fgetcsv($input_file, 1000, ",")) !== FALSE)
        {
            if (!$heading)
            {
                $MstActivities = array(
                    "activity_id"=>$record['0'],
                    "practice_id"=>$record['1'],
                    "description"=>$record['2'],
                    "capability_lvl"=>$record['3'],
                    // "practice_description"=>$record['3'],
                );
                MstActivities::create($MstActivities);
            }
            $heading = false;
        }
        fclose($input_file);
    }
}
