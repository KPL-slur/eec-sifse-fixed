<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\HeadReport;

use App\Http\Livewire\Traits\WithHeadReport;
use App\Http\Livewire\Traits\WithPmBodyReport;
use App\Http\Livewire\Traits\WithRecommendation;
use App\Http\Livewire\Traits\WithReportImage;
use App\Http\Livewire\Traits\WithModal;


class PmReport extends Component
{
    use WithFileUploads;
    use WithHeadReport;
    use WithPmBodyReport;
    use WithRecommendation;
    use WithReportImage;
    use WithModal;

    public $head_id; // to determine which head_id right now

    protected $headReport, $expertReports, $pmBodyReport, $reportImages; // old data for edit form

    /**
     * the first method to run, followed by traits's mount method.
     * If $id exsist then it must be edit form.
     * if edit, then it will initialize old data from db. 
     * Some data initialization is handled by traits's mount method.
     * 
     * @param $id OPTIONAL head_id of the current record
     */
    public function mount($id=NULL)
    {
        if ($id) {
            $this->head_id = $id;
            //* INITIALIZE EDIT DATA
            $this->headReport = HeadReport::Where('head_id', $this->head_id)->first();
            abort_unless($this->headReport, 404, 'Report not found');

            $this->expertReports = $this->headReport->experts;
            $this->pmBodyReport = $this->headReport->pmBodyReport;
            abort_unless($this->pmBodyReport, 404, 'Report not found');

            $this->reportImages = $this->headReport->reportImages;

            //* INITIALIZE EDIT DATA HEAD REPORT
            //* INITIALIZE BODY EDIT
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
        $this->upstoreHead('pm');
        //INSERT EXPERTREPORT
        $this->upstoreExpert();
        //INSERT MANUALEXPERTREPORT
        $this->upstoreManualExpert();
        //INSERT PMBODYREPORT
        $this->upstorePmBodyReport();
        //INSERT RECOMENDATION
        $this->upstoreRecommendation();
        //INSERT MANUAL RECOMENDATION, selalu buat baru
        $this->upstoreManualRecommendation();
        //INSERT REPORT IMAGE
        $this->upstoreReportImage();

        return redirect()->route('report.index', ['maintenance_type' => 'pm']);
    }

    /**
     *  at some step, do validation on the given forms.
     *  some step may do some step specific function calls.
     */
    public function validateStep($step)
    {
        switch ($step) {
            case 1:
                $this->validate($this->headRules);
                $this->validateExpert();
                $this->validateManualExpert();
                break;

            case 2:
                $this->validate($this->pmBodyReportRules,[
                    'required' => 'This field is required.',
                ]);
                break;

            case 3:
                $this->validate([
                    'remark' => 'required',
                ]);
                $this->dispatchBrowserEvent('list-added');
                break;

            case 5:
                $this->validateUploads();
                $this->modalType = 'submit';
                $this->dispatchBrowserEvent('openModalConfirm');
                return false;
                break;
            
            default:
                # code...
                break;
        }
        return true;
    }

    public function render()
    {
        return view('livewire.pm-report');
    }
}