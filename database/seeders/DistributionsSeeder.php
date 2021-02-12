<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistributionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ===== hasil rancangan erd =====
        DB::table('distributions')->insert([
            'expert_id'=> 1,
            'site_id'=>1,
            'created_at' => now()
        ]);
        DB::table('distributions')->insert([
            'expert_id'=> 2,
            'site_id'=>2,
            'created_at' => now()
        ]);
        // ===== hasil rancangan erd =====
    }
}
