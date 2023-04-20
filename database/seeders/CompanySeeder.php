<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id'              => 1,
                'name'            => 'Sakti Medika',
                'phone_number'    => '6221123',
                'address'         => 'Jl. Tebet Barat I No.5, RT.1/RW.2',
                'village_id'      => 3174011002,
                'subdistrict_id'  => 317401,
                'district_id'     => 3174,
                'provience_id'    => 31,
                'zip_code'        => '12810',
            ]
        ];

        Company::insert($data);
    }
}
