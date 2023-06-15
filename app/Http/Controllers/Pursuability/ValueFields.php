<?php

namespace App\Http\Controllers\Pursuability;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint\ce_pltblpvsubcategory;
use App\Models\Complaint\ce_pltblpvaluefields;
use Redirect;
use Alert;
class ValueFields extends Controller
{
    public function index()
    {
        $data = [];
        $data['data'] = ce_pltblpvaluefields::where('isDelete','0')->get();
        $data['subcategory'] = ce_pltblpvsubcategory::where('isDelete','0')->get();
        return view('pursuability.value_feild',$data);
    }

    public function delete($id)
    {
        ce_pltblpvaluefields::where('pValueFieldID',$id)->update(['isDelete'=>'1']);
        Alert::success('You\'ve Successfully Deleted A Feild');
        return Redirect::back();
    }

    public function insert(Request $request)
    {
        // return $request;
        $new = new ce_pltblpvaluefields;
        $new->pValueSubCategoryID = $request->pValueSubCategoryID;
        $new->pValueFieldName = $request->pValueFieldName;

        $new->pValueFieldAllocatePoint = $request->pValueFieldAllocatePoint;
        $new->pValueFieldRemarks = $request->pValueFieldRemarks;
        
        $new->save();
        Alert::success('You\'ve Successfully Added A Feild');
        return Redirect::back();
    }

    public function update(Request $request)
    {
        ce_pltblpvaluefields::where('pValueFieldID',$request->id)->update([
            'pValueSubCategoryID'=>$request->pValueSubCategoryID,
            'pValueFieldName'=>$request->pValueFieldName,

            'pValueFieldAllocatePoint'=>$request->pValueFieldAllocatePoint,
            'pValueFieldRemarks'=>$request->pValueFieldRemarks,
            
        ]);
        Alert::success('You\'ve Successfully Updated A Feild');
        return Redirect::back();
    }

    public function masters()
    {
        return view('masters');
    }
}
