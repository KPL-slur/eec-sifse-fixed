<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreDistributionRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Site;
use App\Models\Expert;
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
        ->where('sites.site_id', '=', $id)
        ->first();
        // dd($sites);

        $distributions = DB::table('distributions')
        ->join('sites', 'distributions.site_id', '=', 'sites.site_id')
        ->join('experts', 'distributions.expert_id', '=', 'experts.expert_id')
        ->where('sites.site_id', '=', $id)
        ->get();
        //dd($distributions);

        return view('distribution.detail', compact('sites', 'distributions'));
    }

    public function edit($id){
        $distributions = DB::table('distributions')
        ->join('experts', 'distributions.expert_id', '=', 'experts.expert_id')
        ->where('dist_id', '=', $id)
        ->first();
        //dd($distributions);

        $experts = DB::table('experts')
        // ->leftJoin('distributions', 'experts.expert_id', '=', 'distributions.expert_id')
        ->where('expert_company', '=', 'Era Elektra Corpora Indonesia')
        // ->whereNull('site_id')
        ->get();
        //dd($experts);

        $sites = DB::table('sites')
        ->join('distributions', 'sites.site_id', '=', 'distributions.site_id')
        ->where('dist_id', '=', $id)
        ->get();
        // dd($sites);
    
        return view('distribution.edit', compact('distributions','experts', 'sites'));
    }

    public function editData(StoreDistributionRequest $request){
        $distributions = DB::table('distributions')
        ->where('site_id', '=', $request->site_id)
        ->update($request->validated());
        
        return redirect('viewDistribution/'.$request->site_id)->with('status2', 'Data Updated!');
    }

    public function deleteData($id){
        $distributions = DB::table('distributions')->where('dist_id',$id);
        $distributions->delete();
       
        return back()->with('status3', 'Data Deleted!');
    }

    public function add($id){

        // $selected = DB::table('distributions')
        // ->where('site_id',  $id)
        // ->distinct()
        // ->pluck('site_id');

        // return($selected);

        $experts = DB::table('experts')
        ->select('experts.name', 'experts.expert_id')
        ->leftJoin('distributions', 'experts.expert_id', 'distributions.expert_id')
        ->where('expert_company', '=', 'Era Elektra Corpora Indonesia')
        // ->union($selected)
        ->where(function($query){
            $query->where('site_id', '=', null);
        //     $query->DB::table('distributions')
        // ->where('site_id',  $id)
        // ->distinct()
        // ->pluck('site_id');
        })
        ->get();
       
        return($experts);

        $sites = DB::table('sites')
        ->where('site_id', '=', $id)
        ->get();

        return view('distribution.add', compact('selected', 'experts', 'sites'));
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
