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
        <td colspan="8"><div style="font-size:21px;font-weight:bold;text-align:center; "> <label style="font-size:21px;font-weight:bold;text-align:center; background: black; color:white;">FORWARDING LETTER SHOWING DETAILS OF </label> <br />
                9th Class (SESSION <?php echo session_year; ?>)
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
        <td colspan="8" style="font-size:12px;"><img style="margin-left: 605px;height: 19px;     width: 135px;" src="<?php  echo base_url().BARCODE_PATH.$barcode; ?>" /></td>
    </tr>
    <tr>
        <td colspan="8" align="center">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table2">
                <tr>
                    <td style="width:150px;"><strong>Total No. Of Candidates:</strong></td>
                    <td><label style="font-size: 13px;"><strong><?php  echo $data[0]['TotalStd'];?></strong></label></td>
                    <td><strong>Challan No:</strong> <?php //echo $data["Challan_No"];?></td>
                </tr>
                <tr>
                    <td><strong>Amount Of Enrolment Fee:</strong></td>
                    <td><label style="font-size: 13px;"><strong><?php echo  $data[0]['TotalRegFee'];?></strong></label></td>
                    <td><strong>Deposit Date:</strong> ____/____/______</td>
                </tr>
                <tr>
                    <td><strong>Amount Of Processing Fee:</strong></td>
                    <td><label style="font-size: 13px;"><strong><?php echo  $data[0]['TotalProcFee'];?></strong></label></td>
                    <td><strong>HBL Branch Name:</strong> ________________________</td>
                </tr>

                <tr>
                    <td><strong>Amount Of Late + Token Enrolment Fee:</strong></td>
                    <td><label style="font-size: 13px;"><strong><?php echo  $data[0]['TotalLateFee'];?></strong></label></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td><strong>Total Amount:</strong></td>
                    <td><label style="font-size: 16px;"><strong><u><?php echo  $data[0]['TotalAmount'];?></u></strong></label></td>
                    <td>&nbsp;</td>
                </tr>
            </table>

        </td>
    </tr>
    <tr>
    <td colspan="7"><label style="font-size:13px;"><br/><br/> Name of the candidates who have not completed the required number of attendances up to the date of the submission of their forms are being submitted provisionally and are mentioned overleaf. Final report regarding their eligibility will be sent to you in due course as instructed in the book of instructions and information. <br><br/><br/>  I certify that the forms have been filled in strictly according to the instructions and the certificate printed on the admission forms have been signed by me. I also certify that I have initialled all corrections made in the admission forms.</label></td>
    
    </tr>
    <tr>
    <td colspan="7"><label><br/>All my candidates will appear at _________________________________________________________________</label></td>
     
    </tr>
   
     <tr>
     <td colspan="7"><label><br/><br/>(Other remarks if any)</label></td>
     </tr>
     <tr>
     <td colspan="7"><label><br/>______________________________________________________________________________________________</label></td>
     </tr>
     <tr>
     <td colspan="7"><label><br/><br/>______________________________________________________________________________________________</label></td>
     </tr>
     <tr>
     <td colspan="7"><label><br/><br/>______________________________________________________________________________________________</label></td>
     </tr>
     <tr>
     <td colspan="7">
     <label><br/><br/>Yours Obediently,</label>
     </td>
     </tr>
     <tr>
     <td colspan="7">
     <label><br/><br/>Enclosures:  1. ___________________________  </label>
     </td>
     </tr>
     <tr>
     <td colspan="7">
     <label><br/><br/>Enclosures:  2. ___________________________  </label>
     </td>
     </tr>
     <tr>
     <td colspan="7">
     <label><br/><br/>Enclosures:  3. ___________________________  </label>
     </td>
     </tr>
     <tr>
     <td colspan="7">
     <label><br/><br/>Enclosures:  4. ___________________________  </label>
     </td>
     </tr>
     <tr>
     <td colspan="7">
     <label><br/><br/>Enclosures:  5. ___________________________  </label>
     </td>
     </tr>
   <!-- <tr>
        <td colspan="8" style="height:20px;"></td>
    </tr>   -->

   

    <tr>
        <td colspan="2" style="padding-top:60px; text-decoration: underline;">Printing Date: <?php
            echo  date("d-m-Y h:i:A");
        ?></td>
        <td colspan="5" style="text-align:right;padding-top:60px;text-decoration:overline;">Signature & Stamp Head Of Institution</td>
    </tr>

</table>
<img src="<?php echo base_url(); ?>assets/img/forwardinginst.PNG" style="margin-left:350px;" >
