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
                        <i class="fa fa-user-plus" style="float:right; color:grey" onclick="showaddperson()" onmouseover="this.style.color='#333333';" onmouseout="this.style.color='grey';" data-toggle="tooltip" data-placement="bottom" title="Add Person"></i>
                        @endif
                        <br>
                        
                        <div class="header" style="background-color:#D3D3D3;height:40px; border-radius:5px; margin-top:10px;">&nbsp;&nbsp;<font color='#000000' size="5.2" face="Product Sans"> Person</font></div>
                        <br>
                        <div id="indexbhutanese">
                        
                        <!-- value="d4f6b858-8c7e-3ec7-ab7a-8f6c610a48c4" -->
                        <table class="table table-bordered">
                            <thead >
                            <tr>
                                <th>Profile Pic</th>
                                <th>Name</th>
                                <th>Identification No</th>  
                                <th>Nationality</th> 
                                <th>Gender</th>                                                                      
                                <th>Phone No</th>  
                                                                                                         
                                <th>Action</th>
                            </tr>
                            </thead>
                            @php
          $id = Auth::user()->id;
          $adminData = App\Models\User::find($id);
      @endphp
                            <tbody>
                        @if($entityperson->count())
                            @foreach ($entityperson as $person)
                            <tr>   
                                <td><img src = "{{ (!empty($adminData->profile_image))? url('upload/admin_images/'.$adminData->profile_image):url('upload/no_image.jpg') }}" class="rounded-circle header-profile-user" alt="User Image" style="height:35px;width:35px;"></td>
                                <td>{{ $person->name }}</td>
                                <td>{{ $person->identification_no }}</td> 
                                <td>{{ $person->type }}</td>
                                <td>{{ $person->gender }}</td>
                                <td>{{ $person->contactno }}</td>                                                                           
                                <td><button type="button" onclick="viewentitydetailscoi('{{ $person->id }}')"  id="viewdetails" name="viewdetails" data-toggle="tooltip" data-placement="bottom" title="View Details"><i class="fa fa-eye"></i></button></td>
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
            <!-- /.card -->
        </div>
    </div>

     <!-- ADD Person -->
   <form  method = "POST" action="{{ route('savecaseentity') }}" enctype="multipart/form-data">
    @csrf 
<div class="modal fade" id="addpersondiv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" >
            <div class="modal-content" style="font-family:Product Sans">                                                                                                                                                                                         <div class="modal-header alert-info">
                    <h5 class="modal-title" id="exampleModalLabel">Add Person</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Individual Type: </label><br> &nbsp;&nbsp;
                                    <input type="radio" name="persontype"  value="Bhutanese" onclick="showbhutanesediv();"> Bhutanese &nbsp;
                                    <input type="radio" name="persontype" value="Non Bhutanese" onclick="shownonbhutanesediv()"> Non Bhutanese  </label>
                                    <input type="hidden" name="personcasenoidadd" id="personcasenoidadd" value="{{ $casenoid }}">
                            </div>
                        </div>
                            <br>
                            
                            
                            <div id="bhutanesediv" style="display:none"> 
                            <input type="hidden" name="token" id="token" value="d4f6b858-8c7e-3ec7-ab7a-8f6c610a48c4"><br>
                                <div class= "row"> 
                                    <div class   = "col-md-6">
                                        <div class  = "form-group">
                                            <label for   = "exampleInputEmail1">CID&nbsp;<font color='red'>*</font></label>
                                                <input name="bhutanesecid" id="bhutanesecid" onchange="gettoken()" class="form-control" type="text" placeholder="Search CID"/>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div id="showcitizendetailsbhutanese" style="display:none">
                                    <div class= "row"> 
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Photo&nbsp;<font color='red'>*</font>(accepted format: jpg)</label>
                                                    <input  name="bhutanesephoto" id="bhutanesephoto"  class="form-control" type="file" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class= "row"> 
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Name&nbsp;<font color='red'>*</font></label>
                                                    <input readonly  name="bhutanesename" id="bhutanesename"  class="form-control" type="text" />
                                            </div>
                                        </div>
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Gender&nbsp;<font color='red'>*</font></label>
                                                    <input readonly name="bhutanesegender" id="bhutanesegender"  class="form-control" type="text" />
                                            </div>
                                        </div>
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Date of Birth&nbsp;<font color='red'>*</font></label>
                                                    <input value="xyz" readonly name="bhutanesedob" id="bhutanesedob"  class="form-control" type="text" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class= "row"> 
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Dzongkhag&nbsp;<font color='red'>*</font></label>
                                                    <input value="xyz" readonly name="bhutanesedzongkhag" id="bhutanesedzongkhag"  class="form-control" type="text" />
                                            </div>
                                        </div>
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Gewog&nbsp;<font color='red'>*</font></label>
                                                    <input value="xyz" readonly name="bhutanesegewog" id="bhutanesegewog"  class="form-control" type="text" />
                                            </div>
                                        </div>
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Village&nbsp;<font color='red'>*</font></label>
                                                    <input value="xyz" readonly name="bhutanesevillage" id="bhutanesevillage"  class="form-control" type="text" />
                                            </div>
                                        </div>
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <h3>Contact Details</h3>
                                    <br>
                                    <div class= "row"> 
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Address&nbsp;<font color='red'>*</font></label>
                                                    <input name="bhutaneseaddress" id="bhutaneseaddress"  class="form-control" type="text" placeholder="Current Address"/>
                                            </div>
                                        </div>
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Phone/Mobile Number&nbsp;<font color='red'>*</font></label>
                                                    <input name="bhutanesephone" id="bhutanesephone"  class="form-control" type="text" placeholder="Mobile No"/>
                                            </div>
                                        </div>
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Email&nbsp;</label>(optional)
                                                    <input name="bhutaneseemail" id="bhutaneseemail"  class="form-control" type="text" placeholder="Email"/>
                                            </div>
                                        </div>
                                    </div>
                                    <h3>Involvement</h3>
                                    <br>
                                    <div class= "row"> 
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Party Type&nbsp;<font color='red'>*</font></label>
                                                    <select class="form-control" name="bhutanesepartytype" id="bhutanesepartytype" >
                                                        <option value="">Select Party Type</option>
                                                            @foreach ($partytypes as $ptypes)
                                                                <option value="{{ $ptypes->party_type}}">{{ $ptypes->party_type }}</option>
                                                            @endforeach    
                                                    </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class= "row"> 
                                        <div class   = "col-md-12">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Involvement&nbsp;<font color='red'>*</font></label>
                                                    <textarea name="bhutaneseinvolvement" id="bhutaneseinvolvement"  class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                            </div>
                            <br>
                            <div  id="nonbhutanesediv" style="display:none"> 
                                <div class= "row"> 
                                    <div class   = "col-md-6">
                                        <div class  = "form-group">
                                            <label for   = "exampleInputEmail1">Work Permit&nbsp;<font color='red'>*</font></label>
                                                <input name="nonbhutanesepermit" id="nonbhutanesepermit" onchange="getDetailsByPermit()" class="form-control" type="text" placeholder="Search Permit"/>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div id="showcitizendetailsnonbhutanese" style="display:none">
                                
                                    <div class= "row"> 
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Name&nbsp;<font color='red'>*</font></label>
                                                    <input value="xyz" readonly name="nonbhutanesename" id="nonbhutanesename"  class="form-control" type="text" placeholder="Search CID"/>
                                            </div>
                                        </div>
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Gender&nbsp;<font color='red'>*</font></label>
                                                    <input value="xyz" readonly name="nonbhutanesegender" id="nonbhutanesegender"  class="form-control" type="text" />
                                            </div>
                                        </div>
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Date of Birth&nbsp;<font color='red'>*</font></label>
                                                    <input value="xyz" readonly name="nonbhutanesedob" id="nonbhutanesedob"  class="form-control" type="text" />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <h3>Permanent Address</h3>
                                    <div class= "row">
                                        <div class   = "col-md-12">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Address&nbsp;<font color='red'>*</font></label>
                                                <textarea name="nonbhutanesepermanentaddress" id="nonbhutanesepermanentaddress"  class="form-control" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <h3>Contact Details</h3>
                                    <br>
                                    <div class= "row"> 
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Address&nbsp;<font color='red'>*</font></label>
                                                    <input name="nonbhutaneseaddress" id="nonbhutaneseaddress"  class="form-control" type="text" placeholder="Address"/>
                                            </div>
                                        </div>
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Phone/Mobile Number&nbsp;<font color='red'>*</font></label>
                                                    <input name="nonbhutanesephone" id="nonbhutanesephone"  class="form-control" type="text" placeholder="Mobile No"/>
                                            </div>
                                        </div>
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Email&nbsp;<font color='red'>*</font></label>
                                                    <input name="nonbhutaneseemail" id="nonbhutaneseemail"  class="form-control" type="text" placeholder="Email"/>
                                            </div>
                                        </div>
                                    </div>
                                    <h3>Involvement</h3>
                                    <br>
                                    <div class= "row"> 
                                        <div class   = "col-md-4">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Party Type&nbsp;<font color='red'>*</font></label>
                                                    <select class="form-control" name="nonbhutanesepartytype" id="nonbhutanesepartytype" >
                                                        <option value="">Select Party Type</option>
                                                            @foreach ($partytypes as $ptypes)
                                                                <option value="{{ $ptypes->party_type }}">{{ $ptypes->party_type }}</option>
                                                            @endforeach    
                                                    </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class= "row"> 
                                        <div class   = "col-md-12">
                                            <div class  = "form-group">
                                                <label for   = "exampleInputEmail1">Involvement&nbsp;<font color='red'>*</font></label>
                                                    <textarea name="nonbhutaneseinvolvement" id="nonbhutaneseinvolvement"  class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                            </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-primary"  name="addButton" id="addButton" data-toggle="tooltip" data-placement="bottom" title="Save" >Save</button> 
                </div>
            </div>
        </div>
    </div>
</form>

<!-- FINISH ADD Person -->
<!-- show entity details modal -->
<div class="modal fade" id="show_entity_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg  modal-dialog-scrollable" >
            <div class="modal-content">
                <div class="modal-header alert-secondary">
                    <h5 class="modal-title" >Entity Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value=""  name="entityidcoi" id="entityidcoi">
                        <div id="entitydetailsshow" style="display:none;"></div>
                            
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end -->

<script>

    function showaddperson()
        {
            $('#addpersondiv').modal('show'); 
        }
        
    function closeaddperson()
        {
            $('#persondiv').hide();
            $('#addperson').show();
            $('#indexbhutanese').show();
        }
	function showbhutanesediv() 
        {
            $('#bhutanesediv').show(1000); 
            $('#nonbhutanesediv').hide();                       
        }

    function shownonbhutanesediv()
        {
            $('#bhutanesediv').hide()
            $('#nonbhutanesediv').show(1000);
        }

    
        
    function getDetailsByPermit()
        {
            $('#showcitizendetailsnonbhutanese').show(700);
        }
        
        function gettoken()
       {
         var url = "{{ route('gettoken')}}";
            $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: url,
            success: function (data) {
                console.log(data);
                $('#token').val(data);
            },
            error: function() { 
                console.log('error');
            }
        });

        getDetailsByCID();
       }

    function getDetailsByCID(){
        // console.log(_token);
         var cid = $('#bhutanesecid').val();
         var token = $('#token').val();
        // console.log(cid);
        $('#showcitizendetailsbhutanese').show(700);
        var settings = {
            "url": "https://apim.staging.api.gov.bt/dcrc_citizen_details_api/1.0.0/citizendetails/"+cid,
            "method": "GET",
            "timeout": 0,
            "headers": {
                "Authorization": "Bearer " + token,
                // "Cookie": "route=1658042636.829.53.968004"
            },
        };

        $.ajax(settings).done(function (response) {
            console.log(response.citizenDetailsResponse);
            var data = response.citizenDetailsResponse.citizenDetail[0];
            var middlename;
          if(response.citizenDetailsResponse.citizenDetail[0].middleName == null){
                middlename = '';
            } else {
                middlename = response.citizenDetailsResponse.citizenDetail[0].middleName;
            }
            if(response.citizenDetailsResponse.citizenDetail[0].gender == 'F'){
                gender = 'Female';
            } else {
                 gender = 'Male';
            }
            if(response.citizenDetailsResponse.citizenDetail.length >= 0){
                
                
                $("#bhutanesename").val(response.citizenDetailsResponse.citizenDetail[0].firstName +' '+ middlename +' '+ response.citizenDetailsResponse.citizenDetail[0].lastName); 
                $("#bhutanesedzongkhag").val(response.citizenDetailsResponse.citizenDetail[0].dzongkhagName); 
                $("#bhutanesevillage").val(response.citizenDetailsResponse.citizenDetail[0].gewogName); 
                $("#bhutanesegewog").val(response.citizenDetailsResponse.citizenDetail[0].villageName);
                $("#bhutanesedob").val(response.citizenDetailsResponse.citizenDetail[0].dob); 
                $("#bhutanesegender").val(gender);  
                 

            } else {
                alert('No details found');
            }
        });
        }

        function viewentitydetailscoi(id){
    
        $('#entityidcoi').val(id);
        $('#show_entity_details').modal('show');
    

   var url = '{{ route("searchentitydetails", ":id") }}';
            url = url.replace(':id', id);
               
            $.ajax({
                
                type:"GET",
                url: url,
                data: {search: $('#entityidcoi').val()},
                success: function(result) {
                    
                    $("#entitydetailsshow").html(result);
                    $("#entitydetailsshow").show();
                    
                }
            });
        }

        
</script>
<style>
    .modal-header {
    background: linear-gradient(to top, grey, #ffffff);
    color: #fff;
    border-radius: 5px 5px 0 0;
    font-family: Product Sans;
}


</style>
@endsection