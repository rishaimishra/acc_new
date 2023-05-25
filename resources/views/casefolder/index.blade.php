@extends('layouts.admin')

@section('content')

<br>
<section class="content">
    <div id="casedetailscard" class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header" style="font-family:Product Sans"> Case List </div>
                        <div class = "card-body">
                            <table id  = "maintable" class="table" >
                                <thead>
                                    <tr>
                                        <th>Case No.</th>
                                        <th>Case Title</th>
                                        <th>Case Status</th>
                                        <th>Days in Queue</th>
                                        <th>Running Days</th>
                                        <th>Received On</th>                            
                                        <th>Action</th>            
                                    </tr>
                                </thead>
                                <tbody>
                                        @if($showassignedcases->count())
                                            @foreach ($showassignedcases as $case)  
                                                <tr>
                                                    <td>{{ $case->case_no }}</td>
                                                    <td>
                                                        @if($case->assigned_status=="Assignment Order Printed")
                                                            <u><a class  = "link-info" href="{{ route('casesummary',$case->id) }}" data-toggle="tooltip" data-placement="bottom" title="Case Details">{{ $case->case_title }}</a></u>
                                                        @else
                                                            {{ $case->case_title }}
                                                        @endif
                                                    </td>
                                                    @if ( $case->role=="Chief")
                                                    
                                                    <td ><p>Assignment Pending</p></td> 
                                                     @elseif ($case->sub_status== "Active")
                                                        <td><p><b>{{ $case->status }}<font color="green"> [{{ $case->sub_status }}] </font></b></p></td> 
                                                    @else
                                                        <td><p><b>{{ $case->status }}<font color="red"> [{{ $case->sub_status }}] </font></b></p></td> 
                                                    @endif
                                                    <td>{{ date_diff(new \DateTime($case->creation_date), new \DateTime())->format("%d days"); }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($case->creation_date)->format('d/m/Y')}}</td>
                                                    
                                                    <td>{{ \Carbon\Carbon::parse($case->creation_date)->format('d/m/Y')}}</td> 
                                                    <td>
                                                       @if($case->role=="Chief")
                                                            @if($case->assigned_status==1 && $case->conflictstatus==0)
                                                                <button type="button" class="btn btn-info btn-sm" onclick="show_modal_coi('{{ $case->id }}')" name="coi" data-toggle="tooltip" data-placement="bottom" title="Manage COI">Manage COI</button>
                                                            @elseif($case->assigned_status==3 && $case->conflictstatus==1)
                                                                <button type="button" class="btn btn-info btn-sm" onclick="show_assigncase_modal_chief('{{ $case->id }}')" name="coi" data-toggle="tooltip" data-placement="bottom" title="Assign">Assign</button>
                                                            @elseif($case->assigned_status==4 && $records == 3)
                                                                <button type="button" class="btn btn-info btn-sm" onclick="show_modal_coi_together('{{ $case->id }},{{ $case->reassignmentstatus }}')" name="declare_coi_together" data-toggle="tooltip" data-placement="bottom" title="Manage COI">Manage COI</button>
                                                            @endif
                                                       @endif
                                                       @if($case->role=="Team Member" || $case->role=="Team Leader" || $case->role=="Legal Representative")
                                                            @if($case->assigned_status== 4 && $case->conflictstatus == 0 )
                                                                <button type="button" class="btn btn-info btn-sm" onclick="show_modal_declare_coi('{{ $case->id }}')" name="declare_coi" data-toggle="tooltip" data-placement="bottom" title="Declare COI">Declare COI</button>
                                                            @endif
                                                       @endif
                                                    </td>
                                                </tr>
                                            @endforeach  
                                        @else
                                            <tr>
                                                <td colspan="8"> No record found </td>
                                            </tr>
                                        @endif           
                                    </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Declare COI -->

	<form method = "POST" action="{{ route('declarecoichief') }}" enctype="multipart/form-data" >
										@csrf  

			<div class="modal fade" id="coichiefmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-xl modal-dialog-scrollable" >
					<div class="modal-content">
						<div class="modal-header alert-info"><h5 class="modal-title" id="exampleModalLabel">Manage COI</h5>
							  <button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span> </button>
						</div>
						<div class="modal-body">
						    <input id = "case_no_id_coi" class="form-control"  type="hidden" name="case_no_id_coi" placeholder="Case No"  >
                                <div id="casedetailsdiv" style="display:none;"></div>
	                            <hr style="height: 1px;  background: teal; margin: 10px 0;   box-shadow: 0px 0px 4px 2px rgba(204,204,204,1);">
							        <div id="coi_show" style="display:none;"></div>    
                                    <hr style="height: 1px;  background: teal; margin: 10px 0;   box-shadow: 0px 0px 4px 2px rgba(204,204,204,1);">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Do you have conflict of interest with any of the alledged person/the case? &nbsp;&nbsp;
                                                    <input type="radio" name="alfabet"  value="yes" onclick="showcoidiv();"> Yes &nbsp;
                                                <input type="radio" name="alfabet" value="no" onclick="dontshowcoidiv()"> No  </label>
                                                <input type="hidden" name="yesno" id="yesno">
                                            </div>
                                        </div>
                                        <br><br>
                                        <div class= "row" id="coidiv" style="display:none"> 
                                            <div class   = "col-md-12">
                                                <div class  = "form-group">
                                                    <label for   = "exampleInputEmail1">Nature of COI&nbsp;<font color='red'>*</font></label>
                                                    <textarea name="coichief" id="coichief" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div> 
						</div>
					
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary" >Declare COI</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											
						</div>
					</div>
				</div>
			</div>
	</form>

	<!-- END VIEW COI -->
    
<!-- ASSIGN CASE CHIEF-->
<form method = "POST" action="{{ route('assigncasechief') }}"  enctype="multipart/form-data" >
        @csrf    

      <div class="modal fade" id="showmodal_assigncase_chief" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" >
            <div class="modal-content">
                <div class="modal-header alert-info">
                    <h5 class="modal-title" id="exampleModalLabel">Assign Case-Chief</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                            <div id="casedetailsdivassignchief" style="display:none;"></div>
                                <input type="hidden" id="case_no_id_chief_assign" name="case_no_id_chief_assign">
                        <hr style="height: 1px;  background: teal; margin: 5px 0;   box-shadow: 0px 0px 4px 2px rgba(204,204,204,1);">
                            <div class   = "row">
                                    <div class  = "col-md-6">
                                        <div class      = "form-group">
                                            <label for  = "exampleInputEmail1">Team Name&nbsp;(Optional)</label>
                                            <input id   = "teamname" placeholder="Team Name" type="text"  class="form-control" name="teamname"   autocomplete="teamname" autofocus>
                                            
                                        </div>
                                    </div>
                            </div>
                            <div class                  = "row">
                                <div class                          = "col-md-10">
                                    <div class                          = "form-group">
                                        
                                        <label>Team Members&nbsp;<font color='red'>*</font></label>
                                            
                                            <table id="tblTeamMembers"class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Role</th>
                                                        <th>Member</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="team">
                                                    <tr>
                                                        <td>
                                                            <select class="form-control" id="teamroles" name="teamroles[]">
                                                                <option value="">Please Select One</option> 
                                                                <option value   = "Team Member">Team Member</option>
                                                                <option value   = "Team Leader">Team Leader</option> 
                                                                <option value   = "Legal Representive">Legal Representive</option>
                                                            </select>
                                                        </td>
                                                        <td> 
                                                            <select class="form-control" id="teammembers" name="teammembers[]">
                                                                <option value="">Please Select One</option>
                                                                @foreach ($users as $user)
                                                                <option value = "{{ $user->email }}">{{ $user->name }}</option>
                                                                @endforeach
                                                            </select></td>
                                                        <td><i class="fa fa-plus" style="color:green" onclick="addteam()"></i></td> 
                                                    </tr>
                                                </tbody>
                                            </table>
                                       
                                    </div>
                                </div>
                              </div>
                                <hr style="height: 1px;  background: teal; margin: 5px 0;   box-shadow: 0px 0px 4px 2px rgba(204,204,204,1);">
                               
                        
 
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Assign</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- FINISH ASSIGN CASE CHIEF -->
<!-- ASSIGN CASE CHIEF-->
<form method = "POST" action="{{ route('assigncasechief') }}"  enctype="multipart/form-data" >
        @csrf    

      <div class="modal fade" id="showmodal_reassigncase_chief" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" >
            <div class="modal-content">
                <div class="modal-header alert-info">
                    <h5 class="modal-title" id="exampleModalLabel">ReAssign Case-Chief</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                            <div id="casedetailsdivreassignchief" style="display:none;"></div>
                                <input type="hidden" id="case_no_id_chief_reassign" name="case_no_id_chief_reassign">
                                    <hr style="height: 1px;  background: teal; margin: 5px 0;   box-shadow: 0px 0px 4px 2px rgba(204,204,204,1);">
                            
                              <div id="existingteammembersreassign" style="display:none;"></div>
                                <hr style="height: 1px;  background: teal; margin: 5px 0;   box-shadow: 0px 0px 4px 2px rgba(204,204,204,1);">
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Assign</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- FINISH ASSIGN CASE CHIEF -->
<!-- DECLArE COI -->
<form method = "POST" action="{{ route('declarecoi_investigator') }}"  enctype="multipart/form-data" >
        @csrf    

    <div class="modal fade" id="modal_show_declare_coi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl  modal-dialog-scrollable" >
            <div class="modal-content">
                <div class="modal-header alert-info"> <h5 class="modal-title" >MANAGE COI</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                            <div id="casedetailsdivinv" style="display:none;"></div>
                                    <input id = "case_no_id_coi_inv" class="form-control"  type="hidden" name="case_no_id_coi_inv"  >
                       <hr style="height: 1px;  background: teal; margin: 10px 0;   box-shadow: 0px 0px 4px 2px rgba(204,204,204,1);">
							        <div id="coi_show_inv" style="display:none;"></div>          
                        <hr style="height: 1px;  background: teal; margin: 10px 0;   box-shadow: 0px 0px 4px 2px rgba(204,204,204,1);">
                                 
                        <div class="row">
                            <div class="col-md-6">
                                <label>Do you have conflict of interest with the case? &nbsp;&nbsp;
                                    <input type="radio" name="alfabet"  value="yes" onclick="showcoidivinv();"> Yes &nbsp;
                                <input type="radio" name="alfabet" value="no" onclick="dontshowcoidivinv()"> No  </label>
                                <input type="hidden" name="yesnoinv" id="yesnoinv">
                            </div>
                        </div>
                    <br><br>
                
                    <div class= "row" id="coidivinv" style="display:none"> 
                        <div class   = "col-md-12">
                            <div class  = "form-group">
                                <label for   = "exampleInputEmail1">Nature of COI&nbsp;<font color='red'>*</font></label>
                                <textarea name="coiinv" id="coiinv" class="form-control"></textarea>
                            </div>
                        </div>
                    </div> 

                        <hr style="height: 1px;  background: teal; margin: 5px 0;   box-shadow: 0px 0px 4px 2px rgba(204,204,204,1);">
                </div>
                    
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Declare</button>                    
                </div>
            </div>
        </div>
    </div>
</form>

<!-- FINISH Declare COI -->
<!-- VIEW COI TOGETHER-->

	<form method = "POST" action="{{ route('printassignmentorder') }}" enctype="multipart/form-data" >
			@csrf  

			<div class="modal fade" id="coitogethermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-xl modal-dialog-scrollable" >
					<div class="modal-content">
						<div class="modal-header alert-info"><h5 class="modal-title" id="exampleModalLabel">Manage COI</h5>
							  <button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span> </button>
						</div>
						<div class="modal-body">
						    <input id = "case_no_id_coi_together" class="form-control"  type="hidden" name="case_no_id_coi_together" placeholder="Case No"  >
                            <input id = "reassignmentstatus" class="form-control"  type="hidden" name="reassignmentstatus"  value="">
                                <div id="casedetailsdivtogether" style="display:none;"></div>
	                            <hr style="height: 1px;  background: teal; margin: 10px 0;   box-shadow: 0px 0px 4px 2px rgba(204,204,204,1);">
							        <div id="coi_show_together" style="display:none;"></div>    
                                    <hr style="height: 1px;  background: teal; margin: 10px 0;   box-shadow: 0px 0px 4px 2px rgba(204,204,204,1);">
                                       
						</div>
					
						<div class="modal-footer">
                            @if ($records == 3)
                                <button type="submit"  class="btn btn-primary" >PRINT ASSIGNMENT ORDER</button>
                            @endif
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											
						</div>
					</div>
				</div>
			</div>
	</form>

	<!-- END VIEW COI TOGETHER-->
<script>
    function show_modal_coi(casenoid)
        {
            $('#case_no_id_coi').val(casenoid);
            $('#coichiefmodal').modal('show');
            
            var url = '{{ route("showcasedetailsforcoi", ":casenoid") }}';
            url = url.replace(':casenoid', casenoid);

            $.ajax({
                
                type:"GET",
                url: url,
                data: {search: $('#case_no_id_coi').val()},
                success: function(responseText) {
                    
                    $("#casedetailsdiv").html(responseText);
                    $("#casedetailsdiv").show();
                    
                }
            });

             var url = '{{ route("viewcoi", ":casenoid") }}';
            url = url.replace(':casenoid', casenoid);

            $.ajax({
                
                type:"GET",
                url: url,
                data: {search: $('#case_no_id_coi').val()},
                success: function(responseText) {
                    
                    $("#coi_show").html(responseText);
                    $("#coi_show").show();
                    
                }
            });
        }


        function showcoidiv()
        {
            $('#coidiv').show(); 
            $('#yesno').val("Yes");
        }

        function dontshowcoidiv()
        {
            $('#coidiv').hide(); 
            $('#yesno').val("No");
        }

        function showcoidivinv()
        {
            $('#coidivinv').show(); 
            $('#yesnoinv').val("Yes");
        }

        function dontshowcoidivinv()
        {
            $('#coidivinv').hide(); 
            $('#yesnoinv').val("No");
        }

        function show_assigncase_modal_chief(casenoid)
        {
           
        $('#case_no_id_chief_assign').val(casenoid);
        
        $('#showmodal_assigncase_chief').modal('show');

        var url = '{{ route("showcasedetailsforcoi", ":casenoid") }}';
            url = url.replace(':casenoid', casenoid);

            $.ajax({
                
                type:"GET",
                url: url,
                data: {search: $('#case_no_id_chief_assign').val()},
                success: function(responseText) {
                    
                    $("#casedetailsdivassignchief").html(responseText);
                    $("#casedetailsdivassignchief").show();
                    
                }
            });

        }

        function show_reassigncase_modal_chief(casenoid)
        {
           
        $('#case_no_id_chief_reassign').val(casenoid);
        
        $('#showmodal_reassigncase_chief').modal('show');

        var url = '{{ route("showcasedetailsforcoi", ":casenoid") }}';
            url = url.replace(':casenoid', casenoid);

            $.ajax({
                
                type:"GET",
                url: url,
                data: {search: $('#case_no_id_chief_reassign').val()},
                success: function(responseText) {
                    
                    $("#casedetailsdivreassignchief").html(responseText);
                    $("#casedetailsdivreassignchief").show();
                    
                }
            });

            var url = '{{ route("showexistingteam", ":casenoid") }}';
            url = url.replace(':casenoid', casenoid);

            $.ajax({
                
                type:"GET",
                url: url,
                data: {search: $('#case_no_id_chief_reassign').val()},
                success: function(responseText) {
                    
                    $("#existingteammembersreassign").html(responseText);
                    $("#existingteammembersreassign").show();
                    
                }
            });

        }
        function addteam() {
        
        html = '<tr>';
        html += '<td><select class="form-control" name="teamroles[]"><option value="">Select Team Members</option><option value="Team Member">Team Member</option> <option value = "Team Leader">Team Leader</option><option value="Legal Representative">Legal Representative</option></select></td><td><select class="form-control" name="teammembers[]"><option value="">Please Select One</option> @foreach ($users as $users)<option value = "{{ $users->email }}">{{ $users->name }}</option>@endforeach</select></td><td><i class="fa fa-minus" style="color:red" onclick="removeteammember()"></i></td>'
        html += '</tr>'

        $('#team').append(html);
    }
    
    function removeteammember() 
    {
        var $tableBody = $('#tblTeamMembers').find("tbody"),
        $trLast = $tableBody.find("tr:last"),
        $trNew = $trLast.remove();
    }

    function show_modal_declare_coi(casenoid)
    {
            
            $('#case_no_id_coi_inv').val(casenoid);
            $('#modal_show_declare_coi').modal('show');
            
            var url = '{{ route("showcasedetailsforcoi", ":casenoid") }}';
            url = url.replace(':casenoid', casenoid);

            $.ajax({
                
                type:"GET",
                url: url,
                data: {search: $('#case_no_id_coi_inv').val()},
                success: function(responseText) {
                    
                    $("#casedetailsdivinv").html(responseText);
                    $("#casedetailsdivinv").show();
                    
                }
            });

            var url = '{{ route("viewcoiinv", ":casenoid") }}';
            url = url.replace(':casenoid', casenoid);

            $.ajax({
                
                type:"GET",
                url: url,
                data: {search: $('#case_no_id_coi_inv').val()},
                success: function(responseText) {
                    
                    $("#coi_show_inv").html(responseText);
                    $("#coi_show_inv").show();
                    
                }
            });
    }

    function show_modal_coi_together(casenoid,reassignmentstatus)
        {
            $('#case_no_id_coi_together').val(casenoid);
            $('#reassignmentstatus').val(reassignmentstatus);
            $('#coitogethermodal').modal('show');
            
            var url = '{{ route("showcasedetailsforcoi", ":casenoid") }}';
            url = url.replace(':casenoid', casenoid);

            $.ajax({
                
                type:"GET",
                url: url,
                data: {search: $('#case_no_id_coi_together').val()},
                success: function(responseText) {
                    
                    $("#casedetailsdivtogether").html(responseText);
                    $("#casedetailsdivtogether").show();
                    
                }
            });

             var url = '{{ route("viewcoitogether", ":casenoid") }}';
            url = url.replace(':casenoid', casenoid);

            $.ajax({
                
                type:"GET",
                url: url,
                data: {search: $('#case_no_id_coi_together').val()},
                success: function(responseText) {
                    
                    $("#coi_show_together").html(responseText);
                    $("#coi_show_together").show();
                    
                }
            });
        }
</script>
@endsection