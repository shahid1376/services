<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title">
                            Batch Release Form<a id="redgForm" data-original-title=""></a>
                        </div>

                    </div>
                    <div class="widget-body">

                        <form class="form-horizontal no-margin" action="<?php echo base_url(); ?>/index.php/Registration/Batchlist_INSERT" method="post" >

                            <div class="control-group">
                                <h4 class="span4"></h4>
                                <div class="controls controls-row">
                                    <input type="hidden" class="span2 hidden" id="isReAdm" name="isReAdm" value="0">

                                    <label class="control-label span2" >

                                    </label> 

                                </div>
                            </div>


                            <div class='control-group'>
                                <div class='controls controls-row'>
                                    <label class='control-label span1' >
                                        Batch Id:
                                    </label>

                                    <input class='span3' type='text' readonly="readonly" id='batch_real_Id' style='text-transform: uppercase;' name='batch_real_Id' placeholder=' BATCH ID' value="<?php  if(!empty($batchId)) { echo  $batchId; } ?>" required='required'>
                                </div>
                            </div>

                            <div class='control-group'>

                                <div class='controls controls-row'>  <label class='control-label span1'  > Reason :  </label> <textarea cols="50" rows="4" class='span3' id='batch_real_reason' style='text-transform: uppercase;' name='batch_real_reason' placeholder='Give strong reason' ><?php if(!empty( $reason)) { echo  $reason; } ?></textarea>  
                                </div>
                            </div>

                            <div class='control-group'>

                                <div class='controls controls-row'>
                                    <label class='control-label span1' for=''> Bank Branch :  </label>  
                                    <select class='span3' id='batch_real_bankbranch' name='batch_real_bankbranch' required='required'>
                                        <option value='0'>SELECT BRANCH</option>
                                        <optgroup label='GUJRANWALA'>
                                        <option value='BISE BR - 1993'>BISE BR</option>
                                        <option value='Bank Squair - 109'>Bank Squair</option>
                                        <option value='Kamoke - 178'>Kamoke</option>
                                        <option value='Dhilanwali - 263'>Dhilanwali</option>
                                        <option value='Tufail Shaheed  - 407'>Tufail Shaheed </option>
                                        <option value='Wazirabad  - 464'>Wazirabad </option>
                                        <option value='Qila Didar Singh - 493'>Qila Didar Singh</option>
                                        <option value='Rahwali - 518'>Rahwali</option>
                                        <option value='Eminabad - 561'>Eminabad</option>
                                        <option value='Noshera Wirkan - 582'>Noshera Wirkan</option>
                                        <option value='G.T. Road - 682'>G.T. Road</option>
                                        <option value='College Road - 698'>College Road</option>
                                        <option value='Wandho - 924'>Wandho</option>
                                        <option value='Satellite Town - 930'>Satellite Town</option>
                                        <option value='Khiali - 952'>Khiali</option>
                                        <option value='Ghakhar - 1049'>Ghakhar</option>
                                        <option value='Khokherki - 1061'>Khokherki</option>
                                        <option value='Mandiala Tega - 1095'>Mandiala Tega</option>
                                        <option value='Alipur Chatha - 1349'>Alipur Chatha</option>
                                        <option value='Gondalawala - 1407'>Gondalawala</option>
                                        <option value='Model Town - 1429'>Model Town</option>
                                        <option value='Kalaske - 1719'>Kalaske</option>
                                        <option value='Dilawar Cheema - 1895'>Dilawar Cheema</option>
                                        <option value="Peoples's - 2356">Peoples's</option>
                                        <option value='Tatley Aali - 2371'>Tatley Aali</option>
                                        <optgroup label='HAFIZABAD'>
                                        <option value='Hafizabad - 183'>Hafizabad</option>
                                        <option value='Jalalpur Bhattian - 626'>Jalalpur Bhattian</option>
                                        <option value='Sukheke Mandi - 1195'>Sukheke Mandi</option>
                                        <option value='Pindi Bhatian - 1418'>Pindi Bhatian</option>
                                        <option value='GRW Road HFD - 2333'>GRW Road HFD</option>
                                        <optgroup label='GUJRAT'>
                                        <option value='Circular Road - 111'>Circular Road</option>
                                        <option value='Guliana - 257'>Guliana</option>
                                        <option value='Gharib Pura - 290'>Gharib Pura</option>
                                        <option value='Kharian - 378'>Kharian</option>
                                        <option value='Harriawala - 385'>Harriawala</option>
                                        <option value='Jalalpur Jattan - 396'>Jalalpur Jattan</option>
                                        <option value='Lalamusa - 466'>Lalamusa</option>
                                        <option value='Doulat Nagar - 592'>Doulat Nagar</option>
                                        <option value='Sara I Alamgir - 658'>Sara I Alamgir</option>
                                        <option value='Mangowal - 823'>Mangowal</option>
                                        <option value='Kotla - 957'>Kotla</option>
                                        <option value='Pero Shah - 1010'>Pero Shah</option>
                                        <option value='Mandir - 1045'>Mandir</option>
                                        <option value='Dinga - 1064'>Dinga</option>
                                        <option value='Narowali - 1170'>Narowali</option>
                                        <option value='Awan Sharif - 1175'>Awan Sharif</option>
                                        <option value='Pakistan Chowk - 1231'>Pakistan Chowk</option>
                                        <option value='Aadowal - 1370'>Aadowal</option>
                                        <option value='Kalra Khasa - 1420'>Kalra Khasa</option>
                                        <option value='G.T. Road - 1449'>G.T. Road</option>
                                        <option value='Fasil Gate - 1451'>Fasil Gate</option>
                                        <option value='Kunjah - 1622'>Kunjah</option>
                                        <option value='Tanda Mota - 1685'>Tanda Mota</option>
                                        <option value='Sara I Alamgir - 2222'>Sara I Alamgir</option>
                                        <option value='Mahloo Khokhar - 2296'>Mahloo Khokhar</option>
                                        <option value='Karianwala - 5011'>Karianwala</option>
                                        <optgroup label='M.B.DIN'>
                                        <option value='M.B.Din - 177'>M.B.Din</option>
                                        <option value='Mangat - 303'>Mangat</option>
                                        <option value='Gojra - 560'>Gojra</option>
                                        <option value='Hellan - 1375'>Hellan</option>
                                        <option value='Malakwal - 1623'>Malakwal</option>
                                        <option value='Head Faqerian - 1705'>Head Faqerian</option>
                                        <option value='Pahrianwali - 2351'>Pahrianwali</option>
                                        <option value='Phalia - 1989'>Phalia</option>

                                        <optgroup label='NAROWAL'>
                                        <option value='Shakargarh - 260'>Shakargarh</option>
                                        <option value='Talwandi Bhindran - 637'>Talwandi Bhindran</option>
                                        <option value='Narowal - 836'>Narowal</option>
                                        <option value='Ahmad Abad - 852'>Ahmad Abad</option>
                                        <option value='Darman - 978'>Darman</option>
                                        <option value='Baddomalhi - 1405'>Baddomalhi</option>
                                        <option value='Noor Kot - 1474'>Noor Kot</option>
                                        <option value='Zafarwal - 1805'>Zafarwal</option>
                                        <option value='Pindi Bohri - 1842'>Pindi Bohri</option>

                                        <optgroup label='SIALKOT'>
                                        <option value='Mubarik Pura - 291'>Mubarik Pura</option>
                                        <option value='Fatehgarh - 308'>Fatehgarh</option>
                                        <option value='Daska - 406'>Daska</option>
                                        <option value='Sambrial - 425'>Sambrial</option>
                                        <option value='Kour Pur - 492'>Kour Pur</option>
                                        <option value='Begowala - 1480'>Begowala</option>
                                        <option value='Chawinda - 566'>Chawinda</option>
                                        <option value='Siranwali - 808'>Siranwali</option>
                                        <option value='Jamke Cheema - 895'>Jamke Cheema</option>
                                        <option value='Circular Road - 969'>Circular Road</option>
                                        <option value='Pasrur - 1084'>Pasrur</option>
                                        <option value='Head Marala - 1127'>Head Marala</option>
                                        <option value='Small Ind Estate - 1285'>Small Ind Estate</option>
                                        <option value='Rang Pura - 1619'>Rang Pura</option>
                                        <option value='Ugokee - 1773'>Ugokee</option>
                                        <option value='Data Zaidka - 1943'>Data Zaidka</option>
                                        <option value='Chobara - 1002'>Chobara</option>
                                    </select>

                                </div>
                            </div>
                            <div class='control-group'>
                                <div class='controls controls-row'>
                                    <label class='control-label span1' >
                                        Bank Challan :
                                    </label>

                                    <input class='span3' type='number' step="1" maxlength="9"  id='batch_real_challanno' style='text-transform: uppercase;' name='batch_real_challanno' placeholder=' BANK CHALLAN NO.' value=" <?php  if(!empty($challan)) { echo  $challan; } ?>"  required='required'>
                                </div>
                            </div>
                            <div class='control-group'>

                                <div class='controls controls-row'>  <label class='control-label span1' >  Paid Amount: </label>  <input class='span3' type='number' id='batch_real_PaidAmount' name='batch_real_PaidAmount' placeholder='Paid Amount'   value="<?php if(!empty(  $amount)) { echo  $amount; } ?>" >
                                </div>
                            </div>         
                            <div class='control-group'>

                                <div class='controls controls-row'>  <label class='control-label span1' >  Paid Date: </label>  <input class='span3' type='text' readonly="readonly" id='batch_real_PaidDate' name='batch_real_PaidDate' placeholder='Paid Date'  required='required' value="<?php if(!empty($date)) { echo  $date; } ?>" >
                                </div>
                            </div>         









                            <div class="form-actions no-margin">
                                <button type="submit" onclick="return BatchRelease_INSERT()" name="btnsubmitBatchRelease" class="btn btn-large btn-info offset2">
                                    Apply
                                </button>

                                <?php

                                echo " <input type='button' class='btn btn-large btn-danger' value='Cancel' onclick='return CancelAlert()' >";



                                ?>

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
<script type="text/javascript">
    function CancelAlert()
    {
        var msg = "Are You Sure You want to Cancel this Form ?"
        alertify.confirm(msg, function (e) {
            if (e) {
                // user clicked "ok"
                window.location.href ="<?php echo base_url(); ?>index.php/Registration/Batchlist";
            } else {
                // user clicked "cancel"

            }
        });
    }



</script>