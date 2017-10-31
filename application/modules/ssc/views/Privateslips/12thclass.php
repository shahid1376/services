<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Roll No Slip | Board Of Intermediate And Secondary Education Gujranwala |bisegrw.com</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Copyright" content="BISEGRW.COM">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="bisegrw.com">
        <meta name="language" content="">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.8.23.custom.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/styleprivateslip.css" />
        <style type="text/css" title="currentStyle">
            @import "css/demo_table_jui.css";
            @import "css/jquery-ui-1.8.4.custom.css";
        </style>   



        <script type="text/javascript">

            $(document).ready(function(){

                $("#btn").click(function(){

                    var nic = $("#fnic").val();
                    var mob = $("#mno").val();    
                    var regno = $("#regno").val();
                    var std_name = $("#std_name").val();
                    var fath_name = $("#fath_name").val();


                    if(std_name == "" || fath_name == "" || nic == "" ){
                        $(".error").text('Please Enter Student Name,Father name & Father CNIC.').show();    

                        return false;
                    }


                    else{
                        return true;
                    }


                });
                $("#btnreg").click(function(){



                    var regno = $("#regno").val();

                    if( regno== ""){
                        $(".errorReg").text('Please Enter Registration No').show();
                        return false;
                    }

                    else{
                        return true;
                    }


                });

                $("#submit_btn").click(function(){
                    var roll_no  = $("#cur_exm_roll_no").val();
                    if(roll_no == ""){
                        $(".msg").text('Please Enter the Roll No.').show();    
                        return false;
                    }     
                });

                $("#formno_btn").click(function(){
                    var form_no  = $("#form_no").val();
                    if(form_no == ""){
                        $(".msg2").text('Please Enter the Form No.').show();    
                        return false;
                    }     
                });


                $("input[type=text]").click(function(){
                    $(".error,.msg,.msg2").hide();    
                });
                // document.getElementById("record_form").style.display = "none";

                $('input[name="type"]').on('change', function() {
                    // this, in the anonymous function, refers to the changed-<input>:
                    // select the element(s) you want to show/hide:
                    // //debugger;
                    $('.Form_NO') .toggle(+this.value === 1 && this.checked);    
                    $('.Roll_NO') .toggle(+this.value === 2 && this.checked);
                    $('.persnal_info') .toggle(+this.value === 3 && this.checked);
                    // pass a Boolean to the method, if the numeric-value of the changed-<input>
                    // is exactly equal to 2 and that <input> is checked, the .business-fields
                    // will be shown:

                    // trigger the change event, to show/hide the .business-fields element(s) on
                    // page-load:
                }).change();

                $('.Form_NO').show(); 



            });    

            function downloadslippvtPersonal()
            {
                var Name = $('#std_name').val();
                var FName = $('#fath_name').val();
                var FNIC = $('#fnic').val();
                var FormNo = '';
                var rno = '';
            }
            function downloadslippvtFormNo()
            {
                var Name = '';
                var FName = '';
                var FNIC = '';
                var FormNo = $('#form_no').val();
                var rno = '';
            }
            function downloadslippvtRno()
            {

                var Name = '';
                var FName = '';
                var FNIC = '';
                var FormNo = '';
                var rno = $("#cur_exm_roll_no").val();
                //alert(rno);
            }

        </script> 

    </head>
    <style type="text/css">
        .Form_NO{}
        .Roll_NO{}
        /* <![CDATA[ */
        /* ]]> */
    </style>
    <body >
        <div class="main_bg_container">
            <div id="header">
                <div class="inHeaderLogin">
                    <a href="" title="BISE Gujranwala" rel="home"><img style="margin-top: 9px;text-align:left;width:150px;float: left;margin-left: 14px;" src="http://www.bisegrw.com/bisegrw/assets/img/icon.png" alt="Logo BISE GRW"></a>
                    <!--Intimation-->
                    <p style="color: wheat;text-align: center;font-size: 23px;margin-left: 28px;float: left;  margin-top:35px;">Board of Intermediate & Secondary Education, Gujranwala </br></br> Download Roll Number Slip For INTER Annual 2016</p>
                </div>
            </div> 
            <div id="wraper2">
                <fieldset >
                    <div class="inner_wraper">

                   
                        <label>
                            <input type="radio" name="type" checked="checked" value="1" >By Form No.</label>
                        <label>
                            <input type="radio" name="type" value="2">By Roll No.</label>
                        <label>
                            <input type="radio" name="type" value="3">By Personal Informaiton</label>
 <br />
 <br />
                             <b style="color: red;margin-left: 260px;font-size: 20px;"><?= $message?></b>
                   
                        <div class="persnal_info">
                            <label class="error" style="display:none;"></label>
                            <form name="std_fth_dob_frm" id="std_fth_dob_frm" action="<?=base_url()?>/index.php/Privateslips/Getpvt12RSlip" method="post">
                                <fieldset >
                                    <legend><h2>Personal Information</h2></legend>

                                    <div class="student_info">

                                        <p>Student Name :</p>

                                        <input type="text" class="contact_textBox required" required name="std_name" id="std_name" >

                                        <br clear="all" />

                                    </div>

                                    <div class="student_info">

                                        <p>Father Name :</p>

                                        <input type="text" class="contact_textBox required" required name="fath_name" id="fath_name" />
                                        <input type="hidden" class="contact_textBox required number" name="cur_exm_roll_no" id="cur_exm_roll_no" maxlength="15" value="" />
                                        <input type="hidden" class="contact_textBox required number"  name="form_no" id="form_no" maxlength="15" value="" />

                                        <br clear="all" />

                                    </div>


                                    <div class="student_info">

                                        <p>Father CNIC:</p>

                                        <input type="text" class="contact_textBox " name="fnic" id="fnic" required />
                                        <label style=" padding:0px 0px 0px 210px">example: (12345-6789123-4)</label>
                                        <br clear="all" />

                                    </div>




                                    <div class="student_info">


                                        <input type="submit" value="Get Roll No. Slip" id="proceed" name="proceed" class="jbtn jmedium jblack" style=" margin-left: 262px;" onclick="downloadslippvtPersonal()">

                                        <br clear="all" />

                                    </div>
                                </fieldset>
                            </form>


                        </div>


                        <div class="Form_NO">
                            <label class="msg2 error" style="display:none;"></label><br />
                            <form name="formno" id="formno" action="<?=base_url()?>/index.php/Privateslips/Getpvt12RSlip" method="post">
                                <fieldset>
                                    <div class="student_info">

                                        <br />
                                        <p>Form No :</p>
                                        <input type="text" class="contact_textBox required number" required name="form_no" id="form_no" maxlength="6" />
                                        <input type="hidden" class="contact_textBox required number" name="cur_exm_roll_no" id="cur_exm_roll_no" maxlength="15" value="" />
                                        <input type="hidden" class="contact_textBox required number" name="fath_name" id="fath_name" maxlength="15" value="" />
                                        <input type="hidden" class="contact_textBox required number" name="fnic" id="fnic" maxlength="15" value="" />
                                        <input type="hidden" class="contact_textBox required number" name="std_name" id="std_name" maxlength="15" value="" />

                                        <br clear="all" />
                                    </div>

                                    <div class="student_info">

                                        <p></p>

                                        <input type="submit" value="Get Roll No. Slip" id="proceed" name="proceed" class="jbtn jmedium jblack" style=" margin-left: 262px;" onclick="downloadslippvtFormNo()">

                                        <br clear="all" />
                                    </div>
                                </fieldset>
                            </form>

                        </div>

                        <div class="Roll_NO">

                            <label class="msg error" style="display:none;"></label><br />
                            <br />

                            <form name="cur_exm_roll_frm" id="cur_exm_roll_frm" action="<?=base_url()?>/index.php/Privateslips/Getpvt12RSlip/" method="post">
                                <fieldset>
                                    <div class="student_info">
                                        <p>Current Exam Roll No :</p>
                                        <input type="text" class="contact_textBox required number" required name="cur_exm_roll_no" id="cur_exm_roll_no" maxlength="6" />
                                        <input type="hidden" class="contact_textBox required number" name="fath_name" id="fath_name" maxlength="15" value="" />
                                        <input type="hidden" class="contact_textBox required number" name="fnic" id="fnic" maxlength="15" value="" />
                                        <input type="hidden" class="contact_textBox required number" name="std_name" id="std_name" maxlength="15" value="" />
                                        <input type="hidden" class="contact_textBox required number" name="form_no" id="form_no" maxlength="15" value="" />
                                        <br clear="all" />
                                    </div>
                                    <div class="student_info">
                                        <p></p>
                                        <input type="submit" value="Get Roll No. Slip" id="proceed" name="proceed" class="jbtn jmedium jblack" style=" margin-left: 262px;" onclick="downloadslippvtRno()">
                                        <br clear="all" />
                                    </div>
                                </fieldset>
                            </form>

                        </div>

                       <img src="<?php echo base_url(); ?>assets/img/Note00.jpg" alt="" style="    width: 700px;margin-top:15px;" />

                    </div>
                </fieldset>
            </div>

        </div>
        </div>
        <div id="copyright">
            &copy; 2016 <a href="http://www.bisegrw.com">www.bisegrw.com</a> | Powered by Bisegrw &amp; Development Team 
    </div>   </body>
</html>
