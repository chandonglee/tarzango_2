<?php

$booking_extra_data = json_decode($data->booking_extra_data);
$book_response = json_decode($data->book_response);
$att_data = json_encode($data);
?>
<h3 class="margin-top-0"><?php echo $headingText;?></h3>
<div class="output"></div>
<form action="" method="POST" class="hotel-form" enctype="multipart/form-data" >
  <div class="panel panel-default">
    
    <div class="panel-body">
      <br>
      <div class="tab-content form-horizontal">
        <div class="tab-pane wow fadeIn animated active in" id="GENERAL">
          <div class="clearfix"></div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Ref. no</label>
            <div class="col-md-8" style="margin-top:7px;">
              <?php echo $data->booking_ref_no;?>
              </div>
          </div>
           <div class="row form-group">
            <label class="col-md-2 control-label text-left">Customer Name</label>
            <div class="col-md-8" style="margin-top:7px;">
              <?php echo $profile->ai_first_name.' '.$profile->ai_last_name;?>
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Customer Email</label>
            <div class="col-md-8" style="margin-top:7px;">
             <?php echo $profile->accounts_email;?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 control-label text-left">Check in</label>
            <div class="col-md-8">
            <?php echo $booking_extra_data->checkin;?>
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Attraction Name</label>
            <div class="col-md-4">
              <?php echo $booking_extra_data->attraction_name;?>
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Address</label>
            <div class="col-md-8" style="margin-top:7px;">
             <?php echo $booking_extra_data->address;?>
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Total</label>
            <div class="col-md-8" style="margin-top:7px;">
             <?php echo $data->booking_total;?>
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Remaining</label>
            <div class="col-md-8" style="margin-top:7px;">
             <?php echo $data->booking_remaining;?>
            </div>
          </div>
        
          <div class="form-group">
        <label class="col-md-2 control-label text-left">Booking Status</label>
        <div class="col-md-3">
        <?php if($adminsegment == "admin" || $adminsegment == "supplier"){ ?>
        <select class="form-control " id="status" name="status">
          <option value="unpaid"  <?php if($data->booking_status == "unpaid"){ echo "selected"; }?>>Unpaid</option>
          <option value="paid" <?php if($data->booking_status == "paid"){ echo "selected"; }?>>Paid</option>
          <option value="cancelled" <?php if($data->booking_status == "cancelled"){ echo "selected"; }?>>Cancelled</option>
        </select>

        <?php }else{ ?> 
        <input type="text" name="status" class="form-control" value="<?php echo ucfirst($data->booking_status); ?>" readonly>
        <?php } ?>
         </div>

        </div>
          
         
        </div>
        
      </div>

    </div>

        <?php if($adminsegment == "admin"  || $adminsegment == "supplier" ){ ?>
        <div class="panel panel-default rprice paytype">
          <div class="panel-heading"><strong>Payment Method</strong></div>
          <div class="panel-body">
          <button  id="element_id_1470283648" type="button"></button>
          <label class="col-md-3 control-label" id="" style="display:none;" >Payment Type</label>
         <div class="col-md-4 add_link"  data-paystandimg="<?php echo base_url().'assets/img/paystand_logo.png'; ?>">
         <input type="hidden" name="paymethod" value="paystand">
          </div>
          </div>
        </div>
        <?php 
          $repl_arry = array(".",",");
          ?>
      
        <?php }else{ ?>
        <input type="hidden" name="paymethod" value="<?php echo $data->paymetmethod;?>">
        <?php } ?>

    <div class="panel-footer">
      <input type="hidden" id="slug" value="<?php echo $data->pt_attr_booking_id;?>" />      
      <input type="hidden" id="slug" value="<?php echo $data->pt_attr_booking_id;?>" />      
      <input type="hidden" id="att_id" value="<?php echo $data->pt_attr_booking_id;?>" />      
      <input type="hidden" name="submittype" value="<?php echo $submittype;?>" />
      <input type="hidden" name="pt_attr_booking_id" value="<?php echo $data->pt_attr_booking_id;?>" />
      <input type="hidden" name="booking_ref_no" value="<?php echo $data->booking_ref_no;?>" />
      <button type="submit" class="btn btn-primary submitfrm" id="<?php echo $submittype; ?>">Submit</button>
    </div>
  </div>



 

</form>
  <script type="text/javascript">

    $('.submitfrm').click(function(){ 
    if( $('#status').val() == 'paid'){
       var att_id = $('#att_id').val();
       var url2 = '<?php echo base_url(); ?>';
      $.ajax({
             type: 'GET',
             data: {
                 att_id: att_id
             },
             url: url2 + "admin/attractionajaxcalls/attraction_paid_email",
             cache: false,
             beforeSend: function() {

             },
             success: function(response) {
                 console.log(response);
                
             }
         });
      }
    
 });
  </script>

       <!-- Google Map API -->
  <script>
          var PayStand = PayStand || {};
          PayStand.checkouts = PayStand.checkouts || [];
          PayStand.load = PayStand.load || function(){};
          var checkout = {
          //api_key: "aiPjqMbXh79vnMDqBVeq1xtM6VIx0LGVfu4ifqQONbm8PrS2GRinF/TDsoMeqeHUJfJ6Xrp9FSGrn2ehugEX8/w",
          api_key: "aUGXTVXIQWzpuRpHZiBjJIs01C5HWowACqx5aOLFQ49xh2JnbGbkKwol1jR5MwY3kIkjHogLXwEpno1kkrQEM3w",
          //org_id: "15191",
          org_id: "760",
          element_ids: ["element_id_1470283648"],
          data_source: "org_defined",
          checkout_type: "button",
          button_options: {
          button_type: "checkout",
          button_name: "Pay Now",
          input: false,
          variants: false
          },
          amount: "<?php echo str_replace($repl_arry,'',number_format($data->booking_total,2));?>",
          //amount: "100",
          items: [{
          title: "Reservation Payment",
          subtitle: "Payment to lock reservation in TarzanGo",
          item_price: "<?php echo str_replace($repl_arry,'',number_format($data->booking_total,2));?>",
          //item_price: "100",
          quantity: 1
          }],
          }
          PayStand.checkoutComplete = function (data) {
            $.ajax({
                type: 'POST',
                data:{pay_data : data , pt_attr_booking_id : <?php echo $data->pt_attr_booking_id; ?> },
                url: '<?php echo base_url();?>admin/ajaxcalls/booking_paid_paystand',
                cache: false,
                beforeSend:function(){
                          // show image here
                          $(".popupBg1").show();
                          $(".data").hide();
                },
                success: function(data)
                {
                   // console.log('final_data'+data);
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
          //PayStand.script.src = 'https://app.paystand.com/js/gen/checkout.min.js';
          PayStand.script.src = 'https://sandbox.paystand.com/js/gen/checkout.min.js';
          var s = document.getElementsByTagName('script')[0];
          s.parentNode.insertBefore(PayStand.script, s);
  </script>
<script>
  $(document).ready(function() {
      if (window.location.hash != "") {
          $('a[href="' + window.location.hash + '"]').click()
      }
  });

</script>