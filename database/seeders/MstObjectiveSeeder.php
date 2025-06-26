<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MstObjective;

class MstObjectiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // MstObjective::truncate();
        $heading = true;
        $input_file = fopen(base_path("csv/mst_objective.csv"), "r");
        while (($record = fgetcsv($input_file, 1000, ",")) !== FALSE)
        {
            if (!$heading)
            {
                $MstObjective = array(
                    "objective_id"=>$record['0'],
                    "objective"=>$record['1'],
                    "objective_description"=>$record['2'],
                    "objective_purpose"=>$record['3']
                );
                MstObjective::create($MstObjective);
            }
            $heading = false;
        }
        fclose($input_file);
    }
}
