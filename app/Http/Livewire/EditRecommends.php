<?php

namespace App\Http\Livewire;

use App\Models\Recommendation;
use App\Models\Stock;
use Livewire\Component;

class EditRecommends extends Component
{
    public $headId;
    public $stocks = [];
    public $recommended; 
    public $recommends = [];

    public function mount($headId)
    {
        $this->stocks = Stock::all();
        $this->recommended = Recommendation::where('head_id', $headId)->get()->toArray();
        // $this->recommends = [
        //     ['nama_barang' => '', 'quantity' => 1]
        // ];
        $this->recommends = $this->recommended;
        // dd($this->recommends);
    }

    public function addRecommend()
    {
        $this->recommends[] = ['spare_part_name' => '', 'qty' => 1];
    }
    
    public function removeRecommend($index, $id=null)
    {
        unset($this->recommends[$index]);
        array_values($this->recommends);
        if ($id != null) {
            Recommendation::where('id', $id)->delete();
        }
    }

    public function render()
    {
        return view('livewire.edit-recommends');
    }
}
