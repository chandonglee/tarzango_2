<?php require $themeurl.'views/home/slider.php';?>
<div class="features hidden-sm hidden-xs">
  <div class="container">
    <div class="row">
      <div data-wow-duration="1s" data-wow-delay="2s" class="wow fadeInUp col-md-3">
        <div class="row">
          <div class="col-md-4">
            <img data-wow-duration="2s" data-wow-delay="2s" class="wow fadeInUp img-rounded" src="<?php echo $theme_url; ?>assets/img/listings.jpg" alt="listings" />
          </div>
          <div class="col-md-8">
            <h4><?php echo trans('0380');?></h4>
          </div>
        </div>
      </div>
      <div data-wow-duration="1s" data-wow-delay="3s" class="wow fadeInUp col-md-3">
        <div class="row">
          <div class="col-md-4">
            <img data-wow-duration="2s" data-wow-delay="3s" class="wow fadeInUp img-rounded" src="<?php echo $theme_url; ?>assets/img/manage.jpg" alt="manage" />
          </div>
          <div class="col-md-8">
            <h4><?php echo trans('0382');?></h4>
          </div>
        </div>
      </div>
      <div data-wow-duration="1s" data-wow-delay="4s" class="wow fadeInUp col-md-3">
        <div class="row">
          <div class="col-md-4">
            <img data-wow-duration="2s" data-wow-delay="3s" class="wow fadeInUp img-rounded" src="<?php echo $theme_url; ?>assets/img/money.jpg" alt="money" />
          </div>
          <div class="col-md-8">
            <h4><?php echo trans('0381');?></h4>
          </div>
        </div>
      </div>
      <div data-wow-duration="1s" data-wow-delay="5s" class="wow fadeInUp col-md-3">
        <div class="row">
          <div class="col-md-4">
            <img data-wow-duration="3s" data-wow-delay="4s" class="wow fadeInUp img-rounded" src="<?php echo $theme_url; ?>assets/img/secure.jpg" alt="secure" />
          </div>
          <div class="col-md-8">
            <h4><?php echo trans('0383');?></h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <br><br>
  <div class="row">
    <!-- Hotel -->
    <?php if(pt_main_module_available('hotels')){ ?> <div class="form-group"> <h2 class="main-title go-right"><?php echo trans('056');?></h2> <div class="clearfix"></div> <i class="tiltle-line go-right"></i> </div> <?php foreach($featuredHotels as $item){ ?> <div class="col-md-4 col-sm-6 col-xs-12 wow fadeInUp animated"> <div class="row"> <div class="img_list"> <a href="<?php echo $item->slug;?>"> <img class="dealthumb go-right" src="<?php echo $item->thumbnail;?>" alt="<?php echo character_limiter($item->title,35);?>"> <div class="short_info"></div> </a> </div> <div class="custom"> <div class="dealtitle go-right"> <p><a href="<?php echo $item->slug;?>" class="dark go-text-right go-right rtl_title_home shadow"><?php echo character_limiter($item->title,20);?></a></p> <span class="size13 white mt-9 go-right"><?php echo $item->stars;?> <br><span class="go-right"><?php echo character_limiter($item->location,20);?>&nbsp;</span></span> </div> <div class="dealprice go-left mt0"> <?php if($item->price > 0){ ?> <p class="size12 white lh2"><?php echo $item->currCode;?> <span class="white shadow rate"> <?php echo $item->currSymbol; ?><?php echo $item->price;?> <?php } ?> </span> </p> </div> </div> </div> </div> <?php } ?> <div class="clearfix"></div> <br><br> <?php } ?>
    <!-- Hotel -->

    <!-- Expedia Hotels -->
    <?php if(pt_main_module_available('ean')){ ?> <div class="form-group"> <h2 class="main-title go-right"><?php echo trans('056');?></h2> <div class="clearfix"></div> <i class="tiltle-line go-right"></i> </div> <?php foreach($featuredHotelsEan->hotels as $item){ ?> <div class="col-md-4 col-sm-6 col-xs-12 wow fadeInUp animated"> <div class="row"> <div class="img_list"> <a href="<?php echo $item->slug;?>"> <img class="dealthumb go-right" src="<?php echo $item->thumbnail;?>" alt="<?php echo character_limiter($item->title,35);?>"> <img class="overlay" src="<?php echo $theme_url; ?>assets/img/overlay.png" style="z-index: "> <div class="short_info"></div> </a> </div> <div class="custom"> <div class="dealtitle go-right"> <p><a href="<?php echo $item->slug;?>" class="dark go-text-right go-right rtl_title_home shadow"><?php echo character_limiter($item->title,20);?></a></p> <span class="size13 white mt-9 go-right"><?php echo $item->stars;?> <br><span class="go-right"><?php echo character_limiter($item->location,20);?>&nbsp;</span></span> </div> <div class="dealprice go-left mt0"> <?php if($item->price > 0){ ?> <p class="size12 white lh2"><?php echo $item->currCode;?> <span class="white shadow rate"> <?php echo $item->currSymbol; ?><?php echo $item->price;?> <?php } ?> </span> </p> </div> </div> </div> </div> <?php } ?> <div class="clearfix"></div> <br><br> <?php } ?>
    <!-- Expedia Hotels -->

    <!-- Tours -->
    <?php if(pt_main_module_available('tours')){ ?> <div class="form-group"> <h2 class="main-title go-right"><?php echo trans('0451');?></h2> <div class="clearfix"></div> <i class="tiltle-line go-right"></i> </div> <div class="row" ng-controller="appCtrl as ctrl" layout="column" ng-cloak="" ng-app="phptravelsApp"> <div id="accordion"> <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInLeft animated"> <div class="list-group"> <a href="javascript:void(0)" class="list-group-item active"><i class="icon_set_1_icon-61"></i> <?php echo trans('032');?></a> <?php $toursLocation = toursWithLocations(); foreach($toursLocation->locations as $loc){ ?> <a href="" class="list-group-item" ng-click="getData(<?php echo $loc->id;?>)"><i class="icon_set_1_icon-41"></i> <?php echo $loc->name; ?> <span class="btn btn-default btn-xs pull-right"><?php echo $loc->count; ?></span></a> <?php } ?> </div> </div> <div class="panel"> <div id="collapse1" class="panel-collapse collapse in"> <div class="col-md-9 col-sm-6 col-xs-12"> <div class="col-lg-{{lg}} col-md-{{md}} col-sm-12 col-xs-12 wow fadeIn animated" ng-repeat="item in items"> <div class="row"> <div class="img_list"> <a href="{{item.slug}}"> <img class="dealthumb go-right" ng-src="{{item.thumbnail}}" alt="{{item.title}}"> <div class="short_info"></div> </a> </div> <div class="custom"> <div class="dealtitle go-right"> <p><a href="<?php echo $item->slug;?>" class="dark go-text-right go-right rtl_title_home shadow"> {{item.title | strLimit: 20}} </a></p> <span class="size13 white mt-9 go-right"><span ng-bind-html="item.stars"></span> <br><span class="go-right"> {{item.location | strLimit: 20}}</span></span> </div> <div class="dealprice go-left mt0"> <p class="size12 white lh2">{{item.currCode}} <span class="white shadow rate"> {{item.currSymbol}}{{item.price}} </span> </p> </div> </div> </div> </div> </div> </div> </div> </div> </div> <div class="clearfix"></div> <br><br> <style> .panel { margin-bottom: 0px; background-color: transparent; border: 1px solid transparent; border-radius: 0px; -webkit-box-shadow: 0 0px 0px rgba(0, 0, 0, .05); box-shadow: 0 0px 0px rgba(0, 0, 0, .05); } </style> <?php } ?> <script src='//ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.js'></script> <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-sanitize.js"></script> <script type="text/javascript"> (function () { 'use strict'; angular .module('phptravelsApp',['ngSanitize']) .controller('appCtrl', appCtrl); function appCtrl ($scope, $http) { var self = this; var url = "<?php echo base_url();?>tours/featuredTours/"; $scope.lg = "6"; $scope.md = "6"; $scope.items = []; $http.get(url).success(function(data) { $scope.items = data; $scope.setClasses($scope.items); }); $scope.getData = function(loc){ $http.get(url+loc).success(function(data) { $scope.items = data; $scope.setClasses($scope.items); }); }; $scope.setClasses = function(data){ var totalItems = data.length; if(totalItems == 1){ $scope.lg = "6 tours12"; $scope.md = "6 tours12"; }else if(totalItems == 2){ $scope.lg = "6"; $scope.md = "6"; }else if(totalItems > 2){ $scope.lg = "6"; $scope.md = "6"; } }; } angular.module('phptravelsApp').filter('strLimit', function() { 'use strict'; return function(input, limit) { if (input) { if (limit > input.length) { return input.slice(0, limit); } else { return input.slice(0, limit) + '...'; } } }; }); })(); </script>
    <!-- Tours -->

    <!-- Cars -->
    <?php if(pt_main_module_available('cars')){ ?> <div class="form-group"> <h2 class="main-title go-right"><?php echo trans('0490');?></h2> <div class="clearfix"></div> <i class="tiltle-line go-right"></i> </div> <?php foreach($featuredCars as $item){ ?> <div class="col-md-4 col-sm-6 col-xs-12 wow fadeInUp animated"> <div class="row"> <div class="img_list"> <a href="<?php echo $item->slug;?>"> <img class="dealthumb go-right" src="<?php echo $item->thumbnail;?>" alt="<?php echo character_limiter($item->title,35);?>"> <div class="short_info"></div> </a> </div> <div class="custom"> <div class="dealtitle go-right"> <p><a href="<?php echo $item->slug;?>" class="dark go-text-right go-right rtl_title_home shadow"><?php echo character_limiter($item->title,20);?></a></p> <span class="size13 white mt-9 go-right"><?php echo $item->stars;?> <br><span class="go-right"><?php echo character_limiter($item->location,20);?>&nbsp;</span></span> </div> <div class="dealprice go-left mt0"> <?php if($item->price > 0){ ?> <p class="size12 white lh2"><?php echo $item->currCode;?> <span class="white shadow rate"> <?php echo $item->currSymbol; ?><?php echo $item->price;?> <?php } ?> </span> </p> </div> </div> </div> </div> <?php } ?> <div class="clearfix"></div> <br><br> <?php } ?>
    <!-- Cars -->
  </div>
</div>

<!-- offers -->
<?php if($offersCount > 0){ ?> <div class="lastminute4"> <div class="container"> <div class="form-group"> <h2 class="main-title"><?php echo trans('0341');?> <?php echo trans('Offers');?></h2> <div class="clearfix"></div> <i class="tiltle-line"></i> </div> <div class="row"> <!-- Carousel --> <div class="wrapper"> <div class="list_carousel wow fadeInUp"> <ul id="foo2"> <?php foreach($specialoffers as $offer){ ?> <li> <a href="<?php echo $offer->slug;?>"><img class="offers-hover img-responsive" src="<?php echo $offer->thumbnail;?>" alt="<?php echo character_limiter($offer->title,15);?>"/></a> <div class="m1"> <h6 class="lh1 dark go-right"><b> <?php echo character_limiter($offer->title,35);?> &nbsp;&nbsp;</b></h6> <h6 class="lh1 green go-right"> <!--<?php echo character_limiter($offer->desc,120);?>--> <?php if($offer->price > 0){ ?> <?php echo $offer->currCode;?> <b><?php echo $offer->currSymbol; ?><?php echo $offer->price;?></b> <?php } ?>&nbsp;&nbsp; </h6> </div> </li> <?php } ?> </ul> <div class="clearfix"></div> <a id="prev_btn2" class="prev offers" href="#"><img src="<?php echo $theme_url; ?>images/spacer.png" alt=""/></a> <a id="next_btn2" class="next offers" href="#"><img src="<?php echo $theme_url; ?>images/spacer.png" alt=""/></a> </div> </div> </div> </div> </div> <?php } ?>
<!-- offers -->