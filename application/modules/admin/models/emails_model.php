<?php
class Emails_model extends CI_Model {
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

		

//send email to customer
		function sendEmail_customer($details, $sitetitle) {
			/*echo json_encode($details);
			exit();*/
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
				$sendto = $details->accountEmail;
				$additionaNotes = $details->additionaNotes;

				$remaining = $details->remainingAmount;
				$HOTEL_NAME = $details->title;
				$room_name = $details->subItem->title;
				$booking_adults = $details->subItem->booking_adults;
				$room_price = $details->subItem->price;
				$couponRate = $details->couponRate;
				
				$checkin = $details->checkin;
				
				$checkout = $details->checkout;
				
				$date = date ( "m/d/Y" , strtotime ( "-1 day" , strtotime ( $details->checkin ) ) );
				$no_of_room  = $details->subItem->quantity;
				$thumbnail = $details->thumbnail;
				$hotel_id = $details->itemid;

				$invoicelink = '<tr><td colspan="2"><strong>Pay now link : </strong><a href="' . base_url() . 'invoice?id=' . $invoiceid . '&sessid=' . $refno . '" >' . base_url() . 'invoice?id=' . $invoiceid . '&sessid=' . $refno . '</a></td>
                                    </tr>';
				$template = $this->shortcode_variables("bookingordercustomer");
				$details = email_template_detail("bookingordercustomer");
				//$smsdetails = sms_template_detail("bookingordercustomer");
				$values = array($invoiceid, $HOTEL_NAME, $refno, $deposit, $totalamount, $sendto, $custid, $country, $phone, $currencycode, $currencysign, $invoicelink, $sitetitle, $remaining , $name, $room_name, $date, $checkin, $checkout, $no_of_room, $thumbnail,$booking_adults,$room_price,$couponRate,$additionaNotes);

				$details = $this->html_template_booking($hotel_id,$invoiceid);
				$message .= str_replace($template, $values, $details);
				/*echo $message;
				exit();*/
				//$smsmessage = str_replace($template, $values, $smsdetails[0]->temp_body);
				//sendsms($smsmessage, $phone, "bookingordercustomer");
				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($sendto);
				$this->email->subject('Booking Details and Invoice');
				$this->email->message($message);
				$this->email->send();
		}

//send email to Admin
		function sendEmail_admin($details, $sitetitle) {
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
				$custemail = $details->accountEmail;
				$additionaNotes = $details->additionaNotes;
				$sendto = $this->adminemail;
				$invoicelink = "<a href=" . base_url() . "invoice?id=" . $invoiceid . "&sessid=" . $refno . " >" . base_url() . "invoice?id=" . $invoiceid . "&sessid=" . $refno . "</a>";
				$template = $this->shortcode_variables("bookingorderadmin");
				$details = email_template_detail("bookingorderadmin");
				//$smsdetails = sms_template_detail("bookingorderadmin");
				$values = array($invoiceid, $refno, $deposit, $totalamount, $custemail, $custid, $country, $phone, $currencycode, $currencysign, $invoicelink, $sitetitle, $name,$additionaNotes);
				
				$message = $this->mailHeader;
				$message .= str_replace($template, $values, $details[0]->temp_body);
				$message .= $this->mailFooter;

				
				//$smsmessage = str_replace($template, $values, $smsdetails[0]->temp_body);
				//sendsms($smsmessage, $this->adminmobile, "bookingorderadmin");
				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($sendto);
				$this->email->subject($details[0]->temp_subject);
				$this->email->message($message);
				$this->email->send();
		}

//send email to Owner
		function sendEmail_owner($details, $sitetitle) {

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
				$custemail = $details->accountEmail;

				$sendto = $this->ownerEmail($details->module, $details->itemid);

				$message = $this->mailHeader;
				$message .= "<h4><b>Order Information</b></h4>";
				$message .= "Date :" . $date . ".<br>";
				$message .= "Invoice No.: " . $invoiceid . ".<br>";
				//	$message .= "Payment Method: " . $paymethod . ".<br><br>";
				$message .= "Deposit Amount: " . $currencycode . " " . $currencysign . $deposit . "<br>";
				$message .= "Total Amount: " . $currencycode . " " . $currencysign . $totalamount . "<br><br>";
				$message .= "<h4><b>Customer Information</b></h4>";
				$message .= "Customer ID: " . $custid . "<br>";
				$message .= "Name : " . $name . "<br>";
				$message .= "Email : " . $custemail . "<br>";
				if(!empty($country)){
				$message .= "Country : " . $country . "<br>";	
				}
				
				$message .= "Phone : " . $phone . "<br>";
				$message .= "<br> To view Invoice visit at: <a href=" . base_url() . "invoice?id=" . $invoiceid . "&sessid=" . $refno . " >" . base_url() . "invoice?id=" . $invoiceid . "&sessid=" . $refno . "</a>";
				$message .= $this->mailFooter;

				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($sendto);
				$this->email->subject('New Booking Notification');
				$this->email->message($message);
				$this->email->send();
		}

//send email to Supplier
		function sendEmail_supplier($details, $sitetitle) {
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
				$custemail = $details->accountEmail;
				$additionaNotes = $details->additionaNotes;
				$sendto = $this->supplierEmail($details->module, $details->itemid);
				$invoicelink = "<a href=" . base_url() . "invoice?id=" . $invoiceid . "&sessid=" . $refno . " >" . base_url() . "invoice?id=" . $invoiceid . "&sessid=" . $refno . "</a>";
				$template = $this->shortcode_variables("bookingordersupplier");
				$details = email_template_detail("bookingordersupplier");
				//$smsdetails = sms_template_detail("bookingorderadmin");
				$values = array($invoiceid, $refno, $deposit, $totalamount, $custemail, $custid, $country, $phone, $currencycode, $currencysign, $invoicelink, $sitetitle, $name,$additionaNotes);
				
				$message = $this->mailHeader;
				$message .= str_replace($template, $values, $details[0]->temp_body);
				$message .= $this->mailFooter;

				
				//$smsmessage = str_replace($template, $values, $smsdetails[0]->temp_body);
				//sendsms($smsmessage, $this->adminmobile, "bookingorderadmin");
				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($sendto);
				$this->email->subject($details[0]->temp_subject);
				$this->email->message($message);
				$this->email->send();

			
		}

//send email to customer for booking payment success
		function paid_sendEmail_customer($details) {
			/*echo json_encode($details);
			exit();*/
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
				$sendto = $details->accountEmail;

				$additionaNotes = $details->additionaNotes;

				$remaining = $details->remainingAmount;
				$HOTEL_NAME = $details->title;
				$room_name = $details->subItem->title;
				$booking_adults = $details->subItem->booking_adults;
				$room_price = $details->subItem->price;
				
				$checkin = $details->checkin;
				
				$checkout = $details->checkout;
				$couponRate = $details->couponRate;
				
				$date = date ( "m/d/Y" , strtotime ( "-1 day" , strtotime ( $details->checkin ) ) );
				$no_of_room  = $details->subItem->quantity;
				$thumbnail = $details->thumbnail;
				$hotel_id = $details->itemid;
				
				$sitetitle = "";

				$invoicelink = "";
				$template = $this->shortcode_variables("bookingpaidcustomer");
				$details = email_template_detail("bookingpaidcustomer");
				//$smsdetails = sms_template_detail("bookingpaidcustomer");
				$values = array($invoiceid, $HOTEL_NAME, $refno, $deposit, $totalamount, $sendto, $custid, $country, $phone, $currencycode, $currencysign, $invoicelink, $sitetitle, $remaining , $name, $room_name, $date, $checkin, $checkout, $no_of_room, $thumbnail,$booking_adults,$room_price,$couponRate,$additionaNotes);
				/*$message = $this->mailHeader;*/
				/*echo '<pre>'.json_encode($message).'</pre>';
				exit();*/
				$details = $this->html_template_booking($hotel_id,$invoiceid);
				$message .= str_replace($template, $values, $details);
				//$message .= $this->mailFooter;
				
				//$smsmessage = str_replace($template, $values, $smsdetails[0]->temp_body);
				//sendsms($smsmessage, $phone, "bookingpaidcustomer");
				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($sendto);
				$this->email->subject('Thanks for Booking at the '.$HOTEL_NAME);
				$this->email->message($message);
				$this->email->send();
				echo $message;
				exit;
		}

		

//send email to Admin for booking paid
		function paid_sendEmail_admin($details) {

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

//send email to Supplier for booking paid
		function paid_sendEmail_supplier($details) {

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
				$sendto = $this->supplierEmail($details->module, $details->itemid);

				$sitetitle = "";

				$invoicelink = "<a href=" . base_url() . "invoice?id=" . $invoiceid . "&sessid=" . $refno . " >" . base_url() . "invoice?id=" . $invoiceid . "&sessid=" . $refno . "</a>";
				$template = $this->shortcode_variables("bookingpaidsupplier");
				$details = email_template_detail("bookingpaidsupplier");
				//$smsdetails = sms_template_detail("bookingpaidadmin");
				$values = array($invoiceid, $refno, $deposit, $totalamount, $custemail, $custid, $country, $phone, $currencycode, $currencysign, $invoicelink, $sitetitle, $name);
				
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
		function paid_sendEmail_owner($details) {
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

// sending booking cancellation emails
		function booking_request_cancellation_email($useremail, $bookingid) {
				//to customer
				$message = $this->mailHeader;
				$message .= "Dear Customer,<br>";
				$message .= "Your booking cancellation request for Booking ID: $bookingid has been registered, you will soon be notified about the response by email.<br>";
				$message .= "Thanks For using our service.";
				$message .= $this->mailFooter;
				
				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($useremail);
				$this->email->subject('Request to cancel Booking.');
				$this->email->message($message);
				$this->email->send();
				// $this->email->print_debugger();
				// to admin
				$adminmessage = "Dear Admin,<br>";
				$adminmessage .= " A request has been registered to cancel Booking id: $bookingid";
				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($this->adminemail);
				$this->email->subject('Request Received to cancel Booking.');
				$this->email->message($adminmessage);
				$this->email->send();
		}

// sending booking cancellation approval email
		function booking_approve_cancellation_email($useremail) {
			//to customer
				$message = $this->mailHeader;
				$message .= "Dear Customer,<br>";
				$message .= "Your booking has been cancelled.<br>";
				$message .= "Thanks For using our service.";
				$message .= $this->mailFooter;

				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($useremail);
				$this->email->subject('Your Booking Cancellation has been Processed.');
				$this->email->message($message);
				$this->email->send();
		}

// sending booking cancellation rejection email
		function booking_reject_cancellation_email($useremail, $bookingid) {
			//to customer
				$message = $this->mailHeader;
				$message .= "Dear Customer,<br>";
				$message .= "Your booking cancellation request for booking id: $bookingid has been rejected.<br>";
				$message .= "Thanks For using our service.";
				$message .= $this->mailFooter;

				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($useremail);
				$this->email->subject('Your Booking Cancellation Request is rejected.');
				$this->email->message($message);
				$this->email->send();
		}

// send reset password
		function reset_password($to, $newpass, $phone) {
				$template = $this->shortcode_variables("forgotpassword");
				$details = email_template_detail("forgotpassword");
				//$smsdetails = sms_template_detail("forgotpassword");
				$values = array($to, $newpass);
				$message = $this->mailHeader;
				$message .= str_replace($template, $values, $details[0]->temp_body);
				$message .= $this->mailFooter;

				//$smsmessage = str_replace($template, $values, $smsdetails[0]->temp_body);
				//sendsms($smsmessage, $phone, "forgotpassword");
				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($to);
				$this->email->subject($details[0]->temp_subject);
				$this->email->message($message);
				$this->email->send();
				/*show_error($this->email->print_debugger());
				*/
		}

//send signup email to customer
		function signupEmail($edata) {
				$phone = $edata['mobile'];
				$email = $edata['email'];
				$password = $edata['password'];
				$fullname = $edata['fullname'];
				$template = $this->shortcode_variables("customersignup");
				$details = email_template_detail("customersignup");
				//$smsdetails = sms_template_detail("customersignup");
				$values = array($fullname, $email, $password);
				
				$message = $this->mailHeader;
				$message .= str_replace($template, $values, $details[0]->temp_body);
				$message .= $this->mailFooter;

				//$smsmessage = str_replace($template, $values, $smsdetails[0]->temp_body);
				//sendsms($smsmessage, $phone, "customersignup");
				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($email);
				$this->email->subject($details[0]->temp_subject);
				$this->email->message($message);
				$this->email->send();

		}

//send newsletter
		function sendNewsletter($message, $subject, $to) {

				$msg = $this->mailHeader;
				$msg .= $message;
				$msg .= $this->mailFooter;

				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($to);
				$this->email->subject($subject);
				$this->email->message($msg);
				$this->email->send();
		}

// get admin email
		function get_admin_email() {
				$this->db->select('accounts_email');
				$this->db->where('accounts_type', 'webadmin');
				$q = $this->db->get('pt_accounts')->result();
				return $q[0]->accounts_email;
		}
// get admin email
		function get_user_email($id) {
				$this->db->select('accounts_email');
				$this->db->where('accounts_id', $id);
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
// get supplier Email
		function supplierEmail($type, $id) {
				$email = '';
				if ($type == "hotels") {
						$this->db->select('hotel_owned_by');
						$this->db->where('hotel_id', $id);
						$q = $this->db->get('pt_hotels')->result();
						$email = $this->get_user_email($q[0]->hotel_owned_by);
				}
				elseif ($type == "tours") {
						$this->db->select('tour_owned_by');
						$this->db->where('tour_id', $id);
						$q = $this->db->get('pt_tours')->result();
						$email = $this->get_user_email($q[0]->tour_owned_by);
				}
				elseif ($type == "cars") {
						$this->db->select('car_owned_by');
						$this->db->where('car_id', $id);
						$q = $this->db->get('pt_cars')->result();
						$email = $this->get_user_email($q[0]->car_owned_by);
				}
				return $email;
		}

// update mailserver settings
		function update_mailserver() {
				$defmailer = $this->input->post('defmailer');
				if ($defmailer == "php") {
						$data = array('mail_default' => $this->input->post('defmailer'), 
									 'mail_fromemail' => $this->input->post('fromemail'),
									 'mail_header' => $this->input->post('mailheader'), 
							         'mail_footer' => $this->input->post('mailfooter'));
				}
				else {
						$data = array('mail_hostname' => $this->input->post('smtphost'), 
							'mail_fromemail' => $this->input->post('fromemail'),
							'mail_username' => $this->input->post('smtpuser'), 
							'mail_password' => $this->input->post('smtppass'), 
							'mail_port' => $this->input->post('smtpport'), 
							'mail_default' => $this->input->post('defmailer'), 
							'mail_secure' => $this->input->post('smtpsecure'),
							'mail_header' => $this->input->post('mailheader'), 
							'mail_footer' => $this->input->post('mailfooter'));
				}

				$this->db->where('mail_id', '1');
				$this->db->update('pt_mailserver', $data);
		}

// resend invoice
//send email to customer
		function resend_invoice($details) {
				$name = $details[0]->ai_first_name . " " . $details[0]->ai_last_name;
				$invoiceid = $details[0]->booking_id;
				$refno = $details[0]->booking_ref_no;
				$sendto = $details[0]->accounts_email;
				$message = $this->mailHeader;
				$message .= "Dear " . $name . ",<br>";
				$message .= "You may review your invoice by visiting at: <a href=" . base_url() . "invoice?id=" . $invoiceid . "&sessid=" . $refno . " >" . base_url() . "invoice?id=" . $invoiceid . "&sessid=" . $refno . "</a>";
				$message .= $this->mailFooter;


				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($sendto);
				$this->email->subject('Booking Invoice');
				$this->email->message($message);
				$this->email->send();
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
// send Verification Email

		public function email_verified($to, $pass, $name, $phone, $accType = null) {
			if($accType == "customers"){
				$loginurl = "<a href=" . base_url() . "login >" . base_url() . "login </a>";
				$pass = "";
			}else{

				$loginurl = "<a href=" . base_url() . "supplier >" . base_url() . "supplier </a>";
			}
				
			if($accType == "customers"){
				$template = $this->shortcode_variables("verifycustomeraccount");
				$details = email_template_detail("verifycustomeraccount");

				//$smsdetails = sms_template_detail("verifyaccount");
				$values = array($name, $to, $loginurl);
			}else{
				$template = $this->shortcode_variables("verifyaccount");
				$details = email_template_detail("verifyaccount");

				//$smsdetails = sms_template_detail("verifyaccount");
				$values = array($name, $to, $pass, $loginurl);
			}


				$message = $this->mailHeader;
				$message .= str_replace($template, $values, $details[0]->temp_body);
				$message .= $this->mailFooter;

				//$smsmessage = str_replace($template, $values, $smsdetails[0]->temp_body);
				//sendsms($smsmessage, $phone, "verifyaccount");
				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($to);
				$this->email->subject($details[0]->temp_subject);
				$this->email->message($message);
				$this->email->send();
		}
// send New supplier email to supplier

		public function supplier_signup($edata) {
				$details = email_template_detail("supplierregister");
				//$smsdetails = sms_template_detail("supplierregister");

				$message = $this->mailHeader;
				$message .= $details[0]->temp_body;
				$message .= $this->mailFooter;

				//sendsms($smsdetails[0]->temp_body, $edata['phone'], "supplierregister");
				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($edata['email']);
				$this->email->subject($details[0]->temp_subject);
				$this->email->message($message);
				$this->email->send();
		}

// send New customer email to supplier

		public function customer_signup($edata) {
				$details = email_template_detail("customerregister");
				//$smsdetails = sms_template_detail("supplierregister");

				$message = $this->mailHeader;
				$message .= $details[0]->temp_body;
				$message .= $this->mailFooter;

				//sendsms($smsdetails[0]->temp_body, $edata['phone'], "supplierregister");
				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($edata['email']);
				$this->email->subject($details[0]->temp_subject);
				$this->email->message($message);
				$this->email->send();
		}

// send New supplier signup email to Admin

		public function new_supplier_email($edata) {
				$template = $this->shortcode_variables("supplierregisteradmin");
				$details = email_template_detail("supplierregisteradmin");
				//$smsdetails = sms_template_detail("supplierregisteradmin");
				$values = array($edata['name'], $edata['email'], $edata['address'], $edata['phone']);

				$message = $this->mailHeader;
				$message .= str_replace($template, $values, $details[0]->temp_body);
				$message .= $this->mailFooter;

				//$smsmessage = str_replace($template, $values, $smsdetails[0]->temp_body);
				//sendsms($smsmessage, $this->adminmobile, "supplierregisteradmin");
				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($this->adminemail);
				$this->email->subject($details[0]->temp_subject);
				$this->email->message($message);
				$this->email->send();
		}

// send New customer signup email to Admin

		public function new_customer_email($edata) {
				$template = $this->shortcode_variables("customerregisteradmin");
				$details = email_template_detail("customerregisteradmin");
				//$smsdetails = sms_template_detail("supplierregisteradmin");
				$values = array($edata['name'], $edata['email'], $edata['address'], $edata['phone']);

				$message = $this->mailHeader;
				$message .= str_replace($template, $values, $details[0]->temp_body);
				$message .= $this->mailFooter;

				//$smsmessage = str_replace($template, $values, $smsdetails[0]->temp_body);
				//sendsms($smsmessage, $this->adminmobile, "supplierregisteradmin");
				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($this->adminemail);
				$this->email->subject($details[0]->temp_subject);
				$this->email->message($message);
				$this->email->send();
		}

		public function sendtotest($template) {
				$details = email_template_detail($template);

				$message = $this->mailHeader;
				$message .= $details[0]->temp_body;
				$message .= $this->mailFooter;

				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($this->adminemail);
				$this->email->subject($details[0]->temp_subject);
				$this->email->message($message);
				$this->email->send();
				return '1';
		}

		public function quickemail($from, $body, $to, $subject) {
				$message = $this->mailHeader;
				$message .= $body;
				$message .= $this->mailFooter;

				$this->email->set_newline("\r\n");
				$this->email->from($from);
				$this->email->to($to);
				$this->email->subject($subject);
				$this->email->message($message);
				$this->email->send();
		}

		public function shortcode_variables($template) {
				if ($template == "bookingorderadmin") {
						$result = array("{invoice_id}", "{invoice_code}", "{deposit_amount}", "{total_amount}", "{customer_email}", "{customer_id}", "{country}", "{phone}", "{currency_code}", "{currency_sign}", "{invoice_link}", "{site_title}", "{fullname}","{additionaNotes}");
				}if ($template == "bookingordersupplier") {
						$result = array("{invoice_id}", "{invoice_code}", "{deposit_amount}", "{total_amount}", "{customer_email}", "{customer_id}", "{country}", "{phone}", "{currency_code}", "{currency_sign}", "{invoice_link}", "{site_title}", "{fullname}","{additionaNotes}");
				}
				elseif ($template == "bookingpaidadmin") {
						$result = array("{invoice_id}", "{invoice_code}", "{deposit_amount}", "{total_amount}", "{customer_email}", "{customer_id}", "{country}", "{phone}", "{currency_code}", "{currency_sign}", "{invoice_link}", "{site_title}", "{fullname}","{additionaNotes}");
				}
				elseif ($template == "supplierregister") {
						$result = array("{fullname}");
				}
				elseif ($template == "forgotpassword") {
						$result = array("{username}", "{password}");
				}
				elseif ($template == "bookingordercustomer") {
						/*$result = array("{invoice_id}", "{invoice_code}", "{deposit_amount}", "{total_amount}", "{customer_email}", "{customer_id}", "{country}", "{phone}", "{currency_code}", "{currency_sign}", "{invoice_link}", "{site_title}", "{due_date}", "{fullname}");*/
						$result = array("{invoice_id}", "{hotel_name}" ,"{invoice_code}", "{deposit_amount}", "{total_amount}", "{customer_email}", "{customer_id}", "{country}", "{phone}", "{currency_code}", "{currency_sign}", "{invoice_link}", "{site_title}", "{remaining_amount}", "{fullname}","{room_name}","{date}","{checkin}","{checkout}","{no_of_room}","{thumbnail}","{booking_adults}","{room_price}","{couponRate}","{additionaNotes}");
				}
				elseif ($template == "bookingpaidcustomer") {
						$result = array("{invoice_id}", "{hotel_name}" ,"{invoice_code}", "{deposit_amount}", "{total_amount}", "{customer_email}", "{customer_id}", "{country}", "{phone}", "{currency_code}", "{currency_sign}", "{invoice_link}", "{site_title}", "{remaining_amount}", "{fullname}","{room_name}","{date}","{checkin}","{checkout}","{no_of_room}","{thumbnail}","{booking_adults}","{room_price}","{couponRate}","{additionaNotes}");

						
				}
				elseif ($template == "verifyaccount") {
						$result = array("{fullname}", "{email}", "{password}", "{loginurl}");
				}elseif ($template == "verifycustomeraccount") {
						$result = array("{fullname}", "{email}", "{password}", "{loginurl}");
				}
				elseif ($template == "supplierregisteradmin") {
						$result = array("{fullname}", "{email}", "{address}", "{phone}");
				}elseif ($template == "customerregisteradmin") {
						$result = array("{fullname}", "{email}", "{address}", "{phone}");
				}
				elseif ($template == "customersignup") {
						$result = array("{fullname}", "{email}", "{password}");
				}
				return $result;
		}

		function send_contact_email($to, $data) {

				$from = $data['contact_email'];
				$subject = "Contact From Website: ".$data['contact_name'] . " - ";
				$subject .= $data['contact_subject'];

				$msg = $this->mailHeader;
				$msg .= $data['contact_message'];
				$msg .= $this->mailFooter;

				$this->email->set_newline("\r\n");
				$this->email->from($from);
				$this->email->to($to);
				$this->email->subject($subject);
				$this->email->message($msg);
				return $this->email->send();
		}
// special offers contact email
		function offerContactEmail() {
			$toemail = $this->input->post('toemail');
			$msg = $this->input->post('message');
			$phone = $this->input->post('phone');
			$name = $this->input->post('name');

			$message = $this->mailHeader;
			$message .= "Name: ".$name."<br>";
			$message .= "Phone: ".$phone."<br>";
			$message .= "Message: ".$msg."<br>";
			$message .= $this->mailFooter;

				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($toemail);
				$this->email->subject('Special Offer Contact Email');
				$this->email->message($message);
				if (!$this->email->send()) {
						//echo $this->email->print_debugger();
				}
				else {
						//echo 'Email sent';
				}
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
		
		
		function get_extra_details($id){
	        
	        $this->db->select('*');
	        $this->db->where('booking_id',$id);
	        /*$this->db->where('hotel_type',$b_type);*/
	        $invoiceData = $this->db->get('pt_book_extra')->result();
	       
	        return $invoiceData;        
	    }
		function html_template_booking($hotel_id,$invoiceid){
			/*error_reporting(E_ALL);*/
			$ptheme = pt_default_theme();
			$this->_config = config_item('theme');
			$uu = $this->_config['url'];
			$site_link = base_url();
			$this->load->helper('settings');
			$res = $this->settings_model->get_contact_page_details();
				$contact_phone = $res[0]->contact_phone;
				$contact_email = $res[0]->contact_email;
				$contact_address = $res[0]->contact_address;

            $footersocials = pt_get_footer_socials();
            /*/
            exit();*/
            foreach ($footersocials as $key => $value) {
             
              	if($value->social_name == 'Facebook'){
            		$fb_link = $value->social_link;
            	}
            	if($value->social_name == 'Twitter'){
            		$tw_link = $value->social_link;
            	}
        	}

        	

        	/*echo $hotel_id;*/
        	$this->db->select('hotel_latitude,hotel_longitude,hotel_desc,hotel_map_city,hotel_stars');
        	$this->db->where('hotel_id', $hotel_id);
        	$query = $this->db->get('pt_hotels');	
        	$hotel_data = $query->result();

        	$arrayInfo['checkIn'] = date("m/d/Y", strtotime("+1 days"));
        	$arrayInfo['checkOut'] = date("m/d/Y", strtotime("+2 days"));
        	$arrayInfo['adults'] = '1';
        	$arrayInfo['child'] = '';
        	$arrayInfo['room'] = '1';
        	/*error_reporting(E_ALL);*/
    		//$this->ci = & get_instance();
				// $this->db = $this->ci->db;
			$this->load->model('hotels/hotels_model');
        	
        	$local_hotels = $this->hotels_model->search_hotels_by_lat_lang($hotel_data[0]->hotel_latitude, $hotel_data[0]->hotel_longitude,$arrayInfo);

        	$top_hotel = '<div class="col-sm-12 hotels">';

        	for ($i=0; $i < count($local_hotels['hotels']) ; $i++) { 
        		if($i < 3){
        		$bb = $local_hotels['hotels'];
        		 $bb[$i]->title;
        		$top_hotel .= '<a class="col-sm-4" href="'.$bb[$i]->slug.'">
									<img class="img-responsive" src="'.$bb[$i]->thumbnail.'">
									<p>'.$this->custom_echo($bb[$i]->title, 15).'</p>
									<h4>'.$bb[$i]->currCode.$bb[$i]->price.'</h4>
								</a>';
        	} 
        }

        	$top_hotel .= '';
        	/*echo json_encode($local_hotels);*/

        	/*exit();
*/
			$email_temp_img =  $uu.$ptheme.'/email_temp_img/';
			$star_temp_img =  $uu.$ptheme.'/images/';
			/*echo $hotel_data[0]->hotel_stars;*/
			$aaa = '';
			for ($st_i=0; $st_i < 5 ; $st_i++) { 
                              	if($st_i < $hotel_data[0]->hotel_stars){
                              		$aaa .= '<img src="'.$star_temp_img.'/star-on.png">';
                              	}else{
                              		$aaa .= '<img src="'.$star_temp_img.'/star-off.png">';
                              	}
                              }
                              /*echo $aaa;
                              exit();*/
			$template = '
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>Tarzango</title>

<!-- Google fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">

<!-- font awesome -->
<link href="css/font-awesome.min.css" rel="stylesheet">

</head>

<body style=" background-color: #ffffff;color: #2c3e50;font-family: \'Roboto\', sans-serif;font-size: 15px;line-height: 1.42857; padding:0; margin:0;">
<div class="email" style="background-color: #f3f3f3;float: left; width: 100%;">
	<div class="container-main main_header" style="background: rgba(0, 0, 0, 0) none repeat scroll 0 0;padding:15px 0;width:100%">
		<div class="container" style="max-width: 1210px; width:100%; margin-left: auto;margin-right: auto;padding-left: 15px;padding-right: 15px;box-sizing: border-box;">
        	<div class="row" style=" margin-left: -15px;margin-right: -15px;">
				<div class="col-sm-12" style="box-sizing: border-box; min-height: 1px; padding-left: 15px;padding-right: 15px;position: relative; float:left; width:100%;">
					<div class="col-sm-12 email_logo" style=" margin-top: 15px;text-align: center; float:left; width:100%">
						<a href="#"><img class="" src="'.$email_temp_img.'email-page-logo.png"></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="email_body">
			<div class="container">
				<div class="col-sm-12">
					<div class="col-sm-2">
					
					</div>
					<div class="col-sm-8">
						<div class="col-sm-12 main-section">
							<img class="top-border" src="'.$email_temp_img.'email-top-gradient.png">
							<div class="confirmation-box">
								<h3>Your Booking by Tarzango is Confirmed!</h3>
								<a href="'.$site_link.'invoice/'.$invoiceid.'">Check Boking Details</a>
							</div>
							<div class="confirmation-number">
								<h4>CONFIRMATION NUMBER: <span>{invoice_code}</span></h4>
							</div>
							<img class="img-responsive las-vegas" src="{thumbnail}">
							<div class="address">
								<div class="row">
									<div class="col-sm-12">
										'.$aaa.'
									</div>
								</div>
								<h2>{hotel_name}</h2>
								<div class="checkin">
									<p class="add">'.$hotel_data[0]->hotel_map_city.'</p>
									<p class="call">(702) 388-2400</p>
								</div>
								<p class="address-text">'.$hotel_data[0]->hotel_desc.'</p>
							</div>
							<form class="" name="email" id="email" method="post">
								<div class="col-sm-6">
									<div class="form-group">
										<label for="name1">CONFIRMATION #</label>
										<input type="text" class="form-control first" id="name1" name="name1" value="{invoice_code}" disabled>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="room">ROOM RATE</label>
										<input type="text" class="form-control" id="room" name="name1" value="${room_price}" disabled>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="date1">CHECK IN</label>
										<input type="text" class="form-control date" id="date1" name="name1" value="{checkin}" disabled>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="date2">CHECK OUT</label>
										<input type="text" class="form-control date" id="date2" name="name1" value="{checkout}" disabled>
									</div>
								</div>
								<div class="col-sm-6	">
									<div class="form-group">
										<label for="rooms">ROOMS</label>
										<input type="text" class="form-control" id="rooms" name="name1" value="{no_of_room}" disabled>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="type">TYPE</label>
										<input type="text" class="form-control" id="type" name="name1" value="{room_name}" disabled>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="total">
										<h3>$ {total_amount}<span class="divider"> /</span><span> Total</span></h3>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="form-group pay_now">
										<label for="rooms">Pay now link</label>
										<a href="'.$site_link.'invoice/'.$invoiceid.'" target="_blank">
										<input type="text" class="form-control" id="rooms" name="name1" value="'.$site_link.'invoice/'.$invoiceid.'" >
										</a>
									</div>
								</div>
								</form>

								<div class="col-sm-12 map">
									 <a href="http://maps.google.com/?daddr={hotel_name}" target="_blank"> 
                                    <img border="0" src="https://maps.googleapis.com/maps/api/staticmap?center='.$hotel_data[0]->hotel_latitude.','.$hotel_data[0]->hotel_longitude.'&zoom=14&size=620x260&markers=size:mid%7Ccolor:red%7C'.$hotel_data[0]->hotel_latitude.','.$hotel_data[0]->hotel_longitude.'&key=AIzaSyAH65sTGsDsP4mMpmbHC8zqRiM1Qh07iL8" alt="Google map"></a>
								</div>
								<div>
									
										'.$top_hotel.'
								
								</div>
								<div class="col-sm-12 contact-box">
									<h3>Need Assistance?</h3>
										<img src="'.$email_temp_img.'call.png">
										<h3>'.$contact_phone.'</h3>
									<p>Confirmation Number: <span>{invoice_code}</span></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>
</div>
</body>
<footer class="email">
	<div class="col-sm-12">
		<a href="#"><img src="'.$email_temp_img.'email-footer-logo.png"></a>
		<p class="sitename">TARZANGO</p>
		<p class="footer-address">'.$contact_address.'</br>'.$contact_phone.'</p>
	</div>
</footer>
</html>';

/*echo $template;
exit();*/
return $template;
		}

}