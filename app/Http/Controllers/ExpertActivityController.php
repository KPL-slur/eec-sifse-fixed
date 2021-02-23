<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeadReport;
use App\Models\Site;
use Illuminate\Support\Facades\DB;

class ExpertActivityController extends Controller
{
    public function index(){
        return view('Activity.index');
    }

    public function indexPM(){
        $pm = DB::table('head_reports')
        ->join('sites', 'head_reports.site_id', '=', 'sites.site_id')
        ->where('maintenance_type', 'pm')
        ->get();
        
        return view('Activity.pmActivity.pm_activity', compact('pm'));
    }

    public function indexCM(){
        $cm = DB::table('head_reports')
        ->join('sites', 'head_reports.site_id' ,'=', 'sites.site_id')
        ->where('maintenance_type' , 'cm')
        ->get();

        return view('Activity.cmActivity.cm_activity', compact('cm'));
    }

    public function add(){
        $sites = DB::table('sites')
        ->get();

        return view('Activity.pmActivity.addPm', ['sites' => $sites]);
    }

    public function addData(Request $request){
        // $this->validate($request, [
        //     'radar_name' => 'required',
        //     'station_is' => 'required',
        //     'report_date_start' => 'required',
        //     'report_date_end' => 'required',
        // ]);
        //dd($request);
        $head_reports = new HeadReport;
        $head_reports->maintenance_type = $request->maintenance_type;
        $head_reports->site_id = $request->radar_name;
        //$sites->station_id = $request->station_id;
        $head_reports->report_date_start = $request->report_date_start;
        $head_reports->report_date_end = $request->report_date_end;
        $head_reports->save();

        return redirect('pm')->with('status1', 'Data Created!');
    }

    public function deleteData($id){
        $head_reports = DB::table('head_reports')->where('head_id',$id);
        $head_reports->delete();

        return redirect('pm')->with('status3', 'Data Deleted!');
    }

    public function editPm($id){
        $sites = DB::table('sites')
        ->get();
        $head_reports = DB::table('head_reports')
        ->where('head_id', '=', '$head_id')
        ->get();

        return view('Activity.pmActivity.editPm', compact('sites', 'head_reports'));
    }

    public function editDataPm(Request $request){
        $head_reports = DB::table('head_reports')
        ->update([
            'radar_name'=>$request->radar_name,
            'station_id'=>$request->station_id,
            'report_date_start'=>$request->report_date_start,
            'report_date_end'=>$request->report_date_end,
        ]);
        return redirect('pm')->with('status2', 'Data Updated');
    }
}
