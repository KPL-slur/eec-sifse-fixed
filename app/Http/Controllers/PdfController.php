<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Services\Utility;
use App\Models\HeadReport;

class PdfController extends Controller
{
    /**
     *
     */
    public function print($maintenance_type, $id, Utility $utility)
    {
        $headReport = HeadReport::findOrFail($id);

        $siteHeadReports = HeadReport::Where('site_id', $headReport->site_id)->with('recommendations')->get();
        foreach ($siteHeadReports as $siteHeadReport) { //headreport
            foreach ($siteHeadReport->recommendations as $index => $recommendation) {
                $recomendations[] = [
                    'name' => $recommendation->name,
                    'jumlah_unit_needed' => $recommendation->jumlah_unit_needed,
                ];
            }
        }

        switch ($maintenance_type) {
            case 'pm':
                $bodyReport = $headReport->pmBodyReport;
                break;

            case 'cm':
                $bodyReport = $headReport->cmBodyReport;
                break;
            
            default:
                # code...
                break;
        }

        $zombieFiles = [];
        $healthyFiles = [];
        foreach ($headReport->reportImages as $index => $reportImage) {
            if (!Storage::disk('public')->exists($reportImage->image)) {
                array_push($zombieFiles, $reportImage->caption);
            } else {
                array_push($healthyFiles, $reportImage);
            }
        }
        // dump($zombieFiles);
        // dd($healthyFiles);

        $date = $utility->easyToReadDate($headReport->report_date_start, $headReport->report_date_end);

        return view('expert.report.print', compact('headReport', 'date', 'bodyReport', 'recomendations', 'zombieFiles', 'healthyFiles'));
    }

    /**
     * ! Deprecated Method, Should not be used, delete later
     */
    public function store(Request $request, $maintenance_type, $id)
    {
        $request->validate([
            'uploadedPdf' => 'required|mimes:pdf'
            ]);

        $headReport = HeadReport::Where('head_id', $id)->first();
        $this->authorize('update', $headReport);
    
        if ($request->file()) {
            if ($headReport->printedReport) {
                Storage::delete('public/'.$headReport->printedReport->file);
                $headReport->printedReport()->delete();
            }

            $fileName = time().'_'.$headReport->report_date_start.'_'.$headReport->report_date_end.'_'.$headReport->site->station_id.'.pdf';
            $filePath = $request->file('uploadedPdf')->storePubliclyAs($maintenance_type, $fileName, 'public');

            $headReport->printedReport()->updateOrCreate(
                ['head_id' => $id],
                ['file' => $filePath]
            );
    
            return back()->with('upload_success', 'File has been uploaded.');
        }
    }

    /**
     *
     */
    public function show($maintenance_type, $id, $path)
    {
        HeadReport::find($id)->printedReports()->where('file', $maintenance_type.'/'.$path)->firstOrFail();
        return response()->file(('storage/'.$maintenance_type.'/'.$path));
    }
    
    /**
     *
     */
    public function download($maintenance_type, $id, $path)
    {
        HeadReport::find($id)->printedReports()->where('file', $maintenance_type.'/'.$path)->firstOrFail();
        return response()->download(('storage/'.$maintenance_type.'/'.$path));
    }

    /**
     * ! Deprecated Method, Should not be used, delete later
     */
    public function destroy($maintenance_type, $id)
    {
        $headReport = HeadReport::Where('head_id', $id)->first();
        $this->authorize('update', $headReport);

        Storage::delete('public/'.$headReport->printedReport->file);
        $headReport->printedReport()->delete();

        return back()->with('delete_success', 'File has been deleted.');
    }
}
