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




?>


<table border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td colspan="8" align="center"><h2 style="margin:0;padding:0;">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, GUJRANWALA</h2></td>
    </tr>
    <tr>
        <td colspan="8"><div style="font-size:16px;font-weight:bold;text-align:center;">REVENUE FORM SHOWING DETAILS OF ADMISSIONS <br />
                <?php echo class_for_9th_Adm ?> Class (SESSION <?php echo CURRENT_SESS1 ?>)
            </div> 
        </td>
    </tr>
    <tr>
        <td colspan="8" style="font-size:12px;"><strong>Institute Code:</strong> <?php   echo  $Inst_cd; ?></td>
    </tr>
    <tr>
        <td colspan="8" style="font-size:12px;"><strong>Institute Name:</strong> <?php echo  $Inst_Name;?></td>
    </tr>
    <tr>
        <td colspan="8" style="font-size:12px;"><img style="margin-left: 605px;height: 24px;     width: 235px;" src="<?php echo "../../../".BARCODE_PATH.$barcode;?>" /></td>
    </tr>
    <tr>
        <td colspan="8" align="center">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table2">
                <tr>
                    <td style="width:150px;"><strong>Total No. Of Candidates:</strong></td>
                    <td><?php   echo count($AllFeeData); $AllFeeData[1]['AdmFine']?></td>
                    <td><strong>Challan No:</strong> <?php //echo $data["Challan_No"];?></td>
                </tr>
                <tr>
                    <td><strong>Amount Of Admission Fee:</strong></td>
                    <td><?php $TotalAdmFee=0; $TotalProcFee=0; $TotalLateFee=0; $TotalAmount=0; $GrandTotal=0;  $totalco =  count($AllFeeData);

                        foreach ($AllFeeData as $i)
                        {  $TotalAdmFee = $TotalAdmFee + $i['AdmFee'];
                            $TotalProcFee = $TotalProcFee + $i['AdmProcessFee'];
                            $TotalLateFee = $TotalLateFee + $i['AdmFine'];
                            $GrandTotal = $GrandTotal + $i['AdmTotalFee'];

                        };
                        // DebugBreak();
                    echo  $TotalAdmFee;?></td>
                    <td><strong>Deposit Date:</strong> ____/____/______</td>
                </tr>
                <tr>
                    <td><strong>Amount Of Processing Fee:</strong></td>
                    <td><strong><?php echo  $TotalProcFee;?></strong></td>
                    <td><strong>HBL Branch Name:</strong> ________________________</td>
                </tr>

                <tr>
                    <td><strong>Amount Of Late + Token Enrolment Fee:</strong></td>
                    <td><strong><?php echo  $TotalLateFee;?></strong></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td><strong>Total Amount:</strong></td>
                    <td><strong><?php echo $TotalAdmFee+$TotalProcFee+$TotalLateFee ;?></strong></td>
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
        <th class="th">Group</th>
        <th class="th">Adm. Fee</th>
        <th class="th">Late+Token Adm. Fee</th>
        <th class="th">Process. Fee</th>
        <th class="th">Total Amount</th>
    </tr>

    <?php
    //DebugBreak();
    $n = 0; 

    foreach ($data as $key=>$vals) {
        $n++;

        ?>
        <tr>
            <td class="td" style="text-align:center;font-weight:bold;"><?php echo $n;?></td>
            <td class="td"><strong><?php echo $vals['name'];?></strong></td>
            <td class="td"><strong><?php echo $vals['Fname'];?></strong></td>
            <?php
              
            $grp_name = $vals["grp_cd"];
            switch ($grp_name) {
                case '1':
                    $grp_name = 'SCIENCE WITH BIOLOGY';
                    break;
                case '7':
                    $grp_name = 'SCIENCE  WITH COMPUTER SCIENCE';
                    break;
                case '8':
                    $grp_name = 'SCIENCE  WITH ELECTRICAL WIRING';
                    break;
                case '2':
                    $grp_name = 'GENERAL';
                    break;
                case '5':
                    $grp_name = 'Deaf and Dumb';
                    break;
                default:
                    $grp_name = "No Group Selected.";
                   

                    
            }
             if(($vals["sub8"] == 78 || $vals["sub8"] == 43) && $vals["grp_cd"] == 1)
                    {
                        $grp_name = $vals["sub8"];
                        switch ($grp_name) {
                            case '78':
                                $grp_name = 'SCIENCE  WITH COMPUTER SCIENCE';
                                break;
                            case '43':
                                $grp_name = 'SCIENCE  WITH ELECTRICAL WIRING';
                                break;


                        }     
                    }     
            ?>
            <td class="td"><strong><?php echo $grp_name;?></strong></td>


            <td class="td" style="text-align:center !important;"><?php echo $vals['AdmFee'] ;?></td>
            <td class="td" style="text-align:center !important;"><?php echo $vals['AdmFine'];?></td>
            <td class="td" style="text-align:center !important;"><?php echo $vals['AdmProcessFee'];?></td>
            <td class="td" style="text-align:center !important;"><?php echo $vals['AdmTotalFee']?></td>

        </tr>
        <?php
    }  // End of Foreach 
    ?>
    <tr>
        <th class="th">&nbsp;</th>
        <th class="th">&nbsp;</th>
        <th class="th">&nbsp;</th> 
        <th class="th">Total :</th>
        <th class="th"><?php echo  $TotalAdmFee;?></th>
        <th class="th"><?php echo $TotalLateFee;?></th>
        <th class="th"><?php echo $TotalProcFee;?></th>
        <th class="th"><?php echo $GrandTotal;?></th>
    </tr>

    <tr>
        <td colspan="2" style="text-align:right;padding-top:60px; text-decoration: underline;">Printing Date: <?php
            echo  date("d-m-Y h:i:A");
        ?></td>
        <td colspan="5" style="text-align:right;padding-top:60px;text-decoration:overline;">Signature & Stamp Head Of Institution</td>
    </tr>

</table>
