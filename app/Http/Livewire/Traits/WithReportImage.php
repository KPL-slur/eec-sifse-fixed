<?php

namespace App\Http\Livewire\Traits;

use App\Models\ReportImage;

/**
 * 
 */
trait WithReportImage
{
    // report image form
    public $caption;
    public $attachments = [];

    public function mountWithReportImage()
    {
        // images mount
        $this->attachments = [
            ['caption' => '', 'image' => '', 'uploaded' => 0]
        ];
    }

    public function addAttachment()
    {
        $this->attachments[] = ['caption' => '', 'image' => '', 'uploaded' => 0];
    }
    
    public function removeAttachment($index)
    {
        if ($this->attachments[$index]['uploaded'] === 1) {
            \Storage::delete('public/'.$this->attachments[$index]['image']);
            ReportImage::where('image', $this->attachments[$index]['image'])->delete();
            $this->attachments[$index]['uploaded'] = 0;
        }

        unset($this->attachments[$index]);
        array_values($this->attachments);
    }

    public function validateUploads()
    {
        foreach ($this->attachments as $index => $attachment) {
            if ($this->attachments[$index]['uploaded'] == 0) {
                $this->validate([
                    'attachments.'.$index.'.caption' => 'required',
                    'attachments.'.$index.'.image' => 'required|image'
                ]);
            }
        }
    }

    public function uploadAll()
    {
        foreach ($this->attachments as $index => $attachment) {
            if ($this->attachments[$index]['uploaded'] == 0) {
                $this->fileUpload($index);
            }
        }
    }

    public function fileUpload($index)
    {
        $this->image[$index] = $this->attachments[$index]['image']->storePublicly('files', 'public');
        
        ReportImage::create([
            'head_id' => $this->headId,
            'image' => $this->image[$index],
            'caption' => $this->attachments[$index]['caption']
        ]);

        $this->attachments[$index]['uploaded'] = 1;
    }

}
