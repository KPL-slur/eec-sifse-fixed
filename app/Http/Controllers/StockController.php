<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ValidateStockRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ExpiredStockNotificationEmail;
use App\Models\Stock;
use App\Models\Recommendation;
use App\Services\ExchangeRate;
use Carbon\Carbon;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Services\ExchangeRate $ex_rate
     * @return \Illuminate\Http\Response
     */
    public function index(ExchangeRate $ex_rate)
    {
        $stocks = Stock::all();

        $rate_fix = $ex_rate->apiCall();
        // $rate_fix = 1000.11;

        // BUAT GROUP DARI STOCKS YANG SELECT NYA
        $stocks_group = []; //inisiasi empty array stocks_group

        $stocks_group_db = DB::table('stocks')->pluck('group'); //buat ngambil semua isi column group
        foreach($stocks_group_db as $sgb){
            if(!in_array($sgb, $stocks_group)){
                array_push($stocks_group, $sgb);
            }
        }
        
        return view('stocks.index', compact('stocks', 'rate_fix', 'stocks_group'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Services\ExchangeRate $ex_rate
     * @return \Illuminate\Http\Response
     */
    public function create(ExchangeRate $ex_rate)
    {
        $rate_fix = $ex_rate->apiCall();
        // $rate_fix = 1000.11;

        // BUAT GROUP DARI STOCKS YANG SELECT NYA
        $stocks_group = []; //inisiasi empty array stocks_group

        $stocks_group_db = DB::table('stocks')->pluck('group'); //buat ngambil 1 isi column group

        foreach($stocks_group_db as $sgb){
            if(!in_array($sgb, $stocks_group)){
                array_push($stocks_group, $sgb);
            }
        }

        return view('stocks.create', compact('rate_fix','stocks_group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ValidateStockRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateStockRequest $request)
    {
        // dd($request);
        Stock::create($request->validated());

        return redirect('stocks')->with('status1','Data berhasil ditambah!');
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
     * @param \App\Services\ExchangeRate $ex_rate
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock, ExchangeRate $ex_rate)
    {
        $rate_fix = $ex_rate->apiCall();
        $rate_fix = 1000.11;

        $stock = Stock::where('stocks.stock_id', $stock->stock_id)
                            ->first();

        // dd($siteAndStock);

        $sites = DB::table('sites')
                    ->select('site_id', 'station_id')
                    ->get();
        // dd($sites);

        // BUAT GROUP DARI STOCKS YANG BAGIAN SELECT
        $stocks_group = []; //inisiasi empty array stocks_group

        $stocks_group_db = DB::table('stocks')->pluck('group'); //buat ngambil 1 isi column group

        foreach($stocks_group_db as $sgb){
            if(!in_array($sgb, $stocks_group)){
                array_push($stocks_group, $sgb);
            }            
        }
        
        return view('stocks.edit', compact('stock', 'sites' , 'rate_fix', 'stocks_group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock $stock
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateStockRequest $request, Stock $stock)
    {

        Stock::find($stock->stock_id)->update($request->validated());

        return redirect('stocks')->with('status2', 'Data berhasil di update');
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
        return redirect('/stocks')->with('status0', 'Data '.$stock->nama.' berhasil di hapus');
    }

    /**
     * for reports stocks according input start date & end date
     * 
     * @param \Illuminate\Http\Request;
     * @return \Illuminate\Http\Response
     */
    public function report(Request $request){
        $stocks = Stock::whereBetween('tgl_masuk', [$request->query('date-start'), $request->query('date-end')])
                    ->get();

        return $stocks;

        return view('stocks.print', compact('stocks'));
    }

    /**
     * 
     * 
     * take recommendations into stocks view
     */
    public function showRecommendation(){
        $recommendations = Recommendation::select('sites.radar_name', 'sites.station_id', 'recommendations.name', 'recommendations.jumlah_unit_needed', 'year')
                                            ->join('head_reports', 'recommendations.head_id', 'head_reports.head_id')
                                            ->join('sites', 'head_reports.site_id', 'sites.site_id')
                                            ->get();
        $rcm_year = [];
        
        $years = DB::table('recommendations')->pluck('year');
        foreach($years as $year){
            if(!in_array($year, $rcm_year)){
                array_push($rcm_year, $year);
            }
        }

        return view('stocks.recommendation', compact('recommendations', 'rcm_year', 'years'));
    }

}
