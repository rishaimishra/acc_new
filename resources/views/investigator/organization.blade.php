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
                            <i class="fa fa-university" style="float:right; color:grey" onclick="showaddorganization()" onmouseover="this.style.color='#333333';" onmouseout="this.style.color='grey';" data-toggle="tooltip" data-placement="bottom" title="Add Organization"><span style="font-size: 10px;">+</span></i>
                        @endif
                        <br>
                        <div class="header" style="background-color:#D3D3D3;height:40px; border-radius:5px; margin-top:10px;">&nbsp;&nbsp;<font color='#000000' size="5.2" face="Product Sans"> Organization</font></div>
                        <br>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Type</th>    
                                        <th>Address</th>
                                        <th>Agency</th>                                                                        
                                        <th>Sub Agency</th>                                                                        
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($entityorganization->count())
                                        @foreach ($entityorganization as $organization)
                                        <tr>   
                                            <td>{{ $organization->name }}</td>
                                            <td>{{ $organization->cid_no }}</td>
                                            <td>{{ $organization->pdzongkhag }}</td>                                                                        
                                            <td>{{ \Carbon\Carbon::parse($organization->permit_expiry_date)->format('d/m/Y')}}</td>
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
<div class="modal fade" id="addorganization" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" >
            <div class="modal-content" style="font-family:Product Sans">                                                                                                                                                                                         <div class="modal-header alert-info">
                    <h5 class="modal-title" id="exampleModalLabel">Add Organization</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Organization Type </label> &nbsp;&nbsp;
                                <input type="radio" name="alfabet"  value="yes" onclick="showbusinessdiv();"> Business &nbsp;
                                <input type="radio" name="alfabet" value="no" onclick="showgovtdiv()"> Government  </label>
                                <input type="radio" name="alfabet" value="no" onclick="showcorporationdiv()"> Corporation  </label>
                        </div>
                    </div>
                    <br>
                                <div id="businessdiv" style="display:none">
                                    <div class= "row"> 
                                        <div class   = "col-md-6">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">License No&nbsp;<font color='red'>*</font></label>
                                                    <input type="text" class="form-control" name="businesslicenseno" id="businesslicenseno" onchange="getDetailsByLicense()">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                <div id="showdetailsbusiness" style="display:none">
                                    <div class= "row"> 
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Business Name&nbsp;<font color='red'>*</font></label>
                                                    <input value="xyz" readonly name="businessname" id="businessname"  class="form-control" type="text" placeholder="Search CID"/>
                                            </div>
                                        </div>
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Location&nbsp;<font color='red'>*</font></label>
                                                    <input value="xyz" readonly name="businesslocation" id="businesslocation"  class="form-control" type="text" placeholder="Search CID"/>
                                            </div>
                                        </div>
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Owners&nbsp;<font color='red'>*</font></label>
                                                    <input value="xyz" readonly name="businessowners" id="businessowners"  class="form-control" type="text" placeholder="Search CID"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class= "row"> 
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">License Issue Date&nbsp;<font color='red'>*</font></label>
                                                    <input value="xyz" readonly name="nonbhutanesecidissuedate" id="nonbhutanesecidissuedate"  class="form-control" type="text" placeholder="Search CID"/>
                                            </div>
                                        </div>
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">License Expiry Date&nbsp;<font color='red'>*</font></label>
                                                    <input value="xyz" readonly name="nonbhutanesecidexpirydate" id="nonbhutanesecidexpirydate"  class="form-control" type="text" placeholder="Search CID"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class= "row">
                                        <div class   = "col-md-12">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Activity&nbsp;<font color='red'>*</font></label>
                                                <input type="text" value="xyz" readonly name="businessactivity" id="businessactivity"  class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    <h3>Contact Details</h3>
                                    <br>
                                    <div class= "row"> 
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Contact Person&nbsp;<font color='red'>*</font></label>
                                                    <input name="businesscontactperson" id="businesscontactperson"  class="form-control" type="text" placeholder="Name"/>
                                            </div>
                                        </div>
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Phone/Mobile Number&nbsp;<font color='red'>*</font></label>
                                                    <input name="businessphone" id="businessphone"  class="form-control" type="text" placeholder="Phone"/>
                                            </div>
                                        </div>
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Email&nbsp;<font color='red'>*</font></label>
                                                    <input name="businessemail" id="businessemail"  class="form-control" type="text" placeholder="Email"/>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                </div>
                                <div id="govtdiv" style="display:none">
                                    
                                    <div class= "row"> 
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Parent Agency&nbsp;<font color='red'>*</font></label>
                                                    <select class="form-control" name="govtparentagency" id="govtparentagency" required>
                                                        <option value="">Select Agency Type</option>
                                                            @foreach ($parentagency as $pagency)
                                                                <option value="{{ $pagency->parent_agency_id }}">{{ $pagency->parent_agency }}</option>
                                                            @endforeach    
                                                    </select>
                                            </div>
                                        </div>
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Agency Name&nbsp;<font color='red'>*</font></label>
                                                    <select class="form-control" name="govtagencyname" id="govtagencyname" required>
                                                        <option value="">Select Agency Name</option>
                                                            @foreach ($agencyname as $agency)
                                                                <option value="{{ $agency->agency_name_id }}">{{ $agency->agency_name }}</option>
                                                            @endforeach    
                                                    </select>
                                            </div>
                                        </div>
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Location&nbsp;<font color='red'>*</font></label>
                                                    <input value="xyz" readonly name="governmentlocation" id="governmentlocation"  class="form-control" type="text" placeholder="Search CID"/>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <h3>Contact Details</h3>
                                    <br>
                                    <div class= "row"> 
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Contact Person&nbsp;<font color='red'>*</font></label>
                                                    <input name="govtcontactperson" id="govtcontactperson"  class="form-control" type="text" placeholder="Search CID"/>
                                            </div>
                                        </div>
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Phone/Mobile Number&nbsp;<font color='red'>*</font></label>
                                                    <input name="govtcontactphone" id="govtcontactphone"  class="form-control" type="text" placeholder="Search CID"/>
                                            </div>
                                        </div>
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Email&nbsp;<font color='red'>*</font></label>
                                                    <input name="govtcontactemail" id="govtcontactemail"  class="form-control" type="text" placeholder="Search CID"/>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div id="corporationdiv" style="display:none">
                                    <div class= "row"> 
                                        <div class   = "col-md-6">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Agency Name&nbsp;<font color='red'>*</font></label>
                                                    <select class="form-control" name="corpagencyname" id="corpagencyname" required>
                                                        <option value="">Select Agency Name</option>
                                                            @foreach ($agencyname as $agency)
                                                                <option value="{{ $agency->agency_name_id }}">{{ $agency->agency_name }}</option>
                                                            @endforeach    
                                                    </select>
                                            </div>
                                        </div>
                                        <div class   = "col-md-6">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Location&nbsp;<font color='red'>*</font></label>
                                                    <input value="xyz" readonly name="corplocation" id="corplocation"  class="form-control" type="text" placeholder="Search CID"/>
                                            </div>
                                        </div>
                                    </div>
                                    <h3>Contact Details</h3>
                                    <br>
                                    <div class= "row"> 
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Contact Person&nbsp;<font color='red'>*</font></label>
                                                    <input name="corpcontactperson" id="corpcontactperson"  class="form-control" type="text" placeholder="Search CID"/>
                                            </div>
                                        </div>
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Phone/Mobile Number&nbsp;<font color='red'>*</font></label>
                                                    <input name="corpcontactphone" id="corpcontactphone"  class="form-control" type="text" placeholder="Search CID"/>
                                            </div>
                                        </div>
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Email&nbsp;<font color='red'>*</font></label>
                                                    <input name="corpcontactemail" id="corpcontactemail"  class="form-control" type="text" placeholder="Search CID"/>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <button type="button" style="float:right;" class="btn btn-outline-primary" onclick="closeaddperson()" name="closeaddpersonbutt" id="closeaddpersonbutt" data-toggle="tooltip" data-placement="bottom" title="Save" ><i class="fa fa-save"></i></button> 
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
    <div class="modal fade" id="editidiary">
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
	 function showaddorganization()
     {
        $('#addorganization').modal('show');
     }

     
    function showbusinessdiv() 
        {
            $('#businessdiv').show(1000); 
            $('#corporationdiv').hide();  
            $('#govtdiv').hide();                      
        }
    function showgovtdiv()
        {
            $('#businessdiv').hide(); 
            $('#corporationdiv').hide();  
            $('#govtdiv').show(1000); 
        }
    function showcorporationdiv()
        {
            $('#businessdiv').hide(); 
            $('#corporationdiv').show(1000);  
            $('#govtdiv').hide(); 
        }
    function getDetailsByLicense()
        {
            $('#showdetailsbusiness').show(700);
        }
</script>
@endsection