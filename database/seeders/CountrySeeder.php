<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Country::truncate();
        $csvFile = fopen(base_path("database/data/country.csv"), "r");

        $firstline = true;
        $data = [];
        while (($d = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
            if (!$firstline) {
                $data[] = [
                    'name' => $d[0],
                    'official_state_name' => $d[1],
                    'alpha_2' => $d[2],
                    'alpha_3' => $d[3],
                    'code' => $d[4],
                    'cctld' => $d[5],
                ];
            }
            $firstline = false;
        }

        fclose($csvFile);
        $collection = collect($data);
        $chunks = $collection->chunk(100);
        foreach ($chunks as $chunk) {
            Country::insert($chunk->toArray());
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
