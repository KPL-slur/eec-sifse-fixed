<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Expert;

class Experts extends Component
{

    public $headId;
    public $experts = [];
    public $manualExperts = [];
    public $expertsData;
    public $uniqueCompanies;

    public function mount()
    {
        $this->experts = [
            ['expert_name' => '', 'expert_company' => '', 'expert_nip' => '']
        ];
        $this->expertsData = Expert::all();
        $this->uniqueCompanies = $this->expertsData->unique('expert_company');
    }

    public function addExpert()
    {
        $this->experts[] = ['expert_name' => '', 'expert_company' => '', 'expert_nip' => ''];
    }
    
    public function removeExpert($index)
    {
        unset($this->experts[$index]);
        array_values($this->experts);
    }

    public function addManualExpert ()
    {
        $this->manualExperts[] = ['expert_name' => '', 'expert_company' => '', 'expert_nip' => ''];
    }

    public function removeManualExpert($index)
    {
        unset($this->manualExperts[$index]);
        array_values($this->manualExperts);
    }

    public function render()
    {
        return view('livewire.experts');
    }
}
