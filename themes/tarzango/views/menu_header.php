  <style type="text/css">   
  .header-navigation-section .menu p.close-button{
    display: none;
    background-color: #fff;
    padding: 22px 15px;
    line-height: 0px;
    font-size: 27px;
    color: #a0e5fd;
    font-family: proximanova_light;
    border-radius: 100%;
    position: absolute;
    top: 23px;
    right: 0px;
    cursor: pointer;}

.close-button{
    -moz-transition: all 0.3s linear;
    -webkit-transition: all 0.3s linear;
    transition: all 0.3s linear;
}

.close-button.down{
    -moz-transform:rotate(45deg);
    -webkit-transform:rotate(45deg);
    transform:rotate(45deg);
}

    </style>

<div class="header-navigation-section container-fluid <?php echo $cls_name; ?>">
  <div class="<?php echo $cls_name_1; ?> ">
    <div class="">
          <div> 
            <div class="col-sm-1 menu pull-right">
           
            <img src="images/acc_icon.png" class="close-button" style="display:block"></img>
          </div>
   
<script type="text/javascript">

$(".close-button").click(function(){
 
 $(this).toggleClass("down"); 
});
</script>

					<div class="menu-dropdown">
               		<?php  if(!empty($customerloggedin)){ ?>
               			<ul>
                    <li><a href="<?php echo base_url().'attraction'; ?>">Attraction</a></li>
              <li><a href="<?php echo base_url().'groupbooking'; ?>">Group Bookings</a></li>
              <li><a href="<?php echo base_url().'services'; ?>">Services</a></li>
              <li><a href="<?php echo base_url().'membership'; ?>">Membership</a></li>
              <li><a href="<?php echo base_url().'agent_show_guide'; ?>">Agent Show Guide</a></li>
              <li><a href="<?php echo base_url().'we_are_hiring'; ?>">We're Hiring</a></li>
              <li><a href="<?php echo base_url().'blog'; ?>">Blog</a></li>
                      <li><a href="<?php echo base_url().'About_us'; ?>">About</a></li>
              <li><a href="<?php echo base_url().'contact-us'; ?>">Contact</a></li>
              <li class="last"><a href="<?php echo base_url()?>account/"> <?php echo $firstname; ?> / </a><a href="<?php echo base_url()?>account/logout/"> <?php echo trans('03');?></a></li>
              <li class="last"><a href="tel:4156803008"><img src="images/call.png"> 415-680-3008</a></li>
						</ul>	
                		  <?php }else{  ?>
						<ul>
            <li><a href="<?php echo base_url().'attraction'; ?>">Attraction</a></li>
              <li><a href="<?php echo base_url().'groupbooking'; ?>">Group Bookings</a></li>
              <li><a href="<?php echo base_url().'services'; ?>">Services</a></li>
              <li class=""><a href="<?php echo base_url().'membership'; ?>">Membership</a></li>
              <li><a href="<?php echo base_url().'agent_show_guide'; ?>">Agent Show Guide</a></li>
              <li><a href="<?php echo base_url().'we_are_hiring'; ?>">We're Hiring</a></li>
              <li><a href="<?php echo base_url().'blog'; ?>">Blog</a></li>
              <li><a href="<?php echo base_url().'About_us'; ?>">About</a></li>
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
          <!--    <?php  if(!empty($customerloggedin)){ ?>
      <div class=" menu pull-right">
      <div class="menu-header" style=" position: absolute; margin-left: -35px; margin-top: -1px;"> 
        <img style=" " src="images/admin.png"><a style="margin-left: 0%; margin-top:-23px; color:#fff;" href="<?php echo base_url()?>account/"> <?php echo $firstname; ?> </a>
     
         </div>
         </div>
         <?php } ?> -->
            <!-- Collect the nav links, forms, and other content for toggling --> 
            
            <!-- /.navbar-collapse --> 
    
          <!-- /.container-fluid --> 
      
      </div>
    </div>
	 <?php echo  $cls_div; ?>