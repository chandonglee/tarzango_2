<h3 class="margin-top-0"><?php echo $headingText;?></h3>
<div class="output"></div>
<form action="" method="POST" class="hotel-form" enctype="multipart/form-data"  >
  <div class="panel panel-default">
  
    <div class="panel-body"> <br>
      <div class="tab-content form-horizontal">
        <div class="tab-pane wow fadeIn animated active in" id="GENERAL">
          <div class="clearfix"></div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Name</label>
            <div class="col-md-4">
              <input name="name" type="text" placeholder="Name" class="form-control" value="<?php echo @$hdata[0]->name;?>" />
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Description</label>
            <div class="col-md-10">
              <textarea name="description"><?php echo @$hdata[0]->description;?></textarea>
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Top Things to See</label>
            <div class="col-md-10">
              <textarea name="to_see"><?php echo @$hdata[0]->to_see;?></textarea>
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Top Things to Do</label>
            <div class="col-md-10">
              <textarea name="to_do"><?php echo @$hdata[0]->to_do;?></textarea>
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Place to Stay</label>
            <div class="col-md-10">
              <textarea name="to_stay"><?php echo @$hdata[0]->to_stay;?></textarea>
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Thumb Image</label>
            <div class="col-md-4">
              <input type="file" name="thumb_img">
            </div>
          </div>
           <?php if(@$hdata[0]->thumb_img != ""){ ?>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Thumb Current Image</label>
            <div class="col-md-4">
            <img src="<?php echo base_url().'uploads/images/dest_img/thumb_img/'.@$hdata[0]->thumb_img; ?>" height="300px" width="500px">
            </div>
          </div>
          <?php } ?>

          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Background Image</label>
            <div class="col-md-4">
              <input type="file" name="back_img">
            </div>
          </div>

          <?php if(@$hdata[0]->back_img != ""){ ?>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left"> Background Current Image</label>
            <div class="col-md-4">
            <img src="<?php echo base_url().'uploads/images/dest_img/back_img/'.@$hdata[0]->back_img; ?>" height="300px" width="500px">
            </div>
          </div>
          <?php } ?>

          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Detail Background Image</label>
            <div class="col-md-4">
              <input type="file" name="detail_back_img">
            </div>
          </div>
          
          <?php if(@$hdata[0]->detail_back_img != ""){ ?>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Detail Background Current Image</label>
            <div class="col-md-4">
            <img src="<?php echo base_url().'uploads/images/dest_img/detail_back_img/'.@$hdata[0]->detail_back_img; ?>" height="300px" width="500px">
            </div>
          </div>
          <?php } ?>

        </div>

  
        <!-- Address and Map -->
        
        <div class="panel panel-default">
          <div class="panel-heading"><strong>Map Address</strong></div>
          <div class="well well-sm" style="margin-bottom: 0px;">
            <div class="col-md-6 form-horizontal">
              <table class="table">
                <tr>
                  <td>Address on Map</td>
                  <td><input type="text" class="form-control Places" id="mapaddress" name="mapaddress" value="<?php echo $hdata[0]->hotel_map_city;?>"></td>
                </tr>
                <tr>
                  <td></td>
                </tr>
                <tr>
                  <td>Latitude</td>
                  <td><input type="text" class="form-control" id="latitude" value="<?php echo $hdata[0]->latitude;?>"  name="latitude" /></td>
                </tr>
                <tr>
                  <td>Longitude</td>
                  <td><input type="text" class="form-control" id="longitude" value="<?php echo $hdata[0]->longitude;?>"  name="longitude" /></td>
                </tr>
              </table>
            </div>
            <div class="col-md-6">
              <div class="thumbnail">
                <div id="map-canvas" style="height: 200px; width:400"></div>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
        <!-- Address and Map --> 
        
      </div>
      
    </div>
  </div>
  <div class="panel-footer">
    
    <input type="hidden" name="submittype" value="<?php echo $submittype;?>" />
    <input type="hidden" name="top_destinations_id" value="<?php echo @$top_destinations_id;?>" />
    <button type="submmit" class="btn btn-primary submitfrm" id="<?php echo $submittype; ?>">Submit</button>
  </div>
  </div>
</form>

<!-- google places --> 

<script type='text/javascript' src="//maps.googleapis.com/maps/api/js?key=AIzaSyAH65sTGsDsP4mMpmbHC8zqRiM1Qh07iL8&sensor=false&libraries=places"></script> 
<script type='text/javascript'>//<![CDATA[
  $(window).load(function(){
   var autocomplete
  getPlace_dynamic();
  function getPlace_dynamic() {
  var input = document.getElementsByClassName('Places');
  var location = $("#mapaddress").val();
  for (i = 0; i < input.length; i++) {
  autocomplete = new google.maps.places.Autocomplete(input[i]);

  }

  google.maps.event.addListener(autocomplete, 'place_changed', function() {

      var place = autocomplete.getPlace();
       $('#latitude').val(place.geometry.location.lat());
       $('#longitude').val(place.geometry.location.lng());
       codeAddress();

    });

  }

  });//]]>


</script> 

<!--Google Map API --> 

<script type="text/javascript">

    var markers = [];



    function initialize() {

        geocoder = new google.maps.Geocoder();

        var mapOptions = {

            center: new google.maps.LatLng(-34.397, 150.644),

            zoom: 13

        };

        map = new google.maps.Map(document.getElementById("map-canvas"),

            mapOptions);


        var ex_latitude = $('#latitude').val();

        var ex_longitude = $('#longitude').val();



        if (ex_latitude != '' && ex_longitude != ''){

            map.setCenter(new google.maps.LatLng(ex_latitude, ex_longitude));//center the map over the result

            var marker = new google.maps.Marker(

                {

                    map: map,

                    draggable:true,
                    icon: "<?php echo PT_DEFAULT_IMAGE . 'marker.png'; ?>",

                    animation: google.maps.Animation.DROP,

                    position: new google.maps.LatLng(ex_latitude, ex_longitude)

                });



            markers.push(marker);

            google.maps.event.addListener(marker, 'dragend', function()

            {

                var marker_positions = marker.getPosition();

                $('#latitude').val(marker_positions.lat());

                $('#longitude').val(marker_positions.lng());



            });



        }

    }



    function codeAddress()

    {

        var address = $('#mapaddress').val();

       /* var country = $('#country').val();

        var state = $('#state').val();

        var city = $('#city').val();
*/


       // var address = [main_address,city, state, country].join();



        if( address != '')

        {





            setAllMap(null); //Clears the existing marker



            geocoder.geocode( {address:address}, function(results, status)

            {

                if (status == google.maps.GeocoderStatus.OK)

                {

                    console.log(results[0].geometry.location.lat());

                    $('#latitude').val(results[0].geometry.location.lat());

                    $('#longitude').val(results[0].geometry.location.lng());

                    map.setCenter(results[0].geometry.location);//center the map over the result





                    //place a marker at the location

                    var marker = new google.maps.Marker(

                        {

                            map: map,

                            draggable:true,

                            animation: google.maps.Animation.DROP,

                            position: results[0].geometry.location

                        });



                    markers.push(marker);





                    google.maps.event.addListener(marker, 'dragend', function()

                    {

                        var marker_positions = marker.getPosition();

                        $('#latitude').val(marker_positions.lat());

                        $('#longitude').val(marker_positions.lng());

//                        console.log(marker.getPosition());

                    });

                } else {

                    alert('Geocode was not successful for the following reason: ' + status);

                }

            });



        }

        else{

            alert('You must enter at least Address');

        }



    }



    function setAllMap(map) {

        for (var i = 0; i < markers.length; i++) {

            markers[i].setMap(map);

        }

    }



    google.maps.event.addDomListener(window, 'load', initialize);

</script> 

<!-- Google Map API --> 

<script>
  $(document).ready(function() {
      if (window.location.hash != "") {
          $('a[href="' + window.location.hash + '"]').click()
      }
  });
</script>