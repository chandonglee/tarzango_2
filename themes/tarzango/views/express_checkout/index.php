<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

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


      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.vertical-tabs.css">
   <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style_1_paypal.css">


<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
           
    <div class="container getCredit wrapper">
            <h2 align="center">Express Checkout </h2>
            
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Hotel name</th>
                    <th>Holder name</th>
                    <th class="center">Price</th>
                </tr>
                </thead>
                <tbody>
               
                    <tr>
                        <td><?php echo $cart['hotelname']; ?></td>
                        <td class="center"> $<?php echo $cart['firstName']. " ".$cart['lastName']; ?></td>
                        <td class="center"><?php echo $cart['total']; ?></td>
                        
                    </tr>
                   
                </tbody>
            </table>
            <div class="row clearfix">
                <div class="col-md-4 column"> </div>
                <div class="col-md-4 column"> </div>
                <div class="col-md-4 column">
                     <table class="table">
                        <tbody>
                        <tr>
                            <td><strong> Subtotal</strong></td>
                            <td> $<?php echo number_format($cart['total'],2); ?></td>
                        </tr>
                       
                        <tr>
                            <td><strong>Handling</strong></td>
                            <td>$<?php echo number_format($cart['tax'],2); ?></td>
                        </tr>
                       
                        <tr>
                            <td><strong>Grand Total</strong></td>
                            <td>$<?php echo number_format($cart['total']+ $cart['tax'],2); ?></td>
                        </tr>
                        <tr>
                            <td class="center" colspan="2"><a href="<?php echo site_url('express_checkout/SetExpressCheckout'); ?>"><img src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif"></a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php exit(); ?>