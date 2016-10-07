<link rel="stylesheet" href="css/bxslider.css">
<script src='js/jquery-ui.js'></script>
<script src='js/bxslider.js'></script>
<script>
  $( function() {
    $( ".accordion" ).accordion({
       active: false,            
       autoHeight: false,            
       navigation: true,            
       collapsible: true,
       create: function(event, ui) { $(".accordion").show(); }
    });
  });
  </script>
<script type="text/javascript">
      $(document).ready(function(){
        
    $('.bxslider').bxSlider({
      //mode: 'fade',
      auto: true,
      autoControls: true,
      captions: true
    });
      });
  </script>
<style type="text/css">
/*===============Responsive css================*/

@media(max-width:1199px) {
.Services_page_main .Services_page_cover .service_cont ul li .service_left {
	padding-right: 3%
}
}

@media(max-width:991px) {
.Services_page_main .Services_page_cover .service_cont ul li .service_left h3 {
	margin-bottom: 30px;
	font-size: 34px;
}
.Services_page_main .Services_page_cover .service_cont ul li .service_left p {
	margin-bottom: 60px;
}
.Services_page_main .Services_page_cover .service_cont ul li {
	padding: 50px 0;
}
}

@media(max-width:820px) {
.member_ship .upgrade_membership h3::after {
	top: 0px;
	right: 0;
	background-size: 90px auto;
}
}

@media(max-width:768px) {
.Services_page_main .container {
	padding-right: 10px !important;
	padding-left: 10px !important;
}
.Services_page_main .Services_page_cover .service_cont ul li .service_right img {
	width: 70%;
}
}

@media(max-width:767px) {
.service_cont_slider .bxslider li .slider_img {
	width: 100%
}
.service_cont_slider .bxslider li .slider_cont {
	width: 100%;
	padding-left: 0;
	margin-top: 30px;
}
.service_cont_slider .bxslider li .slider_cont p {
	width: auto;
}
}

@media(max-width:667px) {
.Services_page_main .Services_page_cover .service_cont ul li .service_right {
	float: left;
	width: 100%;
	text-align: left;
}
.Services_page_main .Services_page_cover .service_cont ul li .service_left {
	width: 100%;
	padding-right: 0;
	text-align: left;
}
.Services_page_main .Services_page_cover .service_cont ul li .service_right img {
	width: auto;
}
}

@media(max-width:568px) {
.service_cont_slider .bxslider li .slider_cont h3 {
	font-size: 40px;
	line-height: 36px;
}
.service_cont_slider .bxslider li > h3 {
	font-size: 24px;
}
.service_cont_slider .bxslider li .slider_cont p {
	font-size: 36px;
}
.service_cont_slider .bxslider li .slider_cont spam {
	margin-top: 5px;
}
}

@media(max-width:480px) {
.Services_page_main .Services_page_cover .service_cont ul li .service_left h3 {
	font-size: 25px;
}
}

@media(max-width:414px) {
.Services_page_main .Services_page_cover .service_cont ul li .service_right img {
	width: 190px;
	margin-left: 80px;
}
.Services_page_main .Services_page_cover .service_cont ul li .service_left h3 {
	font-size: 21px;
	margin-top: 0;
	text-align: center;
}
}
.Services_page_main .Services_page_cover .service_cont ul li .service_right {
	padding: 0 0 40px;
}
}
</style>

<div class="contact">
  <?php include 'new_header.php';?>
  <div class="container-main main_header" style="padding-top:110px">
    <div class="container">
      <div class="row">
        <center class="center" style="margin-left: 88px; z-index: 999;
    margin-top: 20px;">
        </center>
        <div class="col-sm-12 page-title">
          <h2 class="">Services </h2>
          <a  href="<?php echo base_url(); ?>" ><img style="position:relative;z-index:999;" src="images/arrow-blue.png"></a> </div>
      </div>
    </div>
  </div>
</div>
<div class="Services_page_main">
  <div class="Services_page_cover">
    <div class="service_cont">
      <ul>
        <li>
          <div class="container">
            <div class="row">
              <div class="col-sm-4 pull-right"><img src="images/event_housing.png"></div>
              <div class="col-sm-6">
                <h3>Event Housing</h3>
                <p>We negotiate the hotel rooms for event coordinators to provide to attendees, guest, and exhibitors. With providing a simple platform to book , manage, and travel better.</p>
                <a class="service_btn" href="<?php echo base_url().'groupbooking'; ?>">Learn More</a> </div>
              <div class="col-sm-2 hidden-xs"></div>
              <div class="clearfix"></div>
            </div>
          </div>
        </li>
        <li>
          <div class="container">
            <div class="row">
              <div class="col-sm-4 pull-right"><img src="images/book_hotel.png"></div>
              <div class="col-sm-6">
                <h3>Book over 300,000 Hotels</h3>
                <p>We allow you to book under 10 rooms search over 300, 000 hotels and start saving now on your trip. No more taking notes down, just log into your account to keep track of all your reservations. </p>
                <a class="service_btn" href="<?php echo base_url();?>">find your hotel</a> </div>
              <div class="col-sm-2 hidden-xs"></div>
              <div class="clearfix"></div>
            </div>
          </div>
        </li>
        <li>
          <div class="container">
            <div class="row">
              <div class="col-sm-4 pull-right"><img src="images/attraction.png"></div>
              <div class="col-sm-6">
                <h3>Attractions & Excursions</h3>
                <p>Family time is very important, so why not spend it at some of the best attraction places in the world. Which is why we decided to provide it to you. Book at all your fun and excited them parks or city tours now at Tarzango.</p>
                <a class="service_btn" href="<?php echo base_url().'attraction'; ?>">Attractions</a> </div>
              <div class="col-sm-2 hidden-xs"></div>
              <div class="clearfix"></div>
            </div>
          </div>
        </li>
        <li>
          <div class="container">
            <div class="row">
              <div class="col-sm-4 pull-right"><img src="images/car1.png"></div>
              <div class="col-sm-6">
                <h3>Rental Car & Air Flight</h3>
                <p>We're negotiating with the top lenders behind air and rental cars to provide you the best All in one check out experience. No more visiting multiple sites and multiple email reservations, with Tarzango we’ll handle all your travel needs from Pick up to Airport, hotels, tips on what to do in a new city, and places to go. Become  ammeter today to be first in line when we launch these features.</p>
                <a class="service_btn">Coming soon</a></div>
              <div class="col-sm-2 hidden-xs"></div>
              <div class="clearfix"></div>
            </div>
          </div>
        </li>
        <li>
          <div class="container">
            <div class="row">
              <div class="col-sm-4 pull-right"><img src="images/travell_gear.png"></div>
              <div class="col-sm-6">
                <h3>Travel Gear</h3>
                <p>We all hate traveling uncormtably, this is why were making it more comfortable to travel. We’re creating clothes for the adults to the kids to feel at home where your away. Plane rides will never feel the same when your not in the Tarzango gear. And don’t worry about bringing your esstinals, we’ll have you covered with all natural travel nestles that feels and makes you smell good. </p>
                <a class="service_btn" >Coming soon</a></div>
              <div class="col-sm-2 hidden-xs"></div>
              <div class="clearfix"></div>
            </div>
          </div>
        </li>
      </ul>
    </div>
    <div class="service_cont_slider">
      <div class="container">
        <ul class="bxslider">
          <?php 
                          $img_ary_repla = array('bigger/','demo.');
                          for ($r_b=0; $r_b < 3 ; $r_b++) {  
                            if($recent_book[$r_b]->book_response){
                              $total = $recent_book[$r_b]->book_roomtotal;
                              $url = $recent_book[$r_b]->slug;
                              $book_location = $recent_book[$r_b]->book_location;
                            }else{
                              for ($l_ex=0; $l_ex < count($recent_book_l) ; $l_ex++) { 
                                if($recent_book_l[$l_ex]->id == $recent_book[$r_b]->itemid){
                                  $total = $recent_book_l[$l_ex]->book_roomtotal;
                                  $url = $recent_book_l[$l_ex]->slug;
                                  $book_location = $recent_book_l[$l_ex]->book_location;
                                }
                              }
                            }
                            ?>
          <li>
            <h3>Hotels Just Booked.</h3>
            <div class="slider_img"  > <img  src="<?php echo str_replace($img_ary_repla, "",  $recent_book[$r_b]->thumbnail); ?>" /> </div>
            <div class="slider_cont"> <span> <?php echo $recent_book[$r_b]->stars; ?></span>
              <h3><?php echo $recent_book[$r_b]->title; ?></h3>
              <p>$ <?php echo $total; ?><span> /night</span></p>
              <a  href="<?php echo $url; ?>"><img src="images/slider_btn.png"></a>
              <spam>30 minutes ago</spam>
            </div>
          </li>
          <?php }?>
          <!--   
                         <li>
                         <h3>Hotels Just Booked.</h3>
                            <div class="slider_img">
                                <img src="images/slider_img.jpg" />
                            </div>
                            <div class="slider_cont">
                                <span><img src="images/rating.png"></span>
                                <h3>The D Hotel<br><span>Las Vegas</span></h3>
                                <p>$ 129<span>/ night</span></p>
                                <a ><img src="images/slider_btn.png"></a>
                                <spam>30 minutes ago</spam>
                            </div>
                         </li>
                         <li>
                         	<h3>Hotels Just Booked.</h3>
                            <div class="slider_img">
                                <img src="images/slider_img.jpg" />
                            </div>
                            <div class="slider_cont">
                                <span><img src="images/rating.png"></span>
                                <h3>The D Hotel<br><span>Las Vegas</span></h3>
                                <p>$ 129<span>/ night</span></p>
                                <a ><img src="images/slider_btn.png"></a>
                                <spam>30 minutes ago</spam>
                            </div>
                         </li>
                         <li>
                         	<h3>Hotels Just Booked.</h3>
                            <div class="slider_img">
                                <img src="images/slider_img.jpg" />
                            </div>
                            <div class="slider_cont">
                                <span><img src="images/rating.png"></span>
                                <h3>The D Hotel<br><span>Las Vegas</span></h3>
                                <p>$ 129<span>/ night</span></p>
                                <a ><img src="images/slider_btn.png"></a>
                                <spam>30 minutes ago</spam>
                            </div>
                         </li>
                         <li>
                         	<h3>Hotels Just Booked.</h3>
                            <div class="slider_img">
                                <img src="images/slider_img.jpg" />
                            </div>
                            <div class="slider_cont">
                                <span><img src="images/rating.png"></span>
                                <h3>The D Hotel<br><span>Las Vegas</span></h3>
                                <p>$ 129<span>/ night</span></p>
                                <a ><img src="images/slider_btn.png"></a>
                                <spam>30 minutes ago</spam>
                            </div>
                         </li>       -->
        </ul>
      </div>
    </div>
  </div>
</div>
