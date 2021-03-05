<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreSiteRequest;
use App\Http\Requests\ValidateInventoryRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Site;
use App\Models\SitedStock;
use App\Models\Stock;

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
        //->select('radar_name')
        ->where('sites.site_id', '=', $id)
        ->first();
        //dd($sites);
        
        $stocks = DB::table('stocks')
        ->join('sited_stocks', 'stocks.stock_id', '=', 'sited_stocks.stock_id')
        ->join('sites', 'sited_stocks.site_id', '=', 'sites.site_id')
        ->where('sites.site_id', '=', $id)
        ->get();
        // dd($stocks);

        return view('site.inventorie', compact('sites', 'stocks'));
    }

    public function print($id){
        $stocks = DB::table('stocks')
        ->join('sited_stocks', 'stocks.stock_id', '=', 'sited_stocks.stock_id')
        ->join('sites', 'sited_stocks.site_id', '=', 'sites.site_id')
        ->where('sites.site_id', '=', $id)
        ->get();
        dd($stocks);

        return view('pages.inventory_site', compact('stocks'));
    }
    
    public function add(){
        return view('site.addSite');
    } 

    public function addData(StoreSiteRequest $request){
        $validated = $request->validated();

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

    public function addInventorySite($id){
        $sites = DB::table('sites')
        ->where('sites.site_id', '=', $id)
        ->first();
        //dd($sites);

        $stocks = DB::table('stocks')
        ->get();

        return view('site.create', compact('sites', 'stocks'));
     }

     public function addDataInventorySite(ValidateInventoryRequest $request){
        $stocks = new Stock; 
        $stocks->nama_barang = $request->nama_barang;
        $stocks->group = $request->group;
        $stocks->part_number = $request->part_number;
        $stocks->serial_number = $request->serial_number;
        $stocks->tgl_masuk = $request->tgl_masuk;
        $stocks->expired = $request->expired;
        $stocks->save();

        $sitedstocks = new SitedStock;
        $sitedstocks->stock_id = DB::table('stocks')->latest()->first()->stock_id;
        $sitedstocks->site_id = $request->site_id;
        $sitedstocks->save();

        $validated = $request->validated();

        return redirect('inventory/'.$request->site_id)->with('status1', 'Data Created!');
     }

    public function editInventorySite(SitedStock $sitedstock){
        // dd($sitedstock);
        $sites = Site::where('site_id', $sitedstock->site_id)
        ->first();
        // dd($sites);

        $stocks = Stock::where('stock_id', $sitedstock->stock_id)
        ->first();

        return view('site.edit', compact('sites', 'stocks'));
     }

    public function editDataInventorySite(ValidateInventoryRequest $request, Stock $stock){
        //dd($request);
        //dd($stock);
        $stocks = Stock::find($stock->stock_id)
        ->update($request->validated()(
            [
                'nama_barang'=>$request->nama_barang,
                'group'=>$request->group,
                'part_number'=>$request->part_number,
                'serial_number'=>$request->serial_number,
                'tgl_masuk'=>$request->tgl_masuk,
                'expired'=>$request->expired       
            ])
    );
        
        return redirect('inventory/'.$request->site_id)->with('status2', 'Data Edited!');
     }

    public function destroyInventorySite(SitedStock $sitedstock, Request $request){
        $sites = $sitedstock->site_id;
        $stocks = SitedStock::destroy($sitedstock->sited_stock_id);

        return redirect('inventory/'.$sites)->with('status3', 'Data Deleted!');
     }
}
