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
                        
                        <div id="suspensionshow">
                        @if(Auth::user()->role == "Investigator")
                            <button type="button" style="float:right" class="btn btn-outline-primary" onclick="addsuspension()" name="addsuspension" id="addsuspension" data-toggle="tooltip" data-placement="bottom" title="Add asset"><i class="fa fa-plus"></i></button><br>
                        @endif
                            <br>
                                <table  class="table table-bordered table-hover">
                                    <thead >
                                    <tr>
                                        <th>Suspension Type</th>
                                        <th>CID No/License No</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Issue Date</th> 
                                        <th>Revoke Date</th> 
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($suspensions as $suspension)

                                    <tr>
                                        <td>{{ $suspension->suspension_type }}</td>
                                        <td>{{ $suspension->license_no }}</td>
                                        <td>{{ $suspension->name }}</td>
                                        <td>{{ $suspension->suspension_status }}</td>
                                        <td>{{ \Carbon\Carbon::parse($suspension->issue_date)->format('d/m/Y')}}</td>
                                        <td>{{ \Carbon\Carbon::parse($suspension->revoke_date)->format('d/m/Y')}}</td>
                                       
                                        <td>
                                            
                                            @if($suspension->suspension_status == "In Force")
                                            <a class  = "btn btn-outline-primary" href="{{ route('revokesuspensionorder', [ $suspension->id, $casenoid]) }}" data-toggle="tooltip" data-placement="bottom" title="Revoke"><i class="fa fa-repeat"></i></a>&nbsp;
                                            @elseif($suspension->suspension_status == "")
                                            <a class  = "btn btn-outline-primary" href="{{ route('generatesuspensionorder', [ $suspension->id, $casenoid]) }}" data-toggle="tooltip" data-placement="bottom" title="Generate Suspension Order"><i class="fa fa-print"></i></a>&nbsp; 
                                            @endif
                                        </td>
                                    </tr>

                                        @endforeach
                                    </tbody>
                                    </table> 
                                                
                            </div>
                            <!-- add suspension -->
                            <div id="addsuspensionshow" style="display:none">
                            <form method = "POST" action="{{ route('addsuspension') }}"   > 
                            @csrf    
                            <input type="hidden" name="suspensioncasenoadd" id="suspensioncasenoadd" value="{{ $caseno }}">
                                        <input type="hidden" name="suspensioncasenoidadd" id="suspensioncasenoidadd" value="{{ $casenoid }}">     
                                    <div class="row"> 
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="casetitle">Suspension Type:<font color='red'>*</font></label>
                                                        <select class="form-control"   name="suspensiontype" id="suspensiontype" required class="form-control">
                                                                <option value="">Select</option>
                                                                <option value="Public Servant">Public Servant</option>
                                                                <option value="Business">Business</option>
                                                        </select> 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="casetitle">CID/License No:<font color='red'>*</font></label>
                                                    <input type="text" name="cidnosuspension" id="cidnosuspension" class="form-control">
                                            </div>
                                        </div>    
                                    </div>
                                    <div class="row"> 
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                    <label for="casetitle">Name:<font color='red'>*</font></label>
                                                    <input type="text" name="namesuspension" id="namesuspension" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                            <label for="casetitle">Issue Date:<font color='red'>*</font></label>
                                                            <input type="date" name="issuedatesuspension" id="issuedatesuspension" class="form-control">
                                                </div>
                                        </div>    
                                    </div>
                                    <button type="button" style="float:right;" class="btn btn-outline-primary" onclick="closesuspensionadd()" name="closeaddsuspension" id="closeaddsuspension" data-toggle="tooltip" data-placement="bottom" title="Close" ><i class="fa fa-times"></i></button> 
                                    <button type="submit" class="btn btn-outline-primary" style="float:right;"  data-toggle="tooltip" data-placement="bottom" title="Add" ><i class="fa fa-save"></i></button> 
                                    
                                    </form>  
                            </div>           
					</div>
				</div>
  			</div>
	</div>
</section>
<script>
	function addsuspension()
        {
            $('#addsuspensionshow').show();
            $('#suspensionshow').hide();
        }
    function closesuspensionadd()
        {
            $('#addsuspensionshow').hide();
            $('#suspensionshow').show();
        }
        
</script>
@endsection