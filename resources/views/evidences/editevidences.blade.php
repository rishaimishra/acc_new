 @foreach ($evidences as $evid)
                           
 <div class="row">
                            <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Evidence Category&nbsp;</label>
                                       
                                        <select class  = "form-control" name="evidencecat" id="evidencecat" >
                                                    <option value="{{ $evid->evidence_category }}">{{ $evid->evidence_category }}</option>
                                                    <option value   = "Statement">Statement</option>
                                                    <option value   = "Agreement">Agreement</option>
                                                    <option value   = "Emails">Emails</option>
                                                    <option value   = "Document">Document</option>
                                                    <option value   = "Audio Visual">Audio Visual</option>
                                                    <option value   = "Photos">Photos</option>
                                                    <option value   = "Digital Content">Digital Content</option>
                                                    <option value   = "Properties">Properties</option>
                                                    <option value   = "Expert Opinion">Expert Opinion</option>
                                                   
                                        </select>
                                    </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Evidence Name&nbsp;</label>
                                    <input type="text" name="evidencename"  class="form-control" id="evidencename" value="{{ $evid->evidence_name }}">
                                    
                                </div>
                                
                            </div>
                        </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Source&nbsp;</label>
                                        
                                        <select class  = "form-control" name="evidsource" id="evidsource" >
                                                    <option value="{{ $evid->collected_from }}">{{ $evid->collected_from }}</option>
                                                    <option value   = "Source 1">Source 1</option>
                                                    <option value   = "Source 2">Source 2</option>
                                                    <option value   = "Source 3">Source 3</option>
                                                   
                                                   
                                        </select>
                                    </div>
                                </div>
                            </div>     
                            <div class="row">
                               
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Evidence Description&nbsp;</label>
                                        <input type="text" name="evidescription"  class="form-control" id="evidescription" value="{{ $evid->evidence_description }}">
                                        
                                    </div>
                                    
                                </div>
                                
                                
  
                            </div>  
                            
                        
@endforeach