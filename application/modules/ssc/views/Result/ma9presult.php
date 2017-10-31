<style type="text/css">
    input.txt {
        border-right: #8f9ca5 1px solid; border-top: #8f9ca5 1px solid; font-size: 11px; border-left: #8f9ca5 1px solid; color: #000000; border-bottom: #8f9ca5 1px solid; font-family: Verdana, Arial; height: 18px
    }
    .restable {
        padding-right: 0px; padding-left: 0px; font-size: 12px; padding-bottom: 0px; margin: 0px; color: #6f6754; padding-top: 0px; font-family: Georgia, Times New Roman, Times, serif;
    }
    table a:link {
        font-size: 12px; color: #996430; font-family: Georgia, Times New Roman, Times, serif; text-decoration: none
    }
    table a:visited {
        font-size: 12px; color: #996430; font-family: Georgia, Times New Roman, Times, serif; text-decoration: none
    }
    table {
        font-size: 12px; color: #000000; font-family: Georgia, Times New Roman, Times, serif
    }
    .style4 {font-size: large}

    @keyframes blink {  
        50% { color: #005fbf ; }
    100% { color: #000000   ; }
    }
    @-webkit-keyframes blink {
        50% { color: #880000  ; }
    100% { color: #000000   ; }
    }
    .blink {
        -webkit-animation: blink 0.5s linear infinite;
        -moz-animation: blink 0.5s linear infinite;
        animation: blink 0.5s linear infinite;
    }
    .topics tr { line-height: 30px; }

</style>
<?php
include ('mFunPro.php');
$sess ='';
$title = '';
$mRNo1= intval(@$callback['keyword']); 
$totalmarks = 0; 
$srno= 1;    
$_POST['year'] =  2016;
$title = 'Matric Annual(9th) Examination, '.$_POST['year'];
//$mymatricObj = new Matric();
//---------------------------				
//$link=mysql_connect($server,$user,$password);
$Spl_cd= 0;
//DebugBreak();

$result = $result[0];
if ($result === FALSE)
{
    if($result === FALSE)
    {
        echo('<center><span class="blink" style="font-size:25px;  " > You entered invalid Roll-Number, Please enter valid Roll Number from  100000 to 370000 </span></center>');
        echo('<center><span   style="font-size:25px; text-align:justified" > <input type="button" id="btn" name="btn" onclick="history.go(-1);"  value="Go Back" />  </span></center>');
    }
    else 
    {
        $Spl_cd = getField($result,"Spl_cd");
        $res =  $mymatricObj->getsplcase($Spl_cd);//fetchFirst($q);
        if($Spl_cd == 11 or $Spl_cd == 12 or $Spl_cd == 13 or $Spl_cd == 14 or $Spl_cd == 15 or $Spl_cd == 16 ) 
            $splName = getField($result,"result1");
        else 
            $splName = getField($res,"spl_name");
        echo('<center><span class="blink" style="font-size:25px; text-align:justified" > This Student Record is '. $splName . '.</span></center>');                    
        echo('<center><span   style="font-size:25px; text-align:justified" > <input type="button" id="btn" name="btn" onclick="history.go(-1);"  value="Go Back" />  </span></center>');

    }

}
else {
//DebugBreak();

    $Spl_cd = getField($result,"spl_cd");
    if($Spl_cd != '' || $Spl_cd != null) 
    {


        if($Spl_cd == 10 or $Spl_cd == 11 or $Spl_cd == 12 or $Spl_cd == 13 or $Spl_cd == 14 or $Spl_cd == 16 or $Spl_cd == 17 or $Spl_cd == 24 or $Spl_cd == 8 or $Spl_cd == 15 or $Spl_cd == 9  or $Spl_cd == 4   or $Spl_cd == 5  or $Spl_cd == 99 OR  $Spl_cd ==  55) 

        {
            $splName = getField($result,"result1");


        }
        else 
        {
          $splName = getField($result,"spl_name");   
        }
           

        echo('<center><span class="blink" style="font-size:25px; text-align:justified;    margin-bottom: 33px;
    display: block;" > This Student Record is '. @$splName . '</span></center>');
        
        return ;
    } 
    else {
        ?>	
        <a id="btn-print" class="button" style="float: left;margin-top: 10px;margin-left:40px"/>Print</a>
        <div id="printres" style="margin-left: 40px;margin-bottom: 20px;">        
            <table cellSpacing="0" class="txt grid topics" cellPadding="2" width="800" border="1"  align="center" >
                <colgroup>
                    <col width=5%>
                    <col width=41%>
                    <col width=12%>
                    <col width=12%>
                    <col width=30%>
                </colgroup>

                <tbody align="center">

                    <tr align="left" height="100">
                        <td height="50" colspan="5" align="center">               	  
                            <span class="style4">
                                Board of Intermediate & Secondary Education, Gujranwala
                            </span>
                            <h3><?php echo $title;?></h3>
                        </td>
                    </tr>

                    <!-- Roll No, Name, Institute/District -->
                    <tr align="left" height="28">
                        <td colspan="3">&nbsp;Roll No:&nbsp;<b><?php echo getField($result,"RNo"); ?></b></td>
                         <td colspan="2">&nbsp;Registration No:&nbsp;<b><?php echo  getField($result,"strRegNo"); ?></b></td>
                    </tr>

                    <tr align="left" height="28">
                        <td colspan="3">&nbsp;Name:&nbsp;<?php echo getField($result,"Name"); ?></td>
                        <td colspan="2">&nbsp;<?php echo "Group: " . mGroup(getField($result,"Grp_cd")); ?></td>
                    </tr>

                    <tr height="28">
                        <td colspan="5" align="left">
                            <?php
                            $mVar=getField($result,"RegPvt");			
                            if ($mVar == "1"){
                                $mVar=getField($result,"Sch_Cd");
                                $name=getField($result,"sch_Name");
                                echo " School: " . $mVar.'-'.$name;
                            }
                            else
                                if ($mVar == "2")
                                    echo "District: " . mDistrict(getField($result,"Dist_Cd")); 
                            ?>                
                        </td> 
                    </tr>

                    <tr bgcolor="#D8D8D8" align="center">
                        <td>Sr.</td>
                        <td vAlign="bottom" height="10">Name of Subjects</td>
                        <td>Max. Marks</td>
                        <td>Marks<br />Obtained</td>
                        <td>Remarks</td>
                    </tr>   
                    <!-- Sub-1 (Urdu) -->
                    <tr height="28">
                        <td><?= $srno;?></td>
                        <td align="left">&nbsp;&nbsp;URDU</td>
                        <td>
                            <?php 
                            $mark = '';
                            if($_POST['year'] == 2016)
                            {
                                echo $mark =   Get9thSubMarks(getField($result,"S1"));
                            }
                            $totalmarks = $mark;


                            ?>

                        </td>
                        <td><?php if(getField($result,"sub1st1") == 2) echo'A' ; else echo getField($result,"S1MT1"); ?></td>
                        <td><?php if(getField($result,"sub1st1") == 1) echo subRemarks(trim(getField($result,"S1PF1"))); ?></td>
                    </tr>
                    <!-- Sub-2 (English) -->            
                    <tr height="28">
                        <td><?= $srno+=1?></td>
                        <td align="left">&nbsp;&nbsp;ENGLISH</td>
                        <td>
                            <?php 
                            // DebugBreak();
                            $mark = '';
                            if($_POST['year'] == 2016)
                            {
                                echo $mark =   Get9thSubMarks(getField($result,"S2"));
                            }

                            $totalmarks = $totalmarks +$mark;?>
                        </td>
                        <td><?php if(getField($result,"sub2st1") == 2) echo'A' ; else echo getField($result,"S2MT1"); ?></td>
                        <td><?php if(getField($result,"sub2st1") == 1) echo subRemarks(trim(getField($result,"S2PF1"))); ?>	</td>
                    </tr>
                    <!-- Sub-3 (Islamiyat) -->
                    <tr height="28">
                        <td><?= $srno+=1?></td>
                        <!-- td align="left">Islamiyat (Compulsory)</td -->
                        <td align="left">&nbsp;
                            <?php 
                            $mVar = getField($result,"S3");
                            echo ($mVar == "3") ? "ISLAMIYAT" : mSubName($mVar);
                            ?>	
                        </td>
                        <td>
                            <?php 

                            $mark = '';
                            if($_POST['year'] == 2016)
                            {
                                $mark =   Get9thSubMarks(getField($result,"S3"));
                            }

                            else  if($_POST['year'] == 2011) {
                                $totalmarks = $totalmarks +75; 
                                $mark =   75;      
                            }
                            else 
                            {  $totalmarks = $totalmarks +50; 
                                $mark =   50;
                            }
                            echo $mark;
                            ?>


                        </td>
                        <td><?php if(getField($result,"sub3st1") == 2) echo'A' ; else echo getField($result,"S3MT1"); ?></td>
                        <td><?php if(getField($result,"sub3st1") == 1) echo subRemarks(trim(getField($result,"S3PF1"))); ?>	</td>
                    </tr>
                    <?php if($_POST['year'] != 2011) {  
                        $totalmarks = $totalmarks +$mark;
                        ?>
                        <tr height="28">
                            <td><?= $srno+=1?></td>
                            <td align="left">&nbsp;&nbsp;PAKISTAN STUDIES</td>
                            <td>
                                <?php 

                                $mark = '';
                                if($_POST['year'] == 2016)
                                {
                                    $mark =   Get9thSubMarks(getField($result,"S8"));
                                }
                                else
                                {
                                    $mark =  50;
                                }
                                echo  $mark;
                                $totalmarks = $totalmarks +$mark;
                                ?>

                            </td>
                            <td><?php if(getField($result,"sub8st1") == 2) echo 'A' ; else echo getField($result,"S8MT1"); ?></td>
                            <td><?php if(getField($result,"sub8st1") == 1) echo subRemarks(trim(getField($result,"S8PF1"))); ?>	</td>
                        </tr>
                        <?php }?>
                    <!-- Sub-4 (Math) --> 
                    <tr height="28">
                        <td><?= $srno+=1?></td>
                        <td align="left">&nbsp;&nbsp;<?php
                            $mVar=getField($result,"S4");            
                            echo mSubName($mVar);

                        ?></td>
                        <td> <?php 
                            $mark = '';
                            if($_POST['year'] == 2016)
                            {
                                $mark =   Get9thSubMarks(getField($result,"S4"));
                            }
                            else
                            {
                                $mark =  75;
                            }
                            echo  $mark;

                            $totalmarks = $totalmarks +$mark;?>
                        </td>
                        <td><?php if(getField($result,"sub4st1") == 2) echo'A' ; else echo getField($result,"S4MT1"); ?></td>
                        <td><?php if(getField($result,"sub4st1") == 1) echo subRemarks(trim(getField($result,"S4PF1"))); ?>	</td>
                    </tr>
                    <!-- Sub-5 (Phy/GSc) --> 
                    <tr height="28">
                        <td><?= $srno+=1?></td>
                        <td align="left">&nbsp;
                            <?php
                            $mVar=getField($result,"S5");			
                            echo mSubName($mVar);
                            ?> 
                        </td>
                        <td>
                            <?php

                            $mark = '';
                            if($_POST['year'] == 2016)
                            {
                                $mark =   Get9thSubMarks(getField($result,"S5"));
                            }
                            else 
                            {
                                if(getField($result,"Grp_cd") == 5) {
                                    $mark =  "30";
                                }else{



                                    if($_POST['year'] == 2011) {  

                                        $mark =  "60";
                                    }
                                    else {

                                        $mark = "75";  
                                    }



                                }
                            }
                            echo $mark;
                            $totalmarks = $totalmarks +$mark;
                            ?>
                        </td>
                        <td><?php if(getField($result,"sub5st1") == 2) echo'A' ; else echo getField($result,"S5MT1"); ?></td>
                        <td><?php if(getField($result,"sub5st1") == 1) echo subRemarks(trim(getField($result,"S5PF1"))); ?>	</td>
                    </tr>
                    <!-- Sub-6 (Ch/Opt) --> 
                    <tr height="28">
                        <td><?= $srno+=1?></td>
                        <td align="left">&nbsp;
                            <?php
                            $mVar=getField($result,"S6");
                            echo mSubName($mVar);

                            ?>
                        </td>
                        <td>
                            <?php
                            $mark = '';
                            if($_POST['year'] == 2016)
                            {
                                $mark =   Get9thSubMarks(getField($result,"S6"));
                            }
                            else
                            {
                                if(getField($result,"Grp_cd") == 5) {
                                    $mark = "30";
                                }else{
                                    if($_POST['year'] == 2011) {  

                                        $mark = "60";
                                    }
                                    else {

                                        $mark = "75";  
                                    }
                                }   
                            }
                            echo  $mark;
                            $totalmarks = $totalmarks +$mark;
                            ?>
                        </td>
                        <td><?php if(getField($result,"sub6st1") == 2) echo'A' ; else echo getField($result,"S6MT1"); ?></td>
                        <td><?php if(getField($result,"sub6st1") == 1) echo subRemarks(trim(getField($result,"S6PF1"))); ?>	</td>
                    </tr>
                    <!-- Sub-7 (Ch/Opt) --> 
                    <tr height="28">
                        <td><?= $srno+=1?></td>
                        <td align="left">&nbsp;
                            <?php
                            $mVar=getField($result,"S7");
                            echo mSubName($mVar);
                            ?> 
                        </td>
                        <td>
                            <?php

                            $mark = '';
                            if($_POST['year'] == 2016)
                            {
                                $mark =   Get9thSubMarks(getField($result,"S7"));
                            }

                            else
                            {
                                if(getField($result,"Grp_cd") == 5) {
                                    $mark = "30";
                                }else{
                                    if($_POST['year'] == 2011) {  
                                        $totalmarks = $totalmarks +60;
                                        $mark = "60";
                                    }
                                    else {
                                        $totalmarks = $totalmarks +75;
                                        $mark = "75";  
                                    }
                                }
                            }
                            echo  $mark;
                            $totalmarks = $totalmarks +$mark;
                            ?>
                        </td>
                        <td><?php if(getField($result,"sub7st1") == 2) echo'A' ; else echo getField($result,"S7MT1"); ?></td>
                        <td><?php if(getField($result,"sub7st1") == 1) echo subRemarks(trim(getField($result,"S7PF1"))); ?>	</td>
                    </tr>
                    <!-- Total and Grade --> 
                    <tr height="28">
                        <td align="right" colspan="2">Total:</td>
                        <td>
                            <?php
                            if(getField($result,"Grp_cd") == 5) {
                                echo "<b>415</b>";
                            }else{
                                echo "<b>".$totalmarks."</b>";
                            }
                            ?>
                        </td>
                        <td><b>
                                <?php
                                $mVar = getField($result,"obt_mrk");
                                echo $mVar != "0" ?	$mVar : "&nbsp;";
                            ?></b>
                        </td>
                        <td>&nbsp;</td>
                    </tr>            
                    <!-- For Notification Detail --> 
                    <tr height="25" bgcolor="#D8D8D8">
                        <td colspan="2" align="right">Notification:</td>                
                        <td colspan="3" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo getField($result,"result1"); ?></td>
                    </tr>            
                    <!-- Note -->
                    <tr height="28">
                        <td colspan="5" align="left">&nbsp;
                            <?php
                            echo "<u><b>&nbsp;Note:&nbsp;</b></u>This result gazette is issued provisionally, errors and omissions excepted, as a notice only. 
                            Any entry appearing in this notification does not in itself confer any right or privilege 
                            on a candidate for the grant of certificate which will be issued under the rules/regulations 
                            on the basis of the original record of the Board's office.";
                            ?>
                        </td>
                    </tr>
                     <tr style="    height: 53px;">
                    <td colspan="9" align="center">
                    <img src="<?php echo base_url(); ?>assets/img/simple.JPG" alt="" style="    width: 660px;">
                    <span style=" text-align: center;font-size: 16px;margin-left: 122px;margin-top: -8px;" ><a href="http://rechecking.bisegrw.com/" class="blink" style="    font-size: 25px" target="_blank" >Apply for Rechecking</a></span>        
      
                    </td>
                </tr>    
                    <!-- Previous Page -->
                    <tr height="28">
                        <td colspan="5" align="center">
                            <a href="javascript:javascript:history.go(-1)">Click here to go back to previous page</a>
                        </td>
                    </tr>
                    <!-- ***************************************************************************************** -->
                </tbody>
            </table>
        </div>
        <?php  
    }                  

}

?>


