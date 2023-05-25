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
                                <div id="casedetailsdiv" >
                                    <br>
                                        <i style="float:right;color:blue"  onclick="addnewcasedirector()"  id="addcasebtn" name="addcasebtn" data-toggle="tooltip" data-placement="bottom" title="Add New Case"  class="fa fa-plus" onmouseover="this.style.color='#333333';" onmouseout="this.style.color='blue';"></i>
                                        <br><br>
                                        <table id  = "casetableassigned" class="table" >
                                            <thead>
                                                <tr>
                                                    <th>Case No.</th>
                                                    <th>Case Title</th>
                                                    <th>Status</th>
                                                    <th>Days in Queue</th>
                                                    <th>Running Days</th>
                                                    <th>Assigned To</th>
                                                    <th>Assigned On</th>                  
                                                    <th>Action</th>            
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @if($allcases->count())
                                                @foreach ($allcases as $case)  
                                                <tr>
                                                    <td>{{ $case->case_no }}</td>
                                                    <td>{{ $case->case_title }}</td>
                                                    @if ($case->sub_status== "")
                                                    <td ><p>Assigned to Chief</p></td> 
                                                     @elseif ($case->sub_status== "Active")
                                                        <td><p><b>{{ $case->status }}<font color="green"> [{{ $case->sub_status }}] </font></b></p></td> 
                                                    @else
                                                        <td><p><b>{{ $case->status }}<font color="red"> [{{ $case->sub_status }}] </font></b></p></td> 
                                                    @endif
                                                    <td>{{ date_diff(new \DateTime($case->creation_date), new \DateTime())->format("%d days"); }}</td>
                                                    <td></td>
                                                    <td>{{ $case->branch }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($case->creation_date)->format('d/m/Y')}}</td> 
                                                    <td> @if($case->assigned_status=="2" )
                                                            <button type="button" class="btn btn-info btn-sm" onclick="show_modal_chief_coi('{{ $case->id }}')" name="coi" data-toggle="tooltip" data-placement="bottom" title="View COI">Manage COI</button>
                                                        
                                                        @endif
                                                        <button type="button" class="btn btn-success btn-sm" onclick="show_modal_reassign('{{ $case->id }}')" name="Reassign" data-toggle="tooltip" data-placement="bottom" title="Reassign">Reassign</button> 
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
                            <!-- assign div -->
                            <form class="submitaddcase" method = "POST" action="{{ route('registercase') }}" enctype="multipart/form-data" >
                                    @csrf
                                <div id="addcasedetailsdiv" style="display:none">
                                <br>
                                    <div class="row">
                                        <div class="col-12 col-sm-12">
                                            <div class="card card-primary card-outline card-outline-tabs">
                                                <div class="card-header p-0 pt-1 border-bottom-0">
                                                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                                        <li class="nav-item"><a class="nav-link active" id="generaltab" data-toggle="pill" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a></li>
                                                        <li class="nav-item"><a class="nav-link" id="allegationtab" data-toggle="pill" href="#allegation" role="tab" aria-controls="allegation" aria-selected="false">Allegation</a></li>
                                                        <li class="nav-item"><a class="nav-link" id="subjecttab" data-toggle="pill" href="#subject" role="tab" aria-controls="subject" aria-selected="false">Subject</a></li>
                                                        <li class="nav-item"><a class="nav-link" id="coitab" data-toggle="pill" href="#coi" role="tab" aria-controls="coi" aria-selected="false">COI</a></li>
                                                        <li class="nav-item"><a class="nav-link" id="assigntab" data-toggle="pill" href="#assign" role="tab" aria-controls="assign" aria-selected="false">Assign</a></li>
                                                    
                                                    </ul>
                                                </div>
                                                <div class="card-body">
                                                    <div class="tab-content" id="custom-tabs-three-tabContent">
                                                        <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="generaltab">
                                                            <!-- general -->
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                            <label for  = "exampleInputEmail1">Source&nbsp;<font color='red'>*</font></label>
                                                                                <select class="form-control" onchange="displaycaseno()"  name="source_add" id="source_add" persontype>
                                                                                    <option value="">Select Source</option>
                                                                                        @foreach ($sources as $sourcetype)
                                                                                            <option value="{{ $sourcetype->source_type }}">{{ $sourcetype->source_type }}</option>
                                                                                        @endforeach    
                                                                                </select>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Sector Type&nbsp;<font color='red'>*</font></label>
                                                                                <select class="form-control" name="sector_type_add" id="sector_type_add" persontype>
                                                                                    <option value="">Select Type</option>
                                                                                        @foreach ($sector as $sect)
                                                                                            <option value="{{ $sect->sector_type }}">{{ $sect->sector_type }}</option>
                                                                                        @endforeach    
                                                                                </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Case No&nbsp;<font color='red'>*</font></label>
                                                                            <input type="text" readonly name="case_no_add"  class="form-control " id="case_no_add" persontype>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Sector&nbsp;<font color='red'>*</font></label>
                                                                                <select class="form-control" name="sector_subtype_add" id="sector_subtype_add" persontype>
                                                                                    <option value="">Select Type</option>
                                                                                        @foreach ($subsector as $sectsub)
                                                                                            <option value="{{ $sectsub->sector_name }}">{{ $sectsub->sector_name }}</option>
                                                                                    </option>
                                                                                        @endforeach    
                                                                                </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row" id="agency_name" style="display:none;">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Agency Name &nbsp;<font color='red'>*</font></label>
                                                                            <input type="text" name="agency_name_add"  class="form-control " id="agency_name_add"  >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Case Title&nbsp;<font color='red'>*</font></label>
                                                                            <input type="text" name="case_title_add"  class="form-control" id="case_title_add" persontype>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Area&nbsp;<font color='red'>*</font></label>
                                                                                <select class="form-control" name="area_add" id="area_add" persontype>
                                                                                    <option value="">Select Type</option>
                                                                                        @foreach ($area as $areas)
                                                                                            <option value="{{ $areas->area_name }}">{{ $areas->area_name }}</option>
                                                                                    </option>
                                                                                        @endforeach    
                                                                                </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Case Creation Date&nbsp;<font color='red'>*</font></label>
                                                                            <input type="date" name="case_reg_no_add"  class="form-control" id="case_reg_no_add" persontype>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Institution Type&nbsp;<font color='red'>*</font></label>
                                                                                <select class="form-control" name="institution_type_add" id="institution_type_add" persontype>
                                                                                    <option value="">Select Type</option>
                                                                                        @foreach ($institutiontype as $inst)
                                                                                            <option value="{{ $inst->institution_type }}">{{ $inst->institution_type }}</option>
                                                                                        @endforeach    
                                                                                </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <!-- general -->
                                                        </div>
                                                        <div class="tab-pane fade  " id="allegation" role="tabpanel" aria-labelledby="allegationtab">
                                                            <!-- allegation -->
                                                                <div class="row">
                                                                    <div class = "col-md-12 ">
                                                                        <div class  = "form-group">
                                                                            <label for  = "exampleInputEmail1">Probable Offence&nbsp;<font color='red'>*</font></label>
                                                                                <select class="offencetype" multiple="multiple"   name="offence_type_add[]" id="offence_type_add" persontype>
                                                                                    <option value="">Select Offence Type</option>
                                                                                        @foreach ($offencetypes as $offence)
                                                                                            <option >{{ $offence->offence_type }}</option>
                                                                                        @endforeach    
                                                                                </select>
                                                                        </div>
                                                                    </div>   
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for  = "exampleInputEmail1">Allegation Details<font color='red'>*</font></label>
                                                                                <textarea id  = "allegation_details_add" placeholder="Allegation Details"  type="text" class="form-control" name="allegation_details_add"  persontype ></textarea>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for = "exampleInputEmail1">Allegation Document<font color='red'>*</font></label>
                                                                                <input type="file" class="form-control" id="allegation_doc" name="allegation_doc"  persontype >
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                            <!-- allegation -->
                                                        </div>
                                                        <div class="tab-pane fade  " id="subject" role="tabpanel" aria-labelledby="subjectab">
                                                            <!-- subject -->
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label>Subject</label> <br>
                                                                            <div class = "input-group">
                                                                            <input type="text" class="form-control" name="cid" placeholder="Search CID/Permit/License No" id="cid"  onchange="SearchEntity();">  &nbsp; &nbsp; &nbsp; <i class="fa fa-user-plus" id="AddEntity" style="float:right;display:none"; color="blue" onclick="showaddperson()" onmouseover="this.style.color='#333333';" onmouseout="this.style.color='blue';" data-toggle="tooltip" data-placement="bottom" title="Add Entity"></i><br>
                                                                            </div>
                                                                    </div>   
                                                                </div>
                                                                <br>
                                                                <div id= "show_accused_party" style="display:none">
                                                                    <div class= "row">
                                                                        <div class  = "col-md-10">
                                                                            <div class  = "form-group">
                                                                                <table id="entitytable" class="table table-bordered">
                                                                                    <thead>
                                                                                            <tr>
                                                                                                <th>Name</th>
                                                                                                <th>Cid</th> 
                                                                                                <th>Nationality</th>
                                                                                                <th>Gender</th>
                                                                                                <th>Subject Category</th>                                                 
                                                                                            </tr>
                                                                                    </thead>
                                                                                    <tbody id="searchResults">
                                                                                    </tbody>
                                                                                </table> 
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
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
                                                                                <div class="col-md-12">
                                                                                    <label>Do you have conflict of interest with any of the alledged person/the case? &nbsp;&nbsp;
                                                                                        <input type="radio" name="persontype"  value="yes" onclick="showcoidiv();"> Yes &nbsp;
                                                                                    <input type="radio" name="persontype" value="no" onclick="dontshowcoidiv()"> No  </label>
                                                                                    <input type="hidden" name="yesno" id="yesno">
                                                                                </div>
                                                                            </div>
                                                                            <br><br>
                                                                            
                                                                            <div class= "row" id="coidiv" style="display:none"> 
                                                                                <div class   = "col-md-12">
                                                                                    <div class  = "form-group">
                                                                                        <label for   = "exampleInputEmail1">Nature of COI&nbsp;<font color='red'>*</font></label>
                                                                                            <textarea id="summernote" name="coidirector" class="form-control"></textarea>
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
                                                                        <select class="form-control"   name="priority_add" id="priority_add" >
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
                                                                        <textarea placeholder="Remarks"  type="text" class="form-control" name="remarks_add" id="remarks_add" class=""  persontype ></textarea>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for  = "exampleInputEmail1">Investigation Type&nbsp;<font color='red'>*</font></label>
                                                                            <select class="form-control"   name="investigation_type_add" id="investigation_type_add" persontype onchange="toggleinvestigationtype()">
                                                                                <option value="">Select Investigation Type</option>
                                                                                    @foreach ($investigationtype as $invtype)
                                                                                        <option >{{ $invtype->name }}</option>
                                                                                </option>
                                                                                @endforeach    
                                                                            </select> 
                                                                    </div> 
                                                                </div>
                                                                <div class   = "col-md-6" id="showbranch" style="display:none">
                                                                    <div class  = "form-group">
                                                                        <label for   = "exampleInputEmail1">Assign to&nbsp;<font color='red'>*</font></label>
                                                                            <select class    = "form-control" name="branch" id="branch" onchange="displaynames()">
                                                                                <option>Select Branch</option>
                                                                                    @foreach ($branches as $branch)
                                                                                        <option value   = "{{ $branch->branch_name }}">{{ $branch->branch_name }}</option>
                                                                                    @endforeach    
                                                                            </select>
                                                                            
                                                                    </div>
                                                                </div>    
                                                            </div>
                                                            <div id="showteamselection" style="display:none">
                                                                <div class= "row">
                                                                    <div class  = "col-md-10">
                                                                        <div class  = "form-group">
                                                                            <table class="table table-bordered" id="teamdetails">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Name</th>
                                                                                        <th>Role</th>                                                 
                                                                                    </tr>
                                                                                </thead>   
                                                                                <tbody >
                                                                                    <tr >
                                                                                        <td>
                                                                                            <select class  = "form-control" name="teammemberassign[]" id="teammemberassign" onchange="showadhoc()">
                                                                                                <option>Select Team Members</option>
                                                                                                    @foreach ($usersspecial as $userusers)
                                                                                                        <option value   = "{{ $userusers->email }}">{{ $userusers->name }}&nbsp; [ {{ $userusers->role }}, {{ $userusers->branch }}] </option>                                                                       </option>
                                                                                                    @endforeach 
                                                                                                <option>Adhoc</option>   
                                                                                            </select>
                                                                                        </td>
                                                                                        <td>
                                                                                            <select class  = "form-control" name="teamrolesassign[]" id="teamrolesassign" >
                                                                                                <option>Select Role</option>
                                                                                                <option value   = "Team Member">Team Member</option>
                                                                                                <option value   = "Team Leader">Team Leader</option>
                                                                                                <option value   = "Legal Representive">Legal Representive</option> 
                                                                                                <option value   = "Chief">Supervisor<ption> 
                                                                                            </select>
                                                                                        </td>   
                                                                                        <td>   
                                                                                            <button type="button"  class="btn btn-warning" onclick="addmorenew()" name="add" data-toggle="tooltip" data-placement="bottom" title="Add More"><i class="fa fa-plus"></i></button>
                                                                                            <button type="button"  class="btn btn-warning" onclick="removenew()" name="add" data-toggle="tooltip" data-placement="bottom" title="Remove"><i class="fa fa-minus"></i></button>
                                                                                        </td>                                         
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>    
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id= "showdivisionheaddetails" style="display:none">
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
                                                                                        
                                                                                    <tbody id="headdetails">
                                                                                    
                                                                                    </tbody>
                                                                            </table> 
                                                                        
                                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                
                                                                                <input type="submit" style="float:right;" class="btn btn-primary" value="Create" id="addcase" onclick="return confirm('Are you sure you want to submit this form?') || event.preventDefault();">
                                                                                <!-- <a style="display:none" href="" class="btn btn-info btn-sm" id="addcasespecial" >Print Assignment Order</a> -->
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
                        <div class="card-footer">
                        </div>
                </div> 
            </div>
        </div>
    </div>

     <!-- ADD Person -->
   <form id="addForm" >
    @csrf 
<div class="modal fade" id="addpersondiv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" >
            <div class="modal-content" style="font-family:Product Sans">  
                <div class="modal-header alert-info">
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
                                    <input type="radio" name="persontype" value="NonBhutanese" onclick="shownonbhutanesediv()"> Non Bhutanese  </label>
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
                                                <label for   = "exampleInputEmail1">Email&nbsp;</label>
                                                    <input name="nonbhutaneseemail" id="nonbhutaneseemail"  class="form-control" type="text" placeholder="Email"/>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    </div>
                            </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" onclick="addmainentity()" name="addButton" id="addButton" data-toggle="tooltip" data-placement="bottom" title="Save" >Save</button> 
                </div>
            </div>
        </div>
    </div>
</form>

<!-- FINISH ADD Person -->
<!-- VIEW COI CHIEF-->

<form method = "POST" action="{{route('proceed_chief')}}"   enctype="multipart/form-data" >
    @csrf  

        <div class="modal fade" id="showmodal_coi_chief" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable" >
                <div class="modal-content">
                    <div class="modal-header alert-info">
                        <h5 class="modal-title" id="exampleModalLabel">Manage COI</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="casedetailsall" style="display:none;"></div>
                                <input id = "case_no_id_coi_chief" class="form-control"  type="hidden" name="case_no_id_coi_chief" placeholder="Case No"  >
                        <hr style="height: 1px;  background: teal; margin: 10px 0;   box-shadow: 0px 0px 4px 2px rgba(204,204,204,1);">
                        <div id="coi_show_chief" style="display:none;"></div>
                       <hr style="height: 1px;  background: teal; margin: 10px 0;   box-shadow: 0px 0px 4px 2px rgba(204,204,204,1);">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="show_modal_reassign()">ReAssign</button> 
                        <button type="submit" class="btn btn-primary" >Proceed</button>
                                               
                    </div>
                </div>
            </div>
        </div>
</form>

<!-- END VIEW COI -->

<!-- show entity details modal -->
<div class="modal fade" id="show_entitydtls_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg  modal-dialog-scrollable" >
            <div class="modal-content">
                <div class="modal-header alert-secondary">
                    <h5 class="modal-title" >Entity Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value=""  name="entityidaddcase" id="entityidaddcase">
                        <div id="entitydetailsshowaddcase" style="display:none;"></div>
                            
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end -->
<!-- Reassign -->

<form method = "POST" action="{{ route('reassigncase') }}"  >
                                    @csrf     

      <div class="modal fade" id="modal_reassign_show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" >
            <div class="modal-content">
                <div class="modal-header alert-info">
                    <h5 class="modal-title" id="exampleModalLabel">Reassign Case</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        
                        <input type="hidden" name="casenoid_reassign" id="casenoid_reassign">
                        <div id="allegationandaccusedreassigncase" style="display:none;"></div>
                        <hr style="height: 1px;  background: teal; margin: 10px 0;   box-shadow: 0px 0px 4px 2px rgba(204,204,204,1);">
                    <div id="reassigndiv" style="display:none;">  </div>

                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">ReAssign</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- FINISH REASSIGN -->
    
</section>

<script>
    function addnewcasedirector()
            {
                $('#addcasedetailsdiv').show();
                $('#casedetailsdiv').hide();
            }

        function closeaddcase()
            {
                $('#casedetailsdiv').show();
                $('#addcasedetailsdiv').hide();
            }

function displaycaseno(sourceName)
            {

                sourceName = $('#source_add').val(); 

                if(sourceName == "Reactive (Agency Referral)")
                {
                $('#agency_name').show(); 

                }
                else
                {
                    $('#agency_name').hide(); 
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
                            $('#case_no_add').val(data);
                        },
                        error:function(e){
                            console.log(e,'error');
                        }
                    });
            }
            function SearchEntity()
            {
               var cid = $("#cid").val();
            
            
                var url = '{{ route("searchentity", ":cid") }}';
                        url = url.replace(':cid', cid);
                        
                        $.ajax({
                            
                            type:"GET",
                            url: url,
                            data: {search: $('#cid').val()},
                            success: function(result) {
                            if ( result.data.length > 0)
                                {
                                html = '<tr>';
                                html += '<td><input type="hidden" id="entityname[]" name="entityname[]" value="'+result.data[0].name+'">'+result.data[0].name+'</td>';
                                html += '<td><input type="hidden" id="entitycid[]" name=entitycid[]" value="'+result.data[0].identification_no+'">'+result.data[0].identification_no+'</td>';
                                html += '<td><input type="hidden" id="entitynationality[]" name=entitynationality[]" value="'+result.data[0].type+'">'+result.data[0].type+'</td>';
                                html += '<td><input type="hidden" id="entitygender[]" name=entitygender[]" value="'+result.data[0].gender+'">'+result.data[0].gender+'</td>';
                                html += '<td><select name="partytype[]" id="partytype[]" class="form-control"><option value="Witness">Witness</option><option value="Accused">Accused</option><option value="Victim">Victim</option><option value="Complainant">Complainant</option><select><td>';
                                html += '<td><button type="button" onclick="viewentitydetailsaddcase('+result.data[0].id+')"  id="viewdetails" name="viewdetails" data-toggle="tooltip" data-placement="bottom" title="View Details"><i class="fa fa-eye"></i></button> &nbsp; <button type="button" onclick="viewentitydetailsaddcase('+result.data[0].id+')"  id="viewdetails" name="viewdetails" data-toggle="tooltip" data-placement="bottom" title="Remove"><i class="fa fa-trash"></i></button></td>';       
                                html += ''
                                $('#show_accused_party').show(500);
                                $('#searchResults').append(html);
                                $('#cid').val('');
                                
                                }
                                else
                                {
                                    alert("No Data Available. Please add new Data");
                                    $('#AddEntity').show();
                                }
                            },
                            error: function() {
                                alert('An error occurred while fetching data.');
                            }
                        });
            }
        
    function showcoidiv()
            {
                var result = warn(); 
            }

        function warn() {
            
                if (confirm('Are you sure you want to declare COI ?')) 
                {
                    $('#coidiv').show(); 
                    $('#yesno').val("Yes");
                }
                else
                {
                    $('#coidiv').hide(); 
                    $('#yesno').val("No");
                }
            }

        function dontshowcoidiv()
            {
                $('#coidiv').hide(); 
                $('#yesno').val("No");
            }

   function showaddperson()
        {
            $('#addpersondiv').modal('show'); 
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

        function getDetailsByPermit()
        {
            $('#showcitizendetailsnonbhutanese').show(700);
        }
       
        function addmainentity() {
            $.ajax({
                url: '{{ route('savemainentity') }}',
                type: 'POST',
                dataType: 'json',
                data: $('#addForm').serialize(),
                success: function(data) {
                    $('#addpersondiv').modal('hide');
                   
                    // Your code here to handle success response
                },
                error: function(xhr, status, error) {
                    // Your code here to handle error response
                }
            });
       }
function toggleinvestigationtype()
            {
                $option = $('#investigation_type_add').val(); 
                
                if($option == "Regular")
                {
                $('#showbranch').show();
                $('#showteamselection').hide();
                
                }

                if($option == "Special")
                {
                $('#showteamselection').show();
                $('#showdivisionheaddetails').hide();
                $('#showbranch').hide();
                
                }
            }

        function displaynames()
            {
                var branch = $('#branch').val(); 

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('showdivisionheads')}}",
                    type: "GET",
                    data:{
                        'branch' : branch 
                        },
                    success:function(result){
                            html = '<tr>';
                            html += '<td>'+result.name+'</td>';
                            html += '<td>'+result.position+'</td>';
                            $('#showdivisionheaddetails').show(100);
                            $('#showteamselection').hide();
                            $('#headdetails').append(html);
                    },
                    error:function(e){
                        console.log(e,'error');
                    }
                });
            }

function show_modal_chief_coi(casenoid)
{
    $('#case_no_id_coi_chief').val(casenoid);
    $('#showmodal_coi_chief').modal('show');

     var url = '{{ route("showcasedetailsforcoi", ":casenoid") }}';
            url = url.replace(':casenoid', casenoid);

            $.ajax({
                
                type:"GET",
                url: url,
                data: {search: $('#case_no_id_coi_chief').val()},
                success: function(responseText) {
                    
                    $("#casedetailsall").html(responseText);
                    $("#casedetailsall").show();
                    
                }
            });

            var url = '{{ route("viewcoi_chief", ":casenoid") }}';
                    url = url.replace(':casenoid', casenoid);

                    $.ajax({
                        
                        type:"GET",
                        url: url,
                        data: {search: $('#case_no_id_coi_chief').val()},
                        success: function(responseText) {
                            
                            $("#coi_show_chief").html(responseText);
                            $("#coi_show_chief").show();
                            
                        }
                    });
}

function viewentitydetailsaddcase(id){
    
        $('#entityidaddcase').val(id);
        $('#show_entitydtls_details').modal('show');
    

   var url = '{{ route("showentitydetails", ":id") }}';
            url = url.replace(':id', id);
               
            $.ajax({
                
                type:"GET",
                url: url,
                data: {search: $('#entityidaddcase').val()},
                success: function(result) {
                    
                    $("#entitydetailsshowaddcase").html(result);
                    $("#entitydetailsshowaddcase").show();
                    
                }
            });

}

function show_modal_reassign(casenoid)
                {
                
                $('#casenoid_reassign').val(casenoid);
            
                $('#modal_reassign_show').modal('show');

                var url = '{{ route("showcasedetailsforcoi", ":casenoid") }}';
                    url = url.replace(':casenoid', casenoid);
                    
                    $.ajax({
                        
                        type:"GET",
                        url: url,
                        data: {search: $('#casenoid_reassign').val()},
                        success: function(responseText) {
                            
                            $("#allegationandaccusedreassigncase").html(responseText);
                            $("#allegationandaccusedreassigncase").show();
                            
                        }
                    });

                    var url = '{{ route("showcasedetailsforreassigncasedirector", ":casenoid") }}';
                    url = url.replace(':casenoid', casenoid);
                    
                    $.ajax({
                        
                        type:"GET",
                        url: url,
                        data: {search: $('#casenoid_reassign').val()},
                        success: function(responseText) {
                            
                            $("#reassigndiv").html(responseText);
                            $("#reassigndiv").show();
                            
                        }
                    });

                }

</script>
@endsection