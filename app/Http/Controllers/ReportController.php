<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Utility;
use App\Models\HeadReport;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($maintenance_type)
    {
        $headReports = HeadReport::where('maintenance_type', $maintenance_type)
        //select eecid expertise only
        ->with(array('experts'=>function ($query) {
            $query->where('expert_company', 'Era Elektra Corpora Indonesia');
        }))
        ->with('site')
        ->orderBy('head_id', 'desc')
        ->get();
        
        return view('expert.report.index', compact('headReports', 'maintenance_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($maintenance_type)
    {
        return view('expert.report.create', compact('maintenance_type'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($maintenance_type, $id, Utility $utility)
    {
        $headReport = HeadReport::Where('head_id', $id)->first();
        abort_unless($headReport, 404, 'Report not found');

        $date = $utility->easyToReadDate($headReport->report_date_start, $headReport->report_date_end);

        switch ($maintenance_type) {
            case 'pm':
                $bodyReport = $headReport->pmBodyReport;
                abort_unless($bodyReport, 404, 'Report not found');
                break;
            
            case 'cm':
                $bodyReport = $headReport->cmBodyReport;
                abort_unless($bodyReport, 404, 'Report not found');
                break;

            default:
                break;
        }

        $recommendations = $headReport->recommendations;
        $reportImages = $headReport->reportImages;

        if ($headReport->printedReport) {
            $fileName = explode("/", $headReport->printedReport->file)[1]; // return "namafile.pdf" without "cm/"
        } else {
            $fileName = '';
        }

        return view('expert.report.show', compact('bodyReport', 'headReport', 'recommendations', 'reportImages', 'fileName', 'maintenance_type', 'date'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($maintenance_type, $id)
    {
        return view('expert.report.edit', compact('id', 'maintenance_type'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($maintenance_type, $id)
    {
        HeadReport::destroy($id);
        return redirect()->route('report.index', $maintenance_type)->with('status_delete', 'Data Dihapus');
    }
}
