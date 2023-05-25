@extends('layouts.admin')

@section('content')

<br>
@include('investigator/mainheader')
    <!------------------------ end top part ---------------->   

	<div class="card  card-tabs">
  		<h6 class="card-header">@include('tabs/investigator_tab')</h6>
  			<div class="card-body">
			  	<div class="row">
                    <div class="col-12 col-sm-12">
                        @include('tabs/oands_tab') 
                        <br>
                        @include('tabs/searchandseizure_tab')
                        
                        <div id="searchindex">
                           @if(Auth::user()->role == "Investigator")
                                <button type="button" style="float:right" class="btn btn-outline-primary" onclick="addnewsearch()" name="addnewsearchbutt" id="addnewsearchbutt" data-toggle="tooltip" data-placement="bottom" title="Add search"><i class="fa fa-plus"></i></button>
                            @endif
                                <table id = "example3" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                        <th scope="col">Type of Search</th>
                                        <th scope="col">Request Date</th>
                                        <th scope="col">Accused</th>
                                        <th scope="col">Application Status</th>
                                        <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        @if($searchdetails->count())
                                        @foreach ($searchdetails as $search)
                                            <td>{{$search->typeofsearch}}</td>
                                            <td>{{ \Carbon\Carbon::parse($search->applicationdate)->format('d/m/Y')}}</td>
                                            <td><?php echo $key=DB::table('tbl_case_entities')->where('id',$search->suspect)->value('name'); ?></td>
                                            <th>
                                            @if($search->commissionStatus=='Approved')
                                                <label class="text-success">Approved</label>
                                                    @elseif($search->commissionStatus=='Rejected')
                                                <label class="text-danger">Rejected</label>
                                                    @elseif($search->commissionStatus==0)
                                                <label class="text-warning">Pending</label>
                                                    @endif
                                            </th>
                                            <td>
                                                @if($search->commissionStatus == '0')
                                                    @if(Auth::user()->role == "Commission")
                                                        <button class  = "btn btn-outline-primary"  type="button" onclick="showsearchdetailsforupdate('{{ $search->search_id }}')" data-toggle="tooltip" data-placement="bottom" title="Update"><i class="fa fa-pencil"></i></button>      
                                                    @endif
                                                @endif
                                                @if($search->commissionStatus == 'Approved' && $search->seizureStatus == 'Not Seized')
                                                    @if(Auth::user()->role == "Investigator" )
                                                        <button class  = "btn btn-outline-primary"  type="button" onclick="showsearchdetailsforseizure('{{ $search->search_id }}','{{ $search->case_no_id }}')" data-toggle="tooltip" data-placement="bottom" title="Add seizure details">Seize</button>      
                                                    @endif
                                                @endif
                                                @if($search->commissionStatus == 'Approved' && $search->seizureStatus == 'Seized')
                                                    <button class  = "btn btn-outline-primary"  type="button" onclick="showseizeddetails('{{ $search->search_id }}')" data-toggle="tooltip" data-placement="bottom" title="View seizure details">View Seizure Details</button>      
                                                    
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
                        <!-- add new search -->
                        <div id="addnewsearchdiv" style="display:none">
                        <form method = "POST" action="{{ route('addsearch') }}"  enctype="multipart/form-data" >
                                                                    @csrf 
                                    <input type="hidden" name="searchcasenoidadd" id="searchcasenoidadd" value="{{ $casenoid }}">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Search Authorization Type&nbsp;<font color='red'>*</font></label>
                                                        <select class="form-control" name="typeofsearch">
                                                            <option selected>Select an Option</option>
                                                                @foreach ($typeseizures as $seizuretype)
                                                                    <option value="{{ $seizuretype->seizure_type }}">{{ $seizuretype->seizure_type }}</option>
                                                                @endforeach
                                                        </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Suspect Name&nbsp;<font color='red'>*</font></label>
                                                        <select class="form-control"   name="searchsuspect" id="searchsuspect" >
                                                            <option selected>Select an Option</option>
                                                            @foreach($accused as $subject)
                                                                <option value="{{ $subject->id}}">{{ $subject->entity_name}} [{{ $subject->entity_cid}}]</option>
                                                            @endforeach
                                                        </select>                                    
                                                </div>                                
                                            </div>
                                        </div>
                                        <div class= "row">                  
                                            <div class  = "col-md-6">
                                                <div class="form-group">
                                                    <label>Application Date&nbsp;<font color='red'>*</font></label>
                                                    <input type="date" class="form-control" name="searchapplicationdate">
                                                </div>
                                            </div>
                                        </div>     
                                        <div class= "row">                  
                                            <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Probable Cause:&nbsp;<font color='red'>*</font></label>
                                                        <textarea type="text" class="form-control" name="searchpcause" id="searchpcause" placeholder="Please Enter Probable Cause"></textarea>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class= "row">                  
                                            <div class  = "col-md-6">
                                                <div class="form-group">
                                                    <label>Search Target&nbsp;<font color='red'>*</font></label>
                                                            <select class="form-control select2" onchange="searchTarget()" id="searchtarget" name="searchtarget">
                                                                <option selected>Select an Option</option>
                                                                <option value="movable">Movable Property</option>
                                                                <option value="publicPremise">Premises (Public)</option>
                                                                <option value="privatePremise">Premises (Private)</option>
                                                            </select>
                                                </div>
                                            </div>
                                        </div> 
                                        
                                        <div id = 'displaymovable' style = "display: none;">
                                                <h5 class="text-info"><b>Movable</b></h5>
                                            

                                            <div class="row">
                                                <div class="col-md-2">                   
                                                    <label>Identification No:</label>
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <input type="text" id="ideNo" class="form-control" name="ideNo" placeholder="Enter Identification Number">
                                                </div>

                                                <div class="col-md-2">
                                                    <label>Owner Name:</label>
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <input type="text" id="movableOwner" class="form-control" name="movableOwner" placeholder="Enter Owner Name">
                                                </div>
                                            </div></div>
                                    
                                            
                                            <br>
                                            <div id = 'displaypublicpremise' style = "display:none;">
                                                <h5 class="text-info"><b>Public Premise</b></h5>
                                            
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Office Name:</label>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <input type="text" id="publicName" class="form-control" name="publicName" placeholder="Enter Office Name">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Location:</label>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <input type="text" id="publicLocation" class="form-control" name="publicLocation" placeholder="Enter Office Location">
                                                </div>
                                            </div>
                                            </div>
                                            
                                            <br>
                                            <div id = 'displayprivatepremise' style = "display:none;">
                                                <h5 class="text-info"><b>Private Premise</b></h5>
                                            
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Location:</label>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <input type="text" id="privateLocation" class="form-control" name="privateLocation" placeholder="Enter  Location">
                                                </div>
                                            </div></div>
                                            
                                            <br>
                                            <div id = 'displayperson' style = "display :none;">
                                                <h5 class="text-info"><b>Person</b></h5>
                                            
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Name:</label>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <input type="text" id="first-name" class="form-control" name="warrant_rNo" placeholder="Please Enter Name">
                                                </div>

                                                <div class="col-md-4">
                                                    <label>CID</label>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <input type="text" id="personCid" class="form-control" name="personCid" placeholder="Please Enter CID">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">                            
                                                    <label>Contact No:</label>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <input type="text" id="personContact" class="form-control" name="personContact" placeholder="Please Enter Contact Number">
                                                </div>
                                            </div></div>
                                            <br>
                        <button type="button" style="float:right" class="btn btn-outline-primary" onclick="closeaddnewsearchdiv()" name="closeaddnewsearchbutt" id="closeaddnewsearchbutt" data-toggle="tooltip" data-placement="bottom" title="Close" ><i class="fa fa-times"></i></button>
                        <button type="submit" style="float:right;" class="btn btn-outline-primary" ><i class="fa fa-save"></i></button>    
                    </form>
                        </div> 
                        <!-- end add new search -->
                        <br>  
                        <div id="displaysearchdetailsforseizure" style="display:none">
                                <input type="hidden" name="displaysearchdetailsid" id="displaysearchdetailsid">
                                <input type="hidden" id="casenoidseizureadd" name="casenoidseizureadd" value="">
                        </div> 
                        <br>  
                        <div id="searchdetailsforcommissionupdate" style="display:none">
                            <input type="hidden" name="searchidupdate" id="searchidupdate">
                        </div>   
                        <br>
                        <div id="displayseizuredetails" style="display:none">
                                <input type="hidden" name="displayseizuredetailsid" id="displayseizuredetailsid">
                        </div>       
					</div>
				</div>
  			</div>

	</div>
</section>
<script>
	
    function addnewsearch()
    {
        $('#addnewsearchdiv').show(); 
        $('#searchindex').hide(); 
        $('#addnewsearchbutt').hide(); 
    }
    function closeaddnewsearchdiv()
    {
        $('#addnewsearchdiv').hide(); 
        $('#searchindex').show(); 
        $('#addnewsearchbutt').show(); 
    }
    
    

        function searchTarget() {
                var x = document.getElementById("searchtarget").value;
                if(x == 'movable'){
                    $('#displaymovable').show();
                    $('#displaypublicpremise').hide();
                    $('#displayprivatepremise').hide();
                    $('#displayperson').hide();
                }
                else if(x == 'publicPremise'){
                    $('#displaypublicpremise').show();
                    $('#displayprivatepremise').hide();
                    $('#displaymovable').hide();
                    $('#displayperson').hide();
                }
                else if(x == 'privatePremise'){
                    $('#displayprivatepremise').show();
                    $('#displaymovable').hide();
                    $('#displaypublicpremise').hide();
                    $('#displayperson').hide();
                }
                else if(x == 'person'){
                    $('#displayperson').show();
                    $('#displaymovable').hide();
                    $('#displaypublicpremise').hide();
                    $('#displayprivatepremise').hide();
                    
                }
                else {
                    $('#displayperson').hide();
                    $('#displaymovable').hide();
                    $('#displaypublicpremise').hide();
                    $('#displayprivatepremise').hide();
                    
                }
        }

    function showsearchdetailsforupdate(search_id)
        {
            $('#searchidupdate').val(search_id);

            var url = '{{ route("commissionUpdateSearch", ":search_id") }}';
                    url = url.replace(':search_id', search_id);
                    
                    $.ajax({
                        
                        type:"GET",
                        url: url,
                        data: {search: $('#searchidupdate').val()},
                        success: function(responseText) {
                            
                            $("#searchdetailsforcommissionupdate").html(responseText);
                            $("#searchdetailsforcommissionupdate").show();
                            $('#searchindex').hide();
                            $('#addnewsearchdiv').hide();
                            $('#addnewsearchbutt').hide();
                        }
                    });
        }

    function showsearchdetailsforseizure(search_id,casenoid)
        {
            $('#displaysearchdetailsid').val(search_id);
            $('#casenoidseizureadd').val(casenoid);

            var url = '{{ route("seizureAdd",  ['search_id' => ':search_id', 'casenoid' => ':casenoid']) }}';
                url = url.replace(':search_id', search_id);    
                url = url.replace(':casenoid', casenoid);
                

                    $.ajax({
                        
                        type:"GET",
                        url: url,
                        data: { 
                                search: $('#displaysearchdetailsid').val(),
                                search: $('#casenoidseizureadd').val()
                              },
                        success: function(responseText) {
                            
                            $("#displaysearchdetailsforseizure").html(responseText);
                            $("#displaysearchdetailsforseizure").show();
                            $('#addnewsearchdiv').hide();
                            $('#searchindex').hide();
                            $('#addnewsearchbutt').hide();
                        }
                    });
        }

        function showseizeddetails(search_id)
        {
            $('#displayseizuredetailsid').val(search_id);

            var url = '{{ route("viewseizuredetails", ":search_id") }}';
                    url = url.replace(':search_id', search_id);
                    
                    $.ajax({
                        
                        type:"GET",
                        url: url,
                        data: {search: $('#displayseizuredetailsid').val()},
                        success: function(responseText) {
                            
                            $("#displayseizuredetails").html(responseText);
                            $("#displayseizuredetails").show();
                            $('#addnewsearchdiv').hide();
                            $('#searchindex').hide();
                            $('#addnewsearchbutt').hide();
                        }
                    });
        }
</script>
@endsection