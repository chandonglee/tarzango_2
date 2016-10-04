

<style type="text/css">
.menu-header{
  position: absolute;
    margin-left: -70px;
    margin-right: 100px;
}

@media(min-width: 1600px){
  .center{
    margin-left: 120px !important;
    z-index: 999;
    margin-top: 20px;


  }
}
.container-fluid inner-page-nav{
  display: none !important;
}
p.title_text:after {
    content: "";
    width: 30px;
    height: 30px;
    background: url("<?php echo $theme_url; ?>images/faq_up_arrow.png") no-repeat;
    float: right;
    z-index: 444444444444444;
    position: relative;
    display: inline-block;
}

p.arrow_down:after {
    content: "";
    width: 30px;
    height: 30px;
    background: url("<?php echo $theme_url; ?>images/faq_down_arrow.png") no-repeat;
    float: right;
    z-index: 444444444444444;
    position: relative;
    display: inline-block;
}

ul
{
  padding-left: 15px;
  color:#342d6c !important;
}
h3{
  color:#342d6c !important;
  font-family: 'Apercu-Regular';
}
.innerpage h4{
  color:#342d6c !important;
  font-family: 'Apercu-Regular';
}


.innerpage .col-sm-10 h3
{
      font-size: 20px;
}

.innerpage .col-sm-10 p
{
  font-size: 16px;
}

.title_text
{
  font-size: 20px !important;
  font-weight: bold !important;
  font-style: italic;
}


</style>

<?php include $themeurl.'views/new_header.php';?>


<div class="faq" style="z-index:999;    padding-top: 85px;">
  <div class="container-main main_header">
     <div class="container">
      <div class="row">
       
      
            <center class="center" style="margin-left: 88px; z-index: 999;
    margin-top: 20px;"></center>
          
         
     
        <div class="col-sm-12 page-title">
          <h2 class=""><?php echo @$page_contents[0]->content_page_title; ?></h2>
          <a  href="<?php echo base_url(); ?>" ><img style="position:relative;z-index:999;" src="images/arrow-blue.png"></a>
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

          <div class="col-sm-10" style="margin-bottom: 150px;">
        <?php echo @$page_contents[0]->content_body; ?>
        </div>
          <div class="col-sm-1">
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