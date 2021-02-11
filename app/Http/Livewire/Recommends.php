<?php

namespace App\Http\Livewire;

use App\Models\Recommendation;
use App\Models\Stock;
use Livewire\Component;

class Recommends extends Component
{
    public $headId;
    public $stocks = [];
    public $recommends = [];

    public function mount()
    {
        $this->stocks = Stock::all();
        $this->recommends = [
            ['nama_barang' => '', 'quantity' => 1]
        ];
    }

    public function addRecommend()
    {
        $this->recommends[] = ['nama_barang' => '', 'quantity' => 1];
    }
    
    public function removeRecommend($index)
    {
        unset($this->recommends[$index]);
        array_values($this->recommends);
    }

    public function render()
    {
        return view('livewire.recommends');
    }
}
