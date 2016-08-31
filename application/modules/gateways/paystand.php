<?php


function paystand_config() {
	$configarray = array( "FriendlyName" => array( "Type" => "System", "Value" => "Paystand " ), "apiusername" => array( "FriendlyName" => "API Username", "Type" => "text", "Size" => "50", "Description" => "" ), "apipassword" => array( "FriendlyName" => "API Password", "Type" => "text", "Size" => "30" ), "apisignature" => array( "FriendlyName" => "API Signature", "Type" => "text", "Size" => "75" ), "sandbox" => array( "FriendlyName" => "Sandbox", "Type" => "yesno", "Description" => "Tick to enable test mode" ) );
	return $configarray;
}


function paystand_link($params) {

		/*$postfields = array();
		$postfields['PAYMENTREQUEST_0_PAYMENTACTION'] = "Sale";
		$postfields['PAYMENTREQUEST_0_AMT'] = $params['amount'];
		$postfields['PAYMENTREQUEST_0_CURRENCYCODE'] = $params['currency'];
		$postfields['PAYMENTREQUEST_0_CUSTOM'] = $params['invoiceid'];
		$postfields['PAYMENTREQUEST_0_DESC'] = "This is description";
		$postfields['L_PAYMENTREQUEST_0_AMT0'] = $params['amount'];
		$postfields['L_PAYMENTREQUEST_0_NAME0'] = $params['description'];
		$postfields['L_PAYMENTREQUEST_0_QTY0'] = "1";
		$postfields['RETURNURL'] = base_url(). "invoice?&id=".$params['invoiceid']."&sessid=".$params['invoiceref'];
		$postfields['CANCELURL'] = base_url(). "invoice?&id=".$params['invoiceid']."&sessid=".$params['invoiceref'];
		$results = paypalexpress_api_call( $params, "SetExpressCheckout", $postfields );
		$ack = strtoupper( $results['ACK'] );

		if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
			$token = $results['TOKEN'];
			$payerid = $results['PayerID'];
			$_SESSION['paypalexpress']['token'] = $token;
			$_SESSION['paypalexpress']['paymentAmount'] = $params['amount'];
			$_SESSION['paypalexpress']['invoiceid'] = $params['invoiceid'];

			$isMobile = isMobile();
			$target = "";
			if($isMobile){
				$target = "target = '_blank'";
			}

			$PAYPAL_URL = ($params['sandbox'] ? "https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&token=" : "https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=");
				$code = "<form action=\"" . $PAYPAL_URL . $token . "\" method=\"post\" " . $target . ">
						<input type=\"hidden\" name=\"paypalcheckout\" value=\"1\" />
						<input type=\"image\" class=\"paybtn\" name=\"submit\" src=\"https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif\" border=\"0\" align=\"top\" alt=\"Check out with PayPal\" />
						</form>";
				$code 

			return $code;
		}
		else {
			
			return print_r($results);
		}*/

		$base_u = base_url().'assets/img/paystand_logo.png';
		$link = '<a class="paystand_lick"  href="https://tarzango.paystand.com/" target="_blank" ><img src="<?php echo base_url()."assets/img/paystand_logo.png"; ?>"></a><script>$(".paystand_lick").click(function(){$(this).remove();$("body").removeClass("modal-open");$("#paynow").css("display","none");$(".modal-backdrop").css("display","none"); });<\/script>';
		return json_encode($link);

}

?>