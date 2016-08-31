<div class="panel panel-default">
    <div class="panel-heading">
      <span class="panel-title pull-left">Edit Booking</span>
      <input type="hidden" id="currenturl" value="<?php echo current_url();?>" />
      <input type="hidden" id="baseurl" value="<?php echo base_url().$this->uri->segment(1);?>" />
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">     
    <div class="col-md-8">
      <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data" >
               <input type="hidden" name="bookingid" id="bookingid" value="<?php echo $bdetails->id;?>" />
               <input type="hidden" name="refcode" id="refcode" value="<?php echo $bdetails->code;?>" />
               <input type="hidden" name="itemid" id="itemid" value="<?php echo $bdetails->itemid;?>" />
               <input type="hidden" name="subitem" id="subitem" value="<?php echo $bdetails->subItem->id;?>" />
               <input type="hidden" name="btype" id="btype" value="<?php echo $bdetails->module;?>" />
               <input type="hidden" name="currencysign" id="currencysign" value="<?php echo $app_settings[0]->currency_sign;?>" />
               <input type="hidden" name="commission" id="commission" class="<?php echo $commtype;?>" value="<?php echo $commvalue;?>" />
               <input type="hidden" id="tax" class="<?php echo $tax_type; ?>" value="<?php echo $tax_val; ?>" />
               <input type="hidden" name="totalsupamount" id="totalsupamount" value="<?php echo $supptotal;?>" />
               <?php if($service == "hotels"){ ?>
                  <input type="hidden" name="totalamount" id="totalroomamount" value="<?php echo $rtotal;?>" />
              <?php  } ?>

<input type="hidden" name="grandtotal" id="alltotals"  value="<?php echo $bdetails->checkoutTotal;?>" />
<input type="hidden" name="paymethod" id="methodname"  value="<?php echo $bdetails->paymethod;?>" />
<input type="hidden" name="paymethodfee" id="paymethodfee"  value="0" />
<input type="hidden" name="checkin" id="cin"  value="<?php echo $bdetails->checkin;?>" />
<input type="hidden" name="checkout" id="cout"  value="<?php echo $bdetails->checkout;?>" />
<input type="hidden" name="commissiontype" id="comtype" value="<?php echo $commtype;?>" />
<input type="hidden" id="apptax" value="<?php echo $applytax;?>" />
              
<input type="hidden" name="paidamount" value="<?php echo $invoice->amountPaid;?>" />

    <?php if(!empty($service)){  ?>

      <div class="panel panel-default">
      <div class="panel-heading"><strong>Item</strong></div>
      <div class="panel-body">
        <div class="form-group">
          <label class="col-md-3 control-label">Customer Name</label>
          <div class="col-md-8" style="margin-top:7px;">
            <?php echo $bdetails->userFullName;?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Customer Email</label>
          <div class="col-md-8" style="margin-top:7px;">
           <?php echo $bdetails->accountEmail;?>
          </div>
        </div>

        <div class="form-group">
        <label class="col-md-3 control-label"><?php echo $checkinlabel;?> </label>
        <div class="col-md-3">
        <input class="form-control dpd1" id="<?php echo $service;?>" type="text" placeholder="Date" name=""  value="<?php echo $bdetails->checkin;?>" readonly="true" disabled />
        </div>
        </div>
 <?php if($service == "hotels"){ ?>
        <div class="form-group">
        <label class="col-md-3 control-label"><?php echo $checkoutlabel;?> </label>
        <div class="col-md-3">
        <input class="form-control dpd2" id="<?php echo $service;?>" type="text" placeholder="Date" name=""  value="<?php echo $bdetails->checkout;?>" readonly="true" disabled />
        </div>
        </div>


        <div>
        <div class="form-group">
        <label class="col-md-3 control-label">Total ( Nights )</label>
        <div class="col-md-3">
        <input class="form-control" id="stay" type="text" name="stay"  value="<?php echo $bdetails->nights;?>" readonly="true">
        </div>
        </div>
        </div>
<?php } ?>
        
      <!--Hotels-->
      <?php
       $histrue = $chklib->is_mod_available_enabled("hotels");
      if($service == "hotels" && $histrue){ ?>
        <div class="form-group">
        <label class="col-md-3 control-label">Hotel Name</label>
        <div class="col-md-8" style="margin-top:7px;">
        <?php echo $bdetails->title;?>
        </div>
        </div>

        <div class="form-group">
        <label class="col-md-3 control-label">Room Name </label>
        <div class="col-md-8">
        <select data-placeholder="Select" id="poprooms" class="chosen-select hrooms" disabled="true" >
        <?php foreach($hrooms as $hr){ ?>
        <option value="<?php echo $hr->room_id;?>" <?php if($selectedroom == $hr->room_id){ echo "selected";}?> > <?php echo $hr->room_title;?> </option>
        <?php } ?>
        </select>
         <span class="btn bookrslt" style="display:none"></span>
        </div>
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
        <?php
        /*$extra_details = $extra_details->get_extra_details($invoiceid);*/
       /* echo json_encode($bdetails);
          $extra_data =  json_decode($extra_details[0]->extra_data); 
          if($extra_data != array()){*/
 ?>
        <div class="form-group">
            <label class="col-md-3 control-label">Additional notes</label>
            <div class="col-md-8" style="margin-top:7px;">
              <?php echo $bdetails->additionaNotes; ?>
            </div>
        </div>
        <?php
        if($extra_details){
        ?>
        <div class="form-group">
            <label class="col-md-3 control-label">Pickup location</label>
            <div class="col-md-8" style="margin-top:7px;">
              <?php echo $extra_details->location; ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Pickup time</label>
            <div class="col-md-8" style="margin-top:7px;">
              <?php echo $extra_details->time; ?>
            </div>
        </div>
        <?php } ?>
        
       <!-- <div class="form-group">
            <label class="col-md-3 control-label">Guests</label>
            <div class="col-md-8" style="margin-top:7px;">
              <?php  //for ($g_i_e=0; $g_i_e < count( $extra_data->guest_data) ; $g_i_e++) {
                 //   echo $extra_data->guest_data[$g_i_e].'<br>';
                 // }
                ?>
            </div>
        </div>-->
        <?php //} ?>
        <div class="form-group" style="display:none;">
        <label class="col-md-3 control-label">Total Room Price</label>
        <div class="col-md-3">
         </div>
        </div>

        <input class="form-control" id="totalroomprice" type="hidden" name="totalroomprice"  value="<?php echo $rtotal;?>" readonly="true">
        <div class="form-group">
        <label class="col-md-3 control-label">Per Night Price</label>
        <div class="col-md-3">
        <input class="form-control" id="roomtotal" type="text" placeholder="Price" name="roomtotal" value="<?php echo $subitemprice;?>" readonly="true">
        </div>
        </div>


         <?php if($applytax == "yes"){ ?>
          <div class="form-group">
        <label class="col-md-3 control-label">Total Tax</label>
        <div class="col-md-3">
        <input class="form-control" id="taxamount" type="text" name="taxamount"  value="<?php echo $bdetails->tax;?>" readonly="true">
         </div>

        </div>
        <?php }else{ ?><input id="taxamount" type="hidden" name="taxamount"  value="0"><?php } } ?>

         <!-- Hotels-->

      <!-- Cars-->
      <?php
       $cartrue = $chklib->is_mod_available_enabled("cars");
      if($service == "cars" && $cartrue){ ?>
        <input type="hidden" name="totalamount" id="totalcaramount" value="0" />
        <div class="form-group">
        <label class="col-md-3 control-label">Car Name</label>
        <div class="col-md-8">
         <?php echo $bdetails->title;?>
        </div>
        </div>
         <?php } ?>


      <!--Cars-->
     <div class="form-group">
        <label class="col-md-3 control-label">Total Amount</label>
        <div class="col-md-3">

        <input class="form-control editdeposit" type="text" id="totaltopay"  name="totaltopay"  value="<?php echo $bdetails->checkoutAmount;?>" readonly="true">
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
          <button  id="element_id_1470283648" type="button"></button>
          <label class="col-md-3 control-label" id="" style="display:none;" >Payment Type</label>
				 <div class="col-md-4 add_link"  data-paystandimg="<?php echo base_url().'assets/img/paystand_logo.png'; ?>">
         <input type="hidden" name="paymethod" value="paystand">
				    <select style="display:none;"  class="form-control sel_pay" name="paymethod1" data-placeholder="Select" >
                 <option value="">Select</option>
                    <?php foreach($paygateways['activeGateways'] as $payt){ if($payt['name'] != 'moneybookers'){?>
                    <option value="<?php echo $payt['name'];?>" <?php if($payt['name'] == $bdetails->paymethod){ echo "selected"; } ?> ><?php echo  $payt['displayName'];?></option>
                    <?php } } ?>
                  </select>
                  <div style="display:none;padding:10px;" class="paystand_btn_show" >
                  <button  id="element_id_1470283648" type="button"></button>
                  </div>
				  </div>
          </div>
        </div>
        <?php 
$repl_arry = array(".",",");
?>
        <script>
              $(".paystand_btn_show").hide();
               $(".creditcardform").hide();
            $(".sel_pay").change(function(){
              var payment_get = $( ".sel_pay option:selected" ).val();
              console.log(payment_get);
              var img_uu = $(".add_link").data("paystandimg");
              if(payment_get == 'paystand'){
                /*console.log(payment_get);*/
                 $(".creditcardform").hide();
                $(".paystand_btn_show").show();
                //$(".add_link").append('<a class="paystand_lick" href ="https://tarzango.paystand.com/" target="_blank" ><img style="margin-top: 20px;" src="'+img_uu+'" ></a> <script>$(".paystand_lick").click(function(){$(this).remove();});<\/script>');
               

              }else if(payment_get == 'paypalpaymentspro'){
                $(".creditcardform").show();
              }else{
                $(".creditcardform").hide();
              }
            });

  var PayStand = PayStand || {};
  PayStand.checkouts = PayStand.checkouts || [];
  PayStand.load = PayStand.load || function(){};
  var checkout = {
  // live
  api_key: "aiPjqMbXh79vnMDqBVeq1xtM6VIx0LGVfu4ifqQONbm8PrS2GRinF/TDsoMeqeHUJfJ6Xrp9FSGrn2ehugEX8/w",
  //test
  //api_key: "aiPjqMbXh79vnMDqBVeq1xtM6VIx0LGVfu4ifqQONbm8PrS2GRinF/TDsoMeqeHUJfJ6Xrp9FSGrn2ehugEX8/w",
  // live
  org_id: "15191",
  //test
  //org_id: "760",
  element_ids: ["element_id_1470283648"],
  data_source: "org_defined",
  checkout_type: "button",
  button_options: {
  button_type: "checkout",
  button_name: "Pay Now",
  input: false,
  variants: false
  },
  amount: "<?php echo str_replace($repl_arry,'',number_format($bdetails->checkoutTotal,2));?>",
  //amount: "100",
  items: [{
  title: "Reservation Payment",
  subtitle: "Payment to lock reservation in TarzanGo",
  item_price: "<?php echo str_replace($repl_arry,'',number_format($bdetails->checkoutTotal,2));?>",
  //item_price: "100",
  quantity: 1
  }],
  }
  PayStand.checkoutComplete = function (data) {
    $.ajax({
        type: 'POST',
        data:{pay_data : data , invoice_id : <?php echo $bdetails->id; ?> , invoice_code : <?php echo $bdetails->code; ?> },
        url: '<?php echo base_url();?>invoice/booking_paid_paystand',
        cache: false,
        beforeSend:function(){
                  // show image here
                  $(".popupBg1").show();
                  $(".data").hide();
        },
        success: function(data)
        {
            console.log('final_data'+data);
            location.reload(true);
            //alert();
        },
        error: function(e)
        {
          alert(e.message);
        }
    });
    console.log('update123->'+JSON.stringify(data));
  };
  PayStand.checkoutUpdated = function (data) {
    console.log('update->'+JSON.stringify(data));


  };
  PayStand.checkouts.push(checkout);
  PayStand.script = document.createElement('script');
  PayStand.script.type = 'text/javascript';
  PayStand.script.async = true;
  PayStand.script.src = 'https://app.paystand.com/js/gen/checkout.min.js';
  var s = document.getElementsByTagName('script')[0];
  s.parentNode.insertBefore(PayStand.script, s);
        </script>
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


   <?php if(!empty($service)){  ?>
    <div class="col-md-4 pull-right">
    <div class="panel panel-default" >
      <div style="font-size:16px" class="panel-heading"><strong>Booking Summary</strong></div>

      <table class="table summary">
       <tr style="background-color:#ffffdf">

       <td><b><span id="itemtitlesum"><?php echo $bdetails->title;?></span></b></td>
       <td><span id="itempricesum"><?php if(!empty($itemprice)){ echo $app_settings[0]->currency_sign.$itemprice; } ?></span></td>

       </tr>
<?php 
if(!empty($bdetails->bookingExtras)){
foreach($bdetails->bookingExtras as $bextra){ ?>
 <tr style='background-color:#ffffdf' class='sidesups' id="extras_<?php echo $bextra->id;?>"><td><b><?php echo $bextra->title; ?></b></td> <td> <strong><?php echo $app_settings[0]->currency_sign.$bextra->price; ?></strong> </td></tr>
   <?php  } } ?>
      </table>
      <table class="table table-bordered">

     <?php if($service == "hotels"){ ?>
     <?php if($bdetails->extraBeds > 0){  ?>  
    <tr>
      <td><b>Extra Bed (<?php echo $bdetails->extraBeds;?>)</b></td>
      <td style="font-size:14px"><?php echo $app_settings[0]->currency_sign;?><?php echo $bdetails->extraBedsCharges;?></td>
    </tr>
    <?php } ?>
      <tr style="background-color:#e7ffda" style="display:none;" id="tr_roomamount">
       <td style="font-size:14px"><b>Total Room Amount</b></td>
       <td style="font-size:14px"><?php echo $app_settings[0]->currency_sign;?><span id="summaryroomtotal"><?php echo $rtotal;?></span></td>
      
      </tr>
    
      <?php } ?>
        <tr style="background-color:#e7ffda" class="taxesvat">
       <td style="font-size:14px"><b>Tax & VAT </b></td>
       <td style="font-size:14px" id="displaytax"><?php echo $app_settings[0]->currency_sign.$bdetails->tax;?></td>

       </tr>
      <tr style="background-color:#ffffdf">
       <td style="font-size:14px"><b>Deposit </b></td>
       <td style="font-size:14px" id="topaytotal"><?php echo $app_settings[0]->currency_sign.$bdetails->checkoutAmount;?></td>

       </tr>

       <tr style="background-color:#e7ffda">
       <td style="font-size:18px"><b>GRAND TOTAL</b></td>
       <td style="font-size:18px" id="grandtotal"><?php echo $app_settings[0]->currency_sign;  echo $bdetails->checkoutTotal;?></td>
       </tr>

      </table>
    </div>
    </div>
    <?php } ?>
    </div>
 <div class="modal-body">
        <div role="form">
          <div class="form-group" style="display:none;">
            <label for="form-input" class="hidden-xs col-sm-2 control-label text-left" style="padding: 10px;font-size: 18px;"><?php echo trans('0154');?></label>
            <div class="col-sm-10 col-md-10 col-xs-12">
              <select class="form-control form selectx" name="gateway" id="gateway">
                <option value=""><?php echo trans('0159');?></option>
                <?php foreach ($paymentGateways as $pay) { if($pay['name'] != "payonarrival" && $pay['name'] != 'moneybookers'){ ?>
                <option value="<?php echo $pay['name']; ?>" <?php makeSelected($invoice->paymethod, $pay['name']); ?> ><?php echo $pay['gatewayValues'][$pay['name']]['name']; ?></option>
                <?php } } ?>
              </select>
              <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
          <div class="col-sm-6 creditcardform" style="display:none;" >
            <form  role="form" action="<?php echo base_url();?>creditcard" method="POST">
              <fieldset>
                <div class="row">
                  <div class="col-md-6  go-right">
                    <div class="form-group ">
                      <label class="required go-right">First name</label>
                      <input type="text" class="form-control" name="firstname" id="card-holder-firstname" placeholder="<?php echo trans('0171');?>">
                    </div>
                  </div>
                  <div class="col-md-6  go-left">
                    <div class="form-group ">
                      <label class="required go-right">Last name</label>
                      <input type="text" class="form-control" name="lastname" id="card-holder-lastname" placeholder="<?php echo trans('0172');?>">
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-md-12  go-right">
                    <div class="form-group ">
                      <label class="required go-right">Card number</label>
                      <input type="text" class="form-control" name="cardnum" id="card-number" placeholder="<?php echo trans('0316');?>" onkeypress="return isNumeric(event)" >
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-md-3 go-left">
                    <div class="form-group ">
                      <label style="font-size:13px" class="required  go-left">Month</label>
                      <select class="form-control col-sm-2" name="expMonth" id="expiry-month">
                        <option value="01"><?php echo trans('0317');?> (01)</option>
                        <option value="02"><?php echo trans('0318');?> (02)</option>
                        <option value="03"><?php echo trans('0319');?> (03)</option>
                        <option value="04"><?php echo trans('0320');?> (04)</option>
                        <option value="05"><?php echo trans('0321');?> (05)</option>
                        <option value="06"><?php echo trans('0322');?> (06)</option>
                        <option value="07"><?php echo trans('0323');?> (07)</option>
                        <option value="08"><?php echo trans('0324');?> (08)</option>
                        <option value="09"><?php echo trans('0325');?> (09)</option>
                        <option value="10"><?php echo trans('0326');?> (10)</option>
                        <option value="11"><?php echo trans('0327');?> (11)</option>
                        <option value="12"><?php echo trans('0328');?> (12)</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3 go-left">
                    <div class="form-group">
                      <label class="required go-right">Year</label>
                      <select class="form-control" name="expYear" id="expiry-year">
                        <?php for($y = date("Y");$y <= date("Y") + 10;$y++){?>
                        <option value="<?php echo $y?>"><?php echo $y; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3 go-left">
                    <div class="form-group">
                      <label class="required go-right">CVV</label>
                      <input type="text" class="form-control" name="cvv" id="cvv" placeholder="<?php echo trans('0331');?>">
                    </div>
                  </div>
                  <div class="col-md-3 go-left">
                    <label class="required go-right">&nbsp;</label>
                    <img src="<?php echo base_url(); ?>assets/img/cc.png" class="img-responsive">
                  </div>
                </div>
                <div class="clearfix"></div>
                <br>
                <div class="form-group">
                  <div class="alert alert-danger submitresult" style="display:none;"><?php //echo json_encode($bdetails); ?></div>
                  <input type="hidden" name="paymethod" id="creditcardgateway" value="paypalpaymentspro" />
                  <input type="hidden" name="is_admin_side" id="is_admin_side" value="1" />
                  <input type="hidden" name="bookingid" id="bookingid" value="<?php echo $bdetails->id;?>" />
                  <input type="hidden" name="refno" id="bookingid" value="<?php echo $bdetails->code;?>" />
                  <input type="hidden" name="page_name" id="page_name" value="<?php echo base_url().uri_string();?>" />
                  <button type="submit" class="btn btn-success btn-lg paynowbtn pull-left" onclick="return expcheck();">Pay</button>
                </div>
              </fieldset>
            </form>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
      </div>

  </div>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/adminbooking.js"></script>


