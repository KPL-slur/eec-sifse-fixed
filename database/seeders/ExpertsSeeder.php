<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpertsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ===== hasil rancangan erd =====
        DB::table('experts')->insert([
            'name' => 'M. Fris',
            'nip' => '24060118130086',
            'expert_company'=>'wimindo',
            'created_at' => now()
        ]);
        DB::table('experts')->insert([
            'name' => 'M. Ucok',
            'nip' => '24060118140141',
            'expert_company'=>'wimindo',
            'created_at' => now()
        ]);
        // ===== hasil rancangan erd =====
    }
}
