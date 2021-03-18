<?php

namespace App\Http\Livewire\Traits;

/**
 * 
 */
trait WithModal
{
    public $modalType; // to determine which type of modal (submit, delete, cancel)
    public $selectedForm; // to determine which dynamic form it is 
    public $selectedItem; // to determine which item indeces of dynamic field it is

    /**
     * setter
     * 
     * @param $itemId which item index
     * @param $formType which dynamic form
     */
    public function selectItem($itemId, $formType)
    {
        $this->selectedItem = $itemId;
        $this->selectedForm = $formType;
        $this->modalType = 'delete';
        $this->dispatchBrowserEvent('openModalConfirm');
    }

    public function deleteDynamicForm()
    {
        /**
         * mostly dynamic form item deleting confirmation
         */
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

    /**
     * form input cancelation
     */
    public function cancel()
    {
        $this->modalType = 'cancel';
        $this->dispatchBrowserEvent('openModalConfirm');
    }
}
