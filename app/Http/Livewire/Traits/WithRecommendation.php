<?php

namespace App\Http\Livewire\Traits;

use App\Services\Utility;
use App\Models\Stock;
use App\Models\Recommendation;
use App\Models\HeadReport;

/**
 * 
 */
trait WithRecommendation
{
    //* user inputs
    public $recommends = []; //user inputs
    public $manualRecommends = []; //user inputs

    //* list of
    public $stocks = []; // list of all stocks and rekomendation
    
    //* recomendation form edit
    private $siteRecommendations = []; // list of all rekomendation per site
    public $recommendationId = []; // array meanmpung export_report_id yg sudah di extract dari model

    //* LIVEWIRE METHOD
    /**
     * run after class mount method.
     * if $id exist, then it must be an edit form.
     * if edit, call the setRecommends function.
     * 
     * @param $id OPTIONAL head_id of the current record
     */
    public function mountWithRecommendation($id=null)
    {
        if ($id) {
            $this->setRecommends();
        }
    }

    /**
     * 
     */
    public function dehydrate()
    {
        $this->dispatchBrowserEvent('list-added');
    }

    //* RECOMMENDS
    /**
     * 
     */
    public function addRecommend()
    {
        $this->recommends[] = ['name' => '', 'jumlah_unit_needed' => "1 units", 'date' => ''];
    }
    
    /**
     * remove record from db if record already saved
     * and remove it from livewire arr model too.
     * 
     * @param $index index of the current item
     */
    public function removeRecommend($index)
    {
        if (array_key_exists($index, $this->recommends)) {
            if (array_key_exists($index, $this->recommendationId)) {
                if (array_key_exists('head_id', $this->recommends[$index]) && $this->recommends[$index]['head_id'] == $this->head_id ) {
                    Recommendation::where('rec_id', $this->recommendationId[$index])->forceDelete();
                } else {
                    Recommendation::where('rec_id', $this->recommendationId[$index])->delete();
                }
            }
            
            unset($this->recommends[$index]);
            array_values($this->recommends);
            $this->emit('unsetRecommendation');
        }
    }

    /**
     * set the $recommends arr with data from db per site
     * *set the $recommendationId
     * reset the dropdown option by calling setRecommendationDropdown 
     */
    public function setRecommends()
    {
        // Clear Array
        unset($this->recommends);
        unset($this->recommendationId);
        // Init Array
        $this->recommends = [];
        $this->recommendationId = [];
        


        $siteHeadReports = HeadReport::Where('site_id', $this->site_id)->with('recommendations')->get();
        
        foreach ($siteHeadReports as $siteHeadReport){ //headreport
            foreach ($siteHeadReport->recommendations as $index => $recommendation) {
                $this->recommends[] = [
                                        'date' => date('j F Y', strtotime($siteHeadReport->report_date_end)),
                                        'name' => $recommendation->name,
                                        'jumlah_unit_needed' => $recommendation->jumlah_unit_needed,
                                        'head_id' => $recommendation->head_id,
                                    ];
                $this->recommendationId[] = $recommendation->rec_id;
            }
        }
        if (isset($this->head_id)) {
            $headReport = HeadReport::find($this->head_id);
            $deletedRecommends = $headReport->recommendations()->onlyTrashed()->get();
            foreach ($deletedRecommends as $deletedRecommend) {
                $this->recommends[] = [
                                        'date' => date('j F Y', strtotime($headReport->report_date_end)),
                                        'name' => $deletedRecommend->name,
                                        'jumlah_unit_needed' => $deletedRecommend->jumlah_unit_needed,
                                        'head_id' => $deletedRecommend->head_id,
                                    ];
                $this->recommendationId[] = $deletedRecommend->rec_id;
            }
        }
        $this->setRecommendationDropdown();
    }

    /**
     * 
     */
    public function validateRecommends()
    {
        foreach ($this->recommends as $index => $recommend) {
            $this->validate([
                'recommends.'.$index.'.name' => 'required',
                'recommends.'.$index.'.jumlah_unit_needed' => 'required',
            ],[
                'required' => 'This field is required.',
            ]);
        };
    }

    //* MANUAL RECOMMENDS
    /**
     * 
     */
    public function addManualRecommends ()
    {
        $this->manualRecommends[] = ['name' => '', 'jumlah_unit_needed' => "1 units", 'date' => ''];
    }

    /**
     * only removing it from the arr
     * 
     * @param $index index of the current item
     */
    public function removeManualRecommends($index)
    {
        if (array_key_exists($index, $this->manualRecommends)) {
            unset($this->manualRecommends[$index]);
            array_values($this->manualRecommends);
            $this->emit('unsetRecommendation');
        }
    }

    /**
     * 
     */
    public function validateManualRecommends()
    {
        foreach ($this->manualRecommends as $index => $manualRecommend) {
            $this->validate([
                'manualRecommends.'.$index.'.name' => 'required',
                'manualRecommends.'.$index.'.jumlah_unit_needed' => 'required',
            ],[
                'required' => 'This field is required.',
            ]);
        };
    }

    //* GENERAL RECOMMENDATIONS
    /**
     * set the dropdown(s) option(s) to
     * all stocks items and manualrecommendation item
     * *using Utility helper class
     */
    public function setRecommendationDropdown()
    {
        $utility = new Utility; // instance kelas helper
        // preparing for recommend dropdown option
        $this->stocks = Stock::select('nama_barang AS name')
                            ->get()
                            ->toArray();
        foreach ($this->recommends as $recommend){
            if (!($utility->in_array_r($recommend['name'], $this->stocks))) {
                $this->stocks[] = ['name' => $recommend['name']];
            }
        }
    }

    //* UPSTORE
    /**
     * if the record id not found in collection, then
     * it will create a new record, else
     * it will only update the necesarry field
     */
    public function upstoreRecommendation()
    {
        if ($this->recommends) {
            foreach ($this->recommends as $index => $recommend) {
                if (!isset($this->recommendationId[$index])) {
                    Recommendation::Create(
                        [
                            'head_id' => $this->head_id,
                            'name' => $recommend['name'],
                            'jumlah_unit_needed' => $recommend['jumlah_unit_needed'],
                            'year' => now()->year
                        ]
                    );
                } else {
                    Recommendation::where('rec_id', $this->recommendationId[$index])->Update(
                        [
                            'name' => $recommend['name'],
                            'jumlah_unit_needed' => $recommend['jumlah_unit_needed'],
                            'year' => now()->year
                        ]
                    );
                }
            }
        }
    }

    /**
     * Even in edit mode, it will always create a new record
     */
    public function upstoreManualRecommendation()
    {
        if ($this->manualRecommends) {
            foreach ($this->manualRecommends as $manualRecommend) {
                if ($manualRecommend['name']) {
                    Recommendation::create([
                        'head_id' => $this->head_id,
                        'name' => $manualRecommend['name'],
                        'jumlah_unit_needed' => $manualRecommend['jumlah_unit_needed'],
                        'year' => now()->year
                    ]);
                }
            }
        }
    }
}