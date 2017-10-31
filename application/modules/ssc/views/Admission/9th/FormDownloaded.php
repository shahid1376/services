<div class="dashboard-wrapper">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title" style="float: none !important;">
                            <label class="welcome_note myEngheading" style="float: left;">Please Download Your Admission Form.</label>
                        </div>
                    </div>
                    <div class="widget-body">
                        <div id="dt_example" class="example_alt_pagination">
                            <div class="info"  style="position:relative;margin:0;padding:0;overflow:hidden;">
                                <!--FORM START-->
                                <form enctype="multipart/form-data" id="ReturnStatus" name="ReturnStatus" method="post" action="<?php echo base_url(); ?>/index.php/Admission_9th_pvt/checkFormNo_then_download/<?php echo $msg; ?>/<?php echo $dob; ?>" >
                            </div>
                            <p>  <strong style=" font-size: 24px;"> Your Form No.<?php echo $msg; ?> </strong></p>
                            <input type="submit" value="Download" id="btnDownloadForm" class="jbtn jmedium jblack">
                            <input type="button" class="jbtn jmedium jblack" value="Cancel" id="btnCancel" name="btnCancel" onclick="return CancelAlert();" >
                            <div class="clearfix">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    var formno = '<?php echo @$msg; ?>';

    function CancelAlert()
    {
        var msg = "Are You Sure You want to Cancel this Form ?"
        alertify.confirm(msg, function (e) {
            if (e) {
                // user clicked "ok"
                window.location.href ='<?php echo base_url(); ?>Admission/';
            } else {
                // user clicked "cancel"
            }
        });
    }
</script>