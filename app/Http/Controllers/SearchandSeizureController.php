<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use Alert;
use App\Models\Mainseizure;
use App\Models\Mainforensic;
use App\Models\Mainsearch;
use App\Models\Seizures;
use App\Models\Seziurewitness;
use Carbon\Carbon;

class SearchandSeizureController extends Controller
{
    public function addsearch(Request $request){
      
        
      $searchTarget = $request->input('searchtarget');

      if($searchTarget == "movable")
      {
        DB::table('tbl_case_mainsearches')->insert([
            'case_no_id' => $request->input('searchcasenoidadd'),
            'typeofsearch' => $request->input('typeofsearch'),
            'suspect' => $request->input('searchsuspect'),
            'pcause' => $request->input('searchpcause'),
            'applicationdate' => $request->input('searchapplicationdate'),
            'identification_no' => $request->input('ideNo'),
            'owner_name' => $request->input('movableOwner'),
                ]);
      }

      if($searchTarget == "publicPremise")
      {
        DB::table('tbl_case_mainsearches')->insert([
            'case_no_id' => $request->input('searchcasenoidadd'),
            'typeofsearch' => $request->input('typeofsearch'),
            'suspect' => $request->input('searchsuspect'),
            'pcause' => $request->input('searchpcause'),
            'applicationdate' => $request->input('searchapplicationdate'),
            'public_premise_name' => $request->input('publicName'),
            'public_premise_location' => $request->input('publicLocation'),
        ]);
      }

      if($searchTarget == "privatePremise")
      {
        DB::table('tbl_case_mainsearches')->insert([
            'case_no_id' => $request->input('searchcasenoidadd'),
            'typeofsearch' => $request->input('typeofsearch'),
            'suspect' => $request->input('searchsuspect'),
            'pcause' => $request->input('searchpcause'),
            'applicationdate' => $request->input('searchapplicationdate'),
            'private_premise_location' => $request->input('privateLocation')

            ]);
        }
    
     
      Alert::success('You\'ve Successfully added search application');
      return Redirect::back();
    
    }

    public function viewsearchdetails($search_id)
    {
      $search = DB::table('tbl_case_mainsearches')
      ->where('search_id',$search_id)
      ->get();
    
    return view('SearchandSeizures.SearchDetails',compact('search','search_id'))
      ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function commissionUpdateSearch($search_id)
    {

      $Recommendationstatus = DB::table('tbl_recommendationstatuses_lookup')->get();
      $searchdetails = DB::table('tbl_case_mainsearches')->where('search_id',$search_id)->get();
      
      return view('SearchandSeizures.CommissionReviewUpdate',compact('searchdetails','Recommendationstatus','search_id'))
      ->with('i', (request()->input('page', 1) - 1) * 5);
    }

     public function updateCommissionSearch(Request $request)
    {
      // $newData = Mainseizure::find($seizure_id);
      $commissionStatus = $request->input('commissionStatusSearch');
      $commissionReview = $request->input('commissionReviewSearch');
      $search_id = $request->input('searchidupdate');


      DB::table('tbl_case_mainsearches')->where('search_id', $search_id)
                   ->update(array(
                   'commissionStatus'=>$commissionStatus,
                   'commissionReview'=>$commissionReview,
                   ));
                 
                   Alert::success('You\'ve Successfully updated Search application status');
                   return Redirect::back();
    }

     public function seizureAdd($search_id, $case_no_id)
    {
      $searchforseizure = DB::table('tbl_case_mainsearches')
        ->where('search_id',$search_id)
        ->where('commissionStatus', 'Approved')
        ->get();

     
      
      $typeseizures = DB::table('seizuretypes')
        ->get();  

      return view('SearchandSeizures.SeizureDetails',compact('searchforseizure','search_id','typeseizures','case_no_id'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function viewseizuredetails($search_id)
    {
      $search = DB::table('tbl_case_mainsearches')
      ->where('search_id',$search_id)
      ->get();

      $seizuredetailsdigitalitems = DB ::table('mainseizures')
      ->where('search_id',$search_id)
      ->where('seizure_type','Digital Items')
      ->get();

      $seizuredetailsemails = DB ::table('mainseizures')
      ->where('search_id',$search_id)
      ->where('seizure_type','Emails')
      ->get();

      $seizuredetailssocialmedia = DB ::table('mainseizures')
      ->where('search_id',$search_id)
      ->where('seizure_type','Social Media')
      ->get();

      $seizuredetailspassport = DB ::table('mainseizures')
      ->where('search_id',$search_id)
      ->where('seizure_type','Passport')
      ->get();

    return view('SearchandSeizures.SeizureDetailsView',compact('search','search_id','seizuredetailsdigitalitems','seizuredetailsemails','seizuredetailssocialmedia','seizuredetailspassport'))
      ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function saveGeneral(Request $request)
    {
      $search_id = $request->searchidseizureadd;
      $seziures = new Seizures;
      $seziures -> case_no_id = $request -> casenoidseizureadd;
      $seziures -> search_id = $request -> searchidseizureadd;
      $seziures -> SeziureDate = $request -> seziureDate;
      $seziures -> SeizureTime = $request -> seziureTime;
      
      $seziures -> SeizedFromName = $request -> seizedName;
      $seziures -> SeizedFromCid = $request -> seizedCid;
      // $file = $request -> file('seizeddoc');
      // $filepath = $file -> getClientOriginalName();
      // Storage:: putFileAs('SeizedDoc',$file,$filepath);
      // $seziures -> SeizureDoc = $filepath;
      $seziures -> Created_at = Carbon::Now();
      $seziures -> save();
      $seizureid = $request -> searchidseizureadd;
      //save witness
      $witness = new Seziurewitness;
      $witness -> WitnessName = $request -> witnessName;
      $witness -> WitnessCid = $request -> witnessCid;
      $witness -> SeizureId = $seizureid;
      $witness -> save();

      Mainsearch::where('search_id', $search_id)
      ->update(array(
      'seizureStatus'=>"Seized"
      ));

           //Loop save for digital
      $count1 = $request ->item;
      if($count1 != "")
      {
      for($i = 0; $i < count($count1); $i++){

        $Digital = new Mainseizure;
        $Digital -> case_no_id = $request -> casenoidseizureadd;
        $Digital -> search_id = $request -> searchidseizureadd;
        $Digital->item = $request->item[$i];
        $Digital->manufacturer = $request->manufacturer[$i];
        $Digital->model = $request->model[$i];
        $Digital->serialNo = $request->serial[$i];
        $Digital->condition = $request->condition[$i];
        $Digital->seizure_id = $seizureid;
        $Digital->seizure_type = "Digital Items";
        $Digital->save();
          }
    }

     //Loop save for email
     $count2 = $request ->email;
     if($count2 != "")
     {
     for($i = 0; $i < count($count2); $i++){

       $Email = new Mainseizure;
       $Email -> case_no_id = $request -> casenoidseizureadd;
       $Email -> search_id = $request -> searchidseizureadd;
       $Email->email = $request->email[$i];
       $Email->password = $request->password[$i];
       $Email->oldpassword = $request->oldpassword[$i];
       $Email->phoneNo = $request->phoneNo[$i];
       $Email->inbox = $request->inbox[$i];
       $Email->sent = $request->sent[$i];
       $Email->draft = $request->draft[$i];
       $Email->trash = $request->trash[$i];
       $Email->spam = $request->spam[$i];
       $Email->seizure_id = $seizureid;
       $Email->seizure_type = "Emails";
       $Email->save();
   }}

   //Loop save for social media
   $count3 = $request ->platform;
   if($count3 != "")
   {
   for($i = 0; $i < count($count3); $i++){

     $Socialmedia = new Mainseizure;
     $Socialmedia -> case_no_id = $request -> casenoidseizureadd;
     $Socialmedia -> search_id = $request -> searchidseizureadd;
     $Socialmedia->platform = $request->platform[$i];
     $Socialmedia->account_name = $request->accountform[$i];
     $Socialmedia->social_password = $request->password[$i];
     $Socialmedia->social_old_password = $request->oldpassword[$i];
     $Socialmedia->remarks = $request->remarks[$i];
     $Socialmedia->seizure_id = $seizureid;
     $Socialmedia->seizure_type = "Social Media";
     $Socialmedia->save();
 }}

  //Loop save for passport
  $count4 = $request ->passportno;
  if($count4 != "")
  {
  for($i = 0; $i < count($count4); $i++){

    $Passport = new Mainseizure;
    $Passport -> case_no_id = $request -> casenoidseizureadd;
    $Passport -> search_id = $request -> searchidseizureadd;
    $Passport->passport_no = $request->passportno[$i];
    $Passport->name = $request->name[$i];
    $Passport->issue_date = $request->issuedate[$i];
    $Passport->expiry_date = $request->expirydate[$i];
    $Passport->remarks = $request->remarks[$i];
    $Passport->seizure_id = $seizureid;
    $Passport->seizure_type = "Passport";
    $Passport->save();
}
  }
//Loop save for currency
$count5 = $request ->typeOfCurrency;
if($count5 != "")
{
for($i = 0; $i < count($count5); $i++){

  $Currency = new Mainseizure;
  $Currency -> case_no_id = $request -> casenoidseizureadd;
  $Currency -> search_id = $request -> searchidseizureadd;
  $Currency->currency_type = $request->typeOfCurrency[$i];
  $Currency->denomination = $request->denominations[$i];
  $Currency->frequency = $request->frequency[$i];
  $Currency->amount = $request->amount[$i];
  $Currency->remarks = $request->remarks[$i];
  $Currency->seizure_id = $seizureid;
  $Currency->seizure_type = "Currency";
  $Currency->save();
}
}
Alert::success('You\'ve Successfully added Seized Items Details');
      return Redirect::back();
  }

  public function updateSelectedRows(Request $request)
    {
        $selectedIds = $request->input('selected');
        $newStatus = 'Sent to Forensics'; // set the new status here
        
        DB::table('mainseizures')
            ->whereIn('seizure_id', $selectedIds)
            ->update(['status' => $newStatus]);
        
        $seizeddigitalitems = DB::table('mainseizures')->select('*')
            ->where('seizure_type', '=', 'Digital Items')
            ->get(); 
        
            foreach ($seizeddigitalitems as $seizeddigitalitem) {
              Mainforensic::create([
                  'item' => $seizeddigitalitem->item,
                  'manufacturer' => $seizeddigitalitem->manufacturer,
                  'model' => $seizeddigitalitem->model,
                  'serialNo' => $seizeddigitalitem->serialNo,
                  'condition' => $seizeddigitalitem->condition,
              ]);
          }

            Alert::success('You\'ve Successfully sent items to Forensics');
            return Redirect::back();
    }
}
