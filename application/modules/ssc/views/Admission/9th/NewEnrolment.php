
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

                        <form class="form-horizontal no-margin">

                            <div class="control-group">
                                <h4 class="span4">Personal Information :</h4>
                                <div class="controls controls-row">
                                    <input type="hidden" class="span2 hidden" id="isReAdm" name="isReAdm" value="0">
                                    <label class="control-label span2" for="father_name">

                                    </label> 
                                    <img id="previewImg" style="width:80px; height: 80px;" class="span2" src="assets/img/profile.png" alt="Candidate Image">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label hidden span1" for="cand_name">
                                    Father's Name :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3 hidden" id="father_name" type="text" placeholder="Father's Name">  
                                    <label class="control-label span2" for="father_name">
                                        Image :  
                                    </label> 
                                    <input type="file" class="span4" id="image" name="image" required="required" onchange="Checkfiles()">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" for="cand_name">
                                    Candidate Name
                                </label>
                                <div class="controls controls-row">
                                    <div><input class="span3" type="text" id="cand_name" required="required" placeholder="Candidate Name"></div>
                                    <label class="control-label span2" for="father_name">
                                        Father's Name :
                                    </label> 
                                    <div><input style="margin-left:42px" class="span3" id="father_name" required="required" type="text" placeholder="Father's Name"></div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" for="bay_form">
                                    Bay Form No :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="bay_form" required="required" placeholder="Bay Form No.">
                                    <label class="control-label span2" for="father_cnic">
                                        Father's CNIC :
                                    </label> 
                                    <input class="span3" id="father_cnic" type="text" required="required" placeholder="34101-1111111-1">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" for="dob">
                                    Date of Birth:(dd-mm-yyyy)
                                </label>

                                <div class="controls controls-row">
                                    <input class="span3" type="text" required="required" id="dob" placeholder="First Name">
                                    <label class="control-label span2" for="mob_number">
                                        Mobile Number :
                                    </label> 
                                    <input class="span3" id="mob_number" required="required" type="text" placeholder="0300-1234567">
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
                                    <label class="control-label span2" for="Inst_Rno">
                                        Class Roll No :
                                    </label> 
                                    <input class="span3" id="Inst_Rno" type="text" placeholder="">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" for="MarkOfIden">
                                    Mark Of Identification :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="MarkOfIden" required="required">
                                    <label class="control-label span2" for="fname">
                                        Speciality:
                                    </label> 
                                    <select id="speciality"  class="span3" name="speciality">
                                        <option value="0">None</option>
                                        <option value="1">Deaf &amp; Dumb</option>
                                        <option value="2">Board Employee</option>
                                    </select>
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
                                    <label class="radio inline span1">
                                        <input type="radio" id="gender1" value="1" checked="checked" name="gender"> Male
                                    </label> 
                                    <label class="radio inline span1">
                                        <input type="radio" id="gender2" value="2" disabled="disabled" name="gender"> Female 
                                    </label> 
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" for="name">
                                    Hafiz-e-Quran :
                                </label>
                                <div class="controls controls-row">
                                    <label class="radio inline span1">
                                        <input type="radio" id="hafiz1" value="0" checked="checked" name="hafiz"> No
                                    </label>
                                    <label class="radio inline span1">
                                        <input type="radio" id="hafiz2" value="1" name="hafiz"> Yes
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
                                    <textarea style="height:150px;" id="address" class="span8" name="address" required="required"></textarea>
                                </div>
                            </div>
                               <hr>
                                        <div class="control-group">
                                <h4 class="span4">Exam Information :</h4>
                                <div class="controls controls-row">
                                    <input type="hidden" class="span2 hidden" id="isReAdm" name="isReAdm" value="0">
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
                            <option value="1">SCIENCE WITH BIOLOGY</option>
                            <option value="7">SCIENCE  WITH COMPUTER SCIENCE</option>
                                                        <option value="2">HUMANTIES</option>
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
                                    <select id="sub1" class="span3 dropdown" name="sub1"><option value="1">Islamyat Compulsory</option></select> 
                                    <select id="sub2"  name="sub2" class="span3 dropdown">
                                            <option value="2">Pakistan Studies</option></select>
                                </div>
                            </div>    <div class="control-group">
                                <label class="control-label span1" for="name">
                                    
                                </label>
                                <div class="controls controls-row">
                                    <select id="sub1" class="span3 dropdown" name="sub1"></select> 
                                    <select id="sub2"  name="sub2" class="span3 dropdown">
                                            </select>
                                </div>
                            </div>    <div class="control-group">
                                <label class="control-label span1" for="name">
                                    
                                </label>
                                <div class="controls controls-row">
                                    <select id="sub1" class="span3 dropdown" name="sub1"></select> 
                                    <select id="sub2"  name="sub2" class="span3 dropdown">
                                            </select>
                                </div>
                            </div>
                        
                            <div class="form-actions no-margin">
                                <button type="submit" name="save" class="btn btn-large btn-info offset2" onclick="return validateForm();">
                                    Create Account
                                </button>
                                <input type="button" class="btn btn-large btn-danger" value="Cancel" onclick="window.location='index.php';" >
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
