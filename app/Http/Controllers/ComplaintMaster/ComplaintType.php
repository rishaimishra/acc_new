<?php

namespace App\Http\Controllers\ComplaintMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint\complaintTypeModel;
use Redirect;
use Alert;
class ComplaintType extends Controller
{
    public function list()
    {
       $data = [];
       $data['data'] = complaintTypeModel::where('isDelete',0)->get();
       return view('complaint_type.list',$data);
    }

    public function add(Request $request)
    {
        $new = new complaintTypeModel;
        $new->complainttypeName  = $request->complainttypeName;
        $new->save();
        Alert::success('You\'ve Successfully Added A Complaint Type');
        return Redirect::back();
    }

    public function delete($id)
    {
        complaintTypeModel::where('id',$id)->update(['isDelete'=>1]);
        Alert::success('You\'ve Successfully Deleted A Complaint Type');
        return Redirect::back();
    }
}
