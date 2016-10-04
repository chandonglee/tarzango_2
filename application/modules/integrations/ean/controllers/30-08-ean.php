<?php
if (!defined('BASEPATH'))
		exit ('No direct script access allowed');

class Ean extends MX_Controller {
		private $data = array();
		private $city;
		public $cachekey;
		public $numberofresults;
		public $loggedin;
		public $settings = array();
		private $validlang;
		protected $ci = NULL; //codeigniter instance
		protected $db; //database instatnce instance

		function __construct() {
// $this->session->sess_destroy();
				parent :: __construct();
				$chk = modules :: run('home/is_main_module_enabled', 'ean');
				if (!$chk) {
						Module_404();
				}
				modules :: load('home');
				$this->settings = $this->settings_model->get_front_settings('ean');
				$citydef = $this->settings[0]->front_search_city;
				$this->numberofresults = $this->settings[0]->front_listings;
				$this->load->library("ean_lib");
				$this->load->library("hb_lib");
				$this->load->model("ean_model");
				$this->load->model("hb_model");
				$this->load->helper("ean_front");
				$this->data['modulelib'] = $this->ean_lib;
				$this->data['app_settings'] = $this->settings_model->get_settings_data();
				$this->data['lang_set'] = $this->session->userdata('set_lang');
				$this->data['user'] = $this->session->userdata('pt_logged_customer');
				$this->data['appModule'] = "ean";
				$this->city = $citydef;
				$languageid = $this->uri->segment(2);
                $this->validlang = pt_isValid_language($languageid);

				$this->data['phone'] = $this->load->get_var('phone');
				$this->data['contactemail'] = $this->load->get_var('contactemail');
				$this->data['contact_address'] = $this->load->get_var('contact_address');
				$this->data['geo'] = $this->load->get_var('geolib');
				$defaultlang = pt_get_default_language();
				if (empty ($this->data['lang_set'])) {
						$this->data['lang_set'] = $defaultlang;
				}
				$this->loggedin = $this->session->userdata('pt_logged_customer');
				$this->data['baseUrl'] = base_url().'properties/';

				/*error_reporting(E_ALL);*/
				$this->ci = & get_instance();
				$this->db = $this->ci->db;
                $this->appSettings = $this->ci->settings_model->get_settings_data();
				$this->ci->load->model('hotels/hotels_model');
		}

		public function index() {
				$unsetdata = array('customerSessionId' => '', 'activePropertyCount' => '', 'cachekey' => '', 'cacheloc' => '');
				$this->session->unset_userdata($unsetdata);
				$this->data['minprice'] = $this->settings[0]->front_search_min_price;
				$this->data['maxprice'] = $this->settings[0]->front_search_max_price;

				
				$this->data['resultMap'] = $this->__forMap();
				$this->data['selectedCity'] = $this->city;
				/* for request and response */

              /*  echo "<pre>";
                echo $this->ean_lib->apistr."<br>";
				echo print_r($this->data['result']);
				echo "</pre>";
				exit;*/

				//$this->data['result'] = $this->__firstlist();
				$result = $this->__firstlist();
				$this->data['module'] = $result->hotels;
				$this->data['multipleLocations'] = $result->multipleLocations;
				$this->data['locationInfo'] = $result->locationInfo;
				$this->data['moreResultsAvailable'] = $result->moreResultsAvailable;
				$this->data['cacheKey'] = $result->cacheKey;
				$this->data['cacheLocation'] = $result->cacheLocation;


				$cachekey = array();
				$cacheloc = array();
				$cachekey = $this->data['result']['HotelListResponse']['cacheKey'];
				$cacheloc = $this->data['result']['HotelListResponse']['cacheLocation'];

				$cachedata = array('customerSessionId' => $this->data['result']['HotelListResponse']['customerSessionId'], 'activePropertyCount' => $this->data['result']['HotelListResponse']['HotelList']['@activePropertyCount'], 'cachekey' => $cachekey, 'cacheloc' => $cacheloc);
				$this->session->set_userdata($cachedata);
				$this->lang->load("front", $this->data['lang_set']);

				//$this->data['plinks'] = getPaginationEan(site_url('ean/listings'), $this->data['result']['HotelListResponse']['HotelList']['@activePropertyCount'], $this->numberofresults, 1);
				$this->data['currSign'] = $this->ean_lib->currency;
				$this->data['page_title'] = $this->settings[0]->header_title;
				$this->data['metakey'] = $this->settings[0]->meta_keywords;
				$this->data['metadesc'] = $this->settings[0]->meta_description;
				//$this->theme->view('integrations/ean/index', $this->data);
				$this->theme->view('listing', $this->data);
		}

		function listings($offset) {
				$activepcount = $this->session->userdata("activePropertyCount");
				if ($offset == 1) {
						$this->data['result'] = $this->__firstlist();
						$this->data['plinks'] = getPaginationEan(site_url('ean/listings'), $activepcount, $this->numberofresults, $offset);
				}
				else {
						$key = "page" . $offset;
						$next = $offset + 1;
						$nextkey = "page" . $next;
						$ck = $this->session->userdata("cachekey");
						$cl = $this->session->userdata("cacheloc");
						$pInfo['cacheKey'] = $ck[$key];
						$pInfo['cacheLocation'] = $cl[$key];
						$pInfo['customerSessionId'] = $this->session->userdata("customerSessionId");
						$this->data['result'] = $this->ean_lib->HotelListsMore($pInfo);
						$this->data['plinks'] = getPaginationEan(site_url('ean/listings'), $activepcount, $this->numberofresults, $offset);
						$checkkey = array_key_exists($nextkey, $ck);
						if (!$checkkey) {
						/*array_push($ck["$nextkey"],$this->data['result']['HotelListResponse']['cacheKey']);

						array_push($cl["$nextkey"],$this->data['result']['HotelListResponse']['cacheLocation']);

						*/
								$ck[$nextkey] = $this->data['result']['HotelListResponse']['cacheKey'];
								$cl[$nextkey] = $this->data['result']['HotelListResponse']['cacheLocation'];
								$cachedata = array('cachekey' => $ck, 'cacheloc' => $cl);
								$this->session->set_userdata($cachedata);
						}
				}
				$this->lang->load("front", $this->data['lang_set']);
				$this->data['cachekey'] = $this->session->all_userdata();
				$this->data['currSign'] = $this->ean_lib->currency;
				$this->data['page_title'] = $this->settings[0]->header_title;
				$this->data['metakey'] = $this->settings[0]->meta_keywords;
				$this->data['metadesc'] = $this->settings[0]->meta_description;
				$this->theme->view('integrations/ean/index', $this->data);
		}

		function loadMore() {
				$ck = $this->input->post("cacheKey");
				$cl = $this->input->post("cacheLocation");
				$this->data['checkin'] = $this->input->post("checkin");
				$this->data['checkout'] = $this->input->post("checkout");
				$this->data['agesApendUrl'] = $this->input->post("agesappendurl");
				$this->data['adults'] = $this->input->post("adultsCount");
				$Info['cacheKey'] = $ck;
				$Info['cacheLocation'] = $cl;
				$Info['customerSessionId'] = $this->session->userdata("customerSessionId");
				$this->lang->load("front", $this->data['lang_set']);
				$resultData = $this->ean_lib->HotelListsMore($Info);

				$result = $this->getResultInObjects($resultData,$this->data['checkin'],$this->data['checkout'],$this->data['adults'],$this->data['agesApendUrl']);
				
				$this->data['multipleLocations'] = $result->multipleLocations;
				$this->data['locationInfo'] = $result->locationInfo;
				$this->data['moreResultsAvailable'] = $result->moreResultsAvailable;
				$this->data['cacheKey'] = $result->cacheKey;
				$this->data['cacheLocation'] = $result->cacheLocation;
				$this->data['module'] = $result->hotels;
				//$this->data['result'] = $this->ean_lib->HotelListsMore($Info);  
				
				$this->theme->partial('integrations/ean/morehotels', $this->data);
		}

		function distance($lat1, $lon1, $lat2, $lon2, $unit) {

		  $theta = $lon1 - $lon2;
		  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		  $dist = acos($dist);
		  $dist = rad2deg($dist);
		  $miles = $dist * 60 * 1.1515;
		  $unit = strtoupper($unit);

		  if ($unit == "K") {
		    return ($miles * 1.609344);
		  } else if ($unit == "N") {
		      return ($miles * 0.8684);
		    } else {
		        return $miles;
		      }
		}

		function search($offset = null) {
			/*error_reporting(E_ALL);
			print_r($_GET);
			exit();*/
				$search = $this->input->get('search');
				$rating = $this->input->get('rating');
				$room = $this->input->get('room');
				
				//echo $this->input->get('child');
				for ($child_age=0; $child_age < $this->input->get('child') ; $child_age++) { 
					$c_ages[] = rand(0,15);
				}
				$final_child_Ages = implode(",", $c_ages);
				if (!empty ($search)) {
						$this->data['checkin'] = trim($_GET['checkIn']);
						$this->data['checkout'] = trim($_GET['checkOut']);
						$this->data['room'] = $room;
						$this->data['minprice'] = $this->settings[0]->front_search_min_price;
				        $this->data['maxprice'] = $this->settings[0]->front_search_max_price;
				        $this->data['rating'] = $rating;


						if (empty ($offset)) {
								// print_r($_POST);
								$arrayInfo["city"] = trim($_GET['city']);
								$tempCity[] = strtok($arrayInfo["city"], " ,-");
								$arrayInfo["destinationId"] = trim($_GET['destinationId']);
								$arrayInfo["city"] = $tempCity[0];
									// $arrayInfo['countryCode'] = 'IN';
								$arrayInfo['checkIn'] = trim($_GET['checkIn']);
									// $arrayInfo['checkIn'] = "18-08-2014";
								$arrayInfo['checkOut'] = trim($_GET['checkOut']);
								//$childAges = $this->input->get('childages');
								$childAges = $final_child_Ages;
								//$childCount = 0;
								$childAgesStr = "";
								if(!empty($childAges)){
								//$childCount =  count(explode(",",$childAges));
								$childAgesStr = ",".$child;
								}

								$adults = $this->input->get("adults");
								$this->data['propertyCategory'] = $_GET['propertyCategory'];
								$adultString = $adults.$childAgesStr;

								$this->data['adults'] = $adults;
								//$this->data['child'] = $childCount;
								$this->data['child'] = $this->input->get('child');
								$this->data['childAges'] = $childAges;
								if($this->data['child'] > 0){
									$this->data['agesApendUrl'] = '&ages='.$childAges;
								}else{
									$this->data['agesApendUrl'] = '';
								}

								$arrayinfo1['adults'] = $adults;
								$arrayinfo1['child'] = $this->input->get('child');
								$arrayinfo1['room'] = $room;
								/*$arrayinfo1['childAges'] = $childAges;*/
								$arrayinfo1['childAges'] = $final_child_Ages;

								$arrayInfo['rooms'] = "room1=$adultString";
								$arrayInfo['numberOfResult'] = $this->settings[0]->front_search;
								if(!empty($this->data['propertyCategory'])){
									$propertyCat = implode(",",$this->data['propertyCategory']);
									$arrayInfo['propertyCategory'] = $propertyCat;

								}

								$arrayInfo['maxStarRating']= $this->input->get('stars');
								$arrayInfo['minStarRating']= $this->input->get('stars');
								$arrayInfo['lat']= $this->input->get('lat');
								$arrayInfo['long']= $this->input->get('long');
								$sprice = $this->input->get('price');
								if (!empty ($sprice)) {
										$sprice = str_replace(";", ",", $sprice);
										$sprice = explode(",", $sprice);
										$minp = $sprice[0];
										$maxp = $sprice[1];
										$arrayInfo['minRate'] = $minp;
										$arrayInfo['maxRate'] = $maxp;
								}
								
								$is_hb = 1;
								/*
								echo "asdas";
								exit();*/
								$local_hotels = $this->ci->hotels_model->search_hotels_by_lat_lang($arrayInfo['lat'], $arrayInfo['long'],$arrayInfo+$arrayinfo1);
								/*echo json_encode($local_hotels);
								 exit();*/
								if($is_hb == 1){

									$resultData1 = $this->hb_lib->HotelLists($arrayInfo+$arrayinfo1);
									
									/*echo $resultData1;
									exit();*/
									$resultData2 = json_decode($resultData1);
									
									$final_hb_data['hotels'] = array();
									
									$hb_hotel_code = array();

									

							           $key_val = 0;
									for ($hb_r=0; $hb_r < count($resultData2->hotels->hotels) ; $hb_r++) { 

										$checkIn = date("m/d/Y", strtotime($arrayInfo['checkIn'])) ;
										$checkOut = date("m/d/Y", strtotime($arrayInfo['checkOut'])) ;
										 $date1 = new DateTime($checkIn);
							              $date2 = new DateTime($checkOut);

							              $diff = $date2->diff($date1)->format("%a");
								        $stars = filter_var($resultData2->hotels->hotels[$hb_r]->categoryName, FILTER_SANITIZE_NUMBER_INT);
								      

								        $is_valid_hotel = 0;
								        for ($hb_room=0; $hb_room < count($resultData2->hotels->hotels[$hb_r]->rooms) ; $hb_room++) { 
								        	if(isset($resultData2->hotels->hotels[$hb_r]->rooms[$hb_room]->rates[0]->net)){
								        		$is_valid_hotel = 1;
								        	}
								        }
								        if($is_valid_hotel == 1 && $stars >= $rating){
											$code = $resultData2->hotels->hotels[$hb_r]->code;
											$final_hb_data['hotels'][$key_val]->id = $code;
											$hb_hotel_code[$hb_r] = $resultData2->hotels->hotels[$hb_r]->code;
											$final_hb_data['hotels'][$key_val]->title = $resultData2->hotels->hotels[$hb_r]->name;
											$final_hb_data['hotels'][$key_val]->thumbnail = '';

											$slug = $this->data['baseUrl'].'hbhotel/'.$code.'?adults='.$adults.'&checkin='.$checkIn.'&checkOut='.$checkOut.$this->data['agesApendUrl'].'&room='.$room;
											$final_hb_data['hotels'][$key_val]->slug = $slug;
											/*$final_hb_data['hotels'][$key_val]->currCode = $resultData2->hotels->hotels[$hb_r]->currency;*/
											$final_hb_data['hotels'][$key_val]->currCode = '$';
											$final_hb_data['hotels'][$key_val]->price = number_format($resultData2->hotels->hotels[$hb_r]->minRate / $diff,1);
											$final_hb_data['hotels'][$key_val]->location = $resultData2->hotels->hotels[$hb_r]->destinationName;

											$hotel_longitude = $resultData2->hotels->hotels[$hb_r]->longitude;
											$hotel_latitude = $resultData2->hotels->hotels[$hb_r]->latitude;
											$final_hb_data['hotels'][$key_val]->longitude = $hotel_longitude;
											$final_hb_data['hotels'][$key_val]->latitude = $hotel_latitude;
											
											$final_hb_data['hotels'][$key_val]->distance = $this->distance($arrayInfo['lat'],$arrayInfo['long'],$hotel_latitude,$hotel_longitude,'K');

											$final_hb_data['hotels'][$key_val]->desc = '';
											$stars = filter_var($resultData2->hotels->hotels[$hb_r]->categoryName, FILTER_SANITIZE_NUMBER_INT);
											$final_Star = '';
											for ($star_i=0; $star_i < 5 ; $star_i++) { 
												if($star_i < $stars){
													$final_Star .= '<i class="price-text-color fa fa-star"></i>';
												}else{
													$final_Star .= '<i class="fa fa-star"></i>';
												}
											}
											$final_hb_data['hotels'][$key_val]->stars = $final_Star;
											$final_hb_data['hotels'][$key_val]->tripAdvisorRatingImg = null;
											$final_hb_data['hotels'][$key_val]->tripAdvisorRating = 0;
											$final_hb_data['hotels'][$key_val]->room_Data = $resultData2->hotels->hotels[$hb_r]->rooms;
											$key_val++;
										}
									}
									/*  echo '<pre>'.json_encode( $final_hb_data).'</pre>';
								        exit();*/
									
									if(count($final_hb_data['hotels']) > 0){
										$hb_image_data = $this->hb_lib->HotelImage_list($hb_hotel_code);
										/*echo json_encode($hb_image_data);
										exit();*/
										$img_main_url = 'http://photos.hotelbeds.com/giata/bigger/';
																		
										
										if(count($hb_image_data->hotels) > 0 && $hb_image_data != false){

											for ($hb_i=0; $hb_i < count($hb_image_data->hotels) ; $hb_i++) { 
												
												
												for ($hb_h=0; $hb_h < count($final_hb_data['hotels']) ; $hb_h++) { 
													
													
													if($final_hb_data['hotels'][$hb_h]->id == $hb_image_data->hotels[$hb_i]->code){
													
														$thumbnail = $img_main_url.$hb_image_data->hotels[$hb_i]->images[0]->path;
														$thumbnail1 = $hb_image_data->hotels[$hb_i]->images;
														/*echo json_encode($hb_image_data->hotels[$hb_i]);
														exit();*/
														$final_hb_data['hotels'][$hb_h]->thumbnail = $thumbnail;
														$final_hb_data['hotels'][$hb_h]->all_img = $thumbnail1;
														$old_location = $final_hb_data['hotels'][$hb_h]->location;
														$location = $hb_image_data->hotels[$hb_i]->address->content." ".$old_location;
														$final_hb_data['hotels'][$hb_h]->location = $location." ".$hb_image_data->hotels[$hb_i]->postalCode;
														
														
													}

												}

											}

										}else{
											//echo "else";
										}
										
									//echo json_encode($hb_image_data);
									}else{
										//echo "no hotel found";
									}

									/*echo '<pre>'.json_encode($local_hotels).'</pre>';*/
									/*echo count($local_hotels['hotels']);
									exit();*/
									/*error_reporting(E_ALL);*/
									/*$abc = array_merge($final_hb_data['hotels'] , $local_hotels['hotels']);*/
									if(count($local_hotels['hotels']) > 0){
									
										$abc = array_merge($local_hotels['hotels'],$final_hb_data['hotels']);
									}else{
									
										$abc = $final_hb_data['hotels'];
									}

									 function custom_sort($a,$b) {
							                return $a->distance > $b ->distance;
							           }
									
									/*print_r($abc);
									exit();*/
									$sort_Data = usort($abc, "custom_sort");
									/*echo print_r($abc);
									exit();
									echo "<br>";
									echo "<br>";
									echo json_encode($sort_Data);
									
									echo "<br>";*/

									$this->data['module'] = $abc;

								}else{
									$resultData = $this->ean_lib->HotelLists($arrayInfo);
								
									$result = $this->getResultInObjects($resultData,$this->data['checkin'],$this->data['checkout'],$adultString,$this->data['agesApendUrl']);
									$this->data['module'] = $result->hotels;
								}	
							/*error_reporting(E_ALL);	
									echo '<pre>'.json_encode( $abc).'</pre>';
								        exit();*/
								$this->data['multipleLocations'] = $result->multipleLocations;
								$this->data['locationInfo'] = $result->locationInfo;
								$this->data['moreResultsAvailable'] = $result->moreResultsAvailable;
								$this->data['cacheKey'] = $result->cacheKey;
								$this->data['cacheLocation'] = $result->cacheLocation;
								$this->data['lat'] = $arrayInfo['lat'];
								$this->data['long'] = $arrayInfo['long'];

								$cachedata = array(
													'customerSessionId' => $this->data['result']['HotelListResponse']['customerSessionId'],
													 'activePropertyCount' => $this->data['result']['HotelListResponse']['HotelList']['@activePropertyCount'],
													 'cachekey' => $cachekey,
													 'cacheloc' => $cacheloc);
								/*echo json_encode($cachedata);
								exit();*/
								$this->session->set_userdata($cachedata);
								
						}

				}
				else {
						$this->data['result'] = array();
				}
				$this->lang->load("front", $this->data['lang_set']);
				$this->data['page_title'] = 'Search';
				$this->data['currSign'] = $this->ean_lib->currency;

				$this->theme->view('listing', $this->data);
		}

		function ajax_call(){
			/*error_reporting(E_ALL);
			print_r($_GET);
			exit();*/
				$search = $this->input->get('search');
				$rating = $this->input->get('rating');
				$room = $this->input->get('room');

				//echo $this->input->get('child');
				for ($child_age=0; $child_age < $this->input->get('child') ; $child_age++) { 
					$c_ages[] = rand(0,15);
				}
				$final_child_Ages = implode(",", $c_ages);
				if (!empty ($search)) {
						$this->data['checkin'] = trim($_GET['checkIn']);
						$this->data['checkout'] = trim($_GET['checkOut']);
						$this->data['room'] = $room;
						$this->data['minprice'] = $this->settings[0]->front_search_min_price;
				        $this->data['maxprice'] = $this->settings[0]->front_search_max_price;
				        $this->data['rating'] = $rating;


						if (empty ($offset)) {
								// print_r($_POST);
								$arrayInfo["city"] = trim($_GET['city']);
								$tempCity[] = strtok($arrayInfo["city"], " ,-");
								$arrayInfo["destinationId"] = trim($_GET['destinationId']);
								$arrayInfo["city"] = $tempCity[0];
									// $arrayInfo['countryCode'] = 'IN';
								$arrayInfo['checkIn'] = trim($_GET['checkIn']);
									// $arrayInfo['checkIn'] = "18-08-2014";
								$arrayInfo['checkOut'] = trim($_GET['checkOut']);
								//$childAges = $this->input->get('childages');
								$childAges = $final_child_Ages;
								//$childCount = 0;
								$childAgesStr = "";
								if(!empty($childAges)){
								//$childCount =  count(explode(",",$childAges));
								$childAgesStr = ",".$child;
								}

								$adults = $this->input->get("adults");
								$this->data['propertyCategory'] = $_GET['propertyCategory'];
								$adultString = $adults.$childAgesStr;

								$this->data['adults'] = $adults;
								//$this->data['child'] = $childCount;
								$this->data['child'] = $this->input->get('child');
								$this->data['childAges'] = $childAges;
								if($this->data['child'] > 0){
									$this->data['agesApendUrl'] = '&ages='.$childAges;
								}else{
									$this->data['agesApendUrl'] = '';
								}

								$arrayinfo1['adults'] = $adults;
								$arrayinfo1['child'] = $this->input->get('child');
								$arrayinfo1['room'] = $room;
								/*$arrayinfo1['childAges'] = $childAges;*/
								$arrayinfo1['childAges'] = $final_child_Ages;

								$arrayInfo['rooms'] = "room1=$adultString";
								$arrayInfo['numberOfResult'] = $this->settings[0]->front_search;
								if(!empty($this->data['propertyCategory'])){
									$propertyCat = implode(",",$this->data['propertyCategory']);
									$arrayInfo['propertyCategory'] = $propertyCat;

								}

								$arrayInfo['maxStarRating']= $this->input->get('stars');
								$arrayInfo['minStarRating']= $this->input->get('stars');
								$arrayInfo['lat']= $this->input->get('lat');
								$arrayInfo['long']= $this->input->get('long');
								$sprice = $this->input->get('price');
								if (!empty ($sprice)) {
										$sprice = str_replace(";", ",", $sprice);
										$sprice = explode(",", $sprice);
										$minp = $sprice[0];
										$maxp = $sprice[1];
										$arrayInfo['minRate'] = $minp;
										$arrayInfo['maxRate'] = $maxp;
								}
								
								$is_hb = 1;
								
								$local_hotels = $this->ci->hotels_model->search_hotels_by_lat_lang($arrayInfo['lat'], $arrayInfo['long'],$arrayInfo+$arrayinfo1);
								
								if($is_hb == 1){

									$resultData1 = $this->hb_lib->HotelLists($arrayInfo+$arrayinfo1);
									
									
									$resultData2 = json_decode($resultData1);
									
									$final_hb_data['hotels'] = array();
									
									$hb_hotel_code = array();

									 function custom_sort($a,$b) {
							                return $a->distance > $b ->distance;
							           }

							           $key_val = 0;
									for ($hb_r=0; $hb_r < count($resultData2->hotels->hotels) ; $hb_r++) { 

										$checkIn = date("Y-m-d", strtotime($arrayInfo['checkIn'])) ;
										$checkOut = date("Y-m-d", strtotime($arrayInfo['checkOut'])) ;
								        $stars = filter_var($resultData2->hotels->hotels[$hb_r]->categoryName, FILTER_SANITIZE_NUMBER_INT);
								        /*echo json_encode( $resultData2->hotels->hotels[$hb_r]);
								        exit();*/

								        $is_valid_hotel = 0;
								        for ($hb_room=0; $hb_room < count($resultData2->hotels->hotels[$hb_r]->rooms) ; $hb_room++) { 
								        	if(isset($resultData2->hotels->hotels[$hb_r]->rooms[$hb_room]->rates[0]->net)){
								        		$is_valid_hotel = 1;
								        	}
								        }
								        if($is_valid_hotel == 1 && $stars >= $rating){
											$code = $resultData2->hotels->hotels[$hb_r]->code;
											$final_hb_data['hotels'][$key_val]->id = $code;
											$hb_hotel_code[$hb_r] = $resultData2->hotels->hotels[$hb_r]->code;
											$final_hb_data['hotels'][$key_val]->title = $resultData2->hotels->hotels[$hb_r]->name;
											$final_hb_data['hotels'][$key_val]->thumbnail = '';

											$slug = $this->data['baseUrl'].'hbhotel/'.$code.'?adults='.$adults.'&checkin='.$checkIn.'&checkout='.$checkOut.$this->data['agesApendUrl'];
											$final_hb_data['hotels'][$key_val]->slug = $slug;
											$final_hb_data['hotels'][$key_val]->currCode = $resultData2->hotels->hotels[$hb_r]->currency;
											$final_hb_data['hotels'][$key_val]->price = $resultData2->hotels->hotels[$hb_r]->minRate;
											$final_hb_data['hotels'][$key_val]->location = $resultData2->hotels->hotels[$hb_r]->destinationName;

											$hotel_longitude = $resultData2->hotels->hotels[$hb_r]->longitude;
											$hotel_latitude = $resultData2->hotels->hotels[$hb_r]->latitude;
											$final_hb_data['hotels'][$key_val]->longitude = $hotel_longitude;
											$final_hb_data['hotels'][$key_val]->latitude = $hotel_latitude;
											
											$final_hb_data['hotels'][$key_val]->distance = $this->distance($arrayInfo['lat'],$arrayInfo['long'],$hotel_latitude,$hotel_longitude,'K');

											$final_hb_data['hotels'][$key_val]->desc = '';
											$stars = filter_var($resultData2->hotels->hotels[$hb_r]->categoryName, FILTER_SANITIZE_NUMBER_INT);
											$final_Star = '';
											for ($star_i=0; $star_i < 5 ; $star_i++) { 
												if($star_i < $stars){
													$final_Star .= '<i class="price-text-color fa fa-star"></i>';
												}else{
													$final_Star .= '<i class="fa fa-star"></i>';
												}
											}
											$final_hb_data['hotels'][$key_val]->stars = $final_Star;
											$final_hb_data['hotels'][$key_val]->tripAdvisorRatingImg = null;
											$final_hb_data['hotels'][$key_val]->tripAdvisorRating = 0;
											$final_hb_data['hotels'][$key_val]->room_Data = $resultData2->hotels->hotels[$hb_r]->rooms;
											$key_val++;
										}
									}
									
									
									if(count($final_hb_data['hotels']) > 0){
										$hb_image_data = $this->hb_lib->HotelImage_list($hb_hotel_code);
										
										$img_main_url = 'http://photos.hotelbeds.com/giata/bigger/';
																		
										
										if(count($hb_image_data->hotels) > 0 && $hb_image_data != false){

											for ($hb_i=0; $hb_i < count($hb_image_data->hotels) ; $hb_i++) { 
												
												
												for ($hb_h=0; $hb_h < count($final_hb_data['hotels']) ; $hb_h++) { 
													
													
													if($final_hb_data['hotels'][$hb_h]->id == $hb_image_data->hotels[$hb_i]->code){
													
														$thumbnail = $img_main_url.$hb_image_data->hotels[$hb_i]->images[0]->path;
														$thumbnail1 = $hb_image_data->hotels[$hb_i]->images;
														/*echo json_encode($hb_image_data->hotels[$hb_i]);
														exit();*/
														$final_hb_data['hotels'][$hb_h]->thumbnail = $thumbnail;
														$final_hb_data['hotels'][$hb_h]->all_img = $thumbnail1;
														$old_location = $final_hb_data['hotels'][$hb_h]->location;
														$location = $hb_image_data->hotels[$hb_i]->address->content." ".$old_location;
														$final_hb_data['hotels'][$hb_h]->location = $location." ".$hb_image_data->hotels[$hb_i]->postalCode;
														
														
													}

												}

											}

										}else{
											//echo "else";
										}
										
									//echo json_encode($hb_image_data);
									}else{
										//echo "no hotel found";
									}

									/*echo '<pre>'.json_encode($local_hotels).'</pre>';*/
									/*exit();*/
									/*error_reporting(E_ALL);*/
									/*$abc = array_merge($final_hb_data['hotels'] , $local_hotels['hotels']);*/
									$abc = $final_hb_data['hotels'] + $local_hotels['hotels'];
									
									/*echo json_encode($abc);
									exit();*/
									$sort_Data = usort($abc, "custom_sort");
									$final_data = $abc;

								}else{
									$resultData = $this->ean_lib->HotelLists($arrayInfo);
								
									$result = $this->getResultInObjects($resultData,$this->data['checkin'],$this->data['checkout'],$adultString,$this->data['agesApendUrl']);
									$final_data = $result->hotels;
								}	

								
						}

				}
				else {
						$final_data = array();
				}
				
			echo  json_encode($final_data);

		}

		function search1($offset = null) {
			/*error_reporting(E_ALL);
			print_r($_GET);
			exit();*/
				$search = $this->input->get('search');
				$rating = $this->input->get('rating');
				$room = $this->input->get('room');

				//echo $this->input->get('child');
				for ($child_age=0; $child_age < $this->input->get('child') ; $child_age++) { 
					$c_ages[] = rand(0,15);
				}
				$final_child_Ages = implode(",", $c_ages);
				if (!empty ($search)) {
						$this->data['checkin'] = trim($_GET['checkIn']);
						$this->data['checkout'] = trim($_GET['checkOut']);
						$this->data['room'] = $room;
						$this->data['minprice'] = $this->settings[0]->front_search_min_price;
				        $this->data['maxprice'] = $this->settings[0]->front_search_max_price;
				        $this->data['rating'] = $rating;


						if (empty ($offset)) {
								// print_r($_POST);
								$arrayInfo["city"] = trim($_GET['city']);
								$tempCity[] = strtok($arrayInfo["city"], " ,-");
								$arrayInfo["destinationId"] = trim($_GET['destinationId']);
								$arrayInfo["city"] = $tempCity[0];
									// $arrayInfo['countryCode'] = 'IN';
								$arrayInfo['checkIn'] = trim($_GET['checkIn']);
									// $arrayInfo['checkIn'] = "18-08-2014";
								$arrayInfo['checkOut'] = trim($_GET['checkOut']);
								//$childAges = $this->input->get('childages');
								$childAges = $final_child_Ages;
								//$childCount = 0;
								$childAgesStr = "";
								if(!empty($childAges)){
								//$childCount =  count(explode(",",$childAges));
								$childAgesStr = ",".$child;
								}

								$adults = $this->input->get("adults");
								$this->data['propertyCategory'] = $_GET['propertyCategory'];
								$adultString = $adults.$childAgesStr;

								$this->data['adults'] = $adults;
								//$this->data['child'] = $childCount;
								$this->data['child'] = $this->input->get('child');
								$this->data['childAges'] = $childAges;
								if($this->data['child'] > 0){
									$this->data['agesApendUrl'] = '&ages='.$childAges;
								}else{
									$this->data['agesApendUrl'] = '';
								}

								$arrayinfo1['adults'] = $adults;
								$arrayinfo1['child'] = $this->input->get('child');
								$arrayinfo1['room'] = $room;
								/*$arrayinfo1['childAges'] = $childAges;*/
								$arrayinfo1['childAges'] = $final_child_Ages;

								$arrayInfo['rooms'] = "room1=$adultString";
								$arrayInfo['numberOfResult'] = $this->settings[0]->front_search;
								if(!empty($this->data['propertyCategory'])){
									$propertyCat = implode(",",$this->data['propertyCategory']);
									$arrayInfo['propertyCategory'] = $propertyCat;

								}

								$arrayInfo['maxStarRating']= $this->input->get('stars');
								$arrayInfo['minStarRating']= $this->input->get('stars');
								$arrayInfo['lat']= $this->input->get('lat');
								$arrayInfo['long']= $this->input->get('long');
								$sprice = $this->input->get('price');
								if (!empty ($sprice)) {
										$sprice = str_replace(";", ",", $sprice);
										$sprice = explode(",", $sprice);
										$minp = $sprice[0];
										$maxp = $sprice[1];
										$arrayInfo['minRate'] = $minp;
										$arrayInfo['maxRate'] = $maxp;
								}
								
								$is_hb = 1;
								/*
								echo "asdas";
								exit();*/
								$local_hotels = $this->ci->hotels_model->search_hotels_by_lat_lang($arrayInfo['lat'], $arrayInfo['long'],$arrayInfo+$arrayinfo1);
								/*echo json_encode($local_hotels);
								 exit();*/
								if($is_hb == 1){

									$resultData1 = $this->hb_lib->HotelLists($arrayInfo+$arrayinfo1);
									
									/*echo $resultData1;
									exit();*/
									$resultData2 = json_decode($resultData1);
									
									$final_hb_data['hotels'] = array();
									
									$hb_hotel_code = array();

									 function custom_sort($a,$b) {
							                return $a->distance > $b ->distance;
							           }

							           $key_val = 0;
									for ($hb_r=0; $hb_r < count($resultData2->hotels->hotels) ; $hb_r++) { 

										$checkIn = date("Y-m-d", strtotime($arrayInfo['checkIn'])) ;
										$checkOut = date("Y-m-d", strtotime($arrayInfo['checkOut'])) ;
								        $stars = filter_var($resultData2->hotels->hotels[$hb_r]->categoryName, FILTER_SANITIZE_NUMBER_INT);
								        /*echo json_encode( $resultData2->hotels->hotels[$hb_r]);
								        exit();*/

								        $is_valid_hotel = 0;
								        for ($hb_room=0; $hb_room < count($resultData2->hotels->hotels[$hb_r]->rooms) ; $hb_room++) { 
								        	if(isset($resultData2->hotels->hotels[$hb_r]->rooms[$hb_room]->rates[0]->net)){
								        		$is_valid_hotel = 1;
								        	}
								        }
								        if($is_valid_hotel == 1 && $stars >= $rating){
											$code = $resultData2->hotels->hotels[$hb_r]->code;
											$final_hb_data['hotels'][$key_val]->id = $code;
											$hb_hotel_code[$hb_r] = $resultData2->hotels->hotels[$hb_r]->code;
											$final_hb_data['hotels'][$key_val]->title = $resultData2->hotels->hotels[$hb_r]->name;
											$final_hb_data['hotels'][$key_val]->thumbnail = '';

											$slug = $this->data['baseUrl'].'hbhotel/'.$code.'?adults='.$adults.'&checkin='.$checkIn.'&checkout='.$checkOut.$this->data['agesApendUrl'];
											$final_hb_data['hotels'][$key_val]->slug = $slug;
											$final_hb_data['hotels'][$key_val]->currCode = $resultData2->hotels->hotels[$hb_r]->currency;
											$final_hb_data['hotels'][$key_val]->price = $resultData2->hotels->hotels[$hb_r]->minRate;
											$final_hb_data['hotels'][$key_val]->location = $resultData2->hotels->hotels[$hb_r]->destinationName;

											$hotel_longitude = $resultData2->hotels->hotels[$hb_r]->longitude;
											$hotel_latitude = $resultData2->hotels->hotels[$hb_r]->latitude;
											$final_hb_data['hotels'][$key_val]->longitude = $hotel_longitude;
											$final_hb_data['hotels'][$key_val]->latitude = $hotel_latitude;
											
											$final_hb_data['hotels'][$key_val]->distance = $this->distance($arrayInfo['lat'],$arrayInfo['long'],$hotel_latitude,$hotel_longitude,'K');

											$final_hb_data['hotels'][$key_val]->desc = '';
											$stars = filter_var($resultData2->hotels->hotels[$hb_r]->categoryName, FILTER_SANITIZE_NUMBER_INT);
											$final_Star = '';
											for ($star_i=0; $star_i < 5 ; $star_i++) { 
												if($star_i < $stars){
													$final_Star .= '<i class="price-text-color fa fa-star"></i>';
												}else{
													$final_Star .= '<i class="fa fa-star"></i>';
												}
											}
											$final_hb_data['hotels'][$key_val]->stars = $final_Star;
											$final_hb_data['hotels'][$key_val]->tripAdvisorRatingImg = null;
											$final_hb_data['hotels'][$key_val]->tripAdvisorRating = 0;
											$final_hb_data['hotels'][$key_val]->room_Data = $resultData2->hotels->hotels[$hb_r]->rooms;
											$key_val++;
										}
									}
									
									
									if(count($final_hb_data['hotels']) > 0){
										$hb_image_data = $this->hb_lib->HotelImage_list($hb_hotel_code);
										
										$img_main_url = 'http://photos.hotelbeds.com/giata/bigger/';
																		
										
										if(count($hb_image_data->hotels) > 0 && $hb_image_data != false){

											for ($hb_i=0; $hb_i < count($hb_image_data->hotels) ; $hb_i++) { 
												
												
												for ($hb_h=0; $hb_h < count($final_hb_data['hotels']) ; $hb_h++) { 
													
													
													if($final_hb_data['hotels'][$hb_h]->id == $hb_image_data->hotels[$hb_i]->code){
													
														$thumbnail = $img_main_url.$hb_image_data->hotels[$hb_i]->images[0]->path;
														$thumbnail1 = $hb_image_data->hotels[$hb_i]->images;
														/*echo json_encode($hb_image_data->hotels[$hb_i]);
														exit();*/
														$final_hb_data['hotels'][$hb_h]->thumbnail = $thumbnail;
														$final_hb_data['hotels'][$hb_h]->all_img = $thumbnail1;
														$old_location = $final_hb_data['hotels'][$hb_h]->location;
														$location = $hb_image_data->hotels[$hb_i]->address->content." ".$old_location;
														$final_hb_data['hotels'][$hb_h]->location = $location." ".$hb_image_data->hotels[$hb_i]->postalCode;
														
														
													}

												}

											}

										}else{
											//echo "else";
										}
										
									//echo json_encode($hb_image_data);
									}else{
										//echo "no hotel found";
									}

									/*echo '<pre>'.json_encode($local_hotels).'</pre>';*/
									/*exit();*/
									/*error_reporting(E_ALL);*/
									/*$abc = array_merge($final_hb_data['hotels'] , $local_hotels['hotels']);*/
									$abc = $final_hb_data['hotels'] + $local_hotels['hotels'];
									
									/*echo json_encode($abc);
									exit();*/
									$sort_Data = usort($abc, "custom_sort");
									$this->data['module'] = $abc;

								}else{
									$resultData = $this->ean_lib->HotelLists($arrayInfo);
								
									$result = $this->getResultInObjects($resultData,$this->data['checkin'],$this->data['checkout'],$adultString,$this->data['agesApendUrl']);
									$this->data['module'] = $result->hotels;
								}	
								

								$this->data['multipleLocations'] = $result->multipleLocations;
								$this->data['locationInfo'] = $result->locationInfo;
								$this->data['moreResultsAvailable'] = $result->moreResultsAvailable;
								$this->data['cacheKey'] = $result->cacheKey;
								$this->data['cacheLocation'] = $result->cacheLocation;
								$this->data['lat'] = $arrayInfo['lat'];
								$this->data['long'] = $arrayInfo['long'];

								$cachedata = array(
													'customerSessionId' => $this->data['result']['HotelListResponse']['customerSessionId'],
													 'activePropertyCount' => $this->data['result']['HotelListResponse']['HotelList']['@activePropertyCount'],
													 'cachekey' => $cachekey,
													 'cacheloc' => $cacheloc);
								/*echo json_encode($cachedata);
								exit();*/
								$this->session->set_userdata($cachedata);
								
								
						}

				}
				else {
						$this->data['result'] = array();
				}
				$this->lang->load("front", $this->data['lang_set']);
				$this->data['page_title'] = 'Search';
				$this->data['currSign'] = $this->ean_lib->currency;

				$this->theme->view('box-listing', $this->data);
		}

		function search2($offset = null) {
			/*error_reporting(E_ALL);
			print_r($_GET);
			exit();*/
				$search = $this->input->get('search');
				$rating = $this->input->get('rating');
				$room = $this->input->get('room');

				//echo $this->input->get('child');
				for ($child_age=0; $child_age < $this->input->get('child') ; $child_age++) { 
					$c_ages[] = rand(0,15);
				}
				$final_child_Ages = implode(",", $c_ages);
				if (!empty ($search)) {
						$this->data['checkin'] = trim($_GET['checkIn']);
						$this->data['checkout'] = trim($_GET['checkOut']);
						$this->data['room'] = $room;
						$this->data['minprice'] = $this->settings[0]->front_search_min_price;
				        $this->data['maxprice'] = $this->settings[0]->front_search_max_price;
				        $this->data['rating'] = $rating;


						if (empty ($offset)) {
								// print_r($_POST);
								$arrayInfo["city"] = trim($_GET['city']);
								$tempCity[] = strtok($arrayInfo["city"], " ,-");
								$arrayInfo["destinationId"] = trim($_GET['destinationId']);
								$arrayInfo["city"] = $tempCity[0];
									// $arrayInfo['countryCode'] = 'IN';
								$arrayInfo['checkIn'] = trim($_GET['checkIn']);
									// $arrayInfo['checkIn'] = "18-08-2014";
								$arrayInfo['checkOut'] = trim($_GET['checkOut']);
								//$childAges = $this->input->get('childages');
								$childAges = $final_child_Ages;
								//$childCount = 0;
								$childAgesStr = "";
								if(!empty($childAges)){
								//$childCount =  count(explode(",",$childAges));
								$childAgesStr = ",".$child;
								}

								$adults = $this->input->get("adults");
								$this->data['propertyCategory'] = $_GET['propertyCategory'];
								$adultString = $adults.$childAgesStr;

								$this->data['adults'] = $adults;
								//$this->data['child'] = $childCount;
								$this->data['child'] = $this->input->get('child');
								$this->data['childAges'] = $childAges;
								if($this->data['child'] > 0){
									$this->data['agesApendUrl'] = '&ages='.$childAges;
								}else{
									$this->data['agesApendUrl'] = '';
								}

								$arrayinfo1['adults'] = $adults;
								$arrayinfo1['child'] = $this->input->get('child');
								$arrayinfo1['room'] = $room;
								/*$arrayinfo1['childAges'] = $childAges;*/
								$arrayinfo1['childAges'] = $final_child_Ages;

								$arrayInfo['rooms'] = "room1=$adultString";
								$arrayInfo['numberOfResult'] = $this->settings[0]->front_search;
								if(!empty($this->data['propertyCategory'])){
									$propertyCat = implode(",",$this->data['propertyCategory']);
									$arrayInfo['propertyCategory'] = $propertyCat;

								}

								$arrayInfo['maxStarRating']= $this->input->get('stars');
								$arrayInfo['minStarRating']= $this->input->get('stars');
								$arrayInfo['lat']= $this->input->get('lat');
								$arrayInfo['long']= $this->input->get('long');
								$sprice = $this->input->get('price');
								if (!empty ($sprice)) {
										$sprice = str_replace(";", ",", $sprice);
										$sprice = explode(",", $sprice);
										$minp = $sprice[0];
										$maxp = $sprice[1];
										$arrayInfo['minRate'] = $minp;
										$arrayInfo['maxRate'] = $maxp;
								}
								
								$is_hb = 1;
								/*
								echo "asdas";
								exit();*/
								$local_hotels = $this->ci->hotels_model->search_hotels_by_lat_lang($arrayInfo['lat'], $arrayInfo['long'],$arrayInfo+$arrayinfo1);
								/*echo json_encode($local_hotels);
								 exit();*/
								if($is_hb == 1){

									$resultData1 = $this->hb_lib->HotelLists($arrayInfo+$arrayinfo1);
									
									/*echo $resultData1;
									exit();*/
									$resultData2 = json_decode($resultData1);
									
									$final_hb_data['hotels'] = array();
									
									$hb_hotel_code = array();

									 function custom_sort($a,$b) {
							                return $a->distance > $b ->distance;
							           }

							           $key_val = 0;
									for ($hb_r=0; $hb_r < count($resultData2->hotels->hotels) ; $hb_r++) { 

										$checkIn = date("Y-m-d", strtotime($arrayInfo['checkIn'])) ;
										$checkOut = date("Y-m-d", strtotime($arrayInfo['checkOut'])) ;
								        $stars = filter_var($resultData2->hotels->hotels[$hb_r]->categoryName, FILTER_SANITIZE_NUMBER_INT);
								        /*echo json_encode( $resultData2->hotels->hotels[$hb_r]);
								        exit();*/

								        $is_valid_hotel = 0;
								        for ($hb_room=0; $hb_room < count($resultData2->hotels->hotels[$hb_r]->rooms) ; $hb_room++) { 
								        	if(isset($resultData2->hotels->hotels[$hb_r]->rooms[$hb_room]->rates[0]->net)){
								        		$is_valid_hotel = 1;
								        	}
								        }
								        if($is_valid_hotel == 1 && $stars >= $rating){
											$code = $resultData2->hotels->hotels[$hb_r]->code;
											$final_hb_data['hotels'][$key_val]->id = $code;
											$hb_hotel_code[$hb_r] = $resultData2->hotels->hotels[$hb_r]->code;
											$final_hb_data['hotels'][$key_val]->title = $resultData2->hotels->hotels[$hb_r]->name;
											$final_hb_data['hotels'][$key_val]->thumbnail = '';

											$slug = $this->data['baseUrl'].'hbhotel/'.$code.'?adults='.$adults.'&checkin='.$checkIn.'&checkout='.$checkOut.$this->data['agesApendUrl'];
											$final_hb_data['hotels'][$key_val]->slug = $slug;
											$final_hb_data['hotels'][$key_val]->currCode = $resultData2->hotels->hotels[$hb_r]->currency;
											$final_hb_data['hotels'][$key_val]->price = $resultData2->hotels->hotels[$hb_r]->minRate;
											$final_hb_data['hotels'][$key_val]->location = $resultData2->hotels->hotels[$hb_r]->destinationName;

											$hotel_longitude = $resultData2->hotels->hotels[$hb_r]->longitude;
											$hotel_latitude = $resultData2->hotels->hotels[$hb_r]->latitude;
											$final_hb_data['hotels'][$key_val]->longitude = $hotel_longitude;
											$final_hb_data['hotels'][$key_val]->latitude = $hotel_latitude;
											
											$final_hb_data['hotels'][$key_val]->distance = $this->distance($arrayInfo['lat'],$arrayInfo['long'],$hotel_latitude,$hotel_longitude,'K');

											$final_hb_data['hotels'][$key_val]->desc = '';
											$stars = filter_var($resultData2->hotels->hotels[$hb_r]->categoryName, FILTER_SANITIZE_NUMBER_INT);
											$final_Star = '';
											for ($star_i=0; $star_i < 5 ; $star_i++) { 
												if($star_i < $stars){
													$final_Star .= '<i class="price-text-color fa fa-star"></i>';
												}else{
													$final_Star .= '<i class="fa fa-star"></i>';
												}
											}
											$final_hb_data['hotels'][$key_val]->stars = $final_Star;
											$final_hb_data['hotels'][$key_val]->tripAdvisorRatingImg = null;
											$final_hb_data['hotels'][$key_val]->tripAdvisorRating = 0;
											$final_hb_data['hotels'][$key_val]->room_Data = $resultData2->hotels->hotels[$hb_r]->rooms;
											$key_val++;
										}
									}
									
									
									if(count($final_hb_data['hotels']) > 0){
										$hb_image_data = $this->hb_lib->HotelImage_list($hb_hotel_code);
										
										$img_main_url = 'http://photos.hotelbeds.com/giata/bigger/';
																		
										
										if(count($hb_image_data->hotels) > 0 && $hb_image_data != false){

											for ($hb_i=0; $hb_i < count($hb_image_data->hotels) ; $hb_i++) { 
												
												
												for ($hb_h=0; $hb_h < count($final_hb_data['hotels']) ; $hb_h++) { 
													
													
													if($final_hb_data['hotels'][$hb_h]->id == $hb_image_data->hotels[$hb_i]->code){
													
														$thumbnail = $img_main_url.$hb_image_data->hotels[$hb_i]->images[0]->path;
														$thumbnail1 = $hb_image_data->hotels[$hb_i]->images;
														/*echo json_encode($hb_image_data->hotels[$hb_i]);
														exit();*/
														$final_hb_data['hotels'][$hb_h]->thumbnail = $thumbnail;
														$final_hb_data['hotels'][$hb_h]->all_img = $thumbnail1;
														$old_location = $final_hb_data['hotels'][$hb_h]->location;
														$location = $hb_image_data->hotels[$hb_i]->address->content." ".$old_location;
														$final_hb_data['hotels'][$hb_h]->location = $location." ".$hb_image_data->hotels[$hb_i]->postalCode;
														
														
													}

												}

											}

										}else{
											//echo "else";
										}
										
									//echo json_encode($hb_image_data);
									}else{
										//echo "no hotel found";
									}

									/*echo '<pre>'.json_encode($local_hotels).'</pre>';*/
									/*exit();*/
									/*error_reporting(E_ALL);*/
									/*$abc = array_merge($final_hb_data['hotels'] , $local_hotels['hotels']);*/
									$abc = $final_hb_data['hotels'] + $local_hotels['hotels'];
									
									/*echo json_encode($abc);
									exit();*/
									$sort_Data = usort($abc, "custom_sort");
									$this->data['module'] = $abc;

								}else{
									$resultData = $this->ean_lib->HotelLists($arrayInfo);
								
									$result = $this->getResultInObjects($resultData,$this->data['checkin'],$this->data['checkout'],$adultString,$this->data['agesApendUrl']);
									$this->data['module'] = $result->hotels;
								}	
								

								$this->data['multipleLocations'] = $result->multipleLocations;
								$this->data['locationInfo'] = $result->locationInfo;
								$this->data['moreResultsAvailable'] = $result->moreResultsAvailable;
								$this->data['cacheKey'] = $result->cacheKey;
								$this->data['cacheLocation'] = $result->cacheLocation;
								$this->data['lat'] = $arrayInfo['lat'];
								$this->data['long'] = $arrayInfo['long'];

								$cachedata = array(
													'customerSessionId' => $this->data['result']['HotelListResponse']['customerSessionId'],
													 'activePropertyCount' => $this->data['result']['HotelListResponse']['HotelList']['@activePropertyCount'],
													 'cachekey' => $cachekey,
													 'cacheloc' => $cacheloc);
								/*echo json_encode($cachedata);
								exit();*/
								$this->session->set_userdata($cachedata);
								
								
						}

				}
				else {
						$this->data['result'] = array();
				}
				$this->lang->load("front", $this->data['lang_set']);
				$this->data['page_title'] = 'Search';
				$this->data['currSign'] = $this->ean_lib->currency;

				$this->theme->view('grid-listing', $this->data);
		}

		function search3($offset = null) {
			/*error_reporting(E_ALL);
			print_r($_GET);
			exit();*/
				$search = $this->input->get('search');
				$rating = $this->input->get('rating');
				$room = $this->input->get('room');

				//echo $this->input->get('child');
				for ($child_age=0; $child_age < $this->input->get('child') ; $child_age++) { 
					$c_ages[] = rand(0,15);
				}
				$final_child_Ages = implode(",", $c_ages);
				if (!empty ($search)) {
						$this->data['checkin'] = trim($_GET['checkIn']);
						$this->data['checkout'] = trim($_GET['checkOut']);
						$this->data['room'] = $room;
						$this->data['minprice'] = $this->settings[0]->front_search_min_price;
				        $this->data['maxprice'] = $this->settings[0]->front_search_max_price;
				        $this->data['rating'] = $rating;


						if (empty ($offset)) {
								// print_r($_POST);
								$arrayInfo["city"] = trim($_GET['city']);
								$tempCity[] = strtok($arrayInfo["city"], " ,-");
								$arrayInfo["destinationId"] = trim($_GET['destinationId']);
								$arrayInfo["city"] = $tempCity[0];
									// $arrayInfo['countryCode'] = 'IN';
								$arrayInfo['checkIn'] = trim($_GET['checkIn']);
									// $arrayInfo['checkIn'] = "18-08-2014";
								$arrayInfo['checkOut'] = trim($_GET['checkOut']);
								//$childAges = $this->input->get('childages');
								$childAges = $final_child_Ages;
								//$childCount = 0;
								$childAgesStr = "";
								if(!empty($childAges)){
								//$childCount =  count(explode(",",$childAges));
								$childAgesStr = ",".$child;
								}

								$adults = $this->input->get("adults");
								$this->data['propertyCategory'] = $_GET['propertyCategory'];
								$adultString = $adults.$childAgesStr;

								$this->data['adults'] = $adults;
								//$this->data['child'] = $childCount;
								$this->data['child'] = $this->input->get('child');
								$this->data['childAges'] = $childAges;
								if($this->data['child'] > 0){
									$this->data['agesApendUrl'] = '&ages='.$childAges;
								}else{
									$this->data['agesApendUrl'] = '';
								}

								$arrayinfo1['adults'] = $adults;
								$arrayinfo1['child'] = $this->input->get('child');
								$arrayinfo1['room'] = $room;
								/*$arrayinfo1['childAges'] = $childAges;*/
								$arrayinfo1['childAges'] = $final_child_Ages;

								$arrayInfo['rooms'] = "room1=$adultString";
								$arrayInfo['numberOfResult'] = $this->settings[0]->front_search;
								if(!empty($this->data['propertyCategory'])){
									$propertyCat = implode(",",$this->data['propertyCategory']);
									$arrayInfo['propertyCategory'] = $propertyCat;

								}

								$arrayInfo['maxStarRating']= $this->input->get('stars');
								$arrayInfo['minStarRating']= $this->input->get('stars');
								$arrayInfo['lat']= $this->input->get('lat');
								$arrayInfo['long']= $this->input->get('long');
								$sprice = $this->input->get('price');
								if (!empty ($sprice)) {
										$sprice = str_replace(";", ",", $sprice);
										$sprice = explode(",", $sprice);
										$minp = $sprice[0];
										$maxp = $sprice[1];
										$arrayInfo['minRate'] = $minp;
										$arrayInfo['maxRate'] = $maxp;
								}
								
								$is_hb = 1;
								/*
								echo "asdas";
								exit();*/
								$local_hotels = $this->ci->hotels_model->search_hotels_by_lat_lang($arrayInfo['lat'], $arrayInfo['long'],$arrayInfo+$arrayinfo1);
								/*echo json_encode($local_hotels);
								 exit();*/
								if($is_hb == 1){

									$resultData1 = $this->hb_lib->HotelLists($arrayInfo+$arrayinfo1);
									
									/*echo $resultData1;
									exit();*/
									$resultData2 = json_decode($resultData1);
									
									$final_hb_data['hotels'] = array();
									
									$hb_hotel_code = array();

									 function custom_sort($a,$b) {
							                return $a->distance > $b ->distance;
							           }

							           $key_val = 0;
									for ($hb_r=0; $hb_r < count($resultData2->hotels->hotels) ; $hb_r++) { 

										$checkIn = date("Y-m-d", strtotime($arrayInfo['checkIn'])) ;
										$checkOut = date("Y-m-d", strtotime($arrayInfo['checkOut'])) ;
								        $stars = filter_var($resultData2->hotels->hotels[$hb_r]->categoryName, FILTER_SANITIZE_NUMBER_INT);
								        /*echo json_encode( $resultData2->hotels->hotels[$hb_r]);
								        exit();*/

								        $is_valid_hotel = 0;
								        for ($hb_room=0; $hb_room < count($resultData2->hotels->hotels[$hb_r]->rooms) ; $hb_room++) { 
								        	if(isset($resultData2->hotels->hotels[$hb_r]->rooms[$hb_room]->rates[0]->net)){
								        		$is_valid_hotel = 1;
								        	}
								        }
								        if($is_valid_hotel == 1 && $stars >= $rating){
											$code = $resultData2->hotels->hotels[$hb_r]->code;
											$final_hb_data['hotels'][$key_val]->id = $code;
											$hb_hotel_code[$hb_r] = $resultData2->hotels->hotels[$hb_r]->code;
											$final_hb_data['hotels'][$key_val]->title = $resultData2->hotels->hotels[$hb_r]->name;
											$final_hb_data['hotels'][$key_val]->thumbnail = '';

											$slug = $this->data['baseUrl'].'hbhotel/'.$code.'?adults='.$adults.'&checkin='.$checkIn.'&checkout='.$checkOut.$this->data['agesApendUrl'];
											$final_hb_data['hotels'][$key_val]->slug = $slug;
											$final_hb_data['hotels'][$key_val]->currCode = $resultData2->hotels->hotels[$hb_r]->currency;
											$final_hb_data['hotels'][$key_val]->price = $resultData2->hotels->hotels[$hb_r]->minRate;
											$final_hb_data['hotels'][$key_val]->location = $resultData2->hotels->hotels[$hb_r]->destinationName;

											$hotel_longitude = $resultData2->hotels->hotels[$hb_r]->longitude;
											$hotel_latitude = $resultData2->hotels->hotels[$hb_r]->latitude;
											$final_hb_data['hotels'][$key_val]->longitude = $hotel_longitude;
											$final_hb_data['hotels'][$key_val]->latitude = $hotel_latitude;
											
											$final_hb_data['hotels'][$key_val]->distance = $this->distance($arrayInfo['lat'],$arrayInfo['long'],$hotel_latitude,$hotel_longitude,'K');

											$final_hb_data['hotels'][$key_val]->desc = '';
											$stars = filter_var($resultData2->hotels->hotels[$hb_r]->categoryName, FILTER_SANITIZE_NUMBER_INT);
											$final_Star = '';
											for ($star_i=0; $star_i < 5 ; $star_i++) { 
												if($star_i < $stars){
													$final_Star .= '<i class="price-text-color fa fa-star"></i>';
												}else{
													$final_Star .= '<i class="fa fa-star"></i>';
												}
											}
											$final_hb_data['hotels'][$key_val]->stars = $final_Star;
											$final_hb_data['hotels'][$key_val]->tripAdvisorRatingImg = null;
											$final_hb_data['hotels'][$key_val]->tripAdvisorRating = 0;
											$final_hb_data['hotels'][$key_val]->room_Data = $resultData2->hotels->hotels[$hb_r]->rooms;
											$key_val++;
										}
									}
									
									
									if(count($final_hb_data['hotels']) > 0){
										$hb_image_data = $this->hb_lib->HotelImage_list($hb_hotel_code);
										
										$img_main_url = 'http://photos.hotelbeds.com/giata/bigger/';
																		
										
										if(count($hb_image_data->hotels) > 0 && $hb_image_data != false){

											for ($hb_i=0; $hb_i < count($hb_image_data->hotels) ; $hb_i++) { 
												
												
												for ($hb_h=0; $hb_h < count($final_hb_data['hotels']) ; $hb_h++) { 
													
													
													if($final_hb_data['hotels'][$hb_h]->id == $hb_image_data->hotels[$hb_i]->code){
													
														$thumbnail = $img_main_url.$hb_image_data->hotels[$hb_i]->images[0]->path;
														$thumbnail1 = $hb_image_data->hotels[$hb_i]->images;
														/*echo json_encode($hb_image_data->hotels[$hb_i]);
														exit();*/
														$final_hb_data['hotels'][$hb_h]->thumbnail = $thumbnail;
														$final_hb_data['hotels'][$hb_h]->all_img = $thumbnail1;
														$old_location = $final_hb_data['hotels'][$hb_h]->location;
														$location = $hb_image_data->hotels[$hb_i]->address->content." ".$old_location;
														$final_hb_data['hotels'][$hb_h]->location = $location." ".$hb_image_data->hotels[$hb_i]->postalCode;
														
														
													}

												}

											}

										}else{
											//echo "else";
										}
										
									//echo json_encode($hb_image_data);
									}else{
										//echo "no hotel found";
									}

									/*echo '<pre>'.json_encode($local_hotels).'</pre>';*/
									/*exit();*/
									/*error_reporting(E_ALL);*/
									/*$abc = array_merge($final_hb_data['hotels'] , $local_hotels['hotels']);*/
									$abc = $final_hb_data['hotels'] + $local_hotels['hotels'];
									
									/*echo json_encode($abc);
									exit();*/
									$sort_Data = usort($abc, "custom_sort");
									$this->data['module'] = $abc;

								}else{
									$resultData = $this->ean_lib->HotelLists($arrayInfo);
								
									$result = $this->getResultInObjects($resultData,$this->data['checkin'],$this->data['checkout'],$adultString,$this->data['agesApendUrl']);
									$this->data['module'] = $result->hotels;
								}	
								

								$this->data['multipleLocations'] = $result->multipleLocations;
								$this->data['locationInfo'] = $result->locationInfo;
								$this->data['moreResultsAvailable'] = $result->moreResultsAvailable;
								$this->data['cacheKey'] = $result->cacheKey;
								$this->data['cacheLocation'] = $result->cacheLocation;
								$this->data['lat'] = $arrayInfo['lat'];
								$this->data['long'] = $arrayInfo['long'];

								$cachedata = array(
													'customerSessionId' => $this->data['result']['HotelListResponse']['customerSessionId'],
													 'activePropertyCount' => $this->data['result']['HotelListResponse']['HotelList']['@activePropertyCount'],
													 'cachekey' => $cachekey,
													 'cacheloc' => $cacheloc);
								/*echo json_encode($cachedata);
								exit();*/
								$this->session->set_userdata($cachedata);
								
								
						}

				}
				else {
						$this->data['result'] = array();
				}
				$this->lang->load("front", $this->data['lang_set']);
				$this->data['page_title'] = 'Search';
				$this->data['currSign'] = $this->ean_lib->currency;

				$this->theme->view('map-listing', $this->data);
		}

		function __firstlist() {
				$checkin = date("m/d/Y", strtotime("+1 days"));
				$checkout = date("m/d/Y", strtotime("+2 days"));
				$this->data['checkin'] = $checkin;
				$this->data['checkout'] = $checkout;
				$adults = 2;
				$this->data['adults'] = $adults;
				$arrayInfo["city"] = $this->city;
				$arrayInfo['checkIn'] = trim($checkin);
				$arrayInfo['checkOut'] = trim($checkout);
				$arrayInfo['rooms'] = "room1=$adults";
				$arrayInfo['numberOfResult'] = $this->numberofresults;
				$result = $this->ean_lib->HotelLists($arrayInfo);
				return $this->getResultInObjects($result,$checkin,$checkout,$adults);
		}

		function __forMap() {

				$checkin = date("m/d/Y", strtotime("+1 days"));
				$checkout = date("m/d/Y", strtotime("+2 days"));
				$this->data['checkin'] = $checkin;
				$this->data['checkout'] = $checkout;
				$adults = 2;
				$this->data['adults'] = $adults;
				$arrayInfo["city"] = $this->city;
				$arrayInfo['checkIn'] = trim($checkin);
				$arrayInfo['checkOut'] = trim($checkout);
				$arrayInfo['rooms'] = "room1=$adults";
				$arrayInfo['numberOfResult'] = 50;
				return $this->ean_lib->HotelLists($arrayInfo);
		}

		public function hotel($hotelId, $customerSessionId) {

			$module = new stdClass;

			$isValidLang = pt_isValid_language($hotelId);
			$surl = http_build_query($_GET);
			if($isValidLang){
				$currLang = $hotelId;
            	$hotelId = $this->uri->segment(4);
            	$customerSessionId = $this->uri->segment(5);

            	redirect($this->data['baseUrl']."hotel/".$hotelId."/".$customerSessionId.'?'.$surl,'refresh');
            }else{
            	$currLang = $this->data['lang_set'];

            }


				$arrayInfo['hotelId'] = $hotelId;
				$arrayInfo['customerSessionId'] = $customerSessionId;
				$result = $this->ean_lib->HotelDetails($arrayInfo);
				$this->data['module'] = $this->getHotelDetailsObject($hotelid, $result);
				$this->data['lowestPrice'] = $this->data['module']->lowRate;
				$this->data['currencySign'] = $this->ean_lib->currency;

				$checkinDate = trim($this->input->get('checkin'));
				$checkoutDate = trim($this->input->get('checkout'));
				$now = new DateTime();
				if(empty($checkinDate)){
					$checkinDate = date("m/d/Y", strtotime("+1 days"));
				}
				$checkin = new DateTime($checkinDate);

				if($checkin < $now){
					 $checkinDate = date("m/d/Y", strtotime("+1 days"));
				}

				if(empty($checkoutDate)){
					$checkoutDate = date("m/d/Y", strtotime("+3 days"));
				}

				$checkOut = new DateTime($checkoutDate);
				if($checkOut < $now){
					$checkoutDate = date("m/d/Y", strtotime("+3 days"));
				}

				$arrayInfo['checkIn'] = $checkinDate;
				$arrayInfo['checkOut'] = $checkoutDate;
				$childAges = $this->input->get('ages');
				$this->data['childAges'] = $childAges;
				if(!empty($childAges)){
					$ages = ",".$childAges;
				}else{
					$ages = "";
				}

				$adultsCount = $this->input->get('adults');
				if(empty($adultsCount)){
					$adultsCount = 2;
				}

				$this->data['adultsCount'] = $adultsCount;

				if(!empty($childAges)){
				$this->data['childCount'] = count(explode(",",$childAges));

				}
				$adults = $this->input->get('adults').$ages;
				$arrayInfo['rooms'] = "room1=$adults";

				$this->data['hotelid'] = $hotelId;
				$this->data['sessionid'] = $customerSessionId;
				$this->data['HotelInfo'] = $result['HotelInformationResponse'];
				//$this->data['HotelSummary'] = $result['HotelInformationResponse']['HotelSummary'];
				//$this->data['HotelDetails'] = $result['HotelInformationResponse']['HotelDetails'];
				//$this->data['HotelImages'] = $result['HotelInformationResponse']['HotelImages'];
				$this->data['thumbnailImage'] = str_replace("_t", "_b", $this->data['module']->sliderImages['0']['thumbnailUrl']);
				$this->session->set_userdata('hotelThumb', $this->data['thumbnailImage']);

				//$this->data['Facilities'] = $result['HotelInformationResponse']['RoomTypes']['RoomType']['0']['roomAmenities']['RoomAmenity'];
				//$this->data['relatedHotels'] = $this->ean_lib->getRelatedHotels($this->data['HotelSummary']['city']);
				$related = $this->ean_lib->getRelatedHotels($this->data['module']->location);
				if(!empty($related->hotels)){
					$this->data['module']->relatedItems = $related->hotels;
				}

				$roomresponse = $this->ean_lib->HotelRoomAvailability($arrayInfo);


				/*echo json_encode($roomresponse);
				exit();*/
				$roomsInfo = $roomresponse['HotelRoomAvailabilityResponse'];
				$roomsData = $this->getRoomsObject($roomsInfo);
				$this->data['hasRooms'] = $roomsData->hasRooms;
				$this->data['checkInInstructions'] = $roomsData->checkInInstructions;
				$this->data['specialCheckInInstructions'] = $roomsData->specialCheckInInstructions;
		

				/* For Room Availability Request and Response */

              /*  echo "<pre>";
                echo $this->ean_lib->apistr."<br>";
                print_r($roomsInfo);
                echo "</pre>";
                exit;*/

				$this->data['loggedin'] = $this->loggedin;

				$this->data['rooms'] = $roomsInfo['HotelRoomResponse'];

				$this->data['maxAdults'] = $roomsInfo['HotelRoomResponse'][0]['rateOccupancyPerRoom'];

				$this->data['checkin'] = $checkinDate; //$roomsInfo['arrivalDate'];
				$this->data['checkout'] = $checkoutDate; //$roomsInfo['departureDate'];


				$this->data['apistr'] = $this->ean_lib->apistr;
				$this->lang->load("front", $currLang);
				$this->data['page_title'] = $this->data['module']->title;

				$this->data['langurl'] = $this->data['baseUrl']."hotel/{langid}/".$hotelId."/".$customerSessionId.'?'.$surl;
				/*echo $this->data['langurl'];
			
			exit();*/
			/*echo json_encode($this->data['module']);
			exit();*/
				$this->theme->view('details', $this->data);
		}

		public function hbhotel($hotelId, $customerSessionId) {

			$module = new stdClass;

			$isValidLang = pt_isValid_language($hotelId);
			$surl = http_build_query($_GET);
			if($isValidLang){
				$currLang = $hotelId;
            	$hotelId = $this->uri->segment(4);
            	//$customerSessionId = $this->uri->segment(5);

            	redirect($this->data['baseUrl']."hbhotel/".$hotelId."/".$customerSessionId.'?'.$surl,'refresh');
            }else{
            	$currLang = $this->data['lang_set'];

            }
            	/*error_reporting(E_ALL);*/
            	
				$arrayInfo[] = $hotelId;
				
				$Hotel_details = $this->hb_lib->Hotel_details($hotelId);

				$ne_facilities = array();
				$description = "";
				if(isset($Hotel_details->hotel)){
					$description = $Hotel_details->hotel->description->content;
					$facilities_ary = $Hotel_details->hotel->facilities;
					//echo count($facilities_ary);
					for ($i=0; $i < count($facilities_ary) ; $i++) { 
						$main_fac = $Hotel_details->hotel->facilities[$i];
						$ne_facilities[$i]->name = $main_fac->description->content;
					}

					//echo json_encode($ne_facilities);
				}
				$result = $this->hb_lib->HotelImage_list($arrayInfo);
				/*echo json_encode($result);
				exit();*/
				
				if(count($result->hotels) > 0){

					$hotel_data = $result->hotels[0];
					$hotel_name = $hotel_data->name->content;
					$hb_data['id'] = '';
					$hb_data['title'] = $hotel_data->name->content;
					$hb_data['desc'] = '';
					$hb_data['location'] = $hotel_data->city->content;
					$hb_data['lowRate'] = '50';
					$address = $hotel_data->address->content." ".$hotel_data->postalCode." ".$hotel_data->city->content;
					$hb_data['hotelAddress'] = $address;
					$hb_data['latitude'] = $hotel_data->coordinates->latitude;
					$hb_data['longitude'] = $hotel_data->coordinates->longitude;
					$hb_data['policy'] = '';
					$hb_data['stars'] = '';
					$hb_data['amenities'] = array();

					$img_main_url = 'http://photos.hotelbeds.com/giata/bigger/';
					$thumb_img_url = 'http://photos.hotelbeds.com/giata/';

					for ($i=0; $i < count($hotel_data->images) ; $i++) { 

						$img_path = $hotel_data->images[$i]->path;
						$fullImage = $img_main_url.$img_path;
						$thumbImage = $thumb_img_url.$img_path;

						$image_data[$i]['fullImage'] = $fullImage;
						$image_data[$i]['thumbImage'] = $thumbImage;
					}

					for ($i=0; $i < count($hotel_data->interestPoints) ; $i++) { 

						$poiName = $hotel_data->interestPoints[$i]->poiName;
						$distance = $hotel_data->interestPoints[$i]->distance;
						
						$interestPoints[$i]['poiName'] = $poiName;
						$interestPoints[$i]['distance'] = $distance;
					}

					$hb_data['sliderImages'] = $image_data;

					
				}else{
					$hb_data = array();
				}
				$hb_data['desc'] = $description;
				$hb_data['amenities'] = $ne_facilities;
				/*echo json_encode($hb_data);
				exit();*/
				$result = (object)$hb_data;
				$this->data['module'] = $result;
				
				$this->data['lowestPrice'] = $this->data['module']->lowRate;
				
				$this->data['currencySign'] = '$';

				$checkinDate = $this->input->get('checkin');
				
				$checkoutDate = $this->input->get('checkOut');
				
				$now = new DateTime();
				if(empty($checkinDate)){
					$checkinDate = date("m/d/Y", strtotime("+1 days"));
				}
				$checkin = new DateTime($checkinDate);

				if($checkin < $now){
					 $checkinDate = date("m/d/Y", strtotime("+1 days"));
				}

				if(empty($checkoutDate)){
					$checkoutDate = date("m/d/Y", strtotime("+3 days"));
				}

				$checkOut = new DateTime($checkoutDate);
				if($checkOut < $now){
					$checkoutDate = date("m/d/Y", strtotime("+3 days"));
				}

				$arrayInfo['checkIn'] = $checkinDate;
				$arrayInfo['checkOut'] = $checkoutDate;
				$date1 = new DateTime($checkinDate);
             	$date2 = new DateTime($checkoutDate);

              	$diff = $date2->diff($date1)->format("%a");
              	$this->data['diff'] = $diff;
				$childAges = $this->input->get('ages');
				$this->data['childAges'] = $childAges;
				if(!empty($childAges)){
					$ages = ",".$childAges;
				}else{
					$ages = "";
				}

				$adultsCount = $this->input->get('adults');
				if(empty($adultsCount)){
					$adultsCount = 2;
				}

				$this->data['adultsCount'] = $adultsCount;

				if(!empty($childAges)){
				$this->data['childCount'] = count(explode(",",$childAges));

				}
				/*echo json_encode($this->input->get());
				exit();*/
				$adults = $this->input->get('adults').$ages;
				$arrayInfo['adults'] = $this->input->get('adults');
				$arrayInfo['childAges'] = $this->input->get('ages');
				$arrayInfo['room'] = $this->input->get('room');
				$arrayInfo['hotelId'] = $hotelId;


				$this->data['hotelid'] = $hotelId;
				//$this->data['sessionid'] = $customerSessionId;
				$this->data['HotelInfo'] = 'NO INFO AT THIS TIME';
				//$this->data['HotelSummary'] = $result['HotelInformationResponse']['HotelSummary'];
				//$this->data['HotelDetails'] = $result['HotelInformationResponse']['HotelDetails'];
				//$this->data['HotelImages'] = $result['HotelInformationResponse']['HotelImages'];
				
				$this->data['thumbnail'] = $this->data['module']->sliderImages[0]['thumbImage'];
				$this->session->set_userdata('hotelThumb', $this->data['thumbnailImage']);

				//$this->data['Facilities'] = $result['HotelInformationResponse']['RoomTypes']['RoomType']['0']['roomAmenities']['RoomAmenity'];
				//$this->data['relatedHotels'] = $this->ean_lib->getRelatedHotels($this->data['HotelSummary']['city']);
				/*$related = $this->ean_lib->getRelatedHotels($this->data['module']->location);
				if(!empty($related->hotels)){
					$this->data['module']->relatedItems = $related->hotels;
				}*/
				$arrayInfo['hotel_name'] = $hotel_name;
				$arrayInfo['latitude'] = $hb_data['latitude'];
				$arrayInfo['longitude'] = $hb_data['longitude'];
				$roomresponse = $this->hb_lib->get_hotel_by_code($arrayInfo);
				/*echo $roomresponse;*/
				/*exit();*/

				/*$roomsInfo = $roomresponse['HotelRoomAvailabilityResponse'];
				$roomsData = $this->getRoomsObject($roomsInfo);*/
				$roomresponse = json_decode($roomresponse);
				$roomresponse->hotels;
				
				$this->data['hb_room'] = $roomresponse->hotels->hotels[0]->rooms;
				$this->data['hasRooms'] = 5;
				$this->data['is_hotel_bed'] = "1";
				$this->data['checkInInstructions'] = $roomsData->checkInInstructions;
				$this->data['specialCheckInInstructions'] = $roomsData->specialCheckInInstructions;

				$this->data['loggedin'] = $this->loggedin;

				/*$this->data['rooms'] = $roomsInfo['HotelRoomResponse'];

				$this->data['maxAdults'] = $roomsInfo['HotelRoomResponse'][0]['rateOccupancyPerRoom'];*/
				$this->data['checkin'] = $checkinDate; //$roomsInfo['arrivalDate'];
				$this->data['checkout'] = $checkoutDate; //$roomsInfo['departureDate'];

				$this->data['maxAdults'] = $adults;
				$this->data['childAges'] = $arrayInfo['childAges'];
				$this->data['interestPoints'] = $interestPoints;
				/*echo json_encode($roomresponse);
				exit();*/
				$this->data['reviews'] = $roomresponse->reviews;
				$this->data['tripadvisor'] = $roomresponse->tripadvisor;
				$this->data['apistr'] = $this->ean_lib->apistr;
				$this->lang->load("front", $currLang);
				$this->data['page_title'] = $this->data['module']->title;

				$this->data['langurl'] = $this->data['baseUrl']."hotel/{langid}/".$hotelId."/".$customerSessionId.'?'.$surl;
				/*echo $this->data['langurl'];
				exit();*/
				/*echo json_encode($this->data['module']);
				exit();*/
				
				$this->session->set_userdata('check_rate',1);
				$this->theme->view('details', $this->data);
		}

		public function reservation(){


				$isguest = $this->input->get('user');
				$this->data['affiliateConfirmationId'] = $this->setAffliateConfirmation();



				$user = $this->data['user'];

				if($isguest == "guest"){

				}elseif($isguest == "register"){
					unset($_GET['user']);

					$url = http_build_query($_GET);

					redirect('register?' . $url);

				}else{

				if(empty($this->loggedin)){
					unset($_GET['user']);

					$url = http_build_query($_GET);
						redirect('login?' . $url);
				}

				}

				$this->load->model('admin/countries_model');
				$this->data['allcountries'] = $this->countries_model->get_all_countries();
				$pay = $this->input->post('pay');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
				$this->form_validation->set_rules('firstName', 'First Name', 'trim');
				$this->form_validation->set_rules('lastName', 'Last name', 'trim');
				$this->form_validation->set_rules('policy', 'Cancellation Policy', 'required');
				$this->form_validation->set_rules('address', 'Address', 'trim');
				$this->form_validation->set_rules('cvv', 'CVV', 'trim');
				$this->form_validation->set_rules('cardno', 'Card Number', 'trim');
				$this->form_validation->set_rules('province', 'State', 'trim');
				$this->form_validation->set_rules('postalcode', 'Postal Code', 'trim');
				$this->form_validation->set_rules('phone', 'Phone', 'trim');

				if (!empty ($pay)) {

						//echo "Asdas";
						$this->form_validation->run();
						$this->data['result'] = $this->ean_lib->HotelRoomReservation();
						/*print_r($this->data['result']);
						exit();*/
						/* For Room Reservation Request and Response */

						/*echo "<pre>";
						echo "https://book.api.ean.com/ean-services/rs/hotel/v3/res? <br>";
						print_r($this->data['result']);
						echo "</pre>";
						exit;*/

						$error = $this->data['result']->HotelRoomReservationResponse->EanWsError;
						$bookresponse = $this->data['result']->HotelRoomReservationResponse;

						$bookresponse->affiliateConfirmationId = $this->input->post('affiliateConfirmationId');
						if (!empty ($error)) {
								$itid = $this->data['result']->HotelRoomReservationResponse->EanWsError->itineraryId;
								$confirmation = "";
								$this->data['msg'] = $error->presentationMessage;
								//$this->data['msg'] = print_r($this->data['result']->HotelRoomReservationResponse);
								$this->data['result'] = "fail";
						} else {
								$itid = $this->data['result']->HotelRoomReservationResponse->itineraryId;



								$confirmation = $this->data['result']->HotelRoomReservationResponse->confirmationNumbers;
								$this->data['itineraryID'] = $itid;
								$this->data['confirmationNumber'] = $confirmation;
								$this->data['checkInInstructions'] = $this->data['result']->HotelRoomReservationResponse->checkInInstructions;
								$this->data['nonRefundable'] = $this->data['result']->HotelRoomReservationResponse->nonRefundable;
								$this->data['cancellationPolicy'] = $this->data['result']->HotelRoomReservationResponse->cancellationPolicy;
                                $totalCharge = $this->data['result']->HotelRoomReservationResponse->RateInfo->ConvertedRateInfo;
                                if(empty($totalCharge)){
                                $totalCharge = $this->data['result']->HotelRoomReservationResponse->RateInfo->ChargeableRateInfo;
								}

                                $total = (array)$totalCharge;
								$this->data['grandTotal'] = $total['@total'];
								$this->data['currency'] = $this->ean_lib->currency;
								$this->data['surchargeTotal'] = $total['@surchargeTotal'];
								$this->data['nightlyRateTotal'] = $total['@nightlyRateTotal'];



								$this->data['msg'] = trans("0336");
								//$this->data['msg'] = $this->data['msg'] = print_r($this->data['result']->HotelRoomReservationResponse);
								if(!empty($confirmation)){
									$this->data['result'] = "success";

								}else{
									$this->data['result'] = "fail";
								}

						}
						if ($itid > 1 && !empty($confirmation)) {
								$totalamount = $this->input->post('total');
								if($isguest == "guest"){

									$user = $this->ean_model->eanSignup_account($this->input->post());
								}

								$insertdata = array('user' => $user, 'checkin' => $this->input->post('checkin'), 'checkout' => $this->input->post('checkout'), 'hotel' => $this->input->post('hotel'), 'thumbnail' => $this->input->post('thumbnail'), 'location' => $this->input->post('location'),'stars' => $this->input->post('hotelstars'),'hotelname' => $this->input->post('hotelname'), 'roomname' => $this->input->post('roomname'), 'roomtotal' => $this->input->post('roomtotal'), 'tax' => $this->input->post('tax'), 'total' => $totalamount, 'email' => $this->input->post('email'), 'itineraryid' => $itid, 'confirmation' => $confirmation, 'nights' => $this->input->post('nights'),'currency' => $this->input->post('currency'),'bookResponse' => json_encode($bookresponse));
								$this->ean_model->insert_booking($insertdata);

								$this->db->where('book_itineraryid',$itid);
							    $res = $this->db->get('pt_ean_booking')->result();
							    $rrr = json_decode($res[0]->book_response);
								$arrKeys = array();
								$arrVals = array();
                                $surrInfo = $rrr->RateInfo->ConvertedRateInfo;
                                if(empty($surrInfo)){
                                $surrInfo = $rrr->RateInfo->ChargeableRateInfo;
                                }


								$surchargesArray = (array)$surrInfo->Surcharges->Surcharge;
								foreach($surchargesArray as $s => $k){
								if($s == "@type"){
								$arrKeys[] = $k;
								}elseif($s == "@amount"){
								$arrVals[] = $k;
								}

								}

								$surchargeTypes = array_combine($arrKeys,$arrVals);



								$this->data['SalesTax'] = $surchargeTypes['SalesTax'];
								$this->data['HotelOccupancyTax'] = $surchargeTypes['HotelOccupancyTax'];
								$this->data['TaxAndServiceFee'] = $surchargeTypes['TaxAndServiceFee'];




						}
				}
				$this->data['checkin'] = $this->input->get('checkin');
				$this->data['checkout'] = $this->input->get('checkout');
				$arrayInfo['hotelId'] = $this->input->get('hotel');
				$arrayInfo['customerSessionId'] = $this->input->get('sessionid');
				$arrayInfo['checkIn'] = trim($this->input->get('checkin'));
				$arrayInfo['checkOut'] = trim($this->input->get('checkout'));
				$arrayInfo['roomTypeCode'] = $this->input->get('roomtype');

				$arrayInfo['rateKey'] = $this->input->get('ratekey');
				$arrayInfo['rateCode'] = $this->input->get('ratecode');
				$result = $this->ean_lib->HotelDetails($arrayInfo);
				$roomresponse = $this->ean_lib->HotelRoomAvailability($arrayInfo);
				$paymenttypes = $this->ean_lib->paymentinfo($arrayInfo);


				/* For Payment Types Request and Response */

                /*echo "<pre>";
                echo $this->ean_lib->apistr."<br>";
                print_r($paymenttypes);
                echo "</pre>";
                exit;*/
				$this->data['payment'] = $paymenttypes['HotelPaymentResponse']['PaymentType'];
				$this->data['room'] = $roomresponse['HotelRoomAvailabilityResponse'];
				$this->data['roomsCount'] = count($this->data['room']['HotelRoomResponse']['RateInfos']['RateInfo']['RoomGroup']);

				$this->data['cancelpolicy'] = $roomresponse['HotelRoomAvailabilityResponse']['HotelRoomResponse']['RateInfos']['RateInfo']['cancellationPolicy'];
				$this->data['roomname'] = $this->data['room']['HotelRoomResponse']['rateDescription'];
				$this->data['nights'] = $this->data['room']['HotelRoomResponse']['RateInfos']['RateInfo']['ChargeableRateInfo']['NightlyRatesPerRoom']['@size'];
                $rateInfo = $this->data['room']['HotelRoomResponse']['RateInfos']['RateInfo']['ConvertedRateInfo'];
                if(empty($rateInfo)){
                $rateInfo = $this->data['room']['HotelRoomResponse']['RateInfos']['RateInfo']['ChargeableRateInfo'];
                }

                $this->data['total'] = round($rateInfo['@total'], 2);
				$surchargesArray = $rateInfo['Surcharges']['Surcharge'];
				$this->data['tax'] = round($rateInfo['@surchargeTotal'], 2);



				$arrKeys = array();
				$arrVals = array();

				foreach($surchargesArray as $s => $k){
				if($s == "@type"){
				$arrKeys[] = $k;
				}elseif($s == "@amount"){
				$arrVals[] = $k;
				}

				}

				$surchargeTypes = array_combine($arrKeys,$arrVals);

				$this->data['SalesTax'] = $surchargeTypes['SalesTax'];
				$this->data['HotelOccupancyTax'] = $surchargeTypes['HotelOccupancyTax'];
				$this->data['ExtraPersonFee'] = $surchargeTypes['ExtraPersonFee'];

				$this->data['currency'] = $rateInfo['@currencyCode'];
				$this->data['roomtotal'] = round($rateInfo['@nightlyRateTotal'], 2);
				$this->data['HotelSummary'] = $result['HotelInformationResponse']['HotelSummary'];
				$this->data['HotelImages'] = $result['HotelInformationResponse']['HotelImages'];
				$this->data['checkInInstructions'] =  $this->data['room']['checkInInstructions'];
				$stars = $this->data['HotelSummary']['hotelRating'];
				if($stars < 1){
					$stars = 1;
				}
				$this->data['hotelStars'] = $stars;
				$this->data['module'] = (object)array('title' =>  $this->data['HotelSummary']['name'],'location' => $this->data['HotelSummary']['city'],
											'stars' => pt_create_stars($stars),'thumbnail' => $this->data['HotelImages']['HotelImage'][0]['url']);
				

				/*echo "<pre>";
				print_r($this->data['room']);
				echo "</pre>";*/


				if (!empty ($submit)) {
						$this->data['paid'] = "Payment made";
				}

				$this->load->model('admin/accounts_model');
				$loggedin = $this->loggedin;
                $this->data['profile'] = $this->accounts_model->get_profile_details($loggedin);
                $this->lang->load("front", $this->data['lang_set']);
				$this->data['page_title'] = $this->data['HotelSummary']['name'];
				//$this->theme->view('integrations/ean/booking', $this->data);
				$this->theme->view('booking', $this->data);
		}

		public function RandomString()
		{
		    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		    $randstring = '';
		    for ($i = 0; $i < 10; $i++) {
		        $randstring .= $characters[rand(0, strlen($characters) - 1)];
		    }
		    return $randstring;
		}
		public function hbreservation(){
				/*print_r($this->input->post());
				exit();*/
				$isguest = $this->input->get('user');
				$this->data['affiliateConfirmationId'] = $this->setAffliateConfirmation();


				$user = $this->data['user'];

				if($isguest == "guest"){

				}elseif($isguest == "register"){
					unset($_GET['user']);

					$url = http_build_query($_GET);

					redirect('register?' . $url);

				}else{

					if(empty($this->loggedin)){
						unset($_GET['user']);

						$url = http_build_query($_GET);
							redirect('login?' . $url);
					}

				}

				
				$this->load->model('admin/countries_model');
				$this->data['allcountries'] = $this->countries_model->get_all_countries();
				$pay = $this->input->post('pay');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
				$this->form_validation->set_rules('firstName', 'First Name', 'trim');
				$this->form_validation->set_rules('lastName', 'Last name', 'trim');
				$this->form_validation->set_rules('policy', 'Cancellation Policy', 'required');
				$this->form_validation->set_rules('address', 'Address', 'trim');
				$this->form_validation->set_rules('cvv', 'CVV', 'trim');
				$this->form_validation->set_rules('cardno', 'Card Number', 'trim');
				$this->form_validation->set_rules('province', 'State', 'trim');
				$this->form_validation->set_rules('postalcode', 'Postal Code', 'trim');
				$this->form_validation->set_rules('phone', 'Phone', 'trim');

				if (!empty ($pay)) {
						/*error_reporting(E_ALL);*/

						$input_dat = $this->input->post();
								/*echo json_encode($input_dat);*/
								/*echo $guest_data = json_encode($input_dat['guest_data']);
								echo $additionalnotes = json_encode($input_dat['additionalnotes']);*/
								$extra_data['guest_data'] = $input_dat['guest_data'];
								$extra_data['additionalnotes'] = $input_dat['additionalnotes'];
								/*echo json_encode($extra_data);
								echo "<br>";
								error_reporting(E_ALL);*/
								
			                    // $this->db->insert('pt_ean_booking',$pt_book_extra);
								/*exit();*/

								/*if ($input_dat['payment_type'] == 'paypal') {
									
									$invoiceid = $this->RandomString();

									$insertdata = array(
														'invoice_id' => $invoiceid,
														'json_data' => json_encode($input_dat),
														'booking_data' => '',//json_encode($booking_data),
														'pt_ean_booking_id' => $itid,
														);
									
									$this->hb_model->insert_booking($insertdata);
									
									$input_dat['invoice_id'] = $invoiceid;
									$this->load->model('admin/payments_model');
									$gateway = 'paypalexpress';
									$P_data =  $this->payments_model->getGatewayMsg_paypal($gateway,$input_dat);
									$P_data = json_decode($P_data);
									redirect($P_data->htmldata);
									
								}*/
								/*echo "Asdas";
								exit();*/
						/*echo json_encode($input_dat);
						exit();*/
						/*$this->form_validation->run();*/
						$booking_data = $this->hb_lib->HotelRoomReservation($input_dat);
						/*echo $booking_data;
						echo "<br>";*/
						$booking_data = json_decode($booking_data);
						
						$this->data['result'] = $booking_data;
						/*exit();*/
						/*$this->data['result'] = "success";
						$confirmation = array();*/
						
						//echo "Asdas";

						$error = $this->data['result']->error;
						$bookresponse = $this->data['result']->booking;

						if (!empty ($error)) {
								
								$this->data['msg'] = $error->message;
								$this->data['result'] = "fail";
						} else {
								$itid = $this->data['result']->booking->reference;

								$confirmation = $this->data['result']->booking->reference;
								$this->data['itineraryID'] = $itid;
								$this->data['confirmationNumber'] = $confirmation;
								$this->data['nonRefundable'] = '';
								//$this->data['checkInInstructions'] = $this->data['result']->booking->hotel->rooms[0]->rates->[0]->rateComments;
								$this->data['checkInInstructions'] = $this->data['result']->booking->hotel->rooms;
								//$this->data['cancellationPolicy'] = $this->data['result']->booking->hotel->rooms[0]->rates->[0]->cancellationPolicies;
			                    $totalCharge = $this->data['result']->booking->totalNet;
			                    if(empty($totalCharge)){
			                    	$totalCharge = $this->data['result']->booking->totalSellingRate;
								}

			                    $total = $totalCharge;
								$this->data['grandTotal'] = $total;
								$this->data['currency'] = $this->booking->currency;
								$this->data['surchargeTotal'] = '';
								$this->data['nightlyRateTotal'] = '';

								$this->data['msg'] = trans("0336");
								//$this->data['msg'] = $this->data['msg'] = print_r($this->data['result']->HotelRoomReservationResponse);
								if(!empty($confirmation)){
									$this->data['result'] = "success";
								}else{
									$this->data['result'] = "fail";
								}

						}
						if ($itid > 1 && !empty($confirmation)) {
								//if (empty($confirmation)) {
								$totalamount = $this->input->post('total');
								if($isguest == "guest"){

									$user = $this->ean_model->eanSignup_account($this->input->post());
								}

								$a_hot_loc['longitude'] = $input_dat['longitude'];
								$a_hot_loc['latitude'] = $input_dat['latitude'];
								$bookresponse = (object)array_merge((array)$booking_data , $a_hot_loc);
								/*print_r($bookresponse);
								exit();*/

								$insertdata = array('user' => $user, 
													'checkin' => $this->input->post('checkin'),
													'checkout' => $this->input->post('checkout'),
													'hotel' => $this->input->post('hotel'),
													'thumbnail' => $this->input->post('thumbnail'),
													'location' => $this->input->post('location'),
													'stars' => $this->input->post('hotelstars'),
													'hotelname' => $this->input->post('hotelname'),
													'roomname' => $this->input->post('roomname'),
													'roomtotal' => $this->input->post('roomtotal'),
													'tax' => $this->input->post('tax'),
													'total' => $totalamount,
													'email' => $this->input->post('email'),
													'itineraryid' => $itid,
													'confirmation' => $confirmation,
													'nights' => $this->input->post('nights'),
													'currency' => $this->input->post('currency'),
													'bookResponse' => json_encode($bookresponse));

								$this->ean_model->insert_booking($insertdata);

								$this->db->where('book_itineraryid',$itid);
							    $res = $this->db->get('pt_ean_booking')->result();
							    $rrr = json_decode($res);
							    /*echo $rrr->book_id;*/
							    $inv_id = $res[0]->book_id;
							    /*print_r($res[0]->book_id);
							    exit();*/
								$arrKeys = array();
								$arrVals = array();
			                    $surrInfo = $rrr->totalNet;

			                    $insertdata_extra = array(
												'booking_id' => $inv_id,
												'hotel_type' => "1",
												'extra_data' => json_encode($extra_data),
												);

			                    $this->ean_model->insert_booking_extra($insertdata_extra);

			                    if(empty($surrInfo)){
			                    	$surrInfo = $rrr->totalSellingRate;
			                    }

								$this->data['SalesTax'] = '';
								$this->data['HotelOccupancyTax'] = '';
								$this->data['TaxAndServiceFee'] = '10';
								/*$this->data['extra_data'] = $extra_data;*/

								if ($input_dat['payment_type'] == 'paypal') {
									/*error_reporting(E_ALL);*/
									/*echo json_encode($input_dat);
									exit();*/
									/*echo "<br>";*/
									$invoiceid = $this->RandomString();

									$insertdata = array(
														'invoice_id' => $invoiceid,
														'json_data' => json_encode($input_dat),
														'booking_data' => json_encode($booking_data),
														'pt_ean_booking_id' => $itid,
														);
									/*echo json_encode($insertdata);
									echo "<br>";*/
									$this->hb_model->insert_booking($insertdata);
									//exit();
									$input_dat['invoice_id'] = $invoiceid;
									$this->load->model('admin/payments_model');
									$gateway = 'paypalexpress';
									$P_data =  $this->payments_model->getGatewayMsg_paypal($gateway,$input_dat);
									$P_data = json_decode($P_data);
									//echo $P_data->htmldata;
									redirect($P_data->htmldata);
									//echo "<br>";
								}else{
									/*print_r($this->data['checkInInstructions']);*/
									/*exit();*/
									redirect(base_url().'invoice?eid='.$inv_id.'&sessid='.$itid);
									//$this->theme->view('invoice?eid='.$inv_id.'&sessid='.$itid, $this->data);
								}
								/*exit();*/
						}
						
				}
				$this->data['checkin'] = $this->input->get('checkin');
				$this->data['checkout'] = $this->input->get('checkout');
				$arrayInfo['hotelId'] = $this->input->get('hotel');
				$arrayInfo['customerSessionId'] = $this->input->get('sessionid');
				$arrayInfo['checkIn'] = trim($this->input->get('checkin'));
				$arrayInfo['checkOut'] = trim($this->input->get('checkout'));
				$arrayInfo['roomTypeCode'] = $this->input->get('roomtype');

				$arrayInfo['rateKey'] = $this->input->get('ratekey');
				$arrayInfo['roomImg'] = $this->input->get('roomImg');
				$arrayInfo['room'] = $this->input->get('room');
				$arrayInfo1['latitude'] = $this->input->get('latitude');
				$arrayInfo1['longitude'] = $this->input->get('longitude');
				/*error_reporting(E_ALL);*/
				$check_rate =  $this->session->userdata('check_rate');
				
				if(isset($check_rate) && $check_rate == 1){
					$result = $this->hb_lib->checkrates($arrayInfo);

					$this->session->set_userdata('check_rate',0);
					$this->session->set_userdata('rate_data',$result);
				}else{
					$result = $this->session->userdata('rate_data');
				}
				/*echo $result;
				exit;*/
				$result = json_decode($result);
				$checkIn = $arrayInfo['checkIn'];
				$checkOut = $arrayInfo['checkOut'];
				
				$hotelname = $result->hotel->name;
				$destinationName = $result->hotel->destinationName;
				$latitude = $result->hotel->latitude;
				$longitude = $result->hotel->longitude;

				
				$room_name = $result->hotel->rooms[0]->name;
				$rateComments = $result->hotel->rooms[0]->rates[0]->rateComments;

				$cancellationPolicies = $result->hotel->rooms[0]->rates[0]->cancellationPolicies;
				$rooms = $result->hotel->rooms[0]->rates[0]->rooms;
				$adults = $result->hotel->rooms[0]->rates[0]->adults;
				$children = $result->hotel->rooms[0]->rates[0]->children;
				$totalNet = $result->hotel->totalNet;
				$currency = $result->hotel->currency;

				
				$roomresponse = array();
				$paymenttypes = array();
				
				$this->data['payment'] = $paymenttypes['HotelPaymentResponse']['PaymentType'];
				$this->data['room'] = $arrayInfo['room'];
				$this->data['roomsCount'] = $arrayInfo['room'];

				$this->data['cancelpolicy'] = $cancellationPolicies;
				$this->data['roomname'] = $room_name;
				$this->data['longitude'] = $longitude;
				$this->data['latitude'] = $latitude;
				$date1 = new DateTime($checkIn);
	            $date2 = new DateTime($checkOut);

	            $diff = $date2->diff($date1)->format("%a");

				$this->data['nights'] = $diff;
                

                $this->data['total'] = round($totalNet * $arrayInfo['room'] , 2);
				$this->data['tax'] = round(10, 2);

				$this->data['currency'] = $currency;
				$this->data['roomtotal'] = round($totalNet / $diff, 2);
				/*$this->data['HotelSummary'] = $result['HotelInformationResponse']['HotelSummary'];
				$this->data['HotelImages'] = $result['HotelInformationResponse']['HotelImages'];*/
				$this->data['checkInInstructions'] =  $rateComments;
				$stars = 0;
				if($stars < 1){
					$stars = 0;
				}
				$this->data['hotelStars'] = $stars;
				$this->data['module'] = (object)array('title' =>  $hotelname,
													'location' => $destinationName,
													'stars' => pt_create_stars($stars),
													'thumbnail' => $arrayInfo['roomImg']);

				if (!empty ($submit)) {
						$this->data['paid'] = "Payment made";
				}
				$this->load->model('admin/payments_model');
				$paygateways = $this->payments_model->getAllPaymentsBack();
				$this->data['paymentGateways'] = $paygateways['activeGateways'];
				$this->load->model('admin/accounts_model');
				$loggedin = $this->loggedin;
                $this->data['profile'] = $this->accounts_model->get_profile_details($loggedin);
                $this->lang->load("front", $this->data['lang_set']);
				$this->data['page_title'] = $this->data['HotelSummary']['name'];
				//$this->theme->view('integrations/ean/booking', $this->data);
				$this->theme->view('hbbooking', $this->data);
		}

		function hb_p_success(){
			$input_dat = $this->input->get();
			 
			$invoiceid = $input_dat['invoiceid'];

			$this->db->where('invoice_id',$invoiceid);
		    $res = $this->db->get('pt_payment_data')->result();
		    
		    $booking_data = $res[0]->booking_data;
		    /*$input_dat = json_decode($input_dat);

			$booking_data = $this->hb_lib->HotelRoomReservation($input_dat);*/
			/*echo $booking_data;*/
			$booking_data = json_decode($booking_data);
			$this->data['result'] = $booking_data;
			/*exit();*/
			/*$this->data['result'] = "success";
			$confirmation = array();*/
			
			//echo "Asdas";

			$error = $this->data['result']->error;
			$bookresponse = $this->data['result']->booking;

			if (!empty ($error)) {
					
					$this->data['msg'] = $error->message;
					$this->data['result'] = "fail";
			} else {
					$itid = $this->data['result']->booking->reference;

					$confirmation = $this->data['result']->booking->reference;
					$this->data['itineraryID'] = $itid;
					$this->data['confirmationNumber'] = $confirmation;
					$this->data['nonRefundable'] = '';
					$this->data['checkInInstructions'] = $this->data['result']->booking->hotel->rooms[0]->rates[0]->rateComments;
					//$this->data['checkInInstructions'] = $this->data['result']->booking->hotel->rooms;
					//echo json_encode($this->data['checkInInstructions']);
					$this->data['cancellationPolicy'] = $this->data['result']->booking->hotel->rooms[0]->rates[0]->cancellationPolicies;
                    $totalCharge = $this->data['result']->booking->totalNet;
                    if(empty($totalCharge)){
                    	$totalCharge = $this->data['result']->booking->totalSellingRate;
					}

                    $total = $totalCharge;
					$this->data['grandTotal'] = $total;
					$this->data['currency'] = $this->booking->currency;
					$this->data['surchargeTotal'] = '';
					$this->data['nightlyRateTotal'] = '';

					$this->data['msg'] = trans("0336");
					//$this->data['msg'] = $this->data['msg'] = print_r($this->data['result']->HotelRoomReservationResponse);
					if(!empty($confirmation)){
						$this->data['result'] = "success";
					}else{
						$this->data['result'] = "fail";
					}

			}
			//if ($itid > 1 && !empty($confirmation)) {
					
					$this->data['TaxAndServiceFee'] = '10';

			//}
					 $this->lang->load("front", $this->data['lang_set']);
			$this->theme->view('hbbooking', $this->data);
		}

		function hb_p_failed(){
			$input_dat = $this->input->get();
			 
			$invoiceid = $input_dat['invoiceid'];

			$this->db->where('invoice_id',$invoiceid);
		    $res = $this->db->get('pt_payment_data')->result();
		    //print_r($res);
		    $booking_data = $res[0]->booking_data;
		   /* echo $booking_data;
		    exit();*/
		    /*$input_dat = json_decode($input_dat);

			$booking_data = $this->hb_lib->HotelRoomReservation($input_dat);*/
			/*echo $booking_data;*/
			$booking_data = json_decode($booking_data);
			$this->data['result'] = $booking_data;
			/*exit();*/
			/*$this->data['result'] = "success";
			$confirmation = array();*/
			
			//echo "Asdas";

			$error = 'Your paymet not done';
			$bookresponse = $this->data['result']->booking;

			if (!empty ($error)) {
					
					$this->data['msg'] = 'Your paymet not done';
					$this->data['result'] = "fail";
			} else {
					$itid = $this->data['result']->booking->reference;

					$confirmation = $this->data['result']->booking->reference;
					$this->data['itineraryID'] = $itid;
					$this->data['confirmationNumber'] = $confirmation;
					$this->data['nonRefundable'] = '';
					$this->data['checkInInstructions'] = $this->data['result']->booking->hotel->rooms[0]->rates[0]->rateComments;
					//$this->data['checkInInstructions'] = $this->data['result']->booking->hotel->rooms;
					//echo json_encode($this->data['checkInInstructions']);
					$this->data['cancellationPolicy'] = $this->data['result']->booking->hotel->rooms[0]->rates[0]->cancellationPolicies;
                    $totalCharge = $this->data['result']->booking->totalNet;
                    if(empty($totalCharge)){
                    	$totalCharge = $this->data['result']->booking->totalSellingRate;
					}

                    $total = $totalCharge;
					$this->data['grandTotal'] = $total;
					$this->data['currency'] = $this->booking->currency;
					$this->data['surchargeTotal'] = '';
					$this->data['nightlyRateTotal'] = '';

					$this->data['msg'] = trans("0336");
					//$this->data['msg'] = $this->data['msg'] = print_r($this->data['result']->HotelRoomReservationResponse);
					if(!empty($confirmation)){
						$this->data['result'] = "success";
					}else{
						$this->data['result'] = "fail";
					}

			}
			//if ($itid > 1 && !empty($confirmation)) {
					
					$this->data['TaxAndServiceFee'] = '10';

			//}
					 $this->lang->load("front", $this->data['lang_set']);
			$this->theme->view('hbbooking', $this->data);
		}

		function cancel() {
				$id = $this->input->post('id');
				$data = $this->ean_model->get_single_booking($id);
				$bookid = $data[0]->book_id;
				$itenid = $data[0]->book_itineraryid;
				$conf = $data[0]->book_confirmation;
				$email = $data[0]->book_email;
				$currency = $data[0]->book_currency;
				$arrayinfo = array("confirmationnumber" => $conf, "itineraryid" => $itenid, "email" => $email,"currency" => $currency);
				$retdata = $this->ean_lib->HotelRoomCancellation($arrayinfo);

				if (!empty ($retdata['HotelRoomCancellationResponse']['EanWsError'])) {

						echo $retdata['HotelRoomCancellationResponse']['EanWsError']['presentationMessage'];
				}
				else {
					    $cancelnumber = $retdata['HotelRoomCancellationResponse']['cancellationNumber'];
						$this->ean_model->cancel_my_booking($id, $cancelnumber);
						echo "success";
				}

		}

		function maps($lat , $long, $title) {
				if (empty ($lat) || empty ($long)) {
						Error_404();
				}
				else {
					$link = "#";
					$img = $this->session->userdata('hotelThumb');

						pt_show_map($lat, $long, '100%', '100%', $title, $img, 80, 80, $link);
				}
		}

		public function setAffliateConfirmation(){
			$this->db->select('book_id');
			$this->db->order_by('book_id','desc');
			$res = $this->db->get('pt_ean_booking')->result();
			if(!empty($res)){
				$bookid = $res[0]->book_id + 1;
			}else{
				$bookid = 1;
			}

			$rand = rand(1,999);

			return "-".$rand."-".$bookid;

		}

		public function getResultInObjects($result,$checkin = null, $checkout = null,$adults = null,$agesApendUrl = null){
			$response = new stdClass;
			$response->multipleLocations =  $result['HotelListResponse']['LocationInfos']['@size'];
			$response->locations = $result['HotelListResponse']['LocationInfos']['LocationInfo'];
			$response->totalCounts = $result['HotelListResponse']['HotelList']['@size'];
			$response->moreResultsAvailable = $result['HotelListResponse']['moreResultsAvailable'];
			$response->cacheKey = $result['HotelListResponse']['cacheKey'];
			$response->cacheLocation = $result['HotelListResponse']['cacheLocation'];

			if(!empty($response->locations)){
			$getvars = $_GET;
			foreach($response->locations as $loc){
			$getvars['city'] = $loc['city'];
			$getvars['destinationId'] = $loc['destinationId'];

			$link = $this->data['baseUrl'].'search?'.http_build_query($getvars);
			$href = "<a href=$link>".$loc['city']." - ".$loc['countryName']."</a>";

			$response->locationInfo[] = (object)array('city' => $loc['city'],'destinationId' => $loc['destinationId'],'link' => $href);

			}
			}

			if(empty($result['HotelListResponse']['EanWsError'])){
			foreach($result['HotelListResponse']['HotelList']['HotelSummary'] as $rs){
				$thumbnail = str_replace("_t","_b",$rs['thumbNailUrl']);
				$shortDesc = html_entity_decode($rs['shortDescription']);
				$tripAdvisorRating = $rs['tripAdvisorRatingUrl'];
				$stars =  $rs['hotelRating'];
				if($stars < 1){
					$stars = 1;
				}
				
				$slug = $this->data['baseUrl'].'hotel/'.$rs['hotelId'].'/'.$result['HotelListResponse']['customerSessionId'].'?adults='.$adults.'&checkin='.$checkin.'&checkout='.$checkout.$agesApendUrl;
				$response->hotels[] = (object)array('id' => $rs['hotelId'], 'title' => $rs['name'],'thumbnail' => "https://images.travelnow.com".$thumbnail,
					'slug' => $slug,'currCode' => $rs['rateCurrencyCode'],'price' =>$rs['lowRate'],'location' => $rs['city'],'longitude' => $rs['longitude'],
					'latitude' => $rs['latitude'],'desc' => strip_tags($shortDesc), 'stars' => pt_create_stars($stars),'tripAdvisorRatingImg' => $tripAdvisorRating,'tripAdvisorRating' => $stars
					);
			}

			
			}

			return $response;
		}

		public function getHotelDetailsObject($hotelid, $result){
			$response = new stdClass;
			$resultData = $result['HotelInformationResponse'];
			$hotelSummary = $resultData['HotelSummary'];
			$hotelDetails = $resultData['HotelDetails'];
			$amenities = $resultData['RoomTypes']['RoomType']['0']['roomAmenities']['RoomAmenity'];
			$images = $resultData['HotelImages']['HotelImage'];

			if($hotelSummary['hotelRating'] < 1){ $hrating = 1;	}else{ $hrating = $hotelSummary['hotelRating'];    }


			$response->id =  $hotelid;
			$response->title =  $hotelSummary['name'] ;
			$response->desc =  html_entity_decode(strip_tags($hotelDetails['propertyDescription']));
			$response->location =  $hotelSummary['city'] ;
			$response->lowRate =  $hotelSummary['lowRate'] ;
			$response->hotelAddress =  $hotelSummary['locationDescription'] ;
			$response->latitude =  $hotelSummary['latitude'] ;
			$response->longitude =  $hotelSummary['longitude'];
			$response->policy =  html_entity_decode($hotelDetails['hotelPolicy']);
			$response->stars =  pt_create_stars($hrating);
			if(!empty($amenities)){
				foreach($amenities as $amt){
					$response->amenities[] = (object)array('name' => character_limiter(ucwords($amt['amenity']),22));
				}
			}

			if(!empty($images)){
				foreach($images as $img){
					$response->sliderImages[] = array('fullImage' => str_replace("_b", "_z",$img['url']), 'thumbImage' => $img['thumbnailUrl']);
				}
			}
	

			return $response;
		}

		public function getRoomsObject($result){
			$response = new stdClass;

			$response->specialCheckInInstructions =  $result['specialCheckInInstructions'];
			$response->checkInInstructions =  $result['checkInInstructions'];
			$rooms =  $result['HotelRoomResponse'];

			if(!empty($rooms)){
				$response->hasRooms = TRUE;
			}else{
				$response->hasRooms = FALSE;
			}
	

			return $response;
		}


}