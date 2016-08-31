<?php
if (!defined('BASEPATH'))
		exit ('No direct script access allowed');
if (!function_exists('getAllMonth')) {

		function getAllMonth($selected = ''){
        $options = '';
        for($i=1;$i<=12;$i++)
        {
            $value = ($i < 10)?'0'.$i:$i;
            $selectedOpt = ($value == $selected)?'selected':'';
            $options .= '<option value="'.$value.'" '.$selectedOpt.' >'.date("F", mktime(0, 0, 0, $i+1, 0, 0)).'</option>';
        }
        return $options;
    }

}if (!function_exists('get_booking_list_by_date')) {

		function get_booking_list_by_date($date) {
				$CI = get_instance();
				$CI->db->select('*');
				$CI->db->where('booking_checkin', $date);
				$booked = $CI->db->count_all_results('pt_bookings');
				
				return $booked;
		}

}if (!function_exists('getYearList')) {
 function getYearList($selected = ''){
        $options = '';
        for($i=2015;$i<=2025;$i++)
        {
            $selectedOpt = ($i == $selected)?'selected':'';
            $options .= '<option value="'.$i.'" '.$selectedOpt.' >'.$i.'</option>';
        }
        return $options;
    }
		

}if (!function_exists('calendar_room_check')) {

		function calendar_room_check($id, $totalquantity, $chkdate) {
				$CI = get_instance();
				$CI->db->select('booked_room_count,booked_checkout,booked_checkin');
				$CI->db->select_sum('booked_room_count');
				$CI->db->where("booked_checkin <=", $chkdate);
				$CI->db->where("booked_checkout >", $chkdate);
				$CI->db->where('booked_booking_status', 'paid');
				$CI->db->or_where('booked_booking_status', 'reserved');
				$CI->db->group_by('booked_room_id');
				$CI->db->having('booked_room_id', $id);
				$booked = $CI->db->get('pt_booked_rooms')->result();
				if (empty ($booked)) {
						return true;
				}
				else {
						if ($booked[0]->booked_room_count >= $totalquantity) {
								return false;
						}
						else {
								return true;
						}
				}
		}

}if (!function_exists('array_column')) {

function array_column(array $input, $columnKey, $indexKey = null) {
        $array = array();
        foreach ($input as $value) {
            if ( ! isset($value[$columnKey])) {
                trigger_error("Key \"$columnKey\" does not exist in array");
                return false;
            }
            if (is_null($indexKey)) {
                $array[] = $value[$columnKey];
            }
            else {
                if ( ! isset($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not exist in array");
                    return false;
                }
                if ( ! is_scalar($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not contain scalar value");
                    return false;
                }
                $array[$value[$indexKey]] = $value[$columnKey];
            }
        }
        return $array;
    }
    }