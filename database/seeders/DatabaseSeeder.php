<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        try {
            $this->call(AdminSeeder::class);
            $this->call(RestaurantSeeder::class);
            $this->call(BranchSeeder::class);
            $this->call(PositionSeeder::class);
            $this->call(PersonnelSeeder::class);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('[DatabaseCoreSeeder][run] error ' . $e->getMessage());
        }
    }
}
