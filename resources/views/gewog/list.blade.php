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
                                Gewog List
                            </div>
                            <div class="col-sm">
                              <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModa3">
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
                                        <th>Gewog</th>
                                        {{-- <th>Detail</th> --}}
                                        <th>Dzongkhag</th>
                                        <th>Action</th>            
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(@$data)
                                    {{-- {{$data}} --}}
                                    @foreach(@$data as $att)
                                    <tr>
                                        <td>{{ $att->gewogID }}</td>
                                        <td>{{ $att->created_at }}</td>
                                        <td>{{ $att->gewogName }}</td>
                                        <td>{{ $att->getDzongkhagDetails->dzoName }}</td>
                                        <td>
                                                        {{-- <a class="btn btn-xs btn-info"
                                                               href="{{URL::to('attachment/complaintRegistration')}}/{{$att->AttachmentPath}}" target="_blank">
                                                                <i class="fa fa-eye"></i>
                                                                View
                                                            </a>
                                                             --}}
                                                            <a class="btn btn-xs btn-danger" href="{{route('gewog.delete',['id'=>@$att->gewogID])}}" onclick="return confirm('Are you sure , you want to delete this attachment ? ')"><i class="fa fa-trash"></i>
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
<div class="modal fade" id="exampleModa3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{route('gewog.store')}}">@csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Gewog</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name="gewogName" aria-describedby="emailHelp" placeholder="Gewog Name">
                  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                </div>

                <div class="form-group">
                  <select class="form-control" aria-label="Default select example" name="DzoID">
                    <option value="">Select</option>
                    @foreach(@$processing as $value)
                    <option value="{{$value->dzoID}}">{{@$value->dzoName}}</option>
                    @endforeach
                  </select>
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