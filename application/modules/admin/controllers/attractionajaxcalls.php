<?php
if (!defined('BASEPATH'))
		exit ('No direct script access allowed');

class Attractionajaxcalls extends MX_Controller {

		private $data = array();
		public $isadmin;

		function __construct() {
				modules :: load('admin');
                $this->load->model('attraction/attraction_model');
                $this->isadmin = $this->session->userdata('pt_logged_admin');
		}

		// Delete Hotel
        function delattraction(){
          $id = $this->input->post('id');
          $this->attraction_model->delete_attraction_booking($id);
        }

        public function attraction_paid_email($att_id = null){
			/*error_reporting(-1);*/
			$att_id = $this->input->get('att_id');
			$this->load->model('admin/emails_model');
			$this->db->select('pt_attr_booking.*,pt_accounts.accounts_email');
			$this->db->where('pt_attr_booking_id', $att_id);
			$this->db->join('pt_accounts','pt_attr_booking.booking_user = pt_accounts.accounts_id','left');
			$att_data = $this->db->get('pt_attr_booking')->result();
			$mydata = json_decode($att_data[0]->booking_extra_data);
			$bookdata = json_decode($att_data[0]->book_response);
			/*print_r($bookdata->activities[0]->bundles[0]->comments[0]->text);
			exit();*/
			/*print_r($att_data[0]->accounts_email);
			exit;*/
		

        	$this->emails_model->attraction_booking_paid_email($mydata,$att_data,$bookdata);
		}

 		public function invoice_ticket_email($att_id = null){
			/*error_reporting(-1);*/
			$att_id = $this->input->get('att_id');

			$this->load->model('admin/emails_model');
			$this->db->select('pt_attr_booking.*,pt_accounts.accounts_email');
			$this->db->where('pt_attr_booking_id', $att_id);
			$this->db->join('pt_accounts','pt_attr_booking.booking_user = pt_accounts.accounts_id','left');
			$att_data = $this->db->get('pt_attr_booking')->result();
			$mydata = json_decode($att_data[0]->booking_extra_data);

			$bookdata = json_decode($att_data[0]->book_response);

			/*print_r($bookdata->activities[0]->bundles[0]->comments[0]->text);
			exit();*/
        	$this->emails_model->invoice_ticket_email($mydata,$att_data,$bookdata);
		}

	
}