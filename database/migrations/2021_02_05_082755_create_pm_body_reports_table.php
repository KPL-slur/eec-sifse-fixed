<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePmBodyReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // ===== bawaan dr letoy =====
        // Schema::create('pm_body_reports', function (Blueprint $table) {
        //     $table->id();
        //     $table->bigInteger('head_id'); // id of the head of current report. ex: if the id is 5 it means this report has the head reports of 5
        
        //     /* 
        //     *   RADIO
        //     *   boolean or TINYINT(1)
        //     *   in html form input use value 1 for PASS
        //     *   and 0 for FAIL
        //     */
        //     $table->boolean('radio_general_visual');
        //     $table->boolean('radio_rcms');
        //     $table->boolean('radio_wipe_down');
        //     $table->boolean('radio_inspect_all');
        
        //     $table->boolean('radio_compressor_visual');
        //     $table->boolean('radio_duty_cycle');
        
        //     $table->boolean('radio_transmitter_visual');
        
        //     // NULLABLE RADIO
        //     // because that what the example report say
        //     $table->boolean('radio_running_time')->nullable();
        //     $table->boolean('radio_radiate_time')->nullable();
        //     $table->boolean('radio_0_4us')->nullable();
        //     $table->boolean('radio_0_8us')->nullable();
        //     $table->boolean('radio_1_0us')->nullable();
        //     $table->boolean('radio_2_0us')->nullable();
        //     $table->boolean('radio_forward_power')->nullable();
        //     $table->boolean('radio_reverse_power')->nullable();
        //     $table->boolean('radio_vswr')->nullable();
        //     //END OF NULLABLE RADIO VALUE

        //     $table->boolean('radio_receiver_visual');
        //     $table->boolean('radio_stalo_check');
        //     $table->boolean('radio_afc_check');
        //     $table->boolean('radio_mrp_check');
        //     $table->boolean('radio_rcu_check');
        //     $table->boolean('radio_iq2_check');
        
        //     $table->boolean('radio_antenna_visual');
        //     $table->boolean('radio_inspect_motor');
        //     $table->boolean('radio_clean_slip');
        //     $table->boolean('radio_grease_gear');
        
        //     // REMARK
        //     $table->string('general_visual')->nullable();
        //     $table->string('rcms')->nullable();
        //     $table->string('wipe_down')->nullable();
        //     $table->string('inspect_all')->nullable();
        
        //     $table->string('compressor_visual')->nullable();
        //     $table->string('duty_cycle')->nullable();
        
        //     $table->string('transmitter_visual')->nullable();

        //     //NOT NULLABLE REMARK
        //     $table->string('running_time');
        //     $table->string('radiate_time');
        
        //     $table->string('hvps_v_0_4us');
        //     $table->string('hvps_i_0_4us');
        //     $table->string('mag_i_0_4us');
        
        //     $table->string('hvps_v_0_8us');
        //     $table->string('hvps_i_0_8us');
        //     $table->string('mag_i_0_8us');
        
        //     $table->string('hvps_v_1_0us');
        //     $table->string('hvps_i_1_0us');
        //     $table->string('mag_i_1_0us');

        //     $table->string('hvps_v_2_0us');
        //     $table->string('hvps_i_2_0us');
        //     $table->string('mag_i_2_0us');
        
        //     $table->string('forward_power');
        //     $table->string('reverse_power');
        //     $table->string('vswr');
        //     //END OF NOT NULLABLE REMARK
        
        //     $table->string('receiver_visual')->nullable();
        //     $table->string('stalo_check')->nullable();
        //     $table->string('afc_check')->nullable();
        //     $table->string('mrp_check')->nullable();
        //     $table->string('rcu_check')->nullable();
        //     $table->string('iq2_check')->nullable();
        
        //     $table->string('antenna_visual')->nullable();
        //     $table->string('inspect_motor')->nullable();
        //     $table->string('clean_slip')->nullable();
        //     $table->string('grease_gear')->nullable();
        
        //     $table->longText('remark');
        
        //     // laravel timestramp
        //     $table->timestamps();
        // });
        // ===== bawaan dr letoy =====
        
        // ===== hasil rancangan erd =====
        Schema::create('pm_body_reports', function (Blueprint $table) {
            $table->bigIncrements('pm_id');
            $table->foreignId('head_id'); // id of the head of current report. ex: if the id is 5 it means this report has the head reports of 5
        
            /* 
            *   RADIO
            *   boolean or TINYINT(1)
            *   in html form input use value 1 for PASS
            *   and 0 for FAIL
            */
            $table->boolean('radio_general_visual');
            $table->boolean('radio_rcms');
            $table->boolean('radio_wipe_down');
            $table->boolean('radio_inspect_all');
        
            $table->boolean('radio_compressor_visual');
            $table->boolean('radio_duty_cycle');
        
            $table->boolean('radio_transmitter_visual');
        
            // NULLABLE RADIO
            // because that what the example report say
            $table->boolean('radio_running_time')->nullable();
            $table->boolean('radio_radiate_time')->nullable();
            $table->boolean('radio_0_4us')->nullable();
            $table->boolean('radio_0_8us')->nullable();
            $table->boolean('radio_1_0us')->nullable();
            $table->boolean('radio_2_0us')->nullable();
            $table->boolean('radio_forward_power')->nullable();
            $table->boolean('radio_reverse_power')->nullable();
            $table->boolean('radio_vswr')->nullable();
            //END OF NULLABLE RADIO VALUE

            $table->boolean('radio_receiver_visual');
            $table->boolean('radio_stalo_check');
            $table->boolean('radio_afc_check');
            $table->boolean('radio_mrp_check');
            $table->boolean('radio_rcu_check');
            $table->boolean('radio_iq2_check');
        
            $table->boolean('radio_antenna_visual');
            $table->boolean('radio_inspect_motor');
            $table->boolean('radio_clean_slip');
            $table->boolean('radio_grease_gear');
        
            // REMARK
            $table->string('general_visual')->nullable();
            $table->string('rcms')->nullable();
            $table->string('wipe_down')->nullable();
            $table->string('inspect_all')->nullable();
        
            $table->string('compressor_visual')->nullable();
            $table->string('duty_cycle')->nullable();
        
            $table->string('transmitter_visual')->nullable();

            //NOT NULLABLE REMARK
            $table->string('running_time');
            $table->string('radiate_time');
        
            $table->string('hvps_v_0_4us');
            $table->string('hvps_i_0_4us');
            $table->string('mag_i_0_4us');
        
            $table->string('hvps_v_0_8us');
            $table->string('hvps_i_0_8us');
            $table->string('mag_i_0_8us');
        
            $table->string('hvps_v_1_0us');
            $table->string('hvps_i_1_0us');
            $table->string('mag_i_1_0us');

            $table->string('hvps_v_2_0us');
            $table->string('hvps_i_2_0us');
            $table->string('mag_i_2_0us');
        
            $table->string('forward_power');
            $table->string('reverse_power');
            $table->string('vswr');
            //END OF NOT NULLABLE REMARK
        
            $table->string('receiver_visual')->nullable();
            $table->string('stalo_check')->nullable();
            $table->string('afc_check')->nullable();
            $table->string('mrp_check')->nullable();
            $table->string('rcu_check')->nullable();
            $table->string('iq2_check')->nullable();
        
            $table->string('antenna_visual')->nullable();
            $table->string('inspect_motor')->nullable();
            $table->string('clean_slip')->nullable();
            $table->string('grease_gear')->nullable();
        
            $table->longText('remark');
        
            // laravel timestramp
            $table->timestamps();
        });

        // ===== hasil rancangan erd =====
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pm_body_reports');
    }
}
