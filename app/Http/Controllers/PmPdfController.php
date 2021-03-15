<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeadReport;

class PmPdfController extends Controller
{
    /*
     *
     */
    public function print($id, Request $request)
    {
        $request->validate([
            'kasatName' => 'required',
            'kasatNip' => 'required',
        ]);

        $headReport = HeadReport::Where('head_id', $id)->first();

        $kasat = ['name' => $request->kasatName, 'nip' => $request->kasatNip];
        abort_unless($headReport, 404, 'Report not found');

        $headReport = HeadReport::Where('head_id', $id)->first();

        if (date("F Y", strtotime($headReport->report_date_start)) == date("F Y", strtotime($headReport->report_date_start))) {
            $date = date('j', strtotime($headReport->report_date_start)) . " s.d " . date('j F Y', strtotime($headReport->report_date_start));
        }

        // dd($headReport->pmBodyReport->hvps_v_0_4us);
        return view('expert.report.pm.print', compact('headReport', 'date', 'kasat'));
    }

    /**
     *
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'uploadedPdf' => 'required|mimes:pdf'
            ]);

        $headReport = HeadReport::Where('head_id', $id)->first();
    
        if ($request->file()) {

            if($headReport->printedReports){
                \Storage::delete('public/'.$headReport->printedReports->file);
                $headReport->printedReports()->delete();
            }

            $fileName = time().'_'.$headReport->report_date_start.'_'.$headReport->report_date_end.'_'.$headReport->site->station_id.'.pdf';
            $filePath = $request->file('uploadedPdf')->storePubliclyAs('pm', $fileName, 'public');

            $headReport->printedReports()->updateOrCreate(
                ['head_id' => $id],
                ['file' => $filePath]
            );
    
            return back()->with('upload_success', 'File has been uploaded.');
        }
    }

    /**
     * 
     */
    public function show($id)
    {
        $filePath = HeadReport::Where('head_id', $id)->first()->printedReports->file; // pm/nama_file.pdf
        return response()->file(('storage/'.$filePath));
    }
    
    /**
     * 
     */
    public function download($id)
    {
        $filePath = HeadReport::Where('head_id', $id)->first()->printedReports->file; // pm/nama_file.pdf
        return response()->download(('storage/'.$filePath));
    }

    /**
     * 
     */
    public function destroy($id) {
        $headReport = HeadReport::Where('head_id', $id)->first();

        \Storage::delete('public/'.$headReport->printedReports->file);
        $headReport->printedReports()->delete();

        return back()->with('delete_success', 'File has been deleted.');
    }
}
