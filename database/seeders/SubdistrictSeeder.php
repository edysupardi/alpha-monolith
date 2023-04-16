<?php

namespace Database\Seeders;

use App\Models\Subdistrict;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubdistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Subdistrict::truncate();
        $csvFile = fopen(base_path("database/data/subdistrict.csv"), "r");

        $firstline = true;
        $data = [];
        while (($d = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
            if (!$firstline) {
                $data[] = [
                    'id' => $d[0],
                    'provience_id' => $d[1],
                    'district_id' => $d[2],
                    'name' => strtoupper($d[3]),
                ];
            }
            $firstline = false;
        }
        fclose($csvFile);
        $collection = collect($data);
        $chunks = $collection->chunk(100);
        foreach ($chunks as $chunk) {
            Subdistrict::insert($chunk->toArray());
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
