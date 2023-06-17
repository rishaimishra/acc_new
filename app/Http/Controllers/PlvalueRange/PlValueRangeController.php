<?php

namespace App\Http\Controllers\PlvalueRange;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PlValueRange;
use Redirect;
use Alert;

class PlValueRangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['data'] = PlValueRange::orderBy('pValueRangeID','desc')->where('isDelete',0)->get();
        return view('plvaluerange.list', $data);
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
         $dzonkhag = new PlValueRange();
         $dzonkhag->startValue = $request->startValue;
         $dzonkhag->endValue = $request->endValue;
         $dzonkhag->isDelete = 0;
         $dzonkhag->save();
 
         Alert::success('You\'ve Successfully Added New Pursuability Values ');
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

    public function deleteValueRange($id){
        //  dd($id);
         PlValueRange::where(['pValueRangeID' => $id])->delete();
         Alert::success(' Pursuability Values Range Deleted Successfully');
         return redirect()->back();
    }

    public function EditPlValues(Request $request){
        //  dd($request);
         $person = new PlValueRange;
         $person->where(['pValueRangeID' => $request->pValueRangeID])->update([
             'startValue' => $request->startValue,
             'endValue' => $request->endValue,
         ]);

         Alert::success(' Pursuability Values Range Updated Successfully');
         return redirect()->back();
    }
}
