<?php

namespace App\Http\Controllers\InterPretationPValue;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PlValueScore;
use App\Models\ComplainEvaluationDecision;
use App\Models\PlValueRange;
use Redirect;
use Alert;

class InterPretationPValuesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        $data['data'] = PlValueScore::LeftJoin('ce_pltblpvaluesrange', 'ce_linkpvalues_compdecisions.pValueRangeID', '=', 'ce_pltblpvaluesrange.pValueRangeID')
            ->LeftJoin('ce_pltblcomplaintsevaluationdecisions', 'ce_linkpvalues_compdecisions.compEvaDecisionID', '=', 'ce_pltblcomplaintsevaluationdecisions.compEvaDecisionID')
            ->select('ce_linkpvalues_compdecisions.lpvalueCompDecisionID', 'ce_pltblpvaluesrange.startValue', 'ce_pltblpvaluesrange.endValue', 'ce_pltblcomplaintsevaluationdecisions.compEvaDecisionName', 'ce_linkpvalues_compdecisions.isDelete')
            ->orderBy('ce_linkpvalues_compdecisions.lpvalueCompDecisionID')
            ->get();
            $data['processing'] = PlValueRange::where('isDelete',0)->get();
            $data['process'] = ComplainEvaluationDecision::where('isDelete',0)->get();
            // dd($data['data']);

            return view('pvaluescore.list', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'pValueRangeID' => 'required',
            'compEvaDecisionID' => 'required',
        ]);

        $interpretationPValue = PlValueScore::where([ //check if interpretation of P-value already exists
            'pValueRangeID' => $request['pValueRangeID'],
            'compEvaDecisionID' => $request['compEvaDecisionID'],

        ])->first();

       
            $addinterpretationPValue = new PlValueScore();
            $addinterpretationPValue->pValueRangeID = $request['pValueRangeID'];
            $addinterpretationPValue->compEvaDecisionID = $request['compEvaDecisionID'];
            $addinterpretationPValue->save();

            Alert::success('You\'ve Successfully Added A New Interpretation P-value ');
            return Redirect::back();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function deleteValueScope($id){
         // dd($id);
        PlValueScore::where(['lpvalueCompDecisionID' => $id])->delete();
        Alert::success(' PlValueScore Deleted Successfully');
        return redirect()->back();
    }

    public function EditPlValuesScore(Request $request){
        // dd($request);
        $person = new PlValueScore;
        $person->where(['lpvalueCompDecisionID' => $request->lpvalueCompDecisionID])->update([
            'pValueRangeID' => $request->pValueRangeID,
            'compEvaDecisionID' => $request->compEvaDecisionID
        ]);

        Alert::success(' PlValueScore Updated Successfully');
        return redirect()->back();
    }
}
