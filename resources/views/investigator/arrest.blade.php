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
            @include('tabs/oands_tab')
            <div class="tab-content" id="custom-tabs-four-tabContent">
                <br>
                        @if(Auth::user()->role == "Investigator")
                        <div style="float:right">
                            <i class="fa fa-plus" style="float:right; color:grey" onclick="addnewarrestrequest()" onmouseover="this.style.color='#333333';" onmouseout="this.style.color='grey';" data-toggle="tooltip" data-placement="bottom" title="Add Asset"></i>
                        </div>
                        @endif
                            <br>
                                <div id="arrestanddetentionshow">
                                    <table id = "example3" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th >Request Date</th>
                                                <th >Type of Arrest</th>
                                                <th >Suspect Name</th>
                                                <th >Application Status</th>
                                                <th >Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            @foreach ($arrests as $data)
                                            
                                                <td>{{ \Carbon\Carbon::parse($data->applicationdate)->format('d/m/Y')}}</td>
                                                <td>{{$data->typeofArrest}}</td>
                                                <td>{{$data->name}}</td>
                                                <td>
                                                    @if($data->commissionStatus=='Approved')
                                                        <label class="text-success">Approved</label>
                                                    @elseif($data->commissionStatus=='Rejected')
                                                        <label class="text-danger">Rejected</label>
                                                        @elseif($data->commissionStatus=='Detained')
                                                        <label class="text-danger">Detained</label>
                                                    @elseif($data->commissionStatus==0)
                                                        <label class="text-warning">Pending</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    
                                                    <!-- <button type="button"  class="btn btn-info btn-sm" onclick="addnewremand()" name="add" data-toggle="tooltip" data-placement="bottom" title="Add Remand">Remand</button> -->
                                                    @if($data->commissionStatus == 'Approved')
                                                            @if(Auth::user()->role == "Investigator")
                                                                <button class  = "btn btn-outline-primary"  type="button" onclick="showarrestdetailsfordetention('{{ $data->arrest_id }}')" data-toggle="tooltip" data-placement="bottom" title="Add Detention Details">Detain</button>      
                                                            @endif
                                                    @endif
                                                    @if($data->commissionStatus == 'Detained')
                                                            <button class  = "btn btn-outline-primary"  type="button" onclick="showdetentiondetails('{{ $data->arrest_id }}')" data-toggle="tooltip" data-placement="bottom" title="Details">Detention Details</button>
                                                            <button class  = "btn btn-outline-primary"  type="button" onclick="showdetentiondetailsforremand('{{ $data->arrest_id }}')" data-toggle="tooltip" data-placement="bottom" title="Add Remand Details">Remand</button> 
                                                    @else
                                                    <button class  = "btn btn-outline-primary"  type="button" onclick="showarrestdetails('{{ $data->arrest_id }}')" data-toggle="tooltip" data-placement="bottom" title="Details">Arrest Details</button> &nbsp;
                                                    @endif
                                                 
                                                @if($data->commissionStatus == '0')
                                                @if(Auth::user()->role == "Commission")
                                                
                                                <button class  = "btn btn-outline-primary"  type="button" onclick="showarrestdetailsforupdate('{{ $data->arrest_id }}')" data-toggle="tooltip" data-placement="bottom" title="Update"><i class="fa fa-pencil"></i></button>      
                                                @endif
                                                @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div> 
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>


<!--add modal -->
<form method = "POST" action="{{ route('addArrestdetails') }}"  enctype="multipart/form-data" >
      @csrf    
<div class="modal fade" id="addarrest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" >
            <div class="modal-content" style="font-family:Product Sans">                                                                                                                                                                                         <div class="modal-header alert-info">
                    <h5 class="modal-title" id="exampleModalLabel">Add Arrest</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                <input type="hidden" name="arrestcasenoadd" id="arrestcasenoadd" value="{{ $caseno }}">
                <input type="hidden" name="arrestcasenoidadd" id="arrestcasenoidadd" value="{{ $casenoid }}">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Type of Arrest & Detention Requested&nbsp;<font color='red'>*</font></label>
                                    <select class="form-control" name="typeofArrest">
                                        <option selected>Select an Option</option>
                                        <option value="With Court Warrant">With Court Warrant</option>
                                        <option value="Without Court Warrant">Without Court Warrant</option>
                                    </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Suspect Name&nbsp;<font color='red'>*</font></label>
                                    <select class="form-control"   name="suspect" id="suspect" >
                                        <option selected>Select an Option</option>
                                        @foreach($subjects as $subject)
                                            <option value="{{ $subject->id}}">{{ $subject->name}} [{{ $subject->identification_no}}]</option>
                                        @endforeach
                                    </select>                                    
                            </div>                                
                        </div>
                    </div>
                    <div class= "row">                  
                        <div class  = "col-md-6">
                            <div class="form-group">
                                <label>Location&nbsp;<font color='red'>*</font></label>
                                <input type="text" class="form-control" name="location" placeholder="Please Enter Location" >
                            </div>
                        </div>
                        <div class  = "col-md-6">
                            <div class="form-group">
                                <label>Application Date&nbsp;<font color='red'>*</font></label>
                                <input type="date" class="form-control" name="applicationdate">
                            </div>
                        </div>
                    </div>     
                    <div class= "row">                  
                        <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Probable Cause:&nbsp;<font color='red'>*</font></label>
                                    <textarea type="text" class="form-control" name="pcause" id="pcause" placeholder="Please Enter Probable Cause"></textarea>
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
  <form method="POST" action="{{ route('updateidiary') }}" enctype="multipart/form-data">
                            @csrf
    <div class="modal fade" id="editarrest">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Idiary</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="idiaryid" id="idiaryid">
                    <div id="editidiaryshow" style="display:none"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    </form>

<!-- end edit modal -->

<!-- edit modal -->
 
    <div class="modal fade" id="viewarrestdetailsmodal">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Arrest Details</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                        <div id="viewarrestdetails" style="display:none">
                            <input type="hidden" name="arrestid" id="arrestid">
                        </div>
                </div>
                
            </div>
        </div>
    </div>
  

<!-- end edit modal -->


<!-- edit modal -->
  <form method="POST" action="{{ route('updateCommissionArrest') }}" enctype="multipart/form-data">
                            @csrf
    <div class="modal fade" id="viewarrestdetailsforupdatemodal">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Arrest Details</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                        <div id="viewarrestdetailsforupdate" >
                                <input type="text" name="arrestidupdate" id="arrestidupdate">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    </form>

<!-- end edit modal -->
<!-- edit modal -->
  <form method="POST" action="{{ route('detentiondetailsadd') }}" enctype="multipart/form-data">
                            @csrf
    <div class="modal fade" id="showarrestdetailsfordetentionmodal">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detention Details</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="detentioncasenoidadd" id="detentioncasenoidadd" value="{{ $casenoid }}">
                    <input type="hidden" name="arrestidfordetention" id="arrestidfordetention">

                         <div id="viewdetentiondetails" style="display:none">  </div>
                         
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    </form>

<!-- end edit modal -->

<!-- edit modal -->
 
    <div class="modal fade" id="displaydetentiondetailsmodal">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detention Details</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div id="displaydetentiondetails" style="display:none">
                            <input type="hidden" name="arrestiddetentiondisplay" id="arrestiddetentiondisplay">
                    </div>
                </div>
               
            </div>
        </div>
    </div>
  

<!-- end edit modal -->


<!-- edit modal -->
    <form method = "POST" action="{{ route('detentiondetailsadd') }}"  enctype="multipart/form-data" >
                                        @csrf
    <div class="modal fade" id="showdetentiondetailsforremandmodal">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remand Details</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                        <div id="viewdetentiondetailsforremand" style="display:none">
                            <input type="hidden" name="arrestidremanddisplay" id="arrestidremanddisplay"> 
                        </div>
                </div>
               
            </div>
        </div>
    </div>
  
</form>
<!-- end edit modal -->
<script>
	function addnewarrestrequest()
        {
            $('#addarrest').modal('show');
        }
    
    function showarrestdetails(arrest_id)
        {
            $('#arrestid').val(arrest_id);
            $('#viewarrestdetailsmodal').modal('show');
            

            var url = '{{ route("arrestdetailsview", ":arrest_id") }}';
                    url = url.replace(':arrest_id', arrest_id);
                    
                    $.ajax({
                        
                        type:"GET",
                        url: url,
                        data: {search: $('#arrestid').val()},
                        success: function(responseText) {
                            
                            $("#viewarrestdetails").html(responseText);
                            $("#viewarrestdetails").show();
                            
                        }
                    });
        }

        function showdetentiondetails(arrest_id)
        {
            $('#arrestiddetentiondisplay').val(arrest_id);
            $('#displaydetentiondetailsmodal').modal('show');

            var url = '{{ route("detentiondetailsdisplay", ":arrest_id") }}';
                    url = url.replace(':arrest_id', arrest_id);
                    
                    $.ajax({
                        
                        type:"GET",
                        url: url,
                        data: {search: $('#arrestiddetentiondisplay').val()},
                        success: function(responseText) {
                            
                            $("#displaydetentiondetails").html(responseText);
                            $("#displaydetentiondetails").show();
                           
                        }
                    });
        }
    
        function showarrestdetailsforupdate(arrest_id)
        {
            $('#arrestidupdate').val(arrest_id);
             $('#viewarrestdetailsforupdatemodal').modal('show');

            var url = '{{ route("commissionUpdateAnD", ":arrest_id") }}';
                    url = url.replace(':arrest_id', arrest_id);
                    
                    $.ajax({
                        
                        type:"GET",
                        url: url,
                        data: {search: $('#arrestidupdate').val()},
                        success: function(responseText) {
                            
                            $("#viewarrestdetailsforupdate").html(responseText);
                            $("#viewarrestdetailsforupdate").show();
                            
                        }
                    });
        }

        function showarrestdetailsfordetention(arrest_id)
        {
            $('#arrestidfordetention').val(arrest_id);
            $('#showarrestdetailsfordetentionmodal').modal('show');

            var url = '{{ route("detentionAdd", ":arrest_id") }}';
                    url = url.replace(':arrest_id', arrest_id);
                    
                    $.ajax({
                        
                        type:"GET",
                        url: url,
                        data: {search: $('#arrestidfordetention').val()},
                        success: function(responseText) {
                            
                            $("#viewdetentiondetails").html(responseText);
                            $("#viewdetentiondetails").show();
                            
                        }
                    });
        }
        function showdetentiondetailsforremand(arrest_id)
        {
            $('#arrestidremanddisplay').val(arrest_id);
            $('#showdetentiondetailsforremandmodal').modal('show');
            var url = '{{ route("detentiondetailsdisplayforremand", ":arrest_id") }}';
                    url = url.replace(':arrest_id', arrest_id);
                    
                    $.ajax({
                        
                        type:"GET",
                        url: url,
                        data: {search: $('#arrestidremanddisplay').val()},
                        success: function(responseText) {
                            
                            $("#viewdetentiondetailsforremand").html(responseText);
                            $("#viewdetentiondetailsforremand").show();
                          
                        }
                    });
        }

    function closearrestdetails()
        {
                $('#addarrest').hide();
                $("#viewarrestdetails").hide();
                $('#arrestanddetentionshow').show();
                $('#addarrestanddetentionbutt').show();
        }

    function closearrestview()
        {
                $('#addarrest').hide();
                $("#viewarrestdetails").hide();
                $('#arrestanddetentionshow').show();
                $('#addarrestanddetentionbutt').show();
                $("#viewarrestdetails").hide();
        }

       
</script>
<style>
     .modal-header {
    background: linear-gradient(to top, grey, #ffffff);
    color: #fff;
    font-family: Product Sans;
    border-radius: 5px 5px 0 0;
}

</style>
@endsection