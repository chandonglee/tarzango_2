<style type="text/css">
.img-responsive {
	height: 350px;
	widows: 350px;
}

@media screen and (max-width: 650px) {
header.header-section .menu img {
	/*margin-top: -90px !important;
	margin-right: -28px !important;*/
}
header.header-section .logo img {
	float: none;
	padding-right: 0px;
	height: 50px !important;
	width: 60px;
	margin-top: 16px;
}
.inner-section .menu-dropdown {
	z-index: 9999;
	background-position: center center;
	margin: -60px -15px 0;
	right: -20px !important;
	top: 0;
	width: 335px !important;
}
}
</style>
<div class="city-index-search">
  <?php 
/*error_reporting(-1);*/
  include 'header_search.php'; ?>
  <div class="city-index-search-body inner-block-b">
    <div class="image-gallery">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h1 class="title">Top Destinations</h1>
          </div>
          <div class="part">
            <?php 

              for ($i=0; $i < count($dest) ; $i++) { 

              ?>
            <div class="col-sm-4"> <img class="img-responsive" src="<?php echo base_url().'uploads/images/dest_img/thumb_img/'.$dest[$i]->thumb_img; ?>">
              <h2><?php echo $dest[$i]->name; ?></h2>
              <a href="<?php echo base_url().'attraction/city/'.$dest[$i]->top_destinations_id; ?>" ><img class="arrow" src="images/arrow_img.png"></a> </div>
            <?php
              if(($i+1) %3 == 0){ ?>
              <div class="clearfix"></div>
          </div>
          <div class="part">
            <?php  }
             } ?>
             <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
          <div class="part" style="display:none;">
            <div class="col-sm-4"> <img class="img-responsive" src="images/city_index_img4.png">
              <h2>San Francisco</h2>
              <a href="#"><img class="arrow" src="images/arrow_img.png"></a> </div>
            <div class="col-sm-4"> <img class="img-responsive" src="images/city_index_img5.png">
              <h2>Atlanta</h2>
              <a href="#"><img class="arrow" src="images/arrow_img.png"></a> </div>
            <div class="col-sm-4"> <img class="img-responsive" src="images/city_index_img6.png">
              <h2>San Diego</h2>
              <a href="#"><img class="arrow" src="images/arrow_img.png"></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="part"  style="display:none;">
            <div class="col-sm-4"> <img class="img-responsive" src="images/city_index_img1.png">
              <h2>Las Vegas</h2>
              <a href="#"><img class="arrow" src="images/arrow_img.png"></a> </div>
            <div class="col-sm-4"> <img class="img-responsive" src="images/city_index_img2.png">
              <h2>New York</h2>
              <a href="#"><img class="arrow" src="images/arrow_img.png"></a> </div>
            <div class="col-sm-4"> <img class="img-responsive" src="images/city_index_img3.png">
              <h2>Miami</h2>
              <a href="#"><img class="arrow" src="images/arrow_img.png"></a> </div>
            <div class="clearfix"></div>
          </div>
          <div class="part"  style="display:none;">
            <div class="col-sm-4"> <img class="img-responsive" src="images/city_index_img4.png">
              <h2>Las Vegas</h2>
              <a href="#"><img class="arrow" src="images/arrow_img.png"></a> </div>
            <div class="col-sm-4"> <img class="img-responsive" src="images/city_index_img5.png">
              <h2>New York</h2>
              <a href="#"><img class="arrow" src="images/arrow_img.png"></a> </div>
            <div class="col-sm-4"> <img class="img-responsive" src="images/city_index_img6.png">
              <h2>Miami</h2>
              <a href="#"><img class="arrow" src="images/arrow_img.png"></a> </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="container-fluid how-section vip-membership">
      <div class="container">
        <div class="col-md-7 ptop70">
          <h4 class="description" style="text-align:left;font-size:30px;padding-bottom: 0px;">Become a V.I.P member Now and receive additional</h4>
          </br>
          <h4 style="text-align:left;font-size:30px;margin-top:-10px;font-family: 'Apercu-Bold';">10% off plus some AWESOME perks...</h4>
          <a href="<?php echo base_url().'membership';?>" style="float:left" title="group booking" class="pink-btn">membership</a> </div>
        <div class="col-sm-5"> <img style="margin-top: 0px" src="images/membership-door.png"> </div>
      </div>
    </div>
  </div>
</div>
</div>
