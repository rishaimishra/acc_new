
<div class = "card-body"> 
      @foreach ($Mainarrest as $data)
        <input type="hidden" name="arrestid" id="arrestid" value="{{ $arrest_id}}">
      <div class="row">
        <div class="col-md-2">
            <label class="text-info"><b>Application Details:</b></label>
        </div>
      </div>
      <div class="row">
          <div class="col-sm-3">
              <div class="form-group">
                  <label>Type of Arrest & Detention Requested&nbsp;</label><br>
                      {{ $data->typeofArrest }}
              </div>
          </div>
          <div class="col-sm-3">
              <div class="form-group">
                  <label>Application Date&nbsp;</label><br>
                      {{ \Carbon\Carbon::parse($data->applicationdate)->format('d/m/Y') }}
                                                
              </div>                                
          </div>
          <div class  = "col-md-3">
              <div class="form-group">
                <label>Suspect Name&nbsp;</label> <br>
                     <?php echo $key=DB::table('tbl_case_entities')->where('id',$data->suspect)->value('name'); ?>  
                  
              </div>
          </div>
      
          <div class  = "col-md-3">
              <div class="form-group">
              <label>Location&nbsp;</label><br>
                      {{ $data->location }} 
              </div>
          </div>
          </div>
      <div class="row">
                      
          <div class="col-sm-12">
                  <div class="form-group">
                      <label>Probable Cause:&nbsp;</label>
                      {!! $data->pcause !!} 
                  </div>
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
                    <select class="form-control select2" Name="commissionStatus">
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
                      <textarea  type="text" class="form-control" name="commissionReview" placeholder="Please Enter Remarks" ></textarea>
                  </div>
                </div>

               

              

          


<script>

 function closearrestupdatecomission()
 {
      $("#viewarrestdetailsforupdate").hide();
      $('#addarrest').hide();
      $('#arrestanddetentionshow').show();
      $('#addarrestanddetentionbutt').hide();
 }

</script>

