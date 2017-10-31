
<html lang="en"><!--
    <![endif]--><head>
        <meta charset="utf-8">
        <title>
             BISE GRW - BOARD OF INTERMEDIATE AND SECONDARY EDUCATION GUJRANWALA
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- bootstrap css -->

        <link href="<?php echo base_url(); ?>assets/css/icomoon/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet"> <!-- Important. For Theming change primary-color variable in main.css  -->
        <!--[if lte IE 7]>
        <script src="css/icomoon-font/lte-ie7.js">
        </script>
        <![endif]-->

    </head>
    <body style="background-color: #f7f7f7;">


        <div class="container-fluid">
            <div class="dashboard-container">

                <div class="dashboard-wrapper">
                    <div class="left-sidebar">

                        <div class="row-fluid">

                            <div class="span12">
                                <div class="sign-in-container">
                                    <form action="#" class="login-wrapper" method="post">
                                        <div class="header">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <h3>Login<img src="<?php echo base_url(); ?>assets/img/BISEGRW_Icon_1.png" alt="Logo" class="pull-right"></h3>
                                                    <p>Fill out the form below to login.</p>
                                                    <?php 
                                                  
                                                    if($user_status == 1)
                                                    {
                                                        echo "<b style='color: #f63131;    font-size: 15px;'>Invalid Institute Code & Password.</b>";
                                                    }
                                                    else if($user_status == 2)
                                                    {
                                                        echo "<b style='color: #f63131;    font-size: 15px;'>Only Schools are allowed to downlaod slips.</b>";
                                                    }
                                                     else if($user_status == 3)
                                                    {
                                                        echo "<b style='color: #f63131;    font-size: 15px;'>Currently your account is inActive.</b>";
                                                    }
                                                      else if($user_status == 4)
                                                    {
                                                        echo "<b style='color: #f63131;    font-size: 13px;'> Your Registration Returns (2014-2016) not submitted. Please contact to Online Registration Branch B.I.S.E. Gujranwala.</b>";
                                                    }
                                                      else if($user_status == 5)
                                                    {
                                                        echo "<b style='color: #f63131;    font-size: 13px;'> Plaese wait some maintaince.</b>";
                                                    }
                                                       else if($user_status == 6)
                                                    {
                                                        echo "<b style='color: #f63131;    font-size: 13px;'>  Your Institution Students are not Enrolled in Matric Annual 2016.</b>";
                                                    }
                                                     else if($user_status == 7)
                                                    {
                                                        echo "<b style='color: #f63131;    font-size: 13px;'>  Only Registration branch allowed to login.</b>";
                                                    }
                                                  /*  if(isset($_POST['btnLogin'])) {
                                                        $btnLogin = ($_POST['btnLogin']);
                                                    }
                                                    if(isset($_POST['txtInstCode'])) {
                                                        $txtInst_Code = $_POST['txtInstCode'];    
                                                    }
                                                    if(isset($_POST['txtInstPassword'])){
                                                        $txtInst_Password = $_POST['txtInstPassword'];   
                                                    }



                                                    if(isset($btnLogin) && isset($txtInst_Code) && !empty($txtInst_Code) && isset($txtInst_Password) && !empty($txtInst_Password)){
                                                        if(!is_numeric($txtInst_Code)){
                                                            echo "<b>Invalid Institute Code.</b>";
                                                        } else {
                                                            $login = New Login();
                                                            $login->getLogin($txtInst_Code, $txtInst_Password);
                                                        }
                                                    }         */
                                                    ?>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="content">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <input class="input span12 email" id="" name="username" placeholder="Employee Code" required="required" maxlength="4" type="text">
                                                </div>
                                            </div>
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <input class="input span12 password" id="" name="password" placeholder="Password" required="required" type="password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="actions">
                                            <input  class="btn-large pull-right btn-info" name="btnLogin" type="submit" value="Login" style="height: 50px; width: 100px;" >
                                            <!-- <a class="link" href="#">Forgot Password?</a>-->
                                            <div class="clearfix"></div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>


                    </div>

                </div>
            </div>
            <!--/.fluid-container-->
        </div>
        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
        <script type="text/javascript">
            $('a').tooltip('hide');
            $('.popover-pop').popover('hide');
            //Collapse
            $('#myCollapsible').collapse({
                toggle: false
            })
        </script>

    </body></html>