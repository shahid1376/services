<div class="widget">
    <div class="widget-header">
        <div class="title">
            New Registration Form<a id="redgForm" data-original-title=""></a>
        </div>

    </div>
    <div class="widget-body">

        <form class="form-horizontal no-margin" action="<?php echo base_url(); ?>/index.php/Registration/Incomplete_inst_info_INSERT" method="post" >

            <div class="control-group">
                <h4 class="span4">Institute Information :</h4>
                <div class="controls controls-row">
                    <input type="hidden" class="span2 hidden" id="isReAdm" name="isReAdm" value="0">

                    <label class="control-label span2" >

                    </label> 

                </div>
            </div>
            <div class="control-group">

                <label id="ErrMsg" class="control-label span2" style=" text-align: left;"></label>
                <div class="controls controls-row">
                    <input class="span3 hidden"  type="text" placeholder="" >  
                    <label class="control-label span2">

                    </label> 
                    <input type="file" class="span4" id="image" style="display:none;" name="image" onchange="Checkfiles()">
                </div>
            </div>
            <?php


            if($field_status['emis']== 0 || !empty($fill_values['emis']))
            {
                ?> 
                <div class='control-group'>
                    <div class='controls controls-row'>
                        <label class='control-label span1' >
                            EMIS CODE:
                        </label>

                        <input class='span3' type='text' id='Info_emis' style='text-transform: uppercase;' name='Info_emis' placeholder='EMIS CODE' value="<?php if(!empty( $fill_values['emis'])) { echo $fill_values['emis']; } ?>"  required='required'>
                    </div>
                </div>;
                <?php }?>
            <?php
            if($field_status['email'] == 0 || !empty( $fill_values['email']))
            {?> 
                <div class='control-group'>

                    <div class='controls controls-row'>  <label class='control-label span1' style='text-transform: uppercase;' > Email Address:  </label> <input class='span3' type='text' id='Info_email' style='text-transform: uppercase;' name='Info_email' placeholder='Email Address' value="<?php if(!empty( $fill_values['email'])) { echo $fill_values['email'];  }?>" required='required'>
                    </div>
                </div>


                <?php }?>


            <?php
            if($field_status['phone'] == 0 || !empty( $fill_values['phone']))
            {
                ?>
                <div class='control-group'>

                    <div class='controls controls-row'>
                        <label class='control-label span1' for='lblfather_name'> Phone No. :  </label>  
                        <input class='span3' id='info_phone' name='info_phone' style='text-transform: uppercase;' type='text' placeholder="Father's Name"  required='required'  value="<?php if(!empty( $fill_values['phone'])) { echo $fill_values['phone'];  } ?>" >
                    </div>
                </div>
                <?php }?>
            <?php
            if($field_status['cell'] == 0 || !empty( $fill_values['cell']))
            {
                ?>

                <div class='control-group'>

                    <div class='controls controls-row'>  <label class='control-label span1' >  Cell No: </label>  <input class='span3' type='text' id='info_cellNo' name='info_cellNo' placeholder='MOBILE NUMBER'  required='required' value="<?php if(!empty( $fill_values['cell'])) { echo $fill_values['cell'];  }?>" >
                    </div>
                </div>         

                <?php }
            ?>



            <?php
            if($field_status['dist'] == 0)
            {
                echo " 
                <div class='control-group'>

                <div class='controls controls-row'> <label class='control-label span1' for='father_cnic'>  District : </label> 
                <select class='span3' id='info_dist' name='info_dist' required='required'>
                <option value='0'>SELECT DISTRICT</option>
                <option value='1'>GUJRANWALA</option>
                <option value='2'>GUJRAT</option>
                <option value='3'>HAFIZABAD</option>
                <option value='4'>MANDI BAHA-UD-DIN</option>
                <option value='5'>NAROWAL</option>
                <option value='6'>SIALKOT</option>
                </select>
                </div>
                </div>
                ";
            }
            ?>
            <?php
            if($field_status['teh'] == 0)
            {
                echo "      
                <div class='control-group'>
                <div class='controls controls-row'>  <label class='control-label span1' >   Tehsil : </label> 
                <select class='span3' id='info_teh' name='info_teh' required='required'>
                <option value='0'>SELECT TEHSIL</option>
                <option value='1'>KAMOKE</option>
                <option value='2'>GUJRANWALA</option>
                <option value='3'>WAZIRABAD</option>
                <option value='4'>NOWSHERA VIRKAN</option>
                <option value='5'>GUJRAT</option>
                <option value='6'>KHARIAN</option>
                <option value='7'>SARAI ALAMGIR</option>
                <option value='8'>HAFIZABAD</option>
                <option value='9'>PINDI BHATTIAN</option>
                <option value='10'>MANDI BAHA-UD-DIN</option>
                <option value='11'>PHALIA</option>
                <option value='12'>MALAKWAL</option>
                <option value='13'>NAROWAL</option>
                <option value='14'>SHAKARGARH</option>
                <option value='15'>SIALKOT</option>
                <option value='16'>PASRUR</option>
                <option value='17'>DASKA</option>
                <option value='18'>SAMBRIAL</option>
                <option value='19'>ZAFARWAL</option>
                </select>
                </div>
                </div>";

            }
            ?>



            <?php
            // DebugBreak();
            if($field_status['zone'] == 0)
            { ?>
                <div class='control-group'>
                    <div class='controls controls-row'>
                        <label class='control-label span2'>    Zone :  </label> 
                        <select class='span3' id='info_zone' name="info_zone" required='required'>
                            <option value='0'>SELECT ZONE</option>

                            <?php 
                            foreach($zone as $name) 
                            {?>
                                <option value="<?=$name['zone_cd']?>"><?=$name['zone_name']?></option>    
                                <?php 
                            } ?>
                        </select>
                    </div>
                </div> 
                <?php } ?>

            <div class="form-actions no-margin">
                <button type="submit" onclick="return Incomplete_inst_info_INSERT()" name="btnsubmitNewEnrol" class="btn btn-large btn-info offset2">
                    Save Information
                </button>

                <?php
                if(($field_status['cell'] != 0) && ($field_status['dist'] != 0) && ($field_status['teh'] != 0) && ($field_status['zone'] != 0) &&  ($field_status['emis'] != 0)  )
                {
                    echo " <input type='button' class='btn btn-large btn-danger' value='SKIP' onclick='return CancelAlert()' >";

                }

                ?>

                <div class="clearfix">
                </div>
            </div>
        </form>
    </div>  

</div>

<script type="text/javascript">
    function CancelAlert()
    {
        var msg = "Are You Sure You want to SKIP this Form ?"
        alertify.confirm(msg, function (e) {
            if (e) {
                // user clicked "ok"
                window.location.href ="<?php echo base_url(); ?>index.php/Registration/index/7";
            } else {
                // user clicked "cancel"

            }
        });
    }



</script>