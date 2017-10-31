<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title">
                            Admission Form
                        </div>
                    </div>
                    <div class="widget-body">

                        <form enctype="multipart/form-data" class="form-horizontal no-margin" method="post">
                            <div class="control-group">
                                <h4 class="span4">Personal Information:</h4>
                                <div class="controls controls-row">
                                    <input type="hidden" class="span2 hidden" id="isReAdm" name="isReAdm" value="0">
                                    <label class="control-label span2">
                                    </label> 
                                    <img id="previewImg" name="image" style="width:80px; height: 80px;" class="span2" src="<?php echo base_url();?>assets/img/profile.png" alt="Candidate Image">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label hidden span2" for="cand_name">
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3 hidden" id="father_name" type="text" placeholder="Father's Name">  
                                    <label class="control-label span2" for="father_name">
                                        Image :  <span style="color:red">*</span>
                                    </label> 
                                    <input type="file" class="span4" id="image" name="image" required="required" onchange="Checkfiles()">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span2" for="name">
                                    Candidate Name<span style="color:red">*</span>
                                </label>
                                <div class="controls controls-row">
                                    <div><input class="span3" type="text" id="name" name="name" required="required" placeholder="Candidate Name" value="<?php echo @$data["name"];?>" readonly></div>
                                    <label class="control-label span2" for="fName">
                                        Father's Name :<span style="color:red">*</span>
                                    </label> 
                                    <div><input style="margin-left:42px" class="span3" id="fName" name="fName" required="required" type="text" value="<?php echo @$data["fName"];?>" placeholder="Father's Name" readonly></div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span2" for="bForm">
                                    Bay Form No :<span style="color:red">*</span>
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" name="bForm" id="bForm" required="required" placeholder="Bay Form No." value="<?php echo $data["bForm"];?>">
                                    <label class="control-label span2" for="fNic">
                                        Father's CNIC :<span style="color:red">*</span>
                                    </label> 
                                    <input class="span3" id="fNic" name="fNic" type="text" required="required" placeholder="34101-1111111-1" value="<?php echo @$data["fNic"];?>" readonly>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span2" for="dob">
                                    Date of Birth:(dd-mm-yyyy)<span style="color:red">*</span>
                                </label>

                                <div class="controls controls-row">
                                    <input class="span3" type="text" required="required" id="dob" name="dob" placeholder="Date of Birth"  value="<?php echo @$data["dob"];?>" readonly>
                                    <label class="control-label span2" for="MobNo">
                                        Mobile Number :<span style="color:red">*</span>
                                    </label> 
                                    <input class="span3" id="MobNo" name="MobNo" required="required" type="text" placeholder="0300-1234567" value="<?php echo @$data["MobNo"];?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span2" for="med">
                                    MEDIUM:<span style="color:red">*</span>
                                </label>
                                <div class="controls controls-row">
                                    <select id="med" class="dropdown span3" name="med">
										<option value="1" <?php if($data["med"]==1) echo "selected";?>>Urdu</option>
										<option value="2" <?php if($data["med"]==1) echo "selected";?>>English</option>
                                    </select>
                                    <label class="control-label span2" for="speciality">
                                        Speciality:<span style="color:red">*</span>
                                    </label> 
                                    <select id="speciality"  class="span3" name="speciality">
                                        <option value="0">None</option>
                                        <option value="1">Deaf &amp; Dumb</option>
                                        <option value="2">Board Employee</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span2" for="schGrade">
                                    College Grade:<span style="color:red">*</span>
                                </label>
                                <div class="controls controls-row">
                                    <select id="schGrade"  class="span3" name="schGrade">
									  <option>A+</option> <option>A</option>
									  <option>B+</option> <option>B</option>
									  <option>C</option> <option>D</option>
									  <option>E</option> <option>F</option>
									</select>
									<label class="control-label span2" for="classRno">
										Class Roll No :<span style="color:red">*</span>
									</label> 
									<input class="span3" id="classRno" name="classRno" type="text" placeholder="" >
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span2" for="markOfIden">
                                    Mark Of Identification :<span style="color:red">*</span>
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" name="markOfIden" id="markOfIden" required="required">
                                    <label class="control-label span2" for="gender1">
                                        Gender :<span style="color:red">*</span>
                                    </label> 
                                    <label class="radio inline span1">
                                        <input type="radio" id="gender1" value="1" checked="checked" name="sex"> Male
                                    </label> 
                                    <label class="radio inline span2">
                                        <input type="radio" id="gender2" value="2" disabled="disabled" name="sex"> Female 
                                    </label> 
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span2" for="nat">
                                    Nationality :<span style="color:red">*</span>
                                </label>
                                <div class="controls controls-row">  
                                    <label class="radio inline span1">
                                        <input type="radio" value="1" id="nat1" checked="checked" name="nat"> Pakistani
                                    </label>
                                    <label class="radio inline span2">
                                        <input type="radio"  id="nat2" value="2" name="nat">  Non Pakistani 
                                    </label>
                                    <label class="control-label span2" for="rel">
                                        Religion :<span style="color:red">*</span>
                                    </label> 
                                    <label class="radio inline span1">
                                        <input type="radio" id="rel1" class="rel_class" value="1" checked="checked" name="rel"> Muslim
                                    </label>
                                    <label class="radio inline span2">
                                        <input type="radio" id="rel2" class="rel_class" value="2" name="rel"> Non Muslim
                                    </label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span2" for="isHafiz">
                                    Hafiz-e-Quran :<span style="color:red">*</span>
                                </label>
                                <div class="controls controls-row">
                                    <label class="radio inline span1">
                                        <input type="radio" id="isHafiz1" value="0" checked="checked" name="isHafiz"> No
                                    </label>
                                    <label class="radio inline span2">
                                        <input type="radio" id="isHafiz2" value="1" name="isHafiz"> Yes
                                    </label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span2" for="addr">
                                    Address :<span style="color:red">*</span>
                                </label>
                                <div class="controls controls-row">
                                    <textarea style="height:150px;" id="addr" class="span8" name="addr" required="required"></textarea>
                                </div>
                            </div>
                            <hr />
							<div class="control-group">
                                <h4 class="span4">Exam Information :</h4>
                                <div class="controls controls-row">
                                    <input type="hidden" class="span2 hidden" id="isReAdm" name="isReAdm" value="0">
                                    <label class="control-label span2" for="exam_info">
                                    </label> 
                                </div>
                            </div>
                               <div class="control-group">
                                <label class="control-label span2" for="grp_cd">
                                    Study Group :
                                </label>
                                <div class="controls controls-row">
                                <select id="grp_cd" class="dropdown span4"  name="grp_cd" readonly>
									<option value="1" <?php if($data["grp_cd"]== 1) echo "Selected"; else echo ""; ?>>SCIENCE WITH BIOLOGY</option>
									<option value="7" <?php if($data["grp_cd"]== 7) echo "Selected"; else echo ""; ?>>SCIENCE WITH COMPUTER SCIENCE</option>
									<option value="8" <?php if($data["grp_cd"]== 8) echo "Selected"; else echo ""; ?>>SCIENCE WITH ELECTRICAL WIRING(OPT)</option>
									<option value="2" <?php if($data["grp_cd"]== 2) echo "Selected"; else echo ""; ?>>HUMANTIES</option>
									<option value="5" <?php if($data["grp_cd"]== 5) echo "Selected"; else echo ""; ?>>DEAF AND DUMB</option>
								</select>                                            
                                    
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span4" for="cat">
                                 <b>Choose Subjects(Elective Subjects are Enabled Only)</b>   
                                </label>
                                <div class="controls controls-row">
                                    <label class="control-label span8" >
										<strong>Category P-1: <?php if ($data["cat09"]==1){echo "FRESH"; } else if ($data["cat09"]==2){echo "RE-APPEAR"; } else if ($data["cat09"]==3) {echo "MARKS IMPROVEMENT"; }else if ($data["cat09"]==14){echo "ADDITIONAL"; }?> </strong>
										<strong>Category P-2: <?php if ($data["cat10"]==1 or $data["exam_type"]==5){echo "FRESH"; } else if ($data["cat10"]==2){echo "RE-APPEAR"; } else if ($data["cat10"]==3) {echo "MARKS IMPROVEMENT"; }else if ($data["cat10"]==14){echo "ADDITIONAL"; }?></strong>
                                    </label> 
                                </div>
                            </div>
							<?php echo $subjects;?>
								<input type="hidden" name="class" value="<?php echo @$data["class"];?>" />
								<input type="hidden" name="iYear" value="<?php echo @$data["iYear"];?>" />
								<input type="hidden" name="sess" value="<?php echo @$data["sess"];?>" />
								<input type="hidden" name="regNo" value="<?php echo @$data["regNo"];?>" />
								<input type="hidden" name="strRegNo" value="<?php echo @$data["strRegNo"];?>" />
								<input type="hidden" name="schm" value="<?php echo @$data["schm"];?>" />
								<input type="hidden" name="oldRno" value="<?php echo @$data["oldRno"];?>" />
								<input type="hidden" name="oldYear" value="<?php echo @$data["oldYear"];?>" />
								<input type="hidden" name="oldSess" value="<?php echo @$data["oldSess"];?>" />
								<input type="hidden" name="rel" value="<?php echo @$data["rel"];?>" />
								<input type="hidden" name="regPvt" value="<?php echo @$data["regPvt"];?>" />
								<input type="hidden" name="ruralOrUrban" value="<?php echo @$data["ruralOrUrban"];?>" />
								<input type="hidden" name="dist_cd" value="<?php echo @$data["dist_cd"];?>" />
								<input type="hidden" name="teh_cd" value="<?php echo @$data["teh_cd"];?>" />
								<input type="hidden" name="cat09" value="<?php echo @$data["cat09"];?>" />
								<input type="hidden" name="cat10" value="<?php echo @$data["cat10"];?>" />
								<input type="hidden" name="exam_type" value="<?php echo $data["exam_type"];?>">
								<input type="hidden" name="feeFlag" value="<?php echo $data["feeFlag"];?>">
								<input type="hidden" name="zone_cd" value="<?php echo $data["zone_cd"];?>">
							<div class="form-actions no-margin">
                                <button type="submit" name="save" class="btn btn-large btn-info offset2" onclick="return validateForm();">
                                    Save
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