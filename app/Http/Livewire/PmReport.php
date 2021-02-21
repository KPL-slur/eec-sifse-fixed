<?php

namespace App\Http\Livewire;


use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\HeadReport;
use App\Models\Expert;
use App\Models\Site;

use App\Models\Recommendation;
use App\Models\Stock;

use App\Models\ReportImage;

class PmReport extends Component
{
    public $currentStep = 1;

    public $headId;

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

    // expert form
    public $experts = [];
    public $manualExperts = [];
    public $expertsData;
    public $uniqueCompanies;
    public $selectedExpert = []; //queriedvalue

    // recomendation form
    public $stocks = [];
    public $recommends = [];
    public $manualRecommends = [];

    // report image form
    public $caption;
    public $image=[];
    public $attachments = [];

    use WithFileUploads;

    //validation
    private $headRules = ([
        'site_id' => 'required',
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

    //METHODD
    //  Livewire lifecycle hook
    public function mount()
    {
        $this->headId = HeadReport::select('head_id')->orderByDesc('head_id')->first()->head_id + 1;

        //expert mount
        $this->experts = [
            ['expert_id' => '', 'expert_company' => '', 'expert_nip' => '']
        ];
        $this->expertsData = Expert::all();
        $this->uniqueCompanies = $this->expertsData->unique('expert_company');

        //recomendation mount
        $this->stocks = Stock::all();
        $this->recommends = [
            ['stock_id' => '', 'jumlah_unit_needed' => 1]
        ];

        // images mount
        $this->attachments = [
            ['caption' => '', 'image' => '', 'uploaded' => 0]
        ];
    }

    // EXXPERT METHOD
    public function addExpert()
    {
        $this->experts[] = ['expert_id' => '', 'expert_company' => '', 'expert_nip' => ''];
    }
    
    public function removeExpert($index)
    {
        unset($this->experts[$index]);
        array_values($this->experts);
    }

    public function addManualExpert ()
    {
        $this->manualExperts[] = ['expert_name' => '', 'expert_company' => '', 'expert_nip' => ''];
    }

    public function removeManualExpert($index)
    {
        unset($this->manualExperts[$index]);
        array_values($this->manualExperts);
    }

    public function setCompanyAndNip($index){
        // dd($this->experts[$index]['expert_id']);
        if(!empty($this->experts[$index]['expert_id'])){
            $this->selectedExpert[$index] = Expert::where('expert_id', $this->experts[$index]['expert_id'])->first();
            // dd($this->selectedExpert);
        }
    }

    // RECOMENDATION FORMS
    public function addRecommend()
    {
        $this->recommends[] = ['stock_id' => '', 'jumlah_unit_needed' => 1];
    }
    
    public function removeRecommend($index)
    {
        unset($this->recommends[$index]);
        array_values($this->recommends);
    }

    public function addManualRecommends ()
    {
        $this->manualRecommends[] = ['nama_barang' => '', 'jumlah_unit_needed' => 1];
    }

    public function removeManualRecommends($index)
    {
        unset($this->manualRecommends[$index]);
        array_values($this->manualRecommends);
    }

    // ATTACHMENT
    public function addAttachment()
    {
        $this->attachments[] = ['caption' => '', 'image' => '', 'uploaded' => 0];
    }
    
    public function removeAttachment($index)
    {
        if ($this->attachments[$index]['uploaded'] === 1) {
            \Storage::delete('public/'.$this->image[$index]);
            ReportImage::where('image', $this->image[$index])->delete();
            $this->attachments[$index]['uploaded'] = 0;
        }

        unset($this->attachments[$index]);
        array_values($this->attachments);
    }

    public function fileUpload($index)
    {
        // dd($this->attachments);
        $this->validate([
            'attachments.'.$index.'.caption' => 'required',
            'attachments.'.$index.'.image' => 'required'
        ]);

        $this->image[$index] = $this->attachments[$index]['image']->store('files', 'public');
        // dd($image);
        // $validatedData['attachments.'.$index.'.image'] = $image;
        
        ReportImage::create([
            'head_id' => $this->headId,
            'image' => $this->image[$index],
            'caption' => $this->attachments[$index]['caption']
        ]);

        $this->attachments[$index]['uploaded'] = 1;

        session()->flash('message', 'File Uploaded');
        $this->emit('fileUploaded');
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

    public function back()
    {
        $this->currentStep--;
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
