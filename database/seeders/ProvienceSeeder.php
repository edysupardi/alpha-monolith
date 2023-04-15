<?php

namespace Database\Seeders;

use App\Models\Provience;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Provience::truncate();
        $csvFile = fopen(base_path("database/data/provience.csv"), "r");

        $firstline = true;
        $data = [];
        while (($d = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
            if (!$firstline) {
                $data[] = [
                    'id' => $d[0],
                    'name' => $d[1],
                    'latitude' => $d[2],
                    'longitude' => $d[3],
                ];
            }
            $firstline = false;
        }

        fclose($csvFile);
        $collection = collect($data);
        $chunks = $collection->chunk(100);
        foreach ($chunks as $chunk) {
            Provience::insert($chunk->toArray());
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
