<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\MstPolicy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MstPolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('PRAGMA foreign_keys = OFF;');
        MstPolicy::truncate();
        DB::statement('PRAGMA foreign_keys = ON;');
        $heading = true;
        $input_file = fopen(base_path("csv/mst_policy.csv"), "r");
        while (($record = fgetcsv($input_file, 1000, ",")) !== FALSE)
        {
            if (!$heading)
            {
                $MstPolicy = array(
                    "policy_id"=>$record['0'],
                    "objective_id"=>$record['1'],
                    "policy"=>$record['2'],
                    "description"=>$record['3'],
                );
                MstPolicy::create($MstPolicy);
            }
            $heading = false;
        }
        fclose($input_file);
    }
}
