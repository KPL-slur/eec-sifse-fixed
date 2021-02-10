<?php

namespace App\Http\Controllers;

use App\Models\PmBodyReport;
use App\Models\HeadReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PmBodyReportsController extends Controller
{
    private $rules = ([
        'radio_general_visual' => 'required',
        'radio_rcms' => 'required',
        'radio_wipe_down' => 'required',
        'radio_inspect_all' => 'required',
        'radio_compressor_visual' => 'required',
        'radio_duty_cycle' => 'required',
        'radio_transmitter_visual' => 'required',
        'radio_receiver_visual' => 'required',
        'radio_stalo_check' => 'required',
        'radio_afc_check' => 'required',
        'radio_mrp_check' => 'required',
        'radio_rcu_check' => 'required',
        'radio_iq2_check' => 'required',
        'radio_antenna_visual' => 'required',
        'radio_inspect_motor' => 'required',
        'radio_clean_slip' => 'required',
        'radio_grease_gear' => 'required',
        'running_time' => 'required|numeric',
        'radiate_time' => 'required|numeric',
        'hvps_v_0_4us' => 'required|numeric',
        'hvps_i_0_4us' => 'required|numeric',
        'mag_i_0_4us' => 'required|numeric',
        'hvps_v_0_8us' => 'required|numeric',
        'hvps_i_0_8us' => 'required|numeric',
        'mag_i_0_8us' => 'required|numeric',
        'hvps_v_1_0us' => 'required|numeric',
        'hvps_i_1_0us' => 'required|numeric',
        'mag_i_1_0us' => 'required|numeric',
        'hvps_v_2_0us' => 'required|numeric',
        'hvps_i_2_0us' => 'required|numeric',
        'mag_i_2_0us' => 'required|numeric',
        'forward_power' => 'required|numeric',
        'reverse_power' => 'required|numeric',
        'vswr' => 'required|numeric',
        'remark' => 'required',
    ]);
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
     * @param $headId
     * @return \Illuminate\Http\Response
     */
    public function create($headId)
    {
        // dd($headId);
        return view('tech.report.pm.create', compact('headId'));
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
    * @param    $headId
    * @return \Illuminate\Http\Response
    */
    public function edit(PmBodyReport $pmBodyReport, $headId)
    {
        return view('tech.report.pm.edit', compact('pmBodyReport', 'headId'));
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
        // $attributes = $this->validate($request, $this->rules);
        // $pmBodyReport->update($attributes);

        $request->validate($this->rules);

        $input = $request->all();
        $pmBodyReport->fill($input)->save();

        return redirect()->action(
            [PmBodyReportsController::class, 'index']
        );
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
