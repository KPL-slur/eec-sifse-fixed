<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\HeadReport;
use App\Models\Expert;
use App\Models\ExpertReport;
use App\Models\CmBodyReport;
use App\Models\Recommendation;
use App\Models\ReportImage;

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
    
    /**
     *
     */
    public function upstore($head_id=null)
    {
        HeadReport::updateOrCreate(
            ['head_id' => $head_id],
            [
                'site_id' => $this->site_id,
                'maintenance_type' => "cm",
                'report_date_start' => $this->report_date_start,
                'report_date_end' => $this->report_date_end,
            ]
        );

        if ($head_id === null) {
            $head_id = HeadReport::select('head_id')->latest()->first()->head_id;
        }

        //INSERT EXPERTREPORT
        foreach ($this->experts as $index => $expert) {
            if (!isset($this->expertReportId[0])) {
                ExpertReport::create(
                    [
                        'head_id' => $head_id,
                        'expert_id' => $expert['expert_id'],
                        'role' => $expert['expert_role']
                    ]
                );
            } else {
                ExpertReport::where('head_id', $head_id)->create(
                    [
                        'expert_id' => $expert['expert_id'],
                        'role' => $expert['expert_role']
                    ]
                );
            }
            
        }

        //INSERT NEW EXPERT
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
                        'head_id' => $head_id,
                        'expert_id' => $expert_id,
                        'role' => $manualExpert['expert_role']
                    ]);
                }
            }
        }

        CmBodyReport::updateOrCreate(
            ['head_id' => $head_id],
            [
                'remark' => $this->remark
            ]
        );

        //INSERT RECOMENDATION
        if ($this->recommends) {
            foreach ($this->recommends as $index => $recommend) {
                if (!isset($this->recommendationId[$index])) {
                    Recommendation::Create(
                        [
                            'head_id' => $head_id,
                            'name' => $recommend['name'],
                            'jumlah_unit_needed' => $recommend['jumlah_unit_needed'],
                            'year' => now()->year
                        ]
                    );
                } else {
                    Recommendation::where('head_id', $head_id)->Update(
                        [
                            'name' => $recommend['name'],
                            'jumlah_unit_needed' => $recommend['jumlah_unit_needed'],
                            'year' => now()->year
                        ]
                    );
                }
            }
        }

        //INSERT MANUAL RECOMENDATION, selalu buat baru
        if ($this->manualRecommends) {
            foreach ($this->manualRecommends as $manualRecommend) {
                if ($manualRecommend['name']) {
                    Recommendation::create([
                        'head_id' => $head_id,
                        'name' => $manualRecommend['name'],
                        'jumlah_unit_needed' => $manualRecommend['jumlah_unit_needed'],
                        'year' => now()->year
                    ]);
                }
            }
        }

        foreach ($this->attachments as $index => $attachment) {
            if ($this->attachments[$index]['uploaded'] == 0) {
                $image[$index] = $this->attachments[$index]['image']->storePublicly('files', 'public');
        
                ReportImage::create([
                    'head_id' => $head_id,
                    'image' => $image[$index],
                    'caption' => $this->attachments[$index]['caption']
                ]);

                $this->attachments[$index]['uploaded'] = 1;
            }
        }

        return redirect()->route('cm.index');
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
                ]));
                foreach ($this->experts as $index => $expert) {
                    $this->validate([
                        'experts.'.$index.'.expert_id' => 'required',
                        'experts.'.$index.'.expert_role' => 'required',
                    ]);
                };
                foreach ($this->manualExperts as $index => $manualExpert) {
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
        if ($this->currentStep < 4) {
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
