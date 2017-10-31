<div class="dashboard-wrapper">
    <div class="left-sidebar">
       

        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title">
                            9Th Roll No. Slips:
                        </div>

                    </div>
                    <div class="widget-body">
                        <div id="dt_example" class="example_alt_pagination">
                            <table>
                            <tr>
                             <?php if($isdeaf ==0) {?>
                            <td width="50%">
                             <table width="100%" border="0" cellspacing="0" cellpadding="0" class="reports_gen">

                                <tr class="groups">
                                    <th scope="row">Select Group:</th>
                                    <td>
                                        <select id="std_group" style="width:200px;" class="custom" name="std_group"  onchange="std_group(this.value)">
                                            <option value="">-- Show All Groups --</option>
                                            <option value="1">SCIENCE GROUP WITH BIOLOGY</option>
                                            <option value="7">SCIENCE GROUP WITH COMPUTER SCIENCE</option>
                                            <option value="8">SCIENCE GROUP WITH ELECTRICAL WIRING(OPT)</option>
                                            <option value="2">GENERAL</option>
                                         
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <td>
                                         <button type="button" class="btn btn-info"  onclick="downloadgroupwise9th(1)" disabled="disabled" id="downbtn">Download Group Wise Roll No. Slip.</button>
                                    <button type="button" class="btn btn-info"  onclick="downloadgroupwise9th(2)" disabled="disabled" id="viewbtn">View Group Wise Roll No. Slip.</button>
                                        </td>
                                    </th>

                                </tr>

                            </table>
                            </td>
                            <?php }?>
                            <td width="50%">
                             <table width="100%" border="0" cellspacing="0" cellpadding="0" class="reports_gen">
                                
                                <tr class="groups">
                                    <td scope="row"><img src="<?= base_url();?>assets/img/backside.jpg"></td>
                                   
                                </tr>
                                <tr>
                                    <td>
                                    <a href="<?= base_url();?>assets/img/slip_back_page_matric.pdf" target="_blank"><button type="button" class="btn btn-info"  id="downbtn">Download Roll No Slip Back Instructions.</button></a></td>
                                    
                                </tr>

                            </table>
                            </td>
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
                                        <th style="width:25%" class="hidden-phone">
                                            Download
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //  DebugBreak();
									 if($data != false)
                                    {
                                    $n=0;  
                                    $grp_name='';                             
                                    foreach($data as $key=>$vals):
                                    $n++;
                                    $roll_no = !empty($vals["rno"])?$vals["rno"]:"N/A";
                                    $grp_name = $vals["grp_cd"];
                                    switch ($grp_name) {
                                        case '1':
                                            $grp_name = 'Science';
                                            break;
                                        case '2':
                                            $grp_name = 'General';
                                            break;
                                        case '5':
                                            $grp_name = 'DEAF & DEFECTIVE';
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
                                    <td>'.$vals["Dob"].'</td>
                                    <td>'.$grp_name.'</td>
                                    ';

                                    echo'<td>
                                    <button type="button" class="btn btn-info" value="'.$roll_no.'" onclick="downloadslip9th('.$roll_no.',1)">Download Roll No. Slip</button>
                                     <button type="button" class="btn btn-info" value="'.$roll_no.'" onclick="downloadslip9th('.$roll_no.',2)">View Roll No. Slip</button>
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
