<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Alert;
use Redirect;
use Carbon\Carbon;

class InvestigationPlanController extends Controller
{
    public function add_investigation_plan(Request $request)
    {

        $case_start_date   = $request->input('case_start_date');
        $case_end_date     = $request->input('case_end_date');
        $allegations       = $request->input('case_allegations');
        $objectives        = $request->input('case_objectives');
        $scope             = $request->input('case_scope');
        $offtype           = $request->input('offence_type_invplan');
        $casenoid          = $request->input('invplancasenoidadd');

        
            
            DB::table('tbl_case_investigation_plans')->insert([
                'case_no_id' => $casenoid,
                'case_start_date' => $case_start_date,
                'case_end_date'=>$case_end_date,
                'allegations' => $allegations,
                'objectives' => $objectives,
                'scope' => $scope,
                
                ]);

                foreach($offtype as $offtype)
                {
                DB::table('tbl_case_offencetypesinvplan')->insert([
                    'case_no_id' => $casenoid,
                    'offence_type' => $offtype
                ]);
            }


        Alert::success('Investigation Plan Created Successfully');
           return Redirect::back();
    
    }

    /////////////////////////////////////////////////////////////////////////////////
    public function updateinvplan(Request $request)
    {
        
        $id                 = $request->input('invplaneditid');
        $end_date           = $request->input('case_end_date_inv');
        $case_allegations   = $request->input('case_allegations_inv');
        $case_objectives    = $request->input('case_objectives_inv');
        $case_scope         = $request->input('case_scope_inv');

        DB::table('tbl_case_investigation_plans')->where('id', $id)
                    ->update(array(                                     
                        'case_end_date' => $end_date,
                        'allegations' => $case_allegations,
                        'objectives' => $case_objectives,
                        'scope' => $case_scope,
                    ));
        
        
                    Alert::success('You\'ve Successfully updated investigation plan');
                   return Redirect::back();
         

    }

    ///////////////////////////////////////////////////////////

    public function editinvplan($id)
    {
        $investigationplans= DB::table('tbl_case_investigation_plans')
            ->where('id',$id)
            ->get();

        return view('investigationplans.editinvplan',compact('investigationplans'));
    }

    ////////////////////////////////////////////////////////////////

    public function add_hypothesis(Request $request)
    {
        
        $casenoid       = $request->input('casenoidaddhypo');
        $hypothesis     = $request->input('case_hypo');
        $evidence       = $request->input('case_evidence');
        
        $countevidence = COUNT($evidence); 
          
        for($j=0; $j<$countevidence; $j++)//loop thru each arrays
        {
        
            DB::table('tbl_case_hypothesis')->insert([
                'case_no_id' => $casenoid,
                'hypotheses'=>$hypothesis,
                'evidence' => $evidence[$j],
            ]);
        }

        Alert::success('You\'ve Successfully added hypothesis');
       return Redirect::back();
         
             
    }
    ///////////////////////////////////////////////////////////////

    public function add_action_plan(Request $request)
    {
        $casenoid            = $request->input('casenoidaddactionplan');
        $activitycategory    = $request->input('actionplantaskactivityadd');
        $startdate           = $request->input('startdateactionplan');
        $cycle               = $request->input('actionplantaskcycle');

        $taskname            = $request->input('actionplantask');
        $taskdesc            = $request->input('actionplandesc');
        $taskpriority        = $request->input('actionplanpriority');
        $taskassignedto      = $request->input('actionplanassignedto');
        
        $lastno =  DB::table('tbl_case_action_plans')->where('case_no_id' , $casenoid )->orderBy('weekname', 'desc')->value('weekname');
            
        if(isset($lastno))
        {
            $serialno = $lastno + 1;
        }

        else
        {
            $serialno = 1;
        }

        if($cycle == "Weekly")
        {
            $enddate = Carbon::parse($startdate) ->addDays(7);
        }
        if($cycle == "Fortnightly")
        {
            $enddate = Carbon::parse($startdate) ->addDays(14);
        }
        if($cycle == "Monthly")
        {
            $enddate = Carbon::parse($startdate) ->addDays(30);
        }

            DB::table('tbl_case_action_plans')->insert([
                'case_no_id' => $casenoid,
                'activity_category' => $activitycategory,
                'cycle'=>$cycle,
                'actionplanstartdate' => $startdate,
                'actionplanenddate' => $enddate,
                'weekname' => $serialno,
                'status' => 'Open'
                
                ]);

            DB::table('tbl_case_investigation_plans')->where('case_no_id', $casenoid)
                    ->update(array(                                     
                        'startdate_actionplan' => $enddate,
                       
                    ));

            $actionplanid    = DB::table('tbl_case_action_plans')->latest('id')->first();
            $id = $actionplanid->id;
            
            $countactivities = COUNT($taskname);
       
            if (!empty($countactivities)) 
                {
                    for($j=0; $j<$countactivities; $j++)
                        {
                            DB::table('tbl_case_actionplan_activities')->insert([
                                'actionplanid' => $id,
                                'task' => $taskname[$j],
                                'description' => $taskdesc[$j],
                                'priority' => $taskpriority[$j],
                                'assigned_to' => $taskassignedto[$j],
                                
                            ]);
                        }
                }

        Alert::success('Action Plan Added Successfully');
           return Redirect::back();
    
    }

    public function updateactionplanstatus(Request $request)
    {
            
        $id      = $request->input('actionplanstatuseditid');
        $status  = $request->input('actionplanstatus');

        DB::table('tbl_case_actionplan_activities')->where('id', $id)
                    ->update(array(                                     
                        'status' => $status,
                        
                    ));
        
        
                    Alert::success('You\'ve Successfully updated status');
                   return Redirect::back();
    }
}
