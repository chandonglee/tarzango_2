<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Express Checkout - Payment Complete</title>
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
            <div class="container getCredit wrapper">
            <h2 align="center">Payment Complete</h2>
           
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Mobile</th>
                    <th>Name</th>
                    <th class="center">Price</th>
                    <th class="center">QTY</th>
                    <th class="center">Total</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($cart['shopping_cart']['items'] as $cart_item) {
                    ?>
                    <tr>
                        <td><?php echo $cart_item['name']; ?></td>
                        <td><?php echo $cart_item['mobile']; ?></td>
                        <td class="center"> $<?php echo number_format($cart_item['price'],2); ?></td>
                        <td class="center"><?php echo $cart_item['qty']; ?></td>
                        <td class="center"> $<?php echo round($cart_item['qty'] * $cart_item['price'],2); ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
            <div class="row clearfix">
                <div class="col-md-4 column">
                    <p><strong>Billing Information</strong></p>
                    <p>
                        <?php
                        echo $cart['first_name'] . ' ' . $cart['last_name'] . '<br />' .
                            $cart['email'] . '<br />'.
                            $cart['phone_number'] . '<br />' .
                            $cart['paypal_transaction_id'];
                        ?>
                    </p>
                </div>
                <div class="col-md-4 column">
                    <p><strong>Shipping Information</strong></p>
                    <p>
                        <?php
                        echo $cart['shipping_name'] . '<br />' .
                            $cart['shipping_street'] . '<br />' .
                            $cart['shipping_city'] . ', ' . $cart['shipping_state'] . '  ' . $cart['shipping_zip'] . '<br />' .
                            $cart['shipping_country_name'];
                        ?>
                    </p>
                </div>
                <div class="col-md-4 column"> </div>
                <div class="col-md-4 column">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td><strong> Subtotal</strong></td>
                            <td> $<?php echo number_format($cart['shopping_cart']['subtotal'],2); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Shipping</strong></td>
                            <td>$<?php echo number_format($cart['shopping_cart']['shipping'],2); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Handling</strong></td>
                            <td>$<?php echo number_format($cart['shopping_cart']['handling'],2); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Tax</strong></td>
                            <td>$<?php echo number_format($cart['shopping_cart']['tax'],2); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Grand Total</strong></td>
                            <td>$<?php echo number_format($cart['shopping_cart']['grand_total'],2); ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <a class="btn btn-primary" href="<?php echo site_url('getcredit');?>">Home</a>
        </div>
    </div>
</div>
</body>
</html>