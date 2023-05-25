<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label>Report To<span style="font-weight: bold; color: red;">*</span></label>
                <select class="form-control" name="add_report_to" required>
                    <option>Select One</option>
                    @foreach ($interviewers as $intpersons)
                    <option value="{{ $intpersons->email }}">{{ $intpersons->name }}</option>
                    @endforeach
                </select>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label>Date<span style="font-weight: bold; color: red;">*</span></label>
                <input class="form-control" name="summondate" type="date" required>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label>Time<span style="font-weight: bold; color: red;">*</span></label>
                <input class="form-control" name="summontime" type="time" required>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label>Venue<span style="font-weight: bold; color: red;">*</span></label>
                <textarea class="form-control" name="summonvenue" ></textarea>
        </div>
    </div>
   <div class="col-sm-12">
        <h6><b>Documents to be produced</b></h6>
            <table id= "example3" class="table table-bordered table-hover">
                <thead >
                    <tr>
                        <th scope="col">Description of Document/Article</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Remarks</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
    </div>
</div>