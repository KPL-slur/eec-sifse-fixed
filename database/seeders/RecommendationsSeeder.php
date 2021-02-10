<?php

namespace Database\Seeders;

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
        DB::table('recommendations')->insert([
            'head_id' => '1',
            'spare_part_name' => 'Protection Board',
            'qty' => '2',

            'created_at' => now(),
        ]);

        DB::table('recommendations')->insert([
            'head_id' => '1',
            'spare_part_name' => 'Acromag',
            'qty' => '2',

            'created_at' => now(),
        ]);

        DB::table('recommendations')->insert([
            'head_id' => '1',
            'spare_part_name' => 'KVM Display',
            'qty' => '1',

            'created_at' => now(),
        ]);
    }
}
