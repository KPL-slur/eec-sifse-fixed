<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Utility;
use App\Models\HeadReport;
use App\Models\PmBodyReport;
use App\Models\Site;
use App\Models\Expert;
use Illuminate\Support\Facades\DB;

class ExpertActivityController extends Controller
{
    public function index(){
        return view('Activity.index');
    }

    public function indexActivity($maintenance_type){
        $reports = HeadReport::where('maintenance_type', $maintenance_type)
        ->with(array('experts'=>function($query){
            $query->where('expert_company', 'Era Elektra Corpora Indonesia');
        }))
        ->with('site')
        ->orderBy('head_id', 'desc')
        ->get();
        // return $pm;
        
        return view('Activity.activity', compact('reports', 'maintenance_type'));
    }

    public function show($maintenance_type, $id, Utility $utility){
        $headReport = HeadReport::Where('head_id', $id)->first();
        abort_unless($headReport, 404, 'Report not found');
        $date = $utility->easyToReadDate($headReport->report_date_start, $headReport->report_date_end);

        switch ($maintenance_type) {
            case 'pm' :
                $bodyReport = $headReport->pmBodyReport;
                abort_unless($bodyReport, 404, 'Report not found');
                break;
            
            case 'cm' :
                $bodyReport = $headReport->cmBodyReport;
                abort_unless($bodyReport, 404, 'Report not found');
                break;
        }
    
        $recommendations = $headReport->recommendations()->withTrashed()->get();
        $reportImages = $headReport->reportImages;

        if ($headReport->printedReport) {
            $fileName = explode("/", $headReport->printedReport->file)[1]; // return "namafile.pdf" without "cm/"
        } else {
            $fileName = '';
        }

        return view('Activity.show', compact('headReport', 'date', 'bodyReport', 'recommendations', 'reportImages', 'fileName', 'maintenance_type'));
    }


    // public function destroyPm($id){
    //     $head_reports = DB::table('head_reports')->where('head_id',$id);
    //     $head_reports->delete();

    //     return redirect('pm')->with('status3', 'Data Deleted!');
    // }

    // public function add(){
    //     $sites = DB::table('sites')
    //     ->get();

    //     return view('Activity.pmActivity.addPm', ['sites' => $sites]);
    // }

    // public function addData(Request $request){
    //     // $this->validate($request, [
    //     //     'radar_name' => 'required',
    //     //     'station_is' => 'required',
    //     //     'report_date_start' => 'required',
    //     //     'report_date_end' => 'required',
    //     // ]);
    //     //dd($request);
    //     $head_reports = new HeadReport;
    //     $head_reports->maintenance_type = $request->maintenance_type;
    //     $head_reports->site_id = $request->radar_name;
    //     //$sites->station_id = $request->station_id;
    //     $head_reports->report_date_start = $request->report_date_start;
    //     $head_reports->report_date_end = $request->report_date_end;
    //     $head_reports->save();

    //     return redirect('pm')->with('status1', 'Data Created!');
    // }


    // public function editPm($id){
    //     $sites = DB::table('sites')
    //     ->get();
    //     $head_reports = DB::table('head_reports')
    //     ->where('head_id', '=', '$head_id')
    //     ->get();

    //     return view('Activity.pmActivity.editPm', compact('sites', 'head_reports'));
    // }

    // public function editDataPm(Request $request){
    //     $head_reports = DB::table('head_reports')
    //     ->update([
    //         'radar_name'=>$request->radar_name,
    //         'station_id'=>$request->station_id,
    //         'report_date_start'=>$request->report_date_start,
    //         'report_date_end'=>$request->report_date_end,
    //     ]);
    //     return redirect('pm')->with('status2', 'Data Updated');
    // }
}
