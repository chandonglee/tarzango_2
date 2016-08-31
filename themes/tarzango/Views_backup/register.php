<style type="text/css">
  footer{
    display: block !important;
  }
  
</style>
<?php include'main-header.php';?>
<div id="login-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog container">
                <div class="popup-content">
                    <div class="login-page">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="login-form">
                                    <div class="login-title">
                                       
                                        <span class="text">Create Account</span>
                                        <!--<a href="#" class="close-modal fr" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                        </a>-->
                                    </div><!-- End Title -->
                                    <?php  if(!empty($customerloggedin)){ ?>
                                  <li><a href="<?php echo base_url()?>account/logout"><?php echo trans('03');?></a></li>
                                  <?php }else{ if (strpos($currenturl,'book') !== false) { }else{ ?>                                     
                                    <form  action="" method="POST" id="headersignupform" onsubmit="return false;">
                                       <div class="clearfix"></div>
                                          <div class="resultsignup"></div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="input">
                                                    <input class="form-control" type="text" placeholder="<?php echo trans('090');?>" name="firstname" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <div class="input">
                                                    <input class="form-control" type="text" placeholder="<?php echo trans('091');?>" name="lastname" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <div class="input">
                                                    <input class="form-control" type="text" placeholder="<?php echo trans('0173');?>" name="phone"  value="">
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <div class="input">
                                                    <input class="form-control" type="text" placeholder="<?php echo trans('094');?>" name="email"  value="">
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <div class="input">
                                                    <input class="form-control" type="password" placeholder="<?php echo trans('095');?>" name="password"  value="">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12 col-sm-12">
                                                <div class="input">
                                                    <input class="form-control" type="password" placeholder="<?php echo trans('096');?>" name="confirmpassword"  value="">
                                                </div>
                                            </div>
                                           
                                             <div class="col-md-12">
                                                <div class="input clearfix text-center">
                                                    <button type="submit" id="login_submit" 
                                                    class="signupbtn btn_full btn btn-action btn-block btn-lg submit-input btn-login" value=""> <?php echo trans('0115');?> </button>
                                                </div>
                                            </div>

                                            
                                    <?php if(!empty($url)){ ?>
                                        <input type="hidden" class="url" value="<?php echo base_url().'properties/reservation/?'.$url;?>" />
                                        <?php }else{ ?>
                                        <input type="hidden" class="url" value="<?php echo base_url();?>account/" />
                                        <?php } ?>

                                      </form>
                                      <?php } }  ?>
                                </div><!-- end login form -->
                                <!-- end login optionss -->
                            </div><!-- end col-md-12 -->
                        </div><!-- end row -->
                    </div><!-- End Login Page -->
                </div><!-- End Modal Content -->
            </div><!-- End Dialog -->
        </div>


<script type="text/javascript">
  $(function(){
      var url = $(".url").val();
  // start sign up functionality
      $(".signupbtn").on('click',function(){
      $.post("<?php echo base_url();?>account/signup",$("#headersignupform").serialize(), function(response){
      if($.trim(response) == 'true'){
      $(".resultsignup").html("<div id='rotatingDiv'></div>");
      window.location.replace(url);
      }else{
      $(".resultsignup").html(response); } }); });
  // end signup functionality
  })

</script>