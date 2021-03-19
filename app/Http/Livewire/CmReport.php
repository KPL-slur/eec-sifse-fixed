<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\HeadReport;
use App\Models\CmBodyReport;

use App\Http\Livewire\Traits\WithHeadReport;
use App\Http\Livewire\Traits\WithRecommendation;
use App\Http\Livewire\Traits\WithReportImage;
use App\Http\Livewire\Traits\WithModal;


class CmReport extends Component
{
    use WithFileUploads;
    use WithHeadReport;
    use WithRecommendation;
    use WithReportImage;
    use WithModal;

    public $currentStep; // to determine which page to hide

    public $head_id; // to determine which head_id right now

    public $remark; // livewire remark model

    protected $headReport, $expertReports, $cmBodyReport, $reportImages; // old data for edit form

    /**
     * the first method to run, followed by traits's mount method.
     * Initalize the currentStep by one;
     * If $id exsist then it must be edit form.
     * if edit, then it will initialize old data from db. 
     * Some data initialization is handled by traits's mount method.
     * 
     * @param $id OPTIONAL head_id of the current record
     */
    public function mount($id=NULL)
    {
        $this->currentStep = 1;
        if ($id) {
            $this->head_id = $id;
            //* INITIALIZE EDIT DATA
            $this->headReport = HeadReport::Where('head_id', $this->head_id)->first();
            abort_unless($this->headReport, 404, 'Report not found');

            $this->expertReports = $this->headReport->experts;
            $this->cmBodyReport = $this->headReport->cmBodyReport;
            abort_unless($this->cmBodyReport, 404, 'Report not found');

            $this->reportImages = $this->headReport->reportImages;

            //* INITIALIZE EDIT DATA HEAD REPORT
            //* INITIALIZE BODY EDIT
            $this->remark = $this->cmBodyReport->remark;
            //* INITIALIZE REKOMENDASI EDIT 
            //* INITIALIZE GAMBAR
        }
    }
    /**
     *  Update and store method, call traits specific upstore method.
     *  update the record if it exsist otherwise create the record.
     */
    public function upstore()
    {
        $this->upstoreHead('cm');
        //INSERT EXPERTREPORT
        $this->upstoreExpert();
        //INSERT MANUALEXPERTREPORT
        $this->upstoreManualExpert();
        //INSERT CMBODYREPORT
        $this->validate(['remark' => 'required']);
        CmBodyReport::updateOrCreate(
            ['head_id' => $this->head_id],
            ['remark' => $this->remark]
        );
        //INSERT RECOMENDATION
        $this->upstoreRecommendation();
        //INSERT MANUAL RECOMENDATION, selalu buat baru
        $this->upstoreManualRecommendation();
        //INSERT REPORT IMAGE
        $this->upstoreReportImage();

        return redirect()->route('report.index', ['maintenance_type' => 'pm']);
    }

    /**
     *  Increment the currentStep Variable by one.
     *  at some step, do validation on the given forms.
     *  some step may do some step specific function calls.
     */
    public function nextStep()
    {
        switch ($this->currentStep) {
            case 1:
                $this->validate($this->headRules);
                $this->validateExpert();
                $this->validateManualExpert();
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

    /**
     * decrement the step by one
     */
    public function back()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function render()
    {
        return view('livewire.cm-report');
    }
}