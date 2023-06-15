@extends('layouts.admin')

@section('content')
<link
rel="stylesheet"
type="text/css"
href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css"
/>

<br>
<section class="content">
    <div id="casedetailscard" class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header" style="font-family:Product Sans"> Complaint List </div>
                        <div class = "card-body">
                            <table id  = "maintable" class="table" >
                                <thead>
                                    <tr>
                                        <th>Complaint Id</th>
                                        <th>Complaint Registration No.</th>
                                        <th>Complaint Registration Date</th>
                                        <th>Complaint Tile</th>
                                        <th>Mode</th>
                                        {{-- <th>Status</th> --}}
                                        <th>Action</th>            
                                    </tr>
                                </thead>
                                <tbody>
                                       @if(@$data->isNotEmpty())
                                       @foreach(@$data as $value)
                                       <tr>
                                           <td>{{@$value->complaintID}}</td>
                                           <td>{{@$value->complaintRegNo}}</td>
                                           <td>{{@$value->complaintDateTime}}</td>
                                           <td>{{@$value->complaintTitle}}</td>
                                           <td>{{@$value->complaintmoderelation->modeName}}</td>

                                           {{-- <td>@if(@$value->assign_status=="N") Registered @else Assigned  @endif</td> --}}

                                           <td>
                                              @if(@$value->evaluation_status=="AA")
                                               <a href="{{route('complaint.conflict.interest',['id'=>@$value->complaintID])}}" class="btn btn-info">COI</a>
                                               @else
                                               <a href="{{route('complaint.view.details',['id'=>@$value->complaintID])}}" class="btn btn-info">Evaluate</a>
                                               @endif
                                           </td>

                                       </tr>
                                       @endforeach
                                       @endif            
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>



<script
type="text/javascript"
charset="utf8"
src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"
></script>
<script
type="text/javascript"
charset="utf8"
src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
<script>
$(function() {
$("#maintable").dataTable();
});
</script>
@endsection