<?php

namespace App\Http\Controllers\ComplaintMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint\personCategoryModel;
use Redirect;
use Alert;
class PersonCategory extends Controller
{
    public function list()
    {
       $data = [];
       $data['data'] = personCategoryModel::where('isDelete',0)->get();
       return view('person_category.list',$data);
    }

    public function add(Request $request)
    {
        $new = new personCategoryModel;
        $new->categoryName  = $request->categoryName;
        $new->save();
        Alert::success('You\'ve Successfully Added A Person Category');
        return Redirect::back();
    }

    public function delete($id)
    {
        personCategoryModel::where('personCategoryID',$id)->update(['isDelete'=>1]);
        Alert::success('You\'ve Successfully Deleted A Person Category');
        return Redirect::back();
    }
}
