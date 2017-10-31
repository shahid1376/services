<div class="widget">
    <div class="widget-header">
        <div class="title">
            New Registration Form<a id="redgForm" data-original-title=""></a>
        </div>

    </div>
    <div class="widget-body">

        <form class="form-horizontal no-margin" action="<?php echo base_url(); ?>/index.php/Registration_11th/Incomplete_inst_info_INSERT" method="post" >

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
            
                <div class='control-group'>
                    <div class='controls controls-row'>
                        <label class='control-label span1' >
                            INSTITUTE CODE:
                        </label>

                        <input class='span3' type='text' id='Info_emis' style='text-transform: uppercase;' name='Info_emis' placeholder='EMIS CODE' value=""  required='required'>
                    </div>
                </div>;
               
          
                <div class='control-group'>

                    <div class='controls controls-row'>  <label class='control-label span1' style='text-transform: uppercase;' > FEEDING DATE:  </label> <input class='span3' type='text' id='Info_email' style='text-transform: uppercase;' name='Info_email' placeholder='Email Address' value="" required='required'>
                    </div>
                </div>


               


          
                <div class='control-group'>

                    <div class='controls controls-row'>
                        <label class='control-label span1' for='lblfather_name'> REGISTRATION FEE :  </label>  
                        <input class='span3' id='info_phone' name='info_phone' style='text-transform: uppercase;' type='text' placeholder="Father's Name"  required='required'  value="" >
                    </div>
                </div>
               
                <div class='control-group'>

                    <div class='controls controls-row'>  <label class='control-label span1' >  PROCESSING FEE: </label>  <input class='span3' type='text' id='info_cellNo' name='info_cellNo' placeholder='MOBILE NUMBER'  required='required' value="" >
                    </div>
                </div>         
  <div class='control-group'>

                    <div class='controls controls-row'>  <label class='control-label span1' >  SPECIAL FEE: </label>  <input class='span3' type='text' id='info_cellNo' name='info_cellNo' placeholder='MOBILE NUMBER'  required='required' value="" >
                    </div>
                </div>    
                  <div class='control-group'>

                    <div class='controls controls-row'>  <label class='control-label span1' >  ACTIVATED : </label>  <input class='span3' type='text' id='info_cellNo' name='info_cellNo' placeholder='MOBILE NUMBER'  required='required' value="" >
                    </div>
                </div>    
              
            <?php
            // DebugBreak();
           // if($field_status['zone'] == 0)
            //{ ?>
                <div class='control-group'>
                    <div class='controls controls-row'>
                        <label class='control-label span2'>    Zone :  </label> 
                        <select class='span3' id='info_zone' name="info_zone" required='required'>
                            <option value='0'>SELECT ZONE</option>

                            <?php 
                         //   foreach($zone as $name) 
                        //   {?>
                                <option value="<?php //$name['zone_cd'] ?>"><?php //$name['zone_name']?></option>    
                                <?php 
                          //} ?>
                        </select>
                    </div>
                </div> 
                <?php// } ?>

            <div class="form-actions no-margin">
                <button type="submit" onclick="return Incomplete_inst_info_INSERT()" name="btnsubmitNewEnrol" class="btn btn-large btn-info offset2">
                    Save Information
                </button>

                <?php
              // if(($field_status['cell'] != 0) && ($field_status['dist'] != 0) && ($field_status['teh'] != 0) && ($field_status['zone'] != 0) &&  ($field_status['emis'] != 0)  )
              //  {
               //     echo " <input type='button' class='btn btn-large btn-danger' value='SKIP' onclick='return CancelAlert()' >";

             //   }

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
