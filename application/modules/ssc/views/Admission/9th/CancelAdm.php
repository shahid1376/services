<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">

        <div class="row-fluid">
            <div class="span12">
                <div class="widget no-margin">
                    <div class="widget-header">
                        <div class="title">
                            View All Admitted Candidates   <a data-original-title="" id="notifications"></a>
                        </div>

                    </div>
                    <form action="<?=base_url()?>index.php/Admission_9th_reg/NewEnrolment_update/" method="post" id="form_make_adm">
                        <div class="widget-body">
                            <div class='control-group'>
                                <div class='controls controls-row'>
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
                                                    <th style="width:15%" class="hidden-phone">
                                                        Selected Subjects
                                                    </th>
                                                    <th style="width:5%" class="hidden-phone">
                                                        Picture
                                                    </th>
                                                    <th scope="col" align="center"><a href="javascript:void(0);" style="color:red;" class="check">Check All</a></th>
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

                                                        //  DebugBreak();
                                                        echo '<tr  >
                                                        <td>'.$n.'</td>
                                                        <td>'.$vals["formNo"].'</td>
                                                        <td>'.$vals["name"].'</td>
                                                        <td>'.$vals["Fname"].'</td>
                                                        <td>'.date("d-m-Y", strtotime($vals["Dob"])).'</td>
                                                        <td>'.$grp_name.'</td>
                                                        <td>'.$vals["sub1_abr"].','.$vals["sub2_abr"].','.$vals["sub3_abr"].','.$vals["sub4_abr"].','.$vals["sub5_abr"].','.$vals["sub6_abr"].','.$vals["sub7_abr"].','.$vals["sub8_abr"].'</td>
                                                        <td><img id="previewImg" style="width:40px; height: 40px;" src="'.GET_IMAGE_PATH_9th_Admission_Annual.$Inst_Id.'/'.$vals["picpath"].'?'.rand(10000,1000000).'" alt="Candidate Image"></td>
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

                                        <input type="hidden" id="isformwise" name="isformwise" value="3"> 
                                        <div class="clearfix"></div>
                                    </div>
                                    <br>
                                    <div class="row">

                                        <div class="col-lg-12" style="float: right;">
                                        <button type="submit" class="btn btn-large btn-info" name="make_adm_all" id="make_adm_sel" value="3" onclick="return issubmit_sel_cancel();" >Cancel Admissions Of Selected Students</button>
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

