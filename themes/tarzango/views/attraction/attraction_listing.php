<div class="attraction-listing">
  <?php 
/*error_reporting(-1);*/
  include 'header_search.php'; ?>

  <script src="<?php echo $theme_url; ?>js/list.min.js"></script>
  <div class="attraction-listing-body">
    <div class="list">
      <div class="container">
        <div class="row">
         <section id="list-view-default">
          <div class="col-sm-12">
            <div class="col-sm-3 sorting">
              <label class="title">Recommended <img src="images/arrow-down.png"><img src="images/arrow-up.png"></label>
              <div class="dropdown">
                <button class="sort" data-sort="name" style="">Name</button>
                <button class="sort" data-sort="price" style="">Price</button>
              </div>
            </div>
          </div>
         
          <div class="col-sm-12 t_list" id="">
            <?php

            for ($i=0; $i < count($attr) ; $i++) {  ?>
              
              <div class="list-item">
                <div class="box-1">
                  <div class="col-sm-8">
                    <h1 class="name" ><?php echo $attr[$i]->name ?></h1>
                    <h1 class="price" style="display: none;" ><?php echo $attr[$i]->amountsFrom[0]->amount; ?></h1>
                    <?php for ($i_a=0; $i_a < count($attr[$i]->content->segmentationGroups) ; $i_a++) { 
                      if($attr[$i]->content->segmentationGroups[$i_a]->code == 1){
                      ?>
                      <h6  ><?php echo $attr[$i]->content->segmentationGroups[$i_a]->segments[0]->name; ?></h6>
                    <?php } } ?>
                    <p><?php echo character_limiter($attr[$i]->content->description,350); ?></a></p>
                  </div>
                  <div class="col-sm-4">
                    <?php 
                    $img_data = '';
                    for ($i_b=0; $i_b < count($attr[$i]->content->media->images) ; $i_b++) { 
                      if ($attr[$i]->content->media->images[$i_b]->urls[0]->sizeType == 'XLARGE') {
                        $img_data = $attr[$i]->content->media->images[$i_b]->urls[0]->resource;
                      }
                      # code...
                    } ?>
                    <img class="img responsive" src="<?php echo $img_data; ?>">
                  </div>
                </div>
                <?php 
                $Adult_price = '';
                $Adult_p = '';
                $Child_price = 'Child N/A';
                $Child_p = '';
                $child_allow = '&child_allow=0';

                for ($i_c=0; $i_c < count($attr[$i]->amountsFrom) ; $i_c++) { 
                  if($attr[$i]->amountsFrom[$i_c]->paxType == 'ADULT'){
                    $Adult_price = 'Adult $ '.$attr[$i]->amountsFrom[$i_c]->amount;
                    $Adult_p = $attr[$i]->amountsFrom[$i_c]->amount;
                  }elseif($attr[$i]->amountsFrom[$i_c]->paxType == 'CHILD'){
                    $Child_price = 'Child $ '.$attr[$i]->amountsFrom[$i_c]->amount;
                    $Child_p = $attr[$i]->amountsFrom[$i_c]->amount;
                    $child_allow = '&child_allow=1';
                  }
                }

                $total_price = ($Adult_p * $adults) + ($Child_p * $child);
                ?>
                <div class="box-2">
                 
                    <div class="col-sm-8">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <input type="text" id="day" name="day" class="form-control" value="<?php echo $attr[$i]->content->featureGroups[0]->included[0]->description; ?>" disabled>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <input type="text" id="day" name="day" class="form-control" value="<?php echo $Adult_price; ?>" disabled>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <input type="text" id="day" name="day" class="form-control" value="<?php echo $Child_price; ?>" disabled>
                        </div>
                      </div>
                      
                      <div class="col-sm-3">
                        <div class="form-group date">
                          <input type="text" value="<?php echo $checkin; ?>" disabled name="date3" class="form-control" placeholder="DD/MM/YYYY">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="col-sm-6">
                        <h1>$ <?php echo $total_price; ?></h1>
                        <p>net price</p>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group submit-button">
                          <a href="<?php echo base_url().'attraction/details_2?code='.$attr[$i]->code.'&adults='.$adults.'&child='.$child.'&checkIn='.$checkin.'&lat='.$latitude.'&long='.$longitude.$child_allow; ?>">
                          <input type="button" id="submit" name="submit" class="form-control" value="BOOK">
                          </a>
                        </div>
                      </div>
                    </div>
                  
                </div>
              </div>

            <?php } ?>
            
          </div>
          </section>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="container-fluid how-section vip-membership">
      <div class="container">
        <div class="col-md-7 ptop70">
          <h4 class="description" style="text-align:left;font-size:30px;padding-bottom: 0px;">Become a V.I.P member Now and receive additional</h4>
          </br>
          <h4 style="text-align:left;font-size:30px;margin-top:-10px;font-family: 'Apercu-Bold';">10% off plus some AWESOME perks...</h4>
          <a href="<?php echo base_url().'membership';?>" style="float:left" title="group booking" class="pink-btn">membership</a> </div>
        <div class="col-sm-5"> <img style="margin-top: 0px" src="images/membership-door.png"> </div>
      </div>
    </div>
        <div class="clearfix"></div>
  </div>
</div>
</div>

<script type="text/javascript">
  

   var options = {
    valueNames: [ 'name','price' ]
  };

var userList = new List('list-view-default', options);
</script>