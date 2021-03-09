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
            'head_id' => 1,
            'name' => 'Stalo',
            'jumlah_unit_needed' => 5,
            'year' => 2021,

            'created_at' => now()
        ]);
        DB::table('recommendations')->insert([
            'head_id' => 2,
            'name' => 'MOXA',
            'jumlah_unit_needed' => 2,
            'year' => 2021,

            'created_at' => now()
        ]);
        // ===== hasil rancangan erd =====
    }
}
