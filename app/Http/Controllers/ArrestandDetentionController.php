<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Redirect;
use Alert;
use Carbon\Carbon;

class ArrestandDetentionController extends Controller
{
    public function addArrestdetails(Request $request)
        {
          
          $casenoid = $request->input('arrestcasenoidadd');
          $data=array(
                'case_no_id' => $request->input('arrestcasenoidadd'),
                'arrest_requested_by' =>Auth::user()->name,
                'typeofArrest' => $request->input('typeofArrest'),
                'suspect' => $request->input('suspect'),
                'location' => $request->input('location'),
                'pcause' => $request->input('pcause'),
                'applicationdate' => $request->input('applicationdate'),
                'remandStatus' => '0');
            
              DB::table('tbl_case_mainarrests')->insert($data);

          Alert::success('You\'ve Successfully requested Arrest');
              return Redirect::back();

        
        }

    public function commissionUpdateAnD($arrest_id)
        {
          
          $Recommendationstatus = DB::table('tbl_recommendationstatuses_lookup')->get();
          $Mainarrest = DB::table('tbl_case_mainarrests')->where('arrest_id',$arrest_id)->get();
          
          return view('arrestanddetentions.commissionreview',compact('Mainarrest','Recommendationstatus','arrest_id'))
          ->with('i', (request()->input('page', 1) - 1) * 5);
        }

    public function updateCommissionArrest(Request $request)
      {
        $arrest_id = $request->input('arrestid');
        $commissionStatus = $request->input('commissionStatus');
        $commissionReview = $request->input('commissionReview');


        DB::table('tbl_case_mainarrests')->where('arrest_id', $arrest_id)
                    ->update(array(
                    'commissionStatus'=>$commissionStatus,
                    'commissionReview'=>$commissionReview,
                    ));
                  
                    Alert::success('You\'ve Successfully updated arrest application status');
                    return Redirect::back();
      }


      public function arrestdetailsview($arrest_id)
        {
          $Mainarrest = DB::table('tbl_case_mainarrests')->where('arrest_id',$arrest_id)->get();
          
          return view('arrestanddetentions.ArrestandDetentionlistDetails',compact('Mainarrest','arrest_id'))
          ->with('i', (request()->input('page', 1) - 1) * 5);
        }

      public function detentionAdd($arrest_id)
    {
      $Recommendationstatus = DB::table('tbl_recommendationstatuses_lookup')->get();
      $Mainarrest = DB::table('tbl_case_mainarrests')->where('arrest_id',$arrest_id)->get();
      $casenoid = DB::table('tbl_case_mainarrests')->where('arrest_id',$arrest_id)->value('case_no_id');
      
      return view('arrestanddetentions.AddDetention',compact('Mainarrest','Recommendationstatus','arrest_id','casenoid'))
      ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function detentiondetailsadd(Request $request)
    {
      $casenoid = $request->input('detentioncasenoidadd');
      $arrest_id = $request->input('arrestidfordetention');
     
     DB::table('tbl_case_detentions')->insert([
      'case_no_id' => $request->input('detentioncasenoidadd'),
      'arrest_id' => $request->input('arrestidfordetention'),
      'detained_from' => $request->input('detained_from'),
      'detained_on' => $request->input('detained_on'),
      'detained_time' => $request->input('detained_time'),
      'detained_location' => $request->input('detained_location'),
      'remarks' => $request->input('remarks')
    ]);

      DB::table('tbl_case_mainarrests')->where('arrest_id', $arrest_id)
        ->update(array(
        'commissionStatus'=>"Detained"
        ));
        
      Alert::success('You\'ve Successfully added detention details');
                   return Redirect::back();
       
    }

    public function detentiondetailsdisplay($arrest_id)
    {
      $detentions = DB::table('tbl_case_detentions')
        ->where('arrest_id',$arrest_id)
        ->get();
      
      $Mainarrest = DB::table('tbl_case_mainarrests')->where('arrest_id',$arrest_id)->get();

      return view('arrestanddetentions.DetentionDetails',compact('detentions','Mainarrest'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function detentiondetailsdisplayforremand($arrest_id)
    {
      $detentions = DB::table('tbl_case_detentions')
        ->where('arrest_id',$arrest_id)
        ->get();
      
      $courts = DB::table('tbl_courts_lookup')->get();
      
      $Mainarrest = DB::table('tbl_case_mainarrests')->where('arrest_id',$arrest_id)->get();

      return view('arrestanddetentions.RemandDetails',compact('detentions','Mainarrest','courts'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
