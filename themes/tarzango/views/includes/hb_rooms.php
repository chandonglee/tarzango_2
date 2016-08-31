<style type="text/css">
  
 .marker_info h3{
	 color:black;
 }
  .btn-primary {
    background: #FFCB05 !important;
    color: #360836 !important;
    font-size: 16px;
    white-space: nowrap;
    border-radius: 0px;
    font-weight: 600;
    text-decoration: none;
    font-family: "OpenSansLight", sans-serif;
}
</style>

<section  id="ROOMS">
  
  <div class="">
    <!--<div class="rooms-update">
      <form  action="" method="GET" role="search">
        <div class="col-md-2 col-sm-2 go-right">
          <div class="form-group">
            <label class="size13 RTL go-right"><i class="icon-calendar-7"></i><?php echo trans('07');?></label>
            <input type="text" placeholder="<?php echo trans('07');?>" name="checkin" class="form-control dpean1" value="<?php echo $checkin;?>" required>
          </div>
        </div>
        <div class="col-md-2 col-sm-2 go-right">
          <div class="form-group">
            <label class="size13 RTL go-right"><i class="icon-calendar-7"></i><?php echo trans('09');?></label>
            <input type="text" placeholder="<?php echo trans('09');?>" name="checkout" class="form-control dpean2" value="<?php echo $checkout;?>" required>
          </div>
        </div>
        <div class="col-lg-1 col-md-2 col-sm-1 go-right">
          <div class="form-group">
            <label class="size13 RTL go-right"><i class="icon-user-7"></i><?php echo trans('010');?></label>
            <select class="mySelectBoxClass form-control" name="adults" id="adults">
             <?php for($i = 1; $i <= $maxAdults;$i++){ ?>
              <option value="<?php echo $i;?>" <?php makeselected($i,$adultsCount); ?> ><?php echo $i;?></option>
            <?php } ?>
            </select>
          </div>
        </div>
        <div class="col-lg-1 col-md-2 col-sm-1 go-right">
          <div class="form-group">
            <label class="size13 RTL go-right"><i class="icon-user-7"></i><?php echo trans('011');?></label>
            <select class="mySelectBoxClass form-control" name="child" id="child">
              <option selected value="0">0</option>
              <?php for($child = 1; $child < 6;$child++){ ?>
              <option value="<?php echo $child;?>" <?php if($child == $childCount){ echo "selected"; } ?>> <?php echo $child;?> </option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="col-md-2 col-lg-3 col-sm-2 go-right">
          <label>&nbsp;</label>
          <input type="hidden" name="ages" id="childages" value="<?php echo $childAges; ?>">
          <button class="btn btn-block btn-update textupper"><?php echo trans('0106');?></button>
        </div>
        <div class="col-md-2 col-lg-3 col-sm-2">
          <?php if(!empty($rooms)){ ?>
          <h4 style="margin-top: 30px;" class="text-center  size20"><strong><i class="icon_set_1_icon-83"></i><?php echo trans('0122');?></strong> <?php echo $hotelslib->stay; ?> </h4>
          <?php } ?>
        </div>
      </form>
      <div class="clearfix"></div>
    </div>-->
   <!--  <div class="col-md-12">
    <h4>Room rate Disclaimer:</h4>
    <span class="size14">
    The room rates listed are for double occupancy per room unless otherwise stated and exclude tax recovery charges and service fees.
    </span>
    </div> -->
    
    <?php if(empty($hb_room)){ echo '<h1 class="text-center">' . trans("066") . '</h1>'; }else{ ?>
    <?php 
	//echo json_encode($hb_room);
    $set_avg_rate = 0;
	foreach($hb_room as $room){ 
	$nightlyRate = $room->rates[0]->net / $diff;
	if(!empty($nightlyRate)){
	 ?>
    <form action="" method="GET">
      <div class="rooms-update">
       <div class="col-lg-8 col-md-8 col-sm-12">
          <div class="img_list">
            <div class="zoom-gallery">
            <?php $c_temp_img = rand(0,count($temp_img) - 1 );
				$roomImg = $temp_img[$c_temp_img];
				$r_arry = array(".","-");
				$code1 = str_replace($r_arry, "", $room->code);
				$close_id =  $room->rates[0]->allotment.$code1;
				 ?>
              <a href="<?php echo $roomImg; ?>" data-source="<?php echo $roomImg; ?>" title="<?php echo $c_temp_img;//$room->name; ?>">
              <img class="lazy_load"  data-src="<?php echo $roomImg; ?>" data-src-retina="<?php echo $roomImg; ?>" src="">
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
          <div class="itemlabel3">
            <div class="labelleft2 rtl_title_home go-text-right RTL">
              <h4 class="mtb0 RTL go-text-right"><?php echo $room->name; ?></h4>
              <h5 style="color:#8A8A8A"><?php echo trans('010');?> <?php echo $room->rates[0]->adults;?> </h5>
              <hr>
              <div class="col-md-3 visible-lg visible-md go-right" id="accordion" style="margin-top: 0px;">
                <div class="row">
                  <?php if($room->rates[0]->rateClass == 'NOR'){ ?>
                  <button data-toggle="collapse" data-parent="#accordion" class="hidden-xs btn btn-danger btn-xs"  href="#nonrefund<?php echo $close_id; ?>"><?php echo trans('0309');?></button>
                  <?php }else{ ?>
                  <span class="hidden-xs btn btn-success btn-xs"><?php echo trans('0344');?></span>
                  <?php } ?>
                  <!--<button data-toggle="collapse" data-parent="#accordion" class="hidden-xs btn btn-warning btn-xs"  href="#details<?php echo $close_id; ?>"><?php echo trans('052');?></button>-->
                </div>
              </div>
              <p class="grey RTL"><?php echo character_limiter($r->desc, 280);?></p>
            </div>
            <div class="labelright go-left">
              <br/>
              <span class="white size28">
              <?php
			        
              $nightlyRate = number_format($room->rates[0]->net / $diff,2);
              if($set_avg_rate == 0){
                  $set_avg_rate = $nightlyRate;
              }else{
                  if($set_avg_rate > $nightlyRate){
                      $set_avg_rate = $nightlyRate;
                  }
              }

              $currency = '$';
              if(empty($nightlyRate)){
              $nightlyRate = 'try again';
              $currency = 'plesae';
              }

              ?>
              <b>
              <small><?php echo $currency; ?>  </small> <?php echo $nightlyRate; ?>
              </b></span><br/><br/>
              <span class="size18 grey"><?php echo trans('0245'); ;?></span>
              <br/>
              <div class="clearfix"></div>
              <hr>
              <div class="book">
                <span <?php if(!empty($loggedin)){ ?> onclick="booknow()" <?php }else{ ?> data-toggle="modal" data-target="#book<?php echo $close_id;?>" <?php } ?> class="btn btn-primary btn-block"><?php echo trans('0142');?></span>
                <br>
              </div>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </form>
    <div class="clearfix"></div>
    <div class="offset-2">
      <hr style="margin-top: 10px; margin-bottom: 10px;">
    </div>
    <!-- refund policy -->

    <div id="nonrefund<?php echo $close_id; ?>" class="alert alert-danger panel-collapse collapse">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="clearfix"></div>
          <p>
          Cancellation Policies
          <br>
          <hr> 
          <?php 
          
          foreach($room->rates[0]->cancellationPolicies as $key => $value){
            $value = (array)$value;
            if(is_array($value)){
              foreach($value as $key1 => $value1){
                  echo $key1 ." : ".$value1." ";  
              }
            }else{
              echo $key ." : ".$value."<br>";

            }
            echo "<br>";
            //print_r($key);
              //print_r($value);
          } ?></p>
        </div>
      </div>
    </div>
    <!-- refund policy -->
    <div id="details<?php echo $close_id; ?>" class="alert alert-warning panel-collapse collapse">
      <div class="panel panel-default">
        <div class="panel-body">
          
          <p>
          Cancellation Policies
          <br>
          <hr> 
          <?php 
          
          foreach($room->rates[0]->cancellationPolicies as $key => $value){
            $value = (array)$value;
            if(is_array($value)){
              foreach($value as $key1 => $value1){
                  echo $key1 ." : ".$value1." ";  
              }
            }else{
              echo $key ." : ".$value."<br>";

            }
            echo "<br>";
            //print_r($key);
              //print_r($value);
          } ?></p>
          
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(".zoom-gallery").magnificPopup({
        delegate: 'a',
        type: 'image',
        closeOnContentClick: false,
        closeBtnInside: false,
        mainClass: 'mfp-with-zoom mfp-img-mobile',
        image: {
          verticalFit: true,
          titleSrc: function(item) {
            return item.el.attr('title') + ' ';
          }
        },
        gallery: {
          enabled: true
        },
        zoom: {
          enabled: true,
          duration: 300, // don't foget to change the duration also in CSS
          opener: function(element) {
            return element.find('img');
          }
        }

      });

    </script>
    <script>
      $('.collapse').on('show.bs.collapse', function () {
          $('.collapse.in').collapse('hide');
      });
    </script>
    <!-- Modal -->
    <div class="modal fade" id="book<?php echo $close_id;?>" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo trans('0463');?></h4>
          </div>
          <div class="modal-body">
            <p><?php echo trans('0464');?></p>
            <img src="<?php echo base_url(); ?>assets/img/users.png" class="img-responsive"/>
            <hr>
            <div class="row">
              <div class="col-md-6">
                <form id="bookloginform" action="<?php echo base_url();?>properties/hbreservation" method="GET">
                  <input type="hidden" name="adults" value="<?php  echo $adultsCount; ?>" />
                  <input type="hidden" name="child" value="<?php echo $childAges; ?>" /> 
                  <input type="hidden" name="checkin" value="<?php  echo $checkin; ?>" />
                  <input type="hidden" name="checkout" value="<?php  echo $checkout; ?>" />
                  <input type="hidden" name="ratekey" value="<?php echo $room->rates[0]->rateKey; ?>" />
                  <input type="hidden" name="roomImg" value="<?php echo $roomImg; ?>" />
                  <input type="hidden" name="hotel" value="<?php echo $hotelid; ?>" />
                  <input type="hidden" name="sessionid" value="hotelbed" />
                  <button type="submit" class="btn btn-primary btn-block btn-lg"><?php echo trans('04');?></button>
                </form>
              </div>
              <div class="col-md-6">
                <form action="<?php echo base_url();?>properties/hbreservation" method="GET">
                  <input type="hidden" name="adults" value="<?php  echo $adultsCount; ?>" />
                  <input type="hidden" name="child" value="<?php echo $childAges; ?>" />
                  <input type="hidden" name="checkin" value="<?php  echo $checkin; ?>" />
                  <input type="hidden" name="checkout" value="<?php  echo $checkout; ?>" />
                  <input type="hidden" name="ratekey" value="<?php echo $room->rates[0]->rateKey; ?>" />
                  <input type="hidden" name="roomImg" value="<?php echo $roomImg; ?>" />
                  <input type="hidden" name="hotel" value="<?php echo $hotelid; ?>" />
                  <input type="hidden" name="sessionid" value="hotelbed" />
                  <input type="hidden" name="user" value="guest" />
                  <button type="submit" class="btn btn-success btn-block btn-lg"><?php echo trans('0167');?></button>
                </form>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <?php if($app_settings[0]->allow_registration){ if($app_settings[0]->user_reg_approval == "Yes"){ ?>
            <form action="<?php echo base_url();?>properties/hbreservation" method="GET">
              <input type="hidden" name="adults" value="<?php  echo $adultsCount; ?>" />
              <input type="hidden" name="child" value="<?php echo $childAges; ?>" />
              <input type="hidden" name="checkin" value="<?php  echo $checkin; ?>" />
              <input type="hidden" name="checkout" value="<?php  echo $checkout; ?>" />
              <input type="hidden" name="ratekey" value="<?php echo $room->rates[0]->rateKey; ?>" />
              <input type="hidden" name="roomImg" value="<?php echo $roomImg; ?>" />
              <input type="hidden" name="hotel" value="<?php echo $hotelid; ?>" />
              <input type="hidden" name="sessionid" value="hotelbed" />
              <input type="hidden" name="user" value="register" />
              <button type="submit" class="btn btn-default"><?php echo trans('05');?></button>
            </form>
            <?php } } ?>
            <!--            <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo trans('0346');?></button>-->
          </div>
        </div>
      </div>
    </div>
    <?php } } ?>
    <?php } ?>
    <script>
      jQuery(document).ready(function($) {
        var set_avg_rate = '<?php echo $set_avg_rate ?>';
        $(".set_avg_rate").html(set_avg_rate);
      $('.showcalendar').on('change',function(){
         var roomid = $(this).prop('id');
         var monthdata = $(this).val();
        $("#roomcalendar"+roomid).html("<br><br><div id='rotatingDiv'></div>");
       $.post("<?php echo base_url();?>hotels/roomcalendar", { roomid: roomid, monthyear: monthdata}, function(theResponse){ console.log(theResponse);
       $("#roomcalendar"+roomid).html(theResponse);  }); }); });
    </script>
    <script>
      $('.collapse').on('show.bs.collapse', function () {
          $('.collapse.in').collapse('hide');
      });
    </script>
    <script type="text/javascript">
      function booknow(){
        $("#bookloginform").submit();
      }
    </script>
  </div>
  
</section>