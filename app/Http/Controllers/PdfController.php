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
    public function print(Request $request, $maintenance_type, $id, Utility $utility)
    {
        $request->validate([
            'kasatName' => 'required',
            'kasatNip' => 'required|numeric|digits:18',
        ],[
            'kasatName.required' => 'The station master name field is required.',
            'kasatNip.required' => 'The station master nip field is required.',
            'kasatNip.numeric' => 'The station master nip must be a number.',
            'kasatNip.digits' => 'The station master nip must be 18 digits.',
        ]);

        $headReport = HeadReport::Where('head_id', $id)->first();
        abort_unless($headReport, 404, 'Report not found');

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

        $kasat = ['name' => $request->kasatName, 'nip' => $request->kasatNip];

        $date = $utility->easyToReadDate($headReport->report_date_start, $headReport->report_date_end);

        // dd($headReport->pmBodyReport->hvps_v_0_4us);
        return view('expert.report.print', compact('headReport', 'date', 'kasat', 'bodyReport'));
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
    public function show($maintenance_type, $id)
    {
        $filePath = HeadReport::withTrashed()->Where('head_id', $id)->first()->printedReport->file; // pm/nama_file.pdf
        return response()->file(('storage/'.$filePath));
    }
    
    /**
     * 
     */
    public function download($maintenance_type, $id)
    {
        $filePath = HeadReport::withTrashed()->Where('head_id', $id)->first()->printedReport->file; // pm/nama_file.pdf
        return response()->download(('storage/'.$filePath));
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
