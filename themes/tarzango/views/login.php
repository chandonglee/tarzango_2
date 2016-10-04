<!-- 100% Width & Height container  -->
<style type="text/css">
  footer{
    display: block !important;
  }
  footer {
    float: left;
    display: none;
    width: 100%;
}
.login-form{
  margin-top: 50px;
}
@media (max-width: 767px){}
.login-form {
    padding: 20px 25px !important;
    margin-top: 0px !important;
}
}
</style>
<?php include'main-header.php';?>
<div class="bg_list_image">
  <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 login-form" style="margin-bottom:100px;margin-top100px">
  <div class="login-title"><span class="text">Login</span></div>
  <?php  if(!empty($customerloggedin)){ ?>
  <li><a href="<?php echo base_url()?>account/logout"><?php echo trans('03');?></a></li>
  <?php }else{ if (strpos($currenturl,'book') !== false) { }else{ ?>
  <form method="POST" action="" id="loginfrm" accept-charset="UTF-8" onsubmit="return false;">
    
    <!-- Login Wrap  -->
    <div class="login-wrap">
    <div class="resultlogin"></div>
    <div class="col-md-12">
    <div id="login-overlay"></div>
    </div>

      <div class="login-c1 wow fadeInDown animated">
        <div class="cpadding50">
          <div class="form-group">
            <label><?php echo trans('094');?></label>
            <input type="email" class="form-control input-lg padding-10"  placeholder="<?php echo trans('094');?>" required="required" name="username">
          </div>
          <div class="form-group">
            <label><?php echo trans('095');?></label>
            <input type="password" class="form-control input-lg padding-10"  placeholder="<?php echo trans('095');?>" required="required" name="password">
          </div>
        </div>
      </div>

      <div class="visible-xs">
        <div style="margin-top:35px"></div>
      </div>
      <div class="login-c2 wow fadeInUp animated">
        <div class="logmargfix">
          <div class="chpadding50">
            <div class="alignbottom">
              <?php if(!empty($is_hotelbed)) { ?>
              <input type="hidden" class="url" value="<?php echo base_url().'properties/hbreservation/'.$url;?>" />
              <?php }elseif(!empty($url)){ ?>
              <input type="hidden" class="url" value="<?php echo base_url().'properties/reservation/'.$url;?>" />
              <?php }else{ ?>
              <input type="hidden" class="url" value="<?php echo base_url();?>account/" />
              <?php } ?>
              <button type="submit" class="btn-block btn btn-action loginbtn"><?php echo trans('04');?></button>
            </div>
            <div class="alignbottom2">
              <div class="checkbox">
                <label class="go-right"><input class="go-right" type="checkbox" name="remember" id="remember-me" value="1" style="    height: 15px !important;"> <span style="font-size:13px;color:#000"><span class="go-left"> &nbsp; <?php echo trans('0187');?> &nbsp; </span></span></label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="login-c3 wow zoomInDown animated" style="margin-top: 10px;position: relative;float: left;width: 100%;">
        <?php if($registerationAllowed == "1"){ ?><div class="left" style="width: 50%;float: left;"><a href="<?php echo base_url();?>register" class="whitelink"><span></span><?php echo trans('0237');?></a></div><?php } ?>
        <div class="right" style="float: right;"><a data-toggle="modal" href="#ForgetPassword" id="whitelink" class="whitelink "><?php echo trans('0112');?></a></div>
      </div>
    </div>
    <!-- End of Login Wrap  -->
  </form>

</div>  
</div>

<!-- End of Container  -->
<div class="clearfix"></div>
<?php if($fblogin){ ?>
<div class="form-group">
  <a href="<?php echo $fbloginurl;?>" class="btn btn-facebook btn-block"><i class="fa fa-facebook-square" ></i> <?php echo trans('0266');?></a>
</div>
<?php } ?>
<?php } }  ?>
<!-- PHPTRAVELS forget password starting -->
<div class="modal fadeIn animated" id="ForgetPassword1" style="display:none">
  <div class="modal-dialog modal-sm" style="width:450px">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" style="font-family: 'Gotham-Bold'; color: #4867aa; font-size: 28px; display: inherit;"><i class="fa fa-asterisk"></i> <?php echo trans('0112');?></h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="" id="passresetfrm" accept-charset="UTF-8" onsubmit="return false;">
          <div class="resultreset"></div>
          <div class="input-group" style="width:95%">
            <input type="text" placeholder="your@email.com" class="form-control form" id="resetemail" name="email" required>
            <span class="input-group-btn">
            <button type="submit" style="text-align: center; font-family: 'Gotham-Bold'; font-size: 14px;color: #fff;
    padding: 20px 20%;
    background: #3ecdff;
   
    text-transform: uppercase;
    text-decoration: none;
    border: none;
    letter-spacing: 1px;
    " class="btn btn-primary resetbtn" type="button"><?php echo trans('0114');?></button>
            </span>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- PHPTRAVELS forget password ending -->
<script>
 
     $("#whitelink").click(function(){      
        $("#ForgetPassword1").toggle();
    });
 $(".close").click(function(){      
        $("#ForgetPassword1").hide();
    });

  
  $(function(){
  var url = $(".url").val();
  // start login functionality
  $(".loginbtn").on('click',function(){
  $.post("<?php echo base_url();?>account/login",$("#loginfrm").serialize(), function(response){ if(response != 'true'){
  $(".resultlogin").html("<div class='alert alert-danger'>"+response+"</div>"); }else{
  $(".resultlogin").html("<div id='rotatingDiv'></div> <div class='alert alert-info'><?php echo trans('0427');?></div>");
  window.location.replace(url); }}); });
  // end login functionality

  // start password reset functionality
  $(".resetbtn").on('click',function(){
   var resetemail = $("#resetemail").val();
     $(".resultreset").html("<div id='rotatingDiv'></div>");
  $.post("<?php echo base_url();?>account/resetpass",$("#passresetfrm").serialize(), function(response){
  if($.trim(response) == '1'){
  $(".resultreset").html("<div class='alert alert-success'>New Password sent to "+resetemail+", <?php echo trans('0426');?></div>");

  }else{
  $(".resultreset").html("<div class='alert alert-danger'><?php echo trans('0425');?></div>");

  } }); });
  // end password reset functionality


  });
</script>