<?php

class Pickup_model extends CI_Model {
        public $langdef;
        public $isSuperAdmin = null;
		function __construct() {
			// Call the Model constructor
			parent :: __construct();
            $this->langdef = DEFLANG;
            $this->isSuperAdmin = $this->session->userdata('pt_logged_super_admin');
            $this->load->library('pickup/pickup_lib');
            $this->load->model('accounts_model');
		}


		function book_attraction(){
			$input_data = $this->input->post();

			$profile = $this->accounts_model->get_profile_details($input_data['user_id']);
			/*error_reporting(-1);*/
			$booking_data = $this->attraction_lib->attraction_booking($input_data,$profile);
			/*echo $booking_data = str_replace(" ", '', $booking_data);*/
			/*echo $booking_data;*/
			$save_data = json_decode($booking_data);
			
			if(!$save_data->errors){
				/*$save_data = $save_data->;*/
				$pt_attr_booking_id = $this->save_booking($save_data->booking,$profile,$input_data);

				/*if($pt_attr_booking_id){*/
					$book_response_final = array('error' => 'no' , 'msg' => '' , 'url' => base_url().'attraction/invoice/'.$pt_attr_booking_id);
				/*}else{
					$book_response_final = array('error' => 'no' , 'msg' => '' );
				}*/
			}else{
				$book_response_final = array('error' => 'yes' , 'msg' => $save_data->errors[0]->text);
			}
			/*echo "\n";*/
			echo json_encode($book_response_final);
			/*echo json_encode($profile);*/
			exit();
		}

		function save_booking($save_data,$profile,$input_data){
			$this->load->helper('member');
			$mem_data = check_is_member($profile['accounts_id']);
			if($input_data['member_add'] || $mem_data[0]->accounts_id == $profile['accounts_id']){
				$total = $input_data['vip_price'];
			}else{
				$total = $input_data['normal_price'];
			}

			$profile = (array)$profile[0];
			$data = array(
					'booking_ref_no' => $save_data->reference,
					'booking_status' => 'unpaid',
					'booking_user' => $profile['accounts_id'],
					'booking_additional_notes' => $input_data['booking_additional_notes'],
					'booking_total' => $total,
					'booking_remaining' => $total,
					'booking_amount_paid' => '',
					'booking_checkin' => $input_data['checkin'],
					'booking_adults' => $input_data['adults'],
					'booking_child' => $input_data['child'],
					'booking_date' => date("Y-m-d H:i:s"),
					'booking_expiry' => date("Y-m-d H:i:s", strtotime('+24 hours')),
					'booking_payment_date' => '',
					'booking_extra_data' => json_encode($input_data),
					'book_response' => json_encode($save_data),
					);
			$this->db->insert('pt_attr_booking', $data);
			$this->db->last_query();
			return $pt_attr_booking_id = $this->db->insert_id();
		}

		function update_payment_status($pay_data,$pt_attr_booking_id,$booking_ref_no){
			$bookingdata = array(
							'booking_status' => 'paid',
							'booking_remaining' => 0
							);
			$this->db->where('pt_attr_booking_id',$pt_attr_booking_id);
    		$this->db->update('pt_attr_booking',$bookingdata);
		}

		function get_attr_booking($id){
			$this->db->select('*');
			$this->db->where('pt_attr_booking_id', $id);
			$this->db->join('pt_accounts','pt_accounts.accounts_id = pt_attr_booking.booking_user','left');
			$attraction = $this->db->get('pt_attr_booking')->result();
			return $attraction[0];
		}

		function get_attr_my_bookings($id){
			$this->db->select('*');
			$this->db->where('booking_user', $id);
			//$this->db->join('pt_accounts','pt_accounts.accounts_id = pt_attr_booking.booking_user','left');
			$attraction = $this->db->get('pt_attr_booking')->result();
			/*echo $this->db->last_query();
			exit();*/
			return $attraction;
		}

		function delete_attraction_booking($pt_attr_booking_id) {
			$this->db->where('pt_attr_booking_id', $pt_attr_booking_id);
			$this->db->delete('pt_attr_booking');
			echo $this->db->last_query();
		}
  
}