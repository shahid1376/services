<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">

        <div class="row-fluid">
            <div class="span12">
                <div class="widget no-margin">
                    <div class="widget-header">
                        <div class="title">
                            Edit Forms 9th Correction<a data-original-title="" id="notifications">s</a>
                        </div>
                        
                    </div>
                    <div class="widget-body">
                        <h4>
                            View All Submited Forms:
                        </h4>
                        <hr>
                        <div id="dt_example" class="example_alt_pagination">
                            <table class="table table-condensed table-striped table-hover table-bordered pull-left" id="data-table">
                                <thead>
                                    <tr>
                                        <th style="width: 1%;">
                                            Sr.No.
                                        </th>
                                        <th style="width:5%">
                                            Application No.
                                        </th> <th style="width:5%">
                                            Form No.
                                        </th>
                                        <th style="width:15%">
                                            Name
                                        </th>
                                        <th style="width:15%">
                                            Father's Name
                                        </th>
                                        <th style="width:5%" class="hidden-phone">
                                            DOB
                                        </th>
                                    <th style="width:28%" class="hidden-phone" >
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
                                    $formno = !empty($vals["formNo"])?$vals["formNo"]:"N/A";
                                    /*$grp_name = $vals["RegGrp"];
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
                                            $grp_name = 'Humanities';
                                            break;
                                        case '5':
                                            $grp_name = 'Deaf and Dumb';
                                            break;
                                        default:
                                            $grp_name = "No Group Selected.";
                                    }
*/
                                    echo '<tr  >
                                    <td>'.$n.'</td>
                                    <td>'.$vals['AppNo'].'</td>
                                    <td>'.$formno.'</td>
                                    <td>'.$vals["Pre_Name"].'</td>
                                    <td>'.$vals["Pre_FName"].'</td>
                                    <td>'.date("d-m-Y", strtotime($vals["Pre_Dob"])).'</td>
                                    <td><button type="button" class="btn btn-info" value="'.$vals['AppNo'].'" onclick="download_corr_form('.$vals['AppNo'].')">Download Correction Form</button>
                                    <button type="button" class="btn btn-info" value="'.$vals['AppNo'].'" onclick="download_challan_form('.$vals['AppNo'].')">Download Challan Form</button>
                                    <button type="button" class="btn btn-danger" value="'.$vals['AppNo'].'" onclick="Corr_App_Delete('.$vals['AppNo'].')">Delete Application</button>
                                    </td>
                                    </tr>';
                                     //<button type="button" class="btn btn-info" value="'.$formno.'" onclick="EditForm('.$formno.')">Edit Form</button>
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

