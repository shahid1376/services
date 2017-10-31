



<div class="dashboard-wrapper">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget no-margin">
                    <div class="widget-header">
                        <div class="title">
                            PRIVATE INFORMATION CORNER
                        </div>
                    </div>
                    <div class="widget-body">
                        <div class="row-fluid">
                            <div class="metro-nav">
                                <div class="metro-nav-block nav-block-yellow current">
                                    <a data-original-title="" href="http://www.bisegrw.com/">
                                        <div class="fs1" aria-hidden="true" data-icon=""></div>
                                        <div class="brand">
                                            Go to Main Website
                                        </div>
                                    </a>
                                </div>
                                <?php 
                                // DebugBreak();
                                for($i =0 ; $i<count($info); $i++) 
                                {

                                    if($i == 0 )
                                    {
                                        $color = 'green';
                                    }
                                    else  if($i == 1 )
                                    {
                                        $color = 'red';
                                    }
                                    else  if($i == 2 )
                                    {
                                        $color = 'blue';
                                    }
                                    else  if($i == 3 )
                                    {
                                        $color = 'orange';
                                    }
                                    else  if($i == 4 )
                                    {
                                        $color = 'green';
                                    }
                                    else  if($i == 5 )
                                    {
                                        $color = 'blue';
                                    }
                                    else  if($i == 6 )
                                    {
                                        $color = 'green';
                                    }
                                    else  if($i == 7 )
                                    {
                                        $color = 'blue';
                                    }
                                    else  if($i == 8 )
                                    {
                                        $color = 'green';
                                    }
                                    else  if($i == 9 )
                                    {
                                        $color = 'blue';
                                    }
                                    else  if($i == 10 )
                                    {
                                        $color = 'orange';
                                    }
                                    else
                                    {
                                        $color = 'green';
                                    }
                                    ?>
                                    <div class="metro-nav-block nav-block-<?=$color?>" style="height: 80px !important;">
                                        <a data-original-title="" href="<?= $info[$i]['url']?>" target="_blank">
                                            <div class="fs1" aria-hidden="true" data-icon=""></div>
                                            <div class="brand" style="    min-height: 50px !important">
                                                <?= $info[$i]['LinkName']?>
                                            </div>
                                        </a>
                                    </div>
                                    <?php }?>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid" style="margin-top: 20px;">
            <div class="span12">
                <div class="widget no-margin">
                    <div class="widget-header">
                        <div class="title">
                            INSTITUTION INFORMATION CORNER
                        </div>
                    </div>
                    <div class="widget-body">
                        <div class="row-fluid">
                            <div class="metro-nav">
                                <div class="metro-nav-block nav-block-yellow current">
                                    <a data-original-title="" href="http://www.bisegrw.com/">
                                        <div class="fs1" aria-hidden="true" data-icon=""></div>
                                        <div class="brand">
                                            Go to Main Website
                                        </div>
                                    </a>
                                </div>
                                <div class="metro-nav-block nav-block-red" style="height: 80px !important;">
                                    <a data-original-title="" href="http://ssc.bisegrw.com/" target="_blank">
                                        <div class="fs1" aria-hidden="true" data-icon=""></div>
                                        <div class="brand" style="    min-height: 50px !important">
                                            SSC Login Area
                                        </div>
                                    </a>
                                </div>
                                <div class="metro-nav-block nav-block-blue" style="height: 80px !important;">
                                    <a data-original-title="" href="http://hssc.bisegrw.com/" target="_blank">
                                        <div class="fs1" aria-hidden="true" data-icon=""></div>
                                        <div class="brand" style="    min-height: 50px !important">
                                            HSSC Login Area
                                        </div>
                                    </a>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>



    </div>
</div>
