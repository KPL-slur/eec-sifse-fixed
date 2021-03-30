<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class PmCheck extends Component
{
    public $namaKolom;
    public $radioNamaKolom;
    public $satuan;
    public $hvpsVNamaKolom;
    public $hvpsINamaKolom;
    public $magINamaKolom;
    public $type;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($namaKolom, $satuan=null, $type=null)
    {
        $this->namaKolom = $namaKolom;
        $this->radioNamaKolom = 'radio_' . $namaKolom;
        $this->satuan = $satuan;
        $this->hvpsVNamaKolom = 'hvps_v_' . $namaKolom;
        $this->hvpsINamaKolom = 'hvps_i_' . $namaKolom;
        $this->magINamaKolom = 'mag_i_' . $namaKolom;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.forms.pm-check');
    }
}
