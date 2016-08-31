<!DOCTYPE html>

</div>
</div>
<style type="text/css">
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
.header-navigation-section .menu img {
    float: right;
    margin-top: 27px;
    cursor: pointer;
}
.header-navigation-section .menu p.close-button {
    display: none;
    background-color: #fff;
    padding: 20px 7px;
    line-height: 0px;
    font-size: 50px;
    color: #a0e5fd;
    font-family: proximanova_light;
    border-radius: 100%;
    position: absolute;
    top: 17px;
    right: 0px;
    cursor: pointer;
}

</style>
<div class="membership">
	
<div class="contact" style="z-index:999;">
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
	<div class="membership_body" style="z-index:999;">
	<img class="left-bg" src="images/membership-left-bg.png">
	<img class="right-bg" src="images/membership-right-bg.png">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="col-sm-1">
					
					</div>
					<div class="col-sm-10 col-xs-12">
						<div class="col-sm-12 text-center">
							<img class="img-responsive" src="images/memb1.png">
							<h3>Become a Member</h3>
							<p>We provide a modern way for Group Travelers to book large room blocks.</p>
						</div>
						<div class="col-sm-6 col-xs-12">
							<div class="free-plan">
								<h4>Starter Membership</h4>
								<h3>$0 / month</h3>
								<h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</h5>
							</div>
							<div class="get-started">
								<a href="<?php echo base_url().'login'; ?>"><button type="button" class="btn">GET STARTED</button></a>
							</div>
							<div class="info-box">
								<img class="img-responsive" src="images/memb2.png">
								<p>Get access to hotels at a discounted price</p>
							</div>
							<div class="info-box">
								<img class="img-responsive" src="images/memb3.png">
								<p>Keep track of your bookings</p>
							</div>
						</div>
						<div class="col-sm-6 col-xs-12">
							<div class="paid-plan">
								<h4>VIP Membership</h4>
								<h3>$19 / month</h3>
								<h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </h5>
							</div>
							<div class="get-started">
							<?php if($this->_ci->session->userdata('pt_logged_customer')){ ?>
								<button  id="element_id_1470283648" type="button"></button>

								<?php }else{ ?>
								<a href="<?php echo base_url().'membership-step'; ?>" >
								<button type="button" class="btn">GET STARTED</button>
								</a>
								<?php } ?>
							</div>
							<div class="info-box">
								<img class="img-responsive" src="images/memb4.png">
								<p>Take a additional 10% off all Bookings</p>
							</div>
							<div class="info-box">
								<img class="img-responsive" src="images/memb5.png">
								<p>Cut the line & enjoy VIP check in - selected hotels</p>
							</div>
							<div class="info-box">
								<img class="img-responsive" src="images/memb6.png">
								<p>Complimentary upgraded Rooms - selected hotels</p>
							</div>
							<div class="info-box">
								<img class="img-responsive" src="images/memb7.png">
								<p>Airport to Hotel Drop off in SUV - selected cities</p>
							</div>
							<div class="info-box">
								<img class="img-responsive" src="images/memb8.png">
								<p>Dedicated concierge rep to assist with making reservations & planning your stay</p>
							</div>
							<div class="info-box">
								<img class="img-responsive" src="images/memb9.png">
								<p>Front in the line access to Air and rental cars "Coming Soon"</p>
							</div>
						</div>
					</div>
					<div class="col-sm-1">
					
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>



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
  button_name: "GET STARTED",
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
    $.ajax({
        type: 'POST',
        data:{ user_id : <?php echo  $this->_ci->session->userdata('pt_logged_customer'); ?> },
        url: '<?php echo base_url();?>invoice/add_member',
        cache: false,
        beforeSend:function(){
                  // show image here
                  $(".popupBg1").show();
                  $(".data").hide();
        },
        success: function(data)
        {
            //console.log('final_data'+data);
            //location.reload(true);
            window.location.href = '<?php echo $return_url; ?>';
            //alert();
        },
        error: function(e)
        {
          alert(e.message);
        }
    });
    //console.log('update123->'+JSON.stringify(data));add_member
  };
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