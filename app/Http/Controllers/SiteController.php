<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Site;

class SiteController extends Controller
{
    public function index()
    {
    
        $sites = DB::table('sites')
        ->get();
        return view('site.site', ['sites' => $sites]);
    }
    
    public function show($id){
        $sites = DB::table('sites')
        ->select('radar_name')
        ->where('sites.site_id', '=', $id)
        ->first();
        //dd($sites);
        

        $stocks = DB::table('stocks')
        ->join('sites', 'stocks.site_id', '=', 'sites.site_id')
        ->where('sites.site_id', '=', $id)
        ->get();
        //dd($stocks);

        return view('site.inventorie', compact('sites', 'stocks'));
    }

    public function print($id){
        $stocks = DB::table('stocks')
        ->join('sites', 'stocks.site_id', '=', 'sites.site_id')
        ->where('sites.site_id', '=', $id)
        ->get();
        //dd($stocks);

        return view('pages.inventory_site', compact('stocks'));
    }
    
    public function add(){
        return view('site.addSite');
    } 

    public function addData(Request $request){
        $file = $request->file('image');
        $name = $file->getClientOriginalName();
        $path = $file->storeAs('public/image', $name);
        $sites =  new Site;
        $sites->image = $name;
        $sites->radar_name = $request->radar_name;
        $sites->station_id = $request->station_id;
        $sites->save();
    
        return redirect('site')->with('success', 'Data Created!');
    }
}
