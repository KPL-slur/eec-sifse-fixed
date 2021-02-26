<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SitedStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sited_stocks')->insert([
            'site_id'=>1,
            'stock_id'=>2,
        ]);

        DB::table('sited_stocks')->insert([
            'site_id'=>1,
            'stock_id'=>1,
        ]);
    }
}
