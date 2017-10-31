<div class="dashboard-wrapper">
    <div class="left-sidebar">


        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title">
                            12th Result Card:
                        </div>

                    </div>
                    <div class="widget-body">
                        <div id="dt_example" class="example_alt_pagination">
                            <table width="100%">
                                <tr>
                                    <?php  if($isdeaf ==0) {?>
                                        <td width="50%">  
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="reports_gen">

                                                <tr class="groups">
                                                    <th scope="row">Select Group:</th>
                                                    <td>
                                                        <select id="std_group" style="width:200px;" class="custom" name="std_group" onchange="std_group(this.value)">
                                                            <option value="-1">-- Show All Groups --</option>
                                                            <option value="1">PRE-MEDICAL</option>
                                                            <option value="2">PRE-ENGINEERING</option>
                                                            <option value="3">HUMANITIES</option>
                                                            <option value="4">GENERAL SCIENCE</option>
                                                            <option value="5">COMMERCE</option>
                                                            <option value="6">ISLAMIC STUDIES</option>
                                                            <option value="7">HOME ECONOMICS</option>
                                                            <!--<option value="5">DEAF AND DUMB</option>-->
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"></th>

                                                    <td>
                                                        <button type="button" class="btn btn-info"  onclick="downloadgroupwise12(1)" disabled="disabled" id="downbtn">Download Group Wise Result Cards.</button>
                                                        <button type="button" class="btn btn-info"  onclick="downloadgroupwise12(2)" disabled="disabled" id="viewbtn">View Group Wise Result Cards.</button>
                                                    </td>

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
                                        <th style="width:4%" class="hidden-phone">
                                            Pciture
                                        </th>
                                        <th style="width:20%" class="hidden-phone">
                                            Download
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //DebugBreak();
                                    if($data != false)
                                    {
                                        $n=0;  
                                        $grp_name='';                             
                                        foreach($data as $key=>$vals):
                                        $n++;
                                        
                                        if($vals["result1"] != '' && $vals["status"] == 2)
                                        $vals["result2"] = $vals["result1"]. ' [P-I] ' .$vals["result2"];
                                        
                                        $roll_no = !empty($vals["rno"])?$vals["rno"]:"N/A";
                                        $grp_name = $vals["grp_cd"];
                                        switch ($grp_name) {
                                            case '1':
                                                $grp_name = 'PRE-MEDICAL';
                                                break;
                                            case '2':
                                                $grp_name = 'PRE-ENGINEERING';
                                                break;
                                            case '3':
                                                $grp_name = 'HUMANITIES';
                                                break;
                                            case '4':
                                                $grp_name = 'GENERAL SCIENCE';
                                                break;
                                            case '5':
                                                $grp_name = 'COMMERCE';
                                                break;
                                            case '6':
                                                $grp_name = 'ISLAMIC STUDIES';
                                                break;
                                            case '7':
                                                $grp_name = 'HOME ECONOMICS';
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
                                        <td style="text-align:center"> <img src="'.REGULAR_IMAGE_PATH.$vals["picpath"].'" style="height: 60px;">'.'</td>
                                        '; 
                                        

                                        echo'<td>
                                        <button type="button" class="btn btn-info" value="'.$roll_no.'" onclick="downloadslip_Inter('.$roll_no.',1)">Download Result Card</button>
                                        <button type="button" class="btn btn-info" value="'.$roll_no.'" onclick="downloadslip_Inter('.$roll_no.',2)">View Result Card</button>
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
