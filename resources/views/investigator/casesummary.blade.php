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
				    @if( $casesummary  == "")	
                        @if(Auth::user()->role == "Investigator") <button type="button" style="float:right;" class="btn btn-outline-primary" onclick="addcasesummary()"  data-toggle="tooltip" data-placement="bottom" title="Add Summary" ><i class="fa fa-plus"></i></button> @endif
					@else
                        <br>
                        <div id="casesummaryshow" >
                            {{ $casesummary }} 
                            <br>
                            @if(Auth::user()->role == "Investigator")
                           <button type="button" style="float:right;" class="btn btn-outline-primary" onclick="showeditsummarydetails('{{ $casenoid }}')"  data-toggle="tooltip" data-placement="bottom" title="Edit Summary" ><i class="fa fa-edit"></i></button>						
                           @endif
                        </div>
                    @endif
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
        
<!--add modal -->
<form method = "POST" action="{{ route('addcasesummary') }}"  enctype="multipart/form-data" >
      @csrf    
<div class="modal fade" id="addcasesummarymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" >
            <div class="modal-content" style="font-family:Product Sans">                                                                                                                                                                                         <div class="modal-header alert-info">
                    <h5 class="modal-title" id="exampleModalLabel">Add Case Summary</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <input type="hidden" name="casesummarycasenoidadd" id="casesummarycasenoidadd" value="{{ $casenoid }}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="casetitle">Case Summary:<font color='red'>*</font></label>
                                        <textarea name="casesummarydtls" id="casesummarydtls" class="form-control" required=""></textarea>
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
<!--add modal -->
<form method = "POST" action="{{ route('updatecasesummary') }}"  enctype="multipart/form-data" >
      @csrf    
<div class="modal fade" id="editcasesummarymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" >
            <div class="modal-content" style="font-family:Product Sans">                                                                                                                                                                                         <div class="modal-header alert-info">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Case Summary</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <input type="hidden" name="casesummarycasenoidedit" id="casesummarycasenoidedit" value="{{ $casenoid }}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="casetitle">Case Summary:<font color='red'>*</font></label>
                                        <textarea name="casesummaryeditdtls" id="casesummaryeditdtls" class="form-control" required="">  {{ $casesummary }} </textarea>
                                </div>
                            </div>
                        </div>  
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--end add modal -->
</section>
<script>
	
    function addcasesummary()
        {
            $('#addcasesummarymodal').modal('show'); 
             $('#casesummaryshow').show(); 
        }
    
    function showeditsummarydetails()
        {
            $('#editcasesummarymodal').modal('show'); 
        }

</script>
@endsection