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
 <div class="room-type" >
 <?php 
    $set_avg_rate = 0;
    if(!empty($modulelib->stayerror)){ ?>
    <div class="panel-body">
      <div class="alert alert-danger go-text-right">
        <?php echo trans("0420"); ?>
      </div>
    </div>
    <?php } ?>
    <?php if(!empty($rooms)){ 
     /*echo json_encode($rooms);*/
      /*exit();*/
      ?>
      <h2 class="room-title"> Room Types </h2>
    <?php foreach($rooms as $r){ if($r->maxQuantity > 0){ ?>
      
      <div class="room-row" style="">
        <div class="room-row-line">
          <div class="room-type-name"> <?php  echo character_limiter($r->title,11); ?> </div>
          <div class="price-room">
          <?php  if($r->price > 0){

              $nightlyRate = $r->price;
              if($set_avg_rate == 0){
                  $set_avg_rate = $nightlyRate;
              }else{
                  if($set_avg_rate > $nightlyRate){
                      $set_avg_rate = $nightlyRate;
                  }
              }

               ?>
            <div class="prize-room-block"> <?php echo $r->currSymbol; ?><?php echo $r->price; ?></div>
            <div class="day-night"> <span class="slas-room">/ </span> <span class="name-day"> night  </span> </div>
            <?php } ?>
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
              <button type="submit" class="btn btn-action btn-block chk reserve-btn">Reserve</button>
              <a style="display:none;" href="<?php echo trans('0142');?>" class="reserve-btn"> Reserve </a> </div>
            </form>
          
        </div>
        <div class="room-detail" id="collapse<?php echo $r->id; ?>" style="display:none">
          <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12">  
              <div class="close-btn">
                <div  data-click="#collapse<?php echo $r->id; ?>" class="info-toggle"> <img src="images/close-icon.png"> </div>
              </div>
              <img class="img-responsive" style="width: 98%;height: 330px;" src="<?php echo str_replace("demo.", "", $r->thumbnail);?>">
              </div>
            <div class="col-lg-12 col-sm-12 col-md-12" style="padding-top:20px">
              <div class="room-info">
                <h2> <?php echo $r->title;?> </h2>
                <!--<h4 > 1 King Bed or 2 Double Beds</h4>
                <h4> Sleeps up to 4 Guests</h4>
                <h4> 440 square feet </h4>-->

                <p><?php if(!empty($r->desc)){ echo $r->desc; } ?></p>
                <ul class="hotelpreferences go-right hidden-xs">
                <?php $cnt = 0; foreach($item->amenities as $amt){ $cnt++; if($cnt <= 10){ if(!empty($amt->name)){ ?>
                <img title="<?php echo $amt->name;?>" data-toggle="tooltip" data-placement="top" style="height:25px;" src="<?php echo $amt->icon;?>" alt="<?php echo $amt->name;?>" />
                <?php } } } ?>
              </ul>
              <?php if(!empty($r->Amenities) && $r->Amenities->name != null ){ ?>
              <strong><?php echo trans('055');?> : </strong>

              <?php foreach($r->Amenities as $roomAmenity){ if(!empty($roomAmenity->name)){ ?>
              <div class="col-md-4">
                <ul class="list_ok">
                  <li><?php echo $roomAmenity->name;?></li>
                </ul>
              </div>
              <?php } } } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php } } }else{ echo trans("066"); } ?>
      
    </div>

<script>
    $(document).ready(function() {
      $('.info-toggle').click(function(){
      var collapse_content_selector = $(this).attr('data-click');         
      var toggle_switch = $(this);
      $(collapse_content_selector).toggle(function(){
       
      });
      });
        
   
        if(<?php echo $set_avg_rate ?> > 0){
        console.log(<?php echo $set_avg_rate ?>);
          var set_avg_rate = '$<?php echo $set_avg_rate ?>';
          $(".set_avg_rate").html(set_avg_rate);
          
        }else{

          $(".amount-left").html('<h5 class="set_avg_rate" style="font-size: 20px;">No rooms available</h5>');
          /*$(".set_avg_rate").css('font-size','20px');*/
          $(".amount-right").hide();
        }

    });
    </script>

   
</section>
