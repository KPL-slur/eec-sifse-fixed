<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class HeadReportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('head_reports')->insert([
            'site_id' => 1,
            'maintenance_type' => 'pm',
            'kasat_name' => 'Hermawan Dwi',
            'kasat_nip' => '123456789123456789',
            'report_date_start' => now(),
            'report_date_end' => now(),
            'created_at' => now(),
        ]);
        DB::table('head_reports')->insert([
            'site_id' => 1,
            'maintenance_type' => 'pm',
            'kasat_name' => 'Hermawan Dwi',
            'kasat_nip' => '123456789123456789',
            'report_date_start' => now(),
            'report_date_end' => now(),

            'created_at' => now(),
        ]);
        DB::table('head_reports')->insert([
            'site_id' => 2,
            'maintenance_type' => 'cm',
            'kasat_name' => 'Dwi Cahyono',
            'kasat_nip' => '123456789123456789',
            'report_date_start' => now(),
            'report_date_end' => now(),

            'created_at' => now(),
        ]);
        DB::table('head_reports')->insert([
            'site_id' => 2,
            'maintenance_type' => 'cm',
            'kasat_name' => 'Dwi Cahyono',
            'kasat_nip' => '123456789123456789',
            'report_date_start' => now(),
            'report_date_end' => now(),

            'created_at' => now(),
        ]);
    }
}
