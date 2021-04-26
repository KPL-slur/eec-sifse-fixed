<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Expert;

class ExpertsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Expert::factory(config('seeder.eecid_expert_count'))->eecid()->create();
        Expert::factory(config('seeder.expert_count'))->create();
        
        DB::table('experts')->insert([
            'name' => 'M. Fris',
            'nip' => 12345678901,
            'expert_company'=>'Era Elektra Corpora Indonesia',
            'created_at' => now()
        ]);
        DB::table('experts')->insert([
            'name' => 'Ruhaedi Kurniawan',
            'nip' => 12345678902,
            'expert_company'=>'Era Elektra Corpora Indonesia',
            'created_at' => now()
        ]);
        DB::table('experts')->insert([
            'name' => 'Pontjo Agus Winarno',
            'nip' => 12345678903,
            'expert_company'=>'Era Elektra Corpora Indonesia',
            'created_at' => now()
        ]);
    }
}
