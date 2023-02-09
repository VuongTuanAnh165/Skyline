<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('positions')->insert([
                [
                    "name" => 'name ' . $i,
                    "wage" => 1000000 + $i,
                ],
            ]);
        }
    }
}
