<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suspension;
use Illuminate\Support\Facades\Route;

use DB;
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

use App\Models\Branch;
use App\Models\Offencetype;
use App\Models\File;
use App\Models\Conflict;
use App\Models\TaskDetail;
use App\Models\Typeseizure;
use App\Models\Assettype;
use App\Models\TaskType;
use Carbon\CarbonPeriod;

use App\Models\Team;
use App\Models\Entity;
use App\Models\Offence;
use App\Models\Source;
use App\Models\Case_entity;

use App\Models\Investigationtype;
use App\Models\Showcase_audit;

use App\Models\Assetland;
use App\Models\Assetbuilding;
use App\Models\Assetvehicle;
use App\Models\Assetbank;
use App\Models\Assetsecurity;

use App\Models\Mainarrest;
use App\Models\Arrestwarrantapplication;
use App\Models\Detention;
use App\Models\Remand;
use App\Models\Court;


use App\Models\Dzongkhag;
use App\Models\Village;
use App\Models\Gewog;
use App\Models\Owner;
use App\Models\Equipmenttype;   

use App\Models\Bankaccounttype;
use App\Models\Bank;

use Illuminate\Http\Response;
use Auth;
use Storage;
use Carbon\Carbon;
use Alert;
use Redirect;

class SuspensionController extends Controller
{
    public function addsuspension(Request $request)

    {
        
        $caseno             = $request->input('suspensioncasenoadd');
        $casenoid           = $request->input('suspensioncasenoidadd');
        $type               = $request->input('suspensiontype');
        $license            = $request->input('cidnosuspension');
        $name               = $request->input('namesuspension');
        $issuedate          = $request->input('issuedatesuspension');

        //echo $caseno;
        Suspension::create([
            "case_no_id"        => $casenoid,
            "suspension_type"   => $type,
            "license_no"        => $license,
            "name"              => $name,
            "issue_date"        => $issuedate,
            "created_at"        => Carbon::now()

                        ]);
        
                        Alert::success('You\'ve Successfully added suspension');
                    return Redirect::back(); 
    }

    public function generatesuspensionorder(Suspension $suspensions)
    {
        $suspensionid = Route::current()->parameter('id');
        $casenoid = Route::current()->parameter('casenoid');

        $suspensions = DB::table('suspensions')
        ->where('id',$suspensionid)
        ->get();

        $caseno = DB::table('showcases')
        ->where('id', $casenoid)
        ->value('case_no');

        Suspension::where('id', $suspensionid)
        ->update(array( 
        'suspension_status'=>"In Force"));



        return view('suspensions.showsuspensionorder',compact('suspensions','caseno'));

    }

    public function revokesuspensionorder(Suspension $suspensions)
    {
        $suspensionid = Route::current()->parameter('id');
        $casenoid = Route::current()->parameter('casenoid');

        $suspensions = DB::table('suspensions')
        ->where('id',$suspensionid)
        ->get();

        $caseno = DB::table('showcases')
        ->where('id', $casenoid)
        ->value('case_no');

        Suspension::where('id', $suspensionid)
        ->update(array( 
        'suspension_status'=>"Revoked",
        'revoke_date' => Carbon::now()));

        return view('suspensions.showrevokesuspensionorder',compact('suspensions','caseno'));

    }
}
