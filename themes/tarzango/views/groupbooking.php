

<style type="text/css">

::-webkit-input-placeholder { /* WebKit, Blink, Edge */
    color: #373b71 !important;
}
input{
      padding: 15px 18px !important;
}

footer{
  width: 100%;
  float: left;
}
.fa {
   
    margin-left: 6px !important;
    font-size: 19px !important;
    cursor: pointer;
}
.img-responsive{
  height: 255px;
}
.box{
  height: 363px;
}
</style>

<link rel="stylesheet" href="<?php echo $theme_url; ?>css/style_listing.css" type="text/css" media="screen" />

<div class="group_booking">
  <div class="container-main main_header">
     <div class="container">
      <div class="row">
       
      <?php include 'menu_header.php';?>
            <center style="margin-left: 88px; z-index: 999;
    margin-top: 20px;"><a  href="<?php echo base_url(); ?>"><img class="" style="" src="images/contact-logo.png"></a></center>
          
         
     
        <div class="col-sm-12 page-title">
          <h2 class="">Services</h2>
          <a  href="<?php echo base_url(); ?>" ><img style="position:relative;z-index:999;" src="images/arrow-blue.png"></a>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="group_booking_body">
    <div class="section1">
      <div class="container">
        <div class="row">
          <div class="col-sm-7">
            <h1>Tarzango Services</h1>
            <p>Let Tarzango negotiate the lowest rate on the market for your next group hotel needs.You will receive personable experiance, with a dedicatd specialist to help guide you along the way. Our goal is to offer high quality hotels and evets, without breaking the bank.Providing a lasting impression, while keeping cost low is our speciality.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="section2">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h1>How simple is it? Well, We do all the work! </h1>
          </div>
        </div>
      </div>
    </div>
    <div class="section3">
      <div class="container">
        <div class="row">
          <div class="col-sm-1">
          </div>
          <div class="col-sm-10">
            <h1>Get Started Now, it's as easy as</h1>
            <div class="col-sm-4">
              <div class="box one">
                <img src="images/group_booking_icon1.png">
                <h5>Enter Your Event Location</h5>
                <p>1</p>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="box two">
                <img src="images/group_booking_icon2.png">
                <h5>Choose Desired Hotels</h5>
                <p>2</p>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="box three">
                <img src="images/group_booking_icon3.png">
                <h5>Let Tarzango Save You!</h5>
                <p>3</p>
              </div>
            </div>
          </div>
          <div class="col-sm-1">
          </div>
        </div>
      </div>
    </div>
  



<?php  

$now = new DateTime();
$checkin1 = date("m/d/Y", strtotime("+1 days"));
$checkout1 = date("m/d/Y", strtotime("+2 days"));

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
<div class="section4">
      <div class="container">
          <div class="col-sm-12">
          <h1>Search for Landmark or venue space</h1>
          <form class="container form_header_one" action="" method="GET" role="search">
            <div class="col-sm-5">
              <div class="form-group">
                <input id="HotelsPlacesEan" name="city"  type="text" class="form-control RTL " placeholder="<?php echo trans('026');?>" value="" required >
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
                <input type="text" style="font-size: 16px !important;" placeholder=" <?php echo trans('07');?>" name="checkIn" class="dpean1 form-control" value="09/10/2016" required >
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
                 <input type="text" style="font-size: 16px !important;" class="form-control dpean2" placeholder=" <?php echo trans('09');?>" name="checkOut" value="09/20/2016" required >
              </div>
            </div>
            <div class="col-sm-2">
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
            </div>
            <div class="col-sm-1">
              <div class="form-group submit-image">
               <button type="button" class="btn-action  form-control btn btn-sm btn-block update_btn" style="height:60px;width:60px">
              </div>
            </div>
             <input type="hidden" name="childages" id="childages" value="">
            <input type="hidden" name="search" value="search" >
            <input type="hidden" id="lat" name="lat" value="">
            <input type="hidden" id="long" name="long" value="">
            <input type="hidden" id="url" name="url" value="<?php echo base_url(); ?>">
          </form>
        </div>
      </div>
    </div>

    <div id="hotel_deta" style="z-index:9999999999">
    </div>

      <div class="section6">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8">
              <h1>Fill out the form below</h1>
               <div  style="text-align:center;color:red; background:#e8ebf5;background: #e8ebf5; border-radius: 0px; font-size: 14px !important;  font-family: 'Apercu-Regular';width: 96%; margin-left:15px;" class="form_result"></div>
               <form class="" id="booking_data_final1" method="POST" name="">
                <div class="col-sm-12">
                  <div class="form-group">
                    <input type="text" name="g_company_name" value="" class="form-control" id="g_company_name" placeholder="Tarzango">
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
                     <input type="number" name="g_attendees" value="" class="form-control" id="g_attendees" placeholder="Number of anticipated attendees">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                  <input type="number" name="rooms" value="" class="form-control" id="g_aprx_rooms" placeholder="Rooms">
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

              </form>
            </div>
            <div class="col-sm-2">
            </div>
          </div>
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
            <div class="col-sm-12 inner_logo">
              <a href=""><img class="img-responsive" src="images/logo.png"></a>
            </div>
            <h3>Become a Member</h3>
            <h4>We provide a modern way for Group Travellers to book large room blocks.</h4>
            <a class="get-button" href="<?php echo base_url().'membership'; ?>">GET STARTED</a>
          </div>
          </div>
        </div>
        </div>
        
      </div>
    </div>

    <div class="section7">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h1>Become a V.I.P member Now and receive additional</h1>
            <h2>10% off plus some AWESOME Perks</h2>
            <a href="<?php echo base_url().'membership'; ?>">MEMBERSHIP</a>
          </div>
        </div>
      </div>
    </div>
</div>

  
</div>




<script>


  function get_hotel(hotel_id,hotel_name){
    //var hotel_id = $(this).data('hotel_id');
        old_Val_id = $("#sel_hotel_id").val();
        old_Val_name = $("#sel_hotel_name").val();
        if($('#sel_hotel_'+hotel_id).is(":checked")){
           // $("#sel_hotel").html(hotel_id);
            /*$("#sel_hotel_id").val(old_Val_id+','+hotel_id);
            $("#sel_hotel_name").val(old_Val_name+','+hotel_name);*/
            sel_hotel_data = '<input type="hidden" name="sel_hotel_id[]" class="sel_'+hotel_id+'" value="'+hotel_id+'">';
            sel_hotel_data += '<input type="hidden" name="sel_hotel_name[]" class="sel_'+hotel_id+'" value="'+hotel_name+'">';
            $("#booking_data_final1").append(sel_hotel_data);
        }else{
          /*new_val_id = old_Val_id.replace(','+hotel_id,'');
          new_val_name = old_Val_name.replace(','+hotel_name,'');
          $("#sel_hotel_id").val(new_val_id);
          $("#sel_hotel_name").val(new_val_name);*/
          $(".sel_"+hotel_id).remove();
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
           $("#loading").show();
           $('#result_data').hide();
        },
        success: function(data)
        {
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
              
  $(".update_btn").click(function(){
  //$(document).ready(function(){
      //$(".form_header_one")

      var lat = $("#lat").val();
      var long = $("#long").val();
      var room = $("#room").val();
      var checkIn = $(".dpean1").val();
      var checkOut = $(".dpean2").val();
      var url = $("#url").val();
      var city = $("#HotelsPlacesEan").val();
      var adults = 1;
      var search = 'search';
      var childages = '';
      var child = '';
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
           $("#loading").show();
           $('#result_data').hide();
        },
        success: function(data)
        {
          //console.log(data);
          response = $.parseJSON(data);
          var clicks = 1;
              
          var HTML_DATA = '<script>function onClick() {clicks += 1;clicks <= '+response.hotel.length+';if (clicks <= '+response.hotel.length+'){document.getElementById("clicks").innerHTML = clicks;}else if (clicks > '+response.hotel.length+') {clicks = 1;document.getElementById("clicks").innerHTML = clicks;}};var clicks = 1;function onClick1() { if (clicks > 1){ clicks -= 1;document.getElementById("clicks").innerHTML = clicks;}else if (clicks = 1) {clicks = '+response.hotel.length+';document.getElementById("clicks").innerHTML = clicks;}};<\/script>';
            if(response.location_img != '' && response.location_img != null){
              HTML_DATA += '<style>.group_booking_body .section5{background-image:url('+url+'uploads/images/location_img/'+response.location_img+')}</style>';
            }

            HTML_DATA += '<div class="section5"><div class="container"> <div class="row">  <div class="col-sm-12">            <h1>These are the top '+response.hotel.length+' results we found near '+city+'</h1> <div class="col-sm-4"><div id="slider" style="width: 500px; height: 600px;">    <ul>';

          for (var i = 0;  i < response.hotel.length; i++) {
            var base_date = response.hotel[i];
           var hotel_name = base_date.title;
           var add_dot = '';
           if(hotel_name.length > 20){
              add_dot = '...';
           }
            HTML_DATA += '<li><div class="col-sm-4">';  
            HTML_DATA += '<img  class="img-responsive" src="'+base_date.thumbnail.replace('http://demo.tarzango.com/','http://tarzango.com/')+'"><div class="box">';
            HTML_DATA += '<div class="stars" style="font-size: 18px !important;">'+base_date.stars+'</div>';
            HTML_DATA += '<h1>'+hotel_name.substring(0,20)+add_dot+'</h1>';
            //HTML_DATA += '<p> '+base_date.room_Data[0].maxQuantity+' avalible room <br>';
            HTML_DATA += '<p> '+base_date.distance.substring(0,4)+' miles from '+city +'</p>';
            HTML_DATA += '<h2>$ '+base_date.price+'<span> / night</span></h2><input style="float:right;width: 38px;" class="verified" type="checkbox" id="sel_hotel_'+base_date.id+'" onClick="get_hotel('+base_date.id+',\''+base_date.title+'\')">'; 
             HTML_DATA += '</div></li> ';

          }
           HTML_DATA += '</ul></div>';
           HTML_DATA += '<div class="buttons" style="width:390px;"><p><img  type="button" onClick="onClick1()" id="prev" class="pre" src="images/group_booking_icon4.png">#<a id="clicks">1</a><img  type="button" onClick="onClick()" id="next" class="next" src="images/group_booking_icon5.png"></p></div></div></div></div></div> </div>';

          $("#hotel_deta").html(HTML_DATA);
             
          $(function() {


    var slideCount = $('#slider ul li').length;
    var slideWidth = $('#slider ul li').width();
    var slideHeight = $('#slider ul li').height();
    var sliderUlWidth = slideCount * slideWidth;

    $('#slider').css({
        width: slideWidth,
        height: slideHeight
    });

    $('#slider ul').css({
        width: sliderUlWidth,
        marginLeft: -slideWidth
    });

    $('#slider ul li:last-child').prependTo('#slider ul');

    function moveLeft() {
        $('#slider ul').animate({
            left: +slideWidth
        }, 200, function () {
            $('#slider ul li:last-child').prependTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    function moveRight() {
        $('#slider ul').animate({
            left: -slideWidth
        }, 200, function () {
            $('#slider ul li:first-child').appendTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    $('#prev').click(function () {
        moveLeft();
    });

    $('#next').click(function () {
        moveRight();
    });
});
          console.log(response.length);
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
            sel_hotel_data ="";
            sel_hotel_data += '<input type="hidden" name="location_lat" value="'+$("#lat").val()+'">';
            sel_hotel_data += '<input type="hidden" name="location_long" value="'+$("#long").val()+'">';
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

