    @foreach ($investigationplans as $invplan)
        <div class="row">
            <div class="col-md-3">
                <font face="Product Sans" color="Black">Start Date:</font>
            </div>
            <div class="col-md-9">
                <font face="Product Sans" color="Grey"><input type="date" class="form-control" name="invstartdate" id="invstartdate" text="{{$invplan->case_start_date}}"></textbox></font>
            </div>
        </div>
            <hr class="hrnew"></hr>
        <div class="row">
            <div class="col-md-3">
                <font face="Product Sans" color="black">End Date:</font>
            </div>
            <div class="col-md-9">
                <font face="Product Sans" color="grey"><input type="date" class="form-control" name="invstartdate" id="invstartdate" text="{{ $invplan->case_end_date}}"></textbox></font>
            </div>
        </div>
            <hr  class="hrnew"></hr>
        <div class="row">
            <div class="col-md-3">
                <font face="Product Sans" color="black">Allegations/Background:</font>
            </div>
            <div class="col-md-9">
                <font face="Product Sans" color="grey"><textarea name="case_allegations_inv" id="case_allegations_inv" class="form-control" value="">{!! $invplan->allegations !!}</textarea></font>
            </div>
        </div>
            <hr class="hrnew"></hr>
        <div class="row">
            <div class="col-md-3">
                <font face="Product Sans" color="black">Objectives of Investigation:</font>
            </div>
            <div class="col-md-9">
                <font face="Product Sans" color="grey"><textarea name="case_objectives_inv" id="case_objectives_inv" class="form-control" required="">{!! $invplan->objectives !!}</textarea></font>
            </div>
        </div>
            <hr  class="hrnew"></hr>
        <div class="row">
            <div class="col-md-3">
                <font face="Product Sans" color="black">Scope of Investigation:</font>
            </div>
            <div class="col-md-9">
                <font face="Product Sans" color="grey"><textarea name="case_scope_inv" id="case_scope_inv" class="form-control" required="">{!! $invplan->scope !!}</textarea></font>
            </div>
        </div>
    @endforeach

