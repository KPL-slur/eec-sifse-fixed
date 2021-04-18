<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ValidateStockRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Stock;
use App\Models\Recommendation;
use App\Services\ExchangeRate;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ex_rate = new ExchangeRate;
        $stocks = Stock::all();

        $rate_fix = $ex_rate->apiCall();
      
        return view('stocks.index', compact('stocks', 'rate_fix'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ex_rate = new ExchangeRate;
        $rate_fix = $ex_rate->apiCall();

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
        Stock::create($request->validated());

        return redirect('stocks')->with('status1','Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        $ex_rate = new ExchangeRate;
        $rate_fix = $ex_rate->apiCall();

        $stock = Stock::where('stocks.stock_id', $stock->stock_id)
                            ->first();

        // BUAT GROUP DARI STOCKS YANG BAGIAN SELECT
        $stocks_group = []; //inisiasi empty array stocks_group

        $stocks_group_db = DB::table('stocks')->pluck('group'); //buat ngambil 1 isi column group

        foreach($stocks_group_db as $sgb){
            if(!in_array($sgb, $stocks_group)){
                array_push($stocks_group, $sgb);
            }            
        }
        
        return view('stocks.edit', compact('stock', 'rate_fix', 'stocks_group'));
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

        return view('stocks.recommendation', compact('recommendations'));
    }

}
