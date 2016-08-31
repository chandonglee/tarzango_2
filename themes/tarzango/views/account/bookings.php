<link rel="stylesheet" href="<?php echo $theme_url; ?>css/flexslider.css" type="text/css" media="screen" /> 
<style type="text/css">

</style>
<?php if(!empty($bookings) || !empty($eanbookings)){ if(!empty($bookings)){ foreach($bookings as $b){ ?>

    
              <div id="mybookings" class="tab-pane fade in active">
               
                <div class="booking_box">
                  <div class="col-sm-4">
                    <img class="img-responsive" src="<?php echo $b->thumbnail;?>">
                  </div>
                  <div class="col-sm-5">
                    <h2><?php echo character_limiter($b->title,18); ?></h2>
                    <div class="stars">
                     <?php echo $b->stars;?>
                    </div>
                    <h3><img src="images/checkin.png"> <?php echo $b->location;?></h3>
                    <h4>Booking ID: <span> <?php echo $b->id;?></span></h4>
                    <h4>Booking Code: <span> <?php echo $b->code;?></span></h4>
                    <h4>Due Date: <span> <?php echo $b->expiry;?></span></h4>
                  </div>
                  <div class="col-sm-3">
                    <h1>$ <?php echo $b->checkoutTotal;?></h1>
                    <h5><?php echo $b->date;?></h5>
                    <center><label class="unpaid"><a class="book-now" style="color: #ff4633 !important;" href="<?php echo base_url();?>invoice?id=<?php echo $b->id;?>&sessid=<?php echo $b->code;?>" > INVOICE </a></label></center>
                    <h6 class="unpaid" >Unpaid <img src="images/unpaid.png"></h6>
                  </div>
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
