<?php

namespace App\Http\Livewire\Traits;

use App\Models\Site;
use App\Models\Expert;

/**
 * 
 */
trait WithHeadReport
{
    public $sites; // list of all site id
    public $experts = []; // user inputs
    public $expertsData; // list of all experts
    public $manualExperts = []; //user inputs

    // variabel untuk edit dynamic expert form
    public $countExpertReportId; // variabel menampung panjang array expertReportId
    public $expertReportId = []; // array meanmpung export_report_id yg sudah di extract dari model

    public $radar, $site_id, $report_date_start, $report_date_end; //user inputs

    public function mountWithHeadReport()
    {
        $this->sites = Site::all();
        //expert mount
        $this->experts = [
            ['expert_id' => '', 'expert_company' => '', 'expert_nip' => '', 'expert_role' => '']
        ];

        $this->expertsData = Expert::all(); 
        $this->uniqueCompanies = $this->expertsData->unique('expert_company');
    }

    /**
     * 
     */
    public function updatedWithHeadReport()
    {
            $this->radar = $this->sites->where('site_id', $this->site_id)->first()->radar_name;
    }

    // EXXPERT METHOD
    public function addExpert()
    {
        $this->experts[] = ['expert_id' => '', 'expert_company' => '', 'expert_nip' => '', 'expert_role' => ''];
    }
    
    public function removeExpert($index)
    {
        // if (in_array($index , $this->experts)) {
        //     $this->expertsData->where('expert_report_id', $this->expertReportId[$index])->delete();
        // }
        unset($this->experts[$index]);
        array_values($this->experts);

        //decrement the count, if not the data will be dupe
        $this->countExpertReportId--;
    }

    public function addManualExpert ()
    {
        $this->manualExperts[] = ['expert_name' => '', 'expert_company' => '', 'expert_nip' => '', 'expert_role' => ''];
    }

    public function removeManualExpert($index)
    {
        unset($this->manualExperts[$index]);
        array_values($this->manualExperts);
    }

    public function setCompanyAndNip($index){
        if(!empty($this->experts[$index]['expert_id'])){
            $selectedExpert[$index] = $this->expertsData->where('expert_id', $this->experts[$index]['expert_id'])->first();
            $this->experts[$index]['expert_company'] = $selectedExpert[$index]->expert_company;
            $this->experts[$index]['expert_nip'] = $selectedExpert[$index]->nip;
        }
    }
}
