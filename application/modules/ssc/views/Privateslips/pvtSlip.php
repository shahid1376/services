<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>Roll No Slips</title>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/styleprivateslip.css" />
            <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/privateSlip.css" />
            <style type="text/Css">
                <!--

                body {
                    margin-top: 20px;
                    /*   margin-bottom: 2px;
                    margin-left:20px;
                    margin-right:20px;*/
                    padding: 0;


                }

                .page {
                    width: 25cm;
                    min-height: 29.7cm;
                    padding: 1cm;
                    margin: 1cm auto;
                    border: 1px #D3D3D3 solid;
                    border-radius: 5px;
                    background: white;
                    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
                }


                @page {
                size: A4;
                margin: 0;
            }
            @media print {
                .page {
                    margin-top: 20px;
                    border: initial;
                    border-radius: initial;
                    width: initial;
                    min-height: initial;
                    box-shadow: initial;
                    page-break-after: always;
                }


            }

        </style>
        <style>
            @media print {
                .header, .hide { visibility: hidden }
            }
        </style>
    </head>


    <body onLoad="PrintFunction()">
        <script>
            function PrintFunction()
            {
                window.print();
            }
        </script>

        <div id="wraper" style="height:700px; border: solid 2px;padding-top: 25px;padding-left: 18px; padding-bottom: 365px; ">
            <!--<a class="srch" href="index.php" style="color:blue;text-decoration:underline;">Search Again</a>-->

            <div class="header2">
                <img src="<?php echo base_url(); ?>assets/img/icon2.png" width="120" height="120" style="margin-top: -26px;">
                <h2 class="text_center" style="margin-top: -113px;">Board of Intermediate &amp; Secondary Education, Gujranwala </h2>
               <!-- Intimation-->
                <h4 class="text_center" style="margin-top:10px">Roll Number Slip For S.S.C Annual Examination, 2016</h4>
            </div>

            <div class="info_box">
                <div class="rollNo">Roll No:&nbsp;<?php echo $Rno; ?></div>
                <br clear="all" />
            </div>
            <div class="info_box">
                <p> Name :</p>
                <b><?php echo $Name; ?></b>
                <br clear="all" />
            </div>
            <div class="info_box">
                <p> Father Name :</p>
                <b> <?php echo $FathersName; ?></b>
                <br clear="all" />
            </div>

            <div class="info_box">
                <p>Exam Center :</p>
                <b> <?php echo $cent_cd.'-'.$Cent_Name; ?> </b>
                <br clear="all" />
            </div>
            <div style="position: relative;">
                <!-- <div class="bg"><img src="images/Logo1.jpg"/></div>-->
                <?php
                 $countter = 0;
                     $countter9 = 0;
                    if(@$slips[0]['subp2count']>0) {
                ?>
                <div  style="margin-top:20px;font-size: 16px;"><h4>THEORY PART - II</h4></div>
                <div class="table" style="margin-top:-15px;border:none;">
                    <?php 
                   
                    
                        for($k = 0; $k<$slips[0]['subp2count']; $k++) { 

                            if($slips[$k]['class'] == 10) {
                                $countter++;
                                ?>
                                <div>
                                    <div class="seria_no" style="width:auto;"><?= $countter . '.    '?>  <?= $slips[$k]['sub_Name'].' = '?>
                                        <?= $slips[$k]['Date2'].' = '?>
                                        <?= $slips[$k]['Day'].' = '?>
                                        <?= $slips[$k]['TIME'] ?>
                                    </div>

                                    <br clear="all" />
                                </div>
                                <?php } 
                        }?>

                        
                </div>
                <?php }?>
                <br />  
                <?php  
                if(@$slips[$countter]['subp1count']>0) {?>
                <div style=" margin-top:200px;font-size: 16px;"><h4>THEORY PART - I</h4></div>
                <div class="table" style=" margin-bottom:20px;margin-top:-15px;border:none;">
                    <?php 
                   
                        for($k = 0; $k<$slips[$countter]['subp1count']; $k++) { 

                            if($slips[$k+$countter]['class'] == 9) {
                                $countter9++;
                                ?>
                                <div>
                                    <div class="seria_no" style="width:auto;"><?= $countter . '.    '?>  <?= $slips[$k+$countter]['sub_Name'].' = '?>
                                        <?= $slips[$k+$countter]['Date2'].' = '?>
                                        <?= $slips[$k+$countter]['Day'].' = '?>
                                        <?= $slips[$k+$countter]['TIME']?>
                                    </div>

                                    <br clear="all" />
                                </div>
                                <?php } 
                        }?>

                        
                </div>
                <?php }?>
                <!--<b>Practical Date Sheet</b>-->
                <?php 
                $tprcount = $countter+$countter9;
                    $prcount = 0;
                if(@$slips[$tprcount]['prcount'] > 0)
                    {?>
                <div style="margin-top:0px;font-size:16px; float: left;" ><h4>PRACTICAL SCHEDULE</h4></div>
                <div class="table" style="margin-top:-15px;border:none; width: 100%;">
                    <?php   
                    
                    
                        //$slips[$tprcount]['prcount']
                        for($l = 0; $l<$slips[$tprcount]['prcount']; $l++) 
                        { 
                            $prcount++;?>
                            <div >                        
                                <div class="seria_no" style="width:auto;"> <?= $prcount.'.  '.$slips[$l+$tprcount]['sub_Name']?><?= ' = '.$slips[$l+$tprcount]['lab_Name']?>

                                    <?= ' = '.$slips[$l+$tprcount]['Date2']?>
                                    <?= ' = '.$slips[$l+$tprcount]['TIME']?>
                                    <?= ' = '.$slips[$l+$tprcount]['batch']?>
                                </div>                        

                                <br clear="all" />
                            </div>
                            <?php }?>
                   </div>
               <?php }?>
                <div id="wraper" style="padding:10px; margin-top:10px;">

                    <div style="float: left;     margin-top: 39px;">
                        <b>Dealing Official: </b>
                        <b>
                            <?php echo $emp_cd.' - '.$emp_name; ?>         
                        </b>
                    </div>
                    <img src="<?php echo base_url(); ?>assets/img/Note00.jpg" width="880" height="150" alt="Note00.jpg (136,776 bytes)" style="float: left; margin-left: -13px;" />      

                </div>

            </div>
        </div>
    </body>
</html>