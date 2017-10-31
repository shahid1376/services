<!DOCTYPE html>
<!--[if lt IE 7]>

<html class="lt-ie9 lt-ie8 lt-ie7" lang="en">

<![endif]-->
<!--[if IE 7]>

<html class="lt-ie9 lt-ie8" lang="en">

<![endif]-->
<!--[if IE 8]>

<html class="lt-ie9" lang="en">

<![endif]-->
<!--[if gt IE 8]>
<!-->

<html lang="en">

<!--
<![endif]-->

<head>
    <meta charset="utf-8">
    <title>
        BISE GRW - BOARD OF INTERMEDIATE AND SECONDARY EDUCATION GUJRANWALA
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->

    <link href="<?php echo base_url(); ?>assets/css/icomoon/style.css" rel="stylesheet">
    <!--[if lte IE 7]>
    <script src="css/icomoon-font/lte-ie7.js">
    </script>
    <![endif]-->
    <link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet"> <!-- Important. For Theming change primary-color variable in main.css  -->

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/alertify.core.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.fancybox.css">


</head>
<body>
<div class="mPageloader">
    <div class="CSSspinner2 large">
        <div class="spinner-container container1">
            <div class="circle1"></div>
            <div class="circle2"></div>
            <div class="circle3"></div>
            <div class="circle4"></div>
        </div>
        <div class="spinner-container container2">
            <div class="circle1"></div>
            <div class="circle2"></div>
            <div class="circle3"></div>
            <div class="circle4"></div>
        </div>
        <div class="spinner-container container3">
            <div class="circle1"></div>
            <div class="circle2"></div>
            <div class="circle3"></div>
            <div class="circle4"></div>
        </div>
    </div>
</div>

<header style="position: relative;">
    <a href="#" >
        <img src="<?php echo base_url(); ?>assets/img/BISEGRW_Icon.png" alt="logo" style="width:auto; height: 92%;     float: left;" />
    </a>
    <div class="btn-group">
        <button class="btn btn-primary" style="margin-right: 17px;    font-size: 15px;" onclick="window.open('http://www.bisegrw.com')" /><?php  echo 'Home';?></button>
  
        <button class="btn btn-primary btntoggleapp" style="font-size: 15px;">
            <?php
            echo 'Modules';
            ?>
        </button>
        <button data-toggle="dropdown" class="btn btn-primary btntoggleapp dropdown-toggle" style="height: 30px;">
            <span class="caret">
            </span>
        </button>
        <ul class="dropdown-menu pull-right">
          
            <?php 
            // DebugBreak();
            for($i =0 ; $i<count($info); $i++) 
            {?>
            <li>
                <a href="<?= $info[$i]['url']?>">
                    <?= $info[$i]['LinkName']?>
                </a>
            </li> 
            <?php }?>
            <!-- <li>
            <a href="Profile/Profile.php">
            Account Settings
            </a>
            </li>-->
            
        </ul>

    </div>


</header>