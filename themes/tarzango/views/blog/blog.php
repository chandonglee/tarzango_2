<style>
  .item { max-height: 55px !important; }
  .parallax-window { min-height: 220px; position: relative; }

   footer{
        float: left;  
    width: 100%;
    
    min-height: 480px;
    height: auto;
  }
  footer .row .col-sm-12{
    padding-top: 50px;
  }
  
 .data-img{
    background: rgba(248,80,50,0); */
    background: -moz-linear-gradient(top, rgba(248,80,50,0) 0%, rgba(12,19,79,1) 100%);
    background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(248,80,50,0)), color-stop(100%, rgba(12,19,79,1)));
    /* background: -webkit-linear-gradient(top, rgba(248,80,50,0) 0%, rgba(12,19,79,1) 100%); */
    background: -o-linear-gradient(top, rgba(248,80,50,0) 0%, rgba(12,19,79,1) 100%);
    background: -ms-linear-gradient(top, rgba(248,80,50,0) 0%, rgba(12,19,79,1) 100%);
    background: linear-gradient(to bottom, rgba(248,80,50,0) 0%, rgba(12,19,79,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f85032', endColorstr='#0c134f', GradientType=0 );
 
}
</style>


<div class="blog_post">
  <div class="container-main main_header">
    <div class="container">
      <div class="row">
       
      <?php include 'menu_header.php';?>
            <center style="margin-left: 88px; z-index: 999;
    margin-top: 20px;"><a  href="<?php echo base_url(); ?>"><img class="" style="z-index:999" src="images/contact-logo.png"></a></center>
          
         
     
        <div class="col-sm-12 page-title">
          <h2 class="">Blog</h2>
          <a  href="<?php echo base_url().'blog'; ?>" ><img style="position:relative;z-index:999;" src="images/arrow-blue.png"></a>
        </div>
      </div>
    </div>
    </div>
  </div>
  <div class="blog_post_body">
  <img class="top-bg" src="images/paynow_top.png">
  <img class="left-bg" src="images/membership-left-bg.png">
  <img class="right-bg" src="images/membership-right-bg.png">
    <div class="container">
      <div class="col-sm-12 text-center">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-10">
          <div class="section1">
            <div class="box data-img">
              <img class="img-responsive " style="position:relative; z-index:-1; display:block; width:100%;" src="<?php echo str_replace("demo.","",$thumbnail);?>">
              <div class="inner">
                <a href="<?php echo base_url().'blog'; ?>">&#8592; All Posts</a>
                <p>Posted On <?php echo $date;?></p>
                <h2><?php echo $title;?></h2>
              </div>
            </div>
            <div class="content">
              
              <p><?php echo $desc; ?></p>         
              <h5>Posted By <a href="#">Kristizian Vajon</a></h5>
              <h5 class="right">Tagged <a href="#">News</a>, <a href="#">Hotel</a>, <a href="#">Travel</a></h5>
            </div>
            <div class="social">
              <p>SHARE THIS POST</p>
              <a href=""><img src="images/twitter_dark.png"></a>
              <a href=""><img src="images/fb_dark.png"></a>
              <a href=""><img src="images/insta_dark.png"></a>
              <a href=""><img src="images/print_dark.png"></a>
            </div>
          </div>
          <div class="section2">
            <h6>COMMENTS</h6>
            <h5>Join The Conversation</h5>
            <ul>
              <li class="first">
                <a href="#" class="first black">0 Comments</a>
                <a href="#">Brave People</a>
                <a href="#" class="right"><img src="images/count.png"> Login <img src="images/field-arrow-down.png"></a>
              </li>
              <li>
                <a href="#" class="first"><img src="images/grey_heart.png"> Recommended</a>
                <a href="#"><img src="images/share.png"> Share</a>
                <a href="#" class="right"> Sort by Best <img src="images/field-arrow-down.png"></a>
              </li>
              <li class="last">
                <img src="images/img.png">
                <input type="text" name="comment" placeholder="Start the discussion" value="" id="">
              </li>
            </ul>
            <p>Be the first to comment</p>
          </div>
        </div>
        <div class="col-sm-1">
        </div>
      </div>
    </div>
  </div>
  <div class="last-section">
    <div class="col-sm-12 text-center">
      <div class="container-main">
        <div class="container">
          <h4 class="col-sm-9 text-right">Going somewhere? Need a Hotel, let us help you!</h4>
          <a class="col-sm-3 text-center" href="#">TARZANGO</a>
        </div>
      </div>
    </div>
  </div>
</div>

   