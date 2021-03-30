<?php

namespace App\Http\Livewire\Traits;

use App\Models\ReportImage;

/**
 * 
 */
trait WithReportImage
{
    //* user input
    public $attachments = []; //user input

    //* LIVEWIRE METHOD
    /**
     * run after class mount method.
     * if $id exist, then it must be an edit form.
     * init data if edit, init from class variable.
     * or else init expert arr key with empty value.
     * 
     * @param $id OPTIONAL head_id of the current record
     */
    public function mountWithReportImage($id=null)
    {
        if ($id) {
            foreach ($this->reportImages as $reportImage) {
                $this->attachments[] = ['image' => $reportImage->image, 'caption' => $reportImage->caption, 'uploaded' => 1];
            }
        } else {
            //images mount
            $this->attachments = [
                ['caption' => '', 'image' => '', 'uploaded' => 0]
            ];
        }
    }

    /**
     * check if file isnt image type, then
     * remove the value so it will fail in validation.
     * only evaluate the image input
     * 
     * @param $value value of the updated model
     * @param $index updated nested variable // eg. 0.images | 0.caption
     */
    public function updatedAttachments($value, $index)
    {
        $index = explode(".",$index); // 0.images
        if ($index[1] == 'image') {
            $extension = pathinfo($value->getFilename(), PATHINFO_EXTENSION);
            if (!in_array($extension, ['jpg', 'jpeg', 'png', 'bmp', 'gif', 'svg', 'webp'])) {
                $this->attachments[$index[0]]['image'] = '';
            }
            $this->validateUploads();
        }
    }

    //* attachment method
    /**
     * 
     */
    public function addAttachment()
    {
        $this->attachments[] = ['caption' => '', 'image' => '', 'uploaded' => 0];
    }
    
    /**
     * if file already uploaded, first delete it from storage.
     * secondly, delete it from db record, and finaly set the upload
     * to zero. and regardless if it uploaded or not, delete the arr index.
     * 
     * @param $index index of the current item
     */
    public function removeAttachment($index)
    {
        if (array_key_exists($index, $this->attachments)) {
            if ($this->attachments[$index]['uploaded'] === 1) {
                \Storage::delete('public/'.$this->attachments[$index]['image']);
                ReportImage::where('image', $this->attachments[$index]['image'])->delete();
                $this->attachments[$index]['uploaded'] = 0;
            }
            
            unset($this->attachments[$index]);
            array_values($this->attachments);
            $this->emit('unsetAttachment');
        }
    }

    /**
     * validate every single file that are not uplaoded
     */
    public function validateUploads()
    {
        foreach ($this->attachments as $index => $attachment) {
            if ($this->attachments[$index]['uploaded'] == 0) {
                $this->validate([
                    'attachments.'.$index.'.caption' => 'required',
                    'attachments.'.$index.'.image' => 'required|image'
                ],[
                    'required' => 'This field is required.',
                    'image' => 'The input must be an image.',
                ]);
            }
        }
    }

    /**
     * if it is not uploaded, store the file in 
     * storage with default laravel file naming. then,
     * save the record to db and set teh uploaded value to one.
     */
    public function upstoreReportImage()
    {
        $this->validateUploads();
        foreach ($this->attachments as $index => $attachment) {
            if ($this->attachments[$index]['uploaded'] == 0) {
                $image[$index] = $this->attachments[$index]['image']->storePublicly('files', 'public');
        
                ReportImage::create([
                    'head_id' => $this->head_id,
                    'image' => $image[$index],
                    'caption' => $this->attachments[$index]['caption']
                ]);

                $this->attachments[$index]['uploaded'] = 1;
            }
        }
    }
}
