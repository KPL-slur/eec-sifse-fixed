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
    // recomendation form
    public $stocks = []; // list of all stocks and rekomendation
    public $recommends = []; //user inputs
    public $manualRecommends = []; //user inputs
    // recomendation form edit
    private $siteRecommendations = []; // list of all rekomendation per site

    // variabel untuk edit dynamic recomend form
    public $countRecommendationId; // variabel menampung panjang array expertReportId
    public $recommendationId = []; // array meanmpung export_report_id yg sudah di extract dari model

    public function mountWithRecommendation()
    {
        $utility = new Utility; // instance kelas helper

        // preparing for recommend dropdown option
        $this->stocks = Stock::select('nama_barang AS name')
                            ->get()
                            ->toArray();
        foreach ($this->siteRecommendations as $siteRecommendation){
            if (!($utility->in_array_r($siteRecommendation['name'], $this->stocks))) {
                $this->stocks[] = $siteRecommendation;
            }
        }
    }

    public function addRecommend()
    {
        $this->recommends[] = ['name' => '', 'jumlah_unit_needed' => "1 units"];
        $this->dispatchBrowserEvent('list-added');
    }
    
    public function removeRecommend($index)
    {
        if (array_key_exists($index, $this->recommendationId)) {
            Recommendation::where('rec_id', $this->recommendationId[$index])->delete();
        }
        
        unset($this->recommends[$index]);
        array_values($this->recommends);

        //decrement the count, if not the data will be dupe
        $this->countRecommendationId--;
    }

    public function addManualRecommends ()
    {
        $this->manualRecommends[] = ['name' => '', 'jumlah_unit_needed' => "1 units"];
        $this->dispatchBrowserEvent('list-added');
    }

    public function removeManualRecommends($index)
    {
        unset($this->manualRecommends[$index]);
        array_values($this->manualRecommends);
    }

    public function setRecommendation()
    {
        // Clear Array
        unset($this->siteRecommendations);
        unset($this->recommends);
        unset($this->recommendationId);
        // Init Array
        $this->siteRecommendations = [];
        $this->recommends = [];
        $this->recommendationId = [];

        $this->recommendations = HeadReport::Where('site_id', $this->site_id)->get();
        foreach ($this->recommendations as $rcm){ //headreport
            foreach ($rcm->recommendations as $rcmItem){ //one to many relation with recomendation
                $this->siteRecommendations[] = $rcmItem;
            }
        }

        foreach ($this->siteRecommendations as $recommendation) {
            $this->recommends[] = [
                'name' => $recommendation->name,
                'jumlah_unit_needed' => $recommendation->jumlah_unit_needed];
        }

        /*
        *  Bagian ini mengextrak model kedalam array dan 
        *  menghitung jumlah record recomendation sebelumnya
        */
        foreach($this->siteRecommendations as $index => $recommendation){
            $this->recommendationId[$index] = $recommendation->rec_id;
        }
        $this->countRecommendationId = count($this->recommendationId);
    }
}