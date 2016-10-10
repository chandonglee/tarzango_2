<?php 
/*echo json_encode($invoice);
exit();*/
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
.clearfix {
	border: medium none;
	clear: both;
	float: none;
	font-size: 0;
	height: 0;
	line-height: 0;
}
.left-in {
	display: inline-block;
	margin: 15px 2% 30px;
	float: none !important;
}
.hotel-icon {
	margin-top: 15px 0px;
	color: #373b71;
	text-transform: uppercase;
	font-size: 12px;
	font-weight: bold;
}
.p-bottom0 {
	padding-bottom: 0px !important;
}
.w70 {
	width: 42% !important;
}
.w30 {
	width: 20% !important;
}

@media (max-width: 767px) {
.section3 {
	padding: 20px !important;
}
.w70 {
	width: 100% !important;
}
.w30 {
	width: 100% !important;
}
}

@media(min-width: 1000px) {
.img-responsive, .thumbnail > img, .thumbnail a > img, .carousel-inner > .item > img, .carousel-inner > .item > a > img {
	display: block;
	height: 400px !important;
	width: 100% !important;
}
}

@media(min-width: 1600px) {
.img-responsive, .thumbnail > img, .thumbnail a > img, .carousel-inner > .item > img, .carousel-inner > .item > a > img {
	display: block;
	height: 450px !important;
	width: 100% !important;
}
}
</style>
<script src='<?php echo $theme_url; ?>js/custom.js'></script>
<?php 

/*
echo json_encode($invoice);
exit();
echo "string";
error_reporting(E_ALL);
exit();*/
if(!isset($page_title_1)) {


  $book_response = json_decode($invoice->book_response);
  $car_response = $invoice->car_booking;
$car_data = $invoice->car_booking;
/*echo $car_data->book_response;
exit();*/
$car_book_response = json_decode($car_data->book_response);
  
  $Extra_data = $invoice->Extra_data;
 ?>

<!-- list View block   -->
<header class="pay-header">

<div class="container">
  <div class="row">
    <div class="col-lg-1 col-md-1 col-sm-1  col-xs-6"> <a class="logo-pay" href="<?php echo base_url(); ?>"> <img src="images/pay-logo.png" > </a> </div>
    <div class="col-lg-10 col-md-10 col-sm-10 hidden-xs"> </div>
    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-6">
      <div class="menu-icon">
        <?php include $themeurl.'views/menu_header.php';?>
        <script>
                       $(".close-button").click(function(){
    $(".menu-dropdown").toggle();
    
  });
                     </script> 
      </div>
    </div>
  </div>
  <div class="row">
    <?php if($invoice->status == "unpaid"){ 
            if(time() < $invoice->expiryUnixtime){  ?>
    <div class="pay-block"> <img src="images/watch-icon.png">
      <h1 class="wow fadeInLeft animated" id="countdown"></h1>
      <p class=""><?php echo trans('0409');?> <b class="text-warning wow flash animted" style="color: #fe5050;"><?php echo trans('082');?></b></p>
      <div class="form-group">
        <?php if($payOnArrival){ ?>
        <button class="btn-arrival arrivalpay" data-module="<?php echo $invoice->module; ?>" id="<?php echo $invoice->id;?>"><?php echo trans('0345');?></button>
        <?php } 
        if($singleGateway != "payonarrival"){ ?>
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
      <p class=""><?php echo trans('0409');?> <b class="text-warning wow flash animted" style="color: #fe5050;"><?php echo trans('0519');?></b></p>
    </div>
    <?php } }elseif($invoice->status == "reserved"){ ?>
    <div class="pay-block">
      <p class=""><?php echo trans('0409');?> <b class="text-warning wow flash animted" style="color: #fe5050;"><?php echo trans('0445');?></b></p>
    </div>
    <?php }elseif($invoice->status == "cancelled"){ ?>
    <div class="pay-block">
      <p class=""><?php echo trans('0409');?> <b class="text-warning wow flash animted" style="color: #fe5050;"><?php echo trans('0347');?></b></p>
    </div>
    <?php  }else{ ?>
    <div class="pay-block"> <img src="images/status_paid.png">
      <p class=""><?php echo trans('0409');?> <b class="text-warning wow flash animted" style="color: #58f53e;"><?php echo trans('081');?></b></p>
      <h1 style="font-size: 30px; text-transform: uppercase; font-family:'Gotham-Bold'">Thank you for your Payment, you are all set!</h1>
    </div>
    <?php } ?>
  </div>
</div>
</header>
<div class="paynow" >
  <div class="paynow_body"> 
  <img class="top-bg" src="images/paynow_top.png"> 
  <img class="left-bg" src="images/membership-left-bg.png"> 
  <img class="right-bg" src="images/membership-right-bg.png">
    <div class="container" >
      <div class="row">
        <div class="col-sm-12">
          <div class="col-sm-1"> </div>
          <div class="col-sm-10"  id="printcontent">
            <div class="section1">
              <div class="col-sm-12"> <img src="images/email-page-logo.png"> </div>
              <div class="col-sm-6 left">
                <h5><strong>Tarzango</strong></h5>
                <h6>415-680-3008</h6>
              </div>
              <div class="col-sm-6 right">
                <h5><strong><?php echo $invoice->userFullName;?></strong></h5>
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
              <div class="stars"> <?php echo $invoice->stars;?> </div>
              <h1><?php echo $invoice->title;?></h1>
              <div class="text-center">
                <p class="left-in"><img src="images/checkin.png"> <?php echo $invoice->location;?> </p>
                <?php if($invoice->hotel_phone != "") {?>
                <p class="left-in"><img src="images/email-call.png"> <?php echo $invoice->hotel_phone; ?> </p>
                <?php }else{ ?>
                <p class="left-in"><img src="images/email-call.png"> +1234567890 </p>
                <span></span>
                <?php } ?>
                <div class="clearfix"></div>
              </div>
              <img class="img-responsive" src="<?php echo str_replace("demo.", "", $invoice->thumbnail);?>"> </div>
            <div class="section3">
              <div class="details details01">
                <div class="col-sm-3">
                  <h6>CONFIRMATION #</h6>
                  <h5><?php echo $invoice->code; ?></h5>
                </div>
                <div class="col-sm-3">
                  <h6>ROOM RATE</h6>
                  <h5>$ <?php echo $invoice->subItem->price; ?></h5>
                </div>
                <?php if ( !empty($car_data) ){?>
                <div class="col-sm-3">
                  <h6>Transfer Rate</h6>
                  <h5>$ <?php echo $car_data->booking_total; ?></h5>
                </div>
                <?php } ?>
                <div class="col-sm-3">
                  <h6>TOTAL AMOUNT</h6>
                  <h5>$ <?php 
                  
                  $totalRate = $invoice->checkoutTotal + $car_data->booking_total;

                  echo str_replace(".00",'',number_format($totalRate,2));?></h5>

                </div>
                
                <div class="clearfix"></div>
              </div>
              <div class="clearfix"></div>
              <div class="boxes">
                <h3 class="hotel-icon"><img src="images/h-icon.png"> Hotel</h3>
                <div class="box"> <img src="images/paynow_icon2.png">
                  <h6>BOARD TYPE</h6>
                  <h5>All Inclusive</h5>
                </div>
                <div class="box"> <img src="images/paynow_icon3.png">
                  <h6>ROOMS</h6>
                  <h5><?php echo $invoice->subItem->quantity; ?></h5>
                </div>
                <div class="box last"> <img src="images/paynow_icon4.png">
                  <h6>TYPE</h6>
                  <h5><?php echo  character_limiter($invoice->subItem->title,5); ?></h5>
                </div>
                <div class="clearfix"></div>
                <div class="box"> <img src="images/paynow_icon5.png">
                  <h6>CHECK IN</h6>
                  <h5><?php echo $invoice->checkin; ?></h5>
                </div>
                <div class="box "> <img src="images/paynow_icon5.png">
                  <h6>CHECK OUT</h6>
                  <h5><?php echo $invoice->checkout; ?></h5>
                </div>
                <div class="box last"> <img class="m-bottom0" src="images/you-saved.png">
                  <h6>YOU SAVED</h6>
                  <?php 
                  $abc = $Extra_data->normal_price - $total_main;
                  if($abc < 0){
                    $save = '0';

                  }else{
                    $save = number_format($Extra_data->normal_price - $total_main,0);
                  } ?>
                  <h5><?php echo '$ '.$save; ?></h5>
                </div>
                <div class="clearfix"></div>
<?php if ( !empty($car_data )) { ?>
                <div class="hr-color"></div>
                <h3 class="hotel-icon"><img src="images/car-icon.png"> Arrival Transfer</h3>
                <div class="box">
                  <h4 class="new-tital-i">Private Luxury (Sedan)</h4>
                  <h6> Pick Up Date</h6>
                  <h5><?php echo $invoice->checkin; ?></h5>
                </div>
                <div class="box"> <img src="images/DepartureTime.png">
                  <h6>Arrival Time</h6>
                  <h5><?php echo $car_data->pickup_time; ?></h5>
                </div>
                <div class="box last"> <img src="images/flightCode.png">
                  <h6>flight Code</h6>
                  <h5><?php echo $car_data->dep_flight_code; ?></h5>
                </div>
                <div class="clearfix"></div>
                <div class="box"> <img src="images/Travellers.png">
                  <h6>Travellers</h6>
                  <h5><?php echo $invoice->Extra_data->adults; ?> ADULTS
                  <?php $chil = $Extra_data->child; if($chil){ echo $chil; ?>
                  CHILDREN
                  <?php } ?></h5>
                </div>
                <div class="box w70">
                  <h6>From</h6>
                    <h5><?php 

                   // echo json_encode($car_book_response);
                        if (  $car_data->book_type == "round"){
                            
                            foreach ($car_book_response->Purchase->ServiceList->Service as $value) {
                                if ($value->attributes->transferType == "IN"){
                                  echo $value->PickupLocation->Name;  
                                }                              
                             }
                         } else {
                          
                           echo  $car_book_response->Purchase->ServiceList->Service->PickupLocation->Name; 
                         }  
                  ?></h5>
                  <h6>To</h6>
                  <h5><?php 

                      if (  $car_data->book_type == "round"){
                    foreach ($car_book_response->Purchase->ServiceList->Service as $value) {
                              if ($value->attributes->transferType == "OUT"){
                                echo $value->DestinationLocation->LocationDescription;  
                              }                              

                           } 
                         }else {
                          echo  $car_book_response->Purchase->ServiceList->Service->DestinationLocation->LocationDescription; 
                         }

                    ?></h5>
                </div>
                <div class="box w30 last"> <img src="images/Price.png">
                  <h6>Price</h6>
                  <h5><?php 
                    if (  $car_data->book_type == "round"){
                      echo $car_data->booking_total / 2; 
                    } else {
                      echo $car_data->booking_total;
                    }
                  

                  ?></h5>
                </div>
                <div class="clearfix"></div>
					<?php 

                  if (  $car_data->book_type == "round"){
                    foreach ($car_book_response->Purchase->ServiceList->Service as $value) {
                          /*echo json_encode($value);
                          echo "<br>";
                          echo "<br>";
                          echo "<br>";
                          echo "<br>";*/
                        if ($value->attributes->transferType == "IN"){

                            $in_time = $value->CancellationPolicies->CancellationPolicy->attributes->time;
                            $in_date = $value->CancellationPolicies->CancellationPolicy->attributes->dateFrom;
                            $in_amount = $value->CancellationPolicies->CancellationPolicy->attributes->amount;
                        } 

                        if ($value->attributes->transferType == "OUT"){
                            $out_time = $value->CancellationPolicies->CancellationPolicy->attributes->time;
                            $out_date = $value->CancellationPolicies->CancellationPolicy->attributes->dateFrom;
                            $out_amount = $value->CancellationPolicies->CancellationPolicy->attributes->amount;
                        }                              
                    } 
                  } else {
                    
                          $in_time = $car_book_response->Purchase->ServiceList->Service->CancellationPolicies->CancellationPolicy->attributes->time;
                            $in_date = $car_book_response->Purchase->ServiceList->Service->CancellationPolicies->CancellationPolicy->attributes->dateFrom;
                            $in_amount = $car_book_response->Purchase->ServiceList->Service->CancellationPolicies->CancellationPolicy->attributes->amount;
                        
                  }
                    
                ?>
                <div class="freecancellation">
                  <h3>Free cancellation until <?php echo date('m/d/Y',strtotime($in_date));?></h3>

                  <p class="red-ti">In the event of cancellation after <?php echo $in_time;?> on <?php echo date('m/d/Y',strtotime($in_date));?> &nbsp; &nbsp;
                    the following charges will be applied: $ <?php echo $in_amount;?></p>
                  <p>Date and time is calculated based on local time of destination.</p>
                </div>
                <div class="clearfix"></div>
<?php 
                      if ($car_data->book_type == "round"){

                 ?>
                <div class="oneway-book-invoice">
                
                <div class="hr-color"></div>                
                <h3 class="hotel-icon"><img src="images/car-icon.png"> Departure Transfer</h3>
                <div class="box">
                  <h4 class="new-tital-i">Private Luxury (Sedan)</h4>
                  <h6> Pick Up Date</h6>
                  <h5><?php echo $invoice->checkout; ?></h5>

                </div>
                <div class="box"> <img src="images/DepartureTime.png">
                  <h6>Departure Time</h6>
                  <h5><?php echo $car_data->drop_time; ?></h5>
                </div>
                <div class="box last"> <img src="images/flightCode.png">
                  <h6>flight Code</h6>
                  <h5><?php echo $car_data->arv_flight_code; ?></h5>
                  
                </div>
                <div class="clearfix"></div>
                <div class="box"> <img src="images/Travellers.png">
                  <h6>Travellers</h6>
                  <h5><?php echo $invoice->Extra_data->adults; ?> ADULTS
                  <?php $chil = $Extra_data->child; if($chil){ echo $chil; ?>
                  CHILDREN
                  <?php } ?></h5>
                </div>
                <div class="box w70">
                  <h6>From</h6>

                  <h5><?php 
                      

                    foreach ($car_book_response->Purchase->ServiceList->Service as $value) {
                              if ($value->attributes->transferType == "IN"){
                                echo $value->DestinationLocation->LocationDescription;  
                              }                              
                           } 

                    ?></h5>

                  

                  <h6>To</h6>
                  <h5><?php 
                          foreach ($car_book_response->Purchase->ServiceList->Service as $value) {
                              if ($value->attributes->transferType == "OUT"){
                                echo $value->PickupLocation->Name;  
                              }                              
                           }
                  ?></h5>
                </div>
                <div class="box w30 last"> <img src="images/Price.png">
                  <h6>Price</h6>
                  <h5><?php 
                  if (  $car_data->book_type == "round"){
                      echo $car_data->booking_total / 2; 
                    } else {
                      echo $car_data->booking_total;
                    }
                  ?></h5>
                </div>
                <div class="clearfix"></div>
                <div class="freecancellation">
                
                  <h3>Free cancellation until <?php echo date('m/d/Y',strtotime($out_date));?></h3>
                  <p class="red-ti">In the event of cancellation after <?php echo $out_time;?> on <?php echo date('m/d/Y',strtotime($out_date));?> &nbsp; &nbsp;
                    the following charges will be applied: $ <?php echo $out_amount;?></p>
                  <p>Date and time is calculated based on local time of destination.</p>
                </div>
                <div class="clearfix"></div>
                </div>
                <?php } ?>
              <?php } ?>
              </div>
              <div class="user_details">
                <h6>GUEST NAMES<span><?php echo $invoice->subItem->booking_adults; ?> ADULTS
                  <?php $chil = $Extra_data->child; if($chil){ echo $chil; ?>
                  CHILDREN
                  <?php } ?>
                  </span></h6>
                <ul>
                  <?php

                  $book_room = $invoice->subItem->quantity;
                  $booking_adults = $invoice->subItem->booking_adults;
                  $room_per_guest = $booking_adults / $book_room;
                  for ($r_i=0; $r_i < $book_room ; $r_i++) {       ?>
                  <li class="title">
                    <p>ROOM <?php echo $r_i + 1; ?></p>
                  </li>
                  <?php 
                  for($g_d_a=0; $g_d_a < $room_per_guest; $g_d_a++){
                ?>
                  <li class="username">
                    <h5 class="left"><?php echo $Extra_data->guest_name[$g_d_a+ $r_i]; ?></h5>
                    <h5 class="right"><?php echo $Extra_data->guest_age[$g_d_a+ $r_i]; ?> Years</h5>
                  </li>
                  <?php } ?>
                  <?php } ?>
                  <?php if($chil > 0){  ?>
                  <li class="title">
                    <p>CHILD DETAILS</p>
                  </li>
                  <?php 
                    for($c_i=0;$c_i<$chil;$c_i++){
                  ?>
                  <li class="username">
                    <h5 class="left"><?php echo $Extra_data->child_name[$c_i]; ?></h5>
                    <h5 class="right"><img src="images/paynow_icon6.png"> <?php echo $Extra_data->child_age[$c_i]; ?> Years</h5>
                  </li>
                  <?php }  ?>
                </ul>
                <?php } ?>
                <div class="col-sm-12 cancellation"  style=" padding:20px">
                  <h6>The cancellation policy</h6>
                  </br>
                  <p>Here at Tarzango, we offer a hassle free Cancellation Option. Last Minute change of plans? No problem mate! We allow 7 days prior to you arrival for cancellations, without any fees or penalties.</p>
                  </br>
                  <p>For Cancellation Requests within 7 days of check in, any associated fees are at the hotel’s discretion. If applicable, we will refund 50% back to the cardholders card. Refunds will be issued between 24 to 48 hours after an email for cancellation has been sent and approved. Policy may vary for reservations consisting of 10 rooms or more.</p>
                  </br>
                  <p>To make a change to your reservation, please email: <span>booking@tarzango.com</span>. </p>
                  </br>
                  <p>Be sure to check your email within 24 hours for confirmation of your change.</p>
                  </br>
                  <p>To cancel your entire reservation, please email cancel@tarzango.com. Please note: We can only accept cancellation via writing to: <span>cancel@tarzango.com</span>. Cancelations will not be submitted via phone or chat, only through written email to <span>cancel@tarzango.com</span>.</p>
                </div>

              </div>
            </div>

            <div class="col-sm-1">
              <?php if($extra_details->location != ''){ ?>
              <div class="pay-type-block "> <span class="single-type pay-col" >
                <h2> Pickup Details </h2>
                <div class="pay-single-btn" style="width:100%; padding-left: 22px; text-align:left;"><?php echo $extra_details->location; ?></div>
                </span> <span class="single-type pay-col" >
                <h2> Pickup time </h2>
                <div class="pay-single-btn" style="width:100%; padding-left: 22px; text-align:left;"><?php echo $extra_details->time; ?></div>
                </span> </div>
              <?php } ?>
            </div>
          </div>
          
          <div class="paynow_body">
            <div class="col-sm-1">&nbsp;</div>

                  <div class="col-sm-10" style="margin-bottom: 30px; border: none;"> 
                    <a class="button btn_ps" id="pintbtn"><img src="images/paynow_icon7.png"> PRINT INVOICE</a> <a class="button btn_ps" id="savepdf"><img src="images/paynow_icon8.png"> DOWNLOAD INVOICE</a>
                     <?php if($invoice->status == "unpaid"){ 
                      if(time() < $invoice->expiryUnixtime){  ?>
                    <div style="" class="button">
                      <button id="element_id_1470283647"></button>
                    </div>
                    <?php } } ?>
                  </div>
                  <div class="col-sm-1">&nbsp;</div>
                </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="imgs"> </div>
<style type="text/css">
.btn_ps{
  float: left;
    width: 30%;
    margin-right: 20px;
    background-color: #fff;
    border: 1px solid #edeaf2;
    border-radius: 4px;
    color: #0c134f;
    font-size: 11px;
    font-family: 'Gotham-Bold';
    text-align: center;
    padding: 15px 0px;
   /* margin-top: 30px;*/
    line-height: 25px;
    cursor: pointer;
}

</style>
<!-- 

 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAH65sTGsDsP4mMpmbHC8zqRiM1Qh07iL8&callback=initMap">
    </script>  

-->
<?php 
$repl_arry = array(".",",");
?>
<script src="<?php echo $theme_url; ?>js/jspdf.min.js"></script> 
<script src='<?php echo $theme_url; ?>js/html2canvas.js'></script> 
<script src='<?php echo $theme_url; ?>js/canvas2image.js'></script> 
<script type="text/javascript">

  $(function() { 
      $("#pintbtn").click(function() { 

         html2canvas($("#printcontent"), {
              "proxy":"html2canvasproxy",
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
                        var img_data_p = canvas.toDataURL("image/png");
                  
                  var DocumentContainer = document.getElementById('imgs');
                  var WindowObject = window.open('', 'PrintWindow', 'toolbars=no,scrollbars=yes,status=no,resizable=yes');

                  WindowObject.document.writeln('<img src="'+img_data_p+'">');
                  WindowObject.document.close();
                  WindowObject.focus();
                  WindowObject.print();
                  WindowObject.close();

                  
              }
          });
      });
       $("#savepdf").click(function() { 

          html2canvas($("#printcontent"), {
              "proxy":"html2canvasproxy",
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
                  
                        var img1 = new Image();
                        img1.src = img;

                          var imgSize = {
                             w: img1.width,
                             h: img1.height
                          };
                          console.log(img1.width +' *-* '+ img1.height);
                          var imgWidth = 180; 
                          var pageHeight = 295;
                          var imgHeight = imgSize.h * imgWidth / imgSize.w;
                          var heightLeft = imgHeight;

                                            var imgData = img;
                                            var doc = new jsPDF('p', 'mm');

                                            //doc.addImage(imgData, 'png', 15, 15, 180, 297);
                          var position = 15;
                          console.log(imgWidth+'--0++'+imgHeight);
                                            doc.addImage(imgData, 'png', 15, position, imgWidth , imgHeight);
                          heightLeft -= pageHeight;

                          while (heightLeft >= 0) {
                            position = heightLeft - imgHeight;
                            doc.addPage();
                          console.log(imgWidth+'--0++'+imgHeight);
                            doc.addImage(imgData, 'png', 15, position, imgWidth, imgHeight);
                            heightLeft -= pageHeight;
                          }

                  doc.save('invoice.pdf');
              }
          });
      });
  }); 

 <?php if($invoice->status == "unpaid"){ 
                      if(time() < $invoice->expiryUnixtime){  ?>
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
  amount: "<?php echo str_replace($repl_arry,'',number_format($totalRate,2));?>",
  //amount: "100",
  items: [{
  title: "Reservation Payment",
  subtitle: "Payment to lock reservation in TarzanGo",
  item_price: "<?php echo str_replace($repl_arry,'',number_format($totalRate,2));?>",
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
  amount: "<?php echo str_replace($repl_arry,'',number_format($totalRate,2));?>",
  //amount: "100",
  items: [{
  title: "Reservation Payment",
  subtitle: "Payment to lock reservation in TarzanGo",
  item_price: "<?php echo str_replace($repl_arry,'',number_format($totalRate,2));?>",
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
  //PayStand.script.src = 'https://app.paystand.com/js/gen/checkout.min.js';
  PayStand.script.src = 'https://sandbox.paystand.com/js/gen/checkout.min.js';
  var s = document.getElementsByTagName('script')[0];
  s.parentNode.insertBefore(PayStand.script, s);

   /*function initMap() {*/
          
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

<?php } } ?>



      
</script>
<?php } ?>
