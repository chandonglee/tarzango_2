<?php
if (!defined('BASEPATH'))
		exit ('No direct script access allowed');
/*error_reporting(E_ALL);*/
class Carajaxcalls extends MX_Controller {
		private $data = array();
		private $appsettings;

		function __construct() {
				modules :: load('admin');
				$this->load->model('admin/extras_model');
				/*$this->load->model('attraction/attraction_model');*/
				 $this->load->helper("member");
				$defaultlang = pt_get_default_language();
				if (empty ($this->data['lang_set'])) {
						$this->data['lang_set'] = $defaultlang;
				}
                $this->appsettings = $this->settings_model->get_settings_data();
				$this->lang->load("front", $this->data['lang_set']);
		}

		function processlogin() {
			$this->load->model('accounts_model');
			$this->form_validation->set_message('matches', trans("0310"));
			$this->form_validation->set_message('valid_email', trans("0311"));
			$this->form_validation->set_message('required', "%s " . trans("0312"));
			$this->form_validation->set_rules('username', trans("094"), 'required|valid_email');
			$this->form_validation->set_rules('password', trans("095"), 'required|min_length[6]');

			if ($this->form_validation->run() == FALSE) {
					$msg = "<div class='alert alert-danger'>" . validation_errors() . "</div>";
					$bookingResult = array("error" => "yes", 'msg' => validation_errors());
			}else {
				$username = $this->input->post('username');
	 			$password = $this->input->post('password');
				$userid = $this->accounts_model->login_member_customer($username, $password);
				if ($userid != false) {
					$mem_data = check_is_member($userid);

					$bookingResult = array("error" => "no", 'msg' => '' , 'user_id'=> $userid, 'mem_data' => $mem_data[0]);
				 
				}else {
				  	$bookingResult = array("error" => "yes", 'msg' => 'Invalid Email or Password');
				  
				}
							
					
			}

			echo json_encode($bookingResult);
		}

		function processsignup() {
			
			$this->load->model('accounts_model');

			$this->form_validation->set_message('matches', trans("0310"));
			$this->form_validation->set_message('valid_email', trans("0311"));
			$this->form_validation->set_message('required', "%s " . trans("0312"));
			$this->form_validation->set_rules('email', trans("094"), 'required|valid_email');
			$this->form_validation->set_rules('password', trans("095"), 'required|min_length[6]');
			$this->form_validation->set_rules('firstname', trans("0171"), 'trim|required');
			$this->form_validation->set_rules('lastname', trans("0172"), 'trim|required');

			if ($this->form_validation->run() == FALSE) {
					$msg = "<div class='alert alert-danger'>" . validation_errors() . "</div>";
					$bookingResult = array("error" => "yes", 'msg' => validation_errors());
			}else {
					$this->db->select('accounts_email');
					$this->db->where('accounts_email', $this->input->post('email'));
					$this->db->where('accounts_type', 'customers');
					$nums = $this->db->get('pt_accounts')->num_rows();
					if ($nums > 0) {
						$msg = "<div class='alert alert-danger'>" . trans("0313") . "</div>";
						$bookingResult = array("error" => "yes", 'msg' => trans("0313"));
					}else {
							
						$userid = $this->accounts_model->signup_account('customers', '1');
						//$profile = $this->accounts_model->get_profile_details($userid);
						//error_reporting(-1);
						/*$mem_data = check_is_member($userid);*/
						$bookingResult = array("error" => "no", 'msg' => '' , 'user_id' => $userid , 'mem_data' => null );

					}
			}

			echo json_encode($bookingResult);
				
		}

		function processsignup_vip() {
			
			$this->load->model('accounts_model');

			$this->form_validation->set_message('matches', trans("0310"));
			$this->form_validation->set_message('valid_email', trans("0311"));
			$this->form_validation->set_message('required', "%s " . trans("0312"));
			$this->form_validation->set_rules('email', trans("094"), 'required|valid_email');
			$this->form_validation->set_rules('password', trans("095"), 'required|min_length[6]');
			$this->form_validation->set_rules('firstname', trans("0171"), 'trim|required');
			$this->form_validation->set_rules('lastname', trans("0172"), 'trim|required');

			if ($this->form_validation->run() == FALSE) {
					$msg = "<div class='alert alert-danger'>" . validation_errors() . "</div>";
					$bookingResult = array("error" => "yes", 'msg' => validation_errors());
			}else {
					$this->db->select('accounts_email');
					$this->db->where('accounts_email', $this->input->post('email'));
					$this->db->where('accounts_type', 'customers');
					$nums = $this->db->get('pt_accounts')->num_rows();
					if ($nums > 0) {
						$msg = "<div class='alert alert-danger'>" . trans("0313") . "</div>";
						$bookingResult = array("error" => "yes", 'msg' => trans("0313"));
					}else {
							
						$userid = $this->accounts_model->signup_account('customers', '1');
						//$profile = $this->accounts_model->get_profile_details($userid);
						//error_reporting(-1);
						/*$mem_data = check_is_member($userid);*/
						$abc = add_member($userid);
						$bookingResult = array("error" => "no", 'msg' => '' , 'user_id' => $userid , 'mem_data' => null );

					}
			}

			echo json_encode($bookingResult);
				
		}

		function processlogged() {
				
			$user = $this->session->userdata('pt_logged_customer');
			$mem_data = check_is_member($user);
			$bookingResult = array("error" => "no", 'msg' => '' , 'user_id' => $user , 'mem_data' => $mem_data );
			echo json_encode($bookingResult);
		}

		function checkmember(){
			$this->form_validation->set_message('required', "%s " . trans("0312"));
			$this->form_validation->set_rules('user_id', 'Enter valid user id', 'required');
			if ($this->form_validation->run() == FALSE) {
				$msg = "<div class='alert alert-danger'>" . validation_errors() . "</div>";
				$bookingResult = array("error" => "yes", 'msg' => validation_errors());
			}else {
				$user_id = $this->input->post('user_id');
				$mem_data = check_is_member($user_id);

				$bookingResult = array("error" => "no", 'msg' => '' , 'user_id'=> $user_id, 'mem_data' => $mem_data[0]);
				
					
			}

			echo json_encode($bookingResult);
		}


		function add_member(){
			
			$this->form_validation->set_message('required', "%s " . trans("0312"));
			$this->form_validation->set_rules('user_id', 'Enter valid user id', 'required');
			if ($this->form_validation->run() == FALSE) {
				$msg = "<div class='alert alert-danger'>" . validation_errors() . "</div>";
				$bookingResult = array("error" => "yes", 'msg' => validation_errors());
			}else {
				$user_id = $this->input->post('user_id');
				$abc = add_member($user_id);
				$mem_data = check_is_member($user_id);

				$bookingResult = array("error" => "no", 'msg' => '' , 'user_id'=> $user_id, 'mem_data' => $mem_data[0]);
			
			}

			echo json_encode($bookingResult);
		}


		function processBooking() {
			$this->load->model('admin/bookings_model');
			
			$user_id = $this->input->post('user_id');
			echo json_encode($this->bookings_model->do_booking($user_id));
		}

		function hbprocessBooking() {
			$this->load->model('ean/hb_model');
			$this->load->model('accounts_model');
			$user = $this->session->userdata('pt_logged_customer');
			$user_id = $this->input->post('user_id');
			$input_data_1 = $this->input->post();
			$profile = $this->accounts_model->get_profile_details($user_id);
			$profile_1 = $profile[0];
			$input_data = array_merge($input_data_1 , $profile);
			
			echo $book_data = $this->hb_model->do_booking($input_data);
				
		}

		function carBooking(){
			error_reporting(-1);
			$this->load->model('ean/car_hb_model');

			$in_data = $this->input->post();
			$insert_data  = array();
			
			$insert_data['booking_hotel_id'] = $in_data['booking_hotel_id'];
			$insert_data['booking_ref_no1'] = $in_data['booking_ref_no1'];
			$insert_data['booking_ref_no2'] = $in_data['booking_ref_no2'];
			$insert_data['booking_ref_no3'] = $in_data['booking_ref_no3'];
			$insert_data['office_code_1'] = $in_data['office_code_1'];
			$insert_data['office_code_2'] = $in_data['office_code_2'];
			$insert_data['office_code_3'] = $in_data['office_code_3'];
			$insert_data['dep_flight_code'] = $in_data['pickup_flight_code'];
			$insert_data['arv_flight_code'] = $in_data['drp_flight_code'];
			$insert_data['pickup_time'] = $in_data['flight_pickup_time_hour'].':'.$in_data['flight_pickup_time_min'];
			$insert_data['drop_time'] = $in_data['flight_drp_time_hour'].':'.$in_data['flight_drp_time_min'];
			$insert_data['booking_user'] = $in_data['user_id'];
			$insert_data['booking_status'] = 'unpaid';
			$insert_data['booking_payment_type'] = '';
			$insert_data['booking_additional_notes'] = '';
			$insert_data['booking_total'] = $in_data['booking_total'];
			$insert_data['booking_amount_paid'] = '';
			$insert_data['booking_remaining'] = '';
			$insert_data['booking_checkin'] = $in_data['checkin'];
			$insert_data['booking_checkout'] = $in_data['checkout'];
			$insert_data['booking_adults'] = $in_data['adults'];
			$insert_data['booking_child'] = $in_data['child'];
			$insert_data['booking_date'] = date('Y-m-d H:i:s');
			$insert_data['booking_expiry'] = date('Y-m-d H:i:s');
			$insert_data['booking_payment_date'] = '';
			$insert_data['booking_extra_data'] = '';
			$insert_data['book_response'] = $in_data['book_response'];
			$insert_data['payment_data'] = '';
			$insert_data['book_cancel_data'] = '';

			$this->car_hb_model->insert_booking($insert_data);

		}


}