<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\HeadReport;
use Illuminate\Http\Request;

class HeadReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //NOT USED
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $technisians = DB::table('technisians')->get();
        return view('tech.report.create', ['technisians' => $technisians]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'radar_name' => 'required',
            'station_id' => 'required',
            'report_date_start' => 'required',
            'report_date_end' => 'required',
            'expertise1' => 'required',
            'expertise4' => 'required',
            'expertise_company4' => 'required',
        ]);

        HeadReport::create($request->all());

        $maintenance_type = $request->maintenance_type; //used to determine the next report form

        $KontainerIdUntukNanti = HeadReport::select('id')->orderByDesc('id')->first(); //used to determine the head id of this report
        $headId = $KontainerIdUntukNanti->id;

        return view('tech.report.'.$maintenance_type.'.create', compact('headId'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HeadReport  $headReport
     * @return \Illuminate\Http\Response
     */
    public function show(HeadReport $headReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HeadReport  $headReport
     * @return \Illuminate\Http\Response
     */
    public function edit(HeadReport $headReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HeadReport  $headReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HeadReport $headReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HeadReport  $headReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(HeadReport $headReport)
    {
        //
    }
}
