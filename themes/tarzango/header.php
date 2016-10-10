<!DOCTYPE html>
<?php 
	$CI = &get_instance(); 
	$ishome = $CI->uri->segment(1); 
	$currenturl = uri_string(); 
	$app_settings = $CI->settings_model->get_settings_data(); 
	$allowreg = $app_settings[0]->allow_registration; 
	$allowsupplierreg = $app_settings[0]->allow_supplier_registration; 
	
	if(!empty($metadesc)){ 
		$metadescription = $metadesc; 
	}else{ 
		if( empty($ishome)){ 
			$metadescription = $app_settings[0]->meta_description;
		} 
	} 
	
	if(!empty($metakey)){ 
		$metakeywords = $metakey; 
	}else{ 
		if(empty($ishome)){ 
			$metakeywords =  $app_settings[0]->keywords;
		} 
	} 
	
	$lang_set = $CI->theme->_data['lang_set'];
	$langname = $CI->session->userdata('lang_name'); 
	$isRTL = isRTL($lang_set); 
	
	if(empty($langname)){ 
		$langname = languageName($lang_set); 
	}else{ 
		$langname = $langname; 
	}


?>


<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php echo @$metadescription; ?>">
<meta name="keywords" content="<?php echo @$metakeywords; ?>">
<meta name="author" content="TARZANGO">
<title>
<?php if(empty($ishome)){ echo $app_settings[0]->home_title; }else{ echo $CI->theme->_data['page_title']; } ?>
</title>
<link rel="shortcut icon" href="<?php echo PT_GLOBAL_IMAGES_FOLDER.'favicon.png';?>">

<!-- facebook **** -->
<meta property="og:title" content="<?php $ishome = $CI->uri->segment(1); if(empty($ishome)){ echo $app_settings[0]->home_title; }else{ echo $CI->theme->_data['page_title']; } ?>"/>
<meta property="og:site_name" content="<?php echo $app_settings[0]->site_title;?>"/>
<meta property="og:description" content="<?php if($app_settings[0]->seo_status == "1"){echo $metadescription;}?>"/>
<!--<meta property="og:image" content="<?php echo base_url(); ?>uploads/global/favicon.png"/>-->
<meta property="og:url" content="<?php echo $app_settings[0]->site_url;?>/"/>
<meta property="og:publisher" content="https://www.facebook.com/<?php echo $app_settings[0]->site_title;?>"/>
<script type="application/ld+json">{"@context":"http://schema.org/","@type":"Organization","name":"<?php echo $app_settings[0]->site_title;?>","url":"<?php echo $app_settings[0]->site_url;?>/","logo":"<?php echo base_url(); ?>uploads/global/favicon.png","sameAs":"https://www.facebook.com/<?php echo $app_settings[0]->site_title;?>","sameAs":"https://twitter.com/<?php echo $app_settings[0]->site_title;?>","sameAs":"https://www.pinterest.com/<?php echo $app_settings[0]->site_title;?>/","sameAs":"https://plus.google.com/u/0/<?php echo $app_settings[0]->site_title;?>/posts","contactPoint":{"@type":"ContactPoint","telephone":"<?php echo $phone; ?>","contactType":"Customer Service"}}{"@context":"http://schema.org","@type":"WebSite","name":"<?php echo $app_settings[0]->site_title;?>","url":"<?php echo $app_settings[0]->site_url;?>"}  </script>
<!-- [if lt IE 9]>        
	<script src="<?php echo $theme_url; ?>assets/js/html5shiv.js"></script> 
    <script src="<?php echo $theme_url; ?>assets/js/respond.min.js"></script>
<![endif]-->
<!-- **** BASE CSS **** -->
<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
<style>
@import "<?php echo $theme_url; ?>childtheme/childstyle.css";

 .blog{
    display: block !important;
  }
  .header-navigation-section .menu img {
    float: right;
    margin-top: 0px;
    cursor: pointer;
}
.dropbtn {
      outline: none;
  width: 175px;
  font-family: 'gotham_light_test';
  text-align: left;
  margin-top: -12px;
    background-color: #433074;
    color: white;
    padding: 15px;
    font-size: 14px;
    border: none;
    cursor: pointer;
}


.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
  width: 175px;
    display: none;
    text-align: left;
    position: absolute;
    background-color: #433074;
    font-family: 'gotham_light_test';
    min-width: 160px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}

.dropdown-content a {
    color: #fff;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}
.dropdown-content a:hover {
    color: #fff;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.container-main.main_header.new input.search-box{
    border: none !important;
    width: 60%;
    box-shadow: none;
  }
  
  .container-main.main_header.new{
    padding: 10px 0px !important;
  }
  
  
.menu-header{
  display: none;
 }
.user{
  margin-top: 20px;
}
#header.sticky > .container-main.main_header.new{
    padding: 25px 0px !important;
  }
</style>
<!-- **** Google Maps **** -->
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=AIzaSyAH65sTGsDsP4mMpmbHC8zqRiM1Qh07iL8&sensor=false&libraries=places"  ></script>
<!-- jQuery **** -->
<script src="<?php echo $theme_url; ?>assets/js/jquery-1.11.2.min.js"></script>
<script src="<?php echo $theme_url; ?>assets/js/wow.min.js"></script>
<!-- RTL CSS **** -->
<?php if($isRTL == "RTL"){ ?>
<link href="<?php echo $theme_url; ?>RTL.css" rel="stylesheet">
<?php } ?>
<!-- Mobile Redirect -->
<?php if($app_settings[0]->mobile_redirect_status == "Yes"){ if($ishome != "invoice"){ ?>
<script>
	if(/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)){ 
		window.location ="<?php echo $app_settings[0]->mobile_redirect_url ?>";
	}
</script>
<?php } } ?>
<?php 
/*error_reporting(-1);*/
 $pageslug_attraction = $CI->uri->segment(1);
/*exit();*/
   $pagename =  uri_string();
   
?>
<!--[if lt IE 7]>        
	<link rel="stylesheet" type="text/css" href="<?php echo $theme_url; ?>assets/css/font-awesome-ie7.css" media="screen" /> 
<![endif]-->
<?php 
if($pagename != 'membership' && $pagename != 'membership_perks' && $pagename != 'faq'){
?>
  <link rel="stylesheet" href="<?php echo $theme_url; ?>assets/css/jquery-ui.css" />
<?php } ?>
<!-- Bootstrap -->
<link href="<?php echo $theme_url; ?>css/bootstrap.css" rel="stylesheet">

<!-- Bootstrap -->
<link href="<?php echo $theme_url; ?>css/bootstrap-theme.css" rel="stylesheet">
<link href="<?php echo $theme_url; ?>css/owl.carousel.css" rel="stylesheet">
<link href="<?php echo $theme_url; ?>css/owl.theme.css" rel="stylesheet">
<!-- Bootstrap -->
<?php 

  if($pagename == ''){
 ?>
<link href="<?php echo $theme_url; ?>css/style.css" rel="stylesheet">
<?php
  $cls_name = 'slider';
  $cls_name_1 = 'cover';
  $cls_div = '';
 }else if($pagename == 'attraction' || $pageslug_attraction == 'attraction' ){ ?>
  <link href="<?php echo $theme_url; ?>css/style_attraction.css" rel="stylesheet">
 <style>
 .inner-page-nav{
  display: none;
 }
 </style>
<?php 
$cls_name = 'inner-page-nav';
  $cls_name_1 = '';
  $cls_div = '</div></div>';
}else{ ?>
<link href="<?php echo $theme_url; ?>css/style_listing.css" rel="stylesheet">
<?php
  $cls_name = 'inner-page-nav';
  $cls_name_1 = '';
  $cls_div = '</div></div>';
   } ?>
<!-- Bootstrap -->
<!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css"> -->
<link href="<?php echo $theme_url; ?>css/font-awesome.css" rel="stylesheet">


<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<style >
.why-tsrzango h1.slider-header {
    text-align: left;
    margin-top: 120px !important;
    text-transform: none;
    font-family: 'Gotham-Bold';
    max-width: 100%;
}
.header-navigation-section .menu img {
    float: right;
    
    cursor: pointer;
}
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

/*.dropdown .show-submenu {
	border: 1px solid #fd4a63 !important;
}
.dropdown .show_lock:before {
background: url(<?php echo $theme_url;
?>/img/sign-in.png) no-repeat !important;
}
.dropdown .show_usr:before {
	display: inline-block;
	font: normal normal normal 14px/1 FontAwesome;
	font-size: inherit;
	text-rendering: auto;
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
	content: "\f007" !important;
}
.list-unstyled li {
	cursor: pointer;
}*/
</style>
</head>


<body id="top" class="why-tsrzango">
<div class="divLoading" style="margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(0, 0, 0); z-index: 30001; opacity: 0.8;overflow-x: hidden;display: none;">
<p style="position: absolute; color: white; top: 50%; left: 45%;">
  <img src="<?php echo $theme_url.'images/loader.gif'; ?>">
</p>
</div>


<!-- <div class="divLoading" style="margin: 0px; padding: 0px; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(0, 0, 0); z-index: 30001; opacity: 0.8;overflow-x:hidden;">
  <div class="loader__figure"></div>
  <p class="loader__label">Hang on, we're booking your tickets</p>
</div> -->


<!-- Top wrapper -->
<div class="header-navigation-section container-fluid <?php echo $cls_name; ?>">
  <div class="<?php echo $cls_name_1; ?> row">
    <div class="">
      <div class="container">
        <nav class="navbar navbar-default row">
          <div> 
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header"> <a class="navbar-brand non-sticky-logo" href="<?php echo base_url(); ?>"><img src="img/logo.png" class="img-responsive" alt="logo"></a> <a class="navbar-brand sticky-logo" href="<?php echo base_url(); ?>"><img src="img/sticky-logo.png" class="img-responsive" alt="logo"></a>

             <div class="col-sm-1 menu pull-right">

            <img src="images/acc_icon.png" class="close-button mtop25" style="display:block"></img>
            <!-- <p class="close-button" style="display:block">+</p> -->
          </div>

          <script type="text/javascript">

				$(".close-button").click(function(){
				 
				 $(this).toggleClass("down"); 
				});
			</script>
				  <?php  if(!empty($customerloggedin)){ ?>
				     
				      <div class="col-sm-2 user" style="float: right;
    top: 12px;">
				       <div class="dropdown">
				        <button onclick="myFunction()" class="dropbtn">Hello,  <?php echo $firstname; ?>  <img  style="width: 20px; float: right;margin-left: 10px; " src="images/menu-arrow-down.png"></button>
				          <div id="myDropdown1" class="dropdown-content">
				            <a href="<?php echo base_url()?>account/"> Reservations </a>
				           <a href="<?php echo base_url()?>account/logout/"> <?php echo trans('03');?></a>   
				          </div>
				        </div>
				        
				       </div>
        <?php }?>

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
							<li class="last"><a href=""><img src="images/call.png"> 415-680-3008</a></li>
						</ul>	
                		  <?php }else{ if (strpos($currenturl,'book') !== false) { }else{ if($allowreg == "1"){ ?>
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
						 <?php } } } ?>
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
          </div>
          <!-- /.container-fluid --> 
        </nav>
      </div>
    </div>
    <?php echo  $cls_div; ?>


<script src='<?php echo $theme_url ?>js/bootstrap.min.js'></script>
<script src='<?php echo $theme_url ?>js/custom.js'></script>
