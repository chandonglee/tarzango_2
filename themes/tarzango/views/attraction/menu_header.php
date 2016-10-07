  <style type="text/css">   
  /****************Header**********/

  @media screen and (max-width: 650px) {
  header.header-section .menu img{
  /*  margin-top:-90px !important;
    margin-right: -28px !important;*/
  }
  header.header-section .logo img {
    float: none;
    padding-right: 0px;
    height: 50px !important;
    width: 60px;
    margin-top: 16px;
}
.inner-section .menu-dropdown {
    z-index: 9999;
    background-position: center center;
    margin: -60px -15px 0;
    right: -20px !important;
    top: 0;
    width: 335px !important;
}
}
#ascrail2000-hr{
  width: 0px !important;
}
#ascrail2000-hr div{
  width: 0px !important;
}
header.header-navigation-section {
    background-image: url(<?php echo $theme_url; ?>images/header-background.png);
    padding: 30px 0px 60px 0px;
    background-repeat: no-repeat;
    background-size: 100% 100%;
    float: left;
    width: 100%;
}
header.header-navigation-section .logo {
  padding: 0px;
}
header.header-navigation-section .logo img {
  float: left;
    padding-right: 15px;
}
header.header-navigation-section .menu img {
  float: right;

  cursor: pointer;
}
header.header-navigation-section .menu p.close-button {
  display: none;
    background-color: #fff;
    padding: 25px 14px;
    line-height: 0px;
    font-size: 50px;
    color: #a0e5fd;
    font-family: 'ProximaNovaA-Light';
    border-radius: 100%;
    position: absolute;
    top: 0px;
    right: 0px;
  cursor: pointer;
}
.menu-dropdown {
    position: absolute;
    display: none;
    background-image: url(<?php echo $theme_url; ?>images/menu-bg.png);
    background-repeat: no-repeat;
    background-size: 100% 100%;
    padding: 60px;
    width: 400px;
    height: 690px !important;
	right:-25px !important;
	top:25px !important;
    
  z-index: 1111;
}
.menu-dropdown ul {
  padding: 0px;
}
.menu-dropdown ul li {
  list-style-type: none;
  text-align: right;
}
.menu-dropdown ul li a {
  color: #fff;
    font-size: 18px;
    font-family: 'gotham_light_test';
    line-height: 50px;
}
.menu-dropdown ul li a:hover, .menu-dropdown ul li a:focus, .menu-dropdown ul li a:active, .menu-dropdown ul li.active a {
  color: #1cc0fb;
  text-decoration: none;
}
.menu-dropdown ul li.last {
  margin: 10px 0px 0px 0px;
}
.menu-dropdown ul li.last a {
  color: #1cc0fb;
}
.menu-dropdown ul li a img{
  padding-right: 10px;
}
header.header-navigation-section .col-sm-8 {
  margin: 70px 0px 70px 0px;
}
header.header-navigation-section .col-sm-8 h1 {
    font-family: 'Gotham-Bold';
    color: #fff;
    font-size: 50px;
    line-height: 60px;
    margin: 20px 0px;
}
header.header-navigation-section .col-sm-8 p {
    font-family: apercu_light;
    color: #e369a8;
    font-size: 14px;
    line-height: 20px;
    padding: 10px 20px;
    border-radius: 4px;
    float: left;
    background-color: #393270;
    margin: 15px 0px;
}
header.header-navigation-section .fields {
  margin-top: 20px !important;
}
header.header-navigation-section .fields .col-sm-4 {
    width: 40%;
  padding: 0px 10px 0px 0px;
}
header.header-navigation-section .fields .col-sm-2 {
    width: 15%;
  padding: 0px 10px 0px 0px;
}
header.header-navigation-section .fields .submit-button {
  width: 100%;
}
header.header-navigation-section .links a.col-sm-10 {
  text-align: center;
    padding-left: 19%;
    text-decoration: underline;
    color: #8d8ea8;
    font-family: apercu_light;
    font-size: 16px;
}
header.header-navigation-section .links a.col-sm-2 {
  text-align: center;
    text-decoration: underline;
    color: #8d8ea8;
    font-family: apercu_light;
    font-size: 16px;  
}
header.header-navigation-section .fields .submit-button input {
  border: 1px solid #ff73b3 !important;
    background-color: #ff73b3;
    font-size: 17px !important;
    color: #fff !important;
}
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

<div class="header-navigation-section container-fluid col-sm-1 <?php echo $cls_name; ?>">
  <div class="<?php echo $cls_name_1; ?> ">


            <div class="menu pull-right">

            <?php  if(!empty($customerloggedin)){ ?>
            <img src="images/acc_icon.png" class="close-button mb-70" style="display:block"></img>
            <?php }
			else{?>
            <img src="images/acc_icon.png" class="close-button mb-70" style="display:block"></img>
            <?php }?>
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
              <li><a href="<?php echo base_url().'About-Us'; ?>">About</a></li>
              <li><a href="<?php echo base_url().'contact-us'; ?>">Contact</a></li>
              <li class="last"><a href="<?php echo base_url()?>account/"> <?php echo $firstname; ?> / </a><a href="<?php echo base_url()?>account/logout/"> Logout</a></li>
              <li class="last"><a href=""><img src="images/call.png"> 415-680-3008</a></li>
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
              <li><a href="<?php echo base_url().'About-Us'; ?>">About</a></li>
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
	 <?php echo  $cls_div; ?>
	 </div>