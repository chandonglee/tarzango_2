<?php

class Locations_model extends CI_Model {
	private $userloggedin;
	private $isSuperAdmin;

		function __construct() {
// Call the Model constructor
				parent :: __construct();
				$this->userloggedin = $this->session->userdata('pt_logged_id');
   				$this->isSuperAdmin = $this->session->userdata('pt_logged_super_admin');
		}

		//get locations list admin panel
		function getLocationsBackend($id){

			$this->db->where('status','yes');
			$this->db->order_by('id','desc');
			return $this->db->get('pt_locations')->result();

		}

		// get number of photos of location
		function photos_count($locationsid) {
				$this->db->where('limg_locations_id', $locationsid);
				return $this->db->get('pt_locations_images')->num_rows();
		}

		//get details of location
		function getLocationDetails($id, $lang = null){
			$this->db->where('id',$id);
			
			if(!empty($this->userloggedin)){
		
				if(!$this->isSuperAdmin){
					$this->db->where('user',$this->userloggedin);
				}else{
					$user = "";
				}
			}

			$result = $this->db->get('pt_locations')->result();

			$response = new stdClass;
			$response->country = $result[0]->country;
			if(!empty($result[0]->location)){
				$response->isValid = TRUE;
			}else{
				$response->isValid = FALSE;
			}
			
			if(empty($lang) || $lang == DEFLANG){

				$response->city = $result[0]->location;	
			
			}else{

				$this->db->where('loc_id',$id);
				$this->db->where('trans_lang',$lang);
				$Transresult = $this->db->get('pt_locations_translation')->result();
				/*print_r($Transresult[0]);
				exit();*/
				if(empty($Transresult[0]->loc_name)){

					$response->city = $result[0]->location;		

				}else{

					$response->city = $Transresult[0]->loc_name;	
				
				}
					

			}
			
			$response->latitude = $result[0]->latitude;
			$response->longitude = $result[0]->longitude;
			$response->status = $result[0]->status;
			$response->id = $id;
			/*print_r($response);*/
			return $response;

		}

		// add location
		function addLocation() {
			if(!$this->isSuperAdmin){
				$user = $this->userloggedin;
			}else{
				$user = "";
			}

				$data = array(
					'location' => $this->input->post('city'), 
					'country' => $this->input->post('country'), 
					'latitude' => $this->input->post('latitude'), 
					'longitude' => $this->input->post('longitude'), 
					'user' => $user,
					'status' => $this->input->post('status')
					);
				$this->db->insert('pt_locations', $data);
                $locid = $this->db->insert_id();
                $this->upload_location_img($locid,$this->input->post('city'));
                $this->updateLocationsTranslation($this->input->post('translated'),$locid);
		}

		function get_location_img($locid){
			/*echo $locid;*/
			$this->db->where('limg_locations_id',$locid);
        	$result = $this->db->get('pt_locations_images')->result();

        	return $result[0]->limg_image;
        	
		}

		function get_location_img_by_city($city){
			/*echo $locid;*/
			$this->db->where('limg_location',$city);
        	$result = $this->db->get('pt_locations_images')->result();

        	return $result[0]->limg_image;
        	
		}

		function upload_location_img($locid,$limg_location){
			/*error_reporting(E_ALL);*/

			$config['upload_path'] = 'uploads/images/location_img/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->set_allowed_types('*');
            $data['upload_data'] = '';
            if (!$this->upload->do_upload('location_image')) {
                $image_upload_data = array('is_upload' => false);
            } else { 
                $image_upload_data['is_upload'] = true;
                $image_upload_data['upload_data'] = $this->upload->data();
            }

			$this->db->where('limg_locations_id',$locid);
        	$nums = $this->db->get('pt_locations_images')->num_rows();

        	if($nums == 0){
				
                if($image_upload_data['is_upload'] == 1){
                	$img_data = array(
                						'limg_locations_id' => $locid,
                						'limg_location' => $limg_location,
                						'limg_image' => $image_upload_data['upload_data']['file_name']
                						);

                	$this->db->insert('pt_locations_images', $img_data);
                }
            }else{
            	
            	if($image_upload_data['is_upload'] == 1){
                	
                	$img_data = array(
                						'limg_location' => $limg_location,
                						'limg_image' => $image_upload_data['upload_data']['file_name']
                						);

                	$this->db->where('limg_locations_id', $locid);
					$this->db->update('pt_locations_images', $img_data);
                }

            }
		}

		// update location
		function updateLocation($locid) {
				
				$this->upload_location_img($locid,$this->input->post('city'));
				/*exit();*/
				$data = array(
					'location' => $this->input->post('city'), 
					'country' => $this->input->post('country'), 
					'latitude' => $this->input->post('latitude'), 
					'longitude' => $this->input->post('longitude'), 
					'status' => $this->input->post('status')
					);

				$this->db->where('id', $locid);
				$this->db->update('pt_locations', $data);

                $this->updateLocationsTranslation($this->input->post('translated'),$locid);
		}

		//delete location
		function delete_loc($id){
			$this->db->where('loc_id', $id);
			$this->db->delete('pt_locations_translation');

			$this->db->where('id', $id);
			$this->db->delete('pt_locations');

		}

		//update location translation

	   function updateLocationsTranslation($postdata,$id) {

       foreach($postdata as $lang => $val){
		     if(array_filter($val)){
		        $name = $val['name'];

                $transAvailable = $this->getLocationsTranslation($lang,$id);

                if(empty($transAvailable)){
                 $data = array(
                'loc_name' => $name,
                'loc_id' => $id,
                'trans_lang' => $lang
                );
				$this->db->insert('pt_locations_translation', $data);

                }else{

                 $data = array(
                'loc_name' => $name
                );
				$this->db->where('loc_id', $id);
				$this->db->where('trans_lang', $lang);
			    $this->db->update('pt_locations_translation', $data);

              }


              }

                }
		}


		function getLocationsTranslation($lang,$id){

            $this->db->where('trans_lang',$lang);
            $this->db->where('loc_id',$id);
            return $this->db->get('pt_locations_translation')->result();

        }

        function isUserLocation($id, $locid){
        	$this->db->where('user',$id);
        	$this->db->where('id',$locid);
        	$nums = $this->db->get('pt_locations')->num_rows();

        	if($nums > 0){
        		return TRUE;
        	}else{
        		return FALSE;
        	}
        }

        function alreadyExists(){

        	$this->db->where('latitude',$this->input->post('latitude'));
        	$this->db->where('longitude',$this->input->post('longitude'));
        	$nums = $this->db->get('pt_locations')->num_rows();

        	if($nums > 0){
        		$this->session->set_flashdata('msg', 'Location Already Exists');
        		return TRUE;
        	}else{
        		return FALSE;
        	}
        }

}