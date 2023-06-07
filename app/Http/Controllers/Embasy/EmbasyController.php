<?php

namespace App\Http\Controllers\Embasy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Embassy;
use Redirect;
use Alert;

class EmbasyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['data'] = Embassy::orderBy('embassyID','desc')->where('isDelete',0)->get();
        return view('Embassy.list', $data);
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
         $dzonkhag = new Embassy();
         $dzonkhag->embassyName = $request->embassyName;
         $dzonkhag->isDelete = 0;
         $dzonkhag->save();
 
         Alert::success('You\'ve Successfully Added A Dzonkhag ');
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
    public function deleteEmbassy($id)
    {
         // dd($id);
         Embassy::where(['embassyID' => $id])->delete();
         Alert::success(' Embassy Deleted Successfully');
         return redirect()->back();
    }

    public function EditEmbassy(Request $request){
        // dd(@$request);
        $person = new Embassy;
        $person->where(['embassyID' => $request->embassyID])->update([
            'embassyName' => $request->embassyName
        ]);

        Alert::success(' Embassy Updated Successfully');
        return redirect()->back();
    }
}
