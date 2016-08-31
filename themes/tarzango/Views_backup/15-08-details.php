</div>
</div>
<?php include 'header_search.php'; ?>



<link href="<?php echo $theme_url; ?>assets/include/slider/slider.min.css" rel="stylesheet" />
<link href="<?php echo $theme_url; ?>assets/include/slider/owl.carousel.css" rel="stylesheet" />
<link href="<?php echo $theme_url; ?>assets/include/slider/owl.theme.css" rel="stylesheet" />
<link href="<?php echo $theme_url; ?>assets/include/slider/bootstrap-theme.css" rel="stylesheet" />
<link href="<?php echo $theme_url; ?>assets/include/slider/bootstrap-select.css" rel="stylesheet" />
<link href="<?php echo $theme_url; ?>assets/include/slider/bootstrap-datetimepicker.min.css" rel="stylesheet" />

<script src="<?php echo $theme_url; ?>assets/js/single.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/jquery.nicescroll.min.js"></script>
<script src="<?php echo $theme_url; ?>assets/include/slider/slider.js"></script>
<script src="<?php echo $theme_url; ?>assets/include/slider/owl.carousel.min.js"></script>
<script src="<?php echo $theme_url; ?>assets/js/infobox.js"></script>
<link rel="stylesheet" href="<?php echo $theme_url; ?>css/flexslider.css" type="text/css" media="screen" />
<style type="text/css">
  .header-right{
    display: none;
  }
  
    #detail-block{
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
</style>
<script src="<?php echo $theme_url; ?>plugins/lazy/jquery.unveil.js"></script>
<script>
    $(function() {
        $(".lazy_load").unveil(300);
    });
   
</script>
<?php
$overall_rating = $tripadvisor->rating;
$ranking_out_of = $tripadvisor->num_reviews;
?>
<body class="detail-view" >
<section class="hotel-detail-header"> 
 
    <div class="hotel-detail-header-info">
    <div class="hd-info">
      <div class="container">

        <h2><?php echo $module->title; ?> </h2>
       
        <div class="rating-detail"> 
           <div class="st_rating" style="float:left;"> <?php echo $module->stars;?> </div>

         <span style=" color: #f1f1f8; font-weight: normal; font-family: 'Apercu-Light'; font-size: 14px;padding-left: 5px;padding-top: 2px; float: left;"> Great Overall Rating (<?php echo $overall_rating; ?> Based on <?php echo $ranking_out_of; ?> Ratings) </span> </div>
        <div class="listing-back"> <a href="#"> <i class="fa fa-angle-left" aria-hidden="true"></i> Back to Listings  </a> </div>
      </div>
    </div>
  </div>
  <?php
         /*error_reporting(E_ALL);*/
         $image_url = "";
         $image_base_url = base_url().'uploads/images/hotels/slider/';
         $img_list = $module->sliderImages;
         /*echo json_encode($img_list);*/
         
              
          
           /* $image_url = $item->thumbnail;
                if (!file_exists($image_url)) {
                    $image_url = $image_url;
                } else {
                    $image_url = str_replace("bigger/", '', $image_url);
                }*/
            ?>
            <?php 
                for ($h_img=0; $h_img < 1; $h_img++) { 
                    
                      $image_url = $img_list[$h_img]['fullImage'];
                ?>
  <img style="width: 100%;" src="<?php echo str_replace("demo.", "", $image_url); ?>"> 
   <?php  } ?>
</section>

<section id="detail-block" style="background:url(<?php echo $theme_url; ?>images/details-final.png)">

  <div class="container"> 

    <div class="col-lg-8 col-md-8 col-sm-8 "> 

      <div id="detail-slider" class="owl-carousel">
        <?php 
                for ($h_img=0; $h_img < count($img_list); $h_img++) { 
                   
                      $image_url = $img_list[$h_img]['fullImage'];
                ?>
             <div class="item"><img src="<?php echo str_replace("demo.", "", $image_url); ?>" alt="The Last of us" style="width:100%;height:535px;"></div>
            
            <?php  } ?>
       

      </div>


        <div class="detail-pagr-facilitate">

          <div class="row">  

             <div class="col-lg-2 col-sm-2 col-md-2" > <span> <img src="images/icon/detail-icon-1.png"> </span>  <h2> Air Conditioner </h2> </div>
             <div class="col-lg-2 col-sm-2 col-md-2" > <span> <img src="images/icon/detail-icon-2.png"> </span>  <h2> Free Wi-Fi</h2> </div>
             <div class="col-lg-2 col-sm-2 col-md-2" > <span> <img src="images/icon/detail-icon-3.png"> </span>  <h2> Cable TV </h2> </div>
             <div class="col-lg-2 col-sm-2 col-md-2" > <span> <img src="images/icon/detail-icon-4.png"> </span>  <h2> Shower </h2></div>
             <div class="col-lg-2 col-sm-2 col-md-2" > <span> <img src="images/icon/detail-icon-5.png"> </span>  <h2> King Bed </h2> </div>
             <div class="col-lg-2 col-sm-2 col-md-2" > <span> <img src="images/icon/detail-icon-6.png"> </span>  <h2> Bathtub </h2> </div>

          </div>
        </div>
        <div class="detail-decription"> 

           <p><?php echo $module->desc; ?></p>
         
        </div>  
         
          <?php 

if($hasRooms > 0){ 
          if($appModule == "hotels"){ 
              include 'includes/rooms.php'; 
          }else if($is_hotel_bed == "1"){ 
             include 'includes/hb_rooms.php'; 
          }else if($appModule == "ean"){ 
              include 'includes/expedia_rooms.php'; 
          } 
      }  ?>
           <div class="map-block">
            <h2> Directions </h2>
             <div id="map" class="map "  style="height:300px;"></div>
         
          </div>
         <?php include 'includes/reviews.php';?>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 ">

<div class="check-out-form"> 

<div class="amount-detail-page">  <span class="price-detail set_avg_rate"> $ 100 </span>  <span class="slas-detail">/ </span> <span class="night-detail"> <?php echo $diff; ?> nights </span> </div>

<div class=""> 
<label> check in </label>
<div class="control-group">
               
                <div class=" input-append date dpean1 form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input size="16" class="date-block" type="text" value="" >
                    <span class="add-on"><i class="icon-remove"></i></span>
          <span class="add-on"><i class="icon-th"></i></span>
                </div>
        <input type="hidden" id="dtp_input2" class="date-block" value="" /><br/>
            </div>

</div>

<div class=""> 
<label> Check Out </label>

            
      <div class="control-group">
               
                <div class=" input-append date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input size="16" class="date-block" type="text" value="" >
                    <span class="add-on"><i class="icon-remove"></i></span>
          <span class="add-on"><i class="icon-th"></i></span>
                </div>
        <input type="hidden" id="dtp_input2" class="date-block" value="" /><br/>
            </div>
      
       
</div>

<div class="row"> 
<div class="col-lg-6 col-md-6 col-sm-6 ">
<div class="form-group"> 
<label> Rooms  </label>
<div class="input-next-previce"> 
<i class="fa fa-chevron-left"> </i> <input type="text">  <i class="fa fa-chevron-right"> </i>
</div>

</div>
 </div>
<div class="col-lg-6 col-md-6 col-sm-6 "><div class="form-group"> 
<label> Guests  </label>
<div class="input-next-previce"> 
<i class="fa fa-chevron-left"> </i> <input type="text">  <i class="fa fa-chevron-right"> </i>
</div> 

</div> </div>
</div>


<a  href="#ROOMS" class="detail-btn"> Reserve </a>


 </div>

</div>
  </div>

</section>

<!-- <div class="detail-banner-section">
    
      <div class="flexslider">
          <ul class="slides">
          <?php 
                for ($h_img=0; $h_img < count($img_list); $h_img++) { 
                   
                      $image_url = $img_list[$h_img]['fullImage'];
                ?>
            <li style="background-image: url(<?php echo $image_url; ?>"></li>
            <?php  } ?>
            
                      </ul>
        </div>    
</div> -->





    </div>
  </div>
</div>
<!-- map -->
<div class="collapse" id="collapseMap">
  
  <br>

  <script>
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
  
  
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    forceParse: 0,
        showMeridian: 1
    });
  $('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
    });
  $('.form_time').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 1,
    minView: 0,
    maxView: 1,
    forceParse: 0
    });
  
  $('.datepicker').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-3d'
});
    </script>
  <script>$(document).ready(function(e) {
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
                name_point: '<?php echo character_limiter($module->title, 80);?>',
                description_point: '<?php echo character_limiter(strip_tags(trim($item->desc)),100);?>',
                url_point: '<?php echo $module->slug;?>'
            }, <?php foreach($module->relatedItems as $item):?> {
                name: 'hotel name',
                location_latitude: "<?php echo $item->latitude;?>",
                location_longitude: "<?php echo $item->longitude;?>",
                map_image_url: "<?php echo $item->thumbnail;?>",
                name_point: "<?php echo $item->title;?>",
                description_point: '<?php echo character_limiter(strip_tags(trim($item->desc)),100);?>',
                url_point: "<?php echo $item->slug;?>"
            }, <?php endforeach;?>]
        };
        
    var mapOptions = {
        zoom: 14,
        center: new google.maps.LatLng(<?php echo $module->latitude;?>, <?php echo $module->longitude;?>),
        styles: [
      {
        stylers: [
          { hue: "#FFF"}
          
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
            content: '<div class="marker_info" id="marker_info">' + '<h3>' + item.name_point + '</h3>' + '<span>' + item.description_point + '</span>' + '' + '</div>',
            disableAutoPan: !0,
            maxWidth: 0,
            pixelOffset: new google.maps.Size(40, -190),
            closeBoxMargin: '0px -20px 2px 2px',
            closeBoxURL: "<?php echo $theme_url; ?>assets/img/close.png",
            isHidden: !1,
            pane: 'floatPane',
            enableEventPropagation: !0
        })
    }
});
  </script>
  <script type="text/javascript">
    $(".social-share").click(function(){
      $("#share_link").toggle();
    });

  </script>
</div>
<!-- map -->


<!-- head -->
<div class="bg_black">

<!-- head -->

  <?php //include 'includes/review.php'; ?>
  <?php if($appModule != "cars" && $appModule != "ean"){ } //include 'includes/review.php'; } ?>
</div>

<!-- overview -->
<section class="bg-white" style="display:none;">
  <div class="">
    <div id="DESCRIPTION" class="row">
      <div class="panel-body">
        <h2 class="main-title go-right"><?php echo trans('046');?></h2>
        <div class="clearfix"></div>
        <i class="tiltle-line go-right"></i>
        <span class="go-right RTL"><?php echo $module->desc; ?></span>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12">
            <hr>
          </div>
        </div>
        <?php if(!empty($module->policy)) { ?>
        <h4 id="terms" class="main-title  go-right"><?php echo trans('0148');?></h4>
        <div class="clearfix"></div>
        <i class="tiltle-line  go-right"></i>
        <div class="clearfix"></div>
        <span class="RTL">
          <p><?php echo $module->policy; ?></p>
        </span>
        <?php } ?>
        <br>
        <?php if(!empty($module->paymentOptions)){ ?>
        <h4 id="terms" class="main-title  go-right"><?php echo trans('0265');?></h4>
        <div class="clearfix"></div>
        <i class="tiltle-line  go-right"></i>
        <div class="clearfix"></div>
        <span class="RTL">
        <?php foreach($module->paymentOptions as $pay){ if(!empty($pay->name)){ ?>
        <?php echo $pay->name;?> -
        <?php } } ?>
        </span>
        <br><br><br>
        <?php } ?>
        <?php if($appModule == "hotels"){ ?>
        <h4 class="main-title  go-right"><?php echo trans('07');?></h4>
        <div class="clearfix"></div>
        <i class="tiltle-line  go-right"></i>
        <div class="clearfix"></div>
        <p class="RTL"><i class="fa fa-clock-o text-success"></i> <strong> <?php echo trans('07');?> </strong> :   <?php echo $module->defcheckin;?> - <i class="fa fa-clock-o text-warning"></i>   <strong> <?php echo trans('09');?> </strong> :  <?php echo $module->defcheckout;?> </p>
        <?php } ?>
        <!-- Start Tours Inclusions / Exclusions -->
        <?php if($appModule == "tours"){ ?>
        <p class="go-text-left"><i class="fa fa-sun-o text-success"></i> <strong> <?php echo trans('0275');?> </strong> :   <?php echo $module->tourDays;?> | <i class="fa fa-moon-o text-warning"></i>   <strong> <?php echo trans('0276');?> </strong> :  <?php echo $module->tourNights;?> </p>
        <div class="row">
          <div class="clearfix"></div>
          <hr>
          <div id="INCLUSIONS" class="col-md-12">
            <h4 class="main-title go-right"><?php echo trans('0280');?></h4>
            <div class="clearfix"></div>
            <i class="tiltle-line go-right"></i>
            <div class="clearfix"></div>
            <br>
            <?php foreach($module->inclusions as $inclusion){ if(!empty($inclusion->name)){  ?>
            <ul class="list_ok col-md-4 RTL" style="margin: 0 0 5px 0;">
              <li class="go-right"><?php echo $inclusion->name; ?></li>
            </ul>
            <?php } } ?>
            <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
          <hr>
          <div id="EXCLUSIONS"class="col-md-12">
            <h4 class="main-title go-right"><?php echo trans('0281');?></h4>
            <div class="clearfix"></div>
            <i class="tiltle-line go-right"></i>
            <div class="clearfix"></div>
            <br>
            <?php foreach($module->exclusions as $exclusion){ if(!empty($exclusion->name)){  ?>
            <ul class="col-md-4" style="margin: 0 0 5px 0;list-style:none;">
              <li class="go-right"><i style="font-size: 13px; color: #E25A70; margin-left: -16px;" class="icon-cancel-5 go-right"></i> &nbsp;&nbsp;&nbsp; <?php echo $exclusion->name; ?> &nbsp;&nbsp;&nbsp;</li>
            </ul>
            <?php } } ?>
            <div class="clearfix"></div>
          </div>
        </div>
        <?php } ?>
        <!-- End Tours Inclusions / Exclusions -->
      </div>
    </div>
  </div>
</section>
<!-- overview -->

<!-- ----------------------  Related Listings   ---------------------------- -->
<?php $module->relatedItems = array(); if(!empty($module->relatedItems)){ ?>
<div id="RELATED" class="lastminute4">
  <div class="container">
    <div class="form-group">
      <h2 class="main-title"><?php if($appModule == "hotels" || $appModule == "ean"){ echo trans('0290'); }else if($appModule == "tours"){ echo trans('0453'); }else if($appModule == "cars"){ echo trans('0493'); } ?></h2>
      <div class="clearfix"></div>
      <i class="tiltle-line"></i>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 go-left">
        <div class="wrapper">
          <div class="list_carousel">
            <ul id="foo2">
              <?php foreach($module->relatedItems as $item){ ?>
              <li>
                <a href="<?php echo $item->slug;?>"><img style="max-height: 180px;width:100%" class="offers-hover img-responsive" src="<?php echo $item->thumbnail;?>" alt="<?php echo character_limiter($item->title,15);?>"/></a>
                <div class="m1">
                  <h6 class="lh1 dark go-right">
                    <b>
                      <?php echo character_limiter($item->title,15);?>
                      <span class="pull-right">
                        <?php  if($item->price > 0){ ?>
                        <?php echo $item->currCode;?> <?php echo $item->currSymbol; ?><?php echo $item->price;?>
                        <?php } ?>&nbsp;&nbsp;
                        <h6 class="lh1 green go-right">
                          <?php if($item->avgReviews->overall > 0){ ?>
                          <div id="score"><span><i class="icon_set_1_icon-18"></i> <?php echo $item->avgReviews->overall;?></span></div>
                          <?php } ?>
                        </h6>
                      </span>
                      <br><br>
                      <?php echo $item->location;?> <?php echo $item->stars;?>&nbsp;&nbsp;
                    </b>
                  </h6>
                </div>
              </li>
              <?php }  ?>
            </ul>
            <div class="clearfix"></div>
            <a id="prev_btn2" class="prev offers" href="#"><img src="<?php echo $theme_url; ?>images/spacer.png" alt=""/></a>
            <a id="next_btn2" class="next offers" href="#"><img src="<?php echo $theme_url; ?>images/spacer.png" alt=""/></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>
</div>
</div>
<!------------------------  Related Listings   ------------------------------>

<script type="text/javascript" src="<?php echo $theme_url; ?>assets/include/slider/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>assets/include/slider/bootstrap-datetimepicker.min.js" charset="UTF-8"></script>
<script>
  //------------------------------
  // Write Reviews
  //------------------------------

    $(function(){
    $('.reviewscore').change(function(){
    var sum = 0;
    var avg = 0;
    var id = $(this).attr("id");
    $('.reviewscore_'+id+' :selected').each(function() {
    sum += Number($(this).val());
    });
    avg = sum/5;
    $("#avgall_"+id).html(avg);
    $("#overall_"+id).val(avg);
    });

    //submit review
    $(".addreview").on("click",function(){
    var id = $(this).prop("id");
    $.post("<?php echo base_url();?>admin/ajaxcalls/postreview", $("#reviews-form-"+id).serialize(), function(resp){
    var response = $.parseJSON(resp);
    // alert(response.msg);
    $("#review_result"+id).html("<div class='alert "+response.divclass+"'>"+response.msg+"</div>").fadeIn("slow");
    if(response.divclass == "alert-success"){
    setTimeout(function(){
    $("#ADDREVIEW").removeClass('in');
    $("#ADDREVIEW").slideUp();
    }, 5000);
    }
    });
    setTimeout(function(){
    $("#review_result"+id).fadeOut("slow");
    }, 3000);
    });
    })


  //------------------------------
  // Add to Wishlist
  //------------------------------

    $(function(){
    // Add/remove wishlist
    $(".wish").on('click',function(){
    var loggedin = $("#loggedin").val();
    var removelisttxt = $("#removetxt").val();
    var addlisttxt = $("#addtxt").val();
    var title = $("#itemid").val();
    var module = $("#module").val();
    if(loggedin > 0){ if($(this).hasClass('addwishlist')){
     var confirm1 = confirm("<?php echo trans('0437');?>");
     if(confirm1){
    $(".wish").removeClass('addwishlist btn-primary');
    $(".wish").addClass('removewishlist btn-warning');
    $(".wishtext").html(removelisttxt);
    $.post("<?php echo base_url();?>account/wishlist/add", { loggedin: loggedin, itemid: title,module: module }, function(theResponse){ });
     }
     return false;
    }else if($(this).hasClass('removewishlist')){
    var confirm2 = confirm("<?php echo trans('0436');?>");
    if(confirm2){
    $(".wish").addClass('addwishlist btn-primary'); $(".wish").removeClass('removewishlist btn-warning');
    $(".wishtext").html(addlisttxt);
    $.post("<?php echo base_url();?>account/wishlist/remove", { loggedin: loggedin, itemid: title,module: module }, function(theResponse){
    });
    }
    return false;
    } }else{ alert("<?php echo trans('0482');?>"); } });
    // End Add/remove wishlist
    })

  //------------------------------
  // Rooms
  //------------------------------

    $('.collapse').on('show.bs.collapse', function () {
    $('.collapse.in').collapse('hide');  });
    <?php if($appModule == "hotels"){ ?>
    jQuery(document).ready(function($) {
    $('.showcalendar').on('change',function(){
    var roomid = $(this).prop('id');
    var monthdata = $(this).val();
    $("#roomcalendar"+roomid).html("<br><br><div id='rotatingDiv'></div>");
    $.post("<?php echo base_url();?>hotels/roomcalendar", { roomid: roomid, monthyear: monthdata}, function(theResponse){ console.log(theResponse);
    $("#roomcalendar"+roomid).html(theResponse);  }); }); });
    <?php } ?>

</script>