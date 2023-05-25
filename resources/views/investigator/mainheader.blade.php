<br>
 
<link rel ="stylesheet" href="https://fonts.googleapis.com/css2?family=Product+Sans&display=swap" >
<section class="content">
    @foreach ($casesdtls as $casedetails)
    <div id="accordion" style="margin-top:-40px;">
        <div class="card">
            <div class="card-header custom-header" id="headingOne">
                <h5 class="mb-0">
                    &nbsp; &nbsp; 
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <font color='grey' size="4" face="Product Sans"><i class="fa fa-briefcase"></i> </font> &nbsp;
                            <font color='#000000' size="5.5" face="Product Sans">  {{ $caseno }} </font>
                    </button>
                    
                   
                    &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; 
                    &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
                    &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
                    &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
                     &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; 

                    <font color='#007BFF' size="2" face="'Product Sans'">Run Days: </font>
                    <font color='grey' size="2" face="'Product Sans'"> {{ date_diff(new \DateTime($casedetails->assignment_order_date), new \DateTime())->format("%d"); }}</font>
                    &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; 
                    <font color='#007BFF' size="2" face="'Product Sans'">Work Days: </font>
                    <font color='red' size="2" face="'Product Sans'"> {{ date_diff(new \DateTime($casedetails->assignment_order_date), new \DateTime())->format("%d"); }}</font>
                    <button class="btn" style="float:right" data-toggle="collapse" data-target="#collapseOne" aria-controls="collapseOne">
                            <i class="fa fa-angle-up" id="showarrowupbutton" onclick="showarrowdown()"></i>
                            <i style="display:none" id="showarrowdownbutton" class="fa fa-angle-down" onclick="showarrowup()"></i>
                    </button>
                </h5>
            </div>

               
        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                <!-- Content Start-->
            
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="hidden" id="maincaseno" name="maincaseno" value="{{ $caseno }}">
                                <p style="margin-top:-8px">
                                <font color='#007BFF' size="2" face="'Product Sans'">Case Title: </font></p>
                                &nbsp; 
                                 <p style="margin-top:-45px">
                                <font color='grey' size="3" face="'Product Sans'">  {{ $casedetails->case_title }}</font></p>
                                 
                                <p style="margin-top:-8px">
                                <font color='#007BFF' size="2" face="'Product Sans'">Date Assigned: </font></p>
                                &nbsp; 
                                 <p style="margin-top:-45px">
                                <font color='grey' size="3" face="'Product Sans'">  {{ \Carbon\Carbon::parse($casedetails->assignment_order_date)->format('d/m/Y')}}</font></p>

                                <p style="margin-top:-8px">
                                <font color='#007BFF' size="2" face="'Product Sans'">Intake Source: </font></p>
                                &nbsp; 
                                 <p style="margin-top:-45px">
                                <font color='grey' size="3" face="'Product Sans'"> Complaint</font></p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <p style="margin-top:-8px">
                                <font color='#007BFF' size="2" face="'Product Sans'">Team Leader: </font></p>
                            &nbsp; 
                            <p style="margin-top:-45px">
                                <font color='grey' size="3" face="'Product Sans'">  Dorji</font></p>
                            
                            <p style="margin-top:-8px">
                                <font color='#007BFF' size="2" face="'Product Sans'">Team Members: </font></p>
                            &nbsp; 
                            <p style="margin-top:-45px">
                                <font color='grey' size="3" face="'Product Sans'"> Pema, Anju</font></p>

                             <p style="margin-top:-8px">
                                <font color='#007BFF' size="2" face="'Product Sans'">Legal Rep: </font></p>
                            &nbsp; 
                            <p style="margin-top:-45px">
                                <font color='grey' size="3" face="'Product Sans'">Sangay</font></p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <p style="margin-top:-8px">
                                <font color='#007BFF' size="2" face="'Product Sans'">Sector: </font></p>
                                &nbsp; 
                            <p style="margin-top:-45px">
                                <font color='grey' size="3" face="'Product Sans'">  {{ $casedetails->sector }}</font></p>
                                                       
                            <p style="margin-top:-8px">
                                <font color='#007BFF' size="2" face="'Product Sans'">Sub Sector: </font></p>
                            &nbsp; 
                            <p style="margin-top:-45px">
                                <font color='grey' size="3" face="'Product Sans'"> {{ $casedetails->sector_type }}</font></p>

                             <p style="margin-top:-8px">
                                <font color='#007BFF' size="2" face="'Product Sans'">Institution Type: </font></p>
                            &nbsp; 
                            <p style="margin-top:-45px">
                                <font color='grey' size="3" face="'Product Sans'">{{ $casedetails->institution_type }}</font></p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <p style="margin-top:-8px">
                                <font color='#007BFF' size="2" face="'Product Sans'">Expected Closure Date: </font></p>
                            &nbsp; 
                            <p style="margin-top:-45px">
                                <font color='grey' size="3" face="'Product Sans'">  {{ \Carbon\Carbon::parse($casedetails->assignment_order_date)->format('d/m/Y')}}</font></p>
                           
                            <p style="margin-top:-8px">
                                <font color='#007BFF' size="2" face="'Product Sans'">Investigation Status: </font></p>
                            &nbsp; 
                            <p style="margin-top:-45px">
                                <font color='grey' size="3" face="'Product Sans'">Open</font>
                                &nbsp;
                            @if(Auth::user()->role == "Chief")
                                 <font color='black' size="3"><i class="fa fa-edit" onmouseover="this.style.color='#333333';" onmouseout="this.style.color='black';"  data-toggle="tooltip" data-placement="bottom" title="Edit"></i></font>
                            @endif
                            </p>

                             <p style="margin-top:-8px">
                                <font color='#007BFF' size="2" face="'Product Sans'">Sub Status: </font></p>
                            &nbsp; 
                            <p style="margin-top:-45px">
                                <font color='grey' size="3" face="'Product Sans'">Active</font>
                            &nbsp;
                                 @if(Auth::user()->role == "Investigator")
                                 <font color='black' size="3"><i class="fa fa-edit" onmouseover="this.style.color='#333333';" onmouseout="this.style.color='black';"  data-toggle="tooltip" data-placement="bottom" title="Edit"></i></font>
                                 </p>
                            @endif
                        </div>
                    </div>

                </div>
             
                <!-- Content End-->
            </div>
        </div>
    </div>
    @endforeach

<style>
   
.custom-header {
  height: 43px;
  padding: 5px;
}

.custom-header h5 {
  margin-bottom: 0;
}

.custom-header button {
  font-size: 0.8rem;
  padding: 0;
}

.content {
  margin-top: -1px;
}
</style>
<script>

    function showarrowdown()
    {
        $('#showarrowupbutton').hide();
        $('#showarrowdownbutton').show();
    }
     function showarrowup()
    {
        $('#showarrowupbutton').show();
        $('#showarrowdownbutton').hide();
    }

    
   
</script>