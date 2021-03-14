<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Headreport;

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
        // The other table except report image will cascade on delete
        $headReport = HeadReport::onlyTrashed()->where('head_id', $id)->first();

        $reportImageFiles = $headReport->reportImages;
        foreach ($reportImageFiles as $reportImageFile) {
            \Storage::delete('public/'.$reportImageFile->image);
        }

        $headReport->reportImages()->delete();
        $headReport->forceDelete();

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
        $headReport = HeadReport::onlyTrashed()->Where('head_id', $id)->first();
        abort_unless($headReport, 404, 'Report not found');

        $pmBodyReport = $headReport->pmBodyReport;
        abort_unless($pmBodyReport, 404, 'Report not found');

        $recommendations = $headReport->recommendations()->get();
        $reportImages = $headReport->reportImages;

        return view('expert.report.trash.show', compact('pmBodyReport', 'headReport', 'recommendations', 'reportImages'));
    }
}
