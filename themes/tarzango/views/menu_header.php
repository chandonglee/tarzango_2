  <style type="text/css">   
  .header-navigation-section .menu p.close-button{
    display: none;
    background-color: #fff;
    padding: 21px 15px;
    line-height: 0px;
    font-size: 27px;
    color: #a0e5fd;
    font-family: proximanova_light;
    border-radius: 100%;
    position: absolute;
    top: 23px;
    right: 0px;
    cursor: pointer;}
    </style>


<div class="header-navigation-section container-fluid <?php echo $cls_name; ?>">
  <div class="<?php echo $cls_name_1; ?> ">
    <div class="">
     
       
          <div> 
        
            <div class="col-sm-1 menu pull-right">
						<img class="open menu" src="images/menu.png">
						<p class="close-button">×</p>
					</div>
					<div class="menu-dropdown">
               		<?php  if(!empty($customerloggedin)){ ?>
               			<ul>
               				<li><a href="">About</a></li>
							<li><a href="">Group Bookings</a></li>
							<li><a href="">Services</a></li>
							<li><a href="<?php echo base_url().'membership'; ?>">Membership</a></li>
							<li><a href="">Agent Show Guide</a></li>
							<li><a href="">We're Hiring</a></li>
							<li><a href="<?php echo base_url().'blog'; ?>">Blog</a></li>
							<li><a href="<?php echo base_url().'contact-us'; ?>">Contact</a></li>
							<li class="last"><a href="<?php echo base_url()?>account/"><img src="images/shape.png"> <?php echo $firstname; ?> / </a><a href="<?php echo base_url()?>account/logout/"> <?php echo trans('03');?></a></li>
							<li class="last"><a href=""><img src="images/call.png"> 415-680-3008</a></li>
						</ul>	
                		  <?php }else{  ?>
						<ul>
							<li><a href="">About</a></li>
							<li><a href="">Group Bookings</a></li>
							<li><a href="">Services</a></li>
							<li class=""><a href="<?php echo base_url().'membership'; ?>">Membership</a></li>
							<li><a href="">Agent Show Guide</a></li>
							<li><a href="">We're Hiring</a></li>
							<li><a href="<?php echo base_url().'blog'; ?>">Blog</a></li>
							<li><a href="<?php echo base_url().'contact-us'; ?>">Contact</a></li>
							<li class="last"><a href="<?php echo base_url(); ?>login"><img src="images/shape.png"> Sign In /</a><a href="<?php echo base_url(); ?>register"> Sign Up</a></li>
							<li class="last"><a href="tel:4156803008"><img src="images/call.png"> 415-680-3008</a></li>
                  
						</ul>
						 <?php } ?>
					</div>
					
            <!--   <div class="header-login"> <a href="#" class="header-btn"><span></span> <span></span> <span></span> </a>
                <div class="signuo-login">
                  <div class="login"> <a href="<?php echo base_url(); ?>login"> <?php echo trans('04');?></a></div>
                  <div class="signin"> <a href="<?php echo base_url(); ?>register"> <?php echo trans('0115');?></a></div>
                </div>
              </div> -->


            </div>
            <!-- Collect the nav links, forms, and other content for toggling --> 
            
            <!-- /.navbar-collapse --> 
    
          <!-- /.container-fluid --> 
      
      </div>
    </div>
	 <?php echo  $cls_div; ?>