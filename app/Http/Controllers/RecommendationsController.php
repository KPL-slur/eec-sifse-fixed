<?php

namespace App\Http\Controllers;

use App\Models\Recommendation;
use App\Models\HeadReport;
use App\Models\Stock;
use Illuminate\Http\Request;

class RecommendationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($headId)
    {
        return view('tech.report.recommendation.create', compact('headId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->head_id);

        foreach ($request->recommends as $recommend) {
            Recommendation::create([
            // dump($recommend['nama_barang']);
            // dump($recommend['quantity']);
            'head_id' => $request->head_id,
            'spare_part_name' => $recommend['nama_barang'],
            'qty' => $recommend['quantity']
        ]);
        };

        return redirect(url('tech'))->with('status', 'data recorded!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recommendation  $recommendation
     * @return \Illuminate\Http\Response
     */
    public function show(Recommendation $recommendation, $headId)
    {
        // dd($headId);
        $HeadReport = HeadReport::Where('id', $headId)->get();
        $recommendations = Recommendation::Where('head_id', $headId)->get();

        return view('tech.report.recommendation.show', compact('recommendations', 'HeadReport'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recommendation  $recommendation
     * @param    $headId
     * @return \Illuminate\Http\Response
     */
    public function edit($headId)
    {
        $recommendations = Recommendation::Where('head_id', $headId)->get();

        return view('tech.report.recommendation.edit', compact('recommendations', 'headId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\recommendation  $recommendation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $headId)
    {
        foreach ($request->recommends as $recommend) {
            // dd($recommend);
            if (array_key_exists("id", $recommend)) {
                Recommendation::where('id', $recommend['id'])
                ->update([
                    'spare_part_name' => $recommend['spare_part_name'],
                    'qty' => $recommend['qty']
                ]);
            } else {
                Recommendation::create([
                    'head_id' => $request->head_id,
                    'spare_part_name' => $recommend['spare_part_name'],
                    'qty' => $recommend['qty']
                ]);
            }
        };

        return redirect('tech')->with('status', 'data updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\recommendation  $recommendation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recommendation $recommendation)
    {
        //
    }
}
