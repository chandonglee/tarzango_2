<?php

  $dateYear = ($year != '')?$year:date("Y");
    $dateMonth = ($month != '')?$month:date("m");
    $date = $dateYear.'-'.$dateMonth.'-01';
    $currentMonthFirstDay = date("N",strtotime($date));
    $totalDaysOfMonth = cal_days_in_month(CAL_GREGORIAN,$dateMonth,$dateYear);
    $totalDaysOfMonthDisplay = ($currentMonthFirstDay == 7)?($totalDaysOfMonth):($totalDaysOfMonth + $currentMonthFirstDay);
    $boxDisplay = ($totalDaysOfMonthDisplay <= 35)?35:42;
   /* echo $monthssss =  $this->getAllMonth($dateMonth);
exit();*/
  ?>
<style type="text/css">

  body{ font-family: sans-serif;}
  .none{ display:none;}
  .dropdown{color: #444444;font-size:17px;}
  #calender_section{ width:1010px; margin:30px auto 0;}
  #calender_section h2{ background-color:#efefef; color:#444444; font-size:17px; text-align:center; line-height:40px;}
  #calender_section h2 a{ color:#F58220; float:none;}
  #calender_section_top{ width:100%; float:left; margin-top:20px;}
  #calender_section_top ul{padding:0; list-style-type:none;}
  #calender_section_top ul li{ float:left; display:block; width:143px; border:1px solid #000;  text-align:center; font-size:14px; min-height:0; background:none; box-shadow:none; margin:0; padding:0;}
  #calender_section_bot{ width:100%; margin-top:20px; float:left; border-left:1px solid #ccc; border-bottom:1px solid #ccc;}
  #calender_section_bot ul{ margin:0; padding:0; list-style-type:none;}
  #calender_section_bot ul li{ float:left; width:143px; height:80px; text-align:center; border-top:1px solid #ccc; border-right:1px solid #ccc; min-height:0; background:none; box-shadow:none; margin:0; padding:0; position:relative;}
  #calender_section_bot ul li span{ margin-top:7px; float:left; margin-left:7px; text-align:center;}

  .grey{ background-color:#DDDDDD !important;}
  .light_sky{ background-color:#0073aa !important;}

  /*========== Hover Popup ===============*/
  .date_cell { cursor: pointer; cursor: hand; }
  /*.date_cell:hover { background: #DDDDDD !important; }*/
  .date_popup_wrap {
    position: absolute;
    width: 143px;
    height: 115px;
    z-index: 9999;
    /*top: -115px;
    left:-55px;
    background: transparent url(<?php echo base_url(); ?>assets/add-new-event.png) no-repeat top left;*/
    color: #666 !important;
  }
  .events_window {
    overflow: hidden;
    overflow-y: auto;
    width: 133px;
    height: 115px;
    margin-top: 28px;
    margin-left: 25px;
  }
  .event_wrap {
    margin-bottom: 10px; padding-bottom: 10px;
    border-bottom: solid 1px #E4E4E7;
    font-size: 12px;
    padding: 3px;
  }
  .date_window {
    margin-top:20px;
    margin-bottom: 2px;
    padding: 5px;
    font-size: 16px;
    margin-left:9px;
    margin-right:14px;


  }
  .date_window a{
    color: #FFF;
  }
  .popup_event {
    margin-bottom: 2px;
    padding: 2px;
    font-size: 16px;
    width:100%;
    color: #FFF;
  }
  #event_list ul li{cursor:pointer;}
  .popup_event a {color: #000000 !important;}
  .packeg_box a {color: #F58220;float: right;}
  /*a:hover {color: #181919;text-decoration: underline;}*/

  @media only screen and (min-width:480px) and (max-width:767px) {
  #calender_section{ width:336px;}
  #calender_section_top ul li{ width:47px;}
  #calender_section_bot ul li{ width:47px;}
  }
  @media only screen and (min-width: 320px) and (max-width: 479px) {
  #calender_section{ width:219px;}
  #calender_section_top ul li{ width:30px; font-size:11px;}
  #calender_section_bot ul li{ width:30px;}
  #calender_section_bot{ width:217px;}
  #calender_section_bot ul li{ height:50px;}
  }

  @media only screen and (min-width: 768px) and (max-width: 1023px) {
  #calender_section{ width:530px;}
  #calender_section_top ul li{ width:74px;}
  #calender_section_bot ul li{ width:74px;}
  #calender_section_bot{ width:525px;}
  #calender_section_bot ul li{ height:50px;}
  }
</style>

<div id="calendar_div">
  <div id="calender_section">
    <h2>
      <a href="javascript:void(0);" onclick="getCalendar('calendar_div','<?php echo date("Y",strtotime($date.' - 1 Month')); ?>','<?php echo date("m",strtotime($date.' - 1 Month')); ?>');">&lt;&lt;</a>
            <select name="month_dropdown" class="month_dropdown dropdown"><?php echo getAllMonth($dateMonth); ?></select>
            <select name="year_dropdown" class="year_dropdown dropdown"><?php echo getYearList($dateYear); ?></select>
      <a href="javascript:void(0);" onclick="getCalendar('calendar_div','<?php echo date("Y",strtotime($date.' + 1 Month')); ?>','<?php echo date("m",strtotime($date.' + 1 Month')); ?>');">&gt;&gt;</a>
    </h2>
    <div id="event_list" class="none">
    </div>

    <div id="calender_section_top">
      <ul>
        <li>Sun</li>
        <li>Mon</li>
        <li>Tue</li>
        <li>Wed</li>
        <li>Thu</li>
        <li>Fri</li>
        <li>Sat</li>
      </ul>
    </div>
    <div id="calender_section_bot">
      <ul>
      <?php 
        $dayCount = 1; 
        error_reporting(E_ALL);
        for($cb=1;$cb<=$boxDisplay;$cb++){
          if(($cb >= $currentMonthFirstDay+1 || $currentMonthFirstDay == 7) && $cb <= ($totalDaysOfMonthDisplay)){
            //Current date
            $currentDate = $dateYear.'-'.$dateMonth.'-'.$dayCount;
            $today_booking = 0;
            //Include db configuration file
            //include 'dbConfig.php';
            //Get number of events based on the current date
            $today_booking = get_booking_list_by_date($currentDate);
            if($today_booking > 0){
              echo '<li date="'.$currentDate.'" class="light_sky date_cell">';
               //Date cell
            echo '<span>';
            echo $dayCount;
            echo '</span>';
            
            //Hover event popup
            echo '<div id="date_popup_'.$currentDate.'" class="date_popup_wrap ">';
            echo '<div class="date_window">';
            echo '<div class="popup_event">Booking ('.$today_booking.')</div>';
            echo ($today_booking > 0)?'<a href="javascript:;" onclick="getEvents(\''.$currentDate.'\');">view booking</a>':'';
            echo '</div></div>';
            
            }else
           if(strtotime($currentDate) == strtotime(date("Y-m-d"))){
              echo '<li date="'.$currentDate.'" class="grey date_cell">';
               echo '<span>';
            echo $dayCount;
            echo '</span>';
            }else{
              echo '<li date="'.$currentDate.'" class="date_cell">';
              echo '<span>';
            echo $dayCount;
            echo '</span>';
            }
             // echo '<li date="'.$currentDate.'" class="date_cell">';
           
           
            echo '</li>';
            $dayCount++;
            
      ?>
      <?php }else{ ?>
        <li><span>&nbsp;</span></li>
      <?php } } ?>
      </ul>
    </div>
  </div>
</div>
  <script type="text/javascript">
    function getCalendar(target_div,year,month){
      $.ajax({
        type:'POST',
        url:'<?php echo base_url() ?>admin/calender/getCalender1',
        data:'func=getCalender&year='+year+'&month='+month,
        success:function(html){
          $('#'+target_div).html(html);
        }
      });
    }
    function get_da(booking_item,c_date){
     var hotel_name=  $(this).data('hotel_name');
      console.log(booking_item);
      console.log(c_date);
       $.ajax({
        type:'POST',
        url:'<?php echo base_url() ?>admin/calender/get_book_detail',
        data:'booking_item='+booking_item+'&c_date='+c_date,
        success:function(html){
          $('#h_data'+booking_item).append(html);
          $('#h_data'+booking_item).slideDown('slow');
        }
      });

    }
    function getEvents(date){
      $.ajax({
        type:'POST',
        url:'<?php echo base_url() ?>admin/calender/getEvents',
        data:'date='+date,
        success:function(html){
          $('#event_list').html(html);
          $('#event_list').slideDown('slow');
        }
      });
    }
    
    function addEvent(date){
      $.ajax({
        type:'POST',
        url:'functions.php',
        data:'func=addEvent&date='+date,
        success:function(html){
          $('#event_list').html(html);
          $('#event_list').slideDown('slow');
        }
      });
    }
    
    $(document).ready(function(){
      /*$('.date_cell').mouseenter(function(){
        date = $(this).attr('date');
        $(".date_popup_wrap").fadeOut();
        $("#date_popup_"+date).fadeIn();  
      });
      $('.date_cell').mouseleave(function(){
        $(".date_popup_wrap").fadeOut();    
      });*/
      $('.month_dropdown').on('change',function(){
        getCalendar('calendar_div',$('.year_dropdown').val(),$('.month_dropdown').val());
      });
      $('.year_dropdown').on('change',function(){
        getCalendar('calendar_div',$('.year_dropdown').val(),$('.month_dropdown').val());
      });
      $(document).click(function(){
        //$('#event_list').slideUp('slow');
      });
    });
  </script>
</div>