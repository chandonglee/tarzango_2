<?php

      class Groupbookings_model extends CI_Model {
          private $data = array();

          function __construct() {
      // Call the Model constructor
              parent :: __construct();
              $this->load->model('admin/accounts_model');
              $this->load->model('admin/emails_model');
              
              $this->data['app_settings'] = $this->settings_model->get_settings_data();
              $this->load->helper('invoice');
              $this->load->helper('member');
          }

          function get_all_hotel($type = null) {
            
              $this->db->select('hotel_id,hotel_title,hotel_map_city');
             
              return $this->db->get('pt_hotels')->result();
          }

      // get all bookings
          function get_gbbookings($link_code) {
              $this->db->select('*');
              $this->db->where('link_code', $link_code);
              $query = $this->db->get('pt_group_booking');
              $res = $query->result();
              $data = $res[0];
              
              return $data;
          }

          function update_booking($id) {
            $this->load->model('admin/gb_emails_model');
           /*$refNo = $this->bookings_model->getBookingRefNo($id);

            $bdetails = invoiceDetails($id, $refNo);
            echo json_encode( $bdetails);
            exit(); */

            $hotel_id = $this->input->post('hotel_id');
            $link_gen = $this->input->post('link_gen');
            $link_code = $this->input->post('link_code');
            $pt_group_booking_id = $this->input->post('pt_group_booking_id');

            $status = $this->input->post('status');
            /*echo $status;
            exit();*/
            $data = array(
              'hotel_id' => implode(',', $hotel_id),
              'link_code' => $link_code,
              'link_gen' => $link_gen,
              'status' => $status,
              );
            $this->db->where('pt_group_booking_id',$pt_group_booking_id);
            $this->db->update('pt_group_booking',$data);

           
             if($status == "approved"){
              $details = $this->get_gb_by_id($pt_group_booking_id);
              /*echo json_encode($details);
              exit();*/
              $this->gb_emails_model->gb_sendEmail_customer($details);
             /* echo json_encode($this->input->post());
              exit();*/
              /*echo json_encode($invoicedetails);
              exit();*/
              /*$this->gb_emails_model->gb_sendEmail_customer($invoicedetails,$this->data['app_settings'][0]->site_title);
              $this->gb_emails_model->gb_sendEmail_admin($invoicedetails,$this->data['app_settings'][0]->site_title);
              $this->gb_emails_model->gb_sendEmail_owner($invoicedetails,$this->data['app_settings'][0]->site_title);*/

             }

          }

          function get_gb_by_id($pt_group_booking_id){
              $this->db->select('*');
              $this->db->where('pt_group_booking_id', $pt_group_booking_id);
              $query = $this->db->get('pt_group_booking');
              $res = $query->result();
              $data = $res[0];
              
              return $data;
          }


      // get all bookings with limit
          function get_all_bookings_back_limit_admin($perpage = null, $offset = null, $orderby = null) {
              if ($offset != null) {
                  $offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
              }
              $this->db->select('pt_bookings.booking_user,pt_bookings.booking_cancellation_request,pt_bookings.booking_id,pt_bookings.booking_type,pt_bookings.booking_expiry,pt_bookings.booking_ref_no,
              pt_bookings.booking_status,pt_bookings.booking_item,pt_bookings.booking_item_title,
              booking_total,pt_bookings.booking_deposit,pt_bookings.booking_date,pt_accounts.ai_first_name,pt_accounts.ai_last_name,pt_accounts.accounts_email');
              $this->db->join('pt_accounts', 'pt_bookings.booking_user = pt_accounts.accounts_id', 'left');
              $this->db->order_by('pt_bookings.booking_id', 'desc');
              $query = $this->db->get('pt_bookings', $perpage, $offset);
              $data['all'] = $query->result();
      // $data['nums'] = $query->num_rows();
              return $data;
          }

      // get all bookings info  by search for admin
          function search_all_bookings_back_limit_admin($term, $perpage = null, $offset = null, $orderby = null) {
              if ($offset != null) {
                  $offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
              }
              $this->db->select('pt_bookings.booking_user,pt_bookings.booking_cancellation_request,pt_bookings.booking_id,pt_bookings.booking_type,pt_bookings.booking_expiry,pt_bookings.booking_ref_no,
              pt_bookings.booking_status,pt_bookings.booking_item,pt_bookings.booking_item_title,
              booking_total,pt_bookings.booking_deposit,pt_bookings.booking_date,pt_accounts.ai_first_name,pt_accounts.ai_last_name,pt_accounts.accounts_email');
              $this->db->like('pt_bookings.booking_type', $term);
              $this->db->or_like('pt_bookings.booking_id', $term);
              $this->db->or_like('pt_accounts.ai_first_name', $term);
              $this->db->or_like('pt_accounts.ai_last_name', $term);
              $this->db->join('pt_accounts', 'pt_bookings.booking_user = pt_accounts.accounts_id', 'left');
              $this->db->order_by('pt_bookings.booking_id', 'desc');
              $query = $this->db->get('pt_bookings', $perpage, $offset);
              $data['all'] = $query->result();
              $data['nums'] = $query->num_rows();
              return $data;
          }

      // get all bookings info  by advance search for admin
          function adv_search_all_bookings_back_limit_admin($data, $perpage = null, $offset = null, $orderby = null) {
              $invoice = $data["invoiceno"];
              $invoicefromdate = $data["invoicefromdate"];
              $invoicetodate = $data["invoicetodate"];
              $status = $data["status"];
              $customername = $data["customername"];
              $module = $data["module"];
              if ($offset != null) {
                  $offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
              }
              $this->db->select('pt_bookings.booking_user,pt_bookings.booking_cancellation_request,pt_bookings.booking_id,pt_bookings.booking_type,pt_bookings.booking_expiry,pt_bookings.booking_ref_no,
              pt_bookings.booking_status,pt_bookings.booking_item,pt_bookings.booking_item_title,
              booking_total,pt_bookings.booking_deposit,pt_bookings.booking_date,pt_accounts.ai_first_name,pt_accounts.ai_last_name,pt_accounts.accounts_email');
              if (!empty ($invoice)) {
                  $this->db->where('pt_bookings.booking_id', $invoice);
              }
              if (!empty ($module)) {
                  $this->db->where('pt_bookings.booking_type', $module);
              }
              if (!empty ($status)) {
                  $this->db->where('pt_bookings.booking_status', $status);
              }
              if (!empty ($customername)) {
                  $this->db->like('pt_accounts.ai_first_name', $customername);
                  $this->db->or_like('pt_accounts.ai_last_name', $customername);
              }
              if (!empty ($invoicefromdate)) {
                  $this->db->where('pt_bookings.booking_date >=', $invoicefromdate);
                  $this->db->where('pt_bookings.booking_date <=', $invoicetodate);
              }
              $this->db->join('pt_accounts', 'pt_bookings.booking_user = pt_accounts.accounts_id', 'left');
              $this->db->order_by('pt_bookings.booking_id', 'desc');
              $query = $this->db->get('pt_bookings', $perpage, $offset);
              $data['all'] = $query->result();
              $data['nums'] = $query->num_rows();
              return $data;
          }

      // Get supplier's bookings
          function supplier_get_all_bookings($myitems) {
              $this->db->select('pt_bookings.booking_user,pt_bookings.booking_cancellation_request,pt_bookings.booking_id,pt_bookings.booking_type,pt_bookings.booking_expiry,pt_bookings.booking_ref_no,
              pt_bookings.booking_status,pt_bookings.booking_item,pt_bookings.booking_item_title,
              booking_total,pt_bookings.booking_deposit,pt_bookings.booking_date,pt_accounts.ai_first_name,pt_accounts.ai_last_name,pt_accounts.accounts_email');
              if (!empty ($myitems)) {
                  $this->db->where_in('pt_bookings.booking_item', $myitems);
              }
              else {
                  $this->db->where('pt_bookings.booking_item', 0);
              }
              $this->db->join('pt_accounts', 'pt_bookings.booking_user = pt_accounts.accounts_id', 'left');
              $this->db->order_by('pt_bookings.booking_id', 'desc');
              $query = $this->db->get('pt_bookings');
              $data['all'] = $query->result();
              $data['nums'] = $query->num_rows();
              return $data;
          }

      // Get supplier's bookings in limit
          function supplier_get_all_bookings_limit($myitems, $perpage = null, $offset = null, $orderby = null) {
              if ($offset != null) {
                  $offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
              }
              $this->db->select('pt_bookings.booking_user,pt_bookings.booking_cancellation_request,pt_bookings.booking_id,pt_bookings.booking_type,pt_bookings.booking_expiry,pt_bookings.booking_ref_no,
              pt_bookings.booking_status,pt_bookings.booking_item,pt_bookings.booking_item_title,
              booking_total,pt_bookings.booking_deposit,pt_bookings.booking_date,pt_accounts.ai_first_name,pt_accounts.ai_last_name,pt_accounts.accounts_email');
              if (!empty ($myitems)) {
                  $this->db->where_in('pt_bookings.booking_item', $myitems);
              }
              else {
                  $this->db->where('pt_bookings.booking_item', 0);
              }
              $this->db->join('pt_accounts', 'pt_bookings.booking_user = pt_accounts.accounts_id', 'left');
              $this->db->order_by('pt_bookings.booking_id', 'desc');
              $query = $this->db->get('pt_bookings', $perpage, $offset);
              $data['all'] = $query->result();
              $data['nums'] = $query->num_rows();
              return $data;
          }

      // get all bookings info  by search for admin
          function search_all_bookings_back_limit_supplier($term, $myitems, $perpage = null, $offset = null, $orderby = null) {
              if ($offset != null) {
                  $offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
              }
              $this->db->select('pt_bookings.booking_user,pt_bookings.booking_cancellation_request,pt_bookings.booking_id,pt_bookings.booking_type,pt_bookings.booking_expiry,pt_bookings.booking_ref_no,
              pt_bookings.booking_status,pt_bookings.booking_item,pt_bookings.booking_item_title,
              booking_total,pt_bookings.booking_deposit,pt_bookings.booking_date,pt_accounts.ai_first_name,pt_accounts.ai_last_name,pt_accounts.accounts_email');
              $this->db->like('pt_bookings.booking_type', $term);
              $this->db->or_like('pt_bookings.booking_id', $term);
              $this->db->or_like('pt_accounts.ai_first_name', $term);
              $this->db->or_like('pt_accounts.ai_last_name', $term);
              if (!empty ($myitems)) {
                  $this->db->where_in('pt_bookings.booking_item', $myitems);
              }
              else {
                  $this->db->where('pt_bookings.booking_item', 0);
              }
              $this->db->join('pt_accounts', 'pt_bookings.booking_user = pt_accounts.accounts_id', 'left');
              $this->db->order_by('pt_bookings.booking_id', 'desc');
              $query = $this->db->get('pt_bookings', $perpage, $offset);
              $data['all'] = $query->result();
              $data['nums'] = $query->num_rows();
              return $data;
          }

      // get all bookings info  by advance search for admin
          function adv_search_all_bookings_back_limit_supplier($data, $myitems, $perpage = null, $offset = null, $orderby = null) {
              $invoice = $data["invoiceno"];
              $invoicefromdate = $data["invoicefromdate"];
              $invoicetodate = $data["invoicetodate"];
              $status = $data["status"];
              $customername = $data["customername"];
              $module = $data["module"];
              if ($offset != null) {
                  $offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
              }
              $this->db->select('pt_bookings.booking_user,pt_bookings.booking_cancellation_request,pt_bookings.booking_id,pt_bookings.booking_type,pt_bookings.booking_expiry,pt_bookings.booking_ref_no,
                pt_bookings.booking_status,pt_bookings.booking_item,pt_bookings.booking_item_title,
                booking_total,pt_bookings.booking_deposit,pt_bookings.booking_date,pt_accounts.ai_first_name,pt_accounts.ai_last_name,pt_accounts.accounts_email');
              if (!empty ($invoice)) {
                  $this->db->where('pt_bookings.booking_id', $invoice);
              }
              if (!empty ($module)) {
                  $this->db->where('pt_bookings.booking_type', $module);
              }
              if (!empty ($status)) {
                  $this->db->where('pt_bookings.booking_status', $status);
              }
              if (!empty ($customername)) {
                  $this->db->like('pt_accounts.ai_first_name', $customername);
                  $this->db->or_like('pt_accounts.ai_last_name', $customername);
              }
              if (!empty ($invoicefromdate)) {
                  $this->db->where('pt_bookings.booking_date >=', $invoicefromdate);
                  $this->db->where('pt_bookings.booking_date <=', $invoicetodate);
              }
              if (!empty ($myitems)) {
                  $this->db->where_in('pt_bookings.booking_item', $myitems);
              }
              else {
                  $this->db->where('pt_bookings.booking_item', 0);
              }
              $this->db->join('pt_accounts', 'pt_bookings.booking_user = pt_accounts.accounts_id', 'left');
              $this->db->order_by('pt_bookings.booking_id', 'desc');
              $query = $this->db->get('pt_bookings', $perpage, $offset);
              $data['all'] = $query->result();
              $data['nums'] = $query->num_rows();
              return $data;
          }

          function do_login_booking($username, $password) {
              $login = $this->accounts_model->login_customer($username, $password);
              if ($login) {
                  $userid = $this->session->userdata('pt_logged_customer');
                  return $this->do_booking($userid);
              }
              else {
                  $bookingResult = array("error" => "yes", 'msg' => 'Invalid Email or Password');
                  return $bookingResult;
              }
          }

          function check_login_user_for_member($username, $password) {
              $login = $this->accounts_model->login_member_customer($username, $password);
              if ($login) {
                  $bookingResult = array("error" => "no", 'msg' => $login);
                  return $bookingResult;
              }
              else {
                  $bookingResult = array("error" => "yes", 'msg' => 'Invalid Email or Password');
                  return $bookingResult;
              }
          }

          function do_customer_booking() {
             
              //$this->load->helper('member');
             
              $userid = $this->accounts_model->signup_account('customers', '1');
              add_member($userid);

              return $this->do_booking($userid);
          }

          function doGuestBooking($bookquick = null) {
              $userid = $this->accounts_model->signup_account('guest', '0');
            
              if(empty($bookquick)){
                return $this->do_booking($userid);
              }else{
                return $this->doQuickBooking($userid);
              }
              
          }



          function do_booking($userid) {
           
              $is_member = check_is_member($userid);
              
              $error = true;
              $this->load->library('currconverter');
              $itemid = $this->input->post('itemid');
              $roomid = $this->input->post('subitemid');
              $checkin = $this->input->post('checkin');
              $checkout = $this->input->post('checkout');
              $roomscount = $this->input->post('roomscount');
              $booking_additional_notes = $this->input->post('booking_additional_notes');
              $bookingtype = $this->input->post('btype');
              $extras = $this->input->post('extras');
              $extrabeds = $this->input->post('bedscount');
              $passportInfo = "";
              if ($bookingtype == "hotels") {
                  $this->load->library('hotels/hotels_lib');
                  $bookingData = json_decode($this->hotels_lib->getUpdatedDataBookResultObject($itemid, $roomid, $checkin, $checkout, $roomscount, $extras, $extrabeds));
                  if ($bookingData->stay < 1) {
                      $error = true;
                  }
                  else {
                      $error = false;
                  }
              }elseif($bookingtype == "tours"){
                $passportInfo = json_encode($this->input->post('passport'));
                $adults = $this->input->post('adults');
                $child = $this->input->post('children');
                $infant = $this->input->post('infant');

                $apiDate = $this->input->post('tdate'); 
                if(empty($apiDate)){
                  $checkin = $this->input->post('date'); 
                  $checkout = $this->input->post('date');

                  if(empty($checkin)){
                   $checkin = $this->input->post('checkin');
                   $checkout = $this->input->post('checkin');  
                  }

                }else{
                  $checkin = date($this->data['app_settings'][0]->date_f, strtotime($apiDate));
                  $checkout = date($this->data['app_settings'][0]->date_f, strtotime($apiDate));


                }              
               
               

                  $this->load->library('tours/tours_lib');
                  $bookingData = json_decode($this->tours_lib->getUpdatedDataBookResultObject($itemid, $adults,$child,$infant,$extras));
                  $error = false;    
              
              }elseif($bookingtype == "cars"){

                $apiDate = $this->input->post('cdate'); 
                if(empty($apiDate)){

                  $checkin =  $this->input->post('pickupDate');
                  $checkout =  $this->input->post('dropoffDate');


                }else{
                  $checkin = date($this->data['app_settings'][0]->date_f, strtotime($apiDate));
                  $checkout = date($this->data['app_settings'][0]->date_f, strtotime($apiDate));


                }
                
                $pickup = $this->input->post('pickuplocation');
                $drop = $this->input->post('dropofflocation');
                $pickuptime = $this->input->post('pickupTime');
                $pickupdate = $this->input->post('pickupDate');
                $dropdate = $this->input->post('dropoffDate');
                $droptime = $this->input->post('dropoffTime');
               

                  $this->load->library('cars/cars_lib');
                  $bookingData = json_decode($this->cars_lib->getUpdatedDataBookResultObject($itemid,$extras,$pickup,$drop,$pickupdate,$dropdate));
                  $error = false;    
              }

   

             // $grandtotal = $this->currconverter->convertPriceFloat($bookingData->grandTotal);
              $grandtotal = $this->currconverter->removeComma($bookingData->grandTotal);
              $checkin = databaseDate($checkin);
              $checkout = databaseDate($checkout);
              //$deposit = $this->currconverter->convertPriceFloat($bookingData->depositAmount);
              $deposit = $this->currconverter->removeComma($bookingData->depositAmount);
              $tax = $this->currconverter->removeComma($bookingData->taxAmount);
              $paymethodfee = 0;
              //$this->currconverter->convertPriceFloat($bookingData->paymethodFee);
              $extrasTotalFee = $this->currconverter->removeComma($bookingData->extrasInfo->extrasTotalFee);
              $currCode = $bookingData->currCode;
              $currSymbol = $bookingData->currSymbol;
              $subitem = json_encode($bookingData->subitem);
              $extras = json_encode($bookingData->extrasInfo->extrasIndividualFee);
              $adults = $this->input->post('adults');
              $child = $this->input->post('children');
              $stay = $bookingData->stay;
              $extrabedscharges = $this->currconverter->removeComma($bookingData->extraBedCharges);
              $refno = random_string('numeric', 5);
              $expiry = $this->data['app_settings'][0]->booking_expiry * 86400;

              $couponRate = 0;
              $couponCode = 0;

              $coupon = $this->input->post('couponid');
              if($coupon > 0){
                
                $cResult = pt_applyCouponDiscount($coupon, $grandtotal);
                $cResultDeposit = pt_applyCouponDiscount($coupon, $deposit);
                $cResultTax = pt_applyCouponDiscount($coupon, $tax);
                
                $couponRate = $cResult->value;
                $couponCode = $cResult->code;

                $grandtotal = $cResult->amount;
                $deposit = $cResultDeposit->amount;
                $tax = $cResultTax->amount;


                $this->updateCoupon($coupon);

              }

              
              if($is_member[0]->accounts_id == $userid){
                $book_main_price = $grandtotal;
                $grandtotal = $grandtotal - ($grandtotal * 10 / 100);
              }

              if (!$error) {
                  $data = array('booking_ref_no' => $refno, 'booking_type' => $bookingtype, 'booking_item' => $itemid, 'booking_subitem' => $subitem, 'booking_extras' => $extras, 'booking_date' => time(), 'booking_expiry' => time() + $expiry, 'booking_user' => $userid, 'booking_status' => 'unpaid', 'booking_additional_notes' => $this->input->post('booking_additional_notes'), 'booking_total' => $grandtotal, 'booking_remaining' => $grandtotal, 'booking_checkin' => $checkin, 'booking_checkout' => $checkout, 'booking_nights' => $stay, 'booking_adults' => $adults, 'booking_child' => $child,
                  //    'booking_payment_type' => $paymethod,
                  'booking_deposit' => $grandtotal, 'booking_tax' => $tax, 'booking_paymethod_tax' => $paymethodfee, 'booking_extras_total_fee' => $extrasTotalFee, 'booking_curr_code' => $currCode, 'booking_curr_symbol' => $currSymbol, 'booking_extra_beds' => $extrabeds, 'booking_extra_beds_charges' => $extrabedscharges, 'booking_coupon_rate' => $couponRate, 'booking_coupon' => $couponCode, 'booking_guest_info' => $passportInfo);
                  $this->db->insert('pt_bookings', $data);
                  $bookid = $this->db->insert_id();
                  $this->session->set_userdata("BOOKING_ID", $bookid);
                  $this->session->set_userdata("REF_NO", $refno);
                 
                  if ($bookingtype == "hotels") {
                      $rdata = array('booked_booking_id' => $bookid, 'booked_room_id' => $bookingData->subitem->id, 'booked_room_count' => $bookingData->subitem->count, 'booked_checkin' => $checkin, 'booked_checkout' => $checkout, 'booked_booking_status' => 'unpaid');
                      $this->db->insert('pt_booked_rooms', $rdata);
                  }
                  elseif ($bookingtype == "cars") {
                      $cdata = array('booked_booking_id' => $bookid, 'booked_car_id' =>  $itemid, 'booked_pickupdate' => $checkin, 'booked_pickuptime' => $pickuptime, 'booked_pickuplocation' => $pickup, 'booked_dropofflocation' => $drop,'booked_dropoffDate' => databaseDate($dropdate), 'booked_dropoffTime' => $droptime, 'booked_booking_status' => 'unpaid');
                      $this->db->insert('pt_booked_cars', $cdata);
                  }


                  if($is_member[0]->accounts_id == $userid){
                    $grandtotal = $grandtotal - ($grandtotal * 10 / 100);
                    $pickup['location'] = $this->input->post('pickup_location');
                    $pickup['time'] = $this->input->post('pickup_time');
                    $pickup['book_main_price'] = $book_main_price;
                    $pickup['discount_price'] = $grandtotal;
                    add_pickup_detail($bookid,json_encode($pickup));
                  }


                  $url = base_url() . 'invoice?id=' . $bookid . '&sessid=' . $refno;
                  $bookingResult = array("error" => "no", 'msg' => '', 'url' => $url);
                  $invoicedetails = invoiceDetails($bookid,$refno);

                  /*$this->emails_model->sendEmail_customer($invoicedetails,$this->data['app_settings'][0]->site_title);
                  $this->emails_model->sendEmail_admin($invoicedetails,$this->data['app_settings'][0]->site_title);
                  $this->emails_model->sendEmail_owner($invoicedetails,$this->data['app_settings'][0]->site_title);
                  $this->emails_model->sendEmail_supplier($invoicedetails,$this->data['app_settings'][0]->site_title);*/
      
              }
              else {
                  $bookingResult = array("error" => "yes", 'msg' => 'Error occured');
              }

              return $bookingResult;
          }

          function createDateRangeArray($strDateFrom,$strDateTo){
              // takes two dates formatted as YYYY-MM-DD and creates an
              // inclusive array of the dates between the from and to dates.

              // could test validity of dates here but I'm already doing
              // that in the main script

              $aryRange=array();

              $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
              $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

              if ($iDateTo>=$iDateFrom)
              {
                  array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
                  while ($iDateFrom<$iDateTo)
                  {
                      $iDateFrom+=86400; // add 24 hours
                      array_push($aryRange,date('Y-m-d',$iDateFrom));
                  }
              }
              return $aryRange;
          }


//Do quick booking by admin
          function doQuickBooking($userid){

  
              $this->load->library('currconverter');
              $itemid = $this->input->post('itemid');
              $subitemid = $this->input->post('subitemid');
              $roomscount = $this->input->post('roomscount');
              $bookingtype = $this->input->post('btype');
              $quickDeposit = $this->input->post('quickDeposit');
              $extras = $this->input->post('extras');
              $perNight = $this->input->post('perNight');
              $grandtotal = $this->input->post('grandtotal');
              $booking_additional_notes = $this->input->post('booking_additional_notes');
              $stay = $this->input->post('stay');

              $expiry = $this->data['app_settings'][0]->booking_expiry * 86400;
              $paymethodfee = 0;



              $extrabeds = 0;//$this->input->post('bedscount');

              if ($bookingtype == "hotels") {
                  $this->load->library('hotels/hotels_lib');
                  $extrasInfo = $this->hotels_lib->extrasFee($extras); 
                  $extrasData = json_encode($extrasInfo['extrasIndividualFee']);
                  $subitemData = json_encode(array("id" => $subitemid, "price" => $perNight,"count" => $roomscount));
                                    
              }elseif($bookingtype == "tours"){
                $adults = $this->input->post('adults');
                $child = $this->input->post('children');
                $infant = $this->input->post('infants');
       
                 
                  /* $checkin = $this->input->post('checkin');
                   $checkout = $this->input->post('checkin');  
                        */
               

                  $this->load->library('tours/tours_lib');
                  $extrasInfo = $this->tours_lib->extrasFee($extras); 
                  $extrasData = json_encode($extrasInfo['extrasIndividualFee']);
                  $bookingData = json_decode($this->tours_lib->getUpdatedDataBookResultObject($itemid, $adults,$child,$infant,$extras));
                  $subitemData = json_encode($bookingData->subitem);
              }elseif($bookingtype == "cars"){
             

                  $this->load->library('cars/cars_lib');
                  $extrasInfo = $this->cars_lib->extrasFee($extras); 
                  $extrasData = json_encode($extrasInfo['extrasIndividualFee']);
                  $bookingData = json_decode($this->cars_lib->getUpdatedDataBookResultObject($itemid,$extras));
                  $subitemData = json_encode($bookingData->subitem);
              }
              
              $checkin = databaseDate($this->input->post('checkin'));
              $checkout = databaseDate($this->input->post('checkout'));
              $tax = $this->input->post('taxamount');
           
              $extrasTotalFee = $this->input->post('totalsupamount');

              $currCode = $this->input->post('currencycode');
              $currSymbol = $this->input->post('currencysign');
              
              $extrabedscharges = 0;//$this->currconverter->convertPriceFloat($bookingData->extraBedCharges);
              $refno = random_string('numeric', 5);

                  $data = array('booking_ref_no' => $refno, 'booking_type' => $bookingtype, 
                    'booking_item' => $itemid, 
                    'booking_subitem' => $subitemData, 
                    'booking_extras' => $extrasData, 'booking_date' => time(), 
                    'booking_expiry' => time() + $expiry, 'booking_user' => $userid, 
                    'booking_status' => 'unpaid', 
                    'booking_additional_notes' => $booking_additional_notes, 
                    'booking_total' => $grandtotal, 
                    'booking_remaining' => $grandtotal, 
                    'booking_checkin' => $checkin, 
                    'booking_checkout' => $checkout, 
                    'booking_nights' => $stay, 
                    'booking_adults' => '1', 
                    'booking_child' => '0',
                   'booking_payment_type' => $this->input->post('paymethod'),
                  'booking_deposit' => $quickDeposit, 
                  'booking_tax' => $tax, 
                  'booking_paymethod_tax' => $paymethodfee, 
                  'booking_extras_total_fee' => $extrasTotalFee, 
                  'booking_curr_code' => $currCode, 
                  'booking_curr_symbol' => $currSymbol, 
                  'booking_extra_beds' => $extrabeds, 
                  'booking_extra_beds_charges' => $extrabedscharges
                  );

                  $this->db->insert('pt_bookings', $data);
                  $bookid = $this->db->insert_id();
                  
                 

                  if ($bookingtype == "hotels") {
                      $rdata = array('booked_booking_id' => $bookid, 'booked_room_id' => $subitemid, 'booked_room_count' => $roomscount, 'booked_checkin' => $checkin, 'booked_checkout' => $checkout, 'booked_booking_status' => 'unpaid');
                      $this->db->insert('pt_booked_rooms', $rdata);
                  }
                  elseif ($bookingtype == "cars") {
                      $cdata = array('booked_booking_id' => $bookid, 'booked_car_id' => $this->input->post('itemid'), 'booked_checkin' => convert_to_unix($checkin), 'booked_checkout' => convert_to_unix($checkout), 'booked_booking_status' => 'unpaid');
                      $this->db->insert('pt_booked_cars', $cdata);
                  }
                 
              $invoicedetails = invoiceDetails($bookid,$refno);

              $this->emails_model->sendEmail_customer($invoicedetails,$this->data['app_settings'][0]->site_title);
              $this->emails_model->sendEmail_supplier($invoicedetails,$this->data['app_settings'][0]->site_title);
              $this->emails_model->sendEmail_admin($invoicedetails,$this->data['app_settings'][0]->site_title);
              $this->emails_model->sendEmail_owner($invoicedetails,$this->data['app_settings'][0]->site_title);
              
              $url = base_url() . 'invoice?id=' . $bookid . '&sessid=' . $refno;
              $bookingResult = array("error" => "no", 'msg' => '', 'url' => $url);

              return $bookingResult;

          }

          function update_ava_in_room($checkin,$checkout,$room_id,$room_count){
            $checkin_main = $checkin;
             /*echo "<br>";*/
              $checkout_main = $checkout;
             /*echo "<br>";*/

              $all_dates = $this->createDateRangeArray($checkin_main,$checkout_main);
              /*print_r($all_dates);*/
             /*echo "<br>--------<br>";*/
             for ($d_l=0; $d_l < count($all_dates) ; $d_l++) { 
              $date = DateTime::createFromFormat("Y-m-d", $all_dates[$d_l]);
              $date_current_day =  $date->format("d");
              /*echo "-";*/
              $date_current_month =  $date->format("m");
              /*echo "-";*/
              $date_current_year =  $date->format("Y");

              $current_year = date("Y");


              if($current_year == $date_current_year){
                $is_currnt_year = 0;
              }else{
                $is_currnt_year = 1;

              }
              /*echo $is_currnt_year;*/

              $ava_room_id = $room_id;
              $ava_room_count = $room_count;
              //echo $is_currnt_year =  $date->format("m");
                  
                  //print_r($abc);
              /*echo "--------";
                    
             echo "<br>";*/
             /*echo 'UPDATE pt_rooms_availabilities SET d'.$date_current_day.' = d'.$date_current_day.' - '.$ava_room_count.' where y = '.$is_currnt_year.' and m = '.$date_current_month .' and room_id = '.$ava_room_id;*/
              /*echo "<br>";*/
            
                    $this->db->query('UPDATE pt_rooms_availabilities SET d'.$date_current_day.' = d'.$date_current_day.' - '.$ava_room_count.' where y = '.$is_currnt_year.' and m = '.$date_current_month.' and room_id = '.$ava_room_id);
                    /*echo $this->db->last_query();
                    echo "<br>";
                    echo $this->db->affected_rows();
                    echo "--------";
                    echo "<br>";*/
                    /*$data_for_update_room = array(
                                'd'.$date_current_day => 'd'.$date_current_day.'-'.$ava_room_count,
                                );
                    $this->db->where('y',$is_currnt_year);
                    $this->db->where('m',$date_current_month);
                    $this->db->update('pt_rooms_availabilities',$data_for_update_room);
                    echo $this->db->last_query();*/
             }
                    //exit();
              /*             echo "<br>";
                           echo "<br>";
              echo json_encode($bookingData);
              exit();*/
          }

          function update_ava_in_room_can($checkin,$checkout,$room_id,$room_count){
            $checkin_main = $checkin;
             /*echo "<br>";*/
              $checkout_main = $checkout;
             /*echo "<br>";*/

              $all_dates = $this->createDateRangeArray($checkin_main,$checkout_main);
              /*print_r($all_dates);*/
             /*echo "<br>--------<br>";*/
             for ($d_l=0; $d_l < count($all_dates) ; $d_l++) { 
              $date = DateTime::createFromFormat("Y-m-d", $all_dates[$d_l]);
              $date_current_day =  $date->format("d");
              
              $date_current_month =  $date->format("m");
              
              $date_current_year =  $date->format("Y");

              $current_year = date("Y");


              if($current_year == $date_current_year){
                $is_currnt_year = 0;
              }else{
                $is_currnt_year = 1;

              }

              $ava_room_id = $room_id;
              $ava_room_count = $room_count;
            
              $this->db->query('UPDATE pt_rooms_availabilities SET d'.$date_current_day.' = d'.$date_current_day.' + '.$ava_room_count.' where y = '.$is_currnt_year.' and m = '.$date_current_month.' and room_id = '.$ava_room_id);
              
             }

          }

      //Update booking details
          
          function delete_booking($id) {
              $this->db->where('booking_id', $id);
              $this->db->delete('pt_bookings');
              $this->db->where('booked_booking_id', $id);
              $this->db->delete('pt_booked_rooms');
              $this->db->where('review_booking_id', $id);
              $this->db->delete('pt_reviews');
              $this->db->where('booked_booking_id', $id);
              $this->db->delete('pt_booked_cars');
          }

          function cancel_booking($id) {
              $updata = array('booking_status' => 'cancelled');
              $this->db->where('booking_id', $id);
              $this->db->update('pt_bookings', $updata);
              $this->db->where('booked_booking_id', $id);
              $this->db->delete('pt_booked_rooms');
              $this->db->where('booked_booking_id', $id);
              $this->db->delete('pt_booked_cars');
              $this->db->where('review_booking_id', $id);
              $this->db->delete('pt_reviews');
          }

      // change booking status to paid
          function booking_status_paid($id) {
              $this->db->select('booking_total,booking_deposit,booking_type');
              $this->db->where('booking_id', $id);
              $bk = $this->db->get('pt_bookings')->result();
              $btotal = $bk[0]->booking_total;
              $bdep = $bk[0]->booking_deposit;
              $btype = $bk[0]->booking_type;
              $data1 = array('booking_status' => 'paid', 'booking_amount_paid' => $bdep, 'booking_remaining' => $btotal - $bdep, 'booking_payment_date' => time());
              $this->db->where('booking_id', $id);
              $this->db->update('pt_bookings', $data1);
              if ($btype == "hotels") {
                  $data2 = array('booked_booking_status' => 'paid');
                  $this->db->where('booked_booking_id', $id);
                  $this->db->update('pt_booked_rooms', $data2);
              }
              elseif ($btype == "cruises") {
                  $data2 = array('booked_booking_status' => 'paid');
                  $this->db->where('booked_booking_id', $id);
                  $this->db->update('pt_booked_cruise_rooms', $data2);
              }
              elseif ($btype == "cars") {
                  $data3 = array('booked_booking_status' => 'paid');
                  $this->db->where('booked_booking_id', $id);
                  $this->db->update('pt_booked_cars', $data3);
              }
          }

      // change booking status to unpaid
          function booking_status_unpaid($id) {
              $this->db->select('booking_total,booking_deposit,booking_type');
              $this->db->where('booking_id', $id);
              $bk = $this->db->get('pt_bookings')->result();
              $btotal = $bk[0]->booking_total;
              $bdep = $bk[0]->booking_deposit;
              $btype = $bk[0]->booking_type;
              $data1 = array('booking_status' => 'unpaid', 'booking_amount_paid' => 0, 'booking_remaining' => $btotal,);
              $this->db->where('booking_id', $id);
              $this->db->update('pt_bookings', $data1);
              if ($btype == "hotels") {
                  $data2 = array('booked_booking_status' => 'unpaid');
                  $this->db->where('booked_booking_id', $id);
                  $this->db->update('pt_booked_rooms', $data2);
              }
              elseif ($btype == "cruises") {
                  $data2 = array('booked_booking_status' => 'unpaid');
                  $this->db->where('booked_booking_id', $id);
                  $this->db->update('pt_booked_cruise_rooms', $data2);
              }
              elseif ($btype == "cars") {
                  $data3 = array('booked_booking_status' => 'unpaid');
                  $this->db->where('booked_booking_id', $id);
                  $this->db->update('pt_booked_cars', $data3);
              }
          }

          function cancel_booking_approve($id) {
      // delete booking and send email
              $useremail = $this->userinfo_by_bookingid($id);
              $this->emails_model->booking_approve_cancellation_email($useremail);
              $this->cancel_booking($id);
      //  $this->delete_booking($id);
          }

          function cancel_booking_reject($id) {
              $data = array('booking_cancellation_request' => '2');
              $this->db->where('booking_id', $id);
              $this->db->update('pt_bookings', $data);
              $useremail = $this->userinfo_by_bookingid($id);
              $this->emails_model->booking_reject_cancellation_email($useremail, $id);
          }

          function userinfo_by_bookingid($id) {
              $this->db->select('booking_user');
              $this->db->where('booking_id', $id);
              $res = $this->db->get('pt_bookings')->result();
              $user = $res[0]->booking_user;
              $uemail = $this->accounts_model->get_user_email($user);
              return $uemail;
          }

          function get_booking_details_by_id($id) {
              $this->db->where('booking_id', $id);
              return $this->db->get('pt_bookings')->result();
          }

          function getBookingRefNo($id) {
              $this->db->select('*');
              $this->db->where('pt_group_booking_id', $id);
              $res = $this->db->get('pt_group_booking')->result();
              return $res[0];
          }

          function bookingShortInfo($id){
            $this->db->select('booking_ref_no,booking_deposit,booking_type,booking_total,booking_deposit');
            $this->db->where('booking_id',$id);
            return $this->db->get('pt_bookings')->result();
          }

          function updateCoupon($couponid){

              $this->db->where('id',$couponid);
              $res = $this->db->get('pt_coupons')->result();
              $uses = $res[0]->uses + 1;

              $data = array(
                'uses' => $uses
                );
              $this->db->where('id',$couponid);

              $this->db->update('pt_coupons',$data);

          }
		  
		  function getHotelsList() {
              $this->db->select('hotel_id,hotel_title');
              $res = $this->db->get('pt_hotels')->result();
              return $res;
          }

      }
