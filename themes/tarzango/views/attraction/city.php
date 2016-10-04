
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
        <?php //if(count($b_Data['all']) > 0 && $b_Data['all'] != ''){ ?>
        <li class="active col-sm-2"><a data-toggle="tab" class="scroll_down" href="#topthingstosee">Top Things to See</a></li>
        <?php //}else{ ?>
        <!-- <li class=" col-sm-2"></li> -->
        
        <?php// } ?>
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
              scrollTop: $(".section6").offset().top-100},
              'slow');
            }else if(toshow == '#topthingstodo'){
              $('html,body').animate({
              scrollTop: $(".section4").offset().top-100},
              'slow');
            }else if(toshow == '#placetostay'){
              $('html,body').animate({
              scrollTop: $(".section5").offset().top-100},
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
    <?php if(count($dest_img) > 0){ ?>
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
    <?php } ?>
    <div class="section4">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h1 class="title">Top Things to Do</h1>
          </div>
          <div class="col-sm-12 part">
          <?php 
          $datetime = new DateTime('tomorrow');
        $datetime->modify('+1 day');
        $checkIn =  $datetime->format('m/d/Y');
          for ($to_do_i=0; $to_do_i < count($to_do) ; $to_do_i++) { 
            
           ?>
            <div class="col-sm-4" style="z-index: 1;">
              <a href="<?php echo base_url().'attraction/details/'.$id.'/'.$to_do[$to_do_i]->code.'?adults=1&child=0&checkIn='.$checkIn.'&lat='.$lat.'&long='.$long; ?>">
              <div class="gradeint">
              <img class="img-responsive" style="width:100%;position: relative;z-index: -1; height: 273px;" src="<?php echo $to_do[$to_do_i]->content->media->images[0]->urls[0]->resource; ?>">
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
                
                
              <div class="box first" style="background-image:linear-gradient(to bottom, rgba(248,80,50,0) 0%, rgba(12,19,79,1) 100%),url('<?php echo  $h_image_d; ?>'); ">
                
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
    <style type="text/css">
      .box {
  height: 100%;
  float: left;
  background: #fff;
  overflow: hidden;
  border-radius: 4px;
  box-shadow: 0px 1px 3px rgba(0,0,0,0.2);
}

.wrapper {
  display: block;
  width: 97%;
  padding: 1.5% 1.5% 0 1.5%; 
  height: 350px;
  float: left;
}

.single .box {
  width: 100%;
}

a {
  border: 0;
  text-decoration: none;
}

/* 2 IMAGES PER WRAPPER */
.left-big .box:last-child { width: 35%; }
.left-small .box, .left-big .box { width: 65%; }
.left-small .box:first-child { margin: 0 1.5% 0 0; width: 33.5%; }
.left-big .box:first-child { margin: 0 1.5% 0 0; width: 63.5%; }

/* 3 IMAGES PER WRAPPER */
.big-middle .box:nth-child(2) { width: 47%; margin: 0 1.5%; }
.big-middle .box:first-child, .big-middle .box:last-child { width: 25%; }
.small-middle .box:nth-child(2) { margin: 0 1.5%; width: 22%; }
.small-middle .box:first-child, .small-middle .box:last-child { width: 37.5%; }

/* 4 IMAGES PER WRAPPER */

.middle-two-rows .box, .right-two-rows .box  { width: 25%; }

.right-two-rows .box:nth-of-type(2) {
  margin: 0 0 0 1.5%;
  width: 23.5%;
}

.middle {
  float: left;
  width: 47%;
  height: 100%;
  margin: 0 1.5%;
}

.middle .box {
  height: 165px;
  width: 100%;
  clear: both;
  margin: 0;
}

.right-two-rows .middle .box:last-child {
  margin: 0;
}
.right-two-rows .middle {
  margin: 0 0 0 1.5%;
  width: 48.5%;
}

.right-two-rows .middle .box {
  width: 100%;
}

.middle .box:first-child {
  margin: 0 0 20px 0;
}


/* 5 IMAGES PER WRAPPER */

.four-block .box { width: 48.5%; margin: 0 1.5% 0 0; }

.block {
  width: 50%;
  height: 100%;
  float: left;
}
.block .box {
  margin: 0;
  height: 165px;
  margin: 0 3% 0 0;
}

.block .box:nth-of-type(3), .block .box:nth-of-type(4) { margin-top: 20px; }
.block .box:nth-child(2), .block .box:nth-child(4) { margin-right: 0; }


/* INDIVIDUAL STYLING OF EACH BLOCK. YOU MIGHT WANT TO IGNORE THIS */

.blue {
  font-family: 'Bree Serif', serif;
  font-size: 70px;
  text-align: center;
  background: #45bed4;
  text-align: center;
  -webkit-transition: all 0.2s ease-in;
  -moz-transition: all 0.2s ease-in;
  -o-transition: all 0.2s ease-in;
}

.blue:hover {
  box-shadow: 0px 1px 3px rgba(0,0,0,0.2), inset 0px 0px 30px rgba(0,0,0,0.2);
}

.blue span:first-of-type {
  padding: 50px 0 0 0;
  color: rgba(0,0,0,0.7);
  display: block;
}
.blue span:last-of-type {
  display: block;
  width: 100%;
  font-size: 30px;
  color: rgba(255,255,255,0.9);
  text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
}

.box-1 {
  background: url('http://www.inserthtml.com/wp-content/uploads/2012/02/cssvariables.jpg') -500px 0;
}

.box-2 {
  background: url('http://www.inserthtml.com/wp-content/uploads/2012/02/css-slider.jpg') -150px 0;
}

.box-3 {
  background: url('http://www.inserthtml.com/wp-content/uploads/2012/03/main.jpg') -200px 0;
}

.box-4 {
  background: url('http://www.inserthtml.com/wp-content/uploads/2011/12/16.jpg') -300px 0;
}
.box-1 span, .box-4 span {
  padding-top: 35px;
  display: block;
  text-decoration: none;
  text-align: center;
  text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
  color: #fff;
  font-size: 50px;
  font-family: 'Bree Serif', serif;
}


.box div {
  padding: 0px 20px;
  color: #fff;
  font-family: 'Bree Serif', serif;
  text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
  font-size: 30px;
  position: relative;
}

.zoom {
  background: #c06be3;
  box-shadow: inset 0px 0px 90px #8d43ac;
}

.zoom h2 {
  color: #fff;
  margin: 10px 0 0 0;
}

.dark-blue {
  background: #2a333c;
  box-shadow: inset 0px 0px 90px #171d23;
  text-align: justify;
  overflow: hidden;
  position: relative;
}

.dark-blue:after {
  content: " ";
  background: rgba(0,0,0,0);
  position: absolute;
  top: 0; left: 0;
  width: 100%; height: 100%;
  border-radius: 5px;
  box-shadow: inset 0px -30px 60px #171d23;
}

.dark-blue div {
  font-size: 25px;
  padding-top: 10px;
}

.bottom {
  position: absolute;
  bottom: 10px;
  right: 10px;
}
    </style>
     <script type="text/javascript" src="js/javascript.js"></script>
     <?php if(count($b_Data['all']) > 0 && $b_Data['all'] != ''){ ?>
    <div class="section6">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h1 class="title">Top Things to See</h1>
          </div>
         
          <div id="holder">
            
            <!-- INITIAL BOXES, ALWAYS THE SAME -->
           <?php foreach($b_Data['all'] as $post){ ?>
            <div class="box box-1" style="background: url('<?php echo pt_post_thumbnail(str_replace("demo.","",$post->post_id)); ?>'); background-repeat: no-repeat; background-size: 100% 100%;">
              <span>
                <a href="<?php echo base_url().'blog/'.$post->post_slug;?>"><?php echo $post->post_title;?></a>
              </span>
            </div>
            <?php } ?>
         </div>
        </div>
      </div>
    </div>
    <?php } ?>
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
