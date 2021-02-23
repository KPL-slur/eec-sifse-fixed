<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Distribution;

class DistributionController extends Controller
{
    public function index(){
        
        $distributions = DB::table('experts')
        ->join('distributions', 'experts.expert_id', '=', 'distributions.expert_id')
        ->join('sites', 'sites.site_id', '=', 'distributions.site_id')
        ->get();

        return view('distribution.distribution', compact('distributions'));
    }

    public function edit($id){
                
        $sites = DB::table('sites')
        ->get();
        $experts = DB::table('experts')
        ->where('expert_id','=',$id)
        ->get();
    
        return view('distribution.edit', compact('experts', 'sites'));
    }

    public function editData(Request $request){
        $distributions = DB::table('distributions')
        ->where('expert_id', '=', $request->expert_id)
        ->update([
            'site_id' => $request->site_id
        ]);
        return redirect('distribution')->with('status2', 'Data Updated!');
    }

    public function deleteData($id){
        $distributions = DB::table('distributions')->where('dist_id',$id);
        $distributions->delete();
        return redirect('distribution')->with('status3', 'Data Deleted!');
    }

    public function add(){
        $experts = DB::table('experts')
        ->get();
        $sites = DB::table('distributions')
        ->rightJoin('sites', 'sites.site_id', '=', 'distributions.site_id')
        //->whereNull('expert_id')
        ->get();
        return view('distribution.add', compact('experts', 'sites'));
    }

    public function addData(Request $request){
        $distributions = new Distribution;
        $distributions->expert_id = $request->expert_id;
        $distributions->site_id = $request->site_id;
        $distributions->save();

        return redirect('distribution')->with('status1', 'Data Created!');
    }
}
