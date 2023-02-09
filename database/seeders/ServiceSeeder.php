<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            [
                "name" => 'Account quản lý nhà hàng',
                "image" => 'img/service/GsbiR9IAKNX6h37Pg5MqhC155JytkBR65Lu3Pl0t.svg',
                "name_link" => 'account-quan-ly-nha-hang',
                "service_group_id" => 1,
                'content' => '<p>- Trang quản lý</p><p>- Trang bán hàng</p><p>- Trang hóa đơn</p>',
            ],
            [
                "name" => 'Acount quản lý bán lẻ',
                "image" => 'img/service/zMJBRZWCK2Ov3gLawZCtAx4bKyQ6WOLkf0s6oQfv.svg',
                "name_link" => 'acount-quan-ly-ban-le',
                "service_group_id" => 1,
                'content' => '<p>radf</p><p>fdsaaf&nbsp;</p><p>dfa&nbsp;</p><p>dsaf&nbsp;</p><p>adsf</p>',
            ],
        ]);
    }
}
