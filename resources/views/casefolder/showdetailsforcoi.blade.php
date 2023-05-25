@foreach ($casedetails as $cases)
                <div class="row" > 
	                <div class="col-md-4">
                        <div class="form-group">
                            <label>Case Number: </label>&nbsp; {{ $cases->case_no }} 
                              <br>
                              <label>Sector Type: </label> &nbsp; {{ $cases->sector }}
                                <br>
                            <label>Institution Type: </label> &nbsp; {{ $cases->institution_type }}
                            <br>
                            
                            
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Case Title: </label> &nbsp;  {{ $cases->case_title }}
                                    <br>
                            <label>Sector Sub Type: </label> &nbsp; {{ $cases->sector_type }}
                                    <br>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Case Creation Date: </label> &nbsp; {{ \Carbon\Carbon::parse($cases->creation_date)->format('d/m/Y')}}
                            <br>
                            <label>Area: </label> &nbsp; {{ $cases->area }}
                           
                        </div>
                    </div>
                </div>
                <hr style="height: 1px;  background: teal; margin: 10px 0;   box-shadow: 0px 0px 4px 2px rgba(204,204,204,1);">
                <div class="row" > 
	                <div class="col-md-12">
                        <div class="form-group">
                            <label>Complaint Details: </label> &nbsp; {{ $cases->allegation_details }}
                        </div>
                    </div>
                </div>
                <div class="row">
                        <div class = "col-md-6">
                            <div class = "form-group">
                                <label for = "exampleInputEmail1">Offence Details</label>
                                    <ol>
                                        @foreach ($offencedetails as $off)
                                            <li> 
                                                {{ $off->offence_type }}<br>
                                            </li>
                                        @endforeach
                                    </ol>                     
                            </div>
                        </div>
                </div>
                <hr style="height: 1px;  background: teal; margin: 10px 0;   box-shadow: 0px 0px 4px 2px rgba(204,204,204,1);">
                <div class="row">
                        <div class = "col-md-12">
                            <div class = "form-group">
                                <label for = "exampleInputEmail1">Accused</label>
                                    <table id="addmoretable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>CID/Permit No</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="entity">
                                            @foreach ($accuseddetails as $entityshow)
                                                <tr>   
                                                    <td>{{ $entityshow->name }}</td>
                                                    <td>{{ $entityshow->identification_no }}</td>
                                                    <td><button type="button" onclick="viewentitydetailscoi('{{ $entityshow->id }}')"  id="viewdetails" name="viewdetails" data-toggle="tooltip" data-placement="bottom" title="View Details"><i class="fa fa-eye"></i></button></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>                   
                            </div>
                        </div>
                </div>
        @endforeach
<!-- show entity details modal -->
<div class="modal fade" id="show_entity_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg  modal-dialog-scrollable" >
            <div class="modal-content">
                <div class="modal-header alert-secondary">
                    <h5 class="modal-title" >Entity Details</h5>
                    <button type="button" class="close" onclick="closeentitymodal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value=""  name="entityidcoi" id="entityidcoi">
                        <div id="entitydetailsshow" style="display:none;"></div>
                            
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="closeentitymodal()">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end -->
<script>
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
function closeentitymodal()
        {
            $('#show_entity_details').modal('hide');
        }
</script>