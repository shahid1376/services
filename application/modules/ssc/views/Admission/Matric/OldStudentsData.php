<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">

        <div class="row-fluid">
            <div class="span12">
                <div class="widget no-margin">
                    <div class="widget-header">
                        <div class="title">
                         View All Old Students Records   <a data-original-title="" id="notifications"></a>
                        </div>
                        
                    </div>
                    <div class="widget-body">
                        
                        <hr>
                        <div id="dt_example" class="example_alt_pagination">
                            <table class="table table-condensed table-striped table-hover table-bordered pull-left" id="data-table">
                                <thead>
                                    <tr>
                                        <th style="width: 4%;">
                                            Sr.No.
                                        </th>
                                        <th style="width: 6%;">
                                            9th Roll.No.
                                        </th>
                                        <th style="width:20%">
                                            Name
                                        </th>
                                        <th style="width:20%">
                                            Father's Name
                                        </th>
                                        <th style="width:5%" class="hidden-phone">
                                            DOB
                                        </th>
                                        <th style="width:15%" class="hidden-phone">
                                            Subject Group
                                        </th>
                                        <th style="width:15%" class="hidden-phone">
                                            Selected Subjects
                                        </th>
                                        
                                        <th style="width:10%" class="hidden-phone" >
                                            Download
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                               // DebugBreak();
                                    if($data != false)
                                    {
                                    $n=0;  
                                    $grp_name='';                             
                                    foreach($data as $key=>$vals):
                                    $n++;
                                    $formno = !empty($vals["rno"])?$vals["rno"]:"N/A";
                                    $grp_name = $vals["grp_cd"];
                                    $sub7 = $vals["sub7"];
                                    if($grp_name==1 && $sub7==78)
                                    {
                                        $grp_name = 7;
                                    }
                                    if($grp_name == 1 && $sub7 == 43){
                                        $grp_name = 8;
                                    }
                                    if($grp_name == 1 && $sub7 == 8){
                                        $grp_name = 1;
                                    }
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
                                    
                                   /* if($vals["Brd_cd"] ==  1)
                                    {
                                        $pic =  explode('Pictures$',@$vals["picpath"]);
                                        $picpath = DIRPATH.'\\'.@$pic[1];

                                        $type = pathinfo($picpath, PATHINFO_EXTENSION); 
                                    }
                                    else 
                                    {
                                        // $picpath = DIRPATH.'\\'.@$pic[1];

                                        $picpath =  DIRPATHOTHER.'/'.$vals["Sch_cd"].'/'.$vals["picpath"]; 
                                        $type = pathinfo($picpath, PATHINFO_EXTENSION); 
                                    }
                                   
                                    $vals["picpath"] = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents($picpath));*/
                                 //  DebugBreak();
                                    echo '<tr  >
                                    <td>'.$n.'</td>
                                    <td>'.$vals["rno"].'</td>
                                    <td>'.$vals["name"].'</td>
                                    <td>'.$vals["Fname"].'</td>
                                    <td>'.date("d-m-Y", strtotime($vals["Dob"])).'</td>
                                    <td>'.$grp_name.'</td>
                                    <td>'.$vals["sub1_abr"].','.$vals["sub2_abr"].','.$vals["sub3_abr"].','.$vals["sub4_abr"].','.$vals["sub5_abr"].','.$vals["sub6_abr"].','.$vals["sub7_abr"].','.$vals["sub8_abr"].'</td>';
                                    echo'<td>
                                    <button type="button" class="btn btn-info" value="'.$vals["rno"].'" onclick="NewForm('.$vals["rno"].','.$vals["Brd_cd"].')">Save Form</button>
                                   
                                    </td>
                                    </tr>';
                                    endforeach;
                                    }
                                    ?>
 </tbody>
                            </table>
                            <div class="clearfix"></div>
                        </div>
                        <div class="control-group">
                            <div class="controls controls-row">
                                <label class="label label-important" style="font-size: large;">
                                    Note: Please write "No Image" in the above search to check if any image of candidate is missing or not.
                                </label>
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

