@extends('layouts.admin')

@section('content')
<br>
@include('investigator/mainheader')
    <!------------------------ end top part ---------------->
<!-- start-->
<div class="col-sm-13" style="margin-top:-9px;">
    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            @include('tabs/investigator_tab')
        </div>
        <div class="card-body">
            @if(Auth::user()->role == "Investigator")
            <!-- card body -->
                @include('tabs/investigationplan_tab')
                    <div class="tab-content">
                       
                            <br>
                                @if($invcount ==0)
                                    <i class="fa fa-plus" style="float:right; color:grey" onclick="addnewinvplan()" onmouseover="this.style.color='#333333';" onmouseout="this.style.color='grey';"  data-toggle="tooltip" data-placement="bottom" title="Add investigation plan"></i>
                                @else
                                 @foreach($investigationplans as $invplan)  
                                <br>
                                    <i onclick="editnewinvplan('{{ $invplan->id}}')" class="fa fa-edit" style="float:right; color:grey; " onmouseover="this.style.color='#333333';" onmouseout="this.style.color='grey';"  data-toggle="tooltip" data-placement="bottom" title="Edit investigation plan"></i></a>
                                <br>
                                    <div class="header" style="background-color:#D3D3D3;height:40px; border-radius:5px; margin-top:10px;">&nbsp;&nbsp;<font color='#000000' size="5.2" face="Product Sans"> Section 1: Overview</font></div>
                          
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <font face="Product Sans" color="Black">Start Date:</font>
                                    </div>
                                    <div class="col-md-9">
                                        <font face="Product Sans" color="Grey">{{ \Carbon\Carbon::parse($invplan->case_start_date)->format('d/m/Y')}}</font>
                                    </div>
                                </div>
                                <hr class="hrnew"></hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <font face="Product Sans" color="black">End Date:</font>
                                    </div>
                                    <div class="col-md-9">
                                        <font face="Product Sans" color="grey">{{ \Carbon\Carbon::parse($invplan->case_end_date)->format('d/m/Y')}}</font>
                                    </div>
                                </div>

                                <hr  class="hrnew"></hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <font face="Product Sans" color="black">Allegations/Background:</font>
                                    </div>
                                    <div class="col-md-9">
                                        <font face="Product Sans" color="grey">{{ $invplan->allegations}}</font>
                                    </div>
                                </div>
                                
                                <hr class="hrnew"></hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <font face="Product Sans" color="black">Objectives of Investigation:</font>
                                    </div>
                                    <div class="col-md-9">
                                        <font face="Product Sans" color="grey">{{ $invplan->objectives }}</font>
                                    </div>
                                </div>
                                
                                <hr  class="hrnew"></hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <font face="Product Sans" color="black">Scope of Investigation:</font>
                                    </div>
                                    <div class="col-md-9">
                                        <font face="Product Sans" color="grey">{{ $invplan->scope }}</font>
                                    </div>
                                </div>
                            
                                <hr  class="hrnew"></hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <font face="Product Sans" color="black">Probable Offences:</font>
                                    </div>
                                    <div class="col-md-9">
                                        @foreach($investigationplanoffences as $offenceinv)
                                            <font face="Product Sans" color="grey"> {{ $offenceinv->offence_type }}</font> <br>
                                        @endforeach
                                    </div>
                                </div>
                                <a href="{{route('viewhypo', $casenoid)}}" style="float:right; color:grey"><i class='fa fa-arrow-circle-right'  data-toggle="tooltip" data-placement="bottom" title="Next"></i> Next</a>
                            </div>
                        @endforeach
                        @endif
                    </div>
            <!-- end card body -->
        </div> 
        @elseif(Auth::user()->role == "Chief")
        <div class="tab-content">
         <!-- chief content -->
         @if($invcount ==0)
         No Plan Found
         @else
         @foreach($investigationplans as $invplan)  
            <br>
                    <div class="header" style="background-color:#D3D3D3;height:40px; border-radius:5px; margin-top:10px;">&nbsp;&nbsp;<font color='#000000' size="5.2" face="Product Sans"> Section 1: Overview </font><i style="float:right; color:black; margin-top: 10px;" class="fa fa-print" onmouseover="this.style.color='#333333';" onmouseout="this.style.color='grey';"  data-toggle="tooltip" data-placement="bottom" title="Print Investigation Plan"></i></div>
                        <div class="card-body">
                            <div class="row">
                                    <div class="col-md-3">
                                        <font face="Product Sans" color="Black">Start Date:</font>
                                    </div>
                                    <div class="col-md-9">
                                        <font face="Product Sans" color="Grey">{{ \Carbon\Carbon::parse($invplan->case_start_date)->format('d/m/Y')}}</font>
                                    </div>
                                </div>
                                <hr class="hrnew"></hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <font face="Product Sans" color="black">End Date:</font>
                                    </div>
                                    <div class="col-md-9">
                                        <font face="Product Sans" color="grey">{{ \Carbon\Carbon::parse($invplan->case_end_date)->format('d/m/Y')}}</font>
                                    </div>
                                </div>

                                <hr  class="hrnew"></hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <font face="Product Sans" color="black">Allegations/Background:</font>
                                    </div>
                                    <div class="col-md-9">
                                        <font face="Product Sans" color="grey">{{ $invplan->allegations}}</font>
                                    </div>
                                </div>
                                
                                <hr class="hrnew"></hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <font face="Product Sans" color="black">Objectives of Investigation:</font>
                                    </div>
                                    <div class="col-md-9">
                                        <font face="Product Sans" color="grey">{{ $invplan->objectives }}</font>
                                    </div>
                                </div>
                                
                                <hr  class="hrnew"></hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <font face="Product Sans" color="black">Scope of Investigation:</font>
                                    </div>
                                    <div class="col-md-9">
                                        <font face="Product Sans" color="grey">{{ $invplan->scope }}</font>
                                    </div>
                                </div>
                            
                                <hr  class="hrnew"></hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <font face="Product Sans" color="black">Probable Offences:</font>
                                    </div>
                                    <div class="col-md-9">
                                        @foreach($investigationplanoffences as $offenceinv)
                                            <font face="Product Sans" color="grey"> {{ $offenceinv->offence_type }}</font> <br>
                                        @endforeach
                                    </div>
                                </div>
                            
                        @endforeach
                    @endif
                    <br>
                      <div class="header" style="background-color:#D3D3D3;height:40px; border-radius:5px; margin-top:10px;">&nbsp;&nbsp;<font color='#000000' size="5.2" face="Product Sans"> Section 2: Hypothesis</font></div>
                      <br>
                        <table class="table ">
                            <tr>
                                <th>Hypothesis</th>
                                <th>Evidence</th>
                                <th>Evaluation Status</th>
                                <th>Evaluated On</th>
                                <th>Action</th>
                                    
                            </tr>
                            @if($hypothesis->count())
                            
                                @foreach ($uniqueValues as $key => $values)
                                    <tr>
                                        <td>{{ $key }}</td>
                                        <td>
                                            @foreach($values as $hypo)
                                                {{ $hypo->evidence }} <br>
                                            @endforeach
                                        </td>
                                    @foreach ($values as $value)
                                        <td>{{ $value->evaluation_status }}</td>
                                        <td>{{ \Carbon\Carbon::parse($value->evaluated_on)->format('d/m/Y')}}</td>
                                        <td></td>
                                    </tr>
                                    @endforeach 
                                 @endforeach
                                
                            @else
                            <tr>
                                <td colspan="5"> No record found </td>
                            </tr>
                            @endif
                        </table> 
                        <br>
                      <div class="header" style="background-color:#D3D3D3;height:40px; border-radius:5px; margin-top:10px;">&nbsp;&nbsp;<font color='#000000' size="5.2" face="Product Sans"> Section 3: Action Plan</font></div>
                      <br><br><br>
                      @if($actionplans->count())
                        @php($i=0)
                        @foreach($actionplans as $actplans)
                        <!-- action plan accordian -->
                           <div id="accordion" style="margin-top:-40px;">
                                <div class="card">
                                    <div class="card-header custom-header" id="headingOne_{{ $i}}">
                                        <h5 class="mb-0">
                                            &nbsp; &nbsp; 
                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo_{{ $i}}" aria-expanded="true" aria-controls="collapseTwo_{{ $i}}">
                                                    <font color='#000000'  size="3"  face="Product Sans"> Week {{ $actplans->weekname}} &nbsp; [{{ \Carbon\Carbon::parse($actplans->actionplanstartdate)->format('d/m/Y')}}  to {{ \Carbon\Carbon::parse($actplans->actionplanenddate)->format('d/m/Y')}}]</font>
                                            </button>
                                            </h5>
                                    </div>

                                    
                                <div id="collapseTwo_{{ $i}}" class="collapse hide" aria-labelledby="headingOne_{{ $i}}" data-parent="#accordion">
                                    <div class="card-body">
                                        <!-- Content Start-->
                                        <table class="table table-bordered" id="tasktable">
                                            <thead>
                                                <td>Sl No</td>
                                                <th>Task Name</th>
                                                <th>Description</th>
                                                <th>Priority</th>
                                                <th>Assigned To</th>
                                            </thead>
                                            <tbody id="actionplanbody">
                                                @foreach($taskactivities as $act)  
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $act->task}}</td>
                                                    <td>{{ $act->description}}</td>
                                                    <td>{{ $act->priority}}</td>
                                                    <td><?php echo $key=DB::table('users')->where('email',$act->assigned_to)->value('name'); ?></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <!-- Content End-->
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                       @php($i++)
                        <!-- end action plan -->
                        @endforeach
                        @else
                        No record found
                        @endif
                </div>

         <!-- end chief content -->
        </div>
        @endif
    </div>
</div>
<!--end -->

<!--add modal -->
<form method = "POST" action="{{ route('add_investigation_plan') }}"  enctype="multipart/form-data" >
      @csrf    
<div class="modal fade" id="addinvplan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" >
            <div class="modal-content">                                                                                                                                                                                         <div class="modal-header alert-info">
                    <h5 class="modal-title" id="exampleModalLabel">Add Overview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <font face="Product Sans" color="Grey">Start Date:<font color='red'>*</font></font>
                                <input type="date" name="case_start_date" id="case_start_date" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <font face="Product Sans" color="Grey">Expected End Date:<font color='red'>*</font></font>
                                <input type="date" name="case_end_date" onchange="calculatedays()" id="case_end_date" class="form-control" required="">
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="invplancasenoadd" id="invplancasenoadd" value="{{ $caseno }}">
                    <input type="hidden" name="invplancasenoidadd" id="invplancasenoidadd" value="{{ $casenoid }}">
                    <input type="hidden" name="dayscalculated" id="dayscalculated" value="">
                    <input type="hidden" name="registration_date_invplan" class="form-control" id="registration_date_invplan" value="{{ $caseregistrationdate }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <font face="Product Sans" color="Grey">Allegations/Background:<font color='red'>*</font></font>
                                <textarea name="case_allegations" id="case_allegations" class="form-control"
                                    required=""></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <font face="Product Sans" color="Grey">Objectives:<font color='red'>*</font></font>
                                <textarea name="case_objectives" id="case_objectives" class="form-control"
                                    required=""></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <font face="Product Sans" color="Grey">Probable Offence:<font color='red'>*</font></font>
                                <select class="offence_type_invplan" multiple="multiple" name="offence_type_invplan[]" required>
                                    <option value="">Select Offence Type</option>
                                    @foreach ($offencetypes as $offence)
                                    <option>{{ $offence->offence_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <font face="Product Sans" color="Grey">Scope:<font color='red'>*</font></font>
                                <textarea name="case_scope" id="case_scope" class="form-control" required=""></textarea>
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
  <form method="POST" action="{{ route('updateinvplan') }}" enctype="multipart/form-data">
                            @csrf
    <div class="modal fade" id="editinvplanmodal">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Plan</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="invplaneditid" id="invplaneditid">
                    <input type="hidden" name="invplancasenoupdate" id="invplancasenoupdate" value="{{ $caseno }}">
                    <input type="hidden" name="invplancasenoidupdate" id="invplancasenoidupdate" value="{{ $casenoid }}">
                    <div id="showeditinvplan" style="display:none;"> </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    </form>

<!-- end edit modal -->

<style>
.hrnew {
  border: none;
  border-top: 2px dotted #ccc;
  height: 15px;
  margin: 10px 0;
}


.tabs {
    display: block;
    justify-content: space-between;
    margin-bottom: 10px;
    width: 600px;
}

.tablinks {
    background-color: #fff;
    border: none;
    color: grey;
    font-family: Product Sans;
    cursor: pointer;
    padding: 10px;
    width: 17.33%;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}

/* Change the background color of active tab */
.tablinks.active {
    border-bottom: 3px solid #007BFF;
    font-family: Product Sans;
    color: #007BFF;
    
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 20px;
    background-color: #fff;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
}

/* Show the active tab */
.tabcontent.show {
    display: block;
}

    .modal-header {
    background: linear-gradient(to top, #BFABA2, #ffffff);
    color: #000;
    font-family: Product Sans;
    border-radius: 5px 5px 0 0;
}
</style>
<script>


function addnewinvplan() {
    
    $('#addinvplan').modal('show');  

}

function editnewinvplan(id)
{
    $('#editinvplanmodal').modal('show'); 
    $('#invplaneditid').val(id);

    var url = '{{ route("editinvplan", ":id") }}';
    url = url.replace(':id', id);

    $.ajax({

        type: "GET",
        url: url,
        data: {
            search: $('#invplaneditid').val()
        },
        success: function(responseText) {

            $("#showeditinvplan").html(responseText);
            $("#showeditinvplan").show();
        }
    });
}



</script>
@endsection