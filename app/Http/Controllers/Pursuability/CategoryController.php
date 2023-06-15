<?php

namespace App\Http\Controllers\Pursuability;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint\ce_pltblpvaluecategory;
use App\Models\Complaint\ce_pltblpvsubcategory;
use Redirect;
use Alert;
class CategoryController extends Controller
{
    public function index()
    {
        $data = [];
        $data['data'] = ce_pltblpvaluecategory::where('isDelete','0')->get();
        return view('pursuability.category',$data);
    }

    public function delete($id)
    {
        $check = ce_pltblpvsubcategory::where('pValueCategoryID',$id)->where('isDelete','0')->first();
        if (@$check!="") {
            Alert::error('Category can not be deleted as it is associated with subcategory');
            return Redirect::back();
        }
        ce_pltblpvaluecategory::where('pValueCategoryID',$id)->update(['isDelete'=>'1']);
        Alert::success('You\'ve Successfully Deleted A Category');
        return Redirect::back();
    }

    public function insert(Request $request)
    {
        $new = new ce_pltblpvaluecategory;
        $new->pValueName = $request->pValueName;
        $new->pValueRemarks = $request->pValueRemarks;
        $new->save();
        Alert::success('You\'ve Successfully Added A Category');
        return Redirect::back();
    }

    public function update(Request $request)
    {
        ce_pltblpvaluecategory::where('pValueCategoryID',$request->id)->update([
            'pValueName'=>$request->pValueName,
            'pValueRemarks'=>$request->pValueRemarks,
        ]);
        Alert::success('You\'ve Successfully Updated A Category');
        return Redirect::back();
    }
}
