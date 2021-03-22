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
                                    ->select('head_id','name', 'jumlah_unit_needed', 'year')
                                    ->with(['headReports'=>function($query){
                                        $query->select('head_id', 'site_id')
                                                ->with(['site'=>function($query1){
                                                    $query1->select('site_id', 'station_id');
                                                }]);
                                    }])
                                    ->get();

        $site_stocks = Site::with(['stocks'=>function($query){
                                $query->select('stocks.stock_id', 'stocks.nama_barang', 'stocks.jumlah_unit');
                            }])
                            ->get();


        // return $site_stocks;
        // return $site_stocks[0]->stocks[0]->stock_id;
        return view('dashboard', compact('pm', 'cm', 'recommends', 'site_stocks'));
    }
}
