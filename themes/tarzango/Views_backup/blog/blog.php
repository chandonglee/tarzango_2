<style>
  .item { max-height: 55px !important; }
  .parallax-window { min-height: 220px; position: relative; }

   footer{
        float: left;  
    width: 100%;
    background-size: 94% !important ;
    min-height: 480px;
    height: auto;
  }
  footer .row .col-sm-12{
    padding-top: 50px;
  }
  p {
    color: #342d6c !important;
    font-family: 'Apercu-Light';
        line-height: 1.7;
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
          <h2 class=""><?php echo $title;?></h2>
          <a  href="<?php echo base_url().'blog'; ?>" ><img style="position:relative;z-index:999;" src="images/arrow-blue.png"></a>
        </div>
      </div>
    </div>
    </div>
  </div>
<div class="innerpage">

  <img class="top-bg" src="images/innerpage_top_bg.png">
  <img class="left-bg" src="images/innerpage_left_bg.png">
  <img class="right-bg" src="images/innerpage_right_bg.png">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="col-sm-1">
          </div>

          <div class="col-sm-10" style=" margin-bottom: 150px;">
         </br>
          <div class="data-img" style="">
            <img src="<?php echo $thumbnail;?>" class="img-responsive" />
          </div>
            <br/>
            <h3><?php echo $title;?></h3>
            <h3>(<?php echo $date;?>)</h3>
            <hr>
            <p>
              <?php echo $desc; ?>
            </p>
          </div>
        </div>
      </div>
    </div>  
</div>

   