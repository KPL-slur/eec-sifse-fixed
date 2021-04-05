<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\HeadReport;

class PrintedReport extends Component
{
    use WithFileUploads;

    public $headReport;
    public $maintenance_type;
    public $fileName; // display

    public $reports = []; //user input

    public $selectedItem;

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
        if (empty($this->reports)) {
            foreach ($this->headReport->printedReports as $printedReport) {
                $this->reports[] = ['fileName' => $printedReport->file, 'uploaded' => 1];
            }
        } else {
            $this->reports = [
                ['fileName' => '', 'uploaded' => 0]
            ];
        }
    }

    public function updatedReports()
    {
        $this->store();
    }

    //* reports method
    /**
     *
     */
    public function addReport()
    {
        $this->reports[] = ['fileName' => '', 'uploaded' => 0];
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
     * if file already uploaded, first delete it from storage.
     * secondly, delete it from db record, and finaly set the upload
     * to zero. and regardless if it uploaded or not, delete the arr index.
     *
     * @param $index index of the current item
     */
    public function removeReport($index)
    {
        if (array_key_exists($index, $this->reports)) {
            if ($this->reports[$index]['uploaded'] === 1) {
                \Storage::delete('public/'.$this->reports[$index]['fileName']);
                $this->headReport->printedReports()->where('file', $this->reports[$index]['fileName'])->delete();
                $this->reports[$index]['uploaded'] = 0;
            }
            
            unset($this->reports[$index]);
            array_values($this->reports);
            $this->emit('removeReport'); // notif
        }
    }

    /**
     * 
     */
    public function validateUpload($index)
    {
        $this->validate([
                            'reports.'.$index.'.fileName' => 'required|mimes:pdf'
                        ], [
                            'required' => 'This input is required.',
                            'mimes:pdf' => 'This input must be a file of type: pdf.',
                        ]);
    }

    /**
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
     * if it is not uploaded, store the file in
     * storage with default laravel file naming. then,
     * save the record to db and set teh uploaded value to one.
     */
    public function store()
    {
        $this->validateAllUploads();
        
        foreach ($this->reports as $index => $report) {
            if ($this->reports[$index]['uploaded'] == 0) {
                $fileName[$index] = $this->reports[$index]['fileName']->storePublicly($this->maintenance_type, 'public');
        
                $this->headReport->printedReports()->create([
                    'head_id' => $this->headReport->head_id,
                    'file' => $fileName[$index],
                ]);
                
                $this->reports[$index]['fileName'] = $fileName[$index];
                $this->reports[$index]['uploaded'] = 1;
            }
        }
        $this->emit('uploadReport'); // notif
    }

    public function render()
    {
        return view('livewire.printed-report');
    }
}
