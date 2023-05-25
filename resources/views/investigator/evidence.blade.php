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
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    @include('tabs/evidence_tab')
                     @if(Auth::user()->role == "Investigator")
                                <i class="fa fa-plus" title="Add Evidence" onclick="addnewevidencetag()" style="float:right; color:grey" onmouseover="this.style.color='#333333';" onmouseout="this.style.color='grey';"  data-toggle="tooltip" data-placement="bottom"></i>&nbsp;&nbsp;<br> 
                                @endif
                    <div id="showevidencetag">
                        <table class="table ">
                            <tr>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Evidence Name</th>
                                <th>Evidence No</th>
                                <th>Collected On</th>
                                <th>Collection Method</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            @if($evidences->count())
                            @foreach($evidences as $evidence)
                            <tr>
                                
                                <td>{{ $evidence->evidence_category	 }}</td>
                                <td>{{ $evidence->evidence_subcategory	 }}</td>
                                <td>{{ $evidence->evidence_name	 }}</td>
                                <td>{{ $evidence->evidence_no }}</td>
                                <td>{{ \Carbon\Carbon::parse($evidence->collected_on)->format('d/m/Y')}}</td>
                                <td>{{ $evidence->collected_from }}</td>
                                <td>{{ $evidence->evidence_description }}</td>
                                <td><button type="button" onclick="showeditevidence('{{ $evidence->id }}')" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="bottom" title="Edit" ><i class="fa fa-edit"></i></button></td>
                                
                            </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="8"> No record found </td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

<!--add modal -->
<form method = "POST" action="{{ route('addevidences') }}"  enctype="multipart/form-data" >
      @csrf    
<div class="modal fade" id="addevidence" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" >
            <div class="modal-content" style="font-family:Product Sans">                                                                                                                                                                                         <div class="modal-header alert-info">
                    <h5 class="modal-title" id="exampleModalLabel">Add Exhibit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <div class="row"> 
                        <input type="hidden" name="evicasenoidadd" id="evicasenoidadd" value="{{ $casenoid }}">
                            <div class="col-sm-6">
                                <div class="form-group">
                                        <label>Evidence Category&nbsp;<font color='red'>*</font></label>
                                        <select class="form-control" name="evidencecat" id="evidencecat" onchange="abc()">
                                            <option selected="selected" value="">--select one-- </option>
                                            <option value="g">Statement</option>    
                                            <option value="a,b,c,d,e,f">Record</option>
                                            <option value="h,i">Physical Exhibits</option>
                                            <option value="m,n,o">Digital</option>
                                        </select>

                                        
                                        <br />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Sub Category&nbsp;<font color='red'>*</font></label>
                                        <select class="form-control" id="evidencesubcat" name="evidencesubcat">
                                            <option selected="selected" value="">--select one-- </option>
                                            <option value="a">Financial Statement</option>
                                            <option value="b">Minutes of Meeting</option>
                                            <option value="c">Agreement</option>
                                            <option value="d">Document</option>
                                            <option value="e">Report</option>
                                            <option value="f">Official Correspondence</option>
                                            <option value="h">Weapons</option>
                                            <option value="i">Cash</option>
                                            <option value="j">Jwelleries</option>
                                            <option value="k">Electronic Equipments</option>
                                            <option value="l">Clothes</option>
                                            <option value="m">Emails</option>
                                            <option value="n">Audio visuals</option>
                                            <option value="o">Computer files</option>
                                        </select>
                                </div>
                            </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Evidence Number&nbsp;<font color='red'>*</font></label>
                                    <input type="text" name="evidenceno"  class="form-control" id="evidenceno">
                                    
                                </div>
                        </div>
                        <div class="col-sm-6">
                                <div class="form-group">
                                <label>Evidence Name&nbsp;<font color='red'>*</font></label>
                                    <input type="text" name="evidname"  class="form-control" id="evidname">   
                                </div>
                        </div>
                    </div>   
                    <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Collected On&nbsp;<font color='red'>*</font></label>
                                    <input type="date" name="collected_on"  class="form-control" id="collected_on">
                                    
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    
                                    <label>Collected Method&nbsp;<font color='red'>*</font></label>
                                        <select class="form-control"   name="evidfrom" id="evidfrom" required>
                                            <option value="">Select</option>
                                                @foreach ($collectionmethods as $method)
                                                    <option >{{ $method->method }}</option>
                                                @endforeach    
                                        </select>   
                                </div>
                            </div>
                    </div> 
                    <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Evidence Description&nbsp;<font color='red'>*</font></label>
                                    <input type="text" name="evidescription"  class="form-control" id="evidescription">
                                    
                                </div>
                            </div>
                    </div> 
                    <div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Upload Exhibit&nbsp;<font color='red'>*</font></label>
                                <input type="file" name="eviexhibit"  class="form-control" id="eviexhibit">
                                
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
  <form method="POST" action="{{ route('updateevid') }}" enctype="multipart/form-data">
                            @csrf
    <div class="modal fade" id="editevidencemodal">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Exhibit</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="evidenceid" id="evidenceid">
                    <div id="editevidenceshow" style="display:none">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    </form>

<!-- end edit modal -->
<script>
    
	function addnewevidencetag()
        {
            $('#addevidence').modal('show');  
        }
    
    function showeditevidence(id)
        {
            $('#editevidencemodal').modal('show'); 
            $('#evidenceid').val(id);

    var url = '{{ route("editevid", ":id") }}';
            url = url.replace(':id', id);
               
            $.ajax({
                
                type:"GET",
                url: url,
                data: {search: $('#evidenceid').val()},
                success: function(responseText) {
                    
                    $("#editevidenceshow").html(responseText);
                    $('#editevidenceshow').show();   
                }
            });
        }
    
        function abc()
        {
            var values = $('#evidencecat').val().split(',') //split value which is selected
                $("#evidencesubcat option").hide() //hide all options from slect box
  //loop through values
                for (var i = 0; i < values.length; i++) {
                var vals = values[i]
                $("#evidencesubcat option[value=" + vals + "]").show()//show that option

                }
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