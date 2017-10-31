<div class="dashboard-wrapper">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title" style="float: none !important;">
                            <label class="welcome_note myEngheading" style="float: left;">Download Section.</label>
                        </div>
                    </div>
                    <div class="widget-body">
                        <div id="dt_example" class="example_alt_pagination">
                            <div class="info"  style="position:relative;margin:0;padding:0;overflow:hidden;">
                                <!--FORM START-->
                                <form enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>NOC/statusPage_server" >
                            </div>
                            <div class="row" >
                                <div class="col-sm-12">
                                    <strong style=" font-size: 24px; text-align: center;">Please Enter Your Application No.</strong>
                                    <input type="text" id="appNo" name="appNo" style="text-align: left;">
                                </div>

                            </div>

                            <input type="submit" value="Check Status" id="btnchk" name="btnchk" class="jbtn jmedium jblack">
                            <input type="submit" value="Download Challan Form" id="btnDownloadForm" name="btnDownloadForm" class="jbtn jmedium jblack">
                            <input type="button" class="jbtn jmedium jblack" value="Cancel" id="btnCancel" name="btnCancel" onclick="return CancelAlert();" >

                            <?php 

                            if(@$ismigrated == "0")
                            {
                                ?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <br>
                                        <label style="color: blue; font-weight: bold; font-size: 24px;">Your Application is under process at BISE Gujranwala.</label>
                                    </div>
                                </div>   
                                <?php  }
                            else if(@$ismigrated == "1")
                            {
                                ?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <br>
                                        <label style="color: green; font-weight: bold; font-size: 24px;">Congratulations! Your Application Process is completed Successfully. Please Download Your Certificate.</label> <br>
                                        <br>

                                        <input type="submit" value="Download Certificate" id="btnNOC" name="btnNOC" class="jbtn jmedium jblack">
                                    </div>
                                </div> 

                                <?php 

                            }
                            else if(@$ismigrated == "2")
                            {
                                ?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <br>
                                        <label style="color: red; font-weight: bold; font-size: 24px;"><?php echo @$BiseAdminMsg; ?></label>
                                    </div>
                                </div> 
                                <?php   
                            }


                            ?>
                            </form>
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

    var formno = '<?php echo @$app_No; ?>';

    function CancelAlert()
    {
        var msg = "Are You Sure You want to Cancel this Form ?"
        alertify.confirm(msg, function (e) {
            if (e) {
                // user clicked "ok"
                window.location.href ='<?php echo base_url(); ?>noc';
            } else {
                // user clicked "cancel"
            }
        });
    }
</script>
