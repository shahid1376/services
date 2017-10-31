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
        <link href="<?php echo base_url(); ?>assets/css/datatables.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">

        <!--[if lte IE 7]>
        <script src="css/icomoon-font/lte-ie7.js">
        </script>
        <![endif]-->
       <style type="">
       #data-table_length label, .dataTables_filter  label{
               color: #333 !important;
       }
       </style>
    </head>
    <body style="background-color: white !important;">                               
        <div class="left-sidebar">
            <div id="header">
                <div class="inHeaderLogin">
                    <a href="" title="BISE Gujranwala" rel="home"><img style="margin-top: 9px;text-align:left;width:150px;float: left;margin-left: 25%;" src="<?php echo base_url(); ?>assets/img/icon.png" alt="Logo BISE GRW"></a>
                    <!--Intimation-->
                    <p style="color: wheat;text-align: center;font-size: 23px;margin-left: 28px;float: left;  margin-top:55px;">Board of Intermediate & Secondary Education, Gujranwala </br></br> <?= CURRENT_SESS_YEAR?> </p>
                </div>
            </div> 
            <div id="page">
               
             
                <div id="resultsDiv" style="margin-bottom: 40px;min-height: 473px;">
                    <div style="  color: #246785;font-size: 20px;     margin-bottom:  35px;     display: inline-block;    margin-left: 75px;"> Gazette & CD Password: <b style="color: red;font-size: 22px;" >hssc@bisegrw</b></div>
                    <?php 
                    //  DebugBreak();
                    if(@$isfound == -1)
                    {
                        echo "<p style='color: red;font-size: 24px;font-weight: bold;    text-align: center;    margin-bottom: 20px;'>Record Not Found. Please Enter Valid Roll Numnber/Name.</p>";
                    }

                    else if( @$isfound ==1)
                    {

                        include "ia12presult.php";  
                    }   ?>
                   

               
                
              
                       
                        <div style="background-color: #4C5A65;    display: table-cell;    color: #DDDDDD;     -moz-border-radius: 16px;     -webkit-border-radius: 16px;  height: 90px;   font-size: 23px;  margin-top: 0px;vertical-align: middle;text-align: center;" >
                        You can also check detailed result by sending Roll No. to <b>800299 </b>through SMS   <br/></div>
                   </div>

                     </div>

                     

            <div id="header" style=" position: absolute;left: 50%;transform: translate(-50%, -50%);margin: 0 auto;">


                <div class="inFooterLogin">
                    <div id="copyright" style="    color: wheat;font-size: 16px;padding-top: 20px;text-align: center;">
                        © 2016 <a href="http://www.bisegrw.com"  style="color: wheat;">www.bisegrw.com</a> | Powered by Bisegrw  Development Team 
                    </div>
                </div>
            </div> 
        </div>
        <!--/.fluid-container-->
        <a href="http://www.bisegrw.com/home.php" target="blank" style="position: fixed; border: none; text-decoration: none; width: 30px; height: 74px; right: 0px; top: 55px; display: block; overflow: hidden; background: url(&quot;../../../assets/img/silver.png&quot;) 0% 0% no-repeat;"></a>

        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/script.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bttz1.js"></script>

        <script type="text/javascript">
            
            $("#btn-print").live("click", function () {
                var divContents = $("#printres").html();
                var printWindow = window.open('', '', 'height=400,width=800');
                printWindow.document.write('<html><head><title>Inter (Annual) Examination, 2016</title>');
                printWindow.document.write('</head><body >');
                printWindow.document.write(divContents);
                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.print();
            });

            $(document).bind("keyup keydown", function(e){
                if(e.ctrlKey && e.keyCode == 80){
                    var divContents = $("#resultsDiv").html();
                    var printWindow = window.open('', '', 'height=400,width=800');
                    printWindow.document.write('<html><head><title>Inter (Annual) Examination, 2016</title>');
                    printWindow.document.write('</head><body >');
                    printWindow.document.write(divContents);
                    printWindow.document.write('</body></html>');
                    printWindow.document.close();
                    printWindow.print();
                }
            });
            function Result_Print(rno)
            {
                var win = window.open('<?=base_url()?>Result/Result_Print_datagrid/'+rno, '_blank');
                win.focus();
            }
        </script> 
    </body>
</html>