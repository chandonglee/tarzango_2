<link rel="stylesheet" href="<?php echo $theme_url; ?>css/flexslider.css" type="text/css" media="screen" /> 
<style type="text/css">
.flex-direction-nav a {
    margin: -14px 0 0;
  }
.room-details {
  min-height: 250px;
}
.room-details h3{
  font-family: "Roboto";
}
.room-details p{
  font-family: "Roboto";
}
.room-details h4{
  font-family: "Roboto";
}
.booking_disc{
font-family: "Roboto";
}
.amount{
font-family: "Roboto";

}
.white span{
  color: #aaaaaa;
}
.white span strong{
  color: #000;
}
.gray{
  color: #616161;
}
a.book-now:hover{
  background: url(<?php echo $theme_url; ?>img/btn-bg.jpg) repeat;
}
a.book-now{
   background: url(<?php echo $theme_url; ?>img/btn-bg.jpg) repeat;
       background-size: 100%;
       text-align: center;
       color: #fff;
       border: 0;
       width: 110px;
       /*height: 50px;*/
       /*font-weight: 700;*/
}
ul{
  list-style: none;
}
@media (min-width: 320px) {
  .listing-box-left {
    width: 100%;
  }
  .listing-box figure {
    height: 150px;
  }
  .booking_disc {
    padding-top: 0px;
    padding-bottom: 20px;
  }
  .rooms-bnnr .flexslider .flex-viewport li {
    min-height: 150px;
    max-height: 150px;
  }
  .flexslider {
    margin: 0px;
  }
}
@media (min-width: 375px) {
  .listing-box-left {
    width: 100%;
  }
  .listing-box figure {
    height: 150px;
  }
  .booking_disc {
    padding-top: 0px;
    padding-bottom: 20px;
  }
  .rooms-bnnr .flexslider .flex-viewport li {
    min-height: 150px;
    max-height: 150px;
  }
  .flexslider {
    margin: 0px;
  }
}

@media (min-width: 425px) {
  .listing-box-left {
    width: 100%;
  }
  .listing-box figure {
    height: 150px;
  }
  .booking_disc {
    padding-top: 0px;
    padding-bottom: 20px;
  }
  .rooms-bnnr .flexslider .flex-viewport li {
    min-height: 150px;
    max-height: 150px;
  }
  .flexslider {
    margin: 0px;
  }
}


@media (min-width: 768px) {
  .listing-box-left {
    width: 42%;
  }
  .listing-box figure {
    height: 250px;
  }
  .booking_disc {
    padding-top: 0px;
    padding-bottom: 0px;
  }
  .rooms-bnnr .flexslider .flex-viewport li {
    min-height: 250px;
    max-height: 250px;
  }
  .flexslider {
    margin: 0px;
  }
  .room-details {
    min-height: 170px;
  }
  .flexslider .slides img {
    height: 250px;
  }
  .listing-box-right .amount {
    padding: 10px 0px;
  }
  .listing-box-right .amount h5 {
    float: left;
    margin-left: 27px;
  }
  .listing-box-right .amount span {
    float: left;
    margin-left: 27px;
    padding-top: 20px;
  }
}

@media (min-width: 992px) {
 
  .listing-box-left {
    width: 40%;
  }
}

@media (min-width: 1024px) {
 
  .booking_disc {
    padding-top: 60px;
    padding-bottom: 20px;
  }
  .room-details {
    min-height: 250px;
  }
  .listing-box-left {
    width: 32%;
  }
  .listing-box-right .amount span{
    float: none;
  }
  .listing-box-right .amount h5 {
    float: none;
  }
}

@media (min-width: 1280px) {
  /*.room-details {
    min-height: 250px;
  }*/
  .listing-box-left {
    width: 32%;
  }
}

@media (min-width: 1366px) {
  .booking_disc {
    padding-top: 90px;
    padding-bottom: 20px;
  }
  .room-details {
    min-height: 250px;
  }
}


@media (min-width: 1440px) {
  
  .booking_disc {
    padding-top: 90px;
    padding-bottom: 20px;
  }
  .room-details {
    min-height: 250px;
  }
  .listing-box-left {
    width: 22%;
  }
}

@media (min-width: 1920px) {
  .listing-box-left {
    width: 22%;
  }
}

@media (min-width: 2560px) {
 
  .booking_disc {
    padding-top: 90px;
    padding-bottom: 20px;
  }
}

</style>
<?php if(!empty($bookings) || !empty($eanbookings)){ if(!empty($bookings)){ foreach($bookings as $b){ ?>
   
      <div class="listing-box">
        <div class="listing-box-left" >

          <figure>

            <div class="rooms-bnnr" style="">
              <div class="flexslider" style="border:none;">
                <ul class="slides">
                  <li><img src="<?php echo $b->thumbnail;?>"></li>
                </ul>
              </div>
            </div>
          </figure>
        </div>
        <div class="listing-box-right" style="">
          <div class="room-details">
            <h3><?php echo character_limiter($b->title,25); ?><span class="white size12 st_rating"> <?php echo $b->stars;?></span></h3> 
            <p><?php echo $b->location;?> </p>
            <h4> 4035 N Nellis Blvd, Las Vegas, NV 89115, United States</h4>
            <div class="booking_disc" style="">
              <div class="clearfix"></div>
                <span class="white">
                <span style="padding-right:15px"><strong><?php echo trans('0145');?> <?php echo trans('021');?>:</strong> <?php echo $b->id;?></span>
                <span style="padding-right:15px"><strong><?php echo trans('0398');?>: </strong> <?php echo $b->code;?> </span>
                <span><strong><?php echo trans('079');?> :</strong> <?php echo $b->expiry;?> </span>
                </span>
              </div>
          </div>
          <div class="amount">
            <h5><?php echo $b->currSymbol;?><?php echo $b->checkoutTotal;?></h5>
            <span class="grey"><?php echo $b->date;?></span> <a class="book-now" href="<?php echo base_url();?>invoice?id=<?php echo $b->id;?>&sessid=<?php echo $b->code;?>" >Invoice</a> </div>

        </div>
      </div>
   

<br>
<!--Comments modal -->

<!---Comments Modal-->
<?php } }  ?>
<?php if(!empty($eanbookings)){ // print_r($eanbookings);
  foreach($eanbookings->bookings as $eanbook){ ?>
<?php } } ?>
<!-- End expedia bookings -->
<?php }else{ ?>
<table class="table table-hover table-border table-responsive table-striped">
  <tbody>
    <h4><strong> <?php echo trans('087');?> </strong></h4>
  </tbody>
</table>
<?php } ?>
<script type="text/javascript">
  $(function(){
    $(".cancelEanBooking").on("click",function(){
      var bookid = $(this).prop("id");
      $.post("<?php echo base_url();?>ean/cancel",{id: bookid},function(resp){
        if(resp == "success"){
          location.reload();
          return true;
        }else{
          alert(resp);
          return false;
        }
        
      })
    })
  })
</script>
