<?php
if($result == "success" && $appModule == "ean"){ ?>


   <!-- Start Result of Expedia booking for submit -->
  <style>
    .btn-circle {
    border-radius: 50%;
    font-size: 54px;
    padding: 10px 20px;
    }
   

   .fa {
    font-size: 15px !important;
    padding-left: 6px !important;
  }
  footer {
    display: block !important; 
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
<?php  }else{ ?>  
           
 <style>
   @media (min-width: 992px){
.col-md-4 {
    width: 31%;
    margin-left: 10px;
}
.check_div:first-child {
   
    margin-left: 0px;
}
    
  </style>


 

  <div class="container-main ">
   <?php include'main-header.php';?>
  </div>

  <div class="signup">
  <!-- Start Fail Result of Expedia booking for submit -->
    <?php if($result == "fail" && $appModule == "ean"){ ?>
    <div class="alert alert-danger wow bounce" role="alert">
      <p><?php echo $msg;?></p>
    </div>
    <?php } ?>
     <!-- End Fail Result of Expedia booking for submit -->
  <div class="signup_body">
    <img class="top-bg" src="images/signup-top-bg.png">
    <img class="left-bg" src="images/membership-left-bg.png">
    <img class="right-bg" src="images/membership-right-bg.png">
      <div class="container">
        <div class="col-sm-12">
          <div class="col-sm-1">
          
          </div>
<div class="col-sm-10 col-xs-12">

<?php if(empty($usersession)){ ?>
             <?php
             $cur_url =  base_url().uri_string().$_SERVER['QUERY_STRING'];
             ?>
             
             <div class="result"></div>
             <div class="left-section"> 
             <div class="tab-content"> 
             <div class="col-sm-12 check">
                      <div class="checkbox">
                        <label style="    color: #3f296c; font-family: 'Gotham-Bold';  margin: 10px 0px;    text-align: center;"><input type="checkbox" value="" name="mem_checkbox" id="mem_checkbox">Become member and book this hotel with price <?php echo $room->currSymbol;?> <?php echo $room->price - ($room->price * 10 / 100); ?></label>
                      </div>
                    </div>
             </div>
             </div>

              
            <div class="col-sm-7 col-xs-12 left-section">
              <ul class="nav nav-tabs responsive" id="myTab">
                <li class="col-sm-5 "><a data-toggle="tab" id="guesttab" href="#Guest">Book as a Guest</a></li>
                <li class="col-sm-4 "><a data-toggle="tab" id="signintab" href="#Sign-In" style="padding-left:25px">Sign In</a></li>
                <li class="col-sm-3"><a data-toggle="tab" id="signuptab" href="#sign_up">Sign Up</a></li>

              </ul>
              <div class="tab-content">
                <div id="Sign-In" class="tab-pane fade in ">
                  <form action="" method="POST" id="loginform">
                    <input type="hidden" name="form_name" value="login_mem">
                    <div class="col-sm-12">
                      <div class="form-group">
                       <label  class="required  go-right"><?php echo trans('094');?></label>
                      <input class="form-control form" type="text" placeholder="Email" name="username" id="username"  value="">
                       <!--
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="" placeholder="Email">
                      -->
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label  class="required go-right"><?php echo trans('095');?></label>
                        <input class="form-control form" type="password" placeholder="<?php echo trans('095');?>" name="password" id="password"  value="">
                        <!--
                          <label for="pass">Password</label>
                          <input type="password" class="form-control" id="pass" name="pass" value="" placeholder="Password">
                        -->
                      </div>
                    </div>
                    <div class="col-md-12" style="padding:0px">
                      <div class="form-group ">
                        <label  class="required go-right"><?php echo trans('0178');?></label>
                        <textarea class="form-control form" placeholder="<?php echo trans('0415');?>" rows="4" name="additionalnotes"></textarea>
                      </div>
                    </div>
                    <div class="col-sm-12 pickup_location" id="pickup_location">
                      <div class="form-group">
                        <label for="conf_pass">Pickup location</label>
                        <input type="text" class="form-control"  name="pickup_location" value="" placeholder="Pickup location">
                      </div>
                    </div>
                    <div class="col-sm-12 pickup_time" id="pickup_time">
                      <div class="form-group">
                        <label for="conf_pass">Pickup time</label>
                        <input type="date" class="form-control"  name="pickup_time" value="" placeholder="Pickup time">
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <a class="forgot" href="#">Forgot Password?</a>
                    </div>
                    <div class="col-sm-12 check">
                      <div class="checkbox">
                        <label><input type="checkbox" value="" name="keep" id="keep">Keep me signed in on this computer</label>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group submit-button">
                        <!--<input type="submit" class="form-control" id="submit" name="submit" value="SIGN IN">-->
                      </div>
                    </div>
                  </form>
                
                </div>
                <div id="sign_up" class="tab-pane fade">
                  <form class="" name="signup" id="signupform" method="POST">
                    <input type="hidden" name="form_name" value="signup_mem">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="name">Your First Name</label>
                        <input type="text" class="form-control" id="name" name="firstname" value="" placeholder="Full Name">
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                       <label  class="required go-right"><?php echo trans('0172');?></label>
                        <input class="form-control form" type="text" placeholder="<?php echo trans('0172');?>" name="lastname"  value="">                    
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="no">Mobile Number</label>
                        <input type="number" class="form-control" id="no" name="no" value="" placeholder="Mobile Number">
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="" placeholder="Email">
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" class="form-control" id="pass" name="password" value="" placeholder="password">
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="conf_pass">Confirm Password</label>
                        <input type="password" class="form-control" id="conf_pass" name="conf_pass" value="" placeholder="Confirm Password">
                      </div>
                    </div>
                    <div class="col-sm-12 pickup_location" id="pickup_location">
                      <div class="form-group">
                        <label for="conf_pass">Pickup location</label>
                        <input type="text" class="form-control"  name="pickup_location" value="" placeholder="Pickup location">
                      </div>
                    </div>
                    <div class="col-sm-12 pickup_time" id="pickup_time">
                      <div class="form-group">
                        <label for="conf_pass">Pickup time</label>
                        <input type="date" class="form-control"  name="pickup_time" value="" placeholder="Pickup time">
                      </div>
                    </div>
                    <div class="col-sm-12 check">
                      <div class="checkbox">
                        <label><input type="checkbox" value="" name="keep" id="keep">Keep me signed in on this computer</label>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group submit-button">
                        <!-- <input type="submit" class="form-control" id="submit" name="submit" value="CREATE ACCOUNT">-->
                      </div>
                    </div>
                  </form>

                 

                  <script type="text/javascript">
                    
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
                      amount: "1900",
                    items: [{
                    title: "Reservation Payment",
                    subtitle: "Payment to lock reservation in TarzanGo",
                    item_price: "1900",
                    quantity: 1
                    }],
                    }
                    PayStand.checkoutComplete = function (data) {

                     

                      var formname = $("#mem_pay").prop('name');
  
                      $('html, body').animate({
                          scrollTop: $('body').offset().top - 100
                          }, 'slow');
                     $("#mem_pay").fadeOut("fast");
                     $("#waiting").html("Please Wait...");

                     $.post("<?php echo base_url(); ?>"+"admin/ajaxcalls/processBooking"+formname,$("#bookingdetails, #"+formname+"form").serialize(), function(response){
                      var resp = $.parseJSON(response);
                      console.log(resp);
                      if(resp.error == "yes"){
                          $(".result").html("<div class='alert alert-danger'>"+resp.msg+"</div>");
                          $("#mem_pay").fadeIn("fast");
                          $("#waiting").html("");
                          PayStand.closeFrame(checkout);
                      }else{
                          $(".bdetails").addClass("complete");
                          $(".bdetails").removeClass("active");
                          $(".bsuccess").removeClass("disabled");
                          $(".bsuccess").addClass("active");
                          $(".bsuccess").addClass("complete");  
                          $(".acc_section").hide();
                          $(".extrasection").hide();
                          $(".final_section").fadeIn("fast");
                          $(".result").html("");


                          setTimeout(function () {
                            window.location.replace(resp.url);
                          }, 2000);
                      
                        
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

                   
                  <!--
                  <p class="or">OR</p>
                  <a class="col-sm-6 facebook">
                    <img src="images/facebook.png">
                    <p>Sign in with Facebook</p>
                  </a>
                  <a class="col-sm-6 google">
                    <img src="images/google.png">
                    <p>Sign in with Google</p>
                  </a>
                  -->
                </div>
                <div id="Guest" class="tab-pane fade in active">
                  <form class="" id="guestform" name="book_guest"  method="post">
                    <div class="col-sm-12">


                      <div class="form-group">
                      <label  class="required go-right"><?php echo trans('0171');?></label>
                      <input class="form-control form" type="text" placeholder="<?php echo trans('0171');?>" name="firstname"  value="">
                      <!--
                        <label for="firstname">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" value="" placeholder="First Name">
                        -->
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                       <label  class="required go-right"><?php echo trans('0172');?></label>
                        <input class="form-control form" type="text" placeholder="<?php echo trans('0172');?>" name="lastname"  value="">
                        <!--
                        <label for="lastname">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" value="" placeholder="Last Name">
                        -->
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label  class="required  go-right"><?php echo trans('094');?></label>
                      <input class="form-control form" type="text" placeholder="<?php echo trans('094');?>" name="email"  value="">
                      <!--
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="" placeholder="Email">
                        -->
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                      <label  class="required go-right"><?php echo trans('0175');?> <?php echo trans('094');?></label>
                      <input class="form-control form" type="email" placeholder="<?php echo trans('0175');?> <?php echo trans('094');?>" name="confirmemail"  value="">
                      <!--
                        <label for="conf_email">Confirm Email</label>
                        <input type="email" class="form-control" id="conf_email" name="conf_email" value="" placeholder="Confirm Email">
                        -->
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                      <label  class="required go-right"><?php echo trans('0173');?></label>
                      <input class="form-control form" type="text" placeholder="<?php echo trans('0414');?>" name="phone"  value="">
                      <!--
                        <label for="no">Mobile Number</label>
                        <input type="number" class="form-control" id="no" name="no" value="" placeholder="Mobile Number">
                        -->
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                       <label  class="required go-right"><?php echo trans('098');?></label>
                      <input class="form-control form" type="text" placeholder="<?php echo trans('098');?>" name="address"  value="">
                      <!--
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="" placeholder="Address">
                        -->
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                      <label  class="required go-right"><?php echo trans('0105');?></label>

                       <select  class="chosen-select" name="country">
                          <option value=""><?php echo trans('0484');?></option>
                                    <?php
                                       foreach($allcountries as $country){
                                       ?>
                                    <option value="<?php echo $country->iso2;?>" <?php if($profile[0]->ai_country == $country->iso2){echo "selected";}?> ><?php echo $country->short_name;?></option>
                                    <?php } ?>
                                 </select>
                      <!--
                        <label for="country">Country</label>
                        <select class="form-control" id="country" name="country">
                        <option>Country</option>
                        <option value="india">India</option>
                        <option value="usa">USA</option>
                        <option value="australia">Australia</option>
                        <option value="canada">Canada</option>
                        </select>
                        -->
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                      <!--
                        <label for="additional">Additional Requests / Notes</label>
                        <textarea class="form-control" rows="2" value="" name="additional" id="comment"></textarea>
                         -->
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group submit-button">
                      
                      <!--
                        <input type="submit" class="form-control" id="submit" name="submit" value="CONFIRM THIS BOOKING">
                      -->
                      </div>
                    </div>
                  </form>


                </div>
              </div>
            
            <?php }else{ ?>

                    <div class="col-sm-12 col-xs-12">
                      <div class="col-sm-7 col-xs-12 left-section">
                  
                        <form id="loggedform">
                <div class="panel-body">
                  <div class="col-md-6  go-right">
                    <div class="form-group ">
                      <label  class="required go-right"><?php echo trans('0171');?></label>
                      <input class="form-control form" type="text" placeholder="" name=""  value="<?php echo $profile[0]->ai_first_name?>" disabled="disabled" style="background-color: #DEDEDE !important"/>
                    </div>
                  </div>
                  <div class="col-md-6  go-left">
                    <div class="form-group ">
                      <label  class="required go-right"><?php echo trans('0172');?></label>
                      <input class="form-control form" type="text" placeholder="" name=""  value="<?php echo $profile[0]->ai_last_name?>" disabled="disabled" style="background-color: #DEDEDE !important">
                    </div>
                  </div>
                  <div class="col-md-12 go-right">
                    <div class="form-group ">
                      <label  class="required  go-right"><?php echo trans('094');?></label>
                      <input class="form-control form" type="text" placeholder="" name=""  value="<?php echo $profile[0]->accounts_email?>" disabled="disabled" style="background-color: #DEDEDE !important">
                    </div>
                  </div>
                  <div class="col-md-12  go-right">
                    <div class="form-group ">
                      <label  class="required go-right"><?php echo trans('0178');?></label>
                      <textarea class="form-control form" placeholder="<?php echo trans('0415');?>" rows="4" name="additionalnotes"></textarea>
                    </div>
                  </div>
                </div>
              </form>
              
            
            <!-- PHPTRAVELS LoggeIn Booking Starting  -->
            
            <!-- PHPTRAVELS LoggedIn User Booking Ending  -->
            <?php } ?>
              <button style="ma" type="submit"  class="btn btn-action btn-lg  completebook" name="<?php if(empty($usersession)){ echo "guest";}else{ echo "logged"; } ?>"  onclick="return completebook('<?php echo base_url();?>','<?php echo trans('0159')?>');"><?php echo trans('0306');?></button>
               <button type="submit" id="mem_pay" style="display:none;" class="btn btn-action btn-lg  signup_btn" name="signup"  ><?php echo trans('0306');?></button>
               <div id="mem_pay" style="display:none;">
                <button id="element_id_1470283648" style="display:none;"></button>
              </div>
              <script>
                  
                   $(".pickup_time").hide();
                    $(".pickup_location").hide();
              $("#mem_checkbox").click( function(){
                
                if (this.checked) {
                    $(".completebook").prop('name','signup');
                    
                    /*$(".completebook").hide();
                    $("#mem_pay").show();*/
                    $(".pickup_time").show();
                    $(".pickup_location").show();
                    $("#myTab").children("li").removeClass("active");
                    $("#myTab").children("li").children("#signuptab").parent("li").addClass("active");
                    $("#sign_up").addClass("active");
                    $("#sign_up").addClass("in");
                    $("#Sign-In").removeClass("active");
                    $("#Sign-In").removeClass("in");
                    $("#Guest").removeClass("active");
                    $("#Guest").removeClass("in");
                }else{
                  $(".completebook").prop('name','guest');
                  $("#myTab").children("li").removeClass("active");
                    $("#myTab").children("li").children("#guesttab").parent("li").addClass("active");
                    $("#Guest").addClass("active");
                    $("#Guest").addClass("in");
                    $("#Sign-In").removeClass("active");
                    $("#Sign-In").removeClass("in");
                    $("#signuptab").removeClass("active");
                    $("#signuptab").removeClass("in");
                   /* $(".completebook").show();
                    $("#mem_pay").hide();*/
                   $(".pickup_time").hide();
                    $(".pickup_location").hide();
                }
               
              });
             </script> 
              </div>
            <div class="col-sm-5 col-xs-12 right-section">
              <div class="col-sm-12">
                <div class="address">
                  <div class="row">
                    <div class="col-sm-12">
                     <?php echo $module->stars;
                     ?>
                    </div>
                  </div>
                  <h2><?php echo $module->title;?></h2>
                  <div class="checkin">
                    <img src="images/checkin.png">
                    <p><?php echo $module->location;?></p>
                  </div>


 <!-- Start Hotels right side section -->
                   <?php 
                          if($appModule == "hotels"){ 
                    ?>

               
                  <div class="col-sm-12 checkin-details">
                    <div class="col-md-12 col-md-4 check_div">

                    <?php

                    // Create Date Format

                     $date = date_create($module->checkin); 
                              $date_new = date_format($date,"M/d/Y/D");
                              $chekin_date = explode("/",$date_new);
                              
                              
                              $date1 = date_create($module->checkout); 
                              $date_new1 = date_format($date1,"M/d/Y/D");
                              $chekout_date = explode("/",$date_new1); 
                              
                    ?>

                      <p class="title"><?php echo trans('07');?></p>
                      <div class="box">
                        <p style="text-transform:uppercase"><?php echo $chekin_date[0].' '.$chekin_date[2];?></p>
                        <h6><?php echo $chekin_date[1];?></h6>
                        <p style="text-transform:uppercase"><?php echo $chekin_date[3];?></p>
                      </div>
                    </div>
                    <div class="col-md-12 col-md-4 check_div">
                      <p class="title"><?php echo trans('09');?></p>
                      <div class="box">
                        <p style="text-transform:uppercase"><?php echo $chekout_date[0].' '.$chekout_date[2];?></p>
                        <h6><?php echo $chekout_date[1];?></h6>
                        <p style="text-transform:uppercase"><?php echo $chekout_date[3];?></p>
                      </div>
                    </div>
                    <div class="col-md-12 col-md-4 check_div">
                      <p class="title">Rooms</p>
                      <div class="box last" style="min-height: 75px;padding-top: 23px;">
                        <h6><?php echo $room->roomscount;?></h6>                        
                      </div>
                    </div>
                  </div>
                  <?php
                        }
                    ?>
                <!-- Ends Hotels right side section -->


                  <div class="col-sm-12">
                    <div class="total">
                      <h3><?php echo $room->currSymbol;?> <?php echo $room->price;?></h3><h3 class="divider"> /</h3><p> total amount</p>
                    </div>
                  </div>
                </div>
                <div class="details">
                  
                   <img class="form-group img-responsive img-rounded" src="<?php echo $module->thumbnail;?>" alt="<?php echo $module->title;?>" />
                  <p><?php echo trans('0461');?></p>
                  <div class="contact-box">


                  <div class="row">
                      <?php if(!empty($phone)){ ?>
                          <p><?php echo trans('061');?></p>
                          <h3><?php echo $phone; ?></h3>
                      <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-1">
          </div>
        </div>
      </div>
  </div>

</div>



<div class="bg_list_image" style="float:left">
<div class="container">
    <!-- Start Fail Result of Expedia booking for submit -->
    <?php if($result == "fail" && $appModule == "ean"){ ?>
    <div class="alert alert-danger wow bounce" role="alert">
      <p><?php echo $msg;?></p>
    </div>
    <?php } ?>
     <!-- End Fail Result of Expedia booking for submit -->
  <div class="mt25 offset-0">
    <div class="loadinvoice">
      <div class="acc_section">
        <div class="col-md-8 pagecontainer2 offset-0 go-right" style="margin-bottom:50px;">
          <div class="panel-body">
            <br>
            
            <?php if(!empty($error)){ ?>
            <h1 class="text-center strong"><?php echo trans('0432');?></h1>
            <h3 class="text-center"><?php echo trans('0431');?></h3>
            <?php }else{ ?>
             <!-- Start Other Modules Booking left section -->
             <?php if($appModule != "ean"){ ?>
            <?php //include $themeurl.'views/booking/profile.php'; ?>
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
              <?php if($appModule == "tours"){ ?>
              <input type="hidden" name="subitemid" value="<?php echo $module->id;?>" />
              <input type="hidden" name="children" value="<?php echo $module->children;?>" />
              <input type="hidden" name="checkin" value="<?php echo $module->date;?>" />
              <input type="hidden" name="infant" value="<?php echo $module->infants;?>" />
              <?php } ?>
              <?php if($appModule == "cars"){ ?>
              <input type="hidden" name="pickuplocation" value="<?php echo $module->pickupLocation;?>" />
              <input type="hidden" name="dropofflocation" value="<?php echo $module->dropoffLocation;?>" />
              <input type="hidden" name="pickupDate" value="<?php echo $module->pickupDate;?>" />
              <input type="hidden" name="pickupTime" value="<?php echo $module->pickupTime;?>" />
              <input type="hidden" name="dropoffDate" value="<?php echo $module->dropoffDate;?>" />
              <input type="hidden" name="dropoffTime" value="<?php echo $module->dropoffTime;?>" />
              <input type="hidden" name="totalDays" value="<?php echo $module->totalDays;?>" />
              <?php } ?>
           
            <?php  //include $themeurl.'views/coupon.php';  ?>

              <!--<input type="radio" name="payment_type" value="paystand">Paystand
              <input type="radio" name="payment_type" value="paypal">Paypal-->
             </form>
            <div class="clearfix"></div>
            <!-- Start Tour Travellers data fields -->
            <?php if($appModule == "tours"){ ?>
            <div class="panel panel-default">
              <div class="panel-heading"><?php echo trans('0521');?></div>
              <div class="panel-body">
                <div class="form-horizontal">
                  <?php for($i = 1; $i <= $totalGuests;$i++){ ?>
                  <div class="form-group">
                    <div class="col-md-4">
                      <label><?php echo trans('0522');?> <?php echo $i;?> <?php echo trans('0350');?></label>
                      <input type="" name="passport[<?php echo $i;?>][name]" class="form-control" placeholder="Name"/>
                    </div>
                    <div class="col-md-6">
                      <label><?php echo trans('0522');?> <?php echo $i;?> <?php echo trans('0523');?></label>
                      <input type="" name="passport[<?php echo $i;?>][passportnumber]" class="form-control" placeholder="Passport"/>
                    </div>
                    <div class="col-md-2">
                      <label><?php echo trans('0524');?></label>
                      <input type="" name="passport[<?php echo $i;?>][age]" class="form-control" placeholder="Age"/>
                    </div>
                  </div>
                  <hr>
                  <?php } ?>
                </div>
              </div>
            </div>
            <?php } ?>
            <!-- End Tour Travellers data fields -->
            <div class="line3"></div>
            <?php if(!empty($module->policy)){ ?>
            <br>
            <div class="alert alert-info">
              <strong class="RTL go-right"><?php echo trans('045');?></strong><br>
              <p class="RTL" style="font-size:12px"><?php echo $module->policy;?></p>
            </div>
            <?php } ?>
            <p class="RTL"></p>
            <div class="form-group">
              <span id="waiting"></span>
            
             

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
            <input type="hidden" name="sessionid" value="<?php echo $_GET['sessionid']; ?>" />
            <input type="hidden" name="hotel" value="<?php echo $_GET['hotel']; ?>" />
            <input type="hidden" name="hotelname" value="<?php echo $HotelSummary['name'];?>" />
            <input type="hidden" name="hotelstars" value="<?php echo $hotelStars;?>" />
            <input type="hidden" name="location" value="<?php echo $HotelSummary['city'];?>" />
            <input type="hidden" name="thumbnail" value="<?php echo $HotelImages['HotelImage'][0]['url']; ?>" />
            <input type="hidden" name="roomname" value="<?php echo $roomname; ?>" />
            <input type="hidden" name="roomtotal" value="<?php echo $roomtotal; ?>" />
            <input type="hidden" name="checkin" value="<?php echo $_GET['checkin']; ?>" />
            <input type="hidden" name="checkout" value="<?php echo $_GET['checkout']; ?>" />
            <input type="hidden" name="roomtype" value="<?php echo $_GET['roomtype']; ?>" />
            <input type="hidden" name="ratecode" value="<?php echo $_GET['ratecode']; ?>" />
            <input type="hidden" name="currency" value="<?php echo $currency; ?>" />
            <input type="hidden" name="affiliateConfirmationId" value="<?php echo $eanlib->cid.$affiliateConfirmationId; ?>" />
            <input type="hidden" name="total" value="<?php echo $total; ?>" />
            <input type="hidden" name="tax" value="<?php echo $tax; ?>" />
            <input type="hidden" name="nights" value="<?php echo $nights; ?>" />
            <div class="clearfix"></div>
            <div class="panel-body">
              <div class="col-md-6  go-right">
                <div class="form-group ">
                  <label  class="required go-right"><?php echo trans('0330');?></label>
                  <select class="form-control" name="cardtype" id="cardtype">
                    <option value="">Select Card</option>
                    <?php foreach($payment as $pay){ ?>
                    <option value="<?php echo $pay['code'];?>"> <?php echo $pay['name'];?> </option>
                    <?php  } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6  go-left">
                <div class="form-group ">
                  <label  class="required go-right"><?php echo trans('0316');?></label>
                  <input type="text" class="form-control" name="cardno" id="card-number" pattern=".{12,}" required title="12 characters minimum" placeholder="Credit Card Number" onkeypress="return isNumeric(event)" value="<?php echo set_value('cardno');?>" >
                </div>
              </div>
              <div class="col-md-3 go-right">
                <div class="form-group ">
                  <label  class="required  go-right"><?php echo trans('0329');?></label>
                  <select class="form-control" name="expMonth" id="expiry-month">
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
                  <label  class="required go-right">&nbsp;</label>
                  <select class="form-control" name="expYear" id="expiry-year">
                    <?php for($y = date("Y");$y <= date("Y") + 10;$y++){?>
                    <option value="<?php echo $y?>"><?php echo $y; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-3 go-left">
                <div class="form-group">
                  <label  class="required go-right"><?php echo trans('0331');?></label>
                  <input type="text" class="form-control" name="cvv" id="cvv" placeholder="<?php echo trans('0331');?>" value="<?php echo set_value('cvv');?>">
                </div>
              </div>
              <div class="col-md-3 go-left">
                <label  class="required go-right">&nbsp;</label>
                <img src="<?php echo base_url(); ?>assets/img/cc.png" class="img-responsive" />
              </div>
              <div class="clearfix"></div>
                <div class="col-md-6 go-right">
                  <div class="form-group ">
                    <label  class="required go-right"><?php echo trans('0173');?></label>
                    <input class="form-control form" type="text" placeholder="<?php echo trans('0414');?>" name="phone"  value="<?php echo set_value('phone');?>">
                  </div>
                </div>
                <div class="col-md-6 go-right">
                  <div class="form-group ">
                    <label  class="required go-right"><?php echo trans('098');?></label>
                    <input class="form-control form" type="text" placeholder="<?php echo trans('098');?>" name="address"  value="<?php echo set_value('address');?>">
                  </div>
                </div>
              <div class="clearfix"></div>
              
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
        <div class="pagecontainer2 paymentbox grey">
          <!--
          <div class="panel-body">
            <img class="form-group img-responsive img-rounded" src="<?php //echo $module->thumbnail;?> <!--" alt="<?php //echo $module->title;?>" />
            <!--<div class="opensans size18 dark bold RTL go-right"><?php //echo $module->title;?> <!--</div>
           <div class="clearfix"></div>
            <div class="opensans size13 grey RTL go-right"><i class="fa fa-map-marker RTL"></i> <?php //echo $module->location;?> <!--</div>
            <div class="clearfix"></div>
            <span class="go-right RTL st_rating"><?php //echo $module->stars;?> <!--</span>
          </div>
          -->
          <div class="hpadding30">
            <div >
              <div class="row">



                <!-- Start Hotels right side section -->
                
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
                    <p class="go-right RTL"><?php echo $cancelpolicy;?></p>
                  </div>
                  <br>
                </div>
               <?php } ?>
                <!-- End EAN Right Side Section -->
              </div>
              <div class="row">
              <?php if($appModule != "ean"){ ?>
                <!--
                <div class="panel-footer row" style="background: #E6EDF7;font-size:12px">
                  <p><?php //echo trans('0461');?> <!--</p>
                </div>
                -->
                <?php } ?>
                
                <?php if(!empty($phone)){ ?>
                <!--
                <div class="panel-body">
                  <h4 class="opensans text-center"><i class="icon_set_1_icon-57"></i><?php //echo trans('061');?></h4>
                  <!--<p class="opensans size30 lblue xslim text-center"><?php //echo $phone; ?></p>
                <!--</div>
                -->
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
<div class="last-section">
    <div class="col-sm-12 text-center">
      <div class="container-main">
        <div class="container">
          <h4 class="col-sm-9 text-right">Going somewhere? Need a Hotel, let us help you!</h4>
          <a class="col-sm-3 text-center" href="#">TARZANGO</a>
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

       }else if($.trim(cardno) == ""){

      $(".submitresult").html("Enter Card number").fadeIn("slow");

       return false;

       }else if($.trim(cardtype) == ""){

      $(".submitresult").html("Select Card Type").fadeIn("slow");

       return false;

       }else if(month <= minMonth && year <= minYear){

        $(".submitresult").html("Invalid Expiration Date").fadeIn("slow");

       return false;



       }else if($.trim(cvv) == ""){

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
  footer{
    display: block !important; 
  }
</style>
<?php if($appModule != "ean"){ ?>
<script src="<?php echo base_url(); ?>assets/js/booking.js"></script>
<?php } ?>
<div class="clearfix"></div>
