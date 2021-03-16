<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Recommendation;
use App\Models\PmBodyReport;
use App\Models\CmBodyReport;
use App\Models\HeadReport;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $pm = PmBodyReport::all();

        $cm = CmBodyReport::all();


        return view('dashboard', compact('pm', 'cm'));
    }
}
