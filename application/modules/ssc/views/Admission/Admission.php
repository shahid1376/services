
<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">

        <div class="row-fluid">
            <div class="span12">
                <div class="widget no-margin">
                    <div class="widget-header">
                        <div class="title">
                            Matric Admission Dashboard<a data-original-title="" id="notifications">s</a>
                        </div>

                    </div>
                    <div class="widget-body">
                        <h1    style="text-align: center;"><font color="#000000" size="+1" >Note:-Last Date of Online Admission for Matric without late fee is <b class="blink_text"> 16th, May 2016</b></font></h1>
                        <h4>Welcome to Board of Intermediate &amp; Secondary Education, GUJRANWALA</br></br> &nbsp; Dashboard</h4>


                        <div class="shortcutHome">
                            <a href="<?php echo base_url(); ?>Registration/NewEnrolment"><img src="<?php echo base_url();?>assets/img/enrolment.png"><br>New-Registration</a>
                        </div>
                        <!--  <div class="shortcutHome">
                        <a href="GetInfo.php"><img src="<?php echo base_url();?>assets/img/enrolment.png"><br>Re-Admission</a>
                        </div>  -->    
                        <div class="shortcutHome">
                            <a href="<?php echo base_url(); ?>Registration/EditForms"><img src="<?php echo base_url();?>assets/img/edit_form.png"><br>Edit Form</a>
                        </div>
                        <div class="shortcutHome">
                            <a href="<?php echo base_url(); ?>Registration/FormPrinting"><img src="<?php echo base_url();?>assets/img/reports.png"><br>Printing </a>
                        </div>
                        <div class="shortcutHome">


                            <a href="<?php echo base_url(); ?>Registration/CreateBatch"><img src="<?php echo base_url();?>assets/img/batch_list.png"><br>Create Batch</a> 

                        </div>


                        <div class="shortcutHome">
                            <a href="<?php echo base_url(); ?>Registration/batchlist"><img src="<?php echo base_url();?>assets/img/lists.png"><br>Batch List</a>
                        </div>

                        <div class="shortcutHome">
                            <a href="<?php echo base_url(); ?>/login/logout"><img src="<?php echo base_url();?>assets/img/logout_icon.png"><br>Logout</a>
                        </div>

                        <div class="clear"></div>
                        <div class="clear"></div>

                        <div id="smallRight" style="    float: left;margin-left: 20px;    margin-right: 380px;">
                            <h4>Information</h4>
                            <table>
                                <tbody>
                                    <tr>
                                        <td style="border: none;padding: 4px;">Logged ID :</td>
                                        <td style="border: none;padding: 4px;"><b><?php  echo $Inst_id ?></b></td>
                                    </tr>
                                    <tr>
                                        <td style="border: none;padding: 4px;">Name :</td>
                                        <td style="border: none;padding: 4px;width:190px;"><b><?php
                                                echo $Inst_name     
                                            ?></b></td>
                                    </tr>
                                    <tr>

                                </tbody>
                            </table>
                        </div>
                        <div id="smallRight">
                            <h4>Current Report</h4>
                            <table>
                                <tbody>
                                    <tr>
                                        <td style="border: none;padding: 4px;">Total Entries:</td>
                                        <td style="border: none;padding: 4px;">
                                            <b><?php
                                                echo      $count[0]['Total_Entries'];
                                        ?></b>                                </td>
                                    </tr>

                                    <tr>
                                        <td style="border: none;padding: 4px;">Total Batched:</td>
                                        <td style="border: none;padding: 4px;"><b>
                                                <b><?php
                                                    echo     $count[0]['Total_Batched'];
                                                ?></b>                                
                                            </b></td>
                                    </tr>



                                    <tr>
                                        <td style="border: none;padding: 4px;">&nbsp;</td>
                                        <td style="border: none;padding: 4px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="border: none;padding: 4px;">&nbsp;</td>
                                        <td style="border: none;padding: 4px;">&nbsp;</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="clear"></div>
                        <div style="  margin-top: 10px;margin-left: 20px;font-size: 16px;">
                            <!--    ( <a href="#" class="guidlines">Read Instruction's Guide</a>  ) -->
                            <br/>
                            <a href="http://www.bisegrw.com/download/online/registration/Training_Manual_9th_Registration_Central_Software_Urdu.pdf" target="_blank" class="guidlines blink_text" style="font-size: 18px;">Download 9th Registration Training Manual. </a> <br/>
                            <a href="<?php echo base_url(); ?>/assets/img/ForwardingLetter.pdf" target="_blank" class="guidlines blink_text" style="font-size: 18px;">Download Farwarding letter. </a> <br/>
                            <a href="<?php echo base_url(); ?>/assets/img//Image_error.pdf" class="guidlines blink_text" target="_blank" style="font-size: 18px;">Instruction for Error occured due to Image uploading. </a>
                            <br /><br />
                            <strong>NOTE:</strong> <br/>
                            1. Please upload photo of student carefully and with good quality as this picture will be used in his/her matriculation Roll Number Slip/Result Card/certificate.<br /> 
                            2. Fill correct Address of candiate as now governmet often demand addresses of regular candidates also from Board, for various purposes. i.e, Laptop Distribution, Soler Panel distribution, scholership etc.<br /> 
                            3. In case of any problem regarding registration, please send us email on <span style="font-weight:bold; font-family:Verdana, Geneva, sans-serif; font-style:italic; color:#00F" > complaint4bisegrw@gmail.com </span>
                            with your <span style="font-weight:bolder; "> User Id, Password,  Contact No. </span>  and description of problem. <br />
                            4. Please <span style="font-weight:bold; font-family:Verdana, Geneva, sans-serif;  color:#F24F00" > Ensure Mobile Number of student/Gaurdian must be correct.</span> As now Board Send Roll Number Slips information, result information and any other information regarding student's exam through SMS, and in case of
                            any problem of student's data , Board also contact to student on his mobile number.  <br/>
                            5.Picture size must be less than  20 kb, and use only Passport size with small letter ".jpg" extention image.
                        </div>
                    </div>      
                    <div class="clear"></div>  

                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>
</div>

