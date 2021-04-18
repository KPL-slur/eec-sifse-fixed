<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\Utility;
use App\Models\HeadReport;

class PrintedReport extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;

    public $headReport;
    public $maintenance_type;

    public $reports = []; //user input
    public $fileNameChecks = []; //user input

    public $selectedItem;

    private $errMessage = [
        'required' => 'This input is required.',
        'mimes' => 'This input must be a file of type: pdf.',
        'unique' => 'This report already has this kind of file, please check your file category input again.'
    ];

    //* LIVEWIRE METHOD
    /**
     * run after class mount method.
     * if $id exist, then it must be an edit form.
     * init data if edit, init from class variable.
     * or else init expert arr key with empty value.
     *
     * @param $id OPTIONAL head_id of the current record
     */
    public function mount()
    {
        foreach ($this->headReport->printedReports as $printedReport) {
            $this->reports[] = ['fileName' => $printedReport->file, 'uploaded' => 1, 'file' => ''];
            $this->fileNameChecks[] = ['Report'];
        }
        if (empty($this->reports)) {
            $this->reports = [
                ['fileName' => '', 'uploaded' => 0, 'file' => '']
            ];
            $this->fileNameChecks[] = ['Report'];
        }
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    //* reports method

    /**
     *
     */
    public function clearInput($index)
    {
        $this->reports[$index]['file'] = '';
    }

    /**
     *
     */
    public function addReport()
    {
        $this->authorize('update', $this->headReport);
        if (count($this->reports) != 0) {
            if ($this->reports[count($this->reports)-1]['fileName'] != '') {
                $this->reports[] = ['fileName' => '', 'uploaded' => 0, 'file' => ''];
                $this->fileNameChecks[] = ['Report'];
            } else {
                $this->emit('prevLimit'); // notif
            }
        } else {
            $this->reports[] = ['fileName' => '', 'uploaded' => 0, 'file' => ''];
            $this->fileNameChecks[] = ['Report'];
        }
    }

    /**
     *
     */
    public function openModalDelete($index)
    {
        $this->dispatchBrowserEvent('openModalConfirm');
        $this->selectedItem = $index;
    }

    /**
     *
     */
    public function confirmDelete()
    {
        $this->removeReport($this->selectedItem);
        $this->dispatchBrowserEvent('closeModalConfirm');
    }

    /**
     *
     */
    public function deleteStoredFile($index)
    {
        if (!empty($this->reports[$index]['fileName'])) {
            Storage::delete('public/'.$this->reports[$index]['fileName']);
            $this->headReport->printedReports()->where('file', $this->reports[$index]['fileName'])->delete();
            $this->reports[$index]['uploaded'] = 0;
        } else {
            $this->emit('fileError'); // notif
        }
    }
    
    /**
     * if file already uploaded, first delete it from storage.
     * secondly, delete it from db record, and finaly set the upload
     * to zero. and regardless if it uploaded or not, delete the arr index.
     *
     * @param $index index of the current item
     */
    public function removeReport($index)
    {
        $this->authorize('update', $this->headReport);
        if (array_key_exists($index, $this->reports)) {
            if ($this->reports[$index]['uploaded'] === 1) {
                $this->deleteStoredFile($index);
            }
            
            unset($this->reports[$index]);
            array_values($this->reports);
            unset($this->fileNameChecks[$index]);
            array_values($this->fileNameChecks);
            $this->emit('removeReport'); // notif
        }
    }

    /**
     * ! Deprecated not really used but still kept just in case
     * nilai MAX harus sama dengan nilai max_len 
     * pada fungsi js di view livewire.printed-report
     */
    public function validateFileNameChecks()
    {
        foreach ($this->fileNameChecks as $index => $fileNameCheck) {
            foreach ($this->fileNameCheck as $jndex => $fileName) {
                $this->validate(['fileNameChecks.'.$jndex => 'required|max:30']);
            }
        }
    }

    /**
     * ! deprecated
     * validate every single file that are not uplaoded
     */
    public function validateAllUploads()
    {
        foreach ($this->reports as $index => $report) {
            if ($this->reports[$index]['uploaded'] == 0) {
                $this->validateUpload($index);
            }
        }
    }

    /**
     *
     */
    public function setFileName($index)
    {
        $priorities = array('Report', 'Berita Acara');
        $sortedFNC = array_merge(array_intersect($priorities, $this->fileNameChecks[$index]), array_diff($this->fileNameChecks[$index], $priorities));

        $utility = new Utility;
        $date = $utility->easyToReadDateTime($this->headReport->report_date_start, $this->headReport->report_date_end);
        $name = $date;
        
        foreach ($sortedFNC as $key => $fileNameCheck) {
            if ($fileNameCheck != '') {
                $name = $name.'-'.$fileNameCheck;
            }
        }
        $name = $name.'-'.$this->headReport->site->station_id.'.pdf';
        return $name;
    }

    /**
     *
     */
    public function update($index)
    {
        $this->authorize('update', $this->headReport);
        $this->reports[$index]['fileName'] = $this->maintenance_type.'/'.$this->setFileName($index);
        $this->validate([
            'reports.'.$index.'.file' => 'required|mimes:pdf',
        ], $this->errMessage);
        
        if ($this->reports[$index]['uploaded'] == 1) {
            if (! empty($this->reports[$index]['file'])) {
                $fileName[$index] = $this->reports[$index]['file']->storePubliclyAs($this->maintenance_type, $this->setFileName($index), 'public');
            
                Storage::delete('public/'.$this->reports[$index]['fileName']);
                $this->headReport->printedReports()
                ->where('file', $this->reports[$index]['fileName'])
                ->update([
                            'file' => $fileName[$index]
                        ]);
            
                $this->reports[$index]['file'] = '';
                $this->reports[$index]['fileName'] = $fileName[$index];
                $this->reports[$index]['uploaded'] = 1;
                $this->emit('uploadReport'); // notif
            } else {
                $this->emit('fileError'); // notif
            }
        }
    }

    /**
     *
     */
    public function store($index)
    {
        $this->authorize('update', $this->headReport);
        $this->reports[$index]['fileName'] = $this->maintenance_type.'/'.$this->setFileName($index);
        $this->validate([
            'reports.'.$index.'.file' => 'required|mimes:pdf',
            'reports.'.$index.'.fileName' => 'unique:App\Models\PrintedReport,file',
        ], $this->errMessage);

        if ($this->reports[$index]['uploaded'] == 0) {
            if (! empty($this->reports[$index]['file'])) {
                $fileName[$index] = $this->reports[$index]['file']->storePubliclyAs($this->maintenance_type, $this->setFileName($index), 'public');
            
                $this->headReport->printedReports()
                                 ->create([
                                            'head_id' => $this->headReport->head_id,
                                            'file' => $fileName[$index]
                                        ]);

                $this->reports[$index]['file'] = '';
                $this->reports[$index]['fileName'] = $fileName[$index];
                $this->reports[$index]['uploaded'] = 1;
                $this->emit('uploadReport'); // notif
            } else {
                $this->emit('fileError'); // notif
            }
        }
    }

    public function render()
    {
        return view('livewire.printed-report');
    }
}
