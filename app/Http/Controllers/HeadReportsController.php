<?php

namespace App\Http\Controllers;

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
        $HeadReport = HeadReport::all();
        // dd($data);
        return view('tech.report.pm.index', compact('HeadReport'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tech.report.pm.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        HeadReport::create($request->all());

        return redirect('/report/pm')->with('status', 'Data Ditambahkan');
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
