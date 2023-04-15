<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountrySeeder::class);
        $this->call(ProvienceSeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(SubdistrictSeeder::class);
        $this->call(VillageSeeder::class);

        $this->call(CompanySeeder::class);
        $this->call(BranchSeeder::class);
        $this->call(UserSeeder::class);
    }
}
