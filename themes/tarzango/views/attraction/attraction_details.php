
<div class="attraction-details">
  <?php 
/*error_reporting(-1);*/
/*echo json_encode($data);
exit();*/
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
  include 'header_search.php'; ?>
  <div class="attraction-details-body">
    <section class="hotel-detail-header" style="width: 100%;">
      <div class="hotel-detail-header-info">
        <div class="hd-info">
          <div class="container">
            <h2><?php echo $data->name; ?></h2>
            <div class="rating-detail">
              <p>Theme and water parks</p>
            </div>
            <div class="listing-back"> <a href="#"><img src="images/back.png"> Back to Listings</a> </div>
          </div>
        </div>
      </div>
      <?php if($dest[0]->detail_back_img != ""){ ?>
      <img style="width: 100%;" src="<?php echo base_url().'uploads/images/dest_img/detail_back_img/'.$dest[0]->detail_back_img; ?>">
      <?php }else{ ?>
      <img style="width: 100%;" src="<?php echo $data->content->media->images[0]->urls[0]->resource; ?>">
      <?php } ?>
    </section>
    <!--  <div class="banner" style="background-image:url('<?php echo $data->content->media->images[0]->urls[0]->resource; ?>');">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h1><?php echo $data->name; ?></h1>
            <p>Theme and water parks</p>
            <a href="#"><img src="images/back.png"> Back to Listings</a>
          </div>
        </div>
      </div>
    </div> -->
    <div class="inner"> <img class="top-bg" src="images/details_update_sidegraphic3.png"> <img class="left-bg1" src="images/details_update_sidegraphic1.png"> <img class="left-bg2" src="images/details_update_sidegraphic2.png">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="col-sm-7 left-section">
              <div id="myCarousel" class="carousel slide" data-ride="carousel"> 
                <!-- Indicators --> 
                
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                  <?php 
                  for ($img=0; $img < count($data->content->media->images) ; $img++) {  
                    $base_img = $data->content->media->images[$img];
                    $img_disp = '';
                    for ($img_1=0; $img_1 < count($base_img->urls) ; $img_1++) { 
                      if($base_img->urls[$img_1]->sizeType == 'XLARGE'){
                          $img_disp = $base_img->urls[$img_1]->resource;
                      }
                    }
                    ?>
                  <div class="item <?php if($img == 0){ echo "active"; } ?>"> <img src="<?php echo $img_disp; ?>" alt="slide"> </div>
                  <?php }
                  ?>
                </div>
                
                <!-- Left and right controls --> 
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev"> <span class="fa fa-arrow-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next"> <span class="fa fa-arrow-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
              <div class="content">
                <label>Description</label>
                <p><?php echo $data->content->description; ?></p>
                <label>What's Included</label>
                <?php for ($a=0; $a < count($data->content->featureGroups[0]->included) ; $a++) { ?>
                <p><?php echo $data->content->featureGroups[0]->included[$a]->description; ?></p>
                <?php } ?>
                <?php
                for ($b=0; $b < count($data->content->segmentationGroups) ; $b++) { 
                  $base = $data->content->segmentationGroups[$b];
                  ?>
                <label><?php echo $base->name; ?></label>
                <?php
                      $sag_data = array();
                        for ($b_a=0; $b_a < count($base->segments) ; $b_a++) {  ?>
                <?php $sag_data[] =  $base->segments[$b_a]->name; ?>
                <?php }
                       ?>
                <p><?php echo implode(" , ", $sag_data); ?></p>
                <?php }
                 ?>
                <?php include 'booking.php'; ?>
                <label>Location</label>
                <div id="map" style="width:100%;height:400px;"> </div>
              </div>
              <?php if($trip_data != ''){ ?>
              <div class="ratings">
                <label class="rating-title">Ratings</label>
                <?php
                    for ($r_i=0; $r_i < count($trip_data->reviews) ; $r_i++) { ?>
                <div class="item">
                  <div class="col-sm-2 col-xs-4"> <img src="<?php echo base_url().'assets/img/user_blank.jpg'; ?>"> </div>
                  <div class=" hidden-lg hidden-sm hidden-md col-xs-8 mtoprto"><div class="star">
                      <?php
                          for ($st_r_i=0; $st_r_i < $trip_data->reviews[$r_i]->rating; $st_r_i++) { ?>
                      <img src="images/star.png">
                      <?php }
                          for ($st_r_i_a=$st_r_i; $st_r_i_a < 5 ; $st_r_i_a++) { ?>
                      <img src="images/star_light.png">
                      <?php }
                           ?>
                    </div>
                    <label><?php echo $trip_data->reviews[$r_i]->user->username; ?></label></div>
                  <div class="col-sm-10 col-xs-12">
                    <div class="star hidden-xs">
                      <?php
                          for ($st_r_i=0; $st_r_i < $trip_data->reviews[$r_i]->rating; $st_r_i++) { ?>
                      <img src="images/star.png">
                      <?php }
                          for ($st_r_i_a=$st_r_i; $st_r_i_a < 5 ; $st_r_i_a++) { ?>
                      <img src="images/star_light.png">
                      <?php }
                           ?>
                    </div>
                    <label class="hidden-xs"><?php echo $trip_data->reviews[$r_i]->user->username; ?></label>
                    <p class="mtoprto"><?php echo $trip_data->reviews[$r_i]->text; ?></p>
                  </div>
                </div>
                <?php } ?>
              </div>
              <?php }else{ ?>
              <div class="ratings"> </div>
              <?php } ?>
            </div>
            <div class="col-sm-5 right-section" id="detail-slider">
              <form class="sidebar result" method="get">
                <input type="hidden" name="code" value="<?php echo $code; ?>">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Date</label>
                    <input type="text" name="checkIn" value="<?php echo $checkin; ?>" class="form-control" id="datepicker3" placeholder="DD/MM/YYYY">
                  </div>
                </div>
                <div class="col-sm-12">
                  <label class="title">Number Of tickets</label>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Adults</label>
                      <img class="decrease" id="" src="images/field-arrow-down.png">
                      <input type="text" name="adults" value="<?php echo $adults; ?>" id="" class="adult" >
                      <img class="increase" id="" src="images/field-arrow-down.png"> </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Children</label>
                      <img class="decrease" id="" src="images/field-arrow-down.png">
                      <input type="text" name="child" value="<?php echo $child; ?>" id="" class="child" >
                      <img class="increase" id="" src="images/field-arrow-down.png"> </div>
                  </div>
                  <input type="hidden" name="child_allow" value="<?php echo $_GET['child_allow']; ?>">
                  <button type="submit" class="btn modify">MODIFY</button>
                </div>
                <input type="hidden" name="lat" value="<?php echo $latitude; ?>">
                <input type="hidden" name="long" value="<?php echo $longitude; ?>">
              </form>
              <div class="sidebar12 "> </div>
              <div class="sidebar signup_body book_extra_hide" style="display:block;">
                <div class="col-sm-12 col-xs-12 left-section sign_in_up ">
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
                            <input class="form-control form" type="password" placeholder="Password" name="password" id="password"  value="">
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
                            <label for="name"></label>
                            <input type="text" class="form-control" id="name" name="firstname" value="" placeholder="Full Name">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label  class="required go-right"></label>
                            <input class="form-control form" type="text" placeholder="Last Name" name="lastname"  value="">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="no"></label>
                            <input type="number" class="form-control" id="no" name="no" value="" placeholder="Mobile Number">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="email"></label>
                            <input type="email" class="form-control" id="email" name="email" value="" placeholder="Email">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="pass"></label>
                            <input type="password" class="form-control" id="pass" name="password" value="" placeholder="Password">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="conf_pass"></label>
                            <input type="password" class="form-control" id="conf_pass" name="conf_pass" value="" placeholder="Confirm Password">
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group submit-button"> 
                            <!-- <input type="submit" class="form-control" id="submit" name="submit" value="CREATE ACCOUNT">--> 
                          </div>
                        </div>
                      </form>
                      <button type="submit"  class="btn btn-action btn-lg  completebook" name="<?php if(empty($usersession)){ echo "login";}else{ echo "logged"; } ?>"  onclick="return completebook('<?php echo base_url();?>','<?php echo trans('0159')?>');">CONTINUE THIS BOOKING</button>
                    </div>
                  </div>
                </div>
              </div>
              <form class="sidebar" id="final_book" style="display:none;" action="" method="get">
                <div class="sidebar-modal">
                  <div class="col-sm-12">
                    <div class="info"> <img class="booking-sidebar-logo" src="images/booking-sidebar-icon.png"></img>
                      <p class="title">Booking Summary</p>
                      <h4 class="place-title"><?php echo $data->name; ?></h4>
                      <h5>Tickets and Excursions</h5>
                      <h6><?php echo $checkin; ?> . <?php echo $adults ?> Adults
                        <?php if($child > 0 && $_GET['child_allow'] == 1 ){ echo "and ".$child." Child"; } ?>
                      </h6>
                      <hr>
                    </div>
                    <div class="booking-details">
                      <?php 
                      for ($a_g=0; $a_g < $adults ; $a_g++) {  ?>
                      <p>TICKET <?php echo $a_g + 1; ?></p>
                      <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="guest_details[]" value="" class="form-control" Placeholder="Full Name">
                      </div>
                      <?php }
                      if(isset($_GET['child_allow']) && $_GET['child_allow'] == 1){
                      for ($c_g=0; $c_g < $child ; $c_g++) {  ?>
                      <p>CHILD TICKET <?php echo $c_g + 1; ?></p>
                      <div class="form-group">
                        <label>Kids Full Name</label>
                        <input type="text" name="kids_details[]" value="" class="form-control" Placeholder="Full Name">
                      </div>
                      <?php } }else if($child > 0){ ?>
                      <label>CHILD TICKET N/A</label>
                      <?php }
                      ?>
                      <hr>
                      <div class="total-tickets">
                        <p>TICKETS</p>
                        <h3><?php echo $adults ?> Adults
                          <?php if($child > 0 && $_GET['child_allow'] == 1){ echo "and ".$child." Child"; } ?>
                          (1 Day Pass) <span class="aj_disp_price"> $ 85.56</span></h3>
                      </div>
                      <hr>
                      <div class="summery-text">
                        <p>CONTACT REMARKS</p>
                        <p class="blue disp_c_r">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                        <hr>
                        <p class="red">in the event of cancellation after <span class="can_date">00:00 am 26/08/2016 </span> the following charges will be applied $ <span class="can_amt">85.56</span></p>
                        <p class="blue">Date and Time is calculated based on local time of destination.</p>
                      </div>
                      <hr>
                      <div class="notice">
                        <p>ATTENTION: this booking will incur cancellation fees as form the moment it is comfirmed</p>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value="" name="">
                            Yes, I want to book and accept the cancellation policy</label>
                        </div>
                      </div>
                      <hr>
                      <div class="total-amount">
                        <h2>Booking total <span class="aj_disp_price" >$ 85.56</span></h2>
                      </div>
                      <hr>
                      <?php 
                      /*error_reporting(-1);*/
                      $base_addr = $data->content->location->startingPoints[0]->meetingPoint;
                      /*echo json_encode($base_addr);*/
                      if($trip_data->address_obj->address_string){
                        $address = $trip_data->address_obj->address_string;
                      }else if($base_addr->address){
                        $address = $base_addr->address.' '.$base_addr->city.' '.$base_addr->zip;
                      }else{
                        $address = $base_addr->country->destinations[0]->name.' '.$base_addr->country->name;
                      }
                        
                      ?>
                      <input type="hidden" name="address" value="<?php echo $address; ?>">
                      <div class="form-group submit-button">
                        <button type="button"  class="btn btn-action btn-lg " onclick="return finalbook('<?php echo base_url();?>');">CONTINUE TO BOOK TICKETS NOW</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
              <div class="sidebar">
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
                <div class="login book_extra_hide" style="display:none; background: #f1f1f8; padding: 30px 10px;">
                  <div class="col-sm-12 col-xs-12 left-section  " style="text-align:center;">
                    <label style="font-size:15px;"> Total : $ <span class="total_disp">20</span></label>
                  </div>
                  <hr>
                  <div class="col-sm-12 col-xs-12 left-section  ">
                    <form id="loggedform">
                      <div class="panel-body">
                        <div class="col-md-6  go-right">
                          <div class="form-group ">
                            <label  class="required go-right">First Name</label>
                            <input class="form-control form" type="text" placeholder="" name=""  value="<?php echo $profile[0]->ai_first_name?>" disabled="disabled" style="background-color: #DEDEDE !important"/>
                          </div>
                        </div>
                        <div class="col-md-6  go-left">
                          <div class="form-group ">
                            <label  class="required go-right">Last name</label>
                            <input class="form-control form" type="text" placeholder="" name=""  value="<?php echo $profile[0]->ai_last_name?>" disabled="disabled" style="background-color: #DEDEDE !important">
                          </div>
                        </div>
                        <div class="col-md-12 go-right">
                          <div class="form-group ">
                            <label  class="required  go-right">Email</label>
                            <input class="form-control form" type="text" placeholder="" name=""  value="<?php echo $profile[0]->accounts_email?>" disabled="disabled" style="background-color: #DEDEDE !important">
                          </div>
                        </div>
                        <div class="col-md-12  go-right">
                          <div class="form-group ">
                            <label  class="required go-right">Notes</label>
                            <textarea class="form-control form" placeholder="<?php echo trans('0415');?>" rows="4" name="additionalnotes"></textarea>
                          </div>
                        </div>
                      </div>
                    </form>
                    <button type="submit" style="letter-spacing:1.5px;"  class="btn btn-action btn-lg detail-btn completebook" name="<?php if(empty($usersession)){ echo "login";}else{ echo "logged"; } ?>"  onclick="return completebook_login('<?php echo base_url();?>','<?php echo trans('0159')?>');">CONTINUE THIS BOOKING</button>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="container-fluid how-section vip-membership">
      <div class="container">
        <div class="col-md-7 ptop70">
          <h4 class="description" style="text-align:left;font-size:30px;padding-bottom: 0px;">Become a V.I.P member Now and receive additional</h4>
          </br>
          <h4 style="text-align:left;font-size:30px;margin-top:-10px;font-family: 'Apercu-Bold';">10% off plus some AWESOME perks...</h4>
          <a href="<?php echo base_url().'membership';?>" style="float:left" title="group booking" class="pink-btn">membership</a> </div>
        <div class="col-sm-5"> <img style="margin-top: 0px" src="images/membership-door.png"> </div>
      </div>
    </div>
  </div>
</div>
</div>
<form id="bookingdetails" class="hidden-xs hidden-sm" action="" onsubmit="return false">
  <input type="hidden" id="attraction_code" name="attraction_code" value="<?php echo $code;?>" />
  <input type="hidden" name="checkin" value="<?php echo $checkin;?>" />
  <input type="hidden" name="checkout" value="<?php echo $checkOut;?>" />
  <input type="hidden" name="adults" value="<?php echo $adults;?>" />
  <input type="hidden" name="child" value="<?php echo $child;?>" />
  <input type="hidden" name="lat" value="<?php echo $latitude;?>" />
  <input type="hidden" name="long" value="<?php echo $longitude;?>" />
  <input type="hidden" name="thumbnail" value="<?php echo $img_disp; ?>" />
  <input type="hidden" name="attraction_name" value="<?php echo $data->name; ?>" />
  <?php if(!empty($usersession)){ ?>
  <input type="hidden" name="user_id" value="<?php echo $usersession; ?>">
  <?php } ?>
</form>
<?php 
//print_r($data->content->geolocation);
 ?>
<script src="<?php echo base_url(); ?>assets/js/attr_booking.js"></script> 
<script type="text/javascript">
<?php if($data->content->geolocation->latitude) {?>
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
                  name: '<?php echo character_limiter($data->name, 80);?>',
                  location_latitude: <?php echo $data->content->geolocation->latitude;?>,
                  location_longitude: <?php echo $data->content->geolocation->longitude;?>,
                  map_image_url: '<?php echo $img_disp;?>',
                  name_point: '<?php echo character_limiter($data->name, 20);?>',
                  description_point: '',
                  url_point: ''
              }]
          };
          
      var mapOptions = {
          zoom: 16,
          center: new google.maps.LatLng(<?php echo $data->content->geolocation->latitude;?>, <?php echo $data->content->geolocation->longitude;?>),
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
                      //getInfoBox(item).open(mapObject, this);
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
<?php }else{ ?>
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
                  name: '<?php echo character_limiter($data->name, 80);?>',
                  location_latitude: <?php echo $latitude;?>,
                  location_longitude: <?php echo $longitude;?>,
                  map_image_url: '<?php echo $img_disp;?>',
                  name_point: '<?php echo character_limiter($data->name, 20);?>',
                  description_point: '',
                  url_point: ''
              }]
          };
          
      var mapOptions = {
          zoom: 12,
          center: new google.maps.LatLng(<?php echo $latitude;?>, <?php echo $longitude;?>),
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
                      //getInfoBox(item).open(mapObject, this);
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
<?php } ?>
</script>
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
    PayStand.closeFrame(checkout);
    $('html, body').animate({
        scrollTop: $('#detail-slider').offset().top + 300
    }, 'slow');
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
</script> 
