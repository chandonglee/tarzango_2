<div class="panel panel-default">
  <div class="panel-heading"> <span class="panel-title pull-left">Edit Group Booking</span>
    <input type="hidden" id="currenturl" value="<?php echo current_url();?>" />
    <input type="hidden" id="baseurl" value="<?php echo base_url().$this->uri->segment(1);?>" />
    <div class="clearfix"></div>
  </div>
  <div class="panel-body">
    <div class="col-md-8">
      <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data" >
        <input type="hidden" name="pt_group_booking_id" id="pt_group_booking_id" value="<?php echo $bdetails->pt_group_booking_id;?>" />
        <?php //if(!empty($service)){  ?>
        <div class="panel panel-default">
          <div class="panel-heading"><strong>Item</strong></div>
          <div class="panel-body">
            <div class="form-group">
              <label class="col-md-3 control-label">Company Name</label>
              <div class="col-md-8" style="margin-top:7px;"> <?php echo $bdetails->company_name;?> </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Contact Name</label>
              <div class="col-md-8" style="margin-top:7px;"> <?php echo $bdetails->contect_name;?> </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Email</label>
              <div class="col-md-8" style="margin-top:7px;"> <?php echo $bdetails->contect_email;?> </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Check in</label>
              <div class="col-md-8" style="margin-top:7px;"> <?php echo $bdetails->check_in;?> </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Check Out</label>
              <div class="col-md-8" style="margin-top:7px;"> <?php echo $bdetails->check_out;?> </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Contact no</label>
              <div class="col-md-8" style="margin-top:7px;"> <?php echo $bdetails->contect_no;?> </div>
            </div>
              
            <div class="form-group">
              <label class="col-md-3 control-label">Aprx Room</label>
              <div class="col-md-8" style="margin-top:7px;"> <?php echo $bdetails->aprx_rooms;?> </div>
            </div>
              
            <div class="form-group">
              <label class="col-md-3 control-label">City</label>
              <div class="col-md-8" style="margin-top:7px;"> <?php echo $bdetails->city;?> </div>
            </div>
              
            <div class="form-group">
              <label class="col-md-3 control-label">State</label>
              <div class="col-md-8" style="margin-top:7px;"> <?php echo $bdetails->state;?> </div>
            </div>
              
            <div class="form-group">
              <label class="col-md-3 control-label">Place Type</label>
              <div class="col-md-8" style="margin-top:7px;"> <?php echo $bdetails->place_type;?> </div>
            </div>
            
            <!--Hotels-->
            <div class="form-group">
                        <label class="col-md-3 control-label">Hotel Name</label>
                        <div class="col-md-8" style="margin-top:7px;">
            <?php
                $sel_hotel_data = $bdetails->hotel_data;
                $sel_hotel_data = json_decode($sel_hotel_data);
                //print_r($sel_hotel_data);
                //echo count($sel_hotel_data->hotel_id);
                
                for($s_i=0;  $s_i < count($sel_hotel_data->hotel_id); $s_i++){ ?>
                   
                         <?php echo $sel_hotel_data->hotel_name[$s_i];?> 
                    
               <?php  } ?>
                        </div>
            </div>
                <?php exit;
               $histrue = $chklib->is_mod_available_enabled("hotels");
              if($service == "hotels" && $histrue){ ?>
             
                <div class="form-group">
                  <label class="col-md-3 control-label">Hotel Name</label>
                  <div class="col-md-8" style="margin-top:7px;"> <?php echo $bdetails->title;?> </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Room Name </label>
                  <div class="col-md-8">
                    <select data-placeholder="Select" id="poprooms" class="chosen-select hrooms" disabled="true" >
                      <?php foreach($hrooms as $hr){ ?>
                      <option value="<?php echo $hr->room_id;?>" <?php if($selectedroom == $hr->room_id){ echo "selected";}?> > <?php echo $hr->room_title;?> </option>
                      <?php } ?>
                    </select>
                    <span class="btn bookrslt" style="display:none"></span> </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Room Quantity</label>
                  <div class="col-md-3">
                    <select name="title" data-placeholder="Select" class="form-control roomquantity" disabled="true">
                      <?php for($i =1; $i <= $totalrooms;$i++ ){ ?>
                      <option value="<?php echo $i;?>" <?php if($rquantity == $i){ echo "selected";} ?> ><?php echo $i;?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
            
                <div class="form-group">
                  <label class="col-md-3 control-label">Total Room Price</label>
                  <div class="col-md-3">
                    <input class="form-control" id="totalroomprice" type="text" name="totalroomprice"  value="<?php echo $rtotal;?>" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Per Night Price</label>
                  <div class="col-md-3">
                    <input class="form-control" id="roomtotal" type="text" placeholder="Price" name="roomtotal" value="<?php echo $subitemprice;?>" readonly>
                  </div>
                </div>
            
                <div class="form-group">
                  <label class="col-md-3 control-label">Total Deposit</label>
                  <div class="col-md-3">
                    <input class="form-control editdeposit" type="text" id="totaltopay"  name="totaltopay"  value="<?php echo $bdetails->checkoutAmount;?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Booking Status</label>
                  <div class="col-md-3">
                    <?php if($adminsegment == "admin" || $adminsegment == "supplier"){ ?>
                    <select class="form-control " name="status">
                      <option value="unpaid"  <?php if($bdetails->status == "unpaid"){ echo "selected"; }?>>Unpaid</option>
                      <option value="paid" <?php if($bdetails->status == "paid"){ echo "selected"; }?>>Paid</option>
                      <option value="reserved" <?php if($bdetails->status == "reserved"){ echo "selected"; }?>>Reserved</option>
                      <option value="cancelled" <?php if($bdetails->status == "cancelled"){ echo "selected"; }?>>Cancelled</option>
                    </select>
                    <?php }else{ ?>
                    <input type="text" name="status" class="form-control" value="<?php echo ucfirst($bdetails->status); ?>" readonly>
                    <?php } ?>
                  </div>
                </div>
          </div>
        </div>
        
        <!-- extras section  <div class="panel panel-default rprice supdiv" <?php if(empty($sups)){ ?>  style="display:none;" <?php } ?>>
          <div class="panel-heading"><strong>extras</strong></div>
          <div class="panel-body suppcontent">
         <?php if(!empty($sups)){ ?>
          <table class='table table-srtiped'>
          <thead>
          <tr>
          <td><b>Name</b></td>
          <td><b>Price</b></td>
          <td><b>Order</b></td>
          </tr>
          </thead><tbody>
        <?php

          foreach($sups as $sup){ ?>
        <tr><td><?php echo $sup->extraTitle;?></td>
        <td><?php echo $app_settings[0]->currency_sign.$sup->extraPrice; ?> </td>
        <td><input type='checkbox' class='extras'  id="extras_<?php echo $sup->id; ?>" data-title="<?php echo str_replace(" ","&nbsp;",$sup->extraTitle);?>" data-price="<?php echo $sup->extraPrice;?>" onclick="select_sup($(this).data('price'),$(this).data('title'),'<?php echo $sup->id;?>','<?php echo $app_settings[0]->currency_sign;?>');"  <?php if(in_array($sup->id,$bookedsups)){ echo "checked";} ?>    name='extras[]'  value="<?php echo $sup->id;?>" ></td></tr>

       <?php   } ?>
          </tbody></table> <?php } ?>
          </div>
        </div>-->
        
        <?php if($adminsegment == "admin"  || $adminsegment == "supplier" ){ ?>
        <div class="panel panel-default rprice paytype">
          <div class="panel-heading"><strong>Payment Method</strong></div>
          <div class="panel-body">
            <label class="col-md-3 control-label" id="" >Payment Type</label>
            <div class="col-md-4 add_link"  data-paystandimg="<?php echo base_url().'assets/img/paystand_logo.png'; ?>">
              <select  class="form-control sel_pay" name="paymethod" data-placeholder="Select" required>
                <option value="">Select</option>
                <?php foreach($paygateways['activeGateways'] as $payt){ ?>
                <option value="<?php echo $payt['name'];?>" <?php if($payt['name'] == $bdetails->paymethod){ echo "selected"; } ?> ><?php echo  $payt['displayName'];?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>
       
        <?php }else{ ?>
        <input type="hidden" name="paymethod" value="<?php echo $bdetails->paymethod;?>">
        <?php } ?>
        <div class="form-group">
          <div class="col-md-2">
            <input type="hidden" name="updatebooking" value="1" />
            <input type="submit" class="btn btn-primary btn-lg" value="Update Booking">
          </div>
        </div>
        <?php } ?>
      </form>
    </div>
   
  </div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/adminbooking.js"></script> 
