<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">

        <div class="row-fluid">
            <div class="span12">
                <div class="widget no-margin">
                    <div class="widget-header">
                        <div class="title">
                            Edit Forms 9th Registration<a data-original-title="" id="notifications">s</a>
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
                                       
                                        
                                         <th style="width:18%" class="hidden-phone">
                                           Browse Picture
                                        </th>
                                        <th style="width:5%" class="hidden-phone" >
                                            Download
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if($data != false)
                                    {
                                    $n=0;  
                                    $grp_name='';                             
                                    foreach($data as $key=>$vals):
                                    $n++;
                                        $size = @getimagesize(IMAGE_PATH.$Inst_Id.'/'.$vals['PicPath']);
                                        $size = count(@$size);
                                    if(!file_exists(IMAGE_PATH.$Inst_Id.'/'.$vals['PicPath']) || $size == 1)
                                    {
                                        
                                    
                                    
                                    
                                    $formno = !empty($vals["formNo"])?$vals["formNo"]:"N/A";
                                    $grp_name = $vals["RegGrp"];
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

                                    echo '<tr  >
                                    <td>'.$n.'</td>
                                    <td>'.$formno.'</td>
                                    <td>'.$vals["name"].'</td>
                                    <td>'.$vals["Fname"].'</td>
                                    <td>'.date("d-m-Y", strtotime($vals["Dob"])).'</td>
                                     <td>                        
                                     <form id="uplodpics" class="form-horizontal no-margin" action="'.base_url().'/index.php/Registration/uplaodpics" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="formno" value="'.$formno.'">
                                         <input type="file" class="span7" id="image" name="image">
                                     </form>
</td>';
                                    
                                    echo'<td>
                                    <button type="button" class="btn btn-info" value="'.$formno.'" onclick="uplaodpics()">Upload</button>
                                   
                                    </td>
                                    </tr>';
                                    }  endforeach;
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

