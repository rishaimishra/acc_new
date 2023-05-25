@extends('layouts.admin')

@section('content')
<br>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header">@include('tabs.directortab')</div>
                        <div class="card-body">
                            <div id="casetablenonassigneddiv"> 
                                <table class="table" >
                                    <thead>
                                        <tr>
                                            <th id="checkboxshow" hidden="hidden"></th>
                                            <th>Complaint No</th>
                                            <th>Complaint Title</th>
                                            <th>Complaint Status</th>
                                            <th>Complaint Date</th>
                                            <th>Action</th>            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($complaints_list->count())
                                        @foreach ($complaints_list as $complaint)  
                                        <tr>
                                            <td>{{ $complaint->complaint_no }}</td>
                                            <td>{{ $complaint->complaint_title }}</td>
                                            <td>@if ($complaint->complaint_status == '0')  Open @endif 
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($complaint->complaint_reg_date)->format('d/m/Y')}}</td>
                                            <td>
                                                <button type="button"  class="btn btn-info btn-sm" onclick="showassigncasenodiv('{{ $complaint->complaint_no }}')">Assign</button>&nbsp;
                                                <button type="button"  class="btn btn-info btn-sm" id="mergetwocomplaint" name="mergetwocomplaint" onclick="showmergecasenodiv('{{ $complaint->complaint_no }}')">Merge</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="4"> No record found </td>
                                        </tr>
                                        @endif                
                                    </tbody>
                                </table>
                            </div>
                            <!-- assign div -->
                             <form class="submitaddcase" method = "POST" action="{{ route('addcasefromcomplaint') }}" enctype="multipart/form-data" >
                                    @csrf 
                            <div id="assigncasenodiv" style="display:none">
                                
                                <br>
                                    <div class="row">
                                        <div class="col-12 col-sm-12">
                                            <div class="card card-primary card-outline card-outline-tabs">
                                                <div class="card-header p-0 pt-1 border-bottom-0">
                                                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" id="generaltab" data-toggle="pill" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="allegationtab" data-toggle="pill" href="#allegation" role="tab" aria-controls="allegation" aria-selected="false">Allegation</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="subjecttab" data-toggle="pill" href="#subject" role="tab" aria-controls="subject" aria-selected="false">Subject</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="coitab" data-toggle="pill" href="#coi" role="tab" aria-controls="coi" aria-selected="false">COI</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="assigntab" data-toggle="pill" href="#assign" role="tab" aria-controls="assign" aria-selected="false">Assign</a>
                                                        </li>
                                                    
                                                    </ul>
                                                </div>
                                                <div class="card-body">
                                                    <div class="tab-content" id="custom-tabs-three-tabContent">
                                                        <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="generaltab">
                                                            <!-- general -->
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label>Complaint No:</label>
                                                                </div>
                                                                <div class="col-md-3 form-group">
                                                                    <input type="text" readonly name="complaintno"  class="form-control " id="complaintno" >
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                        <label for  = "exampleInputEmail1">Source&nbsp;<font color='red'>*</font></label>
                                                                            <select class="form-control" onchange="displaynonassigned()"  name="source_add_cmd" id="source_add_cmd" required>
                                                                                <option value="">Select Source</option>
                                                                                    @foreach ($sources as $sourcetype)
                                                                                        <option value="{{ $sourcetype->source_type }}">{{ $sourcetype->source_type }}</option>
                                                                                </option>
                                                                                    @endforeach    
                                                                            </select>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Case No&nbsp;<font color='red'>*</font></label>
                                                                        <input type="text" readonly name="case_no_add_cmd"  class="form-control " id="case_no_add_cmd" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row" id="agency_name_cmd" style="display:none;">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Agency Name &nbsp;<font color='red'>*</font></label>
                                                                        <input type="text" name="agency_name_add_cmd"  class="form-control " id="agency_name_add_cmd"  >
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Case Title&nbsp;<font color='red'>*</font></label>
                                                                        <input type="text" name="case_title_add_cmd"  class="form-control" id="case_title_add_cmd" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Case Creation Date&nbsp;<font color='red'>*</font></label>
                                                                        <input type="date" name="case_reg_no_add_cmd"  class="form-control" id="case_reg_no_add_cmd" required>
                                                                    </div>
                                                                    
                                                                </div>
                                                            
                                                            </div>
                                                            <a  style="float:right; color:grey"><i class='fa fa-arrow-circle-right'  data-toggle="tooltip" data-placement="bottom" title="Next"></i> Next</a>
                                                            <!-- general -->
                                                        </div>
                                                        <div class="tab-pane fade  " id="allegation" role="tabpanel" aria-labelledby="allegationtab">
                                                            <!-- allegation -->
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for  = "exampleInputEmail1">Investigation Type&nbsp;<font color='red'>*</font></label>
                                                                        <input type="text" class="form-control" name="offences_cmd" readonly id="offences_cmd" value="Regular">
                                                                    </div> 
                                                                </div>
                                                                <div class = "col-md-6 ">
                                                                    <div class  = "form-group">
                                                                        <label for  = "exampleInputEmail1">Probable Offence&nbsp;<font color='red'>*</font></label>
                                                                            <input type="text" class="form-control" name="offences_cmd"  id="offences_cmd" value="offence 1, offence 2">
                                                                    </div>
                                                                </div>   
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for                          = "exampleInputEmail1">Allegation Details<font color='red'>*</font></label>
                                                                            <textarea readonly id  = "" placeholder="Allegation Details"  type="text" class="form-control" name="offence_dtls_add_cmd"  required >abc def ghi jkl mno pqr stu</textarea>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for                          = "exampleInputEmail1">Attachments<font color='red'>*</font></label>
                                                                            <table id="attachments" class="table table-bordered table-hover" >
                                                                                <tr>
                                                                                    <th>Name</th>
                                                                                    <th>Document</th>
                                                                                    <th>Size</th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Search order</td>
                                                                                    <td><a href="#">abc.pdf</a></td>
                                                                                    <td>5 MB </td>
                                                                                </tr>
                                                                                
                                                                            </table>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for  = "exampleInputEmail1">Additional documents which cant be uploaded?</label> &nbsp;
                                                                        <input type="checkbox"> 
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <!-- allegation -->
                                                        </div>
                                                        <div class="tab-pane fade  " id="subject" role="tabpanel" aria-labelledby="subjectab">
                                                            <!-- subject -->
                                                            <table id="attachments" class="table table-bordered table-hover" >
                                                                <tr>
                                                                    <th>Name</th>
                                                                    <th>CID</th>
                                                                    <th>Type</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>Pema Dorji</th>
                                                                    <td>11215662783</th>
                                                                    <td>Accused</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>Tandin</th>
                                                                    <td>11213990542</th>
                                                                    <td>Victim</th>
                                                                </tr>
                                                            </table>
                                                            <!-- subject -->
                                                        </div>
                                                        <div class="tab-pane fade " id="coi" role="tabpanel" aria-labelledby="coitab">
                                                            <!-- coi -->
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                    <h4> <i class="fa fa-edit"></i>Conflict of Interest Declaration </h4>&nbsp;&nbsp;
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label>Do you have conflict of interest with any of the alledged person/the case? &nbsp;&nbsp;
                                                                            <input type="radio" name="alfabet_cmd"  value="yes" onclick="showcoidiv_cmd();"> Yes &nbsp;
                                                                        <input type="radio" name="alfabet_cmd" value="no" onclick="dontshowcoidiv_cmd()"> No  </label>
                                                                        <input type="hidden" name="yesno_cmd" id="yesno_cmd">
                                                                    </div>
                                                                </div>
                                                                <br><br>
                                                                
                                                                <div class= "row" id="coidiv_cmd" style="display:none"> 
                                                                    <div class   = "col-md-12">
                                                                        <div class  = "form-group">
                                                                            <label for   = "exampleInputEmail1">Nature of COI&nbsp;<font color='red'>*</font></label>
                                                                                <textarea id="summernote" name="coidirector_cmd" class="form-control"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                            <!-- coi -->
                                                        </div>
                                                        <div class="tab-pane fade  " id="assign" role="tabpanel" aria-labelledby="assigntab">
                                                            <!-- assign -->
                                                                <div class= "row"> 
                                                                    <div class   = "col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Priority&nbsp;<font color='red'>*</font></label>
                                                                            <select class="form-control"   name="priority_add_cmd" id="priority_add_cmd" >
                                                                                <option>Select Priority</option>
                                                                                    @foreach ($priority as $priority)
                                                                                        <option value   = "{{ $priority->priority_type }}">{{ $priority->priority_type }}</option>
                                                                                        </option>
                                                                                    @endforeach    
                                                                            </select>
                                                                        </div>		                  			
                                                                    </div>
                                                                    
                                                                </div>
                                                                <div class="row">
                                                                    <div class   = "col-md-12">
                                                                        <div class  = "form-group">
                                                                            <label for   = "exampleInputEmail1">Remarks/Instructions&nbsp;<font color='red'>*</font></label>
                                                                            <textarea placeholder="Remarks"  type="text" class="form-control" name="remarks_add_cmd" id="remarks_add_cmd" class=""  required ></textarea>
                                                                        </div>
                                                                    </div> 
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for  = "exampleInputEmail1">Investigation Type&nbsp;<font color='red'>*</font></label>
                                                                                <select class="form-control"   name="investigation_type_add_cmd" id="investigation_type_add_cmd" required onchange="changeoption_cmd()">
                                                                                    <option value="">Select Investigation Type</option>
                                                                                        @foreach ($investigationtype as $invtype)
                                                                                            <option >{{ $invtype->name }}</option>
                                                                                    </option>
                                                                                    @endforeach    
                                                                                </select> 
                                                                        </div> 
                                                                    </div>
                                                                    <div class   = "col-md-6" id="showbranch_cmd" style="display:none">
                                                                        <div class  = "form-group">
                                                                            <label for   = "exampleInputEmail1">Assign to&nbsp;<font color='red'>*</font></label>
                                                                                <select class    = "form-control" name="branch_cmd" id="branch_cmd" onchange="displaynames_cmd()">
                                                                                    <option>Select Branch</option>
                                                                                        @foreach ($branches as $branch)
                                                                                            <option value   = "{{ $branch->branch_name }}">{{ $branch->branch_name }}</option>
                                                                                    </option>
                                                                                    @endforeach    
                                                                                </select>
                                                                                
                                                                        </div>
                                                                    </div>    
                                                                </div>
                                                                <div id="showteamselection_cmd" style="display:none">
                                                                    <div class= "row">
                                                                        <div class  = "col-md-10">
                                                                            <div class  = "form-group">
                                                                                <table class="table table-bordered" id="teamdetails_cmd">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>Name</th>
                                                                                            <th>Role</th>                                                 
                                                                                        </tr>
                                                                                    </thead>   
                                                                                    <tbody >
                                                                                        <tr >
                                                                                            <td>
                                                                                                <select class  = "form-control" name="teammemberassign_cmd[]" id="teammemberassign_cmd" onchange="showadhoc_cmd()">
                                                                                                    <option>Select Team Members</option>
                                                                                                        @foreach ($usersspecial as $userusers)
                                                                                                            <option value   = "{{ $userusers->email }}">{{ $userusers->name }}&nbsp; [ {{ $userusers->role }}, {{ $userusers->branch }}] </option>                                                                       </option>
                                                                                                        @endforeach 
                                                                                                    <option>Adhoc</option>   
                                                                                                </select>
                                                                                            </td>
                                                                                            <td>
                                                                                                <select class  = "form-control" name="teamrolesassign_cmd[]" id="teamrolesassign_cmd" >
                                                                                                    <option>Select Role</option>
                                                                                                    <option value   = "Team Member">Team Member</option>
                                                                                                    <option value   = "Team Leader">Team Leader</option>
                                                                                                    <option value   = "Legal Representive">Legal Representive</option> 
                                                                                                    <option value   = "Supervisor">Supervisor<ption> 
                                                                                                </select>
                                                                                            </td>   
                                                                                            <td>   
                                                                                                <button type="button"  class="btn btn-warning" onclick="addmorenew_cmd()" name="add" data-toggle="tooltip" data-placement="bottom" title="Add More"><i class="fa fa-plus"></i></button>
                                                                                                <button type="button"  class="btn btn-warning" onclick="removenew_cmd()" name="add" data-toggle="tooltip" data-placement="bottom" title="Remove"><i class="fa fa-minus"></i></button>
                                                                                            </td>                                         
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>    
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id= "showdivisionheaddetails_cmd" style="display:none">
                                                                            <div class= "row">
                                                                                <div class  = "col-md-12">
                                                                                    <div class  = "form-group">
                                                                        
                                                                                        <table class="table table-bordered">
                                                                                                <thead>
                                                                                                        <tr>
                                                                                                            <th>Name</th>
                                                                                                            <th>Designation</th>                                                 
                                                                                                        </tr>
                                                                                                </thead>
                                                                                                    
                                                                                                <tbody id="headdetails_cmd">
                                                                                                
                                                                                                </tbody>
                                                                                        </table> 
                                                                                    
                                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <button type="submit" style="float:right" class="btn btn-primary">Create</button>
                                                                        </div>
                                                                </div>
                                                                </div>
                                                                
                                                            <!-- assign -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                            <!-- assign div -->
                            </form>

                        </div>
                </div> 
            </div>
        </div>
    </div>

    <!--merge modal -->
<form method = "POST" action="{{ route('mergecase') }}"  enctype="multipart/form-data" >
      @csrf    
<div class="modal fade" id="mergemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" >
            <div class="modal-content" style="font-family:Product Sans">                                                                                                                                                                                         <div class="modal-header alert-info">
                    <h5 class="modal-title" id="exampleModalLabel">Merge Case</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <input id = "complaintnoformerge" class="form-control" readonly type="hidden" name="complaintnoformerge"  >
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="casetitle">Case No:<font color='red'>*</font></label>
                                    <select class="tasktype"   name="idiarytasktype" id="idiarytasktype" required>
                                        <option value="">Select</option>
                                            @foreach ($allcases as $cases)
                                                <option value="{{ $cases->id }}">{{ $cases->case_no }}</option>
                                            @endforeach    
                                    </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to merge?') || event.preventDefault();">Merge</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--end merge modal -->
</section>
<script>
     function showassigncasenodiv(complaintno)
    {
        $('#assigncasenodiv').show();
        $('#complaintno').val(complaintno);
        $('#casetablenonassigneddiv').hide();
    }

    function showmergecasenodiv(complaintno)
    {
        $('#complaintnoformerge').val(complaintno);
        $('#mergemodal').modal('show');  
    }

    function closeassigncasenodiv()
    {
        $('#casetablenonassigneddiv').show();
        $('#assigncasenodiv').hide();
    }
    function displaynonassigned()
    {
        sourceName = $('#source_add_cmd').val(); 
    
    if(sourceName == "Reactive (Agency Referral)")
    {
    $('#agency_name_cmd').show(); 
   
    }
    else
    {
        $('#agency_name_cmd').hide(); 
    }

    
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('generateCaseno')}}",
            type: "GET",
            data:{
                'sourceName' : sourceName 
                },
            success:function(data){
                console.log(data);
                $('#case_no_add_cmd').val(data);
            },
            error:function(e){
                console.log(e,'error');
            }
        });
    }

     function showcoidiv_cmd()
            {
                var result = warn(); 
            }

        function warn() {
            
                if (confirm('Are you sure you want to declare COI ?')) 
                {
                    $('#coidiv_cmd').show(); 
                    $('#yesno_cmd').val("Yes");
                }
                else
                {
                    $('#coidiv_cmd').hide(); 
                    $('#yesno_cmd').val("No");
                }
            }

        function dontshowcoidiv_cmd()
            {
                $('#coidiv_cmd').hide(); 
                $('#yesno_cmd').val("No");
            }
            function changeoption_cmd()
            {
                $option = $('#investigation_type_add_cmd').val(); 
                
                if($option == "Regular")
                {
                $('#showbranch_cmd').show();
                $('#showteamselection_cmd').hide();
                // $('#addcase').show();
                // $('#addcasespecial').hide();
                }

                if($option == "Special")
                {
                $('#showteamselection_cmd').show();
                $('#showdivisionheaddetails_cmd').hide();
                $('#showbranch_cmd').hide();
                // $('#addcase').hide();
                // $('#addcasespecial').show();
                }
            }

        function displaynames_cmd(branch)
            {
                branch = $('#branch_cmd').val(); 

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{route('showdivisionheads')}}",
                    type: "GET",
                    data:{
                        'branch' : branch 
                        },
                    success:function(result){
                        console.log(result);
                            html = '<tr>';
                            html += '<td>'+result.name+'</td>';
                            html += '<td>'+result.position+'</td>';
                            $('#showdivisionheaddetails_cmd').show(100);
                            $('#showteamselection_cmd').hide();
                            $('#headdetails_cmd').append(html);
                    },
                    error:function(e){
                        console.log(e,'error');
                    }
                });
            }

             function addmorenew_cmd()
            {
                var $tableBody = $('#teamdetails_cmd').find("tbody"),
                $trLast = $tableBody.find("tr:last"),
                $trNew = $trLast.clone();
                $trLast.after($trNew);
            }   
        
        function removenew_cmd()
            {
                var $tableBody = $('#teamdetails_cmd').find("tbody"),
                $trLast = $tableBody.find("tr:last"),
                $trNew = $trLast.remove();
            }
</script>

@endsection