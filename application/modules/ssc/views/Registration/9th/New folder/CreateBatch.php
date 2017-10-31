<div class="dashboard-wrapper class wysihtml5-supported">
          <div class="left-sidebar">
            <div class="row-fluid">
              <div class="span12">
                <div class="widget no-margin">
                  <div class="widget-header">
                    <div class="title">
                      Create batch 9th Registration<a data-original-title="" id="notifications">s</a>
                    </div>
                    <span class="tools">
                      <a data-original-title="" class="fs1" aria-hidden="true" data-icon=""></a>
                    </span>
                  </div>
                  <div class="widget-body">
                                     <div class="control-group">
                    <h4 class="title">
                    Create Batch:
                    </h4>
                     </div>
                     <hr>
                     <!--<div class="control-group">
                         <label class="control-label">
                        <b> Please Select the option and Provide input for Report:</b>
                         </label>
                     </div> -->
                     <div class="control-group">
                     <label class="control-label span1">
                     Select Option:
                     </label>
                     <div class="controls controls-row">
                     <label class="radio inline span1">
                     <input type="radio" name="opt" checked="checked" value="3">Group Wise <br>
                     </label>
                     <label class="radio inline span2">
                        <input type="radio" name="opt" value="2">Special Case(Board Employee) <br>
                     </label>
                      <label class="radio inline span2">
                      <input type="radio" name="opt" value="1">Special Case(Disable) 
                      </label>
                     </div>
                     </div>
                     <div class="control-group">
                     <label class="control-label span1">
                     Select Group:
                     </label>
                     <div class="controls controls-row">
                    <select id="std_group" name="std_group">
                              <option value="">-- Show All Groups --</option>
                            <option value="1">SCIENCE GROUP WITH BIOLOGY</option>
                            <option value="7">SCIENCE GROUP WITH COMPUTER SCIENCE</option>
                             <option value="2">HUMANTIES</option>
                            <option value="5">DEAF AND DUMB</option>
                       </select>
                     </div>
                     </div>
                     <div class="control-group">
                     <div class="controls controls-row">
                     <input type="submit" id="create_batch" name="create_batch" class="btn btn-large btn-info" value="Create Batch of Complete Group" disabled="disabled">
                     <input type="submit" id="create_batch2" name="create_batch2" class="btn btn-large btn-info" value="Create Batch Of Selected Forms" disabled="disabled">
                     
                     </div>
                     </div>
                       <div id="dt_example" class="example_alt_pagination">
                    <table class="table table-condensed table-striped table-hover table-bordered pull-left" id="data-table">
                      <div id="data-table_wrapper" class="dataTables_wrapper" role="grid">
                      <div id="data-table_length" class="dataTables_length">
                      <label>Show <select size="1" name="data-table_length" aria-controls="data-table"><option value="10" selected="selected">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div><div class="dataTables_filter" id="data-table_filter"><label>Search: <input type="text" aria-controls="data-table"></label></div>
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
                          <div class="dataTables_info" id="data-table_info">Showing 1 to 10 of 40 entries</div><div class="dataTables_paginate paging_full_numbers" id="data-table_paginate"><a tabindex="0" class="first paginate_button paginate_button_disabled" id="data-table_first">First</a><a tabindex="0" class="previous paginate_button paginate_button_disabled" id="data-table_previous">Previous</a><span><a tabindex="0" class="paginate_active">1</a><a tabindex="0" class="paginate_button">2</a><a tabindex="0" class="paginate_button">3</a><a tabindex="0" class="paginate_button">4</a></span><a tabindex="0" class="next paginate_button" id="data-table_next">Next</a><a tabindex="0" class="last paginate_button" id="data-table_last">Last</a></div></div>
                      <div class="clearfix">
                      </div>
                    </div>
                    <!--<label class="label label-important" style="font-size: large;">
                    Note:<br>
                     Please write "No Image" in the above search to check if any image of candidate is missing or not.<br>
                     Forms with "No Image" will not be batched. So please make sure all images are uploaded properly before creating batches. 
                    </label>-->
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        