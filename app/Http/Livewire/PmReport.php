<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Expert;

class PmReport extends Component
{
    public $currentStep = 1;
    public $expertForms = [];
    public $experts = [];
    private $limit = 3;

    public $query;

    public function mount()
    {
        $this->expertForms = [[]];
        $this->experts = Expert::all()
        ->toArray();
        $this->query = '';
    }

    public function updatedQuery()
    {
        foreach ($this->query as $key)
        $this->experts = Expert::where('name', 'like', '%' . $key . '%')
        ->get()
        ->toArray();
    }

    public function addExpertForm()
    {
        $this->expertForms[] = [];
    }

    public function nextStep()
    {
        // $validatedData = $this->validate([
        //     'name' => 'required|unique:products',
        //     'amount' => 'required|numeric',
        //     'description' => 'required',
        // ]);
        $this->currentStep++;
    }

    public function secondStepSubmit()
    {
        // $validatedData = $this->validate([
        //     'stock' => 'required',
        //     'status' => 'required',
        // ]);
        $this->currentStep = 3;
    }

    public function submitForm()
    {
        // Product::create([
        //     'name' => $this->name,
        //     'amount' => $this->amount,
        //     'description' => $this->description,
        //     'stock' => $this->stock,
        //     'status' => $this->status,
        // ]);
        $this->successMessage = 'Product Created Successfully.';
        $this->clearForm();
        $this->currentStep = 1;
    }

    public function back()
    {
        $this->currentStep--;
    }

    public function clearForm()
    {
        // $this->name = '';
        // $this->amount = '';
        // $this->description = '';
        // $this->stock = '';
        // $this->status = 1;
    }

    public function render()
    {
        return view('livewire.pm-report');
    }
}
