
<style>
.form-control{
border-radius:0px;
}
.modal-backdrop { z-index: 99; } 

</style>

<div class="container">
      <div class="row">
        <div class="col-md-12 ">
          <h1 class="text-center slider-header">Tarzango</br><span style="font-family: 'gotham_light_test' "> The Hotel Negotiator</span> </h1>
          <a href="#" class="btn" title="Beta Test For Free!">Beta Test For Free!</a>
           <form action="<?php echo base_url();?>ean/search" method="GET"> 
            <ul class="slider-form">
              <li>
                <input id="HotelsPlacesEan" name="city" type="text" class="form-control RTL search-location form-control-icon" placeholder="Where do you want to go?" required /> 
              </li>
              <li>
                
                <input type="text" class="form-control-icon form-control checkinsearch RTL icon-calendar dpean1" name="checkIn" value="<?php echo $eancheckin;?>" placeholder="<?php echo trans('08');?>" required /> 
              </li>
              <li>
                <input type="text" class="form-control-icon form-control checkinsearch RTL icon-calendar dpean2" name="checkOut" value="<?php echo $eancheckout;?>" placeholder="<?php echo trans('08');?>" required /> 
              </li>
              <li >
                <select name="adults" style="-webkit-appearance: none; -webkit-border-radius: 0; text-align-last: center;">
                  <option value="1" >1 Guest</option>
                  <option value="2" >2 Guest</option>
                  <option value="3" >3 Guest</option>
                  <option value="4" >4 Guest</option>
                  <option value="5" >5 Guest</option>
                </select>
              </li>
              <li>
                <input type="submit" value="Tarzan go!" style="-webkit-appearance: none; -webkit-border-radius: 0;" >
              </li>
            </ul>
            <input type="hidden" id="lat" name="lat">
            <input type="hidden" id="long" name="long">
            <input type="hidden" name="room" value="1">
            <input type="hidden" name="search" value="search">
            <input type="hidden" name="childages" value="">
            <input type="hidden" name="child" value="">
          </form>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>

     </div>
</div>
<div class="container">
	<div class="row">
    	
    </div>
</div>
<!-- WRAP -->
<div class="wrap ctup">
<div class="slideup" >
  <div class="z-index100" style="background-color:#fff">
       <div class="col-md-12 scolright go-left visible-lg visible-md">
          <div class="row">
            <!-- add slider code her -->
          </div>
        </div>
      <div  style="position:absolute;width:100%">
      <div class="container">
      
      <div class="col-md-12 go-right RTL_Bar header-input-box" style="margin-top:25px">
      <div class="row">
    
          </div>
          <div class="clearfix"></div>
          <div class="tab-content row">
            <br>

       
            <!-- Expedia Hotels  -->
            <div  role="tabpanel" class="tab-pane fade <?php pt_searchbox('ean'); ?>" id="EXPEDIA" aria-labelledby="home-tab">
  <?php if(pt_main_module_available('ean')){ ?> 
      <form action="<?php echo base_url();?>ean/search" method="GET" style="display:none;"> 
          	 <div class="col-xs-6 col-md-2 col-lg-2 col-sm-6"> 
              <div class="form-group"> 
                    <label class="control-label go-right"><!--<i class="icon-location-6"></i>--> <?php echo trans('0254');?></label> 
                    
                </div> 
             </div> 
             <div class="col-xs-6 col-md-2 col-lg-2 col-sm-6 check-new"> 
              <div class="form-group"> 
                  <div class="clearfix"></div> 
                    <label class="control-label go-right"><i class="icon-calendar-7"></i> <?php echo trans('07');?></label> 
                    
                 </div> 
             </div> 
             <div class="col-xs-6 col-md-2 col-lg-2 col-sm-6 check-new"> 
              <div class="form-group"> 
                  <div class="clearfix"></div> 
                    <label class="control-label go-right"><i class="icon-calendar-7"></i> <?php echo trans('09');?></label>
                    
                </div> 
              </div> 
             <div class="col-md-1 col-sm-6 col-xs-6"> 
                <div class="form-group"> 
                  <div class="clearfix"></div> 
                      <label class="control-label go-right">Room</label> 
                        <select class="form-control childcount" name="room" id="room" style=""> 
                          <option value="">Select Room</option> 
                            <option value="1" selected >1</option>
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
                    <label class="control-label go-right"><!--<i class="icon-user-7"></i>--> <?php echo trans('010');?></label> 
                    <div class="clearfix"></div> 
                    <select class="form-control" required name="adults" id="guest"> 
                      <option value="">Select</option>
                        <option value="1">1</option> 
                        <option value="2" selected>2</option> 
                        <option value="3">3</option> 
                    </select> 
                 </div> 
              </div> 
             <div class="col-md-1 col-sm-6 col-xs-6"> 
                <div class="form-group"> 
                  <div class="clearfix"></div> 
                      <label class="control-label go-right"><!--<i class="icon-user-7"></i>--> <?php echo trans('011');?></label> 
                        <select class="form-control childcount"  name="child" id="child"> 
                          <option value="">Select</option> 
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option> 
                        </select> 
                    </div> 
                </div>
                
              <div class="col-md-2 col-sm-6 col-xs-6 rating-new"> 
                <div class="form-group"> 
                  <div class="clearfix"></div> 
                      <div class="rating">Rating</div> 
                        <span class="starRating">
                        <input id="rating5" type="radio" name="rating" value="5">
                        <label for="rating5">5</label>
                        <input id="rating4" type="radio" name="rating" value="4">
                        <label for="rating4">4</label>
                        <input id="rating3" type="radio" name="rating" value="3" checked>
                        <label for="rating3">3</label>
                        <input id="rating2" type="radio" name="rating" value="2">
                        <label for="rating2">2</label>
                        <input id="rating1" type="radio" name="rating" value="1">
                        <label for="rating1">1</label>
      					</span> 
                    </div> 
                </div>  
                
                
                <div class="col-md-2 col-sm-6 col-xs-6 refine"> 
                  <div class="form-group"> 
                      <div class="clearfix"></div> 
                        <label class="control-label">&nbsp;</label> 
                        <input type="hidden" name="childages" id="childages" value=""> 
                        <input type="hidden" name="search" value="search" > 
                        <button type="submit" class="btn-action btn btn-sm btn-block"><!--<i class="icon_set_1_icon-78"></i>--> Tarzan Go!</button> 
                     </div> 
                </div> 
                <input type="hidden" id="lat1" name="lat">
            <input type="hidden" id="long1" name="long">
         </form> 
    <script> 
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
         
        console.log(place.geometry.location.lat());
        console.log(place.geometry.location.lng());
       
        document.getElementById("lat").value = place.geometry.location.lat();
        document.getElementById("long").value = place.geometry.location.lng();
        }
      }
        }); 
        </script> 
    
        <div class="clearfix"></div> 
  <?php } ?>
    <?php if(pt_main_module_available('ean')){ ?> 
  <script type="text/javascript"> 
  $(function() {
    $(".childcount").on("change", function() {
        var count = $(this).val();
        var ages = [];
        if (count > 0) {
            for (i = 1; i <= count; i++) {
                ages.push('0');
            }
            $("#childages").val(ages);
            $(".ageselect").empty();
            //addChildsAgeField(count);
            //$("#ages").modal('show');
        } else {
            $("#childages").val("");
        }
    })
});

function addChildsAgeField(children) {
    var childagestxt = '';
    for (child = 1; child <= children; child++) {
        var StringChildAge = '';
        StringChildAge = '\ <label for="form-input-popover" class="col-sm-4 control-label">' + child + ' Age</label><div class="col-sm-8">\n\ <select class="room-child-age form-control" onchange="updateChildAges();">\n\ <option value="0"> Under 1 </option>\n\ <option value="1">1</option>\n\ <option value="2">2</option>\n\ <option value="3">3</option>\n\ <option value="4">4</option>\n\ <option value="5">5</option>\n\ <option value="6">6</option>\n\ <option value="7">7</option>\n\ <option value="8">8</option>\n\ <option value="9">9</option>\n\ <option value="10">10</option>\n\ <option value="11">11</option>\n\ <option value="12">12</option>\n\ <option value="13">13</option>\n\ <option value="14">14</option>\n\ <option value="15">15</option>\n\ <option value="16">16</option>\n\ <option value="17">17</option>\n\ </select></div>';
        $(".ageselect").append(StringChildAge);
    }
}

function updateChildAges() {
    var selectedAges = [];
    $('.room-child-age option:selected').each(function() {
        selectedAges.push($(this).val());
    });
    $("#childages").val(selectedAges);
}
/*$(function() {
    $(".childcount").on("change", function() {
        var count = $(this).val();
        var ages = [];
        if (count > 0) {
            for (i = 1; i <= count; i++) {
                ages.push('0');
            }
            $("#childages").val(ages);
            $(".ageselect").empty();
            addChildsAgeField(count);
            $("#ages").modal('show');
        } else {
            $("#childages").val("");
        }
    })
});*/

function addChildsAgeField(children) {
    var childagestxt = '';
    for (child = 1; child <= children; child++) {
        var StringChildAge = '';
        StringChildAge = '\ <label for="form-input-popover" class="col-sm-4 control-label">' + child + ' Age</label><div class="col-sm-8">\n\ <select class="room-child-age form-control" onchange="updateChildAges();">\n\ <option value="0"> Under 1 </option>\n\ <option value="1">1</option>\n\ <option value="2">2</option>\n\ <option value="3">3</option>\n\ <option value="4">4</option>\n\ <option value="5">5</option>\n\ <option value="6">6</option>\n\ <option value="7">7</option>\n\ <option value="8">8</option>\n\ <option value="9">9</option>\n\ <option value="10">10</option>\n\ <option value="11">11</option>\n\ <option value="12">12</option>\n\ <option value="13">13</option>\n\ <option value="14">14</option>\n\ <option value="15">15</option>\n\ <option value="16">16</option>\n\ <option value="17">17</option>\n\ </select></div>';
        $(".ageselect").append(StringChildAge);
    }
}

function updateChildAges() {
    var selectedAges = [];
    $('.room-child-age option:selected').each(function() {
        selectedAges.push($(this).val());
    });
    $("#childages").val(selectedAges);
} 
    
    
    </script> <!-- Modal --> 
    
    
    <div class="modal fade" id="ages" tabindex="1" role="dialog" aria-hidden="true" style="margin-top:50px"> 
      <div class="modal-dialog modal-sm" style="z-index: 9999;"> 
          <div class="modal-content"> 
              <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
                <h4 class="modal-title" id="myModalLabel"><?php echo trans('011');?></h4> 
            </div> 
            <div class="modal-body"> 
              <div class="form-group form-horizontal ageselect"> </div> 
              <div class="clearfix"></div> 
            </div> <div class="modal-footer"> 
            <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo trans('0233');?></button> 
         </div> </div> </div> </div> <?php } ?>
            </div>
            <!-- Expedia Hotels  -->

            <!-- Dohop Flights  -->
            <div  role="tabpanel" class="tab-pane fade <?php pt_searchbox('Flightsdohop'); ?>" id="DOHOP" aria-labelledby="home-tab">
            <?php if(pt_main_module_available('flightsdohop')){ ?> <form action="//whitelabel.dohop.com/w/<?php echo $dohopusername;?>/" method="GET" target="_blank"> <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 go-right"> <div class="form-group"> <select name="" id="trip" class="selectx"> <option value="1"><?php echo trans('0384');?></option> <option value="2"><?php echo trans('0385');?></option> </select> </div> </div> <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 go-right"> <div class="form-group"> <label class="opensans size13 go-right"><b><i class="fa fa-plane"></i> <?php echo trans('0119');?></b></label> <input required id="a1" name="a1" type="text" class="form-control RTL search-location form-control-icon sterm" placeholder="<?php echo trans('0273');?>" autocomplete="off" required /> <div id="a1resp" class="autosuggest col-md-11 col-sm-11"></div> </div> </div> <div style="margin-bottom: 10px;" class="col-md-12 col-lg-12 col-xs-12 col-sm-12 go-right"> <label class="opensans size13 go-right"><b><i style="position:absolute; -webkit-transform: rotate(181deg);-moz-transform: rotate(181deg);-o-transform: rotate(181deg);writing-mode: lr-tb;" class="fa fa-plane"></i> <span style="margin-left:14px"><?php echo trans('0120');?></span></b></label> <input required id="a2" name="a2" type="text" class="form-control RTL search-location form-control-icon sterm" placeholder="<?php echo trans('0274');?>" autocomplete="off" required /> <div id="a2resp" class="autosuggest col-md-11 col-sm-11"></div> </div> <div class="clearfix"></div> <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12"> <div class="w50percent"> <div class="wh90percent textleft"> <span class="opensans size13 go-right"><b><?php echo trans('0472');?></b></span> <input type="text" class="form-control mySelectCalendar go-text-left checkinsearch RTL dpfd1" name="d1" value="" placeholder="<?php echo trans('08');?>" required /> </div> </div> <div class="w50percentlast selectReturn"> <div class="wh90percent textleft right"> <span class="opensans size13 go-right"><b><?php echo trans('0473');?></b></span> <input type="text" class="returnDate form-control mySelectCalendar checkinsearch RTL dpfd2 go-text-left" name="d2" value="" placeholder="<?php echo trans('08');?>" disabled /> </div> </div> </div> <div class="clearfix"></div> <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 go-right"> <div class="form-group"> <div class="clearfix"></div> <label class="control-label">&nbsp;</label> <div class="clearfix"></div> <input type="submit" value="<?php echo trans('012');?>" class="btn-action btn btn-lg btn-block"> </div> </div> </form> <div class="clearfix"></div> <?php } ?> <script type="text/javascript"> $(function(){ $(".selectReturn").hide(); $("#trip").on("change",function(){ var tripVal = $(this).val(); if(tripVal == "1"){ $(".selectReturn").hide(); $(".returnDate").prop("disabled","disabled"); }else{ $(".returnDate").prop("disabled",""); $(".selectReturn").show(); } }) }) </script>
            </div>
            <!-- Dohop Flights  -->

            <!-- Tours  -->
            <div  role="tabpanel" class="tab-pane fade <?php pt_searchbox('tours'); ?>" id="TOURS" aria-labelledby="home-tab">
            <?php if(pt_main_module_available('tours')){ ?> <form method="GET" action="<?php echo base_url();?>tours/search"> <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12 go-right"> <div class="form-group"> <label class="control-label go-right size13"><?php echo trans('0254');?></label> <select name="location" class="chosen-select RTL" id="location" required > <option><?php echo trans('0447');?></option> <?php foreach($locationsList as $locations): ?> <option value="<?php echo $locations->id;?>"><?php echo $locations->name;?></option> <?php endforeach; ?> </select> </div> </div> <br> <div class="clearfix"></div> <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12 go-righ"> <div class="form-group"> <label class="go-right size13"><?php echo trans('0222');?></label> <select class="selectx RTL" name="type" id="tourtype" required > <option value=""> <?php echo trans('0158');?></option> </select> </div> </div> <br> <div class="clearfix"></div> <div class="col-md-6 col-sm-6 col-xs-6 go-right"> <div class="form-group"> <label class="go-right size13"> <?php echo trans('08');?></label> <input type="text" class="form-control mySelectCalendar go-text-left" name="date" id="tchkin" name="checkout" placeholder="<?php echo trans('08');?>" value="<?php echo $checkin; ?>" required> </div> </div> <div class="col-md-6"> <div class="form-group"> <label class="go-right size13"> <?php echo trans('0446');?></label> <select class="form-control" name="adults"> <option >0</option> <option>1</option> <option selected>2</option> <option>3</option> <option>4</option> <option>5</option> </select> </div> </div> <div class="clearfix"></div> <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 go-right"> <div class="form-group"> <div class="clearfix"></div> <label class="control-label">&nbsp;</label> <br> <div class="clearfix"></div> <button type="submit" class="btn-action btn btn-lg btn-block"><i class="icon_set_1_icon-78"></i> <?php echo trans('012');?></button> </div> </div> </form> <div class="clearfix"></div> <?php } ?>
            </div>
            <!-- Tours  -->

            <!-- Cars  -->
            <div  role="tabpanel" class="tab-pane fade <?php pt_searchbox('cars'); ?>" id="CARS" aria-labelledby="home-tab">
            <?php if(pt_main_module_available('cars')){ ?> <form method="GET" action="<?php echo base_url();?>cars/search"> <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12 go-right"> <div class="form-group"> <label class="control-label go-right"><i class="icon_set_1_icon-21"></i> <?php echo trans('0210');?></label> <select name="pickupLocation" class="chosen-select RTL" id="carlocations" required > <option><?php echo trans('0447');?></option> <?php foreach($carspickuplocationsList as $locations): ?> <option value="<?php echo $locations->id;?>"><?php echo $locations->name;?></option> <?php endforeach; ?> </select> </div> </div> <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12"> <div class="form-group"> <label class="control-label go-right"><i class="icon_set_1_icon-21"></i> <?php echo trans('0211');?></label> <select name="dropoffLocation" class="chosen-select RTL" id="carlocations2" required > <option><?php echo trans('0447');?></option> <?php foreach($carsdropofflocationsList as $locations): ?> <option value="<?php echo $locations->id;?>"><?php echo $locations->name;?></option> <?php endforeach; ?> </select> </div> </div> <div class="col-md-6 col-sm-6 col-xs-6 go-right"> <div class="form-group"> <div class="clearfix"></div> <label class="control-label go-right"><i class="icon-calendar-7"></i> <?php echo trans('0210');?> <?php echo trans('08');?></label> <input type="text" class="form-control RTL" id="departcar" name="pickupDate" placeholder="<?php echo trans('08');?>" value="<?php echo $checkin; ?>" required> </div> </div> <div class="col-md-6 col-sm-6 col-xs-6 go-right"> <div class="form-group"> <div class="clearfix"></div> <label class="control-label go-right"><i class="icon_set_1_icon-38"></i> <?php echo trans('0210');?> <?php echo trans('0259');?></label> <select class="form-control" name="pickupTime"> <?php foreach($carModTiming as $time){ ?> <option value="<?php echo $time; ?>" <?php makeSelected('10:00',$time); ?> ><?php echo $time; ?></option> <?php } ?> </select> </div> </div> <div class="col-md-6 col-sm-6 col-xs-6 go-right"> <div class="form-group"> <div class="clearfix"></div> <label class="control-label go-right"><i class="icon-calendar-7"></i> <?php echo trans('0211');?> <?php echo trans('08');?></label> <input type="text" class="form-control RTL" id="returncar" name="dropoffDate" placeholder="<?php echo trans('08');?>" value="<?php echo $checkin; ?>" required> </div> </div> <div class="col-md-6 col-sm-6 col-xs-6 go-right"> <div class="form-group"> <div class="clearfix"></div> <label class="control-label go-right"><i class="icon_set_1_icon-38"></i> <?php echo trans('0211');?> <?php echo trans('0259');?></label> <select class="form-control" name="dropoffTime"> <?php foreach($carModTiming as $time){ ?> <option value="<?php echo $time; ?>" <?php makeSelected('10:00',$time); ?> ><?php echo $time; ?></option> <?php } ?> </select> </div> </div> <!--<div class="col-md-6 col-sm-6 col-xs-6 go-right"> <div class="form-group"> <label class="go-right"><i class="icon-thumbs-up-4"></i> <?php echo trans('0214');?></label> <select class="form-control selectx" name="type" id="cartype" > <option value=""> <?php echo trans('0158');?></option> <?php foreach($cartypes as $ctype){ ?> <option value="<?php echo $ctype->id; ?>"><?php echo $ctype->name; ?></option> <?php } ?> </select> </div> </div> <div class="col-md-6 col-sm-6 col-xs-6 go-right"> <div class="form-group"> <label class="go-right"><i class="icon-paper-plane-2"></i> <?php echo trans('0207');?></label> <select name="pickup" class="form-control selectx"> <option value=""><?php echo trans('0158');?></option> <option value="yes"><?php echo trans('0363');?></option> <option value="no"><?php echo trans('0364');?></option> </select> </div> </div>--> <div class="clearfix"></div> <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12"> <div class="form-group"> <button type="submit" class="btn-action btn btn-lg btn-block"><i class="icon_set_1_icon-78"></i> <?php echo trans('012');?></button> </div> </div> <div class="clearfix"></div> </form> <?php } ?>
            </div>
            <!-- Cars  -->

            <!-- Cartrawler  -->
            <div  role="tabpanel" class="tab-pane fade <?php pt_searchbox('cartrawler'); ?>" id="CARTRAWLER" aria-labelledby="home-tab">
            <?php if(pt_main_module_available('cartrawler')){ ?> <form action="<?php echo base_url();?>car/" method="GET" target="_self"> <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12"> <div class="form-group"> <label class="control-label go-right"><i class="icon_set_1_icon-21"></i> <?php echo trans('0210');?></label> <input required id="ct1" name="startlocation" type="text" class="form-control RTL search-location form-control-icon ctlocation" placeholder="<?php echo trans('0210');?>" autocomplete="off" required /> <div id="ct1resp" class="autosuggest col-md-11 col-sm-11"></div> </div> </div> <div class="col-md-6 col-sm-6 col-xs-6 go-right"> <div class="form-group"> <div class="clearfix"></div> <label class="control-label go-right"><i class="icon-calendar-7"></i> <?php echo trans('0472');?></label> <input type="text" class="form-control-icon form-control checkinsearch RTL icon-calendar dpcd1" name="pickupdate" value="" placeholder="<?php echo trans('08');?>" required /> </div> </div> <div class="col-md-6 col-sm-6 col-xs-6 go-right"> <div class="form-group"> <div class="clearfix"></div> <label class="control-label go-right"><i class="icon_set_1_icon-38"></i> <?php echo trans('0259');?></label> <select class="form-control" name="timeDepart"> <?php foreach($timing as $time){ ?> <option value="<?php echo $time; ?>" <?php makeSelected('10:00',$time); ?> ><?php echo $time; ?></option> <?php } ?> </select> </div> </div> <div class="clearfix"></div> <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12"> <div class="form-group"> <label class="control-label go-right"><i class="icon_set_1_icon-21"></i> <?php echo trans('0211');?></label> <input id="ct2" name="endlocation" type="text" class="form-control RTL search-location form-control-icon ctlocation" placeholder="<?php echo trans('0211');?>" autocomplete="off" /> <div id="ct2resp" class="autosuggest col-md-11 col-sm-11"></div> </div> </div> <div class="col-md-6 col-sm-6 col-xs-6 go-right"> <div class="form-group"> <div class="clearfix"></div> <label class="control-label go-right"><i class="icon-calendar-7"></i> <?php echo trans('0473');?></label> <input type="text" class="form-control-icon form-control checkinsearch RTL icon-calendar dpcd2" name="dropoffdate" value="" placeholder="<?php echo trans('08');?>" required /> </div> </div> <div class="col-md-6 col-sm-6 col-xs-6 go-right"> <div class="form-group" > <div class="clearfix"></div> <label class="control-label go-right"><i class="icon_set_1_icon-38"></i> <?php echo trans('0259');?></label> <select class="form-control" name="timeReturn"> <?php foreach($timing as $time){ ?> <option value="<?php echo $time; ?>" <?php makeSelected('10:00',$time); ?> ><?php echo $time; ?></option> <?php } ?> </select> </div> </div> <div class="clearfix"></div> <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 form-group"> <div class="clearfix"></div> <input type="hidden" id="pickuplocation" name="pickupLocationId" value=""> <input type="hidden" id="returnlocation" name="returnLocationId" value=""> <input type="hidden" name="clientId" value="<?php echo $cartrawlerid;?>"> <input type="hidden" name="residencyId" value="PK"> <input type="submit" value="<?php echo trans('012');?>" class="btn-action btn btn-lg btn-block"> </div> </form> <div class="clearfix"></div> <?php } ?>
            </div>
            <!-- Cartrawler  -->

            </div>
        </div>
        </div>
        <div class="clearfix"></div>
        </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.carousel').carousel({
      interval: 9000
    })
  });
</script>