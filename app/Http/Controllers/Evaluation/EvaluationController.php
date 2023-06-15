<?php

namespace App\Http\Controllers\Evaluation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint\complaintRegistrationModel;
use App\Models\Complaint\ConflictRejection;
use DB;
use Alert;
class EvaluationController extends Controller
{
    public function index()
    {
        $data = [];
        $headquater = complaintRegistrationModel::where('headquater_user_id',auth()->user()->id)->where('assign_to','H')->pluck('complaintID')->toArray();
        $regional = complaintRegistrationModel::where('regional_user_id',auth()->user()->id)->where('assign_to','R')->pluck('complaintID')->toArray();
        $merge = array_merge($headquater,$regional);
        $data['data'] = complaintRegistrationModel::whereIn('complaintID',$merge)->get();
        return view('evaluation.list',$data);
    }

    public function coi($id)
    {
        $data = [];
        $data['id'] = $id;
        $data['data'] = complaintRegistrationModel::where('complaintID',$id)->first();
        $data['person'] =   DB::table('cr_linkcomplaint_person_category')->where('personCatID',1)
            ->LeftJoin('tblperson', 'cr_linkcomplaint_person_category.personID', '=', 'tblperson.personID')
            ->LeftJoin('cr_pltblpersoncategory', 'cr_pltblpersoncategory.personCategoryID', '=', 'cr_linkcomplaint_person_category.personCatID')
            ->LeftJoin('cr_tblcomplaintregistration', 'cr_linkcomplaint_person_category.complaintID', '=', 'cr_tblcomplaintregistration.complaintID')
            ->select('tblperson.personID', 'tblperson.fname', 'tblperson.mname', 'tblperson.lname', 'tblperson.cid', 'tblperson.otherIdentificationNo', 'cr_pltblpersoncategory.categoryName')
            ->where(['cr_linkcomplaint_person_category.complaintID' => $id, 'tblperson.isDelete' => 0])
            ->get();
        return view('evaluation.conflict_view',$data);
    }

    public function postDecision(Request $request)
    {   
        $check = complaintRegistrationModel::where('complaintID',$request->complaintID)->first();
        if(@$request->evaluation=="Y"){
         if ($check->assign_to=="H") {
               complaintRegistrationModel::where('complaintID',$request->complaintID)->update([
                'assign_status'=>'N',
                'headquater_user_id'=>'',
                'reason_change'=>'',
              ]); 
         }else{
            complaintRegistrationModel::where('complaintID',$request->complaintID)->update([
                'regional_assign_status'=>'N',
                'regional_user_id'=>'',
                'regional_reason_change'=>'',
              ]); 
         }   
            
            $reject = new ConflictRejection;
            $reject->user_id = auth()->user()->id;
            $reject->complaint_id = $request->complaintID;
            $reject->description = $request->describe;
            $reject->save();
            Alert::success('Complaint Updated Successfully');
            return redirect()->route('complaint.evaluate.list');
        }else{

            complaintRegistrationModel::where('complaintID',$request->complaintID)->update([
                'evaluation_status'=>'N'
            ]);  
            Alert::success('Complaint Updated Successfully');
            return redirect()->route('complaint.evaluate.list');
        }
        
    }
}
