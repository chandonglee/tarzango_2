<link rel="stylesheet" href="<?php echo $theme_url; ?>css/flexslider.css" type="text/css" media="screen" />
<style type="text/css"></style>
<?php if(!empty($bookings) || !empty($eanbookings)){ 
  if(!empty($attrbookings)){ 
      foreach($attrbookings as $b){ 
        $book_response = json_decode($b->book_response);
        $booking_extra_data = json_decode($b->booking_extra_data);
       
      /*  echo $book_response;
        exit();*/
        ?>
<?php 
              for ($k=0; $k < count($book_response->activities[0]->content->media->images[0]->urls) ; $k++) { 
                if($book_response->activities[0]->content->media->images[0]->urls[$k]->sizeType == 'XLARGE'){
                  $img_disp = $book_response->activities[0]->content->media->images[0]->urls[$k]->resource;
                }
              }
              ?>
<div id="mybookings" class="tab-pane fade in active">
  <div class="booking_box">
    <div class="col-sm-4"> 
    <?php if($img_disp == ""){ ?>
      <img style="width: 100%;" class="img-responsive" src="images/room.jpg"> 
    <?php }else{ ?>
      <img class="img-responsive" src="<?php echo $img_disp;?>">
    <?php }?>
     </div>

    <div class="col-sm-5">
      <h2><?php echo character_limiter($book_response->activities[0]->name,18); ?></h2>
       <h3><img src="images/checkin.png"> <?php echo $booking_extra_data->address;?></h3>
      <h4>Booking ID: <span> <?php echo $b->pt_attr_booking_id;?></span></h4>
      <h4>Booking Code: <span> <?php echo $b->booking_ref_no;?></span></h4>
      <h4>Due Date: <span> <?php echo date('m/d/Y' ,strtotime($b->booking_expiry));?></span></h4>
    </div>
    <div class="col-sm-3">
      <h1>$ <?php echo number_format($b->booking_total,0);?></h1>
      <h5><?php echo date('m/d/Y' ,strtotime($b->booking_expiry));?></h5>
      <center>
        <?php if($b->booking_status == "paid"){ ?>
        <label class="paid"> <a class="book-now" style="color: #FFF !important;" href="<?php echo base_url();?>attraction/invoice/<?php echo $b->pt_attr_booking_id;?>" > INVOICE </a> </label>
        <?php }else{ ?>
        <label class="unpaid"> <a class="book-now" style="color: #ff4633 !important;" href="<?php echo base_url();?>attraction/invoice/<?php echo $b->pt_attr_booking_id;?>" > INVOICE </a> </label>
        <?php } ?>
      </center>
      <?php if($b->booking_status == "paid"){
                        $active_boook++;
                       ?>
      <h6 class="paid" >Paid <img src="images/paid.png"></h6>
      <?php }elseif($b->booking_status == "cancelled"){ ?>
      <h6 class="unpaid" >Cancelled <img src="images/cancelled.png"></h6>
      <?php }elseif($b->booking_status == "reserved"){ ?>
      <h6 class="unpaid" >Reserved <img src="images/reserved.png"></h6>
      <?php }else{ ?>
      <h6 class="unpaid" >Unpaid <img src="images/unpaid.png"></h6>
      <?php } ?>
      </strong> </div>
  </div>
</div>
<br>
<!--Comments modal --> 

<!---Comments Modal-->
<?php } } 
    if(!empty($bookings)){ 
      foreach($bookings as $b){ ?>

<div id="mybookings" class="tab-pane fade in active">
  <div class="booking_box">
    <div class="col-sm-4"> 
    <?php if($b->thumbnail == ""){ ?>
      <img style="width: 100%;" class="img-responsive" src="images/room.jpg"> 
    <?php }else{ ?>
      <img class="img-responsive" src="<?php echo str_replace('demo.tarzango.com','tarzango.com',$b->thumbnail);?>">
    <?php }?>
     </div>
    <div class="col-sm-5">
      <h2><?php echo character_limiter($b->title,18); ?></h2>
      <div class="stars"> <?php echo $b->stars;?> </div>
      <h3><img src="images/checkin.png"> <?php echo $b->location;?></h3>
      <h4>Booking ID: <span> <?php echo $b->id;?></span></h4>
      <h4>Booking Code: <span> <?php echo $b->code;?></span></h4>
      <h4>Due Date: <span> <?php echo $b->expiry;?></span></h4>
    </div>
    <div class="col-sm-3">
      <h1>$ <?php echo $b->checkoutTotal;?></h1>
      <h5><?php echo $b->date;?></h5>
      <center>
        <?php if($b->status == "paid"){ ?>
        <label class="paid"> <a class="book-now" style="color: #FFF !important;" href="<?php echo base_url();?>invoice?id=<?php echo $b->id;?>&sessid=<?php echo $b->code;?>" > INVOICE </a> </label>
        <?php }else{ ?>
        <label class="unpaid"> <a class="book-now" style="color: #ff4633 !important;" href="<?php echo base_url();?>invoice?id=<?php echo $b->id;?>&sessid=<?php echo $b->code;?>" > INVOICE </a> </label>
        <?php } ?>
      </center>
      <?php if($b->status == "paid"){
                        $active_boook++;
                       ?>
      <h6 class="paid" >Paid <img src="images/paid.png"></h6>
      <?php }elseif($b->status == "cancelled"){ ?>
      <h6 class="unpaid" >Cancelled <img src="images/cancelled.png"></h6>
      <?php }elseif($b->status == "reserved"){ ?>
      <h6 class="unpaid" >Reserved <img src="images/reserved.png"></h6>
      <?php }else{ ?>
      <h6 class="unpaid" >Unpaid <img src="images/unpaid.png"></h6>
      <?php } ?>
      </strong> </div>
  </div>
</div>
<br>
<!--Comments modal --> 

<!---Comments Modal-->
<?php } }  ?>
<?php if(!empty($eanbookings)){ 
// print_r($eanbookings);
  foreach($eanbookings->bookings as $eanbook){ 
    
  $duedate = date('m/d/Y', strtotime('+24 hours', $eanbook->created_date));

    ?>

<div id="mybookings" class="tab-pane fade in active">
  <div class="booking_box">
    <div class="col-sm-4"> 
    <?php if($eanbook->thumbnail == ""){ ?>
      <img style="width: 100%;" class="img-responsive" src="images/room.jpg"> 
    <?php }else{ ?>
      <img style="width: 100%;" class="img-responsive" src="<?php echo str_replace('bigger/','', $eanbook->thumbnail);?>"> 
    <?php }?>
    </div>
    <div class="col-sm-5">
      <h2><?php echo character_limiter($eanbook->title,18); ?></h2>
      <div class="stars"> <?php echo $eanbook->stars;?> </div>
      <h3><img src="images/checkin.png"> <?php echo $eanbook->location;?></h3>
      <h4>Booking ID: <span> <?php echo $eanbook->id;?></span></h4>
      <h4>Booking Code: <span> <?php echo $eanbook->code;?></span></h4>
      <h4>Due Date: <span> <?php echo $duedate;?></span></h4>
    </div>
    <div class="col-sm-3">
      <h1>$ <?php echo number_format($eanbook->total,0);?></h1>
      <h5><?php echo $duedate; ?></h5>
      <center>
        <?php if($eanbook->cancelNumber == "paid"){ ?>
        <label class="paid"> <a class="book-now" style="color: #FFF !important;" href="<?php echo base_url();?>invoice?eid=<?php echo $eanbook->id;?>&sessid=<?php echo $eanbook->code;?>" > INVOICE </a> </label>
        <?php }else{ ?>
        <label class="unpaid"> <a class="book-now" style="color: #ff4633 !important;" href="<?php echo base_url();?>invoice?eid=<?php echo $eanbook->id;?>&sessid=<?php echo $eanbook->code;?>" > INVOICE </a> </label>
        <?php } ?>
      </center>
      <?php if($eanbook->cancelNumber == "paid"){
                        $active_boook++;
                       ?>
      <h6 class="paid" >Paid <img src="images/paid.png"></h6>
      <?php }elseif($eanbook->status == "cancelled"){ ?>
      <h6 class="unpaid" >Cancelled <img src="images/cancelled.png"></h6>
      <?php }elseif($eanbook->status == "reserved"){ ?>
      <h6 class="unpaid" >Reserved <img src="images/reserved.png"></h6>
      <?php }else{ ?>
      <h6 class="unpaid" >Unpaid <img src="images/unpaid.png"></h6>
      <?php } ?>
      </strong> </div>
  </div>
</div>
<br>
<!--Comments modal --> 
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
  var active_boook = '<?php echo $active_boook; ?>';
  $('.active_boook').html(active_boook);
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
