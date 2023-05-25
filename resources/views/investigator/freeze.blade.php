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
                        @if(Auth::user()->role == "Investigator")
                        <button type="button" style="float:right" class="btn btn-outline-primary" onclick="addfreeze()" name="addfreezebutt" id="addfreezebutt" data-toggle="tooltip" data-placement="bottom" title="Add Freeze"><i class="fa fa-plus"></i></button>
                        @endif
                        <br><br>
                            <div id="showfreeze">
                                <table class="table table-bordered table-hover" id="freezetable">
                                    <tr>
                                        <th>Asset Type</th>
                                        <th>Date of Freeze</th>
                                        <th>Freeze Order No</th>
                                        <th>Action</th>
                                    </tr>
                                        @if($frozenassets->count())
                                        @foreach($frozenassets as $asset)
                                    <tr>
                                        <td>{{ $asset->asset_type }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                        @endforeach
                                        @else
                                    <tr>
                                        <td colspan="8"> No record found </td>
                                    </tr>
                                        @endif
                                    </table>
                            </div> 
                            <!-- add freeze -->
                            <div id="addfreezediv" style="display:none">
                                <input type="hidden" name="freezecasenoidadd" id="freezecasenoidadd" value="{{ $casenoid }}">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Asset Type&nbsp;<font color='red'>*</font></label>
                                                <select name="assettype" id="assettype" class="form-control" onchange="assettypechange()">
                                                    <option value="">Please Select</option>
                                                    <option value="Land">Land</option>
                                                    <option value="Vehicle">Vehicle</option>
                                                    <option value="Building">Building</option>
                                                    <option value="Bank">Bank</option>
                                                </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="showlandassetdiv" style="display:none">
                                    
                                </div> 
                                <div id="showbuildingassetdiv" style="display:none">
                                    
                                </div> 
                                <div id="showbankassetdiv" style="display:none">
                                    
                                </div> 
                                <div id="showvehicleassetdiv" style="display:none">
                                    
                                </div> 
                                
                                <button type="button" style="float:right" class="btn btn-outline-primary" onclick="closeaddfreeze()" name="closeaddfreezebutt" id="closeaddfreezebutt" data-toggle="tooltip" data-placement="bottom" title="Close" ><i class="fa fa-times"></i></button>
                            </div>
                            <!-- end add freeze -->             
					</div>
				</div>
  			</div>
	</div>
</section>
<script>
	function addfreeze()
    {
        $('#addfreezebutt').hide();
        $('#addfreezediv').show();
        $('#showfreeze').hide();
        
    }
     function closeaddfreeze()
     {
        $('#addfreezebutt').show();
        $('#addfreezediv').hide();
        $('#showfreeze').show();
     }

     function assettypechange()
     {
        var freezetype = $('#assettype').val();
        var casenoid = $('#freezecasenoidadd').val();
        
        if(freezetype == "Bank")
            {
                var url = '{{ route("showbankasset", ":casenoid") }}';
                    url = url.replace(':casenoid', casenoid);
                    
                    $.ajax({
                        
                        type:"GET",
                        url: url,
                        data: {search: $('#freezecasenoidadd').val()},
                        success: function(responseText) {
                            
                            $("#showbankassetdiv").html(responseText);
                            $('#showbankassetdiv').show(); 
                            $('#showbuildingassetdiv').hide(); 
                            $('#showlandassetdiv').hide(); 
                            $('#showvehicleassetdiv').hide(); 
                              
                            
                        }
                    });
            }
        
            if(freezetype == "Vehicle")
            {
                var url = '{{ route("showvehicleasset", ":casenoid") }}';
                    url = url.replace(':casenoid', casenoid);
                    
                    $.ajax({
                        
                        type:"GET",
                        url: url,
                        data: {search: $('#freezecasenoidadd').val()},
                        success: function(responseText) {
                            
                            $("#showvehicleassetdiv").html(responseText);
                            $('#showvehicleassetdiv').show();   
                            $('#showbuildingassetdiv').hide(); 
                            $('#showlandassetdiv').hide(); 
                            $('#showbankassetdiv').hide(); 
                            
                        }
                    });
            }

            if(freezetype == "Building")
            {
                var url = '{{ route("showbuildingasset", ":casenoid") }}';
                    url = url.replace(':casenoid', casenoid);
                    
                    $.ajax({
                        
                        type:"GET",
                        url: url,
                        data: {search: $('#freezecasenoidadd').val()},
                        success: function(responseText) {
                            
                            $("#showbuildingassetdiv").html(responseText);
                            $('#showbuildingassetdiv').show();  
                            $('#showbankassetdiv').hide(); 
                            $('#showlandassetdiv').hide(); 
                            $('#showvehicleassetdiv').hide();  
                            
                        }
                    });
            }

            if(freezetype == "Land")
            {
                var url = '{{ route("showlandasset", ":casenoid") }}';
                    url = url.replace(':casenoid', casenoid);
                    
                    $.ajax({
                        
                        type:"GET",
                        url: url,
                        data: {search: $('#freezecasenoidadd').val()},
                        success: function(responseText) {
                            
                            $("#showlandassetdiv").html(responseText);
                            $('#showlandassetdiv').show();  
                            $('#showbuildingassetdiv').hide(); 
                            $('#showbankassetdiv').hide(); 
                            $('#showvehicleassetdiv').hide();  
                            
                        }
                    });
            }
     }

     
</script>
@endsection