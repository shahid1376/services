<html>
    <body>
        <div class="container-fluid">
        <div class="dashboard-container">
        <div class="top-nav">
            <ul>
               <!-- <li>
                    <a href="<?php echo base_url(); ?>dashboard" class="<?php if($isselected == '1') {echo 'selected';}?>" >
                        <div class="fs1" aria-hidden="true" data-icon="&#xe0a0;"> </div>
                        Dashboard
                    </a>
                </li>-->
                
                <?php if($isselected == '4'){?>
                
                <li>
                    <a style="width: 115px;" href="<?php echo base_url(); ?>index.php/RollNoSlip" class="<?php if($isselected == '4') {echo 'selected';}?>" >
                        <div class="fs1" aria-hidden="true" data-icon="&#xe032;"> </div>
                        Roll No. Slips
                    </a>
                </li>
                <?php } if($isselected == '2'){?>
                
                <li>
                    <a href="<?php echo base_url(); ?>index.php/Registration" class="<?php if($isselected == '2') {echo 'selected';}?>" >
                        <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                        Registration
                    </a>
                </li>
                <?php } if($isselected == '5'){?>
                
                <li>
                    <a href="<?php echo base_url(); ?>index.php/Admission_matric" class="<?php if($isselected == '5') {echo 'selected';}?>" >
                        <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                        Admission
                    </a>
                </li>
                <?php }?>
             <?php  if($isselected == '6'){?>
                
                <li>
                    <a href="<?php echo base_url(); ?>index.php/Registration_11th" class="<?php if($isselected == '6') {echo 'selected';}?>" >
                        <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                        Registration
                    </a>
                </li>
                <?php }?>
            </ul>
            <div class="clearfix">
            </div>
        </div>
        <div class="sub-nav">
            <?php
             if($isselected == '0') { 
                ?>
                <ul >
                    <li><a href="<?php echo base_url(); ?>index.php/BiseCorrection/slips9thcorrections"   data-original-title="" class="<?php if($isselected == '2') {echo 'heading';}?>">Registration</a></li>
                    <li>
                        <a href="<?php echo base_url(); ?>BiseCorrection/slips9thcorrections">
                            Registration Correction
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>BiseCorrection/BatchRelease">
                            Batch Release
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>BiseCorrection/BatchRestore">
                            Batch Restore
                        </a>
                    </li>

                   
                  <!--  <li>
                        <a href="<?php echo base_url(); ?>Registration/ProofReading">
                            Proof Reading
                        </a>
                    </li>-->
                </ul>
                <?php
            }
            if($isselected == '1') { 
                ?>
                <ul >
                    <li><a href="<?php echo base_url(); ?>index.php"  data-original-title="" class="<?php if($isselected == '1') {echo 'heading';}?>">Dashboard</a></li>
                    <!-- <li>
                    <a href="#notifications">
                    Notifications
                    </a>
                    </li>         -->
                </ul>
                <?php
            }
            if($isselected == '2') { 
                ?>
                <ul >
                    <li><a href="<?php echo base_url(); ?>index.php/Registration"   data-original-title="" class="<?php if($isselected == '2') {echo 'heading';}?>">Registration</a></li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Registration/NewEnrolment">
                            New Enrolement
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>Registration/ReAdmission">
                            Re-Admissions
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Registration/EditForms">
                            Edit Forms
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Registration/CreateBatch">
                            Create Batch
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Registration/batchlist">
                            Batch List
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Registration/FormPrinting">
                            Form Printing
                        </a>
                    </li>
                     <li>
                        <a href="<?php echo base_url(); ?>/index.php/Registration/Profile">
                            Profile
                        </a>
                    </li>
                     <li>
                         <a style="cursor: pointer" onclick="return logout();">Logout</a>
                    </li>
                  <!--  <li>
                        <a href="<?php echo base_url(); ?>Registration/ProofReading">
                            Proof Reading
                        </a>
                    </li>-->
                </ul>
                <?php
            }
            ?>
            <?php   // 9th admission
            if($isselected == '3'){
                ?>
                <ul >
                    <li><a href="<?php echo base_url(); ?>index.php/Admission"   data-original-title="" >Admission</a></li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Admission/StudentsData">
                          Students Data
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Admission/EditForms">
                            Edit Forms
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Admission/CreateBatch">
                            Create Batch
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Admission/BatchList">
                            Batch List
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Admission/FormPrinting">
                            Form Printing
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Admission/ProofReading">
                            Proof Reading
                        </a>
                    </li>

                </ul>
                <?php
            }
            ?>
               <?php
            if($isselected == '4'){
                ?>
                <ul >
                    <li><a href="<?php echo base_url(); ?>index.php/RollNoSlip"   data-original-title="" >Roll No. Slips: </a></li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/RollNoSlip/NinthStd">
                            9th Roll No. Slip
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/RollNoSlip/TenthStd">
                            10th Roll No. Slip
                        </a>
                    </li>
                      <li>
                        <a href="<?php echo base_url(); ?>index.php/RollNoSlip/EleventhStd">
                            11th Roll No. Slip
                        </a>
                    </li>
                      <li>
                        <a href="<?php echo base_url(); ?>index.php/RollNoSlip/InterStd">
                            12th Roll No. Slip
                        </a>
                    </li>
                    <li>
                        <a onclick="return logout();">Logout</a>
                    </li>
                   

                </ul>
                <?php
            }
            ?>
              <?php // matric admission
            if($isselected == '5'){
                ?>
                <ul >
                <li><a href="<?php echo base_url(); ?>index.php/Admission_matric"   data-original-title="" class="<?php if($isselected == '5') {echo 'heading';}?>">Admission</a></li>
                   
                   <!-- <li><a href="<?php echo base_url(); ?>index.php/Admission_matric"   data-original-title="" >Admission Matric</a></li>
                    <li>-->
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Admission_matric/StudentsData">
                          Old  Students 
                        </a>
                    </li>
                       <li>
                        <a href="<?php echo base_url(); ?>index.php/Admission_matric/FormPrinting">
                            Reports
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Admission_matric/EditForms">
                            Edit Form
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Admission_matric/CreateBatch">
                            Create Batch
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Admission_matric/BatchList">
                            Batch List
                        </a>
                    </li>
                 
                   
                    <li>
                        <a href="<?php echo base_url(); ?>/index.php/Admission_matric/Profile">
                            Profile
                        </a>
                    </li>
                     <li>
                         <a style="cursor: pointer" onclick="return logout();">Logout</a>
                    </li>

                </ul>
                <?php
            }
            ?>
            <?php
            // Inter Registration
            if($isselected == '6') { 
                ?>
                <ul >
                    <li><a href="<?php echo base_url(); ?>index.php/Registration_11th"   data-original-title="" class="<?php if($isselected == '6') {echo 'heading';}?>">Registration</a></li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Registration_11th/Students_matricInfo">
                          Old Students 
                        </a>
                    </li>
                   <!-- <li>
                        <a href="<?php echo base_url(); ?>Registration_11th/ReAdmission">
                            Re-Admissions
                        </a>
                    </li>-->

                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Registration_11th/EditForms">
                            Edit Forms
                          <!-- <div id="divEditFormsCount" class="popDiv" style="    background-color: red;    position: relative;    top: -25px;    left: 83px;    display: block;    visibility: visible;    width: 23px;    text-align: center;"><?php //echo @$editformcount; ?></div>-->
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Registration_11th/CreateBatch">
                            Create Batch
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Registration_11th/batchlist">
                            Batch List
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Registration_11th/FormPrinting">
                            Form Printing
                        </a>
                    </li>
                     <li>
                        <a href="<?php echo base_url(); ?>/index.php/Registration_11th/Profile">
                            Profile
                        </a>
                    </li>
                     <li>
                         <a style="cursor: pointer" onclick="return logout();">Logout</a>
                    </li>
                  <!--  <li>
                        <a href="<?php echo base_url(); ?>Registration/ProofReading">
                            Proof Reading
                        </a>
                    </li>-->
                </ul>
                <?php
            }
            ?>
            <div class="btn-group pull-right">
                <button class="btn btn-primary">
                    Main Menu
                </button>
                <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">
                    <span class="caret">
                    </span>
                </button>
                <ul class="dropdown-menu pull-right">
                    <li>
                        <a href="index.html" data-original-title="">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>Registration.php" data-original-title="">
                            Registration
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>Admission.php" data-original-title="">
                            Admission
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>Result.php" data-original-title="">
                            Result
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>Profile.php" data-original-title="">
                            Profile
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </body>
</html>
