<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title">
                            Matric Private  Admission Form  For Existing Candidates.
                        </div>
                    </div>
                    <div class="widget-body">

                        <form class="form-horizontal no-margin" action="<?php  echo base_url(); ?>Admission/NewEnrolment_insert" method="post" enctype="multipart/form-data" name="myform" id="myform">
                            <div class="control-group">
                                <h4 class="span4">Personal Information :</h4>
                                <div class="controls controls-row">
                                    <!--   <label class="control-label span4">
                                    <img id="image_upload_preview" style="width:140px; height: 140px;" alt="Candidate Image" />
                                    </label> 
                                    <label class="control-label span1" >
                                    <input type='file' id="inputFile" onchange="return ValidateFileUpload(this);"/>
                                    </label>echo GET_PRIVATE_IMAGE_PATH. $data[0]['picpath']; -->
                                    <?php 
                                    $type = pathinfo(DIRPATH.@$data[0]['picpath'], PATHINFO_EXTENSION); 
                                    @$image_path_selected = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents(DIRPATH.@$data[0]['picpath']));
                                    ?>
                                    <img id="image_upload_preview" style="width:140px; height: 140px;" src="<?php  echo $image_path_selected;?>" alt="Candidate Image" />
                                    <input type="hidden" value="<?=  $data[0]['picpath']?>" name="pic">
                                    <input type="hidden" value="0" id="isotherbrd" name="isotherbrd" />
                                    <input type="hidden" value="0" id="isFresh" name="isFresh" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label id="ErrMsg" class="control-label span2" style=" text-align: left;"><?php ?></label>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Candidate Name:
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3"  type="text" id="cand_name" style="text-transform: uppercase;" name="cand_name" placeholder="Candidate Name" maxlength="60" readonly="readonly"  value="<?php echo $data[0]['name']; ?>">
                                    <label class="control-label span2" for="lblfather_name">
                                        Father's Name :
                                    </label> 
                                    <input class="span3" id="father_name" name="father_name" style="text-transform: uppercase;" type="text" placeholder="Father's Name" maxlength="60" readonly="readonly" value="<?php echo  $data['0']['Fname']; ?>" required="required">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Bay Form No :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="bay_form" name="bay_form" maxlength="15" placeholder="Bay Form No." value="<?php echo $data['0']['BForm'];?>" <?php if( $data['0']['BForm']!="00000-0000000-0") echo "readonly='readonly'";  ?>  required="required" >
                                    <label class="control-label span2" for="father_cnic">
                                        Father's CNIC :
                                    </label> 
                                    <input class="span3" id="father_cnic" name="father_cnic" type="text" placeholder="34101-1111111-1"  value="<?php echo  $data['0']['FNIC'];?>" <?php if( $data['0']['FNIC'] != "00000-0000000-0") echo "readonly='readonly'";  ?>  required="required" >
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Date of Birth:
                                </label>

                                <div class="controls controls-row">
                                    <input class="span3" type="text" name="dob" placeholder="Date of Birth" readonly="readonly"  value="<?php echo $data['0']['Dob']?>" required = "required">
                                    <label class="control-label span2" >
                                        Mobile Number :
                                    </label> 
                                    <input class="span3" id="mob_number" name="mob_number" type="text" placeholder="0300-123456789" value="<?php echo  $data['0']['MobNo']; ?> " required="required">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    MEDIUM:
                                </label>
                                <div class="controls controls-row">
                                    <select id="medium" class="dropdown span3" name="medium">
                                        <?php
                                        $med = $data['0']['med'] ;
                                        // $med = 2; 
                                        if($med == 1)
                                        {
                                            echo  "<option value='1' selected='selected'>Urdu</option> <option value='1'>English</option>";
                                        }
                                        else
                                        {
                                            echo  "<option value='2' >Urdu</option> <option value='2' selected='selected'>English</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Mark of Identification :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="MarkOfIden" style="text-transform: uppercase;" name="MarkOfIden" value="<?php echo  $data['0']['markOfIden']; ?>" required="required" maxlength="60" >
                                    <label class="control-label span2" >
                                        Speciality:
                                    </label> 
                                    <select id="speciality"  class="span3" name="speciality">
                                        <?php
                                        echo  "<option value='0' selected='selected'>None</option> 
                                        <option value='1'>Deaf &amp; Dumb</option>
                                        <option value='2'>Board Employee</option>;
                                        <option value='3'>Blind</option>";
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!--<div class="control-group">
                            <label class="control-label span1" >
                            Nationality :
                            </label>
                            <div class="controls controls-row">  
                            <?php
                            $nat = $data[0]['nat'];
                            if($nat == 1)
                            {
                                echo  " <label class='radio inline span1'><input type='radio' value='1' id='nationality' checked='checked' name='nationality'> Pakistani
                                </label><label class='radio inline span2'><input type='radio'  id='nationality1' value='2' name='nationality'>  Non Pakistani</label>" ;
                            }
                            else if ($nat == 2)
                            {
                                echo  "<label class='radio inline span1'><input type='radio' value='1' id='nationality'  name='nationality'> Pakistani
                                </label><label class='radio inline span2'><input type='radio'  id='nationality1' checked='checked' value='2' name='nationality'>  Non Pakistani</label>" ;
                            }
                            ?>
                            <label class="control-label span2" for="gender1">
                            Gender :
                            </label> 
                            <?php
                            //DebugBreak();
                            $gender = $data[0]['sex'];
                            if($gender == 1)
                            {
                                echo " <label class='radio inline span1'><input type='radio' id='gender1' value='1' checked='checked'  disabled='disabled' name='gender'> Male</label> 
                                <label class='radio inline span1'><input type='radio' id='gender2' value='2'  name='gender'  disabled='disabled'> Female </label> " ;
                            }
                            else if ($gender == 2)
                            {
                                echo " <label class='radio inline span1'><input type='radio' id='gender1' value='1'  disabled='disabled' name='gender'> Male</label> 
                                <label class='radio inline span1'><input type='radio' id='gender2' value='2'  checked='checked'  disabled='disabled'  name='gender'> Female </label> " ;
                            }
                            ?>
                            <input type="hidden" name="gend" id="gend" value="<?php echo $gender; ?>">
                            </div>
                            </div>
                            <div class="control-group">
                            <label class="control-label span1" >
                            Hafiz-e-Quran :
                            </label>
                            <div class="controls controls-row">
                            <?php
                            // //DebugBreak();
                            if($isReAdm == 1)
                            {
                                echo " <label class='radio inline span1'><input type='radio' id='hafiz1' value='1'  name='hafiz'> No</label>
                                <label class='radio inline span1'><input type='radio' id='hafiz2' value='2' checked='checked' name='hafiz'> Yes</label>";
                            }
                            else
                            {
                                //$hafiz = $data[0]['Ishafiz'];
                                //if ($hafiz == 1)
                                //{
                                echo " <label class='radio inline span1'><input type='radio' id='hafiz1' value='1' checked='checked' name='hafiz'> No</label>
                                <label class='radio inline span1'><input type='radio' id='hafiz2' value='2' name='hafiz'> Yes</label>";
                                //}
                                //else if ($hafiz == 2)
                                //{                                 
                                //   echo " <label class='radio inline span1'><input type='radio' id='hafiz1' value='1'  name='hafiz'> No</label>
                                // <label class='radio inline span1'><input type='radio' id='hafiz2' value='2' checked='checked' name='hafiz'> Yes</label>";
                                //}
                            }    
                            ?>
                            <label class="control-label span3" >
                            Religion :
                            </label> 
                            <?php
                            $rel = $data[0]['rel'];
                            if($rel == 1)
                            {
                                echo " <label class='radio inline span1'><input type='radio' id='religion' class='rel_class' value='1' checked='checked' name='religion'> Muslim
                                </label><label class='radio inline span1'><input type='radio' id='religion1' class='rel_class' value='2' name='religion'> Non Muslim</label>" ;
                            }
                            else if ($rel == 2)
                            {
                                echo " <label class='radio inline span1'><input type='radio' id='religion' class='rel_class' value='1'  name='religion'> Muslim
                                </label><label class='radio inline span1'><input type='radio' id='religion1' class='rel_class' value='2' checked='checked' name='religion'> Non Muslim</label>" ;
                            }
                            ?>
                            </div>
                            </div> -->
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Nationality :
                                </label>
                                <div class="controls controls-row">  
                                    <?php
                                    $nat = $data[0]['nat'];
                                    if($nat == 1)
                                    {
                                        echo 
                                        "<label class='radio inline span1'><input type='radio' value='1' id='nationality' checked='checked' name='nationality'> Pakistani</label>
                                        <label class='radio inline span2'><input type='radio'  id='nationality1' value='2' name='nationality'> Non Pakistani</label>";
                                    }
                                    else if ($nat == 2)
                                    {
                                        echo  "<label class='radio inline span1'><input type='radio' value='1' id='nationality'  name='nationality'> Pakistani
                                        </label><label class='radio inline span2'><input type='radio'  id='nationality1' checked='checked' value='2' name='nationality'>  Non Pakistani</label>" ;
                                    }
                                    ?>
                                    <label class="control-label span3" style="margin-left: -100px;" for="gender1">
                                        Gender :
                                    </label> 
                                    <?php
                                    $gender = $data[0]['sex'];
                                    if($gender == 1)
                                    {
                                        echo 
                                        "<label class='radio inline span1'><input type='radio' id='gender1' value='1' checked='checked'  disabled='disabled' name='gender'> Male</label> 
                                        <label class='radio inline span1'><input type='radio' id='gender2' value='2'  name='gender'  disabled='disabled'> Female </label> " ;
                                    }
                                    else if ($gender == 2)
                                    {
                                        echo 
                                        "<label class='radio inline span1'><input type='radio' id='gender1' value='1'  disabled='disabled' name='gender'> Male</label> 
                                        <label class='radio inline span1'><input type='radio' id='gender2' value='2'  checked='checked'  disabled='disabled'  name='gender'> Female </label> " ;
                                    }
                                    ?>
                                    <input type="hidden" name="gend" id='gend' value="<?php echo $gender; ?>">
                                    <input type="hidden" name="category" id="category" value="<?php echo @$cattype; ?>">


                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Hafiz-e-Quran :
                                </label>
                                <div class="controls controls-row">
                                    <label class='radio inline span1'><input type='radio' id='hafiz1' value='1'  checked='checked' name='hafiz'> No</label>
                                    <label class='radio inline span1'><input type='radio' id='hafiz2' value='2' name='hafiz'> Yes</label>    
                                    <label class="control-label span3" >
                                        Religion :
                                    </label> 
                                    <?php
                                    $rel = $data[0]['rel'];
                                    if($rel == 1)
                                    {
                                        echo
                                        "<label class='radio inline span1'><input type='radio' id='religion' class='rel_class' value='1' checked='checked' name='religion'> Muslim
                                        </label><label class='radio inline span1'><input type='radio' id='religion1' class='rel_class'  value='2' name='religion'> Non Muslim</label>" ;
                                    }
                                    else if ($rel == 2)
                                    {
                                        echo
                                        "<label class='radio inline span1'><input type='radio' id='religion' class='rel_class' value='1' name='religion'> Muslim
                                        </label><label class='radio inline span1'><input type='radio' id='religion1' class='rel_class' value='2' checked='checked' name='religion'> Non Muslim</label>" ;
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="control-group">
                            <label class="control-label span1" >
                                Residency :
                            </label>
                            <div class="controls controls-row">  
                                <?php
                                $resid = $data[0]['RuralORUrban'];
                                if($resid == 1 )
                                {
                                    echo " <label class='radio inline span1'><input type='radio' value='1' id='UrbanRural' checked='checked' name='UrbanRural'> Urban
                                    </label><label class='radio inline span2'><input type='radio'  id='UrbanRural' value='2' name='UrbanRural'>  Rural </label>";
                                }
                                else if($resid == 2)
                                {
                                    echo " <label class='radio inline span1'><input type='radio' value='1' id='UrbanRural' name='UrbanRural'> Urban
                                    </label><label class='radio inline span2'><input type='radio'  id='UrbanRural' value='2'  checked='checked'  name='UrbanRural'>  Rural </label>";
                                }
                                else 
                                {
                                    echo " <label class='radio inline span1'><input type='radio' value='1' id='UrbanRural' name='UrbanRural'> Urban
                                    </label><label class='radio inline span2'><input type='radio'  id='UrbanRural' value='2'  checked='checked'  name='UrbanRural'>  Rural </label>";
                                }
                                ?>

                            </div>
                            <div class="control-group">
                                <label class="control-label span1" style="margin-top: 25px;">
                                    Address :
                                </label>
                                <div class="controls controls-row">
                                    <textarea style="height:150px; margin-top: 25px; text-transform: uppercase;"  id="address" class="span8" name="address" required="required"><?php
                                        echo $data[0]['addr'];
                                    ?></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="control-group">
                                <h4 class="span4">Old Exam Information :</h4>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Rno :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" readonly="readonly" id="oldrno" style="text-transform: uppercase;" name="oldrno" value="<?php  echo  $data['0']['rno']; ?>" required="required" maxlength="60" >
                                    <label class="control-label span2" >
                                        Year:
                                    </label> 
                                    <input type="text" class="span3" name="oldyear" id = "oldyear" readonly="readonly" value="<?php  echo $data['0']['Iyear']; ?>"/> 
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Session :
                                </label>
                                <div class="controls controls-row">
                                    <input type="text" class="span3" id="oldsess" name="oldsess" readonly="readonly" value="<?php echo $data['0']['sess'] == 1 ? "Annual" :"Supplementary"; ?>"/> 
                                    <label class="control-label span2" >
                                        Board:
                                    </label> 
                                    <input type="text" class="span3" id="oldboard" name="oldboard" readonly="readonly" value="<?php echo $data[0]['brd_name'];?>"/>     
                                    <input type="hidden" class="span3" id="oldClass" name="oldClass"  value="<?php echo $data[0]['class'];?>"/>     
                                    <input type="hidden" class="span3" id="oldboardid" name="oldboardid"  value="<?php  echo $data[0]['Brd_cd'];?>"/>     
                                </div>
                            </div>
                            <hr>
                            <div class="control-group">
                                <h4 class="span4" style="margin-left: 30px;">Exam Proposed Center Information :</h4>
                                <div class="controls controls-row">
                                    <label class="control-label span2">

                                    </label> 

                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    District :
                                </label>
                                <div class="controls controls-row">
                                    <select class='span3' id='pvtinfo_dist' name='pvtinfo_dist' required='required'>
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
                                    <select class='span3' id='pvtinfo_teh' name='pvtinfo_teh' required='required'>
                                        <option value='0'>SELECT TEHSIL</option>

                                    </select>
                                </div>
                            </div>



                            <div class="control-group">
                                <label class="control-label span1" >
                                    Zone :
                                </label>
                                <div class="controls controls-row">
                                    <select id="pvtZone"  class="span3" name="pvtZone">
                                        <option value='0'>SELECT ZONE</option>

                                    </select>
                                </div>
                            </div>
                            <div id="instruction" style="display:none; width:700px" >
                                <img src="<?php echo base_url(); ?>assets/img/admission_form.jpg" border="0" width="10000" height="840" alt="admission_form.jpg">
                                <img src="<?php echo base_url(); ?>assets/img/instructions.jpg" border="0" width="10000" height="840" alt="admission_form.jpg">
                            </div>
                            <hr>
                            <div class="control-group">
                                <h4 class="span4" style="margin-left: -45px;">Exam Information :</h4>
                                <div class="controls controls-row">
                                    <label class="control-label span2">

                                    </label> 

                                </div>
                            </div>
                            <div class="control-group">
                                <input type="hidden" value="<?=  $data[0]['grp_cd']?>" name="pergrp" id="pergrp">
                                <label class="control-label span1" >
                                    Study Group :
                                </label>
                                <div class="controls controls-row">
                                    <select id="std_group" class="dropdown span6"  name="std_group">
                                        <?php
                                        //DebugBreak();
                                        $grp = $data[0]['grp_cd'];
                                        $sub7 = $data[0]['sub7'];
                                        $sub8 = $data[0]['sub8'];
                                        $chance = $data[0]['chance'];
                                        $exam_type = $data[0]['exam_type'];
                                        if(isset($_POST))
                                        {
                                            @$cattype   = @$cattype;    
                                        }
                                        else
                                        {
                                            @$cattype   = @$_POST["CatType"];    
                                        }

                                        @$cat09_forAma =$data[0]["cat09"];
                                        @$cat10_forAma =$data[0]["cat10"];
                                        @$status_forAma =$data[0]["status"];


                                        if($exam_type == 2 && $grp !=4)
                                        {
                                            if($grp == 1 && ($sub7 == 8 || $sub8 == 8))
                                            {
                                                echo "<option value='1' selected='selected'>SCIENCE WITH BIOLOGY</option>";  
                                            }
                                            else 
                                            {
                                                echo "<option value='1' >SCIENCE WITH BIOLOGY</option>";    
                                            }
                                            if($sub7 == 78 || $sub8 == 78)
                                            {
                                                echo "<option value='7' selected='selected'>SCIENCE  WITH COMPUTER SCIENCE</option>";
                                            }
                                            else
                                            {
                                                echo "<option value='7'>SCIENCE  WITH COMPUTER SCIENCE</option>"; 
                                            }
                                            if($sub7 == 43 || $sub8 == 43)
                                            {
                                                echo "<option value='8'  selected='selected'>SCIENCE  WITH ELECTRICAL WIRING</option>";
                                            }
                                            else
                                            {
                                                echo "<option value='8'  >SCIENCE  WITH ELECTRICAL WIRING</option>";
                                            }

                                            if($grp == 2)
                                            {
                                                echo "<option value='2' selected='selected'>GENERAL</option>";  
                                            }
                                            else
                                            {
                                                echo "<option value='2'>GENERAL</option>";   
                                            }
                                            if($grp == 5)
                                            {
                                                echo "<option value='5' selected='selected'>DEAF AND DUMB</option>";  
                                            }
                                            else
                                            {
                                                echo "<option value='5'>DEAF AND DUMB</option>";  
                                            }
                                        }


                                        if($grp == 4 && $exam_type == 2)
                                        {
                                            echo "<option value='4' selected='selected'>Ama Group</option>";  
                                        }

                                        if($exam_type == 3 OR $exam_type == 1)
                                        {
                                            if($grp == 1 && $sub7  == 8)
                                            {
                                                echo "<option value='1' selected='selected'>SCIENCE WITH BIOLOGY</option>";                                                               
                                                echo "<option value='2'>GENERAL</option>";
                                                echo "<option value='7'>SCIENCE  WITH COMPUTER SCIENCE</option>";  
                                                echo "<option value='5'>DEAF AND DUMB</option>";  
                                            }

                                            if($grp == 1 && $sub7  == 78)
                                            {
                                                echo "<option value='1' >SCIENCE WITH BIOLOGY</option>"; 
                                                echo "<option value='7' selected='selected'>SCIENCE  WITH COMPUTER SCIENCE</option>";                                                               
                                                echo "<option value='2'>GENERAL</option>";
                                                echo "<option value='5'>DEAF AND DUMB</option>";  
                                            }
                                            if($grp == 1 && $sub7  == 43)
                                            {
                                                echo "<option value='1' >SCIENCE WITH BIOLOGY</option>";                                                                                  
                                                echo "<option value='7' >SCIENCE  WITH COMPUTER SCIENCE</option>";
                                                echo "<option value='8' >SCIENCE  WITH ELECTRICAL WIRING</option>";
                                                echo "<option value='2'>GENERAL</option>";
                                                echo "<option value='5'>DEAF AND DUMB</option>";  
                                            }

                                            if($grp == 2)
                                            {
                                                echo "<option value='2' selected='selected'>GENERAL</option>";  
                                                echo "<option value='1' >SCIENCE WITH BIOLOGY</option>";                                                               
                                                echo "<option value='7'>SCIENCE  WITH COMPUTER SCIENCE</option>";  
                                                echo "<option value='5'>DEAF AND DUMB</option>";
                                            }

                                            if($grp == 5)
                                            {
                                                echo "<option value='5' selected='selected'>DEAF AND DUMB</option>";  
                                                echo "<option value='2' >GENERAL</option>"; 
                                                echo "<option value='1'>SCIENCE WITH BIOLOGY</option>";                                                               
                                                echo "<option value='7'>SCIENCE  WITH COMPUTER SCIENCE</option>";  

                                            }
                                            if($grp == 4)
                                            {
                                                echo "<option value='4' selected='selected'>Ama Group</option>";  
                                            }

                                        }
                                        if($exam_type == 4 || $exam_type == 5 || $exam_type == 6)
                                        {
                                            if($grp == 1 && $sub7 == 8)
                                            {
                                                echo "<option value='1' selected='selected'>SCIENCE WITH BIOLOGY</option>";  
                                                echo "<option value='2'>GENERAL</option>";
                                                echo "<option value='7'>SCIENCE  WITH COMPUTER SCIENCE</option>";  
                                                echo "<option value='5'>DEAF AND DUMB</option>";  
                                            }

                                            if($grp == 1 && $sub7 == 78)
                                            {
                                                echo "<option value='7' selected='selected'>SCIENCE  WITH COMPUTER SCIENCE</option>";
                                                echo "<option value='1' >SCIENCE WITH BIOLOGY</option>"; 
                                                echo "<option value='2'>GENERAL</option>";  
                                                echo "<option value='5'>DEAF AND DUMB</option>";  
                                            }
                                            if($grp == 1 && $sub7 == 43)
                                            {
                                                echo"<option value='8' selected='selected'>SCIENCE  WITH ELECTRICAL WIRING</option>";
                                                echo "<option value='2'>GENERAL</option>"; 
                                                echo "<option value='1' >SCIENCE WITH BIOLOGY</option>";  
                                                echo "<option value='7'>SCIENCE  WITH COMPUTER SCIENCE</option>";
                                                echo "<option value='5'>DEAF AND DUMB</option>";  
                                            }


                                            if($grp == 2)
                                            {
                                                echo "<option value='2' selected='selected'>GENERAL</option>";  
                                                echo "<option value='1'>SCIENCE WITH BIOLOGY</option>";  
                                                echo "<option value='7'>SCIENCE  WITH COMPUTER SCIENCE</option>";
                                                echo "<option value='5'>DEAF AND DUMB</option>";  
                                            }

                                            if($grp == 5)
                                            {
                                                echo "<option value='5' selected='selected'>DEAF AND DUMB</option>";  
                                                echo "<option value='1'>SCIENCE WITH BIOLOGY</option>";  
                                                echo "<option value='2'>GENERAL</option>";  
                                                echo "<option value='7'>SCIENCE  WITH COMPUTER SCIENCE</option>";;  
                                            }
                                        }
                                        if($exam_type == 14) 
                                        {

                                            if($grp == 1 && ($data[0]['sub6']== 8 || $data[0]['sub7']== 8 ))

                                                echo "
                                                <option value='1'  selected='selected'>SCIENCE WITH BIOLOGY</option>"; 

                                            if($grp == 1 && ($data[0]['sub6']== 78 || $data[0]['sub7']== 78 ))

                                                echo "
                                                <option value='7'  selected='selected'>SCIENCE  WITH COMPUTER SCIENCE</option>"; 

                                            if($grp == 2)

                                                echo"<option value='2' selected='selected'>GENERAL</option>";

                                            if($grp == 5)
                                                echo"<option value='5' selected='selected'>DEAF AND DUMB</option>";

                                            if($grp == 7)
                                                echo"<option value='7' selected='selected'>SCIENCE  WITH COMPUTER SCIENCE</option>";
                                        }
                                        if($exam_type == 15)
                                        {


                                            if($grp == 1 && ($data[0]['sub6']== 8 || $data[0]['sub7']== 8 ))

                                                echo "
                                                <option value='1'  selected='selected'>SCIENCE WITH BIOLOGY</option>"; 

                                            if($grp == 1 && ($data[0]['sub6']== 78 || $data[0]['sub7']== 78 ))

                                                echo "
                                                <option value='7'  selected='selected'>SCIENCE  WITH COMPUTER SCIENCE</option>"; 



                                            if($grp == 2)

                                                echo"<option value='2'  selected='selected'>GENERAL</option>";



                                            if($grp == 5)
                                                echo"<option value='5' selected='selected'>DEAF AND DUMB</option>";



                                            if($grp == 7)
                                                echo"<option value='7' disabled='disabled' selected='selected'>SCIENCE  WITH COMPUTER SCIENCE</option>";


                                            if($grp == 8)
                                                echo"<option value='8' disabled='disabled' selected='selected'>SCIENCE  WITH ELECTRICAL WIRING</option>";
                                        }
                                        if($exam_type == 16 && $cattype == 1)
                                        {

                                            if($grp == 1 && ($data[0]['sub6']== 8 || $data[0]['sub7']== 8 ))

                                                echo "
                                                <option value='1'  selected='selected'>SCIENCE WITH BIOLOGY</option>"; 

                                            if($grp == 1 && ($data[0]['sub6']== 78 || $data[0]['sub7']== 78 ))

                                                echo "
                                                <option value='7'  selected='selected'>SCIENCE  WITH COMPUTER SCIENCE</option>"; 

                                            if($grp == 2)

                                                echo"<option value='2' selected='selected'>GENERAL</option>";



                                            if($grp == 5)
                                                echo"<option value='5'  selected='selected'>DEAF AND DUMB</option>";



                                            if($grp == 7)
                                                echo"<option value='7' selected='selected'>SCIENCE  WITH COMPUTER SCIENCE</option>";
                                        }
                                        if($exam_type == 16 && $cattype == 2)
                                        {


                                            if($grp == 1 && ($data[0]['sub6']== 8 || $data[0]['sub7']== 8 ))

                                                echo "
                                                <option value='1'  selected='selected'>SCIENCE WITH BIOLOGY</option>"; 

                                            if($grp == 1 && ($data[0]['sub6']== 78 || $data[0]['sub7']== 78 ))

                                                echo "
                                                <option value='7'  selected='selected'>SCIENCE  WITH COMPUTER SCIENCE</option>"; 

                                            if($grp == 2)

                                                echo"<option value='2' selected='selected'>GENERAL</option>";



                                            if($grp == 5)
                                                echo"<option value='5' selected='selected'>DEAF AND DUMB</option>";



                                            if($grp == 7)
                                                echo"<option value='7'  selected='selected'>SCIENCE  WITH COMPUTER SCIENCE</option>";
                                        }
                                        $subarray = array(
                                            'NONE'=>'',
                                            'NONE'=>'0',
                                            'Urdu' => '1',
                                            'English' => '2',
                                            'ISLAMIYAT (COMPULSORY)' => '3',
                                            'PAKISTAN STUDIES' => '4',
                                            'MATHEMATICS' => '5',
                                            'PHYSICS' => '6',
                                            'CHEMISTRY' => '7',
                                            'BIOLOGY' => '8',
                                            'GENERAL SCIENCE' => '9',
                                            'FOUNDATION OF EDUCATION' => '10',
                                            'GEOGRAPHY OF PAKISTAN' => '11',
                                            'HOUSE HOLD ACCOUNTS & ITS RELATED PROBLEMS' => '12',
                                            'ELEMENTS OF HOME ECONOMICS' => '13',
                                            'PHYSIOLOGY & HYGIENE' => '14',
                                            'GEOMETRICAL & TECHNICAL DRAWING' => '15',
                                            'GEOLOGY' => '16',
                                            'ASTRONOMY & SPACE SCIENCE' => '17',
                                            'ART/ART & MODEL DRAWING' => '18',
                                            'ISLAMIC STUDIES' => '19',
                                            'ISLAMIC HISTORY' => '20',
                                            'HISTORY OF PAKISTAN' => '21',
                                            'ARABIC' => '22',
                                            'PERSIAN' => '23',
                                            'GEOGRAPHY' => '24',
                                            'ECONOMICS' => '25',
                                            'CIVICS' => '26',
                                            'FOOD AND NUTRITION' => '27',
                                            'ART IN HOME ECONOMICS' => '28',
                                            'MANAGEMENT FOR BETTER HOME' => '29',
                                            'CLOTHING & TEXTILES' => '30',
                                            'CHILD DEVELOPMENT AND FAMILY LIVING' => '31',
                                            'MILITARY SCIENCE' => '32',
                                            'COMMERCIAL GEOGRAPHY' => '33',
                                            'URDU LITERATURE' => '34',
                                            'ENGLISH LITERATURE' => '35',
                                            'PUNJABI' => '36',
                                            'EDUCATION' => '37',
                                            'ELEMENTARY NURSING & FIRST AID' => '38',
                                            'PHOTOGRAPHY' => '39',
                                            'HEALTH & PHYSICAL EDUCATION' => '40',
                                            'CALIGRAPHY' => '41',
                                            'LOCAL (COMMUNITY) CRAFTS' => '42',
                                            'ELECTRICAL WIRING' => '43',
                                            'RADIO ELECTRONICS' => '44',
                                            'COMMERCE' => '45',
                                            'AGRICULTURE' => '46',
                                            'BOOK KEEPING & ACCOUNTANCY' => '47',
                                            'WOOD WORK (FURNITURE MAKING)' => '48',
                                            'GENERAL AGRICULTURE' => '49',
                                            'FARM ECONOMICS' => '50',
                                            'ETHICS' => '51',
                                            'LIVE STOCK FARMING' => '52',
                                            'ANIMAL PRODUCTION' => '53',
                                            'PRODUCTIVE INSECTS AND FISH CULTURE' => '54',
                                            'HORTICULTURE' => '55',
                                            'PRINCIPLES OF HOME ECONOMICS' => '56',
                                            'RELATED ACT' => '57',
                                            'HAND AND MACHINE EMBROIDERY' => '58',
                                            'DRAFTING AND GARMENT MAKING' => '59',
                                            'HAND & MACHINE KNITTING & CROCHEING' => '60',
                                            'STUFFED TOYS AND DOLL MAKING' => '61',
                                            'CONFECTIONERY AND BAKERY' => '62',
                                            'PRESERVATION OF FRUITS,VEGETABLES & OTHER FOODS' => '63',
                                            'CARE AND GUIDENCE OF CHILDREN' => '64',
                                            'FARM HOUSE HOLD MANAGEMENT' => '65',
                                            'ARITHEMATIC' => '66',
                                            'BAKERY' => '67',
                                            'CARPET MAKING' => '68',
                                            'DRAWING' => '69',
                                            'EMBORIDERY' => '70',
                                            'HISTORY' => '71',
                                            'TAILORING' => '72',
                                            'TYPE WRITING' => '73',
                                            'WEAVING' => '74',
                                            'SECRETARIAL PRACTICE' => '75',
                                            'CANDLE MAKING' => '76',
                                            'SECRETARIAL PRACTICE AND CORRESPONDANCE' => '77',
                                            'COMPUTER SCIENCES' => '78',
                                            'WOOD WORK (BOAT MAKING)' => '79',
                                            'PRINCIPLES OF ARITHMATIC' => '80',
                                            'SEERAT-E-RASOOL' => '81',
                                            'AL-QURAAN' => '82',
                                            'POULTRY FARMING' => '83',
                                            'ART & MODEL DRAWING' => '84',
                                            'BUSINESS STUDIES' => '85',
                                            'HADEES & FIQAH' => '86',
                                            'ENVIRONMENTAL STUDIES' => '87',
                                            'REFRIGERATION AND AIR CONDITIONING' => '88',
                                            'FISH FARMING' => '89',
                                            'COMPUTER HARDWARE' => '90',
                                            'BEAUTICIAN' => '91',
                                            'GENERAL MATHEMATICS' => '92',
                                            'COMPUTER SCIENCES_DFD' => '93',
                                            'HEALTH & PHYSICAL EDUCATION_DFD' => '94'
                                        );
                                        $result =  array_search($data[0]['sub4'],$subarray);
                                        ?>
                                    </select>                                            
                                </div>
                            </div>




                            <div class="control-group">
                                <label class="control-label span12" style="width: 366px; font-weight: bold;" >
                                    Choose Subjects(Elective Subjects are Enabled Only)   
                                    </br></br></br>

                                    <?php



                                    //  DebugBreak();
                                    @$exam_type = $data[0]['exam_type'];
                                    @$grp_cd = $data[0]['grp_cd'];
                                    @$oldcls = $data[0]['class'];
                                    $Status =  $data[0]['status'];

                                    if($exam_type == 14 || ($cattype == 1 && $exam_type == 16)){

                                        echo "<div class='control-group'>
                                        <label class='control-label'  >
                                        Select Category:  
                                        </label> 
                                        <div class='controls controls-row'>
                                        <select id='ddlMarksImproveoptions' class='dropdown' name='ddlMarksImproveoptions'>
                                        <option value='0' selected='selected'>Select Any One </option>
                                        <option value='1'>PART-1 FULL </option>
                                        <option value='2'>PART-2 FULL</option>                                
                                        <option value='3'>BOTH PART FULL</option>
                                        <option value='4'>SUBJECT WISE</option>            
                                        </select>
                                        </div>
                                        </div>";
                                    }     
                                    //  if(($exam_type == 4 || $exam_type == 5 || $exam_type == 6 ||  $exam_type == 3) &&  $data[0]['Iyear'] ==2017 )
                                    if(($exam_type == 4 || $exam_type == 5 || $exam_type == 6 ||  $exam_type == 3))
                                    {
                                        echo "<div class='control-group' >
                                        <label class='control-label'  id='divIsfullApp'>
                                        <input type='checkbox' name='isfullAppear' id = 'isfullAppear'/>   Is Full Appear?
                                        </label> 

                                        </div>";
                                    }  
                                    ?>
                                </label> 
                            </div>
                            </br></br>
                            <div class="control-group">
                                <div class="control row controls-row">
                                    <label class="control-label span3 " id="lblpart1cat" name="lblpart1cat" style="text-decoration: underline; font-weight: bold;" >
                                        PART-I Subjects
                                    </label>
                                    <label class="control-label span3 " id="lblpart2cat" name="lblpart2cat" style="text-decoration: underline; font-weight: bold;" >
                                        PART-II Subjects
                                    </label>
                                </div>
                                <div class="control row controls-row">
                                    <label class="control-label span1" >

                                    </label>
                                    <select id="sub1" class="span3 dropdown" name="sub1">

                                    </select> 

                                    <select id="sub1p2" class="span3 dropdown" name="sub1p2">

                                    </select> 
                                </div>
                                <div class="control row controls-row">
                                    <label class="control-label span1" >

                                    </label>
                                    <select id="sub2"  name="sub2" class="span3 dropdown">

                                    </select>
                                    <select id="sub2p2" class="span3 dropdown" name="sub2p2">

                                    </select> 
                                </div>
                                <div class="control row controls-row">
                                    <label class="control-label span1" >

                                    </label>
                                    <select id="sub3" class="span3 dropdown" name="sub3">

                                    </select> 
                                    <select id="sub3p2" class="span3 dropdown" name="sub3p2">

                                    </select> 
                                </div>
                                <div class="control row controls-row">
                                    <label class="control-label span1" >

                                    </label>
                                    <select id="sub8"  name="sub8" class="span3 dropdown">

                                    </select>
                                    <select id="sub8p2"  name="sub8p2" class="span3 dropdown">
                                    </select>
                                </div>
                                <div class="control row controls-row">
                                    <label class="control-label span1" >

                                    </label>
                                    <select id="sub4"  name="sub4" class="span3 dropdown">

                                    </select>
                                    <select id="sub4p2" class="span3 dropdown" name="sub4p2">

                                    </select> 
                                </div>

                                <div class="control row controls-row">
                                    <label class="control-label span1" >

                                    </label>
                                    <select id="sub5" class="span3 dropdown" name="sub5" selected="selected">

                                    </select> 
                                    <select id="sub5p2" class="span3 dropdown" name="sub5p2" selected="selected">

                                    </select> 
                                </div>
                                <div class="control row controls-row">
                                    <label class="control-label span1" >

                                    </label>
                                    <select id="sub6"  name="sub6" class="span3 dropdown" selected="selected">

                                    </select>
                                    <select id="sub6p2"  name="sub6p2" class="span3 dropdown" selected="selected">

                                    </select>
                                </div>
                                <div class="control row controls-row">
                                    <label class="control-label span1" >

                                    </label>
                                    <select id="sub7" class="span3 dropdown" name="sub7" selected="selected">

                                    </select> 
                                    <select id="sub7p2" class="span3 dropdown" name="sub7p2" selected="selected">

                                    </select> 
                                </div> 

                            </div>
                            <div>
                                <input type="hidden" name="oldclass" id="oldclass" value="<?php echo @$oldcls; ?>">
                                <input type="hidden" name="exam_type" id="exam_type" value="<?php echo @$exam_type = $data[0]['exam_type']; ?>">
                                <input type="hidden" name="exam_type_static" id="exam_type_static" value="<?php echo @$exam_type = $data[0]['exam_type']; ?>">
                                <input type="hidden" name="oldexam_type" id="oldexam_type">                    

                                <input type="hidden" name="grppre" id="grppre" value="<?php if(($exam_type == 16)){ if( ($data[0]['sub7'] == 78) ||($data[0]['sub6'] == 78)  ) { @$grp_cd = 7; }} else {echo @$grp_cd = $data[0]['grp_cd']; }  ?>">
                                <input type="hidden" name="grppre_extra" id="grppre_extra" value="<?php  if( ($data[0]['sub7'] == 78) ||($data[0]['sub6'] == 78)  ) { @$grp_cd = 7; } else {echo @$grp_cd = $data[0]['grp_cd']; }  ?>">
                                <input type="hidden" name="strRegNo" id="strRegNo" value="<?php  echo $data[0]['strRegNo']; ?>">

                            </div>
                            <div class="form-actions no-margin">
                                <button type="submit" onclick="return checks()" name="btnsubmitUpdateEnrol" class="btn btn-large btn-info offset2" style="    margin-left: -807px;">
                                    Save Form
                                </button>
                                <a href="<?php echo base_url(); ?>assets/pdfs/instructions.pdf" download="Instructions.pdf" class="btn btn-large btn-info" >Download Instruction</a>
                                <input type="button" class="btn btn-large btn-danger" value="Cancel" id="btnCancel" name="btnCancel" onclick="return CancelAlert();" >
                                <div class="clearfix"></div>
                            </div>
                        </form>
                        <script src="<?php echo base_url(); ?>assets/js_matric/jquery-1.8.3.js"></script>
                        <script type="text/javascript">
                            function ValidateFileUpload() {                                                                                                        
                                var fuData = document.getElementById('inputFile');
                                var FileUploadPath = fuData.value;
                                if (FileUploadPath == '') {
                                    alert("Please upload an image");
                                    jQuery('#image_upload_preview').removeAttr('src');
                                } 
                                else {
                                    var Extension = FileUploadPath.substring(
                                        FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
                                    if (Extension == "jpeg" || Extension == "jpg") {
                                        if (fuData.files && fuData.files[0]) {
                                            var reader = new FileReader();
                                            reader.onload = function(e) {
                                                $('#image_upload_preview').attr('src', e.target.result);
                                            }
                                            reader.readAsDataURL(fuData.files[0]);
                                        }
                                    } 
                                    else {
                                        $('#inputFile').removeAttr('value');
                                        jQuery('#image_upload_preview').removeAttr('src');
                                        alert("Image only allows file types of JPEG. ");
                                        return false;
                                    }
                                }
                                var file_size = $('#inputFile')[0].files[0].size;
                                if(file_size>20480) {                                    
                                    $('#inputFile').removeAttr('value');
                                    jQuery('#image_upload_preview').removeAttr('src');
                                    alert("File size can be between 20KB"); 
                                    return false;
                                } 
                            }
                            $(window).load(function()
                                {
                                    $.fancybox("#instruction");
                            });
                            $(document).ready(function(){

                                var sub1_Pak_options = {
                                    1 : 'URDU'
                                }
                                var sub1_NonPak_options = 
                                {
                                    11 : 'GEOGROPHY OF PAKISTAN',
                                    1 : 'URDU'
                                }
                                var sub3_Muslim = 
                                {
                                    3 :'ISLAMYAT COMPULSORY'
                                }
                                var sub3_Non_Muslim = 
                                {
                                    51 : 'ETHICS',
                                    3  :'ISLAMYAT COMPULSORY'
                                }
                                var sub5_Hum = 
                                {
                                    92 : 'GENERAL MATHEMATICS' 
                                }
                                var sub6_Hum = 
                                {
                                    9 : 'GENERAL SCIENCE'  
                                }
                                var sub7_Hum = 
                                {
                                    0 : 'NOT SELECTED',
                                    37: 'EDUCATION',
                                    26: 'CIVICS',
                                    25: 'ECONOMICS',
                                    14: 'PHYSIOLOGY & HYGIENE',
                                    24: 'GEOGRAPHY',
                                    21: 'HISTORY OF PAKISTAN',
                                    35: 'ENGLISH LITERATURE',
                                    34: 'URDU LITERATURE',
                                    19: 'ADVANCED ISLAMIC STUDIES',
                                    87: 'ENVIRONMENTAL STUDIES',
                                    33: 'COMMERCIAL GEOGRAPHY',
                                    22: 'ARABIC',
                                    23: 'PERSIAN',
                                    36: 'PUNJABI',
                                    20: 'ISLAMIC HISTORY / MUSLIM HISTORY',
                                    83: 'POULTRY FARMING',
                                    40: 'HEALTH & PHYSICAL EDUCATION',
                                    78: 'COMPUTER SCIENCE',
                                    15 : 'GEOMETRICAL & TECHNICAL DRAWING',
                                    43 : 'ELECTRICAL WIRING',
                                    48 : 'WOOD WORK (FURNITURE MAKING)',
                                    90 : 'COMPUTER HARDWARE',
                                    89 : 'FISH FARMING',
                                    91 : 'BEAUTICIAN',
                                    74 : 'WEAVING'
                                }
                                var sub8_Hum = 
                                {
                                    0 : 'NOT SELECTED',
                                    37: 'EDUCATION',
                                    26: 'CIVICS',
                                    25: 'ECONOMICS',
                                    14: 'PHYSIOLOGY & HYGIENE',
                                    24: 'GEOGRAPHY',
                                    21: 'HISTORY OF PAKISTAN',
                                    35: 'ENGLISH LITERATURE',
                                    34: 'URDU LITERATURE',
                                    19: 'ADVANCED ISLAMIC STUDIES',
                                    87: 'ENVIRONMENTAL STUDIES',
                                    33: 'COMMERCIAL GEOGRAPHY',
                                    22: 'ARABIC',
                                    23: 'PERSIAN',
                                    36: 'PUNJABI',
                                    20: 'ISLAMIC HISTORY / MUSLIM HISTORY ',
                                    83: 'POULTRY FARMING',
                                    40: 'HEALTH & PHYSICAL EDUCATION',
                                    78: 'COMPUTER SCIENCE',
                                    15 : 'GEOMETRICAL & TECHNICAL DRAWING',
                                    43 : 'ELECTRICAL WIRING',
                                    48 : 'WOOD WORK (FURNITURE MAKING)',
                                    90 : 'COMPUTER HARDWARE',
                                    83 : 'POULTRY FARMING',
                                    89 : 'FISH FARMING',
                                    91 : 'BEAUTICIAN',
                                    74 : 'WEAVING'
                                }
                                var sub5_Deaf = 
                                {
                                    66: 'ARITHMETIC'
                                }
                                var sub6_Deaf = 
                                {
                                    0: 'NOT SELECTED',
                                    72 : 'TAILORING',
                                    67 : 'BAKERY',
                                    68 : 'CARPET MAKING',
                                    93 : 'COMPUTER SCIENCES',
                                    69 : 'DRAWING',
                                    70 : 'EMBORIDERY',
                                    94 : 'HEALTH & PHYSICAL EDUCATION',
                                    73 : 'TYPE WRITING',
                                    74 : 'WEAVING'
                                }
                                var sub7_Deaf = 
                                {
                                    0: 'NOT SELECTED',
                                    72 : 'TAILORING',
                                    67 : 'BAKERY',
                                    68 : 'CARPET MAKING',
                                    93 : 'COMPUTER SCIENCES ',
                                    69 : 'DRAWING',
                                    70 : 'EMBORIDERY',
                                    94 : 'HEALTH & PHYSICAL EDUCATION',
                                    73 : 'TYPE WRITING',
                                    74 : 'WEAVING'
                                }
                                var sub8_Deaf = 
                                {
                                    0: 'NOT SELECTED',
                                    72 : 'TAILORING',
                                    67 : 'BAKERY',
                                    68 : 'CARPET MAKING',
                                    93 : 'COMPUTER SCIENCES',
                                    69 : 'DRAWING',
                                    70 : 'EMBORIDERY',
                                    94 : 'HEALTH & PHYSICAL EDUCATION',
                                    73 : 'TYPE WRITING',
                                    74 : 'WEAVING'
                                }
                                /*var sub1 = {
                                1:'URDU'
                                }*/
                                var sub2_arr = {
                                    2:'ENGLISH'
                                }
                                var sub3_muslim = {
                                    3:'ISLAMIC EDUCATION'
                                }
                                var sub3_nonmuslim = {
                                    3:'ISLAMIC EDUCATION'
                                }
                                var additional_sub = {
                                    0 : 'NOT SELECTED',
                                    6 : 'PHYSICS',
                                    7 : 'CHEMISTRY',
                                    8 : 'BIOLOGY',
                                    9:'GENERAL SCIENCE',
                                    10:'FOUNDATION OF EDUCATION',
                                    11:'GEOGRAPHY OF PAKISTAN',
                                    12:'HOUSE HOLD ACCOUNTS & ITS RELATED PROBLEMS',
                                    13:'ELEMENTS OF HOME ECONOMICS',
                                    14:'PHYSIOLOGY & HYGIENE15GEOMETRICAL & TECHNICAL DRAWING',
                                    16:'GEOLOGY17ASTRONOMY & SPACE SCIENCE',
                                    18:'ART/ART & MODEL DRAWING',
                                    19:'ISLAMIC STUDIES',
                                    20: 'ISLAMIC HISTORY / MUSLIM HISTORY ',
                                    21:'HISTORY OF PAKISTAN',
                                    22:'ARABIC',
                                    23:'PERSIAN',
                                    24:'GEOGRAPHY',
                                    25:'ECONOMICS',
                                    26:'CIVICS',
                                    27:'FOOD AND NUTRITION',
                                    28:'ART IN HOME ECONOMICS',
                                    29:'MANAGEMENT FOR BETTER HOME',
                                    30:'CLOTHING & TEXTILES',
                                    31:'CHILD DEVELOPMENT AND FAMILY LIVING',
                                    32:'MILITARY SCIENCE',
                                    33:'COMMERCIAL GEOGRAPHY',
                                    34:'URDU LITERATURE35ENGLISH LITERATURE',
                                    36:'PUNJABI',
                                    37:'EDUCATION',
                                    38:'ELEMENTARY NURSING & FIRST AID',
                                    39:'PHOTOGRAPHY',
                                    40:'HEALTH & PHYSICAL EDUCATION',
                                    41:'CALIGRAPHY',
                                    42:'LOCAL (COMMUNITY) CRAFTS',
                                    43:'ELECTRICAL WIRING',
                                    44:'RADIO ELECTRONICS',
                                    45:'COMMERCE',
                                    46:'AGRICULTURE',
                                    47:'BOOK KEEPING & ACCOUNTANCY',
                                    48:'WOOD WORK (FURNITURE MAKING)',
                                    49:'GENERAL AGRICULTURE',
                                    50:'FARM ECONOMICS',
                                    51:'ETHICS',
                                    52:'LIVE STOCK FARMING',
                                    53:'ANIMAL PRODUCTION',
                                    54:'PRODUCTIVE INSECTS AND FISH CULTURE',
                                    55:'HORTICULTURE',
                                    56:'PRINCIPLES OF HOME ECONOMICS',
                                    57:'RELATED ACT',
                                    58:'HAND AND MACHINE EMBROIDERY',
                                    59:'DRAFTING AND GARMENT MAKING',
                                    60:'HAND & MACHINE KNITTING & CROCHEING',
                                    61:'STUFFED TOYS AND DOLL MAKING',
                                    62:'CONFECTIONERY AND BAKERY',
                                    63:'PRESERVATION OF FRUITS,VEGETABLES & OTHER FOODS',
                                    64:'CARE AND GUIDENCE OF CHILDREN',
                                    65:'FARM HOUSE HOLD MANAGEMENT',
                                    66:'ARITHEMATIC',
                                    67:'BAKERY',
                                    68:'CARPET MAKING',
                                    69:'DRAWING',
                                    70:'EMBORIDERY',
                                    71:'HISTORY',
                                    72:'TAILORING',
                                    73:'TYPE WRITING',
                                    74:'WEAVING',
                                    75:'SECRETARIAL PRACTICE',
                                    76:'CANDLE MAKING',
                                    77:'SECRETARIAL PRACTICE AND CORRESPONDANCE',
                                    78:'COMPUTER SCIENCE',
                                    79:'WOOD WORK (BOAT MAKING)',
                                    80:'PRINCIPLES OF ARITHMATIC',
                                    81:'SEERAT-E-RASOOL',
                                    82:'AL-QURAAN',
                                    83:'POULTRY FARMING',
                                    84:'ART & MODEL DRAWING',
                                    85:'BUSINESS STUDIES',
                                    86:'HADEES & FIQAH',
                                    87:'ENVIRONMENTAL STUDIES',
                                    88:'REFRIGERATION AND AIR CONDITIONING',
                                    89:'FISH FARMING',
                                    90:'COMPUTER HARDWARE',
                                    91:'BEAUTICIAN',
                                    92:'GENERAL MATH',
                                    93:'COMPUTER SCIENCES (For Deaf and Dumb)',
                                }

                                var grp_cd ="<?php echo  @$data[0]['grp_cd'] ?>";


                                var sub1 ="<?php echo @$data[0]['sub1']; ?>";
                                var sub2 = "<?php echo @$data[0]['sub2']; ?>";
                                var sub3 ="<?php echo @$data[0]['sub3']; ?>";
                                var sub4 = "<?php echo @$data[0]['sub4']; ?>";
                                var sub5 = "<?php echo @$data[0]['sub5']; ?>";
                                var sub6 = "<?php echo @$data[0]['sub6']; ?>";
                                var sub7 = "<?php echo @$data[0]['sub7']; ?>";
                                var sub8 = "<?php echo @$data[0]['sub8']; ?>";
                                // Part 1 Subjects Pass fail .
                                var sub1pf1 = "<?php  echo @$data[0]['sub1pf1']; ?>";
                                var sub2pf1 ="<?php echo @$data[0]['sub2pf1']; ?>";
                                var sub3pf1 = "<?php echo @$data[0]['sub3pf1']; ?>";
                                var sub4pf1 = "<?php echo @$data[0]['sub4pf1']; ?>";
                                var sub5pf1 ="<?php echo @$data[0]['sub5pf1']; ?>";
                                var sub6pf1 = "<?php echo @$data[0]['sub6pf1']; ?>";
                                var sub7pf1 = "<?php echo @$data[0]['sub7pf1']; ?>";
                                var sub8pf1 = "<?php echo @$data[0]['sub8pf1']; ?>";
                                // Part 2 Subjects Pass Fail.
                                var sub1pf2 = "<?php echo @$data[0]['sub1Pf2']; ?>";
                                var sub2pf2 = "<?php echo @$data[0]['sub2pf2']; ?>";
                                var sub3pf2 = "<?php echo @$data[0]['sub3pf2']; ?>";
                                var sub4pf2 = "<?php echo @$data[0]['sub4pf2']; ?>";
                                var sub5pf2 = "<?php echo @$data[0]['sub5pf2']; ?>";
                                var sub6pf2 = "<?php echo @$data[0]['sub6pf2']; ?>";
                                var sub7pf2 = "<?php echo @$data[0]['sub7pf2']; ?>";
                                var sub8pf2 = "<?php echo @$data[0]['sub8pf2']; ?>";
                                // Part 1 Subjects Present and Absent Status
                                var sub1st1 = "<?php echo @$data[0]['sub1st1']; ?>";
                                var sub2st1 ="<?php echo @$data[0]['sub2st1']; ?>";
                                var sub3st1 = "<?php echo @$data[0]['sub3st1']; ?>";
                                var sub4st1 ="<?php echo @$data[0]['sub4st1']; ?>";
                                var sub5st1 ="<?php echo @$data[0]['sub5st1']; ?>";
                                var sub6st1 = "<?php echo @$data[0]['sub6st1']; ?>";
                                var sub7st1 = "<?php echo @$data[0]['sub7st1']; ?>";
                                var sub8st1 = "<?php echo @$data[0]['sub8st1']; ?>";
                                // Part 2 Subjects Present and Absent Status
                                var sub1st2 = "<?php echo @$data[0]['sub1St2']; ?>";
                                var sub2st2 = "<?php echo @$data[0]['sub2st2']; ?>";
                                var sub3st2 ="<?php echo @$data[0]['sub3st2']; ?>";
                                var sub4st2 = "<?php echo @$data[0]['sub4st2']; ?>";
                                var sub5st2 = "<?php echo @$data[0]['sub5st2']; ?>";
                                var sub6st2 = "<?php echo @$data[0]['sub6st2']; ?>";
                                var sub7st2 ="<?php echo @$data[0]['sub7st2']; ?>";
                                var sub8st2 ="<?php  echo @$data[0]['sub8st2']; ?>";
                                // 
                                var Gender = "<?php echo @$gender; ?>";
                                function remove_subjects()
                                {
                                    $("#sub5").empty();
                                    $("#sub5p2").empty();
                                    $("#sub6").empty();
                                    $("#sub6p2").empty();
                                    $("#sub7").empty();
                                    $("#sub7p2").empty();
                                    $("#sub8").empty();
                                    $("#sub8p2").empty();
                                }
                                function load_Bio_CS_Sub()
                                {
                                    var NationalityVal = $("input[name=nationality]:checked").val();
                                    $('#sub1').empty();
                                    $('#sub1p2').empty();
                                    if(NationalityVal == "1")
                                    {
                                        $.each(sub1_Pak_options, function(val, text) {
                                            $('#sub1').append( new Option(text,val) );
                                            $('#sub1p2').append( new Option(text,val) );
                                        }); 
                                    }
                                    else if (NationalityVal == "2")
                                    {
                                        console.log("Hi Foreigner Welcom to Pakistan :) ");
                                        $.each(sub1_NonPak_options, function(val, text) {
                                            $('#sub1').append( new Option(text,val) );
                                            $('#sub1p2').append( new Option(text,val) );
                                        }); 
                                    }
                                    $('#sub2').empty();
                                    $('#sub2p2').empty();
                                    $("#sub2").prepend('<option selected="selected" value="2">ENGLISH</option>');
                                    $("#sub2p2").prepend('<option selected="selected" value="2">ENGLISH</option>');
                                    // Check Religion and select sub........
                                    $("#sub3").empty();
                                    $("#sub3p2").empty();
                                    var Religion = $("input[name=religion]:checked").val();
                                    //console.log(Religion);
                                    console.log(Religion);
                                    if(Religion == "1")
                                    {
                                        $.each(sub3_Muslim,function(val,text){
                                            $("#sub3").append(new Option(text,val));
                                            $("#sub3p2").append(new Option(text,val));
                                        });
                                    }
                                    else if(Religion == "2")
                                    {
                                        $.each(sub3_Non_Muslim,function(val,text){
                                            $("#sub3").append(new Option(text,val));
                                            $("#sub3p2").append(new Option(text,val));
                                        });
                                    }
                                    $("#sub4").empty();
                                    $("#sub4p2").empty();
                                    $("#sub8").empty();
                                    $("#sub8p2").empty();
                                    $("#sub8").prepend('<option selected="selected" value="4">PAKISTAN STUDIES</option>');
                                    $("#sub8p2").prepend('<option selected="selected" value="4">PAKISTAN STUDIES</option>');
                                    // Subject 5 ,6 ,7 and 8
                                    $("#sub5").empty();
                                    $("#sub5p2").empty();
                                    $("#sub6").empty();
                                    $("#sub6p2").empty();
                                    $("#sub7").empty();
                                    $("#sub7p2").empty();

                                    $("#sub4").append(new Option('MATHEMATICS',5));
                                    $("#sub4p2").append(new Option('MATHEMATICS',5));
                                    $("#sub5").append(new Option('PHYSICS',6));
                                    $("#sub5p2").append(new Option('PHYSICS',6));
                                    $("#sub6").append(new Option('CHEMISTRY',7));
                                    $("#sub6p2").append(new Option('CHEMISTRY',7));
                                }
                                function Hum_Deaf_Subjects()
                                {
                                    //alert(isElec);
                                    var NationalityVal = $("input[name=nationality]:checked").val();
                                    console.log(NationalityVal);
                                    $('#sub1').empty();
                                    $('#sub1p2').empty();
                                    if(NationalityVal == "1")
                                    {
                                        console.log("Hi Pakistani ");
                                        $.each(sub1_Pak_options, function(val, text) {
                                            $('#sub1').append( new Option(text,val) );
                                            $('#sub1p2').append( new Option(text,val) );
                                        }); 
                                    }
                                    else if (NationalityVal == "2")
                                    {
                                        console.log("Hi Foreigner Welcom to Pakistan :) ");
                                        $.each(sub1_NonPak_options, function(val, text) {
                                            $('#sub1').append( new Option(text,val) );
                                            $('#sub1p2').append( new Option(text,val) );
                                        }); 
                                    }
                                    $('#sub2').empty();
                                    $('#sub2p2').empty();
                                    $("#sub2").prepend('<option selected="selected" value="2">ENGLISH</option>');
                                    $("#sub2p2").prepend('<option selected="selected" value="2">ENGLISH</option>');
                                    // Check Religion and select sub........
                                    $("#sub3").empty();
                                    $("#sub3p2").empty();
                                    var Religion = $("input[name=religion]:checked").val();



                                    if(Religion == "1")
                                    {

                                        $.each(sub3_Muslim,function(val,text){
                                            $("#sub3").empty();
                                            $("#sub3p2").empty();
                                            $("#sub3").append(new Option(text,val));
                                            $("#sub3p2").append(new Option(text,val));
                                        });
                                    }
                                    else if(Religion == "2")
                                    {
                                        $.each(sub3_Non_Muslim,function(val,text){
                                            $("#sub3").append(new Option(text,val));
                                            $("#sub3p2").append(new Option(text,val));
                                            //$("#sub3").prop('selectedIndex', 2);
                                        });
                                    }
                                    $("#sub8").empty();
                                    $("#sub8p2").empty();
                                    $("#sub8").prepend('<option selected="selected" value="4">PAKISTAN STUDIES</option>');
                                    $("#sub8p2").prepend('<option selected="selected" value="4">PAKISTAN STUDIES</option>');

                                    $("#sub4").empty();
                                    $("#sub4p2").empty();

                                    $("#sub5").empty();
                                    $("#sub5p2").empty();
                                    $("#sub6").empty();
                                    $("#sub6p2").empty();
                                    $("#sub7").empty();
                                    $("#sub7p2").empty();
                                    // $("#sub8").empty();
                                    //  $("#sub8p2").empty();
                                }
                                var langascd = ['22','23','36','34','35'];

                                // sub 1 change event 
                                $("#sub1").change(function(){
                                    var sel_sub =$("#sub1").val();
                                    $("#sub1p2").val(sel_sub);
                                });
                                $("#sub1p2").change(function(){
                                    var sel_sub =$("#sub1p2").val();
                                    $("#sub1").val(sel_sub);
                                });
                                // sub 2 change event 
                                $("#sub2").change(function(){
                                    var sel_sub =$("#sub2").val();
                                    $("#sub2p2").val(sel_sub);
                                });
                                $("#sub2p2").change(function(){
                                    var sel_sub =$("#sub2p2").val();
                                    $("#sub2").val(sel_sub);
                                });
                                // sub 3 change event 
                                $("#sub3").change(function(){
                                    var sel_sub =$("#sub3").val();
                                    $("#sub3p2").val(sel_sub);
                                });
                                $("#sub3p2").change(function(){
                                    var sel_sub =$("#sub3p2").val();
                                    $("#sub3").val(sel_sub);
                                });
                                // sub 4 change event 
                                $("#sub4").change(function(){
                                    var sel_sub =$("#sub4").val();
                                    $("#sub4p2").val(sel_sub);
                                });
                                $("#sub4p2").change(function(){
                                    var sel_sub =$("#sub4p2").val();
                                    $("#sub4").val(sel_sub);
                                });
                                // sub 5 change event 
                                $("#sub5").change(function(){
                                    var sel_sub =$("#sub5").val();
                                    $("#sub5p2").val(sel_sub);
                                });
                                $("#sub5p2").change(function(){
                                    var sel_sub =$("#sub5p2").val();
                                    $("#sub5").val(sel_sub);
                                });
                                // sub 6 change event
                                $("#sub6").change(function(){
                                    // 
                                    var sub6 = $("#sub6").val();
                                    var sub6p2 = $("#sub6p2").val();
                                    var sub7 = $("#sub7").val();
                                    var sub7p2 = $("#sub7p2").val();
                                    var sub5 = $("#sub5").val();
                                    var sub5p2 = $("#sub5p2").val();
                                    // if(sub6 !=0 || sub7 != 0 || sub8 != 0 || sub6p2 != 0 || sub7p2 != 0 || sub8p2 != 0)
                                    // {

                                    var a = langascd.indexOf(sub6);
                                    var b = langascd.indexOf(sub6p2);
                                    var d = langascd.indexOf(sub7);
                                    var c = langascd.indexOf(sub7p2);

                                    if(a >=0  && d>=0)
                                    {
                                        alertify.error("Please choose Different Subjects as Double Language is not allowed" );
                                        $("#sub6").val('0');
                                        $("#sub6p2").val('0');
                                        $("#sub6").focus();
                                        return;  
                                    }



                                    if((sub6 == sub7) || (sub6 == sub5))
                                    {
                                        alertify.error("Please choose Different Subjects" );
                                        $("#sub6").val('0');
                                        $("#sub6p2").val('0');
                                        return;
                                    }
                                    if((sub6 == sub7p2))
                                    {
                                        alertify.error("Please choose Different Subjects" );
                                        $("#sub6").val('0');
                                        $("#sub6p2").val('0');
                                        return;
                                    }
                                    if ((sub6 == 19 || sub6p2 == 19) && (sub7 == 20 || sub7p2== 20))
                                    {
                                        $('#ErrMsg').show(); 
                                        alertify.error('Please select One Subject from ADVANCED ISLAMIC STUDIES / ISLAMIC HISTORY / MUSLIM HISTORY ');                   
                                        $("#sub6").val('0');
                                        $("#sub6p2").val('0');
                                        $("#sub6").focus();
                                        return;  
                                    }    
                                    if((sub7 == 20 && sub6 == 21) || (sub7 == 19 && sub6 == 20) || (sub7 == 19 && sub6 == 21) || (sub7 == 20 && sub6 == 19) || (sub7 == 21 && sub6 == 19)|| (sub7p2 == 20 && sub6p2 == 21) || (sub7p2 == 21 && sub6p2 == 20)  || (sub7p2 == 19 && sub6p2 == 20) || (sub7p2 == 19 && sub6p2 == 21) || (sub7p2 == 20 && sub6p2 == 19) || (sub7p2 == 21 && sub6p2 == 19))
                                    {
                                        alertify.error("Please choose Different Subjects as Double History is not allowed" );
                                        $("#sub6").val('0');
                                        $("#sub6p2").val('0');
                                        $("#sub6").focus();
                                        return;
                                    }         
                                    // }
                                    $("#sub6p2").val(sub6);
                                })
                                $("#sub6p2").change(function(){
                                    var sub6 = $("#sub6").val();
                                    var sub6p2 = $("#sub6p2").val();
                                    var sub7 = $("#sub7").val();
                                    var sub7p2 = $("#sub7p2").val();
                                    var sub5 = $("#sub5").val();
                                    var sub5p2 = $("#sub5p2").val();
                                    var ddlMarksImproveoptions = $("#ddlMarksImproveoptions").val();
                                    ////
                                    //   debugger;
                                    var a = langascd.indexOf(sub6);
                                    var b = langascd.indexOf(sub6p2);
                                    var d = langascd.indexOf(sub7);
                                    var c = langascd.indexOf(sub7p2);

                                    if(b >=0  && d>=0)
                                    {
                                        alertify.error("Please choose Different Subjects as Double Language is not allowed" );
                                        $("#sub6").val('0');
                                        $("#sub6p2").val('0');
                                        $("#sub6").focus();
                                        return;  
                                    }


                                    if((sub6p2 == sub7) || (sub6p2 == sub5) )
                                    {
                                        alertify.error("Please choose Different Subjects" );
                                        $("#sub6").val('0');
                                        $("#sub6p2").val('0');
                                        return;
                                    }
                                    if((sub6p2 == sub7p2))
                                    {
                                        alertify.error("Please choose Different Subjects" );
                                        $("#sub6").val('0');
                                        $("#sub6p2").val('0');
                                        return;
                                    }
                                    if ((sub6 == 19 || sub6p2 == 19) && (sub7 == 20 || sub7p2== 20))
                                    {
                                        $('#ErrMsg').show(); 
                                        alertify.error('Please select One Subject from ADVANCED ISLAMIC STUDIES / ISLAMIC HISTORY / MUSLIM HISTORY ');                   
                                        $("#sub6").val('0');
                                        $("#sub6p2").val('0');
                                        $("#sub6").focus();
                                        return;  
                                    }   


                                    if((sub7 == 20 && sub6 == 21) || (sub7 == 19 && sub6 == 20) || (sub7 == 19 && sub6 == 21) || (sub7 == 20 && sub6 == 19) || (sub7 == 21 && sub6 == 19)|| (sub7p2 == 20 && sub6p2 == 21) || (sub7p2 == 21 && sub6p2 == 20)  || (sub7p2 == 19 && sub6p2 == 20) || (sub7p2 == 19 && sub6p2 == 21) || (sub7p2 == 20 && sub6p2 == 19) || (sub7p2 == 21 && sub6p2 == 19)){
                                        alertify.error("Please choose Different Subjects as Double History is not allowed" );
                                        $("#sub6").val('0');
                                        $("#sub6p2").val('0');
                                        $("#sub6").focus();
                                        return;
                                    }         
                                    $("#sub6").val(sub6p2);
                                    // $("#sub6p2").append(new Option('COMPUTER SCIENCE',78));
                                    //   console.log('Hi i am sub6 dropdown :) ');
                                })
                                $("#sub7").change(function(){
                                    //
                                    //   console.log('Hi i am sub7 dropdown :) ');
                                    var sub6 = $("#sub6").val();
                                    var sub7 = $("#sub7").val();
                                    var sub5 = $("#sub5").val();

                                    var a = langascd.indexOf(sub6);
                                    var d = langascd.indexOf(sub7);

                                    if(a >=0  && d>=0)
                                    {
                                        alertify.error("Please choose Different Subjects as Double Language is not allowed" );
                                        $("#sub7").val('0');
                                        $("#sub7p2").val('0');
                                        $("#sub7").focus();
                                        return;  
                                    }


                                    // console.log("sub7 = "+ sub7 + "  sub8 = "+ sub8);
                                    if( (sub7 == sub6)|| (sub7 == sub5))
                                    {
                                        alertify.error("Please choose Different Subjects" );
                                        $("#sub7").val('0');
                                        $("#sub7p2").val('0');
                                        return;
                                    }
                                    if((sub7 == 20 && sub6 == 21) || (sub7 == 21 && sub6 == 20)  || (sub7 == 19 && sub6 == 20) || (sub7 == 19 && sub6 == 21) || (sub7 == 20 && sub6 == 19) || (sub7 == 21 && sub6 == 19)|| (sub7p2 == 20 && sub6p2 == 21) || (sub7p2 == 21 && sub6p2 == 20)  || (sub7p2 == 19 && sub6p2 == 20) || (sub7p2 == 19 && sub6p2 == 21) || (sub7p2 == 20 && sub6p2 == 19) || (sub7p2 == 21 && sub6p2 == 19)){
                                        alertify.error("Please choose Different Subjects as Double History is not allowed" );
                                        $("#sub7p2").val('0');
                                        $("#sub7").val('0');
                                        return;
                                    }
                                    var valtext = 0;
                                    for(var i =0 ; i<langascd.length; i++)
                                    {
                                        if(sub5 == langascd[i])
                                        {
                                            valtext =1;
                                        }
                                    }
                                    if(valtext>0)
                                    {
                                        alertify.error("Please choose Different Subjects as Double Language is not allowed" );
                                        $("#sub7").val('0');  
                                        $("#sub7p2").val('0');  
                                        return;
                                    }
                                    if ((sub6 == 19 ) && (sub7 == 20) ||(sub6 == 20 ) && (sub7 == 19))
                                    {
                                        $('#ErrMsg').show(); 
                                        alertify.error('Please select One Subject from ADVANCED ISLAMIC STUDIES / ISLAMIC HISTORY / MUSLIM HISTORY ');                   
                                        $("#sub7").val('0');
                                        $("#sub7p2").val('0');
                                        $("#sub7").focus();
                                        return;  
                                    }    
                                    $("#sub7p2").val(sub7);
                                })
                                $("#sub7p2").change(function(){
                                    // 
                                    //console.log('Hi i am sub7 dropdown :) ');
                                    var sub6 = $("#sub6").val();
                                    var sub6p2 = $("#sub6p2").val();
                                    var sub7 = $("#sub7").val();
                                    var sub7p2 = $("#sub7p2").val();
                                    var sub5 = $("#sub5").val();
                                    var sub5p2 = $("#sub5p2").val();
                                    //console.log("sub7 = "+ sub7 + "  sub8 = "+ sub8);

                                    var a = langascd.indexOf(sub6);
                                    var b = langascd.indexOf(sub6p2);
                                    var d = langascd.indexOf(sub7);
                                    var c = langascd.indexOf(sub7p2);

                                    if(a >=0  && c>=0)
                                    {
                                        alertify.error("Please choose Different Subjects as Double Language is not allowed" );
                                        $("#sub7").val('0');
                                        $("#sub7p2").val('0');
                                        $("#sub7").focus();
                                        return;  
                                    }


                                    if((sub7p2 == sub6)|| (sub7p2 == sub6) || (sub7p2 == sub6p2) || (sub7p2 == sub6p2)|| (sub7p2 == sub5p2))
                                    {
                                        alertify.error("Please choose Different Subjects" );
                                        $("#sub7p2").val('0');
                                        $("#sub7").val('0');
                                        return;
                                    }
                                    if((sub7 == 20 && sub6 == 21) || (sub7 == 21 && sub6 == 20)  || (sub7 == 19 && sub6 == 20) || (sub7 == 19 && sub6 == 21) || (sub7 == 20 && sub6 == 19) || (sub7 == 21 && sub6 == 19)|| (sub7p2 == 20 && sub6p2 == 21) || (sub7p2 == 21 && sub6p2 == 20)  || (sub7p2 == 19 && sub6p2 == 20) || (sub7p2 == 19 && sub6p2 == 21) || (sub7p2 == 20 && sub6p2 == 19) || (sub7p2 == 21 && sub6p2 == 19)){
                                        alertify.error("Please choose Different Subjects as Double History is not allowed" );
                                        $("#sub7p2").val('0');
                                        $("#sub7").val('0');
                                        return;
                                    }
                                    var valtext = 0;
                                    var doublelang=0;
                                    for(var i =0 ; i<langascd.length; i++)
                                    {
                                        if((sub6) == langascd[i])
                                        {
                                            doublelang++;
                                        }
                                        if((sub7) == langascd[i])
                                        {
                                            doublelang++;
                                        }


                                    }
                                    if(doublelang>1)
                                    {
                                        valtext = 1; 
                                    }
                                    if(valtext>0)
                                    {
                                        alertify.error("Please choose Different Subjects as Double Language is not allowed" );
                                        $("#sub7").val('0');  
                                        $("#sub7p2").val('0');  
                                        return;
                                    }
                                    if ((sub6 == 19 || sub6p2 == 19) && (sub7 == 20 || sub7p2== 20))
                                    {
                                        $('#ErrMsg').show(); 
                                        alertify.error('Please select One Subject from ADVANCED ISLAMIC STUDIES / ISLAMIC HISTORY / MUSLIM HISTORY ');                   
                                        $("#sub7").val('0');
                                        $("#sub7p2").val('0');
                                        $("#sub7").focus();
                                        return;  
                                    }    
                                    $("#sub7").val(sub7p2);
                                })
                                $("#sub5").change(function(){

                                    //   console.log('Hi i am sub8 dropdown :) ');
                                    var sub6 = $("#sub6").val();
                                    var sub5 = $("#sub5").val();
                                    var sub7 = $("#sub7").val();

                                    var a = langascd.indexOf(sub6);
                                    var d = langascd.indexOf(sub7);

                                    if(a >=0  && d>=0)
                                    {
                                        alertify.error("Please choose Different Subjects as Double Language is not allowed" );
                                        $("#sub5").val('0');
                                        $("#sub5p2").val('0');
                                        $("#sub5").focus();
                                        return;  
                                    }


                                    // console.log("sub8 = "+ sub8 + "  sub8 = "+ sub8);
                                    if( (sub5 == sub6)||(sub5 == sub7))
                                    {
                                        alertify.error("Please choose Different Subjects" );
                                        $("#sub5").val('0');
                                        $("#sub5p2").val('0');
                                        return;
                                    }
                                    if((sub5 == 20 && sub6 == 21) || (sub5 == 21 && sub6 == 20)  || (sub5 == 19 && sub6 == 20) || (sub5 == 19 && sub6 == 21) || (sub5 == 20 && sub6 == 19) || (sub5 == 21 && sub6 == 19)|| (sub5p2 == 20 && sub6p2 == 21) || (sub5p2 == 21 && sub6p2 == 20)  || (sub5p2 == 19 && sub6p2 == 20) || (sub5p2 == 19 && sub6p2 == 21) || (sub5p2 == 20 && sub6p2 == 19) || (sub5p2 == 21 && sub6p2 == 19)){
                                        alertify.error("Please choose Different Subjects as Double History is not allowed" );
                                        $("#sub5p2").val('0');
                                        $("#sub5").val('0');
                                        return;
                                    }
                                    var valtext = 0;
                                    for(var i =0 ; i<langascd.length; i++)
                                    {
                                        if(sub5 == langascd[i])
                                        {
                                            valtext =1;
                                        }
                                    }
                                    if(valtext>0)
                                    {
                                        alertify.error("Please choose Different Subjects as Double Language is not allowed" );
                                        $("#sub5").val('0');  
                                        $("#sub5p2").val('0');  
                                        return;
                                    }
                                    if ((sub6 == 19 ) && (sub5 == 20) ||(sub6 == 20 ) && (sub5 == 19))
                                    {
                                        $('#ErrMsg').show(); 
                                        alertify.error('Please select One Subject from ADVANCED ISLAMIC STUDIES / ISLAMIC HISTORY / MUSLIM HISTORY ');                   
                                        $("#sub5").val('0');
                                        $("#sub5p2").val('0');
                                        $("#sub5").focus();
                                        return;  
                                    }    
                                    $("#sub5p2").val(sub5);
                                })
                                $("#sub5p2").change(function(){
                                    // 
                                    //console.log('Hi i am sub5 dropdown :) ');
                                    var sub6 = $("#sub6").val();
                                    var sub6p2 = $("#sub6p2").val();
                                    var sub5 = $("#sub5").val();
                                    var sub5p2 = $("#sub5p2").val();
                                    var sub7 = $("#sub7").val();
                                    var sub7p2 = $("#sub7p2").val();
                                    //console.log("sub5 = "+ sub5 + "  sub5 = "+ sub5);

                                    var a = langascd.indexOf(sub6);
                                    var b = langascd.indexOf(sub6p2);
                                    var d = langascd.indexOf(sub5);
                                    var c = langascd.indexOf(sub5p2);

                                    if(a >=0  && d>=0)
                                    {
                                        alertify.error("Please choose Different Subjects as Double Language is not allowed" );
                                        $("#sub5").val('0');
                                        $("#sub5p2").val('0');
                                        $("#sub5").focus();
                                        return;  
                                    }


                                    if((sub5p2 == sub6)|| (sub5p2 == sub6) || (sub5p2 == sub6p2) || (sub5p2 == sub6p2))
                                    {
                                        alertify.error("Please choose Different Subjects" );
                                        $("#sub5p2").val('0');
                                        $("#sub5").val('0');
                                        return;
                                    }
                                    if((sub7 == 20 && sub6 == 21) || (sub7 == 21 && sub6 == 20)  || (sub7 == 19 && sub6 == 20) || (sub7 == 19 && sub6 == 21) || (sub7 == 20 && sub6 == 19) || (sub7 == 21 && sub6 == 19)|| (sub7p2 == 20 && sub6p2 == 21) || (sub7p2 == 21 && sub6p2 == 20)  || (sub7p2 == 19 && sub6p2 == 20) || (sub7p2 == 19 && sub6p2 == 21) || (sub7p2 == 20 && sub6p2 == 19) || (sub7p2 == 21 && sub6p2 == 19)){
                                        alertify.error("Please choose Different Subjects as Double History is not allowed" );
                                        $("#sub7p2").val('0');
                                        $("#sub7").val('0');
                                        return;
                                    }
                                    var valtext = 0;
                                    var doublelang=0;
                                    for(var i =0 ; i<langascd.length; i++)
                                    {
                                        if((sub6) == langascd[i])
                                        {
                                            doublelang++;
                                        }
                                        if((sub7) == langascd[i])
                                        {
                                            doublelang++;
                                        }


                                    }
                                    if(doublelang>1)
                                    {
                                        valtext = 1; 
                                    }
                                    if(valtext>0)
                                    {
                                        alertify.error("Please choose Different Subjects as Double Language is not allowed" );
                                        $("#sub7").val('0');  
                                        $("#sub7p2").val('0');  
                                        return;
                                    }
                                    if ((sub6 == 19 || sub6p2 == 19) && (sub7 == 20 || sub7p2== 20))
                                    {
                                        $('#ErrMsg').show(); 
                                        alertify.error('Please select One Subject from ADVANCED ISLAMIC STUDIES / ISLAMIC HISTORY / MUSLIM HISTORY ');                   
                                        $("#sub7").val('0');
                                        $("#sub7p2").val('0');
                                        $("#sub7").focus();
                                        return;  
                                    }    
                                    $("#sub5").val(sub5p2);
                                })
                                $("#sub8").change(function(){
                                    var sel_sub =$("#sub8").val();
                                    $("#sub8p2").val(sel_sub);
                                });
                                $("#sub8p2").change(function(){
                                    var sel_sub =$("#sub8p2").val();
                                    $("#sub8").val(sel_sub);
                                });
                                /*$("#sub8").change(function(){

                                var sub6 = $("#sub6").val();
                                var sub6p2 = $("#sub6p2").val();
                                var sub7 = $("#sub7").val();
                                var sub7p2 = $("#sub7p2").val();
                                var sub8 = $("#sub8").val();
                                var sub8p2 = $("#sub8p2").val();
                                console.log("sub7 = "+ sub7 + "  sub8 = "+ sub8);
                                if((sub7 == sub8)|| (sub8 == sub6))
                                {
                                alertify.error("Please choose Different Subjects" );
                                $("#sub8").val('0');
                                $("#sub8p2").val('0');


                                return;
                                }
                                if((sub7 == 20 && sub8 == 21) || (sub7 == 21 && sub8 == 20)  || (sub7 == 19 && sub8 == 20) || (sub7 == 19 && sub8 == 21) || (sub7 == 20 && sub8 == 19) || (sub7 == 21 && sub8 == 19)){
                                alertify.error("Please choose Different Subjects as Double History is not allowed" );
                                $("#sub8").val('0');
                                $("#sub8p2").val('0');

                                return;
                                }
                                var valtext = 0;
                                var doublelang=0;
                                for(var i =0 ; i<langascd.length; i++)
                                {
                                if((sub8) == langascd[i])
                                {
                                doublelang++;
                                }
                                if((sub7) == langascd[i])
                                {
                                doublelang++;
                                }


                                }
                                if(doublelang>1)
                                {
                                valtext = 1; 
                                }
                                if(valtext>0)
                                {
                                alertify.error("Please choose Different Subjects as Double Language is not allowed" );
                                $("#sub8").val('0');  
                                $("#sub8p2").val('0');  
                                return;
                                }
                                $("#sub8p2").val(sub8);

                                })
                                $("#sub8p2").change(function(){

                                var sub6 = $("#sub6").val();
                                var sub6p2 = $("#sub6p2").val();
                                var sub7 = $("#sub7").val();
                                var sub7p2 = $("#sub7p2").val();
                                var sub8 = $("#sub8").val();
                                var sub8p2 = $("#sub8p2").val();

                                if((sub8p2 == sub6)|| (sub7p2 == sub8p2)|| (sub8p2 == sub6p2))
                                {
                                alertify.error("Please choose Different Subjects" );
                                $("#sub8p2").val('0');
                                $("#sub8").val('0');

                                return;
                                }
                                if((sub7 == 20 && sub8 == 21) || (sub7 == 21 && sub8 == 20)  || (sub7 == 19 && sub8 == 20) || (sub7 == 19 && sub8 == 21) || (sub7 == 20 && sub8 == 19) || (sub7 == 21 && sub8 == 19)){
                                alertify.error("Please choose Different Subjects as Double History is not allowed" );
                                $("#sub8p2").val('0');
                                $("#sub8").val('0');

                                return;
                                }
                                var valtext = 0;
                                for(var i =0 ; i<langascd.length; i++)
                                {
                                if(sub8p2 == langascd[i])
                                {
                                valtext =1;
                                }
                                }
                                if(valtext>0)
                                {
                                alertify.error("Please choose Different Subjects as Double Language is not allowed" );
                                $("#sub8").val('0');  
                                $("#sub8p2").val('0');  
                                return;
                                }
                                $("#sub8").val(sub8p2);
                                })    */
                                function IsFullAppear(){
                                    $("#sub1").empty();
                                    $("#sub1").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
                                    $("#sub1 option[value='" + sub1 + "']").attr("selected","selected");

                                    $("#sub1p2").empty();
                                    $("#sub1p2").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
                                    $("#sub1p2 option[value='" + sub1 + "']").attr("selected","selected");
                                    /* }
                                    else
                                    {   $("#sub1").empty();
                                    $("#sub1").append('<option value="0">NONE</option>');
                                    } */
                                    // Subject 2 
                                    /* if((sub2pf1 == "1"))
                                    {*/
                                    $("#sub2").empty();
                                    $("#sub2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
                                    $("#sub2 option[value='" + sub2 + "']").attr("selected","selected");

                                    $("#sub2p2").empty();
                                    $("#sub2p2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
                                    $("#sub2p2 option[value='" + sub2 + "']").attr("selected","selected");
                                    /* }
                                    else
                                    {
                                    $("#sub2").empty();
                                    $("#sub2").append('<option value="0">NONE</option>');
                                    }      */
                                    // subject 3 
                                    /* if((sub3pf1 == "1"))
                                    {*/
                                    $("#sub3").empty();
                                    $("#sub3").append(new Option('<?php  echo  array_search($data[0]['sub3'],$subarray); ?>',sub3));
                                    $("#sub3 option[value='" + sub3 + "']").attr("selected","selected");

                                    $("#sub3p2").empty();
                                    $("#sub3p2").append(new Option('<?php  echo  array_search($data[0]['sub3'],$subarray); ?>',sub3));
                                    $("#sub3p2 option[value='" + sub3 + "']").attr("selected","selected");

                                    $("#sub8").empty();
                                    $("#sub8").append(new Option('<?php  echo  array_search($data[0]['sub8'],$subarray); ?>',sub8));
                                    $("#sub8 option[value='" + sub8 + "']").attr("selected","selected");


                                    $("#sub8p2").empty();
                                    $("#sub8p2").append(new Option('<?php  echo  array_search($data[0]['sub8'],$subarray); ?>',sub8));
                                    $("#sub8p2 option[value='" + sub8 + "']").attr("selected","selected");                                    

                                    $("#sub4").empty();
                                    $("#sub4").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));
                                    $("#sub4 option[value='" + sub4 + "']").attr("selected","selected");

                                    $("#sub4p2").empty();
                                    $("#sub4p2").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));
                                    $("#sub4p2 option[value='" + sub4 + "']").attr("selected","selected");

                                    $("#sub5").empty();
                                    $("#sub5").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
                                    $("#sub5 option[value='" + sub5 + "']").attr("selected","selected");

                                    $("#sub5p2").empty();
                                    $("#sub5p2").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
                                    $("#sub5p2 option[value='" + sub5 + "']").attr("selected","selected");

                                    $("#sub6").empty();
                                    $("#sub6").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));
                                    $("#sub6 option[value='" + sub1 + "']").attr("selected","selected");

                                    $("#sub6p2").empty();
                                    $("#sub6p2").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));
                                    $("#sub6p2 option[value='" + sub1 + "']").attr("selected","selected");

                                    $("#sub7").empty();
                                    $("#sub7").append(new Option('<?php  echo  array_search($data[0]['sub7'],$subarray); ?>',sub7));
                                    $("#sub7 option[value='" + sub7 + "']").attr("selected","selected");

                                    $("#sub7p2").empty();
                                    $("#sub7p2").append(new Option('<?php  echo  array_search($data[0]['sub7'],$subarray); ?>',sub7));
                                    $("#sub7p2 option[value='" + sub7 + "']").attr("selected","selected");
                                }
                                $("#isfullAppear").change( function(){

                                    //alert("hi i am called :) ");
                                    var old_exam =  $('#oldexam_type').val();
                                    var crnt_exam =  $('#exam_type').val();
                                    if(this.checked)
                                    {


                                        if(crnt_exam == 4 || crnt_exam == 5 || crnt_exam == 6 || crnt_exam == 3)
                                        {
                                            $('#oldexam_type').val(crnt_exam)
                                            $('#exam_type').val(2)
                                        }

                                        IsFullAppear();    
                                    }
                                    else{

                                        if(crnt_exam == 2 && (old_exam == 4 || old_exam == 5 || old_exam == 6 ||  old_exam == 3))
                                        {
                                            $('#oldexam_type').val(2)
                                            $('#exam_type').val(old_exam)
                                        }
                                        sub_grp_load();
                                    }

                                })
                                //Category P-1: MARKS IMPROVEMENT
                                function sub_grp_load(){
                                    //debugger;
                                    <?php 
                                    // DebugBreak();
                                    if($exam_type == 14 || ($cattype == 1 && $exam_type == 16)){
                                        echo "$('#lblpart1cat').text('Category P-1: MARKS IMPROVEMENT')
                                        $('#lblpart2cat').text('Category P-2: MARKS IMPROVEMENT')";    
                                    }
                                    if($exam_type == 15 || ($exam_type == 16 && $cattype == 2)){
                                        echo"$('#lblpart1cat').text('Category P-1: ADDITIONAL')
                                        $('#lblpart2cat').text('Category P-2: ADDITIONAL')";  
                                    }
                                    ?>

                                    // 
                                    // check Pass Fail status first
                                    var ex_type= '<?php echo $data[0]['exam_type']; ?>'
                                    if((sub1pf1 == "3") || (sub1st1 == "2"))
                                    {
                                        $("#sub1").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
                                        $("#sub1 option[value='" + sub1 + "']").attr("selected","selected");
                                    }
                                    else
                                    {   $("#sub1").empty();
                                        $("#sub1").append('<option value="0">NONE</option>');
                                    }
                                    if((sub1pf2 == "3") || (sub1st2 == "2") || ex_type==3 || ex_type==1)
                                    {
                                        $("#sub1p2").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
                                        $("#sub1p2 option[value='" + sub1 + "']").attr("selected","selected");
                                        //$("#sub1p2").append('<option value='+sub1p2+'>'+sub1p2+'</option>');
                                    }
                                    else
                                    {   $("#sub1p2").empty();
                                        $("#sub1p2").append('<option value="0">NONE</option>');
                                    }
                                    // Subject 2 
                                    if((sub2pf1 == "3") || (sub2st1 == "2") )
                                    {
                                        $("#sub2").empty();
                                        $("#sub2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
                                        $("#sub2 option[value='" + sub2 + "']").attr("selected","selected");
                                    }
                                    else
                                    {
                                        $("#sub2").empty();
                                        $("#sub2").append('<option value="0">NONE</option>');
                                    }
                                    if((sub2pf2 == "3") || (sub2st2 == "2") || ex_type==3 || ex_type==1)
                                    {
                                        $("#sub2p2").empty();
                                        $("#sub2p2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
                                        $("#sub2p2 option[value='" + sub2 + "']").attr("selected","selected");
                                    }
                                    else
                                    {
                                        $("#sub2p2").empty();
                                        $("#sub2p2").append('<option value="0">NONE</option>');
                                    }
                                    // subject 3 
                                    if((sub3pf1 == "3") || (sub3st1 == "2"))
                                    {
                                        $("#sub3").empty();
                                        $("#sub3").append(new Option('<?php  echo  array_search($data[0]['sub3'],$subarray); ?>',sub3));
                                        $("#sub3 option[value='" + sub3 + "']").attr("selected","selected");
                                    }
                                    else
                                    {
                                        $("#sub3").empty();
                                        $("#sub3").append('<option value="0">NONE</option>');
                                    }
                                    if((sub3pf2 == "3") || (sub3st2 == "2") || ex_type==3 || ex_type==1)
                                    {
                                        $("#sub3p2").empty();
                                        $("#sub3p2").append(new Option('<?php  echo  array_search($data[0]['sub3'],$subarray); ?>',sub3));
                                        $("#sub3p2 option[value='" + sub3 + "']").attr("selected","selected");
                                    }
                                    else
                                    {
                                        $("#sub3p2").empty();
                                        $("#sub3p2").append('<option value="0">NONE</option>');
                                    }
                                    if((sub4pf1 == "3") || (sub4st1 == "2"))
                                    {
                                        $("#sub4").empty();
                                        $("#sub4").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));
                                        $("#sub4 option[value='" + sub4 + "']").attr("selected","selected");
                                    }
                                    else
                                    {
                                        $("#sub4").empty();
                                        $("#sub4").append('<option value="0">NONE</option>');
                                    }
                                    if((sub4pf2 == "3") || (sub4st2 == "2") || ex_type==3 || ex_type==1)
                                    {
                                        $("#sub4p2").empty();
                                        $("#sub4p2").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));
                                        $("#sub4p2 option[value='" + sub4 + "']").attr("selected","selected");
                                    }
                                    else
                                    {
                                        $("#sub4p2").empty();
                                        $("#sub4p2").append('<option value="0">NONE</option>');
                                    }
                                    if((sub5pf1 == "3") || (sub5st1 == "2"))
                                    {
                                        $("#sub5").empty();
                                        $("#sub5").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
                                        $("#sub5 option[value='" + sub5 + "']").attr("selected","selected");
                                    }
                                    else
                                    {
                                        $("#sub5").empty();
                                        $("#sub5").append('<option value="0">NONE</option>');
                                    }
                                    if((sub5pf2 == "3") || (sub5st2 == "2") || ex_type==3 || ex_type==1)
                                    {
                                        $("#sub5p2").empty();
                                        $("#sub5p2").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
                                        $("#sub5p2 option[value='" + sub5 + "']").attr("selected","selected");
                                    }
                                    else
                                    {
                                        $("#sub5p2").empty();
                                        $("#sub5p2").append('<option value="0">NONE</option>');
                                    }
                                    if((sub6pf1 == "3") || (sub6st1 == "2"))
                                    {
                                        $("#sub6").empty();
                                        $("#sub6").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));
                                        $("#sub6 option[value='" + sub1 + "']").attr("selected","selected");
                                    }
                                    else
                                    {
                                        $("#sub6").empty();
                                        $("#sub6").append('<option value="0">NONE</option>');
                                    }
                                    if((sub6pf2 == "3") || (sub6st2 == "2") || ex_type==3 || ex_type==1)
                                    {
                                        $("#sub6p2").empty();
                                        $("#sub6p2").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));
                                        $("#sub6p2 option[value='" + sub6 + "']").attr("selected","selected");
                                    }
                                    else
                                    {
                                        $("#sub6p2").empty();
                                        $("#sub6p2").append('<option value="0">NONE</option>');
                                    }
                                    if((sub7pf1 == "3") || (sub7st1 == "2"))
                                    {
                                        $("#sub7").empty();
                                        $("#sub7").append(new Option('<?php  echo  array_search($data[0]['sub7'],$subarray); ?>',sub7));
                                        $("#sub7 option[value='" + sub7 + "']").attr("selected","selected");
                                    }
                                    else
                                    {
                                        $("#sub7").empty();
                                        $("#sub7").append('<option value="0">NONE</option>');
                                    }
                                    if((sub7pf2 == "3") || (sub7st2 == "2") || ex_type==3 || ex_type==1)
                                    {
                                        $("#sub7p2").empty();
                                        $("#sub7p2").append(new Option('<?php  echo  array_search($data[0]['sub7'],$subarray); ?>',sub7));
                                        $("#sub7p2 option[value='" + sub7 + "']").attr("selected","selected");
                                    }
                                    else
                                    {
                                        $("#sub7p2").empty();
                                        $("#sub7p2").append('<option value="0">NONE</option>');
                                    }
                                    if((sub8pf1 == "3") || (sub8st1 == "2"))
                                    {
                                        $("#sub8").empty();
                                        $("#sub8").append(new Option('<?php  echo  array_search($data[0]['sub8'],$subarray); ?>',sub8));
                                        $("#sub8 option[value='" + sub8 + "']").attr("selected","selected");
                                    }
                                    else
                                    {
                                        $("#sub8").empty();
                                        $("#sub8").append('<option value="0">NONE</option>');
                                    }
                                    if((sub8pf2 == "3") || (sub8st2 == "2") || ex_type==3 || ex_type==1)
                                    {
                                        $("#sub8p2").empty();
                                        $("#sub8p2").append(new Option('<?php  echo  array_search($data[0]['sub8'],$subarray); ?>',sub8));
                                        $("#sub8p2 option[value='" + sub8 + "']").attr("selected","selected");
                                    }
                                    else
                                    {
                                        $("#sub8p2").empty();
                                        $("#sub8p2").append('<option value="0">NONE</option>');
                                    }
                                    // PART II Subjects ....... 
                                }

                                function sub_grp_load_forexamtype2(){
                                    //
                                    <?php 
                                    if($exam_type == 14 || ($cattype == 1 && $exam_type == 16)){
                                        echo "$('#lblpart1cat').text('Category P-1: MARKS IMPROVEMENT')
                                        $('#lblpart2cat').text('Category P-2: MARKS IMPROVEMENT')";    
                                    }
                                    if($exam_type == 15 || ($exam_type == 16 && $cattype == 2)){
                                        echo"$('#lblpart1cat').text('Category P-1: ADDITIONAL')
                                        $('#lblpart2cat').text('Category P-2: ADDITIONAL')";  
                                    }
                                    ?>



                                    $("#sub1").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
                                    $("#sub1 option[value='" + sub1 + "']").attr("selected","selected");

                                    $("#sub1p2").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
                                    $("#sub1p2 option[value='" + sub1 + "']").attr("selected","selected");
                                    //$("#sub1p2").append('<option value='+sub1p2+'>'+sub1p2+'</option>');

                                    $("#sub2").empty();
                                    $("#sub2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
                                    $("#sub2 option[value='" + sub2 + "']").attr("selected","selected");

                                    $("#sub2p2").empty();
                                    $("#sub2p2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
                                    $("#sub2p2 option[value='" + sub2 + "']").attr("selected","selected");

                                    $("#sub3").empty();
                                    $("#sub3").append(new Option('<?php  echo  array_search($data[0]['sub3'],$subarray); ?>',sub3));
                                    $("#sub3 option[value='" + sub3 + "']").attr("selected","selected");

                                    $("#sub3p2").empty();
                                    $("#sub3p2").append(new Option('<?php  echo  array_search($data[0]['sub3'],$subarray); ?>',sub3));
                                    $("#sub3p2 option[value='" + sub3 + "']").attr("selected","selected");

                                    $("#sub4").empty();
                                    $("#sub4").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));
                                    $("#sub4 option[value='" + sub4 + "']").attr("selected","selected");

                                    $("#sub4p2").empty();
                                    $("#sub4p2").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));
                                    $("#sub4p2 option[value='" + sub4 + "']").attr("selected","selected");

                                    $("#sub5").empty();
                                    $("#sub5").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
                                    $("#sub5 option[value='" + sub5 + "']").attr("selected","selected");

                                    $("#sub5p2").empty();
                                    $("#sub5p2").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
                                    $("#sub5p2 option[value='" + sub5 + "']").attr("selected","selected");


                                    $("#sub6").empty();
                                    $("#sub6").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));
                                    $("#sub6 option[value='" + sub1 + "']").attr("selected","selected");


                                    $("#sub6p2").empty();
                                    $("#sub6p2").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));
                                    $("#sub6p2 option[value='" + sub6 + "']").attr("selected","selected");

                                    $("#sub7").empty();
                                    $("#sub7").append(new Option('<?php  echo  array_search($data[0]['sub7'],$subarray); ?>',sub7));
                                    $("#sub7 option[value='" + sub7 + "']").attr("selected","selected");



                                    $("#sub7p2").empty();
                                    $("#sub7p2").append(new Option('<?php  echo  array_search($data[0]['sub7'],$subarray); ?>',sub7));
                                    $("#sub7p2 option[value='" + sub7 + "']").attr("selected","selected");


                                    $("#sub8").empty();
                                    $("#sub8").append(new Option('<?php  echo  array_search($data[0]['sub8'],$subarray); ?>',sub8));
                                    $("#sub8 option[value='" + sub8 + "']").attr("selected","selected");



                                    $("#sub8p2").empty();
                                    $("#sub8p2").append(new Option('<?php  echo  array_search($data[0]['sub8'],$subarray); ?>',sub8));
                                    $("#sub8p2 option[value='" + sub8 + "']").attr("selected","selected");
                                }

                                function sub_grp_load_forexamtype2grp2(){
                                    <?php 
                                    if($exam_type == 14 || ($cattype == 1 && $exam_type == 16)){
                                        echo "$('#lblpart1cat').text('Category P-1: MARKS IMPROVEMENT')
                                        $('#lblpart2cat').text('Category P-2: MARKS IMPROVEMENT')";    
                                    }
                                    if($exam_type == 15 || ($exam_type == 16 && $cattype == 2)){
                                        echo"$('#lblpart1cat').text('Category P-1: ADDITIONAL')
                                        $('#lblpart2cat').text('Category P-2: ADDITIONAL')";  
                                    }
                                    ?>

                                    $("#sub1").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
                                    $("#sub1 option[value='" + sub1 + "']").attr("selected","selected");

                                    $("#sub1p2").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
                                    $("#sub1p2 option[value='" + sub1 + "']").attr("selected","selected");
                                    //$("#sub1p2").append('<option value='+sub1p2+'>'+sub1p2+'</option>');

                                    $("#sub2").empty();
                                    $("#sub2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
                                    $("#sub2 option[value='" + sub2 + "']").attr("selected","selected");

                                    $("#sub2p2").empty();
                                    $("#sub2p2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
                                    $("#sub2p2 option[value='" + sub2 + "']").attr("selected","selected");

                                    $("#sub3").empty();
                                    $("#sub3").append(new Option('<?php  echo  array_search($data[0]['sub3'],$subarray); ?>',sub3));
                                    $("#sub3 option[value='" + sub3 + "']").attr("selected","selected");

                                    $("#sub3p2").empty();
                                    $("#sub3p2").append(new Option('<?php  echo  array_search($data[0]['sub3'],$subarray); ?>',sub3));
                                    $("#sub3p2 option[value='" + sub3 + "']").attr("selected","selected");

                                    $("#sub4").empty();
                                    $("#sub4").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));
                                    $("#sub4 option[value='" + sub4 + "']").attr("selected","selected");

                                    $("#sub4p2").empty();
                                    $("#sub4p2").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));
                                    $("#sub4p2 option[value='" + sub4 + "']").attr("selected","selected");

                                    $("#sub5").empty();
                                    $("#sub5").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
                                    $("#sub5 option[value='" + sub5 + "']").attr("selected","selected");

                                    $("#sub5p2").empty();
                                    $("#sub5p2").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
                                    $("#sub5p2 option[value='" + sub5 + "']").attr("selected","selected");

                                    $("#sub6").empty();
                                    $("#sub6").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));
                                    $("#sub6 option[value='" + sub6 + "']").attr("selected","selected");

                                    $("#sub6p2").empty();
                                    $("#sub6p2").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));
                                    $("#sub6p2 option[value='" + sub6 + "']").attr("selected","selected");

                                    $("#sub7").empty();
                                    $("#sub7").append(new Option('<?php  echo  array_search($data[0]['sub7'],$subarray); ?>',sub7));
                                    $("#sub7 option[value='" + sub7 + "']").attr("selected","selected");

                                    $("#sub7p2").empty();
                                    $("#sub7p2").append(new Option('<?php  echo  array_search($data[0]['sub7'],$subarray); ?>',sub7));
                                    $("#sub7p2 option[value='" + sub7 + "']").attr("selected","selected");
                                    // var Gender = $("#gend").val();
                                    //  
                                    //console.log(Religion);


                                    /*$("#sub6").empty();
                                    $("#sub6p2").empty();
                                    */

                                    $.each(sub8_Hum,function(val,text){


                                        $("#sub6").append(new Option(text,val));
                                        $("#sub6p2").append(new Option(text,val));
                                    });
                                    if(Gender == "2")
                                    {
                                        $("#sub6").append(new Option('ELEMENTS OF HOME ECONOMICS',13));
                                        $("#sub6p2").append(new Option('ELEMENTS OF HOME ECONOMICS',13));

                                    }
                                    /* $("#sub7").empty();
                                    $("#sub7p2").empty(); */

                                    $.each(sub7_Hum,function(val,text){

                                        $("#sub7").append(new Option(text,val));
                                        $("#sub7p2").append(new Option(text,val));
                                    });
                                    if(Gender == "2")
                                    {
                                        $("#sub7").append(new Option('ELEMENTS OF HOME ECONOMICS',13));
                                        $("#sub7p2").append(new Option('ELEMENTS OF HOME ECONOMICS',13));
                                    }
                                    $("#sub8").empty();
                                    $("#sub8").append(new Option('<?php  echo  array_search($data[0]['sub8'],$subarray); ?>',sub8));
                                    $("#sub8 option[value='" + sub8 + "']").attr("selected","selected");

                                    $("#sub8p2").empty();
                                    $("#sub8p2").append(new Option('<?php  echo  array_search($data[0]['sub8'],$subarray); ?>',sub8));
                                    $("#sub8p2 option[value='" + sub8 + "']").attr("selected","selected");
                                    /* $.each(sub8_Hum,function(val,text){
                                    $("#sub8").append(new Option(text,val));
                                    $("#sub8p2").append(new Option(text,val));
                                    });*/

                                }

                                function additional_sub_grp_load(){
                                    //Category P-1: ADDITIONAL

                                    $('#lblpart1cat').text('Category P-1: ADDITIONAL')
                                    $('#lblpart2cat').text('Category P-2: ADDITIONAL');  

                                    //   debugger;
                                    $.each(additional_sub, function(val, text) {
                                        $('#sub1').hide();
                                        $('#sub1p2').hide();
                                        $('#sub2').hide();
                                        $('#sub2p2').hide();
                                        $('#sub3').hide();
                                        $('#sub3p2').hide();
                                        $('#sub4').hide();
                                        $('#sub4p2').hide();


                                        $('#sub5').append( new Option(text,val) );
                                        $('#sub5p2').append( new Option(text,val) );

                                        $('#sub6').append( new Option(text,val) );
                                        $('#sub6p2').append( new Option(text,val) );

                                        $('#sub7').append( new Option(text,val) );
                                        $('#sub7p2').append( new Option(text,val) );

                                        $('#sub8').hide();
                                        $('#sub8p2').hide();
                                    });  

                                    /* if(grp_cd == 1 || grp_cd == 7 )
                                    {
                                    $('#sub6').append( new Option('BIOLOGY',8) );
                                    $('#sub6p2').append( new Option('BIOLOGY',8) );
                                    $('#sub7').append( new Option('BIOLOGY',8) );
                                    $('#sub7p2').append( new Option('BIOLOGY',8) );
                                    $('#sub5').append( new Option('BIOLOGY',8) );
                                    $('#sub5p2').append( new Option('BIOLOGY',8) );
                                    //8:''
                                    }    */

                                    $("#sub5 option[value='"+sub5+"']").remove(); 
                                    $("#sub5p2 option[value='"+sub5+"']").remove();
                                    $("#sub5 option[value='"+sub6+"']").remove(); 
                                    $("#sub5p2 option[value='"+sub6+"']").remove();
                                    $("#sub5 option[value='"+sub7+"']").remove(); 
                                    $("#sub5p2 option[value='"+sub7+"']").remove();

                                    $("#sub6 option[value='"+sub5+"']").remove(); 
                                    $("#sub6p2 option[value='"+sub5+"']").remove(); 
                                    $("#sub6 option[value='"+sub6+"']").remove(); 
                                    $("#sub6p2 option[value='"+sub6+"']").remove();
                                    $("#sub6 option[value='"+sub7+"']").remove(); 
                                    $("#sub6p2 option[value='"+sub7+"']").remove();

                                    $("#sub7 option[value='"+sub5+"']").remove(); 
                                    $("#sub7p2 option[value='"+sub5+"']").remove();
                                    $("#sub7 option[value='"+sub6+"']").remove(); 
                                    $("#sub7p2 option[value='"+sub6+"']").remove();
                                    $("#sub7 option[value='"+sub7+"']").remove(); 
                                    $("#sub7p2 option[value='"+sub7+"']").remove(); 



                                }

                                function AAMA_KHASA_sub_grp_load()
                                {
                                    //
                                    //Category P-1: ADDITIONAL
                                    //sdfsdfsdfsdfsdf
                                    $("#lblpart1cat").text("Category P-1: FULL");
                                    $("#lblpart2cat").text("Category P-2: FULL");
                                    // $.each(additional_sub, function(val, text) {
                                    // $('#sub1').hide();
                                    $("#sub1").append(new Option('URDU',1));
                                    $("#sub1p2").append(new Option('URDU',1));
                                    $("#sub2").append(new Option('ENGLISH',2));
                                    $("#sub2p2").append(new Option('ENGLISH',2));
                                    $("#sub8").append(new Option('PAKISTAN STUDIES',4));
                                    $("#sub8p2").append(new Option('PAKISTAN STUDIES',4));
                                    $('#sub4').hide();
                                    $('#sub4p2').hide();
                                    $('#sub5').hide();
                                    $('#sub5p2').hide();
                                    $('#sub6').hide();
                                    $('#sub6p2').hide();
                                    $('#sub7').hide();
                                    $('#sub7p2').hide();
                                    $('#sub3').hide();
                                    $('#sub3p2').hide();
                                    //}); 
                                }                                

                                <?php 
                                //DebugBreak();

                                if($exam_type == 2 && ($grp_cd == 1||$grp_cd == 5||$grp_cd == 7))
                                {

                                    echo 'sub_grp_load_forexamtype2()';

                                }
                                else if($exam_type == 2 && $grp_cd == 2)
                                {
                                    // echo 'sub_grp_load()';
                                    echo'sub_grp_load_forexamtype2grp2()';
                                }
                                else if(($cat09_forAma==4 && $cat10_forAma==4) && (($Status == 2) || ($Status == 4) || ($Status == 3)))
                                {

                                    echo "AAMA_KHASA_sub_grp_load()";
                                }
                                else if($exam_type == 15 || ($exam_type == 16 && $cattype == 2))
                                {
                                    echo "additional_sub_grp_load();";
                                }
                                else if($exam_type == 3)
                                {
                                    //DebugBreak();
                                    echo "sub_grp_load_P1_supply_PII_full_exam_type_3()";
                                }
                                else
                                {
                                    echo 'sub_grp_load()';
                                }    
                                ?>

                                function sub_grp_load_P1_supply_PII_full_exam_type_3()
                                {
                                    // 
                                    // debugger;
                                     $("#sub1").empty();
                                    if(sub1pf1 == "2" || sub1pf1 == "3" )
                                    {
                                        $("#sub1").empty();
                                        $("#sub1").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
                                        $("#sub1 option[value='" + sub1 + "']").attr("selected","selected"); 
                                         
                                    }
                                    $("#sub1").append(new Option('NONE',0));


                                    $("#sub1p2").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
                                    $("#sub1p2 option[value='" + sub1 + "']").attr("selected","selected");
                                    //$("#sub1p2").append('<option value='+sub1p2+'>'+sub1p2+'</option>');
                                    
                                      $("#sub2").empty();
                                    if(sub2pf1 == "2" || sub2pf1 == "3")
                                    {
                                        $("#sub2").empty();
                                        $("#sub2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
                                        
                                        $("#sub2 option[value='" + sub2 + "']").attr("selected","selected");    
                                    }
                                    $("#sub2").append(new Option('NONE',0));

                                    $("#sub2p2").empty();
                                    $("#sub2p2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
                                    $("#sub2p2 option[value='" + sub2 + "']").attr("selected","selected");

                                     $("#sub3").empty();
                                    if(sub3pf1 == "2" || sub3pf1 == "3")
                                    {
                                        $("#sub3").empty();
                                        $("#sub3").append(new Option('<?php  echo  array_search($data[0]['sub3'],$subarray); ?>',sub3));
                                        $("#sub3 option[value='" + sub3 + "']").attr("selected","selected");    

                                    }
                                    $("#sub3").append(new Option('NONE',0));

                                    $("#sub3p2").empty();
                                    $("#sub3p2").append(new Option('<?php  echo  array_search($data[0]['sub3'],$subarray); ?>',sub3));
                                    $("#sub3p2 option[value='" + sub3 + "']").attr("selected","selected");

                                     $("#sub4").empty();
                                    if(sub4pf1 == "2" || sub4pf1 == "3")
                                    {
                                        $("#sub4").empty();
                                        $("#sub4").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));
                                        $("#sub4 option[value='" + sub4 + "']").attr("selected","selected");    

                                    }
                                    $("#sub4").append(new Option('NONE',0));

                                    $("#sub4p2").empty();
                                    $("#sub4p2").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));
                                    $("#sub4p2 option[value='" + sub4 + "']").attr("selected","selected");

                                     $("#sub5").empty();
                                    if(sub5pf1 == "2" || sub5pf1 == "3")
                                    {
                                        $("#sub5").empty();
                                        $("#sub5").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
                                        $("#sub5 option[value='" + sub5 + "']").attr("selected","selected");   

                                    }
                                    $("#sub5").append(new Option('NONE',0)); 

                                    $("#sub5p2").empty();
                                    $("#sub5p2").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
                                    $("#sub5p2 option[value='" + sub5 + "']").attr("selected","selected");

                                     $("#sub6").empty();
                                    if(sub6pf1 == "2" || sub6pf1 == "3")
                                    {
                                        $("#sub6").empty();
                                        $("#sub6").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));
                                        $("#sub6 option[value='" + sub1 + "']").attr("selected","selected");   

                                    }
                                    $("#sub6").append(new Option('NONE',0)); 


                                    $("#sub6p2").empty();
                                    $("#sub6p2").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));
                                    $("#sub6p2 option[value='" + sub6 + "']").attr("selected","selected");

                                     $("#sub7").empty();
                                    if(sub7pf1 == "2" || sub7pf1 == "3")
                                    {
                                        $("#sub7").empty();
                                        $("#sub7").append(new Option('<?php  echo  array_search($data[0]['sub7'],$subarray); ?>',sub7));
                                        $("#sub7 option[value='" + sub7 + "']").attr("selected","selected");    
                                        
                                    }
                                    $("#sub7").append(new Option('NONE',0)); 



                                    $("#sub7p2").empty();
                                    $("#sub7p2").append(new Option('<?php  echo  array_search($data[0]['sub7'],$subarray); ?>',sub7));
                                    $("#sub7p2 option[value='" + sub7 + "']").attr("selected","selected");

                                    $("#sub8").empty();
                                    if(sub8pf1 == "2" || sub8pf1 == "3")
                                    {
                                        $("#sub8").empty();
                                        $("#sub8").append(new Option('<?php  echo  array_search($data[0]['sub8'],$subarray); ?>',sub8));
                                        $("#sub8 option[value='" + sub8 + "']").attr("selected","selected");
                                       
                                    }
                                    $("#sub8").append(new Option('NONE',0)); 



                                    $("#sub8p2").empty();
                                    $("#sub8p2").append(new Option('<?php  echo  array_search($data[0]['sub8'],$subarray); ?>',sub8));
                                    $("#sub8p2 option[value='" + sub8 + "']").attr("selected","selected");
                                }
                                function sub_grp_empty_PI(){
                                    $("#sub1").empty().append('<option selected="selected" value="0">NONE</option>');
                                    $("#sub2").empty().append('<option selected="selected" value="0">NONE</option>');
                                    $("#sub3").empty().append('<option selected="selected" value="0">NONE</option>');
                                    $("#sub4").empty().append('<option selected="selected" value="0">NONE</option>');
                                    $("#sub5").empty().append('<option selected="selected" value="0">NONE</option>');
                                    $("#sub6").empty().append('<option selected="selected" value="0">NONE</option>');
                                    $("#sub7").empty().append('<option selected="selected" value="0">NONE</option>');
                                    $("#sub8").empty().append('<option selected="selected" value="0">NONE</option>');
                                }
                                function sub_grp_empty_PII(){
                                    //$("#sub1p2").empty();
                                    $('#sub1p2').empty().append('<option selected="selected" value="0">NONE</option>');
                                    $("#sub2p2").empty().append('<option selected="selected" value="0">NONE</option>');
                                    $("#sub3p2").empty().append('<option selected="selected" value="0">NONE</option>');
                                    $("#sub4p2").empty().append('<option selected="selected" value="0">NONE</option>');
                                    $("#sub5p2").empty().append('<option selected="selected" value="0">NONE</option>');
                                    $("#sub6p2").empty().append('<option selected="selected" value="0">NONE</option>');
                                    $("#sub7p2").empty().append('<option selected="selected" value="0">NONE</option>');
                                    $("#sub8p2").empty().append('<option selected="selected" value="0">NONE</option>');
                                }

                                function sub_grp_load_MarksImp_PI(){
                                    // debugger;
                                    // check Pass Fail status first
                                    sub_grp_empty_PII();
                                    $("#sub1").empty();
                                    $("#sub1").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
                                    $("#sub1 option[value='" + sub1 + "']").attr("selected","selected");
                                    /* }
                                    else
                                    {   $("#sub1").empty();
                                    $("#sub1").append('<option value="0">NONE</option>');
                                    } */
                                    // Subject 2 
                                    /* if((sub2pf1 == "1"))
                                    {*/
                                    $("#sub2").empty();
                                    $("#sub2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
                                    $("#sub2 option[value='" + sub2 + "']").attr("selected","selected");
                                    /* }
                                    else
                                    {
                                    $("#sub2").empty();
                                    $("#sub2").append('<option value="0">NONE</option>');
                                    }      */
                                    // subject 3 
                                    /* if((sub3pf1 == "1"))
                                    {*/
                                    $("#sub3").empty();
                                    $("#sub3").append(new Option('<?php  echo  array_search($data[0]['sub3'],$subarray); ?>',sub3));
                                    $("#sub3 option[value='" + sub3 + "']").attr("selected","selected");

                                    $("#sub8").empty();
                                    $("#sub8").append(new Option('<?php  echo  array_search($data[0]['sub8'],$subarray); ?>',sub8));
                                    $("#sub8 option[value='" + sub8 + "']").attr("selected","selected");
                                    $("#sub4").empty();
                                    $("#sub4").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));
                                    $("#sub4 option[value='" + sub4 + "']").attr("selected","selected");
                                    /*}
                                    else
                                    {
                                    $("#sub4").empty();
                                    $("#sub4").append('<option value="0">NONE</option>');
                                    }      */
                                    /*if((sub5pf1 == "1"))
                                    {*/
                                    $("#sub5").empty();
                                    $("#sub5").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
                                    $("#sub5 option[value='" + sub5 + "']").attr("selected","selected");
                                    /*}
                                    else
                                    {
                                    $("#sub5").empty();
                                    $("#sub5").append('<option value="0">NONE</option>');
                                    }   */
                                    /* if((sub6pf1 == "1"))
                                    { */
                                    $("#sub6").empty();
                                    $("#sub6").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));
                                    $("#sub6 option[value='" + sub1 + "']").attr("selected","selected");
                                    /*}
                                    else
                                    {
                                    $("#sub6").empty();
                                    $("#sub6").append('<option value="0">NONE</option>');
                                    }    */
                                    /*if((sub7pf1 == "1"))
                                    {*/
                                    $("#sub7").empty();
                                    $("#sub7").append(new Option('<?php  echo  array_search($data[0]['sub7'],$subarray); ?>',sub7));
                                    $("#sub7 option[value='" + sub7 + "']").attr("selected","selected");
                                    /* }
                                    else
                                    {
                                    $("#sub7").empty();
                                    $("#sub7").append('<option value="0">NONE</option>');
                                    }  */
                                    /*  if((sub8pf1 == "1"))
                                    { */

                                    /* }
                                    else
                                    {
                                    $("#sub8").empty();
                                    $("#sub8").append('<option value="0">NONE</option>');
                                    }  */
                                    // PART II Subjects ....... 
                                }
                                function sub_grp_load__MarksImp_PII(){
                                    //
                                    // check Pass Fail status first
                                    sub_grp_empty_PI();
                                    //if((sub1pf2 == "1") )
                                    //{
                                    $("#sub1p2").empty();
                                    $("#sub1p2").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
                                    $("#sub1p2 option[value='" + sub1 + "']").attr("selected","selected");
                                    //$("#sub1p2").append('<option value='+sub1p2+'>'+sub1p2+'</option>');
                                    // }
                                    /*  else
                                    {   $("#sub1p2").empty();
                                    $("#sub1p2").append('<option value="0">NONE</option>');
                                    }  */
                                    // Subject 2 
                                    /*if((sub2pf2 == "1"))
                                    { */
                                    $("#sub2p2").empty();
                                    $("#sub2p2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
                                    $("#sub2p2 option[value='" + sub2 + "']").attr("selected","selected");
                                    /*}
                                    else
                                    {
                                    $("#sub2p2").empty();
                                    $("#sub2p2").append('<option value="0">NONE</option>');
                                    }     */
                                    // subject 3 
                                    /*if((sub3pf2 == "1"))
                                    { */
                                    $("#sub3p2").empty();
                                    $("#sub3p2").append(new Option('<?php  echo  array_search($data[0]['sub3'],$subarray); ?>',sub3));
                                    $("#sub3p2 option[value='" + sub3 + "']").attr("selected","selected");

                                    $("#sub8p2").empty();
                                    $("#sub8p2").append(new Option('<?php  echo  array_search($data[0]['sub8'],$subarray); ?>',sub8));
                                    $("#sub8p2 option[value='" + sub8 + "']").attr("selected","selected");

                                    $("#sub4p2").empty();
                                    $("#sub4p2").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));
                                    $("#sub4p2 option[value='" + sub4 + "']").attr("selected","selected");
                                    /*}
                                    else
                                    {
                                    $("#sub4p2").empty();
                                    $("#sub4p2").append('<option value="0">NONE</option>');
                                    }  */
                                    /*  if((sub5pf2 == "1"))
                                    {*/
                                    $("#sub5p2").empty();
                                    $("#sub5p2").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
                                    $("#sub5p2 option[value='" + sub5 + "']").attr("selected","selected");
                                    /* $.each(sub5, function(val, text) {
                                    $('#sub5p2').append( new Option(text,val) );
                                    $("#sub5p2 option[value='" + sub5 + "']").attr("selected","selected");
                                    }); */
                                    /*}
                                    else
                                    {
                                    $("#sub5p2").empty();
                                    $("#sub5p2").append('<option value="0">NONE</option>');
                                    }      */
                                    /* if((sub6pf2 == "1"))
                                    {*/
                                    $("#sub6p2").empty();
                                    $("#sub6p2").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));
                                    $("#sub6p2 option[value='" + sub6 + "']").attr("selected","selected");
                                    /* }
                                    else
                                    {
                                    $("#sub6p2").empty();
                                    $("#sub6p2").append('<option value="0">NONE</option>');
                                    }    */
                                    /* if((sub7pf2 == "1"))
                                    {*/
                                    $("#sub7p2").empty();
                                    $("#sub7p2").append(new Option('<?php  echo  array_search($data[0]['sub7'],$subarray); ?>',sub7));
                                    $("#sub7p2 option[value='" + sub7 + "']").attr("selected","selected");
                                    /* }
                                    else
                                    {
                                    $("#sub7p2").empty();
                                    $("#sub7p2").append('<option value="0">NONE</option>');
                                    }     */
                                    /*if((sub8pf2 == "1"))
                                    {*/

                                    /* }
                                    else
                                    {
                                    $("#sub8p2").empty();
                                    $("#sub8p2").append('<option value="0">NONE</option>');
                                    }    */
                                    // PART II Subjects ....... 
                                }

                                function sub_grp_load_MarksImp_FULL(){

                                    $("#sub1").empty();
                                    $("#sub1").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
                                    $("#sub1 option[value='" + sub1 + "']").attr("selected","selected");


                                    $("#sub1p2").empty();
                                    $("#sub1p2").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
                                    $("#sub1p2 option[value='" + sub1 + "']").attr("selected","selected");

                                    $("#sub2").empty();
                                    $("#sub2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
                                    $("#sub2 option[value='" + sub2 + "']").attr("selected","selected");


                                    $("#sub2p2").empty();
                                    $("#sub2p2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
                                    $("#sub2p2 option[value='" + sub2 + "']").attr("selected","selected");

                                    $("#sub3").empty();
                                    $("#sub3").append(new Option('<?php  echo  array_search($data[0]['sub3'],$subarray); ?>',sub3));
                                    $("#sub3 option[value='" + sub3 + "']").attr("selected","selected");


                                    $("#sub3p2").empty();
                                    $("#sub3p2").append(new Option('<?php  echo  array_search($data[0]['sub3'],$subarray); ?>',sub3));
                                    $("#sub3p2 option[value='" + sub3 + "']").attr("selected","selected");


                                    $("#sub4").empty();
                                    $("#sub4").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));
                                    $("#sub4 option[value='" + sub4 + "']").attr("selected","selected");

                                    $("#sub4p2").empty();
                                    $("#sub4p2").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));
                                    $("#sub4p2 option[value='" + sub4 + "']").attr("selected","selected");

                                    $("#sub5").empty();
                                    $("#sub5").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
                                    $("#sub5 option[value='" + sub5 + "']").attr("selected","selected");
                                    //  else{

                                    $("#sub5p2").empty();
                                    $("#sub5p2").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
                                    $("#sub5p2 option[value='" + sub5 + "']").attr("selected","selected");


                                    $("#sub6").empty();
                                    $("#sub6").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));
                                    $("#sub6 option[value='" + sub1 + "']").attr("selected","selected");

                                    $("#sub6p2").empty();
                                    $("#sub6p2").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));
                                    $("#sub6p2 option[value='" + sub6 + "']").attr("selected","selected");

                                    $("#sub7").empty();
                                    $("#sub7").append(new Option('<?php  echo  array_search($data[0]['sub7'],$subarray); ?>',sub7));
                                    $("#sub7 option[value='" + sub7 + "']").attr("selected","selected");


                                    $("#sub7p2").empty();
                                    $("#sub7p2").append(new Option('<?php  echo  array_search($data[0]['sub7'],$subarray); ?>',sub7));
                                    $("#sub7p2 option[value='" + sub7 + "']").attr("selected","selected");

                                    $("#sub8").empty();
                                    $("#sub8").append(new Option('<?php  echo  array_search($data[0]['sub8'],$subarray); ?>',sub8));
                                    $("#sub8 option[value='" + sub8 + "']").attr("selected","selected");

                                    $("#sub8p2").empty();
                                    $("#sub8p2").append(new Option('<?php  echo  array_search($data[0]['sub8'],$subarray); ?>',sub8));
                                    $("#sub8p2 option[value='" + sub8 + "']").attr("selected","selected");

                                }

                                function sub_grp_load_MarksImp_Subj_wise(){
                                    //
                                    // check Pass Fail status first
                                    if((sub1pf1 == "2" || sub1pf2 == "2") )
                                    {
                                        $("#sub1").empty();
                                        $("#sub1p2").empty();
                                        $("#sub1").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
                                        $("#sub1 option[value='" + sub1 + "']").attr("selected","selected");
                                        $("#sub1p2").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
                                        $("#sub1p2 option[value='" + sub1 + "']").attr("selected","selected");
                                    }
                                    else
                                    {   $("#sub1p2").empty();
                                        $("#sub1p2").append('<option value="0">NONE</option>');
                                        $("#sub1p2").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
                                        $("#sub1").empty();
                                        $("#sub1").append('<option value="0">NONE</option>');
                                        $("#sub1").append(new Option('<?php  echo  array_search($data[0]['sub1'],$subarray); ?>',sub1));
                                    }

                                    // Subject 2 
                                    if((sub2pf1 == "2" || sub2pf2 == "2"))
                                    {
                                        $("#sub2").empty();
                                        $("#sub2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
                                        $("#sub2 option[value='" + sub2 + "']").attr("selected","selected");
                                        $("#sub2p2").empty();
                                        $("#sub2p2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
                                        $("#sub2p2 option[value='" + sub2 + "']").attr("selected","selected");
                                    }
                                    else
                                    {
                                        $("#sub2p2").empty();
                                        $("#sub2p2").append('<option value="0">NONE</option>');
                                        $("#sub2p2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));
                                        $("#sub2").empty();
                                        $("#sub2").append('<option value="0">NONE</option>');
                                        $("#sub2").append(new Option('<?php  echo  array_search($data[0]['sub2'],$subarray); ?>',sub2));  
                                    }

                                    // subject 3 
                                    if((sub3pf1 == "2" || sub3pf2 == "2"))
                                    {
                                        $("#sub3").empty();
                                        $("#sub3").append(new Option('<?php  echo  array_search($data[0]['sub3'],$subarray); ?>',sub3));
                                        $("#sub3 option[value='" + sub3 + "']").attr("selected","selected");
                                        $("#sub3p2").empty();
                                        $("#sub3p2").append(new Option('<?php  echo  array_search($data[0]['sub3'],$subarray); ?>',sub3));
                                        $("#sub3p2 option[value='" + sub3 + "']").attr("selected","selected");
                                    }
                                    else
                                    {
                                        $("#sub3p2").empty();
                                        $("#sub3p2").append('<option value="0">NONE</option>');
                                        $("#sub3p2").append(new Option('<?php  echo  array_search($data[0]['sub3'],$subarray); ?>',sub3));
                                        $("#sub3").empty();
                                        $("#sub3").append('<option value="0">NONE</option>'); 
                                        $("#sub3").append(new Option('<?php  echo  array_search($data[0]['sub3'],$subarray); ?>',sub3));
                                    }

                                    if((sub4pf1 == "2" || sub4pf2 == "2"))
                                    {
                                        $("#sub4").empty();
                                        $("#sub4").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));
                                        $("#sub4 option[value='" + sub4 + "']").attr("selected","selected");
                                        $("#sub4p2").empty();
                                        $("#sub4p2").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));
                                        $("#sub4p2 option[value='" + sub4 + "']").attr("selected","selected");
                                    }
                                    else
                                    {
                                        $("#sub4p2").empty();
                                        $("#sub4p2").append('<option value="0">NONE</option>');
                                        $("#sub4p2").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));
                                        $("#sub4").empty();
                                        $("#sub4").append('<option value="0">NONE</option>');
                                        $("#sub4").append(new Option('<?php  echo  array_search($data[0]['sub4'],$subarray); ?>',sub4));
                                    }

                                    if((sub5pf1 == "2" || sub5pf2 == "2"))
                                    {
                                        $("#sub5").empty();
                                        $("#sub5").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
                                        $("#sub5 option[value='" + sub5 + "']").attr("selected","selected");
                                        $("#sub5p2").empty();
                                        $("#sub5p2").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
                                        $("#sub5p2 option[value='" + sub5 + "']").attr("selected","selected");
                                        //  else{
                                        // }
                                        /*$.each(sub5, function(val, text) {
                                        $('#sub5').append( new Option(text,val) );
                                        $("#sub5 option[value='" + sub5 + "']").attr("selected","selected");
                                        }); */
                                    }
                                    else
                                    {
                                        $("#sub5p2").empty();
                                        $("#sub5p2").append('<option value="0">NONE</option>');
                                        $("#sub5p2").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
                                        $("#sub5").empty();
                                        $("#sub5").append('<option value="0">NONE</option>');
                                        $("#sub5").append(new Option('<?php  echo  array_search($data[0]['sub5'],$subarray); ?>',sub5));
                                    }

                                    if((sub6pf1 == "2" || sub6pf2 == "2"))
                                    {
                                        $("#sub6").empty();
                                        $("#sub6").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));
                                        $("#sub6 option[value='" + sub1 + "']").attr("selected","selected");
                                        $("#sub6p2").empty();
                                        $("#sub6p2").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));
                                        $("#sub6p2 option[value='" + sub6 + "']").attr("selected","selected");
                                    }
                                    else
                                    {
                                        $("#sub6p2").empty();
                                        $("#sub6p2").append('<option value="0">NONE</option>');
                                        $("#sub6p2").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));
                                        $("#sub6").empty();
                                        $("#sub6").append('<option value="0">NONE</option>');
                                        $("#sub6").append(new Option('<?php  echo  array_search($data[0]['sub6'],$subarray); ?>',sub6));
                                    }

                                    if((sub7pf1 == "2" || sub7pf2 == "2"))
                                    {
                                        $("#sub7").empty();
                                        $("#sub7").append(new Option('<?php  echo  array_search($data[0]['sub7'],$subarray); ?>',sub7));
                                        $("#sub7 option[value='" + sub7 + "']").attr("selected","selected");
                                        $("#sub7p2").empty();
                                        $("#sub7p2").append(new Option('<?php  echo  array_search($data[0]['sub7'],$subarray); ?>',sub7));
                                        $("#sub7p2 option[value='" + sub7 + "']").attr("selected","selected");
                                    }
                                    else
                                    {
                                        $("#sub7p2").empty();
                                        $("#sub7p2").append('<option value="0">NONE</option>');
                                        $("#sub7p2").append(new Option('<?php  echo  array_search($data[0]['sub7'],$subarray); ?>',sub7));
                                        $("#sub7").empty();
                                        $("#sub7").append('<option value="0">NONE</option>');
                                        $("#sub7").append(new Option('<?php  echo  array_search($data[0]['sub7'],$subarray); ?>',sub7)); 
                                    }

                                    if((sub8pf1 == "2" || sub8pf2 == "3"))
                                    {
                                        $("#sub8").empty();
                                        $("#sub8").append(new Option('<?php  echo  array_search($data[0]['sub8'],$subarray); ?>',sub8));
                                        $("#sub8 option[value='" + sub8 + "']").attr("selected","selected");
                                        $("#sub8p2").empty();
                                        $("#sub8p2").append(new Option('<?php  echo  array_search($data[0]['sub8'],$subarray); ?>',sub8));
                                        $("#sub8p2 option[value='" + sub8 + "']").attr("selected","selected");
                                    }
                                    else
                                    {
                                        $("#sub8").empty();
                                        $("#sub8").append('<option value="0">NONE</option>');
                                        $("#sub8").append(new Option('<?php  echo  array_search($data[0]['sub8'],$subarray); ?>',sub8));
                                        $("#sub8p2").empty();
                                        $("#sub8p2").append('<option value="0">NONE</option>');
                                        $("#sub8p2").append(new Option('<?php  echo  array_search($data[0]['sub8'],$subarray); ?>',sub8));
                                    }

                                    // PART II Subjects ....... 
                                }
                                $("#ddlMarksImproveoptions").change(function(){
                                    //
                                    //  debugger;
                                    var cat =  $("#ddlMarksImproveoptions").val();
                                    if(cat== 0){
                                        sub_grp_empty_PI();
                                        sub_grp_empty_PII();
                                        // alertify.log("Please Select category");
                                    }
                                    else if(cat== 1){
                                        sub_grp_load_MarksImp_PI();
                                        //  alertify.log("You select Part 1 Full cat");
                                    }
                                    else if(cat== 2){
                                        sub_grp_load__MarksImp_PII();
                                        // alertify.log("You select Part 2 Full cat");
                                    }
                                    else if(cat== 3){
                                        sub_grp_load_MarksImp_FULL();
                                        //   alertify.log("You select Both Part  Full cat");
                                    }
                                    else if(cat== 4){
                                        sub_grp_load_MarksImp_Subj_wise();
                                        // alertify.log("You select subject wise cat");
                                    }
                                })
                               /* $('input:radio[name="religion"]').change(function()
                                    {
                                        // debugger;
                                        if($(this).val() == 1) {

                                            $("#sub3").empty(); 
                                            $("#sub3").prepend('<option selected="selected" value="3"> ISLAMIYAT (COMPULSORY) </option>');
                                            //$("#ddlList").prepend('<option selected="selected" value="0"> Select </option>');
                                        }else{
                                            //$("#father_cnic").mask("****************************",{placeholder:""});

                                            $("#sub3").empty(); 
                                            $("#sub3").prepend("<option selected='selected' value='51'> ETHICS </option>");
                                            $("#sub3").prepend("<option  value='3'> ISLAMIYAT (COMPULSORY) </option>");
                                        }
                                }); */
                                $('input:radio[name="religion"]').change(function()
                                    {
                                        var exam_type = $('#exam_type').val();
                                        if(exam_type == 2)
                                        {
                                            if($(this).val() == 1) 
                                            {

                                                $("#sub3").empty(); 
                                                $("#sub3").prepend('<option selected="selected" value="3"> ISLAMIYAT (COMPULSORY) </option>');
                                                //$("#ddlList").prepend('<option selected="selected" value="0"> Select </option>');
                                            }
                                            else
                                            {
                                                //$("#father_cnic").mask("****************************",{placeholder:""});

                                                $("#sub3").empty(); 
                                                $("#sub3").prepend("<option selected='selected' value='51'> ETHICS </option>");
                                                $("#sub3").prepend("<option  value='3'> ISLAMIYAT (COMPULSORY) </option>");
                                            }
                                        }

                                });
                                $('input:radio[name="gend"]').change(function()
                                    {
                                        var exam_type = $('#exam_type').val();
                                        if(exam_type == 2)
                                        {
                                            if($(this).val() == 2)
                                            {
                                                $("#sub6").append(new Option('ELEMENTS OF HOME ECONOMICS',13));
                                                $("#sub6p2").append(new Option('ELEMENTS OF HOME ECONOMICS',13));
                                                $("#sub7").append(new Option('ELEMENTS OF HOME ECONOMICS',13));
                                                $("#sub7p2").append(new Option('ELEMENTS OF HOME ECONOMICS',13));
                                            }
                                            else
                                            {
                                                // alert('i am removed');
                                                dropdownElement.find('sub8[value=13]').remove();
                                                dropdownElement.find('sub8p2[value=13]').remove();
                                            }
                                        }

                                })
                                $('#std_group').change(function(){


                                     debugger;



                                    var sel_group = $('#std_group').val();
                                    var old_exam =  $('#oldexam_type').val();
                                    var crnt_exam =  $('#exam_type').val();

                                    if(crnt_exam == 4 || crnt_exam == 5 || crnt_exam == 6)
                                    {
                                        $('#oldexam_type').val(crnt_exam)
                                        $('#exam_type').val(2);



                                    }
                                    else if(crnt_exam == 2 && (old_exam == 4 || old_exam == 5 || old_exam == 6))
                                    {
                                        $('#oldexam_type').val(2)
                                        $('#exam_type').val(old_exam);

                                    }
                                   // debugger;
                                    var exam_type_static = $("#exam_type_static").val();
                                    if(((((grp_cd == 1 && sub7 == "8") && sel_group ==1) || ((grp_cd == 1 && sub7 == "78") && sel_group ==7) || ((grp_cd == 1 && sub7 == "43") && sel_group ==8) || ((grp_cd == 2) && sel_group ==2) || ((grp_cd == 1 && sub7 == "78")) && sel_group ==7 || ((grp_cd == 1 && sub7 == "43") && sel_group ==8)) || (grp_cd == 2 && sel_group ==2)) && exam_type_static != 2)// (exam_type_static ==4 || exam_type_static ==5 || exam_type_static ==6))
                                    {
                                        //$("#isfullAppear").attr("check",false);
                                        if(exam_type_static==3)
                                        {
                                        if($("#isfullAppear").attr("check",false));
                                        $("#isfullAppear").attr("disabled",true);

                                        $("#divIsfullApp").hide();
                                        $("#isfullAppear").hide();
                                        
                                            sub_grp_load_P1_supply_PII_full_exam_type_3();
                                            return false;
                                        }
                                        else
                                        {
                                        $("#isfullAppear").attr("disabled",false);
                                        $("#divIsfullApp").show();
                                        $("#isfullAppear").show();

                                        if($("#isfullAppear").is(":checked"))
                                        {
                                            IsFullAppear();
                                        }
                                        else
                                        {
                                            sub_grp_load();
                                        }
                                        }
                                        

                                        return false; 
                                    }
                                    else
                                    {
                                        if($("#isfullAppear").attr("check",false));
                                        $("#isfullAppear").attr("disabled",true);

                                        $("#divIsfullApp").hide();
                                        $("#isfullAppear").hide();
                                    } 



                                    /*if(sub7=="8"){
                                    sel_group ="1";
                                    }
                                    else if(sub7=="78"){
                                    sel_group ="7";
                                    }
                                    else if(sub7=="43"){
                                    sel_group ="8";
                                    }
                                    else{
                                    sel_group ="2";
                                    }     */
                                    /*if((sel_group == grp_cd && crnt_exam !=2 ) || (crnt_exam == 4 || crnt_exam == 5 || crnt_exam == 6 ))//(sel_group == 1 || sel_group == 7 || sel_group == 8) && grp_cd==1 && crnt_exam ==2) || (sel_group == grp_cd && crnt_exam ==2 )   || (sel_group == grp_cd && crnt_exam !=2 ) || (crnt_exam == 4 || crnt_exam == 5 || crnt_exam == 6 ))
                                    {
                                    <?php 
                                    // if($exam_type == 2 && $grp_cd == 1){

                                    //   echo 'sub_grp_load_forexamtype2()'; 
                                    ?>


                                    <?php //}
                                    //  else if ($exam_type == 2 && $grp_cd = 2){
                                    //     echo'sub_grp_load_forexamtype2grp2()';
                                    //   }
                                    //  else{
                                    ?> 
                                    $("#divIsfullApp").removeClass('hide');
                                    $("#isfullAppear").removeClass('hide');
                                    $("#isfullAppear").attr("disabled",false);


                                    <?php // echo 'sub_grp_load()'; 
                                    //}                                        
                                    ?>
                                    }
                                    else
                                    {    */
                                    if(sel_group == "1")
                                    {
                                        // Check Nationality and select appropriate Subject1 against candidate Nationality :)
                                        load_Bio_CS_Sub();
                                        $("#sub7").append(new Option('BIOLOGY',8));
                                        $("#sub7p2").append(new Option('BIOLOGY',8));
                                    }
                                    else if(sel_group == "7")
                                    {
                                        load_Bio_CS_Sub();
                                        $("#sub7").append(new Option('COMPUTER SCIENCE',78));
                                        $("#sub7p2").append(new Option('COMPUTER SCIENCE',78));
                                    }
                                    else if (sel_group == "8")
                                    {
                                        load_Bio_CS_Sub();
                                        $("#sub7").append(new Option('ELECTRICAL WIRING (OPT)',43));
                                        $("#sub7p2").append(new Option('ELECTRICAL WIRING (OPT)',43));
                                        //ELECTRICAL WIRING (OPT)
                                    }
                                    else if(sel_group == "2")
                                    {
                                        Hum_Deaf_Subjects();
                                        $.each(sub5_Hum,function(val,text){
                                            $("#sub4").append(new Option(text,val));
                                            $("#sub4p2").append(new Option(text,val));
                                        });
                                        $.each(sub6_Hum,function(val,text){
                                            $("#sub5").append(new Option(text,val));
                                            $("#sub5p2").append(new Option(text,val));
                                        });
                                        $.each(sub7_Hum,function(val,text){
                                            $("#sub6").append(new Option(text,val));
                                            $("#sub6p2").append(new Option(text,val));
                                        });
                                        $.each(sub8_Hum,function(val,text){
                                            $("#sub7").append(new Option(text,val));
                                            $("#sub7p2").append(new Option(text,val));
                                        });
                                        var Elecgrp ="<?php echo @$grp_cd; ?>";
                                        var isgovt ="<?php echo @$isgovt; ?>";
                                        var b = ['8'];
                                        var isElec = '0';
                                        $.each(Elecgrp,function(i,val){
                                            var result=$.inArray(val,b);
                                            if(result!=-1)
                                            {
                                                isElec = 1;
                                            }
                                        })
                                        if(isgovt == 2)
                                        {
                                            if(isElec != 1)
                                            {
                                                // $("#sub7")
                                                //$("#sub7 option[value='43']").remove();
                                                //$("#sub8 option[value='43']").remove();
                                                $("#sub7 option[value='43']").remove();
                                                $("#sub7p2 option[value='43']").remove();
                                                $("#sub6 option[value='43']").remove();
                                                $("#sub6p2 option[value='43']").remove();
                                                // $("#sub7").find('option[value=43]').remove();
                                                // alert("removed");
                                            }  
                                        }
                                        //  var Gender = $("#gend").val();

                                        //console.log(Religion);
                                        if(Gender == "2")
                                        {
                                            $("#sub6").append(new Option('ELEMENTS OF HOME ECONOMICS',13));
                                            $("#sub6p2").append(new Option('ELEMENTS OF HOME ECONOMICS',13));
                                            $("#sub7").append(new Option('ELEMENTS OF HOME ECONOMICS',13));
                                            $("#sub7p2").append(new Option('ELEMENTS OF HOME ECONOMICS',13));
                                        }
                                        else
                                        {
                                            // alert('i am removed');
                                            dropdownElement.find('sub8[value=13]').remove();
                                            dropdownElement.find('sub8p2[value=13]').remove();
                                        }
                                    }
                                    else if(sel_group == "5")
                                    {
                                        Hum_Deaf_Subjects();
                                        $.each(sub5_Deaf,function(val,text){
                                            $("#sub4").append(new Option(text,val));
                                            $("#sub4p2").append(new Option(text,val));
                                        });
                                        $.each(sub6_Deaf,function(val,text){
                                            $("#sub5").append(new Option(text,val));
                                            $("#sub5p2").append(new Option(text,val));
                                        });
                                        $.each(sub6_Deaf,function(val,text){
                                            $("#sub6").append(new Option(text,val));
                                            $("#sub6p2").append(new Option(text,val));
                                        });
                                        $.each(sub7_Deaf,function(val,text){
                                            $("#sub7").append(new Option(text,val));
                                            $("#sub7p2").append(new Option(text,val));
                                        });
                                        /* $.each(sub8_Deaf,function(val,text){
                                        $("#sub8").append(new Option(text,val));
                                        $("#sub8p2").append(new Option(text,val));
                                        }); */
                                    }
                                    else if (sel_group == "0")
                                    {
                                        remove_subjects();
                                    }
                                    //}
                                })

                            })
                            function checks(){
                                var status  =  check_NewEnrol_validation_matric();
                                if(status == 0)
                                {
                                    return false;    
                                }
                                else
                                {
                                    $("button[type='submit']").html('Please wait ...').attr('disabled','disabled'); 
                                    $("#myform").submit();
                                    return true;
                                } 
                            }
                            function  check_NewEnrol_validation_(){
                                debugger;
                                var name =  $('#cand_name').val();
                                var dist_cd= $('#dist option:selected').val();
                                var teh_cd= $('#teh').val();
                                var zone_cd= $('#zone').val();
                                var pp_cent= $('#pp_cent').val();           
                                var sub6p1 = $('#sub5').val();
                                var sub6p2 = $('#sub6').val();           
                                var sub7p1 = $('#sub7').val();
                                var sub7p2 = $('#sub8').val();                      
                                var ex_type = $('#exam_type').val();
                                var mobNo = $('#mob_number').val();
                                var bFormNo = $('#bay_form').val();
                                var grp_cd = $('#std_group').val();
                                var ddlMarksImproveoptions = $('#ddlMarksImproveoptions').val();
                                var brd_cd = $('#brd_cd').val();
                                var fName = $('#father_name').val();
                                var FNic = $('#father_cnic').val();
                                var dob = $('#dob').val();
                                var address = $('#address').val();
                                var image = $('#image').val();
                                var MarkOfIdent = $('#MarkOfIden').val();
                                var Inst_Rno = $('#Inst_Rno').val();
                                var status = 0;
                                // alert('sub6 '+sub6p1+ ' and '+ sub6p2);
                                // debugger;
                                if(ddlMarksImproveoptions == "" ||  ddlMarksImproveoptions == undefined){
                                    $('#ErrMsg').show();  
                                    $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
                                    $('#ErrMsg').html("<b>Please Select Category! </b>");    
                                    $('#ddlMarksImproveoptions').focus(); 
                                    return status;
                                }
                                else if(name == "" ||  name == undefined){
                                    $('#ErrMsg').show();  
                                    $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
                                    $('#ErrMsg').html("<b>Please Enter your  Name </b>");    

                                    $('#cand_name').focus(); 
                                    return status;
                                }
                                else if(fName == "" || fName == undefined){
                                    $('#ErrMsg').show(); 
                                    $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
                                    $('#ErrMsg').html("<b>Please Enter your Father's Name  </b>");    
                                    $('#father_name').focus(); 
                                    return status;
                                }   


                                else if(FNic == "" || FNic.length == undefined )
                                {
                                    $('#ErrMsg').show(); 
                                    $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
                                    $('#ErrMsg').html("<b>Please Enter your Father's CNIC</b>"); 
                                    $('#father_cnic').focus();  
                                    return status; 
                                }
                                else if(FNic == bFormNo  )
                                {

                                    alertify.error("B-form Number and Father CNIC cannot be same.") 
                                    $('#bay_form').focus();   
                                    return status; 
                                }
                                else if(bFormNo == "" || bFormNo == 0 || bFormNo == undefined)
                                {
                                    $('#ErrMsg').show(); 
                                    $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
                                    $('#ErrMsg').html("<b>Please Enter your bay-Form</b>"); 
                                    $('#bay_form').focus();  
                                    return status; 
                                }
                                else if(dob == "" || dob.length == undefined)
                                {
                                    $('#ErrMsg').show(); 
                                    $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
                                    $('#ErrMsg').html("<b>Please Enter your Date of Birth</b>"); 
                                    $('#dob').focus(); 
                                    return status;  
                                }

                                else if(mobNo == "" || mobNo == 0 || mobNo == undefined)
                                {
                                    $('#ErrMsg').show(); 
                                    $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
                                    $('#ErrMsg').html("<b>Please Enter your Mobile No.</b>"); 
                                    $('#mob_number').focus();   
                                    return status;  
                                }
                                else if(Inst_Rno == "" || Inst_Rno == 0 || Inst_Rno== undefined)
                                {
                                    $('#ErrMsg').show(); 
                                    $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
                                    $('#ErrMsg').html("<b>Please Enter your Institute Roll No.</b>"); 
                                    $('#Inst_Rno').focus();   
                                    return status;  
                                }
                                else if(MarkOfIdent == "" || MarkOfIdent == 0 || MarkOfIdent == undefined)
                                {
                                    $('#ErrMsg').show(); 
                                    $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
                                    $('#ErrMsg').html("<b>Please Enter your Mark of Indentification</b>"); 
                                    $('#MarkOfIden').focus();   
                                    return status;  
                                }
                                else if(address == "" || address == 0 || address.length ==undefined )
                                {
                                    $('#ErrMsg').show(); 
                                    $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
                                    $('#ErrMsg').html("<b>Please Enter your Address</b>"); 
                                    $('#address').focus(); 
                                    return status;    
                                }

                                /*                  else  if ($("#dist").find('option:selected').val() < 1) 
                                {

                                alert('Please select District '); 
                                $("#dist").focus();

                                return status;  
                                }

                                else   if ($("#teh").find('option:selected').val() < 1) {

                                alert('Please select Tehsil');                          
                                $("#teh").focus();
                                return status;  
                                }
                                else  if ($("#zone").find('option:selected').val() < 1) {

                                alert('Please select Zone. ');                          
                                $("#zone").focus();
                                return status;  
                                }
                                */

                                else   if ($("#std_group").find('option:selected').val() < 1) 
                                {
                                    $('#ErrMsg').show(); 
                                    $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
                                    $('#ErrMsg').html("<b>Please Enter your Study Group</b>"); 
                                    // alert('Study Group not selected ');                          
                                    $("#std_group").focus();
                                    return status;  
                                }
                                else   if ($("#sub3").find('option:selected').val() < 1) 
                                {
                                    $('#ErrMsg').show(); 
                                    alert('Plesae select  Subject');                          
                                    $("#sub3").focus();

                                    return status;  
                                }
                                else   if ($("#sub5").find('option:selected').val() < 1) 
                                {
                                    $('#ErrMsg').show(); 
                                    alert('Plesae select Subject');                          
                                    $("#sub5").focus();

                                    return status;  
                                }

                                else   if ($("#sub6").find('option:selected').val() < 1) 
                                {
                                    $('#ErrMsg').show(); 
                                    $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
                                    $('#ErrMsg').html("<b>Plesae select 6th Subject  </b>"); 
                                    // alert('Plesae select 6th Subject  ');                          
                                    $("#sub6").focus();
                                    return status;  
                                }

                                else   if ($("#sub7").find('option:selected').val() < 1) 
                                {
                                    $('#ErrMsg').show(); 
                                    $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
                                    $('#ErrMsg').html("<b>Plesae select 7th Subject  </b>"); 
                                    //alert('Plesae select 7th Subject ');                          
                                    $("#sub7").focus();
                                    return status;  
                                }

                                else   if ($("#sub8").find('option:selected').val() < 1) 
                                {
                                    $('#ErrMsg').show(); 
                                    $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
                                    $('#ErrMsg').html("<b>Plesae select 8th Subject  </b>"); 
                                    //alert('Plesae select 8th Subject ');                          
                                    $("#sub8").focus();
                                    return status;  
                                }

                                status = 1;
                                return status;




                            }

                            $("#sub3").change(function(){
                                var sel_sub =$("#sub3").val();
                                $("#sub3p2").val(sel_sub);
                            });
                            $("#sub3p2").change(function(){
                                var sel_sub =$("#sub3p2").val();
                                $("#sub3").val(sel_sub);
                            });


                            /* function  check_NewEnrol_validation()
                            {

                            var name =  $('#cand_name').val();
                            var dist_cd= $('#pvtinfo_dist option:selected').val();
                            var teh_cd= $('#pvtinfo_teh option:selected').val();
                            var zone_cd= $('#pvtZone option:selected').val();
                            var pp_cent= $('#pp_cent').val();           
                            var sub6p1 = $('#sub6').val();
                            var sub6p2 = $('#sub6p2').val();           
                            var sub7p1 = $('#sub7').val();
                            var sub7p2 = $('#sub7p2').val();  
                            var sub8p1 = $('#sub8').val();                      
                            var sub8p2 = $('#sub8p2').val();                      
                            var ex_type = $('#exam_type').val();
                            var mobNo = $('#mob_number').val();
                            var bFormNo = $('#bay_form').val();
                            var grp_cd = $('#std_group').val();
                            var brd_cd = $('#brd_cd').val();
                            var fName = $('#father_name').val();
                            var FNic = $('#father_cnic').val();
                            var dob = $('#dob').val();
                            var address = $('#address').val();
                            var image = $('#image').val();
                            var MarkOfIdent = $('#MarkOfIden').val();
                            // var Inst_Rno = $('#Inst_Rno').val();
                            var status = 0;
                            var $img = $("#previewImg");
                            var src = $img.attr("src");
                            var grppre = $("#grppre").val();
                            var selected_group_conversion ;
                            var exam_type = $("#exam_type").val();
                            if(grp_cd==1 || grp_cd == 5 || grp_cd ==7)
                            {
                            selected_group_conversion =1;
                            }
                            else
                            {
                            selected_group_conversion =grp_cd;
                            }

                            if(src == '') {
                            $img.addClass("highlight");
                            $img.css("border", "3px solid yellow");
                            $('#ErrMsg').show();  
                            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
                            alertify.error("Please upload your Picture First.")
                            $img.focus(); 
                            return status;
                            }
                            else if(name == "" ||  name == undefined){
                            $('#ErrMsg').show();  
                            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
                            alertify.error("Please Enter your  Name")
                            $('#cand_name').focus(); 
                            return status;
                            }
                            else if(fName == "" || fName == undefined){
                            $('#ErrMsg').show(); 
                            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
                            alertify.error("Please Enter your Father's Name  ") 
                            $('#father_name').focus(); 
                            return status;
                            }   

                            else if(bFormNo == "" || bFormNo == 0 || bFormNo == undefined)
                            {
                            $('#ErrMsg').show(); 
                            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });

                            alertify.error("Please Enter your bay-Form") 
                            $('#bay_form').focus();  
                            return status; 
                            }
                            else if(FNic == "" || FNic.length == undefined )
                            {
                            $('#ErrMsg').show(); 
                            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
                            alertify.error("Please Enter your Father's CNIC") 
                            $('#father_cnic').focus();  
                            return status; 
                            }

                            else if(mobNo == "" || mobNo == 0 || mobNo == undefined)
                            {
                            $('#ErrMsg').show(); 
                            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });

                            alertify.error("Please Enter your Mobile No.") 
                            $('#mob_number').focus();   
                            return status;  
                            }

                            else if(MarkOfIdent == "" || MarkOfIdent == 0 || MarkOfIdent == undefined)
                            {
                            $('#ErrMsg').show(); 
                            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });

                            alertify.error("Please Enter your Mark of Indentification") 
                            $('#MarkOfIden').focus();   
                            return status;  
                            }
                            else if(address == "" || address == 0 || address.length ==undefined )
                            {
                            $('#ErrMsg').show(); 
                            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
                            $('#ErrMsg').html("<b>Please Enter your Address</b>"); 
                            alertify.error("Please Enter your Address")
                            $('#address').focus(); 
                            return status;    
                            }

                            else  if (dist_cd < 1) 
                            {
                            alertify.error('Please select District '); 
                            $("#pvtinfo_dist").focus();
                            return status;  
                            }

                            else if (teh_cd < 1) {

                            alertify.error('Please select Tehsil');                          
                            $("#pvtinfo_teh").focus();
                            return status;  
                            }
                            else if (zone_cd < 1) 
                            {
                            alertify.error('Please select Zone. ');                          
                            $("#pvtZone").focus();
                            return status;  
                            }

                            else if (grp_cd == 0) 
                            {
                            $('#ErrMsg').show(); 
                            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
                            alertify.error('Please Select your Study Group '); 
                            $("#std_group").focus();
                            return status;  
                            }

                            status = 1;
                            return status;
                            }  */
                            function CancelAlert()
                            {
                                var msg = "Are You Sure You want to Cancel this Form ?"
                                alertify.confirm(msg, function (e) {
                                    if (e) {
                                        // user clicked "ok"
                                        window.location.href ='<?php echo base_url(); ?>Admission/';
                                    } else {
                                        // user clicked "cancel"
                                    }
                                });
                            }

                            jQuery(document).ready(function () {
                                $(document.getElementById("bay_form")).mask("99999-9999999-9", { placeholder: "_" });
                                $(document.getElementById("father_cnic")).mask("99999-9999999-9", { placeholder: "_" });
                                $(document.getElementById("mob_number")).mask("9999-9999999", { placeholder: "_" });
                            });
                        </script>                   
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>