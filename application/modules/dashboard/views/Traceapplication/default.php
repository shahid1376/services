
<form enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>index.php/Traceapplication/TraceFile">
    <?php
    @$info = $info[0];
    if(@$err['Error'])
    {
        ?>
        <div class="alert alert-danger fade in alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            <strong><?php echo $err['Error'] ?></strong>
        </div>
        <?php
    }
    ?>
    <div id="hideDiv1">
        <div class="form-group">    
            <div class="row">
                <div class="col-md-12">
                    <h3 align="center" class="bold">TRACE YOUR APPLICATION</h3>
                </div>
            </div>
        </div>
        <div class="form-group">    
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <div class="alert alert-info fade in alert-link">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"></a>
                        <strong>View your application status</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">    
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <label class="control-label" for="traceType">Select Trace By</label>
                    <select class="form-control" id="traceType" name="traceType">
                        <option value="0" <?php if(@$_POST['traceType'] == 0) echo 'selected' ?> >Select Your Tracing Type</option>
                        <option value="1" <?php if(@$_POST['traceType'] == 1) echo 'selected' ?> >By File Id</option>
                        <option value="2" <?php if(@$_POST['traceType'] == 2) echo 'selected' ?> >By One Window No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group" id="criteria1">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <label class="control-label" for="fileId">File No</label>
                    <input type="text" id="fileId" maxlength="10" value="<?php echo @$info['fileid']; ?>" name="fileId" class="form-control" >
                </div>
            </div>
        </div>
        <div class="form-group" id="criteria2">    
            <div class="row">
                <div class="col-md-offset-3 col-md-3">
                    <label class="control-label" for="owoNo">One Window No</label>
                    <input type="text" id="owoNo" maxlength="10" name="owoNo" value="<?php echo @$_POST['owoNo']; ?>" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="control-label" for="owoNo">One Window Date</label>
                    <input type="text" id="owoDate" name="owoDate" class="form-control"  value="<?php echo @$_POST['owoDate']; ?>" readonly="readonly">
                </div>
            </div>
        </div>
        <div class="form-group" id="buttonTrace">    
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <input type="submit" value="Check Status" id="btnchk" name="btnchk" class="btn btn-primary btn-block" onclick="return filedId(this)">
                </div>
            </div>
        </div>
    </div>
    <div id="showDiv1">
        <?php
        $colorClass = "";
        $Msg = "";

        if($info['Final_Status'] == "IN PROCESS")
        {
            $colorClass ="class='alert alert-danger fade in alert-dismissable'";
            $Msg = "Final Status : IN PROCESS";
        }
        else if($info['Final_Status']== "COMPLETED.")
        {
            $colorClass ="class='alert alert-success fade in alert-dismissable'";
            $Msg = "Final Status: APPLICATION COMPLETED";
        }

        if(isset($info['Final_Status']))
        {
            ?>
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
            <div class="form-group">    
                <div class="row">
                    <div class="col-md-offset-3 col-md-6">
                        <div class="alert alert-info fade in alert-dismissable" >
                            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"></a>
                            <strong>
                                Current Status:  <?php echo $info['Current_Status']; ?>
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
            <fieldset>
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-6">
                        <label  class="control-label">Applicant Name</label>
                        <input type="text" class="form-control" value="<?php echo $info['SubmittedBy'];  ?>" readonly="readonly">    
                    </div>
                </div>
                <?php
                if(@$_POST['owoNo'] != '')
                { ?>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-3">
                            <label  class="control-label">One Window No</label>
                            <input type="text" class="form-control" value="<?php echo @$info['OWO-No'];  ?>" readonly="readonly">    
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label  class="control-label">File Id</label>
                            <input type="text" class="form-control" value="<?php echo @$info['fileid'];  ?>" readonly="readonly">    
                        </div>
                    </div>
                    <?php
                }
                else{
                    ?>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-6">
                            <label  class="control-label">File Id</label>
                            <input type="text" class="form-control" value="<?php echo @$_POST['fileId'];  ?>" readonly="readonly">    
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-6">
                        <label class="control-label">File Name</label>
                        <input type="text" class="form-control" value="<?php echo $info['FileName'];  ?>" readonly="readonly">    
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-6">
                        <label class="control-label">Received Date</label>
                        <input type="text" class="form-control" value="<?php echo date($info['recivedDate']);  ?>" readonly="readonly">    
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-6">
                        <label  class="control-label">Current Branch Name</label>
                        <input type="text" class="form-control" value="<?php echo $info['br_Name'];  ?>" readonly="readonly">    
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-6">
                        <label class="control-label">Remarks</label>
                        <input type="text" class="form-control" value="<?php echo $info['Remarks'];  ?>" readonly="readonly">    
                    </div>
                </div>
            </fieldset> 
            <?php
        } 
        ?>
    </div>
    <?php
    if(isset($info)){
        ?>
        <div id="hideBtnPrint"> 
            <div class="form-group">
                <div class="col-md-offset-3 col-md-6">
                    <label  class="control-label"></label>
                    <input type="button" id="btnTracePrint" class="btn btn-primary btn-block" value="Print">    
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</form>
<script type="text/javascript">
    function filedId(){

        var traceType =  $("#traceType").val();
        var owoNo =  $("#owoNo").val();
        var owoDate =  $("#owoDate").val();
        var fileId = $('#fileId').val();

        if(traceType == 1 && fileId == ''){
            alertify.error('Frist Enter Application id');
            $('#fileId').focus();
            return false;
        }
        else if(traceType == 2 && owoNo == ''){
            alertify.error('Frist Enter One Window No');
            $('#owoNo').focus();
            return false;
        }

        else if(traceType == 2 && owoDate == ''){
            alertify.error('Frist Enter One Window Date');
            $('#owoDate').focus();
            return false;
        }
    }
</script>






