<style type="text/css">
.labelright {
	border-radius: 0px 6px 6px 0px;
	float: right;
	height: 100%;
	padding: 10px;
	border: 1px solid #e8e8e8;
	background: white;
	width: 10%;
	margin-top: 20px;
}
.img_list {
	min-height: 210px;
}
.size24 {
	font-size: 22px;
}
</style>
<section  id="ROOMS">
<?php if($user_id){ ?>
  <input type="hidden" value="<?php echo $user_id; ?>" class="user_id_check">
<?php } ?>
<div class="room-type" >
  <?php  

  $set_avg_rate = 0;

  if(!empty($data->modalities)){ 
     
  ?>
    <h2 class="room-title"> Ticket Types </h2>
  <?php
  /*echo json_encode($data);
  exit();*/
      $modalities = $data->modalities;
      $close_id = 0;

    foreach($modalities as $m){ 
      ?>
        <div class="room-row" style="">
          <div class="room-row-line">
            <div class="room-type-name">
              <?php  echo str_replace(" ",'' , $m->name); ?>
            </div>
            <div class="price-room">
              <?php  if($m->rates[0]->rateDetails[0]->totalAmount->amount > 0){
                        $child_price = 0;
                        $adult_price = 0;
                        for ($a_p=0; $a_p < count($m->rates[0]->rateDetails[0]->paxAmounts) ; $a_p++) { 
                            if($m->rates[0]->rateDetails[0]->paxAmounts[$a_p]->paxType == 'CHILD'){
                                $child_price = $m->rates[0]->rateDetails[0]->paxAmounts[$a_p]->amount;
                            }elseif ($m->rates[0]->rateDetails[0]->paxAmounts[$a_p]->paxType == 'ADULT') {
                                $adult_price = $m->rates[0]->rateDetails[0]->paxAmounts[$a_p]->amount;
                            }

                        }


                        $amount = ($adult_price * $adults) + ($child_price * $child);

                        $rateKey = $m->rates[0]->rateDetails[0]->rateKey;
                        $nightlyRate = $amount;
                        $total_price = $amount ;
                        if($set_avg_rate == 0){
                          $set_avg_rate = $total_price;
                        }else if ($set_avg_rate > $total_price) {
                          $set_avg_rate = $total_price;
                        }
                        $discount_price = $total_price * 10 / 100;
                        $discount_price_vip = $total_price - ($total_price * 10 / 100);
                     ?>
              <div class="prize-room-block"> $ <?php echo $amount; ?> </div>
              <div class="day-night"> <span class="slas-room">/ </span> <span class="name-day"> total </span> </div>
              <?php } ?>
            </div>
            <div class="room-btn">
            <div class="CONTRACT_REMARKS" id="<?php echo $rateKey; ?>" style="display: none;">
              <?php echo $m->comments[0]->text; ?>
            </div>
            <div class="" id="<?php echo $rateKey; ?>_am" style="display: none;">
              <?php echo $m->rates[0]->rateDetails[0]->operationDates[0]->cancellationPolicies[0]->amount; ?>
            </div>
            <div class="" id="<?php echo $rateKey; ?>_da" style="display: none;">
              <?php 
              $date = new DateTime($m->rates[0]->rateDetails[0]->operationDates[0]->cancellationPolicies[0]->dateFrom);
              echo $date->format('m/d/Y H:i:s'); ?>
            </div>
            <form action="<?php echo base_url().$appModule;?>/book/<?php echo $module->slug;?>" method="GET">
              <div data-click="#collapse<?php echo $close_id; ?>"  class="ingo-btn info-toggle"> Info </div>
              
              <input type="hidden" name="rateKey" value="<?php echo $rateKey; ?>" />
             
              <?php if($R_user_type == '_f_no_login'){ ?>
              <button type="button" data-target="#M_f_no_login" data-price_vip="<?php echo $discount_price_vip; ?>" data-price_total="<?php echo $total_price; ?>" data-room_id="<?php echo $rateKey; ?>" class="btn btn-action btn-block chk reserve-btn op_modal">Reserve</button>
              <?php }elseif($R_user_type == '_f_free_login'){ ?>
              <button type="button" data-target="#M_f_free_login" data-price_vip="<?php echo $discount_price_vip; ?>" data-price_total="<?php echo $total_price; ?>" data-room_id="<?php echo $rateKey; ?>" class="btn btn-action btn-block chk reserve-btn op_modal">Reserve</button>
              <?php }else{ ?>
              <input type="hidden" name="mem_type" value="M_vip_login" />
              <button type="button" class="btn btn-action btn-block chk reserve-btn already_member" data-price_vip="<?php echo $discount_price_vip; ?>" data-price_total="<?php echo $total_price; ?>" data-room_id="<?php echo $rateKey; ?>" >Reserve</button>
              <?php } ?>
              <a style="display:none;" href="<?php echo trans('0142');?>" class="reserve-btn"> Reserve </a>
              </div>

            </form>
          </div>
          <div class="room-detail" id="collapse<?php echo $close_id; ?>" style="display:none">
            <div class="row">
              <div class="col-lg-12 col-sm-12 col-md-12">
                <div class="close-btn">
                  <div  data-click="#collapse<?php echo $close_id; ?>" class="info-toggle"> <img src="images/close-icon.png"> </div>
                </div>
                </div>
                <div class="col-lg-12 col-sm-12 col-md-12" style="padding-top:20px">
                  <div class="room-info">
                    <h2> <?php echo $m->name;?> </h2>
                    <p>
                      <?php if(!empty($m->comments[0]->text)){ echo $m->comments[0]->text; } ?>
                    </p>
                  </div>
                </div>
            </div>
          </div>
        </div>
  <?php 
  	$close_id++; } 
  }else{ 
  	echo "No Ticket available"; 
  } ?>
</div>
<div class="modal fade " id="M_f_free_login" role="dialog">
  <div class="modal-dialog modal-lg"> 
    
    <!-- Modal content-->
    <div class="modal-content vipmodal">
      <div class="modal-header"> 
        <!--<button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>--> 
      </div>
      <div class="modal-body">
        <div class="vippopupheadicon"><img src="images/memb1.png" /></div>
        <h2 class="becomevip">Become a VIP Member</h2>
        <p class="weprovide">We provide morden way for group Travelers to book large room block.</p>
        <p class="savebox"> you save $ <span class="modal_dispay_price"></span> with your current booking if becoming vip member</p>
        <div class="vipmemberbox">
          <div class="vipmemberboxmain">
            <div class="vipmemberboxhead">
              <h3 class="vipmembertxt">VIP Membership</h3>
              <p class="vipmemberprsc">$ 19 / month</p>
              Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s </div>
            <div class="vipmemberbenift">
              <div class="vipbenifitbox"> <img src="images/memb4.png" />
                <p>Take a additional 10% of all bookings</p>
              </div>
              <div class="vipbenifitbox"> <img src="images/memb5.png" />
                <p>Cut the line  & enjoy vip check in - selected hotels</p>
              </div>
              <div class="vipbenifitbox"> <img src="images/memb6.png" />
                <p>Complementrey upgraded Rooms - selected hotels</p>
              </div>
              <div class="vipbenifitbox"> <img src="images/memb7.png" />
                <p>Airpot to hotel Drop off in SUV - selecetd cites</p>
              </div>
              <div class="vipbenifitbox"> <img src="images/memb8.png" />
                <p>Dedicated concierge rep to assist with making reservation & planing your stay </p>
              </div>
              <div class="vipbenifitbox"> <img src="images/memb9.png" />
                <p>Front in the line access to Air rental cars "coming soon"</p>
              </div>
            </div>
          </div>
        </div>
        <div class="VIPBTN">
          <button type="submit" class="btn freememberbtn cont_free" data-mem_type="cont_as_free" data-modalname="#M_f_free_login" >CONTINUE AS A FREE MEMBER</button>
          <button type="submit" class="btn vipmemberbtn" data-mem_type="cont_as_upg_vip" data-modalname="#M_f_free_login" >UPGRADE TO VIP MEMBER</button>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn  vippoupclose" data-dismiss="modal"></button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade " id="M_f_no_login" role="dialog">
  <div class="modal-dialog modal-lg"> 
    
    <!-- Modal content-->
    <div class="modal-content vipmodal ">
      <div class="modal-header"> 
        <!--<button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>--> 
      </div>
      <div class="modal-body">
        <div class="vippopupheadicon"><img src="images/memb1.png" /></div>
        <h2 class="becomevip">Become a Member</h2>
        <p class="weprovide">We provide morden way for group Travelers to book large room block.</p>
        <p class="savebox"> You save <b>$ <span class="modal_dispay_price"></span></b> with your current booking if becoming vip member</p>
        <div class="vipmemberbox1">
          <div class="vipmemberboxmain">
            <div class="vipmemberboxhead">
              <h3 class="vipmembertxt">Starter Membership</h3>
              <p class="vipmemberprsc">$ 0 / month</p>
              Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s </div>
            <div class="VIPBTNbox">
              <button type="submit" class="btn freememberbtn cont_free" style="width:100%" data-mem_type="cont_as_free" data-modalname="#M_f_no_login" >CONTINUE AS A FREE MEMBER</button>
            </div>
            <div class="vipmemberbenift">
              <div class="vipbenifitbox"> <img src="images/free_1.png" />
                <p>Get access to hotels at a discounted price</p>
              </div>
              <div class="vipbenifitbox"> <img src="images/free_2.png" />
                <p>Keep track of your bookings</p>
              </div>
            </div>
          </div>
        </div>
        <div class="vipmemberbox1" style="text-align:center;"> <img class="hidden-xs" src="<?php echo $theme_url.'/images/vip_show.png'; ?>" style="margin-top:-10px;">
          <div class="vipmemberboxmain" style="margin-top:0px;">
            <div class="vipmemberboxhead">
              <h3 class="vipmembertxt">VIP Membership</h3>
              <p class="vipmemberprsc">$ 19 / month</p>
              Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s </div>
            <div class="VIPBTNbox">
              <button type="submit" class="btn vipmemberbtn" data-mem_type="cont_as_vip" data-modalname="#M_f_no_login"  >CONTINUE AS A VIP MEMBER</button>
            </div>
            <div class="vipmemberbenift">
              <div class="vipbenifitbox"> <img src="images/memb4.png" />
                <p>Take a additional 10% of all bookings</p>
              </div>
              <div class="vipbenifitbox"> <img src="images/memb5.png" />
                <p>Cut the line  & enjoy vip check in - selected hotels</p>
              </div>
              <div class="vipbenifitbox"> <img src="images/memb6.png" />
                <p>Complementrey upgraded Rooms - selected hotels</p>
              </div>
              <div class="vipbenifitbox"> <img src="images/memb7.png" />
                <p>Airpot to hotel Drop off in SUV - selecetd cites</p>
              </div>
              <div class="vipbenifitbox"> <img src="images/memb8.png" />
                <p>Dedicated concierge rep to assist with making reservation & planing your stay </p>
              </div>
              <div class="vipbenifitbox"> <img src="images/memb9.png" />
                <p>Front in the line access to Air rental cars "Coming soon"</p>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer"> 
          <!-- <button type="button" class="btn  vippoupclose" data-dismiss="modal"></button> --> 
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(".reserve-btn").click(function() {
      var room_id = $(this).data('room_id');
      $("#subitemid").val(room_id);
  });
  $(".op_modal").click(function() {
      var price_vip = $(this).data('price_vip');
      var price_total = $(this).data('price_total');
      $(".hide_pp").remove();
      $(".modal-content").append('<input type="hidden" value="' + price_vip + '" class="hide_pp" id="price_vip_1">');
      $(".modal-content").append('<input type="hidden" value="' + price_total + '" class="hide_pp" id="price_total_1">');
      var modal_dispay_price = price_total - price_vip;
      modal_dispay_price = modal_dispay_price.toFixed(0);
      console.log(modal_dispay_price);
      $('.modal_dispay_price').html(modal_dispay_price);
      $('.freememberbtn').attr('data-total_price', price_total);
      $('.vipmemberbtn').attr('data-total_price', price_vip);
      var op_modal = $(this).data('target');
      $(op_modal).modal('show');
      $(op_modal).addClass('in');
      $(op_modal).show();
      $(".remove_1").remove();
      var rateKey = $(this).data('room_id');
      $("#bookingdetails").append('<input type="hidden" class="remove_1" name="rateKey" value="' + rateKey + '">');
      $("#bookingdetails").append('<input type="hidden" class="remove_1 normal_price" name="normal_price" value="' + price_total + '">');
      $("#bookingdetails").append('<input type="hidden" class="remove_1 vip_price" name="vip_price" value="' + price_vip + '">');
  });
  $(document).ready(function() {
      $('.info-toggle').click(function() {
          var collapse_content_selector = $(this).attr('data-click');
          var toggle_switch = $(this);
          $(collapse_content_selector).toggle(function() {

          });
      });

      var discount_price = '$<?php echo $discount_price; ?>';
      $('.discount_price').html(discount_price);

      if (<?php echo $set_avg_rate ?> > 0) {
          var set_avg_rate = '<?php echo $set_avg_rate ?>';
          $(".total_disp").html(set_avg_rate);

      } else {
          $(".book_extra_hide").hide();
      }

  });

  $(".vipmemberbtn").click(function() {
      $('html, body').animate({
          scrollTop: $('#detail-slider').offset().top + 300
      }, 'slow');
      
      var mem_type = $(this).data('mem_type');
      var price = $("#price_vip_1").val();
      $("#bookingdetails").append('<input type="hidden" name="member_add" value="1">');

      $('.total_disp').html(price);
      var op_modal = $(this).data('modalname');
      
      $(op_modal).modal('hide');
      $(op_modal).removeClass('in');
      $(op_modal).hide();
      <?php if(!empty($usersession)){ ?>
        $('.login').show();
      <?php }else{ ?>
        $('.signup_body').show();
      <?php } ?>
      $('#click_type').remove();

      $('#ROOMS').append('<input type="hidden" value="' + mem_type + '" id="click_type">');
      
  });
  $(".already_member").click(function() {
      $('html, body').animate({
          scrollTop: $('#detail-slider').offset().top + 300
      }, 'slow');

      var price = $(this).data('price_vip');
      var price_total = $(this).data('price_total');
      $('.login').show();
      $('.total_disp').html(price);
      $('#click_type').remove();
       var rateKey = $(this).data('room_id');
      $('#ROOMS').append('<input type="hidden" value="already_member" id="click_type">');
      $("#bookingdetails").append('<input type="hidden" class="remove_1" name="rateKey" value="' + rateKey + '">');
      $("#bookingdetails").append('<input type="hidden" class="remove_1 normal_price" name="normal_price" value="' + price_total + '">');
      $("#bookingdetails").append('<input type="hidden" class="remove_1 vip_price" name="vip_price" value="' + price + '">');
  });

  $(".cont_free").click(function() {
      $('html, body').animate({
          scrollTop: $('#detail-slider').offset().top + 300
      }, 'slow');

      <?php if(!empty($usersession)){ ?>
        $('.login').show();
      <?php }else{ ?>
        $('.signup_body').show();
      <?php } ?>

      var mem_type = $(this).data('mem_type');
      var op_modal = $(this).data('modalname');
      var price = $("#price_total_1").val();
      var price_total = $(this).data('price_total');
      $('.total_disp').html(price);
      $(op_modal).modal('hide');
      $(op_modal).removeClass('in');
      $(op_modal).hide();
      
      $('#click_type').remove();
     
      $('#ROOMS').append('<input type="hidden" value="' + mem_type + '" id="click_type">');

  });

</script>
</section>
