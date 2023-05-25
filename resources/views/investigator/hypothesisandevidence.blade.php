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
                @include('tabs/investigationplan_tab')
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    @if(Auth::user()->role == "Investigator")
                    <br><i class="fa fa-plus" style="float:right; color:grey" onclick="addnewhypo()" onmouseover="this.style.color='#333333';" onmouseout="this.style.color='grey';"  data-toggle="tooltip" data-placement="bottom" title="Add Hypothesis"></i>
                     @endif
                    <br>
                      <div class="header" style="background-color:#D3D3D3;height:40px; border-radius:5px; margin-top:10px;">&nbsp;&nbsp;<font color='#000000' size="5.2" face="Product Sans"> Section 2: Hypothesis</font></div>
                      <br>
                        <table class="table ">
                            <tr>
                                <th>Hypothesis</th>
                                <th>Evidence</th>
                                <th>Evaluation Status</th>
                                <th>Evaluated On</th>
                                <th>Action</th>
                                    
                            </tr>
                            @if($hypothesis->count())
                            
                                @foreach ($uniqueValues as $key => $values)
                                    <tr>
                                        <td>{{ $key }}</td>
                                        <td>
                                            @foreach($values as $hypo)
                                                {{ $hypo->evidence }} <br>
                                            @endforeach
                                        </td>
                                    @foreach ($values as $value)
                                        <td>{{ $value->evaluation_status }}</td>
                                        <td>{{ \Carbon\Carbon::parse($value->evaluated_on)->format('d/m/Y')}}</td>
                                        <td></td>
                                    </tr>
                                    @endforeach                                @endforeach
                                
                            @else
                            <tr>
                                <td colspan="5"> No record found </td>
                            </tr>
                            @endif
                        </table> 
                                <a href="{{route('viewactionplan', $casenoid)}}" style="float:right; color:grey"><i class='fa fa-arrow-circle-right'  data-toggle="tooltip" data-placement="bottom" title="Next"></i> Next</a>&nbsp;&nbsp;&nbsp;
                                <a href="{{route('viewinvestigationplan', $casenoid)}}" style="float:right; color:grey">Previous &nbsp;<i class='fa fa-arrow-circle-left'  data-toggle="tooltip" data-placement="bottom" title="Previous"></i> &nbsp;</a>&nbsp;&nbsp;&nbsp;
                                &nbsp;
                                
                                
                </div>
            </div>
            <!-- /.card -->
        </div>
</div>


<!-- add modal -->
  <form method="POST" action="{{ route('add_hypothesis') }}" enctype="multipart/form-data">
                            @csrf
    <div class="modal fade" id="addhypothesis">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Hypothesis</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="casenoidaddhypo" id="casenoidaddhypo" value="{{ $casenoid }}">
                    <table class="table" id="addevidencetable">
                        <thead>
                        <th>Hypothesis</th>
                        <th>Evidence</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td><br>
                                <input class="form-control" type="text" name="case_hypo" id="case_hypo" > 
                                </td>
                                <td>
                                    <table class="table no-border" >
                                        <tbody id="tablebody">
                                            <tr>
                                                <td><input type="text" name="case_evidence[]" id="case_evidence[]" class='form-control'></td>
                                                <td><i class="fa fa-plus" style="color:green" onclick="test()"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td> 
                            </tr>
                        </tbody>
                    </table>      

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    </form>

<!-- end add modal -->


<!-- add modal -->
  <form method="POST" action="{{ route('updateinvplan') }}" enctype="multipart/form-data">
                            @csrf
    <div class="modal fade" id="edithypothesis">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Hypothesis</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="invplaneditid" id="invplaneditid">
                    <input type="hidden" name="invplancasenoupdate" id="invplancasenoupdate" value="{{ $caseno }}">
                    <input type="hidden" name="invplancasenoidupdate" id="invplancasenoidupdate" value="{{ $casenoid }}">
                    <div id="showeditinvplan" style="display:none;"> </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary"><i class="fa fa-save"></i></button>
                </div>
            </div>
        </div>
    </div>
    </form>

<!-- end add modal -->
<script>
    function addnewhypo() {
        $('#addhypothesis').modal('show');  
    }

    function test() {
        
        var html = "<tr><td><input type='text' class='form-control' name='case_evidence[]'></td><td><i class='fa fa-minus' style='color:red' onclick='remove()'></i></td></tr>";
        $('#tablebody').append(html);
    }
    
    function remove() {
        var $tableBody = $('#addevidencetable').find("tbody"),
        $trLast = $tableBody.find("tr:last"),
        $trNew = $trLast.remove();
    }



</script>
<style>
    .modal-header {
    background: linear-gradient(to top, grey, #ffffff);
    color: #fff;
    border-radius: 5px 5px 0 0;
}
</style>
@endsection