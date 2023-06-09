<?php

namespace App\Http\Controllers\Village;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\Gewog;
use App\Models\Village;
use App\Models\Dzongkhag;
use Alert;
use Redirect;



class VillageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['data'] = Village::with('getGewogDetails')->orderBy('villageID','desc')->where('isDelete',0)->get();
        $data['processing'] = Gewog::where('isDelete',0)->get();
        $data['processingDz'] = Dzongkhag::where('isDelete',0)->get();

        // dd($data);
        return view('village.list', $data);
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
        $dzonkhag = new Village();
        $dzonkhag->villageName = $request->villageName;
        $dzonkhag->dzoID = $request->dzooID;
        $dzonkhag->gewogID = $request->gewogID;
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

    public function deleteVj($id){
        // dd($id);
        Village::where(['villageID' => $id])->delete();
        Alert::success(' Village Deleted Successfully');
        return redirect()->back();
    }

    public function gewoglistAsperDzongkhag($id){
        $data = Gewog::where('isDelete',0)->where('dzoID',$id)->get();
        return $data;
    }

    public function EditVillage(Request $request){
        // dd($request);
        $person = new Village;
        $person->where(['villageID' => $request->villageID])->update([
            'DzoID' => $request->dzooID,
            'gewogID' => $request->gewogID,
            'villageName' => $request->villageNamea
        ]);

        Alert::success(' Village Updated Successfully');
        return redirect()->back();
    }
}
