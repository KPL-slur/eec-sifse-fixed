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


    public function show($dist_id){
        $sites = DB::table('sites')
        ->where('sites.site_id', '=', $dist_id)
        ->first();
        // dd($sites);

        $distributions = DB::table('distributions')
        ->join('sites', 'distributions.site_id', '=', 'sites.site_id')
        ->join('experts', 'distributions.expert_id', '=', 'experts.expert_id')
        ->where('sites.site_id', '=', $dist_id)
        ->get();
        // dd($distributions);

        return view('distribution.detail', compact('sites', 'distributions'));
    }

    public function edit($dist_id){
        // $distributions = DB::table('distributions')
        // ->join('experts', 'distributions.expert_id', '=', 'experts.expert_id')
        // ->where('dist_id', '=', $dist_id)
        // ->get();

        $distributions_all = DB::table('distributions')
        ->join('sites', 'distributions.site_id', '=', 'sites.site_id')
        ->where('dist_id', $dist_id)
        ->get();

        // dd($distributions_all);

        $distributions = DB::table('distributions')
        ->where('dist_id', $dist_id)
        ->first();

        // dd($distributions);

        $experts = DB::table('experts')
                        ->select('experts.name', 'experts.expert_id')
                        // ->leftJoin('distributions', 'experts.expert_id', 'distributions.expert_id')
                        ->where('expert_company', 'Era Elektra Corpora Indonesia')
                        ->get()
                        ->toArray();

        foreach ($distributions_all as $distribution) {
            if($distribution->dist_id == $dist_id){ //apakah sudah ada distribusi di site

                foreach ($experts as $key => $exp) {
                    if ($exp->expert_id === $distribution->expert_id) {
                        unset($experts[$key]);
                    }
                }
                // dd($distribution);
            }
        }

        // return($experts);

        $sites = DB::table('sites')
        ->join('distributions', 'sites.site_id', '=', 'distributions.site_id')
        ->where('dist_id', '=', $dist_id)
        ->get();

        // dd($sites);

        //dd($experts[0]->name);

        return view('distribution.edit', compact('distributions','experts', 'sites'));
    }

    public function editData(StoreDistributionRequest $request, Distribution $distribution){
        // $distributions = DB::table('distributions')
        // dd($dist_id);
        Distribution::find($distribution->dist_id)
        // ->where('dist_id', '=', $dist_id)
        ->update($request->validated());
        // dd($distributions);
        // dd($request);

        return redirect('viewDistribution/'.$request->site_id)->with('status2', 'Data Updated!');
    }

    public function deleteData($dist_id){
        $distributions = DB::table('distributions')->where('dist_id',$dist_id);
        $distributions->delete();

        return back()->with('status3', 'Data Deleted!');
    }

    public function add($dist_id){

        // $selected = DB::table('distributions')
        // ->where('site_id',  $dist_id)
        // ->distinct()
        // ->pluck('site_id');
        // return($selected);

        $distributions = DB::table('distributions')
        ->where('site_id', $dist_id)
        ->get();

        // $dist_all = DB::table('distributions')
        // //->where('')
        // ->get();

        $experts = DB::table('experts')
                        ->select('experts.name', 'experts.expert_id')
                        // ->leftJoin('distributions', 'experts.expert_id', 'distributions.expert_id')
                        ->where('expert_company', 'Era Elektra Corpora Indonesia')
                        ->get()
                        ->toArray();

        // if($distributions->contains($dist_id)){
        foreach ($distributions as $distribution) {
            if($distribution->site_id == $dist_id){ //apakah sudah ada distribusi di site
                foreach ($experts as $key => $exp) {
                    if ($exp->expert_id === $distribution->expert_id) {
                        unset($experts[$key]);
                    }
                }
            }
        }


        // $experts = DB::table('experts')
        // ->select('experts.name', 'experts.expert_id')
        // ->leftJoin('distributions', 'experts.expert_id', 'distributions.expert_id')
        // ->where('expert_company', '=', 'Era Elektra Corpora Indonesia')
        // ->where('distributions.site_id', '<>', $dist_id)
        // ->where('site_id', '=', null)
        // ->orWhere('site_id', $dist_id)
        // ->union($selected)
        // ->where(function($query){
        //     $query->where('site_id', '=', null);
        //           ->orWhere()
        //     $query->DB::table('distributions')
        // ->where('site_id',  $dist_id)
        // ->distinct()
        // ->pluck('site_id');
        // })
        // ->get();

        // return $experts;

        $sites = DB::table('sites')
        ->where('site_id', '=', $dist_id)
        ->get();

        return view('distribution.add', compact('sites', 'experts'));
    }

    public function addData(StoreDistributionRequest $request){
        $distributions = new Distribution;
        $distributions->expert_id = $request->expert_id;
        $distributions->site_id = $request->site_id;
        $distributions->save();

        $request->validated();


        return redirect('viewDistribution/'.$request->site_id)->with('status1', 'Data Created!');
    }
}
