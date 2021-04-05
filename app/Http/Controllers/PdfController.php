<?php

namespace App\Http\Controllers;

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

        $date = $utility->easyToReadDate($headReport->report_date_start, $headReport->report_date_end);

        return view('expert.report.print', compact('headReport', 'date', 'bodyReport'));
    }

    /**
     *
     */
    public function store(Request $request, $maintenance_type, $id)
    {
        $request->validate([
            'uploadedPdf' => 'required|mimes:pdf'
            ]);

        $headReport = HeadReport::Where('head_id', $id)->first();
        $this->authorize('update', $headReport);
    
        if ($request->file()) {

            if($headReport->printedReport){
                \Storage::delete('public/'.$headReport->printedReport->file);
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
        return response()->file(('storage/'.$maintenance_type.'/'.$path));
    }
    
    /**
     * 
     */
    public function download($maintenance_type, $id, $path)
    {
        return response()->download(('storage/'.$maintenance_type.'/'.$path));
    }

    /**
     * 
     */
    public function destroy($maintenance_type, $id) {
        $headReport = HeadReport::Where('head_id', $id)->first();
        $this->authorize('update', $headReport);

        \Storage::delete('public/'.$headReport->printedReport->file);
        $headReport->printedReport()->delete();

        return back()->with('delete_success', 'File has been deleted.');
    }
}
