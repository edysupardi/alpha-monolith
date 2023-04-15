<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        District::truncate();
        $csvFile = fopen(base_path("database/data/district.csv"), "r");

        $firstline = true;
        $data = [];
        while (($d = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
            if (!$firstline) {
                $data[] = [
                    'id' => $d[0],
                    'provience_id' => $d[1],
                    'name' => $d[2],
                ];
            }
            $firstline = false;
        }

        fclose($csvFile);
        $collection = collect($data);
        $chunks = $collection->chunk(100);
        foreach ($chunks as $chunk) {
            District::insert($chunk->toArray());
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
