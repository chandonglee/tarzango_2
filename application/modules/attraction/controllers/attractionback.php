<?php
if (!defined('BASEPATH'))
		exit ('No direct script access allowed');

class attractionback extends MX_Controller {
		private $data = array();
        public $accType = "";
        public $role = "";
        public  $editpermission = true;
        public  $deletepermission = true;
		function __construct() {
				/*echo "Asd";
				exit();*/
				$seturl = $this->uri->segment(3);
				if ($seturl != "settings") {
						$chk = modules :: run('home/is_main_module_enabled', 'attraction');
						if (!$chk) {
							backError_404($this->data);
						}
				}
				$checkingadmin = $this->session->userdata('pt_logged_admin');
				$this->accType = $this->session->userdata('pt_accountType');
				$this->role = $this->session->userdata('pt_role');

		        $this->data['userloggedin'] = $this->session->userdata('pt_logged_id');
				if (empty ($this->data['userloggedin'])) {
					$urisegment =  $this->uri->segment(1); 
					$this->session->set_userdata('prevURL', current_url());
						redirect($urisegment);
				}
				if (!empty ($checkingadmin)) {
						$this->data['adminsegment'] = "admin";
				}
				else {
						$this->data['adminsegment'] = "supplier";
				}
				if ($this->data['adminsegment'] == "admin") {

						$chkadmin = modules :: run('admin/validadmin');
						if (!$chkadmin) {

								redirect('admin');
						}
				}
				else {
						$chksupplier = modules :: run('supplier/validsupplier');
						if (!$chksupplier) {
								redirect('supplier');
						}
				}
                $this->data['appSettings'] = modules :: run('admin/appSettings');
				
				$this->data['ckconfig'] = array();
				$this->data['ckconfig']['toolbar'] = array(array('Source', '-', 'Bold', 'Italic', 'Underline', 'Strike', 'Format', 'Styles'), array('NumberedList', 'BulletedList', 'Outdent', 'Indent', 'Blockquote'), array('Image', 'Link', 'Unlink', 'Anchor', 'Table', 'HorizontalRule', 'SpecialChar', 'Maximize'), array('Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo', 'Find', 'Replace', '-', 'SelectAll', '-', 'SpellChecker', 'Scayt'),);
				$this->data['ckconfig']['language'] = 'en';
				//$this->data['ckconfig']['filebrowserUploadUrl'] =  base_url().'home/cmsupload';
				$this->load->helper('hotels/hotels');
				$this->data['languages'] = pt_get_languages();
				$this->load->helper('xcrud');
				$this->data['c_model'] = $this->countries_model;
				$this->data['addpermission'] = true;
                if($this->role == "supplier" || $this->role == "admin"){
	                $this->editpermission = pt_permissions("edithotels", $this->data['userloggedin']);
	                $this->deletepermission = pt_permissions("deletehotels", $this->data['userloggedin']);
	                $this->data['addpermission'] = pt_permissions("addhotels", $this->data['userloggedin']);
                }



				$this->data['all_countries'] = $this->countries_model->get_all_countries();
				$this->load->helper('settings');
				$this->load->model('admin/accounts_model');
				$this->data['isadmin'] = $this->session->userdata('pt_logged_admin');
				$this->data['isSuperAdmin'] = $this->session->userdata('pt_logged_super_admin');
				$this->load->model('attraction/attraction_model');
				$this->load->model('admin/accounts_model');
				$this->load->library('attraction/attraction_lib');
				
		}

		function index() {
			if(!$this->data['addpermission'] && !$this->editpermission && !$this->deletepermission){
            	backError_404($this->data);
            	
            }else{
				$xcrud = xcrud_get_instance();

				$xcrud->table('pt_attr_booking');

                /*if($this->role == "supplier"){
                $xcrud->where('hotel_owned_by',$this->data['userloggedin']);

                }*/
				//$xcrud->join('hotel_owned_by', 'pt_accounts', 'accounts_id');
				$xcrud->join('booking_user', 'pt_accounts', 'accounts_id');
				$xcrud->order_by('pt_attr_booking_id', 'desc');
				//$xcrud->subselect('Owned By', 'SELECT CONCAT(ai_first_name, " ", ai_last_name) FROM pt_accounts WHERE accounts_id = {hotel_owned_by}');
				/*$xcrud->label('ai_first_name', 'Name')->label('booking_ref_no', 'booking_ref_no')->label('booking_status', 'booking_status');*/
                if($this->editpermission){
                	$xcrud->button(base_url() . 'attraction/invoice/{pt_attr_booking_id}', 'View Invoice', 'fa fa-search-plus', 'btn btn-primary', array('target' => '_blank'));
                	/*
	                $xcrud->button(base_url() . $this->data['adminsegment'] . '/top_destinations/manage/{top_destinations_id}', 'Edit', 'fa fa-edit', 'btn btn-warning', array('target' => '_self'));
	                $xcrud->column_pattern('hotel_title', '<a href="' . base_url() . $this->data['adminsegment'] . '/top_destinations/manage/{top_destinations_id}' . '">{value}</a>');*/
	                $xcrud->button(base_url() . $this->data['adminsegment'] . '/attraction/manage/{pt_attr_booking_id}', 'Edit', 'fa fa-edit', 'btn btn-warning', array('target' => '_self'));
	             
	                $xcrud->column_pattern('pt_attr_booking_id', '<a href="' . base_url() . $this->data['adminsegment'] . '/attraction/manage/{pt_attr_booking_id}' . '">{value}</a>');
                
                }

                if($this->deletepermission){
	                $delurl = base_url().'admin/attractionajaxcalls/delattraction';	
	                //$xcrud->multiDelUrl = base_url().'admin/attractionajaxcalls/delMultipleattraction';
	                $xcrud->button("javascript: delfunc('{pt_attr_booking_id}','$delurl')",'DELETE','fa fa-times', 'btn-danger',array('target'=>'_self','id' => '{pt_attr_booking_id}'));
                }
                $xcrud->limit(50);
				$xcrud->unset_add();
				$xcrud->unset_edit();
				$xcrud->unset_remove();
				$xcrud->unset_view();
				$xcrud->column_width('hotel_order', '7%');
				$xcrud->columns('booking_ref_no,pt_accounts.ai_first_name,booking_total,booking_remaining,booking_checkin,booking_adults,booking_status');

				$xcrud->search_columns('pt_accounts.ai_first_name,booking_ref_no');
				$xcrud->label('pt_accounts.ai_first_name', 'User name');
				$xcrud->label('booking_ref_no', 'Ref. no');
				$xcrud->label('booking_checkin', 'Date');
				$xcrud->label('booking_adults', 'Adults');
				$xcrud->label('booking_status', 'Status');
				
				
				$this->data['content'] = $xcrud->render();
				$this->data['page_title'] = 'Attraction Booking Management';
				$this->data['main_content'] = 'temp_view';
				$this->data['header_title'] = 'Attraction Booking Management';
				//$this->data['add_link'] = base_url(). $this->data['adminsegment'] . '/attraction/add';
				$this->load->view('admin/template', $this->data);
			}

                
		}

		function manage($pt_attr_booking_id) {
			/*error_reporting(-1);*/
			if (empty ($pt_attr_booking_id)) {
				redirect($this->data['adminsegment'] . '/attraction/');
			}else{
			}
				//$pt_attr_booking_id =  $this->uri->segment(4);
			
			if(!$this->editpermission){
                 echo "<center><h1>Access Denied</h1></center>";
                 backError_404($this->data);
			}else{
				$updateattr = $this->input->post('submittype');
				$this->data['submittype'] = "update";
				if (!empty ($updateattr)) {
					$pt_attr_booking_id = $this->input->post('pt_attr_booking_id');
					
					$status = $this->input->post('status');
					$booking_ref_no = $this->input->post('booking_ref_no');
					
					if($status == 'cancelled'){
						$cancelled_data = $this->attraction_lib->cancel_booking($booking_ref_no);
						
						$data = array(
									'booking_status' => $status,
									'booking_payment_type' => '',
									'book_cancel_data' => $cancelled_data['msg']
									);
						
					}else{

						if($status == 'paid'){
							$this->attraction_model->attraction_paid_email($pt_attr_booking_id);
						}
						/*exit();*/
						
						$data = array(
									'booking_status' => $status,
									'booking_payment_type' => 'paystand',
									'booking_remaining' => 0
									);
					}

					$this->attraction_model->update_attr_booking($data,$pt_attr_booking_id);
					$this->session->set_flashdata('flashmsgs', 'Attraction Updated Successfully');
					redirect($this->data['adminsegment'] . '/attraction/');
						
				}else {
						
						
						$this->data['data'] = $this->attraction_model->get_attr_booking($pt_attr_booking_id);
						$profile = $this->accounts_model->get_profile_details($this->data['data']->booking_user);
						$this->data['profile'] = $profile[0];
						/*echo json_encode($profile);
						exit();*/
						$this->data['main_content'] = 'attraction/manage';
						$this->data['page_title'] = 'Manage Attraction';
						$this->data['headingText'] = 'Update Attraction';
						
						$this->load->view('admin/template', $this->data);
				}
			}
		}

		public function booking_paid_paystand(){
			error_reporting(-1);
			$pt_attr_booking_id  = $this->input->post('pt_attr_booking_id');
			$pay_data  = $this->input->post('pay_data');
			
			$data = array(
						'booking_status' => 'paid',
						'booking_payment_type' => 'paystand',
						'payment_data' => json_encode($pay_data),
						'booking_remaining' => 0
						);

			$this->attraction_model->update_attr_booking($data,$pt_attr_booking_id);
		}

}