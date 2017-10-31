jQuery(document).ready(function() {
	$("#image").change(function(){
		readURL(this);
	});		
    $("#MobNo").mask("0999-9999999", {
        placeholder: "_"
    });
	$("#fNic").mask("99999-9999999-9", {
		placeholder: "_"
	});

    var is_muslim = $('input:radio[name="rel"]:checked').val();
    var is_pakistani = $('input:radio[name="nat"]:checked').val();
    var id = $('#grp_cd').val();

    $('#std_group,.rel_class,.nationality_class').live('change keyup', function() {
        var is_muslim = $('input:radio[name="rel"]:checked').val();
        var is_pakistani = $('input:radio[name="nat"]:checked').val();
        var id = $('#grp_cd').val();
    });
    $("#image").change(function() {
        readURL(this);
    });
	
	$('#data-table').dataTable({
	  "sPaginationType": "full_numbers"
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

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#previewImg').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}