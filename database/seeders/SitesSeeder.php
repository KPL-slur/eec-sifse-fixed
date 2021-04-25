<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Site;
use App\Models\SitedStock;
use App\Models\Distribution;

class SitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Site::factory(20)
                    ->has(Distribution::factory(2))
                    ->has(SitedStock::factory(30))
                    ->create();
        
        DB::table('sites')->insert([
            'radar_name'=>'DWSR-2501C',
            'image'=>'027ce6f5bc035a08d207f0de97b23965.png',
            'station_id'=>'Banjarmasin'
        ]);
        DB::table('sites')->insert([
            'radar_name'=>'DWSR-3501C',
            'image'=>'027ce6f5bc035a08d207f0de97b23965.png',
            'station_id'=>'Cengkareng'
        ]);
    }
}
