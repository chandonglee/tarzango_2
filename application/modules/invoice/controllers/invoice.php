<?php
header('Access-Control-Allow-Origin: *');

class Invoice extends MX_Controller {
		private $data = array();

		function __construct() {
			//error_reporting(E_ALL);
				parent :: __construct();
				modules :: load('home');
				$this->load->helper("member");
				$this->data['phone'] = $this->load->get_var('phone');
				$this->data['app_settings'] = $this->settings_model->get_settings_data();
				$this->data['errormsg'] = $this->session->flashdata("invoiceerror");
				$this->data['lang_set'] = $this->session->userdata('set_lang');
				$this->data['usersession'] = $this->session->userdata('pt_logged_customer');
				$defaultlang = pt_get_default_language();
				if (empty ($this->data['lang_set'])) {
						$this->data['lang_set'] = $defaultlang;
				}
				//$this->lang->load("front", $this->data['lang_set']);
//$this->data['geo'] = $this->load->get_var('geolib');
		}



		public function index() {
				/*echo $this->session->userdata('pt_logged_customer');
				exit();*/
				$this->load->helper('invoice');
				$this->data['hideLang'] = "hide";
				$this->data['hideCurr'] = "hide";
				$this->data['hidden'] = "hidden-sm hidden-xs";
				$bookingid = $this->input->get('id');
				$bookingref = $this->input->get('sessid');
				$ebookingid = $this->input->get('eid');
				$payerID = $this->input->get('PayerID');
				$token = $this->input->get('token');
				
				$this->data['hideHeader'] = "1";
			
				if (!empty ($ebookingid)) {

						$invoice = pt_get_einvoice_details($ebookingid, $bookingref);
						$invoice = $invoice[0];
						$invoice->Extra_data = json_decode($invoice->extra_data);

						$this->data['invoice'] = $invoice;
						//$this->data['extra_details'] = pt_get_extra_details($ebookingid,'1');

						$book_response = json_decode($this->data['invoice']->book_response);
						/*echo json_encode($book_response);
						exit();*/
						$latitude =  $book_response->hotel->latitude;
						$longitude =  $book_response->hotel->longitude;
						
						$this->data['response'] = json_decode($this->data['invoice']->book_response);
						if (empty ($this->data['invoice'])) {
								redirect(base_url());
						}
						else {
							 $this->lang->load("front", $this->data['lang_set']);
								/* $this->session->set_userdata('checkout_amount', $this->data['invoice'][0]->booking_deposit);
								$this->session->set_userdata('checkout_total', $this->data['invoice'][0]->booking_total);*/
								//$hotel_details_extra = $this->get_extra_details_1($latitude,$longitude);
								/*echo json_encode($hotel_details_extra);
								exit();*/
								//$this->data['invoice'][0]->hotel_details_extra = $hotel_details_extra;

								$contact = $this->settings_model->get_contact_page_details();
								$this->data['contactphone'] = $contact[0]->contact_phone;
								$this->data['contactemail'] = $contact[0]->contact_email;
								$this->data['contact_address'] = $contact[0]->contact_address;
								$this->data['page_title'] = 'Invoice';
								$this->data['page_title_1'] = 'EInvoice';
								//   $this->theme->partial('invoice',$this->data);
								 $this->lang->load("front", $this->data['lang_set']);
								$this->theme->view('admin/modules/global/einvoice', $this->data);
								/*$this->theme->view('admin/modules/global/invoice', $this->data);*/
						}
				}else {

						if (empty ($bookingref) || empty ($bookingid)) {
								$bookingid = $this->session->userdata("BOOKING_ID");
								$bookingref = $this->session->userdata("REF_NO");
						}
						$this->data['invoice'] = invoiceDetails($bookingid, $bookingref);
						/*echo json_encode($this->data['invoice']);
						exit();*/
						//$this->data['extra_details'] = pt_get_extra_details($bookingid,'2');
						$extra_details = get_pickup_detail($bookingid);
            			$this->data['extra_details'] = json_decode($extra_details[0]->extra_data);
						$hotel_id = $this->data['invoice']->itemid;

						$hotel_details_extra = $this->get_extra_details($hotel_id);
						//$this->data['invoice']->hotel_details_extra = $hotel_details_extra;
						
						if (empty ($this->data['invoice']->id)) {
								redirect(base_url());
						}
						else {
							//for paypal express

							if(!empty($token) && !empty($payerID)){
								$this->load->model("admin/bookings_model");
								$gateway = "paypalexpress";
								require_once "./application/modules/gateways/" . $gateway . ".php";
								$this->load->model('admin/payments_model');
								$extraFields  = array('token' => $token, 'payerid' => $payerID);
								$params = $this->payments_model->getGatewayParams($gateway);
								$params['invoiceid'] = $bookingid;
								if (function_exists($gateway . "_verifypayment")) {
								$payResult = call_user_func($gateway . "_verifypayment",$params,$extraFields);
								}

								if($payResult['status'] == "success"){
								$shortInfo = $this->bookings_model->bookingShortInfo($payResult['invoiceid']);

								if($shortInfo[0]->booking_deposit == $payResult['paid']){

								updateInvoiceStatus($payResult['invoiceid'],$payResult['paid'],$payResult['transactionid'],$gateway,"paid", $shortInfo[0]->booking_type,$shortInfo[0]->booking_total);
								$invoicedetails = invoiceDetails($payResult['invoiceid'],$shortInfo[0]->booking_ref_no);

								$this->load->model('admin/emails_model');

								$this->emails_model->paid_sendEmail_customer($invoicedetails);
								$this->emails_model->paid_sendEmail_admin($invoicedetails);
								$this->emails_model->paid_sendEmail_supplier($invoicedetails);
								$this->emails_model->paid_sendEmail_owner($invoicedetails);
								redirect(base_url().'invoice?id='.$bookingid.'&sessid='.$bookingref,'refresh');



								}else{

									echo "Amount is invalid";
									exit;

								}

								}else{
									
									print_r($payResult);
									exit;

								}
								
							}else{

							    $this->lang->load("front", $this->data['lang_set']);

								$this->session->set_userdata('checkout_amount', $this->data['invoice']->checkoutAmount);
								$this->session->set_userdata('checkout_total', $this->data['invoice']->checkoutTotal);
								$contact = $this->settings_model->get_contact_page_details();
								$this->load->model('admin/payments_model');
								$paygateways = $this->payments_model->getAllPaymentsBack();

								if($this->data['invoice'] != "paid"){
								$this->data['msg'] = json_decode($this->payments_model->getGatewayMsg($this->data['invoice']->paymethod,$this->data['invoice']));
								}
								

								$this->data['paymentGateways'] = $paygateways['activeGateways'];
								$this->data['payOnArrival'] = $this->payments_model->payOnArrivalIsActive($paygateways['activeGateways']);
								$singleGateway = $this->payments_model->onlySinglePaymentGatewayActive($paygateways['activeGateways']);
								if($singleGateway['status'] == "yes"){
									
									$this->data['singleGateway'] = $singleGateway['name'];
								
								}else{

									$this->data['singleGateway'] = "";
								}
								//sort on basic of order
								usort($this->data['paymentGateways'], function($a, $b) {
								return $a['order'] - $b['order'];
								});

								$this->data['contactphone'] = $contact[0]->contact_phone;
								$this->data['contactemail'] = $contact[0]->contact_email;
								$this->data['contact_address'] = $contact[0]->contact_address;
								$this->data['page_title'] = 'Invoice';

								$this->theme->view('admin/modules/global/invoice', $this->data);
								//echo print_r($this->data['invoice']); exit;
							}
						}
				}
		}

		function booking_paid_paystand(){

			$abc = $this->input->post();
			//echo json_encode($abc);
			$invoice_id = $this->input->post('invoice_id');
			$invoice_code = $this->input->post('invoice_code');
			$pay_data = $this->input->post('pay_data');
			$order_id = $pay_data['paystand_order']['order_id'];
			
			$booking_total = $pay_data['paystand_order']['merchant_total'];
			
			//print_r($pay_data);
			//print_r($pay_data_1);
			//error_reporting(E_ALL);
			$this->load->helper('invoice');
			updateInvoiceStatus($invoice_id,$booking_total,$order_id,"paystand","paid","hotels",$booking_total);
			$invoicedetails = invoiceDetails($invoice_id,$invoice_code);

			$this->load->model('admin/emails_model');

			$this->emails_model->paid_sendEmail_customer($invoicedetails);
			$this->emails_model->paid_sendEmail_admin($invoicedetails);
			$this->emails_model->paid_sendEmail_supplier($invoicedetails);
			$this->emails_model->paid_sendEmail_owner($invoicedetails);
			redirect(base_url().'invoice?id='.$bookingid.'&sessid='.$bookingref,'refresh');
		}

		function booking_paid_paystand_hb(){

			$abc = $this->input->post();
			//echo json_encode($abc);
			$invoice_id = $this->input->post('invoice_id');
			$invoice_code = $this->input->post('invoice_code');
			$pay_data = $this->input->post('pay_data');
			$order_id = $pay_data['paystand_order']['order_id'];
			
			$booking_total = $pay_data['paystand_order']['merchant_total'];
			
			//print_r($pay_data);
			//print_r($pay_data_1);
			//error_reporting(E_ALL);
			$this->load->helper('invoice');
			updateInvoiceStatus_hb($invoice_id,$booking_total,$order_id,"paystand","paid","hotels",$booking_total);
			$invoicedetails = pt_get_einvoice_details($invoice_id,$invoice_code);

			$this->load->model('admin/emails_model');

			$this->emails_model->paid_sendEmail_customer($invoicedetails);
			$this->emails_model->paid_sendEmail_admin($invoicedetails);
			$this->emails_model->paid_sendEmail_supplier($invoicedetails);
			$this->emails_model->paid_sendEmail_owner($invoicedetails);
			redirect(base_url().'invoice?eid='.$bookingid.'&sessid='.$bookingref,'refresh');
		}

		function add_member(){
			//error_reporting(E_ALL);
			$abc = $this->input->post();
			//echo json_encode($abc);
			$user_id = $this->input->post('user_id');
			$this->load->helper('member');
			$mem_data = check_is_member($user_id);
			//echo $mem_data[0]->accounts_id;
			if($mem_data[0]->accounts_id == $user_id){
				$memberResult = $mem_data;
			}else{
				$memberResult = add_member($user_id);
				
				
			}
			//$member = add_member($user_id);

			return $member;
				
		}

		function send_user_mail_before(){
			
			//print_r($pay_data);
			//print_r($pay_data_1);
			$this->load->model('admin/emails_model');
			/*error_reporting(E_ALL);*/
			$this->load->helper('invoice');
			$data = pt_send_user_mail_before();

			for ($i=0; $i < count($data) ; $i++) { 
				$booking_expiry = $data[$i]->booking_expiry;
				
				$f_date =  date('Y-m-d H:i:s', strtotime('-5 hours', $booking_expiry));
				
				
				$f_date = new DateTime($f_date);
				$end_date = date('Y-m-d H:i:s');
				
				$since_start = $f_date->diff(new DateTime($end_date));
				
				$total_Day_diff =  $since_start->days.' days total<br>';

				if($total_Day_diff < 1){
					
					$total_hours_diff = $since_start->h;
					$total_mins_diff = $since_start->i;

					if($total_hours_diff > 0 && $total_mins_diff > 30){
						
						$invoice_id = $data[$i]->booking_id;
						
						$invoice_code = $data[$i]->booking_ref_no;
						$invoicedetails = invoiceDetails($invoice_id,$invoice_code);

						$this->emails_model->paid_sendEmail_customer($invoicedetails);
						
					}
				}
				//echo "<br>*-------<br>";
			}
				/*exit();
			echo json_encode($data);*/
			/*$invoicedetails = invoiceDetails($invoice_id,$invoice_code);
			
			

			$this->emails_model->paid_sendEmail_customer($invoicedetails);
			$this->emails_model->paid_sendEmail_admin($invoicedetails);
			$this->emails_model->paid_sendEmail_supplier($invoicedetails);
			$this->emails_model->paid_sendEmail_owner($invoicedetails);
			redirect(base_url().'invoice?id='.$bookingid.'&sessid='.$bookingref,'refresh');*/
		}

		function get_extra_details($hotel_id){
			$ptheme = pt_default_theme();
			$this->_config = config_item('theme');
			$uu = $this->_config['url'];
			$site_link = base_url();
			$this->load->helper('settings');
			$res = $this->settings_model->get_contact_page_details();
				$contact_phone = $res[0]->contact_phone;
				$contact_email = $res[0]->contact_email;
				$contact_address = $res[0]->contact_address;

            $footersocials = pt_get_footer_socials();
            /*/
            exit();*/
            foreach ($footersocials as $key => $value) {
             
              	if($value->social_name == 'Facebook'){
            		$fb_link = $value->social_link;
            	}
            	if($value->social_name == 'Twitter'){
            		$tw_link = $value->social_link;
            	}
        	}
        	// echo $hotel_id;
        	$this->db->select('hotel_latitude,hotel_longitude,hotel_desc,hotel_map_city,hotel_stars');
        	$this->db->where('hotel_id', $hotel_id);
        	$query = $this->db->get('pt_hotels');	
        	$hotel_data = $query->result();
        	/*error_reporting(E_ALL);
        	echo json_encode($hotel_data);
        	exit();*/
        	$arrayInfo['checkIn'] = date("m/d/Y", strtotime("+1 days"));
        	$arrayInfo['checkOut'] = date("m/d/Y", strtotime("+2 days"));
        	$arrayInfo['adults'] = '1';
        	$arrayInfo['child'] = '';
        	$arrayInfo['room'] = '1';
    
			$this->load->model('hotels/hotels_model');
			$hotel_latitude = $hotel_data[0]->hotel_latitude;
			$hotel_longitude = $hotel_data[0]->hotel_longitude;
			$hotel_desc = $hotel_data[0]->hotel_desc;
        	
        	$local_hotels = $this->hotels_model->search_hotels_by_lat_lang($hotel_data[0]->hotel_latitude, $hotel_data[0]->hotel_longitude,$arrayInfo);
        	
        	for ($i=0; $i < count($local_hotels['hotels']) ; $i++) { 
        		if($i < 3){
        		 $bb = $local_hotels['hotels'];
        		 $top_hotel[] = $bb[$i];
        		 
	        	} 
	        }


          $final_data['top_hotel'] = $top_hotel;
          $final_data['hotel_latitude'] = $hotel_latitude;
          $final_data['hotel_longitude'] = $hotel_longitude;
          $final_data['hotel_desc'] = $hotel_desc;
          /*exit();*/

          return $final_data;

		}

		function get_extra_details_1($latitude,$longitude){
			$ptheme = pt_default_theme();
			$this->_config = config_item('theme');
			$uu = $this->_config['url'];
			$site_link = base_url();
			$this->load->helper('settings');
			$res = $this->settings_model->get_contact_page_details();
				$contact_phone = $res[0]->contact_phone;
				$contact_email = $res[0]->contact_email;
				$contact_address = $res[0]->contact_address;

            $footersocials = pt_get_footer_socials();
            /*/
            exit();*/
            foreach ($footersocials as $key => $value) {
             
              	if($value->social_name == 'Facebook'){
            		$fb_link = $value->social_link;
            	}
            	if($value->social_name == 'Twitter'){
            		$tw_link = $value->social_link;
            	}
        	}
        	// echo $hotel_id;
        	/*$this->db->select('hotel_latitude,hotel_longitude,hotel_desc,hotel_map_city,hotel_stars');
        	$this->db->where('hotel_id', $hotel_id);
        	$query = $this->db->get('pt_hotels');	
        	$hotel_data = $query->result();*/
        	/*error_reporting(E_ALL);
        	echo json_encode($hotel_data);
        	exit();*/
        	$arrayInfo['checkIn'] = date("m/d/Y", strtotime("+1 days"));
        	$arrayInfo['checkOut'] = date("m/d/Y", strtotime("+2 days"));
        	$arrayInfo['adults'] = '1';
        	$arrayInfo['child'] = '';
        	$arrayInfo['room'] = '1';
    
			$this->load->model('hotels/hotels_model');
			
        	
        	$local_hotels = $this->hotels_model->search_hotels_by_lat_lang($latitude, $longitude,$arrayInfo);
        	
        	for ($i=0; $i < count($local_hotels['hotels']) ; $i++) { 
        		if($i < 3){
        		 $bb = $local_hotels['hotels'];
        		 $top_hotel[] = $bb[$i];
        		 
	        	} 
	        }


          $final_data['top_hotel'] = $top_hotel;
          $final_data['hotel_latitude'] = $hotel_latitude;
          $final_data['hotel_longitude'] = $hotel_longitude;
          $final_data['hotel_desc'] = $hotel_desc;
          /*exit();*/

          return $final_data;

		}
		function validate_coupon() {
				$code = $this->input->post('code');
				$bookingid = $this->input->post('bookingid');
				$this->load->model('admin/coupons_model');
				$resp = $this->coupons_model->validatecoupon($code);
				if ($resp > 0) {
						$amount = $this->session->userdata('checkout_amount');
						$totalpay = $this->session->userdata('checkout_total');
						$alteredamount = $amount * $resp / 100;
						$alteredtotal = $totalpay * $resp / 100;
						$amount = $amount - round($alteredamount, 2);
						$totalpay = $totalpay - round($alteredtotal, 2);
						$data = array('coupon_used' => '1');
						$this->db->where('coupon_code', $code);
						$this->db->update('pt_coupons', $data);
						$data2 = array('booking_deposit' => $amount, 'booking_total' => $totalpay, 'booking_remaining' => $totalpay, 'booking_coupon' => $code, 'booking_coupon_rate' => $resp);
						$this->db->where('booking_id', $bookingid);
						$this->db->update('pt_bookings', $data2);
						echo $resp;
				}
				else {
						echo $resp;
				}
		}

		
		function updatePayOnArrival(){
			
			if ($this->input->is_ajax_request()){
			if(!empty($_POST)){
				$id = $this->input->post('id');
				$module = $this->input->post('module');
				$data = array(
					'booking_status' => 'reserved',
					'booking_payment_type' => 'payonarrival'
					);

				$this->db->where('booking_id',$id);
				$this->db->update('pt_bookings',$data);
				if($module == "hotels"){
					$data2 = array(
					'booked_booking_status' => 'reserved'
					);
				
				$this->db->where('booked_booking_id',$id);
				$this->db->update('pt_booked_rooms',$data2);
					
				}
				
			}
				
			}
			
		}

		function getGatewaylink($bookingid,$bookingref){
			$this->load->helper('invoice');

			if ($this->input->is_ajax_request()){
			if(!empty($_POST)){
				$invoicdata = invoiceDetails($bookingid,$bookingref);
				$this->load->model('admin/payments_model');
				$gateway = $this->input->post('gateway');
				echo $this->payments_model->getGatewayMsg($gateway,$invoicdata);

			}

		}
			
		}

		function notifyUrl($gateway){
			$invoiceRedirect = array('ccavenue');

			$this->load->helper('invoice');
			$payResult = array();
			$postdata = $this->input->post();
			
			if(!empty($postdata)){

			require_once "./application/modules/gateways/" . $gateway . ".php";
			$this->load->model('admin/payments_model');
			$params = $this->payments_model->getGatewayParams($gateway);
			if (function_exists($gateway . "_verifypayment")) {
			$payResult = call_user_func($gateway . "_verifypayment",$params);
			}
			$this->load->model("admin/bookings_model");
		
		
			if($payResult['status'] == "success"){
			$shortInfo = $this->bookings_model->bookingShortInfo($payResult['invoiceid']);

			if($shortInfo[0]->booking_deposit == $payResult['paid']){

				updateInvoiceStatus($payResult['invoiceid'],$payResult['paid'],$payResult['transactionid'],$gateway,"paid", $shortInfo[0]->booking_type,$shortInfo[0]->booking_total);
				$invoicedetails = invoiceDetails($payResult['invoiceid'],$shortInfo[0]->booking_ref_no);

				$this->load->model('admin/emails_model');

				$this->emails_model->paid_sendEmail_customer($invoicedetails);
				$this->emails_model->paid_sendEmail_admin($invoicedetails);
				$this->emails_model->paid_sendEmail_supplier($invoicedetails);
				$this->emails_model->paid_sendEmail_owner($invoicedetails);



			}else{

			}
			
		}

		if(in_array($gateway,$invoiceRedirect)){
			redirect(base_url().'invoice?id='.$payResult['invoiceid'].'&sessid='.$shortInfo[0]->booking_ref_no);
		}
		
		}

			
		}

}