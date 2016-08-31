<?php

$reviews = $tripadvisor->reviews;
 if(!empty($reviews) > 0){ ?>
  <style>
  /* header */

  .table-striped > tbody > tr:nth-of-type(odd){
    background-color: transparent;
  }
  .table-hover > tbody > tr:hover{
   background-color: transparent; 
  }
  .media-heading {
    margin-top: 5px !important;
    margin-bottom: 15px !important; 
  }
  .rating-detail a {
    padding: 0px 1px;
    float: left;  
}
.rating-detail span {
    
    font-weight: normal;
    font-family: 'Apercu-Light';
    font-size: 14px;
    padding-left: 5px;
    padding-top: 2px;
    float: left;
}

  </style>

<div class="detail-view" style=" background-image: none !important; ">
 
 
   <div class="title_rating">
      <h4 style="margin-bottom: 0px;"> Ratings </h4><br/><br/>

      <div class="comment-rating" style="float:left; margin-top:-10px">
        <div class="rating">
          <div class="rating-detail">
          <?php 
                  for ($r_i=0; $r_i < $overall_rating; $r_i++) {  ?>
                  <a > <img src="images/star-icon.png"> </a>
                <?php } 
                for ($r_i_o=$r_i; $r_i_o < 5; $r_i_o++) { 
                ?>
                <a> <img src="images/p-star.png"> </a>
                  <?php }  ?>
                  <span > <strong>Great</strong> Overall Rating (<strong><?php echo $overall_rating; ?></strong> Based on <?php echo $ranking_out_of; ?> Ratings) </span> </div>
        </div>
      </div>
    </div>
 
 
    <div class="clear-left"> </div>
 
 <ul class="media-list">
  <?php if(!empty($reviews) && pt_is_module_enabled('reviews')){ 
                foreach($reviews as $rev){ 
                  ?>
     <li class="media">
        <div class="col-lg-2"> <a class="pull-left rating-img" >
          <img class="media-object img-circle" src="<?php echo base_url(); ?>assets/img/user_blank.jpg" alt="<?php echo $rev->id;?>">
        </a>
        </div>
           <div class="col-lg-10">
        <div class="media-body">

        <h4 class="media-heading"><?php echo $rev->user->username; ?></h4>
          <div class="rating-block"> <span>
                <div class="rating-detail"> 
                <?php 
                  for ($r_i=0; $r_i < round($rev->rating,1); $r_i++) {  ?>
                  <a > <img src="images/star-icon.png"> </a>
                <?php } 
                for ($r_i_o=$r_i; $r_i_o < 5; $r_i_o++) { 
                ?>
                <a > <img src="images/p-star.png"> </a>
                  <?php }  ?>
                 </div>
                </span> </div>
          <p>
            <?php echo $rev->text;?>
          </p>
            </div>
            </div>
        </li>
        <?php } ?>
                                                          
    </ul>
 
 </div>

 <?php } ?>

<?php } ?>