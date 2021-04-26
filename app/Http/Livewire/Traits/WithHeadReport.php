<?php

namespace App\Http\Livewire\Traits;

use App\Models\Site;
use App\Models\HeadReport;
use App\Models\Expert;
use App\Models\ExpertReport;
use App\Rules\DigitsOr;

/**
 * 
 */
trait WithHeadReport
{
    //* user inputs
    public $radar, $site_id, $kasat_name, $kasat_nip, $report_date_start, $report_date_end; //user inputs
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
        'kasat_name' => 'required',
        'kasat_nip' => 'required|numeric|digits:18',
        'report_date_start' => 'required',
        'report_date_end' => 'required|after_or_equal:report_date_start',
    ];

    protected $kasatErrMessage = [
        'kasat_name.required' => 'The station master name field is required.',
        'kasat_nip.required' => 'The station master nip field is required.',
        'kasat_nip.numeric' => 'The station master nip must be a number.',
        'kasat_nip.digits' => 'The station master nip must be 18 digits.',
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
        $this->sites = Site::OrderBy('station_id', 'asc')->get();
        $this->expertsData = Expert::OrderBy('name', 'asc')->get(); 
        $this->uniqueCompanies = $this->expertsData->unique('expert_company');

        if ($id) {
            //INITIALIZE EDIT DATA HEAD REPORT
            $this->site_id = $this->headReport->site_id;
            $this->radar = $this->sites->where('site_id', $this->site_id)->first()->radar_name;
            $this->kasat_name = $this->headReport->kasat_name;
            $this->kasat_nip = $this->headReport->kasat_nip;
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
            $auth = auth()->user();
            $this->experts = [
                ['expert_id' => $auth->expert_id, 'expert_company' => $auth->expert->expert_company, 'expert_nip' => $auth->expert->nip, 'expert_role' => ''],
            ];
        }
    }

    /**
     * run if site_id get updated
     */
    public function updatedSiteId()
    {
        if ($this->site_id) {
            $this->radar = $this->sites->where('site_id', $this->site_id)->first()->radar_name;
        } else {
            $this->radar = null;
        }
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
        if (array_key_exists($index, $this->experts)) {
            if (in_array($index, $this->experts)) {
                $this->expertsData->where('expert_report_id', $this->expertReportId[$index])->delete();
            }
            unset($this->experts[$index]);
            array_values($this->experts);
            $this->emit('unsetExpert');
        }
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
            ],[
                'required' => 'This field is required.',
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
        if (array_key_exists($index, $this->manualExperts)) {
            unset($this->manualExperts[$index]);
            array_values($this->manualExperts);
            $this->emit('unsetExpert');
        }
    }

    /**
     * 
     */
    public function validateManualExpert()
    {
        foreach ($this->manualExperts as $index => $manualExpert) {
            $this->validate([
                'manualExperts.'.$index.'.expert_name' => ['required','unique:experts,name'],
                'manualExperts.'.$index.'.expert_company' => 'required',
                'manualExperts.'.$index.'.expert_nip' => ['numeric', new DigitsOr(11, 18),'unique:experts,nip'],
                'manualExperts.'.$index.'.expert_role' => 'required',
            ],[
                'required' => 'This field is required.',
                'manualExperts.'.$index.'.expert_name.unique' => 'Name has already been taken.',
                'manualExperts.'.$index.'.expert_nip.unique' => 'Nip has already been taken.',
                'numeric' => 'The input must be a number.',
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
        if (! $this->isDupes($index)) { // check if any of the inputs has same value
            if(!empty($this->experts[$index]['expert_id'])){
                $selectedExpert[$index] = $this->expertsData->where('expert_id', $this->experts[$index]['expert_id'])->first();
                $this->experts[$index]['expert_company'] = $selectedExpert[$index]->expert_company;
                $this->experts[$index]['expert_nip'] = $selectedExpert[$index]->nip;
            }
        } else {
            $this->addError('dupes', 'Cannot add the same expert in one report.');
            $this->experts[$index] = ['expert_id' => '', 'expert_company' => '', 'expert_nip' => '', 'expert_role' => ''];
        }
    }

    /**
     * check the current arr of input if any of the the record has same value
     * search the arr twice, because if only once it always return true.
     * this is happen because it found the current as the same value.
     * 
     * @param $index index of the current item 
     * @return boolean
     */
    public function isDupes($index)
    {
        foreach ($this->experts as $jndex => $expert) {
            if($expert['expert_id'] == $this->experts[$index]['expert_id']) { //apakah sudah ada ?
                $blacklist = $jndex;
                foreach ($this->experts as $kndex => $expert) {
                    if ($expert['expert_id'] == $this->experts[$index]['expert_id']) { //apakah sudah ada ?
                        if ($kndex != $blacklist) {
                            return true;
                        }
                    }
                }
            }
        }
        return false;
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
        $this->validate($this->headRules, $this->kasatErrMessage);
        
        HeadReport::updateOrCreate(
            ['head_id' => $this->head_id],
            [
                'site_id' => $this->site_id,
                'maintenance_type' => $maintenance_type,
                'kasat_name' => $this->kasat_name,
                'kasat_nip' => $this->kasat_nip,
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
                if ($manualExpert['expert_nip'] == "") {
                    $manualExpert['expert_nip'] = NULL;
                }
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
