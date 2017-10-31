
<div class="dashboard-wrapper">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title">
                           <span> Exam Matric  <?php  if(Session == 1) echo  "Annual"; else if(Session == 2) echo "Supply"; echo ', '.Year; ?></span>
                        </div>
                          <img src="<?php echo base_url(); ?>assets/img/lastdate.png" alt="Last Date." class="span3" title="Last Date." style="height: 100%; float:right;" />
                    </div>
                    <div class="widget-body">
                        <!--FORM START-->
                        <form enctype="multipart/form-data" id="options" name="options" method="post" action="" >
                            <table>
                                <tr>
                                    <td ><label class="welcome_note myEngheading" >Exam Matric <?php if(Session == 1) echo  "Annual"; else if(Session == 2) echo "Supply"; ?>, <?php echo Year;?></label></td>
                                    <td><label class="myUrduheading">   امتحان میٹرک  <?php  if(Session == 1){ echo' سالانہ';}else if(Session == 2){ echo' سپلی ';} echo Year; ?></label></td>
                                </tr>
                                <tr>
                                    <td width="50%">
                                        <label class=myEngParagraph >  Note:-Last Date of Online Admissions and Submission of Hard Copy for Matric <?php if(Session == "1"){echo "Annual";} else echo "Supply" ?> Examination with (Double fee) is <b style="color: red;font-size: 20px;"> <?php echo DoubleDateFee9th ?></b>.</label>  
                                    </td>
                                    <td width="50%"  >
                                        <label class=myUrduParagraph>داخلہ فارسنگل فیس کے ساتھ آن لائن کرنے اور بھجوانے کی آخری تاریخ     <label class="label" style="color: red;font-size: 18px;"> <?php echo DoubleDateFee9th; ?> </label>  ہے                                         </label>
                                    </td>
                                </tr>
                            </table>

                            <div align="center" style="    font-size: 19px; margin-top: -14px; font-weight: bold;" >
                                <input type="radio" class="nationality_class" id="candidate1" value="1" checked="checked" name="candidate" style="width:27px; height:27px;">
                                Private Candidate
                                <input type="radio" class="nationality_class" id="candidate3" value="2" name="candidate" style="width:27px; height:27px;">
                                Regular Candidate </br>
                            </div>
                            <div style="vertical-align:bottom;margin-top: 20px; font-weight: bold;">
                                <input type="button" value="Next" id="proceed" name="proceed" class="jbtn jmedium jblack">
                                <!-- <input type="button" value="Cancel" onclick="window.location='#';" class="jbtn jmedium jblack"> -->
                            </div>
                        </form>

                        <hr />
                        <div class="info"  style="position:relative;margin:0;padding:0;overflow:hidden;">
                            <!--FORM START-->
                            <form id="registration" name="registration" method="post" action="<?php base_url(); ?>Admission/checkFormNo_then_download">
                                <table width="100%">
                                    <tr>
                                        <td width="50%">
                                            <label class="welcome_note myEngheading">Download Your Already Feeded Form</label>
                                        </td>
                                        <td width="50%" >
                                            <label class=myUrduheading>آن لائن داخلہ فارم یہاں سے ڈونلوڈ کیجیے</label>
                                        </td>
                                    </tr>
                                </table>
                                <div align="center" >
                                <table>
                                    <tr>
                                        <th><b style="margin-left: 2px;">Form No. : <img src="<?php echo base_url(); ?>assets/css_matric/img/required.png" alt="Required Field." class="tooltip" title="Required Field." /></b></th>
                                        <td><input type="text" style=" font-size: 22px; width:96%; padding: 4px; color: #5b5b5b; border: 1px solid #dcdcdc; -moz-border-radius: 3px; -webkit-border-radius: 3px;"  id="formid" name="formid" maxlength="6" required="required"></td>
                                    </tr>
                                    <!-- <tr>
                                    <th><b style="margin-left:2px;">Date Of Birth:</b><img src="<?php echo base_url(); ?>assets/css_matric/img/required.png" alt="Required Field." class="tooltip" title="Required Field." /></th>
                                    <td><input readonly="readonly" type="text" style=" font-size: 22px; width:96%; padding: 4px; color: #5b5b5b; border: 1px solid #dcdcdc; -moz-border-radius: 3px; -webkit-border-radius: 3px;" id="dob" name="dob" required="required">
                                    </td>
                                    </tr> -->
                                    <tr>
                                        <th> <br />
                                        </th>
                                        <td><span style="vertical-align:bottom;margin-top: 20px;">
                                            <input type="button" value="Download" name="btndwnForm" id="btndwnForm" class="jbtn jmedium jblack" />
                                        </span> </td>
                                    </tr>
                                </table>

                            </form>

                            <hr />
                            <table width="100%">
                                <tr><td width="50%">
                                        <label class="myEngParagraph">In case of any problem regarding Admissions, please send us email on </label>
                                    </td> <td width="50%"> <label class="myUrduParagraph">براے مہربانی آن لائن داخلہ فارم مے کسی مسلے کی صورت مے دیے گیے ای میل ایڈریس پر میل کیجیے </label></td></tr></table>
                            <div style=";">
                                <br/> <span style="font-weight:bold; font-size:24px; font-family:Verdana, Geneva, sans-serif; color:#F00" > complaint4bisegrw@gmail.com </span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="clearfix">
                </div>
            </div>
        </div>
    </div>
</div>
</div>









