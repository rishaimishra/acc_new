<?php

namespace App\Http\Controllers\AssignComplaint;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint\complaintRegistrationModel;
use App\Models\Complaint\complaintReceivedByModel;
use App\Models\Complaint\ComplaintAssignUser;
use App\Models\Complaint\RegionalOffice;
use App\Models\User;
use Alert;
class AssignComplaintController extends Controller
{
    public function list()
    {
        $data = [];
        $data['data'] = complaintRegistrationModel::orderBy('complaintID','desc')->get();
        return view('assign_complaint.list',$data);
    }

    public function viewDetails($id)
    {
        $data = [];
        $data['data'] = complaintRegistrationModel::where('complaintID',$id)->first();
        $data['id'] = $id;
        $data['received_users'] = complaintReceivedByModel::where('complaintID',$id)->get();
        $data['user'] = User::get();
        $data['regional_office'] = RegionalOffice::get();
        return view('assign_complaint.view',$data);
    }

    public function postAssign(Request $request)
    {
        
        if (@$request->assign_to=="H") {
            $regional_office = '';
        }else{
            $regional_office =@$request->regional_office;
        }
        complaintRegistrationModel::where('complaintID',$request->complaintID)->update([
            'assign_to'=>$request->assign_to,
            'regional_office'=>$regional_office,
            'instruction'=>$request->instruction,
            'assign_status'=>'Y',
        ]);

        if (@$request->assign_to=="H") {
            if (isset($request['assignUsers'])) {
                foreach ($request['assignUsers'] as $receivedByUserID) {
                    $receiver = new ComplaintAssignUser;
                    $receiver->complaintID = $complaint->complaintID;
                    $receiver->userID = $receivedByUserID;
                    $receiver->save();
                }
            }
        }

        Alert::success('Complaint Assigned Successfully');  
        return redirect()->back();


    }
}
