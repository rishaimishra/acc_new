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
                                    Pursuability Category List
                                </div>
                                <div class="col-sm">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModa2">
                                        Add
                                    </button>
                                </div>
                            </div>

                        </div>




                        <div class="card-body">
                            {{-- <h5>
                              <small>Dzonkhags related to the complaint (Only PDF files are allowed)</small>
                            </h5> --}}
                            <table id="maintableDz" class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th>Remarks</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (@$data->isNotEmpty())
                                        @foreach (@$data as $att)
                                            <tr>
                                                <td>{{ $att->pValueCategoryID }}</td>
                                                <td>{{ $att->pValueName }}</td>
                                                <td>{{ $att->pValueRemarks }}</td>
                                                {{-- <td>{{ $att->CRattachmentDetails }}</td> --}}
                                                <td>
                                                

                                                    <a type="button"
                                                        class="btn btn-xs btn-primary edit_button row-class-{{ @$att->dzoID }}"
                                                        data-row-data='{{ @$att->pValueName }}' data-name="{{$att->pValueName}}" data-id="{{$att->pValueCategoryID}}" data-remark="{{$att->pValueRemarks}}"  data-toggle="modal"
                                                        >
                                                        Edit
                                                    </a>

                                                    <a class="btn btn-xs btn-danger"
                                                        href="{{ route('manage.pursuability-value-category.delete', ['id' => @$att->pValueCategoryID]) }}"
                                                        onclick="return confirm('Are you sure , you want to delete this  ? ')"><i
                                                            class="fa fa-trash"></i>
                                                        Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>No Attachment Found Againt This Complaint</td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="exampleModa2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('manage.pursuability-value-category.insert') }}">@csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Category</label>
                                    <input type="text" class="form-control"  name="pValueName"
                                         placeholder="Category Name">
                                    {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Remarks</label>
                                    <input type="text" class="form-control"  name="pValueRemarks"
                                         placeholder="Remarks">
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


            <!--Edit Modal -->
            <div class="modal fade" id="exampleModaEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('manage.pursuability-value-category.update') }}">@csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Category</label>
                                    <input type="text" class="form-control" name="pValueName"
                                        aria-describedby="emailHelp" id="pValueName_edit" placeholder="Category Name">
                                    <input type="hidden" id="CategoryId" name="id">
                                </div>

                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Remarks</label>
                                    <input type="text" class="form-control" id="remakrs_name_edit" name="pValueRemarks"
                                        aria-describedby="emailHelp" placeholder="Remarks">
                                   
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


    <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
    <script>
        // $(function() {
        //     $("#maintableDz").dataTable();
        // });

        $(document).ready(function() {
            $('#maintableDz').DataTable({
                order: [
                    [0, 'desc']
                ],
            });
        });

// ;

        $('.edit_button').on('click',function(){
            $('#pValueName_edit').val($(this).data('name'));
            $('#CategoryId').val($(this).data('id'));
            $('#remakrs_name_edit').val($(this).data('remark'));
            $('#exampleModaEdit').modal('show');
        })
        
    </script>




@endsection
