<style type="text/css">

::-webkit-input-placeholder { /* WebKit, Blink, Edge */
    color: #373b71 !important;
}
input{
      padding: 15px 18px !important;
}

footer{
  width: 100%;
  float: left;
}



</style>

<script>
$(function() {

    var slideCount = $('#slider ul div').length;
    var slideWidth = $('#slider ul div').width();
    var slideHeight = $('#slider ul div').height();
    var sliderUlWidth = slideCount * slideWidth;

    $('#slider').css({
        width: slideWidth,
        height: slideHeight
    });

    $('#slider ul').css({
        width: sliderUlWidth,
        marginLeft: -slideWidth
    });

    $('#slider ul div:last-child').prependTo('#slider ul');

    function moveLeft() {
        $('#slider ul').animate({
            left: +slideWidth
        }, 200, function () {
            $('#slider ul div:last-child').prependTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    function moveRight() {
        $('#slider ul').animate({
            left: -slideWidth
        }, 200, function () {
            $('#slider ul div:first-child').appendTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    $('#prev').click(function () {
        moveLeft();
    });

    $('#next').click(function () {
        moveRight();
    });
});
</script>

<script type="text/javascript">
    var clicks = 1;
    function onClick() {
        clicks += 1;
        clicks <= 5;
        if (clicks <= 5){
      	  document.getElementById("clicks").innerHTML = clicks;
      	}else if (clicks > 5) {
            clicks = 1;
            document.getElementById("clicks").innerHTML = clicks;
        }

    };
    var clicks = 1;
    function onClick1() {
    	
    	 if (clicks > 1){
        clicks -= 1;
        document.getElementById("clicks").innerHTML = clicks;
    	}else if (clicks = 1) {
            clicks = 5;
             document.getElementById("clicks").innerHTML = clicks;
        }

    };
    </script>

</head>

<div class="book_concept">
	<div class="container-main main_header">
		<div class="container">
      <div class="row">
       
      <?php include 'menu_header.php';?>
            <center style="margin-left: 88px; z-index: 999;
    margin-top: 20px;"><a  href="<?php echo base_url(); ?>"><img class="" style="" src="images/contact-logo.png"></a></center>
          
         
     
        <div class="col-sm-12 page-title">
          <h2 class="">How to book</h2>
          <a  href="<?php echo base_url(); ?>" ><img style="position:relative;z-index:999;" src="images/arrow-blue.png"></a>
        </div>
      </div>
    </div>
	</div>

<div class="book_concept_body">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="col-sm-1">
					
					</div>
					<div class="col-sm-10">
						<div id="slider">
							<ul>
								<div id="slide" class="slide">
									<li><h1>Enter your Destination and select the dates and number of guests and hit search</h1>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
									<img class="img-responsive" src="images/book_concept_img1.png"></li>
								</div>
								<div id="slide" class="slide">
									<li><h1>Browse through the results and select your hotel</h1>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
									<img class="img-responsive" src="images/book_concept_img2.png"></li>
								</div>
								<div id="slide" class="slide">
									<li><h1>Choose room type, make any changes on dates,number of rooms number of guests and confirm</h1>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
									<img class="img-responsive" src="images/book_concept_img3.png"></li>
								</div>
								<div id="slide" class="slide">
									<li><h1>Sign in, Sign up, or Book as a guest,Fill out the information and Confirm booking</h1>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
									<img class="img-responsive" src="images/book_concept_img4.png"></li>
								</div>
								<div id="slide" class="slide">
									<li><h1>Pay for your rooms, print or download your invoice</h1>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
									<img class="img-responsive" src="images/book_concept_img5.png"></li>
								</div>
							</ul>
						</div>
						<div class="col-sm-12 buttons">
							<p><img  type="button" onClick="onClick1()" id="prev" src="images/prev.png">#<a id="clicks">1</a><img type="button" onClick="onClick()"  id="next" src="images/next.png" ></p>
						</div>
					</div>
					<div class="col-sm-1">
					
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="last-section">
		<div class="col-sm-12 text-center">
			<div class="container-main">
				<div class="container">
					<div class="col-sm-12 text-center">
						<h4>Become a member Now and receive additional 10% off plus some AWESOME perks...</h4>
					</div>
					<div class="col-sm-12 text-center">
						<a class="" href="#">MEMBERSHIP</a>
					</div>
				</div>
			</div>
		</div>
	</div>