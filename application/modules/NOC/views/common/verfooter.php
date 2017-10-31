


<div id="footer" class="footer">
    &nbsp; &copy; 2017 BISE Gujranwala, All Rights Reserved. 
</div>  

</div>

<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.maskedinput.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/alertify.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/source/jquery.fancybox.pack.js"></script>    
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/source/jquery.fancybox.js"></script>    


<script type="text/javascript">

    $("#traceType").change(function(){

        var traceType =  $("#traceType").val();

        if(traceType == 0){
            $('#buttonTrace').hide();
            $('#criteria1').hide();
            $('#criteria2').hide();
            $("#owoNo").empty();
            $("#owoDate").empty();
            $("#fileId").empty();
            $("#showDiv1").hide();
            $("#hideBtnPrint").hide();
        }

        if(traceType == 1){
            $("#criteria2").hide();
            $("#owoNo").empty();
            $("#owoDate").empty();
            $("#criteria1").show();
            $("#buttonTrace").show();
            $("#showDiv1").hide();
            $("#hideBtnPrint").hide();
        }
        else if (traceType == 2){
            $("#criteria1").hide();
            $("#fileId").empty();
            $("#criteria2").show();
            $("#buttonTrace").show();
            $("#showDiv1").hide();
            $("#hideBtnPrint").hide();
        }
    });

    $( "#owoDate" ).datepicker(
        {
            dateFormat: 'yy-mm-dd'
            ,changeMonth: true,changeYear:true
            , yearRange: '-1:'
            ,maxDate: new Date()
    }).val();

    $("#btnTracePrint").click(function () {

        $("#showDiv1").show();
        $("#hideDiv1").hide();
        $("#hideBtnPrint").hide();

        window.print();

        $("#hideDiv1").show();
        $("#hideBtnPrint").show();

    });

    jQuery.fn.ForceNumericOnly =
    function()
    {
        return this.each(function()
            {
                $(this).keydown(function(e)
                    {
                        var key = e.charCode || e.keyCode || 0;
                        return (
                            key == 8 || 
                            key == 9 ||
                            key == 13 ||
                            key == 46 ||
                            key == 110 ||
                            key == 190 ||
                            (key >= 35 && key <= 40) ||
                            (key >= 48 && key <= 57) ||
                            (key >= 96 && key <= 105));
                });
        });
    };
    $(document).ready(function () {



        $('.mPageloader').hide();
        $('#instruction').hide();

        $('#buttonTrace').hide();
        $('#criteria1').hide();
        $('#criteria2').hide();

        $body = $("body");
        $("#MobNo").mask("9999-9999999",{placeholder:"_"});
        $("#MobNoHssc").mask("9999-9999999",{placeholder:"_"});
        $(document).on({
            ajaxStart: function() { $body.addClass("loading");    },
            ajaxStop: function() { $body.removeClass("loading"); }    
        });

        window.addDashes = function addDashes(f) {
            var r = /(\D+)/g,
            npa = '',
            nxx = '',
            last4 = '';
            f.value = f.value.replace(r, '');
            npa = f.value.substr(0, 3);
            nxx = f.value.substr(3, 3);
            last4 = f.value.substr(6, 4);
            f.value = npa + '-' + nxx + '-' + last4;
        }

        $("#sscrno, #appNo, #tsscrno, #Hsscrno").ForceNumericOnly();       
        function hideall() {
            $('#divSSC').hide();
            $('#divHSSC').hide();
            $('#divOtherinfo').hide();
        }
        $( "#sscdob" ).datepicker({ dateFormat: 'dd-mm-yy',changeMonth: true, changeYear: true, maxDate: new Date(2003, 7,1),yearRange: '1970:2003'}).val();

        $('#nocFor').change(function () {
            // debugger;
            var option = $('#nocFor').val();
            if (option == 1) {
                hideall();
                $('#divSSC').show();
                $('#divOtherinfo').show();
            }
            else if (option == 2) {
                hideall();
                $('#divHSSC').show();
                $('#divOtherinfo').show();
            }
            else if (option == 0) {
                hideall();
                $('#divSSC').hide();
                $('#divHSSC').hide();
                $('#divOtherinfo').hide();
            }
        });
    });
    function verifyRollNo(vClass,RollNO, vYear ,sess){

        jQuery.ajax({                    
            type: "POST",
            url: "<?php echo base_url(); ?>" + "Verification/VerifyRollNo",
            dataType: 'json',
            data: {vClass: vClass, RollNO: RollNO, vYear: vYear, sess: sess},                            
            success: function(json) {


                if(json.retData.length > 0)
                {   
                    if(vClass == 10) {                                               
                        $('#txtsscName').val(json.retData[0].name);                          
                        $('#txtsscObtMarks').val(json.retData[0].obt_mrk);                          
                        $('#txtsscName').attr('readonly', true);
                        $('#txtsscObtMarks').attr('readonly', true);
                        //$('#lblDisplyMessage').show();
                    }
                    if(vClass == 12) {                                               
                        $('#txtHsscName').val(json.retData[0].name);                          
                        $('#txtHsscObtMarks').val(json.retData[0].obt_mrk);                          
                        $('#txtHsscName').attr('readonly', true);
                        $('#txtHsscObtMarks').attr('readonly', true);

                    }
                }
                else{
                    $('#txtsscName').val('');                          
                    $('#txtsscObtMarks').val('');                   
                    $('#txtHsscName').val('');                          
                    $('#txtHsscObtMarks').val('');   

                    $('#txtsscName').attr('readonly', false);
                    $('#txtsscObtMarks').attr('readonly', false);  
                    $('#txtHsscName').attr('readonly', false);
                    $('#txtHsscObtMarks').attr('readonly', false);                                                        
                }

                if(vYear == 2000){                            
                    $('#rowAttachPicture').show();
                }    
            },                        
            error: function(request, status, error){
                alert(request.responseText);
            }
        });

    }   
    //------------------------file upload review-------------------------------

    function ValidateFileUpload(a,inputFile,fileReview) { 
        var fuData = document.getElementById(inputFile);
        var FileUploadPath = fuData.value;
        if (FileUploadPath == '') {
            alert("Please upload an image");
            jQuery(fileReview).removeAttr('src');
        } 
        else {
            var Extension = FileUploadPath.substring(
                FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
            if (Extension == "jpeg" || Extension == "jpg") {
                if (fuData.files && fuData.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(fileReview).attr('src', e.target.result);
                    }
                    reader.readAsDataURL(fuData.files[0]);
                }
            } 
            else {
                document.getElementById(inputFile).removeAttr('value');
                jQuery(fileReview).removeAttr('src');
                alert("Image only allows file types of JPEG. ");
                return false;
            }
        }
        var file_size = document.getElementById(inputFile)[0].files[0].size;
        if(file_size>30480) {                                    
            document.getElementById(inputFile).removeAttr('value');
            jQuery(fileReview).removeAttr('src');
            alert("File size can be between 30KB"); 
            return false;
        } 
    } 
    //------------------------end, file upload review-------------------------------

    $("#fileId").keypress(function (e) {
        var fileId = $("#fileId").val();    
        if(fileId.length >= 10 && (e.which != 13)) {
            alertify.error('You cannot enter more than 10 digits');
            return false;
        }
        else if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && (e.which != 13)) {
            alertify.error('Please Use Numaric keys Only');
            return false;
        }
    });

    // --------- validation of Info -------------------
    function check_validate()
    {
        var NOC_class = $("input[name='verFor']:checked").val();
        var matric_rno = $("#sscrno").val();  
        var inter_rno = $("#hsscrno").val();   
        var dob = $("#sscdob").val();   
        var ddlsscYear = $("#ddlsscYear").val();   
        var ddlsscSess = $("#ddlsscSess").val();   
        var ddlSscClass = $("#ddlSscClass").val();   
        var ddlsscBrd = $("#ddlsscBrd").val();
        var MobNo = $("#MobNo").val(); 
        if(matric_rno == "")
        {
            alertify.error("Please First Enter Roll Number.");
            $("#sscrno").val("").focus();
        }
        else if(dob == "")
        {
            alertify.error("Please Select DOB First.");
            $("#sscdob").val("").focus(); 
        } 
        else if(ddlsscYear == 0)
        {
            alertify.error("Please Select Year First.");  
            $("#ddlsscYear").val("0").focus(); 
            return false;
        } 
        else if(ddlsscSess == 0)
        {
            alertify.error("Please Select Session First.");  
            $("#ddlsscSess").focus();  
            return false; 
        }
        else if(ddlSscClass== 0)
        {
            alertify.error("Please Select Class First."); 
            $("#ddlSscClass").focus();
            return false;   
        }
        else if($("#MobNo").val().trim() == '')
        {
            alertify.error("Please Select Mobile Number First."); 
            $("#MobNo").val("").focus(); 
            return false;   
        }
        else if(ddlsscBrd == "0")
        {
            alertify.error("Please Select Migrated Board First.");
            $("#ddlsscBrd").focus();
            return false;
        }
        else if($('#terms').prop('checked')== false)
        {
            alertify.error("Please Accept the terms and Conditions Frist");
            $("#terms").focus();
            return false;
        }
        else
        {
            $('.mPageloader').show();
            check_ssc_NOC(matric_rno,ddlsscYear,ddlsscSess,ddlsscBrd,dob); 
            return true;
        }
    }

    $("#aTermsConditionsPopup").click(function()
        {
            $('#instruction').show();
            $.fancybox("#instruction");
    })
    $("#aTermsConditionsPopupHssc").click(function()
        {
            $('#instruction').show();
            $.fancybox("#instruction");
    })
    function check_hssc_validate()
    {
        var NOC_class = $("input[name='verFor']:checked").val();
        var matric_rno = $("#tsscrno").val();  
        var inter_rno = $("#Hsscrno").val();   
        var ddlsscYear = $("#ddlHsscYear").val();   
        var ddlsscSess = $("#ddlHsscSess").val();   
        var ddlsscBrd = $("#ddlHsscBrd").val(); 
        var ddlclass = $("#ddlHsscClass").val();
        if(matric_rno == "")
        {
            alertify.error("Please First Enter Matric Roll Number.");
            $("#tsscrno").focus();
            return false;
        }
        else if(inter_rno == 0)
        {
            alertify.error("Please First Enter Inter Roll Number.");   
            $("#Hsscrno").focus();
            return false;
        } 
        else if(ddlsscYear == 0)
        {
            alertify.error("Please Select Year First.");   
            $("#ddlHsscYear").focus();
            return false;
        } 
        else if(ddlsscSess == 0)
        {
            alertify.error("Please Select Session First.");    
            $("#ddlHsscSess").focus();
            return false;
        }

        else if(ddlclass == "0")
        {
            alertify.error("Please Select Inter Class First.");
            $("#ddlHsscClass").focus();
            return false;
        }

        else if($("#MobNoHssc").val().trim() == '')
        {
            alertify.error("Please Select Mobile Number First."); 
            $("#MobNoHssc").val("").focus(); 
            return false;   
        }

        else if(ddlsscBrd == "0")
        {
            alertify.error("Please Select Migrated Board First.");
            $("#ddlHsscBrd").focus();
            return false;
        }
        else if($('#termshssc').prop('checked')== false)
        {
            alertify.error("Please Accept the terms and Conditions Frist");
            $("#termshssc").focus();
            return false;
        }
        else
        {
            $('.mPageloader').show();
            check_hssc_NOC(matric_rno,inter_rno,ddlsscYear,ddlsscSess,ddlsscBrd,ddlclass); 
            return true;
        }
    }

    function check_downloand()
    {
        var appno = $("#appNo").val(); 
        var appno_alternate = $("#lblAppNo").val(); 
        if(appno == "")
        {
            appno = appno_alternate; 
            $("#appNo").val(appno); 
        }
        if(appno == "")
        {
            alertify.error("Please Provide Application No.");
            return false;
        }
        else if(appno <5)
        {
            alertify.error("Please Provide Correct Application No.");
            return false;
        }
        else
        {
            alertify.log("Please Wait for a while...")   
            return true;
        }


    }
    function check_downloand_NOC()
    {
        var appno = $("#appNo").val(); 
        var appno_alternate = $("#lblAppNo").text(); 
        if(appno == "")
        {
            appno = appno_alternate; 
            $("#appNo").val(appno); 
        }
        if(appno == "")
        {
            alertify.error("Please Provide Application No.");
            return false;
        }
        else if(appno <5)
        {
            alertify.error("Please Provide Correct Application No.");
            return false;
        }
        else
        {
            alertify.log("Please Wait for a while...")   
            return true;
        }
    }
    $("#DownloadNOC").click(function(){
        var appno = $("#appNo").val(); 
        var appno_alternate = $("#lblAppNo").text(); 
        if(appno == "")
        {
            appno = appno_alternate; 
            $("#appNo").val(appno); 
        }
        if(appno == "")
        {
            alertify.error("Please Provide Application No.");
            return false;
        }
        else if(appno <5)
        {
            alertify.error("Please Provide Correct Application No.");
            return false;
        }
        else
        {
            alertify.log("Please Wait for a while...")   
            window.location.href = '<?=base_url()?>NOC/Download_NOC/'+appno;
        }
    })

    function activateButton(element) {

        if(element.checked) {
            $("input[type=submit]").attr("disabled", "enabled");
        }
        else  {
            $("input[type=submit]").attr("disabled", "disabled");
        }
    }
    function check_ssc_NOC(rno,year,sess,migto,dob,matclass)
    {
        var noc_html = "";
        var Mesg = "";
        var Mesg_server = "";
        var alldata ;
        var MobNo = $("#MobNo").val();
        jQuery.ajax({ 

            type: "POST",
            url: "<?php echo base_url(); ?>" + "NOC/get_ssc_data",
            dataType: 'json',
            data: {rno: rno, year: year, sess: sess, brd:migto, dob:dob,class:matclass,Mobno:MobNo},                            
            success: function(json) {


                Mesg = json[0][0]['Mesg'];
                Mesg_server = json[0][0]['Mesg_server'];
                if(Mesg_server != "")
                {
                    alertify.error(Mesg_server);
                    $('.mPageloader').hide();
                }
                else
                {
                    $('.mPageloader').hide();
                    noc_html = "";
                    noc_html += "<div class = 'row-fluid'><div class = 'col-sm-offset-4 class='col-sm-6'><img style='width:80px; height: 80px;' class='img-rounded' src ='"+json[0][0]['PicPath']+"'></div><div class='row'><div class='col-sm-4'>Name</div><div class='col-sm-6'><strong>"+json[0][0]['name']+"</strong></div></div>";
                    noc_html += "<div class='row'><div class='col-sm-4'>Father's' Name</div><div class='col-sm-6'><strong>"+json[0][0]['Fname']+"</strong></div></div>" ;
                    noc_html += "<div class='row'><div class='col-sm-4'>DOB</div><div class='col-sm-6'><strong>"+json[0][0]['dob']+"</strong></div></div></div>";
                    if(Mesg == "")
                    {
                        $( "#dialog-confirm" ).html(noc_html);  
                        $( "#dialog-confirm" ).dialog({
                            resizable: false,
                            height: "auto",
                            width: 450,
                            modal: true,
                            buttons: {

                                "Confirm and Apply": function() { 

                                    $('.mPageloader').show();
                                    jQuery.ajax({                    
                                        type: "POST",
                                        url: "<?php echo base_url(); ?>" + "NOC/Insert_ssc_data",
                                        dataType: 'json',
                                        data: {rno: rno, year: year, sess: sess, migto: migto,dob:dob,Mobno:MobNo},                            
                                        success: function(json) {
                                            $('.mPageloader').hide();
                                            $( "#dialog-confirm" ).html('<div style="color:Green; font-weight:bold; font-size:16px;">Your Application is submitted Successfully</div>'); 
                                            window.location.href = '<?php echo base_url(); ?>NOC/downloadPage/'+json[0][0]['app_No']+'/';
                                            $(".ui-button-text").css("display", "none");
                                        },
                                        error: function(request, status, error){
                                            $('.mPageloader').hide();
                                            $( "#dialog-confirm" ).html('<div style="color:RED; font-weight:bold; font-size:16px;">Your Application is NOT submitted. Please Try again later.</div>');
                                            alert(request.responseText);
                                        }
                                    });
                                }, 
                                Cancel: function() {
                                    $('.mPageloader').hide();
                                    $( this ).dialog( "close" );
                                }
                            }
                        });   
                    }
                    else
                    {
                        $( "#dialog-message" ).html(Mesg);

                        $( "#dialog-message" ).dialog({
                            modal: true,
                            height: "auto",
                            width: 500,
                            buttons: {
                                Ok: function() {

                                    $( this ).dialog( "close" );
                                }
                            }
                        });
                        return;
                    }  
                }

            },                        
            error: function(request, status, error){
                alert(request.responseText);
            }
        });

    }
    function check_hssc_NOC(matric_rno,rno,year,sess,migto,intclass)
    {
        var noc_html = "";
        var Mesg = "";
        var Mesg_server = "";
        var alldata ;
        jQuery.ajax({ 

            type: "POST",
            url: "<?php echo base_url(); ?>" + "NOC/get_hssc_data",
            dataType: 'json',
            data: {rno: rno, year: year, sess: sess, brd:migto, matrno:matric_rno, int_class:intclass},                            
            success: function(json) {

                Mesg = json[0][0]['Mesg'];
                Mesg_server = json[0][0]['Mesg_server'];
                Matched = json[0][0]['matched']; 

                if(Mesg_server != "")
                {
                    alertify.error(Mesg_server);
                    $('.mPageloader').hide();
                }
                else if(Matched == 0)
                {
                    $( "#dialog-message" ).html(Mesg);

                    $( "#dialog-message" ).dialog({
                        modal: true,
                        height: "auto",
                        width: 500,
                        buttons: {
                            Ok: function() {

                                $( this ).dialog( "close" );
                            }
                        }
                    });
                    return; 
                }
                else if(Matched == 1)
                {
                    $('.mPageloader').hide();
                    var gend = json[0][0]['Gender'];
                    var lblgend = "";
                    if (gend == 1 || gend == 0)
                    {
                        lblgend = "MALE";
                    }
                    else 
                    {
                        lblgend = "FEMALE";
                    }
                    noc_html = "";
                    noc_html += "<div class='row'><div class='col-md-offset-5 col-md-6'><img style='width:80px; height: 80px;' class='img-responsive'  src ='"+json[0][0]['PicPath']+"'></div></div>";
                    noc_html += "<div class='row'><div class='col-md-3'>Name</div><div class = 'col-md-9'><strong>"+json[0][0]['name']+"</strong></div></div>";
                    noc_html += "<div class='row'><div class='col-md-3'>Father's Name </div><div class = 'col-md-9'><strong>"+json[0][0]['Fname']+"</strong></div></div>" ;
                    noc_html += "<div class='row'><div class='col-md-3'>Gender</div><div class = 'col-md-9'><strong>"+lblgend+"</strong> </div></div>";
                    if(Mesg == "")
                    {
                        $( "#dialog-confirm" ).html(noc_html);  
                        $( "#dialog-confirm" ).dialog({
                            resizable: false,
                            height: "auto",
                            width: 600,
                            modal: true,
                            buttons: {

                                "Confirm and Apply": function() { 

                                    $('.mPageloader').show();
                                    jQuery.ajax({                    
                                        type: "POST",
                                        url: "<?php echo base_url(); ?>" + "NOC/Insert_hssc_data",
                                        dataType: 'json',
                                        data: {rno: rno, year: year, sess: sess, migto: migto,matrno:matric_rno,intclass:intclass},                            
                                        success: function(json) {
                                            $('.mPageloader').hide();
                                            $( "#dialog-confirm" ).html('<div style="color:Green; font-weight:bold; font-size:16px;">Your Application is submitted Successfully</div>'); 
                                            window.location.href = '<?php echo base_url(); ?>NOC/downloadPage/'+json[0][0]['app_No']+'/';
                                            $(".ui-button-text").css("display", "none");
                                        },
                                        error: function(request, status, error){
                                            $('.mPageloader').hide();
                                            $( "#dialog-confirm" ).html('<div style="color:RED; font-weight:bold; font-size:16px;">Your Application is NOT submitted. Please Try again later.</div>');
                                            alert(request.responseText);
                                        }
                                    });

                                }, 
                                Cancel: function() {
                                    $('.mPageloader').hide();
                                    $( this ).dialog( "close" );
                                }
                            }
                        });   
                    }
                    else
                    {
                        $( "#dialog-message" ).html(Mesg);

                        $( "#dialog-message" ).dialog({
                            modal: true,
                            height: "auto",
                            width: 500,
                            buttons: {
                                Ok: function() {

                                    $( this ).dialog( "close" );
                                }
                            }
                        });
                        return;

                    }  
                }

            },                        
            error: function(request, status, error){
                alert("an Error occoured : " + request.responseText);
            }
        });
    }
</script>        
</body>
</html>