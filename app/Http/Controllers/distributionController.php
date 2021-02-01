<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistributionController extends Controller
{
    public function index(){
        
        $technisians = DB::table('technisians')
        ->join('distributions', '');
        //dd($distributions);

        return view('distribution.distribution', ['distributions' => $distributions]);
    }

    public function edit($id){

    }
}


