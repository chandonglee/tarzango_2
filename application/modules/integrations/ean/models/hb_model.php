<?php
class Hb_model extends CI_Model{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

     

    function insert_booking($insertdata){

        $this->db->insert('pt_payment_data',$insertdata);

    }

  


}