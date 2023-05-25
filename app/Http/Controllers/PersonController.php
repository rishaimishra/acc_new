<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use Redirect;
use DB;
use Storage;

class PersonController extends Controller
{
    public function savemainentity(Request $request)
        {
            $data = $request->all();
            $type = $data['persontype'];

            if($type == "Bhutanese")
            {
                DB::table('tbl_entities')->insert([
                        'name' => $data['bhutanesename'],
                        'gender' => $data['bhutanesegender'],
                        'dateofbirth' => $data['bhutanesedob'],
                        'dzongkhag' => $data['bhutanesedzongkhag'],
                        'gewog' => $data['bhutanesegewog'],
                        'village' => $data['bhutanesevillage'],
                        'identification_no' => $data['bhutanesecid'],
                        'address' => $data['bhutaneseaddress'],
                        'contactno' => $data['bhutanesephone'],
                        'email' => $data['bhutaneseemail'],
                        'type'  => $data['persontype']
                    ]);
                }
            
            if($type == "NonBhutanese")
            {
            
                DB::table('tbl_entities')->insert([
                        'name' => $data['nonbhutanesename'],
                        'gender' => $data['nonbhutanesegender'],
                        'dateofbirth' => $data['nonbhutanesedob'],
                        'permanentaddress' => $data['nonbhutanesepermanentaddress'],
                        'identification_no' => $data['nonbhutanesepermit'],
                        'address' => $data['nonbhutaneseaddress'],
                        'contactno' => $data['nonbhutanesephone'],
                        'email' => $data['nonbhutaneseemail'],
                        'type'  => $data['persontype']
                    ]);
                }


           return response()->json(['success'=>'Data is successfully added']);
             
        }

        public function savecaseentity(Request $request)
        {
            $data = $request->all();
            $type = $data['persontype'];
            $casenoid = $data['personcasenoidadd'];
            $bhutanesephoto = $request->file('bhutanesephoto');  
            $nonbhutanesephoto = $request->file('nonbhutanesephoto');  
            $file_path  = $bhutanesephoto->getClientOriginalName();
            Storage::putFileAs('Entity', $bhutanesephoto, $file_path);

            $valueExists = DB::table('tbl_case_entities')->where('case_no_id', $casenoid)->where('identification_no',$request->bhutanesecid)->orWhere('identification_no',$request->nonbhutanesepermit)->exists();

            if ($valueExists) {
                Alert::success('Value already exists. Please add another value');
                    return Redirect::back();  
            }

           else
           {
            
            if($type == "Bhutanese")
            {
                
                DB::table('tbl_case_entities')->insert([
                        'name' => $data['bhutanesename'],
                        'gender' => $data['bhutanesegender'],
                        'dateofbirth' => $data['bhutanesedob'],
                        'dzongkhag' => $data['bhutanesedzongkhag'],
                        'gewog' => $data['bhutanesegewog'],
                        'village' => $data['bhutanesevillage'],
                        'identification_no' => $data['bhutanesecid'],
                        'address' => $data['bhutaneseaddress'],
                        'contactno' => $data['bhutanesephone'],
                        'email' => $data['bhutaneseemail'],
                        'type'  => $type,
                        'case_no_id' => $casenoid,
                        'entitytype' => $data['bhutanesepartytype'],
                        'involvement' => $data['bhutaneseinvolvement'],
                        'photopath' => $file_path
                    ]);

                // $id = DB::table('tbl_case_entities')->orderBy('id', 'desc')->value('id');
                // $file_name = $id.'_'.$file_path;
                
                

                    
                }
            
            if($type == "Non Bhutanese")
            {
            
                DB::table('tbl_case_entities')->insert([
                        'name' => $data['nonbhutanesename'],
                        'gender' => $data['nonbhutanesegender'],
                        'dateofbirth' => $data['nonbhutanesedob'],
                        'permanentaddress' => $data['nonbhutanesepermanentaddress'],
                        'identification_no' => $data['nonbhutanesepermit'],
                        'address' => $data['nonbhutaneseaddress'],
                        'contactno' => $data['nonbhutanesephone'],
                        'email' => $data['nonbhutaneseemail'],
                        'type'  => $type,
                        'case_no_id' => $casenoid,
                        'entitytype' => $data['nonbhutanesepartytype'],
                        'involvement' => $data['nonbhutaneseinvolvement'],
                        'photopath' => $file_path_nonbhutanese,
                        
                    ]);
                }

                Alert::success('Successful');
                    return Redirect::back(); 
            
                }
             
        }
}
