<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PmScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pm_schedules')->insert([
            'radar_name'=>'DWS'
        ]);
    }
}
