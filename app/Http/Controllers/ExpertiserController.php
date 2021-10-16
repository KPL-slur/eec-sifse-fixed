<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreExpertRequest;
use App\Models\Expert;
use Illuminate\Support\Facades\DB;

class ExpertiserController extends Controller
{
    public function index(){
        $experts = Expert::select('*')
        ->orderBy('expert_company', 'asc')
        ->get();
        // return $experts;

        return view('expertiser.index', compact('experts'));
    }

    public function add(){

        return view('expertiser.add');
    }

    public function store(StoreExpertRequest $request){
        $experts = new Expert;
        $experts->name = $request->name;
        $experts->nip = $request->nip;
        $experts->expert_company = $request->expert_company;
        $experts->save();

        $validated = $request->validated();

        // dd($request);
        return redirect('expertManagement')->with('status1', 'Data Created!');
    }

    public function edit(Expert $expert){
        
        $experts = Expert::where('expert_id', $expert->expert_id)
        ->first();

        return view('expertiser.edit', compact('experts'));
    }

    public function update(StoreExpertRequest $request, Expert $expert){
        Expert::find($expert->expert_id)
        ->update($request->validated());

        return redirect('expertManagement')->with('status2', 'Data Updated!');
    }

    public function destroy(Expert $expert){
        Expert::destroy($expert->expert_id);
        // $experts = DB::table('experts')->where('expert_id',$id);
        // $experts->delete();

        return redirect('expertManagement')->with('status3', 'Data Deleted!');
    }
}
