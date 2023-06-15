<?php

namespace App\Http\Controllers\Pursuability;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint\ce_pltblpvsubcategory;
use App\Models\Complaint\ce_pltblpvaluecategory;
use Redirect;
use Alert;
class SubCategoryController extends Controller
{
    public function index()
    {
        $data = [];
        $data['data'] = ce_pltblpvsubcategory::where('isDelete','0')->get();
        $data['category'] = ce_pltblpvaluecategory::where('isDelete','0')->get();
        return view('pursuability.sub_category',$data);
    }

    public function delete($id)
    {
        ce_pltblpvsubcategory::where('pValueSubCategoryID',$id)->update(['isDelete'=>'1']);
        Alert::success('You\'ve Successfully Deleted A SubCategory');
        return Redirect::back();
    }

    public function insert(Request $request)
    {
        // return $request;
        $new = new ce_pltblpvsubcategory;
        $new->pValueSubCategoryName = $request->pValueSubCategoryName;
        $new->pValueCategoryID = $request->pValueCategoryID;

        $new->maxScore = $request->maxScore;
        $new->allowMultiple = $request->allowMultiple;
        $new->pValueSubCategoryRemarks = $request->pValueSubCategoryRemarks;
        $new->save();
        Alert::success('You\'ve Successfully Added A SubCategory');
        return Redirect::back();
    }

    public function update(Request $request)
    {
        ce_pltblpvsubcategory::where('pValueSubCategoryID',$request->id)->update([
            'pValueCategoryID'=>$request->pValueCategoryID,
            'pValueSubCategoryName'=>$request->pValueSubCategoryName,

            'maxScore'=>$request->maxScore,
            'allowMultiple'=>$request->allowMultiple,
            'pValueSubCategoryRemarks'=>$request->pValueSubCategoryRemarks,
        ]);
        Alert::success('You\'ve Successfully Updated A SubCategory');
        return Redirect::back();
    }
}
