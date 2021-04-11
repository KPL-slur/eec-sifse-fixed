<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Stock;

class StockTable extends Component
{
    public $stocks_group = []; //inisiasi empty array stocks_group
    public $stocks;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->stocks = Stock::all();

        $stocks_group_db = Stock::Pluck('group'); //buat ngambil semua isi column group
        foreach($stocks_group_db as $sgb){
            if(!in_array($sgb, $this->stocks_group)){
                array_push($this->stocks_group, $sgb);
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.stock-table');
    }
}
