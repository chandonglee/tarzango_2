<style type="text/css">
.container-fluid.inner-page-nav{
  display: block;
}
@media (max-width: 375px){
  .col-xs-5 {
    width: 65%;
    margin-left: 65px;
    padding-top: 0px !important;
    padding-bottom: 0px !important;
  }
  .col-xs-7 {
    width: 100%;
    text-align: center;
    padding-top: 0px !important;
    padding-bottom: 0px !important;
  }
    
}

@media (min-width: 768px){
    .col-md-offset-1 {
    margin-left: 5%;
  }
    .col-md-8 {
    width: 56%;
    }
    
}
 @media (min-width: 992px){
    .col-md-offset-1 {
    margin-left: 5.333%;
  }
    .col-md-8 {
    width: 68%;
    }
    .col-md-2 {
    width: 21.666667%;
    }
}
@media (min-width: 1024px){
    .col-md-offset-1 {
    margin-left: 5%;
  }
    .col-md-8 {
    width: 68%;
    }
    
}
@media (min-width: 1366px){
    .col-md-offset-1 {
    margin-left: 9.333%;
  }
    .col-md-8 {
    width: 65%;
    }
    .col-md-2 {
    width: 16.444%;
    }
    .buttons{
      padding-left:13px;
    }
}
@media (min-width: 1440px){
    .col-md-offset-1 {
    margin-left: 12%;
  }
    .col-md-8 {
    width: 61%;
    }
    .col-md-2 {
    width: 16%;
    }
    .buttons{
      padding-left:15px;
    }
}
@media (min-width: 1920px){
    .col-md-offset-1 {
    margin-left: 13%;
  }
    .col-md-8 {
    width: 66%;
    }
    .col-md-2 {
    width: 12%;
    }
    .buttons{
      padding-left:75px;
    }
}
@media (min-width: 2560px){
    .col-md-offset-1 {
    margin-left: 22%;
  }
    .col-md-8 {
    width: 49%;
    }
    .col-md-2 {
    width: 9%;
    }
    .buttons{
      padding-left:70px;
    }
}

  .onoffswitch {
    position: relative; width: 90px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
}
.onoffswitch-checkbox {
    display: none;
}
.onoffswitch-label {
    display: block; overflow: hidden; cursor: pointer;
   border-radius: 20px;
}
.onoffswitch-inner {
    display: block; width: 200%; margin-left: -100%;
    transition: margin 0.3s ease-in 0s;
}
.onoffswitch-inner:before, .onoffswitch-inner:after {
    display: block; float: left; width: 50%; height: 30px; padding: 0; line-height: 30px;
    font-size: 14px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
    box-sizing: border-box;
}
.onoffswitch-inner:before {
    content: "ON";
    padding-right: 50px;
    background-color: #FD4A63; color: #FFFFFF;
}
.onoffswitch-inner:after {
    content: "OFF";
    padding-right: 10px;
    background-color: #EEEEEE; color: #999999;
    text-align: right;
}
.onoffswitch-switch {
    display: block; width: 18px; margin: 6px;
    background: #FFFFFF;
    position: absolute; top: 0; bottom: 0;
    right: 56px;
    border-radius: 20px;
    transition: all 0.3s ease-in 0s; 
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
    margin-left: 0;
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
    right: 0px; 
}


.tabs:hover {
   background: url(<?php echo $theme_url; ?>img/btn-bg.jpg) repeat;
  color: #fff;
   border: none;
}

.active_bg_menu{
   background-image: url(<?php echo $theme_url; ?>img/btn-bg.jpg);
   color: #FFF !important;
    border: none !important;
}
button{
   background: none;
}
.tabs{
  font-family: "Roboto";
  width: 158px;
  height: 50px;
 
  border-radius: 37px; 
  -moz-border-radius: 37px; 
  -webkit-border-radius: 37px; 
  border: 2px solid #919191;
  color:#919191;
}
@media (max-width: 320px){
  .tabs{
    width:120px;
    height:50px;
  }
}
button:focus {outline:0;}
</style>
<?php include '../main-header.php';?>
<!-- CONTENT -->
<div class="bg_list_image">
<div>
  <div class="container col-md-12" style="width:100%;background:#0068a3">
    <div class="row">
    <div class="col-md-8 col-sm-6  col-xs-7 go-right RTL col-md-offset-1 col-sm-offset-1" style="padding-top:10px; padding-bottom:20px">
     <h3 style='color:#fff;font-family: "Roboto"' class="RTL">Welcome <b> <?php echo $profile[0]->ai_first_name; ?> <?php echo $profile[0]->ai_last_name;  ?>!!</b></h3>
     </div>
     <div class="col-md-2 col-sm-4  col-xs-5 go-left RTL "><h4 style='font-family: "Roboto"; font-size:20px; float:left; color:#fff;padding-top:24px'>Newsletter</h4>
      <div class="go-left" align="right" style="padding-top:30px; padding-bottom:20px">
       <div class="onoffswitch">
          <input type="checkbox" name="onoffswitch"  value="<?php echo $profile[0]->accounts_email;?>" <?php if($is_subscribed){echo "checked";}?> class="onoffswitch-checkbox newsletter" id="myonoffswitch">
          <label class="onoffswitch-label" for="myonoffswitch">
              <span class="onoffswitch-inner"><?php trans('0364');?></span>
              <span class="onoffswitch-switch"><?php trans('0363');?></span>
          </label>
      </div>
       
      </div>
    </div>
    </div>
   
  </div>
  </div>
  <div class="clearfix"></div>

  <div class="container mt25 offset-0">
    <!-- CONTENT -->
    <div class="col-md-12 pagecontainer2 offset-0">
      <!-- LEFT MENU -->
      <div class="col-md-0 offset-0 buttons" style="padding-top:20px;padding-bottom:40px;">
        <!-- Nav tabs -->
        <b>
        <button  class="tabs active_bg_menu" href="#bookings" data-toggle="tab" onclick="mySelectUpdate()" >My <?php echo trans('072');?></button>
        <button class="tabs" href="#profile" data-toggle="tab" onclick="mySelectUpdate()"><?php echo trans('073');?></button></b> 
       <!--  <ul class="nav profile-tabs">
          <li class="active">
            <a href="#bookings" data-toggle="tab">
            <span class="bookings-icon"></span>
            <?php echo trans('072');?>
            </a>
          </li>
          <li>
            <a href="#profile" data-toggle="tab" onclick="mySelectUpdate()">
            <span class="profile-icon"></span>
            <?php echo trans('073');?>
            </a>
          </li>
         <!--  <li>
            <a href="#wishlist" data-toggle="tab" onclick="mySelectUpdate()">
            <span class="wishlist-icon"></span>
            <?php echo trans('074');?>
            </a>
          </li> 
         
        </ul> -->
        <div class="clearfix"></div>
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
      <div class="col-md-12 offset-0">
        <!-- Tab panes from left menu -->
        <div class="tab-content">
          <!-- TAB 1 -->
          <div class="tab-pane padding30 active fade in" id="bookings">
            <div class="clearfix"></div>
            <?php include $themeurl.'views/account/bookings.php'; ?>
          </div>
          <!-- END OF TAB 1 -->
          <!-- TAB 2 -->
          <div class="tab-pane fade in" id="profile">
            <?php include $themeurl.'views/account/profile.php'; ?>
          </div>
          <!-- END OF TAB 2 -->
          <!-- TAB 3 -->
          <div class="tab-pane fade in" id="wishlist">
            <?php //include $themeurl.'views/account/wishlist.php'; ?>
          </div>
          <!-- END OF TAB 3 -->
          <!-- TAB 7 -->
          <div class="tab-pane fade in" id="newsletter">
            <?php include $themeurl.'views/account/newsletter.php'; ?>
          </div>
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
