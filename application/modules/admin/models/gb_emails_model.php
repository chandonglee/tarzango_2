<?php
class Gb_emails_model extends CI_Model {
		private $sendfrom;
		private $adminemail;
		private $adminmobile;
		private $sitetitle;
		private $siteurl;
		private $mailHeader;
		private $mailFooter;

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
		function gb_sendEmail_customer($details = "") {
				 
				 $sendto =  $details->contect_email;
				$ptheme = pt_default_theme();
				$this->_config = config_item('theme');
				$uu = $this->_config['url'];
				$template = array('{name}','{check_in}','{check_out}','{link}');
				$values = array($details->contect_name,$details->check_in,$details->check_out,$details->link_gen);
				$email_temp_img =  $uu.$ptheme.'/gb_email_temp_img/';
				//$HTML_DATA = file_get_contents( $uu.$ptheme.'/gb_email-confirmation.html');
				$HTML_DATA = 'Hello {name}, <br/><br/>';
				$HTML_DATA .= 'Your group booking request for the dates: {check_in} and {check_out} is recieved and approved. Kindly send the link: {link} to your members to use for booking. <br/><br/>';
				$HTML_DATA .= 'Thanks, <br/>';
				$HTML_DATA .= 'Tarzango';
				$message = str_replace($template, $values, $HTML_DATA);

				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($sendto);
				$this->email->subject('Thanks for Group Booking at the ');
				$this->email->message($message);
				$this->email->send();
				/*print_r($details);
				exit();*/
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