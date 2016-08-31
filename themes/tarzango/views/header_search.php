

<style type="text/css">
  #top .slider {
    min-height: 130px;
  }
  #top .slider .cover {
    min-height: 130px;
  }
  .fa-star {
    font-size: 16px;
    color: #ABA8C3;
    padding: 3px;
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
    border:0px !important;
  }

header.header-section .sorting .col-sm-1.view-option a img 
{
  margin:0px !important;
}
 .header-navigation-section .menu img {
    float: right;
    margin-top: 27px;
    cursor: pointer;
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
.open{
  margin-top: -44px !important;
    margin-left: 60px !important;
}
.menu-dropdown {
    position: absolute;
    display: none;
    background-image: url(../images/menu-bg.png);
    background-repeat: no-repeat;
    background-size: 100% 100%;
    padding: 60px;
    width: 340px;
    height: auto;
    right: 25px !important;
    top: 15px !important;
    z-index: 1111;
}
@media(min-width: 375px){
  .menu-dropdown{
    top: 100px ;
  }
  .header-navigation-section .menu p.close-button{
    top: -30px ;
  }
}
@media(min-width: 425px){
  .menu-dropdown{
    top: 80px ;
  }
  .header-navigation-section .menu p.close-button{
    top: -27px ;
  }
}
@media(min-width: 768px){
  .menu-dropdown{
    top: 50px ;
  }
}

@media (min-width: 1200px)
{
    .form-control
  {
    width:100% !important;
  }
  .first_container
  {
    width:1210px !important;
  }
}
</style>
<link rel="stylesheet" href="<?php echo $theme_url; ?>css/style_listing.css" type="text/css" media="screen" />
<?php  

$now = new DateTime();
$checkin1 = date("m/d/Y", strtotime("+1 days"));
$checkout1 = date("m/d/Y", strtotime("+2 days"));

$room = isset($_GET['room']) && $_GET['room'] != '' ? $_GET['room'] : 1;
$child = isset($_GET['child']) && $_GET['child'] != '' ? $_GET['child'] : 0;
$adults = isset($_GET['adults']) && $_GET['adults'] != '' ? $_GET['adults'] : 1;
$checkin = isset($_GET['checkin']) && $_GET['checkin'] != '' ? $_GET['checkin'] : $checkin1;

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
  <div class="container-main">
    <div class="container first_container" style="z-index: 1 ;width:100%">
      <div class="row">
        <div class="col-sm-12">
          <div class="col-sm-11 logo" style="top:-15px">
            <a href="<?php echo base_url(); ?>"><img class="" src="images/logo2.png"></a>
            <p>Tarzango - Know where you want to go. We'll do the rest.</p>
          </div>
          <?php include 'menu_header.php';?>
        </div>
      </div>
      <div class="row fields">
        <div class="col-sm-12">
          <form  class="container form_header_one" action="<?php echo $baseUrl;?>search" method="GET" role="search">
            <div class="col-sm-3">
              <div class="form-group">
                <input id="HotelsPlacesEan" name="city"  type="text" class="form-control RTL search-location" placeholder="<?php echo trans('026');?>" value="<?php if(!empty($_GET['city'])){ echo $_GET['city']; }else{ echo $selectedCity; } ?>" required >
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
            <div class="col-sm-1">
              <div class="form-group">
                <select class="form-control" name="room" id="room" style="padding:10px 5px;border-radius: 3px; border: 0px;">
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
              </div>
            </div>
            <div class="col-sm-1">
              <div class="form-group">

            <select  class="form-control" style="border-radius: 3px; border: 0px; " 
            placeholder=" Adults<?php //echo trans('011');?> " name="child" id="child">
              <option value="">Children</option>
                <?php for($j = 0; $j <= 3; $j++ ){ ?>
                <option value="<?php echo $j; ?>" <?php if($j == $child){ echo "selected"; } ?> > <?php echo $j; ?> </option>
                <?php } ?>
            </select>
              </div>
            </div>
            <div class="col-sm-1">
              <div class="form-group">
                <select class="RTL form-control" style="border-radius: 3px; border: 0px;" placeholder=" <?php echo trans('');?> "  name="adults" id="guest">
                 <option value="">Adults</option>
            <?php for($i = 1; $i <= 9; $i++){ if(empty($adults)){ $adults = 2; } ?>
            <option value="<?php echo $i; ?>" <?php if($i == $adults){ echo "selected"; } ?> ><?php echo $i; ?></option>
            <?php } ?>
          </select>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group submit-button">
                 <button type="submit" class="btn-action btn btn-sm btn-block update_btn" style=""><!--<i class="icon_set_1_icon-78"></i>--> UPDATE</button>
              </div>
            </div>
            <input type="hidden" name="childages" id="childages" value="">
            <input type="hidden" name="search" value="search" >
            <input type="hidden" id="lat" name="lat" value="<?php echo $lat; ?>">
            <input type="hidden" id="long" name="long" value="<?php echo $long; ?>">
          </form>
        </div>
      </div>
      <div class="row sorting">
        <div class="col-sm-12">
          <form class="" id="sorting" method="get" name="sorting">
            <div class="col-sm-1 title">
              <div class="form-group">
                <p>Sort Results by</p>
              </div>
            </div>
            <div class="col-sm-2 default">
              <div class="form-group">
                <label>RECOMMENDED</label>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
                <select class="form-control" id="rooms" name="rooms">
                <option value="1">POPULARITY</option>
                </select>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
                <select class="form-control" id="rooms" name="rooms">
                <option value="1">PRICE</option>
                </select>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
                <select class="form-control" id="children" name="children">
                <option value="1">DISTANCE</option>
                </select>
              </div>
            </div>
            <div class="col-sm-2 map-view">
              <div class="form-group">
                <label>MAP VIEW</label>
              </div>
            </div>
            <div class="col-sm-1 view-option">
             <?php $protocol = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
                $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'];
                $complete_url_final =   $base_url . $_SERVER["REQUEST_URI"];
          ?>
          
              <?php $complete_url2 = str_replace("/search", "/search2", $complete_url_final); ?>
              <a class="" id="grid-listing" style="width: 50% !important;float: left;" href="<?php echo $complete_url2; ?>" > <img src="images/icon/grid-list-icon.png"> </a>
              <?php $complete_url1 = str_replace("/search", "/search1", $complete_url_final); ?>
              <a class="" id="box-listing" href="<?php echo $complete_url1; ?>"  > <img  src="images/icon/box-list-icon.png" > </a> 
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</header>

<script>
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
          /*var placeSearch, autocomplete;
          var componentForm = {
            route: 'long_name', // street_address
            locality: 'long_name', // city
            administrative_area_level_1: 'short_name', // state
            country: 'long_name',
            postal_code: 'short_name',
          };*/
          /*google.maps.event.addDomListener(window,"load",function(){
              autocomplete = new google.maps.places.Autocomplete(document.getElementById("HotelsPlacesEan1"));
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
        }*/
      });
  </script>
