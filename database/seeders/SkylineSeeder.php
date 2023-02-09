<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SkylineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skylines')->insert([
            [
                "name" => 'Sky Line',
                "email" => 'skyline@gmail.com',
                "phone" => '0394857654',
                "address" => '235 Hoàng Quốc Việt, Cổ Nhuế, Bắc Từ Liêm, Hà Nội, Việt Nam',
                'client_id' => 'AVc_CFoZ0ekAohOeMvqebQUO2v5ZAnhgEYCPdtq-X5stbDB-f-JC2PAGqaeHdt04xKCirrBo-AAkSgQ4',
                'secret' => 'EO5qdqs0YR-bjV-uQ8xd3yWG0BfkqvONYy49kC69TUyiEZr68Zm-F2ePCeTokUnRdvybiRSgjjJQgN0M'
            ],
        ]);
    }
}
