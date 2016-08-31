<?php if(!empty($module->amenities)){ ?>
      <div id="AMENITIES">
      <div class="col-md-12">
        <h4 class="main-title go-right"><?php echo trans('048');?></h4>
        <div class="clearfix"></div>
        <i class="tiltle-line go-right"></i>
        <div class="clearfix"></div>
        <div class="go-text-right">
          <?php foreach($module->amenities as $amt){ if(!empty($amt->name)){ ?>
          <div style="margin-top:6px;margin-left:0px" class="row col-md-3 col-sm-4">
          <div class="row">
          <!--<img class="go-right" style="max-height:30px;max-witdh:40px" src="<php echo $amt->icon;?>">-->
          <span class="text-left go-text-right size14">
           <?php echo $amt->name; ?>
          </span>
          </div>
          </div>
          <?php } } ?>
        </div>
      </div>
      <div class="clearfix"></div>
      </div>
<?php } ?>