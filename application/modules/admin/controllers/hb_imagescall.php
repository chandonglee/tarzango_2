<?php
if (!defined('BASEPATH'))
		exit ('No direct script access allowed');

class Hb_imagescall extends MX_Controller {

		private $data = array();
		public $isadmin;

		function __construct() {
				modules :: load('admin');
                $this->load->model('hb_images/hb_images_model');
                $this->isadmin = $this->session->userdata('pt_logged_admin');
		}

		// Delete Hotel
        function delhbimages(){

          $id = $this->input->post('id');
          $this->hb_images_model->delete_hbhotel($id);
        }

        function makethumb() {
				$newthumb = $this->input->post('imgname');
				$hotelid = $this->input->post('itemid');
				$this->hb_images_model->updateHotelThumb($hotelid, $newthumb,"update");
		}
	
}