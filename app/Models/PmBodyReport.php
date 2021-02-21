<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmBodyReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'head_id',
        'radio_general_visual',
        'radio_rcms',
        'radio_wipe_down',
        'radio_inspect_all',
        'radio_compressor_visual',
        'radio_duty_cycle',
        'radio_transmitter_visual',
        'radio_running_time',
        'radio_radiate_time',
        'radio_0_4us',
        'radio_0_8us',
        'radio_1_0us',
        'radio_2_0us',
        'radio_forward_power',
        'radio_reverse_power',
        'radio_vswr',
        'radio_receiver_visual',
        'radio_stalo_check',
        'radio_afc_check',
        'radio_mrp_check',
        'radio_rcu_check',
        'radio_iq2_check',
        'radio_antenna_visual',
        'radio_inspect_motor',
        'radio_clean_slip',
        'radio_grease_gear',
        'general_visual',
        'rcms',
        'wipe_down',
        'inspect_all',
        'compressor_visual',
        'duty_cycle',
        'transmitter_visual',
        'running_time',
        'radiate_time',
        'hvps_v_0_4us',
        'hvps_i_0_4us',
        'mag_i_0_4us',
        'hvps_v_0_8us',
        'hvps_i_0_8us',
        'mag_i_0_8us',
        'hvps_v_1_0us',
        'hvps_i_1_0us',
        'mag_i_1_0us',
        'hvps_v_2_0us',
        'hvps_i_2_0us',
        'mag_i_2_0us',
        'forward_power',
        'reverse_power',
        'vswr',
        'receiver_visual',
        'stalo_check',
        'afc_check',
        'mrp_check',
        'rcu_check',
        'iq2_check',
        'antenna_visual',
        'inspect_motor',
        'clean_slip',
        'grease_gear',
        'remark',
    ];

    //ONE TO ONE INVERS
    public function headReport()
    {
        return $this->belongsTo(HeadReport::class, 'head_id');
    }
}
