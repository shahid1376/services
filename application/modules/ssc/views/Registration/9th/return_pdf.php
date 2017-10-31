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
 font-size:11px;
 padding:3px; 
 border:1px solid #818181;
}
.td{
 font-size:10px;
 padding:3px;
 text-align:left; 
 border:1px solid #C0C0C0;
}
body {
    margin:0 auto;
    width:980px;
}
</style>
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" colspan="8">
    <h3 style="margin:0;padding:0;">BOARD OF INTERMEDIATE & SECONDARY EDUCATION, Gujranwala</h3>
    </td>
  </tr>
  <tr>
    <td style="text-align:center;font-weight:bold;" colspan="8">INTERMEDIATE PART-I ENROLMENT RETURN SESSION (2016-2018)</td>
  </tr>
  <tr>
    <td style="height:10px;" colspan="8"></td>
  </tr>
  <tr>
    <td style="font-size:12px;padding:8px 0 0 0;" colspan="8"><strong>Institute Name:</strong> <?php echo $inst_Name;?></td>
  </tr>
  <tr>
    <td colspan="8">
         <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top:10px;">
         <tr>
        <td style="font-size:12px;padding-left:50px;"><strong>Group Name:</strong> <?php $grp_cd = $data[0]["RegGrp"];      switch ($grp_cd) {
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
                                            $grp_name = 'Humanities';
                                            break;
                                        case '5':
                                            $grp_name = 'Deaf and Dumb';
                                            break;
                                        default:
                                            $grp_name = "No Group Selected.";
                                    }
                                    echo $grp_name;
                                    //echo get_groupname($batch_id);?> </td>
        <td style="font-size:12px;padding-left:50px;"><strong>Institute Code:</strong> <?php  echo  $data[0]["Sch_cd"];?></td>
        <td style="font-size:12px;padding-left:50px;"><strong>Gender:</strong> <?php if($data[0]['sex'] == 1)echo "Male";else{echo "Female";}?></td>
      </tr>
        </table>
    </td>
  </tr>

      <tr style="margin-top:30px;">
        <th class="th">Sr#</th>
        <th class="th">Student Name/ Bay-Form</th>
        <th class="th">Father Name/ CNIC</th>
        <th class="th">DOB</th>
        <th class="th">Elective Subjects</th>
        <th class="th">Adm Date</th>
        <th class="th">FormNo</th>
        <th class="th">Image</th>
      </tr>

  <?php
  //DebugBreak();
  $n = 0;
  foreach ($data as $key=>$vals) {
      $n++;
  ?>
      <tr>
        <td class="td" style="text-align:center;font-weight:bold;"><?php echo $n;?></td>
        <td class="td"><strong><?php echo $vals["name"];?></strong> <br /><br /> <?php echo $vals["BForm"];?></td>
        <td class="td"><strong><?php echo $vals["Fname"];?></strong> <br /><br /> <?php echo $vals["FNIC"];?></td>
        <td class="td"><?php echo $vals["Dob"];?> </td>
        <td class="td"><?php //echo show_subjects_list($vals["FormNo"]);?></td>
        <td class="td"><?php echo $vals["Dob"];?></td>
        <td class="td"><?php echo $vals["formNo"];?> </td>
        <td class="td"><?php 
            $exists = file_exists('assets/uploads/'.$vals["Sch_cd"].'/'.$vals["PicPath"]);
              if($exists) {
                $img =base_url().'/assets/uploads/'.$vals["Sch_cd"].'/'.$vals["PicPath"];
                }else{
                     $img =base_url()."/assets/img/no_image.png";
                     }        
            ?> 
        <img src="<?php echo $img;?>" style="width: 50px;height:50px" alt="std_img" />
        </td>
      </tr>
  <?php
  }
  ?>

  <tr>
    <td colspan="8" style="height:20px;"></td>
  </tr>  
  <tr>
    <td colspan="8" style="text-align:left;">Certified that I have checked all the relevant record of the students and the particulars as mentioned above are correct.</td>
  </tr>
  <tr>
    <td colspan="8" style="text-align:right;padding-top:60px;text-decoration:overline;">Signature of Head of Institution with Stamp
    </td>
  </tr>
</table>
