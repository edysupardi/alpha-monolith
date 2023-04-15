<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pwd = "Secret123!";
        $data = [
            [
                'id'                  => 1,
                'company_id'          => 1,
                'branch_id'           => 1,
                'name'                => 'Lita',
                'email'               => 'lita@gmail.com',
                'email_verified_at'   => NULL,
                'password'            => Hash::make($pwd),
                'avatar'              => NULL,
                'remember_token'      => NULL,
                'status'              => 1,
            ]
        ];

        User::insert($data);
    }
}
