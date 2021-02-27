<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreDistributionRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Distribution;

class DistributionController extends Controller
{
    public function index(){
        $sites = DB::table('sites')
        ->get();

        $distributions = DB::table('experts')
        ->join('distributions', 'experts.expert_id', '=', 'distributions.expert_id')
        ->join('sites', 'sites.site_id', '=', 'distributions.site_id')
        ->orderBy('name', 'DESC')
        ->get();

        return view('distribution.distribution', compact('distributions', 'sites'));
    }


    public function show($id){
        $sites = DB::table('sites')
        ->select('radar_name')
        ->where('sites.site_id', '=', $id)
        ->first();

        $distributions = DB::table('distributions')
        ->join('sites', 'distributions.site_id', '=', 'sites.site_id')
        ->join('experts', 'distributions.expert_id', '=', 'experts.expert_id')
        ->where('sites.site_id', '=', $id)
        ->get();
        //dd($distributions);

        return view('distribution.detail', compact('sites', 'distributions'));
    }

    public function edit(Distribution $distribution){
        //dd($distribution);
        $distributions = DB::table('distributions')
        ->where('dist_id', '=', $distribution->dist_id)
        ->first();
        // dd($distributions);        
        $sites = DB::table('sites')
        ->where('site_id','=', $distribution->site_id)
        ->get();
        $experts = DB::table('experts')
        ->get();
        //dd($experts);
    
        return view('distribution.edit', compact('distributions', 'experts', 'sites'));
    }

    public function editData(Request $request){
        $distributions = DB::table('distributions')
        ->where('site_id', '=', $request->site_id)
        ->update([
            'expert_id' => $request->expert_id
        ]);
        return redirect('viewDistribution/'.$request->site_id)->with('status2', 'Data Updated!');
    }

    public function deleteData($id){
        $distributions = DB::table('distributions')->where('dist_id',$id);
        $distributions->delete();
        // return redirect('viewDistribution/{id}')->with('status3', 'Data Deleted!');
        return back()->with('status3', 'Data Deleted!');
    }

    public function add(){
        $experts = DB::table('experts')
        ->get();
        //$sites = DB::table('distributions')
        $sites = DB::table('sites')
        //->where('site_id', '=', $id)
        ->get();
        //dd($sites);
        //->leftJoin('sites', 'sites.site_id', '=', 'distributions.site_id')
        //->whereNull('expert_id')
        //->get();
        // dd($sites);
        return view('distribution.add', compact('experts', 'sites'));
    }

    public function addData(StoreDistributionRequest $request){
        $distributions = new Distribution;
        $distributions->expert_id = $request->expert_id;
        $distributions->site_id = $request->site_id;
        $distributions->save();

        $validated = $request->validated();


        return redirect('viewDistribution/'.$request->site_id)->with('status1', 'Data Created!');
    }
}
