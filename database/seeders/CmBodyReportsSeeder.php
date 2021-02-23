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
        // ===== bawaan dari letoy =====
        // DB::table('cm_body_reports')->insert([
        //     'head_id' => '1',
        //     'remark' => "<h1>Generating fancy text</h1><p>So perhaps, you've generated some fancy text, and you're content that you can now copy and paste your fancy text in the comments section of funny cat videos, but perhaps you're wondering how it's even possible to change the font of your text? Is it some sort of hack? Are you copying and pasting an actual font?</p><p>Well, the answer is actually no - rather than generating fancy fonts, this converter creates fancy symbols. The explanation starts with unicode; an industry standard which creates the specification for thousands of different symbols and characters. All the characters that you see on your electronic devices, and printed in books, are likely specified by the unicode standard.</p>",

        //     'created_at' => now(),
        // ]);
        // ===== bawaan dari letoy =====
            
        // ==== hasil rancangan erd =====
        DB::table('cm_body_reports')->insert([
            'head_id' => 3,
            'remark' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nam ut dicta laudantium quis, dignissimos accusamus voluptas itaque dolor tempora ducimus voluptate nesciunt quisquam eligendi dolore, mollitia eaque iusto. Impedit, beatae.',
            'created_at' => now()
        ]);
        DB::table('cm_body_reports')->insert([
            'head_id' => 4,
            'remark' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nam ut dicta laudantium quis, dignissimos accusamus voluptas itaque dolor tempora ducimus voluptate nesciunt quisquam eligendi dolore, mollitia eaque iusto. Impedit, beatae.',
            'created_at' => now()
        ]);
        // ==== hasil rancangan erd =====
    }
}
