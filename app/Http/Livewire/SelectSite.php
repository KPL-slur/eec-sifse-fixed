<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Site;

class SelectSite extends Component
{
    public $site_id;
    public $radar;

    public function mount()
    {
        // $this->country=$country;
        // $this->radar->radar_name='';
    }
    
    public function render()
    {
        if(!empty($this->site_id)) {
            $this->radar = Site::where('site_id', $this->site_id)->first();
        }
        return view('livewire.select-site')
            ->withStations(Site::get());
    }

    // public function render()
    // {
    //     return view('livewire.select-site');
    // }
}
