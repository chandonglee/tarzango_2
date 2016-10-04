</div>
</div>
<!-- WRAP -->

<script>
window.onload = function () {
  var styles = [
  {
    featureType: 'water', // set the water color
    elementType: 'geometry.fill', // apply the color only to the fill
    stylers: [
      { color: '#adc9b8' }
    ]
  },{
    featureType: 'landscape.natural', // set the natural landscape
    elementType: 'all',
    stylers: [
      { hue: '#809f80' },
      { lightness: -35 }
    ]
  }
  ,{
    featureType: 'poi', // set the point of interest
    elementType: 'geometry',
    stylers: [
      { hue: '#f9e0b7' },
      { lightness: 30 }
    ]
  },{
    featureType: 'road', // set the road
    elementType: 'geometry',
    stylers: [
      { hue: '#d5c18c' },
      { lightness: 14 }
    ]
  },{
    featureType: 'road.local', // set the local road
    elementType: 'all',
    stylers: [
      { hue: '#ffd7a6' },
      { saturation: 100 },
      { lightness: -12 }
    ]
  }
];

var options = {
  mapTypeControlOptions: {
    mapTypeIds: ['Styled']
  },
  center: new google.maps.LatLng(-7.245217594087794, 112.74455556869509),
  zoom: 16,
  disableDefaultUI: true, 
  mapTypeId: 'Styled'
};
var div = document.getElementById('surabaya');
var map = new google.maps.Map(div, options);
var styledMapType = new google.maps.StyledMapType(styles, { name: 'Styled' });
map.mapTypes.set('Styled', styledMapType);
}
</script>

<style type="text/css">
.container-main.main_header.new input.search-box{
    border: none !important;
    width: 60%;
    box-shadow: none;
  }
 
.inner-page-nav{
  display: none;
}  
::-webkit-input-placeholder { /* WebKit, Blink, Edge */
    color:    #373b71 !important;
    font-family: 'Apercu-Regular';
}
:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
   color:    #373b71 !important;
   opacity:  1;
   font-family: 'Apercu-Regular';
}
::-moz-placeholder { /* Mozilla Firefox 19+ */
   color:    #373b71 !important;
   opacity:  1;
   font-family: 'Apercu-Regular';
}
:-ms-input-placeholder { /* Internet Explorer 10-11 */
   color:    #373b71 !important;
   font-family: 'Apercu-Regular';
}

</style>

<body>

<div class="contact">
<?php include 'new_header.php';?> 
  <div class="container-main main_header" style="padding-top:110px">
     <div class="container">
      <div class="row">
       
      
            <center class="center" style="margin-left: 88px; z-index: 999;
    margin-top: 20px;"></center>
          
         
     
        <div class="col-sm-12 page-title">
          <h2 class="">Contact Us</h2>
          <a  href="<?php echo base_url(); ?>" ><img style="position:relative;z-index:999;" src="images/arrow-blue.png"></a>
        </div>
      </div>
    </div>
    </div>
  </div>
  <div class="col-sm-12 text-center">
    <div class="container">
      <div class="col-sm-1">
      </div>
      <div class="inner_section col-sm-10 col-xs-12">
        <div class="intro-text" style="font-family: 'ProximaNovaA-Light';">
          <p class="text-center">Please fill out the form below and we will get back to you as soon as possible.</p>
          <p class="text-center">Need quicker answers? Call us at given numbers.</p>
        </div>
        <div class="contact-form">
          <h2>Send us a Message</h2>
          <form id="contact_form" action="" method="post">
            <?php if(isset($successmsg)){ ?>
                <div style="margin-bottom: 0px;" class="alert alert-success">
                  <i class="fa fa-check-square-o"></i>
                  <?php echo @$successmsg; ?>
                </div>
                </br>
                <?php } if(!empty($validationerrors)){ ?>
                <div style="margin-bottom: 0px;" class="alert alert-danger">
                  <i class="fa fa-times-circle"></i>
                  <?php echo $validationerrors; ?>
                </div>
                </br>
                <?php } ?>
          <?php  if(!empty($customerloggedin)){ ?>
            <div class="col-sm-6 form-group">
              <input type="text" name="contact_name" id="name" class="form-control" value="<?php echo $profile->ai_first_name ?>" placeholder="Enter Your Name">
            </div>
            <div class="col-sm-6 form-group">
              <input type="email"  name="contact_email" id="email" value="<?php echo $profile->accounts_email ?>" class="form-control" placeholder="Enter Your Email">
            </div>
          <?php }else{ ?>
            <div class="col-sm-6 form-group">
              <input type="text" name="contact_name" id="name" class="form-control" value="" placeholder="Enter Your Name">
            </div>
            <div class="col-sm-6 form-group">
              <input type="email"  name="contact_email" id="email" value="" class="form-control" placeholder="Enter Your Email">
            </div>
          <?php } ?>
            <div class="col-sm-12 form-group">
              <textarea class="form-control" name="contact_message" value="" rows="8" id="comment" placeholder="Enter Your Comment"></textarea>
            </div>
            
            <div class="col-sm-12">
            <div class="form-group submit-button">
              <input style="font-size: 14px !important;letter-spacing: 2px;font-family: 'Apercu-Regular';" type="submit" id="submit" name="submit_contact" value="SEND MESSAGE" class="form-control">
            </div>
            </div>
          </form>
        </div>
        <div class="contact-address">
                
             <?php if(!empty($res2[0]->contact_phone)){ ?>
              <div class="col-sm-3 col-xs-12">
                <p>NEED ASSISTANCE?</p>
                <h5><?php echo $res2[0]->contact_phone;?></h5>
              </div>
            <?php } ?>
             <?php if(!empty($res2[0]->contact_address)){ ?>
              <div class="col-sm-6 col-xs-12">
                <p>ADDRESS:</p>
                <h5><?php echo $res2[0]->contact_address; ?></h5>
              </div>
            <?php } ?>
            <?php if(!empty($res2[0]->contact_email)){ ?>
              <div class="col-sm-3 col-xs-12">
                <p>EMAIL</p>
                <h5><?php echo $res2[0]->contact_email;?></h5>
              </div>
            <?php } ?>
        </div>
        <div class="office-map col-sm-12">
          <div class="office col-sm-12">
            <h5>Las Vegas Branch</h5>
            <div class="map">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3220.894561621207!2d-115.14178768538878!3d36.16912031066835!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c8c3750e997b57%3A0x2f3e02601433de8e!2s520+Fremont+St%2C+Las+Vegas%2C+NV+89101%2C+USA!5e0!3m2!1sen!2sin!4v1470855058382" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen=""></iframe>
              <!--<img class="img-responsive" src="images/cross_map.png">-->
              <div class="overlay">
              <div class="overlay-inner">
                <p class="sign 1 minus">+</p>
                
              </div>
              </div>
            </div>
            <div class="map-address 1" style="display: block;">
              <div class="col-sm-6 pull-left">
                <p>520 Fremont St, Suite 200</p>
                <p>Las Vegas, NV 89101</p>
              </div>
              <div class="col-sm-6 pull-right">
                <p>+1(702) 899-1216</p>
                <p>lasvegas@tarzengo.com</p>
              </div>
            </div>
          </div>
          <div class="office col-sm-12">
            <h5>San Diego Branch</h5>
            <div class="map">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3356.8744405973657!2d-117.16115018539945!3d32.71596399440421!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80d954a0c98d429d%3A0x938b74e00a2abedd!2s624+Broadway+%23200%2C+San+Diego%2C+CA+92101%2C+USA!5e0!3m2!1sen!2sin!4v1471269469896" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen=""></iframe>
              <!--<img class="img-responsive" src="images/plus_map.png">-->
              <div class="overlay">
              <div class="overlay-inner">
                <p class="sign 2">+</p>
               
              </div>
              </div>
            </div>
            <div class="map-address 2" style="display: none;">
              <div class="col-sm-6 pull-left">
                <p>624 Broadway, Suite 200</p>
                <p>San Diego, CA 92101</p>
              </div>
              <div class="col-sm-6 pull-right">
                <p>+1(702) 899-1216</p>
                <p>sandiego@tarzengo.com</p>
              </div>
            </div>
          </div>
          <div class="office col-sm-12">
            <h5>San Francisco Branch</h5>
            <div class="map">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.0528701345766!2d-122.40338828524831!3d37.788800719126435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808580629c4805e3%3A0xa0ed57178e7f3e84!2s28+2nd+St+%23200%2C+San+Francisco%2C+CA+94105%2C+USA!5e0!3m2!1sen!2sin!4v1471269512190" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen=""></iframe>
              <!--<img class="img-responsive" src="images/plus_map.png">-->
              <div class="overlay">
              <div class="overlay-inner">
                <p class="sign 3">+</p>
                
              </div>
              </div>
            </div>
            <div class="map-address 3">
              <div class="col-sm-6 pull-left">
                <p>28 2nd Street, Suite 200</p>
                <p>San Francisco, CA 94105</p>
              </div>
              <div class="col-sm-6 pull-right">
                <p>+1(702) 899-1216</p>
                <p>sanfrancisco@tarzengo.com</p>
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

</body>








<!-- End container -->
<!--<div id="map_contact"></div>-->
<div class="clearfix"></div>
<!--
  <?php if(!empty($res2[0]->contact_address)){ ?>
  <address>
  <?php echo $res2[0]->contact_address; ?>
  </address>
  <?php } ?>

  <script>
    $(document).ready(function(){
    $("address").each(function(){
    var embed ="<iframe width='100%' height='315' frameborder='0' scrolling='no'  marginheight='0' marginwidth='0'   src='//maps.google.com/maps?&amp;q="+ encodeURIComponent( $(this).text() ) +"&amp;output=embed'></iframe>";
    $(this).html(embed);
    }); });
  </script>-->
