<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('restaurants')->insert([
            [
                "name" => 'lizardon',
                "logo" => 'image/restaurant/logo.png',
                "email" => 'restaurant@gmail.com',
                "password" => Hash::make('Restaurant123456'),
                "phone" => '0394857654'
            ],
        ]);
    }
}
