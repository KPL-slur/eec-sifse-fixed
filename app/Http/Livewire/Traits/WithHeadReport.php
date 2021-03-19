<?php

namespace App\Http\Livewire\Traits;

use App\Models\Site;
use App\Models\HeadReport;
use App\Models\Expert;
use App\Models\ExpertReport;

/**
 * 
 */
trait WithHeadReport
{
    //* user inputs
    public $radar, $site_id, $report_date_start, $report_date_end; //user inputs
    public $experts = []; // user inputs
    public $manualExperts = []; //user inputs

    //* list of
    public $sites; // list of all site id
    public $expertsData; // list of all experts

    //* variabel untuk edit dynamic expert form
    public $expertReportId = []; // array meanmpung export_report_id yg sudah di extract dari model

    //* validation rules
    protected $headRules = [
        'site_id' => 'required',
        'report_date_start' => 'required',
        'report_date_end' => 'required|after_or_equal:report_date_start',
    ];

    //* LIVEWIRE METHOD
    /**
     * run after class mount method.
     * init dropdown menu items.
     * if $id exist, then it must be an edit form.
     * init data if edit, init from class variable.
     * or else init expert arr key with empty value.
     * 
     * @param $id OPTIONAL head_id of the current record
     */
    public function mountWithHeadReport($id=null)
    {
        $this->sites = Site::all();
        $this->expertsData = Expert::all(); 
        $this->uniqueCompanies = $this->expertsData->unique('expert_company');

        if ($id) {
            //INITIALIZE EDIT DATA HEAD REPORT
            $this->site_id = $this->headReport->site_id;
            $this->radar = $this->sites->where('site_id', $this->site_id)->first()->radar_name;
            $this->report_date_start = $this->headReport->report_date_start;
            $this->report_date_end = $this->headReport->report_date_end;
        
            //INITIALIZE EDIT DATA EXPERT REPORT
            foreach ($this->expertReports as $expertReport) {
                $this->experts[] = ['expert_id' => $expertReport->pivot->expert_id, 'expert_company' => $expertReport->expert_company, 'expert_nip' => $expertReport->nip, 'expert_role' => $expertReport->pivot->role];
            }
            /**
             *  Bagian ini mengextrak model kedalam array
             */
            foreach($this->expertReports as $index => $erId){
                $this->expertReportId[$index] = $erId->pivot->expert_report_id;
            }
        } else {
            //expert mount
            $this->experts = [
                ['expert_id' => '', 'expert_company' => '', 'expert_nip' => '', 'expert_role' => '']
            ];
        }
    }

    /**
     * run if any var in this traits get updated
     */
    public function updatedWithHeadReport()
    {
        if ($this->site_id) {
            $this->radar = $this->sites->where('site_id', $this->site_id)->first()->radar_name;
        } else {
            $this->radar = null;
        }

        if ($this->report_date_end) {
            $this->validate(['report_date_end' => 'required|after_or_equal:report_date_start']);
        }
    }

    /**
     * 
     */
    protected function rules()
    {
        return $this->headRules;
    }

    //* EXXPERT METHOD
    /**
     * 
     */
    public function addExpert()
    {
        $this->experts[] = ['expert_id' => '', 'expert_company' => '', 'expert_nip' => '', 'expert_role' => ''];
    }
    
    /**
     * remove record from db if record already saved
     * and remove it from livewire arr model too.
     */
    public function removeExpert($index)
    {
        if (in_array($index , $this->experts)) {
            $this->expertsData->where('expert_report_id', $this->expertReportId[$index])->delete();
        }
        unset($this->experts[$index]);
        array_values($this->experts);
    }

    /**
     * 
     */
    public function validateExpert()
    {
        foreach ($this->experts as $index => $expert) {
            $this->validate([
                'experts.'.$index.'.expert_id' => 'required',
                'experts.'.$index.'.expert_role' => 'required',
            ]);
        };
    }

    //* MANUAL EXPERT
    /**
     * 
     */
    public function addManualExpert ()
    {
        $this->manualExperts[] = ['expert_name' => '', 'expert_company' => '', 'expert_nip' => '', 'expert_role' => ''];
    }

    /**
     * only removing it from the arr
     * 
     * @param $index index of the current item
     */
    public function removeManualExpert($index)
    {
        unset($this->manualExperts[$index]);
        array_values($this->manualExperts);
    }

    /**
     * 
     */
    public function validateManualExpert()
    {
        foreach ($this->manualExperts as $index => $manualExpert) {
            $this->validate([
                'manualExperts.'.$index.'.expert_name' => 'required',
                'manualExperts.'.$index.'.expert_company' => 'required',
                'manualExperts.'.$index.'.expert_nip' => 'required',
                'manualExperts.'.$index.'.expert_role' => 'required',
            ]);
        };
    }

    //* GENERAL EXPERT
    /**
     * set the value of company and nip from selected expert record table in db
     * 
     * @param $index index of the current item 
     */
    public function setCompanyAndNip($index)
    {
        if(!empty($this->experts[$index]['expert_id'])){
            $selectedExpert[$index] = $this->expertsData->where('expert_id', $this->experts[$index]['expert_id'])->first();
            $this->experts[$index]['expert_company'] = $selectedExpert[$index]->expert_company;
            $this->experts[$index]['expert_nip'] = $selectedExpert[$index]->nip;
        }
    }

    //* UPSTORE
    /**
     * update or store value in db, and
     * *set the value of head_id to the lastest record if create new record
     * if it only updating then it wont set a new head_id
     * 
     * @param $maintenance_type string (pm|cm)
     */
    public function upstoreHead($maintenance_type)
    {
        $this->validate();
        
        HeadReport::updateOrCreate(
            ['head_id' => $this->head_id],
            [
                'site_id' => $this->site_id,
                'maintenance_type' => $maintenance_type,
                'report_date_start' => $this->report_date_start,
                'report_date_end' => $this->report_date_end,
            ]
        );

        // if create new record, get the lastest head_id
        if ($this->head_id === null) {
            $this->head_id = HeadReport::select('head_id')->latest()->first()->head_id;
        }
    }

    /**
     * if the record id not found in collection, then
     * it will create a new record, else
     * it will only update the necesarry field
     */
    public function upstoreExpert()
    {
        $this->validateExpert();
        foreach ($this->experts as $index => $expert) {
            if (!isset($this->expertReportId[$index])) {
                ExpertReport::create(
                    [
                        'head_id' => $this->head_id,
                        'expert_id' => $expert['expert_id'],
                        'role' => $expert['expert_role']
                    ]
                );
            } else {
                ExpertReport::where('head_id', $this->head_id)
                    ->where('expert_report_id', $this->expertReportId[$index])
                    ->update(
                    [
                        'expert_id' => $expert['expert_id'],
                        'role' => $expert['expert_role']
                    ]
                );
            }
            
        }
    }

    /**
     * Even in edit mode, it will always create a new record,
     * First, it create a new record in EXPERT table, secondly
     * it will get the lastest expert_id for henceforth entered 
     * into the ExpertReport record with the role
     */
    public function upstoreManualExpert()
    {
        $this->validateManualExpert();
        if ($this->manualExperts) {
            foreach ($this->manualExperts as $manualExpert) {
                if ($manualExpert['expert_name']) {
                    Expert::create([
                        'name' => $manualExpert['expert_name'],
                        'nip' => $manualExpert['expert_nip'],
                        'expert_company' => $manualExpert['expert_company'],
                        ]);
                    $expert_id = Expert::select('expert_id')->latest()->first()->expert_id; //used to determine the expert_id of this report
                    ExpertReport::create([
                        'head_id' => $this->head_id,
                        'expert_id' => $expert_id,
                        'role' => $manualExpert['expert_role']
                    ]);
                }
            }
        }
    }
}
