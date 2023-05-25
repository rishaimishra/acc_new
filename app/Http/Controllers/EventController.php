<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Redirect;
use Alert;
use Carbon\Carbon;

class EventController extends Controller
{
    public function addevent(Request $request)
    {
       
        $casenoid            = $request->input('eventcasenoidadd');
        $eventname           = $request->input('eventname');
        $eventdate           = $request->input('eventdate');        
        $eventdescription    = $request->input('event_desc'); 
        $category            = $request->input('eventcategory');
        


        $data=array('case_no_id'=>$casenoid,'name'=>$eventname,'date'=>$eventdate,
        'description'=>$eventdescription,'category'=>$category,'conducted_by'=>Auth::user()->name,
         'created_at' => Carbon::now());
        DB::table('tbl_case_events')->insert($data);

        Alert::success('You\'ve Successfully added an Event');
        return Redirect::back();
    }
    

    public function editevent($id)
    {
        $events= DB::table('tbl_case_events')
            ->where('id',$id)
            ->get();

        return view('events.editevents',compact('events'));
    }

    public function updateevent(Request $request)
    {
        
        $id                = $request->input('editeventid');
        $eventname         = $request->input('eventname');
        $eventdate         = $request->input('eventdate');        
        $eventdescription  = $request->input('event_desc');

        DB::table('tbl_case_events')->where('id', $id)
                    ->update(array( 
                        'name'=>$eventname,
                        'date'=>$eventdate,
                        'description'=>$eventdescription,
                        'updated_at' => Carbon::now()
                             ));
                             Alert::success('You\'ve Successfully edited an Event');
                             return Redirect::back();

    }
}
