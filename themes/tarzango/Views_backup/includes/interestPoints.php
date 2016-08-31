
<?php 


 if(!empty($interestPoints)){ ?>
      <div id="AMENITIES1">
      <div class="col-md-12">
        <h4 class="main-title go-right">Tourist Attractions</h4>
        <div class="clearfix"></div>
        <i class="tiltle-line go-right"></i>
        <div class="clearfix"></div>
        <div class="go-text-right">
          <?php foreach($interestPoints as $amt){ if(!empty($amt['poiName'])){ ?>
          <div style="margin-top:6px;margin-left:0px" class="row col-md-3 col-sm-4">
          <div class="row">
          <span class="text-left go-text-right size14">
           <?php echo $amt['poiName']; ?> - 
           <?php echo $amt['distance'] * 0.001. ' Miles'; ?>
          </span>
          </div>
          </div>
          <?php } } ?>
        </div>
      </div>
      <div class="clearfix"></div>
      </div>
<?php } ?>