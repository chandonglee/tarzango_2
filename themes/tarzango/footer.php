
</div>
<?php  $CI = &get_instance(); $app_settings = $CI->settings_model->get_settings_data(); $lang_set = $CI->theme->_data['lang_set']; ?>
<?php if($app_settings[0]->mobile_pic_status == "Yes"){  ?>
<div class="hidden-xs" style="position: fixed;width: 99px;height: 171px;right: 0;z-index: 9999;left: 0;top: 50%;margin-top: -85px;">
  <a href="<?php echo $app_settings[0]->mobile_pic_url; ?>" target="_blank"><img src="<?php echo $theme_url; ?>assets/img/app.png"  alt="phone application" /></a>
</div>
<?php } ?>

<style type="text/css">
  
  a:hover, a:focus {
    
    text-decoration: none !important;
}
.social_network .fa{
  color: #fff; font-size: 25px !important; cursor: pointer;
}
</style>
<footer>
  <div class="footer-above">
    <div class="container">
    <div class="col-sm-8">
      <div class="footer-logo">
        <a href=""><img src="img/logo.png"></a>
      </div>
      <div class="footer-contact">
        <a style="" href="tel:4156803008" title="Call Us"> <?php echo $phone; ?></a><br>
        <a style="" href="mailto:hello@tarzango.com" title="Email Us"><?php echo $contactemail; ?></a>
      </div>
      <div class="social-address">
        <div class="social">
           <ul class="list-unstyled" >
                <?php
                $footersocials = pt_get_footer_socials();
                foreach ($footersocials as $key => $value) {
                 
                  if($value->social_name == 'Facebook'){
                ?>
                  <a class="social_network" target="popup" onclick="window.open('<?php echo $value->social_link;?>','name','width=800,height=600')" >  <i class="fa fa-facebook"></i>  </a> 

                  <?php } if($value->social_name == 'Twitter'){  ?>

                  <a class="social_network" target="popup" onclick="window.open('<?php echo $value->social_link;?>','name','width=800,height=600')" > <i class="fa fa-twitter"></i>  </a> 

                  <?php } if($value->social_name == 'Instagram'){  ?>

                   <a class="social_network" target="popup" onclick="window.open('<?php echo $value->social_link;?>','name','width=800,height=600')" > <i class="fa fa-instagram"></i> </a>
                  <?php } } ?>
                  <!-- <li class="linkedin-button"> <a href="<?php echo $value->social_link;?>"> <span class="fa-stack fa-2x"> <i class="fa fa-linkedin"></i> </span> </a> </li> -->

                </ul>
        </div>
        <div class="address">
          <p>Tarzango, LIC, <?php echo $contact_address; ?></p>
        </div>
      </div>
    </div>
    <div class="col-sm-2 footerlink1" >
      <div class="footer-menu-1">
        <p>About Us</p>
        <ul>
         <li><a href="<?php echo base_url().'how_to_book'; ?>" title="How to Book"> How to Book</a></li>
          <li><a href="<?php echo base_url().'booking_tips'; ?>" title="Booking Tips">Booking Tips</a></li>
          <li><a href="<?php echo base_url().'About_us'; ?>" title="About Us">About Us</a></li>
          <li><a href="<?php echo base_url().'become-a-supplier'; ?>" title="Become Supplier">Become Supplier</a></li>
          <li><a href="<?php echo base_url().'services' ?>" title="Services">Services</a></li>
        </ul>
      </div>
    </div>
    <div class="col-sm-2 footerlink2">
      <div class="footer-menu-2">
        <p>Support</p>
        <ul>
          <li><a href="<?php echo base_url().'contact-us'; ?>" title="Contact"> Contact</a></li>
          <li><a href="<?php echo base_url().'faq'; ?>" title="FAQ and Help">FAQ &amp; Help</a></li>
          <li><a href="<?php echo base_url().'terms-condition'; ?>" >Terms & Conditions</a></li>
          <li><a href="<?php echo base_url().'supplier'; ?>" title="Supplier Login">Supplier Login</a></li>
          <?php  if(!empty($customerloggedin)){ ?>
          <li><a href="<?php echo base_url().'account'; ?>" title="My Account">My Account</a></li>
          <?php }else{ ?>
          <li><a href="<?php echo base_url().'login'; ?>" title="My Account">My Account</a></li>
          <?php } ?>
        </ul>
      </div>
    </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
    <div class="col-sm-3">
      <a href="<?php echo base_url().'Terms-Conditions'; ?>">TERMS</a>
      <a href="<?php echo base_url().'Terms-Conditions'; ?>">PRIVACY</a>
    </div>
    <div class="col-sm-6 text-center">
      <p>@ 2016 Tarzango, LLC All Rights Reserved</p>
    </div>
    <div class="col-sm-3">
      <p>MADE WITH <img src="images/heart.png"> IN SAN FRANCISCO</p>
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
   // app_id: "r8jzxiyp"
  };
</script>
<script>(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/r8jzxiyp';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()</script>
<?php include 'scripts.php'; ?>
<?php echo $app_settings[0]->google; ?>
</body>
</html>
