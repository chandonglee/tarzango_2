<?php
if (!defined('BASEPATH'))
		exit ('No direct script access allowed');
if (!function_exists('check_is_member')) {

	function check_is_member($user_id = ''){
        //echo $user_id;
        $CI = get_instance();
        $CI->db->select('*');
        $CI->db->where("accounts_id ", $user_id);
        $member = $CI->db->get('pt_member')->result();

        return $member;
    }

}

if (!function_exists('add_member')) {

    function add_member($user_id = ''){
        //echo $user_id;
        $cur_date = date('Y-m-d');
      // $after_one = strtotime('+30 days',$cur_date);
         $after_one = date('Y-m-d',strtotime($cur_date,'+1 month'));
        //exit();
        $CI = get_instance();
        $data = array('accounts_id' => $user_id,'exp_date' => $after_one ); 
        
        $abc = $CI->db->insert('pt_member',$data);

    }

}


if (!function_exists('add_pickup_detail')) {

    function add_pickup_detail($booking_id = '',$extra_data){
         
        //exit();
        $CI = get_instance();
        $data = array('booking_id' => $booking_id,'hotel_type' => 2, 'extra_data'=>  $extra_data); 
        
        $abc = $CI->db->insert('pt_book_extra',$data);

    }

}

if (!function_exists('get_pickup_detail')) {

    function get_pickup_detail($booking_id){
         
        //exit();
        $CI = get_instance();
        $CI->db->select('*');
        $CI->db->where("booking_id ", $booking_id);
        $booking_data = $CI->db->get('pt_book_extra')->result();

        return $booking_data;
        
    }

}