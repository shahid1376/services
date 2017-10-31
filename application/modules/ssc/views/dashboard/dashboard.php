<div class="dashboard-wrapper">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget no-margin">
                    <div class="widget-header">
                        <div class="title">
                            Main Dashboard
                        </div>
                    </div>
                    <div class="widget-body">

                        <div class="row-fluid">
                            <div class="metro-nav">
                                <div class="metro-nav-block nav-block-yellow current">
                                    <a href="" >
                                        <div class="fs1" aria-hidden="true" data-icon="&#xe0a0;"></div>
                                        <div class="brand">
                                            Main Dashboard
                                        </div>
                                    </a>
                                </div>
                               
                                <?php 

                                //  DebugBreak();
                                if($appconfig['isreg'] == 1) {?>
                                    <div class="metro-nav-block nav-block-orange">

                                        <a  href="<?=base_url().'ssc/';?>Registration" >
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                                            <div class="brand">
                                                9th Registration
                                            </div>
                                        </a>
                                    </div>

                                    <?php } 

                                if($appconfig['isadmP1'] == 1) {?>
                                    <div class="metro-nav-block nav-block-blue">

                                        <a  href="<?=base_url().'ssc/';?>Admission_9th_reg" >
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                                            <div class="brand">
                                                9th Admission
                                            </div>
                                        </a>
                                    </div>
                                    <?php }?>

                                <?php if($appconfig['isadmP2'] == 1) {?>
                                    <div class="metro-nav-block nav-block-green">

                                        <a  href="<?=base_url().'ssc/';?>Admission_matric" >
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                                            <div class="brand">
                                                10th Admission
                                            </div>
                                        </a>
                                    </div>
                                    <?php }

                                if($appconfig['isadmP2S'] == 1){
                                    ?>

                                    <div class="metro-nav-block nav-block-yellow">

                                        <a  href="<?=base_url().'ssc/';?>Admission_matric" >
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                                            <div class="brand">
                                                10th Supply Admission
                                            </div>
                                        </a>
                                    </div>


                                    <?php } if($appconfig['isslipP2'] == 1) {?>
                                    <div class="metro-nav-block nav-block-red">

                                        <a  href="<?=base_url().'ssc/';?>RollNoSlip/TenthStd" >
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

                                        <a href="<?php echo base_url().'ssc/'; ?>RollNoSlip/NinthStd">
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

                                        <a  href="<?=base_url().'ssc/';?>RollNoSlip/TenthStd" >
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe05c;"></div>
                                            <div class="brand">
                                                10th Supply Roll Number Slips
                                            </div>
                                        </a>
                                    </div>
                                    

                                    <?php }


                                if($appconfig['isresultP1'] == 1){

                                    ?>
                                      <div class="metro-nav-block nav-block-green">

                                        <a  href="<?=base_url().'ssc/';?>Result/dashboard9th" >
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                                            <div class="brand">
                                                9th Result Cards
                                            </div>
                                        </a>
                                    </div>
                                    
                                    <?php }

                                if($appconfig['isresultP2'] == 1){
                                    ?>
                                   
                                    
                                    <div class="metro-nav-block nav-block-blue">

                                        <a  href="<?=base_url().'ssc/';?>Result/dashboard10th" >
                                            <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                                            <div class="brand">
                                                10th Result Cards
                                            </div>
                                        </a>
                                    </div>

                                    
                                    
                                    <?php } 

                                if($appconfig['isresultP2S'] == 1){
                                    ?>
                                    <div class="metro-nav-block nav-block-yellow">
                                        <a  href"<?=base_url().'ssc/';?>Result/dashboard10th" >
                                        <div class="fs1" aria-hidden="true" data-icon="&#xe05c;"></div>
                                        <div class="brand">
                                            10th Supply Result Cards
                                        </div>
                                        </a>
                                    </div>

                                    <?php }?>


                            </div>
                        </div>

                        <div class="row-fluid">

                            <div class="span6">
                                <div class="widget no-margin">
                                    <div id="area_chart"></div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="widget">
                                    <div id="columnChart"></div>
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
