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
                                    Pursuability Feilds List
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
                                        <th>SubCategory</th>
                                        <th>Pursuability Value Field</th>
                                        <th>Allocated Points</th>
                                        <th>Remarks</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (@$data->isNotEmpty())
                                        @foreach (@$data as $att)
                                            <tr>
                                                <td>{{ $att->pValueFieldID   }}</td>
                                                <td>{{ $att->sub_category_name->pValueSubCategoryName }}</td>
                                                <td>{{ $att->pValueFieldName }}</td>
                                                <td>{{ $att->pValueFieldAllocatePoint }}</td>
                                                <td>{{ $att->pValueFieldRemarks }}</td>

                                                
                                                <td>
                                                

                                                    <a type="button"
                                                        class="btn btn-xs btn-primary edit_button row-class-{{ @$att->dzoID }}"
                                                         data-name="{{$att->pValueFieldName}}" data-id="{{$att->pValueFieldID}}" data-parent="{{$att->pValueSubCategoryID }}" data-max="{{$att->pValueFieldAllocatePoint}}"  data-remark="{{$att->pValueFieldRemarks}}"  data-toggle="modal"
                                                        >
                                                        Edit
                                                    </a>

                                                    <a class="btn btn-xs btn-danger"
                                                        href="{{ route('manage.pursuability-value-feilds.delete', ['id' => @$att->pValueFieldID]) }}"
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
                            <h5 class="modal-title" id="exampleModalLabel">Add Feilds</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('manage.pursuability-value-feilds.insert') }}">@csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">SubCategory</label>
                                   <select name="pValueSubCategoryID" class="form-control">
                                    <option>Select SubCategory</option>
                                    @foreach(@$subcategory as $value)
                                    <option value="{{@$value->pValueSubCategoryID}}">{{$value->pValueSubCategoryName}}</option>
                                    @endforeach    
                                   </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Pursuability Value Field</label>
                                    <input type="text" class="form-control"  name="pValueFieldName"
                                         placeholder="Pursuability Value Field" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Allocated Points</label>
                                    <input type="number" class="form-control"  name="pValueFieldAllocatePoint"
                                         placeholder="Allocated Points" required>
                                </div>

                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Remarks</label>
                                    <input type="text" class="form-control"  name="pValueFieldRemarks"
                                         placeholder="Remarks" required>
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
                            <h5 class="modal-title" id="exampleModalLabel">Edit Feilds</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('manage.pursuability-value-feilds.update') }}">@csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">SubCategory</label>
                                   <select name="pValueSubCategoryID" id="pValueSubCategoryID" class="form-control">
                                    <option>Select SubCategory</option>
                                    @foreach(@$subcategory as $value)
                                    <option value="{{@$value->pValueSubCategoryID}}">{{$value->pValueSubCategoryName}}</option>
                                    @endforeach    
                                   </select>
                                </div>

                                <input type="hidden" name="id" id="CategoryId">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Pursuability Value Field</label>
                                    <input type="text" class="form-control"  name="pValueFieldName"
                                         placeholder="Pursuability Value Field" id="pValueFieldName" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Allocated Points</label>
                                    <input type="number" class="form-control" id="pValueFieldAllocatePoint"  name="pValueFieldAllocatePoint"
                                         placeholder="Allocated Points" required>
                                </div>

                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Remarks</label>
                                    <input type="text" class="form-control" id="pValueFieldRemarks"  name="pValueFieldRemarks"
                                         placeholder="Remarks" required>
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
            $('#pValueFieldName').val($(this).data('name'));
            $('#CategoryId').val($(this).data('id'));
            $('#pValueFieldRemarks').val($(this).data('remark'));
            // $('#genderInput_'+data.person.gender).attr('checked', true);
            var dropdown = $(this).data('parent');
            $('#pValueSubCategoryID  option[value="'+dropdown+'"]').prop("selected", true);
            $('#pValueFieldAllocatePoint').val($(this).data('max'));
            
            $('#exampleModaEdit').modal('show');
        })
        
    </script>




@endsection
