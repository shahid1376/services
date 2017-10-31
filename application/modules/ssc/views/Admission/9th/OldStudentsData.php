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
                    <form action="<?=base_url()?>index.php/Admission_9th_reg/NewEnrolment_update/" method="post" id="form_make_adm">
                        <div class="widget-body">
                      <!--  <div class='control-group'>
                              <label class='control-label span1'>
                                    Select Options:
                                </label>
                                <div class="controls controls-row">
                                <input type="radio" name="opt"  checked="checked" value="3" />Group Wise <br />
                                </div>
                                </div>
                                 <div class='control-group'>
                                   <label class='control-label span1'>  </label>
                                    <div class="controls controls-row">
                                <input type="radio" name="opt" value="2" />Special Case(Board Employee) <br />   
                                
                                 </div>
                                  </div>
                                   <div class='control-group'>
                                   <label class='control-label span1'>  </label>
                                    <div class="controls controls-row">
                                <input  type="radio" name="opt" value="1" />Special Case(Disable) <br /> 
                                
                                 </div>
                                  </div>   -->
                               
                 
                            <div class='control-group'>
                                <label class='control-label span1'>
                                    Select Group:
                                </label>
                                <div class='controls controls-row'>
                                    <select id='make_adm9th_groups' name='make_adm9th_groups'>
                                        <?php

                                        // DebugBreak();
                                        $subgroups =  split(',',$grp_cd);
                                        echo "<option value='0' >SELECT GROUP</option>";
                                        for($i =0 ; $i<count($subgroups); $i++)
                                        {
                                            if($subgroups[$i] == 1)
                                            {
                                                if($grp_selected == 1)
                                                {
                                                    echo "<option value='1' selected='selected'>SCIENCE WITH BIOLOGY</option>";  
                                                }
                                                else 
                                                {
                                                    echo "<option value='1' >SCIENCE WITH BIOLOGY</option>";    
                                                }
                                            }
                                            else if($subgroups[$i] == 7)
                                            {
                                                if($grp_selected == 7 )
                                                {
                                                    echo "<option value='7' selected='selected'>SCIENCE  WITH COMPUTER SCIENCE</option>";
                                                }
                                                else
                                                {
                                                    echo "<option value='7'>SCIENCE  WITH COMPUTER SCIENCE</option>"; 
                                                }

                                            }
                                            else if($subgroups[$i] == 8)
                                            {
                                                if($grp_selected == 8)
                                                {
                                                    echo "<option value='8' selected='selected'>SCIENCE  WITH ELECTRICAL WIRING</option>";  
                                                }
                                                else
                                                {
                                                    echo "<option value='8'>SCIENCE  WITH ELECTRICAL WIRING</option>";  
                                                }

                                            }
                                            else if($subgroups[$i] == 2)
                                            {
                                                if($grp_selected == 2 )
                                                {
                                                    echo "<option value='2' selected='selected'>GENERAL</option>";  
                                                }
                                                else
                                                {
                                                    echo "<option value='2'>GENERAL</option>";   
                                                }

                                            }
                                            else if($subgroups[$i] == 5)
                                            {
                                                if($grp_selected == 5 )
                                                {
                                                    echo "<option value='5' selected='selected'>DEAF AND DUMB</option>";  
                                                }
                                                else
                                                {
                                                    echo "<option value='5'>DEAF AND DUMB</option>";  
                                                }

                                            }
                                        }
                                        /* <option value='1'>SCIENCE GROUP WITH BIOLOGY</option>
                                        <option value='7'>SCIENCE GROUP WITH COMPUTER SCIENCE</option>
                                        <option value='2'>HUMANTIES</option>
                                        <option value='5'>DEAF AND DUMB</option>*/
                                        ?> 
                                    </select>
                                    <hr>
                                    <div id="dt_example" class="example_alt_pagination">
                                        <table class="table table-condensed table-striped table-hover table-bordered pull-left" id="data-table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 4%;">
                                                        Sr.No.
                                                    </th>
                                                    <th style="width: 6%;">
                                                        Form No.
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
                                                    <th style="width:10%" class="hidden-phone">
                                                        Selected Subjects
                                                    </th>
                                                    <th style="width:5%" class="hidden-phone">
                                                        Picture
                                                    </th>
                                                    <th style="width:6%" class="hidden-phone">
                                                        View Form
                                                    </th>
                                                    <th  style="width:10%" scope="col" align="center"><a href="javascript:void(0);" style="color:red;" class="check">Check All</a></th>
                                                    <!--<th style="width:10%" class="hidden-phone" >
                                                    Download
                                                    </th>   -->
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
                                                        $formno = !empty($vals["formNo"])?$vals["formNo"]:"N/A";
                                                        $grp_name = $vals["grp_cd"];
                                                        $sub7 = $vals["sub8"];
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

                                                        $picpath =  DIRPATH9th.'/'.$Inst_Id.'/'.$vals["picpath"];
                                                       // echo $picpath;
                                                        $type = pathinfo($picpath, PATHINFO_EXTENSION);
                                                        $vals["picpath"] = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents($picpath));
                                                        
                                                        //  DebugBreak();
                                                        echo '<tr  >
                                                        <td>'.$n.'</td>
                                                        <td>'.$vals["formNo"].'</td>
                                                        <td>'.$vals["name"].'</td>
                                                        <td>'.$vals["Fname"].'</td>
                                                        <td>'.date("d-m-Y", strtotime($vals["Dob"])).'</td>
                                                        <td>'.$grp_name.'</td>
                                                        <td>'.$vals["sub1_abr"].','.$vals["sub2_abr"].','.$vals["sub3_abr"].','.$vals["sub4_abr"].','.$vals["sub5_abr"].','.$vals["sub6_abr"].','.$vals["sub7_abr"].','.$vals["sub8_abr"].'</td>
                                                        <td><img id="previewImg" style="width:40px; height: 40px;" src="'.$vals["picpath"] .'" alt="Candidate Image"></td>
                                                        <td> <button type="button" class="btn btn-info" value="'.$formno.'" onclick="NewForm('.$formno.')">View Form</button></td>
                                                        <td><input style="width: 24px; height: 24px;" type="checkbox" name="chk[]" value="'.$formno.'" /></td> </tr>';
                                                        /*<td><img id="previewImg" style="width:40px; height: 40px;" src="/'.IMAGE_PATH.$Inst_Id.'/'.$vals['PicPath'].'" alt="Candidate Image"></td>';*/
                                                        /* echo'<td>
                                                        <button type="button" class="btn btn-info" value="'.$formno.'" onclick="NewForm('.$formno.')">Save Form</button>

                                                        </td>
                                                        </tr>';  */
                                                        endforeach;
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                        <input type="hidden" id="isformwise" name="isformwise" value="0"> 
                                        <div class="clearfix"></div>
                                    </div>
                                    <br>
                                    <div class="row">

                                        <div class="col-lg-12" style="float: right;">
                                        
                                        <button type="button" class="btn btn-large btn-info" name="make_adm_all" id="make_adm_all" value="1" onclick="return issubmit_all();" >Submit Admissions Of All Students</button>
                                        <button type="button" class="btn btn-large btn-info" name="make_adm_all" id="make_adm_sel" value="2" onclick="return issubmit_sel();" >Submit Admissions Of Selected Students</button>
                                        </div>
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
                    </form> 
                </div>
            </div>
        </div>
    </div> 
</div>

