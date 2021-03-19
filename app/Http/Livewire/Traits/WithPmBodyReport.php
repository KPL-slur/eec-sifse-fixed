<?php

namespace App\Http\Livewire\Traits;

use App\Models\PmBodyReport;

/**
 * 
 */
trait WithPmBodyReport
{
    //* user inputs
    public $radio_general_visual, $radio_rcms, $radio_wipe_down, $radio_inspect_all, $radio_compressor_visual, $radio_duty_cycle;
    public $radio_transmitter_visual, $radio_receiver_visual, $radio_stalo_check, $radio_afc_check, $radio_mrp_check, $radio_rcu_check, $radio_iq2_check;
    public $radio_antenna_visual, $radio_inspect_motor, $radio_clean_slip, $radio_grease_gear;

    public $radio_running_time, $radio_radiate_time, $radio_0_4us, $radio_0_8us, $radio_1_0us, $radio_2_0us;
    public $radio_reverse_power, $radio_forward_power, $radio_vswr;

    public $running_time, $radiate_time, $forward_power, $reverse_power, $vswr;
    public $hvps_v_0_4us, $hvps_i_0_4us, $mag_i_0_4us, $hvps_v_0_8us, $hvps_i_0_8us, $mag_i_0_8us;
    public $hvps_v_1_0us, $hvps_i_1_0us, $mag_i_1_0us, $hvps_v_2_0us, $hvps_i_2_0us, $mag_i_2_0us;

    public $general_visual, $rcms, $wipe_down, $inspect_all, $compressor_visual, $duty_cycle;
    public $transmitter_visual, $receiver_visual, $stalo_check, $afc_check, $mrp_check, $rcu_check, $iq2_check;
    public $antenna_visual, $inspect_motor, $clean_slip, $grease_gear;

    public $remark;

    //* validation rules
    protected $pmBodyReportRules = [
        'radio_general_visual' => 'required',
        'radio_rcms' => 'required',
        'radio_wipe_down' => 'required',
        'radio_inspect_all' => 'required',
        'radio_compressor_visual' => 'required',
        'radio_duty_cycle' => 'required',
        'radio_transmitter_visual' => 'required',
        'radio_receiver_visual' => 'required',
        'radio_stalo_check' => 'required',
        'radio_afc_check' => 'required',
        'radio_mrp_check' => 'required',
        'radio_rcu_check' => 'required',
        'radio_iq2_check' => 'required',
        'radio_antenna_visual' => 'required',
        'radio_inspect_motor' => 'required',
        'radio_clean_slip' => 'required',
        'radio_grease_gear' => 'required',
        'running_time' => ['required', 'numberOrNa'],
        'radiate_time' => ['required', 'numberOrNa'],
        'hvps_v_0_4us' => ['required', 'numberOrNa'],
        'hvps_i_0_4us' => ['required', 'numberOrNa'],
        'mag_i_0_4us' => ['required', 'numberOrNa'],
        'hvps_v_0_8us' => ['required', 'numberOrNa'],
        'hvps_i_0_8us' => ['required', 'numberOrNa'],
        'mag_i_0_8us' => ['required', 'numberOrNa'],
        'hvps_v_1_0us' => ['required', 'numberOrNa'],
        'hvps_i_1_0us' => ['required', 'numberOrNa'],
        'mag_i_1_0us' => ['required', 'numberOrNa'],
        'hvps_v_2_0us' => ['required', 'numberOrNa'],
        'hvps_i_2_0us' => ['required', 'numberOrNa'],
        'mag_i_2_0us' => ['required', 'numberOrNa'],
        'forward_power' => ['required', 'numberOrNa'],
        'reverse_power' => ['required', 'numberOrNa'],
        'vswr' => ['required', 'numberOrNa'],
    ];

    //* LIVEWIRE METHOD

    /**
     * run after class mount method.
     * if $id exist, then it must be an edit form.
     * init data if edit, init from class variable.
     * 
     * @param $id OPTIONAL head_id of the current record
     */
    public function mountWithPmBodyReport($id=null)
    {
        if ($id) {
            //* INITALIZE EDIT DATA PM BODY
            $this->radio_general_visual = $this->pmBodyReport->radio_general_visual;
            $this->radio_rcms = $this->pmBodyReport->radio_rcms;
            $this->radio_wipe_down = $this->pmBodyReport->radio_wipe_down;
            $this->radio_inspect_all = $this->pmBodyReport->radio_inspect_all;

            $this->radio_compressor_visual = $this->pmBodyReport->radio_compressor_visual;
            $this->radio_duty_cycle = $this->pmBodyReport->radio_duty_cycle;

            $this->radio_transmitter_visual = $this->pmBodyReport->radio_transmitter_visual;

            $this->radio_receiver_visual = $this->pmBodyReport->radio_receiver_visual;
            $this->radio_stalo_check = $this->pmBodyReport->radio_stalo_check;
            $this->radio_afc_check = $this->pmBodyReport->radio_afc_check;
            $this->radio_mrp_check = $this->pmBodyReport->radio_mrp_check;
            $this->radio_rcu_check = $this->pmBodyReport->radio_rcu_check;
            $this->radio_iq2_check = $this->pmBodyReport->radio_iq2_check;

            $this->radio_antenna_visual = $this->pmBodyReport->radio_antenna_visual;
            $this->radio_inspect_motor = $this->pmBodyReport->radio_inspect_motor;
            $this->radio_clean_slip = $this->pmBodyReport->radio_clean_slip;
            $this->radio_grease_gear = $this->pmBodyReport->radio_grease_gear;

            $this->radio_running_time = $this->pmBodyReport->radio_running_time;
            $this->radio_radiate_time = $this->pmBodyReport->radio_radiate_time;
            $this->radio_0_4us = $this->pmBodyReport->radio_0_4us;
            $this->radio_0_8us = $this->pmBodyReport->radio_0_8us;
            $this->radio_1_0us = $this->pmBodyReport->radio_1_0us;
            $this->radio_2_0us = $this->pmBodyReport->radio_2_0us;
            $this->radio_reverse_power = $this->pmBodyReport->radio_reverse_power;
            $this->radio_forward_power = $this->pmBodyReport->radio_forward_power;
            $this->radio_vswr = $this->pmBodyReport->radio_vswr;

            $this->running_time = $this->pmBodyReport->running_time;
            $this->radiate_time = $this->pmBodyReport->radiate_time;
            $this->forward_power = $this->pmBodyReport->forward_power;
            $this->reverse_power = $this->pmBodyReport->reverse_power;
            $this->vswr = $this->pmBodyReport->vswr;

            $this->hvps_v_0_4us = $this->pmBodyReport->hvps_v_0_4us;
            $this->hvps_i_0_4us = $this->pmBodyReport->hvps_i_0_4us;
            $this->mag_i_0_4us = $this->pmBodyReport->mag_i_0_4us;

            $this->hvps_v_0_8us = $this->pmBodyReport->hvps_v_0_8us;
            $this->hvps_i_0_8us = $this->pmBodyReport->hvps_i_0_8us;
            $this->mag_i_0_8us = $this->pmBodyReport->mag_i_0_8us;

            $this->hvps_v_1_0us = $this->pmBodyReport->hvps_v_1_0us;
            $this->hvps_i_1_0us = $this->pmBodyReport->hvps_i_1_0us;
            $this->mag_i_1_0us = $this->pmBodyReport->mag_i_1_0us;

            $this->hvps_v_2_0us = $this->pmBodyReport->hvps_v_2_0us;
            $this->hvps_i_2_0us = $this->pmBodyReport->hvps_i_2_0us;
            $this->mag_i_2_0us = $this->pmBodyReport->mag_i_2_0us;

            $this->general_visual = $this->pmBodyReport->general_visual;
            $this->rcms = $this->pmBodyReport->rcms;
            $this->wipe_down = $this->pmBodyReport->wipe_down;
            $this->inspect_all = $this->pmBodyReport->inspect_all;

            $this->compressor_visual = $this->pmBodyReport->compressor_visual;
            $this->duty_cycle = $this->pmBodyReport->duty_cycle;

            $this->transmitter_visual = $this->pmBodyReport->transmitter_visual;

            $this->receiver_visual = $this->pmBodyReport->receiver_visual;
            $this->stalo_check = $this->pmBodyReport->stalo_check;
            $this->afc_check = $this->pmBodyReport->afc_check;
            $this->mrp_check = $this->pmBodyReport->mrp_check;
            $this->rcu_check = $this->pmBodyReport->rcu_check;
            $this->iq2_check = $this->pmBodyReport->iq2_check;

            $this->antenna_visual = $this->pmBodyReport->antenna_visual;
            $this->inspect_motor = $this->pmBodyReport->inspect_motor;
            $this->clean_slip = $this->pmBodyReport->clean_slip;
            $this->grease_gear = $this->pmBodyReport->grease_gear;

            $this->remark = $this->pmBodyReport->remark;
        }
    }

    //* UPSTORE
    /**
     * update or store value in db
     */
    public function upstorePmBodyReport()
    {
        $this->validate($this->pmBodyReportRules);

        PmBodyReport::updateOrCreate(
            ['head_id' => $this->head_id],
            [
                'radio_general_visual' => $this->radio_general_visual,
                'radio_rcms' => $this->radio_rcms,
                'radio_wipe_down' => $this->radio_wipe_down,
                'radio_inspect_all' => $this->radio_inspect_all,

                'radio_compressor_visual' => $this->radio_compressor_visual,
                'radio_duty_cycle' => $this->radio_duty_cycle,

                'radio_transmitter_visual' => $this->radio_transmitter_visual,

                'radio_receiver_visual' => $this->radio_receiver_visual,
                'radio_stalo_check' => $this->radio_stalo_check,
                'radio_afc_check' => $this->radio_afc_check,
                'radio_mrp_check' => $this->radio_mrp_check,
                'radio_rcu_check' => $this->radio_rcu_check,
                'radio_iq2_check' => $this->radio_iq2_check,

                'radio_antenna_visual' => $this->radio_antenna_visual,
                'radio_inspect_motor' => $this->radio_inspect_motor,
                'radio_clean_slip' => $this->radio_clean_slip,
                'radio_grease_gear' => $this->radio_grease_gear,

                'radio_running_time' => $this->radio_running_time,
                'radio_radiate_time' => $this->radio_radiate_time,
                'radio_0_4us' => $this->radio_0_4us,
                'radio_0_8us' => $this->radio_0_8us,
                'radio_1_0us' => $this->radio_1_0us,
                'radio_2_0us' => $this->radio_2_0us,
                'radio_reverse_power' => $this->radio_reverse_power,
                'radio_forward_power' => $this->radio_forward_power,
                'radio_vswr' => $this->radio_vswr,

                'running_time' => $this->running_time,
                'radiate_time' => $this->radiate_time,
                'forward_power' => $this->forward_power,
                'reverse_power' => $this->reverse_power,
                'vswr' => $this->vswr,

                'hvps_v_0_4us' => $this->hvps_v_0_4us,
                'hvps_i_0_4us' => $this->hvps_i_0_4us,
                'mag_i_0_4us' => $this->mag_i_0_4us,

                'hvps_v_0_8us' => $this->hvps_v_0_8us,
                'hvps_i_0_8us' => $this->hvps_i_0_8us,
                'mag_i_0_8us' => $this->mag_i_0_8us,

                'hvps_v_1_0us' => $this->hvps_v_1_0us,
                'hvps_i_1_0us' => $this->hvps_i_1_0us,
                'mag_i_1_0us' => $this->mag_i_1_0us,

                'hvps_v_2_0us' => $this->hvps_v_2_0us,
                'hvps_i_2_0us' => $this->hvps_i_2_0us,
                'mag_i_2_0us' => $this->mag_i_2_0us,

                'general_visual' => $this->general_visual,
                'rcms' => $this->rcms,
                'wipe_down' => $this->wipe_down,
                'inspect_all' => $this->inspect_all,

                'compressor_visual' => $this->compressor_visual,
                'duty_cycle' => $this->duty_cycle,

                'transmitter_visual' => $this->transmitter_visual,

                'receiver_visual' => $this->receiver_visual,
                'stalo_check' => $this->stalo_check,
                'afc_check' => $this->afc_check,
                'mrp_check' => $this->mrp_check,
                'rcu_check' => $this->rcu_check,
                'iq2_check' => $this->iq2_check,

                'antenna_visual' => $this->antenna_visual,
                'inspect_motor' => $this->inspect_motor,
                'clean_slip' => $this->clean_slip,
                'grease_gear' => $this->grease_gear,

                'remark' => $this->remark,
            ]
        );
    }
}
