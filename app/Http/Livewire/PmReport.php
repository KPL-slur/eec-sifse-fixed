<?php

namespace App\Http\Livewire;


use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\HeadReport;
use App\Models\Expert;
use App\Models\ExpertReport;
use App\Models\Site;

use App\Models\Recommendation;
use App\Models\Stock;

use App\Models\ReportImage;

use App\Rules\NumberOrNa;

class PmReport extends Component
{
    public $currentStep = 1;
    public $modalType;

    public $edit;

    // Variabel untuk menampung model
    public $headReport, $pmBodyReport, $recommendations, $reportImages;

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

    // variabel untuk edit dynamic expert form
    public $countExpertReportId; // variabel menampung panjang array expertReportId
    public $expertReportId = []; // array meanmpung export_report_id yg sudah di extract dari model

    // recomendation form
    public $stocks = [];
    public $recommends = [];
    public $manualRecommends = [];
    // recomendation form edit
    private $siteRecommendations = [];

    // variabel untuk edit dynamic recomend form
    public $countRecommendationId; // variabel menampung panjang array expertReportId
    public $recommendationId = []; // array meanmpung export_report_id yg sudah di extract dari model

    // report image form
    public $caption;
    public $image=[];
    public $attachments = [];

    //  MODAL DELETE
    public $selectedItem;
    public $selectedForm;

    use WithFileUploads;

    //METHODD
    //  Livewire lifecycle hook
    public function updatedSiteId($value)
    {
        // Clear Array
        unset($this->siteRecommendations);
        unset($this->recommends);
        unset($this->recommendationId);
        // Init Array
        $this->siteRecommendations = [];
        $this->recommends = [];
        $this->recommendationId = [];

        $this->recommendations = HeadReport::Where('site_id', $value)->get();
        foreach ($this->recommendations as $rcm){ //headreport
            foreach ($rcm->recommendations as $rcmItem){ //stocks with pivot recommendation
                $this->siteRecommendations[] = $rcmItem;
            }
        }

        foreach ($this->siteRecommendations as $recommendation) {
            $this->recommends[] = [
                'stock_id' => $recommendation->pivot->stock_id, 
                'group' => $recommendation->group,
                'jumlah_unit_needed' => $recommendation->pivot->jumlah_unit_needed];
        }

        /*
        *  Bagian ini mengextrak model kedalam array dan 
        *  menghitung jumlah record recomendation sebelumnya
        */
        foreach($this->siteRecommendations as $index => $recommendation){
            $this->recommendationId[$index] = $recommendation->pivot->rec_id;
        }
        $this->countRecommendationId = count($this->recommendationId);
    }

    public function mount($id = null)
    {
        if ($id) {
            //INITIALIZE EDIT DATA
            $this->headReport = HeadReport::Where('head_id', $id)->first();
            abort_unless($this->headReport, 404, 'Report not found');

            $this->expertReports = HeadReport::Where('head_id', $id)->first()->experts;
            $this->pmBodyReport = HeadReport::Where('head_id', $id)->first()->pmBodyReport;
            abort_unless($this->pmBodyReport, 404, 'Report not found');
            // $this->recommendations = HeadReport::Where('head_id', $id)->first()->recommendations;
            $this->recommendations = HeadReport::Where('site_id', $this->headReport->site_id)->get();
            foreach ($this->recommendations as $rcm){ //headreport
                foreach ($rcm->recommendations as $rcmItem){ //stocks with pivot recommendation
                    $this->siteRecommendations[] = $rcmItem;
                }
            }
            $this->reportImages = HeadReport::Where('head_id', $id)->first()->reportImages;

            $this->headId = $this->headReport->head_id;
            $this->edit = 1;
            //INITIALIZE EDIT DATA HEAD REPORT
            $this->site_id = $this->headReport->site_id;
            $this->radar = Site::where('site_id', $this->site_id)->first()->radar_name;
            $this->report_date_start = $this->headReport->report_date_start;
            $this->report_date_end = $this->headReport->report_date_end;
        
            //INITIALIZE EDIT DATA EXPERT REPORT
            foreach ($this->expertReports as $expertReport) {
                $this->experts[] = ['expert_id' => $expertReport->pivot->expert_id, 'expert_company' => $expertReport->expert_company, 'expert_nip' => $expertReport->nip];
            }

            //INITALIZE EDIT DATA PM BODY
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

            // INTISIALISASI REKOMENDASI EDIT 
            foreach ($this->siteRecommendations as $recommendation) {
                $this->recommends[] = [
                    'stock_id' => $recommendation->pivot->stock_id, 
                    'group' => $recommendation->group,
                    'jumlah_unit_needed' => $recommendation->pivot->jumlah_unit_needed
                ];
            }

            foreach ($this->reportImages as $reportImage) {
                $this->attachments[] = ['image' => $reportImage->image, 'caption' => $reportImage->caption, 'uploaded' => 1];
            }

            /*
             *  Bagian ini mengextrak model kedalam array dan 
             *  menghitung jumlah record expert_report sebelumnya
             */
            foreach($this->expertReports as $index => $erId){
                $this->expertReportId[$index] = $erId->pivot->expert_report_id;
            }
            $this->countExpertReportId = count($this->expertReportId);

            /*
             *  Bagian ini mengextrak model kedalam array dan 
             *  menghitung jumlah record recomendation sebelumnya
             */
            foreach($this->siteRecommendations as $index => $recommendation){
                $this->recommendationId[$index] = $recommendation->pivot->rec_id;
            }
            $this->countRecommendationId = count($this->recommendationId);

            // dd($this->attachments);
        } else {
            
            $this->headId = HeadReport::select('head_id')->orderByDesc('head_id')->first()->head_id + 1;

            //expert mount
            $this->experts = [
                ['expert_id' => '', 'expert_company' => '', 'expert_nip' => '']
            ];
            
            //recomendation mount
            // $this->recommends = [
            //     ['stock_id' => '', 'jumlah_unit_needed' => 1]
            // ];

            // images mount
            $this->attachments = [
                ['caption' => '', 'image' => '', 'uploaded' => 0]
            ];
        }

        $this->stocks = Stock::all();
        $this->expertsData = Expert::all();
        $this->uniqueCompanies = $this->expertsData->unique('expert_company');
    }

    // RADAR AND SITE
    public function setRadarName()
    {
        if(!empty($this->site_id)) {
            $this->radar = Site::where('site_id', $this->site_id)->first()->radar_name;
        }
    }

    // EXXPERT METHOD
    public function addExpert()
    {
        $this->experts[] = ['expert_id' => '', 'expert_company' => '', 'expert_nip' => ''];
    }
    
    public function removeExpert($index)
    {
        if (in_array($index , $this->experts)) {
            ExpertReport::where('expert_report_id', $this->expertReportId[$index])->delete();
        }
        unset($this->experts[$index]);
        array_values($this->experts);

        //decrement the count, if not the data will be dupe
        $this->countExpertReportId--;
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
        if(!empty($this->experts[$index]['expert_id'])){
            $this->selectedExpert[$index] = Expert::where('expert_id', $this->experts[$index]['expert_id'])->first();
            $this->experts[$index]['expert_company'] = $this->selectedExpert[$index]->expert_company;
            $this->experts[$index]['expert_nip'] = $this->selectedExpert[$index]->nip;
        }
    }

    // RECOMENDATION FORMS
    public function addRecommend()
    {
        $this->recommends[] = ['stock_id' => '','group' => '', 'jumlah_unit_needed' => 1];
    }
    
    public function removeRecommend($index)
    {
        if (array_key_exists($index, $this->recommendationId)) {
            Recommendation::where('rec_id', $this->recommendationId[$index])->delete();
        }
        
        unset($this->recommends[$index]);
        array_values($this->recommends);

        //decrement the count, if not the data will be dupe
        $this->countRecommendationId--;
    }

    public function addManualRecommends ()
    {
        $this->manualRecommends[] = ['nama_barang' => '','group' => '', 'jumlah_unit_needed' => 1];
    }

    public function removeManualRecommends($index)
    {
        unset($this->manualRecommends[$index]);
        array_values($this->manualRecommends);
    }

    public function setStockGroup($index)
    {
        if(!empty($this->recommends[$index]['stock_id'])) {
            $this->recommends[$index]['group'] = Stock::Where('stock_id', $this->recommends[$index]['stock_id'])
                                                    ->first()->group;
        }
    }

    // ATTACHMENT
    public function addAttachment()
    {
        $this->attachments[] = ['caption' => '', 'image' => '', 'uploaded' => 0];
    }
    
    public function removeAttachment($index)
    {
        if ($this->attachments[$index]['uploaded'] === 1) {
            \Storage::delete('public/'.$this->attachments[$index]['image']);
            ReportImage::where('image', $this->attachments[$index]['image'])->delete();
            $this->attachments[$index]['uploaded'] = 0;
        }

        unset($this->attachments[$index]);
        array_values($this->attachments);
    }

    public function validateUploads()
    {
        foreach ($this->attachments as $index => $attachment) {
            if ($this->attachments[$index]['uploaded'] == 0) {
                $this->validate([
                    'attachments.'.$index.'.caption' => 'required',
                    'attachments.'.$index.'.image' => 'required|image'
                ]);
            }
        }
    }

    public function uploadAll()
    {
        foreach ($this->attachments as $index => $attachment) {
            if ($this->attachments[$index]['uploaded'] == 0) {
                $this->fileUpload($index);
            }
        }
    }

    public function fileUpload($index)
    {
        $this->image[$index] = $this->attachments[$index]['image']->storePublicly('files', 'public');\
        
        App\Models\ReportImage::create([
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
                $this->validate(([
                    'site_id' => 'required',
                    'report_date_start' => 'required',
                    'report_date_end' => 'required',
                    'experts.0.expert_id' => 'required',
                ]));
                break;

            case 2:
                $this->validate(([
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
                    'running_time' => ['required', new NumberOrNa],
                    'radiate_time' => ['required', new NumberOrNa],
                    'hvps_v_0_4us' => ['required', new NumberOrNa],
                    'hvps_i_0_4us' => ['required', new NumberOrNa],
                    'mag_i_0_4us' => ['required', new NumberOrNa],
                    'hvps_v_0_8us' => ['required', new NumberOrNa],
                    'hvps_i_0_8us' => ['required', new NumberOrNa],
                    'mag_i_0_8us' => ['required', new NumberOrNa],
                    'hvps_v_1_0us' => ['required', new NumberOrNa],
                    'hvps_i_1_0us' => ['required', new NumberOrNa],
                    'mag_i_1_0us' => ['required', new NumberOrNa],
                    'hvps_v_2_0us' => ['required', new NumberOrNa],
                    'hvps_i_2_0us' => ['required', new NumberOrNa],
                    'mag_i_2_0us' => ['required', new NumberOrNa],
                    'forward_power' => ['required', new NumberOrNa],
                    'reverse_power' => ['required', new NumberOrNa],
                    'vswr' => ['required', new NumberOrNa],
                ]));
                break;
                
            case 3:
                $this->validate(([
                    'remark' => 'required',
                ]));
                break;

            case 5:
                $this->validateUploads();
                $this->modalType = 'submit';
                $this->dispatchBrowserEvent('openModalConfirm');
                break;
            
            default:
                # code...
                break;
        }
        if ($this->currentStep < 5) {
            $this->currentStep++;
        }
    }

    public function back()
    {
        $this->currentStep--;
    }

    public function selectItem($itemId, $formType)
    {
        $this->selectedItem = $itemId;
        $this->selectedForm = $formType;
        $this->modalType = 'delete';
        $this->dispatchBrowserEvent('openModalConfirm');
    }

    public function deleteDynamicForm()
    {
        switch ($this->selectedForm) {
            case 'expert':
                $this->removeExpert($this->selectedItem);
                $this->dispatchBrowserEvent('closeModalConfirm');
                break;

            case 'manualExpert':
                $this->removeManualExpert($this->selectedItem);
                $this->dispatchBrowserEvent('closeModalConfirm');
                break;

            case 'recommendation':
                $this->removeRecommend($this->selectedItem);
                $this->dispatchBrowserEvent('closeModalConfirm');
                break;

            case 'manualRecommendation':
                $this->removeManualRecommends($this->selectedItem);
                $this->dispatchBrowserEvent('closeModalConfirm');
                break;

            case 'attachment':
                $this->removeAttachment($this->selectedItem);
                $this->dispatchBrowserEvent('closeModalConfirm');
                break;
        
            default:
                # code...
                break;
        }
    }

    public function cancel()
    {
        $this->modalType = 'cancel';
        $this->dispatchBrowserEvent('openModalConfirm');
    }

    public function render()
    {
        // return view('livewire.pm-report');
        return view('livewire.pm-report')
            ->withStations(Site::get());
    }
}
/*  This class is to complex, we need to split it up.
 *  Split it into smaller part and send request from there
 *  By doing so we already send the request piece by piece and
 *  not sending a huge request at the end of the form.
 */ 