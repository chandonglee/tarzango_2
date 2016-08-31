<?php  $CI = &get_instance(); $app_settings = $CI->settings_model->get_settings_data(); $lang_set = $CI->theme->_data['lang_set']; ?>
<?php if($app_settings[0]->mobile_pic_status == "Yes"){  ?>
<div class="hidden-xs" style="position: fixed;width: 99px;height: 171px;right: 0;z-index: 9999;left: 0;top: 50%;margin-top: -85px;">
  <a href="<?php echo $app_settings[0]->mobile_pic_url; ?>" target="_blank"><img src="<?php echo $theme_url; ?>assets/img/app.png"  alt="phone application" /></a>
</div>
<?php } ?>
<div id="footer" class="<?php echo @$hidden; ?> footerbg" >
  <div class="container">
    <div class="clearfix"></div>
    <div class="col-md-3">
      <br>
      <?php if(pt_is_module_enabled('newsletter')){ ?>
      <div id="message-newsletter_2"></div>
      <form role="search" onsubmit="return false;">
      </form>
      <span class="ftitle go-right"><?php echo trans('023');?></span>
      <div class="clearfix"></div>
      <br>
      <div class="relative">
        <input type="email" class="form-control fccustom2 sub_email" id="exampleInputEmail1" placeholder="<?php echo trans('0403');?>" required>
        <div style="color:white" class="subscriberesponse"></div>
        <button type="submit" class="btn btn-default btncustom sub_newsletter">&nbsp;</button>
      </div>
      <?php } ?>
      <br>
      <div class="scont">
        <div class="clearfix"></div>
        <div id="social_footer go-right">
          <?php
            $footersocials = pt_get_footer_socials();
            foreach($footersocials as $fs){
            ?>
          <a href="<?php echo $fs->social_link;?>" target="_blank"><img src="<?php echo PT_SOCIAL_IMAGES; ?><?php echo $fs->social_icon;?>" class="social-icons-footer" /></a>
          <?php } ?>
        </div>
        <img src="<?php echo $theme_url; ?>/assets/img/payments.png" width="233" height="30" data-retina="true" class="img-responsive">
        <br>
        <!--<strong class="white"><?php echo trans('0295');?></strong>-->
      </div>
    </div>
    <!-- End of column 1-->
    <?php get_footer_menu_items(3,"wow fadeInLeft col-xs-6 col-md-3 go-right","ftitle go-text-right","footerlist go-right go-text-right" );?>
    <?php get_footer_menu_items(19,"wow fadeInRight col-xs-6 col-md-3 go-right","ftitle go-text-right","footerlist go-right go-text-right" );?>
    <div class="col-md-3 grey go-right" id="newsletter" style="margin-top:15px">
      <div class="clearfix"></div>
      <div class="clearfix"></div>
      <div class="footer-brand wow bounceIn">
      <a href="<?php echo base_url(); ?>"><img src="<?php echo PT_GLOBAL_IMAGES_FOLDER.$app_settings[0]->header_logo_img;?>" class="img-responsive"/></a>
      <p class="text-center" style="font-size:12px" >&copy; <?php echo $app_settings[0]->copyright;?></p>
      </div>
      <form action="<?php echo base_url(); ?>supplier-register" type="POST">
      <button type="submit" style="margin-bottom:6px" class="btn btn-success btn-block"> <?php echo trans('0241');?></button>
      </form>
      <a class="text-center go-right ftitle hidden-xs" href="mailto:<?php echo $contactemail; ?>" id="email_footer"><div class="text-center"><i style="font-size:18px" class="icon-email"></i> <span ><?php echo $contactemail; ?></span></div></a>
      <?php if(!empty($phone)){ ?><div style="font-size:22px" class="text-center hidden-xs pnr go-right"><i class="icon_set_1_icon-55"></i> <?php echo $phone; ?></div><?php } ?><br/>
      <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
  </div><br><br>
</div>
<div class="footerbg3 hidden-xs">
  <div class="container center grey">
    <a href="#top" class="gotop scroll wow fadeInUp"><img src="<?php echo $theme_url; ?>images/spacer.png" /></a>
  </div>
</div>
<?php include 'scripts.php'; ?>
<?php echo $app_settings[0]->google; ?>
</body>
</html>