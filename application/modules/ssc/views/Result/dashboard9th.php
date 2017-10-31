<div class="dashboard-wrapper">
    <div class="left-sidebar">


        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title">
                            9th Result Cards:
                        </div>

                    </div>
                    <div class="widget-body">
                        <div id="dt_example" class="example_alt_pagination">
                            <table>
                                <tr>
                                    <?php if($isdeaf ==0) {?>
                                        <td width="50%">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="reports_gen">

                                                <tr class="groups">
                                                    <th scope="row">Select Group:</th>
                                                    <td>
                                                        <select id="std_group" style="width:200px;" class="custom" name="std_group"  onchange="std_group(this.value)">
                                                            <option value="">-- Show All Groups --</option>
                                                            <option value="1">SCIENCE GROUP WITH BIOLOGY</option>
                                                            <option value="7">SCIENCE GROUP WITH COMPUTER SCIENCE</option>
                                                            <option value="8">SCIENCE GROUP WITH ELECTRICAL WIRING(OPT)</option>
                                                            <option value="2">GENERAL</option>

                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        <td>
                                                            <button type="button" class="btn btn-info"  onclick="downloadgroupwise9th(1)" disabled="disabled" id="downbtn">Download Group Wise Result Cards.</button>
                                                            <button type="button" class="btn btn-info"  onclick="downloadgroupwise9th(2)" disabled="disabled" id="viewbtn">View Group Wise Result Cards.</button>
                                                        </td>
                                                    </th>

                                                </tr>

                                            </table>
                                        </td>
                                        <?php }?>
                                    <!--  <td width="50%">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="reports_gen">

                                    <tr class="groups">
                                    <td scope="row"><img src="<?= base_url();?>assets/img/backside.jpg"></td>

                                    </tr>
                                    <tr>
                                    <td>
                                    <a href="<?= base_url();?>assets/img/slip_back_page.pdf" target="_blank"><button type="button" class="btn btn-info"  id="downbtn">Download Roll No Slip Back Instructions.</button></a></td>

                                    </tr>

                                    </table>
                                    </td>-->
                                </tr>
                            </table>



                            <table class="table table-condensed table-striped table-hover table-bordered pull-left" id="data-table">

                                <thead>
                                    <tr>
                                        <th style="width: 5%;">
                                            Sr.No.
                                        </th>
                                        <th style="width:5%">
                                            FormNo.
                                        </th>
                                        <th style="width:5%">
                                            Roll No.
                                        </th>
                                        <th style="width:10%">
                                            Name
                                        </th>
                                        <th style="width:10%">
                                            Father's Name
                                        </th>
                                        <th style="width:8%" class="hidden-phone">
                                            DOB
                                        </th>
                                        <th style="width:10%" class="hidden-phone">
                                            Subject Group
                                        </th>
                                        <th style="width:6%" class="hidden-phone">
                                            Result
                                        </th>
                                       
                                        <th style="width:20%" class="hidden-phone">
                                            Download
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //  DebugBreak();
                                    if($data != -1)
                                    {
                                        $n=0;  
                                        $grp_name='';                             
                                        foreach($data as $key=>$vals):
                                        $n++;
                                        $roll_no = !empty($vals["rno"])?$vals["rno"]:"N/A";
                                        $grp_name = $vals["grp_cd"];
                                        switch ($grp_name) {
                                            case '1':
                                                $grp_name = 'Science';
                                                break;
                                            case '2':
                                                $grp_name = 'GENERAL';
                                                break;
                                            case '5':
                                                $grp_name = 'DEAF & DEFECTIVE';
                                                break;
                                            default:
                                                $grp_name = "No Group Selected.";
                                        }
                                        echo '<tr>
                                        <td>'.$n.'</td>
                                        <td>'.$vals["formNo"].'</td>
                                        <td>'.$roll_no.'</td>
                                        <td>'.$vals["name"].'</td>
                                        <td>'.$vals["Fname"].'</td>
                                        <td>'.$vals["Dob"].'</td>
                                        <td>'.$grp_name.'</td>
                                        <td>'.$vals["result1"].'</td>';

                                        echo'<td>
                                        <button type="button" class="btn btn-info" value="'.$roll_no.'" onclick="downloadslip9th('.$roll_no.',1)">Download Result Card</button>
                                        <button type="button" class="btn btn-info" value="'.$roll_no.'" onclick="downloadslip9th('.$roll_no.',2)">View Result Card</button>
                                        </td>
                                        </tr>';
                                        endforeach;
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="clearfix">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>



    </div>

</div>
</div>
</div>
<script type="">
    function std_group(val)
    {
        if(val>0)
        {
            document.getElementById("downbtn").disabled=false; 
            document.getElementById("viewbtn").disabled=false; 
        }
        else
        {
            document.getElementById("downbtn").disabled=true;
            document.getElementById("viewbtn").disabled=true;
        }

    }

</script>
