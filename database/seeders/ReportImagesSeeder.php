<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ===== hasil rancangan erd =====
        DB::table('report_images')->insert([
            'head_id' => 1,
            'image' => '027ce6f5bc035a08d207f0de97b23965.png',
            'caption' => 'example1',
            'created_at' => now()
        ]);
        DB::table('report_images')->insert([
            'head_id' => 2,
            'image' => '027ce6f5bc035a08d207f0de97b23965.png',
            'caption' => 'example2',
            'created_at' => now()
        ]);
        // ===== hasil rancangan erd =====
    }
}
