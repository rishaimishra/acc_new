<?php

namespace App\Http\Controllers\ComplaintMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint\complaintModeModel;
use Redirect;
use Alert;
class ComplaintMasterController extends Controller
{
    public function list()
    {
       $data = [];
       $data['data'] = complaintModeModel::where('isDelete',0)->get();
       return view('complaint_mode.list',$data);
    }

    public function add(Request $request)
    {
        $new = new complaintModeModel;
        $new->modeName = $request->modeName;
        $new->typeofAttachment = $request->typeofAttachment;
        $new->save();
        Alert::success('You\'ve Successfully Added A Complaint Mode');
        return Redirect::back();
    }

    public function delete($id)
    {
        complaintModeModel::where('complaintmodeID',$id)->update(['isDelete'=>1]);
        Alert::success('You\'ve Successfully Deleted A Complaint Mode');
        return Redirect::back();
    }

    
}
