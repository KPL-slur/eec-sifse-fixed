<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CmBodyReportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cm_body_reports')->insert([
            'head_id' => '1',
            'remark' => 'lorem ipsum blah blah blah',

            'created_at' => now(),
        ]);
    }
}
