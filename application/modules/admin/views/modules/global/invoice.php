<style>
  header {
     
      background: linear-gradient(to left, #321d61 , #1d2c68);
      padding: 20px 0;
  }

  .fa {
      padding-left: 7px;
      font-size: 16px;
    }
  .main-pay {
      -webkit-box-shadow: -1px 2px 7px 0px rgba(217,217,227,1);
      -moz-box-shadow: -1px 2px 7px 0px rgba(217,217,227,1);
      box-shadow: -1px 2px 7px 0px rgba(217,217,227,1);
  }
  .row {
      margin-right: -15px;
      margin-left: -15px;
  }
  .pay-block {
      text-align: center;
      margin-top: 60px;
  }
  .pay-block h1 {
      font-family: 'Conv_GothamNarrow-Book_0';
      color: #fff;
      font-size: 21px;
      font-weight: normal;
      margin: 0;
      padding-bottom: 5px;
  }
  .pay-block p {
      font-family: 'Conv_GothamNarrow-Book_0';
      color: #fff;
      font-size: 18px;
      font-weight: normal;
      margin-bottom: 50px;
  }
  .btn-primary {

      text-align: center;
      font-family: 'Gotham-Bold';
      font-size: 15px;
      color: #fff;
      padding: 20px 12%;
      background: #2cc6fd;
      border-radius: 2px;
      text-transform: uppercase;
      text-decoration: none;
      border: none;
      letter-spacing: 1px;
      display: inline-block;
      margin: 0 10px 40px;
  }
   
   .inner-page-nav{
     display: none;
   }
   @media(min-width: 1000px){
    .img-responsive, .thumbnail > img, .thumbnail a > img, .carousel-inner > .item > img, .carousel-inner > .item > a > img{
      display: block;
    height: 400px !important;
    width: 850px !important;
    }
   }
    @media(min-width: 1600px){
    .img-responsive, .thumbnail > img, .thumbnail a > img, .carousel-inner > .item > img, .carousel-inner > .item > a > img{
      display: block;
    height: 450px !important;
    width: 1200px !important;
    }
   }
     
</style>


<?php if(!isset($page_title_1)) { ?>

      <!-- list View block   -->
      <header class="pay-header">
         <div class="container">
            <div class="row">
               <div class="col-lg-1 col-md-1 col-sm-1  col-xs-6">  <a class="logo-pay" href="<?php echo base_url(); ?>">  <img src="images/pay-logo.png" > </a> </div>
               <div class="col-lg-10 col-md-10 col-sm-10 hidden-xs"> </div>
               <div class="col-lg-1 col-md-1 col-sm-1 col-xs-6">
                  <div class="menu-icon">   
                     <a href="#">  <img src="images/menu-icon.png"> </a> 
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="pay-block">
                  <img src="images/watch-icon.png"> 
                  <h1 class="wow fadeInLeft animated" id="countdown"></h1>
                  <p class=""><?php echo trans('0409');?> <b class="text-warning wow flash animted" style="color: #fe5050;"><?php echo trans('082');?></b></p>
                   <div class="form-group">
                      <?php if($payOnArrival){ ?>
                      <button class="btn-arrival arrivalpay" data-module="<?php echo $invoice->module; ?>" id="<?php echo $invoice->id;?>"><?php echo trans('0345');?></button>
                      <?php } if($singleGateway != "payonarrival"){ ?>
                      <button data-toggle="modal" style="display:none;"  data-target="#paynow" type="submit" class="btn btn-primary"><?php echo trans('0117');?></button>
                      <button data-toggle="modal" style="display:none;"  data-target="#paynow" type="button" id="gateway_pro" class="btn btn-primary"><?php echo trans('0117');?></button>
                      <button  id="element_id_1470283648"></button>
                      <?php } ?>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <div class="paynow">
      <div class="paynow_body">
  <img class="top-bg" src="images/paynow_top.png">
  <img class="left-bg" src="images/membership-left-bg.png">
  <img class="right-bg" src="images/membership-right-bg.png">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="col-sm-1">
          
          </div>
          <div class="col-sm-10">
            <div class="section1">
              <div class="col-sm-12">
                <img src="images/email-page-logo.png">
              </div>
              <div class="col-sm-6 left">
                <h5>Tarzango</h5>
                <h6>415-680-3008</h6>
              </div>
              <div class="col-sm-6 right">
                <h5><?php echo $invoice->userFullName;?></h5>
                <h6><?php echo $invoice->userMobile;?></h6>
              </div>
              <div class="col-sm-6 left">
                <p>Invoice Date:<span> <?php echo $invoice->bookingDate;?></span></p>
                <p>Due Date:<span> <?php echo $invoice->expiry;?></span></p>
              </div>
              <div class="col-sm-6 right">
                <p>Invoice Number:<span> <?php echo $invoice->id; ?></span></p>
                <p>Booking Confirmation:<span> <?php echo $invoice->code; ?></span></p>
              </div>
            </div>
            <div class="section2">
              <div class="stars">
               <?php echo $invoice->stars;?>
              </div>
              <h1><?php echo $invoice->title;?></h1>
              <p class="left"><img src="images/checkin.png"> <?php echo $invoice->location;?> </p>
               <?php if($invoice->hotel_phone != "") {?> <p class="right"><img src="images/email-call.png"> <?php echo $invoice->hotel_phone; ?> </p> <?php }else{ ?> <span></span> <?php } ?>
              <img class="img-responsive" src="<?php echo $invoice->thumbnail;?>">
            </div>
            <div class="section3">
              <div class="details">
                <div class="col-sm-3">
                  <h6>CONFIRMATION #</h6>
                  <h5><?php echo $invoice->code; ?></h5>
                </div>
                <div class="col-sm-3">
                  <h6>ROOM</h6>
                  <h5>$ <?php echo $invoice->subItem->price; ?></h5>
                </div>
                <div class="col-sm-3">
                  <h6>TOTAL AMOUNT</h6>
                  <h5>$ <?php echo str_replace(".00",'',number_format($invoice->checkoutTotal,2));?></h5>
                </div>
                <div class="col-sm-3">
                
                </div>
              </div>
              <div class="boxes">
                <div class="box">
                  <img src="images/paynow_icon2.png">
                  <h6>BOARD TYPE</h6>
                  <h5>All Inclusive</h5>
                </div>
                <div class="box">
                  <img src="images/paynow_icon3.png">
                  <h6>ROOMS</h6>
                  <h5><?php echo $invoice->subItem->quantity; ?></h5>
                </div>
                <div class="box">
                  <img src="images/paynow_icon4.png">
                  <h6>TYPE</h6>
                  <h5><?php echo  character_limiter($invoice->subItem->title,10); ?></h5>
                </div>
                <div class="box">
                  <img src="images/paynow_icon5.png">
                  <h6>CHECK IN</h6>
                  <h5><?php echo $invoice->checkin; ?></h5>
                </div>
                <div class="box last">
                  <img src="images/paynow_icon5.png">
                  <h6>CHECK OUT</h6>
                  <h5><?php echo $invoice->checkout; ?></h5>
                </div>
              </div>
              <div class="user_details">
                <h6>GUEST NAMES<span>30 ADULTS 9 CHILDREN</span></h6>
                <ul>
                  <li class="title">
                    <p>ROOM 1</p>
                  </li>
                  <li class="username">
                    <h5 class="left">Kristina Vazon</h5>
                  </li>
                  <li class="username">
                    <h5 class="left">Noemi Vazon</h5>
                    <h5 class="right"><img src="images/paynow_icon6.png"> 2 Years</h5>
                  </li>
                  <li class="username">
                    <h5 class="left">Nobert Vazon</h5>
                    <h5 class="right"><img src="images/paynow_icon6.png"> 4 Years</h5>
                  </li>
                  <li class="title">
                    <p>ROOM 2</p>
                  </li>
                  <li class="username">
                    <h5 class="left">Kristina Vazon</h5>
                  </li>
                  <li class="username">
                    <h5 class="left">Noemi Vazon</h5>
                    <h5 class="right"><img src="images/paynow_icon6.png"> 2 Years</h5>
                  </li>
                  <li class="username">
                    <h5 class="left">Nobert Vazon</h5>
                    <h5 class="right"><img src="images/paynow_icon6.png"> 4 Years</h5>
                  </li>
                  <li class="title">
                    <p>ROOM 3</p>
                  </li>
                  <li class="username">
                    <h5 class="left">Kristina Vazon</h5>
                  </li>
                  <li class="username">
                    <h5 class="left">Noemi Vazon</h5>
                    <h5 class="right"><img src="images/paynow_icon6.png"> 2 Years</h5>
                  </li>
                  <li class="username">
                    <h5 class="left">Nobert Vazon</h5>
                    <h5 class="right"><img src="images/paynow_icon6.png"> 4 Years</h5>
                  </li>
                </ul>
                <div class="col-sm-12">
                  <a class="button" href="" onclick="myFunction()" ><img  src="images/paynow_icon7.png">PRINT INVOICE</a>
                  <a class="button" href="#"><img src="images/paynow_icon8.png">DOWNLOAD INVOICE</a>
                  <div style="" class="button">
                    <button id="element_id_1470283647"></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-1">
          <?php if($extra_details){ ?>
                    <div class="pay-type-block ">
                      <span class="single-type pay-col" >
                        <h2> Pickup Details </h2>
                        <div class="pay-single-btn" style="width:100%; padding-left: 22px; text-align:left;"><?php echo $extra_details->location; ?></div>
                      </span>
                      <span class="single-type pay-col" >
                        <h2> Pickup time </h2>
                        <div class="pay-single-btn" style="width:100%; padding-left: 22px; text-align:left;"><?php echo $extra_details->time; ?></div>
                      </span>
                    </div>
                 
                  <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script>

function myFunction() {
    window.print();
}

</script>    
  
         
                 

  <!-- Modal -->
<div class="modal fade" id="paynow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="margin-bottom: 0px;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <img src="<?php echo $theme_url; ?>img/logo.png" class="img-responsive" alt="Home Logo">
      </div>
      <div class="modal-body">
        <div role="form">
          <div class="form-group" style="display:none;">
            <label for="form-input" class="hidden-xs col-sm-2 control-label text-left" style="padding: 10px;font-size: 18px;"><?php echo trans('0154');?></label>
            <div class="col-sm-10 col-md-10 col-xs-12">
              <select class="form-control form selectx" name="gateway" id="gateway">
                <option value=""><?php echo trans('0159');?></option>
                <?php foreach ($paymentGateways as $pay) { if($pay['name'] != "payonarrival" && $pay['name'] != 'moneybookers'){ ?>
                <option value="<?php echo $pay['name']; ?>" <?php makeSelected($invoice->paymethod, $pay['name']); ?> ><?php echo $pay['gatewayValues'][$pay['name']]['name']; ?></option>
                <?php } } ?>
              </select>
              <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="col-sm-12" >
            <b>Amount : </b> $<?php echo number_format($invoice->checkoutTotal,2);?>
            <hr>
            <center>
              <div  id="response"></div>
              <div  id="response1" style="display:none;"><button id="element_id_1470283648"></button></div>
            </center>
          </div>
          <div class="clearfix"></div>
          <div class="col-sm-12 creditcardform" style="display:none;">
            <form  role="form" action="<?php echo base_url();?>creditcard" method="POST">
              <fieldset>
                <div class="row">
                  <div class="col-md-6  go-right">
                    <div class="form-group ">
                      <label class="required go-right"><?php echo trans('0171');?></label>
                      <input type="text" class="form-control" name="firstname" id="card-holder-firstname" placeholder="<?php echo trans('0171');?>">
                    </div>
                  </div>
                  <div class="col-md-6  go-left">
                    <div class="form-group ">
                      <label class="required go-right"><?php echo trans('0172');?></label>
                      <input type="text" class="form-control" name="lastname" id="card-holder-lastname" placeholder="<?php echo trans('0172');?>">
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-md-12  go-right">
                    <div class="form-group ">
                      <label class="required go-right"><?php echo trans('0316');?></label>
                      <input type="text" class="form-control" name="cardnum" id="card-number" placeholder="<?php echo trans('0316');?>" onkeypress="return isNumeric(event)" >
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-md-3 go-right">
                    <div class="form-group ">
                      <label style="font-size:13px"class="required  go-right"><?php echo trans('0329');?></label>
                      <select class="form-control col-sm-2" name="expMonth" id="expiry-month">
                        <option value="01"><?php echo trans('0317');?> (01)</option>
                        <option value="02"><?php echo trans('0318');?> (02)</option>
                        <option value="03"><?php echo trans('0319');?> (03)</option>
                        <option value="04"><?php echo trans('0320');?> (04)</option>
                        <option value="05"><?php echo trans('0321');?> (05)</option>
                        <option value="06"><?php echo trans('0322');?> (06)</option>
                        <option value="07"><?php echo trans('0323');?> (07)</option>
                        <option value="08"><?php echo trans('0324');?> (08)</option>
                        <option value="09"><?php echo trans('0325');?> (09)</option>
                        <option value="10"><?php echo trans('0326');?> (10)</option>
                        <option value="11"><?php echo trans('0327');?> (11)</option>
                        <option value="12"><?php echo trans('0328');?> (12)</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3 go-left">
                    <div class="form-group">
                      <label class="required go-right">&nbsp;</label>
                      <select class="form-control" name="expYear" id="expiry-year">
                        <?php for($y = date("Y");$y <= date("Y") + 10;$y++){?>
                        <option value="<?php echo $y?>"><?php echo $y; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3 go-left">
                    <div class="form-group">
                      <label class="required go-right">&nbsp;</label>
                      <input type="text" class="form-control" name="cvv" id="cvv" placeholder="<?php echo trans('0331');?>">
                    </div>
                  </div>
                  <div class="col-md-3 go-left">
                    <label class="required go-right">&nbsp;</label>
                    <img src="<?php echo base_url(); ?>assets/img/cc.png" class="img-responsive">
                  </div>
                </div>
                <div class="clearfix"></div>
                <br>
                <div class="form-group">
                  <div class="alert alert-danger submitresult"></div>
                  <input type="hidden" name="paymethod" id="creditcardgateway" value="" />
                  <input type="hidden" name="bookingid" id="bookingid" value="<?php echo $invoice->bookingID;?>" />
                  <input type="hidden" name="refno" id="bookingid" value="<?php echo $invoice->code;?>" />
                  <button type="submit" class="btn btn-success btn-lg paynowbtn pull-left" onclick="return expcheck();"><?php echo trans('0117');?></button>
                </div>
              </fieldset>
            </form>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('0234');?></button>
      </div>
    </div>
  </div>
</div>
<!-- 

 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAH65sTGsDsP4mMpmbHC8zqRiM1Qh07iL8&callback=initMap">
    </script>  

-->
  <?php 
$repl_arry = array(".",",");
?>
<script type="text/javascript">
  var PayStand = PayStand || {};
  PayStand.checkouts = PayStand.checkouts || [];
  PayStand.load = PayStand.load || function(){};
  var checkout = {
  api_key: "aiPjqMbXh79vnMDqBVeq1xtM6VIx0LGVfu4ifqQONbm8PrS2GRinF/TDsoMeqeHUJfJ6Xrp9FSGrn2ehugEX8/w",
  org_id: "15191",
  element_ids: ["element_id_1470283648"],
  data_source: "org_defined",
  checkout_type: "button",
  button_options: {
  button_type: "checkout",
  button_name: "Pay Now",
  input: false,
  variants: false
  },
  amount: "<?php echo str_replace($repl_arry,'',number_format($invoice->checkoutTotal,2));?>",
  //amount: "100",
  items: [{
  title: "Reservation Payment",
  subtitle: "Payment to lock reservation in TarzanGo",
  item_price: "<?php echo str_replace($repl_arry,'',number_format($invoice->checkoutTotal,2));?>",
  //item_price: "100",
  quantity: 1
  }],
  }
  PayStand.checkoutComplete = function (data) {
    $.ajax({
        type: 'POST',
        data:{pay_data : data , invoice_id : <?php echo $invoice->id; ?> , invoice_code : <?php echo $invoice->code; ?> },
        url: '<?php echo base_url();?>invoice/booking_paid_paystand',
        cache: false,
        beforeSend:function(){
                  // show image here
                  $(".popupBg1").show();
                  $(".data").hide();
        },
        success: function(data)
        {
            console.log('final_data'+data);
            location.reload(true);
            //alert();
        },
        error: function(e)
        {
          alert(e.message);
        }
    });
    console.log('update123->'+JSON.stringify(data));
  };
  PayStand.checkoutUpdated = function (data) {
    console.log('update->'+JSON.stringify(data));


  };
  PayStand.checkouts.push(checkout);
  PayStand.script = document.createElement('script');
  PayStand.script.type = 'text/javascript';
  PayStand.script.async = true;
  PayStand.script.src = 'https://app.paystand.com/js/gen/checkout.min.js';
  var s = document.getElementsByTagName('script')[0];
  s.parentNode.insertBefore(PayStand.script, s);
</script>
<script type="text/javascript">
  var PayStand = PayStand || {};
  PayStand.checkouts = PayStand.checkouts || [];
  PayStand.load = PayStand.load || function(){};
  var checkout = {
  api_key: "aiPjqMbXh79vnMDqBVeq1xtM6VIx0LGVfu4ifqQONbm8PrS2GRinF/TDsoMeqeHUJfJ6Xrp9FSGrn2ehugEX8/w",
  org_id: "15191",
  element_ids: ["element_id_1470283647"],
  data_source: "org_defined",
  checkout_type: "button",
  button_options: {
  button_type: "checkout",
  button_name: "Pay Now",
  input: false,
  variants: false
  },
  amount: "<?php echo str_replace($repl_arry,'',number_format($invoice->checkoutTotal,2));?>",
  //amount: "100",
  items: [{
  title: "Reservation Payment",
  subtitle: "Payment to lock reservation in TarzanGo",
  item_price: "<?php echo str_replace($repl_arry,'',number_format($invoice->checkoutTotal,2));?>",
  //item_price: "100",
  quantity: 1
  }],
  }
  PayStand.checkoutComplete = function (data) {
    $.ajax({
        type: 'POST',
        data:{pay_data : data , invoice_id : <?php echo $invoice->id; ?> , invoice_code : <?php echo $invoice->code; ?> },
        url: '<?php echo base_url();?>invoice/booking_paid_paystand',
        cache: false,
        beforeSend:function(){
                  // show image here
                  $(".popupBg1").show();
                  $(".data").hide();
        },
        success: function(data)
        {
            console.log('final_data'+data);
            location.reload(true);
            //alert();
        },
        error: function(e)
        {
          alert(e.message);
        }
    });
    console.log('update123->'+JSON.stringify(data));
  };
  PayStand.checkoutUpdated = function (data) {
    console.log('update->'+JSON.stringify(data));


  };
  PayStand.checkouts.push(checkout);
  PayStand.script = document.createElement('script');
  PayStand.script.type = 'text/javascript';
  PayStand.script.async = true;
  PayStand.script.src = 'https://app.paystand.com/js/gen/checkout.min.js';
  var s = document.getElementsByTagName('script')[0];
  s.parentNode.insertBefore(PayStand.script, s);
</script>

<script type="text/javascript">
 /*function initMap() {*/
        var myLatLng = {lat: <?php echo $invoice->hotel_details_extra['hotel_latitude']; ?>, lng:<?php echo $invoice->hotel_details_extra['hotel_longitude']; ?>};

        var map = new google.maps.Map(document.getElementById('mapDiv'), {
          zoom: 12,
          center: myLatLng
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'Hello World!'
        });
     /* }*/
  // set the date we're counting down to
  // var target_date = new Date('<?php echo $invoice->expiryFullDate; ?>').getTime();
  var target_date = <?php echo $invoice->expiryUnixtime * 1000; ?>;
  var invoiceStatus = "<?php echo $invoice->status; ?>";

  // variables for time units
  var days, hours, minutes, seconds;

  // get tag element
  var countdown = document.getElementById('countdown');
  var ccc = new Date().getTime();

  if(invoiceStatus == "unpaid"){

      // update the tag with id "countdown" every 1 second
      setInterval(function () {

      // find the amount of "seconds" between now and target
      var current_date = new Date().getTime();

      var seconds_left = (target_date - current_date) / 1000;

      // do some time calculations
      days = parseInt(seconds_left / 86400);
      seconds_left = seconds_left % 86400;

      hours = parseInt(seconds_left / 3600);
      seconds_left = seconds_left % 3600;

      minutes = parseInt(seconds_left / 60);
      seconds = parseInt(seconds_left % 60);

      // format countdown string + set tag value
      countdown.innerHTML = '<span class="days">' + days +  ' <b><?php echo trans("0440");?></b></span> <span class="hours">' + hours + ' <b><?php echo trans("0441");?></b></span> <span class="minutes">'
      + minutes + ' <b><?php echo trans("0442");?></b></span> <span class="seconds">' + seconds + ' <b><?php echo trans("0443");?></b></span>';

      }, 1000);

  }


$(function(){
    $(".submitresult").hide();
    loadPaymethodData();

    $(".arrivalpay").on("click",function(){
      var id = $(this).prop("id");
      var module = $(this).data("module");
      var check = confirm("<?php echo trans('0483')?>");
      if(check){
        $.post("<?php echo base_url();?>invoice/updatePayOnArrival", {id: id,module: module}, function(resp){
          location.reload();
        });
      }

    });

    $('#response').on('click','input[type="image"],input[type="submit"]',function(){
      setTimeout(function(){
      $("#response").html("<div id='rotatingDiv'></div>");
      }, 500)


    });

    $("#gateway_pro").on("click",function(){
      var gateway = 'paypalpaymentspro';
      $("#response1").hide();
      $("#response").html("<div id='rotatingDiv'></div>");
      $.post("<?php echo base_url();?>invoice/getGatewaylink/<?php echo $invoice->id?>/<?php echo $invoice->code;?>", {gateway: gateway}, function(resp){
        console.log(resp);
         var response = $.parseJSON(resp);
         console.log(response);
         if(response.iscreditcard == "1"){
          $(".creditcardform").fadeIn("slow");
          $("#creditcardgateway").val(response.gateway);
          $("#response").html("");

        }else if(response.gateway == "paystand"){
            $(".creditcardform").hide();
            $("#response").hide();
            $("#response1").show();
         }else{
           $(".creditcardform").hide();

           $("#response").html(response.htmldata);
         }


      });
    })

    $("#gateway").on("change",function(){
      var gateway = $(this).val();
      $("#response1").hide();
      $("#response").html("<div id='rotatingDiv'></div>");
      $.post("<?php echo base_url();?>invoice/getGatewaylink/<?php echo $invoice->id?>/<?php echo $invoice->code;?>", {gateway: gateway}, function(resp){
        console.log(resp);
         var response = $.parseJSON(resp);
         console.log(response);
         if(response.iscreditcard == "1"){
          $(".creditcardform").fadeIn("slow");
          $("#creditcardgateway").val(response.gateway);
          $("#response").html("");

        }else if(response.gateway == "paystand"){
            $(".creditcardform").hide();
            $("#response").hide();
            $("#response1").show();
         }else{
           $(".creditcardform").hide();

           $("#response").html(response.htmldata);
         }


      });
    })
  });

  function expcheck(){
          $(".submitresult").html("").fadeOut("fast");
       var cardno = $("#card-number").val();
       var firstname = $("#card-holder-firstname").val();
       var lastname = $("#card-holder-lastname").val();
      var minMonth = new Date().getMonth() + 1;
      var minYear = new Date().getFullYear();
      var month = parseInt($("#expiry-month").val(), 10);
      var year = parseInt($("#expiry-year").val(), 10);

       if($.trim(firstname) == ""){
       $(".submitresult").html("Enter First Name").fadeIn("slow");
       return false;
       }else if($.trim(lastname) == ""){
      $(".submitresult").html("Enter Last Name").fadeIn("slow");
       return false;
       }else if($.trim(cardno) == ""){
      $(".submitresult").html("Enter Card number").fadeIn("slow");
       return false;
       }else if(month <= minMonth && year <= minYear){
        $(".submitresult").html("Invalid Expiration Date").fadeIn("slow");
       return false;

       }else{
         $(".paynowbtn").hide();
        $(".submitresult").removeClass("alert-danger");
        $(".submitresult").html("<div id='rotatingDiv'></div>").fadeIn("slow");
       }


       }

       function loadPaymethodData(){

      var gateway = $("#gateway").val();
      var invoiceStatus = "<?php echo $invoice->status; ?>";

      if(invoiceStatus == "unpaid"){

        if(gateway != ""){

          $.post("<?php echo base_url();?>invoice/getGatewaylink/<?php echo $invoice->id?>/<?php echo $invoice->code;?>", {gateway: gateway}, function(resp){
       var response = $.parseJSON(resp);
       console.log(response);
       if(response.iscreditcard == "1"){
        $(".creditcardform").fadeIn("slow");
        $("#creditcardgateway").val(response.gateway);
        $("#response").html("");
       }if(response.gateway == "paystand"){
          $(".creditcardform").hide();
          var paystand = '<a class="paystand_lick"  href="https://tarzango.paystand.com/" target="_blank" ><img src="<?php echo base_url()."assets/img/paystand_logo.png"; ?>"></a><script>$(".paystand_lick").click(function(){$(this).remove();$("body").removeClass("modal-open");$("#paynow").css("display","none");$(".modal-backdrop").css("display","none"); });<\/script>';
          $("#response").html(paystand);
       }else{
       $(".creditcardform").hide();
       $("#response").html(response.htmldata);
       }
      });
      }

      }

      

      }
</script>


<?php }if(isset($page_title_1)) { ?>

<div class="bg_list_image">
  <div class="modal-dialog modal-lg" style="z-index: 0">
    <div class="modal-content" style="z-index: 1025;">
      <div class="modal-body" style="padding:0px;">
       
         <?php //require $themeurl . 'views/invoice.php';?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="bgBody">
          <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td valign="top" width="600" style="padding:0px !important;"><div class="contentEditableContainer contentImageEditable">
                      <div class="contentEditable" align="center"> <img class="banner" src="<?php echo $invoice[0]->book_thumbnail; ?>" alt="Featured image" height="400" width="100%" data-default="placeholder" data-max-width="600" border="0"> </div>
                    </div></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td  bgcolor="#0781ce" style="padding: 20px;" ><div class="contentEditableContainer contentTextEditable">
                      <div class="contentEditable" align="center">
                        <p style="color:#ffffff;font-style:italic;font-size: 16px;margin:0;font-family:sans-serif;line-height:22px;">Confirmation Number: <?php echo $invoice[0]->book_itineraryid;?></p>
                      </div>
                    </div></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="customZone" data-type="Textimage">
            <div class="movableContent bgItem">
              <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center" >
                <tr>
                  <td height="42">&nbsp;</td>
                  <td height="42">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top" style="padding:0 0 0 0px;"><div class="contentEditableContainer contentTextEditable">
                      <div class="contentEditable">
                        <h2><?php echo $invoice[0]->book_hotel;?> </h2>
                        </br>
                        <p ><?php echo $invoice->hotel_details_extra['hotel_desc']; ?></p>
                        <br>
                        <span ><strong>Address : </strong><?php echo $invoice[0]->book_hotel;?> <?php echo $invoice[0]->book_location;?></span><br>
                        <!-- <span class="st_rating" ><strong>Star rating : </strong><?php echo $invoice->stars;?></span> </div>-->
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                      <?php $extra_data =  json_decode($extra_details[0]->extra_data); ?>
                      <span ><strong>Additional notes : </strong> <?php echo $extra_data->additionalnotes; ?> </span>
                      <?php for ($g_i_e=0; $g_i_e < count( $extra_data->guest_data) ; $g_i_e++) { ?>
                       <br>
                      <span ><strong> <?php echo $g_i_e+1; ?> Guest name : </strong> <?php echo $extra_data->guest_data[$g_i_e]; ?> </span>
                        <?php } ?>
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
              <tbody>
                <tr>
                  <td valign="top" width="20">&nbsp;</td>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                      <tr>
                        <td height="42">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="left"><div class="contentEditableContainer contentTextEditable">
                            <div class="contentEditable">
                              <h2 style="color: #F34E32;font-size: 24px;margin: 0;font-weight: normal;font-family: sans-serif;">Guest Details</h2>
                            </div>
                          </div></td>
                      </tr>
                      <tr>
                        <td  style="font-size:18px; margin-bottom:20px; padding: 6px !important;"><strong>Name : </strong><?php echo $invoice[0]->ai_first_name." ".$invoice[0]->ai_last_name; ?></td>
                      </tr>
                      <tr>
                        <td align="left" valign="top" ><table class="reservation" border="1" style="border-collapse: collapse;font-size: 14px;padding: -1px;font-family: sans-serif;border: solid 1px #fff;background: #f2f2f2;" cellspacing="10px" cellpadding="10px" width="100%">
                            <tbody>
                              <tr>
                                <td><strong>Confirmation No : </strong><?php echo $invoice[0]->book_itineraryid;?></td>
                                <td><strong>No of Rooms : </strong>1</td>
                              </tr>
                              <tr>
                                <td colspan="2"><strong>Room Name : </strong><?php echo $invoice[0]->book_roomname;?></td>
                              </tr>
                              <tr>
                                <td><strong>Checkin Date : </strong><?php echo date("m/d/Y", strtotime($invoice[0]->book_checkin));?></td>
                                <td><strong>Checkout Date : </strong><?php echo date("m/d/Y", strtotime($invoice[0]->book_checkout));?></td>
                              </tr>
                              <tr>
                                <td><strong>Total Amount : </strong>$<?php echo str_replace(".00",'',number_format($invoice[0]->book_total,2));?></td>
                                <td><strong>No of Adults / Child : </strong> <?php $book_response = json_decode($invoice[0]->book_response); echo count($book_response->booking->hotel->rooms[0]->paxes); ?></td>
                              </tr>
                              <?php if($invoice->couponRate > 0){ ?>
                                <tr>
                                  <td>
                                      <strong><?php echo trans('0518');?> : </strong> <?php echo $invoice->couponRate; ?>%
                                  </td>
                                </tr>
                              <?php } ?>
                            </tbody>
                          </table></td>
                      </tr>
                    </table></td>
                  <td valign="top" width="20">&nbsp;</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
              <tbody>
                <tr>
                  <td valign="top" width="20">&nbsp;</td>
                  <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr>
                          <td valign="top" height="42"></td>
                        </tr>
                        <tr>
                          <td align="center"><div class="contentEditableContainer contentTextEditable">
                              <div class="contentEditable">
                                <p style="color:#967B76;font-size: 26px;margin:0;font-family:sans-serif;">SIMILAR HOTELS</p>
                              </div>
                            </div></td>
                        </tr>
                        <tr>
                          <td height="38"></td>
                        </tr>
                        <tr>
                          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tbody>
                                <tr>
                                  <?php 
                                       $top_hotel = $invoice[0]->hotel_details_extra['top_hotel'];

                                      $top_hotel_1 = "";
                                      for ($i=0; $i < count($top_hotel) ; $i++) { 
                                        $bb = $top_hotel;
                                        /*echo json_encode($bb[$i]->slug);
                                        exit();*/ ?>
                                  <td width="170" valign="top" class="specbundle2"><a href="<?php echo $bb[$i]->slug; ?>" style="text-decoration: none;">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tbody>
                                        <tr>
                                          <td valign="top" width="170"><div class="contentEditableContainer contentImageEditable">
                                              <div class="contentEditable" align="center"> <img src="<?php echo $bb[$i]->thumbnail; ?>"  width="170" height="120" data-default="placeholder" data-max-width="170"> </div>
                                            </div></td>
                                        </tr>
                                        <tr>
                                          <td align="center" style="padding:12px 0 0 0;" width="186" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                                              <tbody>
                                                <tr>
                                                  <td align="center" valign="top"><div class="contentEditableContainer contentTextEditable">
                                                      <div class="contentEditable">
                                                        <p style="height:30px; width:88%;color:#967B76;font-size: 16px;margin:0;line-height: 18px;font-family:sans-serif;"> <?php echo $bb[$i]->title; ?></p>
                                                      </div>
                                                    </div></td>
                                                </tr>
                                                <tr>
                                                  <td height="10"></td>
                                                </tr>
                                                <tr>
                                                  <td align="center" valign="top"><div class="contentEditableContainer contentTextEditable">
                                                      <div class="contentEditable">
                                                        <p style="color:#fc5f5a;font-size: 24px;margin:0;font-family:sans-serif;"><?php echo $bb[$i]->currCode.$bb[$i]->price; ?></p>
                                                      </div>
                                                    </div></td>
                                                </tr>
                                              </tbody>
                                            </table></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                    </a></td>
                                  <?php  //echo $top_hotel_1;
                                      }
                                    ?>
                                </tr>
                              </tbody>
                            </table></td>
                        </tr>
                      </tbody>
                    </table></td>
                  <td valign="top" width="20">&nbsp;</td>
                </tr>
              </tbody>
            </table>
          </div>
          <hr>
          <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
              <tbody>
                <tr>
                  <td valign="top" width="20">&nbsp;</td>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                      <tr>
                        <td height="42">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="left"><div class="contentEditableContainer contentTextEditable">
                            <div class="contentEditable">
                              <h2>TARZANGO </h2>
                            </div>
                          </div></td>
                      </tr>
                      <tr>
                        <td align="left" valign="top"><div class="contentEditableContainer contentTextEditable">
                            <div class="contentEditable">
                              <p >Going somewhere? Let Tarzango make your booking experience a swing’n good time!</p>
                            </div>
                          </div></td>
                      </tr>
                    </table></td>
                  <td valign="top" width="20">&nbsp;</td>
                </tr>
              </tbody>
            </table>
          </div>
          <hr>
          <div class="movableContent" style="border: 0px; padding-top: 0px; padding-bottom: 20px; position: relative;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td valign="top" width="600" style="padding:0px !important;"><div class="contentEditableContainer contentImageEditable">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                        <tbody>
                          <tr>
                            <td class="spechide" valign="top" style="padding:0px !important;" ><div class="contentEditable" align="center"> <img class="banner" src="email_temp_img/footterHeader_1.png" alt="Footer Head" width="110" height="50" border="0" style="margin-right: -5px;"> <img class="banner" src="email_temp_img/footterHeader_1.png" alt="Footer Head" width="110" height="50" border="0" style="margin-right: -5px;"> <img class="banner1" src="email_temp_img/footterHeader_2.png" alt="Footer Head" width="380" height="50" border="0" style="margin-right: -5px;"> <img class="banner" src="email_temp_img/footterHeader_1.png" alt="Footer Head" width="110" height="50" border="0" style="margin-right: -5px;"> <img class="banner" src="email_temp_img/footterHeader_3.png" alt="Footer Head" width="110" height="50" border="0"> </div></td>
                          </tr>
                        </tbody>
                      </table>
                    </div></td>
                </tr>
                <tr>
                  <td height="15" bgcolor="#EFEFEF"></td >
                </tr>
                <tr>
                  <td bgcolor="#EFEFEF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr>
                          <td valign="top" width="20">&nbsp;</td>
                          <td><div class="contentEditableContainer contentImageEditable">
                              <div class="contentEditable" align="center"> <a href="http://maps.google.com/?daddr=<?php echo $invoice[0]->book_hotel;?>" target="_blank">
                                <div id="mapDiv" style="width: 890px; height: 300px"></div>
                                </a> </div>
                            </div></td>
                          <td valign="top" width="20">&nbsp;</td>
                        </tr>
                      </tbody>
                    </table></td>
                </tr>
              </tbody>
            </table>
          </div>
        </table>
      </div>
    </div>
    </div>
  </div>
  <!-- Modal -->
<div class="modal fade" id="paynow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="margin-bottom: 0px;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo trans('0377');?></h4>
      </div>
      <div class="modal-body">
        <div role="form">
          <div class="form-group">
            <label for="form-input" class="hidden-xs col-sm-2 control-label text-left" style="padding: 10px;font-size: 18px;"><?php echo trans('0154');?></label>
            <div class="col-sm-10 col-md-10 col-xs-12">
              <select class="form-control form selectx" name="gateway" id="gateway1">
                <option value=""><?php echo trans('0159');?></option>
                <?php foreach ($paymentGateways as $pay) { if($pay['name'] != "payonarrival" && $pay['name'] != 'moneybookers'){ ?>
                <option value="<?php echo $pay['name']; ?>" <?php makeSelected($invoice->paymethod, $pay['name']); ?> ><?php echo $pay['gatewayValues'][$pay['name']]['name']; ?></option>
                <?php } } ?>
              </select>
              <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="col-sm-12">
            <hr>
            <center>
              <div  id="response"></div>
            </center>
          </div>
          <div class="clearfix"></div>
          <div class="col-sm-12 creditcardform" style="display:none;">
            <form  role="form" action="<?php echo base_url();?>creditcard" method="POST">
              <fieldset>
                <div class="row">
                  <div class="col-md-6  go-right">
                    <div class="form-group ">
                      <label class="required go-right"><?php echo trans('0171');?></label>
                      <input type="text" class="form-control" name="firstname" id="card-holder-firstname" placeholder="<?php echo trans('0171');?>">
                    </div>
                  </div>
                  <div class="col-md-6  go-left">
                    <div class="form-group ">
                      <label class="required go-right"><?php echo trans('0172');?></label>
                      <input type="text" class="form-control" name="lastname" id="card-holder-lastname" placeholder="<?php echo trans('0172');?>">
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-md-12  go-right">
                    <div class="form-group ">
                      <label class="required go-right"><?php echo trans('0316');?></label>
                      <input type="text" class="form-control" name="cardnum" id="card-number" placeholder="<?php echo trans('0316');?>" onkeypress="return isNumeric(event)" >
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-md-3 go-right">
                    <div class="form-group ">
                      <label style="font-size:13px"class="required  go-right"><?php echo trans('0329');?></label>
                      <select class="form-control col-sm-2" name="expMonth" id="expiry-month">
                        <option value="01"><?php echo trans('0317');?> (01)</option>
                        <option value="02"><?php echo trans('0318');?> (02)</option>
                        <option value="03"><?php echo trans('0319');?> (03)</option>
                        <option value="04"><?php echo trans('0320');?> (04)</option>
                        <option value="05"><?php echo trans('0321');?> (05)</option>
                        <option value="06"><?php echo trans('0322');?> (06)</option>
                        <option value="07"><?php echo trans('0323');?> (07)</option>
                        <option value="08"><?php echo trans('0324');?> (08)</option>
                        <option value="09"><?php echo trans('0325');?> (09)</option>
                        <option value="10"><?php echo trans('0326');?> (10)</option>
                        <option value="11"><?php echo trans('0327');?> (11)</option>
                        <option value="12"><?php echo trans('0328');?> (12)</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3 go-left">
                    <div class="form-group">
                      <label class="required go-right">&nbsp;</label>
                      <select class="form-control" name="expYear" id="expiry-year">
                        <?php for($y = date("Y");$y <= date("Y") + 10;$y++){?>
                        <option value="<?php echo $y?>"><?php echo $y; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3 go-left">
                    <div class="form-group">
                      <label class="required go-right">&nbsp;</label>
                      <input type="text" class="form-control" name="cvv" id="cvv" placeholder="<?php echo trans('0331');?>">
                    </div>
                  </div>
                  <div class="col-md-3 go-left">
                    <label class="required go-right">&nbsp;</label>
                    <img src="<?php echo base_url(); ?>assets/img/cc.png" class="img-responsive">
                  </div>
                </div>
                <div class="clearfix"></div>
                <br>
                <div class="form-group">
                  <div class="alert alert-danger submitresult"></div>
                  <input type="hidden" name="paymethod" id="creditcardgateway" value="" />
                  <input type="hidden" name="bookingid" id="bookingid" value="<?php echo $invoice->bookingID;?>" />
                  <input type="hidden" name="refno" id="bookingid" value="<?php echo $invoice->code;?>" />
                  <button type="submit" class="btn btn-success btn-lg paynowbtn pull-left" onclick="return expcheck();"><?php echo trans('0117');?></button>
                </div>
              </fieldset>
            </form>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('0234');?></button>
      </div>
    </div>
  </div>
</div>

<!-- 

 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAH65sTGsDsP4mMpmbHC8zqRiM1Qh07iL8&callback=initMap">
    </script>  

-->

<script type="text/javascript">
 /*function initMap() {*/
        var myLatLng = {lat: <?php echo $book_response->latitude; ?>, lng:<?php echo $book_response->longitude; ?>};

        var map = new google.maps.Map(document.getElementById('mapDiv'), {
          zoom: 12,
          center: myLatLng
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'Hello World!'
        });
     /* }*/
  // set the date we're counting down to
  // var target_date = new Date('<?php echo $invoice->expiryFullDate; ?>').getTime();
  var target_date = <?php echo $invoice->expiryUnixtime * 1000; ?>;
  var invoiceStatus = "<?php echo $invoice->status; ?>";

  // variables for time units
  var days, hours, minutes, seconds;

  // get tag element
  var countdown = document.getElementById('countdown');
  var ccc = new Date().getTime();

  if(invoiceStatus == "unpaid"){

      // update the tag with id "countdown" every 1 second
      setInterval(function () {

      // find the amount of "seconds" between now and target
      var current_date = new Date().getTime();

      var seconds_left = (target_date - current_date) / 1000;

      // do some time calculations
      days = parseInt(seconds_left / 86400);
      seconds_left = seconds_left % 86400;

      hours = parseInt(seconds_left / 3600);
      seconds_left = seconds_left % 3600;

      minutes = parseInt(seconds_left / 60);
      seconds = parseInt(seconds_left % 60);

      // format countdown string + set tag value
      countdown.innerHTML = '<span class="days">' + days +  ' <b><?php echo trans("0440");?></b></span> <span class="hours">' + hours + ' <b><?php echo trans("0441");?></b></span> <span class="minutes">'
      + minutes + ' <b><?php echo trans("0442");?></b></span> <span class="seconds">' + seconds + ' <b><?php echo trans("0443");?></b></span>';

      }, 1000);

  }


$(function(){
    $(".submitresult").hide();
    loadPaymethodData();

    $(".arrivalpay").on("click",function(){
      var id = $(this).prop("id");
      var module = $(this).data("module");
      var check = confirm("<?php echo trans('0483')?>");
      if(check){
        $.post("<?php echo base_url();?>invoice/updatePayOnArrival", {id: id,module: module}, function(resp){
          location.reload();
        });
      }

    });

    $('#response').on('click','input[type="image"],input[type="submit"]',function(){
      setTimeout(function(){
      $("#response").html("<div id='rotatingDiv'></div>");
      }, 500)


    });

    $("#gateway").on("change",function(){
      var gateway = $(this).val();
      $("#response").html("<div id='rotatingDiv'></div>");
      $.post("<?php echo base_url();?>invoice/getGatewaylink/<?php echo $invoice->id?>/<?php echo $invoice->code;?>", {gateway: gateway}, function(resp){
        /*console.log(resp);*/
       var response = $.parseJSON(resp);
       console.log(response);
       if(response.iscreditcard == "1"){
        $(".creditcardform").fadeIn("slow");
        $("#creditcardgateway").val(response.gateway);
        $("#response").html("");

      }
      if(response.gateway == "paystand"){
          $(".creditcardform").hide();
          var paystand = '<a class="paystand_lick"  href="https://tarzango.paystand.com/" target="_blank" ><img src="<?php echo base_url()."assets/img/paystand_logo.png"; ?>"></a><script>$(".paystand_lick").click(function(){$(this).remove();$("body").removeClass("modal-open");$("#paynow").css("display","none");$(".modal-backdrop").css("display","none"); });<\/script>';
          $("#response").html(paystand);
       }else{
         $(".creditcardform").hide();
         $("#response").html(response.htmldata);
       }


      });
    })
  });

  function expcheck(){
          $(".submitresult").html("").fadeOut("fast");
       var cardno = $("#card-number").val();
       var firstname = $("#card-holder-firstname").val();
       var lastname = $("#card-holder-lastname").val();
      var minMonth = new Date().getMonth() + 1;
      var minYear = new Date().getFullYear();
      var month = parseInt($("#expiry-month").val(), 10);
      var year = parseInt($("#expiry-year").val(), 10);

       if($.trim(firstname) == ""){
       $(".submitresult").html("Enter First Name").fadeIn("slow");
       return false;
       }else if($.trim(lastname) == ""){
      $(".submitresult").html("Enter Last Name").fadeIn("slow");
       return false;
       }else if($.trim(cardno) == ""){
      $(".submitresult").html("Enter Card number").fadeIn("slow");
       return false;
       }else if(month <= minMonth && year <= minYear){
        $(".submitresult").html("Invalid Expiration Date").fadeIn("slow");
       return false;

       }else{
         $(".paynowbtn").hide();
        $(".submitresult").removeClass("alert-danger");
        $(".submitresult").html("<div id='rotatingDiv'></div>").fadeIn("slow");
       }


       }

       function loadPaymethodData(){

      var gateway = $("#gateway").val();
      var invoiceStatus = "<?php echo $invoice->status; ?>";

      if(invoiceStatus == "unpaid"){

        if(gateway != ""){

          $.post("<?php echo base_url();?>invoice/getGatewaylink/<?php echo $invoice->id?>/<?php echo $invoice->code;?>", {gateway: gateway}, function(resp){
       var response = $.parseJSON(resp);
       console.log(response);
       if(response.iscreditcard == "1"){
        $(".creditcardform").fadeIn("slow");
        $("#creditcardgateway").val(response.gateway);
        $("#response").html("");
       }if(response.gateway == "paystand"){
          $(".creditcardform").hide();
          var paystand = '<a class="paystand_lick"  href="https://tarzango.paystand.com/" target="_blank" ><img src="<?php echo base_url()."assets/img/paystand_logo.png"; ?>"></a><script>$(".paystand_lick").click(function(){$(this).remove();$("body").removeClass("modal-open");$("#paynow").css("display","none");$(".modal-backdrop").css("display","none"); });<\/script>';
          $("#response").html(paystand);
       }else{
       $(".creditcardform").hide();
       $("#response").html(response.htmldata);
       }
      });
      }

      }

      

      }
</script>
<?php } ?>