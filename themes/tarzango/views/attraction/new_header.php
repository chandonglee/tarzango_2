<style type="text/css">
.blog {
	display: block !important;
}
.header-navigation-section .menu img {
	float: right;
	cursor: pointer;
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
	top: 17px;
	right: 0px;
	cursor: pointer;
}
.container-main.main_header.new input.search-box {
	border: none !important;
	width: 60%;
	box-shadow: none;
}
.header-navigation-section .menu img {
	z-index: 999999;
	float: right;
	cursor: pointer;
}
.container-main.main_header.new {
	padding: 10px 0px !important;
}
.header-navigation-section .menu p.close-button {
	margin-right: 65px !important;
	top: 10px !important;
}
.menu-dropdown {
	top: 40px;
	right: 55px;
}
.menu-header {
	display: none;
}
.user {
	margin-top: 20px;
}
#header.sticky > .container-main.main_header.new {
	padding: 25px 0px !important;
}
/* new header */

.container-main.main_header.new {
	background-image: none;
	padding: 0px 15px;
	background-color: #1cc0fb;
}
.container-main.main_header.new .col-sm-12 {
	padding: 0px;
}
.container-main.main_header.new .inner_logo {
	text-align: center;
}
.container-main.main_header.new .inner_logo img {
	height: 50px;
	margin: 10px 0px;
}

 .container-main.main_header.new input.search-box::-webkit-input-placeholder {
 color: #fff;
 font-size: 17px;
 font-family: apercu_regular;
}
.container-main.main_header.new .inner_menu {
	text-align: center;
}
.container-main.main_header.new .inner_menu img {
	float: none;
	padding: 0px;
	margin: 27px 0px;
}
.search-section .col-sm-3 input.place {
	background-image: url(../images/field-search.png);
	background-repeat: no-repeat;
	background-position: 10%;
	padding-left: 42px !important;
}
.attraction-listing-body .view-options {
	text-align: right;
	padding: 42px 0px;
}
.attraction-listing-body .view-options p {
	font-size: 17px;
	font-family: apercu_regular;
	color: #0c134f;
	margin-right: 20px;
	float: right;
	margin-bottom: 0px;
}
.attraction-listing-body .view-options a {
	float: right;
}
.attraction-listing-body .view-options a img {
	float: right;
	margin-left: 20px;
}

@media(max-width: 550px) {
.header-navigation-section .menu p.close-button {
	margin-top: -56px;
	right: -55px !important;
}
}
</style>
<?php  

$now = new DateTime();
$checkin1 = date("m/d/Y", strtotime("+1 days"));
$checkout1 = date("m/d/Y", strtotime("+2 days"));


?>
<script type="text/javascript">
  $(window).scroll(function() {
    if ($(this).scrollTop() > 1){  
        $('#header').addClass("sticky");
      }
      else{
        $('#header').removeClass("sticky");
      }
    });
</script>
<div id="header">
<div class="container-main main_header new" style="background-image:none; padding-bottom: 5px;position:fixed ;z-index:999;   ">
  <div class="container width12">
  <div class="col-sm-12">
    <div class="col-sm-1 inner_logo pull-left"> <a href="<?php echo base_url(); ?>"><img class="" src="images/new_logo.png"></a> </div>
    <div class="col-sm-8 pull-left" >
      <form action="<?php echo base_url();?>ean/search" method="GET" role="search" name="">
        <input type="search" name="city" class="form-control search-box" value="" id="HotelsPlacesEan" placeholder="Where you want to go?">
        <input type="hidden" name="adults" value="1" id="adult1" class="adult">
        <input type="hidden" name="children" value="0" id="children1" class="children" >
        <input type="hidden" name="childages" id="childages" value="">
        <input type="hidden" name="room" id="room" value="1">
        <input type="hidden" name="checkIn" id="checkIn" value="<?php echo $checkin1; ?>">
        <input type="hidden" name="checkOut" id="checkOut" value="<?php echo $checkout1; ?>">
        <input type="hidden" name="search" value="search" >
        <input type="hidden" id="lat" name="lat" value="">
        <input type="hidden" id="long" name="long" value="">
      </form>
    </div>
        <div class="col-sm-2 user">
    <?php  if(!empty($customerloggedin)){ ?>
       
    

      <div class="dropdown">
        <button onclick="myFunction()" class="dropbtn">Hello, <?php echo $firstname; ?> <img  style="width: 20px; float: right;margin-left: 10px; " src="images/menu-arrow-down.png"></button>
        <div id="myDropdown" class="dropdown-content"> <a href="<?php echo base_url()?>account/"> Reservations </a> <a href="<?php echo base_url()?>account/logout/"> Logout</a> </div>
      </div>
    <?php }?>
 </div>
    <?php include 'menu_header.php';?>
    </div>
  </div>
  </div>
</div>
<script>

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
              autocomplete = new google.maps.places.Autocomplete(document.getElementById("HotelsPlacesEan"));
              google.maps.event.addListener(autocomplete, 'place_changed', function() {
                fillInAddress();
              });
          }); 
          function fillInAddress() {

          var place = autocomplete.getPlace();

          for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            
            console.log(place.geometry.location.lat());
            console.log(place.geometry.location.lng());
            document.getElementById("lat").value = place.geometry.location.lat();
            document.getElementById("long").value = place.geometry.location.lng();
          }
        }
      });

/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */

function myFunction() {
  
  $("#myDropdown").toggle();
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