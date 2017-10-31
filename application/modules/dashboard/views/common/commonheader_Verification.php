<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>


<head>
    <title>NOC | BISEGRW</title>
    <meta charset="utf-8">
    <link rel="icon" href="<?php echo base_url(); ?>assets/img/headericon.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/alertify.core.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/source/jquery.fancybox.css">

    <style>
        /* progress bar */
        #progress-wrp {
            border: 1px solid #0099CC;
            padding: 1px;
            position: relative;
            border-radius: 3px;
            margin-bottom: 25px;
            text-align: left;
            background: #fff;
            width:140px;
            height: 25px;
            box-shadow: inset 1px 3px 6px rgba(0, 0, 0, 0.12);
        }
        #progress-wrp .progress-bar{
            height: 20px;
            border-radius: 3px;
            background-color: #337ab7;
            width: 0;
            box-shadow: inset 1px 1px 10px rgba(0, 0, 0, 0.11);
        }
        #progress-wrp .status{
            top:2px;
            left:45%;
            position:absolute;
            display:inline-block;
            color: black;
            font-weight: bolder;
        }
        /*End progress bar */

        /* Horizontal Line Styling */
        .colorgraph 
        {
            height: 5px;
            border-top: 0;
            background: #c4e17f;
            border-radius: 5px;
            background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
            background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
            background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
            background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
        }
        /* End Horizontal Line Styling */

        /* Check box styling */
        input[type=checkbox]
        {
            -ms-transform: scale(2);
            -moz-transform: scale(2);
            -webkit-transform: scale(2); 
            -o-transform: scale(2); 
        }

        h3 {
            text-decoration: underline;
        }
        /*End Check box styling */

        .footer{width:100%; float:right; background:#003a6a ; height:40px; color: wheat; margin-top: 25px; margin-bottom: 3px; border-radius: 4px; text-align: center;}

        .mPageloader, .mpOverlay { position: fixed; width: 100%; height: 100%; background: rgba(0,0,0,.3); top: 0; left: 0; z-index: 99999; overflow: hidden; }
        .CSSspinner2 { width: 22px; height: 20px; position: relative; margin: 0 auto; display: inline-block; vertical-align: middle; }
        .CSSspinner2.large { width: 100px; height: 100px; margin: 15px; }
        .container1 > div, .container2 > div, .container3 > div { width: 6px; height: 6px; background-color: #fff; border-radius: 100%; position: absolute; -webkit-animation: bouncedelay 1.2s infinite ease-in-out; animation: bouncedelay 1.2s infinite ease-in-out; -webkit-animation-fill-mode: both; animation-fill-mode: both; }
        .mloader.CSSspinner2 > div > div { background: #d9d9d9; }
        .mloader.a { position: absolute; bottom: 8%; left: 50%; margin-left: -10px; }
        .CSSspinner2.grey .container1 > div.CSSspinner2.grey .CSSspinner2.grey .container3 > div { background: #d9d9d9; }
        .CSSspinner2.large .container1 > div, .CSSspinner2.large .container2 > div, .CSSspinner2.large .container3 > div { width: 20px; height: 20px; }
        .mPageloader .CSSspinner2.large { position: absolute; top: 50%; left: 50%; margin-left: -40px; margin-top: -40px; z-index: 9999; }
        .CSSspinner2.medium { width: 40px; height: 40px; }
        .CSSspinner2.medium > div > div { width: 10px; height: 10px; }
        .CSSspinner2.medium.grey > div > div { background-color: #eee; }
        .CSSspinner2 .spinner-container { position: absolute; width: 100%; height: 100%; }
        .container2 { -webkit-transform: rotateZ(45deg); transform: rotateZ(45deg); }
        .container3 { -webkit-transform: rotateZ(90deg); transform: rotateZ(90deg); }
        .circle1 { top: 0; left: 0; }
        .circle2 { top: 0; right: 0; }
        .circle3 { right: 0; bottom: 0; }
        .circle4 { left: 0; bottom: 0; }
        .container2 .circle1 { -webkit-animation-delay: -1.1s; animation-delay: -1.1s; }
        .container3 .circle1 { -webkit-animation-delay: -1s; animation-delay: -1s; }
        .container1 .circle2 { -webkit-animation-delay: -.9s; animation-delay: -.9s; }
        .container2 .circle2 { -webkit-animation-delay: -.8s; animation-delay: -.8s; }
        .container3 .circle2 { -webkit-animation-delay: -.7s; animation-delay: -.7s; }
        .container1 .circle3 { -webkit-animation-delay: -.6s; animation-delay: -.6s; }
        .container2 .circle3 { -webkit-animation-delay: -.5s; animation-delay: -.5s; }
        .container3 .circle3 { -webkit-animation-delay: -.4s; animation-delay: -.4s; }
        .container1 .circle4 { -webkit-animation-delay: -.3s; animation-delay: -.3s; }
        .container2 .circle4 { -webkit-animation-delay: -.2s; animation-delay: -.2s; }
        .container3 .circle4 { -webkit-animation-delay: -.1s; animation-delay: -.1s; }

        .spinnerdot { width: 40px; height: 40px; position: relative; text-align: center; -webkit-animation: rotate 2.0s infinite linear; animation: rotate 2.0s infinite linear; }
        .dot1, .dot2 { width: 60%; height: 60%; display: inline-block; position: absolute; top: 0; background-color: red !important; border-radius: 100%; -webkit-animation: bounce 2.0s infinite ease-in-out; animation: bounce 2.0s infinite ease-in-out; }
        .dot2 { top: auto; bottom: 0px; -webkit-animation-delay: -1.0s; animation-delay: -1.0s; }



        a.imglink{
            background:         #000;
            display:            inline-block;
        }
        a.imglink img{
            vertical-align:     middle;
            transition:         opacity 0.3s;
            -webkit-transition: opacity 0.3s;
        }
        a.imglink:hover img{
            opacity:            0.5;
        }

    </style>

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

<div class="container">
<div class="row-fluid">
    <h2 style="background:#003a6a !important; color: wheat; text-align: center;" class="jumbotron">
        <img src="<?php echo base_url(); ?>assets/img/BISEGRW_Icon.png" class="img-circle" width="125px" height="125px" alt="Logo">
        Board of Intermediate & Secondary Education, Gujranwala
        <br>
        <?php 
        echo'<p class="text-uppercase"  style="text-align:center;">'.HEADER_TITLE.' </p>';
        ?>
    </h2>
</div>
