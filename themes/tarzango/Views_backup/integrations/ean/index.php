
<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/jshashtable-2.1_src.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/jquery.numberformatter-1.2.3.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/tmpl.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/jquery.dependClass-0.1.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/draggable-0.1.js"></script>
<script type="text/javascript" src="<?php echo $theme_url; ?>plugins/jslider/js/jquery.slider.js"></script>
<link rel="stylesheet" href="<?php echo $theme_url; ?>plugins/jslider/css/jslider.css" type="text/css">
<link rel="stylesheet" href="<?php echo $theme_url; ?>plugins/jslider/css/jslider.round.css" type="text/css">
<!-- CONTENT -->

<div class="container pagecontainer offset-0">
  <form  class="panel-body" action="<?php echo $baseUrl;?>search" method="GET" role="search">
    <div class="col-md-3 col-lg-4 col-sm-12 go-right">
      <div class="form-group">
        <div class="clearfix"></div>
        <label class="control-label go-right"><i class="icon-location-6"></i><?php echo trans('012');?></label>
        <input id="HotelsPlacesEan" name="city"  type="text" class="form-control RTL search-location" placeholder="<?php echo trans('026');?>" value="<?php if(!empty($_GET['city'])){ echo $_GET['city']; }else{ echo $selectedCity; } ?>" required >
      </div>
    </div>
    <div class="col-md-2 col-sm-6 col-xs-6 go-right">
      <div class="form-group">
        <div class="clearfix"></div>
        <label class="control-label go-right size13"><i class="icon-calendar-7"></i> <?php echo trans('07');?></label>
        <input type="text" placeholder=" <?php echo trans('07');?>" name="checkIn" class="dpean1 form-control" value="<?php echo $checkin; ?>" required >
      </div>
    </div>
    <div class="col-md-2 col-sm-6 col-xs-6 go-right">
      <div class="form-group">
        <div class="clearfix"></div>
        <label class="control-label go-right size13"><i class="icon-calendar-7"></i> <?php echo trans('09');?></label>
        <input type="text" class="form-control dpean2" placeholder=" <?php echo trans('09');?>" name="checkOut" value="<?php echo $checkout; ?>" required >
      </div>
    </div>
    <div class="col-md-2 col-lg-1 col-sm-6 col-xs-6 go-right">
      <div class="form-group">
        <div class="clearfix"></div>
        <label class="control-label go-right size13"><i class="icon-user-7"></i> <?php echo trans('010');?></label>
        <select class="RTL form-control" placeholder=" <?php echo trans('');?>"  name="adults">
          <?php for($i = 1; $i <= 9; $i++){ if(empty($adults)){ $adults = 2; } ?>
          <option value="<?php echo $i; ?>" <?php if($i == $adults){ echo "selected"; } ?> ><?php echo $i; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="hidden-md col-lg-1 col-sm-6 col-xs-6 go-right">
      <div class="form-group">
        <div class="clearfix"></div>
        <label class="control-label go-right size13"><i class="icon-user-7"></i> <?php echo trans('011');?></label>
        <select  class="form-control childcount" placeholder=" <?php echo trans('011');?> " name="child" id="child">
          <option value="">0</option>
          <?php for($j = 1; $j <= 3; $j++ ){ ?>
          <option value="<?php echo $j; ?>" <?php if($j == $child){ echo "selected"; } ?> > <?php echo $j; ?> </option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="visible-sm visible-xs">
      <div class="clearfix"></div>
    </div>
    <div class="col-md-3 col-lg-2 col-xs-12 col-sm-12 go-right">
      <div class="form-group">
        <div class="clearfix"></div>
        <label class="control-label">&nbsp;</label>
        <input name="search" type="hidden" value="1">
        <input type="hidden" name="childages" id="childages" value="<?php echo $childAges; ?>">
        <button type="submit" class="btn btn-block btn-primary"><?php echo trans('012');?></button>
      </div>
    </div>
    <div class="clearfix"></div>
  </form>
  <div class="col-md-12">
    <hr style="margin-top: 0px;">
  </div>
  <?php
    //start result array for map
    $totalcountsMap = $resultMap['HotelListResponse']['HotelList']['@size'];

    if($totalcountsMap > 1){
     $resultarrayMap = $resultMap['HotelListResponse']['HotelList']['HotelSummary'];
    }else{
    $resultarrayMap[] = $resultMap['HotelListResponse']['HotelList']['HotelSummary'];
    }

    //end result array for map ?>
  <div class="collapse" id="collapseMap">
    <div id="map" class="map"></div>
    <br>
  </div>
  <div class="clearfix"></div>
  <form  action="<?php echo $baseUrl;?>search" method="GET">
    <!-- FILTERS -->
    <div class="col-md-3 filters offset-0 go-right">
      <a class="btn btn-block btn-primary" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap"><?php echo trans('067');?></a>
      <!-- TOP TIP -->
      <div class="filtertip">
        <div class="padding20">
          <p class="size13">&nbsp;</p>
          <p class="size24"><i class="icon_set_1_icon-42 go-right"></i><span class="go-right"><?php echo trans('0191');?></span> <span class="countprice"></span></p>
        </div>
        <div class="tip-arrow"></div>
      </div>
      <div class="hidden-xs">
        <div style="margin-top:65px"></div>
      </div>
      <!-- Star ratings -->
      <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse1">
      <?php echo trans('0137');?> <?php echo trans('069');?> <span class="collapsearrow"></span>
      </button>
      <div id="collapse1" class="collapse in">
        <div class="hpadding20">
          <br>
          <?php $star = '<i class="star text-warning fa fa-star voted"></i>'; ?>
          <?php $stars = '<i class="fa fa-star-o"></i>'; ?>
          <div  class="rating" style="font-size: 14px;">
            <div class="go-right"><input id="1" type="radio" name="stars" class="go-right radio" value="1" <?php if(@$_GET['stars'] == "1"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="1"><?php echo $star; ?><?php for($i=1;$i<=6;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
            <div class="clearfix"></div>
            <div class="go-right"><input id="2" type="radio" name="stars" class="radio go-right" value="2" <?php if(@$_GET['stars'] == "2"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="2"><?php for($i=1;$i<=2;$i++){ ?> <?php echo $star; ?> <?php } ?><?php for($i=1;$i<=5;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
            <div class="clearfix"></div>
            <div class="go-right"><input id="3" type="radio" name="stars" class="radio" value="3" <?php if(@$_GET['stars'] == "3"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="3"><?php for($i=1;$i<=3;$i++){ ?> <?php echo $star; ?> <?php } ?><?php for($i=1;$i<=4;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
            <div class="clearfix"></div>
            <div class="go-right"><input id="4" type="radio" name="stars" class="radio" value="4" <?php if(@$_GET['stars'] == "4"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="4"><?php for($i=1;$i<=4;$i++){ ?> <?php echo $star; ?> <?php } ?><?php for($i=1;$i<=3;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
            <div class="clearfix"></div>
            <div class="go-right"><input id="5" type="radio" name="stars" class="radio" value="5" <?php if(@$_GET['stars'] == "5"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="5"><?php for($i=1;$i<=5;$i++){ ?> <?php echo $star; ?> <?php } ?><?php for($i=1;$i<=2;$i++){ ?> <?php echo $stars; ?> <?php } ?></label></div>
            <div class="clearfix"></div>
            <div class="go-right"><input id="7" type="radio" name="stars" class="radio" value="7" <?php if(@$_GET['stars'] == "7"){echo "checked";}?>>&nbsp;&nbsp;<label class="go-left" for="7"><?php for($i=1;$i<=7;$i++){ ?> <?php echo $star; ?> <?php } ?></label></div>
          </div>
        </div>
        <div class="clearfix"></div>
        <br>
      </div>
      <!-- End of Star ratings -->
      <!-- Price range -->
      <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse2">
      <?php echo trans('0301');?> <span class="collapsearrow"></span>
      </button>
      <div id="collapse2" class="collapse in">
        <?php if(!empty($_GET['price'])){
          $selectedprice = $_GET['price'];
          }else{
          $selectedprice =  $minprice.",".$maxprice;
          }?>
        <div class="padding20">
          <div class="layout-slider wh100percent">
            <span class="cstyle09"><input id="Slider1" type="slider" name="price" value="<?php echo $selectedprice; ?>" /></span>
          </div>
          <script type="text/javascript" >
            jQuery("#Slider1").slider({ from: <?php echo @$minprice;?>, to: <?php echo @$maxprice;?>, step: 5, smooth: true, round: 0, dimension: "&nbsp;<?php echo $currSign; ?>", skin: "round" });
          </script>
        </div>
      </div>
      <!-- End of Price range -->
      <!-- Acomodations -->
      <button type="button" class="collapsebtn go-text-right" data-toggle="collapse" data-target="#collapse3">
      <?php echo trans('0478');?> <span class="collapsearrow"></span>
      </button>
      <div id="collapse3" class="collapse in">
        <div class="hpadding20">
          <br>
          <div class="go-right"><input type="checkbox" name="propertyCategory[]" value="6" id="all" class="checkbox go-right" <?php if(in_array("6", $propertyCategory)){ echo "checked"; } ?> /><label for="all" class="css-label go-left"> &nbsp;&nbsp;<?php echo trans('0467');?> &nbsp;</label></div>
          <div class="clearfix"></div>
          <div class="go-right"><input type="checkbox" name="propertyCategory[]" value="1" id="hotel" class="checkbox go-right" <?php if(in_array("1", $propertyCategory)){ echo "checked"; } ?> /><label for="hotel" class="css-label go-left"> &nbsp;&nbsp;<?php echo trans('01');?> &nbsp; </label></div>
          <div class="clearfix"></div>
          <div class="go-right"><input type="checkbox" name="propertyCategory[]" value="2" id="suite" class="checkbox go-right" <?php if(in_array("2", $propertyCategory)){ echo "checked"; } ?> /><label for="suite" class="css-label go-left"> &nbsp;&nbsp;<?php echo trans('0468');?>&nbsp;&nbsp; </label></div>
          <div class="clearfix"></div>
          <div class="go-right"><input type="checkbox" name="propertyCategory[]" value="3" id="resort" class="checkbox go-right" <?php if(in_array("3", $propertyCategory)){ echo "checked"; } ?> /><label for="resort" class="css-label go-left"> &nbsp;&nbsp;<?php echo trans('0469');?> &nbsp;</label></div>
          <div class="clearfix"></div>
          <div class="go-right"><input type="checkbox" name="propertyCategory[]" value="4" id="vacation" class="checkbox go-right" <?php if(in_array("4", $propertyCategory)){ echo "checked"; } ?> /><label for="vacation" class="css-label go-left"> &nbsp;&nbsp;<?php echo trans('0470');?> &nbsp; </label></div>
          <div class="clearfix"></div>
          <div class="go-right"><input type="checkbox" name="propertyCategory[]" value="5" id="bed" class="checkbox go-right" <?php if(in_array("5", $propertyCategory)){ echo "checked"; } ?> /><label for="bed" class="css-label go-left"> &nbsp;&nbsp;<?php echo trans('0471');?> &nbsp;</label></div>
          <div class="clearfix"></div>
          <br>
        </div>
        <div class="clearfix"></div>
      </div>
      <!-- End of Acomodations -->
      <!-- End of Hotel Preferences -->
      <div class="clearfix"></div>
      <br/>
      <input type="hidden" name="city" value="<?php if(!empty($_GET['city'])){ echo $_GET['city']; }else{ echo $selectedCity; } ?>">
      <input type="hidden" name="checkIn" value="<?php echo $checkin; ?>">
      <input type="hidden" name="checkOut" value="<?php echo $checkout; ?>">
      <input type="hidden" name="childages" value="<?php echo $childAges; ?>">
      <input type="hidden" name="adults" value="<?php echo $adults; ?>">
      <input type="hidden" name="search" value="1">
      <button style="border-radius:0px" type="submit" class="btn btn-primary btn-lg btn-block" id="searchform"><?php echo trans('012');?></button>
    </div>
    <!-- END OF FILTERS -->
  </form>
  <script>
    $(function() {
       google.maps.event.addDomListener(window,"load",function(){new google.maps.places.Autocomplete(document.getElementById("HotelsPlacesEan"))});
    });
  </script>
  <!-- PHPtravels Modal Starting-->
  <div class="modal fade" id="datepicker" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"><i class="fa fa-calendar text-primary"></i> <?php echo trans('0232');?></h4>
        </div>
        <form method="GET" id="frm" action="" class="my-form">
          <div class="modal-body">
            <div class="col-md-6">
              <div class="form-group">
                <label for="checkIn" class="control-label"><?php echo trans('07');?></label>
                <input class="form-control dpd1" type="text"  placeholder="From" value="" name="checkin" required >
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="checkIn" class="control-label"><?php echo trans('09');?></label>
                <input class="form-control dpd2" type="text" placeholder="To" value="" name="checkout" required >
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="adults" class="control-label"><?php echo trans('010');?></label>
                <select  required class="form-control" placeholder="<?php echo trans('010');?>" name="adults" id="adults">
                  <option value=""><?php echo trans('010');?></option>
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
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="btn" class="control-label">&nbsp;</label>
                <button type="submit" class="btn btn-block btn-success"><?php echo trans('0419');?></button>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="visible-xs"><br><br></div>
  <!-- LIST CONTENT-->
  <div class="col-lg-9 col-md-9 go-left">
    <div class="itemscontainer row">
      <?php include 'hotel-view.php';?>
      <div class="clearfix"></div>
      <!--This is for display cache Parameter-->
      <div id="latest_record_para">
        <input type="hidden" name="moreResultsAvailable" id="moreResultsAvailable" value="<?php echo $moreResultsAvailable; ?>" />
        <input type="hidden" name="cacheKey" id="cacheKey" value="<?php echo $result['HotelListResponse']['cacheKey']; ?>" />
        <input type="hidden" name="cacheLocation" id="cacheLocation" value="<?php echo $result['HotelListResponse']['cacheLocation']; ?>" />
        <input type="hidden" name="" id="agesappendurl" value="<?php echo $agesApendUrl; ?>" />
        <input type="hidden" name="" id="adultsCount" value="<?php echo $adults;?>" />
      </div>
      <!--This is for display content-->
      <div id="New_data_load"></div>
      <!--This is for display Loader Image-->
      <div id="loader_new"></div>
      <div id="message_noResult"></div>
      <!-- END OF LIST CONTENT-->
    </div>
    <!-- END OF container-->
  </div>
</div>
<!-- END OF CONTENT -->
<br><br><br>
<!-- End container -->
<!-- Map -->
<!-- Map Modal -->
<div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="height:400px">
      <div class="mapContent">
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
<script type="text/javascript">
  $(function(){

  $(".dpick").on("click",function(){

  var data = $(this).data('url');

  $("#frm").prop("action",data);

  })

  })
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
      var url_to_new_content = '<?php echo base_url(); ?>ean/loadMore';

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
             // console.log(data);

          }
      });
  }

  //scroll to PAGE's bottom
  var winTop = $(window).scrollTop();
  var docHeight = $(document).height();
  var winHeight = $(window).height();




  $(window).scroll(function () {

      var moreResultsAvailable = $("#moreResultsAvailable").val();
      var foot = $("#footer").offset().top - 500;
      // console.log($(window).scrollTop()+" == "+foot);

      if (moreResultsAvailable != '' && moreResultsAvailable == 1) {

          if ($(window).scrollTop() > foot) {

              if (!loading) {
                  loading = true;
                  loadNewContent();



              }
          }
      }
  });

</script>
<style>
  .dropdown-menu {
  z-index: 1041;
  }
  .modal {
  z-index: 1041;
  margin-top:70px;
  }
  .owl .item img {
  max-height:220px;
  }
</style>
<script>
  $(function() {
     google.maps.event.addDomListener(window,"load",function(){new google.maps.places.Autocomplete(document.getElementById("HotelsPlacesEan"))});
  });
</script>
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
      <?php foreach($resultarrayMap as $res): ?>
      {
        name: 'hotel name',
        location_latitude: "<?php echo $res['latitude']; ?>",
        location_longitude: "<?php echo $res['longitude']; ?>",
        map_image_url: "https://images.travelnow.com<?php echo str_replace("_t","_b",$res['thumbNailUrl']);?>",
        name_point: "<?php echo character_limiter($res['name'],25); ?>",
        description_point: "<?php echo substr($res['shortDescription'],58,100); ?>",
        url_point: "<?php echo $baseUrl;?>hotel/<?php echo $res['hotelId']; ?>/<?php echo $result['HotelListResponse']['customerSessionId']; ?>?adults=<?php echo $adults;?>&checkin=<?php echo $checkin;?>&checkout=<?php echo $checkout.$agesApendUrl;?>"
      },
      <?php endforeach; ?>

      ],


    };


      var mapOptions = {
        zoom: 12,
        center: new google.maps.LatLng(<?php echo $resultarray[0]['latitude'];?>, <?php echo $resultarray[0]['longitude'];?>),
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
        '<img style="width:280px;height:140px" src="' + item.map_image_url + '" alt="<?php echo character_limiter($hotel->title, 80);?>"/>' +
        '<h3>'+ item.name_point +'</h3>' +
        '<span>'+ item.description_point +'</span>' +
        '<a href="'+ item.url_point + '" class="btn_1"><?php echo trans('0177');?></a>' +
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
<script>
  $('.darkened').hover(function() {

      $(this).find('img').fadeTo(500, 0.5);

  }, function() {

      $(this).find('img').fadeTo(500, 1);

  });

</script>
<?php include 'ages.php'; ?>
<script src="<?php echo $theme_url; ?>assets/js/infobox.js"></script>
<script src="<?php echo $theme_url; ?>assets/include/icheck/icheck.min.js"></script>
<link href="<?php echo $theme_url; ?>assets/include/icheck/square/grey.css" rel="stylesheet">
<script>
  var cb, optionSet1;
      $(".checkbox").iCheck({
        checkboxClass: "icheckbox_square-grey",
        radioClass: "iradio_square-grey"
      });

      $(".radio").iCheck({
        checkboxClass: "icheckbox_square-grey",
        radioClass: "iradio_square-grey"
      });
</script>
