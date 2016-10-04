<?php
if (!defined('BASEPATH'))
		exit ('No direct script access allowed');

class top_destinationsback extends MX_Controller {
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
						$chk = modules :: run('home/is_main_module_enabled', 'top_destinations');
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
				$this->load->library('ckeditor');
				$this->data['ckconfig'] = array();
				$this->data['ckconfig']['toolbar'] = array(array('Source', '-', 'Bold', 'Italic', 'Underline', 'Strike', 'Format', 'Styles'), array('NumberedList', 'BulletedList', 'Outdent', 'Indent', 'Blockquote'), array('Image', 'Link', 'Unlink', 'Anchor', 'Table', 'HorizontalRule', 'SpecialChar', 'Maximize'), array('Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo', 'Find', 'Replace', '-', 'SelectAll', '-', 'SpellChecker', 'Scayt'),);
				$this->data['ckconfig']['language'] = 'en';
				//$this->data['ckconfig']['filebrowserUploadUrl'] =  base_url().'home/cmsupload';
				$this->load->helper('hotels/hotels');
				$this->data['languages'] = pt_get_languages();
				$this->load->helper('xcrud');
				$this->data['c_model'] = $this->countries_model;
				$this->data['tripadvisor'] = $this->ptmodules->is_mod_available_enabled("tripadvisor");
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
				 $this->load->model('top_destinations/top_destinations_model');
				/*echo "AsdAS";
				exit();*/
		}

		function index() {
				if(!$this->data['addpermission'] && !$this->editpermission && !$this->deletepermission){
                	backError_404($this->data);
                	
                }else{
				$xcrud = xcrud_get_instance();

				$xcrud->table('top_destinations');

                /*if($this->role == "supplier"){
                $xcrud->where('hotel_owned_by',$this->data['userloggedin']);

                }*/
				//$xcrud->join('hotel_owned_by', 'pt_accounts', 'accounts_id');
				//$xcrud->join('hotel_city', 'pt_locations', 'id');
				$xcrud->order_by('top_destinations.top_destinations_id', 'desc');
				//$xcrud->subselect('Owned By', 'SELECT CONCAT(ai_first_name, " ", ai_last_name) FROM pt_accounts WHERE accounts_id = {hotel_owned_by}');
				$xcrud->label('name', 'Name')->label('latitude', 'Latitude')->label('longitude', 'Longitude');
                if($this->editpermission){
	                $xcrud->button(base_url() . $this->data['adminsegment'] . '/top_destinations/manage/{top_destinations_id}', 'Edit', 'fa fa-edit', 'btn btn-warning', array('target' => '_self'));
	                $xcrud->column_pattern('hotel_title', '<a href="' . base_url() . $this->data['adminsegment'] . '/top_destinations/manage/{top_destinations_id}' . '">{value}</a>');
                }

                if($this->deletepermission){
	                /*$delurl = base_url().'admin/top_destinations/deldestination';	
	                $xcrud->multiDelUrl = base_url().'admin/top_destinationsajaxcalls/delMultipledestination';
	                $xcrud->button("javascript: delfunc('{top_destinations_id}','$delurl')",'DELETE','fa fa-times', 'btn-danger',array('target'=>'_self','id' => '{top_destinations_id}'));*/
                }
                $xcrud->limit(50);
				$xcrud->unset_add();
				$xcrud->unset_edit();
				$xcrud->unset_remove();
				$xcrud->unset_view();
				$xcrud->column_width('hotel_order', '7%');
				$xcrud->columns('name,latitude,longitude,top_destinations_id');

				$xcrud->search_columns('name');
				/*$xcrud->label('pt_hotels.hotel_city', 'Location');
				$xcrud->label('thumbnail_image', 'Image');
				$xcrud->label('hotel_slug', 'Gallery');
				$xcrud->label('hotel_status', 'Status');*/
				$xcrud->label('top_destinations_id', 'Gallery');
				$xcrud->column_callback('hotel_stars', 'create_stars');
				$xcrud->column_callback('pt_hotels.hotel_order', 'orderInputHotels');
				$xcrud->column_callback('pt_hotels.hotel_is_featured', 'feature_stars');
				$xcrud->column_callback('top_destinations_id', 'topdestGallery');
				$xcrud->column_callback('hotel_status', 'create_status_icon');
				$xcrud->column_callback('hotel_city', 'locationsInfo');
				$xcrud->column_class('thumbnail_image', 'zoom_img');
				$xcrud->change_type('thumbnail_image', 'image', false, array('width' => 200, 'path' => '../../'.PT_HOTELS_SLIDER_THUMBS_UPLOAD, 'thumbs' => array(array('height' => 150, 'width' => 120, 'crop' => true, 'marker' => ''))));
				
				
				$this->data['content'] = $xcrud->render();
				$this->data['page_title'] = 'Destinations Management';
				$this->data['main_content'] = 'temp_view';
				$this->data['header_title'] = 'Destinations Management';
				$this->data['add_link'] = base_url(). $this->data['adminsegment'] . '/top_destinations/add';
				$this->load->view('admin/template', $this->data);
		}

                
		}

		function settings(){
				$isadmin = $this->session->userdata('pt_logged_admin');
				if (empty ($isadmin)) {
						redirect($this->data['adminsegment'] . '/hotels/');
				}
				$this->data['all_countries'] = $this->countries_model->get_all_countries();
				$updatesett = $this->input->post('updatesettings');
				$addsettings = $this->input->post('add');
				$updatetypesett = $this->input->post('updatetype');

				if (!empty ($updatesett)) {
						$this->hotels_model->updateHotelSettings();
						redirect('admin/hotels/settings');
				}

                if (!empty ($addsettings)) {
                    $id = $this->hotels_model->addSettingsData();
                    $this->hotels_model->updateSettingsTypeTranslation($this->input->post('translated'),$id);
                    redirect('admin/hotels/settings');

				}

                if (!empty ($updatetypesett)) {
                   $this->hotels_model->updateSettingsData();
                   $this->hotels_model->updateSettingsTypeTranslation($this->input->post('translated'),$this->input->post('settid'));
                    redirect('admin/hotels/settings');

				}

				$this->LoadXcrudHotelSettings("hamenities");
				$this->LoadXcrudHotelSettings("htypes");
				$this->LoadXcrudHotelSettings("hpayments");
				$this->LoadXcrudHotelSettings("ramenities");
				$this->LoadXcrudHotelSettings("rtypes");
                $this->data['typeSettings'] = $this->hotels_model->get_hotel_settings_data();
				$this->data['all_hotels'] = $this->hotels_model->all_hotels_names();
				@ $this->data['settings'] = $this->settings_model->get_front_settings("hotels");
				$this->data['main_content'] = 'hotels/settings';
				$this->data['page_title'] = 'Hotels Settings';
				$this->load->view('admin/template', $this->data);
		}
// Add Hotels

		public function add() {
				/*error_reporting(-1);*/
                if(!$this->data['addpermission']){
                 	backError_404($this->data);

				  }else{
	                $this->load->model('admin/uploads_model');
	               
					$addhotel = $this->input->post('submittype');

	                $this->data['submittype'] = "add";

					if (!empty ($addhotel)) {
							$this->form_validation->set_rules('name', 'Destination Name', 'trim|required');
							$this->form_validation->set_rules('latitude', 'Latitude', 'trim|required');
							$this->form_validation->set_rules('longitude', 'Longitude', 'trim|required');
							if ($this->form_validation->run() == FALSE) {
									echo '<div class="alert alert-danger">' . validation_errors() . '</div><br>';
							}
							else {
									$top_destinations_id = $this->top_destinations_model->add_destinations($this->data['userloggedin']);
									$this->session->set_flashdata('flashmsgs', 'Destination added Successfully');
									/*$this->data['main_content'] = 'top_destinations';
									$this->data['page_title'] = 'Add Destinations';
									$this->data['headingText'] = 'Add Destinations';
									*/
									redirect($this->data['adminsegment'] . '/top_destinations/');
							}
					}else {
							$this->data['main_content'] = 'top_destinations/manage';
							$this->data['page_title'] = 'Add Destinations';
							$this->data['headingText'] = 'Add Destinations';
							$this->load->model('admin/locations_model');
							$this->load->view('admin/template', $this->data);
					}
				}
		}

		function manage($destinationsslug) {
			if (empty ($destinationsslug)) {
					redirect($this->data['adminsegment'] . '/top_destinations/');
			}
               	if(!$this->editpermission){
	                echo "<center><h1>Access Denied</h1></center>";
	                backError_404($this->data);
				}else{
					$updatehotel = $this->input->post('submittype');
					$this->data['submittype'] = "update";
					$top_destinations_id = $this->input->post('top_destinations_id');
					if (!empty ($updatehotel)) {
							$this->form_validation->set_rules('name', 'Destination Name', 'trim|required');
							$this->form_validation->set_rules('latitude', 'Latitude', 'trim|required');
							$this->form_validation->set_rules('longitude', 'Longitude', 'trim|required');
							if ($this->form_validation->run() == FALSE) {
									echo '<div class="alert alert-danger">' . validation_errors() . '</div><br>';
							}
							else {
									$this->top_destinations_model->update_destinations($top_destinations_id);
									$this->session->set_flashdata('flashmsgs', 'Hotel Updated Successfully');
									redirect($this->data['adminsegment'] . '/top_destinations/');
							}
					}else {
							@ $this->data['hdata'] = $this->top_destinations_model->get_destinations_data($destinationsslug);
							
							$this->data['main_content'] = 'top_destinations/manage';
							$this->data['page_title'] = 'Manage Destinations';
							$this->data['headingText'] = 'Update ' . $this->data['hdata'][0]->name;
							$this->load->model('admin/locations_model');
							$this->data['locations'] = $this->locations_model->getLocationsBackend();
							$this->data['top_destinations_id'] = $this->data['hdata'][0]->top_destinations_id;
							$this->load->view('admin/template', $this->data);
					}
				}
		}

		/*function deldestination() {
	        
            $id = $this->input->post('id');
            $this->bookings_model->delete_booking($id);
            $this->session->set_flashdata('flashmsgs', "Deleted Successfully");
	        
	    }*/

		function translate($hotelslug, $lang = null) {
				$this->load->library('hotels/hotels_lib');
				$this->hotels_lib->set_hotelid($hotelslug);
				$add = $this->input->post('add');
				$update = $this->input->post('update');
				if (empty ($lang)) {
						$lang = $this->langdef;
				}
				else {
						$lang = $lang;
				}
				$this->data['lang'] = $lang;
				if (empty ($hotelslug)) {
						redirect($this->data['adminsegment'] . '/hotels/');
				}
				if (!empty ($add)) {
						$language = $this->input->post('langname');
						$hotelid = $this->input->post('hotelid');
						$this->hotels_model->add_translation($language, $hotelid);
						redirect($this->data['adminsegment'] . "/hotels/translate/" . $hotelslug . "/" . $language);
				}
				if (!empty ($update)) {
						$slug = $this->hotels_model->update_translation($lang, $hotelslug);
						redirect($this->data['adminsegment'] . "/hotels/translate/" . $slug . "/" . $lang);
				}
				$hdata = $this->hotels_lib->hotel_details();
				if ($lang == $this->langdef) {
						$hotelsdata = $this->hotels_lib->hotel_short_details();
						$this->data['hotelsdata'] = $hotelsdata;
						$this->data['transpolicy'] = $hotelsdata[0]->hotel_policy;
						$this->data['transadditional'] = $hotelsdata[0]->hotel_additional_facilities;
						$this->data['transdesc'] = $hotelsdata[0]->hotel_desc;
						$this->data['transtitle'] = $hotelsdata[0]->hotel_title;
				}
				else {
						$hotelsdata = $this->hotels_lib->translated_data($lang);
						$this->data['hotelsdata'] = $hotelsdata;
						$this->data['transid'] = $hotelsdata[0]->trans_id;
						$this->data['transpolicy'] = $hotelsdata[0]->trans_policy;
						$this->data['transadditional'] = $hotelsdata[0]->trans_additional;
						$this->data['transdesc'] = $hotelsdata[0]->trans_desc;
						$this->data['transtitle'] = $hotelsdata[0]->trans_title;
				}
				$this->data['hotelid'] = $this->hotels_lib->get_id();
				$this->data['lang'] = $lang;
				$this->data['slug'] = $hotelslug;
				$this->data['language_list'] = pt_get_languages();
				if ($this->data['adminsegment'] == "supplier") {
						if ($this->data['userloggedin'] != $hdata[0]->hotel_owned_by) {
								redirect($this->data['adminsegment'] . '/hotels/');
						}
				}
				$this->data['main_content'] = 'hotels/translate';
				$this->data['page_title'] = 'Translate Hotel';
				$this->load->view('admin/template', $this->data);
		}

		function gallery($id) {
			/*error_reporting(-1);
			echo $id;
			exit();*/
				$this->load->library('top_destinations/top_destinations_lib');
				/*$this->top_destinations_lib->set_hotelid($id);*/
				$this->data['itemid'] = $id;
				
				$this->data['images'] = $this->top_destinations_model->hotelGallery($id);
				/*echo json_encode($this->data['images']);
				exit;*/
                $this->data['uploadUrl'] = base_url().'top_destinations/top_destinationsback/galleryUpload/hotels/';
                $this->data['appRejUrl'] = base_url().'top_destinations/top_destinationsback/set_title/';
                $this->data['delimgUrl'] = base_url().'top_destinations/top_destinationsback/delete_image';
                $this->data['fullImgDir'] = PT_DEST_SLIDER;
                $this->data['thumbsDir'] = PT_DEST_SLIDER_THUMBS;
				$this->data['main_content'] = 'top_destinations/gallery';
				$this->data['page_title'] = 'Destinations Gallery';
				$this->load->view('admin/template', $this->data);
		}

      
		function galleryUpload($type, $id) {
				$this->load->library('image_lib');
				if (!empty ($_FILES)) {
						$tempFile = $_FILES['file']['tmp_name'];
						$fileName = $_FILES['file']['name'];
						$fileName = str_replace(" ", "-", $_FILES['file']['name']);
						$fig = rand(1, 999999);
						$saveFile = $fig . '_' . $fileName;

						if (strpos($fileName,'php') !== false) {

						}else{

                        if($type == "hotels"){
							$targetPath = PT_DEST_SLIDER_UPLOAD;
                        }

						$targetFile = $targetPath . $saveFile;
						move_uploaded_file($tempFile, $targetFile);
						$config['image_library'] = 'gd2';
						$config['source_image'] = $targetFile;
                        if($type == "hotels"){
							$config['new_image'] = PT_DEST_SLIDER_THUMBS_UPLOAD;
                        }

						$config['thumb_marker'] = '';
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = TRUE;
						$config['width'] = THUMB_WIDTH;
						$config['height'] = THUMB_HEIGHT;
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						$this->image_lib->resize();

						modules :: run('admin/watermark/apply',$targetFile);

                        if($type == "hotels"){
                    		/* Add images name to database with respective hotel id */
							$this->top_destinations_model->addPhotos($id, $saveFile);
                        }

                    }
				}
		}

		function set_title(){
			$imgid = $this->input->post('imgid');
			$img_name = $this->input->post('img_name');
			echo $this->top_destinations_model->update_destinations_image_title($imgid,$img_name);
		}

		function delete_image(){
			$imgid = $this->input->post('imgid');
			$imgname = $this->input->post('imgname');
			echo $this->top_destinations_model->delete_destinations_image($imgid,$imgname);
		}

		function LoadXcrudHotelSettings($type) {
				$xc = "xcrud" . $type;
				$xc = xcrud_get_instance();
				$xc->table('pt_hotels_types_settings');
				$xc->where('sett_type', $type);
				$xc->order_by('sett_id', 'desc');
				$xc->button('#sett{sett_id}', 'Edit', 'fa fa-edit', 'btn btn-warning', array('data-toggle' => 'modal'));
				$delurl = base_url().'admin/hotelajaxcalls/delTypeSettings';	
               	$xc->button("javascript: delfunc('{sett_id}','$delurl')",'DELETE','fa fa-times', 'btn-danger',array('target'=>'_self','id' => '{sett_id}'));
                

                if($type == "rtypes" || $type == "htypes"){
                $xc->columns('sett_name,sett_status');
                }else{
                 if($type == "hamenities"){
                 $xc->columns('sett_img,sett_name,sett_selected,sett_status');
                $xc->column_class('sett_img', 'zoom_img');
				$xc->change_type('sett_img', 'image', false, array('width' => 200, 'path' => '../../'.PT_HOTELS_ICONS_UPLOAD, 'thumbs' => array(array('height' => 150, 'width' => 120, 'crop' => true, 'marker' => ''))));

                 }else{
                $xc->columns('sett_name,sett_selected,sett_status');
                }

                 }
                $xc->search_columns('sett_name,sett_selected,sett_status');
                $xc->label('sett_name', 'Name')->label('sett_selected', 'Selected')->label('sett_status', 'Status')->label('sett_img', 'Icon');
                $xc->unset_add();
				$xc->unset_edit();
				$xc->unset_remove();
				$xc->unset_view();
				$xc->multiDelUrl = base_url().'admin/hotelajaxcalls/delMultiTypeSettings/'.$type;	
				$this->data['content' . $type] = $xc->render();
		}

        function extras(){
         
		
			if($this->data['adminsegment'] == "supplier"){

				 $supplierHotels = $this->hotels_model->all_hotels($this->data['userloggedin']);
				 $allhotels = $this->hotels_model->all_hotels();
			
				 echo  modules :: run('admin/extras/listings','hotels',$allhotels, $supplierHotels);

			}else{


				 $hotels = $this->hotels_model->all_hotels();

				echo  modules :: run('admin/extras/listings','hotels',$hotels);

			}
	
         
        }

        function reviews(){
         
         echo  modules :: run('admin/reviews/listings','hotels');
        }

}