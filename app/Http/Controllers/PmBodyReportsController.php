<?php

namespace App\Http\Controllers;

use App\Models\PmBodyReport;
use App\Models\HeadReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PmBodyReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $HeadReport = HeadReport::where('maintenance_type', "pm")->get();
        $maintenance_type = "pm"; //used to determine the add new button route

        return view('tech.report.index', compact('HeadReport', 'maintenance_type'));
    }

    /**
     * Show the form for creating a new resource.
     * @param $passedHeadId
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
        PmBodyReport::create($request->all());

        return redirect()->action(
            [PmBodyReportsController::class, 'index']
        );
    }

    /**
    * Display the specified resource.
    *
    * @param \App\Models\PmBodyReport $pmBodyReport
    * @return \Illuminate\Http\Response
    */
    public function show(PmBodyReport $pmBodyReport)
    {
        $HeadReport = HeadReport::Where('id', $pmBodyReport->head_id)->get();

        return view('tech.report.pm.show', compact('pmBodyReport', 'HeadReport'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param \App\Models\PmBodyReport $pmBodyReport
    * @return \Illuminate\Http\Response
    */
    public function edit(PmBodyReport $pmBodyReport)
    {
        // dd($pmBodyReport);
        $technisians = DB::table('technisians')->get();
        return view('tech.report.edit', ['technisians' => $technisians]);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @param \App\Models\PmBodyReport $pmBodyReport
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, PmBodyReport $pmBodyReport)
    {
//
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param \App\Models\PmBodyReport $pmBodyReport
    * @return \Illuminate\Http\Response
    */
    public function destroy(PmBodyReport $pmBodyReport)
    {
//
    }
}
