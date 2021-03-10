<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Headreport;
use App\Models\ReportImage;

class PmTrashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maintenance_type = "pm";
        $headReports = HeadReport::where('maintenance_type', $maintenance_type)
        //select eecid expertise only
        ->with(array('experts'=>function ($query) {
            $query->where('expert_company', 'Era Elektra Corpora Indonesia');
        }))
        // get trashed items
        ->onlyTrashed()
        ->get();
        
        return view('expert.report.trash.index', compact('headReports', 'maintenance_type'));
    }

    /**
     * Restore softdeleted items.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        HeadReport::onlyTrashed()
                    ->where('head_id', $id)
                    ->first()
                    ->restore();

        return redirect()->route('pm.trash.index')->with('status_restore', 'Data Berhasil Direstore');
    }

    /**
     * Permanent Delete softdeleted items.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function permDelete($id)
    {
        HeadReport::onlyTrashed()
                    ->where('head_id', $id)
                    ->first()
                    ->forceDelete();

        $reportImageFiles = ReportImage::where('head_id', $id)->get();
        foreach ($reportImageFiles as $reportImageFile) {
            \Storage::delete('public/'.$reportImageFile->image);
        }
        ReportImage::where('head_id', $id)->delete();

        return redirect()->route('pm.trash.index')->with('status_perm_delete', 'Data Dihapus Permanent');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $headReport = HeadReport::Where('head_id', $id)->onlyTrashed()->first();
        abort_unless($headReport, 404, 'Report not found');

        $pmBodyReport = HeadReport::Where('head_id', $id)->onlyTrashed()->first()->pmBodyReport;
        abort_unless($pmBodyReport, 404, 'Report not found');

        $recommendations = HeadReport::Where('head_id', $id)->onlyTrashed()->first()->recommendations;
        $reportImages = HeadReport::Where('head_id', $id)->onlyTrashed()->first()->reportImages;

        return view('expert.report.trash.show', compact('pmBodyReport', 'headReport', 'recommendations', 'reportImages'));
    }
}
