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
            'nip' => '0',
            'expert_company'=>'Era Elektra Corpora Indonesia',
            'created_at' => now()
        ]);
        DB::table('experts')->insert([
            'name' => 'Ruhaedi Kurniawan',
            'nip' => '0',
            'expert_company'=>'Era Elektra Corpora Indonesia',
            'created_at' => now()
        ]);
        DB::table('experts')->insert([
            'name' => 'Pontjo Agus Winarno',
            'nip' => '0',
            'expert_company'=>'Era Elektra Corpora Indonesia',
            'created_at' => now()
        ]);
        DB::table('experts')->insert([
            'name' => 'Moshe Nashiruddin',
            'nip' => '24060118140141',
            'expert_company'=>'Statsiun Meteorologi Syamsudin Noor',
            'created_at' => now()
        ]);
        DB::table('experts')->insert([
            'name' => 'Dameon Pranowo S.T.',
            'nip' => '24060118140141',
            'expert_company'=>'Statsiun Meteorologi Syamsudin Noor',
            'created_at' => now()
        ]);
        DB::table('experts')->insert([
            'name' => 'Bernard Mardhiyah',
            'nip' => '24060118140141',
            'expert_company'=>'Statsiun Meteorologi Timika',
            'created_at' => now()
        ]);
        DB::table('experts')->insert([
            'name' => 'Gerardo Handayani',
            'nip' => '24060118140141',
            'expert_company'=>'Statsiun Meteorologi Timika',
            'created_at' => now()
        ]);
        DB::table('experts')->insert([
            'name' => 'Ivah Utama',
            'nip' => '24060118140141',
            'expert_company'=>'Statsiun Meteorologi Timika',
            'created_at' => now()
        ]);
        // ===== hasil rancangan erd =====
    }
}
