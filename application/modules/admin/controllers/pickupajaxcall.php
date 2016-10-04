<?php
if (!defined('BASEPATH'))
		exit ('No direct script access allowed');

class Pickupajaxcalls extends MX_Controller {

		private $data = array();
		public $isadmin;

		function __construct() {
				modules :: load('admin');
                $this->load->model('pickup/pickup_model');
                $this->isadmin = $this->session->userdata('pt_logged_admin');
		}

		// Delete Hotel
        function delattraction(){
          $id = $this->input->post('id');
          $this->pickup_model->delete_pickup_book($id);
        }

	
}