<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

// use Illuminate\Http\Request;

class TechController extends Controller
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
        $loggedName = Auth::user()->name;
        return view('Tech.dashboard', compact('loggedName'));
    }
}
