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
<table border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td colspan="8" align="center"><h2 style="margin:0;padding:0;">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA</h2></td>
    </tr>
    <tr>
        <td colspan="8"><div style="font-size:16px;font-weight:bold;text-align:center;">Revenue Form Showing Details Of SSC Examination 
        <?php if(Session ==1)
        {
        echo "Annual";
        }
        if(Session == 2)
        {
        echo "Supplementary";
        } ?>  <?= CURRENT_SESS1?>  </br>

          <img style="margin-left: 605px;height: 32px;" src="<?php  echo base_url().'/assets/img/M4.jpg'; ?>" />
                    </div> 
        </td>
    </tr>
    <tr>
        <td colspan="8" style="font-size:14px; margin-top: 8px;   margin-bottom: 8px"><strong>Institute Code:</strong> <b><?php   echo  $inst_cd; ?></b></td>
    </tr>
    <tr>
        <td colspan="8" style="font-size:14px;margin-bottom: 8px;"><strong>Institute Name:</strong> <b> <?php echo  $inst_Name;?> </b>
        
      
        </td>
    </tr>
    <tr>
        <td colspan="8" style="font-size:12px;"><img style="margin-left: 605px;height: 26px;     width: 200px;" src="<?php  echo base_url().BARCODE_PATH.$barcode; ?>" /></td>
    </tr>
    <tr>
        <td colspan="8" align="center">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table2">
                <tr>
                    <td style="width:150px;"><strong>Total No. Of Candidates:</strong></td>
                    <td><?php  echo $data['batch_info'][0]["COUNT"];?></td>
                    <td><strong>Challan No:</strong> <?php echo $data['batch_info'][0]["Challan_No"];?></td>
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
                    <td><strong>Amount Of Late Enrolment Fee:</strong></td>
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
        <th class="th">Adm. Fee</th>
        <th class="th">Late Adm Fee</th>
        <th class="th">Process. Fee</th>
        <th class="th">Certificate Fee</th>
        <th class="th">Total Amount</th>
    </tr>

    <?php
    ////DebugBreak();
    $n = 0; 
    foreach ($data['stdinfo'] as $key=>$vals) {
        $n++;
        if($vals->AdmFine == '')
        {
            $vals->AdmFine = 0;
        }
        ?>
        <tr>
            <td class="td" style="text-align:center;font-weight:bold;"><?php echo $n;?></td>
            <td class="td"><strong><?php echo $vals->name;?></strong></td>
            <td class="td"><strong><?php echo $vals->Fname;?></strong></td>


            <td class="td" style="text-align:center !important;"><?php echo $vals->AdmFee ;?></td>
            <td class="td" style="text-align:center !important;"><?php echo $vals->AdmFine;?></td>
            <td class="td" style="text-align:center !important;"><?php echo $vals->AdmProcessFee;?></td>
            <td class="td" style="text-align:center !important;"><?php echo '550';?></td>
            <td class="td" style="text-align:center !important;"><?php echo $vals->AdmTotalFee?></td>

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
        <th class="th"><?php echo $data['batch_info'][0]["TotalCertFee"];?></th>
        <th class="th"><?php echo $data['batch_info'][0]["Amount"];?></th>
    </tr>

    <tr>
        <td colspan="2" style="text-align:right;padding-top:60px; text-decoration: underline;">Printing Date: <?php
            echo  date("d-m-Y h:i:A");
        ?></td>
        <td colspan="5" style="text-align:right;padding-top:60px;text-decoration:overline;">Signature & Stamp Head Of Institution</td>
    </tr>

</table>
