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
				/*echo $message;
				exit();*/
		}


		function beta_test_email($to_email) {
			/*echo json_encode($details);
			exit();*/

				$res = $this->settings_model->get_contact_page_details();
				$contact_phone = $res[0]->contact_phone;
				$contact_email = $res[0]->contact_email;
				$contact_address = $res[0]->contact_address;
				$sento =  $details->contect_email;

				$ptheme = pt_default_theme();
				$this->_config = config_item('theme');
				$uu = $this->_config['url'];
				$email_temp_img =  $uu.$ptheme.'/email_temp_img/gb_email_temp_img/';
				$template = array('{contact_phone}','{contact_email}','{contact_address}','{email_temp_img}');
				$values = array($contact_phone,$contact_email,$contact_address,$email_temp_img);
				$HTML_DATA = file_get_contents( $uu.$ptheme.'/beta_test.html');
				$message = str_replace($template, $values, $HTML_DATA);

				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($to_email);
				$this->email->subject('Beta test email.');
				$this->email->message($message);
				$this->email->send();
		}



		function attraction_booking_paid_email($mydata,$att_data,$bookdata){

				$booking_total = $att_data[0]->booking_total;
				$booking_user = $att_data[0]->booking_user;
				$booking_checkin = $att_data[0]->booking_checkin;
				$booking_ref_no = $att_data[0]->booking_ref_no;
				$accounts_email = $att_data[0]->accounts_email;

				$address = $mydata->address;
				$lat = $mydata->lat;
				$long = $mydata->long;
				$address = $mydata->address;
				$thumbnail = $mydata->thumbnail;
				$attraction_name = $mydata->attraction_name;
				$adults = $mydata->adults;
				$child = $mydata->child;
				$guest_details = $mydata->guest_details;
				$child_details = $mydata->child_details;

				$description = $bookdata->paymentData->description;
				$code = $bookdata->agency->code;
				$comments = $bookdata->activities[0]->bundles[0]->comments[0]->text;


				$ptheme = pt_default_theme();
				$this->_config = config_item('theme');
				$uu = $this->_config['url'];
				$email_temp_img =  $uu.$ptheme.'/email_temp_img/gb_email_temp_img/';
				
				 for ($r_i=0; $r_i < $adults ; $r_i++) {
                  	$bb = $r_i;
                  	$cc = $r_i+1;
                  	$tickets .= '<p style="margin-top:30px; margin-bottom:30px;">
                	<span style="font-family:Verdana, Geneva, sans-serif; display:block; font-size:12px;padding:5px 0px; font-weight:600;color:#32c8fc">
                    	TICKET '.$cc.'
                    </span>
                    <span style="font-family:Verdana, Geneva, sans-serif;font-size:14px;padding:5px 0px; display:block; margin-top:10px; letter-spacing:1px; font-weight:600;color:#0c134f">
                    	'.$guest_details[$bb].'
                    </span>
                </p>
                 <hr />';
				}				
                if($child != ""){
                	 for ($c_i=$cc; $c_i < $child ; $c_i++) {
                	 	$bb = $c_i;
                  		$cc = $c_i+1;

                	 	$tickets .= ' <p style="margin-top:30px; margin-bottom:30px;">
                	<span style="font-family:Verdana, Geneva, sans-serif; display:block; font-size:12px;padding:5px 0px; font-weight:600;color:#32c8fc">
                    	TICKET '.$cc.'
                    </span>
                    <span style="font-family:Verdana, Geneva, sans-serif;font-size:14px;padding:5px 0px; display:block; margin-top:10px; letter-spacing:1px; font-weight:600;color:#0c134f">
                    	'.$child_details[$bb].'
                        
                    </span>
                </p>
                 <hr />';
                	 }
                }
               	$vouchers_total = $booking_total/$adults+$child;

                 for ($r_i=0; $r_i < $adults ; $r_i++) {
                  	$bb = $r_i;
                  	$cc = $r_i+1;
                  	$vouchers .= '<div style="background:url('.$email_temp_img.'box.jpg) center center no-repeat; height:240px; padding:20px;margin-top:10px;" class="tic_ex">
                  	<span style="margin-top: 30px;display:inline-block; float:left; height:180px; width:130px; position:relative; top:31px; border-right:2px dashed #ccc" class="zoo_aa">
                    	<img style="margin-top: 60px;" src="'.$email_temp_img.'rotatelogo.png" style="position:relative;left:40px;top:65px" />
                    </span>
                    <span style="display:inline-block; height:180px; width:346px; position:relative; top:31px; padding:20px 20px; padding-right:0" class="zoo_bb">
                    	<span style="font-family:Verdana, Geneva, sans-serif; display:block; text-transform:uppercase; font-size:12px;font-weight:600;color:#32c8fc">
                    		Tickets and excrusions 
                    	</span>
                        <h2 style="font-family:Verdana, Geneva, sans-serif;color:#0c134f; font-size:22px; margin-top:10px;">
                    		'.$attraction_name.'
                    	</h2>
                        <p style="margin:0 auto; padding:10px 0px;">
                    	<img src="'.$email_temp_img.'map.png" />
                        <span style="font-family:Verdana, Geneva, sans-serif; width:300px; display:inline-block; font-size:11px; color:#0c134f; vertical-align:top;">
                         '.$address.'
                         </span>
                        <span style="display:block; margin-top:10px">
                        	<img src="'.$email_temp_img.'user.png" /> <strong style="font-family:Verdana, Geneva, sans-serif;font-size:11px; font-weight:normal; color:#0c134f;position:relative; top:-5px;">'.$guest_details[$bb].'</strong>
                        </span>
                        <span style="font-family:Verdana, Geneva, sans-serif;display:inline-block;letter-spacing:1px; font-size:16px;padding:5px 0px; font-weight:500;color:#0c134f; margin-top:10px">
                    	1 adult (1 day pass)
                    </span>
                    <span style="font-family:Verdana, Geneva, sans-serif; font-size:20px; margin:0;float:right; font-weight:600; color:#32c8fc; margin-top:13px">$ '.$vouchers_total.'</span>
                    </p>
                    </span>
                    </div>';
                 }
                  if($child != ""){
                	 for ($c_i=$cc; $c_i < $child ; $c_i++) {
                	 	$bb = $c_i;
                  		$cc = $c_i+1;

                	 	$vouchers .= ' <div style="background:url('.$email_temp_img.'box.jpg) center center no-repeat; height:240px; padding:20px;margin-top:10px;" class="tic_ex">
                	 	<span style="margin-top: 30px;display:inline-block; float:left; height:180px; width:130px; position:relative; top:31px; border-right:2px dashed #ccc" class="zoo_aa">
                    	<img style="margin-top: 60px;" src="'.$email_temp_img.'rotatelogo.png" style="position:relative;left:40px;top:65px" />
                    </span>
                    <span style="display:inline-block; height:180px; width:346px; position:relative; top:31px; padding:20px 20px; padding-right:0" class="zoo_bb">
                    	<span style="font-family:Verdana, Geneva, sans-serif; display:block; text-transform:uppercase; font-size:12px;font-weight:600;color:#32c8fc">
                    		Tickets and excrusions 
                    	</span>
                        <h2 style="font-family:Verdana, Geneva, sans-serif;color:#0c134f; font-size:22px; margin-top:10px;">
                    		'.$attraction_name.'
                    	</h2>
                        <p style="margin:0 auto; padding:10px 0px;">
                    	<img src="'.$email_temp_img.'map.png" />
                        <span style="font-family:Verdana, Geneva, sans-serif; width:300px; display:inline-block; font-size:11px; color:#0c134f; vertical-align:top;">
                         '.$address.'
                         </span>
                        <span style="display:block; margin-top:10px">
                        	<img src="'.$email_temp_img.'user.png" /> <strong style="font-family:Verdana, Geneva, sans-serif;font-size:11px; font-weight:normal; color:#0c134f;position:relative; top:-5px;">'.$guest_details[$bb].'</strong>
                        </span>
                        <span style="font-family:Verdana, Geneva, sans-serif;display:inline-block;letter-spacing:1px; font-size:16px;padding:5px 0px; font-weight:500;color:#0c134f; margin-top:10px">
                    	1 child (1 day pass)
                    </span>
                    <span style="font-family:Verdana, Geneva, sans-serif; font-size:20px; margin:0;float:right; font-weight:600; color:#32c8fc; margin-top:13px">$ '.$vouchers_total.'</span>
                    </p>
                    </span>
                    </div>';
                	 }
                }
              
                 $map = '<div class="col-sm-12 map" style="width: 100%;padding-left: 0;float: left; box-sizing: border-box;min-height: 1px; padding-right:0px; position: relative;">
								 <a href="http://maps.google.com/?daddr={hotel_name}" target="_blank"> 
                                    <img style="width:100%;margin-bottom:30px" border="0" src="https://maps.googleapis.com/maps/api/staticmap?center='.$lat.','.$long.'&zoom=14&size=620x260&markers=size:mid%7Ccolor:red%7C'.$lat.','.$long.'&key=AIzaSyAH65sTGsDsP4mMpmbHC8zqRiM1Qh07iL8" alt="Google map"></a>
							</div>';


				$res = $this->settings_model->get_contact_page_details();
				$contact_phone = $res[0]->contact_phone;
				$contact_email = $res[0]->contact_email;
				$contact_address = $res[0]->contact_address;
				$sento =  $details->contect_email;

				

				$template = array('{contact_phone}','{contact_email}','{contact_address}','{email_temp_img}','{booking_total}','{booking_checkin}','{address}','{thumbnail}','{attraction_name}','{booking_ref_no}','{child}','{adults}','{description}','{code}','{comments}','{tickets}','{vouchers}','{map}');

				$values = array($contact_phone,$contact_email,$contact_address,$email_temp_img,$booking_total,$booking_checkin,$address,$thumbnail,$attraction_name,$booking_ref_no,$child,$adults,$description,$code,$comments,$tickets,$vouchers,$map);

				$HTML_DATA = file_get_contents( $uu.$ptheme.'/Attraction_booking_email.html');
				$message = str_replace($template, $values, $HTML_DATA);


				
				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($accounts_email);
				$this->email->subject('Your attraction is Confirmed!');
				$this->email->message($message);
				$this->email->send();
		}
	

		function invoice_ticket_email($mydata,$att_data,$bookdata) {
				
				$booking_total = $att_data[0]->booking_total;
				$booking_user = $att_data[0]->booking_user;
				$booking_checkin = $att_data[0]->booking_checkin;
				$booking_ref_no = $att_data[0]->booking_ref_no;
				$accounts_email = $att_data[0]->accounts_email;

				$address = $mydata->address;
				$lat = $mydata->lat;
				$long = $mydata->long;
				$address = $mydata->address;
				$thumbnail = $mydata->thumbnail;
				$attraction_name = $mydata->attraction_name;
				$adults = $mydata->adults;
				$child = $mydata->child;
				$guest_details = $mydata->guest_details;
				$child_details = $mydata->child_details;

				$description = $bookdata->paymentData->description;
				$code = $bookdata->agency->code;
				$comments = $bookdata->activities[0]->bundles[0]->comments[0]->text;


				$ptheme = pt_default_theme();
				$this->_config = config_item('theme');
				$uu = $this->_config['url'];
				$email_temp_img =  $uu.$ptheme.'/email_temp_img/gb_email_temp_img/';
				
				
               	$vouchers_total = $booking_total/$adults+$child;

                 for ($r_i=0; $r_i < $adults ; $r_i++) {
                  	$bb = $r_i;
                  	$cc = $r_i+1;
                  	$vouchers .= '<div style="background:url('.$email_temp_img.'box.jpg) center center no-repeat; height:240px; padding:20px;margin-top:10px;" class="tic_ex">
                  	<span style="margin-top: 30px;display:inline-block; float:left; height:180px; width:130px; position:relative; top:31px; border-right:2px dashed #ccc" class="zoo_aa">
                    	<img style="margin-top: 60px;" src="'.$email_temp_img.'rotatelogo.png" style="position:relative;left:40px;top:65px" />
                    </span>
                    <span style="display:inline-block; height:180px; width:346px; position:relative; top:31px; padding:20px 20px; padding-right:0" class="zoo_bb">
                    	<span style="font-family:Verdana, Geneva, sans-serif; display:block; text-transform:uppercase; font-size:12px;font-weight:600;color:#32c8fc">
                    		Tickets and excrusions 
                    	</span>
                        <h2 style="font-family:Verdana, Geneva, sans-serif;color:#0c134f; font-size:22px; margin-top:10px;">
                    		'.$attraction_name.'
                    	</h2>
                        <p style="margin:0 auto; padding:10px 0px;">
                    	<img src="'.$email_temp_img.'map.png" />
                        <span style="font-family:Verdana, Geneva, sans-serif; width:300px; display:inline-block; font-size:11px; color:#0c134f; vertical-align:top;">
                         '.$address.'
                         </span>
                        <span style="display:block; margin-top:10px">
                        	<img src="'.$email_temp_img.'user.png" /> <strong style="font-family:Verdana, Geneva, sans-serif;font-size:11px; font-weight:normal; color:#0c134f;position:relative; top:-5px;">'.$guest_details[$bb].'</strong>
                        </span>
                        <span style="font-family:Verdana, Geneva, sans-serif;display:inline-block;letter-spacing:1px; font-size:16px;padding:5px 0px; font-weight:500;color:#0c134f; margin-top:10px">
                    	1 adult (1 day pass)
                    </span>
                    <span style="font-family:Verdana, Geneva, sans-serif; font-size:20px; margin:0;float:right; font-weight:600; color:#32c8fc; margin-top:13px">$ '.$vouchers_total.'</span>
                    </p>
                    </span>
                    </div>';
                 }
                  if($child != ""){
                	 for ($c_i=$cc; $c_i < $child ; $c_i++) {
                	 	$bb = $c_i;
                  		$cc = $c_i+1;

                	 	$vouchers .= ' <div style="background:url('.$email_temp_img.'box.jpg) center center no-repeat; height:240px; padding:20px;margin-top:10px;" class="tic_ex">
                	 	<span style="margin-top: 30px;display:inline-block; float:left; height:180px; width:130px; position:relative; top:31px; border-right:2px dashed #ccc" class="zoo_aa">
                    	<img style="margin-top: 60px;" src="'.$email_temp_img.'rotatelogo.png" style="position:relative;left:40px;top:65px" />
                    </span>
                    <span style="display:inline-block; height:180px; width:346px; position:relative; top:31px; padding:20px 20px; padding-right:0" class="zoo_bb">
                    	<span style="font-family:Verdana, Geneva, sans-serif; display:block; text-transform:uppercase; font-size:12px;font-weight:600;color:#32c8fc">
                    		Tickets and excrusions 
                    	</span>
                        <h2 style="font-family:Verdana, Geneva, sans-serif;color:#0c134f; font-size:22px; margin-top:10px;">
                    		'.$attraction_name.'
                    	</h2>
                        <p style="margin:0 auto; padding:10px 0px;">
                    	<img src="'.$email_temp_img.'map.png" />
                        <span style="font-family:Verdana, Geneva, sans-serif; width:300px; display:inline-block; font-size:11px; color:#0c134f; vertical-align:top;">
                         '.$address.'
                         </span>
                        <span style="display:block; margin-top:10px">
                        	<img src="'.$email_temp_img.'user.png" /> <strong style="font-family:Verdana, Geneva, sans-serif;font-size:11px; font-weight:normal; color:#0c134f;position:relative; top:-5px;">'.$guest_details[$bb].'</strong>
                        </span>
                        <span style="font-family:Verdana, Geneva, sans-serif;display:inline-block;letter-spacing:1px; font-size:16px;padding:5px 0px; font-weight:500;color:#0c134f; margin-top:10px">
                    	1 child (1 day pass)
                    </span>
                    <span style="font-family:Verdana, Geneva, sans-serif; font-size:20px; margin:0;float:right; font-weight:600; color:#32c8fc; margin-top:13px">$ '.$vouchers_total.'</span>
                    </p>
                    </span>
                    </div>';
                	 }
                }
              

				$res = $this->settings_model->get_contact_page_details();
				$contact_phone = $res[0]->contact_phone;
				$contact_email = $res[0]->contact_email;
				$contact_address = $res[0]->contact_address;
				$sento =  $details->contect_email;

				

				$template = array('{contact_phone}','{contact_email}','{contact_address}','{email_temp_img}','{booking_total}','{booking_checkin}','{address}','{thumbnail}','{attraction_name}','{booking_ref_no}','{child}','{adults}','{description}','{code}','{comments}','{tickets}','{vouchers}','{map}');

				$values = array($contact_phone,$contact_email,$contact_address,$email_temp_img,$booking_total,$booking_checkin,$address,$thumbnail,$attraction_name,$booking_ref_no,$child,$adults,$description,$code,$comments,$tickets,$vouchers,$map);

				$HTML_DATA = file_get_contents( $uu.$ptheme.'/invoice_ticket.html');
				$message = str_replace($template, $values, $HTML_DATA);



				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($accounts_email);
				$this->email->subject('Attraction Vouchers');
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
			
			$currencycode = $details->currCode;
			$currencysign = $details->currSymbol;


				$total_amount = $details->checkoutTotal;
				 $abc = $details->Extra_data->normal_price - $total_amount;
                  if($abc < 0){
                    $save = '0';

                  }else{
                    $save = number_format($details->Extra_data->normal_price - $total_amount,0);
					}

				$id = $details->id;
				$itemid = $details->itemid;
				$custid = $details->bookingUser;
				$country = $details->userCountry;
				$name = $details->userFullName;
				$stars = $details->stars;
				$code = $details->code;
				$booking_adults = $details->Extra_data->adults;
				$child = $details->Extra_data->child;
				
				$phone = $details->userMobile;
				$paymethod = $details->paymethod;
				$invoiceid = $details->id;
				$refno = $details->code;
				$deposit = $details->subItem->price;
				$quantity = $details->subItem->quantity;
				$hotel_title = $details->subItem->title;
				$duedate = $details->expiry;
				$date = $details->date;
				$sendto = $details->accountEmail;

				$additionaNotes = $details->additionaNotes;

				$remaining = $details->remainingAmount;
				$HOTEL_NAME = $details->title;
				$location = $details->location;
				$room_name = $details->subItem->title;
				$booking_adults = $details->subItem->booking_adults;
				$room_price = $details->subItem->price;
				
				$checkin = $details->checkin;
				
				$checkout = $details->checkout;
				$couponRate = $details->couponRate;
				
				$date = date ( "m/d/Y" , strtotime ( "-1 day" , strtotime ( $details->checkin ) ) );
				$no_of_room  = $details->subItem->quantity;
				$thumbnail = str_replace("demo.tarzango.com/","tarzango.com/",$details->thumbnail);
				$hotel_id = $details->itemid;

				$guest_name = $details->Extra_data->guest_name;
				$guest_age = $details->Extra_data->guest_age;
				$chil = $details->Extra_data->child;
				$child_name = isset($details->Extra_data->child_name) ? $details->Extra_data->child_name : 0;
				$child_age = isset($details->Extra_data->child_age) ? $details->Extra_data->child_age : 0;
				
				$sitetitle = "";

				$invoicelink = "";
				
				$sendto =  $details->accountEmail;
				
				 $ptheme = pt_default_theme();
					$this->_config = config_item('theme');
					$uu = $this->_config['url'];
				$email_temp_img =  $uu.$ptheme.'/email_temp_img/gb_email_temp_img/';
				/*$template = $this->shortcode_variables("bookingpaidcustomer");
				$details = email_template_detail("bookingpaidcustomer");*/

				  $book_room = $no_of_room;
                  
                  $room_per_guest = $booking_adults / $book_room;
                  
                  for ($r_i=0; $r_i < $book_room ; $r_i++) {
                  	$cc = $r_i+1;
                  	$no_top_hotel .= '<li class="title" style="float: left; width: 100%; list-style-type: none; margin-left:0px;">
                    <p style="font-size: 11px;color: #a5a6b4;padding-top: 15px;margin-left: -30px;">ROOM '.$cc.'</p>
                  </li>';
	             for($g_d_a=0; $g_d_a < $room_per_guest; $g_d_a++){

	               $jj = $g_d_a + $r_i;
	               $dd = $guest_name[$jj];
	               $age = $guest_age[$jj];
	         

	              	$no_top_hotel .= '<li class="username" style="list-style-type: none;width: 100%;float:left;border-bottom: 1px solid #e6e7ed; margin-left:0px; ">
		                    <h5 class="left" style="font-size: 16px;color: #0c134f;float: left;    margin-left: -30px;">'.$dd.'</h5>
                     		<h5 class="right" style="float:right;font-size: 16px;color: #0c134f;margin-right: 5px;">'.$age.' Years</h5>
		                  </li>';
	                  }
                  }

                  if($chil > 0){
	              $no_top_hotel .= ' <li class="title" style="float: left; width: 100%; list-style-type: none; margin-left:0px; ">
                   				 <p style="font-size: 11px;color: #a5a6b4;padding-top: 15px;">CHILD DETAILS</p>
                 				 </li>';
                 	 for($c_i=0;$c_i<$chil;$c_i++){
                 	 	 $ii = $c_i;
	             		 $child_name1 = $child_name[$ii];
	              		 $child_age1= $child_age[$ii];
                 	 	
                 	 	 $no_top_hotel .= '<li class="username" style="list-style-type: none;width: 96%;float:left;border-bottom: 1px solid #e6e7ed; margin-left:0px;">
                   			<h5 class="left" style="font-size: 16px;color: #0c134f;float: left;    margin-left: -30px;">'.$child_name1.'</h5>
                    		<h5 class="right" style="font-size: 16px;color: #0c134f;float: right;margin-right: 5px;"><img src="'.$email_temp_img.'paynow_icon8.png"> '.$child_age1.' Years</h5>
                  			</li>';
                 	}
                 }

                 	$this->db->select('hotel_latitude,hotel_longitude,hotel_desc,hotel_map_city,hotel_stars');
		        	$this->db->where('hotel_id', $itemid);
		        	$query = $this->db->get('pt_hotels');	
		        	$hotel_data = $query->result();

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
		        		 $image = str_replace("demo.tarzango.com/","tarzango.com/",$bb[$i]->thumbnail);
		        		$bb = $local_hotels['hotels'];
		        		 $bb[$i]->title;
		        		$top_hotel .= '<a class="col-sm-4" href="'.$bb[$i]->slug.'" style="margin-left: 2%;padding:10px;text-decoration: none; width:27.3333%;float: left; box-sizing: border-box;position: relative;">';
		        						if($image == ""){

											$top_hotel .= '<img height=185px class="img-responsive"  src="'.$uu.$ptheme.'/email_temp_img/gb_email_temp_img/email-d-lasvegas.png" style="width: 100%; min-height: 185px;   height: 185px; max-height: 185px;">';
										}else{

											$top_hotel .= '<img height=185px class="img-responsive" src="'.$image.'" style="width: 100%; min-height: 185px;   height: 185px; max-height: 185px;">';
										}

											$top_hotel .= '<p style="text-align:center;margin:0px;color: rgb(12, 19, 79);font-size: 14px;margin: 20px 0 10px;font-family: \'Roboto\',sans-serif;">'.$this->custom_echo($bb[$i]->title, 25).'</p>
											<h4 style=" text-align:center;margin:0px; color: rgb(28, 192, 251);font-size: 20px;font-weight: 600;font-family: \'Roboto\',sans-serif;">'.$bb[$i]->currCode.$bb[$i]->price.'</h4>
										</a>';
		        	} 
		        }

		        	$map = '<div class="col-sm-12 map" style="width: 100%;padding-left: 0;float: left; box-sizing: border-box;min-height: 1px; padding-right:0px; position: relative;">
								 <a href="http://maps.google.com/?daddr={hotel_name}" target="_blank"> 
                                    <img style="width:100%" border="0" src="https://maps.googleapis.com/maps/api/staticmap?center='.$hotel_data[0]->hotel_latitude.','.$hotel_data[0]->hotel_longitude.'&zoom=14&size=620x260&markers=size:mid%7Ccolor:red%7C'.$hotel_data[0]->hotel_latitude.','.$hotel_data[0]->hotel_longitude.'&key=AIzaSyAH65sTGsDsP4mMpmbHC8zqRiM1Qh07iL8" alt="Google map"></a>
							</div>';

				$res = $this->settings_model->get_contact_page_details();
				$contact_phone = $res[0]->contact_phone;
				$contact_email = $res[0]->contact_email;
				$contact_address = $res[0]->contact_address;

				

				$template = array("{invoice_id}", "{hotel_name}", "{stars}", "{location}", "{code}","{invoice_code}", "{deposit_amount}", "{total_amount}", "{customer_email}", "{customer_id}", "{country}", "{phone}", "{currency_code}", "{currency_sign}", "{invoice_link}", "{site_title}", "{remaining_amount}", "{fullname}","{room_name}","{date}","{checkin}","{checkout}","{no_of_room}","{thumbnail}","{booking_adults}","{room_price}","{couponRate}","{additionaNotes}","{email_temp_img}","{quantity}","{hotel_title}","{booking_adults}","{child}","{no_top_hotel}","{top_hotel}","{map}","{aaa}","{save}");
				//$smsdetails = sms_template_detail("bookingpaidcustomer");
				$values = array($invoiceid, $HOTEL_NAME, $stars, $location, $code, $refno, $deposit, $total_amount, $sendto, $custid, $country, $phone, $currencycode, $currencysign, $invoicelink, $sitetitle, $remaining , $name, $room_name, $date, $checkin, $checkout, $no_of_room, $thumbnail,$booking_adults,$room_price,$couponRate,$additionaNotes,$email_temp_img, $quantity,$hotel_title,$booking_adults,$child,$no_top_hotel,$top_hotel,$map,$aaa,$save);

				$HTML_DATA = file_get_contents( $uu.$ptheme.'/invoice.html');
				$message = str_replace($template, $values, $HTML_DATA);

				/*print_r($message);
				exit();*/
				/*$message = $this->mailHeader;*/
				/*echo '<pre>'.json_encode($message).'</pre>';
				exit();*/
				/*$details = $this->html_template_booking($hotel_id,$invoiceid);
				$message .= str_replace($template, $values, $details);*/
				//$message .= $this->mailFooter;
				/*echo $message;
				exit;*/
				//$smsmessage = str_replace($template, $values, $smsdetails[0]->temp_body);
				//sendsms($smsmessage, $phone, "bookingpaidcustomer");
				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($sendto);
				$this->email->subject('Thanks for Booking at the '.$HOTEL_NAME);
				$this->email->message($message);
				$this->email->send();
				
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
				$message .= "Your  booking has been cancelled.<br>";
				$message .= "Thanks For using our service.";
				$message .= $this->mailFooter;

				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($useremail);
				$this->email->subject('Your Booking Cancellation has been Processed.');
				$this->email->message($message);
				$this->email->send();
		}

		function booking_cancellation_email_cust($useremail, $bookingid) {

				/*echo $this->sendfrom;
				echo $useremail->accountEmail;
				// /print_r($useremail);
				exit();*/
				$res = $this->settings_model->get_contact_page_details();
				$contact_phone = $res[0]->contact_phone;
				$contact_email = $res[0]->contact_email;
				$contact_address = $res[0]->contact_address;
				$sento =  $details->contect_email;

				$ptheme = pt_default_theme();
				$this->_config = config_item('theme');
				$uu = $this->_config['url'];
				$email_temp_img =  $uu.$ptheme.'/email_temp_img/gb_email_temp_img/';
				$template = array('{bookingID}','{email_temp_img}','{hotel_name}','{state}','{checkin}','{checkout}','{userFullName}','{contact_phone}','{contact_email}','{contact_address}');
				$values = array($useremail->bookingID,$email_temp_img,$useremail->subItem->title,$useremail->title,$useremail->checkin,$useremail->checkout,$useremail->userFullName,$contact_phone,$contact_email,$contact_address);
				$HTML_DATA = file_get_contents( $uu.$ptheme.'/cancelled_email.html');
				$message = str_replace($template, $values, $HTML_DATA);

				
				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($useremail->accountEmail);
				$this->email->subject('Your Booking Cancellation has been Processed.');
				$this->email->message($message);
				$this->email->send();

			/*//to customer
				$message = $this->mailHeader;
				$message .= "Dear Customer,<br>";
				$message .= "Your Booking ID: $bookingid booking has been cancelled.<br>";
				$message .= "Thanks For using our service.";
				$message .= $this->mailFooter;

				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($useremail);
				$this->email->subject('Your Booking Cancellation has been Processed.');
				$this->email->message($message);
				$this->email->send();*/
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
				/*$template = $this->shortcode_variables("forgotpassword");
				$details = email_template_detail("forgotpassword");
				//$smsdetails = sms_template_detail("forgotpassword");
				$values = array($to, $newpass);
				$message = $this->mailHeader;
				$message .= str_replace($template, $values, $details[0]->temp_body);
				$message .= $this->mailFooter;*/

				
				$res = $this->settings_model->get_contact_page_details();
				$contact_phone = $res[0]->contact_phone;
				$contact_email = $res[0]->contact_email;
				$contact_address = $res[0]->contact_address;

				$sendto =  $details->contect_email;
				$ptheme = pt_default_theme();
				$this->_config = config_item('theme');
				$uu = $this->_config['url'];
				$email_temp_img =  $uu.$ptheme.'/email_temp_img/gb_email_temp_img/';
				$template = array('{to}','{newpass}','{email_temp_img}','{contact_phone}','{contact_email}','{contact_address}');
				$values = array($to,$newpass,$email_temp_img,$contact_phone,$contact_email,$contact_address,$values, $details[0]->temp_body);
				$HTML_DATA = file_get_contents( $uu.$ptheme.'/reset_password.html');
				$message = str_replace($template, $values, $HTML_DATA);

				//$smsmessage = str_replace($template, $values, $smsdetails[0]->temp_body);
				//sendsms($smsmessage, $phone, "forgotpassword");
				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($to);
				$this->email->subject('Your Lost Login Information');
				$this->email->message($message);
				$this->email->send();
				/*show_error($this->email->print_debugger());
				*/
		}
		function change_userAccount_password($to, $phone) {
				/*$template = $this->shortcode_variables("forgotpassword");
				$details = email_template_detail("forgotpassword");
				//$smsdetails = sms_template_detail("forgotpassword");
				$values = array($to, $newpass);
				$message = $this->mailHeader;
				$message .= str_replace($template, $values, $details[0]->temp_body);
				$message .= $this->mailFooter;*/

				
				$res = $this->settings_model->get_contact_page_details();
				$contact_phone = $res[0]->contact_phone;
				$contact_email = $res[0]->contact_email;
				$contact_address = $res[0]->contact_address;
				$contact_us = base_url().'/contact-us';

				$sendto =  $details->contect_email;
				$ptheme = pt_default_theme();
				$this->_config = config_item('theme');
				$uu = $this->_config['url'];
				$email_temp_img =  $uu.$ptheme.'/email_temp_img/gb_email_temp_img/';
				
				$template = array('{to}','{email_temp_img}','{contact_phone}','{contact_email}','{contact_address}','{contact_us_url}','{contact_us}');
				$values = array($to,$email_temp_img,$contact_phone,$contact_email,$contact_address,$values, $details[0]->temp_body,$contact_us_url,$contact_us);
				$HTML_DATA = file_get_contents( $uu.$ptheme.'/change_password.html');
				$message = str_replace($template, $values, $HTML_DATA);

				//$smsmessage = str_replace($template, $values, $smsdetails[0]->temp_body);
				//sendsms($smsmessage, $phone, "forgotpassword");
				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($to);
				$this->email->subject('Your Tarzango Password has been chanaged Successfully');
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

				$res = $this->settings_model->get_contact_page_details();
				$contact_phone = $res[0]->contact_phone;
				$contact_email = $res[0]->contact_email;
				$contact_address = $res[0]->contact_address;
				$accountlink = base_url().'/account';
				$membershiplink = base_url().'/membership';

				$sendto =  $details->contect_email;
				$ptheme = pt_default_theme();
				$this->_config = config_item('theme');
				$uu = $this->_config['url'];
				$email_temp_img =  $uu.$ptheme.'/email_temp_img/gb_email_temp_img/';
				$template = array('{fullname}','{password}','{email_temp_img}','{contact_phone}','{contact_email}','{contact_address}','{accountlink}','{membershiplink}');
				$values = array($fullname,$password,$email_temp_img,$contact_phone,$contact_email,$contact_address,$accountlink,$membershiplink);
				$HTML_DATA = file_get_contents( $uu.$ptheme.'/login_email.html');
				$message = str_replace($template, $values, $HTML_DATA);
				
				$this->email->set_newline("\r\n");
				$this->email->from($this->sendfrom);
				$this->email->to($email);
				$this->email->subject($details[0]->temp_subject);
				$this->email->message($message);
				$this->email->send();

				/*$phone = $edata['mobile'];
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
				$this->email->send();*/

		}

		function signupEmail_VIP($id) {

				$this->load->model('accounts_model');
				$edata = $this->accounts_model->get_profile_details($id);

				 $email = $edata[0]->accounts_email;
				/* echo ($email);
				echo json_encode($edata);
				exit();*/
				
				$password = $edata['password'];
				
				$fullname = $edata['ai_first_name']." ".$edata['ai_last_name'];
				
				$template = $this->shortcode_variables("customersignup");
				$details = email_template_detail("customersignup");

				$res = $this->settings_model->get_contact_page_details();
				$contact_phone = $res[0]->contact_phone;
				$contact_email = $res[0]->contact_email;
				$contact_address = $res[0]->contact_address;
				$accountlink = base_url().'/account';
				$membershiplink = base_url().'/membership';

				$sendto =  $details->contect_email;
				$ptheme = pt_default_theme();
				$this->_config = config_item('theme');
				$uu = $this->_config['url'];
				$email_temp_img =  $uu.$ptheme.'/email_temp_img/gb_email_temp_img/';
				$template = array('{email}','{password}','{email_temp_img}','{contact_phone}','{contact_email}','{contact_address}','{accountlink}','{membershiplink}');
				$values = array($email,$password,$email_temp_img,$contact_phone,$contact_email,$contact_address,$accountlink,$membershiplink);
				$HTML_DATA = file_get_contents( $uu.$ptheme.'/vip_email.html');
				$message = str_replace($template, $values, $HTML_DATA);
				/*print_r($uu.$ptheme.'/vip_email.html');
				exit;*/
				
				
				$this->email->from($this->sendfrom);
				$this->email->to($email);
				$this->email->subject('Welcome to tarzango as VIP Member');
				$this->email->message($message);
				$this->email->send();

				/*$phone = $edata['mobile'];
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
				$this->email->send();*/

		}

//send newsletter
		function sendNewsletter($message, $subject, $to) {

				$msg = $this->mailHeader;
				$msg .= $message;
				$msg .= $this->mailFooter;
				
				$this->email->from($this->sendfrom);
				$this->email->to($to);
				$this->email->subject($subject);
				$this->email->message($message);
				$this->email->send();
		}
		function sendNewsletter_sub($to, $from){

				$ptheme = pt_default_theme();
				$this->_config = config_item('theme');
				$uu = $this->_config['url'];

				$res = $this->settings_model->get_contact_page_details();
				$contact_phone = $res[0]->contact_phone;
				$contact_email = $res[0]->contact_email;
				$contact_address = $res[0]->contact_address;

				$accountlink = base_url().'/account';
				$email_temp_img =  $uu.$ptheme.'/email_temp_img/gb_email_temp_img/';
				$template = array('{contact_phone}','{contact_email}','{contact_address}','{email_temp_img}','{accountlink}');
				$values = array($contact_phone,$contact_email,$contact_address,$email_temp_img,$accountlink);
				$HTML_DATA = file_get_contents( $uu.$ptheme.'/newsletter.html');
				$message = str_replace($template, $values, $HTML_DATA);
				/*echo "AsdaS";
				echo $message;
				exit();*/
				$this->email->from($from);
				$this->email->to($to);
				$this->email->subject('Newsletter Subscription');
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

				/*echo $to;
				print_r($data);
				exit();*/

				$from = $data['contact_email'];
				$subject = "Contact From Website: ".$data['contact_name'] . " - ";
				$subject .= $data['contact_subject'];

			/*	$msg = $this->mailHeader;
				$msg .= $data['contact_message'];
				$msg .= $this->mailFooter;*/

				$res = $this->settings_model->get_contact_page_details();
				$contact_phone = $res[0]->contact_phone;
				$contact_email = $res[0]->contact_email;
				$contact_address = $res[0]->contact_address;

				$sendto =  $details->contect_email;
				 $ptheme = pt_default_theme();
					$this->_config = config_item('theme');
					$uu = $this->_config['url'];
				
				$email_temp_img =  $uu.$ptheme.'/email_temp_img/gb_email_temp_img/';
                $template = array('{name}','{check_in}','{check_out}','{link}','{email_temp_img}','{city}','{state}','{aprx_rooms}','{contact_phone}','{contact_email}','{contact_address}','{top_hotel}');
				$values = array($details->contect_name,$details->check_in,$details->check_out,$details->link_gen,$email_temp_img,$details->city,$details->state,$details->aprx_rooms,$contact_phone,$contact_email,$contact_address,$top_hotel);
				
				$HTML_DATA = file_get_contents( $uu.$ptheme.'/contact_us.html');
				$message = str_replace($template, $values, $HTML_DATA);
					/*echo "string";
					echo $message;
					exit();*/

				$this->email->set_newline("\r\n");
				$this->email->from($to);
				$this->email->to($from);
				$this->email->subject('Contact us confirmation');
				$this->email->message($message);
				return $this->email->send();
		}
		function send_contact_email_admin($to, $data) {

				$from = $data['contact_email'];
				$subject = "Contact From Website: ".$data['contact_name'] . " - ";
				$subject .= $data['contact_subject'];

				$msg = $this->mailHeader;
				$msg .= '<br> User Name: '.$data['contact_name'].'<br>';
				$msg .= 'User Email: '.$data['contact_email'].'<br>';
				$msg .= 'User Message: '.$data['contact_message'].'<br>';
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
				$this->email->subject($subject);
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
        		$top_hotel .= '<a class="col-sm-4" href="'.$bb[$i]->slug.'" style="padding: 0 5px;text-decoration: none; width:33.3333%;float: left; box-sizing: border-box;position: relative;">
									<img class="img-responsive" src="'.$bb[$i]->thumbnail.'" style="width: 100%; max-width:100%;">
									<p style="color: rgb(12, 19, 79);font-size: 14px;margin: 20px 0 10px;font-family: \'Roboto\',sans-serif;">'.$this->custom_echo($bb[$i]->title, 15).'</p>
									<h4 style="  color: rgb(28, 192, 251);font-size: 20px;font-weight: 600;font-family: \'Roboto\',sans-serif;">'.$bb[$i]->currCode.$bb[$i]->price.'</h4>
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
<link href="'.$uu.$ptheme.'css/font-awesome.min.css" rel="stylesheet">

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
	<div class="email_body" style=" background-color: rgba(0, 0, 0, 0); float: left;padding: 0; position: relative;width: 100%;">
			<div class="container" style="margin-left: auto;margin-right: auto;padding-left: 15px; padding-right: 15px;max-width: 1210px;width: 100%;box-sizing: border-box;">
				<div class="col-sm-12" style="float: left; box-sizing: border-box;min-height: 1px; padding-left: 15px;padding-right: 15px;position: relative;width:100%;">
					
					<div class="col-sm-12" style=" padding: 0 5%;float: left;  box-sizing: border-box;min-height: 1px;position: relative; width: 66.6667%;">
						<div class="col-sm-12 main-section" style="margin: 20px 0 0;padding: 0;width: 100%; float: left;box-sizing: border-box;min-height: 1px;position: relative;">
							<img src="'.$email_temp_img.'email-top-gradient.png" style=" float: left;width: 100%;">
							<div class="confirmation-box" style=" background-color: #ffffff;border: 1px solid #d8d9e1;float: left;padding: 90px 40px;text-align: center;width: 100%; box-sizing: border-box;">
								<h3 style="color: #352068;font-size: 24px;font-weight: 600;letter-spacing: 1px;margin: 0 0 15px;font-family: \'Roboto\',sans-serif;">Your Booking by Tarzango is Confirmed!</h3>
								<a href="" style="color: #1cc0fb; font-size: 14px;text-decoration: underline;font-family: \'Roboto\',sans-serif;">Check Boking Details</a>
							</div>
							<div class="confirmation-number" style="float: left;text-align: center; width: 100%;background-repeat: no-repeat; background-image:url('.$email_temp_img.'email-conf-bg.png); background-size:100% 100%; ">
								<h4 style="color: #ffffff; font-size: 14px;font-weight: 400;letter-spacing: 1px;line-height: 22px;padding: 30px 0;text-transform: uppercase;font-family: \'Roboto\',sans-serif;">CONFIRMATION NUMBER: <span style="font-weight: 600;font-family: \'Roboto\',sans-serif;">{invoice_code}</span></h4>
							</div>
							<img class="img-responsive las-vegas" src="{thumbnail}" style="width: 100%; max-width:100%; float:left;">
							<div class="address" style="background-color: #ffffff;border: 1px solid #d8d9e1;float: left;padding: 30px 50px;width: 100%; box-sizing:border-box;">
								<div class="row" style=" margin-left: -15px;margin-right: -15px;">
									<div class="col-sm-12" style="text-align: center;  padding: 0; float: left;ox-sizing: border-box;min-height: 1px;position: relative; width: 100%;">
										'.$aaa.'
									</div>
								</div>
								<h2 style=" color: #0c134f;font-size: 36px;font-weight: 600;text-align: center; margin-bottom: 10.5px;margin-top: 21px;font-family: \'Roboto\',sans-serif;">{hotel_name}</h2>
								<div class="checkin" style="float: left;padding: 15px 6%;text-align: center;width: 100%; box-sizing:border-box;">
									<p class="add" style="background-image:url('.$email_temp_img.'checkin.png); background-repeat:no-repeat; background-position:left center; float: left;padding: 0 10px 0 25px;color: #0c134f;float: left;font-size: 14px; line-height:24px;margin-top:0; font-family: \'Roboto\',sans-serif;">'.$hotel_data[0]->hotel_map_city.'</p>
									<p class="call" style="background-image:url('.$email_temp_img.'email-call.png); background-repeat:no-repeat; background-position:left center; float: left;padding: 0 10px 0 30px;color: #0c134f;float: left;font-size: 14px; line-height:24px;margin-top:0; margin-left:20px; font-family: \'Roboto\',sans-serif;">(702) 388-2400</p>
								</div>
								<p class="address-text" style=" color: rgb(12, 19, 79);font-size: 13px; line-height: 25px;font-family: \'Roboto\',sans-serif;">'.$hotel_data[0]->hotel_desc.'</p>
							</div>
							<form class="" name="email" id="email" method="post" style="background-color: rgb(250, 250, 252);border: 1px solid rgb(216, 217, 225); float: left;padding: 50px 50px 30px;width: 100%;box-sizing: border-box;">
								<div class="col-sm-6" style="margin-left: 30px;padding-left: 0;float: left; box-sizing: border-box;min-height: 1px; padding-right: 15px; position: relative;width: 44%;">
									<div class="form-group" style="margin-bottom: 25px;">
										<label for="name1" style="color: rgb(52, 45, 108);font-size: 12px;font-weight: 600;line-height: 20px;margin: 0 0 10px;  box-sizing: border-box;font-family: \'Roboto\',sans-serif;">CONFIRMATION #</label>
										<input type="text" class="form-control first" id="name1" name="name1" value="{invoice_code}" disabled style="background-color: rgb(52, 45, 108); color: rgb(255, 255, 255) !important;font-size: 14px !important;text-align: center;cursor: not-allowed;border-radius: 4px; font-weight: 600;	  width: 75%; border: 1px solid rgb(211, 212, 224) !important;height: 35px !important;padding: 15px 25px !important; box-sizing: border-box;font-family: \'Roboto\', sans-serif;">
									</div>
								</div>
								<div class="col-sm-6" style="padding-left: 0;float: left; box-sizing: border-box;min-height: 1px; padding-right: 15px; position: relative;width: 44%;">
									<div class="form-group" style="margin-bottom: 25px;">
										<label for="room" style="color: rgb(52, 45, 108);font-size: 12px;font-weight: 600;line-height: 20px;margin: 0 0 10px;  box-sizing: border-box;font-family: \'Roboto\',sans-serif;">ROOM RATE</label>
										<input type="text" class="form-control" id="room" name="name1" value="$ {room_price}" disabled style="background-color: rgb(230, 229, 237); border-radius: 4px;color: rgb(52, 45, 108) !important;font-size: 14px !important;font-weight: 600;text-align: center; width: 75%;cursor: not-allowed;border: 1px solid rgb(211, 212, 224) !important;height: 35px !important;padding: 15px 25px !important; color: rgb(55, 59, 113) !important;  box-sizing: border-box;font-family: \'Roboto\', sans-serif;">
									</div>
								</div>
								<div class="col-sm-6" style="margin-left:30px; padding-left: 0;float: left; box-sizing: border-box;min-height: 1px; padding-right: 15px; position: relative;width: 44%;">
									<div class="form-group" style="margin-bottom: 25px;">
										<label for="date1" style="color: rgb(52, 45, 108);font-size: 12px;font-weight: 600;line-height: 20px;margin: 0 0 10px;  box-sizing: border-box;font-family: \'Roboto\',sans-serif;">CHECK IN</label>
										<input type="text" class="form-control date" id="date1" name="name1" value="{checkin}" disabled style="background-color: rgb(230, 229, 237); border-radius: 4px;color: rgb(52, 45, 108) !important;font-size: 14px !important;font-weight: 600;text-align: center; width: 75%;cursor: not-allowed;border: 1px solid rgb(211, 212, 224) !important;height: 35px !important;padding: 15px 25px !important; color: rgb(55, 59, 113) !important;  box-sizing: border-box; background-image: url('.$email_temp_img.'calender.png);background-position: 90% 50%;background-repeat: no-repeat; font-family: \'Roboto\', sans-serif;">
									</div>
								</div>
								<div class="col-sm-6" style="padding-left: 0;float: left; box-sizing: border-box;min-height: 1px; padding-right: 15px; position: relative;width: 44%;">
									<div class="form-group" style="margin-bottom: 25px;">
										<label for="date2" style="color: rgb(52, 45, 108);font-size: 12px;font-weight: 600;line-height: 20px;margin: 0 0 10px;  box-sizing: border-box;font-family: \'Roboto\',sans-serif;">CHECK OUT</label>
										<input type="text" class="form-control date" id="date2" name="name1" value="{checkout}" disabled style="background-color: rgb(230, 229, 237); border-radius: 4px;color: rgb(52, 45, 108) !important;font-size: 14px !important;font-weight: 600;text-align: center; width: 75%;cursor: not-allowed;border: 1px solid rgb(211, 212, 224) !important;height: 35px !important;padding: 15px 25px !important; color: rgb(55, 59, 113) !important;  box-sizing: border-box;background-image: url('.$email_temp_img.'calender.png);background-position: 90% 50%;background-repeat: no-repeat; font-family: \'Roboto\', sans-serif;">
									</div>
								</div>
								
								<div class="col-sm-2" style="margin-left:30px;padding-left: 0;float: left; box-sizing: border-box;min-height: 1px; padding-right: 15px; position: relative;width:44%;">
									<div class="form-group" style="margin-bottom: 25px;">
										<label for="rooms" style="margin-left:30px; color: rgb(52, 45, 108);font-size: 12px;font-weight: 600;line-height: 20px;margin: 0 0 10px;  box-sizing: border-box;font-family: \'Roboto\',sans-serif;">ROOMS</label>
										<input type="text" class="form-control" id="rooms" name="name1" value="{no_of_room}" disabled style="background-color: rgb(230, 229, 237); border-radius: 4px;color: rgb(52, 45, 108) !important;font-size: 14px !important;font-weight: 600;text-align: center; width: 75%;cursor: not-allowed;border: 1px solid rgb(211, 212, 224) !important;height: 35px !important;padding: 15px 25px !important; color: rgb(55, 59, 113) !important;  box-sizing: border-box;font-family: \'Roboto\', sans-serif;">
									</div>
								</div>
								<div class="col-sm-5" style="padding-left: 0;float: left; box-sizing: border-box;min-height: 1px; padding-right: 15px; position: relative;width:41.6667%;">
									<div class="form-group" style="margin-bottom: 25px;">
										<label for="type" style="color: rgb(52, 45, 108);font-size: 12px;font-weight: 600;line-height: 20px;margin: 0 0 10px;  box-sizing: border-box;font-family: \'Roboto\',sans-serif;">TYPE</label>
										<input type="text" class="form-control" id="type" name="name1" value="{room_name}" disabled style="background-color: rgb(230, 229, 237); border-radius: 4px;color: rgb(52, 45, 108) !important;font-size: 14px !important;font-weight: 600;text-align: center; width: 80%;cursor: not-allowed;border: 1px solid rgb(211, 212, 224) !important;height: 35px !important;padding: 15px 25px !important; color: rgb(55, 59, 113) !important;  box-sizing: border-box;font-family: \'Roboto\', sans-serif;">
									</div>
								</div>
								
								
								<div class="col-sm-12" style="padding-left: 0;float: left; box-sizing: border-box;min-height: 1px; padding-right:0px; position: relative;width:100%;">
									<div class="total" style=" float: left;margin: 20px 0;text-align: center;width: 100%;">
										<h3 style=" color: rgb(28, 192, 251);font-size: 44px;font-weight: 600; margin: 0;text-align: center; font-family: \'Roboto\',sans-serif;">$ {total_amount}<span class="divider" style=" color: rgb(209, 209, 211);   font-size: 44px;font-weight: 100;line-height: 60px;margin: 0 15px 0 0;    text-align: center;font-family: \'Roboto\',sans-serif;"> /</span><span style=" color: rgb(209, 209, 211);font-size: 14px;line-height: 47px;margin: 0; text-align: center;vertical-align: bottom;font-family: \'Roboto\',sans-serif;"> Total</span></h3>
									</div>
								</div>
                                <div class="col-sm-12" style="padding-left: 0;float: left; box-sizing: border-box;min-height: 1px; padding-right:0px; position: relative;width:100%;">
                                <a href="'.$site_link.'invoice/'.$invoiceid.'" target="_blank">
									<div class="form-group pay_now" style="margin-bottom: 25px;">
										<label for="rooms" style="color: rgb(52, 45, 108);font-size: 12px;font-weight: 600;line-height: 20px;margin: 0 0 10px;  box-sizing: border-box; text-align: center;text-transform: uppercase;width: 100%;float: left;font-family: \'Roboto\',sans-serif;">Pay now link</label>
										<input type="text" class="form-control" id="rooms" name="name1" value="'.$site_link.'invoice/'.$invoiceid.'" disabled style="background-color: rgb(230, 229, 237); border-radius: 4px;color: rgb(52, 45, 108) !important;font-size: 14px !important;font-weight: 600;text-align: left; width: 90%;cursor: not-allowed;border: 1px solid rgb(211, 212, 224) !important;height: 35px !important;padding: 15px 25px !important; color: rgb(55, 59, 113) !important;  box-sizing: border-box;font-family: \'Roboto\', sans-serif;">
									</div>
									</a>
								</div>
                                <div class="col-sm-12" style="padding-left: 0;float: left; box-sizing: border-box;min-height: 1px; padding-right:0px; position: relative;width:100%;">
									<div class="cancelation_policy" style="float: left;width: 100%;">
										<h3 style="color: rgb(52, 45, 108);font-size: 12px;font-weight: 600;line-height: 25px;margin: 10px 0;text-transform: uppercase;font-family: \'Roboto\',sans-serif;">Cancellation Poli-cy</h3>
                                        <p style=" color: rgb(12, 19, 79);font-size: 13px;line-height: 25px;font-family: \'Roboto\',sans-serif;">Here at Tarzango, we offer a hassle free Cancellation Option. Last Minute change of plans? No problem mate! We allow 7 days prior to you arrival for cancellations, without any fees or penalties.*<br>For Cancellation Requests within 7 days of check in, any associated fees are at the hotel’s discretion. If applicable, we will refund 50% back to the cardholders card. Refunds will be issued between  24 to 48 hours after an email for cancellation has been sent and approved. To cancel your entire reservation,  or modify part of your reservation, please email cancel@tarzango.com. Please note: We can only accept cancellation via writing to: cancel@tarzango.com. Cancelations will not be submitted via phone or chat, only through written email to cancel@tarzango.com.!</p>
									</div>
								</div>
							</form>
							<div class="col-sm-12 map" style="padding-left: 0;float: left; box-sizing: border-box;min-height: 1px; padding-right:0px; position: relative;width:119%;">
								 <a href="http://maps.google.com/?daddr={hotel_name}" target="_blank"> 
                                    <img style="width:100%" border="0" src="https://maps.googleapis.com/maps/api/staticmap?center='.$hotel_data[0]->hotel_latitude.','.$hotel_data[0]->hotel_longitude.'&zoom=14&size=620x260&markers=size:mid%7Ccolor:red%7C'.$hotel_data[0]->hotel_latitude.','.$hotel_data[0]->hotel_longitude.'&key=AIzaSyAH65sTGsDsP4mMpmbHC8zqRiM1Qh07iL8" alt="Google map"></a>
							</div>
							<div class="col-sm-12 hotels" style=" background-color: rgb(250, 250, 252);border: 1px solid rgb(216, 217, 225);float: left;  padding: 30px 50px; text-align: center; width: 100%;box-sizing: border-box;">
								<p class="title" style=" color: rgb(53, 32, 104);font-size: 14px;font-weight: 600;margin: 10px 0 40px; font-family: \'Roboto\',sans-serif;">SIMILAR HOTELS</p>
								
								'.$top_hotel.'
							</div>
							<div class="col-sm-12 contact-box" style="background-color: rgb(252, 252, 255);border: 1px solid rgb(216, 217, 225);float: left;  padding: 50px 0;text-align: center;width: 100%;">
								<h3 style="color: rgb(52, 45, 108);font-size: 26px; margin: 0; font-family: \'Roboto\',sans-serif;">Need Assistance?</h3>
								<img src="'.$email_temp_img.'call.png" style=" margin: 30px 0;width: 30px;">
								<h3 style="color: rgb(52, 45, 108);font-size: 26px;margin: 0; font-weight: 400;font-family: \'Roboto\',sans-serif;">'.$contact_phone.'</h3>
								<p style="  color: rgb(184, 177, 200);font-size: 13px; margin: 20px 0 0; font-family: \'Roboto\',sans-serif;">Confirmation Number: <span style="color: rgb(28, 192, 251);">{invoice_code}</span></p>
							</div>
						</div>
					</div>
					
					
					</div>
				</div>
			</div>
	</div>
</div>
<footer class="email" style=" padding: 45px 0 50px;text-align: center;float: left;width: 100%;background-color: rgb(243, 243, 243);">
	<div class="col-sm-12" style="float: left;  box-sizing: border-box;min-height: 1px; padding-left: 15px; padding-right: 15px;position: relative;  width: 100%;">
		<a href="#"><img src="'.$email_temp_img.'email-footer-logo.png"></a>
		<p class="sitename" style=" color: rgb(139, 139, 139); font-size: 11px;font-weight: 600;letter-spacing: 2px;margin: 15px 0 5px;font-family: \'Roboto\',sans-serif;">TARZANGO</p>
		<p class="footer-address" style="color: rgb(139, 139, 139);font-size: 11px;letter-spacing: 1px;margin: 0;font-family: \'Roboto\',sans-serif;">'.$contact_address.'</br>'.$contact_phone.'</p>
	</div>
</footer>
</body>
</html>';

/*echo $template;
exit();*/
return $template;
		}

}