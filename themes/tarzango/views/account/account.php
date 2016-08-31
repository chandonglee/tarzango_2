<style type="text/css">

.account_body .col-sm-12 .col-sm-10 {
     margin: 0px; 
     margin-top: 30px;
}
.account_body .col-sm-12 .col-sm-10 .tab-content {
    float: left;
    width: 98%;
    margin-top: 25px ;
}
.fa-star{
    content: "\f005";
    font-size: 14px;
    margin-left: 5px;
}
@media(min-width: 1600px){
  .account_body .col-sm-12 .col-sm-10 .tab-content .tab-pane .booking_box .col-sm-4 {
    width: 23%;
    padding: 0px;
}
}


</style>


<div class="account">
  <div class="container-main main_header">
     <div class="container">
      <div class="row">
       
      <?php include $themeurl.'views/menu_header.php';?>
            <center style="margin-left: 88px; z-index: 999;
    margin-top: 20px;"><a  href="<?php echo base_url(); ?>"><img class="" style="z-index:999" src="images/contact-logo.png"></a></center>
        <div class="col-sm-12 page-title">
          <h2 class="">Account</h2>
          <a  href="<?php echo base_url(); ?>" ><img style="position:relative;z-index:999;" src="images/arrow-blue.png"></a>
        </div>
      </div>
    </div>
  </div>

<div class="account_body">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="col-sm-1">
          
          </div>
          <div class="col-sm-10">
            <img class="account-img" src="images/account_icon.png">
            <h1 class="heading">Welcome to your account <?php echo $profile[0]->ai_first_name; ?> <?php echo $profile[0]->ai_last_name;  ?>!</h1>
            <ul class="nav nav-tabs responsive" id="accounts">
            
              <li  class="col-sm-6 tabs active_bg_menu active" data-toggle="tab" onclick="mySelectUpdate()"><a data-toggle="tab"  href="#bookings">My Bookings</a></li>
              <li class="col-sm-6 tabs" data-toggle="tab" onclick="mySelectUpdate()" ><a data-toggle="tab" href="#profile">My Profile</a></li>

            </ul>


          </div>
        </div>
      </div>
  </div>
</div>
</div>


          <script>
    $(".tabs").click(function(){
      /*alert();*/
      $(".tabs").removeClass('active_bg_menu');
      $(this).addClass('active_bg_menu');
    });
  </script>
      </div>
      <!-- LEFT MENU -->
      <!-- RIGHT CPNTENT -->
      <div class="account_body">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="col-sm-1">
          
          </div>
          <div class="col-sm-10">

      
        <!-- Tab panes from left menu -->
        <div class="tab-content">
          <!-- TAB 1 -->
            <div id="bookings" class="tab-pane fade in active">
         
            <p>You have 2 active bookings</p>
            <?php include $themeurl.'views/account/bookings.php'; ?>
          </div>
          <!-- END OF TAB 1 -->
          <!-- TAB 2 -->


          <div class="tab-pane fade in myprofile " id="profile">
              <div class="tab-content">
            <?php include $themeurl.'views/account/profile.php'; ?>
            </div>
          </div>
          <!-- END OF TAB 2 -->
          <!-- TAB 3 -->
          <div class="tab-pane fade in" id="wishlist">
            <?php //include $themeurl.'views/account/wishlist.php'; ?>
          </div>
           </div>
        </div>
      </div>
  </div>
</div>
</div>
          <!-- END OF TAB 3 -->
          <!-- TAB 7 -->
          <!-- <div class="tab-pane fade in" id="newsletter">
            <?php include $themeurl.'views/account/newsletter.php'; ?>
          </div> -->
          <!-- END OF TAB 7 -->
        </div>
        <!-- End of Tab panes from left menu -->
      </div>
      <!-- END OF RIGHT CPNTENT -->
      <div class="clearfix"></div>
    </div>
     <br/><br/><br><br><br><br>
    <!-- END CONTENT -->
  </div>
</div>
</div>

          <style>
.tab-content {
    height: 100%;
}
</style>
<!-- END OF CONTENT -->
<script type="text/javascript">
  $(function(){

  $('.comments').popover({ trigger: "hover" });
  // Update Profile
  $('.updateprofile').click(function(){
  $('html, body').animate({
  scrollTop: $(".toppage").offset().top - 100
  },'slow');
  $.post("<?php echo base_url();?>account/update_profile", $("#profilefrm").serialize(), function(msg){

  $(".accountresult").html(msg).fadeIn("slow");
  slidediv();
  });
  });

  //newsletter subscription
  $(".newsletter").click(function(){
  var email = $(this).val();
  var action = '';
  var msg = '';
  if($(this).prop( "checked" )){
  action = 'add';
  msg = "<?php echo trans('0487');?>";
  }else{
  action = 'remove';
  msg = "<?php echo trans('0489');?>";
  }
  $.post("<?php echo base_url();?>account/newsletter_action", { email: email, action: action }, function(resp){
  $(".accountresult").html('<div class="alert alert-success">'+msg+'</div>').fadeIn("slow");
  slidediv();
  });
  });
  // Remove wish
  $(".removewish").on('click',function(){
  var id = $(this).prop('id');
  var confirm1 = confirm("<?php echo trans('0436');?>");
  if(confirm1){
     $("#wish"+id).fadeOut("slow");
  $.post("<?php echo base_url();?>account/wishlist/single", { id: id }, function(theResponse){
  });
  }


  });

  // Request Cancellation
  $(".cancelreq").on('click',function(){
  var id = $(this).prop('id');
  $.alert.open('confirm', 'Are you sure you want to Cancel this booking', function(answer) {
  if (answer == 'yes'){
  $.post("<?php echo base_url();?>account/cancelbooking", { id: id }, function(theResponse){
  location.reload();
  });
  }
  })
  });

  // Request EAN Cancellation
  $(".ecancel").on('click',function(){
  var id = $(this).prop('id');
  $.alert.open('confirm', 'Are you sure you want to Cancel this booking', function(answer) {
  if (answer == 'yes'){
  $.post("<?php echo base_url();?>ean/cancel", { id: id }, function(theResponse){
    if(theResponse != "0"){
      alert(theResponse);
    }
  //console.log(theResponse);
  location.reload();
  });
  }
  })
  });

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
  $.post("<?php echo base_url();?>account/addreview", $("#reviews-form-"+id).serialize(), function(resp){
  if($.trim(resp) == "done"){
  $("#review_result"+id).html("<div id='rotatingDiv'></div>").fadeIn("slow");
  location.reload();
  }else{
  $("#review_result"+id).html(resp).fadeIn("slow");
  }

  });

  setTimeout(function(){

  $("#review_result"+id).fadeOut("slow");

  }, 3000);

  });

  })

  function slidediv(){

  setTimeout(function(){

  $(".accountresult").fadeOut("slow");

  }, 4000);

  }


</script>
