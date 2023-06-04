<?php

namespace App\Http\Controllers\Complaint;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint\Attachment;
use App\Models\Complaint\link_Repeated_Complaint;
use App\Models\Complaint\complaintRegistrationModel;
use App\Models\Complaint\linkComplaintPersonModel;
use App\Models\Complaint\personModel;
use App\Models\Complaint\GenderModel;
use App\Models\Complaint\personCategoryModel;
use App\Models\Complaint\pl_complaintProcessingType_Model;
use App\Models\Complaint\complaintModeModel;
use App\Models\Complaint\complaintTypeModel;
use App\Models\Complaint\employeeCategoryModel;
use App\Models\Complaint\constituencyModel;
use App\Models\Complaint\agencyModel;
use App\Models\Complaint\complaintReceivedByModel;
use App\Models\User;
use App\Models\Dzongkhag;
use App\Models\Gewog;
use App\Models\Village;
use Auth;
use DB;
use Redirect;
use Alert;
use Carbon\Carbon;
class ComplaintController extends Controller
{

    public function list()
    {
        $data = [];
        $data['data'] = complaintRegistrationModel::orderBy('complaintID','desc')->get();
        return view('complaint.list',$data);
    }
    // function-name : attachmentView
    // description : to get the complait related attachments **

    public function attachmentView($id)
    {
        $data = [];
        $data['data'] = Attachment::where('complaintID',$id)->get();
        $data['id'] = $id;
        return view('complaint.attachment',$data);
    }

    public function attachmentPost(Request $request)
    {
        if (@$request->hasFile('file')) {

            $file = $request->file;
            $size = round(($request->file('file')->getSize()) / 1024, 2);
            $filename = time() . '-' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path().'/attachment/complaintRegistration/',$filename);

            $attachments = new Attachment();
            $attachments->CRattachmentName = $request->CRattachmentName;
            $attachments->CRattachmentDetails = $request->CRattachmentDetails;
            $attachments->complaintID = $request->complaintID;
            $attachments->moduleID = 1;
            $attachments->fileSize = $size;
            $attachments->AttachmentPath = $filename;
            $attachments->save();

            Alert::success('You\'ve Successfully Added A Complaint Attachment ');
            return Redirect::back();
        }else{
            Alert::error('No Attachment Found');
            return redirect()->back();
        }
    }

    public function attachmentDelete($id)
    {
        $check = Attachment::where('CRattachmentID',$id)->first();
        @unlink('attachment/complaintRegistration/'.$check->AttachmentPath);
        Attachment::where('CRattachmentID',$id)->delete();
        Alert::success('You\'ve Successfully Deleted A Complaint Attachment ');
        return Redirect::back();
    }


    public function linkCaseView($id)
    {
        $data = [];
        $data['person_involved'] = link_Repeated_Complaint::where('newComplaintID',$id)->where('isDelete','0')->with('repeatedComplaint_registrationRelation','repeatedComplaint_registrationRelation.complaintmoderelation','repeatedComplaint_registrationRelation.complaintTyperelation')->get();
        $data['id'] = $id;
        $data['case_already_register'] = link_Repeated_Complaint::where('newComplaintID',$id)->where('isDelete','0')->pluck('repeatedComplaintID')->toArray();
        $persons_involved = linkComplaintPersonModel::where('complaintID',$id)->pluck('personID')->toArray();
        $get_complaint_id = linkComplaintPersonModel::whereIn('personID',$persons_involved)->pluck('complaintID')->toArray();
        $data['person_previous_case'] = complaintRegistrationModel::whereIn('complaintID',$get_complaint_id)->where('complaintID','!=',$id)->get();
        // return $data['person_previous_case'];
        return view('complaint.link_case',$data);
    }


    public function linkPersonCase($complaint_id,$id)
    {
        $complaintID = $complaint_id;
        // return $complaintID;
        $oldcomplaint = complaintRegistrationModel::where('complaintID',@$id)->first();
        if (@$oldcomplaint!="") {
            
            $check = link_Repeated_Complaint::where('newComplaintID',$complaintID)->where('repeatedComplaintID',@$id)->first();
            if (@$check!="") {
                Alert::error(' Complaint Have ALready Added');
                return redirect()->back();
            }

            $checkRepeatedExistence = link_Repeated_Complaint::where(['newComplaintID' => $complaintID, 'repeatedComplaintID' => $oldcomplaint->complaintID])
                ->orWhere(['newComplaintID' => $oldcomplaint->complaintID, 'repeatedComplaintID' => $complaintID])
                ->get();

            if (count($checkRepeatedExistence) <= 0) {

                $complaint = link_Repeated_Complaint::distinct()->select('repeatedComplaintID', 'repeatedIndex')//old complaint Existence
                ->where(['repeatedComplaintID' => $oldcomplaint->complaintID])
                    ->groupBy('repeatedComplaintID')
                    ->first();

                $NewComplaintExistence = link_Repeated_Complaint::distinct()->select('repeatedComplaintID', 'repeatedIndex')//new complaint existence
                ->where(['newComplaintID' => $complaintID])
                    ->first();
                $newComplaintInOldColumn = link_Repeated_Complaint::distinct()->select('repeatedComplaintID', 'repeatedIndex')//if new complaintID we are entering is already there in old column/previously linked
                ->where(['repeatedComplaintID' => $complaintID])
                    ->first();

                if (isset($complaint) || isset($NewComplaintExistence) || isset($newComplaintInOldColumn)) { //check if old complaint/newcomplaint is already linked to other complaint, get its index

                    $repeated = new link_Repeated_Complaint;
                    $repeated->newComplaintID = $complaintID;
                    $repeated->repeatedComplaintID = $oldcomplaint->complaintID;
                    if (isset($complaint)) {
                        $repeated->repeatedIndex = $complaint->repeatedIndex;
                    } elseif (isset($NewComplaintExistence)) {
                        $repeated->repeatedIndex = $NewComplaintExistence->repeatedIndex;
                    } elseif (isset($newComplaintInOldColumn)) {
                        $repeated->repeatedIndex = $newComplaintInOldColumn->repeatedIndex;
                    }
                    $repeated->save();
                    Alert::success(' Complaint Linked Successfully');
                    return redirect()->back();

                } else { //else generate new index

                    $maxRepeatedIndex = DB::table('cr_linktbl_repeated_complaint')->max('repeatedIndex');
                    $NewRepeatedIndex = $maxRepeatedIndex + 1;

                    $repeated = new link_Repeated_Complaint;
                    $repeated->newComplaintID = $complaintID;
                    $repeated->repeatedComplaintID = $oldcomplaint->complaintID;
                    $repeated->repeatedIndex = $NewRepeatedIndex;
                    $repeated->save();
                    Alert::success(' Complaint Linked Successfully');
                    return redirect()->back();
                }
            } else {
                 Alert::error(' Complaint Have ALready Added');
                return redirect()->back();
            }






        }else{
            Alert::error('No Complaint Found');
            return redirect()->back();
        }
    }


    public function registerLink(Request $request)
    {
        $complaintID = $request->complaintID;
        // return $complaintID;
        $oldcomplaint = complaintRegistrationModel::where('complaintRegNo',$request->complaintRegNo_LinkComplaint)->first();
        if (@$oldcomplaint!="") {
            
            $check = link_Repeated_Complaint::where('newComplaintID',$request->complaintID)->where('repeatedComplaintID',$request->complaintRegNo_LinkComplaint)->first();
            if (@$check!="") {
                Alert::error(' Complaint Have ALready Added');
                return redirect()->back();
            }

            $checkRepeatedExistence = link_Repeated_Complaint::where(['newComplaintID' => $complaintID, 'repeatedComplaintID' => $oldcomplaint->complaintID])
                ->orWhere(['newComplaintID' => $oldcomplaint->complaintID, 'repeatedComplaintID' => $complaintID])
                ->get();

            if (count($checkRepeatedExistence) <= 0) {

                $complaint = link_Repeated_Complaint::distinct()->select('repeatedComplaintID', 'repeatedIndex')//old complaint Existence
                ->where(['repeatedComplaintID' => $oldcomplaint->complaintID])
                    ->groupBy('repeatedComplaintID')
                    ->first();

                $NewComplaintExistence = link_Repeated_Complaint::distinct()->select('repeatedComplaintID', 'repeatedIndex')//new complaint existence
                ->where(['newComplaintID' => $complaintID])
                    ->first();
                $newComplaintInOldColumn = link_Repeated_Complaint::distinct()->select('repeatedComplaintID', 'repeatedIndex')//if new complaintID we are entering is already there in old column/previously linked
                ->where(['repeatedComplaintID' => $complaintID])
                    ->first();

                if (isset($complaint) || isset($NewComplaintExistence) || isset($newComplaintInOldColumn)) { //check if old complaint/newcomplaint is already linked to other complaint, get its index

                    $repeated = new link_Repeated_Complaint;
                    $repeated->newComplaintID = $complaintID;
                    $repeated->repeatedComplaintID = $oldcomplaint->complaintID;
                    if (isset($complaint)) {
                        $repeated->repeatedIndex = $complaint->repeatedIndex;
                    } elseif (isset($NewComplaintExistence)) {
                        $repeated->repeatedIndex = $NewComplaintExistence->repeatedIndex;
                    } elseif (isset($newComplaintInOldColumn)) {
                        $repeated->repeatedIndex = $newComplaintInOldColumn->repeatedIndex;
                    }
                    $repeated->save();
                    Alert::success(' Complaint Linked Successfully');
                    return redirect()->back();

                } else { //else generate new index

                    $maxRepeatedIndex = DB::table('cr_linktbl_repeated_complaint')->max('repeatedIndex');
                    $NewRepeatedIndex = $maxRepeatedIndex + 1;

                    $repeated = new link_Repeated_Complaint;
                    $repeated->newComplaintID = $complaintID;
                    $repeated->repeatedComplaintID = $oldcomplaint->complaintID;
                    $repeated->repeatedIndex = $NewRepeatedIndex;
                    $repeated->save();
                    Alert::success(' Complaint Linked Successfully');
                    return redirect()->back();
                }
            } else {
                 Alert::error(' Complaint Have ALready Added');
                return redirect()->back();
            }






        }else{
            Alert::error('No Complaint Found');
            return redirect()->back();
        }
    }


    public function deleteLink($id)
    {
        link_Repeated_Complaint::where(['repeatedID' => $id])->delete();
        Alert::success(' Complaint Linked Deleted Successfully');
        return redirect()->back();
    }


    public function searchCasesAutoComplete(Request $request)
    {
             if($request->get('query'))
             {
              $query = $request->get('query');
              $data = DB::table('cr_tblcomplaintregistration')
                ->where('complaintRegNo', 'LIKE', "%{$query}%")
                ->get();
              $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
              foreach($data as $row)
              {
               $output .= '
               <li><a href="#">'.$row->complaintRegNo.'</a></li>
               ';
              }
              $output .= '</ul>';
              echo $output;
             }
    }


    // person-involved
    public function personInvolvedView($id)
    {
            $data = [];
            $data['id'] = $id;
            $data['complaintDetails'] = complaintRegistrationModel::where('complaintID',$id)->first();
            $data['category'] = personCategoryModel::get();
            $data['gender'] = GenderModel::get();
            $data['person'] =   DB::table('cr_linkcomplaint_person_category')
            ->LeftJoin('tblperson', 'cr_linkcomplaint_person_category.personID', '=', 'tblperson.personID')
            ->LeftJoin('cr_pltblpersoncategory', 'cr_pltblpersoncategory.personCategoryID', '=', 'cr_linkcomplaint_person_category.personCatID')
            ->LeftJoin('cr_tblcomplaintregistration', 'cr_linkcomplaint_person_category.complaintID', '=', 'cr_tblcomplaintregistration.complaintID')
            ->select('tblperson.personID', 'tblperson.fname', 'tblperson.mname', 'tblperson.lname', 'tblperson.cid', 'tblperson.otherIdentificationNo', 'cr_pltblpersoncategory.categoryName')
            ->where(['cr_linkcomplaint_person_category.complaintID' => $id, 'tblperson.isDelete' => 0])
            ->get();
            return view('complaint.person_involved',$data);
    }

    public function personInvolvedDelete($id,$complaint_id)
    {
        linkComplaintPersonModel::where(['personID' => $id, 'complaintID' => $complaint_id])->delete();
        Alert::success(' Person Deleted Successfully');
        return redirect()->back();
    }

    public function bhutaneseDetails(Request $request)
    {
        $reponse = [];
        $reponse['person'] = personModel::where(['cid' => $request->cid])->first();
        if (@$reponse['person']!="") {
            $reponse['success'] = true;
            $reponse['person'] = personModel::where(['cid' => $request->cid])->first();
            $check = linkComplaintPersonModel::where('complaintID',$request->complaint_id)->where('personID',$reponse['person']->personID)->first();

            if (@$check!="") {
                $reponse['avail'] = 'Y';
            }else{
                $reponse['avail'] = 'N';
            }
        }else{
            $reponse['success'] = false;
            $reponse['avail'] = 'N';
        }
        return $reponse;
    }

    public function noNbhutaneseDetails(Request $request)
    {
        
        $reponse = [];
        $reponse['person'] = personModel::where(['otherIdentificationNo' =>$request->otherIdentification])->first();
        if (@$reponse['person']!="") {
            $reponse['success'] = true;
            $reponse['person'] = personModel::where(['otherIdentificationNo' =>$request->otherIdentification])->first();
            $check = linkComplaintPersonModel::where('complaintID',$request->complaint_id)->where('personID',$reponse['person']->personID)->first();

            if (@$check!="") {
                $reponse['avail'] = 'Y';
            }else{
                $reponse['avail'] = 'N';
            }
        }else{
            $reponse['success'] = false;
            $reponse['avail'] = 'N';
        }
        return $reponse;
    }

public function postPersonInvolved(Request $request)
    {
//        1. Check existence of person in person table
//        2. Check if the person is already associated with the case in cr_linkcomplaintperson
//        3. If person exists, then just update cr_linkcomplaintperson and also update person information
//        4. Else, first insert new person and then update cr_linkcomplaintperson



        if (isset($request['PIcid'])) {

            $checkperson = personModel::where(['cid' => $request['PIcid']])->first();
            $complaintDetails = complaintRegistrationModel::where(['complaintRegNo' => $request['complaint_registration_no']])->first();

            if (isset($checkperson)) {
                $checkcomplaintpersonlink = linkComplaintPersonModel::where(['personID' => $checkperson->personID, 'complaintID' => $complaintDetails->complaintID])->get();

                if (count($checkcomplaintpersonlink) > 0) {
                    $this->validate($request, [
                        'PIcid' => 'numeric|digits_between:11,11',
                        'personCategory' => 'required',
                        'fname' => 'required',
                        'gender' => 'required'
                    ]);
                    $personinfo = $request->all();
                    $this->updateperson($personinfo);
                    Alert::success(' person successfully updated!');
                    return redirect()->back();


                } else {
                    $this->validate($request, [
                        'PIcid' => 'numeric|digits_between:11,11',
                        'personCategory' => 'required',
                        'fname' => 'required',
                        'gender' => 'required'
                    ]);
                    $personInfo = $request->all();
                    $this->updateperson($personInfo, $checkperson);
                    $this->linkComplaintPerson($complaintDetails, $personInfo, $checkperson);
                    Alert::success(' person successfully linked to the complaint');
                    return redirect()->back();
                }
            } else {
                $this->validate($request, [
                    'PIcid' => 'numeric|digits_between:11,11',
                    'personCategory' => 'required',
                    'fname' => 'required',
                    'gender' => 'required'
                ]);

                $personInfo = $request->all();

                $this->SavePersonInvolved($personInfo, $complaintDetails, $checkperson);
                Alert::success('person successfully linked to the complaint');
                return redirect()->back();
            }

        } elseif ($request['otherIdentification']) {

            $checkperson = personModel::where(['otherIdentificationNo' => $request['otherIdentification']])->first();

            $complaintDetails = complaintRegistrationModel::where(['complaintRegNo' => $request['complaint_registration_no']])->first();

            if (isset($checkperson)) {

                $checkcomplaintpersonlink = linkComplaintPersonModel::where(['personID' => $checkperson->personID, 'complaintID' => $complaintDetails->complaintID])->get();
                if (count($checkcomplaintpersonlink) > 0) {
                    $this->validate($request, [
                        'otherIdentification' => 'required',
                        'personCategory' => 'required',
                        'fname' => 'required',
                        'gender' => 'required'
                    ]);
                    $personInfo = $request->all();

                    $this->updateperson($personInfo, $checkperson);
                    Alert::success('person successfully updated!');
                    return redirect()->back();

                } else {

                    $this->validate($request, [
                        'otherIdentification' => 'required',
                        'personCategory' => 'required',
                        'fname' => 'required',
                        'gender' => 'required'
                    ]);
                    $personInfo = $request->all();

                    $this->updateperson($personInfo, $checkperson);
                    $this->linkComplaintPerson($complaintDetails, $personInfo, $checkperson);
                    Alert::success('person successfully linked to the complaint');
                    return redirect()->back();

                }
            } else {
                $this->validate($request, [
                    'otherIdentification' => 'required',
                    'personCategory' => 'required',
                    'fname' => 'required',
                    'gender' => 'required'
                ]);

                $personInfo = $request->all();

                $this->SavePersonInvolved($personInfo, $complaintDetails, $checkperson);
                Alert::success('person successfully linked to the complaint');
                return redirect()->back();

            }
        }
    }

    public function updateperson($personInfo)
    {
        $dob = strtotime($personInfo['DOB']);
        $newDOB = date('Y-m-d',$dob);

        if (isset($personInfo['PIcid'])) {

            $person = new personModel;
            $person->where(['cid' => $personInfo['PIcid']])->update([
                'fname' => $personInfo['fname'],
                'mname' => $personInfo['mname'],
                'lname' => $personInfo['lname'],
                'dob' => $newDOB,
                'gender' => $personInfo['gender'],
                'employID' => $personInfo['empID'],


                'isDelete' => 0
            ]);
            // Event::fire(new AdminModuleActionPerformed('CID:'.$personInfo['PIcid'], 'Person details updated!', Session::get('loggedinuserid'), cimsConfiguration::registration_Module()));

        } elseif (isset($personInfo['otherIdentification'])) {

            $person = new personModel;
            $person->where(['otherIdentificationNo' => $personInfo['otherIdentification']])->update([
                'fname' => $personInfo['fname'],
                'mname' => $personInfo['mname'],
                'lname' => $personInfo['lname'],
                'dob' => $newDOB,
                'gender' => $personInfo['gender'],
                'employID' => $personInfo['empID'],

                'isDelete' => 0
            ]);


        }

    }

    public function SavePersonInvolved($personInfo, $complaintDetails, $checkperson)
    {

        $newperson = new personModel;
        $newperson->uniqueID = md5(microtime());
        $newperson->fname = $personInfo['fname'];
        $newperson->mname = $personInfo['mname'];
        $newperson->lname = $personInfo['lname'];
        $newperson->dob = $personInfo['DOB'];

        if (isset($personInfo['PIcid'])) {
            $newperson->cid = $personInfo['PIcid'];

        } elseif (isset($personInfo['otherIdentification'])) {
            $newperson->otherIdentificationNo = $personInfo['otherIdentification'];
        }
        $newperson->gender = $personInfo['gender'];
        $newperson->employID = $personInfo['empID'];

        $newperson->save();
        $this->linkComplaintPerson($complaintDetails, $personInfo, $checkperson);


    }

    public function linkComplaintPerson($complaintDetail, $personInfo, $checkperson)
    {

        $linkcomplaintPerson = new linkComplaintPersonModel;
        $linkcomplaintPerson->complaintID = $complaintDetail->complaintID;

        if (isset($personInfo['PIcid'])) {
            $fetchnewpersonentry = personModel::where(['cid' => $personInfo['PIcid']])->first();
            if ($fetchnewpersonentry) {
                $linkcomplaintPerson->personID = $fetchnewpersonentry->personID;
            } else {
                $linkcomplaintPerson->personID = $checkperson->personID;
            }
        } elseif ($personInfo['otherIdentification']) {
            $fetchnewpersonentry = personModel::where(['otherIdentificationNo' => $personInfo['otherIdentification']])->first();
            if ($fetchnewpersonentry) {
                $linkcomplaintPerson->personID = $fetchnewpersonentry->personID;
            } else {
                $linkcomplaintPerson->personID = $checkperson->personID;
            }

        }

        $linkcomplaintPerson->personCatID = $personInfo['personCategory'];
        $linkcomplaintPerson->save();

        // Event::fire(new AdminModuleActionPerformed($linkcomplaintPerson->complaintID, 'Saved the Person Involved in Complaint', Session::get('loggedinuserid'), cimsConfiguration::registration_Module()));


    }


    public function complaintRegView()
    {
        $data = [];
        $data['employe'] = User::get();
        $data['processing'] = pl_complaintProcessingType_Model::get();
        $data['mode'] = complaintModeModel::get();
        $data['dzongkhag'] = Dzongkhag::get();
        $data['type'] = complaintTypeModel::get();
        // return $data['type'];
        $data['agency'] = employeeCategoryModel::get();
        // generate-number
        //max month and year from the existing column
        $operatingyearmonth = DB::table('cr_tblcomplaintregistration')->max('created_at');
        $dt = strtotime($operatingyearmonth);
        $existingmonthyear = date("my", $dt);
        //dd($operatingyearmonth);

        $reg = DB::table('cr_tblcomplaintregistration')->orderBy('created_at', 'desc')->first();

//        --------------
        if (!isset($reg)) {
//            ACC/FU/2017/9/7 ==15
            $numLength = 15;
        } else {
            if (Carbon::now()->month >= 10) {
//                ACC/FU/2017/10/7  =16
                if (strlen($reg->complaintRegNo) == 16) {
//                    ACC/CM/2017/10/1 == 16
                    $numLength = strlen($reg->complaintRegNo);
                } else {
//                    ACC/FU/2017/10/10 = 17
                    $numLength = strlen($reg->complaintRegNo) - 1;
                }
            } else {
//                ACC/FU/2017/1/1 == 15
                if (strlen($reg->complaintRegNo) > 15) {
//                    ACC/FU/2017/1/10 == 16
                    $numLength = strlen($reg->complaintRegNo) - 1;
                } else {
                    $numLength = strlen($reg->complaintRegNo);
                }
            }
        }


//get max complaint registration number on the max created_at date (on existing column)
        $exmp = DB::table('cr_tblcomplaintregistration')
            ->where('created_at', $operatingyearmonth)
            ->select(DB::raw('MAX(CAST(SUBSTRING(complaintRegNo,' . $numLength . ',length(complaintRegNo)) AS unsigned)) AS maximum'))->first();
        $maxcomplaintregID = $exmp->maximum;

        // dd($maxcomplaintregID);

// get current month and year
        $currentmonthdate = Carbon::now();
        $dt2 = strtotime($currentmonthdate);
        $currentmonthdate = date("my", $dt2);


        if ($existingmonthyear == $currentmonthdate) {
            $maxcomplaintregID++;

        } else {
            $maxcomplaintregID = 01;

        }
        $complaintRegistrationNo = 'ACC/CR/' . Carbon::now()->year . '/' . Carbon::now()->month . '/' . $maxcomplaintregID;

        $data['complaint_registration_no'] = $complaintRegistrationNo;
        return view('complaint.complaint_add',$data);
    }


    public function getGewog(Request $request)
    {
        $data = Gewog::where('dzoID',$request->id)->where('isDelete',0)->get();
        $response=array();
        $result="<option value=''>Select</option>";
        if(@$data->isNotEmpty())
        {
            foreach($data as $rows)
            {
                
                $result.="<option value='".$rows->gewogID ."' >".$rows->gewogName."</option>";
            }
        }
        $response['gewog']=$result;
        return response()->json($response);
    }

    public function getVillage(Request $request)
    {
        $data = Village::where('gewogID',$request->id)->where('isDelete',0)->get();
        $response=array();
        $result="<option value=''>Select</option>";
        if(@$data->isNotEmpty())
        {
            foreach($data as $rows)
            {
                
                $result.="<option value='".$rows->villageID."' >".$rows->villageName."</option>";
            }
        }
        $response['village']=$result;
        return response()->json($response);
    }

    public function fetchConstituency(Request $request)
    {
        $data = constituencyModel::where('dzoID',$request->id)->get();
        $response=array();
        $result="<option value=''>Select</option>";
        if(@$data->isNotEmpty())
        {
            foreach($data as $rows)
            {
                
                $result.="<option value='".$rows->constituencyID."' >".$rows->constituencyName."</option>";
            }
        }
        $response['constituency']=$result;
        return response()->json($response);
    }

    public function fetchAgency(Request $request)
    {
        $data = agencyModel::where(['agencyCategoryID' => $request->id, 'parentAgencyID' => 0, 'isDelete' => 0])->orderBy('agencyName', 'asc')->get();
        $response=array();
        $result="<option value=''>Select</option>";
        if(@$data->isNotEmpty())
        {
            foreach($data as $rows)
            {
                
                $result.="<option value='".$rows->agencyID."' >".$rows->agencyName."</option>";
            }
        }
        $response['agency']=$result;
        return response()->json($response);
    }

    public function departmentFetch(Request $request)
    {
        $data = agencyModel::where(['agencyCategoryID' => $request->id, 'isDelete' => 0])->get();
        $response=array();
        $result="<option value=''>Select</option>";
        if(@$data->isNotEmpty())
        {
            foreach($data as $rows)
            {
                
                $result.="<option value='".$rows->agencyID."' >".$rows->agencyName."</option>";
            }
        }
        $response['department']=$result;
        return response()->json($response);
    }


    public function SaveComplaintRegistration(Request $request)
    {
        // return $request;
        $newcomplaintDateTime = $request->complaintDateTime;
        $newOccurrencePeriodFrom = $request->complaintOccurrenceFrom;
        $newOccurrencePeriodTill = $request->complaintOccurrenceTill;

        // return $newOccurrencePeriodTill;

        // $this->validate($request, [
        //         'complaint_registration_no' => 'required|unique:cr_tblcomplaintregistration,complaintRegNo',
        //         'complaint_title' => 'required',
        //         'complaintDateTime' => 'required',
        //         'complaintMode' => 'required',
        //         'complainantType' => 'required',
        //         'complaintDetail' => 'required',
        //         'ComplaintReceivedBy' => 'required'
        // ]);

            $compreg = new complaintRegistrationModel();
            $compreg->uniqueID = md5(microtime());
            $compreg->complaintTitle = $request['complaint_title'];
            $compreg->complaintRegNo = $request['complaint_registration_no'];
            $compreg->complainantType = $request['complainantType'];
            $compreg->complaintDateTime = $newcomplaintDateTime;
            $compreg->complaintDetails = $request['complaintDetail'];

            if ($request['complaintOccurrenceFrom']) {
                $compreg->occurrencePeriodFrom = $newOccurrencePeriodFrom;
            }else{
            $compreg->occurrencePeriodFrom = '';
            }

            if ($request['complaintOccurrenceTill']) {
                $compreg->occurrencePeriodTill = $newOccurrencePeriodTill;
            }else{
            $compreg->occurrencePeriodTill = '';    
            }
            

            $compreg->placeOfOccurrenceDzongkhagID = $request['dzongkhag'];
            $compreg->placeOfOccurrenceGewogID = $request['gewog'];
            $compreg->placeOfOccurrenceVillageID = $request['village'];
            $compreg->modeID = $request['complaintMode'];
            $compreg->complaintProcessingTypeID = $request['compliantProcessingType'];
            $compreg->AgainstAgencyCategory = $request['AgainstAgencyCategory'];
            $compreg->ComplaintRegisteredBy = auth()->user()->id;
            if(@$request->AgainstAgencyCategory==1 || @$request->AgainstAgencyCategory==2)
            {
                $compreg->AgainstAgency = $request['Against_agency'];
                $compreg->AgainstDepartment = $request['Against_department'];
            }elseif(@$request->AgainstAgencyCategory==22){
                $compreg->AgainstAgency = $request['agency_againt_twenty_two'];
                $compreg->AgainstDepartment = $request['Against_department_twenty_two'];
            }else{
                $compreg->AgainstAgency = '';
                $compreg->AgainstDepartment = $request['department_others'];
            }   
            $compreg->save(); 


            $complaint = complaintRegistrationModel::where(['complaintRegNo' => $compreg->complaintRegNo])->first();

            if (isset($request['ComplaintReceivedBy'])) {
                foreach ($request['ComplaintReceivedBy'] as $receivedByUserID) {
                    $receiver = new complaintReceivedByModel;
                    $receiver->complaintID = $complaint->complaintID;
                    $receiver->userID = $receivedByUserID;
                    $receiver->save();
                }
            }



            Alert::success('Complaint Registered Successfully');
            return redirect()->route('attachment.view.complaint',['id'=>$complaint->complaintID]);

    }



    public function complaintRegEdit($id)
    {
        $data = [];
        $data['id'] = $id;
        $data['employe'] = User::get();
        $data['processing'] = pl_complaintProcessingType_Model::get();
        $data['mode'] = complaintModeModel::get();
        $data['dzongkhag'] = Dzongkhag::get();
        $data['gewog'] = Gewog::get();
        $data['village'] = Village::get();
        $data['type'] = complaintTypeModel::get();
        $data['agencyCategory'] = employeeCategoryModel::get();
        $data['data'] = complaintRegistrationModel::where('complaintID',$id)->first();
        $data['received_users'] = complaintReceivedByModel::where('complaintID',$id)->pluck('userID')->toArray();

        $data['deparment'] = agencyModel::where(['isDelete' => 0])->get();
        if (@$data['data']->AgainstAgencyCategory=="1" || @$data['data']->AgainstAgencyCategory=="2") {
            $data['constituency'] = constituencyModel::where('dzoID',@$data['data']->AgainstAgency)->get();
            // return $data['constituency']; 
        }else{
            $data['constituency'] = constituencyModel::get();
        }

        $data['agency'] = agencyModel::where(['agencyCategoryID' => 22, 'parentAgencyID' => 0, 'isDelete' => 0])->orderBy('agencyName', 'asc')->get();
        
        return view('complaint.complaint_edit',$data);
    }

    public function updateComplaint(Request $request)
    {   

                $newcomplaintDateTime = $request->complaintDateTime;
                $newOccurrencePeriodFrom = $request->complaintOccurrenceFrom;
                $newOccurrencePeriodTill = $request->complaintOccurrenceTill;

                if(@$request->AgainstAgencyCategory==1 || @$request->AgainstAgencyCategory==2)
                {
                $AgainstAgency = $request['Against_agency'];
                $AgainstDepartment = $request['Against_department'];
                }elseif(@$request->AgainstAgencyCategory==22){
                $AgainstAgency = $request['agency_againt_twenty_two'];
                $AgainstDepartment = $request['Against_department_twenty_two'];
                }else{
                $AgainstAgency = '';
                $AgainstDepartment = $request['department_others'];
                }


                complaintRegistrationModel::where(['complaintRegNo' => $request['complaint_registration_no']])
                ->update([
                    'complaintTitle' => $request['complaint_title'],
                    'complainantType' => $request['complainantType'],
                    'complaintDateTime' => $newcomplaintDateTime,
                    'complaintDetails' => $request['complaintDetail'],
                    'occurrencePeriodFrom' => $newOccurrencePeriodFrom,
                    'occurrencePeriodTill' => $newOccurrencePeriodTill,
                    'placeOfOccurrenceDzongkhagID' => $request['dzongkhag'],
                    'placeOfOccurrenceGewogID' => $request['gewog'],
                    'placeOfOccurrenceVillageID' => $request['village'],
//                    'complaintReceivedByUID' => $request['ComplaintReceivedBy'],
                    'modeID' => $request['complaintMode'],
                    'complaintProcessingTypeID' => $request['compliantProcessingType'],
                    'AgainstAgencyCategory' => $request['AgainstAgencyCategory'],
                    'AgainstAgency' => $AgainstAgency,
                    'AgainstDepartment' => $AgainstDepartment
                ]);


            $complaint = complaintRegistrationModel::where(['complaintRegNo' => $request['complaint_registration_no']])->first();

            if (isset($request['ComplaintReceivedBy'])) {

                complaintReceivedByModel::where(['complaintID' => $complaint->complaintID])->delete();

                foreach ($request['ComplaintReceivedBy'] as $receivedByUserID) {
                    $receiver = new complaintReceivedByModel;
                    $receiver->complaintID = $complaint->complaintID;
                    $receiver->userID = $receivedByUserID;
                    $receiver->save();
                }
            }

            Alert::success('Complaint Updated Successfully');
            return redirect()->back();
    }





}
