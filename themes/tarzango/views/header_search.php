

<style type="text/css">
header.header-section .menu img{
  margin-top: -15px !important;
}
.form-control:focus{
  border-color: #2c3e50 !important;
  -webkit-box-shadow: none;
  box-shadow: none;
}
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
    width: 60%;
   color: #FFF;
    font-size: 17px;
    text-transform: capitalize;
    padding: 18px;
    display: inline-block;
    /*background: #ffc100;*/
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
    top: -56px !important;
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
       top: 15px !important;
    z-index: 1111;
}
 .close-button{
  margin-top:37px;
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
.img-circle{
  height: 125% !important;
}
.nnn_btn{
  width: 100%;
}
.dropdown {
    position: relative;
    display: inline-block;
}
.form-group button[type="submit"]{
  margin: 0px !important;
  width: 100%;
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


$date1 = new DateTime($checkin);
$date2 = new DateTime($checkOut);

$diff = $date2->diff($date1)->format("%a");
if($room <= 0){
  $room = 1;
}

$sel_room = $room;
?>
<header class="header-section">
<div class="container" style="padding-left: 0px !important;padding-left: 0px !important">
    
      <div class="row" style="padding-left: -45px !important;">
        <div class="col-sm-12" style="padding-left:0px ;padding-right:0px">
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
  <div class="search-section inner-search">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
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
               <select class="form-control inner-dd" name="room" id="room" style="padding:10px 5px;border-radius: 3px; border: 0px;padding-right: 85px !important;">
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
                  <input type="text" name="adults" value="<?php echo $adults; ?>" id="" class="adult" disabled><p> Adults, </p>
                  <input type="text" name="children" value="<?php echo $child; ?>" id="" class="children" disabled><p> Children </p>
                  <img class="input-arrow" src="images/field-arrow-down.png">
                </div>
              </div>
              <div class="dropdown">
                <div class="adults">
                  <p>Adults</p>
                  <div class="right">
                    <input type="text" name="" value="<?php echo $adults; ?>" id="adult1" class="adult" disabled><img class="plus1 first" id="" src="images/arrow-up.png"><img class="minus1 last" id="" src="images/arrow-down.png">
                  </div>
                </div>
                <div class="childrens">
                  <p>Children</p>
                  <div class="right">
                    <input type="text" name="" value="<?php echo $child; ?>" id="children1" class="children" disabled><img class="plus2 first" id="" src="images/arrow-up.png"><img class="minus2 last" id="" src="images/arrow-down.png">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-1 inner-submit">
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
