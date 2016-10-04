<div class="attraction">
  <?php include 'new_header.php'; 
  $dest = $dest[0];
  
  ?>
  <style type="text/css">
    .attraction-body .section1{
          background-image: url('<?php echo base_url().'uploads/images/dest_img/back_img/'.$dest->back_img; ?>');
    }
  </style>
  <div class="container-main main_header">
    <div class="container" style="margin-top: 100px;">
      <div class="row">
        <div class="col-sm-12">
        </div>
        <div class="col-sm-12 page-title">
          <h2 class="">City Information</h2>
          <a  href="<?php echo base_url().'attraction'; ?>"><img src="images/arrow-blue.png"></a>
        </div>
      </div>
    </div>
  </div>
  <div class="attraction-body">
    <div class="section1">
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <h1><?php echo $dest->name; ?></h1>
            <p><?php echo $dest->description; ?></p>
            <a  href="<?php echo base_url().'attraction'; ?>">
            <img src="images/rounded-arrow-left.png"></a>
          </div>
        </div>
      </div>
    </div>
    <div class="section2">
      <ul class="nav nav-tabs">
        <div class="col-sm-3">
        </div>
        <li class="active col-sm-2"><a data-toggle="tab" class="scroll_down" href="#topthingstosee">Top Things to See</a></li>
        <li class="col-sm-2"><a data-toggle="tab" class="scroll_down" href="#topthingstodo">Top Things to Do</a></li>
        <li class="col-sm-2"><a data-toggle="tab" class="scroll_down" href="#placetostay">Place to Stay</a></li>
        <div class="col-sm-3">
        </div>
      </ul>
      <script type="text/javascript">
        $(".scroll_down").click(function(){
            var toshow = $(this).attr('href');
            if(toshow == '#topthingstosee'){
              $('html,body').animate({
              scrollTop: $(".section4").offset().top-100},
              'slow');
            }else if(toshow == '#topthingstodo'){
              $('html,body').animate({
              scrollTop: $(".section5").offset().top-100},
              'slow');
            }else if(toshow == '#placetostay'){
              $('html,body').animate({
              scrollTop: $(".section6").offset().top-100},
              'slow');
            }
            //console.log(toshow);

             /*$('html,body').animate({
              scrollTop: $(".section4").offset().top-100},
              'slow');*/
        });
      </script>
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="tab-content">
              <div id="topthingstosee" class="tab-pane fade in active">
                <p><?php echo $dest->to_see; ?></p>
              </div>
              <div id="topthingstodo" class="tab-pane fade">
                <p><?php echo $dest->to_do; ?></p>
              </div>
              <div id="placetostay" class="tab-pane fade">
                <p><?php echo $dest->to_stay; ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="section3">
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
       

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <?php
            for ($i_s=0; $i_s < count($dest_img) ; $i_s++) { ?>
            <div class="item <?php if($i_s==0){ echo "active"; } ?>">
            <img src="<?php echo PT_DEST_SLIDER.$dest_img[$i_s]->himg_image; ?>" alt="slide">
            <p><?php echo $dest_img[$i_s]->image_title; ?></p>
            </div>
              
          <?php  }

          ?>
          
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
          <span class="fa fa-arrow-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
          <span class="fa fa-arrow-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
    <div class="section4">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h1 class="title">Top Things to Do</h1>
          </div>
          <div class="col-sm-12 part">
          <?php 
          for ($to_do_i=0; $to_do_i < count($to_do) ; $to_do_i++) { 
            
           ?>
            <div class="col-sm-4" style="z-index: 1;">
              <a href="<?php echo base_url().'attraction/details/'.$to_do[$to_do_i]->code; ?>">
              <div class="gradeint">
              <img class="img-responsive" style="width:100%;position: relative;z-index: -1;" src="<?php echo $to_do[$to_do_i]->content->media->images[0]->urls[0]->resource; ?>">
              </div>
              <h2><?php echo $to_do[$to_do_i]->name; ?></h2>
              </a>
            </div>

             <?php
              if(($to_do_i+1) %3 == 0){ ?>
                   </div>
                  <div class="col-sm-12 part">
               <?php  }
             } ?>
            
          </div>
          
        </div>
      </div>
    </div>
    <div class="section5">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h1 class="title">Best Places to Stay</h1>
          </div>
          <style type="text/css">
            .bg_test{
                width: 100%;
                height: 100%;
                background: url('http://unsplash.it/1200x800') center center no-repeat;
                background-size: cover;
                
                
            }
            .bg_test:before {
                  content: '';
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                background-image: linear-gradient(to bottom right,red,red);
                opacity: .6; 
                }
          </style>
          <div class="col-sm-12 part">
            <?php
            /*print_r($to_stay[0]);*/
            /*error_reporting(-1);*/
            /*print_r($to_stay);
            exit();*/
            if(count($to_stay) > 1){
              if(count($to_stay) > 10){
                $l_ary = 9;
              }else{
                $l_ary = count($to_stay);
              }
            }else{
              $l_ary = 0;
            }
            /*echo '----'.$l_ary;
            exit();*/
              for ($h_i=0; $h_i < $l_ary ; $h_i++) {  
                if (getimagesize($to_stay[$h_i]->thumbnail) !== false) {
                  $h_image_d =  str_replace("demo.", '',$to_stay[$h_i]->thumbnail);
                }else{
                  $h_image_d = $theme_url.'images/hotel_default_image.jpg';
                }
                ?>
                <div class="col-sm-4" style="z-index:1">
                
                <span class="gradeint">

              <div class="box first bg_test" >
                </span>
                <div class="stars">
                  <?php echo $to_stay[$h_i]->stars; ?>
                </div>
                <div class="texts">
                  <h1><?php echo $to_stay[$h_i]->title; ?></h1>
                </div>
                <h3>$ <?php echo $to_stay[$h_i]->price; ?><span> /night</span></h3>
                <a href="<?php echo $to_stay[$h_i]->slug; ?>"><img class="arrow" src="images/arrow_img.png"></a>
              </div>
            </div>
            <?php
              if(($h_i+1) %3 == 0){ ?>
                   </div>
                  <div class="col-sm-12 part">
               <?php  }
             } ?>

          </div>
          
        </div>
      </div>
    </div>
    <div class="section6">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h1 class="title">Top Things to See</h1>
          </div>
          <div class="">
            <table class="table">
              <tr>
                <td><div class="col-sm-3 normal">
                  <img class="img-responsive" src="images/attraction-page-image18.png">
                  <p>Titanic The Artifact Exhibition</p>
                </div></td>
                <td rowspan=2><div class="col-sm-3 full-vertical">
                  <img class="img-responsive" src="images/attraction-page-image20.png">
                  <p>Venetian Gondola Ride</p>
                </div></td>
                <td colspan=2><div class="col-sm-6 full-horizontal">
                  <img class="img-responsive" src="images/attraction-page-image24.png">
                  <p>Palazzo Waterfall Atrium and Gardens</p>
                </div></td>
              </tr>
              <tr>
                <td><div class="col-sm-3 normal">
                  <img class="img-responsive" src="images/attraction-page-image17.png">
                  <p>Red Rock Canyon</p>
                </div></td>
                <td colspan=2 rowspan=2><div class="col-sm-6 full-vertical-horizontal">
                  <img class="img-responsive" src="images/attraction-page-image21.png">
                  <p>Mirage Volcano</p>
                </div></td>
              </tr>
              <tr>
                <td colspan=2><div class="col-sm-6 full-horizontal">
                  <img class="img-responsive" src="images/attraction-page-image23.png">
                  <p>Eiffel Tower Experience at paris Las Vegas</p>
                </div></td>
              </tr>
              <tr>
                <td><div class="col-sm-3 normal">
                  <img class="img-responsive" src="images/attraction-page-image15.png">
                  <p>The Neon Boneyard</p>
                </div></td>
                <td><div class="col-sm-3 normal">
                  <img class="img-responsive" src="images/attraction-page-image16.png">
                  <p>Mob Mueseum</p>
                </div></td>
                <td rowspan=2><div class="col-sm-3 full-vertical">
                  <img class="img-responsive" src="images/attraction-page-image19.png">
                  <p>Avengers S.T.A.T.I.O.N</p>
                </div></td>
                <td><div class="col-sm-3 normal">
                  <img class="img-responsive" src="images/attraction-page-image14.png">
                  <p>Fall of Atlantis at Ceasers</p>
                </div></td>
              </tr>
              <tr>
                <td colspan=2><div class="col-sm-6 full-horizontal">
                  <img class="img-responsive" src="images/attraction-page-image22.png">
                  <p>Flamingo Wildlife Habitat</p>
                </div></td>
                <td><div class="col-sm-3 normal">
                  <img class="img-responsive" src="images/attraction-page-image13.png">
                  <p>Streetmosphere at the Venetian</p>
                </div></td>
              </tr>
            </table>
          </div>
          
        </div>
      </div>
    </div>
    <div class="last-section-2">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h1>Become a V.I.P member Now and receive additional</h1>
            <h2>10% off plus some AWESOME Perks</h2>
            <a href="">MEMBERSHIP</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
