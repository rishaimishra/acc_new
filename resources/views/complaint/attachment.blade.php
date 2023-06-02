@extends('layouts.admin')

@section('content')

<br>
<section class="content">
    <div id="casedetailscard" class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header" style="font-family:Product Sans"> Attachment List </div>

                        <div class = "card-body">
                            <h5>
                              <small>Attachments related to the complaint (Only PDF files are allowed)</small>
                            </h5>
                            <table id  = "maintable" class="table" >
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Attachment Name</th>
                                        <th>Detail</th>
                                        {{-- <th>File Size</th> --}}
                                        <th>Action</th>            
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(@$data->isNotEmpty())
                                    @foreach(@$data as $att)
                                    <tr>
                                        <td>{{ $att->CRattachmentID }}</td>
                                        <td>{{ $att->created_at }}</td>
                                        <td>{{ $att->CRattachmentName }}</td>
                                        <td>{{ $att->CRattachmentDetails }}</td>
                                        <td>
                                                        <a class="btn btn-xs btn-info"
                                                               href="{{URL::to('attachment/complaintRegistration')}}/{{$att->AttachmentPath}}" target="_blank">
                                                                <i class="fa fa-eye"></i>
                                                                View
                                                            </a>
                                                            
                                                            <a class="btn btn-xs btn-danger" href="{{route('attachment.delete.complaint',['id'=>@$att->CRattachmentID])}}" onclick="return confirm('Are you sure , you want to delete this attachment ? ')"><i class="fa fa-trash"></i>
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


        <form method="post" action="{{route('attachment.post.complaint')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="complaintID" value="{{@$id}}">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Attachment Name<span style="font-weight: bold; color: red;">*</span></label>
                            <input class="form-control"  type="text" name="CRattachmentName" required>
                    </div>
                </div>

                <div class="clearfix"> </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Attachment Details<span style="font-weight: bold; color: red;"></span></label>
                            <textarea class="form-control"  type="text" name="CRattachmentDetails"> </textarea>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Attachment File<span style="font-weight: bold; color: red;">*</span></label>
                            <input class="form-control" name="file" type="file" required>
                    </div>
                </div>
                <div class="col-sm-6"></div>
                <div class="col-sm-6"><button type="submit" class="btn btn-info">Upload Attachment</button></div>
            </div>
        </form>
    </div>
</section>




@endsection