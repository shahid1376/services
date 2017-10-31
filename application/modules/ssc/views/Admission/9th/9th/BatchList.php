<div class="dashboard-wrapper class wysihtml5-supported">
          <div class="left-sidebar">
         
            <div class="row-fluid">
              <div class="span12">
                <div class="widget no-margin">
                  <div class="widget-header">
                    <div class="title">
                      Batch List 9th Registration<a data-original-title="" id="notifications">s</a>
                    </div>
                   
                  </div>
                  <div class="widget-body">
                    <h4>
                  View All Batched Forms:
                  </h4>
                  <hr>
                  <div id="dt_example" class="example_alt_pagination">
                            <table class="table table-condensed table-striped table-hover table-bordered pull-left" id="data-table">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">
                                            Sr.No.
                                        </th>
                                        <th style="width:7%">
                                            Batch Id.
                                        </th>
                                        <th style="width:15%">
                                            Total Forms In Batch
                                        </th>
                                        <th style="width:15%">
                                            Total Registration Fee
                                        </th>
                                        <th style="width:13%" class="hidden-phone">
                                            Total Processing Fee
                                        </th>
                                        <th style="width:20%" class="hidden-phone">
                                            Total Amount
                                        </th>
                                         <th style="width:25%" class="hidden-phone">
                                            Downloads
                                        </th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                   // DebugBreak();
                                    
                                    if($info!= false)
                                    {
                                    $n=0;  
                                    $grp_name='';                             
                                    foreach($Inst_Cd = $info as $key=>$vals):
                                    $n++;
                                    //$formno = !empty($vals["formNo"])?$vals["formNo"]:"N/A";
                                    echo '<tr  >
                                    <td>'.$n.'</td>
                                    <td>'.$vals['Batch_ID'].'</td>
                                    <td>'.$vals["COUNT"].'</td>
                                    <td>'.$vals["Total_RegistrationFee"].'</td>
                                    <td>'.$vals["Total_ProcessingFee"].'</td> 
                                    <td style="font-weight: bold;font-size: 16px;">'.$vals["Amount"].'</td>
                                    <td><button type="button" class="btn btn-info" value="'.$vals['Batch_ID'].'" onclick="ReturnForm('.$vals['Batch_ID'].')">Return Form</button>
                                     <button type="button" class="btn btn-info" value="'.$vals['Batch_ID'].'" onclick="ChallanForm_Reg9th_Regular('.$vals['Batch_ID'].')">Download Challan Form</button>
                                    <button type="button" class="btn btn-info" value="'.$vals['Batch_ID'].'" onclick="RevenueForm('.$vals['Batch_ID'].')">Revenue Form</button>';
                                    if($vals['flag']==0){
                                     echo '<button type="button" class="btn btn-danger" value="'.$vals['Batch_ID'].'" onclick="ReleaseForm('.$vals['Batch_ID'].')">Release Batch</button>';   
                                    }
                                     echo '
                                    </td>';
                                    endforeach;
                                    
                                    //DebugBreak();
                                 
                                    }
                                    ?>



                                </tbody>
                            </table>
                            <div class="clearfix"></div>
                        </div>
                   
                    <hr>
                     <div class="control-group">
                     <div class="controls controls-row">
                    
                     <a href="<?=base_url()?>/Registration/forwarding_pdf/" class="link offset5 blink_text" style="font-size: x-large;" target="_blank" >Download Farwarding letter.<br> </a>
                     </div>
                     </div>
                     
                      
                      <label class="label label-important label-bullet" style="font-size: large;">
                    Note: Batch List Prints Will Be Used For Registration.
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!--  <div class="right-sidebar">
            
            <div class="wrapper">
              <ul class="stats">
                <li>
                  <div class="left">
                    <h4>
                      15,859
                    </h4>
                    <p>
                      Unique Visitors
                    </p>
                  </div>
                  <div class="chart">
                    <span id="unique-visitors"><canvas height="30" width="69" style="display: inline-block; width: 69px; height: 30px; vertical-align: top;"></canvas></span>
                  </div>
                </li>
                <li>
                  <div class="left">
                    <h4>
                      $47,830
                    </h4>
                    <p>
                      Monthly Sales
                    </p>
                  </div>
                  <div class="chart">
                    <span id="monthly-sales"><canvas height="30" width="69" style="display: inline-block; width: 69px; height: 30px; vertical-align: top;"></canvas></span>
                  </div>
                </li>
                <li>
                  <div class="left">
                    <h4>
                      $98,846
                    </h4>
                    <p>
                      Current balance
                    </p>
                  </div>
                  <div class="chart">
                    <span id="current-balance"><canvas height="30" width="69" style="display: inline-block; width: 69px; height: 30px; vertical-align: top;"></canvas></span>
                  </div>
                </li>
                <li>
                  <div class="left">
                    <h4>
                      18,846
                    </h4>
                    <p>
                      Registrations
                    </p>
                  </div>
                  <div class="chart">
                    <span id="registrations"><canvas height="30" width="69" style="display: inline-block; width: 69px; height: 30px; vertical-align: top;"></canvas></span>
                  </div>
                </li>
                <li>
                  <div class="left">
                    <h4>
                      22,571
                    </h4>
                    <p>
                      Site Visits
                    </p>
                  </div>
                  <div class="chart">
                    <span id="site-visits"><canvas height="30" width="69" style="display: inline-block; width: 69px; height: 30px; vertical-align: top;"></canvas></span>
                  </div>
                </li>
              </ul>
            </div>
            
            <hr class="hr-stylish-1">
            
            
            <div class="wrapper">
              <div id="scrollbar">
                <div style="height: 270px;" class="scrollbar">
                  <div style="height: 270px;" class="track">
                    <div style="top: 0px; height: 55.4795px;" class="thumb">
                      <div class="end">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="viewport">
                  <div style="top: 0px;" class="overview">
                    <div class="featured-articles-container">
                      <h5 class="heading">
                        Recent Articles
                      </h5>
                      <div class="articles">
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Hosting Made For WordPress
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Reinvent cutting-edge
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          partnerships models 24/7
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Eyeballs frictionless
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Empower deliver innovate
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Portals technologies
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Collaborative innovate
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Mashups experiences plug
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Portals technologies
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Collaborative innovate
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Mashups experiences plug
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          B2B plug and play
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Need some interesting
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Portals technologies
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Collaborative innovate
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Portals technologies
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Collaborative innovate
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Mashups experiences plug
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          B2B plug and play
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Need some interesting
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Portals technologies
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Collaborative innovate
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Mashups experiences plug
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Need some interesting
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Portals technologies
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Collaborative innovate
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Mashups experiences plug
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          B2B plug and play
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Need some interesting
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Portals technologies
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Collaborative innovate
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Portals technologies
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Collaborative innovate
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Mashups experiences plug
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          B2B plug and play
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Need some interesting
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Portals technologies
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Collaborative innovate
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet">
                            &nbsp;
                          </span>
                          Mashups experiences plug
                        </a>
                      </div>
                      
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
            
            <hr class="hr-stylish-1">
            
            <div class="wrapper">
              <div id="scrollbar-two">
                <div style="height: 270px;" class="scrollbar">
                  <div style="height: 270px;" class="track">
                    <div style="top: 0px; height: 87.4101px;" class="thumb">
                      <div class="end">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="viewport">
                  <div style="top: 0px;" class="overview">
                    <div class="featured-articles-container">
                      <h5 class="heading-blue">
                        Featured posts
                      </h5>
                      <div class="articles">
                        <a data-original-title="" href="#">
                          <span class="label-bullet-blue">
                            &nbsp;
                          </span>
                          Hosting Made For WordPress
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet-blue">
                            &nbsp;
                          </span>
                          Reinvent cutting-edge
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet-blue">
                            &nbsp;
                          </span>
                          partnerships models 24/7
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet-blue">
                            &nbsp;
                          </span>
                          Eyeballs frictionless
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet-blue">
                            &nbsp;
                          </span>
                          Empower deliver innovate
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet-blue">
                            &nbsp;
                          </span>
                          Portals technologies
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet-blue">
                            &nbsp;
                          </span>
                          Collaborative innovate
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet-blue">
                            &nbsp;
                          </span>
                          Mashups experiences plug
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet-blue">
                            &nbsp;
                          </span>
                          Need some interesting
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet-blue">
                            &nbsp;
                          </span>
                          Portals technologies
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet-blue">
                            &nbsp;
                          </span>
                          Collaborative innovate
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet-blue">
                            &nbsp;
                          </span>
                          Mashups experiences plug
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet-blue">
                            &nbsp;
                          </span>
                          B2B plug and play
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet-blue">
                            &nbsp;
                          </span>
                          Need some interesting
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet-blue">
                            &nbsp;
                          </span>
                          Portals technologies
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet-blue">
                            &nbsp;
                          </span>
                          Collaborative innovate
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet-blue">
                            &nbsp;
                          </span>
                          Portals technologies
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet-blue">
                            &nbsp;
                          </span>
                          Collaborative innovate
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet-blue">
                            &nbsp;
                          </span>
                          Mashups experiences plug
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet-blue">
                            &nbsp;
                          </span>
                          B2B plug and play
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet-blue">
                            &nbsp;
                          </span>
                          Need some interesting
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet-blue">
                            &nbsp;
                          </span>
                          Portals technologies
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet-blue">
                            &nbsp;
                          </span>
                          Collaborative innovate
                        </a>
                        <a data-original-title="" href="#">
                          <span class="label-bullet-blue">
                            &nbsp;
                          </span>
                          Mashups experiences plug
                        </a>
                      </div>
                      
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
            
            
          </div> -->
        </div>
          </div>
        </div>
