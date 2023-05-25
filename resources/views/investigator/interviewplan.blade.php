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
                @include('tabs/interviewplan_tab')
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <br>
                    @if(Auth::user()->role == "Investigator")
                    <i class="fa fa-plus" style="float:right; color:grey" onclick="addnewinterviewplan()" data-toggle="tooltip" data-placement="bottom" title="Add Person"></i>
                        @endif

                        <br> 
                            <div id="interviewplanindex">
                                <br>
                                <table id= "example4" class="table table-bordered table-hover">
                                    <thead >
                                        <tr>
                                            <th>Date</th>
                                            <th>Interviewee</th>
                                            <th>Defences</th>
                                            <th>Facts Already Established</th>
                                            <th>Location</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($interviewplans as $plans)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($plans->interview_date)->format('d/m/Y')}}</td>
                                                <td><?php echo $key=DB::table('tbl_case_entities')->where('identification_no',$plans->accused)->where('case_no_id',$casenoid)->value('name'); ?></td>
                                                <td>{{ $plans->defences }}</td>
                                                <td>{{ $plans->facts_established }}</td>
                                                <td>{{ $plans->location }}</td>
                                                <td> @if ($plans->status == 1)
                                                        <label class="text-success">Sent for Review</label>
                                                        @elseif($plans->status == 2)
                                                        <label class="text-success">Reviewed</label>
                                                        @elseif($plans->status == 3)
                                                        <label class="text-success">Summon Order Printed</label>
                                                        @elseif($plans->status == 4)
                                                        <label class="text-success">Report Printed</label>
                                                        @endif
                                                </td>
                                                <td>
                                                    @if(Auth::user()->role == "Investigator")
                                                        @if($plans->status == 2)
                                                             <button  class="btn btn-success btn-sm" title="Generate" onclick="showsummonorder('{{ $plans->id }}')">Generate</button>
                                                        @elseif($plans->status == 3)
                                                             <button  class="btn btn-success btn-sm" title="Report" onclick="showinterviewreport('{{ $plans->id }}')">Report</button>
                                                        @endif
                                                    @endif
                                                    @if(Auth::user()->role == "Chief")
                                                        @if($plans->status == 1)
                                                            <button class  = "btn btn-outline-primary btn-sm"  type="button" onclick="showinterviewdtlsreview('{{ $plans->id }}')" data-toggle="tooltip" data-placement="bottom" title="Review">Review</button>
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
<form method = "POST" action="{{ route('add_interview_plan') }}"  enctype="multipart/form-data" >
      @csrf    
<div class="modal fade" id="addinterviewplan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" >
            <div class="modal-content" style="font-family:Product Sans">                                                                                                                                                                                         <div class="modal-header alert-info">
                    <h5 class="modal-title" id="exampleModalLabel">Add Interview Plan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Interviewee <font color='red'>*</font></label>
                                    <select class="form-control" name="interviewaccused" id="interviewaccused" >
                                        <option value="">Select Interviewee</option>
                                            @foreach ($accused as $ent)
                                                <option value="{{ $ent->identification_no }}">{{ $ent->name }}</option>
                                            @endforeach    
                                    </select> 
                                    <input type="hidden" name="interviewplancasenoidadd" class="form-control" value="{{ $casenoid }}" />                                 
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Date of Interview&nbsp;<font color='red'>*</font></label>
                                     <input type="date" id="interviewdate" name="interviewdate" class="form-control">
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Interviewer <font color='red'>*</font></label>
                                    <select class="interviewers" multiple="multiple"   name="interviewers[]" id="interviewers" >
                                        <option value="">Select Interviewers</option>
                                            @foreach ($interviewers as $int)
                                                <option value="{{ $int->email }}">{{ $int->name }}</option>
                                            @endforeach    
                                    </select>                               
                            </div>
                        </div>                                                
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Location&nbsp;<font color='red'>*</font></label>
                                     <input type="text" id="interviewlocation" name="interviewlocation" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                               <label>Defences&nbsp;<font color='red'>*</font></label>
                                    <textarea class="form-control" name="interviewdefences" id="interviewdefences" rows="3" required></textarea>                                                       
                            </div>
                        </div>                                                
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Facts Already Established&nbsp;<font color='red'>*</font></label>
                                     <textarea class="form-control" name="facts_altready_established_add" id="facts_altready_established_add" rows="3" required></textarea>
                            </div>
                        </div>
                    </div> 
                   
                    <table class="table" id="addevidencetable">
                        <thead>
                        <th>Points to Prove</th>
                        <th>Facts to Determine</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td><br>
                                <input class="form-control" type="text" name="interview_points" id="interview_points" > 
                                </td>
                                <td>
                                    <table class="table no-border" >
                                        <tbody id="tablebody">
                                            <tr>
                                                <td><input type="text" name="interviewplan_facts[]" id="interviewplan_facts[]" class='form-control'></td>
                                                <td><i class="fa fa-plus" style="color:green" onclick="test()"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td> 
                            </tr>
                        </tbody>
                    </table> 
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
  <form  method = "POST" action="{{ route('updateinterviewplan') }}" enctype="multipart/form-data">
    @csrf 
<div class="modal fade" id="displayinterviewplanmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg  modal-dialog-scrollable" >
            <div class="modal-content">
                <div class="modal-header alert-secondary">
                    <h5 class="modal-title" >Interview Plan Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="displayinterviewplandetails" style="display:none">
                            <input type="hidden" name="interviewplanid" id="interviewplanid">
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Status&nbsp;</label><br>
                                    <select id="status" name="status" class="form-control">
                                        <option>Please choose one</option>
                                        <option value="Reviewed">Reviewed</option>
                                    </select>
                            </div>
                        </div> 
                    </div>
                            
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-primary"  name="addButton" id="addButton" data-toggle="tooltip" data-placement="bottom" title="Update" >Update</button> 
                </div>
            </div>
        </div>
    </div>
</form>
<!-- end edit modal -->

<!-- edit modal -->
  <form  method = "POST" action="{{ route('printsummonorder') }}" enctype="multipart/form-data">
    @csrf 
<div class="modal fade" id="displaysummonordermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl  modal-dialog-scrollable" >
            <div class="modal-content">
                <div class="modal-header alert-secondary">
                    <h5 class="modal-title" >Summon Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="interviewplanidforsummonorder" id="interviewplanidforsummonorder">
                    <div id="displayinterviewplandetailsforsummonorder" style="display:none"></div>

                    <hr style="height: 1px;  background: teal; margin: 10px 0;   box-shadow: 0px 0px 4px 2px rgba(204,204,204,1);">        
                    <div id="displaysummonorder" style="display:none"></div>
                       
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-primary"  name="addButton" id="addButton" data-toggle="tooltip" data-placement="bottom" title="Update" >Print Summon Order</button> 
                </div>
            </div>
        </div>
    </div>
</form>
<!-- end edit modal -->


<!-- edit modal -->
  <form  method = "POST" action="{{ route('displayinterviewreport') }}" enctype="multipart/form-data">
    @csrf 
<div class="modal fade" id="displayinterviewreportmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl  modal-dialog-scrollable" >
            <div class="modal-content">
                <div class="modal-header alert-secondary">
                    <h5 class="modal-title" >Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="interviewplanidforinterviewreport" id="interviewplanidforinterviewreport">
                    <div id="displayinterviewplandetailsinterviewreport" style="display:none"></div>
                    <hr style="height: 1px;  background: teal; margin: 10px 0;   box-shadow: 0px 0px 4px 2px rgba(204,204,204,1);">        
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Type of Interview </label><br>
                                        <select  name="interviewtype" id="interviewtype" class="form-control">
                                            <option value="">Select Type</option>
                                                @foreach ($interviewtypes as $types)
                                                    <option value="{{ $types->interview_type }}">{{ $types->interview_type }}</option>
                                                @endforeach    
                                        </select> 
                                </div>                          
                                
                            </div>
                              <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Start Time </label><br>
                                      <input class="form-control" type="time" name="interviewstarttime" >                              
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>End Time </label><br>
                                      <input type="time" class="form-control"  name="interviewendtime" >                              
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="row">
                          <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Interview Summary&nbsp;</label><br>
                                       <textarea class="form-control" name="interviewsummary" id="interviewsummary" cols="5"></textarea> 
                                </div>
                            </div>
                        </div>
                         <div class="row">
                          <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Observation Summary&nbsp;</label><br>
                                       <textarea class="form-control" name="interviewobservationsummary" id="interviewobservationsummary" cols="5"></textarea> 
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
    <label class="col-sm-3 col-form-label">Interview Recorded<span style="font-weight: bold; color: red;">*</span></label>
    <div class="col-sm-1">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="interview_record_add" id="flexRadioDefault1" value="Yes">
            <label class="form-check-label" for="flexRadioDefault1">
                Yes
            </label>
        </div>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="interview_record_add" id="flexRadioDefault2" value="No">
        <label class="form-check-label" for="flexRadioDefault2">
            No
        </label>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Interview Recording URL<span style="font-weight: bold; color: red;">*</span></label>
    <div class="col-sm-3">
        <input name="url_add" class="form-control" type="text" required />
    </div>
    <label class="col-sm-2 col-form-label">Upload Recording File<span style="font-weight: bold; color: red;">*</span></label>
    <div class="col-sm-3">
        <input name="file_add" class="form-control" type="file" required />
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3 col-form-label">Written Statement<span style="font-weight: bold; color: red;">*</span></label>
    <div class="col-sm-1">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="written_statement_add" id="flexRadioDefaults1" value="Yes">
            <label class="form-check-label" for="flexRadioDefaults1">
                Yes
            </label>
        </div>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="written_statement_add" id="flexRadioDefaults2" value="No">
        <label class="form-check-label" for="flexRadioDefaults2">
            No
        </label>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Statement Written By<span style="font-weight: bold; color: red;">*</span></label>
    <div class="col-sm-3">
        <input name="statement_by_add" class="form-control" type="text" required />
    </div>
    <label class="col-sm-2 col-form-label">Statement Read By<span style="font-weight: bold; color: red;">*</span></label>
    <div class="col-sm-3">
        <input name="statement_read_by_add" class="form-control" type="text" required />
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Attach Statement<span style="font-weight: bold; color: red;">*</span></label>
    <div class="col-sm-3">
        <input name="statement_attached_add" class="form-control" type="file" required />
    </div>
</div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-primary"  name="addButton" id="addButton" data-toggle="tooltip" data-placement="bottom" title="Update" >Print Interview Report</button> 
                </div>
            </div>
        </div>
    </div>
</form>
<!-- end edit modal -->
<script>
	
    function addnewinterviewplan()
        {
            $('#addinterviewplan').modal('show');  
        }

    function showeditinterviewplan(id)
        {
            $('#interviewplanindex').hide();   
            $('#addinterviewdiv').hide();  
            $('#editinterviewdiv').show(); 
            $('#addinterviewplanbutton').hide();
            $('#closeinterviewplanbutt').show(); 
        }
    function closeinterviewplanadd()
        {
            $('#interviewplanindex').show();   
            $('#addinterviewdiv').hide();  
            $('#editinterviewdiv').hide(); 
            $('#addinterviewplanbutton').show(); 
            $('#closeinterviewplanbutt').hide();
        }
    
    function closeeditinterviewplan()
    {
            $('#interviewplanindex').show();   
            $('#addinterviewdiv').hide();  
            $('#editinterviewdiv').hide(); 
            $('#addinterviewplanbutton').show(); 
            $('#closeinterviewplanbutt').hide();
    }
    function test() {
        
        var html = "<tr><td><input type='text' class='form-control' name='case_evidence[]'></td><td><i class='fa fa-minus' style='color:red' onclick='remove()'></i></td></tr>";
        $('#tablebody').append(html);
    }
    
    function remove() {
        var $tableBody = $('#addevidencetable').find("tbody"),
        $trLast = $tableBody.find("tr:last"),
        $trNew = $trLast.remove();
    }

    function showinterviewdtlsreview(interviewplanid)
    {
        $('#interviewplanid').val(interviewplanid);
            $('#displayinterviewplanmodal').modal('show');

            var url = '{{ route("displayinterviewplandetails", ":interviewplanid") }}';
                    url = url.replace(':interviewplanid', interviewplanid);
                    
                    $.ajax({
                        
                        type:"GET",
                        url: url,
                        data: {search: $('#interviewplanid').val()},
                        success: function(responseText) {
                            
                            $("#displayinterviewplandetails").html(responseText);
                            $("#displayinterviewplandetails").show();
                           
                        }
                    });
    }

    function showsummonorder(interviewplanid)
    {
        $('#interviewplanidforsummonorder').val(interviewplanid);
            $('#displaysummonordermodal').modal('show');

            var url = '{{ route("displayinterviewplandetails", ":interviewplanid") }}';
                    url = url.replace(':interviewplanid', interviewplanid);
                    
                    $.ajax({
                        
                        type:"GET",
                        url: url,
                        data: {search: $('#interviewplanidforsummonorder').val()},
                        success: function(responseText) {
                            
                            $("#displayinterviewplandetailsforsummonorder").html(responseText);
                            $("#displayinterviewplandetailsforsummonorder").show();
                           
                        }
                    });

            var url = '{{ route("displaysummonorder", ":interviewplanid") }}';
                    url = url.replace(':interviewplanid', interviewplanid);
                    
                    $.ajax({
                        
                        type:"GET",
                        url: url,
                        data: {search: $('#interviewplanidforsummonorder').val()},
                        success: function(responseText) {
                            
                            $("#displaysummonorder").html(responseText);
                            $("#displaysummonorder").show();
                           
                        }
                    });
    }

    function showinterviewreport(interviewplanid)
    {
        $('#interviewplanidforinterviewreport').val(interviewplanid);
            $('#displayinterviewreportmodal').modal('show');

            var url = '{{ route("displayinterviewplandetails", ":interviewplanid") }}';
                    url = url.replace(':interviewplanid', interviewplanid);
                    
                    $.ajax({
                        
                        type:"GET",
                        url: url,
                        data: {search: $('#interviewplanidforinterviewreport').val()},
                        success: function(responseText) {
                            
                            $("#displayinterviewplandetailsinterviewreport").html(responseText);
                            $("#displayinterviewplandetailsinterviewreport").show();
                           
                        }
                    });

        
        
    }
</script>

@endsection