<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\ReportImage;

class ReportImages extends Component
{
    public $headId = 'headId';
    public $attachments = [];

    use WithFileUploads;

    public function mount()
    {
        // dd($this->headId);
        //images mount
        $this->attachments = [
            ['caption' => '', 'image' => '']
        ];
    }

    public function addAttachment()
    {
        $this->attachments[] = ['caption' => '', 'image' => ''];
        // dd($this->attachments);
    }
    
    public function removeAttachment($index)
    {
        unset($this->attachments[$index]);
        array_values($this->attachments);
    }

    public function fileUpload()
    {
        //dd($this->attachments);

        $validatedData = $this->validate([
            'caption' => 'required',
            'image' => 'required'
        ]);

        $image = $this->image->store('files', 'public');
        $validatedData['image'] = $image;
        ReportImage::create($validatedData);
        session()->flash('message', 'File Upload');
        $this->emit('fileUploaded');
    }

    public function render()
    {
        return view('livewire.report-images');
    }
}
