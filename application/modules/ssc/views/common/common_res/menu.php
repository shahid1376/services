<html>
    <body>
        <div class="container-fluid">
        <div class="dashboard-container">
        <div class="top-nav">
            <ul>
              

                    <?php 
                if($isselected == '4'){?>

                    <li>
                        <a style="width: 115px;" href="<?php echo base_url(); ?>dashboard9th" class="<?php if($isselected == '4') {echo 'selected';}?>" >
                            <div class="fs1" aria-hidden="true" data-icon="&#xe032;"> </div>
                            Result Cards
                        </a>
                    </li>
                    <?php } ?>
                    
            </ul>
            <div class="clearfix">
            </div>
        </div>
        <div class="sub-nav">
          
          
            <?php
            if($isselected == '4'){
                ?>
                 <ul >
                    <li><a   data-original-title="" >Result Cards: </a></li>
                   
                   <?php if($edu_lvl == 1 ) {?>
                    <li>
                        <a href="<?php echo base_url(); ?>Result/dashboard9th">
                            9th Result Cards
                        </a>
                    </li>
                    <?php } 
                    
                   else if($edu_lvl == 2  ) 
                     {
                    ?>
                    <li>
                        <a href="<?php echo base_url(); ?>Result/dashboard12th">
                            12th Result Cards
                        </a>
                    </li>
                   <?php }
                   
                       else if($edu_lvl == 3  ) 
                       {    ?>
                           
                            <li>
                        <a href="<?php echo base_url(); ?>Result/dashboard12th">
                            12th Result Cards
                        </a>
                    </li>
                      <li>
                        <a href="<?php echo base_url(); ?>Result/dashboard9th">
                            9th Result Cards
                        </a>
                    </li>     
                           
                     <?php  }
                   ?>
                   
                 
                    <li>
                        <a onclick="return logout();">Logout</a>
                    </li>


                </ul>
                <?php
            }?>

                
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

