<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sites')->insert([
            'radar_name'=>'Radar Banjarmasin',
            'image'=>'027ce6f5bc035a08d207f0de97b23965.png',
            'station_id'=>'Banjarmasin'
        ]);
        DB::table('sites')->insert([
            'radar_name'=>'Radar Cengkareng',
            'image'=>'027ce6f5bc035a08d207f0de97b23965.png',
            'station_id'=>'Cengkareng'
        ]);
    }
}
