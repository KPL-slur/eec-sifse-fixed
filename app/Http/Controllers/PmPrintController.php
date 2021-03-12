<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeadReport;

class PmPrintController extends Controller
{
    /*
     *
     */
    public function index()
    {
        return view('expert.report.pm.print');
    }

    /*
     *
     */
    public function show($id, Request $request)
    {
        $request->validate([
            'kasatName' => 'required',
            'kasatNip' => 'required',
        ]);

        $kasat = ['name' => $request->kasatName, 'nip' => $request->kasatNip];
        $headReport = HeadReport::Where('head_id', $id)->first();
        abort_unless($headReport, 404, 'Report not found');

        if (date("F Y", strtotime($headReport->report_date_start)) == date("F Y", strtotime($headReport->report_date_start))){
            $date = date('j', strtotime($headReport->report_date_start)) . " s.d " . date('j F Y', strtotime($headReport->report_date_start));
        }

        // dd($headReport->pmBodyReport->hvps_v_0_4us);
        return view('expert.report.pm.print', compact('headReport', 'date', 'kasat'));
    }
}
