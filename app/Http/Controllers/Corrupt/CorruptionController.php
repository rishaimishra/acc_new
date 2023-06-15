<?php

namespace App\Http\Controllers\Corrupt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CorruptionType;
use Redirect;
use Alert;

class CorruptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['data'] = CorruptionType::orderBy('corruptionTypeID','desc')->where('isDelete',0)->get();
        return view('corruptype.list', $data);
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
         $dzonkhag = new CorruptionType();
         $dzonkhag->name = $request->name;
         $dzonkhag->remarks = $request->remarks;
         $dzonkhag->isDelete = 0;
         $dzonkhag->save();
 
         Alert::success('You\'ve Successfully Added A Corruption Type ');
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

    public function deleteCoruptype($id){
        // dd($id);
        CorruptionType::where(['corruptionTypeID' => $id])->delete();
        Alert::success(' Corruption Type Deleted Successfully');
        return redirect()->back();
    }

    public function EditCorruptype(Request $request){
        // dd($request);
        $person = new CorruptionType;
            $person->where(['corruptionTypeID' => $request->corruptionTypeID])->update([
                'name' => $request->name,
                'remarks' => $request->remarks,
            ]);

            Alert::success(' Corruption Type Updated Successfully');
            return redirect()->back();
    }
}
