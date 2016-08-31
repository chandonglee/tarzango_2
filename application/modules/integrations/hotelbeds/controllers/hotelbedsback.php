<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotelbedsback extends MX_Controller {


    private $data = array();

    function __construct(){
	  
      $seturl =  $this->uri->segment(3);
      echo $seturl;
      exit();
      $this->load->helper('settings');
      $this->load->model('hotelbeds/hotelbeds_model');
      
      $this->data['isadmin'] = $this->session->userdata('pt_logged_admin');
      $this->data['isSuperAdmin'] = $this->session->userdata('pt_logged_super_admin');


    }

    function index(){

    }


    function settings(){

      $updatesett = $this->input->post('updatesettings');

        if(!empty($updatesett)){

          $this->hotelbeds_model->update_front_settings();
          redirect('admin/hotelbeds/settings');

        }

      //$this->data['settings'] = $this->settings_model->get_front_settings("hotelbeds");
      $this->data['main_content'] = 'hotelbeds/settings';
    	$this->data['page_title'] = 'Hotelbeds Settings';

    	$this->load->view('admin/template',$this->data);

      }



    }