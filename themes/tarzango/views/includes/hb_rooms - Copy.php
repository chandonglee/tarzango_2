<style type="text/css">
    .labelright{
        border-radius: 0px 6px 6px 0px;
        float: right;
        height: 100%;
        padding: 10px;
        border: 1px solid #e8e8e8;
        background: white;
        width: 10%;
        margin-top: 20px;
    }
    .img_list{
      min-height: 210px;
    }
   /* #ROOMS{
      border:1px solid;
      padding-top: 20px;
      margin-bottom: 20px;
    }*/
    .size24{
      font-size: 22px;
    }
    /*button[type="submit"] {
      background: url(<?php echo $theme_url; ?>img/btn-bg.jpg) no-repeat;
      background-size: 100%;
      text-align: center;
      color: #fff;
      border: 0;
      text-transform: uppercase;
  }*/

</style>

<section  id="ROOMS">
  
  <div class="room-type">
    
    
    <?php if(empty($hb_room)){ echo '<h1 class="text-center">' . trans("066") . '</h1>'; }else{ ?>
    <?php 
	//echo json_encode($hb_room);
    $set_avg_rate = 0;
   /* echo json_encode($module);
    exit();*/
  foreach($hb_room as $room){ 
	$nightlyRate = $room->rates[0]->net / $diff;
	if(!empty($nightlyRate)){
	 ?>
    <h2 class="room-title"> Room Types </h2>

    <div class="room-row" style="">
        <div class="room-row-line">
          <div class="room-type-name"> <?php  echo character_limiter($room->name,11); ?> </div>
          <div class="price-room">
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
           <div class="prize-room-block"> <?php echo $r->currSymbol; ?><?php echo $nightlyRate; ?></div>
            <div class="day-night"> <span class="slas-room">/ </span> <span class="name-day"> night  </span> </div>
            </div>
 <div class="room-btn">
            <form action="<?php echo base_url().$appModule;?>/book/<?php echo $module->slug;?>" method="GET">
            <div data-click="#collapse<?php echo $r->id; ?>"  class="ingo-btn info-toggle"> Info </div>
            <input type="hidden" name="adults" value="<?php  echo $modulelib->adults; ?>" />
            <input type="hidden" name="child" value="<?php  echo $modulelib->children; ?>" />
            <input type="hidden" name="checkin" value="<?php  echo $checkin; ?>" />
            <input type="hidden" name="checkout" value="<?php  echo $checkOut; ?>" />
            <input type="hidden" name="roomid" value="<?php echo $r->id; ?>" />
            <input type="hidden" name="room" value="<?php echo $_GET['room']; ?>" />
             <?php  if($r->price > 100){ ?>
              <?php } ?>
              <?php if($R_user_type == '_f_no_login'){ ?>
              <button type="button" data-target="#M_f_no_login" class="btn btn-action btn-block chk reserve-btn op_modal">Reserve</button>
              <?php }elseif($R_user_type == '_f_free_login'){ ?>
              <button type="button" data-target="#M_f_free_login" class="btn btn-action btn-block chk reserve-btn op_modal">Reserve</button>
              <?php }else{ ?>
              <button type="submit" class="btn btn-action btn-block chk reserve-btn">Reserve</button>

                <?php } ?>
              <a style="display:none;" href="<?php echo trans('0142');?>" class="reserve-btn"> Reserve </a> </div>
            </form>
          
        </div>

    <form action="" method="GET">
      <div class="rooms-update">
       <div class="col-lg-8 col-md-8 col-sm-12">
          <div class="img_list">
            <div class="zoom-gallery">
            <?php 
            $temp_img = $module->sliderImages;
            $c_temp_img = rand(0,count($temp_img) - 1 );
    				$roomImg = $temp_img[$c_temp_img]['fullImage'];
    				$r_arry = array(".","-");
    				$code1 = str_replace($r_arry, "", $room->code);
    				$close_id =  $room->rates[0]->allotment.$code1;
    				 ?>
              <a href="<?php echo $roomImg; ?>" data-source="<?php echo $roomImg; ?>" title="<?php echo $c_temp_img;//$room->name; ?>">
              <img class="lazy_load"  src="<?php echo $roomImg; ?>">
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
    
      $('.collapse').on('show.bs.collapse', function () {
          $('.collapse.in').collapse('hide');
      });
      function booknow(){
        $("#bookloginform").submit();
      }
    </script>
  </div>
  
</section>