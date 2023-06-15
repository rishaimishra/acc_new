<?php

namespace App\Http\Controllers\Pursuability;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint\fu_pltblfollowup_status_list;
use Redirect;
use Alert;
class FollowUpController extends Controller
{
    public function list()
    {
       $data = [];
       $data['data'] = fu_pltblfollowup_status_list::where('isDelete',0)->get();
       return view('follow_status.list',$data);
    }

    public function add(Request $request)
    {
        $new = new fu_pltblfollowup_status_list;
        $new->followupstatusname  = $request->followupstatusname;
        $new->save();
        Alert::success('You\'ve Successfully Added A Follow Status');
        return Redirect::back();
    }

    public function delete($id)
    {
        fu_pltblfollowup_status_list::where('followupstatusID',$id)->update(['isDelete'=>1]);
        Alert::success('You\'ve Successfully Deleted A Follow Status');
        return Redirect::back();
    }

    public function update(Request $request)
    {
        fu_pltblfollowup_status_list::where('followupstatusID',$request->id)->update([
            'followupstatusname'=>$request->followupstatusname,
        ]);
        Alert::success('You\'ve Successfully Updated A Follow Status');
        return Redirect::back();
    }
}
