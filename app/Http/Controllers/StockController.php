<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Stock;
use App\Services\ExchangeRate;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ExchangeRate $ex_rate)
    {
        // $stocks = DB::table('stocks')->get();
        $stocks = Stock::select()
                        ->leftJoin('sites', 'sites.site_id', '=', 'stocks.site_id')
                        ->orderBy('group', 'asc')
                        ->get();

        $rate_fix = $ex_rate->apiCall();

        return view('stocks_currencies.index', compact('stocks', 'rate_fix'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ExchangeRate $ex_rate)
    {
        $sites = DB::table('sites')
                    ->select('site_id','site')
                    ->get();

        $rate_fix = $ex_rate->apiCall();        
        return view('stocks_currencies.create', compact('rate_fix', 'sites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //belom nambah validas
        Stock::create($request->all());
        
        return redirect('stock_currency')->with('status1','Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock, ExchangeRate $ex_rate)
    {
        // $stock_data = Stock::where('stock_id');
        $rate_fix = $ex_rate->apiCall();

        $siteAndStock = DB::table('sites')
                            ->select()
                            ->rightJoin('stocks', 'sites.site_id', '=', 'stocks.site_id')
                            ->where('sites.site_id', '=', $stock->site_id)
                            ->where('stocks.stock_id', '=', $stock->stock_id)
                            ->first();

        $sites = DB::table('sites')
                    ->select('site_id', 'station_id')
                    ->get();

        // dd($siteAndStock);

        // $stocks = [
        //     'site_id' => $stock->site_id,
        //     'nama_barang' => $stock->nama_barang,
        //     'part_number' => $stock->part_number,
        //     'serial_number' => $stock->serial_number,
        //     'tgl_masuk' => $stock->tgl_masuk,
        //     'expired' => $stock->expired,
        //     'kurs_beli' => $stock->kurs_beli,
        //     'jumlah_unit' => $stock->jumlah_unit,
        // ];

        return view('stocks_currencies.edit', compact('siteAndStock', 'sites' , 'rate_fix'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stocks)
    {
        //belom nambah validasi
        // dd($request);
        $stock_where = Stock::where('stock_id', $stocks->stock_id)
                    ->update([
                        'site_id'=>$request->site_id,
                        'nama_barang'=>$request->nama_barang,
                        'group'=>$request->group,
                        'part_number'=>$request->part_number,
                        'serial_number'=>$request->serial_number,
                        'tgl_masuk'=>$request->tgl_masuk,
                        'expired'=>$request->expired,
                        'kurs_beli'=>$request->kurs_beli,
                        'jumlah_unit'=>$request->jumlah_unit,
                        'status'=>$request->status
                    ]);

        return redirect('stock_currency')->with('status2', 'Data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        // dd($stock);
        Stock::destroy($stock->stock_id);
        return redirect('/stock_currency')->with('status0', 'Data '.$stock->nama.' berhasil di hapus');
    }
}
