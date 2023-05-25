<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Hypothese;
use App\Models\Evidence;
use App\Models\Activity;
use App\Models\Notification;
use App\Models\Logistic;
use App\Models\Investigation_plan;
use App\Models\Intelligence;
use App\Models\Priority;
use App\Models\Requesttype;
use App\Models\Requested_by;
use App\Models\Showcase;
use App\Models\IntelligenceFile;
use App\Models\Offencetypesinvplan;
use App\Models\Branch;
use App\Models\Offencetype;
use App\Models\File;
use App\Models\Conflict;
use App\Models\TaskDetail;
use App\Models\Typeseizure;
use App\Models\TaskType;
use App\Models\User;
use Carbon\CarbonPeriod;

use App\Models\Team;
use App\Models\Entity;
use App\Models\Offence;
use App\Models\Source;
use App\Models\Case_entity;
use App\Models\Mainarrest;
use App\Models\Arrestwarrantapplication;
use App\Models\Detention;
use App\Models\Remand;
use App\Models\Court;
use App\Models\Assettype;
use App\Models\Actionplan;

use App\Models\Assetland;
use App\Models\Assetbuilding;
use App\Models\Assetvehicle;
use App\Models\Assetbank;
use App\Models\Assetsecurity;

use App\Models\Dzongkhag;
use App\Models\Village;
use App\Models\Gewog;
use App\Models\Owner;
use App\Models\Equipmenttype;   

use App\Models\Bankaccounttype;
use App\Models\Bank;

use App\Models\Agencytype;
use App\Models\Parentagency;
use App\Models\Agencyname;
use App\Models\Location;

use Alert;

use Carbon\Carbon;
use Date;
use Redirect;
use DateTime;
use Auth;
use DB;

class InvestigationController extends Controller
{
    
    public function casesummary(Request $request)
    {
        $casenoid = Route::current()->parameter('casenoid');
        
        $casesdtls = DB::table('tbl_registered_cases')
        ->where('id',$casenoid)
        ->get();

        $caseno = DB::table('tbl_registered_cases')
        ->where('id', $casenoid)
        ->value('case_no');

        $casesummary = DB::table('tbl_registered_cases')
        ->where('id',$casenoid)
        ->value('case_summary');


        return view('investigator/casesummary', compact('casesdtls','caseno','casenoid','casesummary'));
    }

    public function viewinvestigationplan(Request $request)
    {
        $casenoid = Route::current()->parameter('casenoid');
        
        $casesdtls = DB::table('tbl_registered_cases')
        ->where('id',$casenoid)
        ->get();

        $caseno = DB::table('tbl_registered_cases')
        ->where('id', $casenoid)
        ->value('case_no');


        $investigationplans= DB::table('tbl_case_investigation_plans')
        ->where('case_no_id',$casenoid)
        ->get();

       $caseregistrationdate = DB::table('tbl_registered_cases')->where('id', $casenoid)->pluck('creation_date')->first();

       $caseenddate = DB::table('tbl_registered_cases')->where('id', $casenoid)->pluck('expected_end_date')->first();

       $offencetypes    = DB::table('tbl_offences_lookup')->get();

       $invcount = DB::table('tbl_case_investigation_plans')->where('case_no_id', $casenoid)->count();

        $investigationplanoffences= DB::table('tbl_case_offencetypesinvplan')
        ->where('case_no_id',$casenoid)
        ->get();

        $hypothesis = DB::table('tbl_case_hypothesis')
       ->where('case_no_id',$casenoid)
       ->get();
       

        $uniqueValues = $hypothesis->groupBy('hypotheses')->map(function($item) {
            return $item->unique(['evaluated_on', 'evaluated_status']);
        });

        $priority  =  DB::table('tbl_priorities_lookup')->where("active_status", "=", 1)->get();

       $invplanstartdate = DB::table('tbl_case_investigation_plans')->where('case_no_id', $casenoid)->pluck('startdate_actionplan')->first();
       $invplanenddate   = DB::table('tbl_case_investigation_plans')->where('case_no_id', $casenoid)->pluck('case_end_date')->first();

       $tasktypes  =  DB::table('tbl_task_types_lookup')->get();

       $useresults = DB::table('tbl_user_role_mapping')->where("case_no_id", "=", $casenoid)->where('role','Team Leader')->orWhere('role','Team Member')->orWhere('role','Legal Representative')->get();

       $actionplans = DB::table('tbl_case_action_plans')->where("case_no_id", "=", $casenoid)->get();

       $id = DB::table('tbl_case_action_plans')->where("case_no_id", "=", $casenoid)->value('id');

       $taskactivities = DB::table('tbl_case_actionplan_activities')->where("actionplanid", "=", $id)->get();

        return view('investigator/investigationplan', compact('casesdtls','invcount','investigationplanoffences','caseno','casenoid','investigationplans','caseregistrationdate','caseenddate','offencetypes','hypothesis','uniqueValues','priority','invplanstartdate','invplanenddate','tasktypes','useresults','actionplans','taskactivities'));
    }
    

    public function viewinterviewplan(Request $request)
    {
        $casenoid = Route::current()->parameter('casenoid');

        $casesdtls = DB::table('tbl_registered_cases')
        ->where('id',$casenoid)
        ->get();

        $caseno = DB::table('tbl_registered_cases')
        ->where('id', $casenoid)
        ->value('case_no');

       $interviewplans =  DB::table('tbl_case_interviewplans')
       ->where('case_no_id',$casenoid)
       ->get();

       $accused = DB::table('tbl_case_entities')
       ->where('case_no_id', $casenoid)
       ->where('entitytype', "Accused")
        ->get();
    
        $interviewers = DB::table('users')
       ->where('role', "Investigator")
        ->get();

        $interviewtypes = DB::table('tbl_interviewtypes_lookup')
        ->get();


       return view('investigator/interviewplan', compact('casesdtls','caseno','casenoid','interviewplans','casenoid','accused','interviewers','interviewtypes'));


    }

    public function viewsummonorder(Request $request)
    {
        $casenoid = Route::current()->parameter('casenoid');

        $casesdtls = DB::table('tbl_registered_cases')
        ->where('id',$casenoid)
        ->get();

        $caseno = DB::table('tbl_registered_cases')
        ->where('id', $casenoid)
        ->value('case_no');

        $summonorder = DB::table('tbl_case_summonorders')
        ->where('case_no_id', $casenoid)
        ->get();
        
        $interviewers = DB::table('users')
       ->where('role', "Investigator")
        ->get();

       return view('investigator/summonorder', compact('casesdtls','caseno','casenoid','summonorder','interviewers'));

    }
     public function viewinterviewreport(Request $request)
    {
        $casenoid = Route::current()->parameter('casenoid');

        $casesdtls = DB::table('tbl_registered_cases')
        ->where('id',$casenoid)
        ->get();

        $caseno = DB::table('tbl_registered_cases')
        ->where('id', $casenoid)
        ->value('case_no');


       return view('investigator/interviewreport', compact('casesdtls','caseno','casenoid'));

    }

    public function viewentity(Request $request)
    {
        $casenoid = Route::current()->parameter('casenoid');

        $user_role = Auth::user()->role;
        $user_email = Auth::user()->email;

        $user_login = DB::table('showcase_logins')
        ->join('users', 'users.email', '=', 'showcase_logins.assigned_email')
        ->where('showcase_logins.assigned_email',$user_email)
        ->select('showcase_logins.role')
        ->value('showcase_logins.role');
        
        $showcases = DB::table('showcases')
        ->where('id',$casenoid)
        ->get();

        $caseno = DB::table('showcases')
        ->where('id', $casenoid)
        ->value('case_no');

        $casesummary = DB::table('case_summaries')
        ->where('case_no_id',$casenoid)
        ->value('case_summary_details');

        $casesubstatus = DB::table('case_status')
        ->where ('status_type', "Sub_Status")
       ->get();

       $offences = Offence::where("case_no_id", "=", $casenoid)->get();

        return view('investigator/entity', compact('showcases','caseno','casesummary','casenoid','casesubstatus','offences'));
    }
    
    public function viewidiary(Request $request)
    {
        $casenoid = Route::current()->parameter('casenoid');

        $casesdtls = DB::table('tbl_registered_cases')
        ->where('id',$casenoid)
        ->get();

        $caseno = DB::table('tbl_registered_cases')
        ->where('id', $casenoid)
        ->value('case_no');

       $idiarydetails = DB::table('tbl_idiary_details')
       ->where ('case_no_id',$casenoid)
      ->get();

      $tasktypes  =  DB::table('tbl_task_types_lookup')->get();


        return view('investigator/idiary', compact('casesdtls','caseno','casenoid','idiarydetails','tasktypes'));
    }
    public function viewcaseevent(Request $request)
    {
        $casenoid = Route::current()->parameter('casenoid');

        $casesdtls = DB::table('tbl_registered_cases')
        ->where('id',$casenoid)
        ->get();

        $caseno = DB::table('tbl_registered_cases')
        ->where('id', $casenoid)
        ->value('case_no');

        

       $events = DB::table('tbl_case_events')
        ->where('case_no_id',$casenoid)
        ->get();

        $labels = $events->keys();
        $data = $events->values();
              
        $tasktypes  =  DB::table('tbl_task_types_lookup')->get();

        return view('investigator/caseevent', compact('casesdtls','casenoid','events','tasktypes','labels', 'data','caseno'));
    }
    
    public function viewevidence(Request $request)
    {
        $casenoid = Route::current()->parameter('casenoid');

        $casesdtls = DB::table('tbl_registered_cases')
        ->where('id',$casenoid)
        ->get();

        $caseno = DB::table('tbl_registered_cases')
        ->where('id', $casenoid)
        ->value('case_no');

       $evidences = DB::table('tbl_case_evidences')
       ->where('case_no_id',$casenoid)
       ->get();

       $collectionmethods = DB::table('tbl_collection_methods_lookup')
       ->get();

       $accused = DB::table('tbl_case_entities')
       ->where('case_no_id', $casenoid)
       ->where('entitytype', "Accused")
        ->get();

        

        return view('investigator/evidence', compact('casesdtls','caseno','casenoid','evidences','collectionmethods','accused'));
    }

    public function viewevidencematrix(Request $request)
    {
        $casenoid = Route::current()->parameter('casenoid');

        $casesdtls = DB::table('tbl_registered_cases')
        ->where('id',$casenoid)
        ->get();

        $caseno = DB::table('tbl_registered_cases')
        ->where('id', $casenoid)
        ->value('case_no');

       $evidences = DB::table('tbl_case_evidences')
       ->where('case_no_id',$casenoid)
       ->get();

       $collectionmethods = DB::table('tbl_collection_methods_lookup')
       ->get();

       $accused = DB::table('tbl_case_entities')
       ->where('case_no_id', $casenoid)
       ->where('entitytype', "Accused")
        ->get();

        

        return view('investigator/evidencematrix', compact('casesdtls','caseno','casenoid','evidences','collectionmethods','accused'));
    }

    public function viewfiles(Request $request)
    {
        $casenoid = Route::current()->parameter('casenoid');

         $casesdtls = DB::table('tbl_registered_cases')
        ->where('id',$casenoid)
        ->get();

        $caseno = DB::table('tbl_registered_cases')
        ->where('id', $casenoid)
        ->value('case_no');

        return view('investigator/files', compact('casesdtls','caseno','casenoid'));
    }
    public function viewreports(Request $request)
    {
        $casenoid = Route::current()->parameter('casenoid');

         $casesdtls = DB::table('tbl_registered_cases')
        ->where('id',$casenoid)
        ->get();

        $caseno = DB::table('tbl_registered_cases')
        ->where('id', $casenoid)
        ->value('case_no');

        return view('investigator/reports', compact('casesdtls','caseno','casenoid',));
    }
    public function viewlinkanalysis(Request $request)
    {
        $casenoid = Route::current()->parameter('casenoid');

         $casesdtls = DB::table('tbl_registered_cases')
        ->where('id',$casenoid)
        ->get();

        $caseno = DB::table('tbl_registered_cases')
        ->where('id', $casenoid)
        ->value('case_no');

        return view('investigator/linkanalysis', compact('casesdtls','caseno','casenoid'));
    }

    
    public function viewhypo(Request $request)
    {
        $casenoid = Route::current()->parameter('casenoid');

        $casesdtls = DB::table('tbl_registered_cases')
        ->where('id',$casenoid)
        ->get();

        $caseno = DB::table('tbl_registered_cases')
        ->where('id', $casenoid)
        ->value('case_no');

       
       $hypothesis = DB::table('tbl_case_hypothesis')
       ->where('case_no_id',$casenoid)
       ->get();
       

        $uniqueValues = $hypothesis->groupBy('hypotheses')->map(function($item) {
            return $item->unique(['evaluated_on', 'evaluated_status']);
        });



        $hypocount = DB::table('tbl_case_hypothesis')->where('case_no_id', $casenoid)->count();

        return view('investigator/hypothesisandevidence', compact('casesdtls','uniqueValues','caseno','casenoid','hypothesis','hypocount'));
    }

    public function viewactionplan(Request $request)
    {
        $casenoid = Route::current()->parameter('casenoid');

        $casesdtls = DB::table('tbl_registered_cases')
        ->where('id',$casenoid)
        ->get();

        $caseno = DB::table('tbl_registered_cases')
        ->where('id', $casenoid)
        ->value('case_no');

        
       $priority  =  DB::table('tbl_priorities_lookup')->where("active_status", "=", 1)->get();

       $invplanstartdate = DB::table('tbl_case_investigation_plans')->where('case_no_id', $casenoid)->pluck('startdate_actionplan')->first();
       $invplanenddate   = DB::table('tbl_case_investigation_plans')->where('case_no_id', $casenoid)->pluck('case_end_date')->first();

       $tasktypes  =  DB::table('tbl_task_types_lookup')->get();

       $useresults = DB::table('tbl_user_role_mapping')->where("case_no_id", "=", $casenoid)->where('role','Team Leader')->orWhere('role','Team Member')->orWhere('role','Legal Representative')->get();

       $actionplans = DB::table('tbl_case_action_plans')->where("case_no_id", "=", $casenoid)->get();

       $id = DB::table('tbl_case_action_plans')->where("case_no_id", "=", $casenoid)->value('id');

       $taskactivities = DB::table('tbl_case_actionplan_activities')->where("actionplanid", "=", $id)->get();

        return view('investigator/actionplan', compact('useresults','priority','casesdtls','caseno','casenoid','invplanstartdate','invplanenddate','tasktypes','actionplans','taskactivities'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    

    public function viewperson(Request $request)
    {
        $casenoid = Route::current()->parameter('casenoid');

        $casesdtls = DB::table('tbl_registered_cases')
        ->where('id',$casenoid)
        ->get();

        $caseno = DB::table('tbl_registered_cases')
        ->where('id', $casenoid)
        ->value('case_no');

        $entityperson = DB::table('tbl_case_entities')
          ->where ('case_no_id',$casenoid)
          ->where ('type','=','Bhutanese')
          ->orWhere ('type','=', 'Non Bhutanese')
          ->get();

        $partytypes = DB::table('tbl_partytypes_lookup')->get();
        
        return view('investigator/person', compact('casesdtls','entityperson','caseno','casenoid','partytypes'));
    }

    public function vieworganization(Request $request)
    {
        $casenoid = Route::current()->parameter('casenoid');

        $casesdtls = DB::table('tbl_registered_cases')
        ->where('id',$casenoid)
        ->get();

        $caseno = DB::table('tbl_registered_cases')
        ->where('id', $casenoid)
        ->value('case_no');


        $parentagency = DB::table('tbl_parentagencies_lookup')->get();

        $agencyname = DB::table('tbl_agencynames_lookup')->get();

        $entityorganization = DB::table('tbl_case_organization')
          ->where('case_no_id', $casenoid)
          ->get();
        
        $partytypes = DB::table('tbl_partytypes_lookup')->get();


        return view('investigator/organization', compact('casesdtls','parentagency','entityorganization','agencyname','caseno','casenoid','partytypes'));
    }

    public function viewasset(Request $request)
    {
        $casenoid = Route::current()->parameter('casenoid');

        
        $casesdtls = DB::table('tbl_registered_cases')
        ->where('id',$casenoid)
        ->get();

        $caseno = DB::table('tbl_registered_cases')
        ->where('id', $casenoid)
        ->value('case_no');

        $partytypes = DB::table('tbl_partytypes_lookup')
          ->get();

        $assetbank = DB::table("tbl_case_assetbanks")
          ->select("tbl_case_assetbanks.asset_type","tbl_case_assetbanks.owner","tbl_case_assetbanks.ownerCID")
          ->where('case_no_id', $casenoid);

        $assetvehicle = DB::table("tbl_case_assetvehicles")
          ->select("tbl_case_assetvehicles.asset_type","tbl_case_assetvehicles.owner","tbl_case_assetvehicles.ownerCID")
          ->where('case_no_id', $casenoid);

        $assetland = DB::table("tbl_case_assetlands")
          ->select("tbl_case_assetlands.asset_type","tbl_case_assetlands.owner","tbl_case_assetlands.ownerCID")
          ->where('case_no_id', $casenoid);

        $entityasset = DB::table("tbl_case_assetbuildings")
          ->select("tbl_case_assetbuildings.asset_type","tbl_case_assetbuildings.owner","tbl_case_assetbuildings.ownerCID")
          ->unionAll($assetbank)
          ->unionAll($assetvehicle)
          ->unionAll($assetland)
          ->get();


        return view('investigator/asset', compact('casesdtls','partytypes','entityasset','caseno','casenoid'));
    }

    public function viewarrest(Request $request)
    {
        $casenoid = Route::current()->parameter('casenoid');

        $casesdtls = DB::table('tbl_registered_cases')
        ->where('id',$casenoid)
        ->get();

        $caseno = DB::table('tbl_registered_cases')
        ->where('id', $casenoid)
        ->value('case_no');

       $arrests = DB::table('tbl_case_mainarrests')
       ->join('tbl_case_entities','tbl_case_entities.id','=','tbl_case_mainarrests.suspect')
       ->where ('tbl_case_mainarrests.case_no_id', $casenoid)
       ->select('tbl_case_mainarrests.*','tbl_case_entities.name')
       ->get();
       
        $subjects = DB::table('tbl_case_entities')
       ->where('entitytype', 'Accused')
       ->get();


        return view('investigator/arrest',compact('casesdtls','casenoid','caseno','arrests','subjects'));
    }
    public function viewsearch(Request $request)
    {
        $casenoid = Route::current()->parameter('casenoid');

        $casesdtls = DB::table('tbl_registered_cases')
        ->where('id',$casenoid)
        ->get();

        $caseno = DB::table('tbl_registered_cases')
        ->where('id', $casenoid)
        ->value('case_no');

       $searchdetails  = DB::table('tbl_case_mainsearches')
       ->where('case_no_id', $casenoid)
       ->get();

       $subjects = DB::table('tbl_case_entities')
       ->where('entitytype', 'Accused')
       ->get();

       $typeseizures = DB::table('tbl_seizuretypes_lookup')->get();


        return view('investigator/search',compact('casesdtls','casenoid','caseno','searchdetails','typeseizures','subjects'));
    }

    public function viewseizure(Request $request)
    {
        $casenoid = Route::current()->parameter('casenoid');

        $casesdtls = DB::table('tbl_registered_cases')
        ->where('id',$casenoid)
        ->get();

        $caseno = DB::table('tbl_registered_cases')
        ->where('id', $casenoid)
        ->value('case_no');

       $searchdetails  = DB::table('tbl_case_mainsearches')
       ->where('case_no_id', $casenoid)
       ->get();

       $accused = DB::table('tbl_case_entities')
       ->where('case_no_id', $casenoid)
       ->where('type', "Accused")
        ->get();

       $typeseizures = DB::table('tbl_seizuretypes_lookup')->get();


        return view('investigator/seizure',compact('casesdtls','casenoid','caseno','searchdetails','typeseizures','accused'));
    }
    public function viewfreeze(Request $request)
    {
        $casenoid = Route::current()->parameter('casenoid');

        $casesdtls = DB::table('tbl_registered_cases')
        ->where('id',$casenoid)
        ->get();

        $caseno = DB::table('tbl_registered_cases')
        ->where('id', $casenoid)
        ->value('case_no');

       $frozenassets = DB::table('frozenassets')
       ->orderBy('asset_type')
       ->get();

       $assetbank = DB::table("assetbanks")
       ->select("assetbanks.asset_type","assetbanks.owner","assetbanks.ownerCID")
       ->where('case_no_id', $casenoid);

        $assetvehicle = DB::table("assetvehicles")
       ->select("assetvehicles.asset_type","assetvehicles.owner","assetvehicles.ownerCID")
       ->where('case_no_id', $casenoid);

        $assetland = DB::table("assetlands")
       ->select("assetlands.asset_type","assetlands.owner","assetlands.ownerCID")
       ->where('case_no_id', $casenoid);

        $entityasset = DB::table("assetbuildings")
       ->select("assetbuildings.asset_type","assetbuildings.owner","assetbuildings.ownerCID")
       ->unionAll($assetbank)
       ->unionAll($assetvehicle)
       ->unionAll($assetland)
       ->get();


        return view('investigator/freeze',compact('casesdtls','casenoid','caseno','frozenassets'));
    }
    public function viewsuspension(Request $request)
    {
        $casenoid = Route::current()->parameter('casenoid');

        $casesdtls = DB::table('tbl_registered_cases')
        ->where('id',$casenoid)
        ->get();

        $caseno = DB::table('tbl_registered_cases')
        ->where('id', $casenoid)
        ->value('case_no');

       $suspensions = DB::table('tbl_case_suspensions')
       ->where('case_no_id',$casenoid)
       ->get();

       
        return view('investigator/suspension',compact('casesdtls','casenoid','caseno','suspensions'));
    }
}
