<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RecommendationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ===== hasil rancangan erd =====
        DB::table('recommendations')->insert([
            'rec_id' => 1,
            'head_id' => 1,
            'stock_id' => 1,
            'jumlah_unit_needed' => 5,
            'year' => 2021,

            'created_at' => now()
        ]);
        // ===== hasil rancangan erd =====
    }
}
