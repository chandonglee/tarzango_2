<?php if(!empty($reviews) > 0){ ?>
<div id="REVIEWS">
  <div class="col-md-12">
    <div class="clearfix"></div>
    <br><br>
    <h4 class="main-title go-right"><?php echo trans('0396');?></h4>
    <div class="clearfix"></div>
    <i class="tiltle-line go-right"></i>
    <div class="clearfix"></div>
    <div class="tab-pane active" id="tab-newtopic">
      <div class="table-responsive">
        <div class="fixedtopic">
          <table class="table-hover table table-striped">
            <?php if(!empty($reviews) && pt_is_module_enabled('reviews')){ foreach($reviews as $rev){ ?>
            <tr class="RTL">
              <td style="width: 100px;">
                <img class="go-right" style="height:80px;width:80px" src="<?php echo base_url(); ?>assets/img/user_blank.jpg" alt="<?php echo$rev->review_id;?>"/>
              </td>
              <td>
                <span class="dark"><strong class="go-right"><?php echo $rev->review_name;?> &nbsp;</strong></span> <span class="text-muted"><small><?php echo pt_show_date_php($rev->review_date);?></small>   <span class="badge badge-warning pull-right go-left"> <?php echo round($rev->review_overall,1);?> / 10</span></span> <br/>
                <?php echo character_limiter($rev->review_comment,1000);?>
              </td>
            </tr>
            <?php } ?>
          </table>
          <div class="line3"></div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>