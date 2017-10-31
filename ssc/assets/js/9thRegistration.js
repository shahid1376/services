function Checkfiles()
{
    var fup = document.getElementById('image');
    var fileName = fup.value;
    //  alert('File Name is = '+ fileName);
    var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
    if(ext == "jpg" )
    {
        return true;
    } 
    else
    {
        alert("Upload  .jpg images only");
        fup.value = null;
        fup.focus();
        return false;
    }
}


$(function() {

    //$( "#dob" ).datepicker({ dateFormat: 'dd-mm-yy',changeMonth: true, changeYear: true }).val();
    //$("#dateofadmission" ).datepicker({ dateFormat: 'dd-mm-yy',changeMonth: true, changeYear: true }).val();
});

jQuery(document).ready(function(){    
    $("#registration").validate();
    $("#cand_name").focus();
    /*
    ===========================================
    MASKINGS Settings
    ===========================================
    */
    $("#bay_form,#father_cnic").mask("99999-9999999-9",{placeholder:"_"});
    $("#dob,#dateofadmission").mask("99-99-9999",{placeholder:"_"});
    $("#mob_number").mask("9999-9999999",{placeholder:"_"});
    /*
    ===========================================
    Ajax and Validations
    ===========================================
    */
    var nationality = $('input:radio[name="nationality"]:checked').val();
    if(nationality == 1) {
        $("#bay_form","#father_cnic").mask("99999-9999999-9",{placeholder:"_"});
    }else{
        $("#bay_form","#father_cnic").mask("****************************",{placeholder:""});
    }

    $('input:radio[name="nationality"]').change(function(){
        if($(this).val() == 1) {
            $("#father_cnic").mask("99999-9999999-9",{placeholder:"_"});
            $("#bay_form").mask("99999-9999999-9",{placeholder:"_"});
        }else{
            //$("#father_cnic").mask("****************************",{placeholder:""});
            $("#father_cnic").unmask();
            $("#bay_form").unmask();
        }
    });

    var is_muslim    = $('input:radio[name="religion"]:checked').val();  
    var gender       = $('input:radio[name="gender"]:checked').val();  
    var is_pakistani = $('input:radio[name="nationality"]:checked').val(); 
    var id           = $('#std_group').val();

    $.ajax({
        type: 'post',
        url: "ajax.php",
        data: 'fetch_subjects='+id+'&is_muslim='+is_muslim+'&is_pakistani='+is_pakistani+'&Gender='+gender,
        success: function (data) {
            $(".subjects_section").html(data);
        }

    });


    $('#std_group,.rel_class,.nationality_class').live('change keyup',function(){
        var is_muslim    = $('input:radio[name="religion"]:checked').val();  
        var gender       = $('input:radio[name="gender"]:checked').val();              
        var is_pakistani = $('input:radio[name="nationality"]:checked').val(); 
        var id           = $('#std_group').val();
        //    alert('gender'+ gender);
        $.ajax({
            type: 'post',
            url: "ajax.php",
            data: 'fetch_subjects='+id+'&is_muslim='+is_muslim+'&is_pakistani='+is_pakistani+'&Gender='+gender,
            success: function (data) {
                $(".subjects_section").html(data);
            }

        });
    });

    $("#image").change(function(){
        readURL(this);
    });        

});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#previewImg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
} 
