</div>
</div>
<script src="<?php echo $theme_url; ?>plugins/lazy/jquery.unveil.js"></script>
<script>
    $(function() {
        $("img").unveil(300);
    });
    </script>
<style type="text/css">

header.header-section .menu img{
  margin-top: -15px !important;
}
  .menu-header {
  	position: absolute;
  	margin-left: -70px;
  	margin-top: -77px;
  }
  .hotel-list::-webkit-scrollbar-thumb {
   background-color: darkgrey !important;
   outline: 1px solid slategrey;
  }
  footer {
  	float: left;
  	width: 100%;
  }
  .fa-star {
  	font-size: 16px !important;
  	padding-right: 7px;
  }
  #top .slider {
  	min-height: 130px;
  }
  #top .slider .cover {
  	min-height: 130px;
  }
  .fa-star {
  	font-size: 23px;
  }
  .bg_list_image {
  	background-repeat: no-repeat;
  	background-size: cover;
  	width: 100%;
  }
  /*.offset-1{
  		background-color:rgba(54,8,54,0.4785714285714286) !important
  	  }*/
  .white_font {
  	color: white;
  }
  .header-right {
  	display: none;
  }
  .listing-search {
   background: url(<?php echo $theme_url;
   ?>img/header-bg.png) no-repeat;
  	background-size: 100%;
  	padding-bottom: 20px;
  }
  .form-group input {
  	color: #FFF;
  	background-color: transparent;
  	border: none;
  	box-shadow: none;
  	transition: none;
  	border-radius: 0px;
  	border-bottom: 1px solid rgba(255,255,225,0.8);
  }
  .form-group select {
  	border: solid 2px #555187;
  	border-radius: 3px;
  	color: #555187;
  	font-family: 'Apercu-Regular';
  	font-size: 15px;
  	/*text-transform: uppercase;*/
  	letter-spacing: 1px;
  	text-align: center;
  	padding: 10px 29px;
  	height: auto;
  	width: inherit;
  	background: TRANSPARENT;
  	box-shadow: none !important;
  	text-align-last: center;
  }
  .form-group label {
  	color: rgba(255,255,255,0.5);
  	font-family: 'Roboto', sans-serif;
  	font-weight: 300;
  	font-size: 17px;
  }
  .form-group button[type="submit"] {
  	color: #000;
  	font-size: 17px;
  	text-transform: capitalize;
  	padding: 18px;
  	display: inline-block;
  	background: #ffc100;
  	font-weight: 500;
  	border-radius: 5px;
  	/*
      margin: 10px 0 0 0;
      */
  	-webkit-border-radius: 5px;
  	text-decoration: none;
  	transition: all 0.3s ease;
  	-webkit-transition: all 0.3s ease;
  	border: 0;
  }
  .refine {
  	padding: 0px;
  }
  .starRating:not(old) {
  	display : inline-block;
  	width : 9.5em;
  	height : 1.6em;
  	overflow : hidden;
  	vertical-align : bottom;
  }
  .rating {
  	width: 100%;
  	margin-bottom: 15px;
  	color: rgba(255,255,255,0.5);
  }
  .starRating:not(old) > input {
  	margin-right : -100%;
  	opacity : 0;
  }
  .starRating:not(old) > label {
  	display : block;
  	float : right;
  	position : relative;
  	background : url('<?php echo $theme_url ?>images/star-off.png');
  	background-size : contain;
  }
  .starRating:not(old) > label:before {
  	content : '';
  	display : block;
  	width : 1.5em;
  	height : 1.5em;
  	background : url('<?php echo $theme_url ?>images/star-on.png');
  	background-size : contain;
  	opacity : 0;
  	transition : opacity 0.2s linear;
  }
  .starRating:not(old) > label:hover:before, .starRating:not(old) > label:hover ~ label:before, .starRating:not(:hover) > :checked ~ label:before {
  	opacity : 1;
  }
  .map-view {
  	border: 0px !important;
  }
  .map-view .form-group:active {
  	background-color: yellow;
  }
  header.header-section .sorting .col-sm-1.view-option a img {
  	margin: 0px !important;
  }
  
  .header-navigation-section .menu p.close-button {
  	display: none;
  	background-color: #fff;
  	padding: 20px 7px;
  	line-height: 0px;
  	font-size: 50px;
  	color: #a0e5fd;
  	font-family: proximanova_light;
  	border-radius: 100%;
  	position: absolute;
  	top: -54px !important;
  	right: 0px;
  	cursor: pointer;
  }
  .open {
  	margin-top: -44px !important;
  	margin-left: 60px !important;
  }
  .menu-dropdown {
  	position: absolute;
  	display: none;
  	background-image: url('<?php echo $theme_url?>images/menu-bg.png');
  	background-repeat: no-repeat;
  	background-size: 100% 100%;
  	padding: 60px;
  	width: 340px;
  	height: auto;
  	right: -12px !important;
  	top: 15px !important;
  	z-index: 1111;
  }
  

  }
  .dropbtn {
    width: 175px;
    font-family: 'gotham_light_test';
    text-align: left;
    margin-top: -12px;
      background-color: #433074;
      color: white;
      padding: 15px;
      font-size: 14px;
      border: none;
      cursor: pointer;
  }


  .dropdown {
      position: relative;
      display: inline-block;
  }

  .dropdown-content {
    width: 175px;
      display: none;
      text-align: left;
      position: absolute;
      background-color: #433074;
      font-family: 'gotham_light_test';
      min-width: 160px;
      overflow: auto;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  }

  .dropdown-content a {
      color: #fff;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
  }

  .container-main.main_header.new input.search-box{
      border: none !important;
      width: 60%;
      box-shadow: none;
    }
    .header-navigation-section .menu img {
      z-index: 999999;
      float: right;
          cursor: pointer;
     
      
    }
    .container-main.main_header.new{
      padding: 10px 0px !important;
    }
   
   
    .menu-dropdown{
     top: 40px;
      right: 55px;
    }
  .menu-header{
    display: none;
   }
  .user{
    margin-top: 20px;
  }
  .close-button{
        margin-top: 37px;
  }
  .header-navigation-section{
    padding-right: 0px;
  }
  .map_class{
    width: 100%;
    margin-left: 12px;
    height: 1007px !important;
    margin-top: -212px !important;
    position: relative;
    overflow: hidden;
  }
</style>
<?php  

$now = new DateTime();
$checkin1 = date("m/d/Y", strtotime("+1 days"));
$checkout1 = date("m/d/Y", strtotime("+2 days"));

$room = isset($_GET['room']) && $_GET['room'] != '' ? $_GET['room'] : 1;
$child = isset($_GET['child']) && $_GET['child'] != '' ? $_GET['child'] : 0;
$adults = isset($_GET['adults']) && $_GET['adults'] != '' ? $_GET['adults'] : 1;
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
<header class="header-section">

<div class="container" style="padding-right: 0px; padding-left: 0px ">
   
      <div class="row" style="padding-right: 0px; padding-left: 0px ">
        <div class="col-sm-12" style="padding-right: 0px; padding-left: 0px ">
          <div class="col-sm-9 logo" style="top:-15px">
            <a href="<?php echo base_url(); ?>"><img class="" src="images/logo2.png"></a>
            <p>Tarzango - Know where you want to go. We'll do the rest.</p>
          </div>
          <?php  if(!empty($customerloggedin)){ ?>
             <style>
             header.header-section .menu img{
                  margin-top: -47px !important;
            }
             </style>
     
      <div class="col-sm-2 user" style="margin-top:-8px">
       <div class="dropdown">
        <button onclick="myFunction()" class="dropbtn">Hello,  <?php echo $firstname; ?>  <img  style="width: 20px; float: right;margin-left: 10px; " src="images/menu-arrow-down.png"></button>
          <div id="myDropdown3" class="dropdown-content">
            <a href="<?php echo base_url()?>account/"> Reservations </a>
           <a href="<?php echo base_url()?>account/logout/"> <?php echo trans('03');?></a>   
          </div>
        </div>
        
       </div>
        <?php }?>
        <script type="text/javascript">
          function myFunction() {
  
  $("#myDropdown3").toggle();
    //document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
        //document.getElementById("map_data").className += "map_class";
       
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
        
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
        </script>
          <?php include 'menu_header.php';?>
        </div>
      </div>
      </div>
  
  </header>
  <div class="search-section">
    <div class="container" style="padding-right: 0px; padding-left: 0px ">
      <div class="row" style="padding-right: 0px; padding-left: 0px ">
        <div class="col-sm-12" style="padding-right: 0px; padding-left: 0px ">
          <form class="" id="search_form" action="<?php echo base_url();?>ean/search" method="GET" role="search"  name="search_form">
            <div class="col-sm-3">
              <div class="form-group">
                <div class="form-group">
                  <input id="HotelsPlacesEan" name="city" style="padding-left:50px !important;" type="text" class="form-control RTL search-location" placeholder="<?php echo trans('026');?>" value="<?php if(!empty($_GET['city'])){ echo $_GET['city']; }else{ echo $selectedCity; } ?>" required >
                </div>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
                <input type="text" placeholder=" <?php echo trans('07');?>" name="checkIn" class="dpean1 form-control" value="<?php echo $checkin; ?>" required >
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
                <input type="text" class="form-control dpean2" placeholder=" <?php echo trans('09');?>" name="checkOut" value="<?php echo $checkOut; ?>" required >
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
                <select class="form-control" name="room" id="room" style="padding:10px 5px;border-radius: 3px; border: 0px;padding-right: 85px !important;">
                  <option value="">Room</option>
                  <option value="1" <?php if($room == 1){ echo "selected"; } ?> >1</option>
                  <option value="2" <?php if($room == 2){ echo "selected"; } ?> >2</option>
                  <option value="3" <?php if($room == 3){ echo "selected"; } ?> >3</option>
                  <option value="4" <?php if($room == 4){ echo "selected"; } ?> >4</option>
                  <option value="5" <?php if($room == 5){ echo "selected"; } ?> >5</option>
                  <option value="6" <?php if($room == 6){ echo "selected"; } ?> >6</option>
                  <option value="7" <?php if($room == 7){ echo "selected"; } ?> >7</option>
                  <option value="8" <?php if($room == 8){ echo "selected"; } ?> >8</option>
                  <option value="9" <?php if($room == 9){ echo "selected"; } ?> >9</option>
                  <option value="10" <?php if($room == 10){ echo "selected"; } ?> >10</option>
                </select>
                <span class="rm_sel">Room</span>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <div class="persons right">
                  <input type="text" name="adults" value="<?php echo $adults; ?>" id="" class="adult" disabled>
                  <p> Adults, </p>
                  <input type="text" name="children" value="<?php echo $child; ?>" id="" class="children" disabled>
                  <p> Children </p>
                  <img class="input-arrow" src="images/field-arrow-down.png"> </div>
              </div>
              <div class="dropdown">
                <div class="adults">
                  <p>Adults</p>
                  <div class="right">
                    <input type="text" name="" value="<?php echo $adults; ?>" id="adult1" class="adult" disabled>
                    <img class="plus1 first" id="" src="images/arrow-up.png"><img class="minus1 last" id="" src="images/arrow-down.png"> </div>
                </div>
                <div class="childrens">
                  <p>Children</p>
                  <div class="right">
                    <input type="text" name="" value="<?php echo $child; ?>" id="children1" class="children" disabled>
                    <img class="plus2 first" id="" src="images/arrow-up.png"><img class="minus2 last" id="" src="images/arrow-down.png"> </div>
                </div>
              </div>
            </div>
            <div class="col-sm-1">
              <div class="form-group submit-button">
                <button type="submit" class="btn-action btn btn-sm btn-block update_btn" style=""><!--<i class="icon_set_1_icon-78"></i>--> UPDATE</button>
              </div>
            </div>
            <input type="hidden" name="childages" id="childages" value="">
            <input type="hidden" name="search" value="search" >
            <input type="hidden" name="adults" value="<?php echo $adults; ?>" class="adults_final" >
            <input type="hidden" name="child" value="<?php echo $child; ?>" class="children_final" >
            <input type="hidden" id="lat" name="lat" value="<?php echo $lat; ?>">
            <input type="hidden" id="long" name="long" value="<?php echo $long; ?>">
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
 
    $("#box-listing").click(function(){
      $('#main-listing').show();
   });
   $("#grid-listing").click(function(){
      $('#main-listing').hide();
   });
    
    $(function() { 
          $("#room").change( function(){
            var room = $(this).val();
            console.log(room);
            $(".remove_age").remove();
            $("#guest").html('<option value="" style="display:none;">Select</option>');
            $("#child").html('<option value="" style="display:none;">Select</option>');
            $("#child").append('<option value="0" >0</option>');
            if(room == 1){
              var j = 1;
              for(var i=1;i<7;i++){
                j = room * i;
                if(j < 7){
                  $("#guest").append('<option value="'+j+'" >'+j+'</option>');
                }
              }
            }else if(room != ""){
              var j = 1;
              for(var i=1;i<13;i++){
                j = room * i;
                
                if(j < 13){
                  $("#guest").append('<option value="'+j+'" >'+j+'</option>');
                }
                
              }
            }
            
              k = room * 2;
              l = k / 2 ;
              
              $("#child").append('<option value="'+l+'" >'+l+'</option>');
              $("#child").append('<option value="'+k+'" >'+k+'</option>');

          });
          var placeSearch, autocomplete;
          var componentForm = {
            route: 'long_name', // street_address
            locality: 'long_name', // city
            administrative_area_level_1: 'short_name', // state
            country: 'long_name',
            postal_code: 'short_name',
          };
          google.maps.event.addDomListener(window,"load",function(){
              autocomplete = new google.maps.places.Autocomplete(document.getElementById("HotelsPlacesEan"));
              google.maps.event.addListener(autocomplete, 'place_changed', function() {
                fillInAddress();
              });
          }); 
          function fillInAddress() {

          var place = autocomplete.getPlace();

          for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
           

          document.getElementById("lat").value = place.geometry.location.lat();
          document.getElementById("long").value = place.geometry.location.lng();
          }
        }
      });
  </script> 
</div>
<!-- CONTENT -->
<link rel="stylesheet" href="<?php echo $theme_url; ?>css/flexslider.css" type="text/css" media="screen" />

<!-- <div class="collapse" id="collapseMap">
  <div id="map" class="map"></div>
  <br>
</div> -->

<div class="clearfix"></div>
<?php if($appModule == "ean"){ ?>
<!-- Start Ean search form left side --> 

<!-- End Ean search form left side -->

<?php }else{ ?>
<?php } ?>
<div class="list-view" id="main-listing">
  <div class="hotel-detail-map" id="list-view-first">
    <div  class="default-block ">
      <div class="attraction-listing-body">
        <div class="list">
          <div class="container" >
            <div class="row col-sm-6" >
              <div class="col-sm-12">
                <?php 
                  $pagename =  str_replace( 'ean/', '', uri_string());
                  $protocol = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
                  $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'];
                  $complete_url_final =   $base_url . $_SERVER["REQUEST_URI"];
                  
                  $gb_main_ary = array('gbsearch','gbsearch1','gbsearch2');
                  if(in_array($pagename, $gb_main_ary)){
                    
                    $ary_url =  array('/gbsearch?' , '/gbsearch1?' , '/gbsearch2?');
                    $complete_url1 = str_replace($ary_url, "/gbsearch1?", $complete_url_final);
                    $complete_url2 = str_replace($ary_url, "/gbsearch?", $complete_url_final);
                    $complete_url3 = str_replace($ary_url, "/gbsearch2?", $complete_url_final); 
                  }else{
                    
                    $ary_url =  array('/search?' , '/search1?' , '/search2?' , '/search3?');
                    $complete_url1 = str_replace($ary_url, "/search1?", $complete_url_final);
                    $complete_url2 = str_replace($ary_url, "/search?", $complete_url_final);
                    $complete_url3 = str_replace($ary_url, "/search3?", $complete_url_final); 
                  }
                 
               ?>
                <div class="col-sm-6 sorting">
                  <label class="title map_views">Recommended <img src="images/arrow-down.png"><img src="images/arrow-up.png"></label>
                  <div class="dropdown " style="z-index:999999999">
                    <button class="sort" data-sort="stars" style="">Popularity</button>
                    <a id="map-listing" href="<?php echo $complete_url3; ?>">Recommended</a>
                    <button class="sort" data-sort="distance">Distance</button>
                  </div>
                </div>
                <script type="text/javascript">
                  $(".map_views").click(function(){
                    $("#map_data").toggleClass("map_class");
                });
                </script>
                <div class="col-sm-6 view-options">
                  
                  <a class="" id="box-listing" href="<?php echo $complete_url1; ?>">
                      <img src="images/header-list-icon.png">
                  </a>
                  
                  <a class="" id="grid-listing" href="<?php echo $complete_url2; ?>">
                      <img src="images/header-view-icon.png">
                  </a>
                  <a class="" id="map-listing" href="<?php echo $complete_url3; ?>" >
                      
                    <?php if($complete_url3 == $complete_url_final){ ?>
                      <img src="images/header-map-icon-active.png">
                    <?php }else{ ?>
                      <img src="images/header-map-icon.png">
                    <?php } ?>
                  
                    </a>
                <!--   <p>Showing <span><?php echo count($module); ?></span> Hotels in
                    <?php if(!empty($_GET['city'])){ echo $_GET['city']; }else{ echo $selectedCity; } ?>
                  </p> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="hotel-detail-map-body">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="col-sm-6 left_part">
                <p class="title">Showing <span><?php echo count($module); ?></span> Hotels in
                  <?php if(!empty($_GET['city'])){ echo $_GET['city']; }else{ echo $selectedCity; } ?>
                </p>
                <div class="col-sm-12 hotel-list">
                  <div class="t_list">
                    <?php
          
               if(!empty($module)){ 
                $h_data_pass = $module;
                $i = 0;
               /* $module1 = array();*/
                foreach($module as $item){ 
                 $image_base_url = base_url().'uploads/images/hotels/slider/';
                 $image_base_url = str_replace("demo.", "", $image_base_url);
                 $img_main_url = 'http://photos.hotelbeds.com/giata/';
                 $img_list = $item->all_img;


              ?>
                    <div class="col-sm-6 box odd">
                      <h4><?php echo $item->title;?></h4>
                      <h1 style="display:none" class="distance"><?php echo $item->distance;?></h1>
                      <h1  style="display:none" class="stars"><?php echo $item->stars;?></h1>
                      <h3><?php echo $item->currCode; ?> <?php echo $item->price;?></h3>
                      <div class="col-sm-12 image-box" style="padding-bottom:20px"> <?php echo $item->stars;?> </div>
                      <?php 
                     for ($h_img=0; $h_img < 1; $h_img++) { 
                       if (array_key_exists('himg_image', $img_list[$h_img])) {
                          $image_url = $image_base_url.$img_list[$h_img]->himg_image;
                    ?>
                      <img class="img-responsive" src="<?php echo $image_url; ?>">
                      <?php }else{ 

                              if ( !empty($final_hb_img) && $final_hb_img[$item->id]['sThumbnail'] != "" ) { ?>
                                  <img style="width: 100%;" src="<?php echo base_url();?>uploads/images/hbhotels/slider/<?php echo $final_hb_img[$item->id]['sThumbnail'];?>">
                        <?php } else { ?>
                                <img class="img-responsive" src="<?php echo $img_main_url.$img_list[$h_img]->path; ?>">
                      <?php } } } ?>
                      <a  href="<?php echo $item->slug;?>">
                      <button>RESERVE</button>
                      </a> </div>
                    <?php } } ?>
                  </div>
                </div>
                <div class="col-sm-12 pagination">
                  <div id="demo_pag1"></div>
                </div>
              </div>
              <div class="col-sm-6 right_part"  >
                <div id="map_data" style="width:100%;margin-left: 12px;height: 908px; margin-top: -107px;" > </div>
                <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3220.887903925542!2d-115.14509868519855!3d36.16928231065911!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c8c39f95ded1e3%3A0x112f59c33e7585fc!2sThe+D+Las+Vegas!5e0!3m2!1sen!2sin!4v1471507146561" width="100%" height="auto" frameborder="0" style="border:0" allowfullscreen></iframe> --> 
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="last-section">
        <div class="col-sm-12 text-center">
          <div class="container-main">
            <div class="container">
              <h4 class="col-sm-9 text-right">Going somewhere? Need a Hotel, let us help you!</h4>
              <a class="col-sm-3 text-center" href="#">TARZANGO</a> </div>
          </div>
        </div>
      </div>
    </div>
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_url; ?>css/jquery.bs_pagination.min.css">
    </link>
    <link rel="script" type="text/javascript" href="<?php echo $theme_url; ?>js/jquery.bs_pagination.min.js">
    </link>
    <script>
/*$(function() {
 
  $("#demo_pag1").bs_pagination({
    totalPages: 100
  });
 
});*/
</script>
<style>


  .infoBox{
    background-color: white;
    width: 290px;
    border-radius: 5px;
  }
.infoBox:after, .infoBox:before {
  top: 100%;
  left: 51.5%;
  border: solid transparent;
  content: " ";
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none;
}

.infoBox:after {
  border-color: rgba(255, 255, 255, 0);
  border-top-color: #ffffff;
  border-width: 10px;
  margin-left: -10px;
}
.infoBox:before {
  border-color: rgba(0, 0, 0, 0);
  border-top-color: #;
  border-width: 16px;
  margin-left: -16px;
}

 


  #marker_info h4{
    float: left;
    margin-left: 10px;
    color: #1a124e;
    font-weight: bold;
  }
  #marker_info h3{
    float: right;
    margin-right: 10px;
    margin-top: 10px;
    color: #ff73b3;
  }
  #marker_info span{
    float: left;
    margin-bottom: 25px;
    margin-left: 10px;

  }
  #marker_info{
    width: 290px;
    height: 250px;
    padding: 10px;
    border-radius: 2px;
  }
  .labels {
  color: white;
  font-family: "Lucida Grande", "Arial", sans-serif;
  font-size: 10px;
  text-align: center;
  width: 30px;
  white-space: nowrap;
}
</style>
    <script src="<?php echo $theme_url; ?>js/list.min.js"></script> 
    <script src="<?php echo $theme_url; ?>js/markerwithlabel.js"></script>
    <script>
  
/*  var options = {
    valueNames: [ 'name','distance','stars' ]
  };

var userList = new List('list-view-first', options);*/

  (function(A) {

    if (!Array.prototype.forEach)
     A.forEach = A.forEach || function(action, that) {
       for (var i = 0, l = this.length; i < l; i++)
         if (i in this)
           action.call(that, this[i], i, this);
       };

     })(Array.prototype);

     var
     mapObject,
     markers = [],
     markersData = {

       'map-red': [
        <?php foreach($module as $item): ?>
       {
         name: 'hotel name',
         location_latitude: "<?php echo $item->latitude;?>",
         location_longitude: "<?php echo $item->longitude;?>",
         <?php if ( !empty($final_hb_img) && $final_hb_img[$item->id]['sThumbnail'] != "" ) { ?>
         map_image_url: "<?php echo base_url().'uploads/images/hbhotels/slider/'.$final_hb_img[$item->id]['sThumbnail']; ?>",
         <?php }else{ ?>
         map_image_url: "<?php echo $item->thumbnail;?>",
          <?php } ?>
         name_point: "<?php echo character_limiter($item->title,13);?>",
         stars: '<?php echo $item->stars;?>',
         price: "<?php echo $item->price;?>",
         description_point: "",
         url_point: "<?php echo $item->slug;?>"
       },
        <?php endforeach; ?>

       ],

     };
     var mapOptions = {
        zoom: 12,
        center: new google.maps.LatLng(<?php echo $item->latitude;?>, <?php echo $item->longitude;?>),
        styles: [
           
        ],
        mapTypeId: google.maps.MapTypeId.ROADMAP,

         mapTypeControl: false,
         mapTypeControlOptions: {
           style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
           position: google.maps.ControlPosition.LEFT_CENTER
         },
         panControl: false,
         panControlOptions: {
           position: google.maps.ControlPosition.TOP_RIGHT
         },
         zoomControl: true,
         zoomControlOptions: {
           style: google.maps.ZoomControlStyle.LARGE,
           position: google.maps.ControlPosition.TOP_RIGHT
         },
         scrollwheel: false,
         scaleControl: false,
         scaleControlOptions: {
           position: google.maps.ControlPosition.TOP_LEFT
         },
         streetViewControl: true,
         streetViewControlOptions: {
           position: google.maps.ControlPosition.LEFT_TOP
         },
        
       };
     var marker;
     mapObject = new google.maps.Map(document.getElementById('map_data'), mapOptions);
     for (var key in markersData)
       markersData[key].forEach(function (item) {
           /*console.log(item.price);*/
           var disp_p = '$'+Math.round(item.price);
         marker = new MarkerWithLabel({
           position: new google.maps.LatLng(item.location_latitude, item.location_longitude),
           map: mapObject,
            draggable: false,
            raiseOnDrag: true,
            labelContent: disp_p.substring(0,5),
            labelAnchor: new google.maps.Point(15, 55),
            labelClass: "labels", // the CSS class for the label
            labelInBackground: false,
            icon: '<?php echo base_url(); ?>assets/img/map_pin_room.png',
         });

         if ('undefined' === typeof markers[key])
           markers[key] = [];
         markers[key].push(marker);
         google.maps.event.addListener(marker, 'click', (function () {
       closeInfoBox();
       getInfoBox(item).open(mapObject, this);
       mapObject.setCenter(new google.maps.LatLng(item.location_latitude, item.location_longitude));
       //marker.setAnimation(plugin.google.maps.Animation.BOUNCE);
      }));



  });

   function hideAllMarkers () {
     for (var key in markers)
       markers[key].forEach(function (marker) {
         marker.setMap(null);
       });
   };

   function closeInfoBox() {
     $('div.infoBox').remove();
   };
 
    function getInfoBox(item) {
       return new InfoBox({
         content:
         '<a style="text-decoration:none" href="'+ item.url_point +'"><div class="marker_info col-sm-6 box odd" id="marker_info">' +
         '<h4>'+ item.name_point +'</h4>' +
         '<h3> $ '+ item.price +'</h3>' +
         '<span> '+ item.stars +'</span>' +
         '<div class="col-sm-12 image-box">' +
         '<img style="width:270px;height:150px" class="img-responsive" src="' + item.map_image_url.replace('http://demo.tarzango.com/','http://tarzango.com/') + '" alt=""/>' +
         '</div></a>',
         disableAutoPan: true,
         maxWidth: 0,
         pixelOffset: new google.maps.Size(-150, -325),
         closeBoxMargin: '0px -20px 2px 2px',
         closeBoxURL: "<?php echo $theme_url; ?>assets/img/close.png",
         isHidden: false,
         pane: 'floatPane',
         enableEventPropagation: true
       }); 
    };  
 
</script> 
    <script src="<?php echo $theme_url; ?>assets/js/infobox.js"></script> 
  </div>
</div>
</div>
