<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Utility;
use App\Models\Headreport;

class TrashController extends Controller
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
        // get trashed items
        ->with('site')
        ->orderBy('head_id', 'desc')
        ->onlyTrashed()
        ->get();
        
        return view('expert.report.trash.index', compact('headReports', 'maintenance_type'));
    }

    /**
     * Restore softdeleted items.
     * @param  int  $id
     * @param  string  $maintenance_type
     * @return \Illuminate\Http\Response
     */
    public function restore($maintenance_type, $id)
    {
        HeadReport::onlyTrashed()
                    ->where('head_id', $id)
                    ->first()
                    ->restore();

        return redirect()->route('report.trash.index', compact('maintenance_type'))->with('status_restore', 'Data Berhasil Direstore');
    }

    /**
     * Permanent Delete softdeleted items.
     * @param  int  $id
     * @param  string  $maintenance_type
     * @return \Illuminate\Http\Response
     */
    public function permDelete($maintenance_type, $id)
    {
        // The other table except report image will cascade on delete
        $headReport = HeadReport::onlyTrashed()->where('head_id', $id)->first();

        $reportImageFiles = $headReport->reportImages;
        foreach ($reportImageFiles as $reportImageFile) {
            \Storage::delete('public/'.$reportImageFile->image);
        }

        $headReport->reportImages()->delete();
        $headReport->forceDelete();

        return redirect()->route('report.trash.index', compact('maintenance_type'))->with('status_perm_delete', 'Data Dihapus Permanent');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  string  $maintenance_type
     * @return \Illuminate\Http\Response
     */
    public function show($maintenance_type, $id, Utility $utility)
    {
        $headReport = HeadReport::onlyTrashed()->Where('head_id', $id)->first();
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
            
            default:
                # code...
                break;
        }

        $recommendations = $headReport->recommendations()->get();
        $reportImages = $headReport->reportImages;

        if ($headReport->printedReport) {
            $fileName = explode("/", $headReport->printedReport->file)[1]; // return "namafile.pdf" without "cm/"
        } else {
            $fileName = '';
        }

        return view('expert.report.trash.show', compact('bodyReport', 'headReport', 'recommendations', 'reportImages', 'fileName', 'maintenance_type', 'date'));
    }
}
