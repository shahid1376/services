<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget no-margin">
                    <div class="widget-header">
                        <div class="title">
                            Form Printing 9th Registration<a data-original-title="" id="notifications">s</a>
                        </div>
                                           </div>
                    <div class="widget-body">
                        <div class="control-group">
                            <h4 class="title">
                                Reports:
                            </h4>
                        </div>
                        <hr>
                        <div class="control-group">
                            <label class="control-label">
                                <b> Please Select the option and Provide input for Report:</b>
                            </label>
                        </div>
                        <div class="control-group">
                            <label class="control-label span1">
                                Select Option:
                            </label>
                            <div class="controls controls-row">
                                <label class="radio inline span1">
                                    <input type="radio" name="opt" checked="checked" value="1">Group Wise <br>
                                </label>
                                <label class="radio inline span2">
                                    <input type="radio" name="opt"  value="2">Form No. Wise
                                </label>
                            </div>
                        </div>
                        <div class="control-group" id="grp_selected">
                            <label class="control-label span1">
                                Select Group:
                            </label>
                            <div class="controls controls-row">
                                <select id="std_group"   class="dropdown span3"  name="std_group">
                            <?php        
									$subgroups =  split(',',$grp_cd);
                            echo "<option value='0' >SELECT GROUP</option>";
                            for($i =0 ; $i<count($subgroups); $i++)
                            {
                                if($subgroups[$i] == 1)
                                {
                                   
                                        echo "<option value='1' >SCIENCE WITH BIOLOGY</option>";    
                                }
                                else if($subgroups[$i] == 7)
                                {
                                   
                                        echo "<option value='7'>SCIENCE  WITH COMPUTER SCIENCE</option>"; 

                                }
                                else if($subgroups[$i] == 8)
                                {
                                    
                                        echo "<option value='8'>SCIENCE  WITH ELECTRICAL WIRING</option>";  
                                    
                                }
                                else if($subgroups[$i] == 2)
                                {
                                   
                                        echo "<option value='2'>GENERAL</option>";   
                                    

                                }
                                else if($subgroups[$i] == 5)
                                {
                                   
                                        echo "<option value='5'>DEAF AND DUMB</option>";  
                                    

                                }
                            }
                            
                            echo "</select>" ?>
									
									
									
                            </div>
                        </div>
                        <div style="display: none;" id="formnowise_selected" >
                        <div class="control-group" >
                        <div class="controls controls-row">
                        <label class="control-label span1">Starting Form No.</label>
                        <input type="text" id="strt_formNo"> 
                        </div>
                        </div>
                         <div class="control-group" >
                        <div class="controls controls-row">
                        <label class="control-label span1">Ending Form No.</label>
                        <input type="text" id="ending_formNo"> 
                        </div>
                        </div>
                        </div>
                      </div>
                        <div class="control-group">
                            <div class="controls controls-row">
                                <input type="submit" name="get_report" id="get_report"class="btn btn-large btn-info" value="Final Print of Return">
                                <input type="submit" name="get_Proof" class="btn btn-large btn-info " id="get_Proof" value="Get Proof Print of Return">
                                <input type="submit" name="get_Proof_reg" id="get_Proof_reg" class="btn btn-large btn-info "  value="Get Proof Print Registration From">
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls control-group">
                                <label class="control-label label label-important" style="font-size: large;"> 
                                    Instructions: 1-Please Use A-4 Size (80 gram) Paper to Print All Documents/Reports.
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

