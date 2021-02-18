<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Expert;
use App\Models\Site;

class PmReport extends Component
{
    public $currentStep = 1;

    //head forms
    public $radar, $site_id, $report_date_start, $report_date_end;
    //pm body forms
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
    
    private $headRules = ([
        'radar_name' => 'required',
        'station_id' => 'required',
        'report_date_start' => 'required',
        'report_date_end' => 'required',
    ]);
    private $pmRules = ([
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
        'running_time' => 'required',
        'radiate_time' => 'required',
        'hvps_v_0_4us' => 'required',
        'hvps_i_0_4us' => 'required',
        'mag_i_0_4us' => 'required',
        'hvps_v_0_8us' => 'required',
        'hvps_i_0_8us' => 'required',
        'mag_i_0_8us' => 'required',
        'hvps_v_1_0us' => 'required',
        'hvps_i_1_0us' => 'required',
        'mag_i_1_0us' => 'required',
        'hvps_v_2_0us' => 'required',
        'hvps_i_2_0us' => 'required',
        'mag_i_2_0us' => 'required',
        'forward_power' => 'required',
        'reverse_power' => 'required',
        'vswr' => 'required',
    ]);

    private $remarkRules = ([
        'remark' => 'required',
    ]);

    public function mount()
    {
    }

    /*
     *  FORM STEP METHOD
     */
    public function nextStep()
    {
        switch ($this->currentStep) {
            case 1:
                // $this->validate($this->headRules);
                break;

            case 2:
                // $this->validate($this->pmRules);
                break;
                
            case 3:
                // dd($this->remark);
                // $this->validate($this->remarkRules);
                break;

            case 4:
                // $this->validate($this->remarkRules);
                break;
            
            default:
                # code...
                break;
        }
        $this->currentStep++;
    }

    public function secondStepSubmit()
    {
        // $validatedData = $this->validate([
        //     'stock' => 'required',
        //     'status' => 'required',
        // ]);
        $this->currentStep = 3;
    }

    public function submitForm()
    {
        // Product::create([
        //     'name' => $this->name,
        //     'amount' => $this->amount,
        //     'description' => $this->description,
        //     'stock' => $this->stock,
        //     'status' => $this->status,
        // ]);
        $this->successMessage = 'Product Created Successfully.';
        $this->clearForm();
        $this->currentStep = 1;
    }

    public function back()
    {
        $this->currentStep--;
    }

    public function clearForm()
    {
        // $this->name = '';
        // $this->amount = '';
        // $this->description = '';
        // $this->stock = '';
        // $this->status = 1;
    }

    public function render()
    {
        // return view('livewire.pm-report');

        if(!empty($this->site_id)) {
            $this->radar = Site::where('site_id', $this->site_id)->first();
        }
        return view('livewire.pm-report')
            ->withStations(Site::get());
    }
}
