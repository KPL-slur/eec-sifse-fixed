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
        // $stocks = DB::table('stocks')->get();
        $stocks = Stock::select()
                        // ->leftJoin('sites', 'sites.site_id', '=', 'stocks.site_id')
                        // ->orderBy('group', 'asc')
                        ->get();

        $rate_fix = $ex_rate->apiCall();

        return view('stocks_currencies.index', compact('stocks', 'rate_fix'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Services\ExchangeRate $ex_rate
     * @return \Illuminate\Http\Response
     */
    public function create(ExchangeRate $ex_rate)
    {
        // $sites = DB::table('sites')
        //             ->select('site_id','station_id')
        //             ->get();

        $rate_fix = $ex_rate->apiCall();
        return view('stocks_currencies.create', compact('rate_fix',));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ValidateStockRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateStockRequest $request)
    {        
        // validasi
        // $validated = $request->validated();
        Stock::create($request->validated());

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
     * @param \App\Services\ExchangeRate $ex_rate
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock, ExchangeRate $ex_rate)
    {
        // $stock_data = Stock::where('stock_id');
        $rate_fix = $ex_rate->apiCall();

        // $siteAndStock = DB::table('stocks')
        //                     // ->select('stocks.site_id', 'station_id', 'stock_id', 'nama_barang', 'group', 'part_number','serial_number', 'tgl_masuk', 'expired', 'kurs_beli', 'jumlah_unit', 'status')
        //                     // ->leftJoin('sites', 'stocks.site_id', '=', 'sites.site_id')
        //                     ->where('stocks.stock_id', $stock->stock_id)
        //                     ->first();
        $siteAndStock = Stock::where('stocks.stock_id', $stock->stock_id)
                            ->first();

        // dd($siteAndStock);

        $sites = DB::table('sites')
                    ->select('site_id', 'station_id')
                    ->get();
        // dd($sites);

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
     * @param  \App\Models\Stock $stock
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateStockRequest $request, Stock $stock)
    {
        //belom nambah validasi
        // dd($request);

        Stock::find($stock->stock_id)->update($request->validated());

        // $stock_where = Stock::where('stock_id', $stocks->stock_id)
        //             ->update([
        //                 'nama_barang'=>$request->nama_barang,
        //                 'group'=>$request->group,
        //                 'part_number'=>$request->part_number,
        //                 'serial_number'=>$request->serial_number,
        //                 'tgl_masuk'=>$request->tgl_masuk,
        //                 'expired'=>$request->expired,
        //                 'kurs_beli'=>$request->kurs_beli,
        //                 'jumlah_unit'=>$request->jumlah_unit,
        //                 'status'=>$request->status
        //             ]);

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

    /**
     * for reports stocks according input start date & end date
     * 
     * 
     */
    public function report($date_start, $date_end){
        $siteAndStock = DB::table('sites')
                            ->rightJoin('stocks', 'sites.site_id', '=', 'stocks.site_id')
                            ->whereBetween('tgl_masuk', [$date_start, $date_end])
                            ->get();

        // dd($siteAndStock);

        return view('stocks_currencies.print', compact('siteAndStock'));
    }

    /**
     * 
     * 
     * take recommendations into stocks view
     */
    public function showRecommendation(){
        // $recommendations =  DB::table('recommendations')
        // ->join('head_reports', 'recommendations.head_id', '=', 'head_reports.head_id')
        // ->join('stocks', 'recommendations.stock_id', '=', 'stocks.stock_id')
        // ->join('sites', 'stocks.site_id', '=', 'sites.site_id')
        // ->get();

        $recommendations = Recommendation::select()
                                        ->join('head_reports', 'head_reports.head_id', '=', 'recommendations.head_id')
                                        ->join('sites', 'sites.site_id' , '=', 'head_reports.site_id')
                                        ->join('stocks', 'stocks.stock_id' , '=', 'recommendations.stock_id')
                                        ->get()
                                            
                                        ;

        // dd($recommendations);

        return view('stocks_currencies.recommendation', compact('recommendations'));
    }

    public function sendEmail(){
        $to_email = "wicaklearn@gmail.com";

        Mail::to($to_email)
            ->send(new ExpiredStockNotificationEmail);

        if(Mail::failures() != 0) {
            return "<p> Success! Your E-mail has been sent.</p>";
        } else {
            return "<p> Failed! Your E-mail has not sent.</p>";
        }
    }

}
