<?php
class Gb_emails_model extends CI_Model {
		private $sendfrom;
		private $adminemail;
		private $adminmobile;
		private $sitetitle;
		private $siteurl;
		private $mailHeader;
		private $mailFooter;
		private $data = array();
	    private $city;
	    public $cachekey;
	    public $numberofresults;
	    public $loggedin;
	    public $settings = array();
	    private $validlang;
   		protected $ci = NULL; //codeigniter instance
  	

		function __construct() {
			// Call the Model constructor
				parent :: __construct();

				$this->adminemail = $this->get_admin_email();
				$this->adminmobile = $this->get_admin_mobile();
				$siteInfo = $this->get_siteTitleUrl();
				$this->sitetitle = $siteInfo['title'];
				$this->siteurl = addHttp($siteInfo['url']);


				$headFootShortcode = array("{siteTitle}","{siteUrl}");
				$headFootVals = array($this->sitetitle,$this->siteurl);

				$mailsettings = $this->get_mailserver();
				$this->mailHeader = str_replace($headFootShortcode, $headFootVals, $mailsettings[0]->mail_header);
				$this->mailFooter = str_replace($headFootShortcode, $headFootVals, $mailsettings[0]->mail_footer);
				
				if ($mailsettings[0]->mail_default == "smtp") {
					
					if($mailsettings[0]->mail_secure == "no"){
						$secure = "";
					}else{
						$secure = $mailsettings[0]->mail_secure."://";
					}
						$this->sendfrom = $mailsettings[0]->mail_fromemail;
						$config = Array('protocol' => 'smtp', 'charset' => 'utf-8',
							'smtp_host' => $secure.$mailsettings[0]->mail_hostname, 
							'smtp_port' => $mailsettings[0]->mail_port, 
							'smtp_user' => $mailsettings[0]->mail_username, 'smtp_pass' => $mailsettings[0]->mail_password, 'mailtype' => 'html', 'charset' => 'iso-8859-1', 'wordwrap' => TRUE,'smtp_auth' => TRUE);
						
						$this->load->library('email', $config);
				}
				else {
						$this->sendfrom = $mailsettings[0]->mail_fromemail;
						$this->load->library('email');
						
						$this->email->set_mailtype("html");
				}

		}

		

		function sendtestemail($toemail) {
				$this->email->set_newline("\r\n");
				$message = $this->mailHeader;
				$message .= $this->sendfrom." --this is test email <br>";
				$message .= $this->mailFooter;
				$this->email->from($this->sendfrom);
				$this->email->to($toemail);
				$this->email->subject('tesing email server');
				$this->email->message($message);
				if (!$this->email->send()) {
						echo $this->email->print_debugger();
				}
				else {
						//echo $this->email->print_debugger();
						echo 'Email sent';
				}
		}

	
//send email to customer for booking payment success
		function gb_sendEmail_request_customer($details = "") {
				
           
            $this->load->model('hotels/hotels_model');
            
            $this->load->model("admin/groupbookings_model");
            $res_data = $details;
            /*echo "ASdas";
            echo "<br>";*/
            /*error_reporting(-1);*/
            /*print_r($res_data->hotel_data);
            exit();*/
            $check_in = $res_data->check_in;
            $check_out = $res_data->check_out;
            $lat = $res_data->location_lat;
            $long = $res_data->location_long;
            $hotel_data = json_decode($res_data->hotel_data);
           
            /*$hotel_ids = explode(',', $res_data->hotel_data->hotel_id);*/
            /*print_r($hotel_data->hotel_id);
            exit();*/
           /* print_r($hotel_data);
            exit();*/
            $hotel_id_data = array();
            for ($r_i=0; $r_i < count($hotel_data->sel_hotel_type) ; $r_i++) { 
               if($hotel_data->sel_hotel_type[$r_i] == 2){
                    $hotel_id_data[] = $hotel_data->hotel_id[$r_i];
               }
            }
            $hotel_ids = $hotel_id_data;
            //$hotel_ids = $hotel_data->hotel_id;
            /*print_r($hotel_ids);
            exit();*/
            $room = 1;
            $child = 0;
            $adults = 1;
            $rating = '';
            
                    
            $room = 1;

            //echo $this->input->get('child');
            $c_ages = array();
            for ($child_age=0; $child_age < $child ; $child_age++) { 
                    $c_ages[] = rand(0,15);
            }
            $final_child_Ages = implode(",", $c_ages);
            $childAges = $final_child_Ages;

            //if (!empty ($search)) {
                $this->data['checkin'] = $check_in;
                $this->data['checkout'] = $check_out;
                $this->data['room'] = $room;
                $this->data['minprice'] = '';
                $this->data['maxprice'] = '';
                $this->data['rating'] = $rating;
                $this->data['adults'] = $adults;
                $this->data['child'] = $child;
                $this->data['childAges'] = $childAges;
                $this->data['selectedCity'] = $res_data->city.' '.$res_data->state;
                if($this->data['child'] > 0){
                        $this->data['agesApendUrl'] = '&ages='.$childAges;
                }else{
                        $this->data['agesApendUrl'] = '';
                }

                      
                    $arrayInfo['checkIn'] = trim($check_in);
                    
                    $arrayInfo['checkOut'] = trim($check_out);
                    
                    
                    $childAgesStr = "";
                    if(!empty($childAges)){
                    
                        $childAgesStr = ",".$child;
                    }

                    $this->data['propertyCategory'] = array('hotel');
                    $adultString = $adults.$childAgesStr;

                    $arrayInfo['adults'] = $adults;
                    $arrayInfo['child'] = $child;
                    $arrayInfo['room'] = $room;
                    $arrayInfo['childAges'] = $final_child_Ages;
                    $arrayInfo['hotel_ids'] = $hotel_ids;
                   /* echo json_encode($arrayinfo);
                    exit();*/

                    $arrayInfo['rooms'] = "room1=$adultString";
                    $arrayInfo['numberOfResult'] = '';
                    if(!empty($this->data['propertyCategory'])){
                            $propertyCat = implode(",",$this->data['propertyCategory']);
                            $arrayInfo['propertyCategory'] = $propertyCat;
                    }

                    $arrayInfo['maxStarRating'] = $this->input->get('stars');
                    $arrayInfo['minStarRating'] = $this->input->get('stars');
                    $arrayInfo['lat']= $lat;
                    $arrayInfo['long']= $long;
                    
                    $local_hotels = $this->hotels_model->search_hotels_by_lat_lang_gb($arrayInfo['lat'], $arrayInfo['long'],$arrayInfo);
                    //print_r($local_hotels);
                    /*echo count($hotel_ids);
                    exit();*/

                    $abc =  $local_hotels['hotels'];
                    
                   $ptheme = pt_default_theme();
					$this->_config = config_item('theme');
					$uu = $this->_config['url'];

            
                if(count($hotel_ids) > 0){
    		        for ($i=0; $i < count($abc) ; $i++) { 
    		        		
    		        		$bb = $local_hotels['hotels'];
    		        		 $bb[$i]->title;
    		        		 $image = str_replace("demo.tarzango.com/","tarzango.com/",$bb[$i]->thumbnail);
    		        		$top_hotel .= '<div style="border: 1px solid #eeeeee;float:left; width:100%; margin:0; padding:0; list-style-type:none; margin-bottom:60px;box-shadow: 0 0 7px rgb(204, 204, 204);">
                                <li style="margin-left:0px">
                                            <div style="float:left; width:30%">
                                                <img height="200px" style=" margin-right:15px;float:left; width:100%; max-width:100%;" src="'.$image.'">
                                            </div>
                                    
                                                <h3 style="width:50%;padding-left:10px;padding-top:15px;float:left; margin:0; font-size:20px; font-weight:900; color:#000; line-height:20px;">'.$this->custom_echo($bb[$i]->title, 28).'</h3>
                                                <p style="padding-top:9px;float:right; color:#ff73b3; font-weight:100; font-size:26px; margin:0; margin-right:41px; line-height:26px;">'.$bb[$i]->currCode.$bb[$i]->price.'</p>
                                                <div style="float:left;width: 50%;">
                                                <p style="color:black;padding-top:9px;font-size:11px; opacity:0.6; margin:0;width:100%; clear:right; background-size:10px auto;"><img style="padding-left:10px; height: 12px !important;   margin-right:5px;" src="'.$uu.$ptheme.'/email_temp_img/gb_email_temp_img/'.'checkin.png">' .$this->custom_echo($bb[$i]->location, 50).'</p>
                                                </div>
                                                 <p style="color:black;font-size: 11px;float:right;margin-top:0px; margin-right: 18px;">per / night</p>
                                                <ul style="float:left;width: 285px; margin:5px 8px; padding:0; list-style:none;">
                                                    <li style="float:left; margin:0 3px;"><a href="#"><img src="'.$uu.$ptheme.'/email_temp_img/gb_email_temp_img/'.'icon11.png"></a></li>
                                                    <li style="float:left; margin:0 3px;"><a href="#"><img src="'.$uu.$ptheme.'/email_temp_img/gb_email_temp_img/'.'icon13.png"></a></li>
                                                    <li style="float:left; margin:0 3px;"><a href="#"><img src="'.$uu.$ptheme.'/email_temp_img/gb_email_temp_img/'.'icon15.png"></a></li>
                                                    <li style="float:left; margin:0 3px;"><a href="#"><img src="'.$uu.$ptheme.'/email_temp_img/gb_email_temp_img/'.'icon12.png"></a></li>
                                                    <li style="float:left; margin:0 3px;"><a href="#"><img src="'.$uu.$ptheme.'/email_temp_img/gb_email_temp_img/'.'icon14.png"></a></li>
                                                </ul>
                                                <span style="float:left;color:black; margin:0px;padding-left:10px;width:67%;">
                                                '.$this->custom_echo($bb[$i]->desc, 80).'
                                                </span>               
                                            
                                        </li>
                                        </div>';
    		        }
                }

				$res = $this->settings_model->get_contact_page_details();
				$contact_phone = $res[0]->contact_phone;
				$contact_email = $res[0]->contact_email;
				$contact_address = $res[0]->contact_address;

				$sendto =  $details->contect_email;
               
				$email_temp_img =  $uu.$ptheme.'/email_temp_img/gb_email_temp_img/';
				$template = array('{name}','{check_in}','{check_out}','{link}','{email_temp_img}','{city}','{state}','{aprx_rooms}','{contact_phone}','{contact_email}','{contact_address}','{contact_name}','{company_name}','{attendees}','{place_type}','{contact_no}','{contect_email}','{top_hotel}');
				$values = array($details->contect_name,
                                $details->check_in,
                                $details->check_out,
                                $details->link_gen,
                                $email_temp_img,
                                $details->city,
                                $details->state,
                                $details->aprx_rooms,
                                $contact_phone,
                                $contact_email,
                                $contact_address,
                                $details->contect_name,
                                $details->company_name,
                                $details->attendees,
                                $details->place_type,
                                $details->contect_no,
                                $details->contect_email,
                                $top_hotel);
				$HTML_DATA = file_get_contents( $uu.$ptheme.'/gb_request_email.html');
				$message = str_replace($template, $values, $HTML_DATA);
				
    
				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($sendto);
				$this->email->subject('Thanks for Group Booking at Tarzango');
				$this->email->message($message);
				$this->email->send();
                /*echo $this->sendfrom;
                echo "<br>";
                echo $sendto;
                echo "<br>";
                echo $message;
                echo "<br>";
                show_error($this->email->print_debugger());*/
                
				
		}

		//send email to customer for booking Request success
		
		function gb_sendEmail_customer($details = "") {
				
			$this->load->model('hotels/hotels_model');
			$link_code = $this->input->get('gbcode');
            $this->load->model("admin/groupbookings_model");
            $res_data = $this->groupbookings_model->get_gbbookings($details->link_code);

            
            $check_in = $res_data->check_in;
            $check_out = $res_data->check_out;
            $lat = $res_data->location_lat;
            $long = $res_data->location_long;
            $hotel_data = json_decode($res_data->hotel_data);
           
            $hotel_ids = explode(',', $res_data->hotel_id);
            
            $room = 1;
            $child = 0;
            $adults = 1;
            $rating = '';
            
                    
            $room = 1;

            //echo $this->input->get('child');
            $c_ages = array();
            for ($child_age=0; $child_age < $child ; $child_age++) { 
                    $c_ages[] = rand(0,15);
            }
            $final_child_Ages = implode(",", $c_ages);
            $childAges = $final_child_Ages;

            //if (!empty ($search)) {
                $this->data['checkin'] = $check_in;
                $this->data['checkout'] = $check_out;
                $this->data['room'] = $room;
                $this->data['minprice'] = $this->settings[0]->front_search_min_price;
                $this->data['maxprice'] = $this->settings[0]->front_search_max_price;
                $this->data['rating'] = $rating;
                $this->data['adults'] = $adults;
                $this->data['child'] = $child;
                $this->data['childAges'] = $childAges;
                $this->data['selectedCity'] = $res_data->city.' '.$res_data->state;
                if($this->data['child'] > 0){
                        $this->data['agesApendUrl'] = '&ages='.$childAges;
                }else{
                        $this->data['agesApendUrl'] = '';
                }

             
                

                                
                    $arrayInfo['checkIn'] = trim($check_in);
                    
                    $arrayInfo['checkOut'] = trim($check_out);
                    
                    
                    $childAgesStr = "";
                    if(!empty($childAges)){
                    
                        $childAgesStr = ",".$child;
                    }

                    $this->data['propertyCategory'] = array('hotel');
                    $adultString = $adults.$childAgesStr;

                    $arrayInfo['adults'] = $adults;
                    $arrayInfo['child'] = $child;
                    $arrayInfo['room'] = $room;
                    $arrayInfo['childAges'] = $final_child_Ages;
                    $arrayInfo['hotel_ids'] = $hotel_ids;
                   /* echo json_encode($arrayinfo);
                    exit();*/

                    $arrayInfo['rooms'] = "room1=$adultString";
                    $arrayInfo['numberOfResult'] = $this->settings[0]->front_search;
                    if(!empty($this->data['propertyCategory'])){
                            $propertyCat = implode(",",$this->data['propertyCategory']);
                            $arrayInfo['propertyCategory'] = $propertyCat;
                    }

                    $arrayInfo['maxStarRating'] = $this->input->get('stars');
                    $arrayInfo['minStarRating'] = $this->input->get('stars');
                    $arrayInfo['lat']= $lat;
                    $arrayInfo['long']= $long;
                    
                    $local_hotels = $this->hotels_model->search_hotels_by_lat_lang_gb($arrayInfo['lat'], $arrayInfo['long'],$arrayInfo);
                    //print_r($res_data);
                    

                    $abc =  $local_hotels['hotels'];
                    
                   $ptheme = pt_default_theme();
					$this->_config = config_item('theme');
					$uu = $this->_config['url'];

            

		        	for ($i=0; $i < count($abc) ; $i++) { 
		        		
		        		$bb = $local_hotels['hotels'];
		        		 $bb[$i]->title;
		        		 $image = str_replace("demo.tarzango.com/","tarzango.com/",$bb[$i]->thumbnail);
		        		$top_hotel .= '<div style="border: 1px solid #eeeeee;float:left; width:100%; margin:0; padding:0; list-style-type:none; margin-bottom:40px;box-shadow: 0 0 7px rgb(204, 204, 204);">
		        			<li style="margin-left:0px">
                                    	<div style="float:left; width:30%">
                                        	<img height="200px" style=" margin-right:15px;float:left; width:100%; max-width:100%;" src="'.$image.'">
                                        </div>
                                
                                        	<h3 style="width:50%;padding-left:10px;padding-top:15px;float:left; margin:0; font-size:20px; font-weight:900; color:#000; line-height:20px;">'.$this->custom_echo($bb[$i]->title, 28).'</h3>
                                            <p style="padding-top:9px;float:right; color:#ff73b3; font-weight:100; font-size:26px; margin:0; margin-right:41px; line-height:26px;">'.$bb[$i]->currCode.$bb[$i]->price.'</p>
                                            <div style="float:left;width: 50%;">
                                            <p style="color:black;padding-top:9px;font-size:11px; opacity:0.6; margin:0;width:100%; clear:right; background-size:10px auto;"><img style="padding-left:10px; height: 12px !important;
   margin-right:5px;" src="'.$uu.$ptheme.'/email_temp_img/gb_email_temp_img/'.'checkin.png">' .$this->custom_echo($bb[$i]->location, 50).'</p>
                                            </div>
                                             <p style="color:black;font-size: 11px;float:right;margin-top:0px; margin-right: 18px;">per / night</p>
                                            <ul style="float:left;width: 285px; margin:5px 8px; padding:0; list-style:none;">
                                            	<li style="float:left; margin:0 3px;"><a href="#"><img src="'.$uu.$ptheme.'/email_temp_img/gb_email_temp_img/'.'icon11.png"></a></li>
                                                <li style="float:left; margin:0 3px;"><a href="#"><img src="'.$uu.$ptheme.'/email_temp_img/gb_email_temp_img/'.'icon13.png"></a></li>
                                                <li style="float:left; margin:0 3px;"><a href="#"><img src="'.$uu.$ptheme.'/email_temp_img/gb_email_temp_img/'.'icon15.png"></a></li>
                                                <li style="float:left; margin:0 3px;"><a href="#"><img src="'.$uu.$ptheme.'/email_temp_img/gb_email_temp_img/'.'icon12.png"></a></li>
                                                <li style="float:left; margin:0 3px;"><a href="#"><img src="'.$uu.$ptheme.'/email_temp_img/gb_email_temp_img/'.'icon14.png"></a></li>
                                            </ul>
                                            <span style="float:left;color:black; margin:0px;padding-left:10px;width:67%;">
                                            '.$this->custom_echo($bb[$i]->desc, 60).'
                                            </span>
                                            <a href="'.$bb[$i]->slug.'"><button style="float:left;margin-left:10px; border:none;font-size:9px; text-transform:uppercase; color:#fff; background:#3dccff; border-radius:3px; padding:6px 20px; text-decoration:none; line-height:14px;  letter-spacing:1px; font-weight:600;">reserve</button></a>
                                           
                                        
                                    </li>
                                    </div>';

		        }

        	$top_hotel .= '</u>';

            	

				$res = $this->settings_model->get_contact_page_details();
				$contact_phone = $res[0]->contact_phone;
				$contact_email = $res[0]->contact_email;
				$contact_address = $res[0]->contact_address;

				$sendto =  $details->contect_email;

				
				
				$email_temp_img =  $uu.$ptheme.'/email_temp_img/gb_email_temp_img/';
                $template = array('{name}','{check_in}','{check_out}','{link}','{email_temp_img}','{city}','{state}','{aprx_rooms}','{contact_phone}','{contact_email}','{contact_address}','{top_hotel}');
				$values = array($details->contect_name,$details->check_in,$details->check_out,$details->link_gen,$email_temp_img,$details->city,$details->state,$details->aprx_rooms,$contact_phone,$contact_email,$contact_address,$top_hotel);
				
				$HTML_DATA = file_get_contents( $uu.$ptheme.'/gb_confirmation_email.html');
				$message = str_replace($template, $values, $HTML_DATA);

				
				
				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($sendto);
				$this->email->subject('Thanks for Group Booking at the ');
				$this->email->message($message);
				$this->email->send();
				
				
		}

		

//send email to Admin for booking paid
		function gb_sendEmail_admin($details) {

			$currencycode = $details->currCode;
			$currencysign = $details->currSymbol;

				$custid = $details->bookingUser;
				$country = $details->userCountry;
				$name = $details->userFullName;
				$phone = $details->userMobile;
				$paymethod = $details->paymethod;
				$invoiceid = $details->id;
				$refno = $details->code;
				$totalamount = $details->checkoutTotal;
				$deposit = $details->checkoutAmount;
				$duedate = $details->expiry;
				$date = $details->date;
				$remaining = $details->remainingAmount;
				$custemail = $details->accountEmail;				
				$additionaNotes = $details->additionaNotes;				
				$sendto = $this->adminemail;

				$sitetitle = "";

				$invoicelink = "<a href=" . base_url() . "invoice?id=" . $invoiceid . "&sessid=" . $refno . " >" . base_url() . "invoice?id=" . $invoiceid . "&sessid=" . $refno . "</a>";
				$template = $this->shortcode_variables("bookingpaidadmin");
				$details = email_template_detail("bookingpaidadmin");
				//$smsdetails = sms_template_detail("bookingpaidadmin");
				$values = array($invoiceid, $refno, $deposit, $totalamount, $custemail, $custid, $country, $phone, $currencycode, $currencysign, $invoicelink, $sitetitle, $name,$additionaNotes);
				
				$message = $this->mailHeader;
				$message .= str_replace($template, $values, $details[0]->temp_body);
				$message .= $this->mailFooter;

				//$smsmessage = str_replace($template, $values, $smsdetails[0]->temp_body);
				//sendsms($smsmessage, $this->adminmobile, "bookingpaidadmin");
				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($sendto);
				$this->email->subject('Booking Payment Notification');
				$this->email->message($message);
				$this->email->send();
		}

//send email to Owner for booking paid
		function gb_sendEmail_owner($details) {
				$currencycode = $details->currCode;
				$currencysign = $details->currSymbol;

				$custid = $details->bookingUser;
				$country = $details->userCountry;
				$name = $details->userFullName;
				$phone = $details->userMobile;
				$paymethod = $details->paymethod;
				$invoiceid = $details->id;
				$refno = $details->code;
				$totalamount = $details->checkoutTotal;
				$deposit = $details->checkoutAmount;
				$duedate = $details->expiry;
				$date = $details->date;
				$remaining = $details->remainingAmount;
				$custemail = $details->accountEmail;				
			
				$sendto = $this->ownerEmail($details->module, $details->itemid);
				$sitetitle = "";
				
				$message = $this->mailHeader;
				$message .= "<h4><b>Booking Paid Successfully</b></h4>";
				$message .= "Invoice No.: " . $invoiceid . ".<br>";
				//$message .= "Payment Method: " . $paymethod . ".<br><br>";
				$message .= "Deposit Amount: " . $currencycode . " " . $currencysign . $deposit . "<br>";
				$message .= "Total Amount: " . $currencycode . " " . $currencysign . $totalamount . "<br><br>";
				$message .= "<h4><b>Customer Information</b></h4>";
				$message .= "Customer ID: " . $custid . "<br>";
				$message .= "Name : " . $name . "<br>";
				$message .= "Email : " . $custemail . "<br>";
				$message .= "Country : " . $country . "<br>";
				$message .= "Phone : " . $phone . "<br>";
				$message .= "<br> To view Invoice <a href=" . base_url() . "invoice?id=" . $invoiceid . "&sessid=" . $refno . " >" . base_url() . "invoice?id=" . $invoiceid . "&sessid=" . $refno . "</a>";
				$message .= $this->mailFooter;
				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($sendto);
				$this->email->subject('Booking Payment Notification');
				$this->email->message($message);
				$this->email->send();
		}

		// get admin email
		function get_admin_email() {
				$this->db->select('accounts_email');
				$this->db->where('accounts_type', 'webadmin');
				$q = $this->db->get('pt_accounts')->result();
				return $q[0]->accounts_email;
		}

		// get admin Mobile
		function get_admin_mobile() {
				$this->db->select('ai_mobile');
				$this->db->where('accounts_type', 'webadmin');
				$q = $this->db->get('pt_accounts')->result();
				return $q[0]->ai_mobile;
		}

// get owner email
		function ownerEmail($type, $id) {
				$email = '';
				if ($type == "hotels") {
						$this->db->select('hotel_email');
						$this->db->where('hotel_id', $id);
						$q = $this->db->get('pt_hotels')->result();
						$email = $q[0]->hotel_email;
				}
				elseif ($type == "tours") {
						$this->db->select('tour_email');
						$this->db->where('tour_id', $id);
						$q = $this->db->get('pt_tours')->result();
						$email = $q[0]->tour_email;
				}
				elseif ($type == "cars") {
						$this->db->select('car_email');
						$this->db->where('car_id', $id);
						$q = $this->db->get('pt_cars')->result();
						$email = $q[0]->car_email;
				}
				return $email;
		}

		function get_siteTitleUrl() {
				$appsettings = $this->settings_model->get_settings_data();
				$resultArray = array("title" => $appsettings[0]->site_title,"url" => $appsettings[0]->site_url);
				return $resultArray;
		}

	

// get mailserver settings
		function get_mailserver() {
				$this->db->where('mail_id', '1');
				return $this->db->get('pt_mailserver')->result();
		}
		function custom_echo($x, $length)
		{
			  if(strlen($x)<=$length)
			  {
			    return $x;
			  }
			  else
			  {
			    $y=substr($x,0,$length) . '...';
			    return $y;
			  }
		}
		
		
}