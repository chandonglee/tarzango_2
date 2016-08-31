<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Express Checkout - Order Cancelled</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Angell EYE">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
        #angelleye-logo { margin:10px 0; }
        thead th { background: #F4F4F4;  }
        th.center {
            text-align:center;
        }
        td.center{
            text-align:center;
        }
        #paypal_errors {
            margin-top:25px;
        }
        .general_message {
            margin: 20px 0 20px 0;
        }
        #angelleye-demo-digital-goods-success-msg {
            display:none;
        }
        .container.getCredit.wrapper{
            width: 100% !important;
            left:0% !important;
        }
    </style>
</head>
<body>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/front/bootstrap.vertical-tabs.css">
   <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main/style.css">


  </head>
   <body>
    <header>
      <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">ingOverSea</a>
          <img src="<?php echo base_url('assets/images/web/logo.png'); ?>">
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Get Credit</a></li>
            <li><a href="getcredit">Get Started</a></li>
            <li><a href="#contact">Need help?</a></li>
           </ul>
         </div><!--/.nav-collapse -->
       </div>
      </nav>
   </header>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <div id="header" class="row clearfix">
                
            </div>
            <h2 align="center">Order Cancelled</h2>
            
            <a class="btn btn-primary" href="<?php echo site_url('getcredit');?>">Home</a>
        </div>
    </div>
</div>
</body>
</html>