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
        $pm_home = HeadReport::take(5)
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

        $cm_home = HeadReport::take(5)
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
        //nama recommendation sama kyk nama di stocks, masuk ke array baru
        foreach($recommends as $rcm){
            foreach($stocks as $st){
                if($rcm->name === $st->nama_barang){
                    if(!in_array($st->nama_barang, $stock_rec)){ //gatau kenapa ini works padahal nama barang jadi key
                        // $stock_rec[] = $st->nama_barang;
                        $stock_rec["".$st->nama_barang] = $st->jumlah_unit;
                    }
                }
            }
            //kalo misalkan nama recommendations blm ada di stock_rec, masukin dgn value 0
            if(!array_key_exists($rcm->name, $stock_rec)){
                $stock_rec["".$rcm->name] = 0;
            }
        }

        return view('dashboard', compact('pm_home', 'cm_home', 'recommends', 'stock_rec'));
    }
}
