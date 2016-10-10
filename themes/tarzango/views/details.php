</div>

</div>
<?php if($appModule != "ean"){ ?>
<script src="<?php echo base_url(); ?>assets/js/car_booking.js"></script>
<?php }else{ ?>
<script src="<?php echo base_url(); ?>assets/js/car_hbbooking.js"></script>
<?php } ?>
<?php 

/*error_reporting(E_ALL);*/
$CI = &get_instance(); 
$user_id =  $CI->session->userdata('pt_logged_customer');
$CI->load->helper('member');
if($user_id != ''){ 
  $mem_Data =  check_is_member($user_id);
  if($mem_Data[0]->accounts_id == $user_id){
    $R_user_type = "_f_vip_member";
  }else{
    $R_user_type = "_f_free_login";
  }
 }else{
  $R_user_type = "_f_no_login";
}

 
/*print_r($module);
*/
/*echo json_encode($module);
exit();*/
include 'header_search.php'; ?>
<style type="text/css">
.remarks{
  font-size: 12px;
  padding: 0px;
  padding-bottom: 10px;
}
.fecilities input[type=checkbox], input[type=radio] {
  vertical-align: middle;
  position: relative;
   height: 20px !important;
    bottom: 2px;
  margin-right: 4px;
}
.fecilities input[type=radio] {
  bottom: 2px;
}
.mt15 {
	margin-top: 15px;
}
.nnn_btn {
	color: #fff;
	height: 55px;
	width: 47%;
	float: left;
	background-color: #1cc0fb;
	text-transform: uppercase;
}
.completebook {
	width: 100%;
	margin: 0;
	margin-bottom: 20px;
}
.menu-header {
	position: absolute;
	margin-left: -70px;
	margin-top: -77px;
}
.map-block img {
	width: 6%;
}
#marker_info h4 {
	float: left;
	margin-left: 10px;
	color: #1a124e;
	font-weight: bold;
}
#marker_info h3 {
	float: right;
	margin-right: 10px;
	margin-top: 10px;
	color: #ff73b3;
}
#marker_info span {
	float: left;
	margin-bottom: 25px;
	margin-left: 10px;
}
#marker_info {
	width: 290px;
	height: 55px;
	padding: 10px;
	border-radius: 2px;
}
.header-right {
	display: none;
}
#detail-block {
	padding-top: 50px;
	margin-top: 0px !important;
}
.listing-back a {
	font-family: 'Apercu-Light';
	font-size: 16px;
	color: #7c7ea2;
}
.rating-detail {
	margin-top: 5px;
}
.listing-back {
	display: inline-block;
	width: 100%;
	margin-top: 15px;
}
.date-block {
	text-align: center;
	background: #deddea !important;
}
#vip_car_details {
	background: #f1f1f8;
	padding: 60px 10px;
	padding-bottom: 0px !important;
	overflow: scroll;
	height: 1170px;
	overflow-x: hidden;
}
</style>
<?php
$overall_rating = $tripadvisor->rating;
$ranking_out_of = $tripadvisor->num_reviews;
?>
<section class="hotel-detail-header" style="width: 100%;">

<div class="hotel-detail-header-info">
  <div class="hd-info">
    <div class="container">
      <h2><?php echo $module->title; ?> </h2>
      <div class="rating-detail">
        <div class="st_rating" style="float:left;">
          <?php if($appModule == "ean"){ ?>
          <?php $star =  filter_var($module->stars, FILTER_SANITIZE_NUMBER_INT); ?>
          <?php for ($h_s=0; $h_s < $star ; $h_s++) {  ?>
          <i class="price-text-color fa fa-star"></i>
          <?php } ?>
          <?php for ($h_s=$star; $h_s < 5 ; $h_s++) {  ?>
          <i class="fa fa-star"></i>
          <?php } ?>
          <?php }else{ ?>
          <?php echo $module->stars;?>
          <?php } ?>
        </div>
        <span style=" color: #f1f1f8; font-weight: normal; font-family: 'Apercu-Light'; font-size: 14px;padding-left: 5px;padding-top: 2px; float: left;"> Great Overall Rating (<?php echo $overall_rating; ?> Based on <?php echo $ranking_out_of; ?> Ratings) </span> </div>
      <div class="listing-back"> <a href="javascript:history.go(-1)"> <i class="fa fa-angle-left" aria-hidden="true"></i> Back to Listings </a> </div>
    </div>
  </div>
</div>
<?php
        /*error_reporting(E_ALL);*/
        $image_url = "";
        $image_base_url = base_url().'uploads/images/hotels/slider/';
        $img_list = $module->sliderImages;
        
        if ( !empty($hb_hotels) && $hb_hotels['sThumbnail'] != "" ) {

              ?>
<img style="width: 100%;" src="<?php echo base_url();?>uploads/images/hbhotels/slider/<?php echo $hb_hotels['sThumbnail'];?>">
<?php
        } else {

        for ($h_img=0; $h_img < 1; $h_img++) { 
          $image_url = $img_list[$h_img]['fullImage'];
          ?>
<img style="width: 100%;" src="<?php echo str_replace("demo.", "", $image_url); ?>">
<?php  } } ?>
</section>
<section id="detail-block" style="background:url(<?php echo $theme_url; ?>images/details-final.png)">
  <div class="container">
    <div class="col-lg-8 col-md-8 col-sm-8 mainleft-content " >
      <div id="detail-slider" class="owl-carousel"  >
        <?php

              //HB Hotel have images get in admin side then load this slider...STP
              if($is_hotel_bed == "1" && !empty($hb_hotel_images)){ 
                for ($i = 0; $i<count($hb_hotel_images); $i ++) {

              ?>
        <div class="item"> <img src="<?php echo base_url();?>uploads/images/hbhotels/slider/<?php echo $hb_hotel_images[$i]->sHbHotelImage;?>" alt="The Last of us"> </div>
        <?php
                }
              } else {

                for ($h_img=0; $h_img < count($img_list); $h_img++) { 
                   
                    $image_url = $img_list[$h_img]['fullImage'];
                ?>
        <div class="item"> <img src="<?php echo str_replace("demo.", "", $image_url); ?>" alt="The Last of us" /> </div>
        <?php  } }?>
      </div>
      <div class="detail-pagr-facilitate">
        <div class="row">
          <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6" > <span> <img src="images/icon/detail-icon-1.png"> </span>
            <h2> Air Conditioner </h2>
          </div>
          <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6" > <span> <img src="images/icon/detail-icon-2.png"> </span>
            <h2> Free Wi-Fi</h2>
          </div>
          <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6" > <span> <img src="images/icon/detail-icon-3.png"> </span>
            <h2> Cable TV </h2>
          </div>
          <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6" > <span> <img src="images/icon/detail-icon-4.png"> </span>
            <h2> Shower </h2>
          </div>
          <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6" > <span> <img src="images/icon/detail-icon-5.png"> </span>
            <h2> King Bed </h2>
          </div>
          <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6" > <span> <img src="images/icon/detail-icon-6.png"> </span>
            <h2> Bathtub </h2>
          </div>
        </div>
      </div>
      <h2 style="font-family: 'Gotham-Bold';font-size: 18px;color: #342d6c; margin-top: 35px;"> Why We Love it </h2>
      <div class="detail-decription"> <?php echo $module->desc; ?> </div>
      <?php if($hasRooms > 0){ 
          if($appModule == "hotels"){ 
              include 'includes/rooms.php'; 
          }else if($is_hotel_bed == "1"){ 
             include 'includes/hb_rooms.php'; 
          }else if($appModule == "ean"){ 
              include 'includes/expedia_rooms.php'; 
          } 
      }  ?>
      <div class="map-block">
        <h2> Location </h2>
        <div id="map" class="map "  style="height:300px;"></div>
      </div>
      <?php include 'includes/reviews.php';?>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 side-popups"  id="detail-slider">
      <form method="get" id="newcheckin">
        <div class="check-out-form col-lg-12 col-md-12 col-sm-12">
        <div class="amount-detail-page"> <span class="price-detail set_avg_rate"> $ 100 </span><span class="night-detail"> total </span> <span class="slas-detail">/ </span> <span class="night-detail"> <?php echo $diff; ?> nights </span> </div>
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group" style="text-align:center;">
              <label> check in </label>
              <div class=" input-append date  form_date" >
                <input name="checkin" size="16" class="date-block dpean3" type="text" value="<?php echo $checkin; ?>" >
              </div>
              <br/>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group" style="text-align:center;" >
              <label> Check Out </label>
              <div class=" input-append date  form_date" >
                <input name="checkOut" size="16" class="date-block dpean4" type="text" value="<?php echo $checkOut; ?>" >
              </div>
              <br/>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="col-lg-6 col-md-6 col-sm-6 " style="text-align:center;" >
            <div class="form-group">
              <label> Rooms </label>
              <div class="input-next-previce"> <i class="fa fa-chevron-left decrement-left"> </i>
                <input type="text" name="room" class="room" value="<?php echo $sel_room; ?>" >
                <i class="fa fa-chevron-right increment-right"> </i> </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 " style="text-align:center;"  >
            <div class="form-group">
              <label> Guests </label>
              <div class="input-next-previce"> <i class="fa fa-chevron-left decrease"> </i>
                <input type="text" name="adults" class="adult" value="<?php echo $adults; ?>" >
                <i class="fa fa-chevron-right increase"> </i> </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="col-md-12">
            <input type="hidden" name="child" value="0">
            <button type="submit" class="detail-btn">Modify</button>
          </div>
          <div class="clearfix"></div>
        </div>
      </form>
      <div class="tab-content">
        <style type="text/css">
          #vip_drop .form-group{
            text-align: left !important;
            text-transform: none !important;
          }
           #vip_drop label{
            text-align: left !important;
            text-transform: none !important;
          }
        </style>
        <div id="vip_drop_select" class="row book_extra_hide vip_drop_select" style="display:none;">
          <form id="vip_details_select" action="" onsubmit="return false">
            <input type="hidden" name="invoiceUrl" id="invoiceUrl" value="">
            <div class="col-sm-12 col-xs-12 vip_perks">
              <h4>Add VIP Perks</h4>
              <div class="signupperkrow01">
                <div class="row">
                  <div class="col-sm-2"><img src="images/memb4.png" /></div>
                  <div class="col-sm-8">
                    <p>10% off, <b> you saved <span class="discount_price">$ 231</span></b> on this booking</p>
                  </div>
                  <div class="col-sm-2"><img class="img-responsive" src="images/ok-icon.png" /></div>
                  <div class="clearfix"></div>
                </div>
              </div>
              <div class="signupperkrow01">
                <div class="row">
                  <div class="col-sm-2"><img src="images/memb7.png" /></div>
                  <div class="col-sm-8">
                    <p>Complimentary upgraded  Rooms - selected hotels</p>
                  </div>
                  <div class="col-sm-2"><img class="img-responsive" src="images/ok-icon.png" /></div>
                  <div class="clearfix"></div>
                </div>
              </div>
              <div class="signupperkrow01">
                <div class="row">
                  <div class="col-sm-2"><img src="images/memb8.png" /></div>
                  <div class="col-sm-8">
                    <p>Meet your dedicated Concierge represantative</p>
                  </div>
                  <div class="col-sm-2"><img class="img-responsive" src="images/ok-icon.png" /></div>
                  <div class="clearfix"></div>
                  <div class="col-sm-2 hidden-xs"></div>
                  <div class="col-sm-8">
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="imgbox"><img src="images/signper.png"></div>
                      </div>
                      <div class="col-sm-8">
                        <div class="prsndetail"> <b class="name-t">Angel K. Brent</b> <b class="vip_con">546-589-321</b> <b class="vip_con">angel@tazargo.com</b> </div>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                  <div class="col-sm-2 hidden-xs"></div>
                  <div class="clearfix"></div>
                </div>
              </div>
              <div class="signupperkrow01">
                <div class="row">
                  <div class="col-sm-2"><img src="images/memb7.png" /></div>
                  <div class="col-sm-6">
                    <p>Airport to Hotel Drop Off in SUV - selected cities</p>
                  </div>
                  <div class="col-sm-4">
                    <button class="detail-btn" type="button" id="selectDropOff" >SELECT</button>
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
            <div class="col-sm-12">
              <button type="submit" class="detail-btn green-bg" name="<?php if(empty($usersession)){ echo "login";}else{ echo "logged"; } ?>"  onclick="return bookSummerytest();">CONFIRM THIS BOOKING</button>
              <?php if($user_id && $R_user_type == '_f_vip_member'){ ?>
              <input type="hidden" name="member_add" value="1">
              <?php } ?>
            </div>
            <div class="clearfix"></div>
          </form>
        </div>
        <div id="vip_drop_details" class="book_extra_hide" style="display:none;">
        <form id="vip_details" action="" onsubmit="return false">
          <div id="car_book_att"> </div>
          <?php
            $location = explode(',', $module->location);
            
            if (count($location) == 3){
              $cityname = $location[0];  
            } else {
              $cityname = trim($location[1]);
              $cityname = explode('-', $cityname);
              $cityname = trim($cityname[0]);
            }
            
          ?>
          <input type="hidden" name="cityname" id="cityname" value="<?php echo $cityname?>">
          <div class="col-sm-12 col-xs-12 vip_perks" style="background:#fff; border:1px solid #d3d4e0 !important;">
            <div class="form-group booktype">
              <input type="radio" name="BookType"  checked="" value="round">
              Round Trip &nbsp;
              <input type="radio" name="BookType"  value="oneway">
              Oneway Trip </div>
            <div class="clearfix"></div>
            <h4>Arrival Transfer</h4>
            <div class="airport airport-new">
              <div class="row">
                <div class="col-sm-6">
                  <div>
                    <label for="sel1">Flight Code</label>
                    <input type="text" value="" name="pickup_flight_code" class="form-control" id="pickup_flight_code">
                    <span id="err_arr_code" class="error"></span> </div>
                </div>
                <div class="col-sm-6">
                  <div>
                    <label for="sel1">Flight arrival time </label>
                    <div class="clearfix"></div>
                    <!-- <input type="text" value="" name="pickup_time" class="form-control" id="sel1"> -->
                    <div class="row">
                      <div class="col-sm-6">
                        <select name="flight_pickup_time_hour" class="form-control selectx" id="flight_pickup_time_hour">
                          <script type="text/javascript">

                                        for ( var i = 0; i <= 23; i ++) {
                                            document.write("<option value='"+('0' + i).slice(-2)+"'>"+('0' + i).slice(-2)+"</option>");
                                        }
                                      </script>
                        </select>
                      </div>
                      <div class="col-sm-6">
                        <select name="flight_pickup_time_min" class="form-control selectx" id="flight_pickup_time_min">
                          <script type="text/javascript">

                                        for ( var i = 0; i <= 59; i = i + 5) {
                                            document.write("<option value='"+('0' + i).slice(-2)+"'>"+('0' + i).slice(-2)+"</option>");
                                        }
                                      </script>
                        </select>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-12">
                  <div class="form-group pl-pr0">
                    <label for="sel1">Flight arrival terminal </label>
                    <select name="flight_pickup_terminal" class="form-control selectx" id="flight_pickup_terminal">
                      <option value="">select</option>
                      <?php
                                        for($t=0;$t<count($terminal);$t++){?>
                      <option value="<?php echo $terminal[$t]->code;?>"><?php echo $terminal[$t]->name;?></option>
                      <?php
                                        }
                                      ?>
                    </select>
                    <span id="err_arr_term" class="error"></span> </div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div id="dep">
              <h4>Departure Transfer</h4>
              <div class="airport airport-new">
                <div class="row">
                  <div class="col-sm-6">
                    <label for="sel1">Flight Code</label>
                    <input type="text" value="" name="drp_flight_code" class="form-control" id="drp_flight_code">
                    <span id="err_drp_code" class="error"></span> </div>
                  <div class="col-sm-6">
                    <label for="sel1">Flight departure time </label>
                    <div class="clearfix"></div>
                    <!-- <input type="text" value="" name="pickup_time" class="form-control" id="sel1"> -->
                    
                    <div class="row">
                      <div class="col-sm-6">
                        <select name="flight_drp_time_hour" class="form-control selectx" id="flight_drp_time_hour">
                          <script type="text/javascript">

                                        for ( var i = 0; i <= 23; i ++) {
                                            document.write("<option value='"+('0' + i).slice(-2)+"'>"+('0' + i).slice(-2)+"</option>");
                                        }
                                      </script>
                        </select>
                      </div>
                      <div class="col-sm-6">
                        <select name="flight_drp_time_min" class="form-control selectx" id="flight_drp_time_min">
                          <script type="text/javascript">

                                        for ( var i = 0; i <= 59; i = i + 5) {
                                            document.write("<option value='"+('0' + i).slice(-2)+"'>"+('0' + i).slice(-2)+"</option>");
                                        }
                                      </script>
                        </select>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group pl-pr0" >
                      <label for="sel1">Flight departure terminal </label>
                      <select name="flight_dep_terminal" class="form-control selectx" id="flight_dep_terminal">
                        <option value="">select</option>
                        <?php
                                        for($t=0;$t<count($terminal);$t++){?>
                        <option value="<?php echo $terminal[$t]->code;?>"><?php echo $terminal[$t]->name;?></option>
                        <?php
                                        }
                                      ?>
                      </select>
                      <span id="err_drp_term" class="error"></span> </div>
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 mt15">
              <button type="button" class="detail-btn" id="selectFrom" >CONTINUE</button>
            </div>
          </div>
          </div>
        </form>
      </div>
      <div id="vip_car_details" class="book_extra_hide" style="display:none;"> </div>
      <div id="vip_car_details_out" class="book_extra_hide" style="display:none;"> </div>
      <div id="guest_details" class="guest_details book_extra_hide" style="display:none;">
        <div class="left-section">
          <h4>Enter Guest Details</h4>
          <div class="disp_message" ></div>
          <form class="" name="guest_details" id="guest_details" method="post">
            <?php 
                $room_per_guest = $adults / $sel_room;
                for($g_d=0; $g_d < $sel_room; $g_d++){
               ?>
            <h5>Room #<?php echo $g_d + 1; ?></h5>
            <?php 
                  for($g_d_a=0; $g_d_a < $room_per_guest; $g_d_a++){
                ?>
            <div class="row">
              <div class="col-sm-8">
                <div class="form-group">
                  <label for="name1">Full Name</label>
                  <input type="text" class="form-control" id="name1" name="guest_name[]" value="Ravi Gajera" placeholder="Full Name">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="age1">Age</label>
                  <input type="text" class="form-control" id="age1" name="guest_age[]" value="30" placeholder="Age">
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
            <?php } ?>
            <?php } ?>
            <?php if($child > 0){  ?>
            <h5>Child Details </h5>
            <?php for($c_i=0;$c_i<$child;$c_i++){
                  ?>
            <div class="row">
              <div class="col-sm-8">
                <div class="form-group">
                  <label for="name1">Child Full Name</label>
                  <input type="text" class="form-control" id="name1" name="child_name[]" value="" placeholder="Child Full Name">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="age1">Child Age</label>
                  <input type="text" class="form-control" id="age1" name="child_age[]" value="" placeholder="Child Age">
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
            <?php } } ?>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group submit-button">
                  <button type="button" class="form-control nnn_btn guest_cont" id="submit" name="submit" value="">continue THIS BOOKING</button>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
          </form>
        </div>
      </div>
      <div class="result"></div>
      <div class="signup_body book_extra_hide" style="display:none;">
        <div class="row left-section sign_in_up ">
          <ul class="nav nav-tabs responsive" id="myTab">
            <!-- <li class="col-sm-5 "><a data-toggle="tab" id="guesttab" href="#Guest">Book as a Guest</a></li> -->
            <li class="col-sm-4 "><a data-toggle="tab" id="signintab" href="#Sign-In" style="padding-left:25px">Sign In</a></li>
            <li class="col-sm-3"><a data-toggle="tab" id="signuptab" href="#sign_up">Sign Up</a></li>
          </ul>
          <div class="tab-content">
            <div class="col-sm-12 col-xs-12 left-section  " style="text-align:center;">
              <label style="font-size:15px;"> Total : $ <span class="total_disp">20</span></label>
            </div>
            <input type="hidden" value="<?php echo $R_user_type; ?>" id="mem_type">
            <div id="Sign-In" class="tab-pane fade in active">
              <form action="" method="POST" id="loginform">
                <input type="hidden" name="form_name" value="login_mem">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label  class="required  go-right"><?php echo trans('094');?></label>
                    <input class="form-control form" type="text" placeholder="Email" name="username" id="username"  value="">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label  class="required go-right"><?php echo trans('095');?></label>
                    <input class="form-control form" type="password" placeholder="<?php echo trans('095');?>" name="password" id="password"  value="">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group ">
                    <label  class="required go-right"><?php echo trans('0178');?></label>
                    <textarea class="form-control form" placeholder="<?php echo trans('0415');?>" rows="4" name="additionalnotes"></textarea>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group submit-button"> 
                    <!--<input type="submit" class="form-control" id="submit" name="submit" value="SIGN IN">-->
                    <button type="button"  class="btn btn-action btn-lg  completebook" name="<?php if(empty($usersession)){ echo "login";}else{ echo "logged"; } ?>"  onclick="return completebook('<?php echo base_url();?>','<?php echo trans('0159')?>');">CONTINUE THIS BOOKING</button>
                  </div>
                </div>
              </form>
            </div>
            <div id="sign_up" class="tab-pane fade ">
              <form class="" name="signup" id="signupform" method="POST">
                <input type="hidden" name="form_name" value="signup_mem">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="name">First Name</label>
                    <input type="text" class="form-control" id="name" name="firstname" value="" placeholder="First Name">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label  class="required go-right"><?php echo trans('0172');?></label>
                    <input class="form-control form" type="text" placeholder="<?php echo trans('0172');?>" name="lastname"  value="">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="no">Mobile Number</label>
                    <input type="number" class="form-control" id="no" name="no" value="" placeholder="Mobile Number">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="" placeholder="Email">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="pass">Password</label>
                    <input type="password" class="form-control" id="pass" name="password" value="" placeholder="password">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="conf_pass">Confirm Password</label>
                    <input type="password" class="form-control" id="conf_pass" name="conf_pass" value="" placeholder="Confirm Password">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group submit-button"> 
                    <!-- <input type="submit" class="form-control" id="submit" name="submit" value="CREATE ACCOUNT">--> 
                  </div>
                </div>
              </form>
              <div class="signup_upgrade_to_vip" style="display:none;">
                <form id="signup_upgrade_to_vip">
                  <ul class="nav nav-tabs responsive" id="myTab">
                    <li class="col-sm-12 "><a>Upgrade to VIP Membership</a></li>
                  </ul>
                  <hr>
                  <ul class="nav nav-tabs responsive" id="myTab">
                    <li class="col-sm-12 "><a >$ 19.00 / month</a></li>
                  </ul>
                  <hr>
                  <div class="col-sm-12">
                    <p class="savebox"> You save $ <span>10.92</span> with your current booking if becoming VIP member</p>
                  </div>
                  <div class="col-sm-12 term">
                    <label>TERMS</label>
                  </div>
                  <div class="col-sm-12 term_txt">
                    <label>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</label>
                  </div>
                  <hr>
                  <div class="col-sm-12">
                    <label>CONFRIMATION</label>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-sm-12 check">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" value="" name="upgrade_ac" id="upgrade_ac">
                        Yes, I want to upgrade to a VIP Member</label>
                    </div>
                  </div>
                  <div class="col-sm-12 g_total">
                    <label>Total $142.46</label>
                  </div>
                  <hr>
                  <button type="submit" class="btn vipmemberbtn completebook" >UPGRADE TO VIP MEMBER</button>
                </form>
              </div>
              <div>
                <div class="col-sm-12">
                  <button type="submit"  class="btn-lg detail-btn" name="<?php if(empty($usersession)){ echo "login";}else{ echo "logged"; } ?>"  onclick="return completebook('<?php echo base_url();?>','<?php echo trans('0159')?>');">CONTINUE THIS BOOKING</button>
                </div>
                <div class="clearfix"></div>
              </div>
              
              <!--
                  <p class="or">OR</p>
                  <a class="col-sm-6 facebook">
                    <img src="images/facebook.png">
                    <p>Sign in with Facebook</p>
                  </a>
                  <a class="col-sm-6 google">
                    <img src="images/google.png">
                    <p>Sign in with Google</p>
                  </a>
                  --> 
            </div>
          </div>
        </div>
      </div>
      <div class="book_extra_hide booksummary" style="display:none;">
        <div class="left-section">
          <div class="text-center"> <img src="images/summary-icon.png" />
            <h3>Booking Summary</h3>
          </div>
          <div class="text-center">
            <div class="hoteltitle">
              <h2><?php echo $module->title;?></h2>
              <p>Accommodation</p>
              <p id="nightsrate"></p>
            </div>
            <div class="booktotal">
              <p>Booking total $ <?php echo $set_avg_rate; ?></p>
            </div>
          </div>
          
         <div class="row"> 
          <div class="col-sm-6 col-xs-6 left-section">
            <div class="box"> <img src="images/paynow_icon2.png">
              <h6>BOARD TYPE</h6>
              <h5>All Inclusive</h5>
            </div>
          </div>
          <div class="col-sm-6 col-xs-6">
            <div class="box"> <img src="images/paynow_icon3.png">
              <h6>ROOMS</h6>
              <h5><?php echo $sel_room;?></h5>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="col-sm-6 col-xs-6 left-section">
            <div class="box"> <img src="images/paynow_icon5.png">
              <h6>CHECK IN</h6>
              <h5><?php echo $checkin;?></h5>
            </div>
          </div>
          <div class="col-sm-6 col-xs-6">
            <div class="box "> <img src="images/paynow_icon5.png">
              <h6>CHECK OUT</h6>
              <h5><?php echo $checkOut;?></h5>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="col-sm-6 col-xs-6 left-section">
            <div class="box"> <img src="images/paynow_icon4.png">
              <h6>TYPE</h6>
              <h5 id="roomType"></h5>
            </div>
          </div>
          <div class="col-sm-6 col-xs-6">
            <div class="box"> <img class="m-bottom0" src="images/you-saved.png">
              <h6>YOU SAVED</h6>
              <h5 id="savePrice"></h5>
            </div>
          </div>
          <div class="clearfix"></div>
          </div>
        
          <div class="remark">
            <label>REMARK FOR THE HOTEL</label>
            <div class="form-group fecilities">.
            <div class="col-sm-6 remarks">
              <input type="checkbox" name="" value="Double Bed">Double Bed </input><br>
              <input type="checkbox" name="" value="Late Arrival">Late Arrival </input><br>
              <input type="checkbox" name="" value="Ground floor">Ground floor </input><br>
              <input type="checkbox" name="" value="Smoking room">Smoking room </input><br>
              <input type="checkbox" name="" value="Cot">Cot </input><br>
              <input type="checkbox" name="" value="Except ground floor">Except ground floor </input>
            </div>
             <div class="col-sm-6 remarks" style="margin-top: -20px">
              <input type="checkbox" name="" value="Two beds">Two beds </input><br>
              <input type="checkbox" name="" value="Honeymoon">Honeymoon </input><br>
              <input type="checkbox" name="" value="Non-smoking room">Non-smoking room </input><br>
              <input type="checkbox" name="" value="Adjacent rooms">Adjacent rooms </input><br>
              <input type="checkbox" name="" value="Client without voucher">Client without voucher </input>
            </div>
              <textarea class="form-control" id="add_note" name="add_note" placeholder="Confirm Password"> </textarea>
            </div>
            <p class="f"><strong>The remarks for the establishment are for reference only. Tarzango cannot guarantee them.</strong></p>
          </div>
          <div class="remark">
            <label>Contract Remark</label>.

            <p class="red">in the event of cancellation after <span id="cancellationPolicies_from"></span> 
              the following charges will be applied $ <span id="cancellationPolicies"></span> cancellation charges described above will not apply 
              during1 hour from the creation time of the booking. 
              during this time you may cancel the booking online with 
              no fees. Automatically, after those 1 hours the described 
              cancellation policy will be applied.</p>
            <p>If you cancel after 12pm on arrivel day, the hotel cancellation 
              penalty will apply. Date and time is cancluated based on local time 
              in the destination.</p>
          </div>
          <div class="attansion">
          <div class="attansion-bg-y">
            <p>ATTENTION: THIS BOOKING WILL INCUR CANCELLATION
              FEES AS FROM THE MOMENT IT IS CONFIRMED</p>
            <input type="checkbox" required name="attantion" id="attantion" value="yes">
            Yes, I want to book and accept the cancellation policy <span id="err_term"></span>
            </div>
            <label>Booking Total $ <?php echo $set_avg_rate; ?></label>
          </div>
          <div class="confirm" id="confirmvip">
            <button type="button"  class="detail-btn" name="<?php if(empty($usersession)){ echo "login";}else{ echo "logged"; } ?>"  onclick="return completebook_confirm('<?php echo base_url();?>','<?php echo trans('0159')?>');">CONFIRM THE BOOKING</button>
          </div>
        </div>
      </div>
      <?php
        //print_r($usersession);
         if(!empty($usersession)){ ?>
      <style>
            .login label{
                  font-family: 'Gotham-Bold';
                  font-size: 12px;
                  color: #342d6c;
                  text-align: center;
                  text-transform: uppercase;
                  font-weight: normal;
                  letter-spacing: 1px;
            }
            </style>
      <div class="login book_extra_hide" style="display:none;">
        <div class="col-sm-12 col-xs-12 left-section  " style="text-align:center;">
          <label style="font-size:15px;"> Total : $ <span class="total_disp">20</span></label>
        </div>
        <hr>
        <div class="row left-section">
          <form id="loggedform">
            <div>
              <div class="col-md-6  go-right">
                <div class="form-group ">
                  <label  class="required go-right"><?php echo trans('0171');?></label>
                  <input class="form-control form" type="text" placeholder="" name=""  value="<?php echo $profile[0]->ai_first_name?>" disabled="disabled" style="background-color: #DEDEDE !important"/>
                </div>
              </div>
              <div class="col-md-6  go-left">
                <div class="form-group ">
                  <label  class="required go-right"><?php echo trans('0172');?></label>
                  <input class="form-control form" type="text" placeholder="" name=""  value="<?php echo $profile[0]->ai_last_name?>" disabled="disabled" style="background-color: #DEDEDE !important">
                </div>
              </div>
              <br />
              <div class="clearfix"></div>
              <br />
              <div class="col-md-12 go-right">
                <div class="form-group ">
                  <label  class="required  go-right"><?php echo trans('094');?></label>
                  <input class="form-control form" type="text" placeholder="" name=""  value="<?php echo $profile[0]->accounts_email?>" disabled="disabled" style="background-color: #DEDEDE !important">
                </div>
              </div>
              <br />
              <div class="clearfix"></div>
              <br />
              <div class="col-md-12  go-right">
                <div class="form-group ">
                  <label  class="required go-right"><?php echo trans('0178');?></label>
                  <textarea class="form-control form" placeholder="<?php echo trans('0415');?>" rows="4" name="additionalnotes"></textarea>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
          </form>
          <div class="col-md-12">
            <button type="submit" class="detail-btn" name="<?php if(empty($usersession)){ echo "login";}else{ echo "logged"; } ?>"  onclick="return completebook_login('<?php echo base_url();?>','<?php echo trans('0159')?>');">CONTINUE THIS BOOKING</button>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
      <?php } ?>
    </div>
    <div class="clearfix"></div>
  </div>
</section>
</div>
</div>
</div>

<form id="bookingdetails" class="hidden-xs hidden-sm" action="" onsubmit="return false">
  <input type="hidden" id="itemid" name="itemid" value="<?php echo $module->id;?>" />
  <input type="hidden" name="checkin" id="checkin" value="<?php echo $checkin;?>" />
  <input type="hidden" name="checkout" id="checkout" value="<?php echo $checkOut;?>" />
  <input type="hidden" name="adults" value="<?php echo $adults;?>" />
  <input type="hidden" name="child" value="<?php echo $child;?>" />
  <input type="hidden" id="btype" name="btype" value="<?php echo $appModule;?>" />
  <input type="hidden" name="subitemid" id="subitemid" value="" />
  <?php if($appModule == "hotels"){ ?>
  <input type="hidden" id="couponid" name="couponid" value="" />
  <input type="hidden" name="roomscount" value="<?php echo $sel_room;?>" />
  <input type="hidden" name="bedscount" value="" />
  <?php }else{ ?>
  <input type="hidden" id="room" name="room" value="<?php echo $sel_room; ?>" />
  <input type="hidden" id="total" name="total" value="<?php echo $sel_room; ?>" />
  <input type="hidden" name="hotel" value="<?php echo $hotelid; ?>" />
  <input type="hidden" name="thumbnail" value="<?php echo $roomImg; ?>" />
  <input type="hidden" name="hotelname" value="<?php echo $module->title; ?>" />
  <input type="hidden" name="stars" value="<?php echo filter_var($module->stars, FILTER_SANITIZE_NUMBER_INT); ;?>" />
  <input type="hidden" name="location" value="<?php echo $module->location; ;?>" />
  <?php } ?>
</form>
<form id="carbookingdetails" class="hidden-xs hidden-sm" action="" onsubmit="return false">
  <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
</form>
<script type="text/javascript">

$("#selectDropOff").click(function(){
    $("#vip_drop_select").hide();
    $("#vip_drop_details").show();
 });

function mypop(id){
     
        var op_modal = "#carfulldetails"+id;
        $(op_modal).modal('show');
        $(op_modal).addClass('in');
        $(op_modal).show();
    }

   $("#selectFrom").click(function(){
 

      var pickup_date  = "<?php echo $checkin;?>";
      var pickup_time_hour = $("#flight_pickup_time_hour").val();
      var pickup_time_min = $("#flight_pickup_time_min").val();      
      var pickup_terminal = $("#flight_pickup_terminal").val();
      var drop_terminal = $("#flight_dep_terminal").val();
      var dropoff_date = "<?php echo $checkOut;?>";
      var drp_time_hour = $("#flight_drp_time_hour").val();
      var drp_time_min = $("#flight_drp_time_min").val();

      var drop_dest = "";
      var drop_zone = "";
      var drop_acco = "";
     
      var child = <?php echo $child;?>;
      var adult = <?php echo $adults;?>;
      var location_latitude = '<?php echo $module->latitude;?>';
      var location_longitude = '<?php echo $module->longitude;?>';
      var address = '<?php echo $module->location;?>';
      var hoteltitle = "<?php echo $module->title; ?>";
      var hotellocaion = $("#cityname").val();
      var fulladdress = '<?php echo $module->hotelAddress;?>';

      var BookType = $("input[name='BookType']:checked").val();

      var guest_name = $("input[name='guest_name[]']").map(function(){return $(this).val();}).get();
      var guest_age = $("input[name='guest_age[]']").map(function(){return $(this).val();}).get();

      var child_name = $("input[name='child_name[]']").map(function(){return $(this).val();}).get();
      var child_age = $("input[name='child_age[]']").map(function(){return $(this).val();}).get();

      var flag = 0;
      var n = 0;
    $(".error").text('');
    
    if ( $("#pickup_flight_code").val() == "") {
        $("#err_arr_code").text('Please enter arrival flight code');
        flag ++;
        return false;
    } else if ( $("#flight_pickup_terminal").val() == "") {
        $("#err_arr_term").text('Please select terminal');
        flag ++;
        return false;
    } else if ( $("#drp_flight_code").val() == "" && BookType != "oneway") {
        $("#err_drp_code").text('Please enter departure flight code');
        flag ++;
        return false;
    } else if ( $("#flight_dep_terminal").val() == "" && BookType != "oneway") {
        $("#err_drp_term").text('Please select terminal');
        flag ++;
        return false;
    } else {
        flag = 0;
    }

    if (flag == 0) {

      $.ajax({
        type: 'GET',
        data:{pickup_date:pickup_date,pickup_time_hour:pickup_time_hour,pickup_time_min:pickup_time_min,pickup_terminal:pickup_terminal,dropoff_date:dropoff_date,drp_time_hour:drp_time_hour,drp_time_min:drp_time_min,drop_dest:drop_dest,drop_zone:drop_zone,drop_acco:drop_acco,child:child,adult:adult,location_latitude:location_latitude,location_longitude:location_longitude,BookType:BookType,hoteltitle:hoteltitle,hotellocaion:hotellocaion,drop_terminal:drop_terminal,address:address,fulladdress:fulladdress,guest_name:guest_name,guest_age:guest_age,child_name:child_name,child_age:child_age},
        url: '<?php echo base_url(); ?>'+'ean/ajax_call_car_list',
        cache: false,
        beforeSend:function(){
          //show image here
          $(".divLoading").show();
           //$('#result_data').hide();
        },
        success: function(data){
         
          $(".divLoading").hide();
          //console.log(data);          
          response = $.parseJSON(data);
                    
          var fullname = '';  
          var services = '';  
          var contract = "";
          var desc = '';
          var availtotken = "";
          var contractcode = '';
          var cnt = 1;
          var HTML_DATA = '<div class="section5"><div> <div class="">  <div class="col-sm-12 bg-w"><div>';

          if (typeof response.ErrorList == 'undefined'){

            $("#vip_car_details").html('');

            if (typeof response.ServiceTransfer.attributes == 'undefined'){
           
            
                      $.each(response.ServiceTransfer, function(index, element) {

                        
                        console.log(element);
                        if (element.attributes.transferType == "IN"){

                            n ++;

                            HTML_DATA += "<div class='row'>";
                            
                            

                            $.each(element.ProductSpecifications.MasterServiceType, function(index, element2) {
                              
                                  fullname += element2.name +' - ';
                             
                            });

                            $.each(element.ProductSpecifications.MasterProductType, function(index, element3) {
                              
                                  fullname += element3.name + ' - ';
                             
                            });

                            $.each(element.ProductSpecifications.MasterVehicleType, function(index, element4) {
                              
                                  fullname += element4.name;
                             
                            });
							
							$.each(element.TransferInfo.ImageList.Image, function(index, element1) {

                              //console.log(element1.Type);
                              if(element1.Type == 'S'){
                                HTML_DATA += "<div class='col-sm-4'><img src='"+element1.Url+"'></div><div class='col-sm-8'><h3>"+fullname+"</h3></div><div class='clearfix'></div></div>";
                              }
                              
                            });

                           // HTML_DATA += "<div class=''><h3>"+fullname+"</h3></div>";
                            fullname = '';

                            if (typeof element.TransferInfo.TransferSpecificContent.MaximumNumberStops != "undefined"){
                                  //  console.log(element.TransferInfo.TransferSpecificContent.MaximumNumberStops.attributes.maxstops);                
                                  HTML_DATA += "<div class=''><label class=''>Maximum stops : </label><h3>"+element.TransferInfo.TransferSpecificContent.MaximumNumberStops.attributes.maxstops+"</h3></div>";                           
                            }

                            if (typeof element.ProductSpecifications.TransferGeneralInfoList.TransferBulletPoint){
                                services += "<uL>";
                               
                                $.each(element.ProductSpecifications.TransferGeneralInfoList.TransferBulletPoint, function(index, element5) {
                                
                                    //console.log(element5.Description);
                                  services += "<li>"+element5.Description+"</li>";
                             
                                });

                                services += "</ul>";
                                HTML_DATA += "<div class=''>"+services+"</div>";
                                services = '';

                                desc = "<ul>";
                                

                                $.each(element.TransferInfo.TransferSpecificContent.GenericTransferGuidelinesList.TransferBulletPoint, function(index, element8) {
                              
                                  desc += "<li>"+element8.DetailedDescription+"</li>";
                             
                                });

                                desc += "</ul>";
                                  

                                HTML_DATA += "<div class='button-new'><button type='button' onclick='mypop("+cnt+")' data-target='#carfulldetails"+cnt+"' class='link-button'>View More Details</button></div><div class='modal fade' id='carfulldetails"+cnt+"' role='dialog'><div class='modal-dialog modal-lg'> <div class='modal-content'><div class='modal-body'><h3>General Information"+desc+"</div></div></div></div></div>";
                                //console.log(element.Currency.Sellin gPrice);                                   

                            } 
                                

                            //console.log(element.ContractList.Contract.IncomingOffice.attributes.code);

                            var contract = element.ContractList.Contract.Name;
                            var contractcode = element.ContractList.Contract.IncomingOffice.attributes.code;
                            var availtotken = element.attributes.availToken;

                            var tranCode = element.TransferInfo.Code;
                            var tranType = element.TransferInfo.Type.attributes.code;
                            var tranVehicleType = element.TransferInfo.VehicleType.attributes.code;

                            if ( BookType == 'oneway'){
                              var onclickevent = "car_hotel_airport_in";
                            } else {
                              var onclickevent = "car_hotel_airport_out";
                            }

                            HTML_DATA += "<div class='b-text-l'><p>Net Price $ : <span>"+element.SellingPrice+"<span></p><button class='nextcarlist detail-btn' onclick='"+onclickevent+"("+cnt+")' type='button'>SELECT</button><input type='hidden' id='contractcode"+cnt+"' name='contractcode' value='"+contractcode+"'><input type='hidden' id='availtotken"+cnt+"' name='availtotken' value='"+availtotken+"' ><input type='hidden' id='contract"+cnt+"' name='contract' value='"+contract+"'><input type='hidden' id='tranCode"+cnt+"' name='tranCode' value='"+tranCode+"'><input type='hidden' id='tranType"+cnt+"' name='tranType' value='"+tranType+"'><input type='hidden' id='tranVehicleType"+cnt+"' name='tranVehicleType' value='"+tranVehicleType+"'></div>";

                            $("#carbookingdetails").append("<input type='hidden' id='contractcode"+cnt+"' name='contractcode' value='"+contractcode+"'><input type='hidden' id='availtotken"+cnt+"' name='availtotken' value='"+availtotken+"' ><input type='hidden' id='contract"+cnt+"' name='contract' value='"+contract+"'><input type='hidden' id='tranCode"+cnt+"' name='tranCode' value='"+tranCode+"'><input type='hidden' id='tranType"+cnt+"' name='tranType' value='"+tranType+"'><input type='hidden' id='tranVehicleType"+cnt+"' name='tranVehicleType' value='"+tranVehicleType+"'>");

                            cnt ++;
                            desc = '';

                        } else {

                          if ( element.attributes.transferType == "OUT" && n == 0) {
                            n ++;
                            HTML_DATA += "No car found. Please try again.<div style='margin-top:15px;'><button type='button'  class='btn btn-action btn-lg  completebook'  onclick='return bookSummery();''>CONTINUE THE BOOKING</button></div>";
                          }
                        }

                      });
            } else{


                //----------------------------------------------------------------Single Car------------------------------

                    HTML_DATA += "<div class=''>";
                           
                              $.each(response.ServiceTransfer.TransferInfo.ImageList.Image, function(index, element1) {

                              //console.log(element1.Type);
                              if(element1.Type == 'S'){
                                HTML_DATA += "<div class=''><img src='"+element1.Url+"'></div><div class=''><h3></h3></div></div>";
                              }
                              
                            });

                              
                                  fullname += response.ServiceTransfer.ProductSpecifications.MasterServiceType.attributes.name +' - ';
                                  fullname += response.ServiceTransfer.ProductSpecifications.MasterProductType.attributes.name + ' - ';
                                  fullname += response.ServiceTransfer.ProductSpecifications.MasterVehicleType.attributes.name;
                          
                            HTML_DATA += "<div class=''><h3>"+fullname+"</h3></div>";
                            fullname = '';

                            if (typeof response.ServiceTransfer.TransferInfo.TransferSpecificContent.MaximumNumberStops != "undefined"){
                                               
                                  HTML_DATA += "<div class=''><label class=''>Maximum stops : </label><h3>"+response.ServiceTransfer.TransferInfo.TransferSpecificContent.MaximumNumberStops.attributes.maxstops+"</h3></div>";                           
                            }

                            if (typeof response.ServiceTransfer.ProductSpecifications.TransferGeneralInfoList.TransferBulletPoint){
                                services += "<uL>";
                               
                                $.each(response.ServiceTransfer.ProductSpecifications.TransferGeneralInfoList.TransferBulletPoint, function(index, element5) {
                                
                                    //console.log(element5.Description);
                                  services += "<li>"+element5.Description+"</li>";
                             
                                });

                                services += "</ul>";
                                HTML_DATA += "<div class=''>"+services+"</div>";
                                services = '';

                                desc = "<ul>";

                               
                                $.each(response.ServiceTransfer.TransferInfo.TransferSpecificContent.GenericTransferGuidelinesList.TransferBulletPoint, function(index, element8) {
                              
                                  desc += "<li>"+element8.DetailedDescription+"</li>";
                             
                                });

                                desc += "</ul>";
                                  

                                HTML_DATA += "<div class=''><button type='button' onclick='mypop("+cnt+")' data-target='#carfulldetails"+cnt+"' class='btn btn-action btn-block chk reserve-btn op_modal'>View More Details</button></a></div><div class='modal fade' id='carfulldetails"+cnt+"' role='dialog'><div class='modal-dialog modal-lg'> <div class='modal-content'><div class='modal-body'><h3>General Information"+desc+"</div></div></div></div></div>";
                                //console.log(element.Currency.Sellin gPrice);                                   

                            } 
                                

                            //console.log(element.ContractList.Contract.IncomingOffice.attributes.code);

                            var contract = response.ServiceTransfer.ContractList.Contract.Name;
                            var contractcode = response.ServiceTransfer.ContractList.Contract.IncomingOffice.attributes.code;
                            var availtotken = response.ServiceTransfer.attributes.availToken;

                            var tranCode = response.ServiceTransfer.TransferInfo.Code;
                            var tranType = response.ServiceTransfer.TransferInfo.Type.attributes.code;
                            var tranVehicleType = response.ServiceTransfer.TransferInfo.VehicleType.attributes.code;

                            if ( BookType == 'oneway'){
                              var onclickevent = "car_hotel_airport_in";
                            } else {
                              var onclickevent = "car_hotel_airport_out";
                            }

                            HTML_DATA += "<div class=''><p>Net Price $ : "+response.ServiceTransfer.SellingPrice+"</p><button class='nextcarlist' onclick='"+onclickevent+"("+cnt+")' type='button'>SELECT</button><input type='hidden' id='contractcode"+cnt+"' name='contractcode' value='"+contractcode+"'><input type='hidden' id='availtotken"+cnt+"' name='availtotken' value='"+availtotken+"' ><input type='hidden' id='contract"+cnt+"' name='contract' value='"+contract+"'><input type='hidden' id='tranCode"+cnt+"' name='tranCode' value='"+tranCode+"'><input type='hidden' id='tranType"+cnt+"' name='tranType' value='"+tranType+"'><input type='hidden' id='tranVehicleType"+cnt+"' name='tranVehicleType' value='"+tranVehicleType+"'></div>";

                            $("#carbookingdetails").append("<input type='hidden' id='contractcode"+cnt+"' name='contractcode' value='"+contractcode+"'><input type='hidden' id='availtotken"+cnt+"' name='availtotken' value='"+availtotken+"' ><input type='hidden' id='contract"+cnt+"' name='contract' value='"+contract+"'><input type='hidden' id='tranCode"+cnt+"' name='tranCode' value='"+tranCode+"'><input type='hidden' id='tranType"+cnt+"' name='tranType' value='"+tranType+"'><input type='hidden' id='tranVehicleType"+cnt+"' name='tranVehicleType' value='"+tranVehicleType+"'>");

                //--------------------------------------------------------------------------------------------------------

            }
          
          } else {

              HTML_DATA += "No car found. Please try again.<div style='margin-top:15px;'><button type='button'  class='btn btn-action btn-lg  completebook'  onclick='return bookSummery();''>CONTINUE THE BOOKING</button></div>";
          }
        
          HTML_DATA += '</div></div></div></div>';

          $('html, body').animate({
              scrollTop: $('#detail-slider').offset().top + 500
          }, 'slow');

          $("#vip_drop_details").hide();
          $("#vip_car_details").show();
          $("#vip_car_details").html(HTML_DATA);
        }         
             
      });
    }
  });
  
  function bookSummery(){
    $('html, body').animate({
        scrollTop: $('#detail-slider').offset().top + 500
    }, 'slow');

    $('#vip_car_details').hide();
    $(".booksummary").show();
  }

  function car_hotel_airport_out(id){
 
       var pickup_date  = "<?php echo $checkin;?>";
      var pickup_time_hour = $("#flight_pickup_time_hour").val();
      var pickup_time_min = $("#flight_pickup_time_min").val();      
      var pickup_terminal = $("#flight_pickup_terminal").val();
      var drop_terminal = $("#flight_dep_terminal").val();
      var dropoff_date = "<?php echo $checkOut;?>";
      var drp_time_hour = $("#flight_drp_time_hour").val();
      var drp_time_min = $("#flight_drp_time_min").val();

      var pickup_flight_code = $("#pickup_flight_code").val()
      var drp_flight_code = $("#drp_flight_code").val()

      var child = <?php echo $child;?>;
      var adult = <?php echo $adults;?>;
      var location_latitude = '<?php echo $module->latitude;?>';
      var location_longitude = '<?php echo $module->longitude;?>';
      var address = '<?php echo $module->location;?>';
      var hoteltitle = "<?php echo $module->title; ?>";
      var hotellocaion = $("#cityname").val();
      var fulladdress = '<?php echo $module->hotelAddress;?>';

      var BookType = $("input[name='BookType']:checked").val();
      
      var contract = $("#contract"+id).val();
      var contractcode = $("#contractcode"+id).val();
      var availtotken = $("#availtotken"+id).val();

      var tranCode = $("#tranCode"+id).val();
      var tranType = $("#tranType"+id).val()
      var tranVehicleType = $("#tranVehicleType"+id).val()

      var guest_name = $("input[name='guest_name[]']").map(function(){return $(this).val();}).get();
      var guest_age = $("input[name='guest_age[]']").map(function(){return $(this).val();}).get();

      var child_name = $("input[name='child_name[]']").map(function(){return $(this).val();}).get();
      var child_age = $("input[name='child_age[]']").map(function(){return $(this).val();}).get();
        //------------------------------------------Services Add IN------------------------------
        
        var ptocken = "";
        var psui = "";

        $.ajax({
          type: 'GET',
          data:{contract:contract,contractcode:contractcode,availtotken:availtotken,tranCode:tranCode,tranType:tranType,tranVehicleType:tranVehicleType,child:child,adult:adult,pickup_date:pickup_date,pickup_time_hour:pickup_time_hour,pickup_time_min:pickup_time_min,pickup_terminal:pickup_terminal,dropoff_date:dropoff_date,drp_time_hour:drp_time_hour,drp_time_min:drp_time_min,location_latitude:location_latitude,location_longitude:location_longitude,BookType:BookType,hoteltitle:hoteltitle,hotellocaion:hotellocaion,drop_terminal:drop_terminal,address:address,fulladdress:fulladdress,guest_name:guest_name,guest_age:guest_age,child_name:child_name,child_age:child_age},
          url: '<?php echo base_url(); ?>'+'ean/ajax_call_car_services_in',
          cache: false,
          beforeSend:function(){
             $(".divLoading").show();
          },
          success: function(data)
          {
                 
                  // $(".divLoading").hide();
                  console.log('In-----------------');
                  responsein = $.parseJSON(data);
                  console.log(responsein);  
                  ptocken = responsein.Purchase.attributes.purchaseToken;
                  psui = responsein.Purchase.ServiceList.Service.attributes.SPUI;

                  //------------------------------------------Services Add OUt------------------------------
      
                 // console.log('Mayur -------------'+ptocken);

                   $.ajax({
                      type: 'GET',
                      data:{contract:contract,contractcode:contractcode,availtotken:availtotken,tranCode:tranCode,tranType:tranType,tranVehicleType:tranVehicleType,child:child,adult:adult,pickup_date:pickup_date,pickup_time_hour:pickup_time_hour,pickup_time_min:pickup_time_min,pickup_terminal:pickup_terminal,dropoff_date:dropoff_date,drp_time_hour:drp_time_hour,drp_time_min:drp_time_min,location_latitude:location_latitude,location_longitude:location_longitude,BookType:BookType,hoteltitle:hoteltitle,hotellocaion:hotellocaion,drop_terminal:drop_terminal,address:address,fulladdress:fulladdress,ptocken:ptocken,psui:psui,guest_name:guest_name,guest_age:guest_age,child_name:child_name,child_age:child_age},
                      url: '<?php echo base_url(); ?>'+'ean/ajax_call_car_services_out',
                      cache: false,
                      beforeSend:function(){
                        // show image here
                        // $(".divLoading").show();
                         //$('#result_data').hide();
                      },
                      success: function(data)
                      {
                       
                        // $(".divLoading").hide();
                        console.log('Out-----------------');
                        responseout = $.parseJSON(data);
                        var purchasenewtoken = responseout.Purchase.attributes.purchaseToken;
                        var supi1 = '';
                        var supi2 = '';                            

                      $.each(responseout.Purchase.ServiceList.Service, function(index, element9) {

                          if ( element9.attributes.transferType == "IN"){
                            supi1 = element9.attributes.SPUI;
                          }
                          
                          if ( element9.attributes.transferType == "OUT"){
                            supi2 = element9.attributes.SPUI;
                          }
                          

                      });

                        //console.log(responseout);
                        

                       // var ptocken = responsein.Purchase.attributes.purchaseToken;
                        //var psui = responsein.Purchase.ServiceList.Service.attributes.SPUI;

                          //------------------------------------------Purchase Confirm------------------------------

                            $.ajax({
                              type: 'GET',
                              data:{contract:contract,contractcode:contractcode,availtotken:availtotken,tranCode:tranCode,tranType:tranType,tranVehicleType:tranVehicleType,child:child,adult:adult,pickup_date:pickup_date,pickup_time_hour:pickup_time_hour,pickup_time_min:pickup_time_min,pickup_terminal:pickup_terminal,dropoff_date:dropoff_date,drp_time_hour:drp_time_hour,drp_time_min:drp_time_min,location_latitude:location_latitude,location_longitude:location_longitude,BookType:BookType,purchasenewtoken:purchasenewtoken,supi1:supi1,supi2:supi2,pickup_flight_code:pickup_flight_code,drp_flight_code:drp_flight_code,hoteltitle:hoteltitle,drop_terminal:drop_terminal,guest_name:guest_name,guest_age:guest_age,child_name:child_name,child_age:child_age},
                              url: '<?php echo base_url(); ?>'+'ean/ajax_call_car_save',
                              cache: false,
                              beforeSend:function(){
                                // show image here
                                // $(".divLoading").show();
                                 //$('#result_data').hide();
                              },
                              success: function(data)
                              {
                               
                                 $(".divLoading").hide();

                                //console.log(data);
                                $("#carbookingdetails").append("<input type='hidden' name='book_response' value='"+data+"'>");

                                responsesave = $.parseJSON(data);
                                console.log(responsesave);
                                var refno1 = responsesave.Purchase.Reference.FileNumber;
                                var refnocode1 = responsesave.Purchase.Reference.IncomingOffice.attributes.code;

                                $("#carbookingdetails").append("<input type='hidden' name='booking_ref_no1' value='"+refno1+"'><input type='hidden' name='office_code_1' value='"+refnocode1+"'>");

                                $("#carbookingdetails").append("<input type='hidden' name='booking_total' value='"+responsesave.Purchase.TotalPrice+"'>");

                                $.each(responsesave.Purchase.ServiceList.Service, function(index, element10) {

                                    if ( element10.attributes.transferType == "IN"){
                                       $("#carbookingdetails").append("<input type='hidden' name='booking_ref_no2' value='"+element10.Reference.FileNumber+"'><input type='hidden' name='office_code_2' value='"+element10.Reference.IncomingOffice.attributes.code+"'>");
                                    }

                                    if ( element10.attributes.transferType == "OUT"){
                                        $("#carbookingdetails").append("<input type='hidden' name='booking_ref_no3' value='"+element10.Reference.FileNumber+"'><input type='hidden' name='office_code_3' value='"+element10.Reference.IncomingOffice.attributes.code+"'>");
                                    } 


                                });

                                $('#confirmvip').html('');
                                var murl = "<?php echo base_url();?>";
                                $('#confirmvip').html('<input type="hidden" name="myurl" id="myurl" value="'+murl+'"><button type="button"  class="btn btn-action btn-lg  completebook" name="<?php if(empty($usersession)){ echo "login";}else{ echo "logged"; } ?>"  onclick="return completebook_confirmvip()">CONFIRM THE BOOKING</button>');
                                
                                $('html, body').animate({
                                scrollTop: $('#detail-slider').offset().top + 500
                                }, 'slow');

                                $('#vip_car_details').hide();
                                $(".booksummary").show();

                                  
                              }         
                                   
                            }); 

                      }         
                           
                    });
            

          }         
               
        });
  }


function car_hotel_airport_in(id){
 
       var pickup_date  = "<?php echo $checkin;?>";
      var pickup_time_hour = $("#flight_pickup_time_hour").val();
      var pickup_time_min = $("#flight_pickup_time_min").val();      
      var pickup_terminal = $("#flight_pickup_terminal").val();
      var drop_terminal = $("#flight_dep_terminal").val();
      var dropoff_date = "<?php echo $checkOut;?>";
      var drp_time_hour = $("#flight_drp_time_hour").val();
      var drp_time_min = $("#flight_drp_time_min").val();

      var pickup_flight_code = $("#pickup_flight_code").val()
      var drp_flight_code = $("#drp_flight_code").val()

      var child = <?php echo $child;?>;
      var adult = <?php echo $adults;?>;
      var location_latitude = '<?php echo $module->latitude;?>';
      var location_longitude = '<?php echo $module->longitude;?>';
      var address = '<?php echo $module->location;?>';
      var hoteltitle = "<?php echo $module->title; ?>";
      var hotellocaion = $("#cityname").val();
      var fulladdress = '<?php echo $module->hotelAddress;?>';

      var BookType = $("input[name='BookType']:checked").val();
      
      var contract = $("#contract"+id).val();
      var contractcode = $("#contractcode"+id).val();
      var availtotken = $("#availtotken"+id).val();

      var tranCode = $("#tranCode"+id).val();
      var tranType = $("#tranType"+id).val()
      var tranVehicleType = $("#tranVehicleType"+id).val()

      var guest_name = $("input[name='guest_name[]']").map(function(){return $(this).val();}).get();
      var guest_age = $("input[name='guest_age[]']").map(function(){return $(this).val();}).get();

      var child_name = $("input[name='child_name[]']").map(function(){return $(this).val();}).get();
      var child_age = $("input[name='child_age[]']").map(function(){return $(this).val();}).get();

       //console.log('Save-----------------'+guest_name);

        //------------------------------------------Services Add IN------------------------------
        
        var ptocken = "";
        var psui = "";
        
        if ( $("#pickup_flight_code").val() == "") {
            $("#err_arr_code").text('Please enter arrival flight code');
            flag ++;
            return false;
        } else if ( $("#flight_pickup_terminal").val() == "") {
            $("#err_arr_term").text('Please select terminal');
            flag ++;
            return false;
        } else {
              $.ajax({
                    type: 'GET',
                    data:{contract:contract,contractcode:contractcode,availtotken:availtotken,tranCode:tranCode,tranType:tranType,tranVehicleType:tranVehicleType,child:child,adult:adult,pickup_date:pickup_date,pickup_time_hour:pickup_time_hour,pickup_time_min:pickup_time_min,pickup_terminal:pickup_terminal,dropoff_date:dropoff_date,drp_time_hour:drp_time_hour,drp_time_min:drp_time_min,location_latitude:location_latitude,location_longitude:location_longitude,BookType:BookType,hoteltitle:hoteltitle,hotellocaion:hotellocaion,drop_terminal:drop_terminal,address:address,fulladdress:fulladdress,guest_name:guest_name,guest_age:guest_age,child_name:child_name,child_age:child_age},
                    url: '<?php echo base_url(); ?>'+'ean/ajax_call_car_services_in',
                    cache: false,
                    beforeSend:function(){
                       $(".divLoading").show();
                    },
                    success: function(data)
                    {
                           
                            // $(".divLoading").hide();
                            console.log('Save-----------------');
                            responsein = $.parseJSON(data);
                            console.log(responsein);  
                            purchasenewtoken = responsein.Purchase.attributes.purchaseToken;
                            psui = responsein.Purchase.ServiceList.Service.attributes.SPUI;

                
                            //------------------------------------------Purchase Confirm------------------------------

                                      $.ajax({
                                          type: 'GET',
                                          data:{contract:contract,contractcode:contractcode,availtotken:availtotken,tranCode:tranCode,tranType:tranType,tranVehicleType:tranVehicleType,child:child,adult:adult,pickup_date:pickup_date,pickup_time_hour:pickup_time_hour,pickup_time_min:pickup_time_min,pickup_terminal:pickup_terminal,dropoff_date:dropoff_date,drp_time_hour:drp_time_hour,drp_time_min:drp_time_min,location_latitude:location_latitude,location_longitude:location_longitude,BookType:BookType,pickup_flight_code:pickup_flight_code,drp_flight_code:drp_flight_code,hoteltitle:hoteltitle,hotellocaion:hotellocaion,address:address,fulladdress:fulladdress,drop_terminal:drop_terminal,purchasenewtoken:purchasenewtoken,psui:psui,guest_name:guest_name,guest_age:guest_age,child_name:child_name,child_age:child_age},
                                          url: '<?php echo base_url(); ?>'+'ean/ajax_call_car_oneway_save',
                                          cache: false,
                                          beforeSend:function(){
                                            // show image here
                                            // $(".divLoading").show();
                                            //$('#result_data').hide();
                                          },
                                          success: function(data)
                                          {

                                                $(".divLoading").hide();

                                                //console.log(data);
                                                $("#carbookingdetails").append("<input type='hidden' name='book_response' value='"+data+"'>");

                                                responsesave = $.parseJSON(data);
                                                console.log(responsesave);
                                                var refno1 = responsesave.Purchase.Reference.FileNumber;
                                                var refnocode1 = responsesave.Purchase.Reference.IncomingOffice.attributes.code;

                                                $("#carbookingdetails").append("<input type='hidden' name='booking_ref_no1' value='"+refno1+"'><input type='hidden' name='office_code_1' value='"+refnocode1+"'>");

                                                    $("#carbookingdetails").append("<input type='hidden' name='booking_total' value='"+responsesave.Purchase.TotalPrice+"'>");

                                              
                                                
                                                    $("#carbookingdetails").append("<input type='hidden' name='booking_ref_no2' value='"+responsesave.Purchase.ServiceList.Service.Reference.FileNumber+"'><input type='hidden' name='office_code_2' value='"+responsesave.Purchase.ServiceList.Service.Reference.IncomingOffice.attributes.code+"'>");

                                                    $("#carbookingdetails").append("<input type='hidden' name='booking_ref_no3' value=''><input type='hidden' name='office_code_3' value=''>");
                                                                                     
                                              

                                                    $('#confirmvip').html('');
                                                    var murl = "<?php echo base_url();?>";
                                                    $('#confirmvip').html('<input type="hidden" name="myurl" id="myurl" value="'+murl+'"><button type="submit"  class="btn btn-action btn-lg  completebook" name="<?php if(empty($usersession)){ echo "login";}else{ echo "logged"; } ?>"  onclick="return completebook_confirmvip()">CONFIRM THE BOOKING</button>');

                                                      $('html, body').animate({
                                                      scrollTop: $('#detail-slider').offset().top + 500
                                                      }, 'slow');

                                                      $('#vip_car_details').hide();
                                                      $(".booksummary").show();


                                          }         

                                      }); 

                    }         
                         
                  });
        } 

        
  }
</script> 
<script type="text/javascript">

function completebook_confirmvip() {

    var url = $("#myurl").val();

    $(".divLoading").show();

     $("#err_term").text("");

     var policy = $("input[name='attantion']:checked").val();

     if (typeof policy != "undefined") {

        <?php if($appModule == "ean"){ ?>

         $.post(url + "admin/carajaxcalls/hbprocessBooking", $("#bookingdetails,#guest_details").serialize(), function(response) {
          <?php } else {?>


         $.post(url + "admin/carajaxcalls/processBooking", $("#bookingdetails,#guest_details").serialize(), function(response) {
          <?php } ?>

             var resp = $.parseJSON(response);
              console.log(resp);
              var rdir_url = resp.url;
              /*setTimeout(function() {
                    window.location.replace(rdir_url);
                    }, 5000);*/
              $("#carbookingdetails").append("<input type='hidden' name='booking_hotel_id' value='"+resp.book_id+"' >");
              
    
              $.post(url + "admin/carajaxcalls/carBooking", $("#bookingdetails,#guest_details,#carbookingdetails,#vip_details,#newcheckin").serialize(), function(response) {
                console.log(rdir_url);
                /* var resp = $.parseJSON(response);
                 console.log(resp);*/
                 $(".divLoading").hide();
                    setTimeout(function() {
                    window.location.replace(rdir_url);
                    }, 2000);


              });
       });  

    } else {
          $("#err_term").text("Please select the checkbox for policy");
    }

 }

</script> 
<!-- map -->
<div class="collapse" id="collapseMap"> <br>
  <script>

$(".guest_cont").click(function(){
var guest_name = $("input[name='guest_name[]']").map(function(){return $(this).val();}).get();
var guest_age = $("input[name='guest_age[]']").map(function(){return $(this).val();}).get();


var child_name = $("input[name='child_name[]']").map(function(){return $(this).val();}).get();
var child_age = $("input[name='child_age[]']").map(function(){return $(this).val();}).get();
  

  var mem_type = $('#click_type').val();
  
  if (guest_name == '' && guest_age == '') {
     $('.disp_message').html("<div class='alert alert-success'>Enter guest details.</div>");
   }else if(mem_type == 'already_member'){
     $('.book_extra_hide').hide();
      $('.login').show();
  }else if(mem_type == 'cont_as_free'){
      $('.book_extra_hide').hide();
     
      <?php if(!empty($usersession)){ ?>
         $('.login').show();
      <?php }else{ ?>
         $('.signup_body').show();
      <?php } ?>
     // $('.signup_upgrade_to_vip').show();
  }else if(mem_type == 'cont_as_vip'){
      $('.book_extra_hide').hide();
       $('.signup_body').show();
  }else if(mem_type == 'cont_as_upg_vip'){
    $('.book_extra_hide').hide();
    $('.login').show();
  } else{

  }


});

 
    $(document).ready(function() {
      $("#detail-slider").owlCarousel({

      navigation : true,
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem : true,
      pagination:false,
      navigationText : ["prev", "next"],

      // "singleItem:true" is a shortcut for:
      // items : 1, 
      // itemsDesktop : false,
      // itemsDesktopSmall : false,
      // itemsTablet: false,
      // itemsMobile : false

      });
    });
  
     
    $(document).ready(function(e) {
      (function(A) {
          if (!Array.prototype.forEach)
              A.forEach = A.forEach || function(action, that) {
                  for (var i = 0, l = this.length; i < l; i++)
                      if (i in this) action.call(that, this[i], i, this);
              }
      })(Array.prototype);
      var mapObject, markers = [],
          markersData = {
              'marker': [{
                  name: '<?php echo character_limiter($module->title, 80);?>',
                  location_latitude: <?php echo $module->latitude;?>,
                  location_longitude: <?php echo $module->longitude;?>,
                  map_image_url: '<?php echo $module->thumbnail;?>',
                  name_point: '<?php echo character_limiter($module->title, 20);?>',
                  description_point: '',
                  url_point: '<?php echo $module->slug;?>'
              }, <?php foreach($module->relatedItems as $item):?> {
                  name: 'hotel name',
                  location_latitude: "<?php echo $item->latitude;?>",
                  location_longitude: "<?php echo $item->longitude;?>",
                  map_image_url: "<?php echo $item->thumbnail;?>",
                  name_point: "<?php echo $item->title;?>",
                  description_point: '',
                  url_point: "<?php echo $item->slug;?>"
              }, <?php endforeach;?>]
          };
          
      var mapOptions = {
          zoom: 16,
          center: new google.maps.LatLng(<?php echo $module->latitude;?>, <?php echo $module->longitude;?>),
          styles: [
              {
                  "featureType": "road",
                  "elementType": "geometry",
                  "stylers": [
                      {
                          "color": "#5b4e96"
                      }
                  ]
              },
              {
                  "featureType": "road",
                  "elementType": "labels",
                  "stylers": [
                      {
                          "weight": "0.01"
                      },
                      {
                          "hue": "#00fff1"
                      }
                  ]
              }
          ],
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          mapTypeControl: !1,
          mapTypeControlOptions: {
              style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
              position: google.maps.ControlPosition.LEFT_CENTER
          },
          panControl: !1,
          panControlOptions: {
              position: google.maps.ControlPosition.TOP_RIGHT
          },
          zoomControl: !0,
          zoomControlOptions: {
              style: google.maps.ZoomControlStyle.LARGE,
              position: google.maps.ControlPosition.TOP_RIGHT
          },
          scrollwheel: !1,
          scaleControl: !1,
          scaleControlOptions: {
              position: google.maps.ControlPosition.TOP_LEFT
          },
          streetViewControl: !0,
          streetViewControlOptions: {
              position: google.maps.ControlPosition.LEFT_TOP
          }
      };
      var marker;
      mapObject = new google.maps.Map(document.getElementById('map'), mapOptions);
      for (var key in markersData)
          markersData[key].forEach(function(item) {
              marker = new google.maps.Marker({
                  position: new google.maps.LatLng(item.location_latitude, item.location_longitude),
                  map: mapObject,
                  icon: '<?php echo base_url(); ?>uploads/global/default/' + key + '.png',
              });
              if ('undefined' === typeof markers[key])
                  markers[key] = [];
                  markers[key].push(marker);
                  google.maps.event.addListener(marker, 'click', (function() {
                      closeInfoBox();
                      getInfoBox(item).open(mapObject, this);
                      mapObject.setCenter(new google.maps.LatLng(item.location_latitude, item.location_longitude))
                  }))
          });

      function hideAllMarkers() {
          for (var key in markers)
              markers[key].forEach(function(marker) {
                  marker.setMap(null)
              })
      };

      function closeInfoBox() {
          $('div.infoBox').remove()
      };

      function getInfoBox(item) {
          return new InfoBox({
             content:
            '<div style="background:#fff;" class="marker_info col-sm-6 box odd" id="marker_info">' +
           '<h4>'+ item.name_point +'</h4>' +
           '</div>',
           disableAutoPan: true,
           maxWidth: 0,
           pixelOffset: new google.maps.Size(-150, -135),
           closeBoxMargin: '0px -20px 2px 2px',
           closeBoxURL: "<?php echo $theme_url; ?>assets/img/close.png",
           isHidden: false,
           pane: 'floatPane',
           enableEventPropagation: true
          })
      }
    });



  </script> 
</div>
<!-- map -->

<div id="mem_pay" style="display:none;">
  <button id="element_id_1470283648" style="display:none;"></button>
</div>
<script type="text/javascript">
  
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
    amount: "1900",
  items: [{
  title: "Reservation Payment",
  subtitle: "Payment to lock reservation in TarzanGo",
  item_price: "1900",
  quantity: 1
  }],
  }
  PayStand.checkoutComplete = function (data) {

    var formname = $("#mem_pay").data('name');

    
     $("#mem_pay").fadeOut("fast");
     $("#waiting").html("Please Wait...");


    var user_id = $("#user_id").val();
    console.log("my id = "+user_id);
   
   $.ajax({
             type: 'POST',
             data: {
                 user_id: user_id
             },
             url: "<?php echo base_url();?>" + "admin/carajaxcalls/add_member",
             cache: false,
             beforeSend: function() {

             },
             success: function(response) {

                PayStand.closeFrame(checkout);
                
                 var resp = $.parseJSON(response);
                console.log(response);


                 if (resp.error == "yes") {
                     $(".result").html("<div class='alert alert-danger'>" + resp.msg + "</div>");
                     $("#waiting").html("");

                 } else {

                    $('html, body').animate({
                      scrollTop: $('#detail-slider').offset().top + 500
                    }, 'slow');

                    $('.book_extra_hide').hide();
                    $(".result").html("");
                    $('#vip_drop_select').show();  

                 }
             }
         });
 }

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
</script> 
