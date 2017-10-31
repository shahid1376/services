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
        .topics tr { line-height: 15px; }
</style>
<?php
include ('iFunPro.php');
//---------------------------
//$mRNo = $_REQUEST['rIA2P14'];	
$sess ='';
$title = '';
$mRNo1= intval(@$callback['keyword']); 
$totalmarks = 0; 
$srno= 1;    
$_POST['year'] =  2016;
$_POST['class'] =  12;


$class ='';
$sess ='';
$title = '';
if($_POST['class'] == '12' )
{
    $class =12; 
    $sess =1;
    $title = 'Intermediate (12th/Composite) Annual Examination,  '.$_POST['year'];
}
else  if($_POST['class'] == 'is')
{
    $class =12;
    $sess =2; 
    $title = 'Intermediate (12th/Composite) Supply Examination, '.$_POST['year'];
}
else  if($_POST['class'] == '11')
{
    $class =11;
    $sess =1;  
    $title = 'Intermediate (11th) Annual Examination, '.$_POST['year'];
}

//$mymatricObj = new Matric();

//$result = $mymatricObj->get12result($mRNo1,$sess,$class,$_POST['year']); 
$result = $result[0];  
if ($result === false)
{				

    echo('<center><span class="blink" style="font-size:25px;  " > You entered invalid Roll-Number, Please enter valid Roll Number from  100000 to 300000 </span></center>');
    echo('<center><span   style="font-size:25px; text-align:justified" > <input type="button" id="btn" name="btn" onclick="history.go(-1);"  value="Go Back" />  </span></center>');


}
//else
//if ($mVar == 2 or $mVar > 3 ){
//	echo ("aa"); /*echo("<center><b>Result for Roll No" + $mRNo1 + " is : " + getField($result,"result2") + "</b></center>");*/}
else {
   // DebugBreak();

    $Spl_cd = getField($result,"Spl_cd");
   // $res =  $mymatricObj->getsplcase($Spl_cd);
    $naration = '';
    $splName = '';
    if($Spl_cd == 10 or $Spl_cd == 11 or $Spl_cd == 12 or $Spl_cd == 13 or $Spl_cd == 14 or $Spl_cd == 16 or $Spl_cd == 17 or $Spl_cd == 24 or $Spl_cd == 8 or $Spl_cd == 15 or $Spl_cd == 9  or $Spl_cd == 4  or $Spl_cd == 5  or $Spl_cd == 99 or $Spl_cd == 72 OR $Spl_cd == 119) 

    {
        $splName = getField($result,"result2");

        if($splName == '')
        {
            $naration =  $mymatricObj->getsplcase($splName);  

            $splName = getField($res,"spl_name");  
        }
       

        //$naration = getField($result,"SPL");
    }


    if($splName != '')
    {  echo('<center><span class="blink" style="font-size:25px; text-align:justified" > This Student Record is '. $splName . '.</br></span></center>');
        echo('<center><span   style="font-size:25px; text-align:justified" > <input type="button" id="btn" name="btn" onclick="history.go(-1);"  value="Go Back" />  </span></center>');
        return ;

    }
     
    $status=getField($result,"status");
    $schm= getField($result,"schm");
    $obt_mrk=getField($result,"obt_mrk");
    $chance=getField($result,"chance");
    $Cat09=getField($result,"Cat11");
    $Cat10=getField($result,"cat12");
    //$row = mysql_fetch_row($result);
    //print($num);        
    //echo gettype(getField($result,"RNo"));
    ?>	        
    <a id="btn-print" class="button" style="margin-top: 5px;margin-left:40px"/>Print</a>
        <div id="printres" style="margin-left: 40px;margin-bottom: 20px;"> 
    <table cellSpacing="0" class="txt grid topics" cellPadding="2" width="800" border="1" align="center">
        <colgroup>
            <col width=4%>
            <col width=40%>
            <col width=8%>
            <col width=8%>
            <col width=8%>
            <col width=8%>
            <col width=8%>
            <col width=8%>
            <col width=8%>
        </colgroup>
        <tbody align="center">
            <tr align="left" height="80">
                <td height="40" colspan="9" align="center" valign="middle">
                    <span class="style4">
                        Board of Intermediate &amp; Secondary Education, Gujranwala            </span>
                <h3><?php echo  $title?></h3>         </td>
            </tr>
            <!-- Roll No, Name, Institute/District -->
            <tr align="left" height="30">
                <td colspan="9"><u>Roll No:</u> <b><?php echo getField($result,"RNo"); 
                    ?></b></td>
            </tr>
            <tr align="left" height="30">
                <td colspan="5"><u>Name:</u> <?php echo getField($result,"Name"); ?></td>
                <td colspan="4">
                    <?php
                    $mGrp = getField($result,"Grp_Cd");

                    echo "<u>Group:</u> " . iGroup($mGrp);

                ?>         </td>
            </tr>
            <tr height="30">
                <td colspan="9" align="left">
                    <?php
                    $mVar=getField($result,"RegPvt");			

                    if ($mVar == "1"){

                        $mVar=getField($result,"coll_cd");

                       // $resInst = $mymatricObj->getschoolname($mVar); 

                       // $mVar=getField($resInst,"Name");

                        echo "<u>College:</u> " . $mVar.'-'.getField($result,"sch_Name");

                    }

                    else

                        if ($mVar == "2")

                            echo "<u>District:</u> " . iDistrict(getField($result,"Dist_Cd"));

                ?>         </td>
            </tr>
            <tr bgcolor="#D8D8D8" align="center" height="10">
                <td rowspan="2">Sr.</td>
                <td rowspan="2">Name of Subjects</td>
                <td rowspan="2" bgcolor="#D8D8D8">Max.<br>Marks</td>
                <td colspan="4">Marks Obtained</td>
                <!-- td>10th</td>
                <td>Practical</td>

                <td>Total</td -->
                <td colspan="2">status</td>
                <!-- td>10th</td -->
            </tr>
            <tr bgcolor="#D8D8D8" align="center">
                <!-- td>Sr.</td>
                <td vAlign="bottom" height="10">Name of Subjects</td>

                <td>Max. Marks</td -->
                <td>11th</td>
                <td>12th</td>
                <td>Practical</td>
                <td>Total</td>
                <td>11th</td>
                <td>12th</td>
            </tr>
            <!-- Sub-3 (Islamiyat) -->
            <tr height="35">
                <td>1</td>
                <td align="left">
                    <?php 
                    $mVar = getField($result,"S3");

                    echo ($mVar == "92") ? "ISLAMIC EDUCATION" : iSubName($mVar);

                ?>         </td>
                <td>50</td>
                <td><?php if(getField($result,"S3ST1") == 2 ) echo 'A' ; else echo getField($result,"S3MT1"); ?></td>
                <td align="center">-</td>
                <td>&nbsp;</td>
                <td><?php 
                //DebugBreak();
                    if(getField($result,"S3PF1") ==1  || getField($result,"S3PF1") ==2 )
                    {
                        echo getField($result,"S3MT1"); 
                    }
                ?>         </td>
                <td>
                    <?php
                    $mVar = getField($result,"S3PF1");

                    echo subStatus($mVar);

                ?>         </td>
                <td>-</td>
            </tr>
            <!-- Sub-8 (Pak-St) -->          
            <tr height="35">
                <td>2</td>
                <td align="left">PAKISTAN STUDIES</td>
                <td>50</td>
                <td align="center">-</td>
                <td><?php if(getField($result,"S8ST2") == 2 ) echo 'A' ; else echo getField($result,"S8MT2"); ?></td>
                <td>&nbsp;</td>
                <td><?php 
                
                 $mVar = getField($result,"S8PF2");
                 
                 if($mVar == 1 || $mVar == 2)
                 {
                    echo getField($result,"S8MT2");   
                 }
                
                
               ?></td>
                <td>-</td>
                <td>	
                    <?php
                   

                    echo subStatus($mVar);

                ?>         </td>
            </tr>
            <!-- Sub-1 (Urdu) -->
            <tr height="35">
                <td>3</td>
                <td align="left">URDU</td>
                <td>200</td>
                <td><?php if(getField($result,"S1ST1") == 2 ) echo 'A' ; echo getField($result,"S1MT1"); ?></td>
                <td><?php  if(getField($result,"S1ST2") == 2 ) echo 'A' ; echo getField($result,"S1MT2"); ?></td>
                <td>&nbsp;</td>
                <td><?php 
                $mVar = getField($result,"S1PF1"); 
                $mVar1 = getField($result,"S1PF2");  
                
                if(($mVar == 1 && $mVar1 == 1  ) || ($mVar == 2 || $mVar1 == 2))
                {
                      echo getField($result,"S1MT1")+getField($result,"S1MT2");
                }
                
               ?></td>
                <td>
                    <?php
                    				

                    echo subStatus($mVar);

                ?>         </td>
                <td>
                    <?php
                    

                    echo subStatus($mVar1);

                ?>         </td>
            </tr>
            <!-- Sub-2 (English) -->            
            <tr height="35">
                <td>4</td>
                <td align="left">ENGLISH</td>
                <td>200</td>
                <td><?php  if(getField($result,"S2ST1") == 2 ) echo 'A' ; echo getField($result,"S2MT1"); ?></td>
                <td><?php if(getField($result,"S2ST2") == 2 ) echo 'A' ; echo getField($result,"S2MT2"); ?></td>
                <td>&nbsp;</td>
                <td><?php 
                 $mVar = getField($result,"S2PF1");
                 $mVar1 = getField($result,"S2PF2");
                
                
                if(($mVar == 1 && $mVar1 == 1  ) || ($mVar == 2 || $mVar1 == 2))
                {
                      echo getField($result,"S2MT1")+getField($result,"S2MT2");
                } 	?></td>
                <td>
                    <?php
                   

                    echo subStatus($mVar);

                ?>         </td>
                <td>
                    <?php
                   

                    echo subStatus($mVar1);

                ?>         </td>
            </tr>
            <!-- Sub-4 (Opt-1) --> 
            <tr height="35">
                <td>5</td>
                <td align="left">
                    <?php
                    //DebugBreak();
                    $mVar = getField($result,"S4");

                    echo iSubName($mVar);
                    // echo ($mGrp == "5") ? "<br>" . iSubName(getField($result,"S4A")) : "";
                ?>         </td>
                <td><?php echo ($mGrp != "5" && $mGrp != "7") ? "200" : subMaxMarks_New($mVar,$schm); ?></td>
                <td><?php if(getField($result,"S4ST1") == 2 ) echo 'A' ; echo getField($result,"S4MT1"); ?></td>
                <td><?php if(getField($result,"S4ST2") == 2 ) echo 'A' ; echo getField($result,"S4MT2"); ?></td>
                <td><?php       	
                   
                    
                    if($mGrp == "7")
                    {
                    
                      $Sub4 = getField($result,"S4");
                      $Sub4A = getField($result,"S4A");
                      $Marks1  = getField($result,"S4MP1");
                      $Marks2  = getField($result,"S4MP2");
                      $PrPf1  =  getField($result,"sub4prpf1"); 
                      $PrPf2  =  getField($result,"sub4prpf2"); 
                      $s4st1 = getField($result,"S4SP1");
                      $s4st2 = getField($result,"S4SP2");
                      $PrPf = getField($result,"sub4prpf1");   
                      $PrPf = getField($result,"sub4prpf2");   
                        
                      if($s4st1 == 2 || $s4st2 == 2) 
                      {
                          if($s4st1 == 2)
                          {
                              echo "P1: A";  
                          }
                          if($s4st2 == 2)
                          {
                              echo "</br>P2: A";  
                          }
                        
                      }
                      else
                      {
                          if ($schm==1){

                              echo 'P1:'.Get_gradePrac_Inter_HE($Sub4,$Marks1,$PrPf1).'</br> P2:'.Get_gradePrac_Inter_HE($Sub4A,$Marks2,$PrPf2);
                          }
                          else {
                              echo 'P1:'.getField($result,"S4MP1").'</br> P2:'.getField($result,"S4MP2");
                          } 
                      }
                      
                       
                    }
                    else
                    {
                      $Sub4 = getField($result,"S4");
                      $Marks4  = getField($result,"S4MP2");
                      $PrPf4  =  getField($result,"sub4prpf");
                      $PrPf = getField($result,"sub4prpf");  
                      $s4st = getField($result,"S4SP2");
                        
                        
                        if($s4st == 2) {echo "A";}
                        else
                        {
                            if ($schm==1){echo Get_gradePrac_Inter($Sub4,$Marks4,$PrPf4);}
                            else {echo getField($result,"S4MP2");} 
                        }  
                    }                        
                  
                ?></td>
                <td><?php 
                
                 $mVar = getField($result,"S4PF1");
                  $Pf   = getField($result,"S4PF2");
                    if(($mVar == 1 && $Pf == 1  ) || ($mVar == 2 || $Pf == 2))
                    {
                        echo getField($result,"S4MT1")+getField($result,"S4MT2");
                        
                    }
                  
                	?></td>
                <td>
                    <?php
                   

                    echo subStatus($mVar);

                ?>         </td>
                <td>
                    <?php
                    $Pf   = getField($result,"S4PF2");
                                
                    echo subStatus_New($Pf,$PrPf);


                ?>         </td>
            </tr>
            <!-- Sub-5 (Opt-2) --> 
            <tr height="35">
                <td>6</td>
                <td align="left">
                    <?php
                    $mVar = getField($result,"S5");

                    echo iSubName($mVar);

                    echo ($mGrp == "5" || $mGrp == "7") ? "<br>" . iSubName(getField($result,"S5A")) : "";

                ?>         </td>
                <td><?php echo ($mGrp != "5" && $mGrp != "7") ? "200" : subMaxMarks_New($mVar,$schm); ?> </td>
                <td><?php if(getField($result,"S5ST1") == 2 ) echo 'A' ; echo getField($result,"S5MT1"); ?></td>
                <td><?php if(getField($result,"S5ST2") == 2 ) echo 'A' ; echo getField($result,"S5MT2"); ?></td>
                <td><?php  

                    if($mGrp == "7")
                    {
                       
                        $Sub5 = getField($result,"S5");
                        $Sub5A = getField($result,"S5A");
                        $Marks1  = getField($result,"S5MP1");
                        $Marks2  = getField($result,"S5MP2");
                        $PrPf1  =  getField($result,"sub5prpf1"); 
                        $PrPf2  =  getField($result,"sub5prpf2"); 
                        $s5st1 = getField($result,"S5SP1");
                        $s5st2 = getField($result,"S5SP2");
                        $PrPf = getField($result,"sub5prpf1");   
                        $PrPf = getField($result,"sub5prpf2");   

                        if($s5st1 == 2 || $s5st2 == 2) 
                        {
                            if($s5st1 == 2)
                            {
                                echo "P1: A";  
                            }
                            if($s5st2 == 2)
                            {
                                echo "</br>P2: A";  
                            }

                        }
                        else
                        {
                            if ($schm==1){

                                echo 'P1:'.Get_gradePrac_Inter_HE($Sub5,$Marks1,$PrPf1).'</br> P2:'.Get_gradePrac_Inter_HE($Sub5A,$Marks2,$PrPf2);
                            }
                            else {
                                echo 'P1:'.getField($result,"S5MP1").'</br> P2:'.getField($result,"S5MP2");
                            } 
                        }


                    }
                    else
                    {
                        $Sub5    = getField($result,"S5");
                        $Marks5  = getField($result,"S5MP2");
                        $PrPf5   = getField($result,"sub5prpf");
                        $PrPf = getField($result,"sub5prpf"); 
                        $s5st = getField($result,"S5SP2"); 
                        if($s5st == 2) {echo "A";}
                        else
                        {
                            if ($schm==1){echo Get_gradePrac_Inter($Sub5,$Marks5,$PrPf5);}
                            else {echo getField($result,"S5MP2");} 
                        } 
                    }
                
                
                
                
                   ?></td>
                <td><?php 
                
                $mVar = getField($result,"S5PF1");
                $Pf   = getField($result,"S5PF2");
                if(($mVar == 1 && $Pf == 1  ) || ($mVar == 2 || $Pf == 2))
                    {
                        echo getField($result,"S5MT1")+getField($result,"S5MT2") ;     
                    }
               ?></td>
                <td>
                    <?php
                    

                    echo subStatus($mVar);

                ?>         </td>
                <td>
                    <?php
                   

                    echo subStatus_New($Pf,$PrPf);


                ?>         </td>
            </tr>
            <!-- Sub-6 (Opt-3) --> 
            <tr height="35">
                <td>7</td>
                <td align="left">
                    <?php
                    $mVar = getField($result,"S6");
                    echo iSubName($mVar);
                    echo ($mGrp == "5" || $mGrp == "7") ? "<br>" . iSubName(getField($result,"S6A")) : "";
                ?>         </td>
                <td><?php echo ($mGrp != "5") ? "200" : subMaxMarks_New($mVar,$schm); ?> </td>
                <td><?php if(getField($result,"S6ST1") == 2 ) echo 'A' ; echo getField($result,"S6MT1"); ?></td>
                <td><?php if(getField($result,"S6ST2") == 2 ) echo 'A' ; echo getField($result,"S6MT2"); ?></td>
                <td><?php  
                
                if($mGrp == "7")
                    {
                        $Sub6 = getField($result,"S6");
                        $Sub6A = getField($result,"S6A");
                        $Marks1  = getField($result,"S6MP1");
                        $Marks2  = getField($result,"S6MP2");
                        $PrPf1  =  getField($result,"sub6prpf1"); 
                        $PrPf2  =  getField($result,"sub6prpf2"); 
                        $s6st1 = getField($result,"S6SP1");
                        $s6st2 = getField($result,"S6SP2");
                        $PrPf = getField($result,"sub6prpf1");   
                        $PrPf = getField($result,"sub6prpf2");   

                        if($s6st1 == 2 || $s6st2 == 2) 
                        {
                            if($s6st1 == 2)
                            {
                                echo "P1: A";  
                            }
                            if($s6st2 == 2)
                            {
                                echo "</br>P2: A";  
                            }

                        }
                        else
                        {
                            if ($schm==1){

                                echo 'P1:'.Get_gradePrac_Inter_HE($Sub6,$Marks1,$PrPf1).'</br> P2:'.Get_gradePrac_Inter_HE($Sub6A,$Marks2,$PrPf2);
                            }
                            else {
                                echo 'P1:'.getField($result,"S6MP1").'</br> P2:'.getField($result,"S6MP2");
                            } 
                        }


                    }
                    else
                    {
                        $Sub6    = getField($result,"S6");
                        $Marks6  = getField($result,"S6MP2");
                        $PrPf6   = getField($result,"sub6prpf");
                        $PrPf = getField($result,"sub6prpf");
                        $s6st = getField($result,"S6SP2");
                        if($s6st == 2) {echo "A";}
                        else
                        {
                            if ($schm==1){echo Get_gradePrac_Inter($Sub6,$Marks6,$PrPf6);}
                            else {echo getField($result,"S6MP2");} 
                        }
                    } ?></td>
                <td><?php 
                $mVar = getField($result,"S6PF1");
                $Pf   = getField($result,"S6PF2");
                
                if(($mVar == 1 && $Pf == 1  ) || ($mVar == 2 || $Pf == 2))
                {
                     echo getField($result,"S6MT1")+ getField($result,"S6MT2") ;     
                }
              ?></td>
                <td>
                    <?php
                    

                    echo subStatus($mVar);

                ?>         </td>
                <td>
                    <?php
                    
                 

                    echo subStatus_New($Pf,$PrPf);

                ?>         </td>
            </tr>
            <!-- Sub-7 (Opt-4) --> 
           <?php if ($mGrp == "5" || $mGrp == "7"){?>
           <tr height="35">
                <td>8</td>
                <td align="left">
                    <?php
                    $mVar = getField($result,"S7");
                    echo iSubName($mVar).'</br>';
                    echo  iSubName(getField($result,"S7A"));
                ?>         </td>
                <td><?php  if ($mGrp == "5") echo 150; else echo 100;?> </td>
                <td><?php if(getField($result,"S7ST1") == 2 ) echo 'A' ; echo getField($result,"S7MT1"); ?></td>
                <td><?php if(getField($result,"S7ST2") == 2 ) echo 'A' ; echo getField($result,"S7MT2"); ?></td>
                <td><?php  
                    $Sub6    = getField($result,"S7");
                    $Marks6  = getField($result,"S7MP2");
                    $PrPf6   = getField($result,"sub7prpf");

                    $s6st = getField($result,"S7SP2");
                    if($s6st == 2) {echo "A";}
                    else
                    {
                        if ($schm==1){echo Get_gradePrac_Inter($Sub6,$Marks6,$PrPf6);}
                        else {echo getField($result,"S7MP2");} 
                } ?></td>
                <td><?php 
                $mVar = getField($result,"S7PF1");
                $Pf   = getField($result,"S7PF2");
                
                if(($mVar == 1 && $Pf == 1  ) || ($mVar == 2 || $Pf == 2))
                {
                     echo getField($result,"S7MT1")+ getField($result,"S7MT2") ;     
                }
              ?></td>
                <td>
                    <?php
                    

                    echo subStatus($mVar);

                ?>         </td>
                <td>
                    <?php
                    
                    $PrPf = getField($result,"sub7prpf");

                    echo subStatus_New($Pf,$PrPf);

                ?>         </td>
            </tr>
           
           
           
            <?php
           }
            

            ?>
            <!-- Total and Grade --> 
            <tr height="25">
                <!-- td></td -->
                <td align="right" colspan="2" bgcolor="#D8D8D8">Total/Over All Grade:</td>
                <td><b>1100</b></td>
                <td colspan="3">&nbsp;</td>
                <!-- td></td>
                <td></td -->
                <td><b>
                    <?php
                    $mVar = getField($result,"obt_mrk");

                    echo $mVar != "0" ?	$mVar : "";

                ?></b>         </td>
                <td bgcolor="#D8D8D8">Grade:</td>
                <td><b>
                        <?php 
                        if(is_numeric($mVar)) {
                            $percent = ($mVar/1100)*100;
                            if(is_numeric($percent)) {
                                echo get_grade($percent);
                            }
                        }
                        ?>
                    </b></td>
            </tr>
            <!-- For Notification Detail --> 
            <tr height="25">
                <!-- td></td -->
                <td colspan="2" rowspan="2" align="right">Notification:</td>
                <td colspan="1" bgcolor="#D8D8D8">11th:</td>
                <td colspan="6" align="left"><?php echo getField($result,"result1"); ?></td>
            </tr>
            <tr height="25">
                <!-- td></td -->
                <td colspan="1" bgcolor="#D8D8D8">12th:</td>
                <td colspan="6" align="left"> <?php echo getField($result,"result2"); ?></td>
            </tr>
            <tr align="left" height="30">
                <td colspan="9" align="center">
                    <?php 
                    $status=getField($result,"status");

                    $chance=getField($result,"chance");

                    $Cat11=getField($result,"Cat11");

                    $cat12=getField($result,"cat12");



                    if ($status=="1"){		//Pass

                        if ($Cat11=="1" or $Cat11=="2" or $cat12=="1" or $cat12=="2")

                            echo "< The candidate has Passed >";

                        else

                            if ($Cat11=="3" or $cat12=="3")

                                echo "< The candidate has Improved his/her marks >";

                            else

                                if ($Cat11=="4" or $cat12=="4")

                                    echo "< Candidate has Passed Khasa Subjects >";

                                else

                                    if ($Cat11=="5" or $cat12=="5")

                                        echo "< Candidate has Passed Additional Subject >";

                                    else

                                        if ($Cat11=="6" or $cat12=="6")

                                            echo "< Candidate has Passed after Passing Fazal Examination >";

                    }		

                    else

                        if ($status=="2" and $_POST['year'] >=2014){		//Fail (Reappear)
                        //  DebugBreak();
                        $myear = $_POST['year'] +1;
                        
                            if ($Cat11=="1" or $Cat11=="2" or $cat12=="1" or $cat12=="2")

                                echo "< Candidate has failed in subject(s) and eligible to reappear till ";

                            if($sess == 1)
                        {


                            if ($chance=="1")

                                echo "Supplementary Examination, ".$myear." >";

                            else if ($chance=="2")

                                echo "Annual Examination, ".$myear." >";							

                                elseif ($chance=="3")
                                    echo "Supplementary Examination, ".$_POST['year']." >";
                        }
                           if($sess == 2)
                        {


                            if ($chance=="1")

                                echo "Annual Examination, ".$myear." >";

                            else if ($chance=="2")

                                echo "Supplementary Examination, ".$_POST['year']." >";                            

                                elseif ($chance=="3")
                                    echo "Annual Examination, ".$_POST['year']." >";
                        }
                    }

                    else

                        if ($status=="3"){		//Fail (Full)

                            if ($Cat11=="1" or $Cat11=="2" or $cat12=="1" or $cat12=="2"){

                                /*if ($chance=="1" or $chance=="2")

                                echo "Candidate has Failed in more than two subjects so he/she will reappear in full subjects next time";

                                else 

                                if ($chance==3)*/



                                echo "< The candidate has failed in both parts. THEREFORE, he/she should appear in full subjects next time >";

                            }

                            else 

                                if ($Cat11=="3" or $cat12=="3")

                                    echo "< Candidate could not Improve his/her marks >";

                                else

                                    if ($Cat11=="4" or $cat12=="4")

                                        echo "< Candidate has Failed after Passing Aama/Khasa Examination >";

                                    else

                                        if ($Cat11=="5" or $cat12=="5")

                                            echo "< Candidate has Failed in Additional Subject >";

                                        else

                                            if ($Cat11=="6" or $cat12=="6")

                                                echo "< Candidate has Failed after Passing Fazal Examination >";

                    }

                ?>         </td>
            </tr>
            <tr height="25">
                <td colspan="9" align="left">
                    <?php
                    echo "<u><b>Note:-<br></b></u>

                    i-This result gazette is issued provisionally, errors and omissions excepted, as a notice only. 

                    Any entry appearing in this notification does not in itself confer any right or privilege 

                    on a candidate for the grant of certificate which will be issued under the rules/regulations 

                    on the basis of the original record of the Board's office.<br>

                    ii-For rechecking you can apply within 15 days after result declaration date.";					

                ?>         </td>
            </tr>
            <tr height="28">
                <td colspan="9" align="left">
                    In Case of any query related to result. Contact to Board Official Mr. <strong> <?Php echo getField($result,"Emp_Name"); ?> </strong>
                </td>
            </tr>
            <?php if($_POST['year'] == 2016) {?>
                <tr style="    height: 53px;">
                    <td colspan="9" align="center">
                        <img src="<?= base_url()?>assets/img/simple.JPG" alt="" style="    width: 660px;">
                        <span style="display:block; text-align: center;font-size: 16px;margin-left: 122px;margin-top: -12px;" ><a href="http://rechecking.bisegrw.com/rechecking_hssc/" class="blink" style="    font-size: 25px" target="_blank" >Apply for Rechecking</a></span>        
                    </td>
                </tr>   
                <?php }?> 
            <tr height="28">
                <td colspan="9" align="center">
                <a href="javascript:javascript:history.go(-1)">Click here to go back to previous page</a>         </td>
            </tr>
            <!-- ***************************************************************************************** -->
        </tbody>
    </table>
    </div>
    <?php                    

}
?>

