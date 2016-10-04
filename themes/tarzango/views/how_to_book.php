
<link rel="stylesheet" href="<?php echo $theme_url; ?>css/jquery.ui.css">

<!-- favicon -->
<!-- <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="icon" href="images/favicon.ico" type="image/x-icon"> -->


<script src='<?php echo $theme_url; ?>js/turn.min.js'></script>
<style type="text/css">
  @media(min-width: 1600px){
    #flipbook{
      position: relative;
   /* width: 1200px;
    height: 600px;*/
    /*margin-left: -100px !important;*/
    }
  }
</style>
<script>
$(function() {
  $("#flipbook").turn({
   
    autoCenter: true
});

    $('#prev').click(function () {
      $("#flipbook").turn("previous");
     setTimeout(function(){
     var getzindex =  $('#flipbook .page-wrapper').first().css('z-index');
     $('#next').attr('src','<?php echo $theme_url; ?>images/next.png');
     if(getzindex==5){$('#prev').attr('src','<?php echo $theme_url; ?>images/prev.png');}
     },800);
    });
     $('#next').click(function () {
       $("#flipbook").turn("next");
  /*  var pageslideno = $('#flipbook .page-wrapper').length;
    pageslideno =pageslideno-1;
     alert(pageslideno);*/
    // var getzindex =  $('#flipbook .page-wrapper:ed('+pageslideno+')').css('z-index');
    setTimeout(function(){
     var getzindex =  $('#flipbook .page-wrapper').last().css('z-index');
      $('#prev').attr('src','<?php echo $theme_url; ?>images/prev1.png');
      if(getzindex==5){$('#next').attr('src','<?php echo $theme_url; ?>images/next1.png');}
    },800);
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
<?php include 'new_header.php';?>
<div class="book_concept" style="padding-top:85px;">
  <div class="container-main main_header">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="col-sm-4"> </div>
          
        </div>
        <div class="col-sm-12 page-title">
          <h2 class="">How to Book</h2>
          <img src="images/arrow-blue.png"> </div>
      </div>
    </div>
  </div>
  <!--<div class="book_concept_body">
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
              <p><img id="prev" src="images/prev.png"> #1 <img id="next" src="images/next.png"></p>
            </div>
          </div>
          <div class="col-sm-1">
          
          </div>
        </div>
      </div>
    </div>
  </div>-->
  <div class="book_concept_body">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div id="flipbook">
            <div >
              <div>
                <h3 class="bookhead">Enter your Destination and select the dates and number of guests and hit search</h3>
                <p class="bookdtl">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
                <div class="bookimg"><img class="img-responsive " src="images/book_concept_img1.png"></div>
              </div>
            </div>
            <div>
              <div>
                <h3 class="bookhead">Browse through the results and select your hotel</h3>
                <p class="bookdtl">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
                <div class="bookimg"><img class="img-responsive" src="images/book_concept_img2.png"></div>
              </div>
            </div>
            <div>
              <div>
                <h3 class="bookhead">Choose room type, make any changes on dates,number of rooms number of guests and confirm</h3>
                <p class="bookdtl">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
                <div class="bookimg"><img class="img-responsive" src="images/book_concept_img3.png"></div>
              </div>
            </div>
            <div>
              <div>
                <h3 class="bookhead">Sign in, Sign up, or Book as a guest,Fill out the information and Confirm booking</h3>
                <p class="bookdtl">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
                <div class="bookimg"><img class="img-responsive" src="images/book_concept_img4.png"></div>
              </div>
            </div>
            <div>
              <div>
                <h3 class="bookhead">Pay for your rooms, print or download your invoice</h3>
                <p class="bookdtl">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
                <div class="bookimg"><img class="img-responsive" src="images/book_concept_img5.png"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12 buttons">
          <p><img id="prev" src="<?php echo $theme_url; ?>images/prev.png"><img id="next" src="<?php echo $theme_url; ?>images/next.png"></p>
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
          <div class="col-sm-12 text-center"> <a class="" href="<?php echo base_url().'membership'; ?>">MEMBERSHIP</a> </div>
        </div>
      </div>
    </div>
  </div>
</div>