<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Redirect;
use Alert;
use Carbon\Carbon;

class EvidenceController extends Controller
{
    public function addevidences(Request $request)
    {
       
        
        $casenoid            = $request->input('evicasenoidadd');
        $evidencecat         = $request->input('evidencecat');
        $evidencesubcat      = $request->input('evidencesubcat');        
        $evidescription      = $request->input('evidescription');        
        $evidenceno          = $request->input('evidenceno');        
        $evisource           = $request->input('evidfrom');
        $evidencecolldate    = $request->input('collected_on');
        $evidname            = $request->input('evidname');

        // $attachment = $request->file('eviexhibit');
        // $file_path = $attachment->getClientOriginalName();
        // Storage::putFileAs('Evidences/',$casenoid, $attachment, $file_path);

        $data=array('case_no_id'=>$casenoid,'evidence_category'=>$evidencecat,
        'evidence_subcategory'=>$evidencesubcat,'collected_on'=>$evidencecolldate,
        'collected_by'=>Auth::user()->name,'evidence_description'=>$evidescription,
        'evidence_no'=>$evidenceno,'collected_from'=>$evisource,'evidence_name'=>$evidname,        
        'created_at' => Carbon::now());
        DB::table('tbl_case_evidences')->insert($data);

        Alert::success('You\'ve Successfully added an Evidence');
        return Redirect::back();
       
    }

    
    public function editevid($caseno)
    {
        $evidences= DB::table('tbl_case_evidences')
            ->where('id',$caseno)
            ->get();

        return view('evidences.editevidences',compact('evidences'));
    }

    public function updateevid(Request $request)
    {
        
        $id                = $request->input('evidenceid');
        $caseno            = $request->input('evicasenoupdate');
        $evidencecat       = $request->input('evidencecat');
        $evidencename      = $request->input('evidencename');        
        $evidescription    = $request->input('evidescription');        
        $evidenceno        = $request->input('evidenceno');        
        $evisource         = $request->input('evidsource');

        DB::table('tbl_case_evidences')->where('id', $id)
                    ->update(array(                                     
                        'evidence_category'=>$evidencecat,
                        'evidence_name'=>$evidencename,
                        'evidence_description'=>$evidescription,
                        'evidence_no'=>$evidenceno,
                        'collected_from'=>$evisource,
                        'updated_at' => Carbon::now()
                             ));

        Alert::success('You\'ve Successfully updated an Evidence');
        return Redirect::back();

                           
    }

    public function generateevidenceno(Request $request)
    {
        $generatedEvidenceNo = null;
        
        $zerostring = "0";
        
        

        $evidencecategory = $request->evidencecat;

        $lastevidenceno =  DB::table('tbl_case_evidences')->select(['evidence_no'])->where('evidence_category' , $evidencecategory )->latest()->first();
        

        if(isset($lastevidenceno))
        {
            $pieces = explode("-", $lastevidenceno->evidence_no);
            $serialno = $pieces[2] + 1;
               dd($serialno);
        } 
        else
        {
            $serialno = 1;
        
        }

        

        
        if($evidencecategory == "Statement")
        {
            $generatedEvidenceNo ="RCO";
        }

        
        
        return response()->json($generatedEvidenceNo);
    }

}
