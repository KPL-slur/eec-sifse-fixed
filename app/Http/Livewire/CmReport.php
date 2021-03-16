<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\HeadReport;

use App\Http\Livewire\Traits\WithHeadReport;
use App\Http\Livewire\Traits\WithRecommendation;
use App\Http\Livewire\Traits\WithReportImage;
use App\Http\Livewire\Traits\WithModal;

use App\Services\Utility;

class CmReport extends Component
{
    use WithFileUploads;
    use WithHeadReport;
    use WithRecommendation;
    use WithReportImage;
    use WithModal;

    public $currentStep;
    public $edit;
    public $modalType;

    public $remark;

    /**
     * 
     */
    public function mount()
    {
        $this->currentStep = 1;
    }

    //
    
    //

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
                ]));
                foreach ($this->experts as $index => $expert){
                    $this->validate([
                        'experts.'.$index.'.expert_id' => 'required',
                        'experts.'.$index.'.expert_role' => 'required',
                    ]);
                };
                foreach ($this->manualExperts as $index => $manualExpert){
                    $this->validate([
                        'manualExperts.'.$index.'.expert_name' => 'required',
                        'manualExperts.'.$index.'.expert_company' => 'required',
                        'manualExperts.'.$index.'.expert_nip' => 'required',
                        'manualExperts.'.$index.'.expert_role' => 'required',
                    ]);
                };
                break;

            case 2:
                $this->validate(([
                    'remark' => 'required',
                ]));
                $this->dispatchBrowserEvent('list-added');
                break;

            case 4:
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

    public function render()
    {
        return view('livewire.cm-report');
    }
}
