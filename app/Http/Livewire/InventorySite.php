<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Stock;

class InventorySite extends Component
{
    public $stocks = [];
    public $sitedStock = [];

    public function mount()
    {
        $this->sitedStock[] = ['stock_id' => ''];
    }

    public function stock()
    {
        $this->stocks = Stock::all();
        $this->sitedStock = [
            ['stock_id' => '']
        ];
    }

    public function addStock()
    {
        $this->sitedStock[] = ['stock_id' => ''];
    }

    public function removeStock($index)
    {
        unset($this->sitedStock[$index]);
        array_values($this->sitedStock);
    }

    public function render()
    {
        return view('livewire.inventory-site');
    }

}
