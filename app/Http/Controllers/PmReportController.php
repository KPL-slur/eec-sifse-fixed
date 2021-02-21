<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Headreport;
use App\Models\Expert;
use App\Models\ExpertReport;
use App\Models\PmBodyReport;
use App\Models\Recommendation;

class PmReportController extends Controller
{
    private $rules = ([
        'site_id' => 'required',
        'report_date_start' => 'required',
        'report_date_end' => 'required',

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
        'running_time' => 'required',
        'radiate_time' => 'required',
        'hvps_v_0_4us' => 'required',
        'hvps_i_0_4us' => 'required',
        'mag_i_0_4us' => 'required',
        'hvps_v_0_8us' => 'required',
        'hvps_i_0_8us' => 'required',
        'mag_i_0_8us' => 'required',
        'hvps_v_1_0us' => 'required',
        'hvps_i_1_0us' => 'required',
        'mag_i_1_0us' => 'required',
        'hvps_v_2_0us' => 'required',
        'hvps_i_2_0us' => 'required',
        'mag_i_2_0us' => 'required',
        'forward_power' => 'required',
        'reverse_power' => 'required',
        'vswr' => 'required',
        'remark' => 'required',
    ]);
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maintenance_type = "pm";
        $headReports = HeadReport::where('maintenance_type', $maintenance_type)
        //select eecid expertise only
        ->with(array('experts'=>function($query){
            $query->where('expert_company','Era Elektra Corpora Indonesia');
        }))
        ->get();

        // foreach ($headReports as $hr) {
        //     foreach ($hr->experts as $expert) {
        //         dump($expert->name);
        //     }
        // }
        // dd($headReports);
        
        return view('expert.report.index', compact('headReports', 'maintenance_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $experts = Expert::all();
        // $uniqueCompany = $experts->unique('expert_company');

        // dd($experts);
        return view('expert.report.pm.create');
    }

    /**
     * Rawan akan kesalahan data, Semisal head sudah di store namun pmbodyreport gagal di store 
     * akan menyebabkan itegeritas data menjadi rusak, sehingga data yg akan dimasukan setelahnya 
     * menjadi error semua. misal akan terjadi sebuah head yg tidak memiliki body.
     * 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate($this->rules);
        
        // foreach ($request->recommends as $recommend){
        //     if ($recommend['stock_id']) {
        //         dd($recommend);
        //     }
        // }
        // dd('die');
        // dd($request->all());

        //INSERT HEADREPORT
        Headreport::create([
            'head_id' => $request->head_id,
            'site_id' => $request->site_id,
            'maintenance_type' => 'pm',
            'report_date_start' => $request->report_date_start,
            'report_date_end' => $request->report_date_end,
        ]);
        // $headId = HeadReport::select('head_id')->orderByDesc('head_id')->first()->head_id; //used to determine the head id of this report
        // $request->merge([
        //     'head_id' => $headId
        // ]);

        //INSERT EXPERTREPORT
        foreach ($request->experts as $expert) {
            if ($expert['expert_id']) {
                ExpertReport::create([
                    'head_id' => $request->head_id,
                    'expert_id' => $expert['expert_id']
                ]);
            }
        }

        //INSERT NEW EXPERT
        if ($request->manualExperts) {
            foreach ($request->manualExperts as $manualExpert){
                if ($manualExpert['expert_name']) {
                Expert::create([
                    'name' => $manualExpert['expert_name'],
                    'nip' => $manualExpert['expert_nip'],
                    'expert_company' => $manualExpert['expert_company'],
                    ]);
                    $expertId = Expert::select('expert_id')->orderByDesc('expert_id')->first()->expert_id; //used to determine the expert_id of this report
                    ExpertReport::create([
                        'head_id' => $request->head_id,
                        'expert_id' => $expertId
                    ]);
                }
            }
        }
                
        //INSERT BODY REPORT
        PmBodyReport::create($request->all());

        //INSERT RECOMENDATION
        foreach ($request->recommends as $recommend){
            if ($recommend['stock_id']) {
                Recommendation::create([
                    'head_id' => $request->head_id,
                    'stock_id' => $recommend['stock_id'],
                    'jumlah_unit_needed' => $recommend['jumlah_unit_needed'],
                ]);
            }
        }

        //INSERT MANUAL RECOMENDATION
            //DISINI NUGGU @wicak
        
        //INSERT IMAGE

        return redirect()->route('pm.index')->with('status', 'Data Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $headReport = HeadReport::Where('head_id', $id)->first();
        $pmBodyReport = HeadReport::Where('head_id', $id)->first()->pmBodyReport;
        $recommendations = HeadReport::Where('head_id', $id)->first()->recommendations;
        $reportImages = HeadReport::Where('head_id', $id)->first()->reportImages;
        // dd($reportImages);

        if (!$pmBodyReport) {
            return  'uhoh body not found, please delete this report';
        }

        return view('expert.report.pm.show', compact('pmBodyReport', 'headReport', 'recommendations', 'reportImages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Image upload view.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reportImage($id)
    {
        return view('expert/report/layout/report-images', compact('id'));
    }
}
