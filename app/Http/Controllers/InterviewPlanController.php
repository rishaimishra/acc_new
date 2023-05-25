<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use Alert;

class InterviewPlanController extends Controller
{
    public function add_interview_plan(Request $request)
    {

        $accused        = $request->input('interviewaccused');
        $date           = $request->input('interviewdate');
        $intpersons     = $request->input('interviewers');
        $location       = $request->input('interviewlocation');
        $defences       = $request->input('interviewdefences');
        $facts          = $request->input('facts_altready_established_add');
        $casenoid       = $request->input('interviewplancasenoidadd');

        
            
            DB::table('tbl_case_interviewplans')->insert([
                'case_no_id' => $casenoid,
                'accused' => $accused,
                'interview_date'=>$date,
                'location' => $location,
                'defences' => $defences,
                'facts_established' => $facts,
                'status' => 1
                
                ]);

                foreach($intpersons as $inter)
                {
                DB::table('tbl_case_interviewers')->insert([
                    'case_no_id' => $casenoid,
                    'interviewers' => $inter
                ]);
            }


        Alert::success('Interview Plan Created Successfully');
           return Redirect::back();
    
    }

     public function displayinterviewplandetails($id)
    {
        $interviewplans= DB::table('tbl_case_interviewplans')
            ->where('id',$id)
            ->get();
        
        $casenoid = DB::table('tbl_case_interviewplans')
            ->where('id',$id)
            ->value('case_no_id');

        return view('interviewplans.editinterviewplan',compact('interviewplans','casenoid'));
    }

    public function updateinterviewplan(Request $request)
    {
        $id        = $request->input('interplanid');
        $status    = $request->input('status');

      
         DB::table('tbl_case_interviewplans')->where('id', $id)
                    ->update(array(                                     
                        'status' => 2,
                    ));
        
        
                    Alert::success('Status Updated Successfully');
                   return Redirect::back();
    }

    public function displaysummonorder($id)
    {
        $interviewers = DB::table('users')
       ->where('role', "Investigator")
        ->get();

        return view('interviewplans.showsummonorder',compact('id','interviewers'));
    }

     public function printsummonorder(Request $request)
    {
       
       $id        = $request->input('interviewplanidforsummonorder');
        DB::table('tbl_case_interviewplans')->where('id', $id)
                    ->update(array(                                     
                        'status' => 3,
                    ));
        return view('interviewplans.printsummonorder');
    }

    public function addsummonorder(Request $request)
    {

        $name        = $request->input('intervieweename');
        $reportto    = $request->input('add_report_to');
        $date        = $request->input('summondate');
        $time        = $request->input('summontime');
        $venue       = $request->input('summonvenue');
        $casenoid    = $request->input('summonordercasenoid');

            DB::table('tbl_case_summonorders')->insert([
                'case_no_id'  => $casenoid,
                'interviewee' => $name,
                'report_to'   =>$reportto,
                'summondate'  => $date,
                'summontime'  => $time,
                'summonvenue' => $venue,
                
                ]);

        Alert::success('Summon Order Created Successfully');
           return Redirect::back();
    
    }

    public function displayinterviewreport(Request $request)
    {
        
        $id        = $request->input('interviewplanidforinterviewreport');
        DB::table('tbl_case_interviewplans')->where('id', $id)
                    ->update(array(                                     
                        'status' => 4,
                    ));
        return view('interviewplans.showinterviewreport');
    }

}
