<?php

namespace App\Http\Controllers\CorruptArea;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CorruptionArea;
use Redirect;
use Alert;

class CorruptionAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['data'] = CorruptionArea::orderBy('corruptionAreaID','desc')->where('isDelete',0)->get();
        return view('corrupAreatype.list', $data);
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
        //  dd($request);
        $dzonkhag = new CorruptionArea();
        $dzonkhag->name = $request->name;
        $dzonkhag->remarks = $request->remarks;
        $dzonkhag->isDelete = 0;
        $dzonkhag->save();

        Alert::success('You\'ve Successfully Added A Corruption Area ');
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

    public function deleteCoruptArea($id){
        // dd($id);
        CorruptionArea::where(['corruptionAreaID' => $id])->delete();
        Alert::success(' Corruption Area Deleted Successfully');
        return redirect()->back();
    }

    public function EditCorruparea(Request $request){
        // dd($request);
        $person = new CorruptionArea;
            $person->where(['corruptionAreaID' => $request->corruptionAreaID])->update([
                'name' => $request->name,
                'remarks' => $request->remarks,
            ]);

            Alert::success(' Corruption Area Updated Successfully');
            return redirect()->back();
    }

}
