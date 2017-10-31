
        
 <div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget no-margin">
                    <div class="widget-header">
                        <div class="title">
                            Matric Annual 2017 Zone  <a data-original-title="" id="notifications"></a>
                        </div>
                        
                    </div>
                     <div class="widget-body">
                     <img src="assets/img/rezone_instruction.jpg" style="height:150px;margin-left: 30%;">
                        <hr>
                        <div class="control-group">
                            <h4 class="span4" style="margin-left: 30px;">Exam Proposed Center Information :</h4>
                            <div class="controls controls-row">
                                <label class="control-label span2">

                                </label> 

                            </div>
                        </div>
                         <form class="form-horizontal no-margin" action="<?php  echo base_url(); ?>Admission_matric/updatezone" method="post" enctype="multipart/form-data" name="myform" id="myform">
                        <input type="hidden" id='gend' value="<?= $gender?>">
                        <div class="controls controls-row">
                        <label class="control-label span1" >
                                District :
                            </label>
                                <select class='span3' id='pvtinfo_distr' name='pvtinfo_dist' required='required'>
                                    <option value='0'>SELECT DISTRICT</option>
                                    <option value='1'>GUJRANWALA</option>
                                    <option value='2'>GUJRAT</option>
                                    <option value='3'>HAFIZABAD</option>
                                    <option value='4'>MANDI BAHA-UD-DIN</option>
                                    <option value='5'>NAROWAL</option>
                                    <option value='6'>SIALKOT</option>
                                </select>
                                <label class="control-label span2" >
                                    Tehsil:
                                </label> 
                                <select class='span3' id='pvtinfo_tehr' name='pvtinfo_teh' required='required'>
                                    <option value='0'>SELECT TEHSIL</option>

                                </select>
                            </div>
                       

                        <div class="controls controls-row">
                            <label class="control-label span1" >
                                Zone :
                            </label>
                            <select id="pvtZoner"  class="span3" name="pvtZone">
                                <option value='0'>SELECT ZONE</option>

                            </select>

                        </div>

<div id="instruction" style="display:none;"></div>
                        <div class="form-actions no-margin">
                            <button type="submit" onclick="return examchecks()" name="btnsubmitUpdateEnrol" class="btn btn-large btn-info offset2" >
                                Update Infromation
                            </button>

                            <div class="clearfix"></div>
                        </div>
                        <script src="<?php echo base_url(); ?>assets/js_matric/jquery-1.8.3.js"></script>

                        </form>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>
</div> 
</div>
