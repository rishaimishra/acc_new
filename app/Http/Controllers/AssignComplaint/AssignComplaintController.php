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
use App\Models\Complaint\Attachment;
use DB;
use App\Models\Complaint\linkComplaintPersonModel;
use App\Models\Complaint\personModel;
use App\Models\Complaint\GenderModel;
use App\Models\Complaint\personCategoryModel;
use App\Models\Complaint\link_Repeated_Complaint;
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
        $data['assignUsers'] = ComplaintAssignUser::where('complaint_id',$id)->pluck('user_id')->toArray();
        return view('assign_complaint.view',$data);
    }

    public function postAssign(Request $request)
    {   

        if (@$request->instruction=="") {
           Alert::error('Please Enter Instruction');  
           return redirect()->back();
        }
        
        if (@$request->assign_to=="H") {
            $regional_office = '';
            $headquater_user_id = $request->headquater_user_id;
            $regional_user_id = '';
        }else{
            $regional_office =@$request->regional_office;
            $headquater_user_id = '';
            $regional_user_id = '';
        }
        complaintRegistrationModel::where('complaintID',$request->complaintID)->update([
            'assign_to'=>$request->assign_to,
            'regional_office'=>$regional_office,
            'instruction'=>$request->instruction,
            'assign_status'=>'Y',
            'headquater_user_id'=>$headquater_user_id,
            'regional_user_id'=>$regional_user_id,
        ]);

        // if (@$request->assign_to=="H") {
        //     if (isset($request['assignUsers'])) {
        //         foreach ($request['assignUsers'] as $receivedByUserID) {
        //             $receiver = new ComplaintAssignUser;
        //             $receiver->complaint_id  = $request->complaintID;
        //             $receiver->user_id = $receivedByUserID;
        //             $receiver->save();
        //         }
        //     }
        // }

        Alert::success('Complaint Assigned Successfully');  
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



        if (@$request->assign_to=="H") {
             $regional_office = '';
             $headquater_user_id = $request->headquater_user_id;
             $regional_user_id = '';
        }else{
            $regional_office =@$request->regional_office;
            $headquater_user_id = '';
            $regional_user_id = '';
        }
        complaintRegistrationModel::where('complaintID',$request->complaintID)->update([
            'assign_to'=>$request->assign_to,
            'regional_office'=>$regional_office,
            'instruction'=>$request->instruction,
            'reason_change'=>$request->reason_change,
            'assign_status'=>'Y',
            'headquater_user_id'=>$headquater_user_id,
            'regional_user_id'=>$regional_user_id,
        ]);

        // if (@$request->assign_to=="H") {
        //     if (isset($request['assignUsers'])) {

        //         ComplaintAssignUser::where(['complaint_id' => $request->complaintID])->delete();
        //         foreach ($request['assignUsers'] as $receivedByUserID) {
        //             $receiver = new ComplaintAssignUser;
        //             $receiver->complaint_id = $request->complaintID;
        //             $receiver->user_id = $receivedByUserID;
        //             $receiver->save();
        //         }
        //     }
        // }else{
        //     $ids = explode(',',$request->complaintID);
        //     ComplaintAssignUser::where('complaint_id',$ids)->delete();
        // }

        Alert::success('Complaint Re-Assigned Successfully');  
        return redirect()->back();
    }

    public function viewDetailsAttachment($id)
    {
        $data = [];
        $data['data'] = Attachment::where('complaintID',$id)->get();
        $data['id'] = $id;
        return view('assign_complaint.attachment',$data);
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
        return view('assign_complaint.person_involved',$data);
    }

    public function viewDetailsCaseLink($id)
    {
        $data = [];
        $data['person_involved'] = link_Repeated_Complaint::where('newComplaintID',$id)->where('isDelete','0')->with('repeatedComplaint_registrationRelation','repeatedComplaint_registrationRelation.complaintmoderelation','repeatedComplaint_registrationRelation.complaintTyperelation')->get();
        $data['id'] = $id;
        return view('assign_complaint.case_link',$data);
    }
}
