<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Complaint\complaintRegistrationModel;
use App\Models\Complaint\complaintReceivedByModel;
use App\Models\Complaint\ComplaintAssignUser;
use App\Models\Complaint\RegionalOffice;
use App\Models\User;
use Alert;
use App\Models\Complaint\Attachment;
use DB;
use App\Models\Complaint\linkComplaintPersonModel;
use App\Models\Complaint\personModel;
use App\Models\Complaint\GenderModel;
use App\Models\Complaint\personCategoryModel;
use App\Models\Complaint\link_Repeated_Complaint;
use App\Models\RegionAssignUser;
class AssignComplaintRegional extends Controller
{
    public function list()
    {
        $data = [];
        $data['data'] = complaintRegistrationModel::orderBy('complaintID','desc')->where('assign_to','R')->get();
        return view('regional_assign.list',$data);
    }

    public function viewDetails($id)
    {
        $data = [];
        $data['data'] = complaintRegistrationModel::where('complaintID',$id)->first();
        $data['id'] = $id;
        $data['received_users'] = complaintReceivedByModel::where('complaintID',$id)->get();
        $data['user'] = User::get();
        $data['regional_office'] = RegionalOffice::get();
        $data['assignUsers'] = RegionAssignUser::where('complaint_id',$id)->pluck('user_id')->toArray();
        return view('regional_assign.view',$data);
    }


    public function postAssign(Request $request)
    {   

        if (@$request->instruction=="") {
           Alert::error('Please Enter Instruction');  
           return redirect()->back();
        }
        
        
        complaintRegistrationModel::where('complaintID',$request->complaintID)->update([
            'regional_assign_status'=>'Y',
            'regional_instruction'=>$request->instruction,
            'regional_user_id'=>$request->regional_user_id,
        ]);

            // if (isset($request['assignUsers'])) {
            //     foreach ($request['assignUsers'] as $receivedByUserID) {
            //         $receiver = new RegionAssignUser;
            //         $receiver->complaint_id  = $request->complaintID;
            //         $receiver->user_id = $receivedByUserID;
            //         $receiver->save();
            //     }
            // }
        

        Alert::success('Regional Complaint Assigned Successfully');  
        return redirect()->back();


    }


    public function postAssignUpdate(Request $request)
    {

        if (@$request->reason_change=="") {
           Alert::error('Please Enter Reason Of Re-Assign');  
           return redirect()->back();
        }

        if (@$request->instruction=="") {
           Alert::error('Please Enter Instruction');  
           return redirect()->back();
        }



       
        complaintRegistrationModel::where('complaintID',$request->complaintID)->update([
            'regional_assign_status'=>'Y',
            'regional_instruction'=>$request->instruction,
            'regional_reason_change'=>$request->reason_change,
            'regional_user_id'=>$request->regional_user_id,
        ]);

        
            // if (isset($request['assignUsers'])) {

            //     RegionAssignUser::where(['complaint_id' => $request->complaintID])->delete();
            //     foreach ($request['assignUsers'] as $receivedByUserID) {
            //         $receiver = new RegionAssignUser;
            //         $receiver->complaint_id = $request->complaintID;
            //         $receiver->user_id = $receivedByUserID;
            //         $receiver->save();
            //     }
            // }
        

        Alert::success('Regional Complaint Re-Assigned Successfully');  
        return redirect()->back();
    }


    public function viewDetailsAttachment($id)
    {
        $data = [];
        $data['data'] = Attachment::where('complaintID',$id)->get();
        $data['id'] = $id;
        return view('regional_assign.attachment',$data);
    }

    public function viewDetailsPersonInvolved($id)
    {
        $data = [];
        $data['person'] =   DB::table('cr_linkcomplaint_person_category')
            ->LeftJoin('tblperson', 'cr_linkcomplaint_person_category.personID', '=', 'tblperson.personID')
            ->LeftJoin('cr_pltblpersoncategory', 'cr_pltblpersoncategory.personCategoryID', '=', 'cr_linkcomplaint_person_category.personCatID')
            ->LeftJoin('cr_tblcomplaintregistration', 'cr_linkcomplaint_person_category.complaintID', '=', 'cr_tblcomplaintregistration.complaintID')
            ->select('tblperson.personID', 'tblperson.fname', 'tblperson.mname', 'tblperson.lname', 'tblperson.cid', 'tblperson.otherIdentificationNo', 'cr_pltblpersoncategory.categoryName')
            ->where(['cr_linkcomplaint_person_category.complaintID' => $id, 'tblperson.isDelete' => 0])
            ->get();
            $data['id'] = $id;
        return view('regional_assign.person_involved',$data);
    }

    public function viewDetailsCaseLink($id)
    {
        $data = [];
        $data['person_involved'] = link_Repeated_Complaint::where('newComplaintID',$id)->where('isDelete','0')->with('repeatedComplaint_registrationRelation','repeatedComplaint_registrationRelation.complaintmoderelation','repeatedComplaint_registrationRelation.complaintTyperelation')->get();
        $data['id'] = $id;
        return view('regional_assign.case_link',$data);
    }
}
