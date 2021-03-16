<?php

namespace App\Http\Livewire\Traits;

/**
 * 
 */
trait WithModal
{
    public $selectedItem;
    public $selectedForm;

    public function selectItem($itemId, $formType)
    {
        $this->selectedItem = $itemId;
        $this->selectedForm = $formType;
        $this->modalType = 'delete';
        $this->dispatchBrowserEvent('openModalConfirm');
    }

    public function deleteDynamicForm()
    {
        switch ($this->selectedForm) {
            case 'expert':
                $this->removeExpert($this->selectedItem);
                $this->dispatchBrowserEvent('closeModalConfirm');
                break;

            case 'manualExpert':
                $this->removeManualExpert($this->selectedItem);
                $this->dispatchBrowserEvent('closeModalConfirm');
                break;

            case 'recommendation':
                $this->removeRecommend($this->selectedItem);
                $this->dispatchBrowserEvent('closeModalConfirm');
                break;

            case 'manualRecommendation':
                $this->removeManualRecommends($this->selectedItem);
                $this->dispatchBrowserEvent('closeModalConfirm');
                break;

            case 'attachment':
                $this->removeAttachment($this->selectedItem);
                $this->dispatchBrowserEvent('closeModalConfirm');
                break;
        
            default:
                # code...
                break;
        }
    }

    public function cancel()
    {
        $this->modalType = 'cancel';
        $this->dispatchBrowserEvent('openModalConfirm');
    }
}
