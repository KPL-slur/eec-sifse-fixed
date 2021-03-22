<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Recommendation;
use App\Models\PmBodyReport;
use App\Models\CmBodyReport;
use App\Models\HeadReport;
use App\Models\Site;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        // $pm = HeadReport::where('maintenance_type', 'pm')
        //                 ->first()
        //                 ->experts()
        //                 ->where('expert_company', 'Era Elektra Corpora Indonesia')
        //                 ->get();

        // $pm = HeadReport::where('maintenance_type', 'pm')
        // ->with(array('experts'=>function($query){
        //     $query->where('expert_company', 'Era Elektra Corpora Indonesia');
        // }))
        // ->get();

        $pm = HeadReport::take(5)
                        ->orderBy('updated_at','desc')
                        ->where('maintenance_type', 'pm')
                        ->with(['experts'=>function($query){
                            $query->select('experts.expert_id', 'name')
                                ->where('expert_company', 'Era Elektra Corpora Indonesia');
                        }])
                        ->with(['pmBodyReport'=>function($query){
                            $query->select('head_id','remark');
                        }])
                        ->with(['site'=>function($query){
                            $query->select('sites.site_id', 'station_id');
                        }])
                        ->get();

        $cm = HeadReport::take(5)
                        ->orderBy('updated_at', 'desc')
                        ->where('maintenance_type', 'cm')
                        ->with(['experts'=>function($query){
                            $query->select('experts.expert_id', 'name')
                                ->where('expert_company', 'Era Elektra Corpora Indonesia');
                        }])
                        ->with(['cmBodyReport'=>function($query){
                            $query->select('head_id','remark');
                        }])
                        ->with(['site'=>function($query){
                            $query->select('sites.site_id', 'station_id');
                        }])
                        ->get();

        // foreach($cm as $c){
        //     $c->cmBodyReport->remark = strip_tags(html_entity_decode($c->cmBodyReport->remark));
        // }
        $cm_remark = "<h1>Generating fancy text</h1><p>So perhaps, you've generated some fancy text, and you're content that you can now copy and paste your fancy text in the comments section of funny cat videos, but perhaps you're wondering how it's even possible to change the font of your text? Is it some sort of hack? Are you copying and pasting an actual font?</p><p>Well, the answer is actually no - rather than generating fancy fonts, this converter creates fancy symbols. The explanation starts with unicode; an industry standard which creates the specification for thousands of different symbols and characters. All the characters that you see on your electronic devices, and printed in books, are likely specified by the unicode standard.</p>";
        $cm_remark = strip_tags(html_entity_decode($cm_remark));
        // return $cm_remark;

        $recommends = Recommendation::take(5)
                                    ->orderBy('updated_at', 'desc')
                                    ->select('head_id','name', 'jumlah_unit_needed', 'year')
                                    ->with(['headReports'=>function($query){
                                        $query->select('head_reports.head_id', 'head_reports.site_id')
                                        ->with(['site'=>function($query1){
                                            $query1->select('sites.site_id')
                                            ->with(['stocks'=>function($query2){
                                                $query2->select('stocks.stock_id', 'stocks.nama_barang', 'stocks.jumlah_unit');
                                            }]);
                                        }]);
                                    }])
                                    ->get();
        $stocks = Stock::all();
        $stock_rec = [];
        foreach($recommends as $rcm){
            foreach($stocks as $st){
                if($rcm->name === $st->nama_barang){
                    if(!in_array($st->nama_barang, $stock_rec)){
                        // $stock_rec[] = $st->nama_barang;
                        $stock_rec["".$st->nama_barang] = $st->jumlah_unit;
                    }
                }
            }
        }
        
        return view('dashboard', compact('pm', 'cm', 'recommends', 'stock_rec'));
    }
}
