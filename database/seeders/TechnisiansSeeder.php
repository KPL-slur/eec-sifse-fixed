<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TechnisiansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('technisians')->insert([
            'tech_id' => '1',
            'name' => 'M Fris Setiawan',

            'created_at' => now(),
        ]);
        DB::table('technisians')->insert([
            'tech_id' => '2',
            'name' => 'Ruhaedi Kurniawan',

            'created_at' => now(),
        ]);
        DB::table('technisians')->insert([
            'tech_id' => '3',
            'name' => 'Pontjo Agus Winarno',

            'created_at' => now(),
        ]);
    }
}
