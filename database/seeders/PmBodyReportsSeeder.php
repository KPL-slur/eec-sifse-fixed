<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PmBodyReportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ===== bawaan letoy & hasil rancangan erd =====
        DB::table('pm_body_reports')->insert([
            'head_id' => '1',

            //radio
            'radio_general_visual' => '1',
            'radio_rcms' => '1',
            'radio_wipe_down' => '1',
            'radio_inspect_all' => '1',
            'radio_compressor_visual' => '1',
            'radio_duty_cycle' => '1',
            'radio_transmitter_visual' => '1',
            'radio_receiver_visual' => '1',
            'radio_stalo_check' => '1',
            'radio_afc_check' => '1',
            'radio_mrp_check' => '1',
            'radio_rcu_check' => '1',
            'radio_iq2_check' => '1',
            'radio_antenna_visual' => '1',
            'radio_inspect_motor' => '1',
            'radio_clean_slip' => '1',
            'radio_grease_gear' => '1',

            //remark
            'running_time' => '047399.0',
            'radiate_time' => '046936.9',

            'hvps_v_0_4us' => '752.8',
            'hvps_i_0_4us' => '1.6',
            'mag_i_0_4us' => '27.3',
            
            'hvps_v_0_8us' => '752.0',
            'hvps_i_0_8us' => '2.4',
            'mag_i_0_8us' => '47.2',
            
            'hvps_v_1_0us' => '753.0',
            'hvps_i_1_0us' => '0.6',
            'mag_i_1_0us' => '12.4',

            'hvps_v_2_0us' => '752.8',
            'hvps_i_2_0us' => '1.0',
            'mag_i_2_0us' => '23.2',

            'forward_power' => '85.704',
            'reverse_power' => '54.93',
            'vswr' => '1.02',

            'remark' => '<h1>Olive Oil</h1><p>Olive oil composed of refined olive oils and virgin olive oils. Oil comprising exclusively olive  oils that have undergone refining and oils obtained directly from olives</p>',

            'created_at' => now(),
        ]);
        DB::table('pm_body_reports')->insert([
            'head_id' => '2',

            //radio
            'radio_general_visual' => '1',
            'radio_rcms' => '1',
            'radio_wipe_down' => '1',
            'radio_inspect_all' => '1',
            'radio_compressor_visual' => '0',
            'radio_duty_cycle' => '0',
            'radio_transmitter_visual' => '0',
            'radio_receiver_visual' => '0',
            'radio_stalo_check' => '0',
            'radio_afc_check' => '0',
            'radio_mrp_check' => '0',
            'radio_rcu_check' => '0',
            'radio_iq2_check' => '1',
            'radio_antenna_visual' => '0',
            'radio_inspect_motor' => '0',
            'radio_clean_slip' => '0',
            'radio_grease_gear' => '0',

            //remark
            'running_time' => '047399.0',
            'radiate_time' => '046936.9',

            'hvps_v_0_4us' => '752.8',
            'hvps_i_0_4us' => '1.6',
            'mag_i_0_4us' => '27.3',
            
            'hvps_v_0_8us' => '752.0',
            'hvps_i_0_8us' => '2.4',
            'mag_i_0_8us' => '47.2',
            
            'hvps_v_1_0us' => '753.0',
            'hvps_i_1_0us' => '0.6',
            'mag_i_1_0us' => '12.4',

            'hvps_v_2_0us' => '752.8',
            'hvps_i_2_0us' => '1.0',
            'mag_i_2_0us' => '23.2',

            'forward_power' => '85.704',
            'reverse_power' => '54.93',
            'vswr' => '1.02',

            'remark' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolor dolorum modi, quidem aperiam laudantium pariatur ut quam labore quisquam cum odio adipisci a nobis libero, iure minima consequatur, sed consequuntur?',

            'created_at' => now(),
        ]);
    }
}
