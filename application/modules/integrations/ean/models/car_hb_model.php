<?php
class Car_hb_model extends CI_Model{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        /*$this->load->library('ean/hb_lib');*/
        /*$this->load->model('ean/ean_model');*/
    }
   

    function insert_booking($insertdata = null){
        /*echo "sasd";*/
        $this->db->insert('pt_car_booking',$insertdata);
        echo $this->db->last_query();
    }



}