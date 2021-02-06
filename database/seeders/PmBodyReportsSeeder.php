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
            'running_time' => '047399.0 hrs',
            'radiate_time' => '046936.9 hrs',

            'hvps_v_0_4us' => '752.8 V',
            'hvps_i_0_4us' => '1.6 A',
            'mag_i_0_4us' => '27.3 mA',
            
            'hvps_v_0_8us' => '752.0 V',
            'hvps_i_0_8us' => '2.4 A',
            'mag_i_0_8us' => '47.2 mA',
            
            'hvps_v_1_0us' => '753.0 V',
            'hvps_i_1_0us' => '0.6 A',
            'mag_i_1_0us' => '12.4 mA',

            'hvps_v_2_0us' => '752.8 V',
            'hvps_i_2_0us' => '1.0 A',
            'mag_i_2_0us' => '23.2 mA',

            'forward_power' => '85.704 dBm',
            'reverse_power' => '54.93 dBm',
            'vswr' => '1.02 :1',

            'remark' => 'lorem ipsum blah blah blah',

            'created_at' => now(),
        ]);
    }
}
