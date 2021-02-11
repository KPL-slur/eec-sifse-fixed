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
     * @param $headId
     * @return \Illuminate\Http\Response
     */
    public function create($headId)
    {
        return view('tech.report.cm.create', compact('headId'));
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

        // return redirect()->action(
        //     [CmBodyReportsController::class, 'index']
        // );

        $queryHeadId = HeadReport::select('id')->orderByDesc('id')->first(); //used to determine the head id of this report
        $headId = $queryHeadId->id;
        
        return redirect()->action(
            [RecommendationsController::class, 'create'],
            ['headId' => $headId]
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
     * @param   $headId
     * @return \Illuminate\Http\Response
     */
    public function edit(CmBodyReport $cmBodyReport, $headId)
    {
        return view('tech.report.cm.edit', compact('cmBodyReport', 'headId'));
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
        $request->validate($this->rules);

        $input = $request->all();
        $cmBodyReport->fill($input)->save();

        return redirect()->action(
            [CmBodyReportsController::class, 'index']
        );
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
