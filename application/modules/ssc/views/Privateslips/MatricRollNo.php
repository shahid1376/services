<style type="">
    .bubbleStyle{
        width:12px;
        text-align: center;


    }

</style>

<table width="100%">
    <tr>
        <td width="10%"> <img src="assets/img/icon2.png" alt="" style="width:130px; height:80px" ></td>
        <td width="95%" align="left" >  
            <table>
                <tr>
                    <td align="left" colspan="2"><label style="font-size: 12px;"><b>BOARD OF INTERMEDIATE & SECONDARY EDUCATION, GUJRANWALA</b></label> </td>
                </tr>
                <tr>
                    <td width="6%"></td>
                    <td style="line-height: 7px;font-size: 9px;" align="left" width="94%">ROLL NUMBER SLIP (WITH DATE SHEET) FOR S.S.C <?php if($Session ==1) echo 'ANNUAL'; else echo 'SUPPLY'; ?>  EXAMINATION, <?= $Year ?>   </td>
                </tr>
                <tr>
                    <td width="30%"></td>
                    <td style="line-height: 11px;font-size: 9px; font-weight: bold;" width="70%" align="left">(PROVISIONALLY)</td>
                </tr>


            </table>

        </td>

    </tr>
    <tr><td colspan="2" style="line-height: -4px;"></td></tr>
</table>

<table width="100%"  cellpadding="1" cellspacing="0">
    <tr>
        <td  width="60%">
            <table width="100%">
                <tr>
                    <td width="20%"><label ><strong style="font-size: 9px;">ROLL NO </strong></label></td>
                    <td width="1%" style="line-height: 15px;"><label style="font-size: 11px;">:</label></td>
                    <td   width="16%" style="border: 1px solid black;line-height: 15px;" align="center"><strong style="font-size: 11px;"> <?= $Rno?></strong></td>
                    <td width="63%"></td>
                </tr>
                <tr>
                    <td width="20%"><label >NAME</label></td>
                    <td width="80%" colspan="3"><label style="font-size: 11px;" >: <?= $Name?></label></td>

                </tr>
                <tr>
                    <td width="20%"><label >FATHER's NAME</label></td>
                    <td width="80%" colspan="2"><label style="font-size: 11px;">: <?= $FathersName?></label></td>

                </tr>
                <tr>
                    <td width="20%"><label >DATE OF BIRTH </label></td>
                    <td width="80%" colspan="2"><label style="font-size: 11px;">:  <?= $DOB?></label></td>
                </tr>
                <tr>
                    <td width="20%" style="line-height: 10px;" ><label><strong style="font-size: 9px;">CENTER</strong></label></td>
                    <td width="80%" style="line-height: 10px;" colspan="2"><label><strong style="font-size: 9px;">: <?= $cent_cd.'-'.$Cent_Name?> </strong></label></td>
                </tr>
            </table>
        </td>
        <td width="40%">
            <table width="100%">
                <tr>
                    <td align="left" width="60%" style=" " > 
                        <table>
                            <tr>
                                <td colspan="3"> <img align="middle" alt="" src="assets/pdfs/<?= $barcode?>" style="width:200px;height: 20px;" /></td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td align="center" colspan="3"><b style="font-size: 10px;"><?php if($grp_cd == 1) echo 'SCIENCE'; else if($grp_cd == 2) echo 'GENERAL';?></b></td>
                            </tr>
                            <tr>
                                <td colspan="3"> </td>
                            </tr>

                            <tr>
                                <td width="15%"></td>
                                <td  align="center" width="70%"><p style="border: 1px solid black; line-height: 13px;font-size: 10px;" > SCHEME=1100</p></td>
                                <td width="15%"></td>

                            </tr>
                        </table>
                    </td> 
                    <td  align="right" width="40%" >
                        <table>
                            <tr>
                                <td  align="center" style="font-weight: bold">FormNo:<?= $formno?></td>
                            </tr>

                            <tr>
                                <?php 
                                $filepath = base_url().'assets/'.$picpath;
                                //$filepath = base_url().'assets/img/no_image.png';
                                /* $isexists = file_exists($filepath);
                                if(!$isexists)
                                {
                                $filepath = base_url().'assets/img/no_image.png';
                                }*/
                                ?>
                                <td  align="center" > <img alt="" src="<?= $filepath?>"  style="width:200px;height:220px;"></td>
                            </tr>
                            <tr>
                                <td align="center" style="font-weight: bold"><?php if($Gender==1) echo 'MALE'; if($Gender==2) echo 'FEMALE';   ?></td>
                            </tr>
                        </table>


                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<table  width="100%" cellpadding="1" cellspacing="0" >
    <tr>
        <td width="77%">
            <table>
                <?php $countter = 0;
                if(@$slips[0]['subp2count']>0) {?>
                    <tr>
                        <td>
                            <table   border="1"  cellpadding="1" cellspacing="0" width="100%"  >
                                <tr style="background-color: #D0D0D0 ;">
                                    <td align="center" colspan="5" >
                                        <label Style="text-align:center; font-weight: bold;">THEORY = PART - II </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="5%" align="center" ><b>Sr#</b></td>
                                    <td width="60%" align="center"><b>SUBJECT(s)</b> </td>
                                    <td align="center" width="12%"><b>DATE</b></td>
                                    <td width="13%" align="center"><b>DAY</b></td>
                                    <td  align="center" width="10%"><b>TIME</b></td>
                                </tr>
                                <?php 

                                for($k = 0; $k<$slips[0]['subp2count']; $k++) { 

                                    if($slips[$k]['class'] == 10) {
                                        $countter++;
                                        ?>
                                        <tr>
                                            <td align="center"><?= $countter?></td>
                                            <td>  <?= $slips[$k]['sub_Name']?></td>
                                            <td  align="center" ><?= $slips[$k]['Date2']?></td>
                                            <td align="center"><?= $slips[$k]['Day']?></td>
                                            <td align="center" ><?= $slips[$k]['TIME']?></td>
                                        </tr>
                                        <?php } 
                                }?>


                            </table>
                        </td>
                    </tr>
                    <?php }?>
                <tr><td style="line-height: 5px;"></td></tr>
                <?php 
                $countter9 = 0;
                if(@$slips[$countter]['subp1count'] > 0)
                {
                    ?>
                    <tr>
                        <td>
                            <table   border="1" width="100%"  >



                                <tr class="noBorder" height="2px" style="background-color:#D0D0D0;">
                                    <td align="center" colspan="5" ><label Style="text-align:center; font-weight: bold;">THEORY = PART - I </label></td>
                                </tr>
                                <tr>
                                    <td width="5%" align="center" ><b>Sr#</b></td>
                                    <td width="60%" align="center"><b>SUBJECT(s)</b> </td>
                                    <td align="center" width="12%"><b>DATE</b></td>
                                    <td width="13%" align="center"><b>DAY</b></td>
                                    <td  align="center" width="10%"><b>TIME</b></td>
                                </tr>
                                <?php
                                for($l = 0; $l<$slips[$countter]['subp1count']; $l++) { 

                                    if($slips[$l+$countter]['class'] == 9) {
                                        $countter9++;
                                        ?>
                                        <tr>
                                            <td align="center" ><?= $countter9?></td>
                                            <td >  <?= $slips[$l+$countter]['sub_Name']?></td>
                                            <td align="center"><?= $slips[$l+$countter]['Date2']?></td>
                                            <td align="center"><?= $slips[$l+$countter]['Day']?></td>
                                            <td align="center"><?= $slips[$l+$countter]['TIME']?></td>
                                        </tr>
                                        <?php } 
                                }?>

                            </table>
                        </td>
                    </tr>
                    <?php }?>
            </table>
        </td>
        <td width="1%"></td>
        <td width="22%">
            <img src="assets/img/Note.jpg"  style="width:200px;height:360px;" >
        </td>
    </tr>
    <tr><td colspan="3" style="line-height: 3px;"></td></tr>
</table>
<?php   
$tprcount = $countter+$countter9;
$prcount = 0;
if(@$slips[$tprcount]['prcount'] > 0)
{?>
    <table   border="1"   width="100%"  >
        <tr style="background-color: #D0D0D0 ;">
            <td align="center" colspan="6" ><label Style="text-align:center; font-weight: bold;">PRACTICAL = PART - II </label> </td>
        </tr>
        <tr>
            <td width="4%" align="center"><b>Sr#</b></td>
            <td width="26%" align="center"><b>Subject(s)</b></td>
            <td width="48%" align="center"><b>Laboratory</b></td>
            <td width="9%" align="center"><b>Date</b></td>
            <td width="7%" align="center"><b>Time</b></td>
            <td width="6%" align="center"><b>Batch</b></td>
        </tr>
        <?php
        //$slips[$tprcount]['prcount']
        for($l = 0; $l<$slips[$tprcount]['prcount']; $l++) 
        { 
            $prcount++;?>
            <tr >
                <td align="center" ><?= $prcount?></td>
                <td>  <?= $slips[$l+$tprcount]['sub_Name']?></td>
                <td><?= $slips[$l+$tprcount]['lab_Name']?>
                </td>
                <td align="center"><?= $slips[$l+$tprcount]['Date2']?></td>
                <td align="center"><?= $slips[$l+$tprcount]['TIME']?></td>
                <td align="center"><?= $slips[$l+$tprcount]['batch']?></td>
            </tr>
            <?php }?>

    </table>
    <?php   }?>


<table width="100%" >
    <tr><td></td><td></td></tr>
    <tr>
        <td width="47%" align="left">
            Official Name: <b><u><?= $emp_cd.'-'.$emp_name?></u></b>
        </td>
        <td width="35%" align="center">
            Candidate's Signature: ______________________
        </td>  
        <td width="18%" align="right">
            Printing Date: <u><?php echo date('d-m-Y')?></u>
        </td>              
    </tr>
    <tr><td></td><td></td></tr>
</table>

<table width="100%"  >
    <tr>
        <td width="20%">
            <table border="1" >
                <tr>
                    <td colspan="6" align="center" style="line-height: 15px;font-size: 12px;"><b>ROLL NO</b></td>
                </tr>

                <?php 
                $rnostr = $Rno;
                $rnostr1 = substr($rnostr,0,1);
                $rnostr2 = substr($rnostr,1,1);
                $rnostr3 = substr($rnostr,2,1);
                $rnostr4 = substr($rnostr,3,1);
                $rnostr5 = substr($rnostr,4,1);
                $rnostr6 = substr($rnostr,5,1);
                ?>
                <tr>
                    <td align="center" style="line-height: 20px;font-size: 12px;"><b><?= $rnostr1?></b></td>
                    <td  align="center" style="line-height: 20px;font-size: 12px;"><b><?= $rnostr2?></b></td>
                    <td align="center" style="line-height: 20px;font-size: 12px;"><b><?= $rnostr3?></b></td>
                    <td align="center" style="line-height: 20px;font-size: 12px;"><b><?= $rnostr4?></b></td>
                    <td align="center" style="line-height: 20px;font-size: 12px;"><b><?= $rnostr5?></b></td>
                    <td align="center" style="line-height: 20px;font-size: 12px;"><b><?= $rnostr6?></b></td>
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
                    <td align="center" style="line-height: 18px" ><img alt="" src="assets/img/<?=$bubble0ps1?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px" ><img alt="" src="assets/img/<?= $bubble0ps2?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px" ><img alt="" src="assets/img/<?= $bubble0ps3?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px" ><img alt="" src="assets/img/<?= $bubble0ps4?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px" ><img alt="" src="assets/img/<?= $bubble0ps5?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px" ><img alt="" src="assets/img/<?= $bubble0ps6?>" class="bubbleStyle"/></td>
                </tr>
                <tr class="noBorder">
                    <td align="center" style="line-height: 18px" ><img alt="" src="assets/img/<?=$bubble1ps1?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px" ><img alt="" src="assets/img/<?= $bubble1ps2?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px" ><img alt="" src="assets/img/<?= $bubble1ps3?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px" ><img alt="" src="assets/img/<?= $bubble1ps4?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px" ><img alt="" src="assets/img/<?= $bubble1ps5?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px" ><img alt="" src="assets/img/<?= $bubble1ps6?>" class="bubbleStyle"/></td>
                </tr>
                <tr class="noBorder">
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?=$bubble2ps1?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble2ps2?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble2ps3?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble2ps4?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble2ps5?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble2ps6?>" class="bubbleStyle"/></td>
                </tr>

                <tr class="noBorder">
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?=$bubble3ps1?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble3ps2?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble3ps3?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble3ps4?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble3ps5?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble3ps6?>" class="bubbleStyle"/></td>
                </tr>

                <tr class="noBorder">
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?=$bubble4ps1?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble4ps2?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble4ps3?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble4ps4?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble4ps5?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble4ps6?>" class="bubbleStyle"/></td>
                </tr>

                <tr class="noBorder">
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?=$bubble5ps1?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble5ps2?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble5ps3?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble5ps4?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble5ps5?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble5ps6?>" class="bubbleStyle"/></td>
                </tr>

                <tr class="noBorder">
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?=$bubble6ps1?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble6ps2?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble6ps3?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble6ps4?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble6ps5?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble6ps6?>" class="bubbleStyle"/></td>
                </tr>

                <tr class="noBorder">
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?=$bubble7ps1?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble7ps2?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble7ps3?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble7ps4?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble7ps5?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble7ps6?>" class="bubbleStyle"/></td>
                </tr>

                <tr class="noBorder">
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?=$bubble8ps1?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble8ps2?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble8ps3?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble8ps4?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble8ps5?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble8ps6?>" class="bubbleStyle"/></td>
                </tr>

                <tr class="noBorder">
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?=$bubble9ps1?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble9ps2?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble9ps3?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble9ps4?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble9ps5?>" class="bubbleStyle"/></td>
                    <td align="center" style="line-height: 18px"><img alt="" src="assets/img/<?= $bubble9ps6?>" class="bubbleStyle"/></td>
                </tr>


            </table>
        </td>
        <td width="80%" align="right">
            <img alt="" src="assets/img/256(10thPrivate)Final.JPG" style="width:500px;height:250px;   text-align: right;" />
        </td>
    </tr>
    <tr><td colspan="2"></td></tr>
</table>
<table>
    <tr>
        <td width="75%" align="center">
        <img src="assets/img/Note00.jpg" style="height: 70px; width: 500px;" alt="">
        </td>
        <td width="25%" align="center">
            <table>
                <tr>
                    <td align="center"></td>
                </tr>
                <tr>
                    <td align="center"></td>
                </tr>
                <tr>
                    <td align="center"></td>
                </tr>
              <tr>
                    <td align="center"></td>
                </tr>
               <!-- <tr>
                    <td align="center"> <img src="assets/img/CE_Signature.png" style="height: 70px;" alt=""></td>
                </tr>-->
                <tr style="line-height: 20px;"> <td align="center">CONTROLLER OF EXAMINATIONS</td></tr>
            </table>
        </td>
    </tr>
</table>

