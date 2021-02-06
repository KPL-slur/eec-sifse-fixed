<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Distribution;

class DistributionController extends Controller
{
    public function index(){
        
        $technisians = DB::table('technisians')
        ->join('distributions', 'technisians.tech_id', '=', 'distributions.tech_id')
        ->join('sites', 'sites.site_id', '=', 'distributions.site_id')
        ->get();
        // dd($technisians);

        return view('distribution.distribution', ['technisians' => $technisians]);
    }

    public function edit($id){
                
        $sites = DB::table('sites')
        ->get();
        $technisians = DB::table('technisians')
        ->where('tech_id','=',$id)
        ->get();
    
        return view('distribution.edit', ['technisians' => $technisians, 'sites' => $sites]);
    }

    public function editData(Request $request){
        $distributions = DB::table('distributions')
        ->where('tech_id', '=', $request->tech_id)
        ->update([
            'site_id' => $request->site_id
        ]);
        return redirect('distribution')->with('success', 'Data Updated!');
    }

    public function deleteData($id){
        $technisians = DB::table('distributions')->where('tech_id',$id);
        $technisians->delete();
        return redirect('distribution')->with('success', 'Data Deleted!');
    }

    public function add(){
        $technisians = DB::table('technisians')
        ->get();
        $sites = DB::table('distributions')
        ->rightJoin('sites', 'sites.site_id', '=', 'distributions.site_id')
        ->whereNull('tech_id')
        ->get();
        //  dd($sites);
        return view('distribution.add', ['technisians' => $technisians, 'sites' => $sites]);
    }

    public function addData(Request $request){
        // dd($request->all());
        $distributions = new Distribution;
        $distributions->tech_id = $request->tech_id;
        $distributions->site_id = $request->site_id;
        $distributions->save();
        
        return redirect('distribution')->with('success', 'Data Created!');
    }
}


