<?php

namespace App\Http\Controllers;

use App\Models\CmBodyReport;
use App\Models\HeadReport;
use Illuminate\Http\Request;

class CmBodyReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $HeadReport = HeadReport::where('maintenance_type', "cm")->get();
        $maintenance_type = "cm"; //used to determine the add new button route

        return view('tech.report.index', compact('HeadReport', 'maintenance_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //NEVER USED because the view already called after headreport's store method
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        CmBodyReport::create($request->all());

        return redirect()->action(
            [CmBodyReportsController::class, 'index']
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CmBodyReport  $cmBodyReport
     * @return \Illuminate\Http\Response
     */
    public function show(CmBodyReport $cmBodyReport)
    {
        $HeadReport = HeadReport::Where('id', $cmBodyReport->head_id)->get();

        return view('tech.report.cm.show', compact('cmBodyReport', 'HeadReport'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CmBodyReport  $cmBodyReport
     * @return \Illuminate\Http\Response
     */
    public function edit(CmBodyReport $cmBodyReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CmBodyReport  $cmBodyReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CmBodyReport $cmBodyReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CmBodyReport  $cmBodyReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(CmBodyReport $cmBodyReport)
    {
        //
    }
}
