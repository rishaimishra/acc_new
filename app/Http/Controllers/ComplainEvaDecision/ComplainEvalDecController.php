<?php

namespace App\Http\Controllers\ComplainEvaDecision;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ComplainEvaluationDecision;
use Redirect;
use Alert;

class ComplainEvalDecController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['data'] = ComplainEvaluationDecision::orderBy('compEvaDecisionID','desc')->where('isDelete',0)->get();
        return view('compEvalDecision.list', $data);
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
        $dzonkhag = new ComplainEvaluationDecision();
        $dzonkhag->compEvaDecisionName = $request->compEvaDecisionName;
        $dzonkhag->compEvaDecisionRemarks = $request->compEvaDecisionRemarks;
        $dzonkhag->isDelete = 0;
        $dzonkhag->save();

        Alert::success('You\'ve Successfully Added A Complain Evaluation Decision ');
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

    public function deleteCompEvalDec($id){
         // dd($id);
         ComplainEvaluationDecision::where(['compEvaDecisionID' => $id])->delete();
         Alert::success(' Complaint Evaluation Decision Deleted Successfully');
         return redirect()->back();
    }
    
    public function EditCorruparea(Request $request){
        // dd($request);
        $person = new ComplainEvaluationDecision;
            $person->where(['compEvaDecisionID' => $request->id])->update([
                'compEvaDecisionName' => $request->compEvaDecisionName,
                'compEvaDecisionRemarks' => $request->compEvaDecisionRemarks,
            ]);

            Alert::success(' Complaint Evaluation Decision Updated Successfully');
            return redirect()->back();
    }
}
