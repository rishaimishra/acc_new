@extends('layouts.admin')

@section('content')

<br>
<section class="content">
    <div id="casedetailscard" class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header" style="font-family:Product Sans"> 
                        {{-- Embassy List --}}
                        <div class="row" style="font-family:Product Sans">
                            <div class="col-sm">
                              Complaint Type List
                            </div>
                            <div class="col-sm">
                              <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModa2">
                                    Add
                                </button>
                            </div>
                          </div>
                          
                    </div>

                    


                        <div class = "card-body">
                            {{-- <h5>
                              <small>Dzonkhags related to the complaint (Only PDF files are allowed)</small>
                            </h5> --}}
                            <table id  = "maintable" class="table" >
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Complaint Type</th>
                                        <th>Action</th>            
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(@$data->isNotEmpty())
                                    @foreach(@$data as $att)
                                    <tr>
                                        <td>{{ $att->id}}</td>
                                        <td>{{ $att->complainttypeName }}</td>
                                        
                                        <td>
                                                        {{-- <a class="btn btn-xs btn-info"
                                                               href="{{URL::to('attachment/complaintRegistration')}}/{{$att->AttachmentPath}}" target="_blank">
                                                                <i class="fa fa-eye"></i>
                                                                View
                                                            </a>
                                                             --}}

                                                             <a type="button"
                                                                class="btn btn-xs btn-primary edit_button"
                                                                data-name="{{$att->complainttypeName}}" data-id="{{$att->id}}"  data-toggle="modal"
                                                                >
                                                                Edit
                                                            </a>


                                                            <a class="btn btn-xs btn-danger" href="{{route('complaint-type-master.delete',['id'=>$att->id])}}" onclick="return confirm('Are you sure , you want to delete this  ? ')"><i class="fa fa-trash"></i>
                                                                Delete
                                                            </a>

                                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr><td>No Data Found</td></tr>
                                    @endif
                                                  
                               </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
<div class="modal fade" id="exampleModa2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Complaint Type</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{route('complaint-type-master.add')}}">@csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Complaint Type</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name="complainttypeName" aria-describedby="emailHelp" placeholder="Complaint Type">
                 </div>

                 
        
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
  </div>


<!--Edit Modal -->
            <div class="modal fade" id="exampleModaEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Complaint Mode</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{route('complaint-type-master.update')}}">@csrf
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Complaint Type</label>
                                  <input type="text" class="form-control" id="complainttypeName" name="complainttypeName" aria-describedby="emailHelp" placeholder="Complaint Type">
                                 </div>

                                 
                             <input type="hidden" name="id" id="id">
                                <button type="submit" class="btn btn-primary">Submit</button>
                              </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                        </div>
                    </div>
                </div>
            </div>

    </div>
</section>


<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $('.edit_button').on('click',function(){
            $('#complainttypeName').val($(this).data('name'));
            $('#id').val($(this).data('id'));
            
            $('#exampleModaEdit').modal('show');
        })
</script>


@endsection