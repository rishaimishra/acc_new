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
                @include('tabs/investigationplan_tab')
                <div class="tab-content" id="custom-tabs-four-tabContent">
                     @if(Auth::user()->role == "Investigator")
                    <br><i class="fa fa-plus" style="float:right; color:grey" onclick="addnewactionplan()" onmouseover="this.style.color='#333333';" onmouseout="this.style.color='grey';"  data-toggle="tooltip" data-placement="bottom" title="Add ActionPlan"></i>
                     @endif
                    <br>
                      <div class="header" style="background-color:#D3D3D3;height:40px; border-radius:5px; margin-top:10px;">&nbsp;&nbsp;<font color='#000000' size="5.2" face="Product Sans"> Section 3: Action Plan</font></div>
                      <br>
                        <br><br>
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
                                                <th>Status</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody id="actionplanbody">
                                                @foreach($taskactivities as $act)  
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $act->task}}</td>
                                                    <td>{{ $act->description}}</td>
                                                    <td>{{ $act->priority}}</td>
                                                    <td><?php echo $key=DB::table('users')->where('email',$act->assigned_to)->value('name') ?></td>
                                                    <td>{{ $act->status}}</td>
                                                    <td>
                                                      @if(Auth::user()->email == $act->assigned_to)                                                      
                                                            <i onclick="editactionplanstatus('{{ $act->id}}')" class="fa fa-edit" style="float:right; color:blue; " onmouseover="this.style.color='#333333';" onmouseout="this.style.color='blue';"  data-toggle="tooltip" data-placement="bottom" title="Edit Action plan status"></i></a>
                                                      @endif
                                                      </td>
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


                    <a href="{{route('viewhypo', $casenoid)}}" style="float:right; color:grey"><i class='fa fa-arrow-circle-left'  data-toggle="tooltip" data-placement="bottom" title="Previous"></i> Previous</a> 
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

    

<!-- add modal -->
  <form method="POST" action="{{ route('add_action_plan') }}" enctype="multipart/form-data">
                            @csrf
    <div class="modal fade" id="addactionplan" style="font-family: Product Sans;"> 
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Action Plan</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="casenoidaddactionplan" id="casenoidaddactionplan" value="{{ $casenoid }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="casetitle">Start Date: </label><br>
                                        {{ \Carbon\Carbon::parse($invplanstartdate)->format('d/m/Y')}}
                                        <input type="hidden" name="startdateactionplan" id="startdateactionplan" value="{{ $invplanstartdate }}">
                                        
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="casetitle">End Date:</label><br>
                                       {{ \Carbon\Carbon::parse($invplanenddate)->format('d/m/Y')}}
                                </div>
                            </div>
                            </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="casetitle">Activity Category:<font color='red'>*</font></label>
                                        <select class="form-control"   name="actionplantaskactivityadd" id="actionplantaskactivityadd" required>
                                            <option value="">Select</option>
                                                @foreach ($tasktypes as $tasktype)
                                                    <option >{{ $tasktype->task_name }}</option>
                                                @endforeach    
                                        </select>
                                </div>
                            </div>
                           
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="casetitle">Cycle:<font color='red'>*</font></label>
                                        <select class="form-control"   name="actionplantaskcycle" id="actionplantaskcycle" onchange="showdates()">
                                            <option value="">--Select One--</option>
                                            <option value="Weekly">Weekly</option>
                                            <option value="Fortnightly">Fortnightly</option>
                                            <option value="Monthly">Monthly</option>
                                        </select>
                                    
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group"> 
                                    <table class="table table-bordered" id="tasktable">
                                        <thead>
                                            <th>Task</th>
                                            <th>Description</th>
                                            <th>Priority</th>
                                            <th>Assigned To</th>
                                        </thead>
                                        <tbody id="actionplanbody">
                                            <tr>
                                                <td><input type="text" name="actionplantask[]" id="actionplantask[]" class='form-control'></td>
                                                <td><input type="text" name="actionplandesc[]" id="actionplandesc[]" class='form-control'></td>
                                                <td>
                                                    <select class="form-control"   name="actionplanpriority[]" id="actionplanpriority[]" >
                                                        <option>Select Priority</option>
                                                            @foreach ($priority as $priority)
                                                                <option value = "{{ $priority->priority_type }}">{{ $priority->priority_type }}</option>
                                                            @endforeach    
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class  = "form-control" name="actionplanassignedto[]" id="actionplanassignedto[]" onchange="showadhoc()">
                                                        <option>Select</option>
                                                            @foreach ($useresults as $userusers)
                                                                <option value  = "{{ $userusers->assigned_to }}"><?php echo $key=DB::table('users')->where('email',$userusers->assigned_to)->value('name'); ?> </option>                                                                       </option>
                                                            @endforeach 
                                                    </select>
                                                </td>
                                                <td><i class="fa fa-plus" style="color:green" onclick="addtask()"></i></td>    
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    </form>

<!-- end add modal -->


<!-- add modal -->
  <form method="POST" action="{{ route('updateactionplanstatus') }}" enctype="multipart/form-data">
                            @csrf
    <div class="modal fade" id="editactionplanstatusmodal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Status</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="actionplanstatuseditid" id="actionplanstatuseditid">
                        <div class="row">
                            <div class="col-sm-10">
                                <label>Status&nbsp;<font color='red'>*</font></label>
                                    <select name="actionplanstatus" id="actionplanstatus" class="form-control" required>
                                        <option>Please Select</option>
                                        <option value="Complete">Complete</option>
                                        <option value="Discontinue" >Discontinue</option>
                                    </select> 
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Change</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- end add modal -->
<script>

	function addnewactionplan()
    {
        $('#addactionplan').modal('show');  

    }

    function editactionplanstatus(id)
    {
        $('#editactionplanstatusmodal').modal('show'); 
        $('#actionplanstatuseditid').val(id);
        
    }

    function addtask() {
        
        html = '<tr>';
        html += '<td><input type="text" name="actionplantask[]" id="actionplantask[]" class="form-control"></td><td><input type="text" name="actionplandesc[]" id="actionplandesc[]" class="form-control"></td><td><select class="form-control" name="actionplanpriority[]"><option value="">Select Priority</option><option value="High">High</option> <option value = "Low">Low</option><option value="Medium">Medium</option></select></td><td><select class="form-control" name="actionplanassignedto[]"><option value="">Please Select One</option> @foreach ($useresults as $users)<option value = "{{ $users->assigned_to }}"><?php echo $key=DB::table('users')->where('email',$users->assigned_to)->value('name'); ?></option>@endforeach</select></td><td><i class="fa fa-minus" style="color:red" onclick="removetask()"></i></td>'
        html += '</tr>'

        $('#actionplanbody').append(html);
    }
    
    function removetask() 
    {
        var $tableBody = $('#tasktable').find("tbody"),
        $trLast = $tableBody.find("tr:last"),
        $trNew = $trLast.remove();
    }

    
</script>
<style>
    .modal-header {
        background: linear-gradient(to top, grey, #ffffff);
        color: #000;
        border-radius: 5px 5px 0 0;
        font-family: Product Sans;
        }
</style>
@endsection