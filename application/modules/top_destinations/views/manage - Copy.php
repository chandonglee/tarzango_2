<script type="text/javascript">
  $(function(){
     var slug = $("#slug").val();
     $(".submitfrm").click(function(){
       var submitType = $(this).prop('id');
            for ( instance in CKEDITOR.instances )

      {

          CKEDITOR.instances[instance].updateElement();

      }
               $(".output").html("");
                $('html, body').animate({

                scrollTop: $('body').offset().top

                }, 'slow');
       if(submitType == "add"){
       url = "<?php echo base_url();?>admin/top_destinations/add" ;

       }else{
       url = "<?php echo base_url();?>admin/top_destinations/manage/"+slug;

       }

       $.post(url,$(".hotel-form").serialize() , function(response){
          if($.trim(response) != "done"){
          $(".output").html(response);
          }else{
             window.location.href = "<?php echo base_url().$adminsegment."/top_destinations/"?>";
          }

          });

     })



  })
</script>
<h3 class="margin-top-0"><?php echo $headingText;?></h3>
<div class="output"></div>
<form action="" method="POST" class="hotel-form" enctype="multipart/form-data" onsubmit="return false;" >
  <div class="panel panel-default">
    <ul class="nav nav-tabs nav-justified" role="tablist">
      <li class="active"><a href="#GENERAL" data-toggle="tab">General</a></li>
      <li class=""><a href="#FACILITIES" data-toggle="tab">Facilities</a></li>
      <li class=""><a href="#META_INFO" data-toggle="tab">Meta Info</a></li>
      <li class=""><a href="#POLICY" data-toggle="tab">Policy</a></li>
      <li class=""><a href="#CONTACT" data-toggle="tab">Contact</a></li>
      <li class=""><a href="#TRANSLATE" data-toggle="tab">Translate</a></li>
    </ul>
    <div class="panel-body">
      <br>
      <div class="tab-content form-horizontal">
        <div class="tab-pane wow fadeIn animated active in" id="GENERAL">
          <div class="clearfix"></div>
          
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Destination Name</label>
            <div class="col-md-4">
              <input name="hotelname" type="text" placeholder="Hotel Name" class="form-control" value="<?php echo @$hdata[0]->hotel_title;?>" />
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Description</label>
            <div class="col-md-10">
              <textarea name="description"></textarea>
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Top Things to See</label>
            <div class="col-md-10">
              <textarea name="to_see"></textarea>
            </div>
          </div>
          
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Top Things to Do</label>
            <div class="col-md-10">
              <textarea name="to_do"></textarea>
            </div>
          </div>

           <div class="row form-group">
            <label class="col-md-2 control-label text-left">Place to Stay</label>
            <div class="col-md-10">
              <textarea name="to_stay"></textarea>
            </div>
          </div>

          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Thumb Image</label>
            <div class="col-md-4">
            <input type="file" name="thumb_img">
            </div>
          </div>

          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Background Image</label>
            <div class="col-md-4">
            <input type="file" name="back_img">
            </div>
          </div>
          
         
          </div>
                 
       
      <!-- Address and Map -->

        <div class="panel panel-default">
        <div class="panel-heading"><strong>Map Address</strong></div>
        <div class="well well-sm" style="margin-bottom: 0px;">
        <div class="col-md-6 form-horizontal">
        <table class="table">
        <tr>
        <td>Address on Map</td>
        <td>
       <input type="text" class="form-control Places" id="mapaddress" name="hotelmapaddress" value="<?php echo $hdata[0]->hotel_map_city;?>">
        </td>
        </tr>
        <tr>
        <td></td>
        </tr>
        <tr>
        <td>Latitude</td>
        <td><input type="text" class="form-control" id="latitude" value="<?php echo $hdata[0]->hotel_latitude;?>"  name="latitude" /></td>
        </tr>
        <tr>
        <td>Longitude</td>
        <td><input type="text" class="form-control" id="longitude" value="<?php echo $hdata[0]->hotel_longitude;?>"  name="longitude" /></td>
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
        <div class="tab-pane wow fadeIn animated in" id="FACILITIES">
          <div class="row form-group">
            <div class="col-md-12">
              <div class="col-md-4">
                <label class="pointer"><input class="all" type="checkbox" name="" value="" id="select_all" > Select All</label>
              </div>
              <div class="clearfix"></div>
              <hr>
              <div class="clearfix"></div>
              <?php $hamenity = explode(",",@$hdata[0]->hotel_amenities);
                foreach($hamts as $hamt){ ?>
              <div class="col-md-4">
                <label class="pointer"><input class="checkboxcls" <?php if($submittype == "add"){ if( $hamt->sett_selected == "1"){echo "checked";} }else{ if(in_array($hamt->sett_id,$hamenity)){ echo "checked"; } } ?> type="checkbox" name="hotelamenities[]" value="<?php echo $hamt->sett_id;?>"  > <?php echo $hamt->sett_name;?></label>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
        <div class="tab-pane wow fadeIn animated in" id="META_INFO">
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Meta Title</label>
            <div class="col-md-6">
              <input name="hotelmetatitle" type="text" placeholder="Title" class="form-control" value="<?php echo @$hdata[0]->hotel_meta_title;?>" />
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Meta Keywords</label>
            <div class="col-md-6">
              <textarea name="hotelkeywords" placeholder="Keywords" class="form-control" id="" cols="30" rows="2"><?php echo @$hdata[0]->hotel_meta_keywords;?></textarea>
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Meta Description</label>
            <div class="col-md-6">
              <textarea name="hotelmetadesc" placeholder="Description" class="form-control" id="" cols="30" rows="4"><?php echo @$hdata[0]->hotel_meta_desc;?></textarea>
            </div>
          </div>
        </div>
        <div class="tab-pane wow fadeIn animated in" id="POLICY">
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Check In</label>
            <div class="col-md-2">
              <input name="checkintime" type="text" placeholder="Check In" class="form-control timepicker" data-format="hh:mm A" value="<?php echo $checkin;?>" />
            </div>
            <label class="col-md-2 control-label text-left">Check Out</label>
            <div class="col-md-2">
              <input name="checkouttime" type="text" placeholder="Check Out" class="form-control timepicker" data-format="hh:mm A" value="<?php echo $checkout;?>" />
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Payment Options</label>
            <div class="col-md-6">
              <select multiple class="chosen-multi-select" name="hotelpayments[]">
                <?php foreach($hpayments as $hpayment){ ?>
                <option value="<?php echo $hpayment->sett_id;?>" <?php if($submittype == "add"){ if( $hpayment->sett_selected == "1"){echo "selected";} }else{ if(in_array($hpayment->sett_id,$hotelpaytypes)){ echo "selected"; } } ?> >
                  <?php echo $hpayment->sett_name;?>
                </option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Policy And Terms</label>
            <div class="col-md-8">
              <textarea name="hotelpolicy" placeholder="Policy..." class="form-control" id="" cols="30" rows="7"><?php echo @$hdata[0]->hotel_policy;?></textarea>
            </div>
          </div>
        </div>
        <div class="tab-pane wow fadeIn animated in" id="CONTACT">
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Hotel's Email</label>
            <div class="col-md-4">
              <input name="hotelemail" type="text" placeholder="Email" class="form-control " value="<?php echo @$hdata[0]->hotel_email;?>" />
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Hotel's Website</label>
            <div class="col-md-4">
              <input name="hotelwebsite" type="text" placeholder="Website" class="form-control " value="<?php echo @$hdata[0]->hotel_website;?>" />
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Phone</label>
            <div class="col-md-4">
              <input name="hotelphone" type="text" placeholder="Phone" class="form-control" value="<?php echo @$hdata[0]->hotel_phone;?>" />
            </div>
          </div>
         <!--  <div class="row form-group">
           <label class="col-md-2 control-label text-left">Full Address</label>
           <div class="col-md-6">
             <input name="hoteladdress" type="text" placeholder="Address" class="form-control" value="<?php echo @$hdata[0]->hotel_address;?>" />
           </div>
         </div> -->
        </div>
        <div class="tab-pane wow fadeIn animated in" id="TRANSLATE">
          <?php foreach($languages as $lang => $val){ if($lang != "en"){ @$trans = getBackHotelTranslation($lang,$hotelid); ?>
          <div class="panel panel-default">
            <div class="panel-heading"><img src="<?php echo PT_LANGUAGE_IMAGES.$lang.".png"?>" height="20" alt="" /> <?php echo $val['name']; ?></div>
            <div class="panel-body">
              <div class="row form-group">
                <label class="col-md-2 control-label text-left">Hotel Name</label>
                <div class="col-md-4">
                  <input name='<?php echo "translated[$lang][title]"; ?>' type="text" placeholder="Hotel Name" class="form-control" value="<?php echo @$trans[0]->trans_title;?>" />
                </div>
              </div>
              <div class="row form-group">
                <label class="col-md-2 control-label text-left">Hotel Description</label>
                <div class="col-md-10">
                  <?php $this->ckeditor->editor("translated[$lang][desc]", @$trans[0]->trans_desc, $ckconfig,"translated[$lang][desc]"); ?>
                  <!--    <textarea name='<?php echo "translated[$lang][desc]"; ?>' placeholder="Description..." class="form-control" id="" cols="30" rows="4"><?php echo @$trans[0]->trans_desc;?></textarea>   -->
                </div>
              </div>
              <hr>
              <div class="row form-group">
                <label class="col-md-2 control-label text-left">Meta Title</label>
                <div class="col-md-6">
                  <input name='<?php echo "translated[$lang][metatitle]"; ?>' type="text" placeholder="Title" class="form-control" value="<?php echo @$trans[0]->metatitle;?>" />
                </div>
              </div>
              <div class="row form-group">
                <label class="col-md-2 control-label text-left">Meta Keywords</label>
                <div class="col-md-6">
                  <textarea name='<?php echo "translated[$lang][keywords]"; ?>' placeholder="Keywords" class="form-control" id="" cols="30" rows="2"><?php echo @$trans[0]->metakeywords;?></textarea>
                </div>
              </div>
              <div class="row form-group">
                <label class="col-md-2 control-label text-left">Meta Description</label>
                <div class="col-md-6">
                  <textarea name='<?php echo "translated[$lang][metadesc]"; ?>' placeholder="Description" class="form-control" id="" cols="30" rows="4"><?php echo @$trans[0]->metadesc;?></textarea>
                </div>
              </div>
              <hr>
              <div class="row form-group">
                <label class="col-md-2 control-label text-left">Policy And Terms</label>
                <div class="col-md-8">
                  <textarea name='<?php echo "translated[$lang][policy]"; ?>' placeholder="Policy..." class="form-control" id="" cols="15" rows="4"><?php echo @$trans[0]->trans_policy;?></textarea>
                </div>
              </div>
            </div>
          </div>
          <?php } } ?>
        </div>
      </div>

 



    </div>
    <div class="panel-footer">
      <input type="hidden" id="slug" value="<?php echo @$hdata[0]->hotel_slug;?>" />
      <input type="hidden" name="submittype" value="<?php echo $submittype;?>" />
      <input type="hidden" name="hotelid" value="<?php echo @$hotelid;?>" />
      <button class="btn btn-primary submitfrm" id="<?php echo $submittype; ?>">Submit</button>
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