@extends('layouts.admin')

@section('content')

<br>
<section class="content">
    <div id="casedetailscard" class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header" style="font-family:Product Sans"> 
                        {{-- Dzonkhag List --}}
                        <div class="row" style="font-family:Product Sans">
                            <div class="col-sm">
                                Dzonkhag List
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
                                        <th>Date</th>
                                        <th>Attachment Name</th>
                                        {{-- <th>Detail</th> --}}
                                        {{-- <th>File Size</th> --}}
                                        <th>Action</th>            
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(@$data->isNotEmpty())
                                    @foreach(@$data as $att)
                                    <tr>
                                        <td>{{ $att->dzoID }}</td>
                                        <td>{{ $att->created_at }}</td>
                                        <td>{{ $att->dzoName }}</td>
                                        {{-- <td>{{ $att->CRattachmentDetails }}</td> --}}
                                        <td>
                                                        {{-- <a class="btn btn-xs btn-info"
                                                               href="{{URL::to('attachment/complaintRegistration')}}/{{$att->AttachmentPath}}" target="_blank">
                                                                <i class="fa fa-eye"></i>
                                                                View
                                                            </a>
                                                             --}}
                                                            <a class="btn btn-xs btn-danger" href="{{route('dzonkhag.delete',['id'=>@$att->dzoID])}}" onclick="return confirm('Are you sure , you want to delete this attachment ? ')"><i class="fa fa-trash"></i>
                                                                Delete
                                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr><td>No Attachment Found Againt This Complaint</td></tr>
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
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{route('dzonkhag.store')}}">@csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Dzongkhag</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name="dzoName" aria-describedby="emailHelp" placeholder="Dzongkhag Name">
                  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
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


    </div>
</section>




@endsection