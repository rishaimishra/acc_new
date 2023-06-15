<?php

namespace App\Http\Controllers\agency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use App\Models\Complaint\agencyModel;
use App\Models\EmpCategory;
use Alert;

class AgencyController extends Controller
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
        $data['data'] = agencyModel::with('getEmpCatDetails')->orderBy('agencyID','desc')->where('isDelete',0)->get();
        $data['processing'] = EmpCategory::where('isDelete',0)->get();

        // dd($data);
        return view('agency.list', $data);
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
        $dzonkhag = new agencyModel();
        $dzonkhag->agencyName = $request->agencyName;
        $dzonkhag->agencyCategoryID = $request->agencyCategoryID;
        $dzonkhag->parentAgencyID = $request->parentAgencyID;
        $dzonkhag->isDelete = 0;
        $dzonkhag->save();

        Alert::success('You\'ve Successfully Added A Agency ');
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

    public function deleteAgency($id){
        // dd($id);
        agencyModel::where(['agencyID' => $id])->delete();
        Alert::success(' Agency Deleted Successfully');
        return redirect()->back();
    }

    public function EditAgency(Request $request){
        // dd($request);
        $person = new agencyModel;
        $person->where(['agencyID' => $request->agencyID])->update([
            'agencyCategoryID' => $request->emcatId,
            'parentAgencyID' => $request->parentId,
            'agencyName' => $request->agencyName
        ]);

        Alert::success(' Agency Updated Successfully');
        return redirect()->back();
    }
}
