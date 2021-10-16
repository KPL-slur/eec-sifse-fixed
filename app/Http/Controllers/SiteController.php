<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreSiteRequest;
use App\Http\Requests\ValidateInventoryRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Site;
use App\Models\SitedStock;
use App\Models\Stock;

class SiteController extends Controller
{
    public function index()
    {
        $sites = DB::table('sites')
        ->orderBy('station_id', 'asc')
        ->get();
        return view('site.site', compact('sites'));
    }

    public function show($id_site){
        $sites = DB::table('sites')
        //->select('radar_name')
        ->where('sites.site_id', '=', $id_site)
        ->first();
        //dd($sites);

        $stocks = DB::table('stocks')
        ->join('sited_stocks', 'stocks.stock_id', '=', 'sited_stocks.stock_id')
        ->join('sites', 'sited_stocks.site_id', '=', 'sites.site_id')
        ->where('sites.site_id', '=', $id_site)
        ->get();
        // dd($stocks);

        $stocks_group = [];

        $groups = DB::table('stocks')->pluck('group');
        foreach($groups as $grp){
            if(!in_array($grp, $stocks_group)){
                array_push($stocks_group, $grp);
            }
        }

        return view('site.inventory', compact('sites', 'stocks', 'stocks_group'));
    }

    public function print($id_site){
        $stocks = DB::table('stocks')
        ->join('sited_stocks', 'stocks.stock_id', '=', 'sited_stocks.stock_id')
        ->join('sites', 'sited_stocks.site_id', '=', 'sites.site_id')
        ->where('sites.site_id', '=', $id_site)
        ->get();
        // dd($stocks);

        return view('pages.inventory_site', compact('stocks'));
    }

    public function add(){
        $stocks = Stock::all();

        return view('site.addSite', compact('stocks'));
    }

    public function addData(StoreSiteRequest $request){

        //INSERT NEW SITE

        // Site::create([
        //     'radar_name' => $request->radar_name,
        //     'station_id' => $request->station_id,
        //     'image' => null
        //     ]);

        $file = $request->file('image');
        if(!file_exists($file)){
            // $name = 'default.png';
            // $path = $file->storeAs('public/image', $name);

            Site::create([
                'radar_name' => $request->radar_name,
                'station_id' => $request->station_id,
                'image' => null
            ]);
        }
        else{
            $name = $file->getClientOriginalName();
            $file->storeAs('public/image', $name);

            Site::create([
                'radar_name' => $request->radar_name,
                'station_id' => $request->station_id,
                'image' => $name
            ]);
        }
        foreach ($request->stocks as $index => $stock) {
            $request->validate([
                'stocks.'.$index.'.stock_id' => 'required'
            ], ['required'=>'This field is required']);
            if ($stock['stock_id']) {

                $sitedstocks = new SitedStock;
                $sitedstocks->site_id = DB::table('sites')->latest()->first()->site_id;
                $sitedstocks->stock_id = $stock['stock_id'];
                $sitedstocks->save();

                DB::table('stocks')
                ->where('stock_id', '=', $stock['stock_id'])
                ->decrement('jumlah_unit');

            }
        }
        $sites = DB::table('sites')
        ->select('site_id')
        ->latest()
        ->first();

        $request->validated();

        return redirect('inventory/'.$sites->site_id)->with('status1', 'Data Created!');
    }

    public function addInventorySite($id_site){

        $sites = DB::table('sites')
        ->where('sites.site_id', '=', $id_site)
        ->first();
        //dd($sites);

        // $stocks = DB::table('stocks')
        // ->get();

        $stocks = Stock::all();

        return view('site.create', compact('sites', 'stocks'));
     }

     public function addDataInventorySite(Request $request){

        // $stocks = new Stock;
        // $stocks->nama_barang = $request->nama_barang;
        // $stocks->group = $request->group;
        // $stocks->part_number = $request->part_number;
        // $stocks->serial_number = $request->serial_number;
        // $stocks->tgl_masuk = $request->tgl_masuk;
        // $stocks->expired = $request->expired;
        // $stocks->save();

        // $sitedstocks = new SitedStock;
        // $sitedstocks->stock_id = DB::table('stocks')->latest()->first()->stock_id;
        // $sitedstocks->site_id = $request->site_id;
        // $sitedstocks->save();

        //INSERT SITEDSTOCK TO SITE
        foreach ($request->stocks as $index => $stock) {
            $request->validate([
                'stocks.'.$index.'.stock_id' => 'required'
            ], ['required'=>'This field is required']);
            if ($stock['stock_id']) {

                $sitedstocks = new SitedStock;
                $sitedstocks->site_id = $request->site_id;
                $sitedstocks->stock_id = $stock['stock_id'];
                $sitedstocks->save();

                $stocks = DB::table('stocks')
                ->where('stock_id', '=', $stock['stock_id'])
                ->decrement('jumlah_unit');
            }
        }
        // dd($request);

        // $validated = $request->validated();

        return redirect('inventory/'.$request->site_id)->with('status1', 'Data Created!');
     }

    public function editInventorySite(SitedStock $sitedstock){
        // dd($sitedstock);
        $sites = Site::where('site_id', $sitedstock->site_id)
        ->first();
        // dd($sites);

        $stocks = Stock::where('stock_id', $sitedstock->stock_id)
        ->first();

        $stocks_group = [];

        $groups = DB::table('stocks')->pluck('group');
        foreach($groups as $grp){
            if(!in_array($grp, $stocks_group)){
                array_push($stocks_group, $grp);
            }
        }

        return view('site.edit', compact('sites', 'stocks', 'stocks_group', 'groups'));
     }

    public function editDataInventorySite(ValidateInventoryRequest $request, Stock $stock){
        //dd($request);
        Stock::find($stock->stock_id)
        ->update($request->validated()
        // (
        //     [
        //         'nama_barang'=>$request->nama_barang,
        //         'group'=>$request->group,
        //         'part_number'=>$request->part_number,
        //         'serial_number'=>$request->serial_number,
        //         'tgl_masuk'=>$request->tgl_masuk,
        //         'expired'=>$request->expired
        //     ]
        // )
    );

        return redirect('inventory/'.$request->site_id)->with('status2', 'Data Edited!');
     }

    public function destroyInventorySite(SitedStock $sitedstock, Request $request){
        $sites = $sitedstock->site_id;
        SitedStock::destroy($sitedstock->sited_stock_id);

        return redirect('inventory/'.$sites)->with('status3', 'Data Deleted!');
    }

    public function destroySite($id_site){
        $sites = DB::table('sites')->where('site_id',$id_site);
        $sites->delete();

        return redirect('site')->with('status3', 'Data Deleted!');
    }
}
