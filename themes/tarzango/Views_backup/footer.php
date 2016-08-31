
</div>
<?php  $CI = &get_instance(); $app_settings = $CI->settings_model->get_settings_data(); $lang_set = $CI->theme->_data['lang_set']; ?>
<?php if($app_settings[0]->mobile_pic_status == "Yes"){  ?>
<div class="hidden-xs" style="position: fixed;width: 99px;height: 171px;right: 0;z-index: 9999;left: 0;top: 50%;margin-top: -85px;">
  <a href="<?php echo $app_settings[0]->mobile_pic_url; ?>" target="_blank"><img src="<?php echo $theme_url; ?>assets/img/app.png"  alt="phone application" /></a>
</div>
<?php } ?>

<footer>
  <div class="container-fluid">
 <div class="container footer-top">
     <div class="row">
    <div class="col-sm-12" style="padding-bottom:55px">
     <img src="<?php echo $theme_url; ?>img/ftr-logo.png" alt="img">
    </div>  
    <div class="col-md-12">
        
         <div class="col-md-8">
              <a style="color:#1ec1fb" href="tel:4156803008" title="Call Us"> <?php echo $phone; ?></a><br>
              <a style="color:#1ec1fb" href="mailto:hello@tarzango.com" title="Email Us"><?php echo $contactemail; ?></a>
              <div class="social-ftr">
               <ul class="list-unstyled">
                <?php
                $footersocials = pt_get_footer_socials();
                foreach ($footersocials as $key => $value) {
                 
                  if($value->social_name == 'Facebook'){
                ?>
                  <a target="popup" onclick="window.open('<?php echo $value->social_link;?>','name','width=800,height=600')" >  <i class="fa fa-facebook"></i>  </a> 

                  <?php } if($value->social_name == 'Twitter'){  ?>

                  <a target="popup" onclick="window.open('<?php echo $value->social_link;?>','name','width=800,height=600')" > <i class="fa fa-twitter"></i>  </a> 

                  <?php } if($value->social_name == 'Instagram'){  ?>

                   <a  target="popup" onclick="window.open('<?php echo $value->social_link;?>','name','width=800,height=600')" > <i class="fa fa-instagram"></i> </a>
                  <?php } } ?>
                  <!-- <li class="linkedin-button"> <a href="<?php echo $value->social_link;?>"> <span class="fa-stack fa-2x"> <i class="fa fa-linkedin"></i> </span> </a> </li> -->

                </ul>
                <div style="padding-top:25px;color: #fff;">
                  <?php echo $contact_address; ?>  
                </div>
              </div>

          </div>
          <div class="col-md-2">
          
          
    <h6>About Us</h6>  
          <ul>
          <li><a href="#" title="How to Book"> How to Book</a></li>
<li><a href="<?php echo base_url().'booking_tips'; ?>" title="Booking Tips">Booking Tips</a></li>
<li><a href="#" title="About Us">About Us</a></li>
<li><a href="<?php echo base_url().'become-a-supplier'; ?>" title="Become Supplier">Become Supplier</a></li>
<li><a href="<?php echo base_url().'Price-Guarantee' ?>" title="Price Guarantee">Price Guarantee</a></li>
          </ul>



      </div> 
      
      
      <div class="col-md-2" style="padding-right:0px">
    <!--     <img src="<?php echo $theme_url; ?>img/ftr-logo.png" alt="img"> -->
    <h6>Support</h6> 
           <ul>
          <li><a href="<?php echo base_url().'contact-us'; ?>" title="Contact"> Contact</a></li>
<li><a href="<?php echo base_url().'faq'; ?>" title="FAQ and Help">FAQ &amp; Help</a></li>

<li><a href="<?php echo base_url().'terms-condition'; ?>" >Terms & Conditions</a></li>
<li><a href="<?php echo base_url().'supplier'; ?>" title="Supplier Login">Supplier Login</a></li>
<li><a href="#" title="My Account">My Account</a></li>
          </ul>
          <!-- <h5>Join Tarzango on Social Media</h5> -->
      </div>

      </div>  
      
        
      
      
      
         </div>
     </div>
     
  </div><div class="clearfix"></div>
  <div class="container-fluid copyright">
    <div class="container">
        <div class="row" style="padding-top:10px;padding-bottom:10px">
        <div class="col-sm-4" ><a style="color:#fff;text-transform: uppercase;" href="#" title="Terms">Terms</a>    <a style="color:#fff;text-transform: uppercase;" href="#" title="Privacy">Privacy</a> </div>
    <div class="col-sm-4 text-center">&copy; 2016 Tarzango, LLC  All Rights Reserved </div>
        <div class="col-sm-4 text-right" style="color:#fff; text-transform: uppercase;">Made with  <i><img src="<?php echo $theme_url; ?>img/heart-icon.png" alt="Icon"></i>    in San Francisco</div>
    </div>
        </div>
  </div>
</footer>


<!-- Include all compiled plugins (below), or include individual files as needed --> 
<!-- <script src="<?php echo $theme_url; ?>j/bootstrap.js"></script>  -->
<script src="<?php echo $theme_url; ?>j/jquery.flexslider.js"></script> 
<script src="<?php echo $theme_url; ?>j/owl.carousel.min.js"></script> 
<script src="<?php echo $theme_url; ?>j/general.js"></script>

<script>
// $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        controlsContainer: $(".custom-controls-container"),
        customDirectionNav: $(".custom-navigation a"),
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
   // });
  window.intercomSettings = {
    //app_id: "r8jzxiyp"
  };
</script>
<script>(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/r8jzxiyp';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()</script>
<?php include 'scripts.php'; ?>
<?php echo $app_settings[0]->google; ?>
</body>
</html>
