<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">

        <div class="row-fluid">
            <div class="span12">
                <div class="widget no-margin">
                    <div class="widget-header">
                        <div class="title">
                            Edit Forms 9th Registration<a data-original-title="" id="notifications">s</a>
                        </div>
                        <span class="tools">
                            <a data-original-title="" class="fs1" aria-hidden="true" data-icon=""></a>
                        </span>
                    </div>
                    <div class="widget-body">
                        <h4>
                            View All Submited Forms:
                        </h4>
                        <hr>
                       <!-- <div id="dt_example" class="example_alt_pagination">-->
                            <!--<table class="table table-condensed table-striped table-hover table-bordered pull-left" id="data-table">-->
                           <!-- <div id="data-table_wrapper" class="dataTables_wrapper" role="grid">-->
                               <!-- <div id="data-table_length" class="dataTables_length">
                                    <label>Show <select size="1" name="data-table_length" aria-controls="data-table"><option value="10" selected="selected">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div><div class="dataTables_filter" id="data-table_filter"><label>Search: <input type="text" aria-controls="data-table"></label></div>-->
                                   <table class="table table-condensed table-striped table-hover table-bordered pull-left" id="data-table1">

                                <thead>
                                    <tr>
                                        <th style="width: 5%;">
                                            Sr.No.
                                        </th>
                                        <th style="width:5%">
                                            Form No.
                                        </th>
                                        <th style="width:20%">
                                            Name
                                        </th>
                                        <th style="width:20%">
                                            Father's Name
                                        </th>
                                        <th style="width:10%" class="hidden-phone">
                                            DOB
                                        </th>
                                        <th style="width:5%" class="hidden-phone">
                                            Subject Group
                                        </th>
                                        <th style="width:5%" class="hidden-phone">
                                            Picture
                                        </th>
                                        <th style="width:25%" class="hidden-phone">
                                            Download
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                   // //DebugBreak();
                                    $n=0;  
                                    $grp_name='';                             
                                    foreach($data as $key=>$vals):
                                    $n++;
                                    $formno = !empty($vals["formNo"])?$vals["formNo"]:"N/A";
                                    $grp_name = $vals["grp_cd"];
                                    switch ($grp_name) {
                                        case '1':
                                            $grp_name = 'Science';
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
                                    echo '<tr>
                                    <td>'.$n.'</td>
                                    <td>'.$formno.'</td>
                                    <td>'.$vals["name"].'</td>
                                    <td>'.$vals["Fname"].'</td>
                                    <td>'.$vals["Dob"].'</td>
                                    <td>'.$grp_name.'</td>
                                    <td><img id="previewImg" style="width:40px; height: 40px;" src="'.base_url().'assets/uploads/'.$Inst_Id.'/'.$vals['PicPath'].'" alt="                                             Candidate Image"></td>';

                                    echo'<td>
                                    <button type="button" class="btn btn-info" value="'.$formno.'" onclick="EditForm('.$formno.')">Edit Form</button>
                                     <button type="button" class="btn btn-info" value="'.$formno.'" onclick="DeleteForm('.$formno.')">Delete Form</button>
                                    </td>
                                    </tr>';
                                    endforeach;
                                    //  echo ' <tr class="gradeX warning">
                                    //                                    <td>
                                    //
                                    //                                    </td>
                                    //                                    <td>
                                    //                                    14.7 %
                                    //                                    </td>
                                    //                                    <td>
                                    //                                    31.1 %
                                    //                                    </td>
                                    //                                    <td class="hidden-phone">
                                    //                                    46.9 %
                                    //                                    </td>
                                    //                                    <td class="hidden-phone">
                                    //                                    4.2 %
                                    //                                    </td>
                                    //                                    <td class="hidden-phone">
                                    //                                    2.1 %
                                    //                                    </td>
                                    //                                    </tr> ';
                                    ?>
                                </tbody>
                            </table>
     
                           <!-- <div class="clearfix">
                            </div>
                        </div>-->
                      <!--  <div class="control-group">
                            <div class="controls controls-row">
                                <label class="label label-important" style="font-size: large;">
                                    Note: Please write "No Image" in the above search to check if any image of candidate is missing or not.
                                </label>
                            </div>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div> 
</div>
<script type="">


   //alert('Hello ');
  
    //console.log( "ready!" );

</script>
