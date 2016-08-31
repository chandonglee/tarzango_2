<link href="<?php echo $theme_url; ?>assets/include/slider/slider.min.css" rel="stylesheet" />
<script src="<?php echo $theme_url; ?>assets/js/single.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/jquery.nicescroll.min.js"></script>
<script src="<?php echo $theme_url; ?>assets/include/slider/slider.js"></script>
<script src="<?php echo $theme_url; ?>assets/js/infobox.js"></script>
<div class="mtslide2 sliderbg2"></div>
<!-- head -->
<div class="container">
  <div class="row">
    <div class="col-md-7 go-right">
      <h2 class="go-right"><strong><?php echo character_limiter($module->title, 28);?></strong></h2>
      <div class="clearfix"></div>
      <h4 class="go-right RTL"><i class="icon-location-6"></i> <?php echo $module->location; ?>  <?php echo $module->stars;?>
      <br>&nbsp;<small><?php echo $module->hotelAddress; ?></small></h4>

    </div>
    <div class="col-md-5">
      <div class="row">
        <div class="visible-lg visible-md col-md-6 go-right" style="margin-top:10px">
          <?php if($hasRooms){ ?>
          <h3><small class="go-text-right"><?php echo trans('070');?></small> <?php echo @$currencySign; ?><?php echo @$lowestPrice; ?> <small class="go-text-left"><?php echo trans('0141');?></small></h3>
          <?php } ?>
        </div>
        <div class="col-md-6 go-left" style="margin-top:20px">
          <a class="btn btn-action pull-right btn-block" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap"><?php echo trans('067');?></a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- head -->
<!-- map -->
<div class="collapse" id="collapseMap">
  <div id="map" class="map"></div>
  <br>
  <script>$('#collapseMap').on('shown.bs.collapse',function(e){(function(A){if(!Array.prototype.forEach)
    A.forEach=A.forEach||function(action,that){for(var i=0,l=this.length;i<l;i++)
    if(i in this) action.call(that,this[i],i,this);}})(Array.prototype);var mapObject,markers=[],markersData={'marker':[{name:'<?php echo character_limiter($module->title, 80);?>',location_latitude:<?php echo $module->latitude;?>,location_longitude:<?php echo $module->longitude;?>,map_image_url:'<?php echo $module->thumbnail;?>',name_point:'<?php echo character_limiter($module->title, 80);?>',description_point:'<?php echo character_limiter(strip_tags(trim($item->desc)),100);?>',url_point:'<?php echo $module->slug;?>'},<?php foreach($module->relatedItems as $item):?>{name:'hotel name',location_latitude:"<?php echo $item->latitude;?>",location_longitude:"<?php echo $item->longitude;?>",map_image_url:"<?php echo $item->thumbnail;?>",name_point:"<?php echo $item->title;?>",description_point:'<?php echo character_limiter(strip_tags(trim($item->desc)),100);?>',url_point:"<?php echo $item->slug;?>"},<?php endforeach;?>]};var mapOptions={zoom:14,center:new google.maps.LatLng(<?php echo $module->latitude;?>,<?php echo $module->longitude;?>),mapTypeId:google.maps.MapTypeId.ROADMAP,mapTypeControl:!1,mapTypeControlOptions:{style:google.maps.MapTypeControlStyle.DROPDOWN_MENU,position:google.maps.ControlPosition.LEFT_CENTER},panControl:!1,panControlOptions:{position:google.maps.ControlPosition.TOP_RIGHT},zoomControl:!0,zoomControlOptions:{style:google.maps.ZoomControlStyle.LARGE,position:google.maps.ControlPosition.TOP_RIGHT},scrollwheel:!1,scaleControl:!1,scaleControlOptions:{position:google.maps.ControlPosition.TOP_LEFT},streetViewControl:!0,streetViewControlOptions:{position:google.maps.ControlPosition.LEFT_TOP},styles:[]};var marker;mapObject=new google.maps.Map(document.getElementById('map'),mapOptions);for(var key in markersData)
    markersData[key].forEach(function(item){marker=new google.maps.Marker({position:new google.maps.LatLng(item.location_latitude,item.location_longitude),map:mapObject,icon:'<?php echo base_url(); ?>uploads/global/default/'+key+'.png',});if('undefined'===typeof markers[key])
    markers[key]=[];markers[key].push(marker);google.maps.event.addListener(marker,'click',(function(){closeInfoBox();getInfoBox(item).open(mapObject,this);mapObject.setCenter(new google.maps.LatLng(item.location_latitude,item.location_longitude))}))});function hideAllMarkers(){for(var key in markers)
    markers[key].forEach(function(marker){marker.setMap(null)})};function closeInfoBox(){$('div.infoBox').remove()};function getInfoBox(item){return new InfoBox({content:'<div class="marker_info" id="marker_info">'+'<img style="width:280px;height:140px" src="'+item.map_image_url+'" alt="<?php echo character_limiter($module->title, 80);?>"/>'+'<h3>'+item.name_point+'</h3>'+'<span>'+item.description_point+'</span>'+'<a href="'+item.url_point+'" class="btn btn-primary"><?php echo trans('0177');?></a>'+'</div>',disableAutoPan:!0,maxWidth:0,pixelOffset:new google.maps.Size(40,-190),closeBoxMargin:'0px -20px 2px 2px',closeBoxURL:"<?php echo $theme_url; ?>assets/img/close.png",isHidden:!1,pane:'floatPane',enableEventPropagation:!0})}});
  </script>
</div>
<!-- map -->
<div id="OVERVIEW" class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel with-nav-tabs panel-default">
        <div class="tabsbar">
          <ul class="RTL visible-lg visible-md nav nav-tabs nav-justified">
            <li class="text-center"><a class="tabsBtn" href="#OVERVIEW" data-toggle="tab"><?php echo trans('0248');?></a></li>
            <?php if(!empty($rooms) > 0){ ?>
            <li class="text-center"><a class="tabsBtn" href="#ROOMS" data-toggle="tab"><?php echo trans('016');?></a></li>
            <?php  } ?>
            <?php if(!empty($module->desc)){ ?>
            <li class="text-center"><a class="tabsBtn" href="#DESCRIPTION" data-toggle="tab"><?php echo trans('046');?></a></li>
            <?php  } ?>
            <?php if(!empty($module->amenities)){ ?>
            <li class="text-center"><a class="tabsBtn" href="#AMENITIES" data-toggle="tab"><?php echo trans('0249');?></a></li>
            <?php  } ?>
            <?php if(!empty($module->inclusions)){ ?>
            <li class="text-center"><a class="tabsBtn" href="#INCLUSIONS" data-toggle="tab"><?php echo trans('0280');?></a></li>
            <?php  } ?>
            <?php if(!empty($module->exclusions)){ ?>
            <li class="text-center"><a class="tabsBtn" href="#EXCLUSIONS" data-toggle="tab"><?php echo trans('0281');?></a></li>
            <?php  } ?>
            <?php if(!empty($reviews) > 0){ ?>
            <li class="text-center"><a class="tabsBtn" href="#REVIEWS" data-toggle="tab"><?php echo trans('0396');?></a></li>
            <?php  } ?>
            <?php if(!empty($module->relatedItems)){ ?>
            <li class="text-center"><a class="tabsBtn" href="#RELATED" data-toggle="tab"><?php if($appModule == "hotels" || $appModule == "ean"){ echo trans('0290'); }else if($appModule == "tours"){ echo trans('0453'); }else if($appModule == "cars"){ echo trans('0493'); } ?></a></li>
            <?php  } ?>
          </ul>
        </div>
        <div style="padding:10px">
          <div class="row">
            <!-- slider -->
            <div class="col-md-7 go-right">
              <div class="fotorama bg-dark" data-allowfullscreen="true" data-nav="thumbs">
                <?php foreach($module->sliderImages as $img){ ?>
                <img src="<?php echo $img['fullImage']; ?>" />
                <?php } ?>
              </div>
              <div class="visible-xs visible-sm">
                <div style="margin-top:25px"></div>
              </div>
            </div>
            <!-- slider -->
            <!-- aside -->
            <div class="col-md-5 go-right">
              <!-- Start Review Total -->
              <?php if($appModule != "cars" && $appModule != "ean"){ ?>
              <div class="col-xs-5 col-sm-3 col-md-5 row col-lg-4 go-right">
                <div class="reviews text-center"><?php echo $avgReviews->totalReviews; ?> <?php echo trans('042');?></div>
                <div class="c100 p<?php echo $avgReviews->overall * 10;?>" style="margin-top:10px">
                  <span><strong><?php echo $avgReviews->overall;?> </strong>/<small>10</small></span>
                  <div class="slice">
                    <div class="bar"></div>
                    <div class="fill"></div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <?php } ?>
              <!-- End Review Total -->
              <!-- Start Hotel Reviews bars -->
              <?php if($appModule == "hotels"){ ?>
              <div class="row go-lwft">
                <div class="col-xs-7 col-sm-9 col-md-7 col-lg-8">
                  <div class="col-xs-2 col-md-3 col-lg-2">
                    <label class="text-left"><?php echo trans('030');?> </label>
                  </div>
                  <div class="col-xs-9 col-md-9 col-lg-10">
                    <div class="progress">
                      <div class="progress-bar progress-bar-primary go-right" role="progressbar" aria-valuenow="20"
                        aria-valuemin="0" aria-valuemax="10" style="width: <?php echo $avgReviews->clean * 10;?>%">
                        <span class="sr-only"></span>
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-xs-2 col-md-3 col-lg-2">
                    <label class="text-left"><?php echo trans('031');?></label>
                  </div>
                  <div class="col-xs-9 col-md-9 col-lg-10">
                    <div class="progress">
                      <div class="progress-bar progress-bar-primary go-right" role="progressbar" aria-valuenow="20"
                        aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $avgReviews->comfort * 10;?>%">
                        <span class="sr-only"></span>
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-xs-2 col-md-3 col-lg-2">
                    <label class="text-left"><?php echo trans('032');?></label>
                  </div>
                  <div class="col-xs-9 col-md-9 col-lg-10">
                    <div class="progress">
                      <div class="progress-bar progress-bar-primary go-right" role="progressbar" aria-valuenow="20"
                        aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $avgReviews->location * 10;?>%">
                        <span class="sr-only"></span>
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-xs-2 col-md-3 col-lg-2">
                    <label class="text-left"><?php echo trans('033');?></label>
                  </div>
                  <div class="col-xs-9 col-md-9 col-lg-10">
                    <div class="progress">
                      <div class="progress-bar progress-bar-primary go-right" role="progressbar" aria-valuenow="20"
                        aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $avgReviews->facilities * 10;?>%">
                        <span class="sr-only"></span>
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-xs-2 col-md-3 col-lg-2">
                    <label class="text-left"><?php echo trans('034');?></label>
                  </div>
                  <div class="col-xs-9 col-md-9 col-lg-10">
                    <div class="progress">
                      <div class="progress-bar progress-bar-primary go-right" role="progressbar" aria-valuenow="80"
                        aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $avgReviews->staff * 10;?>%">
                        <span class="sr-only"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php } ?>
              <!-- End Hotel Reviews bars -->
              <?php include 'tripadvisor.php';?>
              <!-- Start aside Short Description -->
              <?php if($appModule == "hotels"){ ?>
              <span class="RTL"><?php echo character_limiter($module->desc, 660);?> <a href="#DESCRIPTION" class="tabsBtn text-primary"><strong><?php echo trans('0286');?></strong></a></span>
              <br><br>
              <div class="clearfix"></div>
              <?php } ?>
              <!-- End aside Short Description -->
              <!-- Start Tour Form aside -->
              <?php if($appModule == "tours"){ ?>
              <div class="col-xs-5 col-sm-3 col-md-7 row col-lg-9 go-right pull-right go-left">
                <form action="" method="GET" >
                  <div class="panel panel-default">
                    <div class="panel-heading"><?php echo trans('0158');?> <?php echo trans('08');?></div>
                    <div class="panel-body">
                      <input id="tchkin" name="date" value="<?php echo $module->date; ?>" placeholder="date" type="text" class="form-control form-group" placeholder="<?php echo trans('012');?>">
                      <button type="submit" class="btn btn-block btn-warning pull-right"><?php echo trans('0454');?></button>
                    </div>
                  </div>
                </form>
              </div>
              <form  action="<?php echo base_url().$appModule;?>/book/<?php echo $module->slug;?>" method="GET" role="search">
                <input type="hidden" name="date" value="<?php echo $module->date;?>">
                <table style="width:100%" class="table table-bordered">
                  <?php if(!empty($modulelib->error)){ ?>
                  <div class="alert alert-danger go-text-right">
                    <?php echo trans($modulelib->errorCode); ?>
                  </div>
                  <?php } ?>
                  <thead>
                    <tr>
                      <th  style="line-height: 1.428571;"><?php echo trans('068');?></th>
                      <th style="line-height: 1.428571;"><?php echo trans('0450');?></th>
                      <th  style="line-height: 1.428571;" class="text-center"><?php echo trans('070');?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if($module->adultStatus){ ?>
                    <tr>
                      <th scope="row"><?php echo trans('010');?> <span class="weak"><?php echo $module->currSymbol;?><?php echo $module->perAdultPrice;?></span></th>
                      <td>
                        <select name="adults" class="selectx changeInfo input-sm" id="selectedAdults">
                          <?php for($adults = 1; $adults <= $module->maxAdults; $adults++){ ?>
                          <option value="<?php echo $adults;?>" <?php echo makeSelected($selectedAdults, $adults); ?>><?php echo $adults;?></option>
                          <?php } ?>
                        </select>
                      </td>
                      <td class="text-center adultPrice"><?php echo $module->currSymbol;?><?php echo $module->adultPrice;?></td>
                    </tr>
                    <?php } if($module->childStatus){ ?>
                    <tr>
                      <th scope="row"><?php echo trans('011');?> <span class="weak"><?php echo $module->currSymbol;?><?php echo $module->perChildPrice;?></span></th>
                      <td>
                        <select name="child" class="selectx changeInfo input-sm" id="selectedChild">
                          <option value="0">0</option>
                          <?php for($child = 1; $child <= $module->maxChild; $child++){ ?>
                          <option value="<?php echo $child;?>" <?php echo makeSelected($selectedChild, $child); ?> ><?php echo $child;?></option>
                          <?php } ?>
                        </select>
                      </td>
                      <td class="text-center childPrice"><?php echo $module->currSymbol;?><?php echo $module->childPrice;?></td>
                    </tr>
                    <?php } if($module->infantStatus){  ?>
                    <tr>
                      <th scope="row"><?php echo trans('0282');?> <span class="weak"><?php echo $module->currSymbol;?><?php echo $module->perInfantPrice;?></span></th>
                      <td>
                        <select name="infant" class="selectx changeInfo input-sm" id="selectedInfants">
                          <option value="0">0</option>
                          <?php for($infant = 1; $infant <= $module->maxInfant; $infant++){ ?>
                          <option value="<?php echo $infant;?>" <?php echo makeSelected($selectedInfants, $infant); ?> ><?php echo $infant;?></option>
                          <?php } ?>
                        </select>
                      </td>
                      <td class="text-center infantPrice"><?php echo $module->currSymbol;?><?php echo $module->infantPrice;?></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
                <div class="row">
                  <div class="col-md-6">
                    <h4 class="well well-sm text-center size20" style="margin-top: 4px; margin-bottom: 14px;"><span style="color:#333333;" class="totalCost"><?php echo $module->currCode;?> <?php echo $module->currSymbol;?><strong><?php echo $module->totalCost;?></strong></span><br>
                      <small style="font-size: 12px;"> <?php echo trans('0126');?> <span class="totaldeposit"> <?php echo $module->currCode;?> <?php echo $module->currSymbol;?><?php echo $module->totalDeposit;?></span> </small>
                    </h4>
                  </div>
                  <div class="col-md-6">
                    <button style="height: 64px; margin: 3px;" type="submit" class="btn btn-block btn-action btn-lg"><?php echo trans('0142');?></button>
                  </div>
                </div>
              </form>
              <?php } ?>
              <!-- End Tour Form aside -->
              <!-- Start Car From aside -->
              <?php if($appModule == "cars"){ ?>
              <form  class="form-horizontal" action="<?php echo base_url().$appModule;?>/book/<?php echo $module->slug;?>" method="GET" role="search">
                <div class="row form-group">
                  <div class="col-md-4 col-xs-4">
                    <label class="control-label go-right"><i class="icon_set_1_icon-21"></i> <?php echo trans('0210');?></label>
                  </div>
                  <div class="col-md-8 col-xs-4">
                    <select name="pickupLocation" class="chosen-select RTL selectLoc" id="pickuplocation" required>
                      <option value=""><?php echo trans('0447');?></option>
                      <?php foreach($carspickuplocationsList as $locations): ?>
                      <option value="<?php echo $locations->id;?>" <?php echo makeSelected($selectedpickupLocation, $locations->id); ?> ><?php echo $locations->name;?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-4 col-xs-4">
                    <label class="control-label go-right"><i class="icon_set_1_icon-21"></i> <?php echo trans('0211');?></label>
                  </div>
                  <div class="col-md-8 col-xs-4">
                    <select name="dropoffLocation" class="chosen-select RTL selectLoc" id="droplocation" required>
                      <option value=""><?php echo trans('0447');?></option>
                      <?php if(!empty($selecteddropoffLocation)){ foreach($carsdropofflocationsList as $locations): ?>
                      <option value="<?php echo $locations->id;?>" <?php echo makeSelected($selecteddropoffLocation, $locations->id); ?> ><?php echo $locations->name;?></option>
                      <?php endforeach; } ?>
                    </select>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-5 col-xs-12">
                    <label class="control-label go-right"><i class="icon_set_1_icon-53"></i> <?php echo trans('0210');?> <?php echo trans('08');?></label>
                  </div>
                  <div class="col-md-7 col-xs-12">
                    <input id="departcar" name="pickupDate" value="<?php echo $module->pickupDate;?>" placeholder="date" type="text" class="form-control carDates" required>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-5 col-xs-12">
                    <label class="control-label go-right"><i class="icon_set_1_icon-52"></i> <?php echo trans('0210');?> <?php echo trans('0259');?></label>
                  </div>
                  <div class="col-md-7 col-xs-12">
                    <select class="form-control input" name="pickupTime">
                      <?php foreach($carModTiming as $time){ ?>
                      <option value="<?php echo $time; ?>" <?php makeSelected($pickupTime,$time); ?> ><?php echo $time; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-5 col-xs-12">
                    <label class="control-label go-right"><i class="icon_set_1_icon-53"></i> <?php echo trans('0211');?> <?php echo trans('08');?></label>
                  </div>
                  <div class="col-md-7 col-xs-12">
                    <input id="returncar" name="dropoffDate" value="<?php echo $module->dropoffDate;?>" placeholder="date" type="text" class="form-control carDates" required>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-5 col-xs-12">
                    <label class="control-label go-right"><i class="icon_set_1_icon-52"></i> <?php echo trans('0211');?> <?php echo trans('0259');?></label>
                  </div>
                  <div class="col-md-7 col-xs-12">
                    <select class="form-control input" name="dropoffTime">
                      <?php foreach($carModTiming as $time){ ?>
                      <option value="<?php echo $time; ?>" <?php makeSelected($dropoffTime,$time); ?> ><?php echo $time; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <hr>
                <input type="hidden" id="cartotals" value="<?php echo $module->showTotal; ?>">
                <div class="showTotal">
                <div class="mtb0 col-md-5  col-xs-6 well well-sm text-center">
                  <h4 style="" class="totalCost"><?php echo trans('078');?> <?php echo $module->currCode;?> <?php echo $module->currSymbol;?><strong><span class="grandTotal"><?php echo $module->totalCost;?></span></strong></h4>
                </div>
                <div class="col-md-5  col-xs-6 h4">
                  <small> <?php echo trans('0153');?>  <?php echo $module->currCode;?> <?php echo $module->currSymbol;?><span class="totalTax"> <?php echo $module->taxAmount;?></span> </small>
                  <div class="clearfix"></div>
                  <small> <?php echo trans('0126');?>  <?php echo $module->currCode;?> <?php echo $module->currSymbol;?><span class="totaldeposit"> <?php echo $module->totalDeposit;?></span> </small>
                </div>
                </div>
                <div class="clearfix"></div>
                <hr style="margin-top: 5px; margin-bottom: 12px;">
                <div class="row">
                  <div class="col-md-6">
                    <button type="submit" class="btn btn-block btn-primary btn-lg"><?php echo trans('0142');?></button>
                  </div>
              </form>
              <?php } ?>
              <!-- End  Car From aside -->
              <input type="hidden" id="loggedin" value="<?php echo $usersession;?>" />
              <input type="hidden" id="itemid" value="<?php echo $module->id; ?>" />
              <input type="hidden" id="module" value="<?php echo $appModule;?>" />
              <input type="hidden" id="addtxt" value="<?php echo trans('029');?>" />
              <input type="hidden" id="removetxt" value="<?php echo trans('028');?>" />
              <!-- Start Add/Remove Wish list Review Section -->
              <div class="row">
              <div  <?php if($appModule == "cars"){ ?>class="col-md-6" <?php } ?> >
              <?php if($appModule != "cars" && $appModule != "ean"){ ?>
              <div class="col-md-6 form-group"><button  data-toggle="collapse" data-parent="#accordion" class="writeReview btn-lg btn btn-success btn-block btn-lgs" href="#ADDREVIEW"><i class="icon_set_1_icon-68"></i> <?php echo trans('083');?></button></div>
              <?php if(!empty($reviews) > 0){ ?>
              <div class="col-md-6 form-group"><a href="#REVIEWS" class="tabsBtn btn btn-primary btn-lg btn-block btn-lgs"><i class="icon_set_1_icon-93"></i> <?php echo trans('0394');?></a></div>
              <?php } } ?>
              <div class="col-md-12">
              <?php $currenturl = current_url(); $wishlist = pt_check_wishlist($customerloggedin,$module->id,$appModule); if($allowreg){ if($wishlist){ ?>
              <span class="btn wish btn-danger btn-outline btn-lg btn-block removewishlist"><span class="wishtext"><i class=" icon_set_1_icon-82"></i> <?php echo trans('028');?></span></span>
              <?php }else{ ?>
              <span class="btn wish btn-block btn-lg addwishlist btn-danger"><span class="wishtext"><i class=" icon_set_1_icon-82"></i> <?php echo trans('029');?></span></span>
              <?php } } ?>
              </div>
              </div>
              </div>
              </div>
              <!-- End Add/Remove Wish list Review Section -->
            </div>
            <script>
              $(function(){

                $(".changeInfo").on("change",function(){

                  var tourid = "<?php echo $module->id; ?>";
                  var adults = $("#selectedAdults").val();
                  var child = $("#selectedChild").val();
                  var infants = $("#selectedInfants").val();

                  $.post("<?php echo base_url()?>tours/tourajaxcalls/changeInfo",{tourid: tourid, adults: adults, child: child, infants: infants},function(resp){

                    var result = $.parseJSON(resp);
                    $(".adultPrice").html(result.currSymbol+result.adultPrice);
                    $(".childPrice").html(result.currSymbol+result.childPrice);
                    $(".infantPrice").html(result.currSymbol+result.infantPrice);
                    $(".totalCost").html(result.currCode+" "+result.currSymbol+result.totalCost);
                    $(".totaldeposit").html(result.currCode+" "+result.currSymbol+result.totalDeposit);
                    console.log(result);

                  })

                }); //end of change info


              })// end of document ready

            </script>
            <!-- aside -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php if($appModule != "cars" && $appModule != "ean"){ include 'includes/review.php'; } ?>
</div>
<!-- rooms -->
<?php if($hasRooms > 0){ if($appModule == "hotels"){ include 'includes/rooms.php'; }else if($appModule == "ean"){ include 'includes/expedia_rooms.php'; } }  ?>
<!-- rooms -->
<!-- overview -->
<section class="bg-white">
  <div class="container">
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
        <h4 id="terms" class="main-title  go-right"><?php echo trans('0148');?></h4>
        <div class="clearfix"></div>
        <i class="tiltle-line  go-right"></i>
        <div class="clearfix"></div>
        <span class="RTL">
          <p><?php echo $module->policy; ?></p>
        </span>
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
<section class="bg-white">
  <div class="container">
    <div class="row">
      <hr>
      <div class="clearfix"></div>
      <?php include 'includes/amenities.php';?>
      <div class="visible-xs"><br></div>
      <?php include 'includes/reviews.php';?>
    </div>
    <br>
  </div>
</section>
<!------------------------  Related Listings   ------------------------------>
<?php if(!empty($module->relatedItems)){ ?>
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
<!------------------------  Related Listings   ------------------------------>
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