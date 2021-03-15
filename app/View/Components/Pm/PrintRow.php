<?php

namespace App\View\Components\Pm;

use Illuminate\View\Component;

class PrintRow extends Component
{
    /**
     * Nilai dari redio, bernilai 1 atau 0
     * bernilai string karena di pass
     * 
     * @var string
     */
    public $radio;

    /**
     * Nilai dari remark
     * 
     * @var string
     */
    public $remark;

    /**
     * Nilai dari remark
     * Defaultnya NULL
     * 
     * @var string
     */
    public $label;

    /**
     * Satuan dari remark yang memiliki nilai
     * Defaultnya NULL
     * 
     * @var string
     */
    public $satuan;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($radio, $remark=NULL, $label, $satuan=NULL)
    {
        $this->radio = $radio;
        $this->remark = $remark;
        $this->label = $label;
        $this->satuan = $satuan;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.pm.print-row');
    }
}
