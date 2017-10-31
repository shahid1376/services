           <div class="row-fluid">
		<div class="dashboard-wrapper class wysihtml5-supported">
          <div class="left-sidebar">
            <div class="row-fluid">
              <div class="span12">
                <div class="widget">
                  <div class="widget-header">
                    <div class="title">
                      <a id="dynamicTable">Dynamic Table</a>
                    </div>
                    <span class="tools">
                      <a class="fs1" aria-hidden="true" data-icon="&#xe090;"></a>
                    </span>
                  </div>
                  <div class="widget-body">

					<div id="dt_example" class="example_alt_pagination">
                      <table class="table table-condensed table-striped table-hover table-bordered pull-left" id="data-table">
					   <thead> 
						<tr>
						  <th scope="col">Sr#</th>
						  <th scope="col">Rno</th>
						  <th scope="col">Student Name</th>
						  <th scope="col">FatherName</th>
						  <th scope="col">DateofBirth</th>
						  <th scope="col">Result</th>
						  <th scope="col" style="text-align:center;">Add</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$n = 0;
						if(is_array($data)){
							foreach($data as $key=>$vals):
							$n++;
							$stdRno = '';
							$rno = 0; $rno = $vals["rno"];
							$stdRno = $rno;
							echo '
							   <tr>
									<td>'.$n.'</td>
									<td>'.$vals["rno"].'</td>
									<td>'.$vals["name"].'</td>						
									<td>'.$vals["fName"].'</td>
									<td>'.$vals["dob"].'</td>
									<td>'.$vals["result1"].'</td>
									<td><a href="ReAdmission/'.$stdRno.'">Submit</a></td>
							  </tr>';
						   endforeach;
						} else {
							echo '<tr>
									<td colspan=7>No Data</td>
							  </tr>';
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
