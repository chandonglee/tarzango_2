<style>

/* footer */
  .item { max-height: 55px !important; }
  .parallax-window { min-height: 220px; position: relative; }

  .container-fluid inner-page-nav{
    display: none !important;
  }
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
    background: rgba(248,80,50,0); 
    background: -moz-linear-gradient(top, rgba(248,80,50,0) 0%, rgba(12,19,79,1) 100%);
    background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(248,80,50,0)), color-stop(100%, rgba(12,19,79,1)));
    /* background: -webkit-linear-gradient(top, rgba(248,80,50,0) 0%, rgba(12,19,79,1) 100%); */
    background: -o-linear-gradient(top, rgba(248,80,50,0) 0%, rgba(12,19,79,1) 100%);
    background: -ms-linear-gradient(top, rgba(248,80,50,0) 0%, rgba(12,19,79,1) 100%);
    background: linear-gradient(to bottom, rgba(248,80,50,0) 0%, rgba(12,19,79,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f85032', endColorstr='#0c134f', GradientType=0 );
 
}
   
</style>


<div class="blog">
  <div class="container-main main_header">
    <div class="container">
      <div class="row">
       
      <?php include 'menu_header.php';?>
            <center style="margin-left: 88px; z-index: 999;
    margin-top: 20px;"><a  href="<?php echo base_url(); ?>"><img class="" style="z-index:999" src="images/contact-logo.png"></a></center>
          
         
     
        <div class="col-sm-12 page-title">
          <h2 class="">Blog</h2>
          <a  href="<?php echo base_url(); ?>" ><img style="position:relative;z-index:999;" src="images/arrow-blue.png"></a>
        </div>
      </div>
    </div>
    </div>
  </div>

<link rel="stylesheet" href="<?php echo $theme_url; ?>assets/css/blog.css" />
<!-- <section style="max-height:200px !important" class="parallax-window" data-parallax="scroll" data-image-src="<?php echo $theme_url; ?>assets/img/login.jpg" data-natural-width="150" data-natural-height="100">
  <div class="parallax-content-1">
    <div class="animated fadeInDown">
      <h1 style="margin-top: -216px;"><?php echo trans('Blog');?></h1>
      <p><?php echo trans('0481');?></p>
    </div>
  </div>
</section> -->
<!-- End section -->
<?php //print_r($allposts); ?>
<div class="col-sm-12 text-center">
    <div class="container">
     <?php if(!empty($categories)){ ?>
      <div class="col-sm-12">
        <ul class="nav nav-tabs responsive" id="myTab">
        <li></li>
         <li class="col-sm-3"><a href="<?php echo base_url().'blog'; ?>">All</a></li>
        <?php  foreach($categories as $cat):
        $count = pt_posts_count($cat->id);
        if($count > 0){
        ?> 
          <li class="col-sm-3"> <a href="<?php echo base_url().'blog/category?cat='.$cat->slug; ?>" class="list-group-item"><?php echo $cat->name;?> </a></li>
           <?php  } endforeach; ?>
        </ul>
      </div>
       <?php  } ?>
      <div class="tab-content responsive">
        <div class="tab-pane active" id="all">
          <div class="col-sm-1">
          </div>
          <div class="col-sm-10">
           <?php if(!empty($allposts['all'])){
            $a = 0;
            $b = 1;

            foreach($allposts['all'] as $post):
           /* echo json_encode($post);
            exit();*/
             $bloglib->set_id($post->post_id);
            $bloglib->post_short_details();

             $date = date_create($bloglib->date); 
            $date_new = date_format($date,"F m, Y");

            if($a != 0 && $a != $b + 3){
             ?>
              <div class="col-sm-6 background">
                <div class="data-img" style="">
               <img style="position:relative; z-index:-1; display:block;" src="<?php echo pt_post_thumbnail(str_replace("demo.tarzango.com/","tarzango.com/",$post->post_id));
              ?>" alt="<?php echo $bloglib->title;?>" class="img-responsive">
                </div>
              <div class="overlay">
                <div class="col-sm-12">
                  <p class="date">Posted on <?php echo $date_new; ?></p>
                  <p class="tag">Tagged</p>
                  <a href="#"><?php echo $post->cat_name;?></a>
                  
                </div>
                <div class="col-sm-12 banner-text">
                  <h2><?php echo $bloglib->title;?></h2>
                   <a href="<?php echo base_url().'blog/'.$post->post_slug;?>"><img src="images/arrow-left.png"></a>
                </div>
              </div>
            </div>
           
            <?php } else {?>
              
               <div class="col-sm-12 background">
               <div class="data-img" style="">
            <img style="position:relative; z-index:-1; display:block;" src="<?php echo str_replace("demo.","",pt_post_thumbnail($post->post_id)); ?>" alt="<?php echo $bloglib->title;?>" class="img-responsive">
            </div>
              <div class="overlay">
                <div class="col-sm-12">
                  <p class="date">Posted on <?php echo $date_new; ?></p>
                  <p class="tag">Tagged</p>
                  <a href="#"><?php echo $post->cat_name;?></a>
                  
                </div>
                <div class="col-sm-12 banner-text">
                  <h2><?php echo $bloglib->title;?></h2>
                  <a href="<?php echo base_url().'blog/'.$post->post_slug;?>"> <img style="margin: 25px 0px 0px 10%;" src="images/arrow-left.png"></a>
                </div>
              </div>
            </div>
            <?php $b = $a; ?>
            <?php } $a++;?>
               <?php  endforeach; }else{ echo '<h1 class="text-center">' . trans("066") . '</h1>'; } ?>
        </div>
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


