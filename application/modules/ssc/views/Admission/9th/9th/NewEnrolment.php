<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title">
                            New Registration Form<a id="redgForm" data-original-title=""></a>
                        </div>

                    </div>
                    <div class="widget-body">

                        <form class="form-horizontal no-margin" action="<?php echo base_url(); ?>/index.php/Registration/NewEnrolment_insert" method="post" enctype="multipart/form-data">

                            <div class="control-group">
                                <h4 class="span4">Personal Information :</h4>
                                <div class="controls controls-row">
                                    <input type="hidden" class="span2 hidden" id="isReAdm" name="isReAdm" value="0">

                                       <label class="control-label span2" style="width: 411px;margin-left: -199px;" >
                                      <img src="../../assets/img/upalodimage.jpg" alt="" >
                                    </label> 
                                    <img id="previewImg" style="width:80px; height: 80px;" class="span2" src="<?php echo base_url(); ?>assets/img/profile.png" alt="Candidate Image">
                                </div>
                            </div>
                            <div class="control-group">

                                <label id="ErrMsg" class="control-label span2" style=" text-align: left;"><?php  // if (($excep != "") && ($excep['excep'] != "success")){echo $excep['excep'];}  ?></label>
                                <div class="controls controls-row">
                                    <input class="span3 hidden"  type="text" placeholder="" >  
                                    <label class="control-label span2">
                                        Image :  
                                    </label> 
                                    <input type="file" class="span4" id="image" name="image"  onchange="return readURL(this);">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Candidate Name :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="cand_name" style="text-transform: uppercase;" name="cand_name" placeholder="Candidate Name" value = "<?php  if(($excep != "")&& ($excep['excep'] != "success")){echo strtoupper($excep['cand_name']) ;} else {echo '';}?>" maxlength="60">
                                    <label class="control-label span2" for="lblfather_name">
                                        Father's Name :
                                    </label> 
                                    <input class="span3" id="father_name" name="father_name" style="text-transform: uppercase;" type="text" placeholder="Father's Name" value="<?php if (($excep != "") && ($excep['excep'] != "success")){echo strtoupper($excep['father_name']) ;} else {echo '';} ?>" required="required" maxlength="60">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Bay Form No :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="bay_form" name="bay_form" placeholder="Bay Form No." value="<?php if (($excep != "") && ($excep['excep'] != "success")){echo $excep['bay_form'];} else {echo '';} ?>" required="required">
                                    <label class="control-label span2" for="father_cnic">
                                        Father's CNIC :
                                    </label> 
                                    <input class="span3" id="father_cnic" name="father_cnic" type="text" placeholder="34101-1111111-1" value="<?php if (($excep != "") && ($excep['excep'] != "success")){echo $excep['father_cnic'];} else {echo '';} ?>" required="required">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label span1" >
                                    Date of Birth:(dd-mm-yyyy)
                                </label>

                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="dob" name="dob" placeholder="DOB" value="<?php if (($excep != "") && ($excep['excep'] != "success")){echo $excep['dob'];} else {echo '';} ?>" required="required" readonly="readonly" >

                                    <label class="control-label span2" >
                                        Mobile Number :
                                    </label> 
                                    <input class="span3" id="mob_number" name="mob_number" type="text" placeholder="0300-1234567" value="<?php if (($excep != "") && ($excep['excep'] != "success")){echo $excep['mob_number'];} else {echo '';} ?>" required="required">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    MEDIUM:
                                </label>
                                <div class="controls controls-row">
                                    <select id="medium" class="dropdown span3" name="medium">
                                        <?php if (($excep != "") && ($excep['excep'] != "success")){

                                            if($excep['medium'] == "1"){
                                                echo "<option value='1' selected='selected'>Urdu</option>
                                                <option value='2'>English</option>";
                                            }
                                            else if($excep['medium'] == "2"){
                                                echo "<option value='1' >Urdu</option>
                                                <option value='2' selected='selected'>English</option>";    
                                            }
                                        } else {echo "<option value='1' selected='selected'>Urdu</option>
                                            <option value='2'>English</option>";} ?>

                                    </select>
                                    <label class="control-label span2" >
                                        Class Roll No :
                                    </label> 
                                    <input class="span3" id="Inst_Rno" type="text" style="text-transform: uppercase;"  name="Inst_Rno" placeholder="" value="<?php if (($excep != "") && ($excep['excep'] != "success")){echo $excep['Inst_Rno'];} else {echo '';} ?>" required="required" maxlength="8">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Mark Of Identification :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="MarkOfIden" style="text-transform: uppercase;" name="MarkOfIden" maxlength="60" value="<?php if (($excep != "") && ($excep['excep'] != "success")){echo $excep['MarkOfIden'];} else {echo '';} ?>" required="required" >
                                    <label class="control-label span2" >
                                        Speciality:
                                    </label> 
                                    <select id="speciality"  class="span3" name="speciality">
                                        <?php if (($excep != "") && ($excep['excep'] != "success")){

                                            if($excep['speciality'] == "0"){
                                                echo " <option value='0' selected='selected'>None</option>
                                                <option value='1'>Deaf &amp; Dumb</option>
                                                <option value='2'>Board Employee</option>";
                                            }
                                            else if($excep['speciality'] == "1"){
                                                echo "<option value='0' >None</option>
                                                <option value='1' selected='selected'>Deaf &amp; Dumb</option>
                                                <option value='2'>Board Employee</option>";    
                                            }
                                            else if($excep['speciality'] == "2"){
                                                echo "<option value='0' >None</option>
                                                <option value='1' selected='selected'>Deaf &amp; Dumb</option>
                                                <option value='2'  selected='selected' >Board Employee</option>";    
                                            }

                                        } else {echo " <option value='0' selected='selected'>None</option>
                                            <option value='1'>Deaf &amp; Dumb</option>
                                            <option value='2'>Board Employee</option>";} ?>

                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Nationality :
                                </label>
                                <div class="controls controls-row">  
                                    <?php if (($excep != "") && ($excep['excep'] != "success")){

                                        if($excep['nationality'] == "1"){
                                            echo "  <label class='radio inline span1'>
                                            <input type='radio' value='1' id='nationality' checked='checked' name='nationality'> Pakistani
                                            </label>
                                            <label class='radio inline span2'>
                                            <input type='radio'  id='nationality1' value='2' name='nationality'>  Non Pakistani 
                                            </label>";
                                        }
                                        else if($excep['nationality'] == "2"){
                                            echo "<label class='radio inline span1'>
                                            <input type='radio' value='1' id='nationality'  name='nationality'> Pakistani
                                            </label>
                                            <label class='radio inline span2'>
                                            <input type='radio'  id='nationality1' value='2' checked='checked' name='nationality'>  Non Pakistani 
                                            </label>";    
                                        }


                                    } else {echo "  <label class='radio inline span1'>
                                        <input type='radio' value='1' id='nationality' checked='checked' name='nationality'> Pakistani
                                        </label>
                                        <label class='radio inline span2'>
                                        <input type='radio'  id='nationality1' value='2' name='nationality'>  Non Pakistani 
                                        </label>";} ?>

                                    <label class="control-label span2" for="gender1">
                                        Gender :
                                    </label> 
                                    <?php
                                    // DebugBreak();
                                    // $gen = 0;
                                    // echo $gender;
                                    if($gender == 1){
                                        echo " <label class='radio inline span1'><input type='radio' id='gender1' value='1' checked='checked' name='gender' disabled='disabled' > Male</label> 
                                        <label class='radio inline span1'><input type='radio' id='gender2' value='2'   name='gender'  disabled='disabled' > Female </label> 
                                        ";
                                    }
                                    else if ($gender == 2){
                                        echo " <label class='radio inline span1'><input type='radio' id='gender1' value='1'  name='gender' disabled='disabled' > Male</label> 
                                        <label class='radio inline span1'><input type='radio' id='gender2' value='2'  checked='checked'  name='gender' disabled='disabled'> Female </label> ";
                                    }
                                    ?>
                                    <input type="hidden" name="gender" value="<?php echo $gender; ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Hafiz-e-Quran :
                                </label>

                                <div class="controls controls-row">
                                    <?php if (($excep != "") && ($excep['excep'] != "success")){

                                        if($excep['hafiz'] == "1"){
                                            echo "   <label class='radio inline span1'>
                                            <input type='radio' id='hafiz1' value='1' checked='checked'   name='hafiz'> No
                                            </label>
                                            <label class='radio inline span1'>
                                            <input type='radio' id='hafiz2'  value='2' name='hafiz'> Yes
                                            </label>";
                                        }
                                        else if($excep['hafiz'] == "2"){
                                            echo " <label class='radio inline span1'>
                                            <input type='radio' id='hafiz1' value='1'    name='hafiz'> No
                                            </label>
                                            <label class='radio inline span1'>
                                            <input type='radio' id='hafiz2'  value='2' checked='checked' name='hafiz'> Yes
                                            </label>";    
                                        }


                                    } else {echo "   <label class='radio inline span1'>
                                        <input type='radio' id='hafiz1' value='1' checked='checked'   name='hafiz'> No
                                        </label>
                                        <label class='radio inline span1'>
                                        <input type='radio' id='hafiz2'  value='2' name='hafiz'> Yes
                                        </label>";} ?>

                                    <label class="control-label span3" >
                                        Religion :
                                    </label> 
                                    <?php if (($excep != "") && ($excep['excep'] != "success")){

                                        if($excep['religion'] == "1"){
                                            echo "   <label class='radio inline span1'>
                                            <input type='radio' id='religion' class='rel_class' value='1' checked='checked' name='religion'> Muslim
                                            </label>
                                            <label class='radio inline span1'>
                                            <input type='radio' id='religion1' class='rel_class' value='2' name='religion'> Non Muslim
                                            </label>";
                                        }
                                        else if($excep['religion'] == "2"){
                                            echo " <label class='radio inline span1'>
                                            <input type='radio' id='religion' class='rel_class' value='1' name='religion'> Muslim
                                            </label>
                                            <label class='radio inline span1'>
                                            <input type='radio' id='religion1' class='rel_class' value='2'  checked='checked' name='religion'> Non Muslim
                                            </label>";    
                                        }


                                    } else {echo "  <label class='radio inline span1'>
                                        <input type='radio' id='religion' class='rel_class' value='1' checked='checked' name='religion'> Muslim
                                        </label>
                                        <label class='radio inline span1'>
                                        <input type='radio' id='religion1' class='rel_class' value='2' name='religion'> Non Muslim
                                        </label>";} 

                                    ?>

                                </div>
                            </div>
                            <div class="control-group">
                            <label class="control-label span1" >
                                Residency :
                            </label>
                            <div class="controls controls-row">  
                                <?php if (($excep != "") && ($excep['excep'] != "success")){

                                    if($excep['UrbanRural'] == "1"){
                                        echo "    <label class='radio inline span1'>
                                        <input type='radio' value='1' id='UrbanRural' checked='checked' name='UrbanRural'> Urban
                                        </label>
                                        <label class='radio inline span2'>
                                        <input type='radio'  id='UrbanRural' value='2' name='UrbanRural'>  Rural 
                                        </label>";
                                    }
                                    else if($excep['UrbanRural'] == "2"){
                                        echo "<label class='radio inline span1'>
                                        <input type='radio' value='1' id='UrbanRural'  name='UrbanRural'> Urban
                                        </label>
                                        <label class='radio inline span2'>
                                        <input type='radio'  id='UrbanRural' value='2' checked='checked' name='UrbanRural'>  Rural 
                                        </label>";    
                                    }


                                } else {echo "  <label class='radio inline span1'>
                                    <input type='radio' value='1' id='UrbanRural' checked='checked' name='UrbanRural'> Urban
                                    </label>
                                    <label class='radio inline span2'>
                                    <input type='radio'  id='UrbanRural' value='2' name='UrbanRural'>  Rural 
                                    </label>";} ?>

                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Address :
                                </label>
                                <div class="controls controls-row">
                                    <textarea style="height:150px;text-transform: uppercase;" id="address" class="span8" name="address" required="required"><?php if (($excep != "") && ($excep['excep'] != "success")){echo $excep['address'];} else {echo '';} ?></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="control-group">
                                <h4 class="span4">Exam Information :</h4>
                                <div class="controls controls-row">
                                    <input type="hidden" class="span2 hidden" id="isReAdm" name="isReAdm" value="0">
                                    <label class="control-label span2">

                                    </label> 

                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Study Group :
                                </label>
                                <div class="controls controls-row">
                                    <select id="std_group" class="dropdown span6"  name="std_group">
                                        <?php 
                                        $subgroups =  split(',',$grp_cd);
                                        echo "<option value='0' >SELECT GROUP</option>";
                                        for($i =0 ; $i<count($subgroups); $i++)
                                        {
                                            if($subgroups[$i] == 1)
                                            {
                                                if($excep['std_group'] == 1 &&  ($excep['excep'] != "success") && ($excep != ""))
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
                                                if($excep['std_group'] == 7 &&  ($excep['excep'] != "success") && ($excep != ""))
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
                                                 if($excep['std_group'] == 8 &&  ($excep['excep'] != "success") && ($excep != ""))
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
                                                 if($excep['std_group'] == 2 &&  ($excep['excep'] != "success") && ($excep != ""))
                                                {
                                                  echo "<option value='2' selected='selected'>HUMANTIES</option>";  
                                                }
                                                else
                                                {
                                                  echo "<option value='2'>HUMANTIES</option>";   
                                                }
                                                
                                            }
                                            else if($subgroups[$i] == 5)
                                            {
                                                 if($excep['std_group'] == 5 &&  ($excep['excep'] != "success") && ($excep != ""))
                                                {
                                                   echo "<option value='5' selected='selected'>DEAF AND DUMB</option>";  
                                                }
                                                else
                                                {
                                                   echo "<option value='5'>DEAF AND DUMB</option>";  
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
                                            'HISTORY OF PAKISTAN/ HISTORY OF INDO PAK' => '21',
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
                                        //  DebugBreak();
                                        //  $result =  array_search($excep['sub1'],$subarray);
                                        ?>

                                    </select>                                            

                                </div>
                            </div>
                            <div class="control-group">
                               <label class="control-label span12" style="width: 366px; font-weight: bold;" >
                                     Choose Subjects(Elective Subjects are Enabled Only)   
                                    </label> 
                              
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >

                                </label>
                                <div class="controls controls-row">
                                    <select id="sub1" class="span3 dropdown" name="sub1"><option value="<?php if (($excep != "") && ($excep['excep'] != "success")){ echo $excep['sub1'];} else {echo "1";} ?>"><?php if (($excep != "") && ($excep['excep'] != "success")){ echo array_search($excep['sub1'],$subarray);} else{echo "Urdu";} ?></option></select> 
                                    <select id="sub2"  name="sub2" class="span3 dropdown">
                                        <option value="<?php if (($excep != "") && ($excep['excep'] != "success")){ echo $excep['sub2'];} else {echo "2";} ?>"><?php if (($excep != "") && ($excep['excep'] != "success")){ echo array_search($excep['sub2'],$subarray);} else{echo "English";} ?></option></select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >

                                </label>
                                <div class="controls controls-row">
                                    <select id="sub3" class="span3 dropdown" name="sub3"><option value="<?php if (($excep != "") && ($excep['excep'] != "success")){ echo $excep['sub3'];} else{ echo "3";} ?>"><?php if (($excep != "") && ($excep['excep'] != "success")){ echo array_search($excep['sub3'],$subarray);} else{echo "Islamyat Compulsory";} ?></option></select> 
                                    <select id="sub4"  name="sub4" class="span3 dropdown"><option value="<?php if (($excep != "") && ($excep['excep'] != "success")){ echo $excep['sub4'];} else {echo "4";} ?>"><?php if (($excep != "") && ($excep['excep'] != "success")){ echo array_search($excep['sub4'],$subarray);} else{echo "Pakistan Studies";} ?></option></select>
                                </div>
                            </div>    <div class="control-group">
                                <label class="control-label span1" >

                                </label>
                                <div class="controls controls-row">
                                    <select id="sub5" class="span3 dropdown" name="sub5" >
                                        <option value="<?php if (($excep != "") && ($excep['excep'] != "success")){ echo $excep['sub5'];} ?>" ><?php if (($excep != "") && ($excep['excep'] != "success")){ echo array_search($excep['sub5'],$subarray);} ?></option>
                                    </select> 
                                    <select id="sub6"  name="sub6" class="span3 dropdown">
                                        <option value="<?php if (($excep != "") && ($excep['excep'] != "success")){ echo $excep['sub6'];} ?>"><?php if (($excep != "") && ($excep['excep'] != "success")){ echo array_search($excep['sub6'],$subarray);} ?></option>
                                    </select>
                                </div>
                            </div>    <div class="control-group">
                                <label class="control-label span1" >

                                </label>
                                <div class="controls controls-row">
                                    <select id="sub7" class="span3 dropdown" name="sub7">
                                        <option value="<?php if (($excep != "") && ($excep['excep'] != "success")){ echo $excep['sub7'];} ?>"><?php if (($excep != "") && ($excep['excep'] != "success")){ echo array_search($excep['sub7'],$subarray);} ?></option></select> 
                                    <select id="sub8"  name="sub8" class="span3 dropdown">
                                        <option value="<?php if (($excep != "") && ($excep['excep'] != "success")){ echo $excep['sub8'];} ?>"><?php if (($excep != "") && ($excep['excep'] != "success")){ echo array_search($excep['sub8'],$subarray);} ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-actions no-margin">

                                <button type="submit" onclick="return checks()" name="btnsubmitNewEnrol" class="btn btn-large btn-info offset2">
                                    Save Form
                                </button>
                                <input type="button" class="btn btn-large btn-danger" value="Cancel" onclick="return CancelAlert()" >
                                <div class="clearfix">
                                </div>
                            </div>


                        </form>


                    </div>  

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">



    function checks(){

    var status  =  check_NewEnrol_validation();
    if(status == 0)
    {

        return false;    
    }
    else
    {
        return true;
    } 
    }

    function CancelAlert()
    {
        var msg = "Are You Sure You want to Cancel this Form ?"
        alertify.confirm(msg, function (e) {
            if (e) {
                // user clicked "ok"
                window.location.href ='<?php echo base_url(); ?>index.php/Registration/';
            } else {
                // user clicked "cancel"

            }
        });
    }

</script>