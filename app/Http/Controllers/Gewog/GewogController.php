<?php

namespace App\Http\Controllers\Gewog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use App\Models\Gewog;
use App\Models\Dzongkhag;
use Alert;


class GewogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $Dzonkhag = [];
        $data['data'] = Gewog::with('getDzongkhagDetails')->orderBy('gewogID','desc')->where('isDelete',0)->get();
        $data['processing'] = Dzongkhag::where('isDelete',0)->get();

        // dd($data);
        return view('gewog.list', $data);
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
        $dzonkhag = new Gewog();
        $dzonkhag->gewogName = $request->gewogName;
        $dzonkhag->DzoID = $request->DzoID;
        $dzonkhag->isDelete = 0;
        $dzonkhag->save();

        Alert::success('You\'ve Successfully Added A Gewog ');
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

    public function deleteGz($id){
        // dd($id);
        Gewog::where(['gewogID' => $id])->delete();
        Alert::success(' Gewog Deleted Successfully');
        return redirect()->back();
    }

    public function EditGewog(Request $request){
        // dd($request);
        $person = new Gewog;
        $person->where(['gewogID' => $request->gewogID])->update([
            'DzoID' => $request->DzoID,
            'gewogName' => $request->gewogName
        ]);

        Alert::success(' Gewog Updated Successfully');
        return redirect()->back();
    }
}
