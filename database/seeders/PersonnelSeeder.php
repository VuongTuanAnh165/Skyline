<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PersonnelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('personnels')->insert([
                [
                    "name" => 'name ' . $i,
                    "email" => 'example' . $i .'@gmail.com',
                    "password" => Hash::make('Personnal'.$i),
                    'phone' => '039123456' . $i,
                    'position_id'=> $i,
                ],
            ]);
        }
    }
}
