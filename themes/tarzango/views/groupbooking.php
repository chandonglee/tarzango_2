
<style type="text/css">
@media(min-width: 1600px) {
.center {
	margin-left: 120px !important;
	z-index: 999;
	margin-top: 20px;
}
}
::-webkit-input-placeholder { /* WebKit, Blink, Edge */
 color: #373b71 !important;
}
input {
	padding: 15px 18px !important;
}
footer {
	width: 100%;
	float: left;
}
.fa {
	margin-left: 6px !important;
	font-size: 19px !important;
	cursor: pointer;
}
.img-responsive {
	height: 255px;
}
.box {
/*height: 363px;*/
}
input[type="radio"], input[type="checkbox"] {
	margin-left: 15px !important;
}
/*
.group_booking_body .section5 h1{
  font-size: 14px;
}*/
</style>
<link rel="stylesheet" href="<?php echo $theme_url; ?>css/ini.css" />

<div class="group_booking">
  <?php include 'new_header.php';?>
  <div class="container-main main_header" style="padding-top:110px">
    <div class="container">
      <div class="row">
        <center class="center" style="margin-left: 88px; z-index: 999;
    margin-top: 20px;">
        </center>
        <div class="col-sm-12 page-title">
          <h2 class="">Official Housing for Group Bookings</h2>
          <a  href="<?php echo base_url(); ?>" ><img style="position:relative;z-index:999;" src="images/arrow-blue.png"></a> </div>
      </div>
    </div>
  </div>
</div>
<div class="group_booking_body">
  <div class="section-new">
    <div class="container">
      <div class="row">
        <div class="col-sm-9">
          <h1>Make Tarzango Your Official Housing</h1>
          <p>Our team will negotiate the best rates to help you save <br/>
            money without compromising a 4 star experience</p>
          <p style="padding-top: 15px;font-weight: bold;">Simply follow these 3 steps:</p>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
  <div class="section1">
    <div class="container">
      <div class="row">
        <div class="col-sm-1 col-xs-4"> <img src="images/blue_circle.png"></div>
        <div class="col-sm-9 col-xs-8">
          <p>Search for any hotel.</p>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-1 col-xs-4"> <img src="images/blue_circle2.png"></div>
        <div class="col-sm-9 col-xs-8">
          <p>Select the desire hotels you wish for us to contract.</p>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-1 col-xs-4"> <img src="images/blue_circle3.png"></div>
        <div class="col-sm-9 col-xs-8">
          <p>Lastly, give us some details. Then sit back and wait <br/>
            for your approved hotels with discounted rates.</p>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
  <div class="section2" style="display:none;">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h1>How simple is it? Well, We do all the work! </h1>
        </div>
      </div>
    </div>
  </div>
  <div class="section3" style="display:none;">
    <div class="container">
      <div class="row">
        <div class="col-sm-1"> </div>
        <div class="col-sm-10">
          <h1>Get Started Now, it's as easy as</h1>
          <div class="col-sm-4">
            <div class="box one"> <img src="images/group_booking_icon1.png">
              <h5>Enter Your Event Location</h5>
              <p>1</p>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="box two"> <img src="images/group_booking_icon2.png">
              <h5>Choose Desired Hotels</h5>
              <p>2</p>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="box three"> <img src="images/group_booking_icon3.png">
              <h5>Let Tarzango Save You!</h5>
              <p>3</p>
            </div>
          </div>
        </div>
        <div class="col-sm-1"> </div>
      </div>
    </div>
  </div>
  <?php  

$now = new DateTime();
$checkin1 = date("m/d/Y", strtotime("+1 days"));
$checkout1 = date("m/d/Y", strtotime("+2 days"));

$checkin = isset($_GET['checkIn']) && $_GET['checkIn'] != '' ? $_GET['checkIn'] : $checkin1;

$checkOut = isset($_GET['checkOut']) && $_GET['checkOut'] != '' ? $_GET['checkOut'] : $checkout1;
$room = isset($_GET['room']) && $_GET['room'] != '' ? $_GET['room'] : '0';

$date1 = new DateTime($checkin);
                            $date2 = new DateTime($checkOut);

                            $diff = $date2->diff($date1)->format("%a");
if($room <= 0){
  $room = 1;
}

?>
  <div class="section4">
    <div class="container">
      <div class="col-sm-12">
        <h1>Search the Best Hotel options for your Event</h1>
        <form class="container form_header_one" action="" method="GET" role="search">
          <div class="col-sm-5">
            <div class="form-group">
              <input id="HotelsPlacesEan1" name="city"  type="text" class="form-control RTL " placeholder="<?php echo trans('026');?>" value="Las Vegas, NV, United States" required >
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <input type="text" style="font-size: 16px !important;" placeholder=" <?php echo trans('07');?>" name="checkIn" class="dpean1 form-control" value="<?php echo $checkin; ?>" required >
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <input type="text" style="font-size: 16px !important;" class="form-control dpean2" placeholder=" <?php echo trans('09');?>" name="checkOut" value="<?php echo $checkOut; ?>" required >
            </div>
          </div>
          <!-- <div class="col-sm-2">
            <div class="form-group">
              <select class="form-control" name="room" id="room" style="padding:10px 5px;border-radius: 3px; border: 0px;">
                <option value="">Room</option>
                <option value="1">1</option>
                <option value="2" selected>2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select>
            </div>
          </div> -->
          <div class="col-sm-1">
          <div class="form-group submit-image">
          <button type="button" class="btn-action  form-control btn btn-sm btn-block update_btn" style="height:60px;width:60px">
          </div>
          </div>
          <input type="hidden" name="childages" id="childages" value="">
          <input type="hidden" name="room" id="room" value="1">
          <input type="hidden" name="search" value="search" >
          <input type="hidden" id="lat1" name="lat" value="36.1699412">
          <input type="hidden" id="long1" name="long" value="-115.13982959999998">
          <input type="hidden" id="url" name="url" value="<?php echo base_url(); ?>">
        </form>
      </div>
    </div>
  </div>

  
  <div class="">
  
</div>



  <link href='<?php echo $theme_url; ?>/iimg/flipping_gallery.css' rel='stylesheet' type='text/css'>
  <script type="text/javascript" src="<?php echo $theme_url; ?>/iimg/jquery.flipping_gallery.js"></script>
  <style>
     
      body {
       
        padding: 0;
        text-align: center;
        
        position: relative;
        margin: 0;
        height: 100%;
      }
      .wrapper {
        height: auto !important;
        margin: 0 auto;
              }
      a {
        text-decoration: none;
      }
      h1, h2 {
        width: 100%;
        float: left;
      }
     
      h2 {
        letter-spacing: 0px;
        color: rgba(255,255,255,0.65);
        font-weight: 100;
        margin-top: 10px;
        margin-bottom: 10px;
      }
      .pointer {
        color: #00B0FF;
       
        font-size: 24px;
        margin-top: 15px;
        position: absolute;
        top: 130px;
        right: -40px;
      }
      .pointer2 {
        color: #00B0FF;
       
        font-size: 24px;
        margin-top: 15px;
        position: absolute;
        top: 130px;
        left: -40px;
      }
      pre {
        margin: 80px auto;
      }
      pre code {
        padding: 35px;
        border-radius: 5px;
        font-size: 15px;
        background: rgba(0,0,0,0.1);
        border: rgba(0,0,0,0.05) 5px solid;
        max-width: 500px;
      }
      .main {
        float: left;
        width: 100%;
        margin: 0 auto;
      }
      .main h1 {
  
      }
      .main h1.demo1 {
        background: #1ABC9C;
      }
      .reload.bell {
        font-size: 12px;
        padding: 20px;
        width: 45px;
        text-align: center;
        height: 47px;
        border-radius: 50px;
        -webkit-border-radius: 50px;
        -moz-border-radius: 50px;
      }
      .reload.bell #notification {
        font-size: 25px;
        line-height: 140%;
      }
      .reload, .btn {
        display: inline-block;
        border: 4px solid #A2261E;
        border-radius: 5px;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        background: #CC3126;
        display: inline-block;
        line-height: 100%;
        padding: 0.7em;
        text-decoration: none;
        color: #0D2633;
        /*width: 100px;*/
        line-height: 140%;
        font-size: 17px;
       
        font-weight: bold;
      }
      .reload:hover {
        background: #A2261E;
      }
      .btn {
        /*width: 200px;*/
        color: #0D2633;
        border: none;
        margin-left: 10px;
        background: #00B0FF;
      }
      .clear {
        width: auto;
      }
      .btn:hover, .btn:hover {
        background: #00CDFF;
      }
      .btns {
        width: 410px;
        margin: 50px auto;
      }
      .credit {
       
        font-style: italic;
        text-align: center;
        color: #3D5455;
        color: rgba(255,255,255,0.35);
        padding: 10px;
        margin: 0 0 40px 0;
        float: left;
        width: 100%;
        letter-spacing: 1px;
      }
      .credit a {
        text-decoration: none;
        font-weight: bold;
        color: rgba(255,255,255,0.55);
      }
      .back {
        position: absolute;
        top: 0;
        left: 0;
        text-align: center;
        display: block;
        padding: 7px;
        width: 100%;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        background: rgba(0,0,0,0.25);
        font-weight: bold;
        font-size: 13px;
        color: rgba(255,255,255,0.5);
        -webkit-transition: all 200ms ease-out;
        -moz-transition: all 200ms ease-out;
        -o-transition: all 200ms ease-out;
        transition: all 200ms ease-out;
      }
      .back:hover {
        background: rgba(0,0,0,0.5);
      }
      .page-container {
        max-width: 700px;
        margin: auto;
        position: relative;
      }
      .page-container p {
        font-size: 21px;
        font-weight: 100;
        line-height: 180%;
      }
      .page-container h3 {
   
        font-size: 23px;
      }
      .gallery {
       /* width: 500px;
        height: 333px;
        margin: 150px auto 100px;*/
      }
      /*.navigation {
        margin-bottom: 150px;
      }*/
      .fg-card, .fg-card > img {
        border-radius: 3px;
      }
      .fg-caption {
        color: white;
        font-style: italic;
     
        font-size: 24px;
      }
</style>

 

  <div id="hotel_deta" style="z-index:9999999999">
    <!-- <div class="wrapper">
      <div class="main">
        <div class="header"> </div>
        <div class="page-container">
          <div class="gallery" id="n_data"> </div>
          <div class="navigation"> <a href="#" class="btn prev">Previous</a> <a href="#" class="btn next">Next</a> </div>
        </div>
      </div>
    </div> -->
  </div>

  <style type="text/css">
    .carousel-inner.onebyone-carosel { margin: auto; width: 90%; }
.onebyone-carosel .active.left { left: -33.33%; }
.onebyone-carosel .active.right { left: 33.33%; }
.onebyone-carosel .next { left: 33.33%; }
.onebyone-carosel .prev { left: -33.33%; }
  </style>
<script type="text/javascript">
  $(document).ready(function () {
   /* $('#myCarousel').carousel({
        interval: 10000
    })
    $('.fdi-Carousel .item').each(function () {
        var next = $(this).next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));

        if (next.next().length > 0) {
            next.next().children(':first-child').clone().appendTo($(this));
        }
        else {
            $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
        }
    });*/

    /*$('#myCarousel').carousel({
                interval: 10000
            })
            $('.fdi-Carousel .item').each(function () {
                var next = $(this).next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }
                next.children(':first-child').clone().appendTo($(this));

                if (next.next().length > 0) {
                    next.next().children(':first-child').clone().appendTo($(this));
                }
                else {
                    $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
                }
            });*/
});
</script>
<script type="text/javascript" src="<?php echo $theme_url; ?>/js/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>/js/jcarousel.responsive.js"></script>
<style>
.jcarousel-wrapper {
    margin: 20px auto;
    position: relative;
}

/** Carousel **/

.jcarousel {
    position: relative;
    overflow: hidden;
    width: 100%;
}

.jcarousel ul {
    width: 20000em;
    position: relative;
    list-style: none;
    margin: 0 0 0 26px;
    padding: 0;
}

.jcarousel li {
    width: 370px;
    float: left;
	padding:0px 15px 15px 15px;

}

.jcarousel img {
    display: block;
    max-width: 100%;
    height: auto !important;
}

/** Carousel Controls **/

.jcarousel-control-prev,
.jcarousel-control-next {
    position: absolute;
    top: 50%;
    margin-top: -15px;
    width: 50px;
    height: 50px;
    text-align: center;
    background: #FFF;
    color: #fff;
    text-decoration: none;
    text-shadow: 0 0 1px #000;
    font: 24px/46px Arial, sans-serif;
    -webkit-border-radius: 30px;
    -moz-border-radius: 30px;
    border-radius: 30px;
    -webkit-box-shadow: 0 0 4px #ccc;
    -moz-box-shadow: 0 0 4px #ccc;
    box-shadow: 0 0 4px #ccc;
	z-index:9999;
}

.jcarousel-control-prev {
    left: -55px;
}

.jcarousel-control-next {
    right: -55px;
}

/** Carousel Pagination **/

.jcarousel-pagination {
    position: absolute;
    bottom: -40px;
    left: 50%;
    -webkit-transform: translate(-50%, 0);
    -ms-transform: translate(-50%, 0);
    transform: translate(-50%, 0);
    margin: 0;
}

.jcarousel-pagination a {
    text-decoration: none;
    display: inline-block;

    font-size: 11px;
    height: 10px;
    width: 10px;
    line-height: 10px;

    background: #fff;
    color: #4E443C;
    border-radius: 10px;
    text-indent: -9999px;

    margin-right: 7px;


    -webkit-box-shadow: 0 0 2px #4E443C;
    -moz-box-shadow: 0 0 2px #4E443C;
    box-shadow: 0 0 2px #4E443C;
}

.jcarousel-pagination a.active {
    background: #FFF;
    color: #fff;
    opacity: 1;

    -webkit-box-shadow: 0 0 2px #F0EFE7;
    -moz-box-shadow: 0 0 2px #F0EFE7;
    box-shadow: 0 0 2px #F0EFE7;
}


</style>


<div class="container">

<div class="jcarousel-wrapper">
<h2 class="text-center">Your Selected Hotels</h2>
    <div class="jcarousel">
      <ul>
        
      </ul>
    </div>


    <a href="#" class="jcarousel-control-next"><img src="images/group_booking_icon5.png"></a>
    <a href="#" class="jcarousel-control-prev"><img src="images/group_booking_icon4.png"></a> 
    <p class="jcarousel-pagination"></p>
  </div>
</div>

  <div class="section6 gr-bg">
    <div class="container">
      <div class="row">
        <div class="col-sm-2 hidden-xs"> </div>
        <div class="col-sm-8">
          <h1>Fill out the form below</h1>
          <div  style="text-align:center;color:red; margin-bottom:20px; background:#e8ebf5;background: #e8ebf5; border-radius: 0px; font-size: 14px !important;  font-family: 'Apercu-Regular';" class="form_result"></div>
          <form class="" id="booking_data_final1" method="POST" name="">
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <input type="text" name="g_company_name" value="" class="form-control" id="g_company_name" placeholder="Company Name">
                </div>
              </div>
              <div class="col-sm-6">
                <p>Date in which it will take place</p>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <input type="text" id="" style="font-size: 16px !important;" name="check_in" class="form-control dpean3" placeholder="MM/DD/YYYY">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <input type="text" id="" style="font-size: 16px !important;" name="check_out" class="form-control dpean4" placeholder="MM/DD/YYYY">
                </div>
              </div>
              <div class="col-sm-8">
                <div class="form-group">
                  <input type="number" name="g_attendees" value="" min="1" class="form-control" id="g_attendees" placeholder="Number of anticipated attendees">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <input type="number" name="rooms" value="" min="1" class="form-control" id="g_aprx_rooms" placeholder="Rooms">
                  <!--  <select class="form-control" id="g_aprx_rooms" name="rooms">
                    <option value="1">1 Room</option>
                    <option value="2">2 Rooms</option>
                    <option value="3">3 Rooms</option>
                    <option value="4">4 Rooms</option>
                    </select> --> 
                </div>
              </div>
              <div class="col-sm-8">
                <div class="form-group">
                  <input type="text" name="locality" value="" class="form-control" id="locality" placeholder="Preferred City">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <input type="text" name="administrative_area_level_1" value="" class="form-control" id="g_state" placeholder="State">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input type="text" name="g_place_type" value="" class="form-control" id="g_place_type" placeholder="Do you need a Event or Meeting Space?">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input type="text" name="g_contect_name" value="" class="form-control" id="g_contect_name" placeholder="Contact Name">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input type="number" name="g_contect_no" value="" class="form-control" id="g_contect_no" placeholder="Phone Number">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input type="email" name="g_contect_email" value="" class="form-control" id="g_contect_email" placeholder="Email Address">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group submit-button">
                  <input type="button" name="submit" value="Send Request" class="btn btn-info btn-lg form-control"  id="sbt_frm" >
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
          </form>
        </div>
        <div class="col-sm-2 hidden-xs"> </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
  <div class="modal fade thank-you" id="myModal" role="dialog">
    <div class="modal-dialog"> 
      
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="col-sm-12">
            <div class="col-sm-6 left_section">
              <h1>Thank You,</h1>
              <p>Your request has been assigned to a negotiator!</p>
              <p class="last">We'll get back to you within the next 48 hours</p>
            </div>
            <div class="col-sm-6 right_section">
              <div class="col-sm-12 inner_logo"> <a href=""><img class="img-responsive" src="images/logo.png"></a> </div>
              <h3>Become a Member</h3>
              <h4>We provide a modern way for Group Travelers to book large room blocks.</h4>
              <a class="get-button" href="<?php echo base_url().'membership'; ?>">GET STARTED</a> </div>
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
  <div class="clearfix"></div>
</div>
</div>
<style type="text/css">
  .sel_txt{
    float: right;
    margin-top: 20px; 
    padding-right: 24px;
    font-size: 18px;
    font-family: 'Apercu-Regular';
    color: #2c3748;
  }
  .sel_txt_chk{
        width: 25px;
    position: absolute;
    background: #fff;
    
    margin-left: -58px !important;
  }
</style>
<input type="hidden" id="sel_slider_count" value="0">
<div class="temp_data" style="display: none;">
  
</div>
<script type="text/javascript" src="<?php echo $theme_url; ?>js/easing.js"></script> 
<script>

$('.jcarousel-wrapper').hide();
  function get_hotel(hotel_type,hotel_id,hotel_name){
   /* alert();*/
    //var hotel_id = $(this).data('hotel_id');
        old_Val_id = $("#sel_hotel_id").val();
        old_Val_name = $("#sel_hotel_name").val();
        var count_sel = $('#sel_slider_count').val();

        count_sel = parseInt(count_sel,10);
        //console.log($('.chk_hotel_'+hotel_id).attr("checked")+'-------');
        if($('.chk_hotel_'+hotel_id).is(":checked") && $('.chk_hotel_'+hotel_id).attr("checked") != 'checked'){
           // $("#sel_hotel").html(hotel_id);
            /*$("#sel_hotel_id").val(old_Val_id+','+hotel_id);
            $("#sel_hotel_name").val(old_Val_name+','+hotel_name);*/
            //$(this).attr('checked')
            $('.chk_hotel_'+hotel_id).attr('checked' , 'checked');
            $(".chk_hotel_"+hotel_id).siblings(".sel_txt").html('Selected');
            sel_hotel_data = '<input type="hidden" name="sel_hotel_id[]" class="sel_'+hotel_id+'" value="'+hotel_id+'">';
            sel_hotel_data += '<input type="hidden" name="sel_hotel_type[]" class="sel_'+hotel_id+'" value="'+hotel_type+'">';
            sel_hotel_data += '<input type="hidden" name="sel_hotel_name[]" class="sel_'+hotel_id+'" value="'+hotel_name+'">';
            $("#booking_data_final1").append(sel_hotel_data);

            var sss_hh = $('.sel_hotel_'+hotel_id).html();
            
            sss_hh = '<li class="remove_sli_'+hotel_id+'">'+sss_hh+'</li>';

          
            $(".temp_data").append(sss_hh);
            var final_sli = $(".temp_data").html();
            new_cnt = count_sel + 1;
            $('#sel_slider_count').val(new_cnt);
            

            $(".jcarousel").children('ul').html(final_sli);
            
            

            console.log(new_cnt+'---plss');
        }else{
          new_cnt = count_sel - 1;
          console.log(new_cnt+'---min');
            $('#sel_slider_count').val(new_cnt);
          $('.chk_hotel_'+hotel_id).removeAttr('checked');
          $(".chk_hotel_"+hotel_id).siblings(".sel_txt").html('Select');
          /*new_val_id = old_Val_id.replace(','+hotel_id,'');
          new_val_name = old_Val_name.replace(','+hotel_name,'');
          $("#sel_hotel_id").val(new_val_id);
          $("#sel_hotel_name").val(new_val_name);*/
          $(".sel_"+hotel_id).remove();
          $(".remove_sli_"+hotel_id).remove();
        }
        var count_sel = $('#sel_slider_count').val();

        count_sel = parseInt(count_sel,10);
        if(count_sel <= 0){
              $('.jcarousel-wrapper').hide();
            }else{
              $('.jcarousel-wrapper').show();
            }
        
         /*console.log(hotel_id);
         console.log(hotel_name);*/
  }

      hotel = new Array();
      obj = {};
  function add_room(hotel_id,hotel_name){
      //get_hotel(hotel_id,hotel_name);
      hotel1 = new Array();
      var room_data = $('#sel_hotel_room_'+hotel_id).val();
      
      sel_hotel_data = '<input type="hidden" name="sel_hotel_id[]" class="sel_'+hotel_id+'" value="'+hotel_id+'">';
      sel_hotel_data += '<input type="hidden" name="sel_hotel_name[]" class="sel_'+hotel_id+'" value="'+hotel_name+'">';
      sel_hotel_data += '<input type="hidden" name="sel_hotel_room[]" class="sel_'+hotel_id+'" value="'+room_data+'">';
      $("#booking_data_final1").append(sel_hotel_data);
      hotel.push(hotel1);


  }
  $("#sbt_frm").click(function(){
   
    var frn_data = $("#booking_data_final1").serialize();
    console.log(frn_data);
   
    /*console.log(hotel_data);
    console.log(hotel_data1);*/
    /*var hotel_ids = $("#sel_hotel_id").val();
    var company_name = $("#g_company_name").val();
    var check_in = $("#datepicker1").val();
    var check_out = $("#datepicker2").val();
    var attendees = $("#g_attendees").val();
    var aprx_rooms = $("#g_aprx_rooms").val();
    var city = $("#g_city").val();
    var state = $("#g_state").val();
    var place_type = $("#place_type").val();
    var contect_name = $("#contect_name").val();
    var contect_no = $("#contect_no").val();
    var contect_email = $("#contect_email").val();*/

    var url = $("#url").val();
    $.ajax({
        type: 'POST',
       /* data:{hotel_data:hotel_data,hotel_ids:hotel_ids,company_name:company_name,check_in:check_in,check_out:check_out,attendees:attendees,aprx_rooms:aprx_rooms,city:city,state:state,place_type:place_type,contect_name:contect_name,contect_no:contect_no,contect_email:contect_email},*/
        data:$("#booking_data_final1").serialize(),
        
        url: url+'admin/ajaxcalls/group_booking_add',
        cache: false,
        beforeSend:function(){
          // show image here
           $(".divLoading").show();
           $('#result_data').hide();
        },
        success: function(data)
        {
           $(".divLoading").hide();
          console.log(data);
          response = $.parseJSON(data);

          if(response.error == 'yes'){
              $(".form_result").html(response.msg);
          }else{
              window.location = url;
          }
        }
      });
});
              
  //$(".update_btn").click(function(){
  $(document).ready(function(){
      //$(".form_header_one")

      var lat = $("#lat1").val();
      var long = $("#long1").val();
      var room = $("#room").val();
      var checkIn = $(".dpean1").val();
      var checkOut = $(".dpean2").val();
      var url = $("#url").val();
      var city = $("#HotelsPlacesEan1").val();
      var adults = 1;
      var search = 'search';
      var childages = '';
      var child = '0';
      /*console.log(lat);
      console.log(long);
      console.log(room);
      console.log(checkin);
      console.log(checkout);*/
      $.ajax({
        type: 'GET',
        data:{city:city,checkIn:checkIn,checkOut:checkOut,adults:adults,lat:lat,long:long,room:room,search:search,childages:childages,child:child},
        url: url+'ean/ajax_call',
        cache: false,
        beforeSend:function(){
          // show image here
           $(".divLoading").show();
           $('#result_data').hide();
        },
        success: function(data)
        {
           $(".divLoading").hide();
          //console.log(data);
          response = $.parseJSON(data);
          var clicks = 1;
              
          var HTML_DATA = '<script>function onClick() {clicks += 1;clicks <= '+response.hotel.length+';if (clicks <= '+response.hotel.length+'){document.getElementById("clicks").innerHTML = clicks;}else if (clicks > '+response.hotel.length+') {clicks = 1;document.getElementById("clicks").innerHTML = clicks;}};var clicks = 1;function onClick1() { if (clicks > 1){ clicks -= 1;document.getElementById("clicks").innerHTML = clicks;}else if (clicks = 1) {clicks = '+response.hotel.length+';document.getElementById("clicks").innerHTML = clicks;}};<\/script>';
          //var HTML_DATA = '';
            if(response.location_img != '' && response.location_img != null){
              HTML_DATA += '<style>.group_booking_body .section5{background-image:url('+url+'uploads/images/location_img/'+response.location_img+')}</style>';
            }

            HTML_DATA += '<div class="section5"><div class="container"> <div class="row"><div class="col-sm-12"><h1>These are the top '+response.hotel.length+' results we found near '+city+'</h1> <div class="col-sm-4"><div id="slider" style=""><div class="wrapper"><div class="main"><div class="page-container">                    <div class="gallery" id="n_data">';
          //  var HTML_DATA = '';
          var N_HTML_DATA = '';
          for (var i = 0;  i < response.hotel.length; i++) {
            var base_date = response.hotel[i];
           var hotel_name = base_date.title;
           var dist = base_date.distance;
           var add_dot = '';
           if(hotel_name.length > 20){
              add_dot = '...';
           }
           
           var h_img = base_date.thumbnail.replace('http://demo.tarzango.com/','http://tarzango.com/');
           if(h_img == ''){
              var h_img = 'http://demo.tarzango.com/themes/tarzango/images/room.jpg';
           }
          // N_HTML_DATA += '<a  data-caption="Trekking in Chhomrong, Himalayas, Nepal">';
            HTML_DATA += '<li class="card sel_hotel_'+base_date.id+'">';  
            HTML_DATA += '<div class="box"><img  class="img-responsive" style="width:100%;" src="'+h_img+'">';
            HTML_DATA += '<div class="box-text"> <div class="stars" style="font-size: 18px !important;">'+base_date.stars+'</div>';
            HTML_DATA += '<h1>'+hotel_name.substring(0,20)+add_dot+'</h1>';
            //HTML_DATA += '<p> '+base_date.room_Data[0].maxQuantity+' avalible room <br>';
            HTML_DATA += '<p> '+base_date.distance.substring(0,3)+' miles from '+city +'</p>';
            if(base_date.desc == ''){
              HTML_DATA += '<div class="row"><h2 class="col-md-6">$ '+base_date.price+'<span> / night</span></h2> <span class="col-md-6"><div class="checkbox-bg"><input class="verified sel_txt_chk chk_hotel_'+base_date.id+'" type="checkbox" id="sel_hotel_'+base_date.id+'" onClick="get_hotel('+1+','+base_date.id+',\''+base_date.title+'\')"><div  class="sel_txt"> Select</div></div></span><div class="clearfix"></div></div>'; 
            }else{
              HTML_DATA += '<div class="row"><h2 class="col-md-6">$ '+base_date.price+'<span> / night</span></h2> <span class="col-md-6"><div class="checkbox-bg"><input class="verified sel_txt_chk chk_hotel_'+base_date.id+'" type="checkbox" id="sel_hotel_'+base_date.id+'" onClick="get_hotel('+2+','+base_date.id+',\''+base_date.title+'\')"><div  class="sel_txt"> Select</div></div></span><div class="clearfix"></div></div>'; 

            }
             HTML_DATA += '</div></div></li> ';

             N_HTML_DATA += HTML_DATA;
             //N_HTML_DATA += '</a>';
          }
           HTML_DATA += '  </div>          <div class="navigation">             <a href="#" class="btn prev">Previous</a>             <a href="#" class="btn next">Next</a>          </div>        </div>      </div>    </div> </div>';
           HTML_DATA += '<div class="buttons navigation"><p><img  type="button" onClick="onClick1()" id="prev" class="pre btn prev" src="images/group_booking_icon4.png">#<a id="clicks">1</a><img  type="button" onClick="onClick()" id="next" class="next btn next" src="images/group_booking_icon5.png"></p></div></div><div class="clearfix"></div></div><div class="clearfix"></div></div></div> </div><div class="clearfix"></div>';

          $("#hotel_deta").html(HTML_DATA);
          //$("#n_data").html(N_HTML_DATA);
             $('html,body').animate({
              scrollTop: $(".section5").offset().top-100},
              'slow');
             /* autoplay: 2000*/
              $(".gallery").flipping_gallery({
              enableScroll: false,
            });
            
            $(".next").click(function() {
              $(".gallery").flipForward();
              return false;
            });
            $(".prev").click(function() {
              $(".gallery").flipBackward();
              return false;
            });
      var i = 0;
      var cardn =0;
      var nclick=0;
      var pclick=0;
      $('#prev').click(function () {
        var cardno = $(".card").length;

        if(nclick==1){
            i = i+cardno;nclick=0;cardn =cardno-cardn;
        }
        pclick=1;
          
        if(cardno>0){
          // cardno = cardno-cardn;
            if(cardn==cardno){cardn =0;}
          //alert(cardn);
         /*$('.card:eq('+cardn+')')
            .animate({left: -90+"%", marginTop: 2+"em"},500, "easeOutBack",function(){i++;$(this).css("z-index", i)})
            .animate({left: 0+"%", marginTop: 0+"em"},500, "easeOutBack");
             cardn = cardn+1;*/
        }
      });

      $('#next').click(function () {
        var cardno = $(".card").length;
        console.log(cardno);
        if(pclick==1){i = i-cardno;pclick=0; cardn =cardno-cardn;}
         nclick=1;
           
        if(cardno>0){
          cardn = cardn+1;
           var  cardno1 = cardno-cardn;
          if(cardn==cardno){cardn =0;}
         // alert(cardno1);
         /*$('.card:eq('+cardno1+')')
          .animate({left: -90+"%", marginTop: 2+"em"},500, "easeOutBack",function(){i--;$(this).css("z-index", i)})
          .animate({left: 0+"%", marginTop: 0+"em"},500, "easeOutBack");*/
           
        }
      });


          //console.log(response.length);
        }
          
             
      });
  });


    /*$(function() {
       google.maps.event.addDomListener(window,"load",function(){new google.maps.places.Autocomplete(document.getElementById("HotelsPlacesEan"))});
    });*/
    $(function() { 
         
          var placeSearch, autocomplete;
          var componentForm = {
            route: 'long_name', // street_address
            locality: 'long_name', // city
            administrative_area_level_1: 'short_name', // state
            country: 'long_name',
            postal_code: 'short_name',
          };
          google.maps.event.addDomListener(window,"load",function(){
              autocomplete = new google.maps.places.Autocomplete(document.getElementById("HotelsPlacesEan1"));
              google.maps.event.addListener(autocomplete, 'place_changed', function() {
                fillInAddress();
              });
          }); 
          function fillInAddress() {

          var place = autocomplete.getPlace();

          for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            
            
           
            document.getElementById("lat1").value = place.geometry.location.lat();
            document.getElementById("long1").value = place.geometry.location.lng();

            
          }
            sel_hotel_data ="";
            sel_hotel_data += '<input type="hidden" name="location_lat" value="'+$("#lat1").val()+'">';
            sel_hotel_data += '<input type="hidden" name="location_long" value="'+$("#long1").val()+'">';
            $("#booking_data_final1").append(sel_hotel_data);
        }
      });
  </script> 
<script src="<?php echo $theme_url; ?>j/jquery.geocomplete.js"></script> 
<script>
      $(function(){
        $("#locality").geocomplete({
          details: "#booking_data_final1",
          types: ["geocode", "establishment"],
        });

      });
    </script> 