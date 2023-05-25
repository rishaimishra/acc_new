

            <!-- content -->
            <div class = "card-body"> 
            @foreach ($searchdetails as $data)
              <input type="hidden" name="searchidupdate" id="searchidupdate" value="{{  $search_id}}">                
                <div class="row">
                  <div class="col-md-2">
                      <label class="text-info"><b>Application Details:</b></label>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <label>Type of Search & Seizure Requested:</label>
                  </div>
                  <div class="col-md-4 form-group">
                  <input type="text" value="{{ $data->typeofsearch }}" class="form-control" name="applicationdate" readonly>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-2">
                    <label>Suspect:</label>
                  </div>
                  <div class="col-md-4 form-group">
                  <input type="text" value="{{ $data->suspect }}" class="form-control" name="applicationdate" readonly>
                  </div>
  
                  
                </div>

                <div class="row">
                  <div class="col-md-2">
                      <label>Probable Cause:</label>
                  </div>
                  <div class="col-md-4 form-group">
                    <textarea type="text" class="form-control" name="pcause" readonly>{{ $data->pcause }}</textarea>
                  </div>

                  
                </div>

                <div class="row">
                  <div class="col-md-2">
                      <label>Application Date:</label>
                  </div>
                  <div class="col-md-4 form-group">
                      <input type="date" value="{{ $data->applicationdate }}" class="form-control" name="applicationdate" readonly>
                  </div>
  
                  
                </div>

               
                

              
                @endforeach
               
                <hr>

                <div class="row">
                  <div class="col-md-4">
                      <label class="text-info"><b>Commission’s Recommendation</b></label>
                  </div>
                </div>

                
                <div class="row">
                  <div class="col-md-2">
                    <label>Recommendation Status:</label>
                  </div>
                  <div class="col-md-4 form-group">
                    <select class="form-control select2" Name="commissionStatusSearch">
                      <option selected>Select an Option</option>
                      @foreach ($Recommendationstatus as $getData1)
                        <option value="{{ $getData1->recommendationstatus_type }}">{{ $getData1->recommendationstatus_type }}</option>
                      @endforeach
                    </select>
                  </div>
  
                  <div class="col-md-2">
                      <label>Instructions/Remarks:</label>
                  </div>
                  <div class="col-md-4 form-group">
                      <textarea  type="text" class="form-control" name="commissionReviewSearch" placeholder="Please Enter Remarks" ></textarea>
                  </div>
                </div>

                          
                
               
            


