<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Stock;
// use Illuminate\Http\Request;

class ExpertController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $expert = Auth::user()->expert;
        if (Auth::user()->expert) {
            $loggedName = $expert->name;
        } else {
            $loggedName = '';
        }
        return view('expert.dashboard', compact('loggedName'));
    }

    public function stocks()
    {
        $stocks = Stock::all();
      
        return view('stocks.index', compact('stocks'));
    }
}
