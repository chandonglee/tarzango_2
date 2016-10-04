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

/*echo json_encode($invoice);
exit();*/
if(isset($page_title_1)) {
  /*$invoice = $invoice[0];*/
  if($invoice->book_cancelnumber == null){
    $invoice->status = 'unpaid';
  }else{
    $invoice->status = 'paid';
  }

  $book_response = json_decode($invoice->book_response);
  $Extra_data = $invoice->Extra_data;
  $invoice->expiryUnixtime = strtotime(date('Y-m-d H:i:s', strtotime('+24 hours', strtotime($invoice->created_date))));
  
  //$invoice->expiryUnixtime = strtotime();
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
    <?php if($invoice->status == "unpaid"){ if(time() < $invoice->expiryUnixtime){  ?>
    <div class="pay-block"> <img src="images/watch-icon.png">
      <h1 class="wow fadeInLeft animated" id="countdown"></h1>
      <p class=""><?php echo trans('0409');?> <b class="text-warning wow flash animted" style="color: #fe5050;"><?php echo trans('082');?></b></p>
      <div class="form-group">
        <?php if($payOnArrival){ ?>
        <button class="btn-arrival arrivalpay" data-module="<?php echo $invoice->module; ?>" id="<?php echo $invoice->id;?>"><?php echo trans('0345');?></button>
        <?php } if($singleGateway != "payonarrival"){ ?>
        <button data-toggle="modal" style="display:none;"  data-target="#paynow" type="submit" class="btn btn-primary"><?php echo trans('0117');?></button>
        <button data-toggle="modal" style="display:none;"  data-target="#paynow" type="button" id="gateway_pro" class="btn btn-primary"><?php echo trans('0117');?></button>
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
      <h1 style="font-size: 30px; text-transform: uppercase; font-family:'Gotham-Bold'">Thank you for your Payment, you are all set</h1>
    </div>
    <?php } ?>
  </div>
</div>
</header>
<div class="paynow" >
  <div class="paynow_body"> <img class="top-bg" src="images/paynow_top.png"> <img class="left-bg" src="images/membership-left-bg.png"> <img class="right-bg" src="images/membership-right-bg.png">
    <div class="container" >
      <div class="row">
        <div class="col-sm-12">
          <div class="col-sm-1"> </div>
          <div class="col-sm-10"  id="printcontent">
            <div class="section1">
              <div class="col-sm-12"> <img src="images/email-page-logo.png"> </div>
              <div class="col-sm-6 left">
                <h5>Tarzango</h5>
                <h6>415-680-3008</h6>
              </div>
              <div class="col-sm-6 right">
                <h5><?php echo $invoice->ai_first_name.' '.$invoice->ai_last_name;?></h5>
                <h6><?php echo $invoice->ai_mobile;?></h6>
              </div>
              <div class="col-sm-6 left">
                <p>Invoice Date:<span> <?php echo date("m/d/Y", strtotime($invoice->created_date)); ?></span></p>
                <!-- <p>Due Date:<span> <?php echo $invoice->expiry;?></span></p>-->
              </div>
              <div class="col-sm-6 right">
                <p>Invoice Number:<span> <?php echo $invoice->book_id; ?></span></p>
                <p>Booking Confirmation:<span> <?php echo $invoice->book_itineraryid; ?></span></p>
              </div>
            </div>
            <div class="section2">
              <div class="stars"> 
              <?php //echo $invoice->book_stars; ?>
              
              <?php for ($h_s=0; $h_s < $invoice->book_stars ; $h_s++) {  ?>
                <i class="price-text-color fa fa-star"></i>
              <?php } ?>
              
              <?php for ($h_s=$invoice->book_stars; $h_s < 5 ; $h_s++) {  ?>
                <i class="fa fa-star"></i>
              <?php } ?>

               </div>
              <h1><?php echo $invoice->book_hotel;?></h1>
              <p class="left"><img src="images/checkin.png"> <?php echo $invoice->book_location;?> </p>
             
              <img class="img-responsive" src="<?php echo $invoice->book_thumbnail;?>"> </div>
            <div class="section3">
              <div class="details">
                <div class="col-sm-4">
                  <h6>CONFIRMATION #</h6>
                  <h5><?php echo $invoice->book_itineraryid; ?></h5>
                </div>
                <div class="col-sm-4">
                  <h6>ROOM RATE</h6>
                  <h5>$ <?php echo number_format($invoice->book_roomtotal / $invoice->Extra_data->room); ?></h5>
                </div>
                <div class="col-sm-4">
                  <h6>TOTAL AMOUNT</h6>
                  <h5>$ <?php echo str_replace(".00",'',number_format($invoice->book_total,2));?></h5>
                </div>
              </div>
              <div class="boxes">
                <div class="box" style="margin-left:10px !important"> <img src="images/paynow_icon2.png">
                  <h6>BOARD TYPE</h6>
                  <h5><?php echo $book_response->hotel->rooms[0]->rates[0]->boardName; ?></h5>
                </div>
                <div class="box"> <img src="images/paynow_icon3.png">
                  <h6>ROOMS</h6>
                  <h5><?php echo $invoice->Extra_data->room; ?></h5>
                </div>
                <div class="box" style="margin-right:0% !important"> <img src="images/paynow_icon4.png">
                  <h6>TYPE</h6>
                  <h5><?php echo  character_limiter($invoice->book_roomname,5); ?></h5>
                </div>
              </div>
              <div class="boxes">
                <div class="box" style="margin-left:10px !important"> <img src="images/paynow_icon5.png">
                  <h6>CHECK IN</h6>
                  <h5><?php echo $invoice->book_checkin; ?></h5>
                </div>
                <div class="box "> <img src="images/paynow_icon5.png">
                  <h6>CHECK OUT</h6>
                  <h5><?php echo $invoice->book_checkout; ?></h5>
                </div>
                <div class="box last" style="margin-right:0% !important;"> <img src="images/paynow_icon5.png">
                  <h6>YOU SAVED</h6>
                  <h5><?php  if($Extra_data->normal_price){ echo "$ ".number_format($Extra_data->normal_price - $invoice->book_total,2); }else{ echo "$ 0"; } ?></h5>
                </div>
              </div>
              <div class="user_details">
                <h6>GUEST NAMES<span><?php echo $invoice->Extra_data->adults; ?> ADULTS
                  <?php $chil = $Extra_data->child; if($chil){ echo $chil; ?>
                  CHILDREN
                  <?php } ?>
                  </span></h6>
                <ul>
                  <?php

                  $book_room = $invoice->Extra_data->room;
                  $booking_adults = $invoice->Extra_data->adults;
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
                <div class="col-sm-12 cancellation"  style="border-bottom: 1px solid #e6e7ed; padding:20px">
                  <h6>The cancellation policy</h6>
                  </br>
                  <p>Here at Tarzango, we offer a hassle free Cancellation Option. Last Minute change of plans? No problem mate! We allow 7 days prior to you arrival for cancellations, without any fees or penalties.*</p>
                  </br>
                  <p>For Cancellation Requests within 7 days of check in, any associated fees are at the hotel’s discretion. If applicable, we will refund 50% back to the cardholders card. Refunds will be issued between 24 to 48 hours after an email for cancellation has been sent and approved. Policy may vary for reservations consisting of 10 rooms or more.</p>
                  </br>
                  <p>To make a change to your reservation, please email: <span>booking@tarzango.com</span>. </p>
                  </br>
                  <p>Be sure to check your email within 24 hours for confirmation of your change.</p>
                  </br>
                  <p>To cancel your entire reservation, please email cancel@tarzango.com. Please note: We can only accept cancellation via writing to: <span>cancel@tarzango.com</span>. Cancelations will not be submitted via phone or chat, only through written email to <span>cancel@tarzango.com</span>.</p>
                </div>
                <div>
                  <div class="col-sm-12"> <a class="button" id="pintbtn"><img src="images/paynow_icon8.png"> PRINT INVOICE</a> <a class="button" id="savepdf"><img src="images/paynow_icon8.png"> DOWNLOAD INVOICE</a>
                    <?php if($invoice->status == "unpaid"){ ?>
                    <div style="" class="button">
                      <button id="element_id_1470283647"></button>
                    </div>
                    <?php } ?>
                  </div>
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
        </div>
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
        <img src="<?php echo $theme_url; ?>img/logo.png" class="img-responsive" alt="Home Logo"> </div>
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
          <div class="col-sm-12" > <b>Amount : </b> $<?php echo number_format($invoice->checkoutTotal,2);?>
            <hr>
            <center>
              <div  id="response"></div>
              <div  id="response1" style="display:none;">
                <button id="element_id_1470283648"></button>
              </div>
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
                    <img src="<?php echo base_url(); ?>assets/img/cc.png" class="img-responsive"> </div>
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
<div id="imgs"> </div>
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
              onrendered: function(canvas) {
                  theCanvas = canvas;
                  
                  var type = 'png',
                  w = 800,
                  h = 1550;
                  $imgs = document.getElementById('imgs');
                  //$imgs.append(Canvas2Image.convertToImage(canvas, w, h, type));
                  img_data_p = Canvas2Image.convertToImage(canvas, w, h, type);
                  
                  
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
              onrendered: function(canvas) {
                  theCanvas = canvas;
                  //document.body.appendChild(canvas);
                  //$('#img_val').val(canvas.toDataURL("image/png"));
                  // Convert and download as image 
                  //alert();
                  //Canvas2Image.saveAsPNG(canvas); 
                  //window.print(canvas);
                  //Canvas2Image.convertToImage(canvas, 500, 500, type)
                  var type = 'png',
                  w = 800,
                  h = 1550;
                  $imgs = document.getElementById('imgs');
                  //$imgs.append(Canvas2Image.convertToImage(canvas, w, h, type));
                  img_data_p = Canvas2Image.convertToImage(canvas, w, h, type);
                  //console.log(img_data_p);
                  //var ffff = img_data_p.replace('<img src=​"','');
                  //var ffff = ffff.replace('">​','');
                  // window.print(img_data_p);
                  // You'll need to make your image into a Data URL
                  // Use http://dataurl.net/#dataurlmaker
                  var imgData = img_data_p;
                  var doc = new jsPDF();

                  doc.addImage(imgData, 'png', 15, 15, 180, 275);
                  doc.save('invoice.pdf');
                  /*var DocumentContainer = document.getElementById('imgs');
                  var WindowObject = window.open('', 'PrintWindow', 'toolbars=no,scrollbars=yes,status=no,resizable=yes');

                  WindowObject.document.writeln('<img src="'+img_data_p+'">');
                        

                  WindowObject.document.close();
                  WindowObject.focus();
                  WindowObject.print();
                  WindowObject.close();*/
                  //pwin = window.open(img_data_p);
                  //pwin.onload = function () {}
                  //$("#paynow_body").append('<img id="my_img" src="'+Canvas2Image.convertToImage(canvas, 1366, 768, 'jpeg')+'">');
                  // Clean up 
                  //document.body.removeChild(canvas);
              }
          });
      });
  }); 

  var PayStand = PayStand || {};
  PayStand.checkouts = PayStand.checkouts || [];
  PayStand.load = PayStand.load || function(){};
  var checkout = {
  api_key: "aiPjqMbXh79vnMDqBVeq1xtM6VIx0LGVfu4ifqQONbm8PrS2GRinF/TDsoMeqeHUJfJ6Xrp9FSGrn2ehugEX8/w",
  //api_key: "aUGXTVXIQWzpuRpHZiBjJIs01C5HWowACqx5aOLFQ49xh2JnbGbkKwol1jR5MwY3kIkjHogLXwEpno1kkrQEM3w",
  org_id: "15191",
  //org_id: "760",
  element_ids: ["element_id_1470283648"],
  data_source: "org_defined",
  checkout_type: "button",
  button_options: {
  button_type: "checkout",
  button_name: "Pay Now",
  input: false,
  variants: false
  },
  amount: "<?php echo str_replace($repl_arry,'',number_format($invoice->book_total,2));?>",
  //amount: "100",
  items: [{
  title: "Reservation Payment",
  subtitle: "Payment to lock reservation in TarzanGo",
  item_price: "<?php echo str_replace($repl_arry,'',number_format($invoice->book_total,2));?>",
  //item_price: "100",
  quantity: 1
  }],
  }
  PayStand.checkoutComplete = function (data) {
    $.ajax({
        type: 'POST',
        data:{pay_data : data , invoice_id : <?php echo $invoice->book_id; ?> , invoice_code : <?php echo $invoice->book_itineraryid; ?> },
        url: '<?php echo base_url();?>invoice/booking_paid_paystand_hb',
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
  };
  PayStand.checkouts.push(checkout);
  PayStand.script = document.createElement('script');
  PayStand.script.type = 'text/javascript';
  PayStand.script.async = true;
  PayStand.script.src = 'https://app.paystand.com/js/gen/checkout.min.js';
  //PayStand.script.src = 'https://sandbox.paystand.com/js/gen/checkout.min.js';
  var s = document.getElementsByTagName('script')[0];
  s.parentNode.insertBefore(PayStand.script, s);

  
  var PayStand = PayStand || {};
  PayStand.checkouts = PayStand.checkouts || [];
  PayStand.load = PayStand.load || function(){};
  var checkout = {
  api_key: "aiPjqMbXh79vnMDqBVeq1xtM6VIx0LGVfu4ifqQONbm8PrS2GRinF/TDsoMeqeHUJfJ6Xrp9FSGrn2ehugEX8/w",
  //api_key: "aUGXTVXIQWzpuRpHZiBjJIs01C5HWowACqx5aOLFQ49xh2JnbGbkKwol1jR5MwY3kIkjHogLXwEpno1kkrQEM3w",
  org_id: "15191",
  //org_id: "760",
  element_ids: ["element_id_1470283647"],
  data_source: "org_defined",
  checkout_type: "button",
  button_options: {
  button_type: "checkout",
  button_name: "Pay Now",
  input: false,
  variants: false
  },
  amount: "<?php echo str_replace($repl_arry,'',number_format($invoice->book_total,2));?>",
  //amount: "100",
  items: [{
  title: "Reservation Payment",
  subtitle: "Payment to lock reservation in TarzanGo",
  item_price: "<?php echo str_replace($repl_arry,'',number_format($invoice->book_total,2));?>",
  //item_price: "100",
  quantity: 1
  }],
  }
  PayStand.checkoutComplete = function (data) {
    $.ajax({
        type: 'POST',
        data:{pay_data : data , invoice_id : <?php echo $invoice->book_id; ?> , invoice_code : <?php echo $invoice->book_itineraryid; ?> },
        url: '<?php echo base_url();?>invoice/booking_paid_paystand_hb',
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
  };
  PayStand.checkouts.push(checkout);
  PayStand.script = document.createElement('script');
  PayStand.script.type = 'text/javascript';
  PayStand.script.async = true;
  PayStand.script.src = 'https://app.paystand.com/js/gen/checkout.min.js';
  //PayStand.script.src = 'https://sandbox.paystand.com/js/gen/checkout.min.js';
  var s = document.getElementsByTagName('script')[0];
  s.parentNode.insertBefore(PayStand.script, s);
</script> 

<script type="text/javascript">
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
          var paystand = '';
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
<?php }?>
