<style>

</style>

 <div class="well text-center">
  <aside class="sidebar-right">

     <!-- discount alert  -->
     <?php if($invoice->couponRate > 0){ ?>
    <div style="margin-bottom:0px;padding: 5px;" class="alert alert-success"><i class="text-success fa fa-check"></i> <?php echo trans('0518');?> <?php echo $invoice->couponRate; ?>%</div>
     <?php } ?> <!-- discount alert -->

    <div class="text-primary"><strong><?php echo trans('0153');?> </strong> : <?php echo $invoice->currCode; ?> <?php echo $invoice->currSymbol; ?><?php echo str_replace(".00",'',number_format($invoice->tax,2));?></div>
    <h3 style="margin:0px"><strong><?php echo trans('0124');?> </strong> : <strong class="text-danger"><?php echo $invoice->currCode; ?> <?php echo $invoice->currSymbol; ?><?php echo str_replace(".00",'',number_format($invoice->checkoutTotal,2));?></strong></h3>
    <span style="color:#d4d4d4" >--------------------------------------- </span>
    <br>
    <strong class="text-success"><?php echo trans('0126');?> </strong> : <?php echo $invoice->currCode; ?> <?php echo $invoice->currSymbol; ?><?php echo str_replace(".00",'',number_format($invoice->checkoutAmount,2)); ?>
  </aside>
</div>


<div class="clearfix"></div>
<div class="panel panel-default  hidden-xs">
  <div class="panel-heading  hidden-xs">
    <span><strong><?php echo trans('076');?> <?php echo trans('08');?> </strong>: <?php echo $invoice->bookingDate;?></span>
    <span><strong><?php echo trans('079');?> </strong>: <?php echo $invoice->expiry;?></span>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-lg-2 col-md-4 col-sm-4">
        <img src="<?php echo $invoice->thumbnail;?>" class="img-responsive">
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
        <h3 style="margin-top: 0px;margin-bottom: 0px"><strong><?php echo $invoice->title;?></strong></h3>
        <h4 class="st_rating"><a href="javascript:void(0);"><i class="icon-location-6"></i> <?php echo $invoice->location;?> </a> <?php echo $invoice->stars;?> </h4>
      </div>
    </div>
  </div>
</div>
<?php if(!empty($invoice->bookingExtras)){ ?>
<div class="panel panel-default hidden-xs">
  <div class="panel-heading strong"><?php echo trans('0156');?></div>
  <div class="panel-body">
  <div class="row">
    <?php foreach($invoice->bookingExtras as $extra){ ?>
    <div class="col-md-6 form-group">
      <div class="col-lg-4 col-md-6 col-sm-4">
        <img src="<?php echo $extra->thumbnail;?>" class="img-responsive">
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
        <h4 style="margin-top: 0px;margin-bottom: 0px"><strong><?php echo $extra->title;?></strong></h4>
        <h4><a href="javascript:void(0);"><i class="icon-shop-1"></i> <?php echo $invoice->currCode." ".$invoice->currSymbol.$extra->price;?> </a> </h4>
      </div>
    </div>
    <?php } ?>
  </div>
  </div>
</div>
<?php } ?>
<?php if(!empty($invoice->additionaNotes)){ ?>
<div class="panel panel-default hidden-xs">
  <div class="panel-heading"><?php echo trans('0178');?></div>
  <div class="panel-body">
    <p><?php echo $invoice->additionaNotes;?></p>
  </div>
</div>
<?php } ?>
<div class="panel panel-default  hidden-xs">
  <div class="panel-heading  hidden-xs">
    <strong><?php echo trans('076');?> <?php echo trans('0434');?></strong> : <span class="weak"> <?php echo $invoice->id; ?> </span> <strong><?php echo trans('0398');?></strong> <?php echo $invoice->code; ?>
  </div>
</div>


<div class="col-md-8 hidden-xs">

<!-- Start Hotels Section -->
<?php if($invoice->module == "hotels"){ ?>
  <p><strong><?php echo trans('07');?> : </strong> <?php echo $invoice->checkin; ?> <strong><?php echo trans('09');?> : </strong> <?php echo $invoice->checkout; ?> </p>
  <p><span class="strong"> <?php echo trans('0435');?> </span> : <?php echo $invoice->subItem->title;?>  <span class="text-primary strong"><?php echo $invoice->currSymbol;?><?php echo $invoice->subItem->price;?></span><br>
    <span class="strong"> <?php echo trans('0123');?> ( <?php echo $invoice->subItem->quantity;?> )   </span> <span class="text-primary strong"><?php echo $invoice->currSymbol;?><?php echo $invoice->subItem->total;?></span><br>
    <?php if($invoice->extraBeds > 0){ ?>
    <span class="strong"> <?php echo trans('0428');?> ( <?php echo $invoice->extraBeds; ?> )</span> <span class="text-primary strong"><?php echo $invoice->currSymbol; ?><?php echo $invoice->extraBedsCharges; ?></span><br>
    <?php } ?>
    <strong><?php echo trans('0122');?> ( <?php echo $invoice->nights;?> )</strong> <span class="text-primary strong"><?php echo $invoice->currSymbol;?><?php echo $invoice->subItem->totalNightsPrice;?> </span>
  </p>
<?php } ?>
<!-- End Hotels Section -->

<!-- Start Tours Section -->
<?php if($invoice->module == "tours"){ ?>
      <p><strong><?php echo trans('07');?> : </strong> <?php echo $invoice->checkin; ?> </p>
      <div class="clearfix"></div><br>
      <table class="table table-bordered">
      <thead>
      <tr>
      <th  style="line-height: 1.428571;"><?php echo trans('068');?></th>
      <th style="line-height: 1.428571;"><?php echo trans('0450');?></th>
      <th  style="line-height: 1.428571;" class="text-center"><?php echo trans('070');?></th>
      </tr>
      </thead>
      <tbody>
      <tr>
      <th scope="row"><?php echo trans('010');?> <span class="weak"><?php echo $invoice->currCode; ?> <?php echo $invoice->currSymbol;?><?php echo str_replace(".00",'',number_format($invoice->subItem->adults->price,2));?></span></th>
      <td>
      <?php echo $invoice->subItem->adults->count;?>
      </td>
      <td class="text-center adultPrice"><?php echo $invoice->currCode; ?> <?php echo $invoice->currSymbol;?><?php echo str_replace(".00",'',number_format($invoice->subItem->adults->price * $invoice->subItem->adults->count,2));?></td>
      </tr>
      <?php if($invoice->subItem->child->count > 0){ ?>
      <tr>
      <th scope="row"><?php echo trans('011');?> <span class="weak"><?php echo $invoice->currCode; ?> <?php echo $invoice->currSymbol;?><?php echo $invoice->subItem->child->price;?></span></th>
      <td>
      <?php echo $invoice->subItem->child->count;?>
      </td>
      <td class="text-center childPrice"><?php echo $invoice->currCode; ?> <?php echo $invoice->currSymbol;?><?php echo $invoice->subItem->child->price * $invoice->subItem->child->count;?></td>
      </tr>
      <?php } if($invoice->subItem->infant->count > 0){ ?>
      <tr>
      <th scope="row"><?php echo trans('0282');?> <span class="weak"> <?php echo $invoice->currCode; ?> <?php echo $invoice->currSymbol;?><?php echo $invoice->subItem->infant->price;?></span></th>
      <td>
      <?php echo $invoice->subItem->infant->count;?>
      </td>
      <td class="text-center childPrice"><?php echo $invoice->currCode; ?> <?php echo $invoice->currSymbol;?><?php echo $invoice->subItem->infant->price * $invoice->subItem->infant->count;?></td>
      </tr>
      <?php } ?>
      </tbody>
      </table>
      <!-- Guest Info Table -->
      <?php $chk = (array)$invoice->guestInfo; $chk1 = reset($chk); ?>
      <?php if(!empty($chk1->name)){ ?>
      <table class="table table-bordered">
      <thead>
      <tr>
      <th  style="line-height: 1.428571;"><?php echo trans('0350');?></th>
      <th style="line-height: 1.428571;"><?php echo trans('0523');?></th>
      <th  style="line-height: 1.428571;" class="text-center"><?php echo trans('0524');?></th>
      </tr>
      </thead>
      <tbody>
      <?php foreach($invoice->guestInfo as $guest){ ?>
      <tr>
      <td><?php echo $guest->name;?></td>
      <td><?php echo $guest->passportnumber;?></td>
      <td><?php echo $guest->age;?></td>
      </tr>
      <?php } ?>
      </tbody>
      </table>
      <?php } ?>
      <!-- End Guest Info Table -->
    <?php } ?>
<!-- End Tours Section -->

<!-- Start Cars Section -->
<?php if($invoice->module == "cars"){ ?>
    <strong><?php echo trans('08');?> : </strong> <?php echo $invoice->date; ?><br>
    <strong><?php echo trans('0275');?> : </strong> <?php echo $invoice->nights; ?><br>
    <strong><?php echo trans('0210');?> : </strong> <?php echo $invoice->bookedItemInfo->pickupLocation; ?><br>
    <strong><?php echo trans('0211');?> : </strong> <?php echo $invoice->bookedItemInfo->dropoffLocation; ?><br>
    <strong><?php echo trans('0210');?> <?php echo trans('08'); ?> : </strong> <?php echo $invoice->bookedItemInfo->pickupDate; ?><br>
    <strong><?php echo trans('0210');?> <?php echo trans('0259'); ?> : </strong> <?php echo $invoice->bookedItemInfo->pickupTime; ?><br>
    <strong><?php echo trans('0211');?> <?php echo trans('08'); ?> : </strong> <?php echo $invoice->bookedItemInfo->dropoffDate; ?><br>
    <strong><?php echo trans('0211');?> <?php echo trans('0259'); ?> : </strong> <?php echo $invoice->bookedItemInfo->dropoffTime; ?><br>
<?php } ?>
<!-- End Cars Section -->

</div>
<div class="clearfix"></div>
<!-- /.modal-content -->