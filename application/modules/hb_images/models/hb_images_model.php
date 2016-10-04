<?php

class Hb_images_model extends CI_Model {
        public $langdef;
        public $isSuperAdmin = null;
		function __construct() {
// Call the Model constructor
				parent :: __construct();
                $this->langdef = DEFLANG;
                $this->isSuperAdmin = $this->session->userdata('pt_logged_super_admin');
		}

		function hotelGallery($slug){
			
          $this->db->select('*');
          $this->db->where('iHotelID',$slug);
          
          $imd_Data =  $this->db->get('pt_hbhotelimages')->result();
          
           return$imd_Data;
        }

        function hb_hotels($slug){
			
          $this->db->select('*');
          $this->db->where('iHotelID',$slug);
          
          $imd_Data =  $this->db->get('pt_hbhotels')->row_array();
          
           return $imd_Data;
        }

        function addPhotos($id,$filename){
		        //add photos to hotel images table
        		/*error_reporting(-1);*/
		        $imgorder = 0;
		        $this->db->where('iHotelID', $id);
		        $imgorder = $this->db->get('pt_hbhotelimages')->num_rows();
		        $imgorder = $imgorder + 1;

				$approval = pt_admin_gallery_approve();
		    	$insdata = array(
                'iHotelID' => $id,
                'sHbHotelImage' => $filename,
                'isActive' => $approval
                );
				$this->db->insert('pt_hbhotelimages', $insdata);
				/*echo $this->db->last_query();
				exit();*/

        }

        // update hotel data
		function update_hb_image_title($id,$image_title) {

			
            $data = array(
			                'sTitle' => $image_title,
			                );

			$this->db->where('iImageID', $id);
			$this->db->update('pt_hbhotelimages', $data);

		}

        // update hotel data
		function update_hb_images($id) {

			//Remove room id...
			
			if ( $this->input->post('removeID') != ""){
				$removeID = rtrim($this->input->post('removeID'),',');
				$removeID = explode(',', $removeID);

				sort($removeID);
			} else {
				$removeID = array();
			}

			$roomID = rtrim($this->input->post('iRoomID'),',');
			$roomID = explode(',', $roomID);
			
			
			$config['upload_path'] = '/uploads/images/hbrooms/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload',$config);


			// HB Hotel updated here.....
				$data = array(
				       'iHbHotelID' => $this->input->post('iHbHotelID'),
			            'sHbHotelName' => $this->input->post('sHbHotelName'),
			        );

				$this->db->where('iHotelID', $id);
				$this->db->update('pt_hbhotels', $data);
				

				if ( $roomID > 0){
			for($i=0; $i<count($roomID); $i++)
			{

				if ( in_array( $roomID[$i], $removeID) && !empty($removeID)) {
					
					$this->db->where('iRoomID', $roomID[$i]);
					$this->db->delete('pt_hbrooms');
				} else {
			
				$rand_no  = rand(0,999999999999);
				$newImages = '';

				if ( $_FILES['sRoomImage'.$roomID[$i]]['name'] != "") {

					$imageExt  = pathinfo($_FILES['sRoomImage'.$roomID[$i]]['name'], PATHINFO_EXTENSION);
					$imageName = pathinfo($_FILES['sRoomImage'.$roomID[$i]]['name'], PATHINFO_FILENAME);

				move_uploaded_file($_FILES['sRoomImage'.$roomID[$i]]['tmp_name'], "uploads/images/hbrooms/".$rand_no.$imageName.'.'.$imageExt);	

					$newImages = $rand_no.$imageName.'.'.$imageExt;

				} else {
					$newImages = $_POST['sRoomImageold'.$roomID[$i]];
				}	
				
           
				$data = array(
					'iHotelID' => $id,
					'sRoomName' => $_POST['sRoomName'.$roomID[$i]],
			        'sRoomImage' => $newImages,
				);

				$this->db->where('iRoomID', $roomID[$i]);
				$this->db->update('pt_hbrooms', $data);

			}
		}
		}


				// Room added here.....

			$cpt = count($_FILES['sRoomImage']['name']);

			if ( $cpt > 0){
			for($i=0; $i<$cpt; $i++)
			{
				$rand_no  = rand(0,999999999999);

				$imageExt  = pathinfo($_FILES['sRoomImage']['name'][$i], PATHINFO_EXTENSION);
				$imageName = pathinfo($_FILES['sRoomImage']['name'][$i], PATHINFO_FILENAME);

				move_uploaded_file($_FILES['sRoomImage']['tmp_name'][$i], "uploads/images/hbrooms/".$rand_no.$imageName.'.'.$imageExt);
           
				$data = array(
					'iHotelID' => $id,
					'sRoomName' => $_POST['sRoomName'][$i],
			        'sRoomImage' => $rand_no.$imageName.'.'.$imageExt,
			        'isActive' => 1,
				);

				$this->db->insert('pt_hbrooms', $data);

			}
		}

            

		}

//update hotel thumbnail
		function updateHotelThumb($hotelid,$imgname,$action) {
		  if($action == "delete"){
            $this->db->select('sThumbnail');
            $this->db->where('sThumbnail',$imgname);
            $this->db->where('iHotelID',$hotelid);
            $rs = $this->db->get('pt_hbhotels')->num_rows();
            if($rs > 0){
              $data = array(
              'sThumbnail' => PT_BLANK_IMG
              );
              $this->db->where('iHotelID',$hotelid);
              $this->db->update('pt_hbhotels',$data);
            }
            }else{
              $data = array(
              'sThumbnail' => $imgname
              );
              $this->db->where('iHotelID',$hotelid);
              $this->db->update('pt_hbhotels',$data);
            }

		}
		
		// Delete Hotel Images
		function delete_hb_image($imgid, $imgname) {
				$this->db->where('iImageID', $imgid);
				$this->db->delete('pt_hbhotelimages');
               
                @ unlink(PT_HB_SLIDER_THUMBS_UPLOAD . $imgname);
				@ unlink(PT_HB_SLIDER_UPLOAD . $imgname);

		}

		// get number of photos of hotel
		function photos_count($hotelid) {
				$this->db->where('iHotelID', $hotelid);
				return $this->db->get('pt_hbhotelimages')->num_rows();
		}

		// add hotel data
		function add_hb_images($user = null) {
			if(empty($user)){
				$user = 1;
			}
			
			$cpt = count($_FILES['sRoomImage']['name']);
			

            
			$config['upload_path'] = '/uploads/images/hbrooms/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload',$config);


			// HB Hotel added here.....
				$data = array(
				       'iHbHotelID' => $this->input->post('iHbHotelID'),
			            'sHbHotelName' => $this->input->post('sHbHotelName'),
			            'isActive' => 1,
			        );

				$this->db->insert('pt_hbhotels', $data);
				$hb_hotelID = $this->db->insert_id();
				
				// Room added here.....

			if ( $cpt > 0){
			for($i=0; $i<$cpt; $i++)
			{
				$rand_no  = rand(0,999999999999);

				$imageExt  = pathinfo($_FILES['sRoomImage']['name'][$i], PATHINFO_EXTENSION);
				$imageName = pathinfo($_FILES['sRoomImage']['name'][$i], PATHINFO_FILENAME);

				move_uploaded_file($_FILES['sRoomImage']['tmp_name'][$i], "uploads/images/hbrooms/".$rand_no.$imageName.'.'.$imageExt);
           // $config['file_name'] = $imageName.'.'.$imageExt;
            
           //$this->upload->initialize($config);
          //  $this->upload->set_allowed_types('*');
            

           /* if (!$this->upload->do_upload()) {
                echo $this->upload->display_errors();
            } else { 
                $image_upload_data['is_upload'] = true;
                $image_upload_data['upload_data'] = $this->upload->data();
            }*/


				$data = array(
					'iHotelID' => $hb_hotelID,
					'sRoomName' => $_POST['sRoomName'][$i],
			        'sRoomImage' => $rand_no.$imageName.'.'.$imageExt,
			        'isActive' => 1,
				);

				$this->db->insert('pt_hbrooms', $data);

			}
		}

				return $hb_hotelID;
		}


		// get all data of single hotel by slug
		function get_hbhotel_data($hotelslug) {

				$this->db->select('*');
				$this->db->where('iHotelID', $hotelslug);
				/* $this->db->where('pt_hotel_images.himg_type','default');

				$this->db->join('pt_hotel_images','pt_hotels.hotel_id = pt_hotel_images.himg_hotel_id','left');*/
				return $this->db->get('pt_hbhotels')->result();
		}

// get all data of single room by hotel ref
		function get_hbhotel_room_data($hotelslug) {

				$this->db->select('*');
				$this->db->where('iHotelID', $hotelslug);
				/* $this->db->where('pt_hotel_images.himg_type','default');

				$this->db->join('pt_hotel_images','pt_hotels.hotel_id = pt_hotel_images.himg_hotel_id','left');*/
				return $this->db->get('pt_hbrooms')->result();
		}
		
// Get all enabled hotels short info
		function shortInfo($id = null) {
				$result = array();
				$this->db->select('hotel_id,hotel_title,hotel_slug');
				if (!empty ($id)) {
						$this->db->where('hotel_owned_by', $id);
				}
				$this->db->where('hotel_status', 'Yes');
				$this->db->order_by('hotel_id', 'desc');
				$hotels = $this->db->get('pt_hotels')->result();
				foreach($hotels as $hotel){
					$result[] = (object)array('id' => $hotel->hotel_id, 'title' => $hotel->hotel_title, 'slug' => $hotel->hotel_slug);
				}

				return $result;
		}


// Get all hotels id and names only
		function all_destinations($id = null) {
				$this->db->select('*');
				//$this->db->order_by('hotel_id', 'desc');
				if (!empty ($id)) {
					$this->db->where('top_destinations_id', $id);
				}
				return $this->db->get('top_destinations')->result();
		}

// Get all hotels for extras
		function all_dest_images($id = null) {
				$this->db->select('*');
				if (!empty ($id)) {
					$this->db->where('himg_top_destinations_id', $id);
				}
				$this->db->order_by('himg_top_destinations_id', 'desc');
				return $this->db->get('pt_destinations_images')->result();
		}



// get data of single hotel by id for maps
		function hotel_data_for_map($id) {
				$this->db->select('pt_hotels.hotel_id,pt_hotels.hotel_title,pt_hotels.hotel_slug');
				$this->db->where('pt_hotels.hotel_id', $id);
/*  $this->db->where('pt_hotel_images.himg_type','default');

$this->db->where('pt_hotel_images.himg_approved','1');

$this->db->join('pt_hotel_images','pt_hotels.hotel_id = pt_hotel_images.himg_hotel_id','left');*/
				return $this->db->get('pt_hotels')->result();
		}




// add hotel images by type
		function add_hotel_image($type, $filename, $hotelid) {
				$imgorder = 0;

             			$this->db->where('himg_type', 'slider');
						$this->db->where('himg_hotel_id', $hotelid);
						$imgorder = $this->db->get('pt_hotel_images')->num_rows();
						$imgorder = $imgorder + 1;
			 $approval = pt_admin_gallery_approve();
				$this->db->where('himg_type', 'default');
				$this->db->where('himg_hotel_id', $hotelid);
				$hasdefault = $this->db->get('pt_hotel_images')->num_rows();
				if ($hasdefault < 1) {
						$type = 'default';
				}
				$data = array('himg_hotel_id' => $hotelid, 'himg_type' => $type, 'himg_image' => $filename, 'himg_order' => $imgorder, 'himg_approved' => $approval);
				$this->db->insert('pt_hotel_images', $data);
		}

// update hotel image by type
		function update_hotel_image($type, $filename, $hotelid) {
				$data = array('himg_image' => $filename);
				$this->db->where("himg_type", $type);
				$this->db->where("himg_hotel_id", $hotelid);
				$this->db->update('pt_hotel_images', $data);
		}

// update hotel order
		function update_hotel_order($id, $order) {
				$data = array('hotel_order' => $order);
				$this->db->where('hotel_id', $id);
				$this->db->update('pt_hotels', $data);
		}
// Disable Hotel

		public function disable_hotel($id) {
				$data = array('hotel_status' => '0');
				$this->db->where('hotel_id', $id);
				$this->db->update('pt_hotels', $data);
		}
// Enable Hotel

		public function enable_hotel($id) {
				$data = array('hotel_status' => '1');
				$this->db->where('hotel_id', $id);
				$this->db->update('pt_hotels', $data);
		}

// update featured status
		function update_featured() {
			   //	$forever = $this->input->post('foreverfeatured');
				$isfeatured = $this->input->post('isfeatured');
                $id = $this->input->post('id');
                
                if($isfeatured == "no"){
					$isforever = '';
				}else{

				$isforever = "forever";
				
				}

			   /*	if ($isfeatured == '1') {
						if ($forever == "forever") {
								$ffrom = date('Y-m-d');
								$fto = date('Y-m-d', strtotime('+1 years'));
								$isforever = 'forever';
						}
						else {
								$ffrom = $this->input->post('ffrom');
								$fto = $this->input->post('fto');
								$isforever = '';
						}
				}
				else {
						$ffrom = '';
						$fto = '';
						$isforever = 'forever';
				}*/

				//$data = array('hotel_is_featured' => $isfeatured, 'hotel_featured_from' => convert_to_unix($ffrom), 'hotel_featured_to' => convert_to_unix($fto), 'hotel_featured_forever' => $isforever);
			    $data = array('hotel_is_featured' => $isfeatured, 'hotel_featured_forever' => $isforever);
				$this->db->where('hotel_id', $id);
				$this->db->update('pt_hotels', $data);

		}





// Get Hotel Images
		function hotel_images($id) {
				/*$this->db->where('himg_hotel_id', $id);
				$this->db->where('himg_type', 'default');
				$this->db->order_by('himg_id', 'desc');
				$q = $this->db->get('pt_hotel_images');
				$data['def_image'] = $q->result();*/
				$this->db->where('himg_type', 'slider');
				$this->db->order_by('himg_id', 'desc');
				$this->db->having('himg_hotel_id', $id);
				$q = $this->db->get('pt_hotel_images');
				$data['all_slider'] = $q->result();
				$data['slider_counts'] = $q->num_rows();
				/*$this->db->where('himg_hotel_id', $id);
				$this->db->where('himg_type', 'interior');
				$this->db->order_by('himg_id', 'desc');
				$q2 = $this->db->get('pt_hotel_images');
				$data['all_interior'] = $q2->result();
				$data['interior_counts'] = $q2->num_rows();
				$this->db->where('himg_hotel_id', $id);
				$this->db->where('himg_type', 'exterior');
				$this->db->order_by('himg_id', 'desc');
				$q3 = $this->db->get('pt_hotel_images');
				$data['all_exterior'] = $q3->result();
				$data['exterior_counts'] = $q3->num_rows();*/
				return $data;
		}

function hbhotel_images($id) {
				
				$this->db->where('iHotelID', $id);
				$q = $this->db->get('pt_hbhotelimages');
				return $q->result();
		}

//update hotel thumbnail
		function update_thumb($oldthumb, $newthumb, $hotelid) {
				$data = array('himg_type' => 'slider');
				$this->db->where('himg_id', $oldthumb);
				$this->db->where('himg_hotel_id', $hotelid);
				$this->db->update('pt_hotel_images', $data);
				$data2 = array('himg_type' => 'default');
				$this->db->where('himg_id', $newthumb);
				$this->db->where('himg_hotel_id', $hotelid);
				$this->db->update('pt_hotel_images', $data2);
		}

// update image order
		function update_image_order($imgid, $order) {
				$data = array('himg_order' => $order);
				$this->db->where('himg_id', $imgid);
				$this->db->update('pt_hotel_images', $data);
		}


// get number of rooms of hotel
		function rooms_count($hotelid) {
				$this->db->where('room_hotel', $hotelid);
				$this->db->select_sum('room_quantity');
				$res = $this->db->get('pt_rooms')->result();
				return $res[0]->room_quantity;
		}

// get number of reviews of hotel
		function reviews_count($hotelid) {
				$this->db->where('review_itemid', $hotelid);
				$this->db->where('review_module', 'hotels');
				return $this->db->get('pt_reviews')->num_rows();
		}




// get default image of hotel
		function default_hotel_img($id) {
				$this->db->select('thumbnail_image');
				$this->db->where('hotel_id', $id);
				$res = $this->db->get('pt_hotels')->result();
				return $res[0]->thumbnail_image;
		}

// Approve or reject Hotel Images
		function approve_reject_images() {
				$data = array('himg_approved' => $this->input->post('apprej'));
				$this->db->where('himg_id', $this->input->post('imgid'));

                return $this->db->update('pt_hotel_images', $data);
		}


function delete_hbhotel($hotelid) {

				$hotelimages = $this->hbhotel_images($hotelid);

				foreach ($hotelimages as $sliderimg) {
					
						@ unlink(PT_HB_SLIDER_THUMBS_UPLOAD . $sliderimg->sHbHotelImage);
						@ unlink(PT_HB_SLIDER_UPLOAD . $sliderimg->sHbHotelImage);
					
				}

			    $this->db->select('sRoomImage');
				$this->db->where('iHotelID', $hotelid);
				$rooms = $this->db->get('pt_hbrooms')->result();

				foreach ($rooms as $r) {
						echo $r->sRoomImage;
					@ unlink('uploads/images/hbrooms/' . $r->sRoomImage);
					

						
            $this->db->where('iHotelID',$hotelid);
            $this->db->delete('pt_hbrooms');
        
    
				}
			  
				$this->db->where('iHotelID',$hotelid);
				$this->db->delete('pt_hbhotels');
		}

// Delete Hotel
		function delete_hotel($hotelid) {
				$hotelimages = $this->hotel_images($hotelid);
				foreach ($hotelimages['all_slider'] as $sliderimg) {
						$this->delete_image($sliderimg->himg_image,$sliderimg->himg_id, $hotelid);
				}

			    $this->db->select('room_id,room_hotel');
				$this->db->where('room_hotel', $hotelid);
				$rooms = $this->db->get('pt_rooms')->result();
				foreach ($rooms as $r) {
						$this->db->select('rimg_room_id,rimg_image');
						$this->db->where('rimg_room_id', $r->room_id);
						$roomimgs = $this->db->get('pt_room_images')->result();
						foreach ($roomimgs as $rmimg) {
								@ unlink(PT_ROOMS_THUMBS_UPLOAD . $rmimg->rimg_image);
								@ unlink(PT_ROOMS_IMAGES_UPLOAD . $rmimg->rimg_image);

								$this->db->where('rimg_room_id', $rmimg->rimg_room_id);
								$this->db->delete('pt_room_images');
						}

 			$this->db->where('room_id',$r->room_id);
            $this->db->delete('pt_rooms_availabilities');

            $this->db->where('room_id',$r->room_id);
            $this->db->delete('pt_rooms_prices');
        
        	

                $this->db->where('item_id', $r->room_id);
                $this->db->delete('pt_rooms_translation');

				}
			  
				$this->db->where('room_hotel', $hotelid);
				$this->db->delete('pt_rooms');

				$this->db->where('review_itemid', $hotelid);
				$this->db->where('review_module', 'hotels');
				$this->db->delete('pt_reviews');

                $this->db->where('item_id', $hotelid);
                $this->db->delete('pt_hotels_translation');

				$this->db->where('hotel_id', $hotelid);
				$this->db->delete('pt_hotels');
		}


// Disable hotel settings
		function disable_settings($id) {
				$data = array('sett_status' => 'No');
				$this->db->where('sett_id', $id);
				$this->db->update('pt_hotels_types_settings', $data);
		}

// Enable hotel settings
		function enable_settings($id) {
				$data = array('sett_status' => 'Yes');
				$this->db->where('sett_id', $id);
				$this->db->update('pt_hotels_types_settings', $data);
		}



// Check by slug
		function hotel_exists($slug) {
				$this->db->select('hotel_id');
				$this->db->where('hotel_slug', $slug);
				$this->db->where('hotel_status', 'Yes');
				$nums = $this->db->get('pt_hotels')->num_rows();
				if ($nums > 0) {
						return true;
				}
				else {
						return false;
				}
		}

// List all hotels on front listings page
		function list_hotels_front($perpage = null, $offset = null, $orderby = null) {
				$data = array();
               // $hotelslist = $lists['hotels'];
				if ($offset != null) {
						$offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
				}
				$this->db->select('pt_hotels.hotel_id,pt_hotels.hotel_stars,pt_hotels.hotel_title,pt_hotels.hotel_order,pt_hotels.hotel_order,pt_rooms.room_basic_price as price');
				if ($orderby == "za") {
						$this->db->order_by('pt_hotels.hotel_title', 'desc');
				}
				elseif ($orderby == "az") {
						$this->db->order_by('pt_hotels.hotel_title', 'asc');
				}
				elseif ($orderby == "oldf") {
						$this->db->order_by('pt_hotels.hotel_id', 'asc');
				}
				elseif ($orderby == "newf") {
						$this->db->order_by('pt_hotels.hotel_id', 'desc');
				}
				elseif ($orderby == "ol") {
						$this->db->order_by('pt_hotels.hotel_order', 'asc');
				}
				elseif ($orderby == "p_lh") {
						$this->db->order_by('pt_rooms.room_basic_price', 'asc');
				}
				elseif ($orderby == "p_hl") {
						$this->db->order_by('pt_rooms.room_basic_price', 'desc');
				}
				elseif ($orderby == "s_lh") {
						$this->db->order_by('pt_hotels.hotel_stars', 'asc');
				}
				elseif ($orderby == "s_hl") {
						$this->db->order_by('pt_hotels.hotel_stars', 'desc');
				}
               // $this->db->where_in('pt_hotels.hotel_id', $hotelslist);
				//$this->db->select_avg('pt_reviews.review_overall', 'overall');
				$this->db->group_by('pt_hotels.hotel_id');
                $this->db->join('pt_rooms', 'pt_hotels.hotel_id = pt_rooms.room_hotel', 'left');
			    //$this->db->join('pt_reviews', 'pt_hotels.hotel_id = pt_reviews.review_itemid', 'left');
				$this->db->where('pt_hotels.hotel_status', 'Yes');
				$query = $this->db->get('pt_hotels', $perpage, $offset);
				$data['all'] = $query->result();
				$data['rows'] = $query->num_rows();
				return $data;
		}

// Search hotels from home page
		function search_hotels_front($perpage = null, $offset = null, $orderby = null, $cities = null,$lists = null) {
				$data = array();
				$checkin = $this->input->get('checkin');
				$checkout = $this->input->get('checkout');
				$adult = $this->input->get('adults');
				$child = $this->input->get('child');
				$types = $this->input->get('type');
				$amenities = $this->input->get('amenities');
				$groups = $this->input->get('group');
				$categories = $this->input->get('category');
				$stars = $this->input->get('stars');
				$sprice = $this->input->get('price');
				$days = pt_count_days($checkin, $checkout);
                $checkindate = convert_to_unix($checkin);
                $checkoutdate = convert_to_unix($checkout);
                //$hotelslist = $lists['hotels'];
                //$roomslist = $lists['rooms'];
				if ($offset != null) {
						$offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
				}

            	$this->db->select("pt_hotels.*,pt_rooms.room_basic_price as price");
				if ($orderby == "za") {
						$this->db->order_by('pt_hotels.hotel_title', 'desc');
				}
				elseif ($orderby == "az") {
						$this->db->order_by('pt_hotels.hotel_title', 'asc');
				}
				elseif ($orderby == "oldf") {
						$this->db->order_by('pt_hotels.hotel_id', 'asc');
				}
				elseif ($orderby == "newf") {
						$this->db->order_by('pt_hotels.hotel_id', 'desc');
				}
				elseif ($orderby == "ol") {
						$this->db->order_by('pt_hotels.hotel_order', 'asc');
				}
				elseif ($orderby == "p_lh") {
				    	$this->db->order_by('pt_rooms.room_basic_price', 'asc');

				}
				elseif ($orderby == "p_hl") {
				   	$this->db->order_by('pt_rooms.room_basic_price', 'desc');

				}
				elseif ($orderby == "s_lh") {
						$this->db->order_by('pt_hotels.hotel_stars', 'asc');
				}
				elseif ($orderby == "s_hl") {
						$this->db->order_by('pt_hotels.hotel_stars', 'desc');
				}
			   /*	if (!empty ($adult)) {
						$this->db->where('pt_hotels.hotel_adults <=', $adult);
				}
				if (!empty ($child)) {
						$this->db->where('pt_hotels.hotel_children <=', $child);
				}*/
				if (!empty ($types)) {
						$this->db->where_in('pt_hotels.hotel_type', $types);
				}

				if (!empty ($amenities)) {
					foreach($amenities as $am){

						$this->db->or_like('pt_hotels.hotel_amenities', $am);
					}
				}

				if (!empty ($stars)) {
						$this->db->where('pt_hotels.hotel_stars', $stars);
				}
				if (!empty ($sprice)) {
						/*$sprice = str_replace(";", ",", $sprice);
						$sprice = explode(",", $sprice);
						$minp = $sprice[0];
						$maxp = $sprice[1];
						$this->db->where('pt_rooms.room_basic_price >=', $minp);
						$this->db->where('pt_rooms.room_basic_price <=', $maxp);*/

				}
               // $this->db->where_in('pt_hotels.hotel_id', $hotelslist);
                //$this->db->select_avg('pt_reviews.review_overall', 'overall');
            	$this->db->group_by('pt_hotels.hotel_id');
				$this->db->join('pt_rooms', 'pt_hotels.hotel_id = pt_rooms.room_hotel', 'left');
			   // $this->db->join('pt_reviews', 'pt_hotels.hotel_id = pt_reviews.review_itemid', 'left');
				$this->db->having('pt_hotels.hotel_status', 'Yes');
				if(!empty($perpage)){
				$query = $this->db->get('pt_hotels', $perpage, $offset);	
			}else{
				$query = $this->db->get('pt_hotels');	
			}
				
				$data['all'] = $query->result();
				$data['rows'] = $query->num_rows();
				return $data;
		}
//search hotels by text
		function search_hotels_by_text($cityid, $perpage = null, $offset = null, $orderby = null, $cities = null,$lists = null,$checkin = null,$checkout = null) {
			/*echo "Asdas";
			exit();*/
				$data = array();

                $searchtxt = $cityid;// $this->input->get('searching');
                if(empty($checkin)){
                	$checkin = $this->input->get('checkin');
                }

                if(empty($checkout)){
                	$checkout = $this->input->get('checkout');
                }
				
				$adult = $this->input->get('adults');
				$child = $this->input->get('child');
				$stars = $this->input->get('stars');
				$sprice = $this->input->get('price');
				$types = $this->input->get('type');

                //$hotelslist = $lists['hotels'];
				if ($offset != null) {
						$offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
				}
				$this->db->select('pt_hotels.*,pt_rooms.room_basic_price as price,pt_hotels_translation.trans_title');
				$this->db->select_avg('pt_reviews.review_overall', 'overall');
				$this->db->where('pt_hotels.hotel_city', $searchtxt);

				/*$this->db->where('MATCH (pt_hotels.hotel_title) AGAINST ("'. $searchtxt .'")', NULL, false);
				$this->db->or_where('MATCH (pt_hotels_translation.trans_title) AGAINST ("'. $searchtxt .'")', NULL, false);
				$this->db->or_where('MATCH (pt_hotels.hotel_city) AGAINST ("'. $searchtxt .'")', NULL, false);
				*/

                	/*$this->db->like('pt_hotels.hotel_title', $searchtxt);
				    $this->db->or_like('pt_hotels_translation.trans_title', $searchtxt);
				    $this->db->or_like('pt_hotels.hotel_city', $searchtxt);*/

			 if (!empty ($stars)) {
						$this->db->having('pt_hotels.hotel_stars', $stars);
				}
				if ($orderby == "za") {
						$this->db->order_by('pt_hotels.hotel_title', 'desc');
				}
				elseif ($orderby == "az") {
						$this->db->order_by('pt_hotels.hotel_title', 'asc');
				}
				elseif ($orderby == "oldf") {
						$this->db->order_by('pt_hotels.hotel_id', 'asc');
				}
				elseif ($orderby == "newf") {
						$this->db->order_by('pt_hotels.hotel_id', 'desc');
				}
				elseif ($orderby == "ol") {
						$this->db->order_by('pt_hotels.hotel_order', 'asc');
				}
				elseif ($orderby == "p_lh") {
						$this->db->order_by('pt_hotels.hotel_basic_price', 'asc');
				}
				elseif ($orderby == "p_hl") {
						$this->db->order_by('pt_hotels.hotel_basic_price', 'desc');
				}
				elseif ($orderby == "s_lh") {
						$this->db->order_by('pt_hotels.hotel_stars', 'asc');
				}
				elseif ($orderby == "s_hl") {
						$this->db->order_by('pt_hotels.hotel_stars', 'desc');
				}
				if (!empty ($types)) {
						$this->db->where_in('pt_hotels.hotel_type', $types);
				}
				if (!empty ($sprice)) {
						$sprice = str_replace(";", ",", $sprice);
						$sprice = explode(",", $sprice);
						$minp = $sprice[0];
						$maxp = $sprice[1];
						$this->db->where('pt_rooms.room_basic_price >=', $minp);
						$this->db->where('pt_rooms.room_basic_price <=', $maxp);
				}
				$this->db->join('pt_hotels_translation', 'pt_hotels.hotel_id = pt_hotels_translation.item_id', 'left');
				$this->db->group_by('pt_hotels.hotel_id');
                $this->db->join('pt_rooms', 'pt_hotels.hotel_id = pt_rooms.room_hotel', 'left');
			    $this->db->join('pt_reviews', 'pt_hotels.hotel_id = pt_reviews.review_itemid', 'left');
				$this->db->having('pt_hotels.hotel_status', 'Yes');
				
				if(!empty($perpage)){
			
				$query = $this->db->get('pt_hotels', $perpage, $offset);	
			
				}else{
			
				$query = $this->db->get('pt_hotels');	
			
				}

				$data['all'] = $query->result();
				$data['rows'] = $query->num_rows();
				return $data;
		}


		function search_hotels_by_lat_lang($hotel_latitude, $hotel_longitude,$arrayInfo) {
			/*echo "Asdas";
			exit();*/

			/*echo json_encode($arrayInfo);*/
			$checkIn = $arrayInfo['checkIn'];
			$checkOut = $arrayInfo['checkOut'];
			$adults = $arrayInfo['adults'];
			$child = $arrayInfo['child'];
			$room = $arrayInfo['room'];
			$orderby = '';
			/*exit();*/
			/*error_reporting(E_ALL);*/
				$data = array();

                /*$searchtxt = $cityid;*/
                // $this->input->get('searching');
                if(empty($checkin)){
                	$checkin = $this->input->get('checkin');
                }

                if(empty($checkout)){
                	$checkout = $this->input->get('checkout');
                }
				
				$adult = $this->input->get('adults');
				$child = $this->input->get('child');
				$stars = $this->input->get('rating');
				$sprice = $this->input->get('price');
				$types = $this->input->get('type');

                //$hotelslist = $lists['hotels'];
                $offset ='';
				if ($offset != null) {
						$offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
				}
				$this->db->select('pt_hotels.*,pt_rooms.room_basic_price as price,pt_hotels_translation.trans_title,
			   ( 3959 * acos( cos( radians('.number_format($hotel_latitude,1).') ) * cos( radians( pt_hotels.hotel_latitude ) ) 
			   * cos( radians(pt_hotels.hotel_longitude) - radians('.number_format($hotel_longitude,1).')) + sin(radians('.number_format($hotel_latitude,1).')) 
			   * sin( radians(pt_hotels.hotel_latitude)))) AS distance ');
				$this->db->select_avg('pt_reviews.review_overall', 'overall');
				$this->db->having('distance <=', '50');

				//$this->db->like('pt_hotels.hotel_latitude', number_format($hotel_latitude,1));
				//$this->db->like('pt_hotels.hotel_longitude', number_format($hotel_longitude,1));

				/*$this->db->where('MATCH (pt_hotels.hotel_title) AGAINST ("'. $searchtxt .'")', NULL, false);
				$this->db->or_where('MATCH (pt_hotels_translation.trans_title) AGAINST ("'. $searchtxt .'")', NULL, false);
				$this->db->or_where('MATCH (pt_hotels.hotel_city) AGAINST ("'. $searchtxt .'")', NULL, false);
				*/

                	/*$this->db->like('pt_hotels.hotel_title', $searchtxt);
				    $this->db->or_like('pt_hotels_translation.trans_title', $searchtxt);
				    $this->db->or_like('pt_hotels.hotel_city', $searchtxt);*/

			 if (!empty ($stars)) {
						$this->db->having('pt_hotels.hotel_stars >=', $stars);
				}
				if ($orderby == "za") {
						$this->db->order_by('pt_hotels.hotel_title', 'desc');
				}
				elseif ($orderby == "az") {
						$this->db->order_by('pt_hotels.hotel_title', 'asc');
				}
				elseif ($orderby == "oldf") {
						$this->db->order_by('pt_hotels.hotel_id', 'asc');
				}
				elseif ($orderby == "newf") {
						$this->db->order_by('pt_hotels.hotel_id', 'desc');
				}
				elseif ($orderby == "ol") {
						$this->db->order_by('pt_hotels.hotel_order', 'asc');
				}
				elseif ($orderby == "p_lh") {
						$this->db->order_by('pt_hotels.hotel_basic_price', 'asc');
				}
				elseif ($orderby == "p_hl") {
						$this->db->order_by('pt_hotels.hotel_basic_price', 'desc');
				}
				elseif ($orderby == "s_lh") {
						$this->db->order_by('pt_hotels.hotel_stars', 'asc');
				}
				elseif ($orderby == "s_hl") {
						$this->db->order_by('pt_hotels.hotel_stars', 'desc');
				}
				if (!empty ($types)) {
						$this->db->where_in('pt_hotels.hotel_type', $types);
				}
				if (!empty ($sprice)) {
						$sprice = str_replace(";", ",", $sprice);
						$sprice = explode(",", $sprice);
						$minp = $sprice[0];
						$maxp = $sprice[1];
						$this->db->where('pt_rooms.room_basic_price >=', $minp);
						$this->db->where('pt_rooms.room_basic_price <=', $maxp);
				}
				$this->db->join('pt_hotels_translation', 'pt_hotels.hotel_id = pt_hotels_translation.item_id', 'left');
				$this->db->group_by('pt_hotels.hotel_id');
                $this->db->join('pt_rooms', 'pt_hotels.hotel_id = pt_rooms.room_hotel', 'left');
			    $this->db->join('pt_reviews', 'pt_hotels.hotel_id = pt_reviews.review_itemid', 'left');
				$this->db->having('pt_hotels.hotel_status', 'Yes');
				
				if(!empty($perpage)){
			
				$query = $this->db->get('pt_hotels', $perpage, $offset);	
			
				}else{
			
				$query = $this->db->get('pt_hotels');	
			
				}
				/*echo $this->db->last_query();*/

				$hotel_data = $query->result();
				/*echo"<br>";
				echo json_encode($hotel_data);

				exit();*/
				$final_hotel_data = array();

				/*error_reporting(E_ALL);*/
				/*$this->data['amenities'] = $this->hotels_lib->getHotelAmenities();
				echo json_encode($this->data['amenities']);
				
				exit();*/
				 $this->load->library('hotels/hotels_lib');

				$image_base_url = base_url().'uploads/images/hotels/slider/';
				for ($i=0; $i < count($hotel_data) ; $i++) { 
					$final_hotel_data['hotels'][$i]->id = $hotel_data[$i]->hotel_id;

					$this->db->where("himg_hotel_id",$hotel_data[$i]->hotel_id);
		            $query = $this->db->get("pt_hotel_images");
		            $result = $query->result();  
		            
		            $rooms_data_ckin_ckout = $this->hotels_lib->hotel_rooms($hotel_data[$i]->hotel_id,$checkIn,$checkOut);
		            
		            
					$final_hotel_data['hotels'][$i]->title = $hotel_data[$i]->hotel_title;
					$final_hotel_data['hotels'][$i]->thumbnail = $image_base_url.$hotel_data[$i]->thumbnail_image;

					/*echo $hotel_data[$i]->hotel_city;
					echo "<br>";*/
					$locationInfoUrl = pt_LocationsInfo($hotel_data[$i]->hotel_city);
					
					$countryName = url_title($locationInfoUrl->country, 'dash', true);
					$cityName = url_title($locationInfoUrl->city, 'dash', true);

					$slug = base_url().'hotels/'.$countryName.'/'.$cityName.'/'.$hotel_data[$i]->hotel_slug.'?checkin='.$checkIn.'&checkOut='.$checkOut.'&adults='.$adults.'&child='.$child.'&room='.$room;
					/*exit();*/
					//$slug = $hotel_data[$i]->hotel_slug;
					//$this->data['baseUrl'].'hbhotel/'.$code.'?adults='.$adults.'&checkin='.$checkIn.'&checkout='.$checkOut.$this->data['agesApendUrl'];

					$final_hotel_data['hotels'][$i]->slug = $slug;
					$final_hotel_data['hotels'][$i]->currCode = '$';
					if($rooms_data_ckin_ckout[0]->price == null ){

						$final_hotel_data['hotels'][$i]->price = $hotel_data[$i]->price;
					}else{
						$final_hotel_data['hotels'][$i]->price = $rooms_data_ckin_ckout[0]->price;
						
					}
					$final_hotel_data['hotels'][$i]->location = $hotel_data[$i]->hotel_map_city;
					$final_hotel_data['hotels'][$i]->longitude = $hotel_data[$i]->hotel_longitude;
					$final_hotel_data['hotels'][$i]->latitude = $hotel_data[$i]->hotel_latitude;
					$final_hotel_data['hotels'][$i]->distance = $hotel_data[$i]->distance;
					$final_hotel_data['hotels'][$i]->desc = $hotel_data[$i]->hotel_desc;
					/*$final_hotel_data['hotels'][$i]->desc = '';*/
					/*$final_hotel_data['hotels'][$i]->desc = $hotel_data[$i]->hotel_amenities;*/

					$final_Star = '';
					for ($star_i=0; $star_i < 5 ; $star_i++) { 
						if($star_i < $hotel_data[$i]->hotel_stars){
							$final_Star .= '<i class="price-text-color fa fa-star"></i>';
						}else{
							$final_Star .= '<i class="fa fa-star"></i>';
						}
					}

					$final_hotel_data['hotels'][$i]->stars = $final_Star;
					$final_hotel_data['hotels'][$i]->tripAdvisorRatingImg = '';
					$final_hotel_data['hotels'][$i]->tripAdvisorRating = '';
					$final_hotel_data['hotels'][$i]->room_Data = $rooms_data_ckin_ckout;
					$final_hotel_data['hotels'][$i]->all_img = $result;
				}
				/*exit();*/
				/*$data['all'] = $query->result();
				$data['rows'] = $query->num_rows();*/
				/*echo json_encode($final_hotel_data);
				exit();*/
				return $final_hotel_data;
		}


		function search_hotels_by_lat_lang_gb($hotel_latitude, $hotel_longitude,$arrayInfo) {
			/*echo "Asdas";
			exit();*/

			/*echo json_encode($arrayInfo);*/
			$checkIn = $arrayInfo['checkIn'];
			$checkOut = $arrayInfo['checkOut'];
			$adults = $arrayInfo['adults'];
			$child = $arrayInfo['child'];
			$room = $arrayInfo['room'];
			$hotel_ids = $arrayInfo['hotel_ids'];
			$orderby = '';
			/*exit();*/
			/*error_reporting(E_ALL);*/
				$data = array();

                /*$searchtxt = $cityid;*/
                // $this->input->get('searching');
                if(empty($checkin)){
                	$checkin = $this->input->get('checkin');
                }

                if(empty($checkout)){
                	$checkout = $this->input->get('checkout');
                }
				
				$adult = $this->input->get('adults');
				$child = $this->input->get('child');
				$stars = $this->input->get('rating');
				$sprice = $this->input->get('price');
				$types = $this->input->get('type');

                //$hotelslist = $lists['hotels'];
				/*if ($offset != null) {
						$offset = ($offset == 1) ? 0 : ($offset * $perpage) - $perpage;
				}*/
				$this->db->select('pt_hotels.*,pt_rooms.room_basic_price as price,pt_hotels_translation.trans_title,
			   ( 3959 * acos( cos( radians('.number_format($hotel_latitude,1).') ) * cos( radians( pt_hotels.hotel_latitude ) ) 
			   * cos( radians(pt_hotels.hotel_longitude) - radians('.number_format($hotel_longitude,1).')) + sin(radians('.number_format($hotel_latitude,1).')) 
			   * sin( radians(pt_hotels.hotel_latitude)))) AS distance ');
				$this->db->select_avg('pt_reviews.review_overall', 'overall');
				$this->db->having('distance <=', '50');

				//$this->db->like('pt_hotels.hotel_latitude', number_format($hotel_latitude,1));
				//$this->db->like('pt_hotels.hotel_longitude', number_format($hotel_longitude,1));

				/*$this->db->where('MATCH (pt_hotels.hotel_title) AGAINST ("'. $searchtxt .'")', NULL, false);
				$this->db->or_where('MATCH (pt_hotels_translation.trans_title) AGAINST ("'. $searchtxt .'")', NULL, false);
				$this->db->or_where('MATCH (pt_hotels.hotel_city) AGAINST ("'. $searchtxt .'")', NULL, false);
				*/

                	/*$this->db->like('pt_hotels.hotel_title', $searchtxt);
				    $this->db->or_like('pt_hotels_translation.trans_title', $searchtxt);
				    $this->db->or_like('pt_hotels.hotel_city', $searchtxt);*/

			 if (!empty ($stars)) {
						$this->db->having('pt_hotels.hotel_stars >=', $stars);
				}
				if ($orderby == "za") {
						$this->db->order_by('pt_hotels.hotel_title', 'desc');
				}
				elseif ($orderby == "az") {
						$this->db->order_by('pt_hotels.hotel_title', 'asc');
				}
				elseif ($orderby == "oldf") {
						$this->db->order_by('pt_hotels.hotel_id', 'asc');
				}
				elseif ($orderby == "newf") {
						$this->db->order_by('pt_hotels.hotel_id', 'desc');
				}
				elseif ($orderby == "ol") {
						$this->db->order_by('pt_hotels.hotel_order', 'asc');
				}
				elseif ($orderby == "p_lh") {
						$this->db->order_by('pt_hotels.hotel_basic_price', 'asc');
				}
				elseif ($orderby == "p_hl") {
						$this->db->order_by('pt_hotels.hotel_basic_price', 'desc');
				}
				elseif ($orderby == "s_lh") {
						$this->db->order_by('pt_hotels.hotel_stars', 'asc');
				}
				elseif ($orderby == "s_hl") {
						$this->db->order_by('pt_hotels.hotel_stars', 'desc');
				}
				if (!empty ($types)) {
						$this->db->where_in('pt_hotels.hotel_type', $types);
				}
				
				if (!empty ($sprice)) {
						$sprice = str_replace(";", ",", $sprice);
						$sprice = explode(",", $sprice);
						$minp = $sprice[0];
						$maxp = $sprice[1];
						$this->db->where('pt_rooms.room_basic_price >=', $minp);
						$this->db->where('pt_rooms.room_basic_price <=', $maxp);
				}
				$this->db->join('pt_hotels_translation', 'pt_hotels.hotel_id = pt_hotels_translation.item_id', 'left');
				$this->db->group_by('pt_hotels.hotel_id');
                $this->db->join('pt_rooms', 'pt_hotels.hotel_id = pt_rooms.room_hotel', 'left');
			    $this->db->join('pt_reviews', 'pt_hotels.hotel_id = pt_reviews.review_itemid', 'left');
				$this->db->having('pt_hotels.hotel_status', 'Yes');
				if (!empty ($hotel_ids)) {
						$this->db->where_in('pt_hotels.hotel_id ', $hotel_ids);
				}
				if(!empty($perpage)){
			
				$query = $this->db->get('pt_hotels', $perpage, $offset);	
			
				}else{
			
				$query = $this->db->get('pt_hotels');	
			
				}
				/*echo $this->db->last_query();
				exit();*/

				$hotel_data = $query->result();
				/*echo"<br>";
				echo json_encode($hotel_data);

				exit();*/
				$final_hotel_data = array();

				/*error_reporting(E_ALL);*/
				/*$this->data['amenities'] = $this->hotels_lib->getHotelAmenities();
				echo json_encode($this->data['amenities']);
				
				exit();*/
				 $this->load->library('hotels/hotels_lib');

				$image_base_url = base_url().'uploads/images/hotels/slider/';
				for ($i=0; $i < count($hotel_data) ; $i++) { 
					$final_hotel_data['hotels'][$i]->id = $hotel_data[$i]->hotel_id;

					$this->db->where("himg_hotel_id",$hotel_data[$i]->hotel_id);
		            $query = $this->db->get("pt_hotel_images");
		            $result = $query->result();  
		            
		            $rooms_data_ckin_ckout = $this->hotels_lib->hotel_rooms($hotel_data[$i]->hotel_id,$checkIn,$checkOut);
		            
		            
					$final_hotel_data['hotels'][$i]->title = $hotel_data[$i]->hotel_title;
					$final_hotel_data['hotels'][$i]->thumbnail = $image_base_url.$hotel_data[$i]->thumbnail_image;

					/*echo $hotel_data[$i]->hotel_city;
					echo "<br>";*/
					$locationInfoUrl = pt_LocationsInfo($hotel_data[$i]->hotel_city);
					
					$countryName = url_title($locationInfoUrl->country, 'dash', true);
					$cityName = url_title($locationInfoUrl->city, 'dash', true);

					$slug = base_url().'hotels/'.$countryName.'/'.$cityName.'/'.$hotel_data[$i]->hotel_slug.'?checkin='.$checkIn.'&checkOut='.$checkOut.'&adults='.$adults.'&child='.$child.'&room='.$room;
					/*exit();*/
					//$slug = $hotel_data[$i]->hotel_slug;
					//$this->data['baseUrl'].'hbhotel/'.$code.'?adults='.$adults.'&checkin='.$checkIn.'&checkout='.$checkOut.$this->data['agesApendUrl'];

					$final_hotel_data['hotels'][$i]->slug = $slug;
					$final_hotel_data['hotels'][$i]->currCode = '$';
					if($rooms_data_ckin_ckout[0]->price == null ){

						$final_hotel_data['hotels'][$i]->price = $hotel_data[$i]->price;
					}else{
						$final_hotel_data['hotels'][$i]->price = $rooms_data_ckin_ckout[0]->price;
						
					}
					$final_hotel_data['hotels'][$i]->location = $hotel_data[$i]->hotel_map_city;
					$final_hotel_data['hotels'][$i]->longitude = $hotel_data[$i]->hotel_longitude;
					$final_hotel_data['hotels'][$i]->latitude = $hotel_data[$i]->hotel_latitude;
					$final_hotel_data['hotels'][$i]->distance = $hotel_data[$i]->distance;
					$final_hotel_data['hotels'][$i]->desc = $hotel_data[$i]->hotel_desc;
					/*$final_hotel_data['hotels'][$i]->desc = '';*/
					/*$final_hotel_data['hotels'][$i]->desc = $hotel_data[$i]->hotel_amenities;*/

					$final_Star = '';
					for ($star_i=0; $star_i < 5 ; $star_i++) { 
						if($star_i < $hotel_data[$i]->hotel_stars){
							$final_Star .= '<i class="price-text-color fa fa-star"></i>';
						}else{
							$final_Star .= '<i class="fa fa-star"></i>';
						}
					}

					$final_hotel_data['hotels'][$i]->stars = $final_Star;
					$final_hotel_data['hotels'][$i]->tripAdvisorRatingImg = '';
					$final_hotel_data['hotels'][$i]->tripAdvisorRating = '';
					$final_hotel_data['hotels'][$i]->room_Data = $rooms_data_ckin_ckout;
					$final_hotel_data['hotels'][$i]->all_img = $result;
				}
				/*exit();*/
				/*$data['all'] = $query->result();
				$data['rows'] = $query->num_rows();*/
				/*echo json_encode($final_hotel_data);
				exit();*/
				/*exit();*/
				return $final_hotel_data;
		}




// for auto suggestions search
		function textsearch() {
				$q = $this->input->get('q');
				$r = $this->input->get('type');
				$term = mysql_real_escape_string($q);
				$query = $this->db->query("SELECT hotel_title as name FROM pt_hotels WHERE hotel_title LIKE '%$term%' ")->result();
				foreach ($query as $qry) {
						echo $qry->name . "\n";
				}
		}

// get all hotels for related selection for backend
		function select_related_hotels($id = null) {
				$this->db->select('hotel_title,hotel_id');
				if(empty($this->isSuperAdmin)){
				if (!empty ($id)) {
						$this->db->where('hotel_owned_by', $id);
				}
				}
				
				
				return $this->db->get('pt_hotels')->result();
		}

// get related hotels for front-end
		function get_related_hotels($hotels) {
				$id = explode(",", $hotels);
				$this->db->select('pt_hotels.hotel_title,pt_hotels.hotel_slug,pt_hotels.hotel_id,pt_hotels.hotel_basic_price,pt_hotels.hotel_basic_discount,pt_hotels.hotel_stars');
				$this->db->select_avg('pt_reviews.review_overall', 'overall');
				$this->db->where_in('pt_hotels.hotel_id', $id);
// $this->db->where('pt_hotel_images.himg_type','default');
				$this->db->group_by('pt_hotels.hotel_id');
// $this->db->join('pt_hotel_images','pt_hotels.hotel_id = pt_hotel_images.himg_hotel_id','left');
				$this->db->join('pt_reviews', 'pt_hotels.hotel_id = pt_reviews.review_itemid', 'left');
				return $this->db->get('pt_hotels')->result();
		}

// get featured hotels
		function featured_hotels_front() {
				$settings = $this->settings_model->get_front_settings('hotels');
				$limit = $settings[0]->front_homepage;
				$orderby = $settings[0]->front_homepage_order;
				$this->db->select('pt_hotels.hotel_status,pt_hotels.hotel_slug,pt_hotels.hotel_id,pt_hotels.hotel_desc,pt_hotels.hotel_stars,

   pt_hotels.hotel_title,pt_hotels.hotel_city,pt_hotels.hotel_basic_price,pt_hotels.hotel_basic_discount,pt_hotels.hotel_latitude,pt_hotels.hotel_longitude');
				$this->db->select_avg('pt_reviews.review_overall', 'overall');
				$this->db->where('pt_hotels.hotel_is_featured', 'yes');
				$this->db->where('pt_hotels.hotel_featured_from <', time());
				$this->db->where('pt_hotels.hotel_featured_to >', time());
				$this->db->group_by('pt_hotels.hotel_id');
				$this->db->join('pt_reviews', 'pt_hotels.hotel_id = pt_reviews.review_itemid', 'left');
				$this->db->having('hotel_status', '1');
				$this->db->limit($limit);
				if ($orderby == "za") {
						$this->db->order_by('pt_hotels.hotel_title', 'desc');
				}
				elseif ($orderby == "az") {
						$this->db->order_by('pt_hotels.hotel_title', 'asc');
				}
				elseif ($orderby == "oldf") {
						$this->db->order_by('pt_hotels.hotel_id', 'asc');
				}
				elseif ($orderby == "newf") {
						$this->db->order_by('pt_hotels.hotel_id', 'desc');
				}
				elseif ($orderby == "ol") {
						$this->db->order_by('pt_hotels.hotel_order', 'asc');
				}
				return $this->db->get('pt_hotels')->result();
		}

// get popular hotels
		function popular_hotels_front() {
				$settings = $this->settings_model->get_front_settings('hotels');
				$limit = $settings[0]->front_popular;
				$orderby = $settings[0]->front_popular_order;

                $this->db->select('pt_hotels.hotel_id,pt_hotels.hotel_status,pt_reviews.review_overall,pt_reviews.review_itemid');

                $this->db->select_avg('pt_reviews.review_overall', 'overall');
				$this->db->order_by('overall', 'desc');
				$this->db->group_by('pt_hotels.hotel_id');
				$this->db->join('pt_reviews', 'pt_hotels.hotel_id = pt_reviews.review_itemid');
				$this->db->where('hotel_status', 'yes');
				$this->db->limit($limit);
			   	return $this->db->get('pt_hotels')->result();
		}

// get latest hotels
		function latest_hotels_front() {
				$settings = $this->settings_model->get_front_settings('hotels');
				$limit = $settings[0]->front_latest;
				$this->db->select('pt_hotels.hotel_status,pt_hotels.hotel_slug,pt_hotels.hotel_id,pt_hotels.hotel_desc,pt_hotels.hotel_stars,

   pt_hotels.hotel_title,pt_hotels.hotel_city,pt_hotels.hotel_basic_price,pt_hotels.hotel_basic_discount,pt_hotels.hotel_latitude,pt_hotels.hotel_longitude');
				$this->db->select_avg('pt_reviews.review_overall', 'overall');
				$this->db->order_by('pt_hotels.hotel_id', 'desc');
				$this->db->group_by('pt_hotels.hotel_id');
				$this->db->join('pt_reviews', 'pt_hotels.hotel_id = pt_reviews.review_itemid', 'left');
				$this->db->where('hotel_status', '1');
				$this->db->limit($limit);
				return $this->db->get('pt_hotels')->result();
		}

		function offers_data($id) {
				$this->db->where('offer_module', 'hotels');
				$this->db->where('offer_item', $id);
				return $this->db->get('pt_special_offers')->result();
		}

// update translated data os some fields in english
		function update_english($id) {
				$hslug = create_url_slug($this->input->post('title'));
				$this->db->where('hotel_slug', $hslug);
				$this->db->where('hotel_id !=', $id);
				$nums = $this->db->get('pt_hotels')->num_rows();
				if ($nums > 0) {
						$hslug = $hslug . "-" . $id;
				}
				else {
						$hslug = $hslug;
				}
				$data = array('hotel_title' => $this->input->post('title'), 'hotel_slug' => $hslug, 'hotel_desc' => $this->input->post('desc'), 'hotel_additional_facilities' => $this->input->post('additional'), 'hotel_policy' => $this->input->post('policy'));
				$this->db->where('hotel_id', $id);
				$this->db->update('pt_hotels', $data);
				return $hslug;
		}





		function convert_price($amount) {
				$this->load->library('geolib');
				return $this->geolib->convert_price($amount);
		}

// get special offer hotels
		function specialoffer_hotels() {
				$this->db->select('pt_hotels.hotel_status,pt_hotels.hotel_slug,pt_hotels.hotel_id,pt_hotels.hotel_desc,pt_hotels.hotel_stars,

   pt_hotels.hotel_title,pt_hotels.hotel_city,pt_hotels.hotel_basic_price,pt_hotels.hotel_basic_discount,pt_hotels.hotel_latitude,pt_hotels.hotel_longitude,pt_special_offers.offer_item');
				$this->db->select_avg('pt_reviews.review_overall', 'overall');
				$this->db->where('pt_special_offers.offer_from <=', time());
				$this->db->where('pt_special_offers.offer_to >=', time());
				$this->db->where('pt_special_offers.offer_status', '1');
				$this->db->order_by('pt_special_offers.offer_id', 'desc');
				$this->db->group_by('pt_hotels.hotel_id');
				$this->db->join('pt_reviews', 'pt_hotels.hotel_id = pt_reviews.review_itemid', 'left');
				$this->db->join('pt_special_offers', 'pt_hotels.hotel_id = pt_special_offers.offer_item', 'left');
				$this->db->having('pt_hotels.hotel_status', '1');
				return $this->db->get('pt_hotels')->result();
		}




        // Adds translation of some fields data
		function add_translation($postdata,$id) {
		  foreach($postdata as $lang => $val){
		     if(array_filter($val)){
		        $title = $val['title'];
                $desc = $val['desc'];
                $metatitle = $val['metatitle'];
				$metadesc = $val['metadesc'];
				$keywords = $val['keywords'];
				$policy = $val['policy'];
                $data = array(
                'trans_title' => $title,
                'trans_desc' => $desc,
                'trans_policy' => $policy,
                'metatitle' => $metatitle,
                'metadesc' => $metadesc,
                'metakeywords' => $keywords,
                'item_id' => $id,
                'trans_lang' => $lang
                );
				$this->db->insert('pt_hotels_translation', $data);
                }

                }


		}

        // Update translation of some fields data
		function update_translation($postdata,$id) {

       foreach($postdata as $lang => $val){
		     if(array_filter($val)){
		        $title = $val['title'];
                $desc = $val['desc'];
                $metatitle = $val['metatitle'];
				$metadesc = $val['metadesc'];
				$kewords = $val['keywords'];
				$policy = $val['policy'];
                $transAvailable = $this->getBackTranslation($lang,$id);

                if(empty($transAvailable)){
                   $data = array(
                'trans_title' => $title,
                'trans_desc' => $desc,
                'trans_policy' => $policy,
                'metatitle' => $metatitle,
                'metadesc' => $metadesc,
                'metakeywords' => $kewords,
                'item_id' => $id,
                'trans_lang' => $lang
                );
				$this->db->insert('pt_hotels_translation', $data);

                }else{
                 $data = array(
                'trans_title' => $title,
                'trans_desc' => $desc,
                'trans_policy' => $policy,
                'metatitle' => $metatitle,
                'metadesc' => $metadesc,
                'metakeywords' => $kewords,
                );
				$this->db->where('item_id', $id);
				$this->db->where('trans_lang', $lang);
			    $this->db->update('pt_hotels_translation', $data);
                }


              }

                }
		}

        function getBackTranslation($lang,$id){

            $this->db->where('trans_lang',$lang);
            $this->db->where('item_id',$id);
            return $this->db->get('pt_hotels_translation')->result();

        }

        

        

        function assignHotels($hotels,$userid){
          if(!empty($hotels)){
          $userhotels = $this->userOwnedHotels($userid);
                foreach($userhotels as $ht){
                   if(!in_array($ht,$hotels)){
                    $ddata = array(
                   'hotel_owned_by' => '1'
                   );
                   $this->db->where('hotel_id',$ht);
                   $this->db->update('pt_hotels',$ddata);
                   }
                }

                foreach($hotels as $h){
                   $data = array(
                   'hotel_owned_by' => $userid
                   );
                   $this->db->where('hotel_id',$h);
                   $this->db->update('pt_hotels',$data);

                 }

                 }
        }

        function userOwnedHotels($id){
          $result = array();
          if(!empty($id)){
          $this->db->where('hotel_owned_by',$id);	
          }
          
          $rs = $this->db->get('pt_hotels')->result();
          if(!empty($rs)){
            foreach($rs as $r){
              $result[] = $r->hotel_id;
            }
          }
          return $result;
        }

        /*************Hotel Settings Functions**************/

        // Add hotel settings data
		function addSettingsData() {
		        $filename = "";
                $type = $this->input->post('typeopt');
                if($type == "hamenities"){
                  if (isset ($_FILES['amticon']) && !empty ($_FILES['amticon']['name'])) {
                    $filename = $this->uploadSettingIcon();
                  }else{
                    $filename = $this->input->post('oldicon');
                  }

                }
				$data = array(
                'sett_name' => $this->input->post('name'),
                'sett_status' => $this->input->post('statusopt'),
                'sett_selected' => $this->input->post('setselect'),
                'sett_type' => $type,
                'sett_img' => $filename
                );
				$this->db->insert('pt_hotels_types_settings', $data);
                return $this->db->insert_id();
                $this->session->set_flashdata('flashmsgs', "Updated Successfully");

		}

// update hotel settings data
		function updateSettingsData() {
				$id = $this->input->post('settid');
                $type = $this->input->post('typeopt');

                  if(isset ($_FILES['amticon']) && !empty ($_FILES['amticon']['name'])) {
                    $filename = $this->uploadSettingIcon($this->input->post('oldicon'));
                  }else{
                    $filename = $this->input->post('oldicon');
                  }


				$data = array('sett_name' => $this->input->post('name'),
                'sett_status' => $this->input->post('statusopt'),
                'sett_selected' => $this->input->post('setselect'),
                'sett_img' => $filename

                );
				$this->db->where('sett_id', $id);
				$this->db->update('pt_hotels_types_settings', $data);
                $this->session->set_flashdata('flashmsgs', "Updated Successfully");
		}

// Get hotel settings data
		function get_hotel_settings_data($type = null) {
		  if(!empty($type)){
             	$this->db->where('sett_type', $type);
		  }

				$this->db->order_by('sett_id', 'desc');
				return $this->db->get('pt_hotels_types_settings')->result();
		}

		function get_hotel_settings_value($type, $id) {
				$this->db->where('sett_type', $type);
				$this->db->where('sett_id', $id);
				$this->db->where('sett_status', 'Yes');
				$rslt = $this->db->get('pt_hotels_types_settings')->result();
				if (empty ($rslt)) {
						return '';
				}
				else {
						return $rslt[0]->sett_name . "!";
				}
		}

// Get hotel settings data for adding hotel or room
		function get_hsettings_data($type) {
				$this->db->where('sett_type', $type);
				$this->db->where('sett_status', 'Yes');
				return $this->db->get('pt_hotels_types_settings')->result();
		}

// Get hotel settings data for adding hotel or room
		function get_hsettings_data_front($type, $items) {
				$this->db->where('sett_type', $type);
				$this->db->where_in('sett_id', $items);
				$this->db->where('sett_status', 'Yes');
				return $this->db->get('pt_hotels_types_settings')->result();
		}
     		function updateHotelSettings() {
				$ufor = $this->input->post('updatefor');
				$herohotels = $this->input->post('herohotels');
				if (!empty ($herohotels)) {
						$herohotelstxt = implode(",", $herohotels);
				}
				else {
						$herohotelstxt = "";
				}
				$miniherohotels = $this->input->post('miniherohotels');
				if (!empty ($miniherohotels)) {
						$miniherohotelstxt = implode(",", $miniherohotels);
				}
				else {
						$miniherohotelstxt = "";
				}
				$topcities = $this->input->post('topcities');
				if (!empty ($topcities)) {
						$topcitiestxt = implode(",", $topcities);
				}
				else {
						$topcitiestxt = "";
				}
				$data = array('front_icon' => $this->input->post('page_icon'),
                'front_homepage' => $this->input->post('home'),
                'front_homepage_order' => $this->input->post('homeorder'),
                'front_popular' => $this->input->post('popular'),
                'front_popular_order' => $this->input->post('popularorder'),
                'front_latest' => $this->input->post('latest'),
                'front_homepage_hero' => $herohotelstxt,
                'front_listings' => $this->input->post('listings'),
                'front_listings_order' => $this->input->post('listingsorder'),
                'front_homepage_small_hero' => $miniherohotelstxt,
                'front_top_cities' => $topcitiestxt,
                'front_search' => $this->input->post('searchresult'),
                'front_search_order' => $this->input->post('searchorder'),
                'front_search_min_price' => $this->input->post('minprice'),
                'front_search_max_price' => $this->input->post('maxprice'),
                'front_checkin_time' => $this->input->post('checkin'),
                'front_checkout_time' => $this->input->post('checkout'),
                'front_txtsearch' => '1',
				'front_tax_percentage' => $this->input->post('taxpercentage'), 'front_tax_fixed' => $this->input->post('taxfixed'), 'front_search_state' => $this->input->post('state'), 'front_sharing' => $this->input->post('sharing'), 'linktarget' => $this->input->post('target'), 
				'header_title' => $this->input->post('headertitle'),
				'meta_keywords' => $this->input->post('keywords'),
				'meta_description' => $this->input->post('description')
				);
				$this->db->where('front_for', $ufor);
				$this->db->update('pt_front_settings', $data);
				$this->session->set_flashdata('flashmsgs', "Updated Successfully");
		}

	 function updateSettingsTypeTranslation($postdata,$id) {

       foreach($postdata as $lang => $val){
		     if(array_filter($val)){
		        $name = $val['name'];

                $transAvailable = $this->getBackSettingsTranslation($lang,$id);

                if(empty($transAvailable)){
                 $data = array(
                'trans_name' => $name,
                'sett_id' => $id,
                'trans_lang' => $lang
                );
				$this->db->insert('pt_hotels_types_settings_translation', $data);

                }else{

                 $data = array(
                'trans_name' => $name
                );
				$this->db->where('sett_id', $id);
				$this->db->where('trans_lang', $lang);
			    $this->db->update('pt_hotels_types_settings_translation', $data);

              }


              }

                }
		}


         function getBackSettingsTranslation($lang,$id){

            $this->db->where('trans_lang',$lang);
            $this->db->where('sett_id',$id);
            return $this->db->get('pt_hotels_types_settings_translation')->result();

        }

        // Delete hotel settings
		function deleteTypeSettings($id) {
				$this->db->where('sett_id', $id);
				$this->db->delete('pt_hotels_types_settings');

                $this->db->where('sett_id', $id);
				$this->db->delete('pt_hotels_types_settings_translation');
		}

		// Delete multiple hotel settings
		function deleteMultiplesettings($id, $type) {
				$this->db->where('sett_id', $id);
				$this->db->where('sett_type',$type);
				$this->db->delete('pt_hotels_types_settings');

				$rowsDeleted = $this->db->affected_rows();

				if($rowsDeleted > 0){
				$this->db->where('sett_id', $id);
				$this->db->delete('pt_hotels_types_settings_translation');
				}

			
		}

         function getTypesTranslation($lang,$id){

            $this->db->where('trans_lang',$lang);
            $this->db->where('sett_id',$id);
            return $this->db->get('pt_hotels_types_settings_translation')->result();

        }

        function uploadSettingIcon($oldfile = null){

				if (!empty ($_FILES)) {
				  if(!empty($oldfile)){
				    @unlink(PT_HOTELS_ICONS_UPLOAD.$oldfile);
				  }
						$tempFile = $_FILES['amticon']['tmp_name'];
						$fileName = $_FILES['amticon']['name'];
						$fileName = str_replace(" ", "-", $_FILES['amticon']['name']);
						$fig = rand(1, 999999);
						$saveFile = $fig . '_' . $fileName;

						$targetPath = PT_HOTELS_ICONS_UPLOAD;

						$targetFile = $targetPath . $saveFile;
						move_uploaded_file($tempFile, $targetFile);
                        return $saveFile;
                       }
        }

        /*************End Hotel Settings Functions**************/

  
}