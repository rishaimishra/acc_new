<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use DB;
use Auth;
use Alert;
use Storage;
use Redirect;
use Carbon\Carbon;

class CaseController extends Controller
{
     public function directornonassigned(Request $request)
    {
        $complaints_list    = DB::table('tbl_complaints')->where('complaint_status','=','0')->get();
        $sources            = DB::table('tbl_sources_lookup')->get();
        $priority           = DB::table('tbl_priorities_lookup')->get();
        $investigationtype  = DB::table('tbl_investigationtype_lookup')->get();
        $branches           = DB::table('tbl_branch_lookup')->get();
        $usersspecial       = DB::table('users')->where('status',1)->where('role','chief')->orWhere('role','Investigator')->get();
        $allcases           = DB::table('tbl_registered_cases')->get();

        return view('director.nonassignedcases', compact('complaints_list','sources','priority','investigationtype','branches','usersspecial','allcases'));
    }

    public function directorassigned(Request $request)
    {
        $sources            = DB::table('tbl_sources_lookup')->get();
        $sector             = DB::table('tbl_sectortypes_lookup')->get();
        $subsector          = DB::table('tbl_sectorsubtypes_lookup')->get();
        $institutiontype    = DB::table('tbl_institutiontypes_lookup')->get();
        $area               = DB::table('tbl_areas_lookup')->get();
        $priority           = DB::table('tbl_priorities_lookup')->get();
        $investigationtype  = DB::table('tbl_investigationtype_lookup')->get();
        $branches           = DB::table('tbl_branch_lookup')->get();
        $offencetypes       = DB::table('tbl_offences_lookup')->get();
        $usersspecial       = DB::table('users')->where('status',1)->where('role','chief')->orWhere('role','Investigator')->get();
        $allcases           = DB::table('tbl_registered_cases')->get();

        return view('director.assignedcases',compact('sources','sector','subsector','institutiontype','area','priority','investigationtype','branches','offencetypes','usersspecial','allcases'));
    }

     public function generateCaseno(Request $request)
    {
        $generatedCaseNo = null;
        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('Y');
        $zerostring = "0";

        $sourcetype = $request->sourceName;

        $lastcaseno =  DB::table('tbl_registered_cases')->select(['case_no'])->where('source_type' , $sourcetype )->latest()->first();
        
        if(isset($lastcaseno))
        {
            $pieces = explode("-", $lastcaseno->case_no);
            $serialno = $pieces[2] + 1;
               
        } 
        else
        {
            $serialno = 1;
        
        }

        if (isset($request->sourceName)) {
            $generatedCaseNo = $request->sourceName;
        }

        
        if($generatedCaseNo == "Reactive (Complaint)")
        {
            $generatedCaseNo ="RCO".'-'.$month.''.$year.'-'.$zerostring.$serialno;
        }

        if($generatedCaseNo == "Reactive (Agency Referral)")
        {
            $generatedCaseNo ="RAG".'-'.$month.''.$year.'-'.$zerostring.$serialno;
        }
        
        if($generatedCaseNo == "Proactive (Offshoot)")
        {
            $generatedCaseNo ="POF".'-'.$month.''.$year.'-'.$zerostring.$serialno;
        }
        
        if($generatedCaseNo == "Proactive (Intel)")
        {
            $generatedCaseNo ="PIN".'-'.$month.''.$year.'-'.$zerostring.$serialno;
        }
        
        return response()->json($generatedCaseNo);
    }

    public function showdivisionheads(Request $request)
    {
        $branch = $request->branch;
        $headdtls = DB::table('users')->where("branch", "=", $branch)->first();
        return response()->json($headdtls);
    }

    public function addcasefromcomplaint(Request $request, Showcase $showcase)
    {
        
        Alert::success('You\'ve Successfully created a case');
            return Redirect::back(); 
    }


    public function searchentity(Request $request)
        {
       
            $cid = Route::current()->parameter('cid');
            $data = DB::table('tbl_entities')->where('identification_no', '=', $cid)->get();

            return response()->json(['data' => $data]);
        }

    public function registercase(Request $request)
        {
            $request->validate(['case_no_add' => 'required|unique:tbl_registered_cases,case_no']);

            $entityname         = $request->input('entityname');
            $entitycid          = $request->input('entitycid');
            $entitytype         = $request->input('partytype');
            $entitygender       = $request->input('entitygender');
            $entitynationality  = $request->input('entitynationality');
            $assigned_email     = Auth::user()->email;
            $yesno              = $request->input('yesno');
            $invtype            = $request->input('investigation_type_add');
            $natureofconflict   = $request->input('coidirector');
            $branch             = $request->input('branch');
            
            $data = $request->all();
                DB::table('tbl_registered_cases')->insert([
                            'source_type'           => $data['source_add'],
                            'agency_name'           => $data['agency_name_add'],
                            'sector'                => $data['sector_type_add'],
                            'case_no'               => $data['case_no_add'],
                            'sector_type'           => $data['sector_subtype_add'],
                            'case_title'            => $data['case_title_add'],
                            'area'                  => $data['area_add'],
                            'creation_date'         => $data['case_reg_no_add'],
                            'institution_type'      => $data['institution_type_add'],
                            'allegation_details'    => $data['allegation_details_add'],
                            'priority'              => $data['priority_add'],
                            'instructions'          => $data['remarks_add'],
                            'branch'                => $data['branch'],
                            'investigation_type'    => $data['investigation_type_add'],
                            'assigned_status'       => "1"
                        ]);
            
                $caseid    = DB::table('tbl_registered_cases')->latest('id')->first();
                $caseno_id = $caseid->id;
                
                $offence_type = $request->input('offence_type_add');

            foreach($offence_type as $offtype)
            {
                    DB::table('tbl_case_offences')->insert([
                        'case_no_id'   => $caseno_id,
                        'offence_type' => $offtype
                    ]);
            }

            $countcid = COUNT($entityname);
       
            if (!empty($countcid)) 
                {
                    for($j=0; $j<$countcid; $j++)
                        {
                            DB::table('tbl_case_entities')->insert([
                                'case_no_id' => $caseno_id,
                                'name' => $entityname[$j],
                                'identification_no' => $entitycid[$j],
                                'entitytype' => $entitytype[$j],
                                'gender' => $entitygender[$j],
                                'type' => $entitynationality[$j]
                                
                            ]);
                        }
                }

            $name = DB::table('users')->where('email',$assigned_email)->value('name');

                if($yesno == "Yes")
                    {
                        DB::table('tbl_case_conflicts')->insert([
                            'case_no_id'         => $caseno_id,
                            'declared_by'        => "Director",
                            'email'              => $assigned_email,
                            'name'               => $name,
                            'nature_of_conflict' => $natureofconflict,
                            'conflict_status'    => 1
                        ]);

                        $conflictstatus = 1;
                    }
                else
                    {
                        DB::table('tbl_case_conflicts')->insert([
                            'case_no_id'            => $caseno_id,
                            'declared_by'           => "Director",
                            'email'                 => $assigned_email,
                            'name'                  => $name,
                            'nature_of_conflict'    => "No Conflict",
                            'conflict_status' => 1
                        ]);

                        $conflictstatus = 2;
                    }

                $chief_email = DB::table('users')
                    ->where('branch','=', $branch)
                    ->where('role', "=", 'Chief')
                    ->value('email');
                
                $commission_email = DB::table('users')
                    ->where('role', "=", 'Commission')
                    ->value('email');

                if($invtype == "Regular")
                {
                    DB::table('tbl_user_role_mapping')->insert([
                            'case_no_id'      => $caseno_id,
                            'assigned_by'     => $assigned_email,
                            'assigned_to'     => $chief_email,
                            'role'            => "Chief",
                            'assigned_on'     => Carbon::now(),
                            
                    ]);

                    DB::table('tbl_user_role_mapping')->insert([
                            'case_no_id'      => $caseno_id,
                            'assigned_by'     => $assigned_email,
                            'assigned_to'     => $commission_email,
                            'role'            => "Commission",
                            'assigned_on'     => Carbon::now(),
                            
                    ]);
                }

                Alert::success('Case Created Successfully');
                    return Redirect::back(); 
    }

    public function mycases(Request $request)
    {
        $user_email = Auth::user()->email;

        $showassignedcases = DB::table('tbl_registered_cases')
        ->orderBy('created_at', 'desc')
        ->join('tbl_user_role_mapping', 'tbl_registered_cases.id', '=', 'tbl_user_role_mapping.case_no_id')
        ->where('tbl_user_role_mapping.assigned_to',$user_email)
        ->select('tbl_registered_cases.*','tbl_user_role_mapping.role','tbl_user_role_mapping.conflictstatus')
        ->get();

        $records = DB::table('tbl_user_role_mapping')->where('conflictstatus','1')->where(function($query) {
			$query->where('role','Team Leader')
						->orWhere('role','Team Member')
                        ->orWhere('role','Legal Representative');
                        })->count();
        
        $users  = DB::table('users')->where('status',1)->where('role','Investigator')->get();

        return view('casefolder.index',compact('showassignedcases','users','records'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    public function showcasedetailsforcoi(Request $request)
    {
        $casenoid = Route::current()->parameter('casenoid');

        $casedetails = DB::table('tbl_registered_cases')->where('id', $casenoid)->get();
        $accuseddetails = DB::table('tbl_case_entities')->where('case_no_id', $casenoid)->where('entitytype','=','Accused')->get();
        $offencedetails = DB::table('tbl_case_offences')->where('case_no_id', $casenoid)->get();

        return view('casefolder.showdetailsforcoi', compact('casedetails','accuseddetails','offencedetails'));

    }

    public function searchentitydetails(Request $request)
    {        
        $id = Route::current()->parameter('id');
        $entitydetailsshow =  DB::table('tbl_case_entities')->where('id', $id)->get();
        
        return view('casefolder.showentitiesdetails',compact('entitydetailsshow'));
    }

     public function showentitydetails(Request $request)
    {        
        $id = Route::current()->parameter('id');
        $entitydetailsshow =  DB::table('tbl_entities')->where('id', $id)->get();
        
        return view('casefolder.showentitiesdtls',compact('entitydetailsshow'));
    }

    function declarecoichief(Request $request)
    {
        $case_no_id_coi    = $request->input('case_no_id_coi');
        $natureofconflict  = $request->input('coichief');
        $yesno             = $request->input('yesno');
        $assigned_email    = Auth::user()->email;
        $name              = DB::table('users')->where('email',$assigned_email)->value('name');
        
        if($yesno == "Yes")
            {
                DB::table('tbl_case_conflicts')->insert([
                    'case_no_id' => $case_no_id_coi,
                    'declared_by' => "Chief",
                    'name' => $name,
                    'email' => $assigned_email,
                    'nature_of_conflict' => $natureofconflict,
                    'conflict_status' => 1
                 ]);
            }
        else
            {
                DB::table('tbl_case_conflicts')->insert([
                    'case_no_id' => $case_no_id_coi,
                    'declared_by' => "Chief",
                    'name' => $name,
                    'email' => $assigned_email,
                    'nature_of_conflict' => "No Conflict",
                    'conflict_status' => 1
                 ]);
            }

             DB::table('tbl_registered_cases')->where('id', $case_no_id_coi)
                
                ->update(array( 
                'assigned_status'=>"2"));

           

            Alert::success('COI declared successfully');
                        return Redirect::back();
    }

    public function viewcoi_chief(Request $request)
    {
        $casenoid = Route::current()->parameter('casenoid');
        $coifiles = DB::table('tbl_case_conflicts')->where(['case_no_id' => $casenoid,  'declared_by' => "Chief"])->get();
        
            return view('casefolder.viewcoi_chief',compact('coifiles'));

    }

    public function proceed_chief(Request $request)
    {
        $case_no_id_coi    = $request->input('case_no_id_coi_chief');  
        
        DB::table('tbl_registered_cases')->where('id', $case_no_id_coi)
                ->update(array( 
                'assigned_status'=>"3"));

                 DB::table('tbl_user_role_mapping')->where('case_no_id', $case_no_id_coi)
                ->where('role','Chief')
                ->update(array( 
                'conflictstatus'=>"1"));

            Alert::success('status updated successfully');
                        return Redirect::back();
    }

    public function assigncasechief(Request $request)
    {
        //dd(request()->all());
        
        $case_id        = $request->input('case_no_id_chief_assign');
        $teammember     = $request->input('teammembers');
        $teamrole       = $request->input('teamroles');
        $teamname       = $request->input('teamname');
        $user_email     = Auth::user()->email;

        
                $number = COUNT($teammember);//count how many arrays available
                    if($number > 0)  
                    {  
                      for($i=0; $i<$number; $i++)//loop thru each arrays
                        {
                            DB::table('tbl_user_role_mapping')->insert([
                                'case_no_id'      => $case_id,
                                'assigned_by'     => $user_email,
                                'assigned_to'     => $teammember[$i],
                                'role'            => $teamrole[$i],
                                'assigned_on'     => Carbon::now(),
                                'conflictstatus'  => 0
                            
                        ]);
                    }

                    }

                    DB::table('tbl_registered_cases')->where('id', $case_id)
                        ->update(array( 
                            'assigned_status'=>"4"));

                    
                    
                       
                    Alert::success('Assigned case successfully');
                        return Redirect::back();
        }

        public function viewcoi(Request $request)
        {
            $casenoid = Route::current()->parameter('casenoid');
            $coifiles = DB::table('tbl_case_conflicts')->where(['case_no_id' => $casenoid,  'declared_by' => "Director"])->get();
            return view('casefolder.viewcoi',compact('coifiles'));
        } 

        public function viewcoiinv(Request $request)
        {
            $casenoid = Route::current()->parameter('casenoid');
            $coifiles = DB::table('tbl_case_conflicts')->where('case_no_id', $casenoid)->where('declared_by', '!=', 'Investigator')->get();
            return view('casefolder.viewcoiinv',compact('coifiles'));
        } 

        public function viewcoitogether(Request $request)
        {
            $casenoid = Route::current()->parameter('casenoid');
            $coifiles = DB::table('tbl_case_conflicts')->where('case_no_id', $casenoid)->where('declared_by', '!=', 'Chief')->get();

            return view('casefolder.viewcoitogether',compact('coifiles'));
        } 

        public function declarecoi_investigator(Request $request)
    {
            $case_no_id_coi         = $request->input('case_no_id_coi_inv');
            $natureofconflict       = $request->input('coiinv');
            $yesno                  = $request->input('yesnoinv');
            $assigned_email         = Auth::user()->email;
            $name                   = DB::table('users')->where('email',$assigned_email)->value('name');
            $user_role              = Auth::user()->role;
                        
            if($yesno == "Yes")
                {
                    DB::table('tbl_case_conflicts')->insert([
                    'case_no_id' => $case_no_id_coi,
                    'declared_by' => "Investigator",
                    'name' => $name,
                    'email' => $assigned_email,
                    'nature_of_conflict' => $natureofconflict,
                    'conflict_status' => 1
                 ]);
                }
            else
                {
                    DB::table('tbl_case_conflicts')->insert([
                    'case_no_id' => $case_no_id_coi,
                    'declared_by' => "Investigator",
                    'name' => $name,
                    'email' => $assigned_email,
                    'nature_of_conflict' => "No Conflict",
                    'conflict_status' => 1
                 ]);
                }
                
                DB::table('tbl_user_role_mapping')->where('assigned_to', $assigned_email)
                        ->update(array( 
                            'conflictstatus'=> 1));

                Alert::success('COI declared successfully');
                    return Redirect::back();
           

    }

    public function replaceinvestigator(Request $request)
    {
        return response()->json([
        'status' => 'success',
        'message' => 'Data updated successfully.',
        'data' => $data
    ]);
    }

    public function printassignmentorder(Request $request)
    {
        $case_no_id  = $request->input('case_no_id_coi_together');
        DB::table('tbl_registered_cases')->where('id', $case_no_id)
                        ->update(array( 
                            'assigned_status'=>"Assignment Order Printed"));
        
         return view('casefolder.assignmentorder');
    }

     public function showcasedetailsforreassigncasedirector(Request $request)
    {
        $casenoid  = Route::current()->parameter('casenoid');

        $casedetails = DB::table('tbl_registered_cases')->where('id', $casenoid)->get();
        $branches  = DB::table('tbl_branch_lookup')->get();

        return view('casefolder.showcasedetailsforreassigncasedirector', compact('casedetails','branches'));
    }
       
    public function reassigncase(Request $request)
    {

        $casenoid               = $request->input('casenoid_reassign');
        $branch                 = $request->input('new_branch');
        $reason    = $request->input('reason_reassign');
        
            $assigned_email    = DB::table('users')
                                ->where('branch','=', $branch)
                                ->where('role', "=", 'Chief')
                                ->value('email');

            DB::table('tbl_user_role_mapping')
                        ->where('case_no_id', '=', $casenoid)
                        ->where('role', '=', 'Chief')
                        ->update(['assigned_to' => $assigned_email]);

            DB::table('tbl_registered_cases')->where('id', $casenoid)
                        ->update(array(
                        'branch'=>$branch,
                        'reassignment_reason'=>$reason,
                        'assigned_status' => "coi not declared by chief",
                        'reassignmentstatus'=>1));
                    
            Alert::success('You\'ve Successfully Reassigned the case');
                    return Redirect::back();
    }
    
    public function showexistingteam(Request $request)

        {
            $casenoid  = Route::current()->parameter('casenoid');
            $existingteammembers =  DB::table('tbl_user_role_mapping')
                        ->where('case_no_id', '=', $casenoid)
                        ->where('role', '=', 'Team Member')
                        ->orWhere('role', '=', 'Team Leader')
                        ->orWhere('role', '=', 'Legal Representative')
                        ->get();

            return view('casefolder.existingteammembers', compact('existingteammembers'));
        }

}
