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
        
        foreach($pm as $p){
            $p->pmBodyReport->remark = html_entity_decode($p->pmBodyReport->remark); //decode dari kode html ke string biasa
            if(strripos($p->pmBodyReport->remark, "kesimpulan")){
                $pos_kesimpulan = strripos($p->pmBodyReport->remark, "kesimpulan"); //cari posisi terakhir dari kata kesimpulan di string remark
                $p->pmBodyReport->remark = substr($p->pmBodyReport->remark, $pos_kesimpulan); // ngambil substring dari posisi kesimpulan ke belakang
                $pos_ul_kesimpulan = stripos($p->pmBodyReport->remark, "</ul>"); //nyari posisi </ul> kesimpulan
                $p->pmBodyReport->remark = substr($$p->pmBodyReport->remark, 0, $pos_ul_kesimpulan + 5); // taro dalem remark, ilangin string setelah </ul>
            } else {
                $p->pmBodyReport->remark = "Tidak dapat ditarik kesimpulan dalam remark PM ini";
            }
        }
        
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

        foreach($cm as $c){
            $c->cmBodyReport->remark = html_entity_decode($c->cmBodyReport->remark); //decode dari kode html ke string biasa
            if(strripos($c->cmBodyReport->remark, "kesimpulan")){
                $pos_kesimpulan = strripos($c->cmBodyReport->remark, "kesimpulan"); //cari posisi terakhir dari kata kesimpulan di string remark
                $c->cmBodyReport->remark = substr($c->cmBodyReport->remark, $pos_kesimpulan); // ngambil substring dari posisi kesimpulan ke belakang
                $pos_ul_kesimpulan = stripos($c->cmBodyReport->remark, "</ul>"); //nyari posisi </ul> kesimpulan
                $c->cmBodyReport->remark = substr($c->cmBodyReport->remark, 0, $pos_ul_kesimpulan + 5);  // taro dalem remark, ilangin string setelah </ul>
            }else{
                $c->cmBodyReport->remark = "Tidak dapat ditarik kesimpulan dalam remark CM ini";
            }
        }


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
                    if(!in_array($st->nama_barang, $stock_rec)){ //gatau kenapa ini works padahal nama barang jadi key
                        // $stock_rec[] = $st->nama_barang;
                        $stock_rec["".$st->nama_barang] = $st->jumlah_unit;
                    }
                }
            }
        }
        
        return view('dashboard', compact('pm', 'cm', 'recommends', 'stock_rec'));
    }
}
