<?php 
/*echo json_encode($invoice);
exit();*/
  $booking_expiry = $invoice->booking_expiry;
  $expiryUnixtime = strtotime($invoice->booking_expiry);
  $booking_status = $invoice->booking_status;
  $book_response = json_decode($invoice->book_response);
  $booking_extra_data = json_decode($invoice->booking_extra_data);

?>
<style>
  header {
    background: linear-gradient(to left, #321d61, #1d2c68);
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
    font-family: gotham_light;
    color: #fff;
    font-size: 21px;
    font-weight: normal;
    margin: 0;
    padding-bottom: 5px;
  }
  .pay-block p {
    font-family: gotham_light;
    color: #fff;
    font-size: 18px;
    font-weight: normal;
    margin-bottom: 50px;
  }
  .btn-primary {
    text-align: center;
    font-family: gotham_bold;
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
  .menu {
    width: 52px;
  }
  .menu-header {
    position: absolute;
    margin-left: -105px !important;
    margin-top: -48px !important;
  }
  .inner-page-nav {
    display: none;
  }
  .pay-header {
    padding-bottom: 120px;
  }
  .menu-header {
    margin-left: -100px !important;
  }
  .menu-header a {
    margin-left: 110% !important;
  }

  
</style>
<!-- list View block   -->
<header class="pay-header">

<div class="container">
  <div class="row">
    <div class="col-lg-1 col-md-1 col-sm-1  col-xs-6"> <a class="logo-pay" href="<?php echo base_url(); ?>"> <img src="images/pay-logo.png" > </a> </div>
    <div class="col-lg-10 col-md-10 col-sm-10 hidden-xs"> </div>
    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-6">
      <div class="menu-icon">
        <?php// include $themeurl.'views/menu_header.php';?>
        <script>
        $(".close-button").click(function(){
          $(".menu-dropdown").toggle();
        });
        </script> 
      </div>
    </div>
  </div>
  <div class="row">
    <?php if($booking_status == "unpaid" ){ 
      /*echo $booking_status;
      exit();*/
      if(time() < $expiryUnixtime){  ?>
    <div class="pay-block"> <img src="images/watch-icon.png">
      <h1 class="wow fadeInLeft animated" id="countdown"></h1>
      <p class="">Your booking status is <b class="text-warning wow flash animted" style="color: #fe5050;">Unpaid</b></p>
      <div class="form-group">
        <?php if($payOnArrival){ ?>
        <button class="btn-arrival arrivalpay" data-module="<?php echo $invoice->module; ?>" id="<?php echo $invoice->id;?>">Pay on Arrival</button>
        <?php } if($singleGateway != "payonarrival"){ ?>
        <button data-toggle="modal" style="display:none;"  data-target="#paynow" type="submit" class="btn btn-primary">Pay Now</button>
        <button data-toggle="modal" style="display:none;"  data-target="#paynow" type="button" id="gateway_pro" class="btn btn-primary">Pay Now</button>
        <div style="text-align:center;">
          <div class="col-sm-5" style="color:transparent"> aasdsada </div>
          <div class="col-sm-2">
            <button  id="element_id_1470283648"></button>
          </div>
          <div class="col-sm-5" style="color:transparent"> aasdsada </div>
        </div>
        <?php } ?>
      </div>
    </div>
    <?php }else{ ?>
    <div class="pay-block">
      <p class="">Your booking status is <b class="text-warning wow flash animted" style="color: #fe5050;">Expired</b></p>
    </div>
    <?php } 
    }elseif($booking_status == "reserved"){ ?>
    <div class="pay-block">
      <p class="">Your booking status is <b class="text-warning wow flash animted" style="color: #fe5050;">Reserved</b></p>
    </div>
    <?php }elseif($booking_status == "cancelled"){ ?>
    <div class="pay-block">
      <p class="">Your booking status is <b class="text-warning wow flash animted" style="color: #fe5050;">Cancelled</b></p>
    </div>
    <?php  }else{ ?>
    <div class="pay-block"> <img src="images/status_paid.png">
      <p class="">Your booking status is <b class="text-warning wow flash animted" style="color: #58f53e;">Paid</b></p>
      <h1 style="font-size: 23px; text-transform: uppercase; font-family:gotham_bold">Thank you for your Payment, you are all set!</h1>
    </div>
    <?php } ?>
  </div>
</div>
</header>

    <?php if($booking_status != "paid"){  ?>
<div class="paynow">
 
  <div class="paynow_body"> <img class="top-bg" src="images/paynow_top.png"> <img class="left-bg" src="images/membership-left-bg.png"> <img class="right-bg" src="images/membership-right-bg.png">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="col-sm-1"> </div>
          <div class="col-sm-10" id="printcontent">
            <div class="section1">
              <div class="col-sm-12"> <img src="images/email-page-logo.png"> </div>
              <div class="col-sm-6 left">
                <h5>Tarzango</h5>
                <h6>415-680-3008</h6>
              </div>
              <div class="col-sm-6 right">
                <h5><?php echo $invoice->ai_first_name.' '.$invoice->ai_last_name; ?></h5>
                <h6><?php echo $invoice->ai_mobile; ?></h6>
              </div>
              <div class="col-sm-6 left">
                <p>Invoice Date:<span> <?php echo date("m/d/Y", strtotime($invoice->booking_date)); ?></span></p>
              </div>
              <div class="col-sm-6 right">
                <p>Invoice Number:<span> <?php echo $invoice->booking_ref_no; ?></span></p>
              </div>
            </div>
            <div class="section2">
              <h1><?php echo $book_response->activities[0]->content->name; ?></h1>
              <p class="left"><img src="images/checkin.png"> <?php echo $booking_extra_data->address; ?></p>
              <!-- <p class="right"><img src="images/email-call.png"> (702) 388-2400</p> -->
              <?php 
              for ($k=0; $k < count($book_response->activities[0]->content->media->images[0]->urls) ; $k++) { 
                if($book_response->activities[0]->content->media->images[0]->urls[$k]->sizeType == 'XLARGE'){
                  $img_disp = $book_response->activities[0]->content->media->images[0]->urls[$k]->resource;
                }
              }
              ?>
              <span></span> 
              <img class="img-responsive" src="<?php echo $img_disp; ?>" style="height: 400px !important;
    width: 100% !important;"> </div>
            <?php
            $child_count = count($booking_extra_data->kids_details);
            ?>
            <div class="section3">
              <div class="details">
                <div class="col-sm-9">
                  <h6>Tickets and Exucrsions</h6>
                  <!-- <h5><?php echo $booking_extra_data->adults; ?> adults </h5> -->
                  <h5><?php echo $booking_extra_data->adults; ?> adults
                    <?php if($child_count > 0){ echo "& ".$child_count." child (1 Day Pass)"; } ?>
                  </h5>
                </div>
                <div class="col-sm-3">
                  <h6>TOTAL AMOUNT</h6>
                  <h5>$ <?php echo $invoice->booking_total; ?></h5>
                </div>
              </div>
              <div class="boxes">
                <div class="box"> <img src="images/paynow_icon5.png">
                  <h6>CHECK IN</h6>
                  <h5><?php echo date("m/d/Y", strtotime($invoice->booking_checkin)); ?></h5>
                </div>
              </div>
              <div class="user_details"> 
                <!-- <h6>GUEST NAMES<span><?php echo $booking_extra_data->adults; ?> ADULTS </span></h6> -->
                <h6>GUEST NAMES<span><?php echo $booking_extra_data->adults; ?> ADULTS
                  <?php if($child_count > 0){ echo $child_count." CHILDREN"; } ?>
                  </span></h6>
                <ul>
                  <?php 
                  for ($i=0; $i < count($booking_extra_data->guest_details) ; $i++) { ?>
                  <li class="title">
                    <p>TIKET <?php echo $i + 1 ?></p>
                  </li>
                  <li class="username">
                    <h5 class="left"><?php echo $booking_extra_data->guest_details[$i]; ?></h5>
                  </li>
                  <?php } ?>
                  <?php 
                  for ($i=0; $i < count($booking_extra_data->kids_details) ; $i++) { ?>
                  <li class="title">
                    <p>TIKET <?php echo $i + 1 ?></p>
                  </li>
                  <li class="username">
                    <h5 class="left"><?php echo $booking_extra_data->kids_details[$i]; ?></h5>
                    <h5 class="right"><img src="images/paynow_icon6.png"> 2 Years</h5>
                  </li>
                  <?php } ?>
                  
                  <!-- <li class="username">
                    <h5 class="left">Noemi Vazon</h5>
                    <h5 class="right"><img src="images/paynow_icon6.png"> 2 Years</h5>
                  </li> -->
                </ul>
                <div class="col-sm-12"> 
                  <a class="button" id="pintbtn" style="cursor: pointer;">
                    <img src="images/paynow_icon7.png">PRINT INVOICE
                  </a> 
                  <a class="button" id="savepdf" style="cursor: pointer;">
                    <img src="images/paynow_icon8.png">DOWNLOAD INVOICE
                  </a> 

                  <?php if($booking_status == "unpaid" && time() < $expiryUnixtime){
                   ?>
                    <div class="button" style="width: 200px; float: right; margin-top: 30px;">
                      <button id="element_id_1470283647"></button>
                    </div>
                    <?php } ?></div>
              </div>
            </div>
          </div>
          <div class="col-sm-1"> </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php }else{ ?>

<?php 
  for ($k=0; $k < count($book_response->activities[0]->content->media->images[0]->urls) ; $k++) { 
    if($book_response->activities[0]->content->media->images[0]->urls[$k]->sizeType == 'XLARGE'){
      $img_disp = $book_response->activities[0]->content->media->images[0]->urls[$k]->resource;
    }
  }
?>
<div class="paynow-voucher" >
  
  <div class="paynow-voucher-body">
  <img class="top-bg" src="images/paynow_top.png">
  <img class="left-bg" src="images/details_update_sidegraphic1.png">
  <img class="right-bg" src="images/sidegraphics3.png">
    <div class="container" >
      <div class="row">
        <div class="col-sm-12">
          <div class="col-sm-1">
          
          </div>
          <div class="col-sm-10 content-box">
            <div class="list" id="printcontent_1">
              <h1>Vouchers</h1>
              <?php 
              $main_p =  number_format($invoice->booking_total,2);
              $per_p = $main_p / (count($booking_extra_data->guest_details) + count($booking_extra_data->kids_details));
              for ($i_i=0; $i_i < count($booking_extra_data->guest_details) ; $i_i++) { ?>
               <div class="box">
                <div class="col-sm-9">
                  <h6>tickets and exucrions</h6>
                  <h3><?php echo $book_response->activities[0]->content->name; ?></h3>
                  <div class="address">
                    <h5><img src="images/checkin.png"> <?php echo $booking_extra_data->address; ?></h5>
                    <!-- <h5><img src="images/email-call.png"> (619) 231-1515</h5> -->
                  </div>
                  <h5><img src="images/vouchar_icon1.png"> <?php echo $booking_extra_data->guest_details[$i_i]; ?></h5>
                  <h4>1 Adult (1 Day Pass)<span>$ <?php echo number_format($per_p,2); ?></span></h4>
                </div>
                <div class="col-sm-3">
                  <img class="img-responsive" src="<?php echo $img_disp; ?>" style="height: 250px;">
                </div>
              </div>
             <?php   } 
              for ($i_i=0; $i_i < count($booking_extra_data->kids_details) ; $i_i++) { ?>
               <div class="box">
                <div class="col-sm-9">
                  <h6>tickets and exucrions</h6>
                  <h3><?php echo $book_response->activities[0]->content->name; ?></h3>
                  <!-- <div class="address">
                    <h5><img src="images/checkin.png"> 2920 Zoo Dr.San Diego, CA 92101</h5>
                    <h5><img src="images/email-call.png"> (619) 231-1515</h5>
                  </div> -->
                  <h5><img src="images/vouchar_icon1.png"> <?php echo $booking_extra_data->kids_details[$i_i]; ?></h5>
                  <h4>1 Kid (1 Day Pass)<span>$ <?php echo number_format($per_p,2); ?></span></h4>
                </div>
                <div class="col-sm-3">
                  <img class="img-responsive" src="<?php echo $img_disp; ?>" style="height: 250px;">
                </div>
              </div>
             <?php   } ?>
              

            </div>
         
            <div class="buttons">
              <div class="disp_message" style=" margin-left: 15px;margin-right: 15px;"></div>
              <div class="col-sm-2">
              </div>
              <div class="col-sm-4">
              <input type="hidden" value="<?php echo ($profile[0]->accounts_email);?>" class="form-control form" id="invoiceemail" name="email" required="">
                <a style="cursor: pointer;" id="send_by_email" ><img src="images/vouchar_icon2.png"> send by email</a>
              </div>
              <div class="col-sm-4">
                <a id="savepdf_1" style="cursor: pointer;"><img src="images/vouchar_icon3.png"> download pdf</a>
              </div>
              <div class="col-sm-2">
              </div>
            </div>
          </div>
          <div class="col-sm-1">
          
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>
</div>
<div id="imgs"> </div>
<?php 
$repl_arry = array(".",",");
?>
<script src="<?php echo $theme_url; ?>js/jspdf.min.js"></script> 
<script src='<?php echo $theme_url; ?>js/html2canvas.js'></script> 
<script src='<?php echo $theme_url; ?>js/canvas2image.js'></script>  
<script type="text/javascript">
   $(function() { 
     
      $("#send_by_email").click(function() { 

          html2canvas($("#printcontent_1"), {
              "proxy":"../html2canvasproxy",
              onrendered: function(canvas) {
                  var img = new Image();
                        img.onload = function() {
                            img.onload = null;
                            //document.body.appendChild(img);
                        };
                        img.onerror = function() {
                            img.onerror = null;
                            if(window.console.log) {
                                window.console.log("Not loaded image from canvas.toDataURL");
                            } else {
                                //alert("Not loaded image from canvas.toDataURL");
                            }
                        };
            
                        var img = canvas.toDataURL("image/png");
                        var DocumentContainer = document.getElementById('imgs');


                       /* img_data_p = Canvas2Image.convertToImage(canvas, w, h, type);
                        console.log(img_data_p);*/
                        
                       // var WindowObject = window.open('', 'PrintWindow', 'toolbars=no,scrollbars=yes,status=no,resizable=yes');
                     /* 
                        WindowObject.document.close();*/
                        
                       /* WindowObject.focus();
                        WindowObject.print();
                        WindowObject.close();*/
                  
                         var image = '<img src="'+img+'">';
                         var to_email = $('#invoiceemail').val();
                         var url = '<?php echo base_url(); ?>';
                          
                      
                            $.ajax({
                                   type: 'POST',
                                   data: {
                                       to_email: to_email,
                                       image: image
                                   },
                                  
                                   url: url + "admin/ajaxcalls/invoice_ticket_email",
                                   cache: false,
                                   beforeSend: function() {

                                   },
                                   success: function(response) {
                                       console.log(response);
                                       $('#invoiceemail').val('');
                                       $('.disp_message').html("<div class='alert alert-success'>Your booking email has been sent.</div>");
                                   }
                               });
              }
          });


                         
      });
      $("#savepdf").click(function() { 

          html2canvas($("#printcontent"), {
              "proxy":"../html2canvasproxy",
              onrendered: function(canvas) {
                  var img = new Image();
                        img.onload = function() {
                            img.onload = null;
                            //document.body.appendChild(img);
                        };
                        img.onerror = function() {
                            img.onerror = null;
                            if(window.console.log) {
                                window.console.log("Not loaded image from canvas.toDataURL");
                            } else {
                                //alert("Not loaded image from canvas.toDataURL");
                            }
                        };
                        var img = canvas.toDataURL("image/png");
                  
                  var imgData = img;
                  var doc = new jsPDF();

                  doc.addImage(imgData, 'png', 15, 15, 180, 275);
                  doc.save('invoice.pdf');
              }
          });
      });
      //$(document).ready(function(){
      $("#savepdf_1").click(function() { 

          html2canvas($("#printcontent_1"), {
              "proxy":"../html2canvasproxy",
              onrendered: function(canvas) {
                  var img = new Image();
                        img.onload = function() {
                            img.onload = null;
                            //document.body.appendChild(img);
                        };
                        img.onerror = function() {
                            img.onerror = null;
                            if(window.console.log) {
                                window.console.log("Not loaded image from canvas.toDataURL");
                            } else {
                                //alert("Not loaded image from canvas.toDataURL");
                            }
                        };
                         var img = canvas.toDataURL("image/jpeg");
                        var imgData = img;
                        var img1 = new Image();
                        img1.src = imgData;

                       // img1.onload = function(){
                          var imgSize = {
                             w: img1.width,
                             h: img1.height
                          };
                          //alert( imgSize.w +' '+ imgSize.h );
                        //};
                  /*console.log(imgData);
                  console.log(imgData.height);*/
                  console.log(imgSize.w +' '+ imgSize.h);
                  var wi = imgSize.w / 5;
                  var hi = imgSize.h / 5;
                  if (wi == 0) {
                    wi = 190;
                  }
                 /* if (hi == 0) {
                    hi = 
                  }*/
                  console.log(wi);
                  console.log(hi);
                  var doc = new jsPDF();

                  doc.addImage(imgData, 'png', 10, 10, wi, hi);
                  doc.save('invoice.pdf');
              }
          });
      });
  }); 
    <?php if($booking_status == "unpaid" && $booking_status != 'cancelled' && time() < $expiryUnixtime){  ?>
  var PayStand = PayStand || {};
  PayStand.checkouts = PayStand.checkouts || [];
  PayStand.load = PayStand.load || function(){};
  var checkout = {
  //api_key: "aiPjqMbXh79vnMDqBVeq1xtM6VIx0LGVfu4ifqQONbm8PrS2GRinF/TDsoMeqeHUJfJ6Xrp9FSGrn2ehugEX8/w",
  api_key: "aUGXTVXIQWzpuRpHZiBjJIs01C5HWowACqx5aOLFQ49xh2JnbGbkKwol1jR5MwY3kIkjHogLXwEpno1kkrQEM3w",
  //org_id: "15191",
  org_id: "760",
  element_ids: ["element_id_1470283648"],
  data_source: "org_defined",
  checkout_type: "button",
  button_options: {
  button_type: "checkout",
  button_name: "Pay Now",
  input: false,
  variants: false
  },
  amount: "<?php echo str_replace($repl_arry,'',number_format($invoice->booking_total,2));?>",
  //amount: "100",
  items: [{
  title: "Reservation Payment",
  subtitle: "Payment to lock reservation in TarzanGo",
  item_price: "<?php echo str_replace($repl_arry,'',number_format($invoice->booking_total,2));?>",
  //item_price: "100",
  quantity: 1
  }],
  }
  PayStand.checkoutComplete = function (data) {
    $.ajax({
        type: 'POST',
        data:{pay_data : data , pt_attr_booking_id : <?php echo $invoice->pt_attr_booking_id; ?> , booking_ref_no : <?php echo $invoice->booking_ref_no; ?> },
        url: '<?php echo base_url();?>attraction/booking_paid_paystand',
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
  //PayStand.script.src = 'https://app.paystand.com/js/gen/checkout.min.js';
  PayStand.script.src = 'https://sandbox.paystand.com/js/gen/checkout.min.js';
  var s = document.getElementsByTagName('script')[0];
  s.parentNode.insertBefore(PayStand.script, s);

  var PayStand = PayStand || {};
  PayStand.checkouts = PayStand.checkouts || [];
  PayStand.load = PayStand.load || function(){};
  var checkout = {
  //api_key: "aiPjqMbXh79vnMDqBVeq1xtM6VIx0LGVfu4ifqQONbm8PrS2GRinF/TDsoMeqeHUJfJ6Xrp9FSGrn2ehugEX8/w",
  api_key: "aUGXTVXIQWzpuRpHZiBjJIs01C5HWowACqx5aOLFQ49xh2JnbGbkKwol1jR5MwY3kIkjHogLXwEpno1kkrQEM3w",
  //org_id: "15191",
  org_id: "760",
  element_ids: ["element_id_1470283647"],
  data_source: "org_defined",
  checkout_type: "button",
  button_options: {
  button_type: "checkout",
  button_name: "Pay Now",
  input: false,
  variants: false
  },
  amount: "<?php echo str_replace($repl_arry,'',number_format($invoice->booking_total,2));?>",
  //amount: "100",
  items: [{
  title: "Reservation Payment",
  subtitle: "Payment to lock reservation in TarzanGo",
  item_price: "<?php echo str_replace($repl_arry,'',number_format($invoice->booking_total,2));?>",
  //item_price: "100",
  quantity: 1
  }],
  }
  PayStand.checkoutComplete = function (data) {
    $.ajax({
        type: 'POST',
        data:{pay_data : data , pt_attr_booking_id : <?php echo $invoice->pt_attr_booking_id; ?> , booking_ref_no : <?php echo $invoice->booking_ref_no; ?> },
        url: '<?php echo base_url();?>attraction/booking_paid_paystand',
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
  //PayStand.script.src = 'https://app.paystand.com/js/gen/checkout.min.js';
  PayStand.script.src = 'https://sandbox.paystand.com/js/gen/checkout.min.js';
  var s = document.getElementsByTagName('script')[0];
  s.parentNode.insertBefore(PayStand.script, s);

   /*function initMap() {*/
          
       /* }*/
    // set the date we're counting down to
    // var target_date = new Date('<?php echo $invoice->expiryFullDate; ?>').getTime();
    var target_date = <?php echo $expiryUnixtime * 1000; ?>;
    var invoiceStatus = "<?php echo $booking_status; ?>";

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
        countdown.innerHTML = '<span class="days">' + days +  ' <b>Days</b></span> <span class="hours">' + hours + ' <b>Hours</b></span> <span class="minutes">'
        + minutes + ' <b>Minutes</b></span> <span class="seconds">' + seconds + ' <b>Seconds</b></span>';

        }, 1000);

    }

  <?php } ?>
</script>