 <style type="text/css">
   
.corr_check_box{
        width: 20px;    height: 20px;
}

    </style>
<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header" id="lblFormNo">
                        <div class="title">
                         Form No.   <?php
                                       echo $data[0]['formNo'];  
                                     ?>
                        </div>

                    </div>
                    <div class="widget-body">

                        <form class="form-horizontal no-margin" id="corr_form" action="<?php  echo base_url(); ?>/NinthCorrection/NewEnrolment_update" method="post" enctype="multipart/form-data">

                            <div class="control-group">
                                <h4 class="span4">Personal Information :</h4>
                                </br>
                            <img src="<?=base_url()?>assets/img/OnlineCorrectoin.jpg" alt="" style="width: 530px;">
                                <div class="controls controls-row">
                                    <input type="hidden" class="span2 hidden" id="isReAdm" name="isReAdm" value="0">
                                   
                                    <img id="previewImg" style="width:80px; height: 80px;" class="span2" src="<?php  if($isReAdm==1) {} else{echo base_url().IMAGE_PATH.$Inst_Id.'/'.$data[0]['PicPath']; } ?>" alt="Candidate Image">
                                   
                                    <img id="corr_previewImg" name="corr_previewImg" style="width:80px; height: 80px; margin-right: 322px;    float: right; display: none;" class="span2" src="<?php echo base_url() ?>assets/img/profile.png" alt="Candidate Image">
                                </div>
                            </div>

                            <div class="control-group">

                                <label id="ErrMsg" class="control-label span2" style=" text-align: left;"><?php ?></label>
                                <div class="controls controls-row">
                                   
                                    <label class="control-label span3">
                                      Current Image :  
                                    </label> 
                                   
                                  <!--  <input type="file" class="span2" id="image" name="image" onchange="Checkfiles()">-->
                                     <label class="control-label span2" style="width: 411px;" >
                                        <img src="<?=base_url()?>assets/img/upalodimage.jpg" alt="" >
                                    </label> 
                                    <label class="control-label span2">
                                         Correction Image :  <input type="checkbox" class="corr_check_box " style="width: 20px;    height: 20px;" id="c7" name="c[]" value="7">
                                    </label> 
                                    <input type="file" class="span2" id="corr_image" style="display: none;" name="corr_image"  style="">
                                </div>
                            </div>
                            <div id="div_confirmation">
                           
                            </div>
                            
                            
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Candidate Name :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" readonly="readonly"  type="text" id="cand_name" style="text-transform: uppercase;" name="cand_name" placeholder="Candidate Name" maxlength="60"  value="<?php  echo  $data['0']['name']; ?>" <?php if($isReAdm==1) echo "readonly='readonly'";  ?>  >

                                    <label class="control-label span2" for="lblfather_name" >
                                        Correction  Candidate Name :  <input type="checkbox" class="corr_check_box" style="width: 20px;    height: 20px;" id="c0" name="c[]" value="1">
                                    </label> 
                                    <input class="span3" id="corr_cand_name" name="corr_cand_name" style="text-transform: uppercase; display:none;" type="text" placeholder="Candidate Name" maxlength="60" >
                                </div>

                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Father's Name :<!-- MEDIUM:-->
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" readonly="readonly" id="father_name" name="father_name" style="text-transform: uppercase;" type="text" placeholder="Father's Name" maxlength="60" value="<?php echo  $data['0']['Fname']; ?>" <?php if($isReAdm==1) echo "readonly='readonly'";  ?> required="required">
                                    <!-- <select id="medium" class="dropdown span3" name="medium">
                                    <?php // DebugBreak();
                                    // $med = $data['0']['med'] ;
                                    // $med = 2; 
                                    //    if($med == 1)
                                    //   {
                                    //       echo  "<option value='1' selected='selected'>Urdu</option> <option value='2'>English</option>";
                                    //    }
                                    //    else
                                    //    {
                                    //        echo  "<option value='1' >Urdu</option> <option value='2' selected='selected'>English</option>";
                                    //    }
                                    ?>

                                    </select>-->
                                    <label class="control-label span2" >
                                        Correction  Father's Name :  <input type="checkbox" class="corr_check_box" id="c1" name="c[]" value="2" style="width: 20px;    height: 20px;"> 
                                    </label> 
                                    <input class="span3" id="corr_father_name" type="text"  style="text-transform: uppercase; display:none;" name="corr_father_name" placeholder="Father's Name"  maxlength="60">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Date of Birth:(dd-mm-yyyy)
                                </label>

                                <div class="controls controls-row">
                                    <input class="span3" type="text"  name="dob" placeholder="DOB" value="<?php $source = $data['0']['Dob']; $date = new DateTime($source); echo $date->format('d-m-Y'); ?>" required="required" readonly="readonly"  <?php if($isReAdm==1) echo "readonly='readonly'"; ?> >

                                    <label class="control-label span2" >
                                        Correction Date of Birth : <input type="checkbox" class="corr_check_box" id="c2" name="c[]" value="3" style="width: 20px;    height: 20px;"> 
                                    </label> 
                                    <input class="span3" id="corr_dob" name="corr_dob" readonly="readonly" style="display: none;"  type="text" placeholder="dd-mm-yyyy">
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label span1" >
                                    Bay Form No :
                                </label>
                                <div class="controls controls-row">
                                    <input type="hidden" name="oldbform" value="<?php echo   $data['0']['BForm']; ?>">
                                    <input type="hidden" name="oldfform" value="<?php echo  $data['0']['FNIC']; ?>">
                                    <input class="span3" readonly="readonly" type="text" id="bay_form" name="bay_form" placeholder="Bay Form No." value="<?php echo  $data['0']['BForm']; ?>" required="required" <?php if($isReAdm==1) echo "readonly='readonly'";  ?>>
                                    <label class="control-label span2" for="father_cnic">
                                        Correction  Bay Form No  : <input type="checkbox" class="corr_check_box" id="c3" name="c[]" value="4" style="width: 20px;    height: 20px;">
                                    </label> 
                                    <input class="span3" id="corr_bay_form" name="corr_bay_form" style="display: none;"  type="text" placeholder="34101-1111111-1" value="" >
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Father's CNIC :<!-- Mark Of Identification :-->
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" readonly="readonly" id="father_cnic" name="father_cnic" type="text" placeholder="34101-1111111-1" value="<?php echo  $data['0']['FNIC']; ?>" <?php if($isReAdm==1) echo "readonly='readonly'";  ?> required="required">
                                    <!-- <input class="span3" type="text" id="MarkOfIden" style="text-transform: uppercase;" name="MarkOfIden" value="<?php //echo  $data['0']['markOfIden']; ?>" required="required" maxlength="60" >-->
                                    <label class="control-label span2" >
                                        Correction  Father's CNIC : <input type="checkbox" class="corr_check_box" id="c4" name="c[]" value="5" style="width: 20px;    height: 20px;">
                                    </label> 
                                    <input class="span3" id="corr_father_cnic" type="text"  style="text-transform: uppercase; display:none;" name="corr_father_cnic" placeholder="34101-1111111-1"  >
                                </div>
                            </div>  

                                <label class="control-label span3" style='display:none;' >
                                        Religion :
                                    </label> 
                                    <?php
                                        $rel = $data[0]['rel'];
                                        if($rel == 1)
                                        {
                                           echo " <label class='radio inline span1'><input type='radio' id='religion' class='rel_class' value='1' checked='checked' name='religion' style='display:none;'>
                                    </label><label class='radio inline span1'><input type='radio' id='religion1' class='rel_class' value='2' name='religion' style='display:none;'></label>" ;
                                        }
                                        else if ($rel == 2)
                                        {
                                             echo " <label class='radio inline span1'><input type='radio' id='religion' class='rel_class' value='1'  name='religion' style='display:none;'>
                                    </label><label class='radio inline span1'><input type='radio' id='religion1' class='rel_class' value='2' checked='checked' name='religion' style='display:none;'> </label>" ;
                                        }
                                    ?>
                                     <?php
                                    $nat = $data[0]['nat'];
                                    if($nat == 1)
                                    {
                                       echo  " <label class='radio inline span1'><input type='radio' value='1' id='nationality' checked='checked' name='nationality' style='display:none;'> 
                                    </label><label class='radio inline span2'><input type='radio'  id='nationality1' value='2' name='nationality' style='display:none;'> </label>" ;
                                    }
                                    else if ($nat == 2)
                                    {
                                         echo  "<label class='radio inline span1'><input type='radio' value='1' id='nationality'  name='nationality' style='display:none;'> 
                                    </label><label class='radio inline span2'><input type='radio'  id='nationality1' checked='checked' value='2' name='nationality' style='display:none;'>  </label>" ;
                                    }
                                ?>


                            <hr>
                            <div class="control-group">
                                <h4 class="span4">Exam Information :</h4>
                                <div class="controls controls-row">
                                    <input type="hidden" class="span2 hidden" id="isReAdm" name="isReAdm" value="0">
                                    <label class="control-label span5">
                                        Correction Study Group: <input type="checkbox" class="corr_check_box" id="c5" name="c[]" value="6" style="width: 20px;    height: 20px;">
                                    </label> 

                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Study Group :
                                </label>
                                <div class="controls controls-row">
                                    <select id="std_group" class="dropdown span6"  name="std_group" disabled="disabled" >
                                        <?php
                                        // DebugBreak();
                                        $grp = $data[0]['RegGrp'];
                                        $subgroups =  split(',',$grp_cd);
                                        echo "<option value='0' >SELECT GROUP</option>";
                                        if($isReAdm == 1 )
                                        {
                                            echo "<option value='1' >SCIENCE WITH BIOLOGY</option>
                                            <option value='7'>SCIENCE  WITH COMPUTER SCIENCE</option>
                                            <option value='8' >SCIENCE  WITH ELECTRICAL WIRING</option>
                                            <option value='2'>HUMANTIES</option>
                                            <option value='5'>DEAF AND DUMB</option>
                                            ";  
                                        }
                                        if($isReAdm != 1)
                                        {
                                            for($i =0 ; $i<count($subgroups); $i++)
                                            {
                                                if($subgroups[$i] == 1)
                                                {
                                                    if($grp == 1)
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
                                                    if($grp == 7)
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
                                                    if($grp == 8)
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
                                                    if($grp == 2)
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
                                                    if($grp == 5)
                                                    {
                                                        echo "<option value='5' selected='selected'>DEAF AND DUMB</option>";  
                                                    }
                                                    else
                                                    {
                                                        echo "<option value='5'>DEAF AND DUMB</option>";  
                                                    }

                                                }
                                            } 
                                        }
                                        $subarray = array(
                                            'Urdu' => '1',
                                            'English' => '2',
                                            'ISLAMIYAT (COMPULSORY)' => '3',
                                            'PAKISTAN STUDIES' => '4',
                                            'MATHEMATICS' => '5',
                                            'PHYSICS' => '6',
                                            'CHEMISTRY' => '7',
                                            'BIOLOGY' => '8',
                                            'GENERAL SCIENCE' => '9',
                                            'FOUNDATION OF EDUCATION' => '10',
                                            'GEOGRAPHY OF PAKISTAN' => '11',
                                            'HOUSE HOLD ACCOUNTS & ITS RELATED PROBLEMS' => '12',
                                            'ELEMENTS OF HOME ECONOMICS' => '13',
                                            'PHYSIOLOGY & HYGIENE' => '14',
                                            'GEOMETRICAL & TECHNICAL DRAWING' => '15',
                                            'GEOLOGY' => '16',
                                            'ASTRONOMY & SPACE SCIENCE' => '17',
                                            'ART/ART & MODEL DRAWING' => '18',
                                            'ISLAMIC STUDIES' => '19',
                                            'ISLAMIC HISTORY' => '20',
                                            'HISTORY OF PAKISTAN' => '21',
                                            'ARABIC' => '22',
                                            'PERSIAN' => '23',
                                            'GEOGRAPHY' => '24',
                                            'ECONOMICS' => '25',
                                            'CIVICS' => '26',
                                            'FOOD AND NUTRITION' => '27',
                                            'ART IN HOME ECONOMICS' => '28',
                                            'MANAGEMENT FOR BETTER HOME' => '29',
                                            'CLOTHING & TEXTILES' => '30',
                                            'CHILD DEVELOPMENT AND FAMILY LIVING' => '31',
                                            'MILITARY SCIENCE' => '32',
                                            'COMMERCIAL GEOGRAPHY' => '33',
                                            'URDU LITERATURE' => '34',
                                            'ENGLISH LITERATURE' => '35',
                                            'PUNJABI' => '36',
                                            'EDUCATION' => '37',
                                            'ELEMENTARY NURSING & FIRST AID' => '38',
                                            'PHOTOGRAPHY' => '39',
                                            'HEALTH & PHYSICAL EDUCATION' => '40',
                                            'CALIGRAPHY' => '41',
                                            'LOCAL (COMMUNITY) CRAFTS' => '42',
                                            'ELECTRICAL WIRING' => '43',
                                            'RADIO ELECTRONICS' => '44',
                                            'COMMERCE' => '45',
                                            'AGRICULTURE' => '46',
                                            'BOOK KEEPING & ACCOUNTANCY' => '47',
                                            'WOOD WORK (FURNITURE MAKING)' => '48',
                                            'GENERAL AGRICULTURE' => '49',
                                            'FARM ECONOMICS' => '50',
                                            'ETHICS' => '51',
                                            'LIVE STOCK FARMING' => '52',
                                            'ANIMAL PRODUCTION' => '53',
                                            'PRODUCTIVE INSECTS AND FISH CULTURE' => '54',
                                            'HORTICULTURE' => '55',
                                            'PRINCIPLES OF HOME ECONOMICS' => '56',
                                            'RELATED ACT' => '57',
                                            'HAND AND MACHINE EMBROIDERY' => '58',
                                            'DRAFTING AND GARMENT MAKING' => '59',
                                            'HAND & MACHINE KNITTING & CROCHEING' => '60',
                                            'STUFFED TOYS AND DOLL MAKING' => '61',
                                            'CONFECTIONERY AND BAKERY' => '62',
                                            'PRESERVATION OF FRUITS,VEGETABLES & OTHER FOODS' => '63',
                                            'CARE AND GUIDENCE OF CHILDREN' => '64',
                                            'FARM HOUSE HOLD MANAGEMENT' => '65',
                                            'ARITHEMATIC' => '66',
                                            'BAKERY' => '67',
                                            'CARPET MAKING' => '68',
                                            'DRAWING' => '69',
                                            'EMBORIDERY' => '70',
                                            'HISTORY' => '71',
                                            'TAILORING' => '72',
                                            'TYPE WRITING' => '73',
                                            'WEAVING' => '74',
                                            'SECRETARIAL PRACTICE' => '75',
                                            'CANDLE MAKING' => '76',
                                            'SECRETARIAL PRACTICE AND CORRESPONDANCE' => '77',
                                            'COMPUTER SCIENCES' => '78',
                                            'WOOD WORK (BOAT MAKING)' => '79',
                                            'PRINCIPLES OF ARITHMATIC' => '80',
                                            'SEERAT-E-RASOOL' => '81',
                                            'AL-QURAAN' => '82',
                                            'POULTRY FARMING' => '83',
                                            'ART & MODEL DRAWING' => '84',
                                            'BUSINESS STUDIES' => '85',
                                            'HADEES & FIQAH' => '86',
                                            'ENVIRONMENTAL STUDIES' => '87',
                                            'REFRIGERATION AND AIR CONDITIONING' => '88',
                                            'FISH FARMING' => '89',
                                            'COMPUTER HARDWARE' => '90',
                                            'BEAUTICIAN' => '91',
                                            'GENERAL MATHEMATICS' => '92',
                                            'COMPUTER SCIENCES_DFD' => '93',
                                            'HEALTH & PHYSICAL EDUCATION_DFD' => '94'

                                        );
                                        $result =  array_search($data[0]['sub4'],$subarray);



                                        ?>

                                    </select>                                            
   <select id="corr_std_group" class="dropdown span6"  name="corr_std_group" style="display: none;">
                                        <?php
                                        // DebugBreak();
                                        $grp = $data[0]['RegGrp'];
                                        $subgroups =  split(',',$grp_cd);
                                        echo "<option value='0' >SELECT GROUP</option>";
                                        if($isReAdm == 1 )
                                        {
                                            echo "<option value='1' >SCIENCE WITH BIOLOGY</option>
                                            <option value='7'>SCIENCE  WITH COMPUTER SCIENCE</option>
                                            <option value='8' >SCIENCE  WITH ELECTRICAL WIRING</option>
                                            <option value='2'>GENERAL</option>
                                            <option value='5'>DEAF AND DUMB</option>
                                            ";  
                                        }
                                        if($isReAdm != 1)
                                        {
                                            for($i =0 ; $i<count($subgroups); $i++)
                                            {
                                                if($subgroups[$i] == 1)
                                                {
                                                    if($grp == 1)
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
                                                    if($grp == 7)
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
                                                    if($grp == 8)
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
                                                    if($grp == 2)
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
                                                    if($grp == 5)
                                                    {
                                                        echo "<option value='5' selected='selected'>DEAF AND DUMB</option>";  
                                                    }
                                                    else
                                                    {
                                                        echo "<option value='5'>DEAF AND DUMB</option>";  
                                                    }

                                                }
                                            } 
                                        }
                                       
                                      //  $result =  array_search($data[0]['sub4'],$subarray);



                                        ?>

                                    </select> 
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span6" style="font-weight: bold;     text-align: center;" >
                                    Choose Subjects(Elective Subjects are Enabled Only)   
                                </label> 
<label class="control-label span6" id="corr_lbl_choose_sub" style="font-weight: bold;     text-align: center; display:none;" >
                                    Choose Subjects(Elective Subjects are Enabled Only)   
                                </label> 
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >

                                </label>
                                <div class="controls controls-row">
                                    <select id="sub1" class="span3 dropdown" name="sub1" disabled="disabled">
                                        <option value="<?php  echo $data[0]['sub1'] ?>" ><?php echo array_search($data[0]['sub1'],$subarray); ?></option>
                                    </select> 
                                    <select id="sub2"  name="sub2" class="span3 dropdown" disabled="disabled">
                                        <option value="<?php echo $data[0]['sub2'] ?>"><?php echo array_search($data[0]['sub2'],$subarray);?></option>
                                    </select>
                                    
                                    <select id="corr_sub1" class="span3 dropdown" name="corr_sub1" style="display: none;">
                                        <option value="<?php echo $data[0]['sub1'] ?>" ><?php echo array_search($data[0]['sub1'],$subarray); ?></option>
                                    </select> 
                                    <select id="corr_sub2"  name="corr_sub2" class="span3 dropdown" style="display: none;">
                                        <option value="<?php echo $data[0]['sub2'] ?>"><?php echo array_search($data[0]['sub2'],$subarray);?></option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label span1" >

                                </label>
                                <div class="controls controls-row">
                                    <select id="sub3" class="span3 dropdown" name="sub3" disabled="disabled">

                                        <option value="<?php echo $data[0]['sub3'] ?>" selected='selected'><?php
                                            echo array_search($data[0]['sub3'],$subarray);
                                        ?></option></select> 
                                         <select id="sub8"  name="sub8" class="span3 dropdown" disabled="disabled">
                                        <option value="<?php  if($isReAdm != 1) { echo $data[0]['sub8'];} else{echo "";}    ?>" selected="selected"><?php  if($isReAdm != 1) {
                                            // DebugBreak();
                                            echo array_search($data[0]['sub8'],$subarray);}  else {echo "";};
                                        ?></option>
                                    </select>
                                  
                                        
                                        <select id="corr_sub3" class="span3 dropdown" name="corr_sub3" style="display: none;">

                                        <option value="<?php echo $data[0]['sub3'] ?>" selected='selected'><?php
                                            echo array_search($data[0]['sub3'],$subarray);
                                        ?></option></select> 
                                        <select id="corr_sub8"  name="corr_sub8" class="span3 dropdown" style="display: none;">
                                        <option value="<?php  if($isReAdm != 1) { echo $data[0]['sub8'];} else{echo "";}    ?>" selected="selected"><?php  if($isReAdm != 1) {
                                            // DebugBreak();
                                            echo array_search($data[0]['sub8'],$subarray);}  else {echo "";};
                                        ?></option>
                                    </select>
                                   
                                </div>
                            </div>    
                            <div class="control-group">
                                <label class="control-label span1" >

                                </label>
                                <div class="controls controls-row">
                                  <select id="sub4"  name="sub4" class="span3 dropdown" disabled="disabled">
                                        <option value="<?php if($isReAdm != 1) { echo $data[0]['sub4'];} else echo'4'; ?>" selected="selected"><?php
                                            if($isReAdm != 1) {echo array_search($data[0]['sub4'],$subarray);} else echo"Pakistan Studies";      
                                        ?></option></select>
                                    <select id="sub5" class="span3 dropdown" name="sub5" selected="selected" disabled="disabled">
                                        <?php  if($isReAdm != 1)
                                            { echo "";} ?>
                                        <option value="<?php if($isReAdm != 1) {echo $data[0]['sub5'];} else{ echo "";} ?>"><?php  if($isReAdm != 1) {echo array_search($data[0]['sub5'],$subarray);} else {echo "";}

                                        ?></option>
                                    </select> 
                                   
                                          <select id="corr_sub4"  name="corr_sub4" class="span3 dropdown" style="display: none;">
                                        <option value="<?php if($isReAdm != 1) { echo $data[0]['sub4'];} else echo'4'; ?>" selected="selected"><?php
                                            if($isReAdm != 1) {echo array_search($data[0]['sub4'],$subarray);} else echo"Pakistan Studies";      
                                        ?></option></select>
                                     <select id="corr_sub5" class="span3 dropdown" name="corr_sub5" selected="selected" style="display: none;">
                                        <?php  if($isReAdm != 1)
                                            { echo "";} ?>
                                        <option value="<?php if($isReAdm != 1) {echo $data[0]['sub5'];} else{ echo "";} ?>"><?php  if($isReAdm != 1) {echo array_search($data[0]['sub5'],$subarray);} else {echo "";}

                                        ?></option>
                                    </select> 
                                   
                                </div>
                            </div>   
                            <div class="control-group">
                                <label class="control-label span1" >

                                </label>
                                <div class="controls controls-row">
                                 <select id="sub6"  name="sub6" class="span3 dropdown" selected="selected" disabled="disabled">
                                        <option value="<?php  if($isReAdm != 1) {echo $data[0]['sub6'];} else{echo "";}  ?>"><?php  if($isReAdm != 1) {
                                            echo array_search($data[0]['sub6'],$subarray);} else {echo "";};
                                        ?></option>
                                    </select>
                                    <select id="sub7" class="span3 dropdown" name="sub7" selected="selected" disabled="disabled">
                                        <option value="<?php  if($isReAdm != 1) {echo $data[0]['sub7']; }  else{echo "";}   ?>"><?php if($isReAdm != 1) {
                                            // DebugBreak();
                                            echo array_search($data[0]['sub7'],$subarray);} else {echo "";};
                                        ?></option>
                                    </select> 
                                   
                                     <select id="corr_sub6"  name="corr_sub6" class="span3 dropdown" selected="selected" style="display: none;">
                                        <option value="<?php  if($isReAdm != 1) {echo $data[0]['sub6'];} else{echo "";}  ?>"><?php  if($isReAdm != 1) {
                                            echo array_search($data[0]['sub6'],$subarray);} else {echo "";};
                                        ?></option>
                                    </select>
                                     <select id="corr_sub7" class="span3 dropdown" name="corr_sub7" selected="selected" style="display: none;">
                                        <option value="<?php  if($isReAdm != 1) {echo $data[0]['sub7']; }  else{echo "";}   ?>"><?php if($isReAdm != 1) {
                                            // DebugBreak();
                                            echo array_search($data[0]['sub7'],$subarray);} else {echo "";};
                                        ?></option>
                                    </select> 
                                    
                                </div>
                            </div>

                            <div class="form-actions no-margin">
                                <input type="hidden"   value="<?php  echo $data[0]['formNo']; ?>"  name="formNo">
                                <input type="hidden"   value="<?php  echo $isReAdm; ?>"  name="IsReAdm">
                                <input type="hidden"   value="<?php  echo $Oldrno; ?>"  name="OldRno">
                                <input type="hidden"   value="<?php  echo $data[0]['nat']; ?>" id="hid_nat" name="hid_nat">
                                <input type="hidden"   value="<?php  echo $data[0]['sex']; ?>" id="hid_sex"  name="hid_sex">
                                <input type="hidden"   value="<?php  echo $data[0]['rel']; ?>" id="hid_rel" name="hid_rel">
                                <button type="button" id="btnsubmitUpdateEnrol" name="btnsubmitUpdateEnrol" class="btn btn-large btn-info offset2" >
                                    Apply for Correction
                                </button>
                                <input type="button" class="btn btn-large btn-danger" value="Cancel" id="btnCancel" name="btnCancel" onclick="return CancelAlert();" >
                                <div class="clearfix">
                                </div>
                            </div>

<!--                            onclick="return checks()"-->

                        </form>
                        <script type="text/javascript">



   document.getElementById("corr_image").onchange = function () {
    debugger;
    var reader = new FileReader();
    var imgPath = $(this)[0].value;
    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
     if (extn == "jpg" || extn == "jpeg") {
    reader.onload = function (e) {
        
        // get loaded data and render thumbnail.
        document.getElementById("corr_previewImg").src = e.target.result;
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
     }
     else{
         alert("Please upload only Jpeg files");
     }
};

                            function checks(){
                                debugger;
                                var msg = "Are You Sure You want to Cancel this Form ?"
                                alertify.confirm(msg, function (e) {
                                    if (e) {
                                          return true;
                                        // user clicked "ok"
                                       // window.location.href ='<?php echo base_url(); ?>index.php/Registration/EditForms';
                                    } else {
                                        return false; 
                                        // user clicked "cancel"

                                    }
                                });
                               /* var status  =  //check_NewEnrol_validation();
                                if(status == 0)
                                {

                                    return false;    
                                }
                                else
                                {

                                    return true;
                                } */


                            }
                            function CancelAlert()
                            {
                                var msg = "Are You Sure You want to Cancel this Form ?"
                                alertify.confirm(msg, function (e) {
                                    if (e) {
                                        // user clicked "ok"
                                        window.location.href ='<?php echo base_url(); ?>index.php/NinthCorrection/EditForms';
                                    } else {
                                        // user clicked "cancel"

                                    }
                                });
                            }
                            
                        </script>

                    </div>  

                </div>
            </div>
        </div>
    </div>
</div>
