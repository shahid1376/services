
<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title">
                            Event Admission for<a id="redgForm" data-original-title="">m</a>
                        </div>
                        <span class="tools">
                            <a class="fs1" aria-hidden="true" data-icon="" data-original-title=""></a>
                        </span>
                    </div>
                    <div class="widget-body">

                        <form class="form-horizontal no-margin" action="<?php echo base_url(); ?>Admission_9th_pvt/NewEnrolment_insert" method="post" enctype="multipart/form-data" id="from9thpvt" >

                            <div class="control-group">
                                <h4 class="span4">Personal Information :</h4>
                                <div class="controls controls-row">
                                    <input type="hidden" class="span2 hidden" id="isReAdm" name="isReAdm" value="0">
                                    <label class="control-label span2" for="father_name">

                                    </label> 
                                    <img id="previewImg" style="width:80px; height: 80px;" class="span2" src="<?php echo base_url(); ?>assets/img/profile.png" alt="Candidate Image">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label hidden span1" for="">
                                    Father's Name :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3 hidden"  type="text" placeholder="Father's Name">  
                                    <label class="control-label span2" for="father_name">
                                        Image :  
                                    </label> 
                                    <input type="file" class="span4" id="image" name="image" required="required" >
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" for="cand_name">
                                    Candidate Name
                                </label>
                                <div class="controls controls-row">
                                    <div><input class="span3" type="text" id="cand_name" name='cand_name' required="required" placeholder="Candidate Name"  style="text-transform: uppercase;" ></div>
                                    <label class="control-label span2" for="">
                                        Father's Name :
                                    </label> 
                                    <div><input style="margin-left:42px;text-transform: uppercase;" class="span3" id="father_name" name="father_name" required="required" type="text"   placeholder="Father's Name"></div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" for="bay_form">
                                    Bay Form No :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="bay_form" name="bay_form" required="required" value="34101-412564-2" placeholder="Bay Form No.">
                                    <label class="control-label span2" for="father_cnic">
                                        Father's CNIC :
                                    </label> 
                                    <input class="span3" id="father_cnic" name="father_cnic" type="text" value="34101-56321-4" required="required" placeholder="34101-1111111-1">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" for="dob">
                                    Date of Birth:(dd-mm-yyyy)
                                </label>

                                <div class="controls controls-row">
                                    <input class="span3" type="text" required="required" id="dob"  name="dob" placeholder="dd-mm-yyyy" readonly>
                                    <label class="control-label span2" for="mob_number">
                                        Mobile Number :
                                    </label> 
                                    <input class="span3" id="mob_number" name="mob_number" required="required" type="text" placeholder="0300-1234567">
                                </div>
                            </div>
                          
                            <div class="control-group">
                                <label class="control-label span1" for="MarkOfIden">
                                    Mark Of Identification :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" style="text-transform: uppercase;" type="text" id="MarkOfIden" name="MarkOfIden"  required="required">
                                    <label class="control-label span2" for="fname">
                                        Speciality:
                                    </label> 
                                    <select id="speciality"  class="span3" name="speciality">
                                        <option value="0">None</option>
                                        <option value="1">Deaf &amp; Dumb</option>
                                        <option value="2">Board Employee</option>
                                        <option value="3">Blind</option>
                                    </select>
                                </div>
                            </div>
                              <div class="control-group">
                                <label class="control-label span1" for="medium">
                                    MEDIUM:
                                </label>
                                <div class="controls controls-row">
                                    <select id="medium" class="dropdown span3" name="medium">
                                        <option value="1" selected="selected">Urdu</option>
                                        <option value="2">English</option>
                                    </select>
                                   <label class="control-label span2" for="UrbanRural">
                                        Residency :
                                    </label> 
                                   <label class='radio inline span1'><input type='radio' value='1' id='UrbanRural' checked='checked' name='UrbanRural'> Urban
                                    </label><label class='radio inline span1'><input type='radio'  id='UrbanRural' value='2' name='UrbanRural'>  Rural </label>  
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" for="nationality1">
                                    Nationality :
                                </label>
                                <div class="controls controls-row">  
                                    <label class="radio inline span1">
                                        <input type="radio" value="1" id="nationality1" checked="checked" name="nationality"> Pakistani
                                    </label>
                                    <label class="radio inline span2">
                                        <input type="radio"  id="nationality2" value="2" name="nationality">  Non Pakistani 
                                    </label>
                                    <label class="control-label span2" for="gender1">
                                        Gender :
                                    </label> 
                                    <label class="radio inline span1" style='    color: red;'>
                                        <input type="radio" id="gender1" value="1"  name="gender" > Male
                                    </label> 
                                    <label class="radio inline span1" style='    color: red;'>
                                        <input type="radio" id="gender2" value="2" name="gender" > Female 
                                    </label> 
                                </div>
                                
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" for="name">
                                    Hafiz-e-Quran :
                                </label>
                                <div class="controls controls-row">
                                    <label class="radio inline span1">
                                        <input type="radio" id="hafiz1" value="1" checked="checked" name="hafiz"> No
                                    </label>
                                    <label class="radio inline span1">
                                        <input type="radio" id="hafiz2" value="2" name="hafiz"> Yes
                                    </label>
                                    <label class="control-label span3" for="fname">
                                        Religion :
                                    </label> 
                                    <label class="radio inline span1">
                                        <input type="radio" id="religion1" class="rel_class" value="1" checked="checked" name="religion"> Muslim
                                    </label>
                                    <label class="radio inline span1">
                                        <input type="radio" id="religion2" class="rel_class" value="2" name="religion"> Non Muslim
                                    </label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" for="name">
                                    Address :
                                </label>
                                <div class="controls controls-row">
                                    <textarea style="height:150px;text-transform: uppercase;" id="address" class="span8" name="address" required="required"> </textarea>
                                </div>
                            </div>
                            <hr>
                                      <div class="control-group">
                                <h4 class="span4" style="margin-left: 30px;">Exam Proposed Center Information :</h4>
                                <div class="controls controls-row">
                                    <label class="control-label span2">

                                    </label> 

                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    District :
                                </label>
                                <div class="controls controls-row">
                                    <select class='span3' id='pvtinfo_dist' name='pvtinfo_dist' required='required'>
                                        <option value='0'>SELECT DISTRICT</option>
                                        <option value='1'>GUJRANWALA</option>
                                        <option value='2'>GUJRAT</option>
                                        <option value='3'>HAFIZABAD</option>
                                        <option value='4'>MANDI BAHA-UD-DIN</option>
                                        <option value='5'>NAROWAL</option>
                                        <option value='6'>SIALKOT</option>
                                    </select>
                                    <label class="control-label span2" >
                                        Tehsil:
                                    </label> 
                                    <select class='span3' id='pvtinfo_teh' name='pvtinfo_teh' required='required'>
                                        <option value='0'>SELECT TEHSIL</option>

                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                            <label class="control-label span1" >
                                Zone :
                            </label>

                            <div class="controls controls-row">
                                <select id="pvtZone"  class="span3" name="pvtZone">
                                    <option value='0'>SELECT ZONE</option>

                                </select>
                                <!-- <label class="control-label span2" >
                                Board:
                                </label> 
                                <select id="speciality"  class="span3" name="speciality">
                                <?php echo "<option value='1' selected='selected'>Gujranwala</option>";  ?>
                                </select>
                                </div>-->
                            </div>
                            <div id="instruction" style="display:none; width:700px" >
                                <img src="<?php echo base_url(); ?>assets/img/admission_form.jpg" border="0" width="10000" height="840" alt="admission_form.jpg">
                                <img src="<?php echo base_url(); ?>assets/img/instructions.jpg" border="0" width="10000" height="840" alt="admission_form.jpg">
                            </div>
                            <hr>
                      
                            </div>
                             
                                        <div class="control-group">
                                <h4 class="span4">Exam Information :</h4>
                                <div class="controls controls-row">
                                    <input type="hidden" class="span2 hidden"  value="0">
                                    <label class="control-label span2" for="father_name">

                                    </label> 
                                    
                                </div>
                            </div>
                               <div class="control-group">
                                <label class="control-label span1" for="nationality1">
                                    Study Group :
                                </label>
                                <div class="controls controls-row">
                                    <select id="std_group" class="dropdown span6"  name="std_group">
                                        <option value="0">Please Select Group</option>
                                        <option value="1">SCIENCE WITH BIOLOGY</option>
                                        <option value="7">SCIENCE  WITH COMPUTER SCIENCE</option>
                                        <option value="8">SCIENCE  WITH ELECTRICAL WIRING</option>
                                        <option value="2">GENERAL</option>
                                        <option value="5">DEAF AND DUMB</option>
                                    </select>                                            
                                    
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span3" for="name">
                                 <b>Choose Subjects(Elective Subjects are Enabled Only)</b>   
                                </label>
                                <div class="controls controls-row">
                                    <label class="control-label span8" >
                                    </label> 
                                </div>
                            </div>
                                  <div class="control-group">
                                <label class="control-label span1" for="name">
                                    
                                </label>
                                <div class="controls controls-row">
                                    <select id="sub1" class="span3 dropdown" name="sub1"><option value="1">Urdu</option></select> 
                                    <select id="sub2"  name="sub2" class="span3 dropdown">
                                            <option value="2">English</option></select>
                                </div>
                            </div>
                                    <div class="control-group">
                                <label class="control-label span1" for="name">
                                    
                                </label>
                                <div class="controls controls-row">
                                    <select id="sub3" class="span3 dropdown" name="sub3"><option value="3">Islamyat Compulsory</option></select> 
                                    <select id="sub4"  name="sub4" class="span3 dropdown">
                                            <option value="4">Pakistan Studies</option></select>
                                </div>
                            </div>    
                            <div class="control-group">
                                <label class="control-label span1" for="name">
                                    
                                </label>
                                <div class="controls controls-row">
                                    <select id="sub5" class="span3 dropdown" name="sub5"></select> 
                                    <select id="sub6"  name="sub6" class="span3 dropdown">
                                            </select>
                                </div>
                            </div>    <div class="control-group">
                                <label class="control-label span1" for="name">
                                    
                                </label>
                                <div class="controls controls-row">
                                    <select id="sub7" class="span3 dropdown" name="sub7"></select> 
                                    <select id="sub8"  name="sub8" class="span3 dropdown">
                                            </select>
                                </div>
                            </div>
                        
                           
                            <div class="row">
                            <div class="col-lg-2">
                            </div>
                            <div class="col-lg-4">
                                <button type="submit" name="save" class="btn btn-large btn-info" onclick="return checks();"> 
                                    Save Form
                                </button>
                                <input type="button" class="btn btn-large btn-danger" value="Cancel" onclick="window.location='index.php';" >
                            </div>
                            </div>
                            
                                <div class="clearfix">
                                </div>
                            

                        </form>


                    </div>  

                </div>
            </div>
        </div>
    </div>
</div>
<script type="">
    function checks(){
        var status  =  check_NewEnrol_validation();
        if(status == 0)
        {
            return false;    
        }
        else
        {
             $("button[type='submit']").html('Please wait ...').attr('disabled','disabled'); 
             $("#from9thpvt").submit(); 
            return true;
        } 
    }
function  check_NewEnrol_validation(){

        var name =  $('#cand_name').val();
        var dist_cd= $('#pvtinfo_dist').val();
        var teh_cd= $('#pvtinfo_teh').val();
        var zone_cd= $('#pvtZone').val();
      //  var pp_cent= $('#pp_cent').val();           
        var sub6p1 = $('#sub5').val();
        var sub6p2 = $('#sub6').val();           
        var sub7p1 = $('#sub7').val();
        var sub7p2 = $('#sub8').val();                      
        var ex_type = $('#exam_type').val();
        var mobNo = $('#mob_number').val();
        var bFormNo = $('#bay_form').val();
        var grp_cd = $('#std_group').val();
        var brd_cd = $('#brd_cd').val();
        var fName = $('#father_name').val();
        var FNic = $('#father_cnic').val();
        var dob = $('#dob').val();
        var address = $('#address').val();
        var image = $('#image').val();
        var MarkOfIdent = $('#MarkOfIden').val();
         var gend = $("input[name=gender]:checked").val();
        var status = 0;
        // alert('sub6 '+sub6p1+ ' and '+ sub6p2);
        if(name == "" ||  name == undefined){
              alertify.error("Please Enter your  Name.");
          
            $('#cand_name').focus(); 
            return status;
        }
        else if(fName == "" || fName == undefined){
            alertify.error("Please Enter your  Father's Name.");
           
            $('#father_name').focus(); 
            return status;
        }   

        else if(bFormNo == "" || bFormNo == 0 || bFormNo == undefined)
        {
             alertify.error("Please Enter your  bay-Form.");
            $('#bay_form').focus();  
            return status; 
        }
        else if(FNic == "" || FNic.length == undefined )
        {
             alertify.error("Please Enter your  Father's CNIC.");
            
            $('#father_cnic').focus();  
            return status; 
        }
        else if(bFormNo == "" || bFormNo == 0 || bFormNo == undefined)
        {
            $('#ErrMsg').show(); 
            $("#ErrMsg").css({ backgroundColor: '#FEFAFB', color: '#F00' });
            $('#ErrMsg').html("<b>Please Enter your bay-Form</b>"); 
            $('#bay_form').focus();  
            return status; 
        }
        else if(FNic == bFormNo  )
        {

            alertify.error("B-form Number and Father CNIC cannot be same.") 
            $('#bay_form').focus();   
            return status; 
        }
        else if(dob == "" || dob.length == undefined)
        {
             alertify.error("Please Enter your  Date of Birth.");
            
            $('#dob').focus(); 
            return status;  
        }

        else if(mobNo == "" || mobNo == 0 || mobNo == undefined)
        {
            alertify.error("Please Enter your Mobile No.");
            
            $('#mob_number').focus();   
            return status;  
        }
        else if(gend == "" || gend== undefined)
        {
             alertify.error("Please Select Your Gender.");
            //$('#ErrMsg').html("<b>Please Select Your Gender.</b>"); 
            $("input[name=gender]:checked").focus();   
            return status;  
        }
        else if(MarkOfIdent == "" || MarkOfIdent == 0 || MarkOfIdent == undefined)
        {
             alertify.error("Please Enter your Mark of Indentification.");
            //$('#ErrMsg').html("<b>Please Enter your Mark of Indentification</b>"); 
            $('#MarkOfIden').focus();   
            return status;  
        }
        else if(address == "" || address == 0 || address.length ==undefined )
        {
            alertify.error("Please Enter your Address.");
            //$('#ErrMsg').html("<b>Please Enter your Address</b>"); 
            $('#address').focus(); 
            return status;    
        }

        else  if (dist_cd < 1) 
        {

             alertify.error("Please select District.");
      
        $("#pvtinfo_dist").focus();

        return status;  
        }

        else   if (teh_cd < 1) {
        alertify.error("Please select Tehsil.");
        //alert('Please select Tehsil');                          
        $("#pvtinfo_teh").focus();
        return status;  
        }
        else  if (zone_cd < 1) {
alertify.error("Please select Zone.");
       // alert('Please select Zone. ');                          
        $("#pvtZone").focus();
        return status;  
        }
        

        else   if ($("#std_group").find('option:selected').val() < 1) 
        {
             alertify.error("Please Enter your Study Group.");
           
            // alert('Study Group not selected ');                          
            $("#std_group").focus();
            return status;  
        }
        else   if ($("#sub3").find('option:selected').val() < 1) 
        {
             alertify.error("Plesae select  Subject.");
                             
            $("#sub3").focus();

            return status;  
        }
        else   if ($("#sub5").find('option:selected').val() < 1) 
        {
            alertify.error("Plesae select  Subject.");
                                   
            $("#sub5").focus();

            return status;  
        }

        else   if ($("#sub6").find('option:selected').val() < 1) 
        {
             alertify.error("Plesae select 6th Subject.");
                                   
            
            // alert('Plesae select 6th Subject  ');                          
            $("#sub6").focus();
            return status;  
        }

        else   if ($("#sub7").find('option:selected').val() < 1) 
        {
             alertify.error("Plesae select 7th Subject.");
                                   
            
            // alert('Plesae select 6th Subject  ');                          
             
            $("#sub7").focus();
            return status;  
        }

        else   if ($("#sub8").find('option:selected').val() < 1) 
        {
            alertify.error("Plesae select 8th Subject.");
              
            $("#sub8").focus();
            return status;  
        }

        status = 1;
        return status;




    }
     
</script>