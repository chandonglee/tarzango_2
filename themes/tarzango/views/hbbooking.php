<?php if($result == "success" && $appModule == "ean"){ ?>
 <!-- Start Result of Expedia booking for submit -->
<style>
  .btn-circle {
  border-radius: 50%;
  font-size: 54px;
  padding: 10px 20px;
  }
</style>
<div class="modal-dialog modal-lg" style="z-index: 10;" >
  <div class="modal-content">
    <div class="modal-body">
      <br><br>
      <div class="center-block">
        <center>
          <button class="btn btn-circle block-center btn-lg btn-success"><i class="fa fa-check"></i></button>
          <h3 class="text-center"><?php echo trans('0409');?> <b class="text-success wow flash animted animated"><?php echo trans('0135');?></b></h3>
          <p class="text-center"><?php echo $msg;?></p>
          <p><?php echo trans('0540'); ?>: <?php echo $itineraryID; ?></p>
          <p><?php echo trans('0539'); ?>: <?php echo $confirmationNumber; ?></p>

              <?php if(!empty($nightlyRateTotal)){ ?>
              <p><strong>Total Nightly Rate: <?php echo $currency." ".$nightlyRateTotal; ?></strong></p>
              <?php } ?>

              <?php if(!empty($SalesTax)){ ?>
              <p><strong>Sales Tax: <?php echo $currency." ".$SalesTax; ?></strong></p>
              <?php } ?>

              <?php if(!empty($HotelOccupancyTax)){ ?>
              <p>><strong>Hotel Occupancy Tax: <?php echo $currency." ".$HotelOccupancyTax; ?></strong></p>
              <?php } ?>

              <?php if(!empty($TaxAndServiceFee)){ ?>
              <p><strong>Tax and Service Fee: <?php echo $currency." ".$TaxAndServiceFee; ?></strong></p>
              <?php } ?>

          <p><b>  <?php echo trans('0124');?> :</b> <?php echo $currency.$grandTotal;?> (<?php echo trans('0538'); ?>) </p>
          <p><?php echo trans('0537'); ?> </p>
          <?php if(!empty($checkInInstructions)){ ?>
          <p><strong><?php echo trans('0458'); ?></strong> : <?php echo strip_tags($checkInInstructions); ?></p>
          <?php } ?>
          <?php if(!empty($nonRefundable)){ ?>
          <p><strong><?php echo trans('0309'); ?></strong> : <?php echo $cancellationPolicy; ?></p>
          <?php } ?>
        </center>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
 <!-- End Result of Expedia booking for submit -->
 <?php }elseif($result == "fail" ) { ?>
  <div class="modal-dialog modal-lg" style="z-index: 10;" >
  <div class="modal-content">
    <div class="modal-body" style="min-height:500px;">
      <br><br>
      <div class="center-block">
        <center>
          <button class="btn btn-circle block-center btn-lg btn-danger"><i class="fa fa-close"></i></button>
          <h3 class="text-center"><?php echo trans('0409');?> <b class="text-danger wow flash animted animated">Failed</b></h3>
          <p class="text-center"><?php echo $msg;?></p>
          <form action="<?php echo base_url(); ?>" method="post"><button type="submit" style="color: black; background-color: #ffc100; border-color: #ffc100;" class="btn btn-primary">Goto homepage</button></form>
        </center>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
<?php  }else{ ?>
<div class="bg_list_image">
<div class="container">
    <!-- Start Fail Result of Expedia booking for submit -->
    <?php if($result == "fail" && $appModule == "ean"){ ?>
    <div class="alert alert-danger wow bounce" role="alert">
      <p><?php echo $msg;?></p>
    </div>
    <div class="modal-dialog modal-lg" style="z-index: 10;" >
  <div class="modal-content">
    <div class="modal-body">
      <br><br>
      <div class="center-block">
        <center>
          <button class="btn btn-circle block-center btn-lg btn-success"><i class="fa fa-check"></i></button>
          <h3 class="text-center"><?php echo trans('0409');?> <b class="text-success wow flash animted animated"><?php echo trans('0135');?></b></h3>
          <p class="text-center"><?php echo $msg;?></p>
          <p><?php echo trans('0540'); ?>: <?php echo $itineraryID; ?></p>
          <p><?php echo trans('0539'); ?>: <?php echo $confirmationNumber; ?></p>

              <?php if(!empty($nightlyRateTotal)){ ?>
              <p><strong>Total Nightly Rate: <?php echo $currency." ".$nightlyRateTotal; ?></strong></p>
              <?php } ?>

              <?php if(!empty($SalesTax)){ ?>
              <p><strong>Sales Tax: <?php echo $currency." ".$SalesTax; ?></strong></p>
              <?php } ?>

              <?php if(!empty($HotelOccupancyTax)){ ?>
              <p>><strong>Hotel Occupancy Tax: <?php echo $currency." ".$HotelOccupancyTax; ?></strong></p>
              <?php } ?>

              <?php if(!empty($TaxAndServiceFee)){ ?>
              <p><strong>Tax and Service Fee: <?php echo $currency." ".$TaxAndServiceFee; ?></strong></p>
              <?php } ?>

          <p><b>  <?php echo trans('0124');?> :</b> <?php echo $currency.$grandTotal;?> (<?php echo trans('0538'); ?>) </p>
          <p><?php echo trans('0537'); ?> </p>
          <?php if(!empty($checkInInstructions)){ ?>
          <p><strong><?php echo trans('0458'); ?></strong> : <?php echo strip_tags($checkInInstructions); ?></p>
          <?php } ?>
          <?php if(!empty($nonRefundable)){ ?>
          <p><strong><?php echo trans('0309'); ?></strong> : <?php echo $cancellationPolicy; ?></p>
          <?php } ?>
        </center>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
    <?php } ?>
     <!-- End Fail Result of Expedia booking for submit -->
  <div class="mt25 offset-0">
    <div class="loadinvoice">
      <div class="acc_section">
        <div class="col-md-8 pagecontainer2 offset-0 go-right" style="margin-bottom:50px;">
          <div class="panel-body">
            <br>
            <div class="result"></div>
            <?php if(!empty($error)){ ?>
            <h1 class="text-center strong"><?php echo trans('0432');?></h1>
            <h3 class="text-center"><?php echo trans('0431');?></h3>
            <?php }else{ ?>
             <!-- Start Other Modules Booking left section -->
             <?php if($appModule != "ean"){ ?>
            <?php include $themeurl.'views/booking/profile.php'; ?>
            <form id="bookingdetails" class="hidden-xs hidden-sm" action="" onsubmit="return false">
              <?php if(!empty($module->extras)){ ?>
              <div class="clearfix"></div>
              <div class="panel panel-default">
                <div class="panel-heading go-text-right"><?php echo trans('001');?> <?php echo trans('0156');?></div>
                <script>
                  //Incrementer
                  $(function () {
                    "use strict";
                      $(".numbers-row").append('<div class="inc button_inc">+</div><div class="dec button_inc">-</div>');
                      $(".button_inc").on("click", function () {

                          var $button = $(this);
                          var oldValue = $button.parent().find("input").val();

                          if ($button.text() == "+") {
                              var newVal = parseFloat(oldValue) + 1;
                          } else {
                              // Don't allow decrementing below zero
                              if (oldValue > 1) {
                                  var newVal = parseFloat(oldValue) - 1;
                              } else {
                                  newVal = 1;
                              }
                          }
                          $button.parent().find("input").val(newVal);
                      });
                  });

                </script>
                <!-- Carousel -->
                <table class="table table-striped cart-list add_bottom_30">
                  <thead>
                    <tr>
                      <th><?php echo trans('0376');?></th>
                      <th><?php echo trans('077');?></th>
                      <th><?php echo trans('070');?></th>
                      <th class="text-center"><?php echo trans('0399');?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($module->extras as $extra){ ?>
                    <?php include $themeurl.'views/booking/extras.php'; ?>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!--End step -->
              <?php } ?>
              <script type="text/javascript">
                $(function(){
                $('.popz').popover({ trigger: "hover" });
                });
              </script>
              <!-- Complete This booking button only starting -->
              <div class="panel panel-default btn_section" style="display:none;">
                <div class="panel-body">
                  <center>
                </div>
              </div>
              <!-- End Complete This booking button only -->
              <input type="hidden" id="itemid" name="itemid" value="<?php echo $module->id;?>" />
              <input type="hidden" name="checkout" value="<?php echo $module->checkout;?>" />
              <input type="hidden" name="adults" value="<?php echo $module->adults;?>" />
              <input type="hidden" id="couponid" name="couponid" value="" />
              <input type="hidden" id="btype" name="btype" value="<?php echo $appModule;?>" />
              <?php if($appModule == "hotels"){ ?>
              <input type="hidden" name="subitemid" value="<?php echo $room->id;?>" />
              <input type="hidden" name="roomscount" value="<?php echo $room->roomscount;?>" />
              <input type="hidden" name="bedscount" value="<?php echo $room->extraBedsCount;?>" />
              <input type="hidden" name="checkin" value="<?php echo $module->checkin;?>" />
              <?php } ?>
            
           
            <?php  include $themeurl.'views/coupon.php';  ?>
             </form>
            <div class="clearfix"></div>
          
            <div class="line3"></div>
            <?php if(!empty($module->policy)){ ?>
            <br>
            <div class="alert alert-info">
              <strong class="RTL go-right"><?php echo trans('045');?></strong><br>
              <p class="RTL" style="font-size:12px"><?php echo $module->policy;?></p>
            </div>
            <?php } ?>
            <p class="RTL"><?php echo trans('0416');?></p>
            <div class="form-group">
              <span id="waiting"></span>
              <button type="submit" class="btn btn-action btn-lg btn-block completebook" name="<?php if(empty($usersession)){ echo "guest";}else{ echo "logged"; } ?>"  onclick="return completebook('<?php echo base_url();?>','<?php echo trans('0159')?>');"><?php echo trans('0306');?></button>
            </div>

           <!-- End Other Modules Booking left section -->
            <?php }else{?>
            <!-- Start Expedia Booking Form -->
            <form role="form" action="" method="POST"  >
            <div class="step">
              <div class="panel-body">
                <div class="col-md-6  go-right">
                  <div class="form-group ">
                    <label  class="required go-right"><?php echo trans('0171');?></label>
                    <input class="form-control form" id="card-holder-firstname" type="text" placeholder="<?php echo trans('0171');?>" name="firstName"  value="<?php echo @@$profile[0]->ai_first_name?>">
                  </div>
                </div>
                <div class="col-md-6  go-left">
                  <div class="form-group ">
                    <label  class="required go-right"><?php echo trans('0172');?></label>
                    <input class="form-control form" id="card-holder-lastname" type="text" placeholder="<?php echo trans('0172');?>" name="lastName"  value="<?php echo @$profile[0]->ai_last_name?>">
                  </div>
                </div>
                <div class="col-md-6 go-right">
                  <div class="form-group ">
                    <label  class="required  go-right"><?php echo trans('094');?></label>
                    <input class="form-control form" id="card-holder-email" type="text" placeholder="<?php echo trans('094');?>" name="email"  value="<?php echo @$profile[0]->accounts_email; ?>">
                  </div>
                </div>
                <div class="col-md-6 go-right">
                  <div class="form-group ">
                    <label  class="required go-right"><?php echo trans('0173');?></label>
                    <input class="form-control form" id="card-holder-phone" type="text" placeholder="<?php echo trans('0414');?>" name="phone"  value="<?php echo @$profile[0]->ai_mobile; ?>">
                  </div>
                </div>
                <div class="col-md-6  go-right">
                  <div class="form-group ">
                    <label  class="required go-right"><?php echo trans('0105');?></label>
                    <select data-placeholder="Select" id="country" name="country" class="form-control">
                      <option value=""> <?php echo trans('0158');?> <?php echo trans('0105');?> </option>
                      <?php foreach($allcountries as $c){ ?>
                      <option value="<?php echo $c->iso2;?>" <?php makeSelected($c->iso2, @$profile[0]->ai_country); ?> ><?php echo $c->short_name;?></option>
                      <?php }  ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6  go-left">
                  <div class="form-group ">
                    <label  class="required go-right"><?php echo trans('0101');?></label>
                    <input id="card-holder-state" class="form-control form" type="text" placeholder="<?php echo trans('0101');?>" name="province"  value="<?php if(!empty($profile[0]->ai_state)){ echo @$profile[0]->ai_state; } ?>">
                  </div>
                </div>
                <div class="col-md-6 go-right">
                  <div class="form-group ">
                    <label  class="required  go-right"><?php echo trans('0100');?></label>
                    <input id="card-holder-city" class="form-control form" type="text" placeholder="<?php echo trans('0100');?>" name="city"  value="<?php echo @$profile[0]->ai_mobile; ?>">
                  </div>
                </div>
                <div class="col-md-6 go-left">
                  <div class="form-group">
                    <label  class="required go-right"><?php echo trans('0103');?></label>
                    <input id="card-holder-postalcode" class="form-control form" type="text" placeholder="<?php echo trans('0104');?>" name="postalcode"  value="<?php if(!empty($profile[0]->ai_postal_code)){ echo @$profile[0]->ai_postal_code; } ?>">
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12  go-right">
                  <div class="form-group ">
                    <label  class="required go-right"><?php echo trans('098');?></label>
                    <textarea class="form-control form" placeholder="<?php echo trans('098');?>" rows="4"  name="address"><?php echo @$profile[0]->ai_address_1; ?></textarea>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
            <!--End step -->
            <script type="text/javascript">
              $(function(){
              $('.popz').popover({ trigger: "hover" });
              });
            </script>
            <!-- Complete This booking button only starting -->
            <div class="panel panel-default btn_section" style="display:none;">
              <div class="panel-body">
                <center>
              </div>
            </div>
            <!-- End Complete This booking button only -->
            <input type="hidden" name="pay" value="1" />
            <input type="hidden" name="adults" value="<?php echo $_GET['adults'];?>" />
            <input type="hidden" name="child" value="<?php echo $_GET['child'];?>" />
            <input type="hidden" name="sessionid" value="<?php echo $_GET['sessionid']; ?>" />
            <input type="hidden" name="hotel" value="<?php echo $_GET['hotel']; ?>" />
            <input type="hidden" name="hotelname" value="<?php echo $module->title;?>" />
            <input type="hidden" name="hotelstars" value="<?php echo $hotelStars;?>" />
            <input type="hidden" name="location" value="<?php echo $module->location;?>" />
            <input type="hidden" name="thumbnail" value="<?php echo $module->thumbnail; ?>" />
            <input type="hidden" name="roomname" value="<?php echo $roomname; ?>" />
            <input type="hidden" name="roomtotal" value="<?php echo $roomtotal; ?>" />
            <input type="hidden" name="checkin" value="<?php echo $_GET['checkin']; ?>" />
            <input type="hidden" name="checkout" value="<?php echo $_GET['checkout']; ?>" />
            <input type="hidden" name="roomtype" value="<?php echo $_GET['roomtype']; ?>" />
            <input type="hidden" name="ratecode" value="<?php echo $_GET['ratecode']; ?>" />
            <input type="hidden" name="currency" value="<?php echo $currency; ?>" />
            <input type="hidden" name="ratekey" value="<?php echo $_GET['ratekey']; ?>" />
            <input type="hidden" name="total" value="<?php echo $total; ?>" />
            <input type="hidden" name="tax" value="<?php echo $tax; ?>" />
            <input type="hidden" name="nights" value="<?php echo $nights; ?>" />
            <div class="clearfix"></div>
            <div class="panel-body">
              <!-- card code -->
              <div class="clearfix"></div>
              <div class="col-md-3 go-left">
                <div class="form-group">
                  <label  class="required go-right">Select payment method</label>
                        <input type="radio" id="paystand" name="payment_type" value="patstand"> Paystand
                        <input type="radio" id="paypal" name="payment_type" value="paypal"> Paypal
                </div>
              </div>
              
              <hr>
              <div class="row">
                <div class="col-md-12">
                  <p style="padding:10px;"><input type="checkbox" name="" id="policy" value="1">
                    <?php echo trans('0416');?>  <br>
                    <a href="http://travel.ian.com/index.jsp?pageName=userAgreement&locale=en_US&cid=<?php echo $eanlib->cid; ?>" target="_blank"><?php echo trans('057'); ?></a>
                  </p>
                  <div class="form-group">
                    <div class="alert alert-danger submitresult"></div>
                    <span id="waiting"></span>
                    <div class="col-md-12"><button type="submit" class="btn btn-success btn-lg btn-block paynowbtn" onclick="return expcheck();" name="<?php if(empty($usersession)){ echo "guest";}else{ echo "logged"; } ?>" ><?php echo trans('0306');?></button></div>
                 <div class="clearfix"></div><hr>
                    <div class="panel-body">
                     <p style="font-size:12px" class="go-right RTL"> <?php echo $checkInInstructions; ?></p>
                  </div>
                  </div>
                </div>
              </div>
            </div>
            </form>
            <!-- End Expedia Booking Form -->
            <?php } ?>

          </div>
        </div>
      </div>
      <!-- Booking Final Starting -->
      <div class="col-md-8 offset-0 final_section go-right"  style="display:none;">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="step-pane" id="step4">
              <div id="rotatingDiv" class="show"></div>
              <h2 class="text-center"><?php echo trans('0179');?></h2>
              <p class="text-center"><?php echo trans('0180');?></p>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
      <!-- Booking Final Ending -->
      <!-- END OF LEFT CONTENT -->
      <!-- RIGHT CONTENT -->
      <div class="col-md-4 go-left">
        <div class="pagecontainer2 paymentbox white">
          <div class="panel-body">
            <img class="form-group img-responsive img-rounded" src="<?php echo $module->thumbnail;?>" alt="<?php echo $module->title;?>" />
            <div class="opensans size18 dark bold RTL go-right"><?php echo $module->title;?></div>
            <div class="clearfix"></div>
            <div class="opensans size13 grey RTL go-right"><i class="fa fa-map-marker RTL"></i> <?php echo $module->location;?></div>
            <div class="clearfix"></div>
            <span class="go-right RTL"><?php //echo $module->stars;?></span>
          </div>
          <div class="hpadding30">
            <div >
              <div class="row">
                <!-- Start Hotels right side section -->
                <?php if($appModule == "hotels"){ ?>
                <table class="table table_summary">
                  <tbody>
                    <tr>
                      <td class="go-right">
                        <strong> <?php echo trans('07');?></strong> <br> <?php echo $module->checkin;?>
                      </td>
                      <td class="go-left">
                        <strong> <?php echo trans('09');?></strong> <br> <?php echo $module->checkout;?>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <?php echo trans('060');?>
                      </td>
                      <td class="text-right">
                        <?php echo $room->stay;?>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <?php echo $room->title;?>
                      </td>
                      <td class="text-right">
                        <?php echo $room->roomscount;?>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <?php echo trans('0412');?>
                      </td>
                      <td class="text-right">
                        <?php echo $room->currCode;?> <?php echo $room->currSymbol;?> <?php echo $room->perNight;?>
                      </td>
                    </tr>
                    <?php if($room->extraBedsCount > 0){ ?>
                    <tr>
                      <td>
                        <?php echo trans('0429');?>
                      </td>
                      <td class="text-right">
                        <?php echo $room->currCode;?> <?php echo $room->currSymbol;?><?php echo $room->extraBedCharges; ?>
                      </td>
                    </tr>
                    <?php } ?>
                    <tr class="beforeExtraspanel">
                      <td>
                        <?php echo trans('0153');?>
                      </td>
                      <td class="text-right">
                        <?php echo $room->currCode;?> <?php echo $room->currSymbol;?><span id="displaytax"><?php echo $module->taxAmount;?></span>
                      </td>
                    </tr>
                    <div class="booking-deposit">
                      <tr>
                        <td class="booking-deposit-font">
                          <strong><?php echo trans('0126');?></strong>
                        </td>
                        <td class="text-right">
                          <strong><span class="booking-deposit-font go-left"><?php echo $room->currCode;?> <?php echo $room->currSymbol;?><span id="displaydeposit"><?php echo $module->depositAmount?></span></span></strong>
                        </td>
                      </tr>
                    </div>
                    <tr>
                      <td>
                      </td>
                      <td >
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="padding30" style="padding-top:0px">
                  <span class="left size20"><strong><?php echo trans('0124');?></strong> :</span>
                  <span class="right lred2 bold size18">                        <?php echo $room->currCode;?> <?php echo $room->currSymbol;?><span id="displaytotal"><?php echo $room->price;?></span></span>
                  <div class="clearfix"></div>
                </div>
                <?php } ?>
                <!-- End Hotels right side section -->
                <!-- start Tours right side section -->
                <?php if($appModule == "tours"){ ?>
                <table class="table table_summary">
                  <tbody>
                    <tr>
                      <td>
                        <strong> <?php echo trans('0275');?></strong> : <?php echo $module->tourDays;?>
                      </td>
                      <td class="text-right">
                        <strong> <?php echo trans('0122');?></strong> : <?php echo $module->tourNights;?>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <?php echo trans('08');?>
                      </td>
                      <td class="text-right">
                        <?php echo $module->date;?>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <strong> <?php echo trans('010');?>  (<?php echo $module->adults;?>)</strong>
                      </td>
                      <td class="text-right">
                        <?php echo $module->currCode;?> <?php echo $module->currSymbol;?> <?php echo $module->adultprice;?>
                      </td>
                    </tr>
                    <?php if($module->children > 0) { ?>
                    <tr>
                      <td>
                        <strong> <?php echo trans('011');?>  (<?php echo $module->children;?>)</strong>
                      </td>
                      <td class="text-right">
                        <?php echo $module->currCode;?> <?php echo $module->currSymbol;?> <?php echo $module->childprice;?>
                      </td>
                    </tr>
                    <?php } ?>
                    <?php if($module->infants > 0) { ?>
                    <tr>
                      <td>
                        <strong> <?php echo trans('0282');?>  (<?php echo $module->infants;?>)</strong>
                      </td>
                      <td class="text-right">
                        <?php echo $module->currCode;?> <?php echo $module->currSymbol;?> <?php echo $module->infantprice;?>
                      </td>
                    </tr>
                    <?php } ?>
                    <tr>
                      <td>
                        <strong> <?php echo trans('0408');?> </strong>
                      </td>
                      <td class="text-right">
                        <?php echo $module->currCode;?> <?php echo $module->currSymbol;?> <?php echo $module->subTotal;?>
                      </td>
                    </tr>
                    <tr class="beforeExtraspanel">
                      <td>
                        <?php echo trans('0153');?>
                      </td>
                      <td class="text-right">
                        <?php echo $module->currCode;?> <?php echo $module->currSymbol;?><span id="displaytax"><?php echo $module->taxAmount;?></span>
                      </td>
                    </tr>
                    <div class="booking-deposit">
                      <tr>
                        <td class="booking-deposit-font">
                          <strong><?php echo trans('0126');?></strong>
                        </td>
                        <td class="text-right">
                          <strong><span class="booking-deposit-font go-left"><?php echo $module->currCode;?> <?php echo $module->currSymbol;?><span id="displaydeposit"><?php echo $module->depositAmount?></span></span></strong>
                        </td>
                      </tr>
                    </div>
                    <tr class="total">
                      <td>
                      </td>
                      <td class="text-right">
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="padding30" style="padding-top:0px">
                  <span class="left size20"><strong><?php echo trans('0124');?></strong> :</span>
                  <span class="right lred2 bold size18">                         <?php echo $module->currCode;?> <?php echo $module->currSymbol;?><span id="displaytotal"><?php echo $module->price;?></span></span>
                  <div class="clearfix"></div>
                </div>
                <?php } ?>
                <!-- End Tours right side section -->
                <!-- Start Cars right side section -->
                <?php if($appModule == "cars"){ ?>
                <table class="table table_summary">
                  <tbody>
                  <tr>
                      <td>
                        <?php echo trans('0275');?>
                      </td>
                      <td class="text-right">
                        <?php echo $module->totalDays;?>
                      </td>
                    </tr>
                    <tr>
                      <td>
                         <strong> <?php echo trans('0210');?> <?php echo trans('032');?> </strong>
                      </td>
                      <td class="text-right">
                        <strong>  <?php echo $modulelib->pickupLocationName;?> </strong>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <?php echo trans('0210');?> <?php echo trans('08');?>
                      </td>
                      <td class="text-right">
                        <?php echo $module->pickupDate;?>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <?php echo trans('0210');?> <?php echo trans('0259');?>
                      </td>
                      <td class="text-right">
                        <?php echo $module->pickupTime;?>
                      </td>
                    </tr>
                    <tr>
                      <td>
                         <strong>  <?php echo trans('0211');?> <?php echo trans('032');?> </strong>
                      </td>
                      <td class="text-right">
                        <strong>  <?php echo $modulelib->dropoffLocationName;?> </strong>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <?php echo trans('0211');?> <?php echo trans('08');?>
                      </td>
                      <td class="text-right">
                        <?php echo $module->dropoffDate;?>
                      </td>
                    </tr>
                    <tr>
                      <td>
                       <?php echo trans('0211');?> <?php echo trans('0259');?>
                      </td>
                      <td class="text-right">
                        <?php echo $module->dropoffTime;?>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <strong> <?php echo trans('0408');?> </strong>
                      </td>
                      <td class="text-right">
                        <?php echo $module->currCode;?> <?php echo $module->currSymbol;?> <?php echo $module->subTotal;?>
                      </td>
                    </tr>
                    <tr class="beforeExtraspanel">
                      <td>
                        <?php echo trans('0153');?>
                      </td>
                      <td class="text-right">
                        <?php echo $module->currCode;?> <?php echo $module->currSymbol;?><span id="displaytax"><?php echo $module->taxAmount;?></span>
                      </td>
                    </tr>
                    <div class="booking-deposit">
                      <tr>
                        <td class="booking-deposit-font">
                          <strong><?php echo trans('0126');?></strong>
                        </td>
                        <td class="text-right">
                          <strong><span class="booking-deposit-font go-left"><?php echo $module->currCode;?> <?php echo $module->currSymbol;?><span id="displaydeposit"><?php echo $module->depositAmount?></span></span></strong>
                        </td>
                      </tr>
                      <tr class="total">
                        <td>
                        </td>
                        <td class="text-right">
                        </td>
                      </tr>
                    </div>
                  </tbody>
                </table>
                <div class="padding30" style="padding-top:0px">
                  <span class="left size20"><strong><?php echo trans('0124');?></strong> :</span>
                  <span class="right lred2 bold size18">
                  <?php echo $module->currCode;?> <?php echo $module->currSymbol;?><span id="displaytotal"><?php echo $module->price;?></span></span>
                  <div class="clearfix"></div>
                </div>
                <?php } ?>
                <!-- End Cars right side section -->

                <!-- Start EAN right side section -->
                  <?php if($appModule == "ean"){ ?>
                  <table class="table table_summary">
                    <tbody>
                      <tr>
                        <td>
                          <strong> <?php echo trans('016');?></strong> : <?php echo $roomsCount;?>
                        </td>
                        <td class="text-right">
                          <strong> <?php echo trans('010');?></strong> : <?php echo $_GET['adults'];?>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <strong> <?php echo trans('07');?></strong> : <?php echo $checkin;?>
                        </td>
                        <td class="text-right">
                          <strong> <?php echo trans('09');?></strong> : <?php echo $checkout;?>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <?php echo trans('060');?>
                        </td>
                        <td class="text-right">
                          <?php echo $nights;?>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <strong> <?php echo $roomname; ?> </strong>
                        </td>
                        <td class="text-right">
                          <?php echo @$roomscount;?>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <?php echo trans('0412');?>
                        </td>
                        <td class="text-right">
                          <?php echo $currency." ".$roomtotal; ?>
                        </td>
                      </tr>
                      <?php if(!empty($ExtraPersonFee)){ ?>
                      <tr>
                        <td>
                          <strong>Extra Person Fee</strong>
                        </td>
                        <td class="text-right">
                          <?php echo $currency." ".$ExtraPersonFee; ?>
                        </td>
                      </tr>
                      <?php } ?>
                      <tr>
                        <td>
                          <?php echo trans('0541');?>
                        </td>
                        <td class="text-right">
                          <?php echo $currency." ".$tax; ?>
                        </td>
                      </tr>
                      <?php if(!empty($SalesTax)){ ?>
                      <tr>
                        <td>
                          <small>Sales Tax</small>
                        </td>
                        <td class="text-right">
                          <?php echo $currency." ".$SalesTax; ?>
                        </td>
                      </tr>
                      <?php } ?>
                      <?php if(!empty($HotelOccupancyTax)){ ?>
                      <tr>
                        <td>
                          <small>Hotel Occupancy Tax</small>
                        </td>
                        <td class="text-right">
                          <?php echo $currency." ".$HotelOccupancyTax; ?>
                        </td>
                      </tr>
                      <?php } ?>
                      <tr>
                        <td>
                        </td>
                        <td >
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="padding30" style="padding-top:0px">
                    <span class="left size20"><strong><?php echo trans('0124');?></strong> :</span>
                    <span class="right lred2 bold size18">  <?php echo $currency." ".$total; ?>
                    <br><span style="font-size: 9px !important; color: #000 !important;"> (Including Taxes and Fees) </span> </span>
                    <div class="clearfix"></div>
                  </div>
                </div>
                <div class="row">
                  <div class="panel-footer row text-danger go-right RTL">
                    <?php echo trans('0212');?>
                  </div>
                  <div class="panel-footer row">
                    <div class="clearfix"></div>
                    <br>
                    <h4>Cancellation Policy</h4>
                    <p class="go-right RTL">
                      <?php 
                        foreach($cancelpolicy as $key => $value){
                          $value = (array)$value;
                          if(is_array($value)){
                            foreach($value as $key1 => $value1){
                                echo $key1 ." : ".$value1." ";  
                            }
                          }else{
                            echo $key ." : ".$value."<br>";

                          }
                          echo "<br>";
                          //print_r($key);
                            //print_r($value);
                        } 
                      ?>
                        
                    </p>
                  </div>
                  <br>
                </div>
               <?php } ?>
                <!-- End EAN Right Side Section -->
              </div>
              <div class="row">
              <?php if($appModule != "ean"){ ?>
                <div class="panel-footer row" style="background: #E6EDF7;font-size:12px">
                  <p><?php echo trans('0461');?></p>
                </div>
                <?php } ?>
                <?php if(!empty($phone)){ ?>
                <div class="panel-body">
                  <h4 class="opensans text-center"><i class="icon_set_1_icon-57"></i><?php echo trans('061');?></h4>
                  <p class="opensans size30 lblue xslim text-center"><?php echo $phone; ?></p>
                </div>
                <?php } ?>
                <br>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
        <br/>
      </div>
      <!-- END OF RIGHT CONTENT -->
    </div>
  </div>
</div>  
</div>
<!-- END OF CONTENT -->

<?php } ?>
<?php if($appModule == "ean"){ ?>
<!-- Start JS for Expedia -->
<script type="text/javascript">
  $(function(){

        $(".submitresult").hide();

        })

       function expcheck(){

          $(".submitresult").html("").fadeOut("fast");

       var cardno = $("#card-number").val();
       var cardtype = $("#cardtype").val();

       var email = $("#card-holder-email").val();

       var country = $("#country").val();

       var cvv = $("#cvv").val();

       var city = $("#card-holder-city").val();

       var state = $("#card-holder-state").val();

       var postalcode = $("#card-holder-postalcode").val();

       var firstname = $("#card-holder-firstname").val();

       var lastname = $("#card-holder-lastname").val();
       var policy = $("#policy").val();
      var minMonth = new Date().getMonth() + 1;

      var minYear = new Date().getFullYear();

      var month = parseInt($("#expiry-month").val(), 10);

      var year = parseInt($("#expiry-year").val(), 10);

      
       if(country == "US"){

        if($.trim(postalcode) == ""){

       $(".submitresult").html("Enter Postal Code").fadeIn("slow");

       return false;

       }else if($.trim(state) == ""){

      $(".submitresult").html("Enter State").fadeIn("slow");

       return false;

       }

       }

       if($.trim(firstname) == ""){

       $(".submitresult").html("Enter First Name").fadeIn("slow");

       return false;

       }else if($.trim(lastname) == ""){

      $(".submitresult").html("Enter Last Name").fadeIn("slow");

       return false;

       }else if($.trim(cardno) != ""){

      $(".submitresult").html("Enter Card number").fadeIn("slow");

       return false;

       }else if($.trim(cardtype) != ""){

      $(".submitresult").html("Select Card Type").fadeIn("slow");

       return false;

       }else if($.trim(cvv) != ""){

        $(".submitresult").html("Enter Security Code").fadeIn("slow");

       return false;



       }else if($.trim(country) == ""){

        $(".submitresult").html("Select Country").fadeIn("slow");

       return false;



       }else if($.trim(city) == ""){

        $(".submitresult").html("Enter City").fadeIn("slow");

       return false;



       }else if($.trim(email) == ""){

        $(".submitresult").html("Enter Email").fadeIn("slow");

       return false;



       }else if(!$('#policy').is(':checked')){

        $(".submitresult").html("Please Accept Cancellation Policy").fadeIn("slow");

       return false;



       }else{

         $(".paynowbtn").hide();

        $(".submitresult").removeClass("alert-danger");

        $(".submitresult").html("<div id='rotatingDiv'></div>").fadeIn("slow");

       }





       }

       function isNumeric(evt)

        {

          var e = evt || window.event; // for trans-browser compatibility

          var charCode = e.which || e.keyCode;

          if (charCode > 31 && (charCode < 47 || charCode > 57))

          return false;

          if (e.shiftKey) return false;

          return true;

       }






</script>
<!-- End JS for Expedia -->
<?php }?>

<style>
  #rotatingImg {
  display: none;
  }
  .booking-bg {
  padding: 10px 0 5px 0;
  width: 100%;
  background-image: url('<?php echo $theme_url; ?>assets/images/step-bg.png');
  background-color: #222;
  text-align: center;
  }
  .bookingFlow__message {
  color: white;
  font-size: 18px;
  margin-top: 5px;
  margin-bottom: 15px;
  letter-spacing: 1px;
  }
  .select2-choice {
  font-size: 13px !important;
  padding: 0 0 0 10px!important;
  }
</style>
<?php if($appModule != "ean"){ ?>
<script src="<?php echo base_url(); ?>assets/js/booking.js"></script>
<?php } ?>
<div class="clearfix"></div>
