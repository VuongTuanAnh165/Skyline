<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('branches')->insert([
                [
                    "name" => $i,
                    'address' => 'Hà nội auto ' . $i,
                    "background" => 'image/restaurant/background.png',
                    "email" => 'exam' . $i . '@gmail.com',
                    "phone" =>  "03124567" . $i - 1,
                    "open_time" => "08:00",
                    "close_time" => "23:00",
                ],
            ]);
        }
    }
}
