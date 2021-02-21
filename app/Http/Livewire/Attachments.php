<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use Livewire\Component;

use App\Models\ReportImage;

class Attachments extends Component
{
    public $caption;
    public $image;
    public $attachments = [];

    use WithFileUploads;

    public function mount()
    {
        // images mount
        $this->attachments = [
            ['caption' => '', 'image' => '']
        ];
    }

    // ATTACHMENT
    public function addAttachment()
    {
        $this->attachments[] = ['caption' => '', 'image' => ''];
    }
    
    public function removeAttachment($index)
    {
        unset($this->attachments[$index]);
        array_values($this->attachments);
    }

    public function fileUpload()
    {
        dd($this->attachments);
        $validatedData = $this->validate([
            'caption' => 'required',
            'image' => 'required'
        ]);

        $image = $this->image->store('files', 'public');
        $validatedData['image'] = $image;
        ReportImage::create($validatedData);
        session()->flash('message', 'File Uploaded');
        $this->emit('fileUploaded');
    }


    public function render()
    {
        return view('livewire.attachments');
    }
}
