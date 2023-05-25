@foreach($interviewplans as $intplans)
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label>Interviewee </label><br>
                <input type="hidden" name="interplanid" id="interplanid" value="{{ $intplans->id }}">
                    <?php echo $key=DB::table('tbl_case_entities')->where('identification_no',$intplans->accused)->where('case_no_id',$casenoid)->value('name'); ?>
            </div>                          
            
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Date of Interview&nbsp;</label><br>
                      {{ \Carbon\Carbon::parse($intplans->interview_date)->format('d/m/Y')}}   
            </div>
        </div>
    
        <div class="col-sm-4">
            <div class="form-group">
                <label>Interviewer </label><br>
                                                  
            </div>
        </div>
        
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label>Location&nbsp;</label><br>
                       {{ $intplans->location}}  
            </div>
        </div>
    
        <div class="col-sm-4">
            <div class="form-group">
                <label>Defences&nbsp;</label><br>
                {{ $intplans->defences}}
            </div>
        </div> 
        <div class="col-sm-4">
            <div class="form-group">
                <label>Facts Already Established&nbsp;</label><br>
                {{ $intplans->facts_established}}
            </div>
        </div>
    </div>
     
@endforeach

<style>
    .hrnew {
        border: none;
        border-top: 2px dotted #ccc;
        height: 15px;
        margin: 10px 0;
    }
</style>