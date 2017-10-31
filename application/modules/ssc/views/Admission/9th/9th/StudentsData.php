<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title">
                            Event registration for<a id="redgForm" data-original-title="">m</a>
                        </div>
                        <span class="tools">
                            <a class="fs1" aria-hidden="true" data-icon="" data-original-title=""></a>
                        </span>
                    </div>
                    <div class="widget-body">

                        <form class="form-horizontal no-margin" action="<?php echo base_url(); ?>/index.php/Registration/NewEnrolment" method="post">

                            <div class="control-group">
                                <h4 class="span4">Personal Information :</h4>
                                <div class="controls controls-row">
                                    <input type="hidden" class="span2 hidden" id="isReAdm" name="isReAdm" value="0">
                                    <label class="control-label span2" >

                                    </label> 
                                    <img id="previewImg" style="width:80px; height: 80px;" class="span2" src="<?php echo base_url(); ?>assets/img/profile.png" alt="Candidate Image">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label hidden span1" >
                                    Father's Name :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3 hidden"  type="text" placeholder="Father's Name">  
                                    <label class="control-label span2">
                                        Image :  
                                    </label> 
                                    <input type="file" class="span4" id="image" name="image" onchange="Checkfiles()" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Candidate Name :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="cand_name" name="cand_name" placeholder="Candidate Name" required>
                                    <label class="control-label span2" for="lblfather_name">
                                        Father's Name :
                                    </label> 
                                    <input class="span3" id="father_name" name="father_name" type="text" placeholder="Father's Name" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Bay Form No :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="bay_form" name="bay_form" placeholder="Bay Form No." required>
                                    <label class="control-label span2" for="father_cnic">
                                        Father's CNIC :
                                    </label> 
                                    <input class="span3" type="text" id="father_cnic" name="father_cnic" placeholder="34101-1111111-1" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Date of Birth:(dd-mm-yyyy)
                                </label>

                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="dob" name="dob" placeholder="DOB" required>
                                    <label class="control-label span2" >
                                        Mobile Number :
                                    </label> 
                                    <input class="span3" id="mob_number" name="mob_number" type="text" placeholder="0300-1234567" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    MEDIUM:
                                </label>
                                <div class="controls controls-row">
                                    <select id="medium" class="dropdown span3" name="medium">
                                        <option value="1" selected="selected">Urdu</option>
                                        <option value="2">English</option>
                                    </select>
                                    <label class="control-label span2" >
                                        Class Roll No :
                                    </label> 
                                    <input class="span3" id="Inst_Rno" type="text" name="Inst_Rno" placeholder="" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Mark Of Identification :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="MarkOfIden" name="MarkOfIden" >
                                    <label class="control-label span2" >
                                        Speciality:
                                    </label> 
                                    <select id="speciality"  class="span3" name="speciality">
                                        <option value="0">None</option>
                                        <option value="1">Deaf &amp; Dumb</option>
                                        <option value="2">Board Employee</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Nationality :
                                </label>
                                <div class="controls controls-row">  
                                    <label class="radio inline span1">
                                        <input type="radio" value="1" id="nationality" checked="checked" name="nationality"> Pakistani
                                    </label>
                                    <label class="radio inline span2">
                                        <input type="radio"  id="nationality1" value="2" name="nationality">  Non Pakistani 
                                    </label>
                                    <label class="control-label span2" for="gender1">
                                        Gender :
                                    </label> 
                                    <label class="radio inline span1">
                                        <input type="radio" id="gender1" value="1" checked="checked" name="gender"> Male
                                    </label> 
                                    <label class="radio inline span1">
                                        <input type="radio" id="gender2" value="2" disabled="disabled" name="gender"> Female 
                                    </label> 
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Hafiz-e-Quran :
                                </label>
                                <div class="controls controls-row">
                                    <label class="radio inline span1">
                                        <input type="radio" id="hafiz1" value="0" checked="checked" name="hafiz"> No
                                    </label>
                                    <label class="radio inline span1">
                                        <input type="radio" id="hafiz2" value="1" name="hafiz"> Yes
                                    </label>
                                    <label class="control-label span3" >
                                        Religion :
                                    </label> 
                                    <label class="radio inline span1">
                                        <input type="radio" id="religion" class="rel_class" value="1" checked="checked" name="religion"> Muslim
                                    </label>
                                    <label class="radio inline span1">
                                        <input type="radio" id="religion1" class="rel_class" value="2" name="religion"> Non Muslim
                                    </label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Address :
                                </label>
                                <div class="controls controls-row">
                                    <textarea style="height:150px;" id="address" class="span8" name="address" required></textarea>
                                </div>
                            </div>
                               <hr>
                                        <div class="control-group">
                                <h4 class="span4">Exam Information :</h4>
                                <div class="controls controls-row">
                                    <input type="hidden" class="span2 hidden" id="isReAdm" name="isReAdm" value="0">
                                    <label class="control-label span2">

                                    </label> 
                                    
                                </div>
                            </div>
                               <div class="control-group">
                                <label class="control-label span1" >
                                    Study Group :
                                </label>
                                <div class="controls controls-row">
                                <select id="std_group" class="dropdown span6"  name="std_group">
                            <option value="1">SCIENCE WITH BIOLOGY</option>
                            <option value="7">SCIENCE  WITH COMPUTER SCIENCE</option>
							<option value="2">HUMANTIES</option>
                            <option value="5">DEAF AND DUMB</option>
                       </select>                                            
                                    
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span3" >
                                 <b>Choose Subjects(Elective Subjects are Enabled Only)</b>   
                                </label>
                                <div class="controls controls-row">
                                    <label class="control-label span8" >
                                    </label> 
                                </div>
                            </div>
                                  <div class="control-group">
                                <label class="control-label span1" >
                                    
                                </label>
                                <div class="controls controls-row">
                                    <select id="sub1" class="span3 dropdown" name="sub1"><option value="1">Urdu</option></select> 
                                    <select id="sub2"  name="sub2" class="span3 dropdown">
                                            <option value="2">English</option></select>
                                </div>
                            </div>
                                    <div class="control-group">
                                <label class="control-label span1" >
                                    
                                </label>
                                <div class="controls controls-row">
                                    <select id="sub3" class="span3 dropdown" name="sub3"><option value="1">Islamyat Compulsory</option></select> 
                                    <select id="sub4"  name="sub4" class="span3 dropdown">
                                            <option value="2">Pakistan Studies</option></select>
                                </div>
                            </div>    <div class="control-group">
                                <label class="control-label span1" >
                                    
                                </label>
                                <div class="controls controls-row">
                                    <select id="sub5" class="span3 dropdown" name="sub5"></select> 
                                    <select id="sub6"  name="sub6" class="span3 dropdown">
                                            </select>
                                </div>
                            </div>    <div class="control-group">
                                <label class="control-label span1" >
                                    
                                </label>
                                <div class="controls controls-row">
                                    <select id="sub7" class="span3 dropdown" name="sub7"></select> 
                                    <select id="sub8"  name="sub8" class="span3 dropdown">
                                            </select>
                                </div>
                            </div>
                        
                            <div class="form-actions no-margin">
                                <button type="submit" name="save" class="btn btn-large btn-info offset2">
                                    Create Account
                                </button>
                                <input type="button" class="btn btn-large btn-danger" value="Cancel" onclick="window.location='index.php';" >
                                <div class="clearfix">
                                </div>
                            </div>

                        </form>


                    </div>  

                </div>
            </div>
        </div>
    </div>
</div>
