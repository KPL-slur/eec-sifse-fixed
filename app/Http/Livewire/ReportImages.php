<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\ReportImage;

class ReportImages extends Component
{
    public $caption;
    public $image;

    use WithFileUploads;

    public function fileUpload()
    {
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
