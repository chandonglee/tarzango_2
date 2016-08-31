</div>
</div>

<script src="<?php echo $theme_url; ?>plugins/lazy/jquery.unveil.js"></script>
<script>
    $(function() {
        $("img").unveil(300);
    });
    </script>
<style type="text/css">
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
   background: url(<?php echo $theme_url;?>img/header-bg.png) no-repeat;
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
  	text-transform: uppercase;
  	letter-spacing: 1px;
  	text-align: center;
  	padding: 10px 29px;
  	height: auto;
  	width: inherit;
  	background: TRANSPARENT;
  	box-shadow: none !important;
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
</style>

<header class="header-section">
  <div class="container-main">
    <div class="container">
    <div class="row" style="margin-bottom:30px">
        <div class="col-sm-12">
          <div class="col-sm-11 logo">
            <a href=""><img class="" src="images/logo2.png"></a>
            <p>Tarzango - Know Where you want to go. We'll do the rest.</p>
          </div>
          <div class="col-sm-1 menu">
            <a href =""><img class="" src="images/menu.png"></a>
          </div>
        </div>
      </div>
    <?php if($appModule == "ean"){ ?>
    <!-- EAN search form -->
    <form  class="container" action="<?php echo $baseUrl;?>search" method="GET" role="search">
      <div class="col-sm-2">
        <div class="form-group">
          <div class="clearfix"></div>
<!--
          <label class="control-label go-right size13"><i class="icon-calendar-7"></i>Hotels</label>
-->
          <input id="HotelsPlacesEan" name="city"  type="text" class="form-control RTL search-location" placeholder="<?php echo trans('026');?>" value="<?php if(!empty($_GET['city'])){ echo $_GET['city']; }else{ echo $selectedCity; } ?>" required >
        </div>
      </div>
      <div class="col-xs-6 col-md-2 col-lg-2 col-sm-6 check-new">
        <div class="form-group">
          <div class="clearfix"></div>
         <!--
          <label class="control-label go-right size13"><i class="icon-calendar-7"></i> 
          <?php //echo trans('07');?>
          <!--
          </label>
          -->

          <input type="text" placeholder=" <?php echo trans('07');?>" name="checkIn" class="dpean1 form-control" value="<?php echo $checkin; ?>" required >
        </div>
      </div>
      <div class="col-xs-6 col-md-2 col-lg-2 col-sm-6 check-new">
        <div class="form-group">
          <div class="clearfix"></div>
<!--
          <label class="control-label go-right size13"><i class="icon-calendar-7"></i> 
          <?php //echo trans('09');?>
          <!--
          </label>
-->
          <input type="text" class="form-control dpean2" placeholder=" <?php echo trans('09');?>" name="checkOut" value="<?php echo $checkout; ?>" required >
        </div>
      </div>
      <div class="col-md-1 col-sm-6 col-xs-6" style="margin-right: 10px;">
        <div class="form-group">
          <div class="clearfix"></div>
<!--
          <label class="control-label go-right">Room</label>
-->
          <select class="form-control" name="room" id="room" style="width:135px;padding:10px 5px;border-radius: 3px; border: 0px;">
            <option value="">Room</option>
            <option value="1">1</option>
            <option value="2">2</option>
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
      </div>
      <div class="col-md-1 col-sm-6 col-xs-6">
        <div class="form-group">
          <div class="clearfix"></div>
<!--
          <label class="control-label go-right size13"><i class="icon-user-7"></i> 
          <?php //echo trans('010');?> <!-- 
          </label>
-->
          <select class="RTL form-control" style="border-radius: 3px; border: 0px; width: 70px;margin-left: 42px;;" placeholder=" <?php echo trans('');?> "  name="adults" id="guest">
            <?php for($i = 1; $i <= 9; $i++){ if(empty($adults)){ $adults = 2; } ?>
            <option value="<?php echo $i; ?>" <?php if($i == $adults){ echo "selected"; } ?> ><?php echo $i; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="col-md-1 col-sm-6 col-xs-6" style="margin-right: 35px; margin-left: -10px;">
        <div class="form-group">
          <div class="clearfix"></div>
<!--
          <label class="control-label go-right size13"><i class="icon-user-7"></i> 
          <?php //echo trans('011');?>
 <!--
          </label>
-->
          <select  class="form-control" style="border-radius: 3px; border: 0px;   margin-left: 40px;width: 140px;" 
          placeholder=" Adults<?php //echo trans('011');?> " name="child" id="child">
            <option value="">Adults</option>
            <?php for($j = 1; $j <= 3; $j++ ){ ?>
            <option value="<?php echo $j; ?>" <?php if($j == $child){ echo "selected"; } ?> > <?php echo $j; ?> </option>
            <?php } ?>
          </select>
        </div>
      </div>

<!--
      <div class="col-md-2 col-sm-6 col-xs-6 rating-new">
        <div class="form-group">
          <div class="clearfix"></div>
          <div class="rating">Rating</div>
            <span class="starRating">
              <input id="rating5" type="radio" name="rating" value="5" <?php //if($rating == 5){ echo "checked"; } ?> >
<!--              <label for="rating5">5</label>
              <input id="rating4" type="radio" name="rating" value="4" <?php //if($rating == 4){ echo "checked"; } ?> >
 <!--             <label for="rating4">4</label>  
              <input id="rating3" type="radio" name="rating" value="3" <?php //if($rating == 3){ echo "checked"; } ?> >
  <!--            <label for="rating3">3</label>
              <input id="rating2" type="radio" name="rating" value="2" <?php //if($rating == 2){ echo "checked"; } ?> >
  <!--            <label for="rating2">2</label>
              <input id="rating1" type="radio" name="rating" value="1" <?php //if($rating == 1){ echo "checked"; } ?> >
  <!--            <label for="rating1">1</label>
            </span> 
        </div>
      </div>
-->
      <div class="col-md-2 col-sm-6 col-xs-6 refine">
        <div class="form-group">
          <div class="clearfix"></div>
          <button type="submit" class="btn-action btn btn-sm btn-block update_btn" style="margin-left: 80px;"><!--<i class="icon_set_1_icon-78"></i>--> UPDATE</button>
        </div>
      </div>
      <div class="clearfix"></div>
      <input type="hidden" name="childages" id="childages" value="">
      <input type="hidden" name="search" value="search" >
      <input type="hidden" id="lat" name="lat" value="<?php echo $lat; ?>">
      <input type="hidden" id="long" name="long" value="<?php echo $long; ?>">
    </form>
    <div class="container" style="margin-bottom: 30px;">
      <div class="row">
        <div class="second-block ">

        

          <div class="col-lg-11 col-md-11 col-sm-11" style="padding:0px;width:86%">
            <form class="form-inline search-second" role="form">
              <label class="lable-name"> Sort Results by </label> 

              
              <div class="form-group">
               <!--
                <label>RECOMMENDED</label>
                -->
                
                <select class="selectpicker" data-style="active-btn">
                  <option>RECOMMENDED</option>
                  <!--
                  <option>Popularity</option>
                  <option>Popularity</option>
                  <option>Popularity</option>
                  -->
                </select>
              </div>
        
              <div class="form-group">
                <select class="selectpicker" data-style="active-btn">
                  <option>Popularity</option>
                  <option>Popularity</option>
                  <option>Popularity</option>
                  <option>Popularity</option>
                </select>
              </div>
              <!--
              <div class="form-group">
                <select class="selectpicker" data-style="select-btn">
                  <option>Stars</option>
                  <option>Stars </option>
                  <option>Stars </option>
                  <option>Stars </option>
                </select>
              </div>
             
              <div class="form-group">
                <select class="selectpicker" data-style="select-btn">
                  <option>Guest Rating</option>
                  <option>Guest Rating</option>
                  <option>Guest Rating</option>
                  <option>Guest Rating</option>
                </select>
              </div>
               -->
              <div class="form-group">
                <select class="selectpicker" data-style="select-btn" style="padding-right: 35%;">
                  <option>Price</option>
                  <option>$ 1111 </option>
                  <option>$ 1111 </option>
                  <option>$ 1111 </option>
                  <option>$ 1111 </option>
                  <option>$ 1111 </option>
                  <option>$ 1111 </option>
                </select>
              </div>
              <div class="form-group">
                <select class="selectpicker" data-style="select-btn">
                  <option>Distance</option>
                  <option> 20 km </option>
                  <option> 20 km </option>
                  <option> 20 km </option>
                  <option> 20 km </option>
                  <option> 20 km </option>
                  <option> 20 km </option>
                </select>
              </div>

              <div class="form-group"> <a class="map-view" href="#"> Map View </a>
                
              </div>

            </form>
          </div>
          <?php $protocol = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
                $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'];
                $complete_url_final =   $base_url . $_SERVER["REQUEST_URI"];
          ?>
          <div class="col-lg-2 col-md-2 col-sm-2" style="padding:0px;width:14%;">
            <div class="btn-grid-block">
              <?php $complete_url2 = str_replace("/search", "/search2", $complete_url_final); ?>
              <a class="" id="grid-listing" href="<?php echo $complete_url2; ?>" > <img src="images/icon/grid-list-icon.png"> </a>
              <?php $complete_url1 = str_replace("/search", "/search1", $complete_url_final); ?>
              <a class="" id="box-listing" href="<?php echo $complete_url1; ?>"  > <img  src="images/icon/box-list-icon.png" > </a> </div>
          </div>
        </div>
      </div>
    </div>
    <?php include 'integrations/ean/ages.php'; ?>
    <script>
 
    $("#box-listing").click(function(){
      $('#main-listing').show();
   });
   $("#grid-listing").click(function(){
      $('#main-listing').hide();
   });
    /*$(function() {
       google.maps.event.addDomListener(window,"load",function(){new google.maps.places.Autocomplete(document.getElementById("HotelsPlacesEan"))});
    });*/
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
            /*if (componentForm[addressType]) {
              var val = place.address_components[i][componentForm[addressType]];
            // document.getElementById(addressType).value = "";
              document.getElementById(addressType).value = val;

            }*//*
          console.log(place.geometry.location);
          console.log(place.geometry.location.G);*/
          console.log(place.geometry.location.lat());
          console.log(place.geometry.location.lng());
          /*if(place.geometry.location.G == 'undefined'){
            document.getElementById("lat").value = place.geometry.location.G;
            document.getElementById("long").value = place.geometry.location.K;
          }else if(place.geometry.location.H == 'undefined'){
            document.getElementById("lat").value = place.geometry.location.H;
            document.getElementById("long").value = place.geometry.location.L;
            }else {
              document.getElementById("lat").value = place.geometry.location.lat();
              document.getElementById("long").value = place.geometry.location.lng();
            }*/

          document.getElementById("lat").value = place.geometry.location.lat();
          document.getElementById("long").value = place.geometry.location.lng();
          }
        }
      });
  </script> 
    <script type="text/javascript">
  var loading = false;//to prevent duplicate
  function loadNewContent() {

      // get the current cache location and key..
      var moreResultsAvailable = $("#moreResultsAvailable").val();
      var cacheKey = $("#cacheKey").val();
      var cacheLocation = $("#cacheLocation").val();
      var cachePaging = $("#cachePaging").val();
      var checkin = $(".dpean1").val();
      var checkout = $(".dpean2").val();
      var agesappend = $("#agesappendurl").val();
      var adultsCount = $("#adultsCount").val();


      $('#loader_new').html("<div id='rotatingDiv'></div>");
      var url_to_new_content = "<?php echo base_url(); ?>ean/loadMore";

      $.ajax({
          type: 'POST',
          data: {'moreResultsAvailable': moreResultsAvailable, 'cacheKey': cacheKey, 'cacheLocation': cacheLocation, 'checkin': checkin, 'checkout': checkout,'agesappendurl': agesappend,'adultsCount': adultsCount },
          url: url_to_new_content,
          success: function (data) {

              // document.getElementById('loadNewdata').value = 1;

              if (data != "" && data != "404") {
                
                  $('#loader_new').html('');
                  loading = false;


                 // $("#latest_record_para").html(data);

                         var newData = data.split("###");

                    $("#latest_record_para").html(newData[0]);

                    $("#New_data_load").append(newData[1]);
 

              }
              else
              {
                  $('#loader_new').html('');
                  $("#message_noResult").html('');

              }
              //console.log(data);

          }
      });
  }

  //scroll to PAGE's bottom
  var winTop = $(window).scrollTop();
  var docHeight = $(document).height();
  var winHeight = $(window).height();




  $(window).scroll(function () {

      var moreResultsAvailable = $("#moreResultsAvailable").val();
      /*var foot = $("#footer").offset().top - 500;*/
      // console.log($(window).scrollTop()+" == "+foot);

      if (moreResultsAvailable != '' && moreResultsAvailable == 1) {

          if ($(window).scrollTop() > foot) {

              if (!loading) {
                  loading = false;
                  /*loadNewContent();*/
              }
          }
      }
  });

</script> 
    
    <!-- End EAN Search Form -->
    
    <?php }else{ ?>
    <?php } ?>
  </div>
  <!-- CONTENT -->
  <link rel="stylesheet" href="<?php echo $theme_url; ?>css/flexslider.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="<?php echo $theme_url; ?>css/style_listing.css" type="text/css" media="screen" />
  
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
    <section id="list-view-default">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="total-total-block">
              <h2> Showing <span><?php echo count($module); ?></span> Hotels in Las Vegas, NV</h2>
            </div>
          </div>
        </div>
      </div>
      <div  class="default-block"> 
        <!--  <div class="container-fluid listing-detail-bg">
    <div class="container">
      <div class="row">
        <div class="listing-number">
          <h2><span><?php echo count($module); ?></span> Hotels are available</h2>
        </div> -->
        <?php
         /*echo json_encode($module);*/
         
           if(!empty($module)){ 
            $h_data_pass = $module;
            $i = 0;
            foreach($module as $item){ 

         /*error_reporting(E_ALL);*/
         /*echo json_encode($item->all_img);*/
         $image_url = "";
         $image_base_url = base_url().'uploads/images/hotels/slider/';
         $image_base_url = str_replace("demo.", "", $image_base_url);
         $img_main_url = 'http://photos.hotelbeds.com/giata/';
         $img_list = $item->all_img;
       
           /* $image_url = $item->thumbnail;
                if (!file_exists($image_url)) {
                    $image_url = $image_url;
                } else {
                    $image_url = str_replace("bigger/", '', $image_url);
                }*/
            
              if ($i & 1) { ?>
        <div class="fullwidth-container">
          <div class="row table-row">
            <div class="col-sm-6 col-xs-12 col-md-6 table-cell valign-middle bg-cover">
              <div class="slider-default">
                <div id="carousel2" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                    <?php 
                    for ($h_img=0; $h_img < 1; $h_img++) { 
                       if (array_key_exists('himg_image', $img_list[$h_img])) {
                          $image_url = $image_base_url.$img_list[$h_img]->himg_image;
                    ?>
                        <div class="item active">
                          <div class="slider-bg"> </div>
                          <img  src="<?php echo $image_url; ?>"> 
                        </div>
                    <?php }else{ ?>
                        <div class="item active">
                          <div class="slider-bg"> </div>
                          <img src="<?php echo $img_main_url.$img_list[$h_img]->path; ?>"> 
                        </div>
                    <?php } } ?>
                  </div>
                </div>
                
                <!-- /clearfix --> 
                
              </div>
            </div>
            <div class="col-sm-6 col-xs-12 col-md-6 table-cell valign-middle bg-cover-1">
              <div class="about-text-main">
                <div class="list-box">
                  <div class="hotel-image">
                    <div class="hotel-name-address-block">
                      <h1> <?php echo $item->title;?> </h1>
                      <div class="hotel-prize-block">
                        <h1> <?php echo $item->currCode; ?><?php echo $item->price;?> </h1>
                        <div class="tag-day-block"> <span class="from"> from </span> <span class="line-block"> / </span> <span class="night"> night </span> </div>
                      </div>
                    </div>
                  </div>
                  <div  class="hotel-detail-main">
                    <div class="facilitate">
                      <ul>
                        <li> <img src="images/icon/facilitate-1.png"> </li>
                        <li> <img src="images/icon/facilitate-2.png"> </li>
                        <li> <img src="images/icon/facilitate-3.png"> </li>
                        <li> <img src="images/icon/facilitate-4.png"> </li>
                        <li> <img src="images/icon/facilitate-5.png"> </li>
                      </ul>
                    </div>
                    <div class="hotel-description"> <span> <?php echo character_limiter($item->desc,300);?> </span> </div>
                    <div class="btn-reserve"> <a  href="<?php echo $item->slug;?>"> reserve </a> </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <?php }else{ ?>



        <div class="fullwidth-container">
          <div class="row table-row">
            <div class="col-sm-6 col-xs-12 col-md-6 table-cell valign-middle bg-cover-1">
              <div class="about-text-main">
                <div class="list-box">
                  <div class="hotel-image">
                    <div class="hotel-name-address-block">
                      <h1> <?php echo $item->title;?> </h1>
                      <div class="hotel-prize-block">
                        <h1> <?php echo $item->currCode; ?><?php echo $item->price;?> </h1>
                        <div class="tag-day-block"> <span class="from"> from </span> <span class="line-block"> / </span> <span class="night"> night </span> </div>
                      </div>
                    </div>
                  </div>
                  <div  class="hotel-detail-main">
                    <div class="facilitate">
                      <ul>
                        <li> <img src="images/icon/facilitate-1.png"> </li>
                        <li> <img src="images/icon/facilitate-2.png"> </li>
                        <li> <img src="images/icon/facilitate-3.png"> </li>
                        <li> <img src="images/icon/facilitate-4.png"> </li>
                        <li> <img src="images/icon/facilitate-5.png"> </li>
                      </ul>
                    </div>
                    <div class="hotel-description"> <span><?php echo character_limiter($item->desc,300);?> </span> </div>
                    <div class="btn-reserve"> <a  href="<?php echo $item->slug;?>"> reserve </a> </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6  col-xs-12 col-md-6 table-cell left-img valign-middle bg-cover">
              <div class="slider-default">
                <div id="carousel" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                    <?php 
                     for ($h_img=0; $h_img < 1; $h_img++) { 
                       if (array_key_exists('himg_image', $img_list[$h_img])) {
                          $image_url = $image_base_url.$img_list[$h_img]->himg_image;
                    ?>
                        <div class="item active">
                          <div class="slider-bg"> </div>
                          <img src="<?php echo $image_url; ?>"> 
                        </div>

                    <?php }else{ ?>

                        <div class="item active">
                          <div class="slider-bg"> </div>
                          <img src="<?php echo $img_main_url.$img_list[$h_img]->path; ?>"> 
                        </div>

                    <?php } } ?>
                  </div>
                </div>
                <!-- /clearfix --> 
              </div>
            </div>
          </div>
        </div>
        <?php } $i++; ?>
        <?php
               $cnt = 0; foreach($item->amenities as $amt){ $cnt++; if($cnt <= 10){ if(!empty($amt->name)){ ?>
        <img title="<?php echo $amt->name;?>" data-toggle="tooltip" data-placement="top" style="height:25px;" src="<?php echo $amt->icon;?>" alt="<?php echo $amt->name;?>" />
        <?php } } } ?>
        <?php } } ?>
        <div class="container">
          <div class="row">
            
          </div>
        </div>
      </div>
    </section>
  </div>
  <script>
  
  $('#collapseMap').on('shown.bs.collapse', function(e){
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
       map_image_url: "<?php echo $item->thumbnail;?>",
       name_point: "<?php echo $item->title;?>",
       description_point: "<?php echo character_limiter(strip_tags(trim($item->desc)),75);?>",
       url_point: "<?php echo $item->slug;?>"
     },
      <?php endforeach; ?>

     ],

   };
     var mapOptions = {
        <?php if(empty($_GET)){ ?>
       zoom: 10,
        <?php }else{ ?>
         zoom: 12,
        <?php } ?>
       center: new google.maps.LatLng(<?php echo $item->latitude;?>, <?php echo $item->longitude;?>),
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
       styles: [/*map styles*/]
     };
     var
     marker;
     mapObject = new google.maps.Map(document.getElementById('map'), mapOptions);
     for (var key in markersData)
       markersData[key].forEach(function (item) {
         marker = new google.maps.Marker({
           position: new google.maps.LatLng(item.location_latitude, item.location_longitude),
           map: mapObject,
           icon: '<?php echo base_url(); ?>assets/img/' + key + '.png',
         });

         if ('undefined' === typeof markers[key])
           markers[key] = [];
         markers[key].push(marker);
         google.maps.event.addListener(marker, 'click', (function () {
       closeInfoBox();
       getInfoBox(item).open(mapObject, this);
       mapObject.setCenter(new google.maps.LatLng(item.location_latitude, item.location_longitude));
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
       '<div class="marker_info" id="marker_info">' +
       '<img style="width:280px;height:140px" src="' + item.map_image_url + '" alt=""/>' +
       '<h3>'+ item.name_point +'</h3>' +
       '<span>'+ item.description_point +'</span>' +
       '<a href="'+ item.url_point + '" class="btn btn-primary"><?php echo trans('0177');?></a>' +
       '</div>',
       disableAutoPan: true,
       maxWidth: 0,
       pixelOffset: new google.maps.Size(40, -190),
       closeBoxMargin: '0px -20px 2px 2px',
       closeBoxURL: "<?php echo $theme_url; ?>assets/img/close.png",
       isHidden: false,
       pane: 'floatPane',
       enableEventPropagation: true
     }); };  });
</script> 
  <script src="<?php echo $theme_url; ?>assets/js/infobox.js"></script> 
</div>
</div>
</div>