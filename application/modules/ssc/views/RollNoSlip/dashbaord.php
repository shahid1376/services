<div class="dashboard-wrapper">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget no-margin">
                    <div class="widget-header">
                        <div class="title">
                            Roll Number Slips Dashboard
                        </div>
                    </div>
                    <div class="widget-body">

                         <h4>Welcome to Board of Intermediate &amp; Secondary Education, GUJRANWALA</br></h4>
                    
                    <hr/>
                        <div class="row-fluid">
                            <div class="metro-nav">


                                <?php 

                                //  DebugBreak();
                                if($appconfig['isslipP2'] == 1) {?>
                                    <div class="metro-nav-block nav-block-red">

                                        <a  href="<?=base_url();?>RollNoSlip/TenthStd" >
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe05c;"></div>
                                            <div class="brand">
                                                10th Roll Number Slips
                                            </div>
                                        </a>
                                    </div>
                                    <?php } 
                                if($appconfig['isslipP1'] == 1){
                                    ?>
                                   <div class="metro-nav-block nav-block-red">

                                        <a  href="<?=base_url();?>RollNoSlip/NinthStd" >
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe05c;"></div>
                                            <div class="brand">
                                                9th Roll Number Slips
                                            </div>
                                        </a>
                                    </div>
                                    <?php }

                                if($appconfig['isslipP2S'] == 1) {
                                    ?>

                                    <div class="metro-nav-block nav-block-yellow">

                                        <a  href="<?=base_url();?>RollNoSlip/TenthStd" >
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe05c;"></div>
                                            <div class="brand">
                                                10th Supply Roll Number Slips
                                            </div>
                                        </a>
                                    </div>

                                    <?php }?>


                            </div>
                        </div>
                        <hr/>
                        <div class="row-fluid">

                            <div id="smallRight" style="    float: left;margin-left: 20px;    margin-right: 245px;">
                                <h4>Information</h4>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td style="border: none;padding: 4px;">Institute ID :</td>
                                            <td style="border: none;padding: 4px;"><b><?php  echo $Inst_Id ?></b></td>
                                        </tr>
                                        <tr>
                                            <td style="border: none;padding: 4px;">Institute Name :</td>
                                            <td style="border: none;padding: 4px;"><b><?php
                                                    echo $inst_Name     
                                                ?></b></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>





<!--
<script type="text/javascript" async="async" defer="defer" data-cfasync="false" src="https://mylivechat.com/chatinline.aspx?hccid=93646887"></script>
-->


