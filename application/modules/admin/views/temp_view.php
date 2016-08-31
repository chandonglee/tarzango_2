<div class="panel panel-default">
  <div class="panel-heading"><?php echo $header_title; ?></div>
  <?php if(@$addpermission && !empty($add_link)){ ?>
   <form class="add_button" action="<?php echo $add_link; ?>" method="post"><button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Add</button></form>
  <?php } ?>
   <div class="panel-body">
		<?php if(isset($method_name) && isset($controller_name)) { ?>
		<form method="post" name="findbyhotel" id="findbyhotel" action="<?php echo site_url('admin/bookings/searchbyhotels');?>">
			<select name="hotel" id="hotel" onchange="this.form.submit()">
					<option value="">All</option>
					<?php for($i=0;$i<count($hotels);$i++) { ?>
					<option value="<?php echo $hotels[$i]->hotel_id; ?>" <?php if (isset($hotelid) && $hotelid==$hotels[$i]->hotel_id) echo 'selected' ; ?>><?php echo $hotels[$i]->hotel_title; ?></option>
					<?php } ?>
			</select>
		</form>
		<?php } ?>
		
     <?php echo $content;?>
   </div>
 </div>