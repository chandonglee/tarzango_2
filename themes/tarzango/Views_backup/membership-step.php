<?php
//aecho $this->_ci->session->userdata('is_member');
//echo $this->_ci->session->userdata('pt_logged_customer');
//exit();

$return_url = 'http%3A%2F%2F192.168.0.4%2Ftarzango_2%2Fhotels%2Fbook%2FThe-D-Las-Vegas%3Fadults%3D1%26child%3D0%26checkin%3D09%252F09%252F2016%26checkout%3D09%252F13%252F2016%26roomid%3D53%26room%3D1';
$return_url = $_GET['ret_url'];

?>
<style type="text/css">



	::-webkit-input-placeholder { /* WebKit, Blink, Edge */
	    color:    #373b71 !important;
	}
	:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
	   color:    #373b71 !important;
	   opacity:  1;
	}
	::-moz-placeholder { /* Mozilla Firefox 19+ */
	   color:    #373b71 !important;
	   opacity:  1;
	}
	:-ms-input-placeholder { /* Internet Explorer 10-11 */
	   color:    #373b71 !important;
	}


	.container-fluid inner-page-nav{
		display: none !important;
	}
	footer{
		background-size: 94% !important ;
		min-height: 480px;
		height: auto;
	}
	footer .row .col-sm-12{
		padding-top: 50px;
	}

		@media (min-width: 1200px)
		{
			.col-sm-2, .check-new 
			{
				width: 16.666667%;
			}
		}
</style>
<div class="membership">
	<div class="container-main main_header">
		<div class="container">
      <div class="row">
       
      <?php include 'menu_header.php';?>
            <center style="margin-left: 88px; z-index: 999;
    margin-top: 20px;"><a  href="<?php echo base_url(); ?>"><img class="" style="z-index:999" src="images/contact-logo.png"></a></center>
          
         
     
        <div class="col-sm-12 page-title">
          <h2 class="">Membership</h2>
          <a  href="<?php echo base_url(); ?>" ><img style="position:relative;z-index:999;" src="images/arrow-blue.png"></a>
        </div>
      </div>
    </div>
    </div>
	</div>
	<div class="membership_steps_body">
	<!--<img class="left-bg" src="images/membership-left-bg.png">
	<img class="right-bg" src="images/membership-right-bg.png">-->
		<div class="container" style="z-index:1;">
			<div class="row">
				<div class="col-sm-12">
					<div class="col-sm-1">
					
					</div>
					<div class="col-sm-10 col-xs-12 no-padding">
						<div class="col-sm-12 text-center">
							<img class="img-responsive" src="images/memb1.png">
							<h3>Sign-up below and start enjoying the benefits today!</h3>
							<p>Fill out the form below</p>
						</div>
						<form class="" id="signupform" name="signup" method="POST">
							<input type="hidden" name="form_name" value="signup_mem_new">
							<div class="col-sm-12 no-padding">
								<div class="col-sm-6">
			                      <div class="form-group">
			                        <label for="name">First Name</label>
			                        <input type="text" class="form-control" id="name" name="firstname" value="" placeholder="Full Name">
			                      </div>
			                    </div>
								  <div class="col-sm-6">
			                      <div class="form-group">
			                       <label  class="required go-right"><?php echo trans('0172');?></label>
			                        <input class="form-control form" type="text" placeholder="<?php echo trans('0172');?>" name="lastname"  value="">                    
			                      </div>
			                    </div>
			                    <div class="col-sm-6">
			                      <div class="form-group">
			                        <label for="no">Mobile Number</label>
			                        <input type="number" class="form-control" id="no" name="no" value="" placeholder="Mobile Number">
			                      </div>
			                    </div>
			                    <div class="col-sm-6">
			                      <div class="form-group">
			                        <label for="email">Email</label>
			                        <input type="email" class="form-control" id="email" name="email" value="" placeholder="Email">
			                      </div>
			                    </div>
								<div class="col-sm-6">
			                      <div class="form-group">
			                        <label for="pass">Password</label>
			                        <input type="password" class="form-control" id="pass" name="password" value="" placeholder="password">
			                      </div>
			                    </div>
			                    <div class="col-sm-6">
			                      <div class="form-group">
			                        <label for="conf_pass">Confirm Password</label>
			                        <input type="password" class="form-control" id="conf_pass" name="confirmpassword" value="" placeholder="Confirm Password">
			                      </div>
			                    </div>
			                   
								<div class="col-sm-12 check" style="display:none;">
									<div class="checkbox">
									  <label><input type="checkbox" value="" name="add_conf" id="add_conf">My billing address is the same as my home address.</label>
									</div>
								</div>
								<div class="col-sm-12 check">
									<div class="checkbox">
									  <label class="agreement"><input type="checkbox" checked="checked" value="" name="agreement" id="agreement">I have read and agree to the Tarzango VIP Membership <a href="#">terms and conditions.</a></label>
									</div>
								</div>
								<div class="col-sm-8">
									<div class="process_tab">
										<p class="">Account</p><img src="images/arrow-right.png">
										<p class="">Contact</p><img src="images/arrow-right.png">
										<p class="last">Billing</p>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group submit-button">
									  <input type="submit" style="display:none;" class="form-control" id="submit" name="submit" value="Sign Up">
									  <div style="display:none;">
									   <button  id="element_id_1470283648" style="display:none;" type="button"></button>
									   </div>
									   <button type="button" id="submit" style="" class=" btn btn-action btn-lg  completebook" name="signup"  onclick="return completebook('<?php echo base_url();?>','<?php echo trans('0159')?>');">Sign up</button>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="col-sm-1">
					
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="membership_steps_body">
<div class="col-sm-2">
					
					</div>
					<div class="col-sm-6 result">
					
					</div>
					<div class="col-sm-2">
					
					</div>
	</div>
	<div class="last-section member-last-section">
		<div class="col-sm-12 text-center">
			<div class="container-main">
				<div class="container">
					<h4 class="col-sm-12 text-center">Become a member Now and receive additional 10% off plus some AWESOME perks...</h4>
					
					<a class="col-sm-3 text-center" href="#">MEMBERSHIP</a>
					
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">

function completebook(url,msg){
    var formname = $(".completebook").prop('name');
  	console.log(formname);
    /*$('html, body').animate({
      scrollTop: $('body').offset().top - 100
    }, 'slow');*/
    
    /*$(".completebook").fadeOut("fast");
    $("#waiting").html("Please Wait...");*/
    if ($('#mem_checkbox').is(":checked"))
    {
      var mem_check = "check";
    }else{
      var mem_check = "notcheck";
    }

        $.post(url+"admin/ajaxcalls/processMemberignup",$("#bookingdetails, #"+formname+"form").serialize(), function(response){
            var resp = $.parseJSON(response);
            console.log(resp);
            
            if(resp.error == "yes"){
              $(".result").html("<div class='alert alert-danger'>"+resp.msg+"</div>");
              /*$(".completebook").fadeIn("fast");
              $("#waiting").html("");*/

            }else{
            	 $.post(url+"account/signup_with_member",$("#"+formname+"form").serialize(), function(response){
            	 	console.log(response);
			      	if($.trim(response) != 'false'){
			      		$(".result").html("<div id='rotatingDiv'></div>");
			      		//window.location.replace(url);
			      		PayStand.build(checkout);
		                PayStand.showFrame(checkout);
		                PayStand.checkout(checkout);
			      		PayStand.checkoutComplete = function (data) {
			      			/*PayStand.build(checkout);
			                PayStand.showFrame(checkout);
			                PayStand.checkout(checkout);*/
						    $.ajax({
						        type: 'POST',
						        data:{ user_id : response },
						        url: url+'invoice/add_member',
						        cache: false,
						        beforeSend:function(){
						                  // show image here
						                  $(".popupBg1").show();
						                  $(".data").hide();
						        },
						        success: function(data)
						        {
						            window.location.replace(url);
						        },
						        error: function(e)
						        {
						          alert(e.message);
						        }
						    });
					    //console.log('update123->'+JSON.stringify(data));add_member
					  };
			      	}else{
			      		$(".result").html(response); 
			  		} 
			  	});
                // PayStand.build(checkout);
                // PayStand.showFrame(checkout);
                // PayStand.checkout(checkout);
             
              
            }
        });
    

  }
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
  button_name: "Sign Up",
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
 
  PayStand.checkoutUpdated = function (data) {
    //console.log('update->'+JSON.stringify(data));


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