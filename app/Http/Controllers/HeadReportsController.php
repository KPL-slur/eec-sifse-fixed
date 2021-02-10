<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\HeadReport;
use Illuminate\Http\Request;

class HeadReportsController extends Controller
{
    private $rules = ([
        'radar_name' => 'required',
        'station_id' => 'required',
        'report_date_start' => 'required',
        'report_date_end' => 'required',
        'expertise1' => 'required',
        'expertise4' => 'required',
        'expertise_company4' => 'required',
    ]);

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
        $request->validate($this->rules);

        HeadReport::create($request->all());

        $maintenance_type = $request->maintenance_type; //used to determine the next report form

        $queryHeadId = HeadReport::select('id')->orderByDesc('id')->first(); //used to determine the head id of this report
        $headId = $queryHeadId->id;

        // return view('tech.report.'.$maintenance_type.'.create', compact('headId'));  //not working with validation
        switch ($maintenance_type) {
            case 'pm':
                return redirect()->action(
                    [PmBodyReportsController::class, 'create'],
                    ['headId' => $headId]
                );
                break;
            
            case 'cm':
                return redirect()->action(
                    [CmBodyReportsController::class, 'create'],
                    ['headId' => $headId]
                );
                break;
            
            default:
                return redirect()->route('tech');
                break;
        }
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
        $technisians = DB::table('technisians')->get();
        return view('tech.report.edit', compact('headReport', 'technisians'));
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
        
        // HeadReport::where('id', $headReport->id)
        // ->update($request->all());

        // $attributes = $this->validate($request, $this->rules);
        // $headReport->update($attributes);

        $request->validate($this->rules);

        $input = $request->all();
        $headReport->fill($input)->save();

        $maintenance_type = $request->maintenance_type; //used to determine the next report form

        $headId = $headReport->id;

        $QueryBodyId = DB::table($maintenance_type . '_body_reports')
        // ->select('id')
        ->where('head_id', $headId)
        ->first();
        $bodyId = $QueryBodyId->id;
        // return view('tech.report.'.$maintenance_type.'.create', compact('headId'));  //not working with validation
        switch ($maintenance_type) {
            case 'pm':
                return redirect()->action(
                    [PmBodyReportsController::class, 'edit'],
                    ['pmBodyReport' => $bodyId, 'headId' => $headId]
                );
                break;
            
            case 'cm':
                return redirect()->action(
                    [CmBodyReportsController::class, 'edit'],
                    ['cmBodyReport' => $bodyId, 'headId' => $headId]
                );
                break;
            
            default:
                return redirect()->route('tech');
                break;
        }
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
