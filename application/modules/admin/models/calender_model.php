<?php

      class Calender_model extends CI_Model {
          private $data = array();

          function __construct() {
      // Call the Model constructor
              parent :: __construct();
              $this->load->model('admin/accounts_model');
              $this->load->model('admin/emails_model');
              $this->data['app_settings'] = $this->settings_model->get_settings_data();
              $this->load->helper('invoice');
          }

          function get_booking_list($type = null) {
            
              $this->db->select('*');
              $this->db->where('booking_checkin',date("Y-m-d"));

              $data =  $this->db->count_all_results('pt_bookings');
             /* echo $data;
              exit();*/
              /*echo $this->db->last_query();*/

              return $data;
          }

          function get_booking_list_by_Date($date = null) {
            
              $this->db->select('pt_bookings.booking_item,pt_bookings.booking_id,pt_bookings.booking_ref_no,pt_hotels.hotel_title');
              $this->db->where('booking_checkin',$date);
              $this->db->join('pt_hotels', 'pt_bookings.booking_item = pt_hotels.hotel_id', 'left');
              /*$this->db->group_by('pt_bookings.booking_item');*/
              $query = $this->db->get('pt_bookings');
              /*echo $this->db->last_query();
              exit();*/
              $data['all'] = $query->result_array();
              $data['nums'] = $query->num_rows();

              return $data;
            
          }

           function get_booking_detail_list_by_Date($booking_item = null,$date = null) {
            
              $this->db->select('pt_bookings.booking_item,pt_bookings.booking_id,pt_bookings.booking_ref_no,pt_hotels.hotel_title');
              $this->db->where('booking_checkin',$date);
              $this->db->where('booking_item',$booking_item);
              $this->db->join('pt_hotels', 'pt_bookings.booking_item = pt_hotels.hotel_id', 'left');
              /*$this->db->group_by('pt_bookings.booking_item');*/
              $query = $this->db->get('pt_bookings');
              /*echo $this->db->last_query();
              exit();*/
              $data['all'] = $query->result_array();
              $data['nums'] = $query->num_rows();

              return $data;
            
          }

      // get all bookings
          function get_all_bookings_back_admin() {
              $this->db->select('pt_bookings.booking_user,pt_bookings.booking_cancellation_request,pt_bookings.booking_id,pt_bookings.booking_type,pt_bookings.booking_expiry,pt_bookings.booking_ref_no,
              pt_bookings.booking_status,pt_bookings.booking_item,pt_bookings.booking_item_title,
              booking_total,pt_bookings.booking_deposit,pt_bookings.booking_date,pt_accounts.ai_first_name,pt_accounts.ai_last_name,pt_accounts.accounts_email');
              $this->db->join('pt_accounts', 'pt_bookings.booking_user = pt_accounts.accounts_id', 'left');
              $this->db->order_by('pt_bookings.booking_id', 'desc');
              $query = $this->db->get('pt_bookings');
              $data['all'] = $query->result();
              $data['nums'] = $query->num_rows();
              return $data;
          }

      // get all bookings with limit
          function get_all_bookings_back_limit_admin($perpage = null, $offset = null, $orderby = null) {
              if ($offset != null) {
                  $offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
              }
              $this->db->select('pt_bookings.booking_user,pt_bookings.booking_cancellation_request,pt_bookings.booking_id,pt_bookings.booking_type,pt_bookings.booking_expiry,pt_bookings.booking_ref_no,
              pt_bookings.booking_status,pt_bookings.booking_item,pt_bookings.booking_item_title,
              booking_total,pt_bookings.booking_deposit,pt_bookings.booking_date,pt_accounts.ai_first_name,pt_accounts.ai_last_name,pt_accounts.accounts_email');
              $this->db->join('pt_accounts', 'pt_bookings.booking_user = pt_accounts.accounts_id', 'left');
              $this->db->order_by('pt_bookings.booking_id', 'desc');
              $query = $this->db->get('pt_bookings', $perpage, $offset);
              $data['all'] = $query->result();
      // $data['nums'] = $query->num_rows();
              return $data;
          }

      // get all bookings info  by search for admin
          function search_all_bookings_back_limit_admin($term, $perpage = null, $offset = null, $orderby = null) {
              if ($offset != null) {
                  $offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
              }
              $this->db->select('pt_bookings.booking_user,pt_bookings.booking_cancellation_request,pt_bookings.booking_id,pt_bookings.booking_type,pt_bookings.booking_expiry,pt_bookings.booking_ref_no,
              pt_bookings.booking_status,pt_bookings.booking_item,pt_bookings.booking_item_title,
              booking_total,pt_bookings.booking_deposit,pt_bookings.booking_date,pt_accounts.ai_first_name,pt_accounts.ai_last_name,pt_accounts.accounts_email');
              $this->db->like('pt_bookings.booking_type', $term);
              $this->db->or_like('pt_bookings.booking_id', $term);
              $this->db->or_like('pt_accounts.ai_first_name', $term);
              $this->db->or_like('pt_accounts.ai_last_name', $term);
              $this->db->join('pt_accounts', 'pt_bookings.booking_user = pt_accounts.accounts_id', 'left');
              $this->db->order_by('pt_bookings.booking_id', 'desc');
              $query = $this->db->get('pt_bookings', $perpage, $offset);
              $data['all'] = $query->result();
              $data['nums'] = $query->num_rows();
              return $data;
          }

        }

      