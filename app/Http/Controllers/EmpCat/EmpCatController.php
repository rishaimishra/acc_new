<?php

namespace App\Http\Controllers\EmpCat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmpCategory;
use Redirect;
use Alert;

class EmpCatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['data'] = EmpCategory::orderBy('empCategoryID','desc')->where('isDelete',0)->get();
        return view('EmpCategory.list', $data);
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
         $dzonkhag = new EmpCategory();
         $dzonkhag->empCategoryName = $request->empCategoryName;
         $dzonkhag->isDelete = 0;
         $dzonkhag->save();
 
         Alert::success('You\'ve Successfully Added A Employee Category ');
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

    public function deleteEmpCat($id){
        // dd($id);
        EmpCategory::where(['empCategoryID' => $id])->delete();
        Alert::success(' Employee Category Deleted Successfully');
        return redirect()->back();
    }

    public function EditEmpCat(Request $request){
        $person = new EmpCategory;
        $person->where(['empCategoryID' => $request->empCategoryID])->update([
            'empCategoryName' => $request->empCategoryName
        ]);

        Alert::success(' Employee Category Updated Successfully');
        return redirect()->back();
    }
}
