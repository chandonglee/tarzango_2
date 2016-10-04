
 <script>
  $( function() {
    $( ".accordion" ).accordion({
	   active: false,            
	   autoHeight: false,            
	   navigation: true,            
	   collapsible: true,
	   heightStyle: "content",
	   create: function(event, ui) { $(".accordion").show(); }
	});
  } );
  </script>
</head>

<div class="contact">
<?php include 'new_header.php';?>
  <div class="container-main main_header" style="padding-top:110px">
     <div class="container">
      <div class="row">
       
      
            <center class="center" style="margin-left: 88px; z-index: 999;
    margin-top: 20px;"></center>
          
         
     
        <div class="col-sm-12 page-title">
          <h2 class="">Membership</h2>
          <a  href="<?php echo base_url(); ?>" ><img style="position:relative;z-index:999;" src="images/arrow-blue.png"></a>
        </div>
      </div>
    </div>
    </div>
  </div>
<div class="member_ship">
	
	<div class="col-sm-12 text-center">
		<div class="container">
			<div class="membership_signin_page">
            	<div class="membership_header">
                	<img src="images/vip_membership_icon.png">
                    <h3>Your VIP Membership Perks</h3>
					<p>Consectetur adipisicing elit, sed do eiusmod tempor incididunt</p>
                </div>
                <div class="membership_perks">
                	<div class="col-md-1"></div>
                    <div class="col-md-10">
                    	<div class="accordion">
                      <h3 class="Acc_head">
                      	<span><img src="images/memb2.png"></span>
                        Get access to hotels at a discounted price</h3>
                      <div class="acc_cont">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor.</p>
                      </div>
                      <h3 class="Acc_head">
                      	<span><img src="images/memb3.png"></span>
                        Keep track of your bookings</h3>
                      <div class="acc_cont">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor.</p>
                      </div>
                      <h3 class="Acc_head">
                      	<span><img src="images/memb4.png"></span>
                        Take a additional 10% off all Bookings</h3>
                      <div class="acc_cont">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor.</p>
                      </div>
                      <h3 class="Acc_head">
                      	<span><img src="images/memb5.png"></span>
                        Cut the line & enjoy VIP check in - selected hotels</h3>
                      <div class="acc_cont">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor.</p>
                      </div>
                      <h3 class="Acc_head">
                      	<span><img src="images/memb6.png"></span>
                        Complimentary upgraded Rooms - selected hotels</h3>
                      <div class="acc_cont">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor.</p>
                      </div>
                      <h3 class="Acc_head">
                      	<span><img src="images/memb7.png"></span>
                      	Airport to Hotel Drop Off in SUV - selected cities</h3>
                      <div class="acc_cont">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor.</p>
                      </div>
                      <h3 class="Acc_head">
                      	<span><img src="images/memb8.png"></span>
                        Dedicated concierge rep to assist with making reservations & planning your stay.</h3>
                      <div class="acc_cont">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor.</p>
                      </div>
                      <h3 class="Acc_head">
                      	<span><img src="images/memb9.png"></span>
                      	Front in the line access to Air and rental cars "Coming Soon" </h3>
                      <div class="acc_cont">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor.</p>
                      </div>
                   </div>
                   </div>
                   <div class="col-md-1"></div>
                </div>    
            </div>
		</div>
	</div>
	<div class="last-section">
		<div class="col-sm-12 text-center">
			<div class="container-main">
				<div class="container">
					<h4 class="col-sm-9 text-right" style="font-size: 34px">Need to negotiate 10 or more rooms, let us help you!</h4>
					<a class="col-sm-3 text-center" href="<?php echo base_url().'groupbooking'; ?>">Group Bookings</a>
				</div>
			</div>
		</div>
	</div>
</div>
