<link rel="stylesheet" href="<?php echo $theme_url; ?>assets/css/circle.css" />
<link rel="stylesheet" href="<?php echo $theme_url; ?>assets/css/single.css" />
<link href="<?php echo $theme_url; ?>assets/include/slider/slider.min.css" rel="stylesheet" />
<link href="<?php echo $theme_url; ?>assets/css/magnific-popup.css" rel="stylesheet" />
<script src="<?php echo $theme_url; ?>assets/js/single.js"></script>
<script src="<?php echo $theme_url; ?>/assets/js/jquery.nicescroll.min.js"></script>
<script src="<?php echo $theme_url; ?>assets/include/slider/slider.js"></script>
<div class="mtslide2 sliderbg2"></div>
 <?php include 'includes/head.php';?>
 <?php include 'includes/map.php';?>
<div id="OVERVIEW" class="container">
<div class="row">
  <div class="col-md-12">
    <div class="panel with-nav-tabs panel-default">
    <div class="tabsbar">
        <ul class="RTL visible-lg visible-md nav nav-tabs nav-justified">
          <li class="text-center"><a class="tabsBtn" href="#OVERVIEW" data-toggle="tab"><?php echo trans('0248');?></a></li>
          <li class="text-center"><a class="tabsBtn" href="#ROOMS" data-toggle="tab"><?php echo trans('016');?></a></li>
          <li class="text-center"><a class="tabsBtn" href="#DESCRIPTION" data-toggle="tab"><?php echo trans('046');?></a></li>
          <li class="text-center"><a class="tabsBtn" href="#AMENITIES" data-toggle="tab"><?php echo trans('0249');?></a></li>
          <li class="text-center"><a class="tabsBtn" href="#RELATED" data-toggle="tab"><?php echo trans('0290');?></a></li>
        </ul>
    </div>
      <div style="padding:10px">
        <div class="row">
           <?php include 'includes/slider.php';?>
           <?php include 'includes/aside.php';?>
        </div>
        </div>
      </div>
    </div>
  </div>
<?php include 'includes/review.php';?>
  </div>
    <?php include 'includes/rooms.php';?>
    <?php include 'includes/overview.php';?>
    <section class="bg-white">
      <div class="container">
      <div class="row">
        <hr>
      <div class="clearfix"></div>
     <?php include 'includes/amenities.php';?>
     <div class="visible-xs"><br></div>
     <?php include 'includes/reviews.php';?>
     </div>
      <br>
     </div>
    </section>
    <?php  if(empty($relatedHotels->errorMsg)){ include 'includes/related.php'; } ?>
    <?php include 'ages.php';?>
