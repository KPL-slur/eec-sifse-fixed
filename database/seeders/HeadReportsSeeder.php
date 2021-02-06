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
            'maintenance_type' => 'pm',
            'radar_name' => 'DWSR-3501C',
            'station_id' => 'TIMIKA',
            'report_date_start' => now(),
            'report_date_end' => now(),
            'expertise1' => "Ruhaedi Kurniawan",
            'expertise2' => "M Fris Setiawan",
            'expertise_company1' => "Era Elektra Corpora Indonesia",
            'expertise_company2' => "Era Elektra Corpora Indonesia",

            'created_at' => now(),
        ]);
        DB::table('head_reports')->insert([
            'maintenance_type' => 'cm',
            'radar_name' => 'DWSR-2501C',
            'station_id' => 'Banjarmasin',
            'report_date_start' => now(),
            'report_date_end' => now(),
            'expertise1' => "Pontjo Agus Winarno",
            'expertise2' => "M Fris Setiawan",
            'expertise_company1' => "Era Elektra Corpora Indonesia",
            'expertise_company2' => "Era Elektra Corpora Indonesia",

            'created_at' => now(),
        ]);
    }
}
