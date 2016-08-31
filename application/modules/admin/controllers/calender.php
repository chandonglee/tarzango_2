<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');
/*error_reporting(E_ALL);*/
class Calender extends MX_Controller {
    private $data = array();
    public $role;
    public  $editpermission = true;
    public  $deletepermission = true;
    function __construct() {
        modules :: load('admin');
        $chkadmin = modules :: run('admin/validadmin');
        if (!$chkadmin) {
            $this->session->set_userdata('prevURL', current_url());
            redirect('admin');
        }
        $this->data['app_settings'] = $this->settings_model->get_settings_data();
        $checkingadmin = $this->session->userdata('pt_logged_admin');
        if (!empty ($checkingadmin)) {
            $this->data['userloggedin'] = $this->session->userdata('pt_logged_admin');
        }
        else {
            $this->data['userloggedin'] = $this->session->userdata('pt_logged_supplier');
        }
        if (!empty ($checkingadmin)) {
            $this->data['adminsegment'] = "admin";
        }
        else {
            $this->data['adminsegment'] = "supplier";
        }
        $this->load->model('admin/calender_model');
        $this->data['userloggedin'] = $this->session->userdata('pt_logged_admin');
        $this->data['isadmin'] = $this->session->userdata('pt_logged_admin');
        $this->data['isSuperAdmin'] = $this->session->userdata('pt_logged_super_admin');
        $this->role = $this->session->userdata('pt_role');
        $this->data['role'] = $this->role;
        $this->data['addpermission'] = true;
        if($this->role == "admin"){
        $this->editpermission = pt_permissions("editbooking", $this->data['userloggedin']);
        $this->deletepermission = pt_permissions("deletebooking", $this->data['userloggedin']);
        $this->data['addpermission'] = pt_permissions("addbooking", $this->data['userloggedin']);
        }

        $this->lang->load("back", "en");
    }

    function index() {
		
		$controller_name = $this->router->fetch_class();
		$method_name = $this->router->fetch_method();

        $today_booking = $this->calender_model->get_booking_list();
        $this->load->helper('calender');
        $dateYear = ($year != '')?$year:date("Y");
        $dateMonth = ($month != '')?$month:date("m");
        $getAllMonths = $this->getAllMonth($dateMonth);
		$getYearList = $this->getYearList($dateYear);

		
        if(!$this->data['addpermission'] && !$this->editpermission && !$this->deletepermission){
                    backError_404($this->data);
                    
        }else{

            
            $this->data['today_booking'] = $today_booking;
            $this->data['page_title'] = 'Calender Management';
            $this->data['main_content'] = 'calender_view';
            $this->data['header_title'] = 'Calender Management';
            $this->data['controller_name'] = $controller_name;
    		$this->data['method_name'] = $method_name;
            $this->data['getAllMonths'] = $getAllMonths;
    		$this->data['getYearList'] = $getYearList;
    		
            $this->load->view('template', $this->data);    
       
        
        }
    
    }

    public function getCalender1(){

        if(isset($_POST['func']) && !empty($_POST['func'])){
            switch($_POST['func']){
                case 'getCalender':
                    $this->getCalender($_POST['year'],$_POST['month']);
                    break;
                case 'getEvents':
                    $this->getEvents($_POST['date']);
                    break;
                default:
                    break;
            }
        }
    }

    public function getCalender($year = '',$month = ''){
    $this->load->helper('calender');
    $dateYear = ($year != '')?$year:date("Y");
    $dateMonth = ($month != '')?$month:date("m");
    $date = $dateYear.'-'.$dateMonth.'-01';
    $currentMonthFirstDay = date("N",strtotime($date));
    $totalDaysOfMonth = cal_days_in_month(CAL_GREGORIAN,$dateMonth,$dateYear);
    $totalDaysOfMonthDisplay = ($currentMonthFirstDay == 7)?($totalDaysOfMonth):($totalDaysOfMonth + $currentMonthFirstDay);
    $boxDisplay = ($totalDaysOfMonthDisplay <= 35)?35:42;
    
    ?>
        <div id="calender_section">
    <h2>
      <a href="javascript:void(0);" onclick="getCalendar('calendar_div','<?php echo date("Y",strtotime($date.' - 1 Month')); ?>','<?php echo date("m",strtotime($date.' - 1 Month')); ?>');">&lt;&lt;</a>
            <select name="month_dropdown" class="month_dropdown dropdown"><?php echo getAllMonth($dateMonth); ?></select>
            <select name="year_dropdown" class="year_dropdown dropdown"><?php echo getYearList($dateYear); ?></select>
      <a href="javascript:void(0);" onclick="getCalendar('calendar_div','<?php echo date("Y",strtotime($date.' + 1 Month')); ?>','<?php echo date("m",strtotime($date.' + 1 Month')); ?>');">&gt;&gt;</a>
    </h2>
    <div id="event_list" class="none">
        <span class="btn-group">
          <a class="btn btn-default btn-xcrud btn btn-primary" href="http://localhost/tarzango/invoice/?id=202&amp;sessid=24922" title="View Invoice" target="_blank"><i class="fa fa-search-plus"></i></a>
          <a class="btn btn-default btn-xcrud btn btn-warning" href="http://localhost/tarzango/admin/bookings/edit/hotels/202" title="Edit" target="_self"><i class="fa fa-edit"></i></a>
          <a class="btn btn-default btn-xcrud btn-danger" href="javascript: delfunc(\'202\',\'http://localhost/tarzango/admin/bookings/delBooking\')" title="DELETE" target="_self" id="202"><i class="fa fa-times"></i></a>
        </span>

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
            
            }elseif(strtotime($currentDate) == strtotime(date("Y-m-d"))){
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
  <?php 
    }

    

    public function getEvents($date = ''){
        //Include db configuration file
        //include 'dbConfig.php';
        $this->load->helper('invoice');
         $this->load->helper('calender');
        $eventListHTML = '';
        $date = $this->input->post('date');
        $date = $date?$date:date("Y-m-d");
        //error_reporting(-1);
        //Get events based on the current date
        $result = $this->calender_model->get_booking_list_by_Date($date);
       
        $hotel_count = array_count_values(array_column($result['all'], 'booking_item'));
        /*$items = explode(',',$result['all']);
       $data =  array_count_values($items);*/
      /* print_r($result1);
       exit();*/
       
        if($result['nums'] > 0){
            $eventListHTML = '<h2>Events on '.date("l, d M Y",strtotime($date)).'</h2>';
            $eventListHTML .= '<ul>';
            $book = 1;
                $added_id = array();

            for ($i=0; $i < count($result['all']) ; $i++) { 
                
                $t = $result['all'][$i]['hotel_title'];
                if(!in_array($result['all'][$i]['booking_item'] , $added_id)){
                    
                /*}else{*/
                    $added_id[] = $result['all'][$i]['booking_item'];
                    $booking_item = $result['all'][$i]['booking_item'];

                    $inv_data = invoiceDetails($result['all'][$i]['booking_id'],$result['all'][$i]['booking_ref_no']);
                   /* echo json_encode($inv_data);*/
                    $eventListHTML .= '<li onClick="get_da('.$booking_item.',\''.$date.'\');">'.$result['all'][$i]['hotel_title'].' ('.$hotel_count[$booking_item].' Booking)</li><div id="h_data'.$booking_item.'" ></div>';
                    //print_r($added_id);
                }
                
            }
                    //print_r($added_id);
            $eventListHTML .= '</ul>';
        }
        echo $eventListHTML;
    }

    public function get_book_detail(){
        $eventListHTML = "";
        $date = $this->input->post('c_date');
        $booking_item = $this->input->post('booking_item');
        $date = $date?$date:date("Y-m-d");
        //error_reporting(-1);
        //Get events based on the current date
        $result = $this->calender_model->get_booking_detail_list_by_Date($booking_item,$date);
        /*echo json_encode($result);
        exit();*/
        $eventListHTML = '<div style="width:100%">
        <style type="text/css">
          thead td{
            font-weight: bold;
            border:2px solid;

          }
          td{
            text-align: center;
          }
          tbody td{
            border:1px solid;
            padding: 5px;
          }
        </style>
        <table style="width:100%" >
            <thead >
                <td>ID</td>
                <td>Ref. no</td>
                <td>Customer</td>
                <td>Hotel name</td>
                <td>Date</td>
                <td>Total</td>
                <td>Paid</td>
                <td>Remaining</td>
                <td>Status</td>
                <td>Action</td>
            </thead>
            <tbody>';
        for ($b_d=0; $b_d < count($result['all']) ; $b_d++) { 
           /* echo "-----<br>";
            echo $result['all'][$b_d]['booking_id'];
            echo "<br>";
            echo $result['all'][$b_d]['booking_ref_no'];
            echo "-----<br>";*/
            $inv_data = invoiceDetails($result['all'][$b_d]['booking_id'],$result['all'][$b_d]['booking_ref_no']);
           /* echo "<br>";
            echo "<br>";
            
            echo json_encode($inv_data);
            echo "<br>";
            echo "<br>";*/
         $eventListHTML .='
                <tr>
                  <td>'.$inv_data->id.'</td>
                  <td>'.$inv_data->code.'</td>
                  <td>'.$inv_data->userFullName.'</td>
                  <td>'.$inv_data->title.'</td>
                  <td>'.date('m/d/Y',strtotime($inv_data->checkin)).'</td>
                  <td>$'.$inv_data->checkoutTotal.'</td>
                  <td>$'.$inv_data->amountPaid.'</td>
                  <td>$'.number_format($inv_data->checkoutTotal - $inv_data->amountPaid,0).'</td>
                  <td>'.$inv_data->status.'</td>
                  <td>
                        <span class="btn-group">
                          <a class="btn btn-default btn-xcrud btn btn-primary" href="'.base_url().'invoice/?id='.$inv_data->id.'&amp;sessid='.$inv_data->code.'" title="View Invoice" target="_blank"><i class="fa fa-search-plus"></i></a>
                          <a class="btn btn-default btn-xcrud btn btn-warning" href="'.base_url().'admin/bookings/edit/hotels/'.$inv_data->id.'" title="Edit" target="_blank"><i class="fa fa-edit"></i></a>
                          <a class="btn btn-default btn-xcrud btn-danger" href="javascript: delfunc(\''.$inv_data->id.'\',\''.base_url().'/admin/bookings/delBooking\')" title="DELETE" target="_self" id="'.$inv_data->id.'"><i class="fa fa-times"></i></a>
                        </span>
                </td>
                  </tr>';
        }
        //exit();
        $eventListHTML .='
            </tbody>
        </table>
      </div>
    </div>';
    echo $eventListHTML;
    }

    public function getAllMonth($selected = ''){
        $options = '';
        for($i=1;$i<=12;$i++)
        {
            $value = ($i < 10)?'0'.$i:$i;
            $selectedOpt = ($value == $selected)?'selected':'';
            $options .= '<option value="'.$value.'" '.$selectedOpt.' >'.date("F", mktime(0, 0, 0, $i+1, 0, 0)).'</option>';
        }
        return $options;
    }

    function getYearList($selected = ''){
        $options = '';
        for($i=2015;$i<=2025;$i++)
        {
            $selectedOpt = ($i == $selected)?'selected':'';
            $options .= '<option value="'.$i.'" '.$selectedOpt.' >'.$i.'</option>';
        }
        return $options;
    }


}