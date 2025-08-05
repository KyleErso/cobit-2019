<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\MstRoles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MstRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::statement('PRAGMA foreign_keys = OFF;');
        MstRoles::truncate();
        // DB::statement('PRAGMA foreign_keys = ON;');
        $heading = true;
        $input_file = fopen(base_path("csv/mst_roles.csv"), "r");
        while (($record = fgetcsv($input_file, 1000, ",")) !== FALSE)
        {
            if (!$heading)
            {
                $MstRoles = array(
                    "role_id"=>$record['0'],
                    "role"=>$record['1'],
                    "description"=>$record['2'],
                );
                MstRoles::create($MstRoles);
            }
            $heading = false;
        }
        fclose($input_file);
    }
}
