<?php

namespace App\Http\Controllers\ComplaintMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint\ComplaintSource;
use Redirect;
use Alert;
class SourceController extends Controller
{
     public function list()
    {
       $data = [];
       $data['data'] = ComplaintSource::where('isDelete',0)->get();
       return view('complaint_source.list',$data);
    }

    public function add(Request $request)
    {
        $new = new ComplaintSource;
        $new->complaintSourceName  = $request->complaintSourceName;
        $new->save();
        Alert::success('You\'ve Successfully Added A Complaint Source');
        return Redirect::back();
    }

    public function delete($id)
    {
        ComplaintSource::where('sourceOfcomplaintsID',$id)->update(['isDelete'=>1]);
        Alert::success('You\'ve Successfully Deleted A Complaint Source');
        return Redirect::back();
    }

    public function update(Request $request)
    {
        ComplaintSource::where('sourceOfcomplaintsID',$request->id)->update([
            'complaintSourceName'=>$request->complaintSourceName,
        ]);
        Alert::success('You\'ve Successfully Updated A Complaint Source');
        return Redirect::back();
    }
}
