<?php
if (!defined('BASEPATH'))
		exit ('No direct script access allowed');


if (!function_exists('add_group_booking')) {

    function add_group_booking($store_data = ''){
        
        $CI = get_instance();
       
        $abc = $CI->db->insert('pt_group_booking',$store_data);

    }

}

