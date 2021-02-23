<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpertReportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ===== hasil rancangan erd =====
        DB::table('expert_reports')->insert([
            'head_id'=>1,
            'expert_id'=>1,
            'created_at'=>now()
        ]);
        DB::table('expert_reports')->insert([
            'head_id'=>2,
            'expert_id'=>2,
            'created_at'=>now()
        ]);
        // ===== hasil rancangan erd =====
        
    }
}
