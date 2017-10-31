<style>
    table {
        font-family:Arial, Helvetica, sans-serif;
    }
    .table{
        border-collapse:collapse;
        margin-top:30px;
    }
    .th{
        background-color:#C2C2C2;
        font-size:12px;
        padding:3px; 
        border:1px solid #818181;
    }
    .td{
        font-size:12px;
        padding:3px;
        text-align:left; 
        border:1px solid #C0C0C0;
    }

    .table2{
        border-collapse:collapse;
        margin-top:30px;
    }
    .table2 th{
        background-color:#C2C2C2;
        font-size:12px;
        padding:3px; 
    }
    .table2 td{
        font-size:12px;
        padding:3px;
        text-align:left; 
    }
    body {
        margin:0 auto;
        width:980px;
    }
</style>

<?php


   
   if($rulefee[0]['isfine'] == 1)
   {
      $count = $data['batch_info'][0]["COUNT"];
      $data['batch_info'][0]["Total_RegistrationFee"] =  $count*$rulefee[0]['Reg_Fee'] ;
      $data['batch_info'][0]["Total_ProcessingFee"] =  $count*$rulefee[0]['Reg_Processing_Fee'] ;
      //$data['batch_info'][0]["Total_LateRegistrationFee"] =  $count*$rulefee[0]['Fine'] ;
      $data['batch_info'][0]["Amount"] =  $data['batch_info'][0]["Total_LateRegistrationFee"]+$data['batch_info'][0]["Total_ProcessingFee"]+$data['batch_info'][0]["Total_RegistrationFee"] ;
   }

?>


<table border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td colspan="8" align="center"><h2 style="margin:0;padding:0;">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA</h2></td>
    </tr>
    <tr>
        <td colspan="8"><div style="font-size:16px;font-weight:bold;text-align:center;">REVENUE FORM SHOWING DETAILS OF ENROLMENT <br />
                9th Class (SESSION 2016-2018)
            </div> 
        </td>
    </tr>
    <tr>
        <td colspan="8" style="font-size:12px;"><strong>Institute Code:</strong> <?php   echo  $inst_cd; ?></td>
    </tr>
    <tr>
        <td colspan="8" style="font-size:12px;"><strong>Institute Name:</strong> <?php echo  $inst_Name;?></td>
    </tr>
    <tr>
        <td colspan="8" style="font-size:12px;"><img style="margin-left: 605px;height: 19px;     width: 135px;" src="<?php  echo "/".BARCODE_PATH.$barcode; ?>" /></td>
    </tr>
    <tr>
        <td colspan="8" align="center">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table2">
                <tr>
                    <td style="width:150px;"><strong>Total No. Of Candidates:</strong></td>
                    <td><?php  echo $data['batch_info'][0]["COUNT"];?></td>
                    <td><strong>Challan No:</strong> <?php //echo $data["Challan_No"];?></td>
                </tr>
                <tr>
                    <td><strong>Amount Of Enrolment Fee:</strong></td>
                    <td><?php echo  $data['batch_info'][0]["Total_RegistrationFee"];?></td>
                    <td><strong>Deposit Date:</strong> ____/____/______</td>
                </tr>
                <tr>
                    <td><strong>Amount Of Processing Fee:</strong></td>
                    <td><strong><?php echo  $data['batch_info'][0]["Total_ProcessingFee"];?></strong></td>
                    <td><strong>HBL Branch Name:</strong> ________________________</td>
                </tr>

                <tr>
                    <td><strong>Amount Of Late + Token Enrolment Fee:</strong></td>
                    <td><strong><?php echo  $data['batch_info'][0]["Total_LateRegistrationFee"];?></strong></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td><strong>Total Amount:</strong></td>
                    <td><strong><?php echo  $data['batch_info'][0]["Amount"];?></strong></td>
                    <td>&nbsp;</td>
                </tr>
            </table>

        </td>
    </tr>
    <tr>
        <td colspan="8" style="height:20px;"></td>
    </tr>

    <tr>
        <th class="th">Sr#</th>
        <th class="th">Name</th>
        <th class="th">Father Name</th>
        <!--    <th class="th">Date Of Adm</th> -->
        <th class="th">Reg. Fee</th>
        <th class="th">Late+Token Reg. Fee</th>
        <th class="th">Process. Fee</th>
        <th class="th">Total Amount</th>
    </tr>

    <?php
  //DebugBreak();
    $n = 0; 
    $data['batch_info'][0]["Total_LateRegistrationFee"] = 0;
    foreach ($data['stdinfo'] as $key=>$vals) {
        $n++;
        if($rulefee[0]['isfine'] == 1)
        {
           $vals->regFee    = $rulefee[0]['Reg_Fee'];
           if($vals->IsReAdm == 1)
           {
               $vals->RegFineFee = 0;
           }
           else
           {
             $vals->RegFineFee = $rulefee[0]['Fine']; 
               $data['batch_info'][0]["Total_LateRegistrationFee"] = $data['batch_info'][0]["Total_LateRegistrationFee"] +$vals->RegFineFee; 
           }
         
           $vals->RegProcessFee = $rulefee[0]['Reg_Processing_Fee'];
           $vals->RegTotalFee   = $vals->regFee+$vals->RegFineFee+$vals->RegProcessFee;
        }
        else 
        {
            if($vals->RegFineFee == '')
            {
                $vals->RegFineFee = 0;
            }
            if($vals->Spec >0)
            {
                $vals->regFee = 0;
            }  
        } 
       
        ?>
        <tr>
            <td class="td" style="text-align:center;font-weight:bold;"><?php echo $n;?></td>
            <td class="td"><strong><?php echo $vals->name;?></strong></td>
            <td class="td"><strong><?php echo $vals->Fname;?></strong></td>


            <td class="td" style="text-align:center !important;"><?php echo $vals->regFee ;?></td>
            <td class="td" style="text-align:center !important;"><?php echo $vals->RegFineFee;?></td>
            <td class="td" style="text-align:center !important;"><?php echo $vals->RegProcessFee;?></td>
            <td class="td" style="text-align:center !important;"><?php echo $vals->RegTotalFee?></td>

        </tr>
        <?php
    }  // End of Foreach 
    ?>
    <tr>
        <th class="th">&nbsp;</th>
        <th class="th">&nbsp;</th>
        <!--    <th class="th">&nbsp;</th> -->
        <th class="th">Total :</th>
        <th class="th"><?php echo  $data['batch_info'][0]["Total_RegistrationFee"];;?></th>
        <th class="th"><?php echo $data['batch_info'][0]["Total_LateRegistrationFee"];;?></th>
        <th class="th"><?php echo $data['batch_info'][0]["Total_ProcessingFee"];?></th>
        <th class="th"><?php echo $data['batch_info'][0]["Amount"];?></th>
    </tr>

    <tr>
        <td colspan="2" style="text-align:right;padding-top:60px; text-decoration: underline;">Printing Date: <?php
            echo  date("d-m-Y h:i:A");
        ?></td>
        <td colspan="5" style="text-align:right;padding-top:60px;text-decoration:overline;">Signature & Stamp Head Of Institution</td>
    </tr>

</table>
