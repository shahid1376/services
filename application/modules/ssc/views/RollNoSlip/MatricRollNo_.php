<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>PDF Created</title>

        <style type="text/css">

            /*body {
            background-color: #fff;
            margin: 4px;
            font-family: Lucida Grande, Verdana, Sans-serif;
            font-size: 14px;
            color: #4F5155;
            }

            a {
            color: #003399;
            background-color: transparent;
            font-weight: normal;
            }

            h1 {
            color: #444;
            background-color: transparent;
            border-bottom: 1px solid #D0D0D0;
            font-size: 12px;
            font-weight: bold;
            margin: 2px 0 2px 0;
            padding: 1px 0 2px 0;
            }

            code {
            font-family: Monaco, Verdana, Sans-serif;
            font-size: 12px;
            background-color: #f9f9f9;
            border: 1px solid #D0D0D0;
            color: #002166;
            display: block;
            margin: 1px 0 1px 0;
            padding: 1px 1px 1px 1px;
            }
            .auto-style1 {
            width: 150px;
            font-size: small;
            }

            .auto-style3 {
            width: 20px;
            }

            .auto-style4 {
            }

            .auto-style5 {
            width: 300px;
            }
            .auto-style6 {
            text-align: center;
            }
            .auto-style12 {
            width: 18px;
            }
            .auto-style13 {
            width: 11px;
            }
            .auto-style17 {
            width: 632px;
            }
            borderWithColor{
            border:black;
            border-style: solid;

            }

            .auto-style29 {
            width: 76px;
            font-weight: bold;
            height: 26px;
            font-size: xx-small;
            }
            .auto-style30 {
            width: 18px;
            height: 26px;
            }
            .auto-style31 {
            width: 11px;
            height: 26px;
            }
            .auto-style35 {
            font-size: xx-small;
            }
            .auto-style36 {
            width: 14px;
            height: 26px;
            font-weight: bold;
            font-size: xx-small;
            }
            .auto-style38 {
            width: 76px;
            }
            .auto-style39 {
            width: 14px;
            }
            .auto-style40 {
            width: 163px;
            }
            .auto-style43 {
            width: 194px;
            }
            .auto-style44 {
            width: 54px;
            height: 26px;
            font-weight: bold;
            font-size: xx-small;
            }
            .auto-style45 {
            width: 54px;
            }
            .auto-style46 {
            width: 81px;
            font-weight: bold;
            height: 26px;
            font-size: xx-small;
            }
            .auto-style47 {
            width: 81px;
            }
            .auto-style48 {
            width: 91px;
            font-weight: bold;
            height: 26px;
            font-size: xx-small;
            }
            .auto-style49 {
            width: 91px;
            }
            .auto-style50 {
            width: 26px;
            height: 26px;
            font-weight: bold;
            font-size: xx-small;
            }
            .auto-style51 {
            width: 26px;
            }
            .auto-style52 {
            width: 40px;
            height: 26px;
            }
            .auto-style53 {
            width: 40px;
            }
            .auto-style54 {
            width: 31px;
            height: 26px;
            }
            .auto-style55 {
            width: 31px;
            }
            #header {
            text-align:center;
            padding:5px;
            }
            #nav {
            line-height:50px;
            background-color:#eeeeee;
            height:300px;
            width:100px;
            float:right;
            padding:5px; 
            }
            #section {
            width:100%;
            float:center;
            padding:10px; 
            }
            #footer {
            background-color:black;
            color:white;
            clear:both;
            text-align:center;
            padding:5px; 
            } */
            .head{
                background: green;
                width:100%;
                height:auto;

            }
            .content1{
                background:maroon;
                width:300px;

            }
            .subdetail{
                background:orange;
                width:300px;

            }
            .content2{
                background:silver;
            }
            .footers{
                background:aqua;
            }
            .detail{
                background:lime;
                width:300px;
                height:200px;
            }
            .pix{
                background:navy;
                width:300px;


            }
            @page {
                size: A4;
                width:100%;
                margin-top: 5px;
                margin-left: 20px;
                margin-right:20px;
                font-size: small; 
                font-family: Arial;
            }
            .floatleft{
                float:left;
            }
            .floatright{
                float:right;
            }
            tr.noBorder td {border: 0; border-left:0;  }
            .smallsize{
                font-size: x-small;
                text-align: center;
            }
            .centers{
                text-align: center;
                font-size: medium;
            }
            tbody{
                font-size: small;
            }
            .borders {
                border: 1px solid black;
                border-collapse: collapse;
            }
            hr{
                border-top: 1px dotted #8c8b8b;
                border-bottom: none;
                border-left: none;
                border-right: none;

            }
            .onlyCenter{
                text-align: center;
            }
            .bubbleStyle{
                width:30%;
                height:30%;
                text-align: left;

            }
            tr,td {
                margin-left: 15px;

            }
        </style>
    </head>
    <body>
        <div style="text-align: center;" >
            <label class="centers">BOARD OF INTERMEDIATE & SECONDARY EDUCATION, GUJRANWALA</label> 
            <label  class="centers">ROLL NUMBER SLIP (WITH DATE SHEET) FOR <?= $info[0]['Class'] ?> <?php if($info[0]['Session'] ==1) echo 'ANNUAL'; else echo 'SUPPLY'; ?>  EXAMINATION, <?= $info[0]['Year'] ?> </label>  
            <label class="centers"><b>(PROVISIONALLY)</b></label>
        </div>
        <table style="margin-top:-14px;" style="border:solid 1px red">
            <tr>
                <td  ><label class="smallsize">ROLL NO</label></td>
                <td ><label  style="font-size: medium;"><strong>: <?= $info[0]['Rno']?></strong></label></td>
                <td  rowspan="2" colspan="4"> 
                  <?php
                
                      //echo $this->load->library('barcode');
                      
                   //  DebugBreak();
                    // echo $data['barcode'];
                      //echo include('barcode.php');
                      //header ('Content-type: image/png');
                    //  imagepng($image);
                     // imagedestroy($image);
                     //$info
                     //DebugBreak();
                  ?>
                  <img alt="" src="assets/pdfs/<?= $barcode?>" />
                </td>     
            </tr>
            <tr>
                <td  > <label class="smallsize">NAME</label></td>
                <td ><label class="smallsize">: <?= $info[0]['Name']?></label></td>
                <td  colspan="4">
                    <img alt="" src="assets/img/download.jpg" style="width:85px; height:90px; margin-top: -40px;     margin-left: 100px;" />
                </td>
            </tr>
            <tr>
                <td ><label class="smallsize">FATHER's NAME</label></td>
                <td ><label class="smallsize">: <?= $info[0]['FathersName']?></label></td>
                <td colspan="4"></td>
                

            </tr>
            <tr>
                <td  ><label class="smallsize">DATE OF BIRTH </label></td>
                <td ><label class="smallsize">:  <?= $info[0]['DOB']?></label></td>
                <td colspan="4"></td>

            </tr>
            <tr>
                <td ><label><strong>CENTER </strong></label></td>
                <td colspan="5" ><label style="font-size: medium;"><strong>: <?= $info[0]['cent_cd'].'-'.$info[0]['Cent_Name']?></strong></label></td>
                <td ></td>

            </tr>
        </table>

        <img src="assets/img/Note.jpg" style="margin-left: 580px;margin-top: 140px; width:160px; position: absolute;" >
        
        <table  class=borders border="1" style="width:50%; margin-top: -38px;" cellpadding="1" cellspacing="0" >
            <tr class="noBorder" height="2px">
                <td align="center" colspan="5" ><label Style="text-align:center; font-weight: bold;">THEORY - PART (II) </label></td>
            </tr>
            <tr>
                <td width="5px" class="onlyCenter"><label class="smallsize"><b>S#.</b></label></td>
                <td width="350px" ><label class="smallsize"><b>SUBJECTS(s)</b></label> </td>
                <td class=onlyCenter width="60px"><label class="smallsize"><b>DATE</b></label></td>
                <td class=onlyCenter width="60px"><label class="smallsize"><b>DAY</b></label></td>
                <td class=onlyCenter width="60px" ><label class="smallsize"><b>TIME</b></label></td>
            </tr>
            <?php 
            $countter = 0;
            for($i = 0; $i<$slip[0]['subp2count']; $i++) { 

                if($slip[$i]['class'] == 10) {
                    $countter++;
                    ?>
                    <tr>
                        <td class="onlyCenter"><label class="smallsize" ><?= $countter?></label></td>
                        <td ><label class="smallsize"><?= $slip[$i]['sub_Name']?></label></td>
                        <td class="onlyCenter"><label class="smallsize"><?= $slip[$i]['Date2']?></label></td>
                        <td class="onlyCenter"><label class="smallsize"><?= $slip[$i]['Day']?></label></td>
                        <td class="onlyCenter"><label class="smallsize"><?= $slip[$i]['TIME']?></label></td>
                    </tr>
                    <?php } 
            }?>
           
        </table>

        <!--   <table>
        <tr>
        <td>
        <img alt="" src="assets/img/Note.JPG" style=" width: 25px; float: right; text-align: center; height: 100px;" />
        </td>
        </tr>
        </table> -->
        <table  class=borders border="1" style="width:50%; margin-top: 5px;" cellpadding="1" cellspacing="0" >
            <tr class="noBorder" height="2px">
                <td align="center" colspan="5" ><label Style="text-align:center; font-weight: bold;">THEORY - PART (I) </label></td>
            </tr>
              <tr>
                <td width="5px" class="onlyCenter"><label class="smallsize"><b>S#.</b></label></td>
                <td width="350px" ><label class="smallsize"><b>SUBJECTS(s)</b></label> </td>
                <td class=onlyCenter width="60px"><label class="smallsize"><b>DATE</b></label></td>
                <td class=onlyCenter width="60px"><label class="smallsize"><b>DAY</b></label></td>
                <td class=onlyCenter width="60px" ><label class="smallsize"><b>TIME</b></label></td>
            </tr>
             <?php 
            $countter9 = 0;
            for($i = 0; $i<$slip[$countter]['subp1count']; $i++) { 

                if($slip[$i+$countter]['class'] == 9) {
                    $countter9++;
                    ?>
                    <tr>
                        <td class="onlyCenter"><label class="smallsize" ><?= $countter9?></label></td>
                         <td ><label class="smallsize"><?= $slip[$i]['sub_Name']?></label></td>
                        <td class="onlyCenter"><label class="smallsize"><?= $slip[$i+$countter]['Date2']?></label></td>
                        <td class="onlyCenter"><label class="smallsize"><?= $slip[$i+$countter]['Day']?></label></td>
                        <td class="onlyCenter"><label class="smallsize"><?= $slip[$i+$countter]['TIME']?></label></td>
                    </tr>
                    <?php } 
            }?>
            
          
        </table>
        <table  class=borders border="1" style="width:100%; margin-top: 18px;" cellpadding="2" cellspacing="0" >
            <tr class="noBorder" height="2px">
                <td align="center" colspan="6" ><label Style="text-align:center; font-weight: bold;">PRACTICAL-PART(II) </label> 

                </td>
            </tr>
            <tr>
            <td width="5px" align="center"><label  class="smallsize" style="text-align: center;"><b>S#</b></label></td>
                <td width="80px" align="center"><label class="smallsize"><b>Subject(s)</b></label></td>
                <td width="200px" align="center"> <label class="smallsize"><b>Laboratory</b></label></td>
                <td width="40px" align="center"><label class="smallsize"><b>Date</b></label></td>
                <td width="40px" align="center"><label class="smallsize"><b>Time</b></label></td>
                <td width="30px" align="center"><label class="smallsize"><b>Batch</b></label></td>
                </tr>
            <tr>
                <td class="onlyCenter"><label>1</label></td>
                <td> <label class="smallsize">ELEMENTS OF HOME ECONOMICS</label></td>
                <td><label class="smallsize">47-GOVT.H/S/S NO.2 SIALKOT</label></td>
                <td class="onlyCenter"><label>10-10-2015</label></td>
                <td class="onlyCenter"><label>02:30 PM</label></td>
                <td class="onlyCenter"><label>III</label></td>
            </tr>
            <tr>
                <td class="onlyCenter"><label>2</label></td>
                <td> <label class="smallsize">COMPUTER SCIENCE </label></td>
                <td><label class="smallsize">47-GOVT.H/S/S NO.2 SIALKOT</label></td>
                <td class="onlyCenter"><label>10-10-2015</label></td>
                <td class="onlyCenter"><label>02:30 PM</label></td>
                <td class="onlyCenter"><label>III</label></td>
            </tr>
            <tr>
                <td class="onlyCenter"><label>3</label></td>
                <td> <label class="smallsize">COMPUTER SCIENCE </label></td>
                <td><label class="smallsize">47-GOVT.H/S/S NO.2 SIALKOT</label></td>
                <td class="onlyCenter"><label>10-10-2015</label></td>
                <td class="onlyCenter"><label>02:30 PM</label></td>
                <td class="onlyCenter"><label>III</label></td>
            </tr>
        </table>
        <table width="100%" >
            <tr>
                <td width="100px">
                    <label><b>Official Name</b></label>
                    <label>_______________________</label>
                </td>
                <td width="250px">
                    <label><b>Candidate's Signature: </b></label>
                    <label><b>______________________</b></label>
                </td>                
            </tr>
        </table>

        <hr>
        <table width="50%" height="130px" >
            <tr>
                <td>
                    <table border="1" class=borders height="90px">
                        <tr>
                            <td colspan="6" class=onlyCenter>ROLL NO</td>
                        </tr>
                        
                        <?php 
                        
                        
                         $rnostr = $info[0]['Rno'];
                         $rnostr1 = substr($rnostr,0,1);
                         $rnostr2 = substr($rnostr,1,1);
                         $rnostr3 = substr($rnostr,2,1);
                         $rnostr4 = substr($rnostr,3,1);
                         $rnostr5 = substr($rnostr,4,1);
                         $rnostr6 = substr($rnostr,5,1);
                         
                         
                        
                        ?>
                        <tr>
                            <td class="onlyCenter"><label><?= $rnostr1?></label></td>
                            <td class="onlyCenter"><label><?= $rnostr2?></label>
                            <td class="onlyCenter"><label><?= $rnostr3?></label></td>
                            <td class="onlyCenter"><label><?= $rnostr4?></label></td>
                            <td class="onlyCenter"><label><?= $rnostr5?></label></td>
                            <td class="onlyCenter"><label><?= $rnostr6?></label></td>
                        </tr>
                        
                        <?php 
                        $bubble0ps1 = '0.JPG';
                        $bubble0ps2 = '0.JPG';
                        $bubble0ps3 = '0.JPG';
                        $bubble0ps4 = '0.JPG';
                        $bubble0ps5 = '0.JPG';
                        $bubble0ps6 = '0.JPG';
                        
                        $bubble1ps1 = '1.JPG';
                        $bubble1ps2 = '1.JPG';
                        $bubble1ps3 = '1.JPG';
                        $bubble1ps4 = '1.JPG';
                        $bubble1ps5 = '1.JPG';
                        $bubble1ps6 = '1.JPG';
                        
                        $bubble2ps1 = '2.JPG';
                        $bubble2ps2 = '2.JPG';
                        $bubble2ps3 = '2.JPG';
                        $bubble2ps4 = '2.JPG';
                        $bubble2ps5 = '2.JPG';
                        $bubble2ps6 = '2.JPG';
                        
                        $bubble3ps1 = '3.JPG';
                        $bubble3ps2 = '3.JPG';
                        $bubble3ps3 = '3.JPG';
                        $bubble3ps4 = '3.JPG';
                        $bubble3ps5 = '3.JPG';
                        $bubble3ps6 = '3.JPG';
                        
                        $bubble4ps1 = '4.JPG';
                        $bubble4ps2 = '4.JPG';
                        $bubble4ps3 = '4.JPG';
                        $bubble4ps4 = '4.JPG';
                        $bubble4ps5 = '4.JPG';
                        $bubble4ps6 = '4.JPG';
                        
                        $bubble5ps1 = '5.JPG';
                        $bubble5ps2 = '5.JPG';
                        $bubble5ps3 = '5.JPG';
                        $bubble5ps4 = '5.JPG';
                        $bubble5ps5 = '5.JPG';
                        $bubble5ps6 = '5.JPG';
                        
                        $bubble6ps1 = '6.JPG';
                        $bubble6ps2 = '6.JPG';
                        $bubble6ps3 = '6.JPG';
                        $bubble6ps4 = '6.JPG';
                        $bubble6ps5 = '6.JPG';
                        $bubble6ps6 = '6.JPG';
                        
                        $bubble7ps1 = '7.JPG';
                        $bubble7ps2 = '7.JPG';
                        $bubble7ps3 = '7.JPG';
                        $bubble7ps4 = '7.JPG';
                        $bubble7ps5 = '7.JPG';
                        $bubble7ps6 = '7.JPG';
                        
                        $bubble8ps1 = '8.JPG';
                        $bubble8ps2 = '8.JPG';
                        $bubble8ps3 = '8.JPG';
                        $bubble8ps4 = '8.JPG';
                        $bubble8ps5 = '8.JPG';
                        $bubble8ps6 = '8.JPG';
                        
                        $bubble9ps1 = '9.JPG';
                        $bubble9ps2 = '9.JPG';
                        $bubble9ps3 = '9.JPG';
                        $bubble9ps4 = '9.JPG';
                        $bubble9ps5 = '9.JPG';
                        $bubble9ps6 = '9.JPG';
                      
                      //region for 0 bubbling 
                        if($rnostr1 == 0) {
                            $bubble0ps1 = 'bubble.JPG'; 
                        }
                        if($rnostr2 == 0)
                        {
                            $bubble0ps2 = 'bubble.JPG';
                        }
                        if($rnostr3 == 0)
                        {
                            $bubble0ps3 = 'bubble.JPG';
                        }
                        if($rnostr4 == 0)
                        {
                            $bubble0ps4 = 'bubble.JPG';
                        }
                        if($rnostr5 == 0)
                        {
                            $bubble0ps5 = 'bubble.JPG';
                        }
                        if($rnostr6 == 0)
                        {
                            $bubble0ps6 = 'bubble.JPG';
                        }
                        //endregion 
                        
                        // for 1 bubbling
                        if($rnostr1 == 1) {
                            $bubble1ps1 = 'bubble.JPG'; 
                        }
                        if($rnostr2 == 1)
                        {
                            $bubble1ps2 = 'bubble.JPG';
                        }
                        if($rnostr3 == 1)
                        {
                            $bubble1ps3 = 'bubble.JPG';
                        }
                        if($rnostr4 == 1)
                        {
                            $bubble1ps4 = 'bubble.JPG';
                        }
                        if($rnostr5 == 1)
                        {
                            $bubble1ps5 = 'bubble.JPG';
                        }
                        if($rnostr6 == 1)
                        {
                            $bubble1ps6 = 'bubble.JPG';
                        }
                        // end bubbling 1 
                        
                            // for 2 bubbling
                        if($rnostr1 == 2) {
                            $bubble2ps1 = 'bubble.JPG'; 
                        }
                        if($rnostr2 == 2)
                        {
                            $bubble2ps2 = 'bubble.JPG';
                        }
                        if($rnostr3 == 2)
                        {
                            $bubble2ps3 = 'bubble.JPG';
                        }
                        if($rnostr4 == 2)
                        {
                            $bubble2ps4 = 'bubble.JPG';
                        }
                        if($rnostr5 == 2)
                        {
                            $bubble2ps5 = 'bubble.JPG';
                        }
                        if($rnostr6 == 2)
                        {
                            $bubble2ps6 = 'bubble.JPG';
                        }
                        // end bubbling 2 
                        
                            // for 3 bubbling
                        if($rnostr1 == 3) {
                            $bubble3ps1 = 'bubble.JPG'; 
                        }
                        if($rnostr2 == 3)
                        {
                            $bubble3ps2 = 'bubble.JPG';
                        }
                        if($rnostr3 == 3)
                        {
                            $bubble3ps3 = 'bubble.JPG';
                        }
                        if($rnostr4 == 3)
                        {
                            $bubble3ps4 = 'bubble.JPG';
                        }
                        if($rnostr5 == 3)
                        {
                            $bubble3ps5 = 'bubble.JPG';
                        }
                        if($rnostr6 == 3)
                        {
                            $bubble3ps6 = 'bubble.JPG';
                        }
                        // end bubbling 3 
                        
                        
                        // for 4 bubbling
                        if($rnostr1 == 4) {
                            $bubble4ps1 = 'bubble.JPG'; 
                        }
                        if($rnostr2 == 4)
                        {
                            $bubble4ps2 = 'bubble.JPG';
                        }
                        if($rnostr3 == 4)
                        {
                            $bubble4ps3 = 'bubble.JPG';
                        }
                        if($rnostr4 == 4)
                        {
                            $bubble4ps4 = 'bubble.JPG';
                        }
                        if($rnostr5 == 4)
                        {
                            $bubble4ps5 = 'bubble.JPG';
                        }
                        if($rnostr6 == 4)
                        {
                            $bubble4ps6 = 'bubble.JPG';
                        }
                        // end bubbling 4 
                        
                              // for 5 bubbling
                        if($rnostr1 == 5) {
                            $bubble5ps1 = 'bubble.JPG'; 
                        }
                        if($rnostr2 == 5)
                        {
                            $bubble5ps2 = 'bubble.JPG';
                        }
                        if($rnostr3 == 5)
                        {
                            $bubble5ps3 = 'bubble.JPG';
                        }
                        if($rnostr4 == 5)
                        {
                            $bubble5ps4 = 'bubble.JPG';
                        }
                        if($rnostr5 == 5)
                        {
                            $bubble5ps5 = 'bubble.JPG';
                        }
                        if($rnostr6 == 5)
                        {
                            $bubble5ps6 = 'bubble.JPG';
                        }
                        // end bubbling 5 
                        
                                      // for 6 bubbling
                        if($rnostr1 == 6) {
                            $bubble6ps1 = 'bubble.JPG'; 
                        }
                        if($rnostr2 == 6)
                        {
                            $bubble6ps2 = 'bubble.JPG';
                        }
                        if($rnostr3 == 6)
                        {
                            $bubble6ps3 = 'bubble.JPG';
                        }
                        if($rnostr4 == 6)
                        {
                            $bubble6ps4 = 'bubble.JPG';
                        }
                        if($rnostr5 == 6)
                        {
                            $bubble6ps5 = 'bubble.JPG';
                        }
                        if($rnostr6 == 6)
                        {
                            $bubble6ps6 = 'bubble.JPG';
                        }
                        // end bubbling 6 
                        
                        
                                           // for 7 bubbling
                        if($rnostr1 == 7) {
                            $bubble7ps1 = 'bubble.JPG'; 
                        }
                        if($rnostr2 == 7)
                        {
                            $bubble7ps2 = 'bubble.JPG';
                        }
                        if($rnostr3 == 7)
                        {
                            $bubble7ps3 = 'bubble.JPG';
                        }
                        if($rnostr4 == 7)
                        {
                            $bubble7ps4 = 'bubble.JPG';
                        }
                        if($rnostr5 == 7)
                        {
                            $bubble7ps5 = 'bubble.JPG';
                        }
                        if($rnostr6 == 7)
                        {
                            $bubble7ps6 = 'bubble.JPG';
                        }
                        // end bubbling 7 
                        
                          // for 8 bubbling
                        if($rnostr1 == 8) {
                            $bubble8ps1 = 'bubble.JPG'; 
                        }
                        if($rnostr2 == 8)
                        {
                            $bubble8ps2 = 'bubble.JPG';
                        }
                        if($rnostr3 == 8)
                        {
                            $bubble8ps3 = 'bubble.JPG';
                        }
                        if($rnostr4 == 8)
                        {
                            $bubble8ps4 = 'bubble.JPG';
                        }
                        if($rnostr5 == 8)
                        {
                            $bubble8ps5 = 'bubble.JPG';
                        }
                        if($rnostr6 == 8)
                        {
                            $bubble8ps6 = 'bubble.JPG';
                        }
                        // end bubbling 8 
                        
                                 // for 9 bubbling
                        if($rnostr1 == 9) {
                            $bubble9ps1 = 'bubble.JPG'; 
                        }
                        if($rnostr2 == 9)
                        {
                            $bubble9ps2 = 'bubble.JPG';
                        }
                        if($rnostr3 == 9)
                        {
                            $bubble9ps3 = 'bubble.JPG';
                        }
                        if($rnostr4 == 9)
                        {
                            $bubble9ps4 = 'bubble.JPG';
                        }
                        if($rnostr5 == 9)
                        {
                            $bubble9ps5 = 'bubble.JPG';
                        }
                        if($rnostr6 == 9)
                        {
                            $bubble9ps6 = 'bubble.JPG';
                        }
                        // end bubbling 9 
                        ?>
                        
                        
                        <tr class="noBorder">
                            <td class="onlyCenter"><img alt="" src="assets/img/<?=$bubble0ps1?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble0ps2?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble0ps3?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble0ps4?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble0ps5?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble0ps6?>" class="bubbleStyle"/></td>
                        </tr>
                        <tr class="noBorder">
                            <td class="onlyCenter"><img alt="" src="assets/img/<?=$bubble1ps1?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble1ps2?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble1ps3?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble1ps4?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble1ps5?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble1ps6?>" class="bubbleStyle"/></td>
                        </tr>
                        <tr class="noBorder">
                            <td class="onlyCenter"><img alt="" src="assets/img/<?=$bubble2ps1?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble2ps2?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble2ps3?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble2ps4?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble2ps5?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble2ps6?>" class="bubbleStyle"/></td>
                        </tr>

                        <tr class="noBorder">
                             <td class="onlyCenter"><img alt="" src="assets/img/<?=$bubble3ps1?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble3ps2?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble3ps3?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble3ps4?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble3ps5?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble3ps6?>" class="bubbleStyle"/></td>
                        </tr>

                        <tr class="noBorder">
                            <td class="onlyCenter"><img alt="" src="assets/img/<?=$bubble4ps1?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble4ps2?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble4ps3?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble4ps4?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble4ps5?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble4ps6?>" class="bubbleStyle"/></td>
                        </tr>

                        <tr class="noBorder">
                             <td class="onlyCenter"><img alt="" src="assets/img/<?=$bubble5ps1?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble5ps2?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble5ps3?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble5ps4?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble5ps5?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble5ps6?>" class="bubbleStyle"/></td>
                        </tr>

                        <tr class="noBorder">
                            <td class="onlyCenter"><img alt="" src="assets/img/<?=$bubble6ps1?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble6ps2?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble6ps3?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble6ps4?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble6ps5?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble6ps6?>" class="bubbleStyle"/></td>
                        </tr>

                        <tr class="noBorder">
                             <td class="onlyCenter"><img alt="" src="assets/img/<?=$bubble7ps1?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble7ps2?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble7ps3?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble7ps4?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble7ps5?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble7ps6?>" class="bubbleStyle"/></td>
                        </tr>

                        <tr class="noBorder">
                           <td class="onlyCenter"><img alt="" src="assets/img/<?=$bubble8ps1?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble8ps2?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble8ps3?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble8ps4?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble8ps5?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble8ps6?>" class="bubbleStyle"/></td>
                        </tr>

                        <tr class="noBorder">
                             <td class="onlyCenter"><img alt="" src="assets/img/<?=$bubble9ps1?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble9ps2?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble9ps3?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble9ps4?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble9ps5?>" class="bubbleStyle"/></td>
                            <td class="onlyCenter"><img alt="" src="assets/img/<?= $bubble9ps6?>" class="bubbleStyle"/></td>
                        </tr>



                    </table>
                </td>
                <td>
                    <img alt="" src="assets/img/256.JPG" style=" width: 500px; height:70%; margin-left: 15%; text-align: right; margin-top:-10px; " />
                </td></tr>
        </table>


        <table style="width:100%; height: 1%;     margin-top: -24px;"  cellpadding="0" cellspacing="0">
            <tr>
                <td ><label class="smallsize"><b>To </b></label></td>
                <td ><label class="smallsize">ROLL NO: <?= $info[0]['Rno']?></label></td>
                <td rowspan="4">
                    <!-- <img alt="" src="assets/img/256.JPG" style=" width: 35px; float: right; text-align: center; height: 38px;" />--></td>
            </tr>
            <tr>
                <td ><label class="smallsize">Name</label></td>
                <td ><label class="smallsize">: <?= $info[0]['Name']?></label></td>
            </tr>
            <tr>
                <td ><label class="smallsize">Father's Name</label></td>
                <td ><label class="smallsize">: <?= $info[0]['FathersName']?></label></td>
            </tr>
            <tr>
                <td ><label class="smallsize">Address</label></td>
                <td colspan="4" ><label class="smallsize">:<?= $info[0]['address']?></label></td>
            </tr>
            <tr>
                <td ><label class="smallsize">Tehsil</label></td>
                <td><label class="smallsize">:Gujranwala</label></td>
                <td ><label class="smallsize">District</label></td>
                <td><label class="smallsize">:Gujranwala</label></td>
                <td style="text-align: right;" ><label class="smallsize">CONTROLLER OF EXAMINATIONS</label></td>
            </tr>
            <tr>
                <td><label class="smallsize">Print Date: </label></td>
                <td><label>10-10-2015</label></td>
            </tr>
        </table>


        <!-- <div id="content1">
        <div id="SubjectDetails" style="text-align: left; float:left; margin-left:2%; width:60%;  " class="subdetail" >

        </div>
        <div id="pictures" style="text-align: left; float:left; width:30%;  " class="pix">

        </div>
        </div>
        <div id="content2">

        </div>                    -->
        <!-- <div style="float: left; width: 1000px;" >
        <table style="width:500px;" border="1">
        <tr>
        <th colspan="4">
        <label style="text-align: center; font-weight:bold">THEORY - PART (II) </label>  
        </th>
        </tr>
        <tr>
        <td ><label>S#.</label></td>
        <td ><label>SUBJECTS(s)</label> </td>
        <td ><label><b><span class="auto-style35">DATE</span></b></label><span class="auto-style35"></td>
        <td ><label><b><span class="auto-style35">DAY</span></b></label></td>
        <td  >TIME</td>
        </tr>
        <tr>
        <td >1</td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        </tr>
        <tr>
        <td >2</td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        </tr>
        <tr>
        <td >3</td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        </tr>
        <tr>
        <td >4</td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        </tr>
        <tr>
        <td >5</td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        </tr>
        <tr>
        <td >6</td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        </tr>
        <tr>
        <td >7</td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        </tr>
        <tr>
        <td >8</td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        </tr>
        </table>

        <table style="width:500px;" border="1">
        <tr>
        <th colspan="4">
        <label style="text-align: center; font-weight:bold">THEORY - PART ( I ) </label>  
        </th>
        </tr>
        <tr>
        <td class="auto-style36"><label>S#.</label></td>
        <td class="auto-style29"><label>SUBJECTS(s)</label> </td>
        <td class="auto-style30"><label><b><span class="auto-style35">DATE</span></b></label><span class="auto-style35"></td>
        <td class="auto-style31"><label><b><span class="auto-style35">DAY</span></b></label></td>
        <td class="auto-style44">TIME</td>
        </tr>
        <tr>
        <td class="auto-style39">1</td>
        <td class="auto-style38">&nbsp;</td>
        <td class="auto-style12">&nbsp;</td>
        <td class="auto-style13">&nbsp;</td>
        <td class="auto-style45">&nbsp;</td>
        </tr>
        <tr>
        <td class="auto-style39">2</td>
        <td class="auto-style38">&nbsp;</td>
        <td class="auto-style12">&nbsp;</td>
        <td class="auto-style13">&nbsp;</td>
        <td class="auto-style45">&nbsp;</td>
        </tr>
        <tr>
        <td class="auto-style39">3</td>
        <td class="auto-style38">&nbsp;</td>
        <td class="auto-style12">&nbsp;</td>
        <td class="auto-style13">&nbsp;</td>
        <td class="auto-style45">&nbsp;</td>
        </tr>
        <tr>
        <td class="auto-style39">4</td>
        <td class="auto-style38">&nbsp;</td>
        <td class="auto-style12">&nbsp;</td>
        <td class="auto-style13">&nbsp;</td>
        <td class="auto-style45">&nbsp;</td>
        </tr>
        <tr>
        <td class="auto-style39">5</td>
        <td class="auto-style38">&nbsp;</td>
        <td class="auto-style12">&nbsp;</td>
        <td class="auto-style13">&nbsp;</td>
        <td class="auto-style45">&nbsp;</td>
        </tr>
        <tr>
        <td class="auto-style39">6</td>
        <td class="auto-style38">&nbsp;</td>
        <td class="auto-style12">&nbsp;</td>
        <td class="auto-style13">&nbsp;</td>
        <td class="auto-style45">&nbsp;</td>
        </tr>
        <tr>
        <td class="auto-style39">7</td>
        <td class="auto-style38">&nbsp;</td>
        <td class="auto-style12">&nbsp;</td>
        <td class="auto-style13">&nbsp;</td>
        <td class="auto-style45">&nbsp;</td>
        </tr>
        <tr>
        <td class="auto-style39">8</td>
        <td class="auto-style38">&nbsp;</td>
        <td class="auto-style12">&nbsp;</td>
        <td class="auto-style13">&nbsp;</td>
        <td class="auto-style45">&nbsp;</td>
        </tr>
        </table>

        </div >
        <div id="imgNote" style="float: right; width: 1000px;">
        <img alt="" src="../assets/img/Urdu_Notes_For_Class_XI.png" style="float: left; width:150px; height:450px" /> 
        </div>




        <br>
        <label>Checked by:&nbsp;&nbsp;  (Candidate's Signature) 
        <br>
        <img alt="" src="../assets/img/650-www-pakmed-nemt-medical-education-science-july-31-2013-news-2.gif" style="width: 600px; height: 500px;" /></label><br>-->




        <!-- <div id="footer">
        <table style="width:100%;">
        <tr>
        <td >To.</td>
        <td ></td>
        <td rowspan="4">
        <img alt="" src="../assets/img/certified-rubber-stamp.gif" style=" width: 35px; float: right; text-align: center; height: 38px;" /></td>
        </tr>
        <tr>
        <td >Name:</td>
        <td ></td>
        </tr>
        <tr>
        <td >Father&#39;s Name</td>
        <td ></td>
        </tr>
        <tr>
        <td >Address: </td>
        <td ></td>
        </tr>
        <tr>
        <td >Tehsil:</td>
        <td >District:</td>
        <td >CONTROLLER OF EXAMINATIONS</td>
        </tr>
        </table>
        </div>-->


        <!--<h1>BOARD OF INTERMEDIATE & SECONDARY EDUCATION, GUJRANWALA</h1> 


        <h1>ROLL NUMBER SLIP (WITH DATE SHEET) FOR   EXAMINATION,  </h1> <br>
        <h1>(PROVISIONALLY)</h1>


        <label>ROLL No &emsp;&emsp;&emsp;&emsp;:</label> <label><b></b></label>  <br>
        <label>NAME  &emsp;&emsp;&emsp;&emsp;&emsp;&ensp;:</label> <label></label>    <br>
        <label>FATHER'S NAME :</label> <label></label>    <br>
        <label>DATE OF BIRTH &ensp;:</label> <label></label>    <br>
        <label> <b>CENTER &emsp;&emsp;&emsp;&emsp;:</b></label>        <label></label>    <br>

        <h1>/h1>

        <p>The PDF you are looking at is being generated dynamically by HTML2PDF This is Testing Pdf from BISE Gujranwala.</p>
        <table border="1px">
        <thead>
        <tr>
        <td>
        Sr.No.
        </td>
        <td> Subject</td>
        <td>Timing</td>
        </tr>

        </thead>
        <tr>
        <td>1</td>
        <td>English</td>
        <td>10:30 AM</td>
        </tr>
        </table>
        <code></code>  -->
<?php   //DebugBreak();?>
    </body>
</html>