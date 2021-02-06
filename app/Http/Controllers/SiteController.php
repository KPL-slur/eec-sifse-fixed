<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function index()
    {
        $sites = DB::table('sites')
        ->get();
        return view('site.site', ['sites' => $sites]);
    }
    
    public function show($id){
        
        $stocks = DB::table('stocks')
        ->join('sites', 'stocks.site_id', '=', 'sites.site_id')
        ->where('sites.site_id', '=', $id  )
        ->get();

        return view('site.inventorie', ['stocks' => $stocks, 'id'=>$id]);
    }

    public function print($id){
        $stocks = DB::table('stocks')
        ->join('sites', 'stocks.site_id', '=', 'sites.site_id')
        ->where('sites.site_id', '=', $id  )
        ->get();

        return view('pages.inventory_site', ['stocks' => $stocks]);
    }
    
    public function add(){
        return view('site.addSite');
    }
}
