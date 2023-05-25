@extends('layouts.admin')
@section('content')
<br>
@include('investigator/mainheader')
    <!------------------------ end top part ---------------->  
<div class="col-sm-13" style="margin-top:-9px;">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                @include('tabs/investigator_tab')
            </div>
            <div class="card-body">
                @include('tabs/entity_tab')
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <br>
                        @if(Auth::user()->role == "Investigator")
                            <i class="fa fa-building" style="float:right; color:grey" onclick="showaddasset()" onmouseover="this.style.color='#333333';" onmouseout="this.style.color='grey';" data-toggle="tooltip" data-placement="bottom" title="Add Asset"><span style="font-size: 10px; margin-top: 10px;">+</span></i>
                        @endif
                        <br>
                        <div class="header" style="background-color:#D3D3D3;height:40px; border-radius:5px; margin-top:10px;">&nbsp;&nbsp;<font color='#000000' size="5.2" face="Product Sans">Asset</font></div>
                        <br>
                            <table class="table table-bordered table-hover">
                                <thead >
                                    <tr>
                                        <th>Asset Type</th>
                                        <th>Owner</th>
                                        <th>CID</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($entityasset->count())
                                        @foreach ($entityasset as $asset)
                                        <tr>   
                                            <td>{{ $asset->asset_type }}</td>
                                            <td>{{ $asset->owner }}</td>
                                            <td>{{ $asset->ownerCID }}</td>
                                            <td></td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5"> No record found </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                </div>
            </div>
        </div>
</div>

<!--add modal -->
<form method = "POST" action=""  enctype="multipart/form-data" >
      @csrf    
<div class="modal fade" id="addasset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" >
            <div class="modal-content" style="font-family:Product Sans">                                                                                                                                                                                         <div class="modal-header alert-info">
                    <h5 class="modal-title" id="exampleModalLabel">Add iDiary</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                                <div class="col-md-6">
                                    <label>Asset Type: </label><br> &nbsp;&nbsp;
                                        <input type="radio" name="alfabet"  value="yes" onclick="showlanddiv();"> Land &nbsp;
                                        <input type="radio" name="alfabet" value="no" onclick="showbuildingdiv()"> Building  </label>
                                        <input type="radio" name="alfabet"  value="yes" onclick="showvehiclediv();"> Vehicle &nbsp;
                                        <input type="radio" name="alfabet" value="no" onclick="showbankdiv()"> Bank  </label>
                                </div>
                            </div>
                            <br>
                            <div id="landdiv" style="display:none"> 
                                <div class= "row"> 
                                    <div class   = "col-md-6">
                                        <div class  = "form-group">
                                            <label for   = "exampleInputEmail1">CID&nbsp;<font color='red'>*</font></label>
                                                <input name="landcid" id="landcid" onchange="getLandDetailsByCID()" class="form-control" type="text" />
                                        </div>
                                    </div>
                                </div>
                                <div id="getlanddetails" style="display:none">
                                <form action="" method="POST">
                                    @csrf 
                                    <input type="hidden" id="case_no_id_land" name="case_no_id_land" value="{{ $casenoid }}">
                                    <div class= "row"> 
                                        <div class   = "col-md-6">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Plot No&nbsp;<font color='red'>*</font></label>
                                                    <input name="assetplotno" id="assetplotno"  class="form-control" type="text" readonly value="xyz" />
                                            </div>
                                        </div>
                                        <div class   = "col-md-6">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Thram No&nbsp;<font color='red'>*</font></label>
                                                    <input name="assetplotno" id="assetthramno"  class="form-control" type="text" readonly value="xyz"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class= "row"> 
                                        <div class   = "col-md-6">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Area&nbsp;<font color='red'>*</font></label>
                                                    <input name="assetarea" id="assetarea"  class="form-control" type="text" readonly value="xyz"/>
                                            </div>
                                        </div>
                                        <div class   = "col-md-6">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Owner&nbsp;<font color='red'>*</font></label>
                                                    <input name="landowner" id="landowner"  class="form-control" type="text" readonly value="xyz"/>
                                            </div>
                                        </div>
                                    </div>
                                    <h3>Location</h3>
                                    <div class= "row"> 
                                        <div class   = "col-md-6">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Dzongkhag&nbsp;<font color='red'>*</font></label>
                                                    <input name="landdzongkhag" id="landdzongkhag"  class="form-control" type="text" readonly value="xyz"/>
                                            </div>
                                        </div>
                                        <div class   = "col-md-6">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Gewog/Thromde&nbsp;<font color='red'>*</font></label>
                                                    <input name="landthromde" id="landthromde"  class="form-control" type="text" readonly value="xyz"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class= "row"> 
                                        <div class   = "col-md-6">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Village/Lap&nbsp;<font color='red'>*</font></label>
                                                    <input name="landvillage" id="landvillage"  class="form-control" type="text" readonly value="xyz"/>
                                            </div>
                                        </div>
                                        <div class   = "col-md-6">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Address&nbsp;<font color='red'>*</font></label>
                                                    <textarea name="landaddress" id="landaddress"  class="form-control" type="text" readonly value="xyz"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <h3>Involvement</h3>
                                    <br>
                                    <div class= "row"> 
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Party Type&nbsp;<font color='red'>*</font></label>
                                                    <select class="form-control" name="landpartytype" id="landpartytype" required>
                                                        <option value="">Select Party Type</option>
                                                            @foreach ($partytypes as $ptypes)
                                                                <option value="{{ $ptypes->party_type_id }}">{{ $ptypes->party_type }}</option>
                                                            @endforeach    
                                                    </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class= "row"> 
                                        <div class   = "col-md-12">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Involvement&nbsp;<font color='red'>*</font></label>
                                                    <textarea name="landinvolvement" id="landinvolvement"  class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" id="changestatusbutton" name="changestatusbutton" style="float:right;" class="btn btn-light"  data-toggle="tooltip" data-placement="bottom" title="Save" ><i class="fa fa-save"></i></button> 
                                </form>
                                </div>
                            </div>
                            <div id="vehiclediv" style="display:none"> 
                                <div class= "row"> 
                                    <div class   = "col-md-6">
                                        <div class  = "form-group">
                                            <label for   = "exampleInputEmail1">CID&nbsp;<font color='red'>*</font></label>
                                                <input name="assetvehiclecid" id="assetvehiclecid" onchange="getVehicleDetailsByCID()" class="form-control" type="text" />
                                        </div>
                                    </div>
                                </div>
                                <div id="getvehicledetails" style="display:none">
                               
                                    <input type="hidden" id="case_no_id_vehicle" name="case_no_id_vehicle" value="{{ $casenoid }}">
                                    <div class= "row"> 
                                        <div class   = "col-md-6">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Vehicle Type&nbsp;<font color='red'>*</font></label>
                                                    <input type="text" name="vehicletype" id="vehicletype"  class="form-control" readonly value="xyz">
                                            </div>
                                        </div>
                                        <div class   = "col-md-6">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Registration No&nbsp;<font color='red'>*</font></label>
                                                    <input name="vehicleregistrationno" id="vehicleregistrationno"  class="form-control" type="text" readonly value="xyz"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class= "row"> 
                                        <div class   = "col-md-6">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Registration Date&nbsp;<font color='red'>*</font></label>
                                                <input name="vehicleregistrationdate" id="vehicleregistrationdate"  class="form-control" type="date" readonly value="02-01-2023"/>
                                            </div>
                                        </div>
                                        <div class   = "col-md-6">
                                            <div class  = "form-group">
                                            <label for   = "exampleInputEmail1">Owner&nbsp;<font color='red'>*</font></label>
                                                <input name="vehicleowner" id="vehicleowner"  class="form-control" type="text" readonly value="xyz"/>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <h3>Involvement</h3>
                                    <br>
                                    <div class= "row"> 
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Party Type&nbsp;<font color='red'>*</font></label>
                                                    <select class="form-control" name="vehiclepartytype" id="vehiclepartytype" required>
                                                        <option value="">Select Party Type</option>
                                                            @foreach ($partytypes as $ptypes)
                                                                <option value="{{ $ptypes->party_type_id }}">{{ $ptypes->party_type }}</option>
                                                            @endforeach    
                                                    </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class= "row"> 
                                        <div class   = "col-md-12">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Involvement&nbsp;<font color='red'>*</font></label>
                                                    <textarea name="vehicleinvolvement" id="vehicleinvolvement"  class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" id="changestatusbutton" name="changestatusbutton" style="float:right;" class="btn btn-light"  data-toggle="tooltip" data-placement="bottom" title="Save" ><i class="fa fa-save"></i></button> 
                                </form>
                                </div>
                            </div>
                            <div id="buildingdiv" style="display:none"> 
                                <div class= "row"> 
                                    <div class   = "col-md-6">
                                        <div class  = "form-group">
                                            <label for   = "exampleInputEmail1">CID&nbsp;<font color='red'>*</font></label>
                                                <input name="assetbuildingcid" id="assetbuildingcid" onchange="getBuildingDetailsByCID()" class="form-control" type="text" />
                                        </div>
                                    </div>
                                </div>
                                <div id="getbuildingdetails" style="display:none"> 
                               
                                    <input type="hidden" id="case_no_id_building" name="case_no_id_building" value="{{ $casenoid }}">
                                    <div class= "row"> 
                                        <div class   = "col-md-6">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Plot No&nbsp;<font color='red'>*</font></label>
                                                    <input name="buildingplotno" id="buildingplotno"  class="form-control" type="text" readonly value="xyz"/>
                                            </div>
                                        </div>
                                        <div class   = "col-md-6">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Thram No&nbsp;<font color='red'>*</font></label>
                                                    <input name="buildingthramno" id="buildingthramno"  class="form-control" type="text" readonly value="xyz"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class= "row"> 
                                        <div class   = "col-md-6">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Land Area/PLR:&nbsp;<font color='red'>*</font></label>
                                                    <input name="landareaplr" id="landareaplr"  class="form-control" type="text" /readonly value="xyz">
                                            </div>
                                        </div>
                                        <div class   = "col-md-6">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Building/House/Flat No:&nbsp;<font color='red'>*</font></label>
                                                    <input name="buildingno" id="buildingno"  class="form-control" type="text" readonly value="xyz"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class= "row"> 
                                        <div class   = "col-md-6">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">No of Units:&nbsp;<font color='red'>*</font></label>
                                                    <input name="landnoofunits" id="landnoofunits"  class="form-control" type="text" readonly value="xyz"/>
                                            </div>
                                        </div>
                                        <div class   = "col-md-6">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Owner&nbsp;<font color='red'>*</font></label>
                                                    <input name="buildingowner" id="buildingowner"  class="form-control" type="text" readonly value="xyz"/>
                                            </div>
                                        </div>
                                    </div>
                                    <h3>Location</h3>
                                    <div class= "row"> 
                                        <div class   = "col-md-6">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Dzongkhag&nbsp;<font color='red'>*</font></label>
                                                    <input name="buildingdzongkhag" id="buildingdzongkhag"  class="form-control" type="text" readonly value="xyz"/>
                                            </div>
                                        </div>
                                        <div class   = "col-md-6">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Gewog/Thromde&nbsp;<font color='red'>*</font></label>
                                                    <input name="buildingthromde" id="buildingthromde"  class="form-control" type="text" readonly value="xyz"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class= "row"> 
                                        <div class   = "col-md-6">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Village/Lap&nbsp;<font color='red'>*</font></label>
                                                    <input name="buildingvillage" id="buildingvillage"  class="form-control" type="text" readonly value="xyz"/>
                                            </div>
                                        </div>
                                        <div class   = "col-md-6">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Address&nbsp;<font color='red'>*</font></label>
                                                    <textarea name="buildingaddress" id="buildingaddress"  class="form-control" type="text" readonly>xyz</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <h3>Involvement</h3>
                                    <br>
                                    <div class= "row"> 
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Party Type&nbsp;<font color='red'>*</font></label>
                                                    <select class="form-control" name="buildingpartytype" id="buildingpartytype" required>
                                                        <option value="">Select Party Type</option>
                                                            @foreach ($partytypes as $ptypes)
                                                                <option value="{{ $ptypes->party_type_id }}">{{ $ptypes->party_type }}</option>
                                                            @endforeach    
                                                    </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class= "row"> 
                                        <div class   = "col-md-12">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Involvement&nbsp;<font color='red'>*</font></label>
                                                    <textarea name="buildinginvolvement" id="buildinginvolvement"  class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" id="changestatusbutton" name="changestatusbutton" style="float:right;" class="btn btn-light"  data-toggle="tooltip" data-placement="bottom" title="Save" ><i class="fa fa-save"></i></button> 
                                </form>
                                </div>
                            </div>
                            <div id="bankdiv" style="display:none"> 
                                <div class= "row"> 
                                    <div class   = "col-md-6">
                                        <div class  = "form-group">
                                            <label for   = "exampleInputEmail1">CID&nbsp;<font color='red'>*</font></label>
                                                <input name="bankcid" id="bankcid" onchange="getBankDetailsByCID()" class="form-control" type="text" />
                                        </div>
                                    </div>
                                </div>
                                <div id="getbankdetails" style="display:none"> 
                                 
                                    <input type="hidden" id="case_no_id_bank" name="case_no_id_bank" value="{{ $casenoid }}">
                                    <div class= "row"> 
                                        <div class   = "col-md-6">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Bank Name&nbsp;<font color='red'>*</font></label>
                                                    <input name="bankname" id="bankname"  class="form-control" type="text" readonly value="xyz"/>
                                            </div>
                                        </div>
                                        <div class   = "col-md-6">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Bank Account Type&nbsp;<font color='red'>*</font></label>
                                                    <input name="bankaccounttype" id="bankaccounttype"  class="form-control" type="text" readonly value="xyz"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class   = "col-md-6">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Owner&nbsp;<font color='red'>*</font></label>
                                                    <input name="bankaccountowner" id="bankaccountowner"  class="form-control" type="text" readonly value="xyz"/>
                                            </div>
                                        </div>
                                        <div class   = "col-md-6">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Account No&nbsp;<font color='red'>*</font></label>
                                                    <input name="bankaccountno" id="bankaccountno"  class="form-control" type="text" readonly value="xyz"/>
                                            </div>
                                        </div>
                                    </div>
                                    <h3>Involvement</h3>
                                    <br>
                                    <div class= "row"> 
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Party Type&nbsp;<font color='red'>*</font></label>
                                                    <select class="form-control" name="bankpartytype" id="bankpartytype" required>
                                                        <option value="">Select Party Type</option>
                                                            @foreach ($partytypes as $ptypes)
                                                                <option value="{{ $ptypes->party_type_id }}">{{ $ptypes->party_type }}</option>
                                                            @endforeach    
                                                    </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class= "row"> 
                                        <div class   = "col-md-12">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Involvement&nbsp;<font color='red'>*</font></label>
                                                    <textarea name="bankinvolvement" id="bankinvolvement"  class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--end add modal -->

<!-- edit modal -->
  <form method="POST" action="" enctype="multipart/form-data">
                            @csrf
    <div class="modal fade" id="editasset">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Idiary</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="idiaryid" id="idiaryid">
                    <div id="editidiaryshow" style="display:none">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    </form>

<!-- end edit modal -->
<script>
	function showaddasset()
        {
             $('#addasset').modal('show');
        }
    
    function showlanddiv()
        {
            $('#landdiv').show();
            $('#buildingdiv').hide();
            $('#vehiclediv').hide();
            $('#bankdiv').hide();
        }
    function showbuildingdiv()
        {
            $('#landdiv').hide();
            $('#buildingdiv').show();
            $('#vehiclediv').hide();
            $('#bankdiv').hide();
        }
    function showvehiclediv()
        {
            $('#landdiv').hide();
            $('#buildingdiv').hide();
            $('#vehiclediv').show();
            $('#bankdiv').hide();
        }
    function showbankdiv()
        {
            $('#landdiv').hide();
            $('#buildingdiv').hide();
            $('#vehiclediv').hide();
            $('#bankdiv').show();
        }
    function getLandDetailsByCID()
        {
            $('#getlanddetails').show();
        }
    function getVehicleDetailsByCID()
    {
        $('#getvehicledetails').show();
    }
    function getBankDetailsByCID()
    {
        $('#getbankdetails').show();
    }
    function getBuildingDetailsByCID()
    {
        $('#getbuildingdetails').show();
    }
    
</script>
@endsection