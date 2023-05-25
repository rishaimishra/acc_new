@extends('layouts.admin')

@section('content')
<br>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@include('investigator/mainheader')
    <!------------------------ end top part ---------------->  
<div class="col-sm-13" style="margin-top:-9px;">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                @include('tabs/investigator_tab')
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <i onclick="showtimeline()" name="addtimeline" id="addtimeline" data-toggle="tooltip" data-placement="bottom" title="Event Timeline" style="float:right; color:grey" onmouseover="this.style.color='#333333';" onmouseout="this.style.color='grey';" class="fa fa-timeline"></i></button> &nbsp;&nbsp;
                                @if(Auth::user()->role == "Investigator")
                                <i class="fa fa-plus" title="Add Event" onclick="addnewevent()" style="float:right; color:grey" onmouseover="this.style.color='#333333';" onmouseout="this.style.color='grey';"  data-toggle="tooltip" data-placement="bottom">&nbsp;&nbsp;</i>&nbsp;&nbsp;<br> 
                                @endif
                                    <table class="table table-bordered table-hover">
                                        <tr>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>Conducted By</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach($events as $event)
                                        <tr>
                                            <td>{{ $event->name }}</td>
                                            <td>{{ $event->date }}</td>
                                            <td>{!! $event->description !!}</td>
                                            <td>{{ $event->conducted_by }}  </td>
                                            <td>
                                            @if(Auth::user()->role == "Investigator")
                                                <button type="button" onclick="showeditevent('{{ $event->id }}')" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="bottom" title="Edit Summary" ><i class="fa fa-edit"></i></button></td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </table>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

<!--add modal -->
<form method = "POST" action="{{ route('addevent') }}"  enctype="multipart/form-data" >
      @csrf    
<div class="modal fade" id="addcaseevent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" >
            <div class="modal-content" style="font-family:Product Sans">                                                                                                                                                                                         <div class="modal-header alert-info">
                <h5 class="modal-title" id="exampleModalLabel">Add Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="eventcasenoidadd" id="eventcasenoidadd" value="{{ $casenoid }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="casetitle">Event Category:<font color='red'>*</font></label>
                                    <select class="form-control"   name="eventcategory" id="eventcategory" required>
                                        <option value="">Select</option>
                                            @foreach ($tasktypes as $tasktype)
                                                <option >{{ $tasktype->task_name }}</option>
                                            @endforeach    
                                    </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Event Name&nbsp;<font color='red'>*</font></label>
                                <input type="text" name="eventname"  class="form-control" id="eventname">
                            </div>        
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Event Date</label>
                                <input type="date" class="form-control" name="eventdate" id="eventdate" />
                            </div> 
                        </div> 
                    </div>  
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Event Description&nbsp;<font color='red'>*</font></label>
                                <textarea name="event_desc" id="event_desc" class="form-control" required=""></textarea>
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
<form method="POST" action="{{ route('updateevent') }}" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="editcaseevent">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Event</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="editeventid" id="editeventid">
                        <div id="editeventshow" style="display:none"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- end edit modal -->

<!-- edit modal -->
  <form method="POST" action="{{ route('updateevent') }}" enctype="multipart/form-data">
                            @csrf
    <div class="modal fade" id="eventtimeline">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Event Timeline</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="timeline">
                        @foreach ($events as $event)
                            <div class="timeline-event">
                                <div class="timeline-event-content">
                                    <div class="timeline-event-icon">
                                        <i class="material-icons"></i>
                                    </div>
                                    <div class="timeline-event-details">
                                        {{ $event->name }} &nbsp;[{{ $event->date }}]
                                        <p class="timeline-event-date">{{ $event->description }} </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- end edit modal -->
<script>

function addnewevent()
{
        $('#addcaseevent').modal('show');  
}

function showtimeline()
{
    $('#eventtimeline').modal('show');
}
function showeditevent(id)
{
        $('#editcaseevent').modal('show'); 
        $('#editeventid').val(id);

    var url = '{{ route("editevent", ":id") }}';
            url = url.replace(':id', id);
               
            $.ajax({
                
                type:"GET",
                url: url,
                data: {search: $('#idiaryid').val()},
                success: function(responseText) {
                    
                    $("#editeventshow").html(responseText);
                    $('#editeventshow').show();   
                }
            }); 
}
</script>
<style>
    
.modal-header {
    background: linear-gradient(to top, grey, #ffffff);
    color: #fff;
    font-family: Product Sans;
    border-radius: 5px 5px 0 0;
}

    .timeline {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .timeline-event {
        display: flex;
        align-items: flex-start;
        gap: 22px;
    }

    .timeline-event-content {
        display: flex;
        align-items: flex-start;
        gap: 5px;
        width: 100%;
    }

    .timeline-event-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 20px;
        height: 20px;
        background-color: #fff;
        border-radius: 50%;
        border: 1px solid red;

    }

    .timeline-event-details {
        flex-grow: 1;
    }

    .timeline-event-date {
        font-size: 14px;
        color: #999;
    }
</style>

@endsection