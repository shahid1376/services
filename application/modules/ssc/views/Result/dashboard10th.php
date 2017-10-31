<div class="dashboard-wrapper">
    <div class="left-sidebar">


        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title">
                            10th Result Card:
                        </div>

                    </div>
                    <div class="widget-body">
                        <div id="dt_example" class="example_alt_pagination">
                            <table width="100%">
                                <tr>
                                    <?php if($isdeaf ==0) {?>
                                        <td width="50%">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="reports_gen">

                                                <tr class="groups">
                                                    <th scope="row">Select Group:</th>
                                                    <td>
                                                        <select id="std_group" style="width:375px;" class="custom" name="std_group"  onchange="std_group(this.value)">
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
                                                            <button type="button" class="btn btn-info"  onclick="downloadgroupwise10thres(1)" disabled="disabled" id="downbtn">Download Group Wise Result Cards.</button>
                                                            <button type="button" class="btn btn-info"  onclick="downloadgroupwise10thres(2)" disabled="disabled" id="viewbtn">View Group Wise Result Cards.</button>
                                                        </td>
                                                    </th>

                                                </tr>

                                            </table>
                                        </td>
                                        <?php }?>
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
                                 //   DebugBreak();
                                    if($data != -1)
                                    {
                                        $n=0;  
                                        $grp_name='';  
                                                                   
                                        foreach($data as $key=>$vals):
                                            $n++;
                                            $disables = '' ;
                                            if($vals["result1"] != '' && $vals["status"] == 2)
                                                $vals["result2"] = $vals["result1"]. ' [P-I] ' .$vals["result2"];

                                            $roll_no = !empty($vals["rno"])?$vals["rno"]:"N/A";
                                          /*  if($vals['rno']=="456504")
                                            {
                                                $vals['spl_cd']="73";
                                                $vals['spl_name'] = "RL DUE TO REGISTRATION BRANCH (CONTACT TO REGISTRATION BRANCH)";
                                            }*/
                                            $grp_name = $vals["grp_cd"];
                                            if(($vals["status"] == 4 || $vals['spl_cd']!="")  )
                                            {
                                                $disables = '';
                                                if($vals['spl_cd']!="" )
                                                {
                                                    $disables = '<h6 style="color: red;">'.$vals['spl_name'].'</h6>';
                                                }
                                            }
                                            else
                                            {

                                                $disables = '<button type="button" class="btn btn-info" value="'.$roll_no.'" onclick="downloadslip_matric('.$roll_no.',1,'.$sess.')">Download Result Card</button>
                                                <button type="button" class="btn btn-info" value="'.$roll_no.'" onclick="downloadslip_matric('.$roll_no.',2,'.$sess.')">View Result Card</button>'; 
                                            }
                                            if($roll_no != 481476 || $roll_no != 481665 || $roll_no != 488061)
                                            {
                                                $disables = '<button type="button" class="btn btn-info" value="'.$roll_no.'" onclick="downloadslip_matric('.$roll_no.',1,'.$sess.')">Download Result Card</button>
                                                <button type="button" class="btn btn-info" value="'.$roll_no.'" onclick="downloadslip_matric('.$roll_no.',2,'.$sess.')">View Result Card</button>'; 
                                            }
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
                                            <td>'.$grp_name.'</td>
                                            <td>'.$vals["result2"].'</td>
                                            '; 


                                            echo'<td>'.$disables.'</td>
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
