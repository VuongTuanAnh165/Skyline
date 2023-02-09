<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_groups')->insert([
            [
                "name" => 'Account',
                "image" => 'img/service_group/FE0YKzKMyBK23VMIemB7BDyZKLa5Q9CgFD7p5iCJ.svg',
                "name_link" => 'account',
                "description" => 'Lưu trữ bảo mật hiệu suất cao cho trang web của bạn. Đừng để mất thêm khách hàng vì tốc độ chậm nhất của dịch vụ lưu trữ của bạn. Hơn 100 nghìn trang web được lưu trữ.',
            ],
        ]);
    }
}
