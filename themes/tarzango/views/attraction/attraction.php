<style type="text/css">
  .img-responsive{
    height: 350px;
    widows: 350px;
  }
  @media screen and (max-width: 650px) {
  header.header-section .menu img{
    margin-top:-90px !important;
    margin-right: -28px !important;
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
          <div class="col-sm-12 part">
            <?php 

              for ($i=0; $i < count($dest) ; $i++) { 

              ?>
                 <div class="col-sm-4">
                  <img class="img-responsive" src="<?php echo base_url().'uploads/images/dest_img/thumb_img/'.$dest[$i]->thumb_img; ?>">
                  <h2><?php echo $dest[$i]->name; ?></h2>
                  <a href="<?php echo base_url().'attraction/city/'.$dest[$i]->top_destinations_id; ?>" ><img class="arrow" src="images/arrow_img.png"></a>
                </div>
            <?php
              if(($i+1) %3 == 0){ ?>
                   </div>
                  <div class="col-sm-12 part">
               <?php  }
             } ?>
           
          </div>
          <div class="col-sm-12 part" style="display:none;">
            <div class="col-sm-4">
              <img class="img-responsive" src="images/city_index_img4.png">
              <h2>San Francisco</h2>
              <a href="#"><img class="arrow" src="images/arrow_img.png"></a>
            </div>
            <div class="col-sm-4">
              <img class="img-responsive" src="images/city_index_img5.png">
              <h2>Atlanta</h2>
              <a href="#"><img class="arrow" src="images/arrow_img.png"></a>
            </div>
            <div class="col-sm-4">
              <img class="img-responsive" src="images/city_index_img6.png">
              <h2>San Diego</h2>
              <a href="#"><img class="arrow" src="images/arrow_img.png"></a>
            </div>
          </div>
          <div class="col-sm-12 part"  style="display:none;">
            <div class="col-sm-4">
              <img class="img-responsive" src="images/city_index_img1.png">
              <h2>Las Vegas</h2>
              <a href="#"><img class="arrow" src="images/arrow_img.png"></a>
            </div>
            <div class="col-sm-4">
              <img class="img-responsive" src="images/city_index_img2.png">
              <h2>New York</h2>
              <a href="#"><img class="arrow" src="images/arrow_img.png"></a>
            </div>
            <div class="col-sm-4">
              <img class="img-responsive" src="images/city_index_img3.png">
              <h2>Miami</h2>
              <a href="#"><img class="arrow" src="images/arrow_img.png"></a>
            </div>
          </div>
          <div class="col-sm-12 part"  style="display:none;">
            <div class="col-sm-4">
              <img class="img-responsive" src="images/city_index_img4.png">
              <h2>Las Vegas</h2>
              <a href="#"><img class="arrow" src="images/arrow_img.png"></a>
            </div>
            <div class="col-sm-4">
              <img class="img-responsive" src="images/city_index_img5.png">
              <h2>New York</h2>
              <a href="#"><img class="arrow" src="images/arrow_img.png"></a>
            </div>
            <div class="col-sm-4">
              <img class="img-responsive" src="images/city_index_img6.png">
              <h2>Miami</h2>
              <a href="#"><img class="arrow" src="images/arrow_img.png"></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="last-section-2">
      <div class="container">
        <div class="row">
          <div class="col-sm-7 vip-text">
            <h1>Become a V.I.P member Now and receive additional</h1>
            <h2>10% off plus some AWESOME Perks</h2>
            <a href="<?php echo base_url().'membership'; ?>">MEMBERSHIP</a>
          </div>
          <div class="col-sm-5 member-ship">
            <img style="margin-top: -80px" src="images/membership-door.png">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
