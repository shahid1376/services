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

        <link href="<?php echo base_url(); ?>assets/css/icomoon/styleprivateslip.css" rel="stylesheet">   
        <link href="<?php echo base_url(); ?>assets/css/icomoon/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/styles.css" rel="stylesheet">

        <!--[if lte IE 7]>
        <script src="css/icomoon-font/lte-ie7.js">
        </script>
        <![endif]-->

    </head>
    <body style="background-color: white !important;">                               
        <div class="left-sidebar">
            <div id="header">
                <div class="inHeaderLogin">
                    <a href="" title="BISE Gujranwala" rel="home"><img style="margin-top: 9px;text-align:left;width:150px;float: left;margin-left: 25%;" src="<?php echo base_url(); ?>assets/img/icon.png" alt="Logo BISE GRW"></a>
                    <!--Intimation-->
                    <p style="color: wheat;text-align: center;font-size: 23px;margin-left: 28px;float: left;  margin-top:55px;">Board of Intermediate & Secondary Education, Gujranwala </br></br> Matric Annual Result 2016 </p>
                </div>
            </div> 
            <div id="page">
                <form id="searchForm" method="post">
                    <fieldset>

                        <input name="keyword" type="text" required="required" id="s">

                        <input type="submit" value="Submit" id="submitButton">

                        <div id="searchInContainer">
                            <input type="radio" name="check" value="byrno" id="searchSite" checked="">
                            <label for="searchSite" id="siteNameLabel">Search by Roll No</label>

                            <input type="radio" name="check" value="byname" id="searchWeb">
                            <label for="searchWeb">Search by Name</label>
                        </div>



                    </fieldset>
                </form>

                <div id="resultsDiv"></div>
            </div>
            <div id="header" style=" position: fixed;left: 50%;bottom: -30px;transform: translate(-50%, -50%);margin: 0 auto;">
                <div class="inFooterLogin">
                    <div id="copyright" style="    color: wheat;font-size: 16px;padding-top: 20px;text-align: center;">
                        © 2016 <a href="http://www.bisegrw.com" style="color: wheat;">www.bisegrw.com</a> | Powered by Bisegrw  Development Team 
                    </div>
                </div>
            </div> 
        </div>
        <!--/.fluid-container-->
        <a href="http://www.bisegrw.com/" target="blank" style="position: fixed; border: none; text-decoration: none; width: 30px; height: 74px; right: 0px; top: 55px; display: block; overflow: hidden; background: url(&quot;../assets/img/silver.png&quot;) 0% 0% no-repeat;"></a>

        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/script.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bttz.js"></script>
        <script type="text/javascript">
            $('a').tooltip('hide');
            $('.popover-pop').popover('hide');
            //Collapse
            $('#myCollapsible').collapse({
                toggle: false
            })
        </script> 
    </body>
</html>