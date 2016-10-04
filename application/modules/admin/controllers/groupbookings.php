<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

class Groupbookings extends MX_Controller {
    private $data = array();
    public $role;
    public  $editpermission = true;
    public  $deletepermission = true;
    function __construct() {
          
        modules :: load('admin');
        $chkadmin = modules :: run('admin/validadmin');
        if (!$chkadmin) {
            $this->session->set_userdata('prevURL', current_url());
            redirect('admin');
        }
        $this->data['app_settings'] = $this->settings_model->get_settings_data();
        $checkingadmin = $this->session->userdata('pt_logged_admin');
        if (!empty ($checkingadmin)) {
            $this->data['userloggedin'] = $this->session->userdata('pt_logged_admin');
        }
        else {
            $this->data['userloggedin'] = $this->session->userdata('pt_logged_supplier');
        }
        if (!empty ($checkingadmin)) {
            $this->data['adminsegment'] = "admin";
        }
        else {
            $this->data['adminsegment'] = "supplier";
        }
        $this->load->model('admin/bookings_model');
        $this->data['userloggedin'] = $this->session->userdata('pt_logged_admin');
        $this->data['isadmin'] = $this->session->userdata('pt_logged_admin');
        $this->data['isSuperAdmin'] = $this->session->userdata('pt_logged_super_admin');
        $this->role = $this->session->userdata('pt_role');
        $this->data['role'] = $this->role;
        $this->data['addpermission'] = true;
        if($this->role == "admin"){
        $this->editpermission = pt_permissions("editbooking", $this->data['userloggedin']);
        $this->deletepermission = pt_permissions("deletebooking", $this->data['userloggedin']);
        $this->data['addpermission'] = pt_permissions("addbooking", $this->data['userloggedin']);
        }

        $this->lang->load("back", "en");
    }

    function index() {
        
        if(!$this->data['addpermission'] && !$this->editpermission && !$this->deletepermission){
                    backError_404($this->data);
                    
        }else{
            $this->load->helper('xcrud');
            $xcrud = xcrud_get_instance();
            $xcrud->table('pt_group_booking');
            $xcrud->order_by('pt_group_booking_id', 'desc');
            $xcrud->columns('pt_group_booking_id,company_name,check_in,check_out,attendees,aprx_rooms,city,state,place_type,contect_name,contect_no,contect_email,status');
            $xcrud->label('pt_group_booking_id', 'ID')->label('company_name', 'C. Name')->label('check_in', 'Check in')->label('check_out', 'Check out')->label('attendees', 'Attendees')->label('aprx_rooms', 'Room')->label('city state', '')->label('place_type', 'Place type')->label('contect_name', 'Name')->label('contect_email','E-mail')->label('status', 'Status');
            //$xcrud->column_callback('check_in', 'fmtDate');
            $xcrud->search_columns('company_name,contect_name,contect_no,contect_email');
             $xcrud->column_callback('status', 'gbbookingStatusBtns');
            //$xcrud->button(base_url() . 'invoice/?id={booking_id}&sessid={booking_ref_no}', 'View Invoice', 'fa fa-search-plus', 'btn btn-primary', array('target' => '_blank'));
            
            if($this->editpermission){
                $xcrud->button(base_url() . $this->data['adminsegment'] . '/groupbookings/edit/gb/{pt_group_booking_id}', 'Edit', 'fa fa-edit', 'btn btn-warning', array('target' => '_self'));
            }

            /*if($this->deletepermission){
                $delurl = base_url() . 'admin/bookings/delBooking';
                $xcrud->multiDelUrl = base_url().'admin/bookings/delMultipleBookings';

                $xcrud->button("javascript: delfunc('{booking_id}','$delurl')",'DELETE','fa fa-times','btn-danger',array('target'=>'_self','id' => '{booking_id}'));
            }*/

            $this->data['add_link'] = '';
            $xcrud->limit(10);
            $xcrud->unset_add();
            $xcrud->unset_view();
            $xcrud->unset_remove();
            $xcrud->unset_edit();
            $this->data['content'] = $xcrud->render();
            $this->data['page_title'] = 'Group Booking Management';
            $this->data['main_content'] = 'temp_view';
            $this->data['header_title'] = 'Group Booking Management';

            $this->load->view('template', $this->data);    
       
        
        }
    
    }

    function edit($module, $id) {
        /*error_reporting(E_ALL);*/
        if(!$this->editpermission){
                 echo "<center><h1>Access Denied</h1></center>";
                 backError_404($this->data);
        }else{
            $this->load->helper('invoice');
            $this->load->model('groupbookings_model');
             //echo $this->url->segment(2);
            $this->data['supptotal'] = 0;
            $updatebooking = $this->input->post('updatebooking');
            if (!empty ($updatebooking)) {
                $this->groupbookings_model->update_booking($id);
                redirect(base_url() . "admin/groupbookings");
            }
            if (!empty ($module) && !empty ($id)) {
            
                $this->data['chklib'] = $this->ptmodules;
                $bdetails = $this->groupbookings_model->getBookingRefNo($id);
                $all_hotel = $this->groupbookings_model->get_all_hotel();
                /*echo json_encode($bdetails);
                exit();*/
                /*print_r($all_hotel);
                echo $all_hotel[0]->hotel_title;
                exit();*/
                $this->data['bdetails'] =  $bdetails;
                $this->data['all_hotel'] =  $all_hotel;
               
                //hotels module
                if ($module == "hotels") {
                    /*$this->load->library('hotels/hotels_lib');
                    $this->hotels_lib->set_id($this->data['gbdetails']->itemid);
                    $this->hotels_lib->hotel_short_details();*/
                    
                }
                
                $this->data['main_content'] = 'modules/groupbookings/edit';
                $this->data['page_title'] = 'Edit Booking';
                $this->load->view('admin/template', $this->data);
            }
            else {
                redirect('admin/groupbookings');
            }
        }
    
    }



// delete single booking
    function delBooking() {
        if (!$this->input->is_ajax_request()) {
            redirect('admin');
        }
        else {
            $id = $this->input->post('id');
            $this->bookings_model->delete_booking($id);
            $this->session->set_flashdata('flashmsgs', "Deleted Successfully");
        }
    }

// Delete Multiple Bookings
    function delMultipleBookings(){
          if (!$this->input->is_ajax_request()) {
            redirect('admin');
        }
        else {
            $items = $this->input->post('items');
            foreach($items as $item){
            $this->bookings_model->delete_booking($item);
                
            }
            
            } 
    }

// change booking status to paid
    function booking_status_paid() {
        if (!$this->input->is_ajax_request()) {
            redirect('admin');
        }
        else {
            $bookinglist = $this->input->post('booklist');
            foreach ($bookinglist as $id) {
                $this->bookings_model->booking_status_paid($id);
            }
            $this->session->set_flashdata('flashmsgs', "Status Changed to Paid Successfully");
        }
    }

// change booking status to unpaid
    function booking_status_unpaid() {
        if (!$this->input->is_ajax_request()) {
            redirect('admin');
        }
        else {
            $bookinglist = $this->input->post('booklist');
            foreach ($bookinglist as $id) {
                $this->bookings_model->booking_status_unpaid($id);
            }
            $this->session->set_flashdata('flashmsgs', "Status Changed to Unpaid Successfully");
        }
    }

//change single bookin status to paid
    function single_booking_status_paid() {
        if (!$this->input->is_ajax_request()) {
            redirect('admin');
        }
        else {
            $id = $this->input->post('id');
            $this->bookings_model->booking_status_paid($id);
        }
    }

//change single bookin status to unpaid
    function single_booking_status_unpaid() {
        if (!$this->input->is_ajax_request()) {
            redirect('admin');
        }
        else {
            $id = $this->input->post('id');
            $this->bookings_model->booking_status_unpaid($id);
        }
    }

// cancellation request
    function cancelrequest($action) {
        $id = $this->input->post('id');
        if ($action == 'approve') {
            $this->bookings_model->cancel_booking_approve($id);
        }
        else {
            $this->bookings_model->cancel_booking_reject($id);
        }
    }

//resend invoice
    function resendinvoice() {
        $invoiceid = $this->input->post('id');
        $refno = $this->input->post('refno');
        $this->load->helper('invoice');
        $invoicedetails = invoiceDetails($invoiceid, $refno);
        $this->load->model('emails_model');
        $this->emails_model->resend_invoice($invoicedetails);
    }

    
    function dashboardBookings(){

        if(!$this->data['addpermission'] && !$this->editpermission && !$this->deletepermission){
                    backError_404($this->data);
                    
                }else{
        $this->load->helper('xcrud');
        $xcrud = xcrud_get_instance();
        $xcrud->table('pt_bookings');
        $xcrud->join('booking_user', 'pt_accounts', 'accounts_id');
        $xcrud->order_by('booking_id', 'desc');
        $xcrud->columns('booking_id,booking_ref_no,pt_accounts.ai_first_name,booking_type,booking_date,booking_total,booking_amount_paid,booking_remaining,booking_status');
        $xcrud->label('booking_id', 'ID')->label('booking_ref_no', 'Ref No.')->label('pt_accounts.ai_first_name', 'Customer')->label('booking_type', 'Module')->label('booking_date', 'Date')->label('booking_total', 'Total')->label('booking_amount_paid', 'Paid')->label('booking_remaining', 'Remaining')->label('booking_status', 'Status');
        $xcrud->column_callback('booking_date', 'fmtDate');
        $xcrud->column_callback('booking_status', 'bookingStatusBtns');
        $xcrud->search_columns('booking_id,booking_ref_no,pt_accounts.ai_first_name,booking_type,booking_status');
        $xcrud->button(base_url() . 'invoice/?id={booking_id}&sessid={booking_ref_no}', 'View Invoice', 'fa fa-search-plus', 'btn btn-primary', array('target' => '_blank'));
         if($this->editpermission){
        $xcrud->button(base_url() . $this->data['adminsegment'] . '/bookings/edit/{booking_type}/{booking_id}', 'Edit', 'fa fa-edit', 'btn btn-warning', array('target' => '_self'));
        }
         if($this->deletepermission){
        $delurl = base_url() . 'admin/bookings/delBooking';
        $xcrud->multiDelUrl = base_url().'admin/bookings/delMultipleBookings';

        $xcrud->button("javascript: delfunc('{booking_id}','$delurl')",'DELETE','fa fa-times','btn-danger',array('target'=>'_self','id' => '{booking_id}'));
        }

        $this->data['add_link'] = '';
        $xcrud->unset_add();
        $xcrud->unset_view();
        $xcrud->unset_remove();
        $xcrud->unset_edit();
        $xcrud->unset_print();
        $xcrud->unset_csv();
        $this->data['content'] = $xcrud->render();
        $this->data['page_title'] = 'Recent Bookings';
        $this->data['main_content'] = 'temp_view';
        $this->data['header_title'] = 'Recent Bookings';
        


        $this->load->view('temp_view', $this->data);    
       
        
    }

    }

    function split_subitem($string) {
        return explode("_", $string);
    }



}