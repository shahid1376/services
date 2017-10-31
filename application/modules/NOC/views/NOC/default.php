
<?php
@$info = $info[0][0];
?>
<form enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>NOC/statusPage_server" >

    <div class="form-group">    
        <div class="row">
            <div class="col-md-12">
                <h3 align="center" class="bold">1- NOC Status</h3>
            </div>
        </div>
    </div>

    <div class="form-group">    
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <div class="alert alert-info fade in alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"></a>
                    <strong>View your application status</strong>
                </div>
            </div>
        </div>
    </div>


    <div class="form-group">    
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <label class="control-label" for="tsscrno" >Application No</label>
                <input type="text" id="appNo" maxlength="8" name="appNo" class="form-control" >
            </div>
        </div>
    </div>

    <div class="form-group">    
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <input type="submit" value="Check Status" id="btnchk" name="btnchk" onclick="return check_downloand();" class="btn btn-primary btn-block">
            </div>
        </div>
    </div>
    <?php 
    $colorClass = "";
    $Msg = "";
    // DebugBreak();
    if($info['IsActive']==0)
    {
        $colorClass ="class='alert alert-danger fade in alert-dismissable'";
        $Msg = "Application DELETED.";
    }
    else if($info['ismigrated']==1)
    {
        $colorClass ="class='alert alert-success fade in alert-dismissable'";
        $Msg = "Application Completed";
    }
    else if($info['ismigrated']==0 && $info['remarks']!="")
    {
        $colorClass ="class='alert alert-danger fade in alert-dismissable'";
        $Msg = "Application can not proceed due to ".$info['remarks'];
    }
    else if($info['ismigrated']==0 && $info['isverified']==0)
    {
        $colorClass ="class='alert alert-warning fade in alert-dismissable'";
        $Msg = "Application Under Process (Fee not verified!)";
    }
    else if($info['ismigrated']==0 && $info['isverified']==1 )
    {
        $colorClass ="class='alert alert-info fade in alert-dismissable'";
        $Msg = "Application Under Process (Fee verified!)";
    }
    /*else if($info['ismigrated']==0 && $info['isverified']==1 && $info['remarks']!="")
    {
    $colorClass ="class='alert alert-danger fade in alert-dismissable'";
    $Msg = "Application can not proceed due to ".$info['remarks'];
    } */

    if(isset($info['app_No']))
    {
        ?>

        <div class="form-group">    
            <div class="row">
                <div class="page-head-image col-md-offset-5">
                    <?php 
                    if(file_exists($info['picPath']))
                    {
                        $type = pathinfo(@$info['picPath'], PATHINFO_EXTENSION); 
                        @$image_path_selected = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents(@$info['picPath']));
                    } 
                    else 
                    {
                        @$image_path_selected = base_url()."assets/img/BrowseImage.png";
                    }  
                    ?>
                    <img id="previewImg" style="width:140px; height: 140px;" class="img-rounded" src="<?php echo  $image_path_selected ?> " alt="Candidate Image">
                </div>
            </div>
        </div>

        <div class="form-group">    
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <div <?php echo $colorClass; ?>>
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"></a>
                        <strong>
                            <?php echo $Msg; ?>
                        </strong>
                    </div>
                </div>
            </div>
        </div>

        <fieldset>
            <div class="form-group">
                <div class="col-md-offset-3 col-md-6">
                    <label  class="control-label">Application ID:</label>
                    <input type="text" class="form-control" id='lblAppNo' value="<?php echo $info['app_No'];  ?>" readonly="readonly">    
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-3 col-md-6">
                    <label  class="control-label">Roll No:</label>
                    <input type="text" class="form-control" value="<?php echo $info['Rno']."  "; 
                        if($info['class']==9)
                            {echo 'SSC-I'."  "; }
                        else if($info['class']==10)
                            {echo 'SSC-II'."  "; }
                            else if($info['class']==11)
                                {echo 'HSSC-I'."  "; }
                                else if($info['class']==12) 
                                    {echo 'HSSC-II'."  "; }  

                                    if($info['sess']==1)
                        {
                            echo 'Annual'."  ".$info['iyear']."  ";
                        }
                        else if($info['sess']==2)
                        {
                            echo 'Supplymentary'."  ".$info['iyear']."  ";
                        }

                        if($info['status']==1)
                        {
                            echo 'PASSED'."  ";
                        }
                        else if($info['status']==2)
                        {
                            echo 'FAIL'."  ";
                        }
                        else if($info['status']==3)
                        {
                            echo 'ABSENT'."  ";
                        }
                        ?>" readonly="readonly">
                </div>

            </div>
            <div class="form-group">
                <div class="col-md-offset-3 col-md-6">
                    <label class="control-label">Name:</label>
                    <input type="text" class="form-control" value="<?php echo $info['name'];  ?>" readonly="readonly">    
                </div>

            </div>
            <div class="form-group">
                <div class="col-md-offset-3 col-md-6">
                    <label class="control-label">Father Name:</label>
                    <input type="text" class="form-control" value="<?php echo $info['fname'];  ?>" readonly="readonly">    
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-3 col-md-6">
                    <label class="control-label">Migration Applied for Board/University:</label>
                    <textarea rows="3" cols="50" class="form-control" readonly><?php echo $info['MigTo'];  ?></textarea>
                </div>
            </div>

            <div class="form-group">    
                <div class="row">
                    <div class="col-md-offset-3 col-md-6">
                    </div>
                </div>
            </div>

            <div class="form-group">    
                <div class="row">
                    <div class="col-md-offset-3 col-md-6">
                        <?php
                        if($info['ismigrated']==1 && $info['IsActive']==1)
                        {
                            ?>
                            <input type="button" value="Download NOC" id="DownloadNOC" name="DownloadNOC" onclick="return check_downloand();" class="btn btn-primary btn-block">
                            <input type="button" value="Cancel" id="gotoNocApp" name="gotoNocApp" onclick="window.location.href = '<?=base_url();?>NOC/'" class="btn btn-danger btn-block">
                            <?php
                        }
                        else if($info['ismigrated']==0 && $info['isverified']==0 && $info['IsActive']==1)
                        {
                            ?>
                            <input type="submit" value="Download Challan Form" id="btnDownloadForm" name="btnDownloadForm" onclick="return check_downloand();" class="btn btn-primary btn-block">
                            <input type="button" value="Cancel" id="gotoNocApp" name="gotoNocApp" onclick="window.location.href = '<?=base_url();?>NOC/'" class="btn btn-danger btn-block">
                            <?php
                        } 
                        ?> 
                    </div>
                </div>
            </div>     
        </fieldset> 

        <?php
    } 
    ?>
</form>
<?php
if(!isset($info))
{
    ?>
    <hr class="colorgraph">
    <form action="" name="noc_form" id="noc_form" >
        <div class="pull-right" id="instruction" style="width:600px" >
            <img src="<?php echo base_url(); ?>assets/img/Nocinst.jpg" class="img-responsive" alt="NOC Instructions.jpg">
        </div>

        <div class="form-group">    
            <div class="row">
                <div class="col-md-12">
                    <h3 align="center" class="bold">2- Application for NOC</h3>
                </div>
            </div>
        </div>

        <div class="form-group">    
            <div class="row">
                <div class="col-md-offset-3 col-md-3">
                    <label class="control-label" for="ddlprupose" >Type of NOC </label>
                    <select name="ddlprupose" id="ddlprupose" class="form-control" >
                        <option selected=selected>NOC For Other Board</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="control-label" for="nocFor" >NOC For</label>
                    <select name="nocFor" id="nocFor" class="form-control" >
                        <option value="0" selected=selected>SELECT ONE</option>
                        <option value="1">SSC ONLY</option>
                        <option value="2">HSSC ONLY</option>
                    </select>
                </div>
            </div>
        </div>

        <div id="dialog-confirm" title="Please Confirm Your Information in order to Proceed NOC Application."></div>

        <div id="divSSC" style="display:none;">
            <div class="form-group">    
                <div class="row">
                    <div class="col-md-12">
                        <h3 align="center" class="bold">SSC Information</h3>
                    </div>
                </div>
            </div>

            <div class="form-group">    
                <div class="row">
                    <div class="col-md-offset-3 col-md-3">
                        <label class="control-label" for="sscrno" >Roll No</label>
                        <input type="text" id="sscrno" maxlength="6"  class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="control-label" for="sscdob" >Date of Birth</label>
                        <input type="text" id="sscdob" name="sscdob" readonly="readonly" class="form-control">
                    </div>
                </div>
            </div>


            <div class="form-group">    
                <div class="row">
                    <div class="col-md-offset-3 col-md-3">
                        <label class="control-label" for="ddlsscYear" >Year</label>
                        <select id="ddlsscYear" class="form-control" >
                            <option value="0">SELECT YEAR</option>
                            <option value="2017">2017</option>
                            <option value="2016">2016</option>
                            <option value="2015">2015</option>
                            <option value="2014">2014</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label" for="ddlsscSess" >Session</label>
                        <select id="ddlsscSess" class="form-control">
                            <option value="0">SELECT SESSION</option>
                            <option value="1">ANNUAL</option>
                            <option value="2">SUPPLEMANTARY</option>
                        </select>
                    </div>
                </div>
            </div>



            <div class="form-group">    
                <div class="row">
                    <div class="col-md-offset-3 col-md-3">
                        <label class="control-label" for="ddlHsscSess" >Class</label>
                        <select id="ddlSscClass" class="form-control" name="ddlHsscSess">
                            <option value="0">SELECT CLASS</option>
                            <option value="9">MATRIC PART-I</option>
                            <option value="10">MATRIC PART-II</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label" for="MobNo" >Mobile No</label>
                        <input type="text" id="MobNo" name="MobNo"  placeholder="0345-1234567" class="form-control">
                    </div>
                </div>
            </div>

            <div class="form-group">    
                <div class="row">
                    <div class="col-md-offset-3 col-md-6">
                        <label class="control-label" for="ddlsscBrd" >Migrate To</label>
                        <select id="ddlsscBrd" class="form-control" name="ddlsscBrd">
                            <option value="0">PLEASE SELECT ONE</option>
                            <option value= "101">ABASYN UNIVERSITY, PESHAWAR </option>
                            <option value= "102">ABBOTTABAD INTERNATIONAL MEDICAL COLLEGE, ABBOTTABAD</option>
                            <option value= "393">ABBOTTABAD MEDICAL COLLEGE ABBOTTABAD (KPK)</option>
                            <option value= "103">ABDUL WALI KHAN UNIVERSITY, MARDAN</option>
                            <option value= "32">AFBHE GHQ RAWALPINDI</option>
                            <option value= "422">AGA KHAN BOARD KARACHI</option>
                            <option value= "24">AGA KHAN UNIVERSITY EXAMINATION BOARD KARACHI</option>
                            <option value= "106">AGA KHAN UNIVERSITY MEDICAL COLLEGE, KARACHI</option>
                            <option value= "107">AGA KHAN UNIVERSITY, KARACHI</option>
                            <option value= "396">AGRICULTURE UNIVERSITY OF AZAD JANNU & KASHMIR</option>
                            <option value= "419">AGRICULTURE UNIVERSITY OF RAWLA KOT</option>
                            <option value= "108">AIR UNIVERSITY, ISLAMABAD</option>
                            <option value= "387">AJK UNIVERSITY MIRPUR</option>
                            <option value= "109">AKHTAR SAEED MEDICAL & DENTAL COLLEGE, LAHORE</option>
                            <option value= "110">AL-HAMD ISLAMIC UNIVERSITY, QUETTA</option>
                            <option value= "434">AL-KHAIR UNIVERSITY, BHIMBER, AJ&K </option>
                            <option value= "111">AL-KHAIR UNIVERSITY, BHIMBER, AJ&K (ADMISSIONS ALLOWED ONLY AT MAIN CAMPUS, BHIMBER, AJ&K W.E.F 17.10.2011)</option>
                            <option value= "115">AL-NAFEES MEDICAL COLLEGE, ISLAMABAD</option>
                            <option value= "117">AL-TIBRI MEDICAL COLLEGE, KARACHI</option>
                            <option value= "112">ALLAMA IQBAL MEDICAL COLLEGE, LAHORE</option>
                            <option value= "18">ALLAMA IQBAL OPEN UNIVERSITY, ISLAMABAD</option>
                            <option value= "116">ALTAMASH INSTITUTE OF DENTAL MEDICINE, KARACHI</option>
                            <option value= "118">AMEER-UD-DIN MEDICAL COLLEGE (PGMI) LAHORE</option>
                            <option value= "423">AMEER-UD-DIN MEDICAL COLLEGE LAHORE</option>
                            <option value= "119">AMNA INAYAT MEDICAL COLLEGE, SHEIKHUPURA</option>
                            <option value= "431">ARMED BOARD G.H.Q RAWALPINDI</option>
                            <option value= "397">ARMED FORCES NURSING SERVICE (AFNS)</option>
                            <option value= "120">ARMY MEDICAL COLLEGE, RAWALPINDI</option>
                            <option value= "122">AYUB MEDICAL COLLEGE, ABBOTT BAD</option>
                            <option value= "123">AZAD JAMMU & KASHMIR MEDICAL COLLEGE, MUZAFFARABAD-AJK.</option>
                            <option value= "124">AZIZ FATIMA MEDICAL & DENTAL COLLEGE, FAISALABAD</option>
                            <option value= "125">AZRA NAHEED MEDICAL COLLEGE, LAHORE</option>
                            <option value= "126">BACHA KHAN MEDICAL COLLEGE, MARDAN</option>
                            <option value= "127">BAHAUDDIN ZAKARIYA UNIVERSITY, MULTAN</option>
                            <option value= "128">BAHRIA UNIVERSITY MEDICAL & DENTAL COLLEGE, KARACHI</option>
                            <option value= "129">BAHRIA UNIVERSITY, ISLAMABAD</option>
                            <option value= "430">BAHRIA UNIVERSITY, KARACHI</option>
                            <option value= "130">BALOCHISTAN UNIVERSITY OF ENGINEERING & TECHNOLOGY, KHUZDAR</option>
                            <option value= "131">BALOCHISTAN UNIVERSITY OF INFORMATION TECHNOLOGY & MANAGEMENT SCIENCES, QUETTA</option>
                            <option value= "132">BANNU MEDICAL COLLEGE, BANNU</option>
                            <option value= "133">BAQAI DENTAL COLLEGE, KARACHI</option>
                            <option value= "134">BAQAI MEDICAL COLLEGE, KARACHI</option>
                            <option value= "135">BAQAI MEDICAL UNIVERSITY, KARACHI</option>
                            <option value= "389">BARANI UNIVERSITY RAWALPINDI</option>
                            <option value= "136">BEACONHOUSE NATIONAL UNIVERSITY, LAHORE</option>
                            <option value= "438">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION MALAKAND</option>
                            <option value= "11">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, ABBOTTABAD</option>
                            <option value= "6">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, BAHAWALPUR</option>
                            <option value= "22">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, BANNU</option>
                            <option value= "23">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, D.I.KHAN</option>
                            <option value= "8">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, DERA GHAZI KHAN</option>
                            <option value= "5">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, FAISALABAD</option>
                            <option value= "25">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, HYDERABAD</option>
                            <option value= "19">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, KOHAT</option>
                            <option value= "2">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, LAHORE</option>
                            <option value= "26">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, LARKANA</option>
                            <option value= "21">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, MALAKAN</option>
                            <option value= "15">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, MARDAN</option>
                            <option value= "10">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, MIR PUR</option>
                            <option value= "27">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, MIRPUR KHAS (SINDH)</option>
                            <option value= "4">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, MULTAN</option>
                            <option value= "12">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, PESHAWAR</option>
                            <option value= "14">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, QUETTA</option>
                            <option value= "3">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, RAWALPINDI</option>
                            <option value= "7">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, SARGODHA</option>
                            <option value= "28">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, SUKKUR</option>
                            <option value= "29">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, SWAT</option>
                            <option value= "34">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, SAHIWAL</option>
                            <option value= "13">BOARD OF SECONDARY EDUCATION, KARACHI</option>
                            <option value= "161">BOLAN MEDICAL COLLEGE, QUETTA</option>
                            <option value= "17">CAMBRIDGE </option>
                            <option value= "163">CECOS UNIVERSITY OF INFORMATION TECHNOLOGY AND EMERGING SCIENCES, PESHAWAR</option>
                            <option value= "164">CENTRAL PARKS MEDICAL COLLEGE, LAHORE</option>
                            <option value= "165">CHANDKA MEDICAL COLLEGE, LARKANA</option>
                            <option value= "166">CITY UNIVERSITY OF SCIENCE AND INFORMATION TECHNOLOGY, PESHAWAR</option>
                            <option value= "167">CMH LAHORE MEDICAL COLLEGE, LAHORE</option>
                            <option value= "168">COMMECES INSTITUTE OF BUSINESS & EMERGING SCIENCES, KARACHI</option>
                            <option value= "169">COMSATS INSTITUTE OF INFORMATION TECHNOLOGY, ISLAMABAD</option>
                            <option value= "425">COMSATS UNIVERSITY ISLAMABAD</option>
                            <option value= "436">COMSATS UNIVERSITY SAHIWAL</option>
                            <option value= "170">CONTINENTAL MEDICAL COLLEGE, LAHORE</option>
                            <option value= "171">DADABHOY INSTITUTE OF HIGHER EDUCATION,KARACHI</option>
                            <option value= "172">DAWOOD COLLEGE OF ENGINEERING & TECHNOLOGY, KARACHI </option>
                            <option value= "416">DAWOOD UNIVERSITY OF ENGINEERING & TECHNOLOGY, KARACHI </option>
                            <option value= "173">DE’MONTMORENCY COLLEGE OF DENTISTRY, LAHORE</option>
                            <option value= "174">DENTAL SECTION, BOLAN MEDICAL COLLEGE, QUETTA</option>
                            <option value= "175">DENTAL SECTION, HAMDARD COLLEGE OF MEDICINE & DENTISTRY, KARACHI</option>
                            <option value= "176">DENTAL SECTION, JINNAH MEDICAL & DENTAL COLLEGE, KARACHI</option>
                            <option value= "177">DENTAL SECTION, KARACHI MEDICAL & DENTAL COLLEGE, KARACHI</option>
                            <option value= "178">DENTAL SECTION, LUMHS, JAMSHORO</option>
                            <option value= "179">DOW INTERNATIONAL MEDICAL COLLEGE, KARACHI</option>
                            <option value= "180">DOW UNIVERSITY OF HEALTH SCIENCES, KARACHI</option>
                            <option value= "182">DR.ISHRATUL EBAD INSTITUTE OF ORAL HEALTH SCIENCES, KARACHI</option>
                            <option value= "433">ENGINEERING UNIVERSITY MIRPUR, AZAD JAMMU & KASHMIR </option>
                            <option value= "405">F.C. COLLEGE, LAHORE.</option>
                            <option value= "183">F.M.H COLLEGE OF MEDICINE & DENTISTRY, LAHORE</option>
                            <option value= "184">FACULTY OF MEDICINE & ALLIED MEDICAL SCIENCES/ISRA UNIVERSITY, HYDERABAD</option>
                            <option value= "185">FATIMA JINNAH MEDICAL COLLEGE FOR WOMEN, LAHORE</option>
                            <option value= "186">FATIMA JINNAH WOMEN UNIVERSITY, RAWALPINDI</option>
                            <option value= "188">FEDERAL MEDICAL & DENTAL COLLEGE, ISLAMABAD</option>
                            <option value= "394">FEDERAL URDU UNIVERSITY ISLAMABAD</option>
                            <option value= "189">FEDERAL URDU UNIVERSITY OF ARTS, SCIENCES & TECHNOLOGY, ISLAMABAD</option>
                            <option value= "9">FEDRAL BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, ISLAMABAD</option>
                            <option value= "418">FEDRAL URDU UNIVERSIY KARACHI</option>
                            <option value= "191">FORMAN CHRISTIAN COLLEGE, LAHORE (UNIVERSITY STATUS)</option>
                            <option value= "192">FOUNDATION UNIVERSITY MEDICAL COLLEGE, RAWALPINDI</option>
                            <option value= "193">FOUNDATION UNIVERSITY, ISLAMABAD</option>
                            <option value= "194">FRONTIER MEDICAL COLLEGE, ABBOTTABAD</option>
                            <option value= "195">FRONTIER WOMEN UNIVERSITY, PESHAWAR</option>
                            <option value= "196">GANDHARA UNIVERSITY, PESHAWAR</option>
                            <option value= "197">GHULAM ISHAQ KHAN INSTITUTE OF ENGINEERING SCIENCES & TECHNOLOGY, TOPI</option>
                            <option value= "198">GHULAM MOHAMMAD MAHER MEDICAL COLLEGE, SUKKUR</option>
                            <option value= "199">GLOBAL INSTITUTE, LAHORE</option>
                            <option value= "200">GOMAL MEDICAL COLLEGE, D.I.KHAN</option>
                            <option value= "201">GOMAL UNIVERSITY, D.I. KHAN</option>
                            <option value= "202">GOVERNMENT COLLEGE UNIVERSITY, FAISALABAD </option>
                            <option value= "203">GOVERNMENT COLLEGE UNIVERSITY, LAHORE</option>
                            <option value= "204">GOVERNMENT MEDICAL COLLEGES IN KARACHI AND SINDH</option>
                            <option value= "205">GOVERNMENT MEDICAL COLLEGES IN PESHAWAR AND KPK</option>
                            <option value= "409">GOVT AYSHA DIGREE COLLEGE FOR GIRLS LAHORE</option>
                            <option value= "410">GOVT DEGREE COLLEGE FOR WOMEN AZAD KASHMIR</option>
                            <option value= "411">GOVT ISLAMIA COLLEGE FOR WOMEN KOPER ROAD LAHORE</option>
                            <option value= "417">GOVT MUSLIM POST GREDUATE WOMEN COLLEGE LAHORE </option>
                            <option value= "414">GOVT POST GREDUATE ISLAMIA COLLEGE LAHORE</option>
                            <option value= "206">GREENWICH UNIVERSITY, KARACHI</option>
                            <option value= "207">GUJRANWALA MEDICAL COLLEGE, GUJRANWALA</option>
                            <option value= "208">HAJVERY UNIVERSITY, LAHORE</option>
                            <option value= "209">HAMDARD COLLEGE OF MEDICINE & DENTISTRY, KARACHI</option>
                            <option value= "210">HAMDARD UNIVERSITY, KARACHI</option>
                            <option value= "390">HARIPUR CAMPUS HAZARA UNIVERSITY</option>
                            <option value= "211">HASHMAT MEDICAL & DENTAL COLLEGE, GUJRAT</option>
                            <option value= "212">HAZARA UNIVERSITY, DODHIAL, MANSEHRA</option>
                            <option value= "435">HAZARA UNIVERSITY, MANSEHRA</option>
                            <option value= "213">HITEC UNIVERSITY, TAXILA</option>
                            <option value= "384">I. T. UNIVERSITY OF BLOCHISTAN</option>
                            <option value= "214">IMPERIAL COLLEGE OF BUSINESS STUDIES, LAHORE</option>
                            <option value= "215">INDEPENDENT MEDICAL COLLEGE, FAISALABAD</option>
                            <option value= "216">INDUS UNIVERSITY, KARACHI</option>
                            <option value= "217">INDUS VALLEY SCHOOL OF ART AND ARCHITECTURE, KARACHI</option>
                            <option value= "218">INSTITUTE OF BUSINESS ADMINISTRATION, KARACHI</option>
                            <option value= "219">INSTITUTE OF BUSINESS AND TECHNOLOGY, KARACHI</option>
                            <option value= "220">INSTITUTE OF BUSINESS MANAGEMENT, KARACHI</option>
                            <option value= "221">INSTITUTE OF MANAGEMENT SCIENCE, PESHAWAR (IMS)</option>
                            <option value= "222">INSTITUTE OF MANAGEMENT SCIENCES, LAHORE</option>
                            <option value= "223">INSTITUTE OF SOUTHERN PUNJAB, MULTAN</option>
                            <option value= "224">INSTITUTE OF SPACE TECHNOLOGY, ISLAMABAD (IST)</option>
                            <option value= "36">INTER BOARD COMMITTEE OF CHAIRMEN</option>
                            <option value= "225">INTERNATIONAL ISLAMIC UNIVERSITY, ISLAMABAD</option>
                            <option value= "226">IQRA NATIONAL UNIVERSITY, PESHAWAR</option>
                            <option value= "227">IQRA UNIVERSITY, KARACHI</option>
                            <option value= "228">ISLAM MEDICAL COLLEGE, SIALKOT</option>
                            <option value= "229">ISLAMABAD MEDICAL & DENTAL COLLEGE, ISLAMABAD</option>
                            <option value= "230">ISLAMIA COLLEGE UNIVERSITY, PESHAWAR</option>
                            <option value= "231">ISLAMIA UNIVERSITY, BAHAWALPUR</option>
                            <option value= "232">ISLAMIC INTERNATIONAL MEDICAL COLLEGE, RAWALPINDI</option>
                            <option value= "233">ISRA UNIVERSITY, HYDERABAD</option>
                            <option value= "441">JAAM SHORO UNIVERSITY</option>
                            <option value= "432">JAAME  UNIVERSITY KARACHI</option>
                            <option value= "234">JINNAH MEDICAL & DENTAL COLLEGE, KARACHI</option>
                            <option value= "236">JINNAH MEDICAL COLLEGE, PESHAWAR</option>
                            <option value= "237">JINNAH UNIVERSITY FOR WOMEN, KARACHI</option>
                            <option value= "238">KABIR MEDICAL COLLEGE/GIMS, PESHAWAR</option>
                            <option value= "239">KARACHI INSTITUTE OF ECONOMICS & TECHNOLOGY, KARACHI</option>
                            <option value= "240">KARACHI MEDICAL & DENTAL COLLEGE, KARACHI</option>
                            <option value= "412">KARAK UNIVERSITY KHAIBER PAKHTUNKHA</option>
                            <option value= "391">KARAKURUM BOARD GILGIT BALTISTAN</option>
                            <option value= "20">KARAKURUM INTERNATIONAL UNIVERSITY GILGIT - NORTHERN AREAS</option>
                            <option value= "242">KARAKURUM INTERNATIONAL UNIVERSITY, GILGIT, GILGIT BALTISTAN</option>
                            <option value= "243">KASB INSTITUTE OF TECHNOLOGY, KARACHI</option>
                            <option value= "244">KHAWAJA MUHAMMAD SAFDAR MEDICAL COLLEGE, SIALKOT</option>
                            <option value= "245">KHYBER COLLEGE OF DENTISTRY, PESHAWAR</option>
                            <option value= "246">KHYBER GIRLS MEDICAL COLLEGE, PESHAWAR</option>
                            <option value= "247">KHYBER MEDICAL COLLEGE, PESHAWAR</option>
                            <option value= "248">KHYBER MEDICAL UNIVERSITY, PESHAWAR </option>
                            <option value= "249">KHYBER PAKHTUNKHWA AGRICULTURAL UNIVERSITY, PESHAWAR</option>
                            <option value= "250">KING EDWARD MEDICAL UNIVERSITY, LAHORE</option>
                            <option value= "252">KINNAIRD COLLEGE FOR WOMEN, LAHORE</option>
                            <option value= "253">KOHAT UNIVERSITY OF SCIENCE AND TECHNOLOGY, KOHAT</option>
                            <option value= "407">KPK BOARD OF TECHNICAL EDUCATION, PESHAWAR.</option>
                            <option value= "254">KUST INSTITUTE OF MEDICAL SCIENCES, KOHAT</option>
                            <option value= "255">LAHORE COLLEGE FOR WOMEN UNIVERSITY, LAHORE</option>
                            <option value= "408">LAHORE GARRISON UNIVERSITY GIRLS LAHORE</option>
                            <option value= "256">LAHORE LEADS UNIVERSITY, LAHORE</option>
                            <option value= "257">LAHORE MEDICAL & DENTAL COLLEGE, LAHORE</option>
                            <option value= "258">LAHORE SCHOOL OF ECONOMICS, LAHORE</option>
                            <option value= "259">LAHORE UNIVERSITY OF MANAGEMENT SCIENCES (LUMS), LAHORE</option>
                            <option value= "260">LASBELA UNIVERSITY OF AGRICULTURE, WATER AND MARINE SCIENCES</option>
                            <option value= "261">LIAQUAT COLLEGE OF MEDICINE AND DENTISTRY, KARACHI</option>
                            <option value= "262">LIAQUAT NATIONAL MEDICAL COLLEGE, KARACHI</option>
                            <option value= "264">LIAQUAT UNIVERSITY OF MEDICAL AND HEALTH SCIENCES, JAMSHORO SINDH.</option>
                            <option value= "265">MARGALLA COLLEGE OF DENTISTRY, RAWALPINDI</option>
                            <option value= "401">MEDICAL COLLEGE, DERA GHAZI KHAN</option>
                            <option value= "266">MEHRAN UNIVERSITY OF ENGINEERING & TECHNOLOGY, JAMSHORO</option>
                            <option value= "406">MINHAAJ COLLEGE LAHORE</option>
                            <option value= "267">MINHAJ UNIVERSITY, LAHORE </option>
                            <option value= "268">MIRPUR UNIVERSITY OF SCIENCE AND TECHNOLOGY (MUST), AJ&K</option>
                            <option value= "270">MOHI-UD-DIN ISLAMIC UNIVERSITY, AJK </option>
                            <option value= "269">MOHIUDDIN ISLAMIC MEDICAL COLLEGE, MIRPUR</option>
                            <option value= "271">MOHTARMA BENAZIR BHUTTO SHAHEED MEDICAL COLLEGE MIRPUR-AJK</option>
                            <option value= "272">MUHAMMAD ALI JINNAH UNIVERSITY, KARACHI</option>
                            <option value= "273">MUHAMMAD MEDICAL COLLEGE, MIRPURKHAS</option>
                            <option value= "274">MULTAN MEDICAL & DENTAL COLLEGE, MULTAN</option>
                            <option value= "402">MULTAN UNIVERSITY</option>
                            <option value= "275">NATIONAL COLLEGE OF ARTS, LAHORE (NCA)</option>
                            <option value= "276">NATIONAL COLLEGE OF BUSINESS ADMINISTRATION & ECONOMICS, LAHORE</option>
                            <option value= "277">NATIONAL DEFENSE UNIVERSITY, ISLAMABAD (NDU)</option>
                            <option value= "382">NATIONAL INSTITUTE OF HEALTH SCIENCES ISLAMABAD</option>
                            <option value= "278">NATIONAL TEXTILE UNIVERSITY, FAISALABAD</option>
                            <option value= "279">NATIONAL UNIVERSITY OF COMPUTER AND EMERGING SCIENCES, ISLAMABAD</option>
                            <option value= "280">NATIONAL UNIVERSITY OF MODERN LANGUAGES, ISLAMABAD (NUML)</option>
                            <option value= "281">NATIONAL UNIVERSITY OF SCIENCES & TECHNOLOGY, RAWALPINDI (NUST)</option>
                            <option value= "282">NAWABSHAH MEDICAL COLLEGE FOR GIRLS, NAWABSHAH</option>
                            <option value= "283">NAWAZ SHAIRF MEDICAL COLLEGE, GUJRAT</option>
                            <option value= "284">NED UNIVERSITY OF ENGINEERING & TECHNOLOGY, KARACHI</option>
                            <option value= "285">NEWPORT INSTITUTE OF COMMUNICATIONS & ECONOMICS, KARACHI</option>
                            <option value= "400">NFC, INSTITUTE OF ENGINEERING & TECHNOLOGY, MULTAN</option>
                            <option value= "286">NISHTAR MEDICAL COLLEGE, MULTAN</option>
                            <option value= "288">NORTHERN UNIVERSITY, NOWSHERA</option>
                            <option value= "289">NWFP UNIVERSITY OF ENGINEERING. & TECHNOLOGY, PESHAWAR</option>
                            <option value= "420">P.U.C.I.T</option>
                            <option value= "290">PAK INTERNATIONAL MEDICAL COLLEGE, PESHAWAR</option>
                            <option value= "291">PAK RED CRESCENT MEDICAL & DENTAL COLLEGE, LAHORE</option>
                            <option value= "377">PAKISTAN BOARD</option>
                            <option value= "292">PAKISTAN INSTITUTE OF DEVELOPMENT ECONOMICS (PIDE), ISLAMABAD</option>
                            <option value= "293">PAKISTAN INSTITUTE OF ENGINEERING & APPLIED SCIENCES, ISLAMABAD (PIEAS)</option>
                            <option value= "294">PAKISTAN INSTITUTE OF FASHION AND DESIGN, LAHORE</option>
                            <option value= "443">PAKISTAN INSTITUTE OF MEDICAL SCIENCES, ISLAMABAD (PIMS)</option>
                            <option value= "428">PAKISTAN MARINE ACADEMY, KARACHI</option>
                            <option value= "295">PAKISTAN MILITARY ACADEMY, ABBOTTABAD (PMA)</option>
                            <option value= "296">PAKISTAN NAVAL ACADEMY, KARACHI</option>
                            <option value= "298">PEOPLES UNIVERSITY OF MEDICAL AND HEALTH SCIENCES FOR WOMEN, NAWABSHAH (SHAHEED BENAZIRABAD) </option>
                            <option value= "299">PESHAWAR MEDICAL COLLEGE, PESHAWAR</option>
                            <option value= "378">PESHAWAR TECHNICAL BOARD</option>
                            <option value= "392">PMDC LAHORE</option>
                            <option value= "300">PRESTON INSTITUTE OF MANAGEMENT, SCIENCE AND TECHNOLOGY, KARACHI</option>
                            <option value= "301">PRESTON UNIVERSITY, KARACHI</option>
                            <option value= "302">PRESTON UNIVERSITY, KOHAT</option>
                            <option value= "31">PUNJAB BOARD OF TECHNICAL EDUCATION, LAHORE</option>
                            <option value= "304">PUNJAB MEDICAL COLLEGE, FAISALABAD</option>
                            <option value= "305">QUAID-E-AWAM UNIVERSITY OF ENGINEERING, SCIENCES & TECHNOLOGY, NAWABSHAH</option>
                            <option value= "306">QUAID-E-AZAM MEDICAL COLLEGE, BAHAWALPUR</option>
                            <option value= "307">QUAID-I-AZAM UNIVERSITY, ISLAMABAD</option>
                            <option value= "421">QUEEN MARY COLLEGE, LAHORE</option>
                            <option value= "308">QUETTA INSTITUTE OF MEDICAL SCIENCES, QUETTA</option>
                            <option value= "309">QURTABA UNIVERSITY OF SCIENCE AND INFORMATION TECHNOLOGY, D.I. KHAN</option>
                            <option value= "310">RASHID LATIF MEDICAL COLLEGE, LAHORE</option>
                            <option value= "311">RAWAL INSTITUTE OF HEALTH SCIENCES, ISLAMABAD</option>
                            <option value= "312">RAWALPINDI MEDICAL COLLEGE, RAWALPINDI</option>
                            <option value= "313">REHMAN MEDIACL COLLEGE, PESHAWAR</option>
                            <option value= "314">RIPHAH INTERNATIONAL UNIVERSITY, ISLAMABAD</option>
                            <option value= "315">SAHIWAL MEDICAL COLLEGE, SAHIWAL</option>
                            <option value= "316">SAIDU MEDICAL COLLEGE, SWAT</option>
                            <option value= "317">SARDAR BAHADUR KHAN WOMEN UNIVERSITY, QUETTA</option>
                            <option value= "318">SARDAR BEGUM DENTAL COLLEGE,.PESHAWAR</option>
                            <option value= "319">SARGODHA MEDIAL COLLEGE, SARGODHA</option>
                            <option value= "320">SARHAD UNIVERSITY OF SCIENCE AND INFORMATION TECHNOLOGY, PESHAWAR </option>
                            <option value= "321">SERVICES INSTITUTE OF MEDICAL SCIENCES, LAHORE</option>
                            <option value= "322">SHAH ABDUL LATIF UNIVERSITY, KHAIRPUR</option>
                            <option value= "323">SHAHAEED MOHTARMA BENAZIR BHUTTO MEDICAL UNIVERSITY, LARKANA</option>
                            <option value= "324">SHAHEED BENAZIR BHUTTO MEDICAL COLLEGE, LYARI, KARACHI</option>
                            <option value= "325">SHAHEED BENAZIR BHUTTO UNIVERSITY, SHERINGAL, DIR</option>
                            <option value= "326">SHAHEED ZULFIKAR ALI BHUTTO INSTITUTE OF SC. & TECHNOLOGY (SZABIST), KARACHI</option>
                            <option value= "327">SHAIKH ZAYED MEDICAL COLLEGE, RAHIM YAR KHAN</option>
                            <option value= "328">SHALAMAR MEDICAL & DENTAL COLLEGE, LAHORE</option>
                            <option value= "329">SHARIF MEDICAL & DENTAL COLLEGE, LAHORE</option>
                            <option value= "330">SHEIKH KHALIFA BIN ZAYED AL-NAHYAN MEDICAL COLLEGE, LAHORE</option>
                            <option value= "331">SHIFA COLLEGE OF MEDICINE, ISLAMABAD</option>
                            <option value= "332">SHIFA TAMEER-E-MILLAT UNIVERSITY, ISLAMABAD</option>
                            <option value= "424">SIMS MEDICAL COLLEGE, LAHORE</option>
                            <option value= "426">SIMS MEDICAL UNIVERSITY, LAHORE</option>
                            <option value= "333">SINDH AGRICULTURE UNIVERSITY, TANDOJAM</option>
                            <option value= "30">SINDH BOARD OF TECHNICAL EDUCATION, KARACHI</option>
                            <option value= "335">SINDH INSTITUTE OF MEDICAL SCIENCES, KARACHI</option>
                            <option value= "336">SINDH MEDICAL COLLEGE, KARACHI</option>
                            <option value= "388">SINDH NURSES EXAMINATION BOARD OF KARACHI</option>
                            <option value= "337">SIR SYED COLLEGE OF MEDICAL SCIENCES FOR GIRLS, KARACHI</option>
                            <option value= "338">SIR SYED UNIVERSITY OF ENGG. & TECHNOLOGY, KARACHI</option>
                            <option value= "339">SUKKUR INSTITUTE OF BUSINESS ADMINISTRATION, SUKKUR </option>
                            <option value= "404">SUPERIOR UNIVERSITY LAHORE</option>
                            <option value= "340">TEXTILE INSTITUTE OF PAKISTAN, KARACHI</option>
                            <option value= "341">THE GIFT UNIVERSITY, GUJRANWALA</option>
                            <option value= "342">THE SUPERIOR COLLEGE, LAHORE </option>
                            <option value= "413">THE SUPERIOR UNIVERSITY, LAHORE </option>
                            <option value= "445">THE UNIVERSITY OF ABBOTABAD</option>
                            <option value= "343">THE UNIVERSITY OF FAISALABAD, FAISALABAD</option>
                            <option value= "444">UCP UNIVERSITY LAHORE</option>
                            <option value= "344">UNIVERSITY COLLEGE OF MEDICINE & DENTISTRY, LAHORE</option>
                            <option value= "345">UNIVERSITY MEDICAL COLLEGE, FAISALABAD</option>
                            <option value= "346">UNIVERSITY OF AGRICULTURE, FAISALABAD</option>
                            <option value= "385">UNIVERSITY OF AJK KOTLY</option>
                            <option value= "347">UNIVERSITY OF ARID AGRICULTURE, RAWALPINDI</option>
                            <option value= "348">UNIVERSITY OF AZAD JAMMU & KASHMIR, MUZAFFARABAD, AZAD KASHMIR, MUZAFFARABAD</option>
                            <option value= "439">UNIVERSITY OF BAHAWALPUR</option>
                            <option value= "349">UNIVERSITY OF BALOCHISTAN, QUETTA</option>
                            <option value= "350">UNIVERSITY OF CENTRAL PUNJAB, LAHORE</option>
                            <option value= "351">UNIVERSITY OF EAST, HYDERABAD</option>
                            <option value= "352">UNIVERSITY OF EDUCATION, LAHORE</option>
                            <option value= "353">UNIVERSITY OF ENGINEERING & TECHNOLOGY, LAHORE</option>
                            <option value= "354">UNIVERSITY OF ENGINEERING & TECHNOLOGY, TAXILA </option>
                            <option value= "355">UNIVERSITY OF GUJRAT, GUJRAT </option>
                            <option value= "398">UNIVERSITY OF HARIPUR K.P.K. PAKISTAN</option>
                            <option value= "356">UNIVERSITY OF HEALTH SCIENCES, LAHORE</option>
                            <option value= "357">UNIVERSITY OF KARACHI, KARACHI </option>
                            <option value= "358">UNIVERSITY OF LAHORE, LAHORE</option>
                            <option value= "359">UNIVERSITY OF MALAKAND, CHAKDARA, DIR, MALAKAND</option>
                            <option value= "429">UNIVERSITY OF MALAKAND, MALAKAND</option>
                            <option value= "360">UNIVERSITY OF MANAGEMENT & TECHNOLOGY, LAHORE</option>
                            <option value= "403">UNIVERSITY OF MULTAN</option>
                            <option value= "361">UNIVERSITY OF PESHAWAR, PESHAWAR</option>
                            <option value= "383">UNIVERSITY OF POONCH, RAWLAKOAT</option>
                            <option value= "395">UNIVERSITY OF SARGODHA, LAHORE CAMPUS</option>
                            <option value= "362">UNIVERSITY OF SARGODHA, SARGODHA</option>
                            <option value= "363">UNIVERSITY OF SCIENCE & TECHNOLOGY, BANNU</option>
                            <option value= "442">UNIVERSITY OF SCIENCE AND TECHNOLOGY ABBOTTABAD</option>
                            <option value= "427">UNIVERSITY OF SINDH</option>
                            <option value= "364">UNIVERSITY OF SINDH, JAMSHORO</option>
                            <option value= "365">UNIVERSITY OF SOUTH ASIA, LAHORE</option>
                            <option value= "366">UNIVERSITY OF SWAT, SWAT</option>
                            <option value= "367">UNIVERSITY OF THE PUNJAB, LAHORE</option>
                            <option value= "368">UNIVERSITY OF VETERINARY & ANIMAL SCIENCES, LAHORE</option>
                            <option value= "369">UNIVERSITY OF WAH, WAH</option>
                            <option value= "370">VICENNA MEDICAL COLLEGE,LAHORE</option>
                            <option value= "371">VIRTUAL UNIVERSITY OF PAKISTAN, LAHORE</option>
                            <option value= "372">WAH MEDICAL COLLEGE, WAH CANTT</option>
                            <option value= "446">WOMAN UNIVERSITY OF AZAD JAMMU & KASHMIR, BAGH</option>
                            <option value= "373">WOMEN MEDICAL COLLEGE, ABBOTTABAD</option>
                            <option value= "374">YUSRA MEDICAL & DENTAL COLLEGE,ISLAMABAD</option>
                            <option value= "376">ZIA-UD-DIN UNIVERSITY, KARACHI</option>
                            <option value= "375">ZIAUDDIN MEDICAL COLLEGE, KARACHI</option>

                            <!--<option value="2">BISE,  LAHORE</option>
                            <option value="3">BISE,  RAWALPINDI</option>
                            <option value="4">BISE,  MULTAN</option>
                            <option value="5">BISE,  FAISALABAD</option>
                            <option value="6">BISE,  BAHAWALPUR</option>
                            <option value="7">BISE,  SARGODHA</option>
                            <option value="8">BISE,  DERA GHAZI KHAN</option>
                            <option value="9">FBISE, ISLAMABAD</option>
                            <option value="10">BISE, MIRPUR</option>
                            <option value="11">BISE, ABBOTTABAD</option>
                            <option value="12">BISE, PESHAWAR</option>
                            <option value="13">BSE, KARACHI</option>
                            <option value="14">BISE, QUETTA</option>
                            <option value="15">BISE, MARDAN</option>
                            <option value="16">FBISE, ISLAMABAD</option>
                            <option value="17">CAMBRIDGE</option>
                            <option value="18">AIOU, ISLAMABAD</option>
                            <option value="19">BISE, KOHAT</option>
                            <option value="20">KARAKURUM</option>
                            <option value="21">MALAKAN</option>
                            <option value="22">BISE, BANNU</option>
                            <option value="23">BISE, D.I.KHAN</option>
                            <option value="24">AKUEB, KARACHI</option>
                            <option value="25">BISE, HYDERABAD</option>
                            <option value="26">BISE, LARKANA</option>
                            <option value="27">BISE, MIRPUR(SINDH)</option>
                            <option value="28">BISE, SUKKUR</option>
                            <option value="29">BISE, SWAT</option>
                            <option value="30">SBTE KARACHI</option>
                            <option value="31">PBTE, LAHORE</option>
                            <option value="32">AFBHE RAWALPINDI</option>
                            <option value="33">BIE, KARACHI</option>
                            <option value="34">BISE SAHIWAL</option>
                            <option value="35">ISLAMIC UNIVERSITY</option>-->

                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">    
                <div class="row">
                    <div class="col-md-offset-3 col-md-6">
                        <label class="checkbox-inline">
                            <input type='checkbox' name='terms' id='terms'> 
                            I accept all the <a id="aTermsConditionsPopup" href="#">terms & conditions </a> of BISE, Gujranwala
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">    
                <div class="row">
                    <div class="col-md-offset-3 col-md-6">
                        <input type="button" class="btn btn-primary btn-block" id = "btnVerifySSCRollNo" name="btnVerifySSCRollNo" onclick="return check_validate();" value="Verify Roll Number">
                    </div>
                </div>
            </div>

        </div>


        <div id="divHSSC" style="display:none;">
            <div class="form-group">    
                <div class="row">
                    <div class="col-md-12">
                        <h3 align="center" class="bold">HSSC Information</h3>
                    </div>
                </div>
            </div>



            <div class="form-group">    
                <div class="row">
                    <div class="col-md-offset-3 col-md-3">
                        <label class="control-label" for="tsscrno" >Matric Roll No</label>
                        <input type="text" id="tsscrno" name="sscrno" maxlength="6" class="form-control" >
                    </div>
                    <div class="col-md-3">
                        <label class="control-label" for="Hsscrno" >Inter Roll No</label>
                        <input type="text" id="Hsscrno" name="Hsscrno" maxlength="6"  class="form-control">
                    </div>
                </div>
            </div>


            <div class="form-group">    
                <div class="row">
                    <div class="col-md-offset-3 col-md-3">
                        <label class="control-label" for="ddlHsscYear" >Inter Year</label>
                        <select id="ddlHsscYear" class="form-control" >
                            <option value="0">SELECT YEAR</option>
                            <option value="2017">2017</option>
                            <option value="2016">2016</option>
                            <option value="2015">2015</option>
                            <option value="2014">2014</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label" for="ddlHsscSess" >Inter Session</label>
                        <select id="ddlHsscSess" class="form-control">
                            <option value="0">SELECT SESSION</option>
                            <option value="1">ANNUAL</option>
                            <option value="2">SUPPLEMANTARY</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">    
                <div class="row">
                    <div class="col-md-offset-3 col-md-3">
                        <label class="control-label" for="ddlHsscClass" >Inter Class</label>
                        <select id="ddlHsscClass" class="form-control" name="ddlHsscSess">
                            <option value="0">SELECT CLASS</option>
                            <option value="11">INTER PART-I</option>
                            <option value="12">INTER PART-II</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label" for="MobNo" >Mobile No</label>
                        <input type="text" id="MobNoHssc" name="MobNo"  placeholder="0345-1234567" class="form-control">
                    </div>
                </div>
            </div>


            <div class="form-group">    
                <div class="row">
                    <div class="col-md-offset-3 col-md-6">
                        <label class="control-label" for="ddlHsscBrd" >Migrate To</label>
                        <select id="ddlHsscBrd" class="form-control" name="ddlHsscBrd">
                            <option value="0">PLEASE SELECT ONE</option>
                            <option value= "101">ABASYN UNIVERSITY, PESHAWAR </option>
                            <option value= "102">ABBOTTABAD INTERNATIONAL MEDICAL COLLEGE, ABBOTTABAD</option>
                            <option value= "393">ABBOTTABAD MEDICAL COLLEGE ABBOTTABAD (KPK)</option>
                            <option value= "103">ABDUL WALI KHAN UNIVERSITY, MARDAN</option>
                            <option value= "32">AFBHE GHQ RAWALPINDI</option>
                            <option value= "422">AGA KHAN BOARD KARACHI</option>
                            <option value= "24">AGA KHAN UNIVERSITY EXAMINATION BOARD KARACHI</option>
                            <option value= "106">AGA KHAN UNIVERSITY MEDICAL COLLEGE, KARACHI</option>
                            <option value= "107">AGA KHAN UNIVERSITY, KARACHI</option>
                            <option value= "396">AGRICULTURE UNIVERSITY OF AZAD JANNU & KASHMIR</option>
                            <option value= "419">AGRICULTURE UNIVERSITY OF RAWLA KOT</option>
                            <option value= "108">AIR UNIVERSITY, ISLAMABAD</option>
                            <option value= "387">AJK UNIVERSITY MIRPUR</option>
                            <option value= "109">AKHTAR SAEED MEDICAL & DENTAL COLLEGE, LAHORE</option>
                            <option value= "110">AL-HAMD ISLAMIC UNIVERSITY, QUETTA</option>
                            <option value= "434">AL-KHAIR UNIVERSITY, BHIMBER, AJ&K </option>
                            <option value= "111">AL-KHAIR UNIVERSITY, BHIMBER, AJ&K (ADMISSIONS ALLOWED ONLY AT MAIN CAMPUS, BHIMBER, AJ&K W.E.F 17.10.2011)</option>
                            <option value= "115">AL-NAFEES MEDICAL COLLEGE, ISLAMABAD</option>
                            <option value= "117">AL-TIBRI MEDICAL COLLEGE, KARACHI</option>
                            <option value= "112">ALLAMA IQBAL MEDICAL COLLEGE, LAHORE</option>
                            <option value= "18">ALLAMA IQBAL OPEN UNIVERSITY, ISLAMABAD</option>
                            <option value= "116">ALTAMASH INSTITUTE OF DENTAL MEDICINE, KARACHI</option>
                            <option value= "118">AMEER-UD-DIN MEDICAL COLLEGE (PGMI) LAHORE</option>
                            <option value= "423">AMEER-UD-DIN MEDICAL COLLEGE LAHORE</option>
                            <option value= "119">AMNA INAYAT MEDICAL COLLEGE, SHEIKHUPURA</option>
                            <option value= "431">ARMED BOARD G.H.Q RAWALPINDI</option>
                            <option value= "397">ARMED FORCES NURSING SERVICE (AFNS)</option>
                            <option value= "120">ARMY MEDICAL COLLEGE, RAWALPINDI</option>
                            <option value= "122">AYUB MEDICAL COLLEGE, ABBOTT BAD</option>
                            <option value= "123">AZAD JAMMU & KASHMIR MEDICAL COLLEGE, MUZAFFARABAD-AJK.</option>
                            <option value= "124">AZIZ FATIMA MEDICAL & DENTAL COLLEGE, FAISALABAD</option>
                            <option value= "125">AZRA NAHEED MEDICAL COLLEGE, LAHORE</option>
                            <option value= "126">BACHA KHAN MEDICAL COLLEGE, MARDAN</option>
                            <option value= "127">BAHAUDDIN ZAKARIYA UNIVERSITY, MULTAN</option>
                            <option value= "128">BAHRIA UNIVERSITY MEDICAL & DENTAL COLLEGE, KARACHI</option>
                            <option value= "129">BAHRIA UNIVERSITY, ISLAMABAD</option>
                            <option value= "430">BAHRIA UNIVERSITY, KARACHI</option>
                            <option value= "130">BALOCHISTAN UNIVERSITY OF ENGINEERING & TECHNOLOGY, KHUZDAR</option>
                            <option value= "131">BALOCHISTAN UNIVERSITY OF INFORMATION TECHNOLOGY & MANAGEMENT SCIENCES, QUETTA</option>
                            <option value= "132">BANNU MEDICAL COLLEGE, BANNU</option>
                            <option value= "133">BAQAI DENTAL COLLEGE, KARACHI</option>
                            <option value= "134">BAQAI MEDICAL COLLEGE, KARACHI</option>
                            <option value= "135">BAQAI MEDICAL UNIVERSITY, KARACHI</option>
                            <option value= "389">BARANI UNIVERSITY RAWALPINDI</option>
                            <option value= "136">BEACONHOUSE NATIONAL UNIVERSITY, LAHORE</option>
                            <option value= "438">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION MALAKAND</option>
                            <option value= "11">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, ABBOTTABAD</option>
                            <option value= "6">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, BAHAWALPUR</option>
                            <option value= "22">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, BANNU</option>
                            <option value= "23">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, D.I.KHAN</option>
                            <option value= "8">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, DERA GHAZI KHAN</option>
                            <option value= "5">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, FAISALABAD</option>
                            <option value= "25">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, HYDERABAD</option>
                            <option value= "19">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, KOHAT</option>
                            <option value= "2">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, LAHORE</option>
                            <option value= "26">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, LARKANA</option>
                            <option value= "21">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, MALAKAN</option>
                            <option value= "15">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, MARDAN</option>
                            <option value= "10">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, MIR PUR</option>
                            <option value= "27">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, MIRPUR KHAS (SINDH)</option>
                            <option value= "4">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, MULTAN</option>
                            <option value= "12">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, PESHAWAR</option>
                            <option value= "14">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, QUETTA</option>
                            <option value= "3">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, RAWALPINDI</option>
                            <option value= "7">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, SARGODHA</option>
                            <option value= "28">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, SUKKUR</option>
                            <option value= "29">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, SWAT</option>
                            <option value= "34">BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, SAHIWAL</option>
                            <option value= "13">BOARD OF SECONDARY EDUCATION, KARACHI</option>
                            <option value= "161">BOLAN MEDICAL COLLEGE, QUETTA</option>
                            <option value= "17">CAMBRIDGE </option>
                            <option value= "163">CECOS UNIVERSITY OF INFORMATION TECHNOLOGY AND EMERGING SCIENCES, PESHAWAR</option>
                            <option value= "164">CENTRAL PARKS MEDICAL COLLEGE, LAHORE</option>
                            <option value= "165">CHANDKA MEDICAL COLLEGE, LARKANA</option>
                            <option value= "166">CITY UNIVERSITY OF SCIENCE AND INFORMATION TECHNOLOGY, PESHAWAR</option>
                            <option value= "167">CMH LAHORE MEDICAL COLLEGE, LAHORE</option>
                            <option value= "168">COMMECES INSTITUTE OF BUSINESS & EMERGING SCIENCES, KARACHI</option>
                            <option value= "169">COMSATS INSTITUTE OF INFORMATION TECHNOLOGY, ISLAMABAD</option>
                            <option value= "425">COMSATS UNIVERSITY ISLAMABAD</option>
                            <option value= "436">COMSATS UNIVERSITY SAHIWAL</option>
                            <option value= "170">CONTINENTAL MEDICAL COLLEGE, LAHORE</option>
                            <option value= "171">DADABHOY INSTITUTE OF HIGHER EDUCATION,KARACHI</option>
                            <option value= "172">DAWOOD COLLEGE OF ENGINEERING & TECHNOLOGY, KARACHI </option>
                            <option value= "416">DAWOOD UNIVERSITY OF ENGINEERING & TECHNOLOGY, KARACHI </option>
                            <option value= "173">DE’MONTMORENCY COLLEGE OF DENTISTRY, LAHORE</option>
                            <option value= "174">DENTAL SECTION, BOLAN MEDICAL COLLEGE, QUETTA</option>
                            <option value= "175">DENTAL SECTION, HAMDARD COLLEGE OF MEDICINE & DENTISTRY, KARACHI</option>
                            <option value= "176">DENTAL SECTION, JINNAH MEDICAL & DENTAL COLLEGE, KARACHI</option>
                            <option value= "177">DENTAL SECTION, KARACHI MEDICAL & DENTAL COLLEGE, KARACHI</option>
                            <option value= "178">DENTAL SECTION, LUMHS, JAMSHORO</option>
                            <option value= "179">DOW INTERNATIONAL MEDICAL COLLEGE, KARACHI</option>
                            <option value= "180">DOW UNIVERSITY OF HEALTH SCIENCES, KARACHI</option>
                            <option value= "182">DR.ISHRATUL EBAD INSTITUTE OF ORAL HEALTH SCIENCES, KARACHI</option>
                            <option value= "433">ENGINEERING UNIVERSITY MIRPUR, AZAD JAMMU & KASHMIR </option>
                            <option value= "405">F.C. COLLEGE, LAHORE.</option>
                            <option value= "183">F.M.H COLLEGE OF MEDICINE & DENTISTRY, LAHORE</option>
                            <option value= "184">FACULTY OF MEDICINE & ALLIED MEDICAL SCIENCES/ISRA UNIVERSITY, HYDERABAD</option>
                            <option value= "185">FATIMA JINNAH MEDICAL COLLEGE FOR WOMEN, LAHORE</option>
                            <option value= "186">FATIMA JINNAH WOMEN UNIVERSITY, RAWALPINDI</option>
                            <option value= "188">FEDERAL MEDICAL & DENTAL COLLEGE, ISLAMABAD</option>
                            <option value= "394">FEDERAL URDU UNIVERSITY ISLAMABAD</option>
                            <option value= "189">FEDERAL URDU UNIVERSITY OF ARTS, SCIENCES & TECHNOLOGY, ISLAMABAD</option>
                            <option value= "9">FEDRAL BOARD OF INTERMEDIATE AND SECONDARY EDUCATION, ISLAMABAD</option>
                            <option value= "418">FEDRAL URDU UNIVERSIY KARACHI</option>
                            <option value= "191">FORMAN CHRISTIAN COLLEGE, LAHORE (UNIVERSITY STATUS)</option>
                            <option value= "192">FOUNDATION UNIVERSITY MEDICAL COLLEGE, RAWALPINDI</option>
                            <option value= "193">FOUNDATION UNIVERSITY, ISLAMABAD</option>
                            <option value= "194">FRONTIER MEDICAL COLLEGE, ABBOTTABAD</option>
                            <option value= "195">FRONTIER WOMEN UNIVERSITY, PESHAWAR</option>
                            <option value= "196">GANDHARA UNIVERSITY, PESHAWAR</option>
                            <option value= "197">GHULAM ISHAQ KHAN INSTITUTE OF ENGINEERING SCIENCES & TECHNOLOGY, TOPI</option>
                            <option value= "198">GHULAM MOHAMMAD MAHER MEDICAL COLLEGE, SUKKUR</option>
                            <option value= "199">GLOBAL INSTITUTE, LAHORE</option>
                            <option value= "200">GOMAL MEDICAL COLLEGE, D.I.KHAN</option>
                            <option value= "201">GOMAL UNIVERSITY, D.I. KHAN</option>
                            <option value= "202">GOVERNMENT COLLEGE UNIVERSITY, FAISALABAD </option>
                            <option value= "203">GOVERNMENT COLLEGE UNIVERSITY, LAHORE</option>
                            <option value= "204">GOVERNMENT MEDICAL COLLEGES IN KARACHI AND SINDH</option>
                            <option value= "205">GOVERNMENT MEDICAL COLLEGES IN PESHAWAR AND KPK</option>
                            <option value= "409">GOVT AYSHA DIGREE COLLEGE FOR GIRLS LAHORE</option>
                            <option value= "410">GOVT DEGREE COLLEGE FOR WOMEN AZAD KASHMIR</option>
                            <option value= "411">GOVT ISLAMIA COLLEGE FOR WOMEN KOPER ROAD LAHORE</option>
                            <option value= "417">GOVT MUSLIM POST GREDUATE WOMEN COLLEGE LAHORE </option>
                            <option value= "414">GOVT POST GREDUATE ISLAMIA COLLEGE LAHORE</option>
                            <option value= "206">GREENWICH UNIVERSITY, KARACHI</option>
                            <option value= "207">GUJRANWALA MEDICAL COLLEGE, GUJRANWALA</option>
                            <option value= "208">HAJVERY UNIVERSITY, LAHORE</option>
                            <option value= "209">HAMDARD COLLEGE OF MEDICINE & DENTISTRY, KARACHI</option>
                            <option value= "210">HAMDARD UNIVERSITY, KARACHI</option>
                            <option value= "390">HARIPUR CAMPUS HAZARA UNIVERSITY</option>
                            <option value= "211">HASHMAT MEDICAL & DENTAL COLLEGE, GUJRAT</option>
                            <option value= "212">HAZARA UNIVERSITY, DODHIAL, MANSEHRA</option>
                            <option value= "435">HAZARA UNIVERSITY, MANSEHRA</option>
                            <option value= "213">HITEC UNIVERSITY, TAXILA</option>
                            <option value= "384">I. T. UNIVERSITY OF BLOCHISTAN</option>
                            <option value= "214">IMPERIAL COLLEGE OF BUSINESS STUDIES, LAHORE</option>
                            <option value= "215">INDEPENDENT MEDICAL COLLEGE, FAISALABAD</option>
                            <option value= "216">INDUS UNIVERSITY, KARACHI</option>
                            <option value= "217">INDUS VALLEY SCHOOL OF ART AND ARCHITECTURE, KARACHI</option>
                            <option value= "218">INSTITUTE OF BUSINESS ADMINISTRATION, KARACHI</option>
                            <option value= "219">INSTITUTE OF BUSINESS AND TECHNOLOGY, KARACHI</option>
                            <option value= "220">INSTITUTE OF BUSINESS MANAGEMENT, KARACHI</option>
                            <option value= "221">INSTITUTE OF MANAGEMENT SCIENCE, PESHAWAR (IMS)</option>
                            <option value= "222">INSTITUTE OF MANAGEMENT SCIENCES, LAHORE</option>
                            <option value= "223">INSTITUTE OF SOUTHERN PUNJAB, MULTAN</option>
                            <option value= "224">INSTITUTE OF SPACE TECHNOLOGY, ISLAMABAD (IST)</option>
                            <option value= "36">INTER BOARD COMMITTEE OF CHAIRMEN</option>
                            <option value= "225">INTERNATIONAL ISLAMIC UNIVERSITY, ISLAMABAD</option>
                            <option value= "226">IQRA NATIONAL UNIVERSITY, PESHAWAR</option>
                            <option value= "227">IQRA UNIVERSITY, KARACHI</option>
                            <option value= "228">ISLAM MEDICAL COLLEGE, SIALKOT</option>
                            <option value= "229">ISLAMABAD MEDICAL & DENTAL COLLEGE, ISLAMABAD</option>
                            <option value= "230">ISLAMIA COLLEGE UNIVERSITY, PESHAWAR</option>
                            <option value= "231">ISLAMIA UNIVERSITY, BAHAWALPUR</option>
                            <option value= "232">ISLAMIC INTERNATIONAL MEDICAL COLLEGE, RAWALPINDI</option>
                            <option value= "233">ISRA UNIVERSITY, HYDERABAD</option>
                            <option value= "441">JAAM SHORO UNIVERSITY</option>
                            <option value= "432">JAAME  UNIVERSITY KARACHI</option>
                            <option value= "234">JINNAH MEDICAL & DENTAL COLLEGE, KARACHI</option>
                            <option value= "236">JINNAH MEDICAL COLLEGE, PESHAWAR</option>
                            <option value= "237">JINNAH UNIVERSITY FOR WOMEN, KARACHI</option>
                            <option value= "238">KABIR MEDICAL COLLEGE/GIMS, PESHAWAR</option>
                            <option value= "239">KARACHI INSTITUTE OF ECONOMICS & TECHNOLOGY, KARACHI</option>
                            <option value= "240">KARACHI MEDICAL & DENTAL COLLEGE, KARACHI</option>
                            <option value= "412">KARAK UNIVERSITY KHAIBER PAKHTUNKHA</option>
                            <option value= "391">KARAKURUM BOARD GILGIT BALTISTAN</option>
                            <option value= "20">KARAKURUM INTERNATIONAL UNIVERSITY GILGIT - NORTHERN AREAS</option>
                            <option value= "242">KARAKURUM INTERNATIONAL UNIVERSITY, GILGIT, GILGIT BALTISTAN</option>
                            <option value= "243">KASB INSTITUTE OF TECHNOLOGY, KARACHI</option>
                            <option value= "244">KHAWAJA MUHAMMAD SAFDAR MEDICAL COLLEGE, SIALKOT</option>
                            <option value= "245">KHYBER COLLEGE OF DENTISTRY, PESHAWAR</option>
                            <option value= "246">KHYBER GIRLS MEDICAL COLLEGE, PESHAWAR</option>
                            <option value= "247">KHYBER MEDICAL COLLEGE, PESHAWAR</option>
                            <option value= "248">KHYBER MEDICAL UNIVERSITY, PESHAWAR </option>
                            <option value= "249">KHYBER PAKHTUNKHWA AGRICULTURAL UNIVERSITY, PESHAWAR</option>
                            <option value= "250">KING EDWARD MEDICAL UNIVERSITY, LAHORE</option>
                            <option value= "252">KINNAIRD COLLEGE FOR WOMEN, LAHORE</option>
                            <option value= "253">KOHAT UNIVERSITY OF SCIENCE AND TECHNOLOGY, KOHAT</option>
                            <option value= "407">KPK BOARD OF TECHNICAL EDUCATION, PESHAWAR.</option>
                            <option value= "254">KUST INSTITUTE OF MEDICAL SCIENCES, KOHAT</option>
                            <option value= "255">LAHORE COLLEGE FOR WOMEN UNIVERSITY, LAHORE</option>
                            <option value= "408">LAHORE GARRISON UNIVERSITY GIRLS LAHORE</option>
                            <option value= "256">LAHORE LEADS UNIVERSITY, LAHORE</option>
                            <option value= "257">LAHORE MEDICAL & DENTAL COLLEGE, LAHORE</option>
                            <option value= "258">LAHORE SCHOOL OF ECONOMICS, LAHORE</option>
                            <option value= "259">LAHORE UNIVERSITY OF MANAGEMENT SCIENCES (LUMS), LAHORE</option>
                            <option value= "260">LASBELA UNIVERSITY OF AGRICULTURE, WATER AND MARINE SCIENCES</option>
                            <option value= "261">LIAQUAT COLLEGE OF MEDICINE AND DENTISTRY, KARACHI</option>
                            <option value= "262">LIAQUAT NATIONAL MEDICAL COLLEGE, KARACHI</option>
                            <option value= "264">LIAQUAT UNIVERSITY OF MEDICAL AND HEALTH SCIENCES, JAMSHORO SINDH.</option>
                            <option value= "265">MARGALLA COLLEGE OF DENTISTRY, RAWALPINDI</option>
                            <option value= "401">MEDICAL COLLEGE, DERA GHAZI KHAN</option>
                            <option value= "266">MEHRAN UNIVERSITY OF ENGINEERING & TECHNOLOGY, JAMSHORO</option>
                            <option value= "406">MINHAAJ COLLEGE LAHORE</option>
                            <option value= "267">MINHAJ UNIVERSITY, LAHORE </option>
                            <option value= "268">MIRPUR UNIVERSITY OF SCIENCE AND TECHNOLOGY (MUST), AJ&K</option>
                            <option value= "270">MOHI-UD-DIN ISLAMIC UNIVERSITY, AJK </option>
                            <option value= "269">MOHIUDDIN ISLAMIC MEDICAL COLLEGE, MIRPUR</option>
                            <option value= "271">MOHTARMA BENAZIR BHUTTO SHAHEED MEDICAL COLLEGE MIRPUR-AJK</option>
                            <option value= "272">MUHAMMAD ALI JINNAH UNIVERSITY, KARACHI</option>
                            <option value= "273">MUHAMMAD MEDICAL COLLEGE, MIRPURKHAS</option>
                            <option value= "274">MULTAN MEDICAL & DENTAL COLLEGE, MULTAN</option>
                            <option value= "402">MULTAN UNIVERSITY</option>
                            <option value= "275">NATIONAL COLLEGE OF ARTS, LAHORE (NCA)</option>
                            <option value= "276">NATIONAL COLLEGE OF BUSINESS ADMINISTRATION & ECONOMICS, LAHORE</option>
                            <option value= "277">NATIONAL DEFENSE UNIVERSITY, ISLAMABAD (NDU)</option>
                            <option value= "382">NATIONAL INSTITUTE OF HEALTH SCIENCES ISLAMABAD</option>
                            <option value= "278">NATIONAL TEXTILE UNIVERSITY, FAISALABAD</option>
                            <option value= "279">NATIONAL UNIVERSITY OF COMPUTER AND EMERGING SCIENCES, ISLAMABAD</option>
                            <option value= "280">NATIONAL UNIVERSITY OF MODERN LANGUAGES, ISLAMABAD (NUML)</option>
                            <option value= "281">NATIONAL UNIVERSITY OF SCIENCES & TECHNOLOGY, RAWALPINDI (NUST)</option>
                            <option value= "282">NAWABSHAH MEDICAL COLLEGE FOR GIRLS, NAWABSHAH</option>
                            <option value= "283">NAWAZ SHAIRF MEDICAL COLLEGE, GUJRAT</option>
                            <option value= "284">NED UNIVERSITY OF ENGINEERING & TECHNOLOGY, KARACHI</option>
                            <option value= "285">NEWPORT INSTITUTE OF COMMUNICATIONS & ECONOMICS, KARACHI</option>
                            <option value= "400">NFC, INSTITUTE OF ENGINEERING & TECHNOLOGY, MULTAN</option>
                            <option value= "286">NISHTAR MEDICAL COLLEGE, MULTAN</option>
                            <option value= "288">NORTHERN UNIVERSITY, NOWSHERA</option>
                            <option value= "289">NWFP UNIVERSITY OF ENGINEERING. & TECHNOLOGY, PESHAWAR</option>
                            <option value= "420">P.U.C.I.T</option>
                            <option value= "290">PAK INTERNATIONAL MEDICAL COLLEGE, PESHAWAR</option>
                            <option value= "291">PAK RED CRESCENT MEDICAL & DENTAL COLLEGE, LAHORE</option>
                            <option value= "377">PAKISTAN BOARD</option>
                            <option value= "292">PAKISTAN INSTITUTE OF DEVELOPMENT ECONOMICS (PIDE), ISLAMABAD</option>
                            <option value= "293">PAKISTAN INSTITUTE OF ENGINEERING & APPLIED SCIENCES, ISLAMABAD (PIEAS)</option>
                            <option value= "294">PAKISTAN INSTITUTE OF FASHION AND DESIGN, LAHORE</option>
                            <option value= "443">PAKISTAN INSTITUTE OF MEDICAL SCIENCES, ISLAMABAD (PIMS)</option>
                            <option value= "428">PAKISTAN MARINE ACADEMY, KARACHI</option>
                            <option value= "295">PAKISTAN MILITARY ACADEMY, ABBOTTABAD (PMA)</option>
                            <option value= "296">PAKISTAN NAVAL ACADEMY, KARACHI</option>
                            <option value= "298">PEOPLES UNIVERSITY OF MEDICAL AND HEALTH SCIENCES FOR WOMEN, NAWABSHAH (SHAHEED BENAZIRABAD) </option>
                            <option value= "299">PESHAWAR MEDICAL COLLEGE, PESHAWAR</option>
                            <option value= "378">PESHAWAR TECHNICAL BOARD</option>
                            <option value= "392">PMDC LAHORE</option>
                            <option value= "300">PRESTON INSTITUTE OF MANAGEMENT, SCIENCE AND TECHNOLOGY, KARACHI</option>
                            <option value= "301">PRESTON UNIVERSITY, KARACHI</option>
                            <option value= "302">PRESTON UNIVERSITY, KOHAT</option>
                            <option value= "31">PUNJAB BOARD OF TECHNICAL EDUCATION, LAHORE</option>
                            <option value= "304">PUNJAB MEDICAL COLLEGE, FAISALABAD</option>
                            <option value= "305">QUAID-E-AWAM UNIVERSITY OF ENGINEERING, SCIENCES & TECHNOLOGY, NAWABSHAH</option>
                            <option value= "306">QUAID-E-AZAM MEDICAL COLLEGE, BAHAWALPUR</option>
                            <option value= "307">QUAID-I-AZAM UNIVERSITY, ISLAMABAD</option>
                            <option value= "421">QUEEN MARY COLLEGE, LAHORE</option>
                            <option value= "308">QUETTA INSTITUTE OF MEDICAL SCIENCES, QUETTA</option>
                            <option value= "309">QURTABA UNIVERSITY OF SCIENCE AND INFORMATION TECHNOLOGY, D.I. KHAN</option>
                            <option value= "310">RASHID LATIF MEDICAL COLLEGE, LAHORE</option>
                            <option value= "311">RAWAL INSTITUTE OF HEALTH SCIENCES, ISLAMABAD</option>
                            <option value= "312">RAWALPINDI MEDICAL COLLEGE, RAWALPINDI</option>
                            <option value= "313">REHMAN MEDIACL COLLEGE, PESHAWAR</option>
                            <option value= "314">RIPHAH INTERNATIONAL UNIVERSITY, ISLAMABAD</option>
                            <option value= "315">SAHIWAL MEDICAL COLLEGE, SAHIWAL</option>
                            <option value= "316">SAIDU MEDICAL COLLEGE, SWAT</option>
                            <option value= "317">SARDAR BAHADUR KHAN WOMEN UNIVERSITY, QUETTA</option>
                            <option value= "318">SARDAR BEGUM DENTAL COLLEGE,.PESHAWAR</option>
                            <option value= "319">SARGODHA MEDIAL COLLEGE, SARGODHA</option>
                            <option value= "320">SARHAD UNIVERSITY OF SCIENCE AND INFORMATION TECHNOLOGY, PESHAWAR </option>
                            <option value= "321">SERVICES INSTITUTE OF MEDICAL SCIENCES, LAHORE</option>
                            <option value= "322">SHAH ABDUL LATIF UNIVERSITY, KHAIRPUR</option>
                            <option value= "323">SHAHAEED MOHTARMA BENAZIR BHUTTO MEDICAL UNIVERSITY, LARKANA</option>
                            <option value= "324">SHAHEED BENAZIR BHUTTO MEDICAL COLLEGE, LYARI, KARACHI</option>
                            <option value= "325">SHAHEED BENAZIR BHUTTO UNIVERSITY, SHERINGAL, DIR</option>
                            <option value= "326">SHAHEED ZULFIKAR ALI BHUTTO INSTITUTE OF SC. & TECHNOLOGY (SZABIST), KARACHI</option>
                            <option value= "327">SHAIKH ZAYED MEDICAL COLLEGE, RAHIM YAR KHAN</option>
                            <option value= "328">SHALAMAR MEDICAL & DENTAL COLLEGE, LAHORE</option>
                            <option value= "329">SHARIF MEDICAL & DENTAL COLLEGE, LAHORE</option>
                            <option value= "330">SHEIKH KHALIFA BIN ZAYED AL-NAHYAN MEDICAL COLLEGE, LAHORE</option>
                            <option value= "331">SHIFA COLLEGE OF MEDICINE, ISLAMABAD</option>
                            <option value= "332">SHIFA TAMEER-E-MILLAT UNIVERSITY, ISLAMABAD</option>
                            <option value= "424">SIMS MEDICAL COLLEGE, LAHORE</option>
                            <option value= "426">SIMS MEDICAL UNIVERSITY, LAHORE</option>
                            <option value= "333">SINDH AGRICULTURE UNIVERSITY, TANDOJAM</option>
                            <option value= "30">SINDH BOARD OF TECHNICAL EDUCATION, KARACHI</option>
                            <option value= "335">SINDH INSTITUTE OF MEDICAL SCIENCES, KARACHI</option>
                            <option value= "336">SINDH MEDICAL COLLEGE, KARACHI</option>
                            <option value= "388">SINDH NURSES EXAMINATION BOARD OF KARACHI</option>
                            <option value= "337">SIR SYED COLLEGE OF MEDICAL SCIENCES FOR GIRLS, KARACHI</option>
                            <option value= "338">SIR SYED UNIVERSITY OF ENGG. & TECHNOLOGY, KARACHI</option>
                            <option value= "339">SUKKUR INSTITUTE OF BUSINESS ADMINISTRATION, SUKKUR </option>
                            <option value= "404">SUPERIOR UNIVERSITY LAHORE</option>
                            <option value= "340">TEXTILE INSTITUTE OF PAKISTAN, KARACHI</option>
                            <option value= "341">THE GIFT UNIVERSITY, GUJRANWALA</option>
                            <option value= "342">THE SUPERIOR COLLEGE, LAHORE </option>
                            <option value= "413">THE SUPERIOR UNIVERSITY, LAHORE </option>
                            <option value= "445">THE UNIVERSITY OF ABBOTABAD</option>
                            <option value= "343">THE UNIVERSITY OF FAISALABAD, FAISALABAD</option>
                            <option value= "444">UCP UNIVERSITY LAHORE</option>
                            <option value= "344">UNIVERSITY COLLEGE OF MEDICINE & DENTISTRY, LAHORE</option>
                            <option value= "345">UNIVERSITY MEDICAL COLLEGE, FAISALABAD</option>
                            <option value= "346">UNIVERSITY OF AGRICULTURE, FAISALABAD</option>
                            <option value= "385">UNIVERSITY OF AJK KOTLY</option>
                            <option value= "347">UNIVERSITY OF ARID AGRICULTURE, RAWALPINDI</option>
                            <option value= "348">UNIVERSITY OF AZAD JAMMU & KASHMIR, MUZAFFARABAD, AZAD KASHMIR, MUZAFFARABAD</option>
                            <option value= "439">UNIVERSITY OF BAHAWALPUR</option>
                            <option value= "349">UNIVERSITY OF BALOCHISTAN, QUETTA</option>
                            <option value= "350">UNIVERSITY OF CENTRAL PUNJAB, LAHORE</option>
                            <option value= "351">UNIVERSITY OF EAST, HYDERABAD</option>
                            <option value= "352">UNIVERSITY OF EDUCATION, LAHORE</option>
                            <option value= "353">UNIVERSITY OF ENGINEERING & TECHNOLOGY, LAHORE</option>
                            <option value= "354">UNIVERSITY OF ENGINEERING & TECHNOLOGY, TAXILA </option>
                            <option value= "355">UNIVERSITY OF GUJRAT, GUJRAT </option>
                            <option value= "398">UNIVERSITY OF HARIPUR K.P.K. PAKISTAN</option>
                            <option value= "356">UNIVERSITY OF HEALTH SCIENCES, LAHORE</option>
                            <option value= "357">UNIVERSITY OF KARACHI, KARACHI </option>
                            <option value= "358">UNIVERSITY OF LAHORE, LAHORE</option>
                            <option value= "359">UNIVERSITY OF MALAKAND, CHAKDARA, DIR, MALAKAND</option>
                            <option value= "429">UNIVERSITY OF MALAKAND, MALAKAND</option>
                            <option value= "360">UNIVERSITY OF MANAGEMENT & TECHNOLOGY, LAHORE</option>
                            <option value= "403">UNIVERSITY OF MULTAN</option>
                            <option value= "361">UNIVERSITY OF PESHAWAR, PESHAWAR</option>
                            <option value= "383">UNIVERSITY OF POONCH, RAWLAKOAT</option>
                            <option value= "395">UNIVERSITY OF SARGODHA, LAHORE CAMPUS</option>
                            <option value= "362">UNIVERSITY OF SARGODHA, SARGODHA</option>
                            <option value= "363">UNIVERSITY OF SCIENCE & TECHNOLOGY, BANNU</option>
                            <option value= "442">UNIVERSITY OF SCIENCE AND TECHNOLOGY ABBOTTABAD</option>
                            <option value= "427">UNIVERSITY OF SINDH</option>
                            <option value= "364">UNIVERSITY OF SINDH, JAMSHORO</option>
                            <option value= "365">UNIVERSITY OF SOUTH ASIA, LAHORE</option>
                            <option value= "366">UNIVERSITY OF SWAT, SWAT</option>
                            <option value= "367">UNIVERSITY OF THE PUNJAB, LAHORE</option>
                            <option value= "368">UNIVERSITY OF VETERINARY & ANIMAL SCIENCES, LAHORE</option>
                            <option value= "369">UNIVERSITY OF WAH, WAH</option>
                            <option value= "370">VICENNA MEDICAL COLLEGE,LAHORE</option>
                            <option value= "371">VIRTUAL UNIVERSITY OF PAKISTAN, LAHORE</option>
                            <option value= "372">WAH MEDICAL COLLEGE, WAH CANTT</option>
                            <option value= "446">WOMAN UNIVERSITY OF AZAD JAMMU & KASHMIR, BAGH</option>
                            <option value= "373">WOMEN MEDICAL COLLEGE, ABBOTTABAD</option>
                            <option value= "374">YUSRA MEDICAL & DENTAL COLLEGE,ISLAMABAD</option>
                            <option value= "376">ZIA-UD-DIN UNIVERSITY, KARACHI</option>
                            <option value= "375">ZIAUDDIN MEDICAL COLLEGE, KARACHI</option>

                            <!--<option value="2">BISE,  LAHORE</option>
                            <option value="3">BISE,  RAWALPINDI</option>
                            <option value="4">BISE,  MULTAN</option>
                            <option value="5">BISE,  FAISALABAD</option>
                            <option value="6">BISE,  BAHAWALPUR</option>
                            <option value="7">BISE,  SARGODHA</option>
                            <option value="8">BISE,  DERA GHAZI KHAN</option>
                            <option value="9">FBISE, ISLAMABAD</option>
                            <option value="10">BISE, MIRPUR</option>
                            <option value="11">BISE, ABBOTTABAD</option>
                            <option value="12">BISE, PESHAWAR</option>
                            <option value="13">BSE, KARACHI</option>
                            <option value="14">BISE, QUETTA</option>
                            <option value="15">BISE, MARDAN</option>
                            <option value="16">FBISE, ISLAMABAD</option>
                            <option value="17">CAMBRIDGE</option>
                            <option value="18">AIOU, ISLAMABAD</option>
                            <option value="19">BISE, KOHAT</option>
                            <option value="20">KARAKURUM</option>
                            <option value="21">MALAKAN</option>
                            <option value="22">BISE, BANNU</option>
                            <option value="23">BISE, D.I.KHAN</option>
                            <option value="24">AKUEB, KARACHI</option>
                            <option value="25">BISE, HYDERABAD</option>
                            <option value="26">BISE, LARKANA</option>
                            <option value="27">BISE, MIRPUR(SINDH)</option>
                            <option value="28">BISE, SUKKUR</option>
                            <option value="29">BISE, SWAT</option>
                            <option value="30">SBTE KARACHI</option>
                            <option value="31">PBTE, LAHORE</option>
                            <option value="32">AFBHE RAWALPINDI</option>
                            <option value="33">BIE, KARACHI</option>
                            <option value="34">BISE SAHIWAL</option>-->
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">    
                <div class="row">
                    <div class="col-md-offset-3 col-md-6">
                        <label class="checkbox-inline">
                            <input type='checkbox' name='terms' id='termshssc'> 
                            I accept all the <a id="aTermsConditionsPopupHssc" href="#">terms & conditions </a> of BISE, Gujranwala
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">    
                <div class="row">
                    <div class="col-md-offset-3 col-md-6">
                        <input type="button" class="btn btn-primary btn-block" id = "btnVerifyHSSCRollNo" name="btnVerifyHSSCRollNo" onclick="return check_hssc_validate();" value="Verify Roll Number">
                    </div>
                </div>
            </div>
            <div id="dialog-message" title="You can apply for NOC with your following record."></div>
        </div>
    </form>
    <?php
}
?>









