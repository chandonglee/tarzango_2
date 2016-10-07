<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*error_reporting(E_ALL);*/
class Car_hb_lib {

      	function __construct($_apiKey = "n2cxz49a5vd9u9verw3afva7" ,$_local = "en_US",$_currency = "$"){
            

      	}
        /*
         * function for API call using curl
         */
        function apiCall($post_data){
            
            $post_url='http://testapi.interface-xml.com/appservices/http/FrontendService';
            
            $header[] = "Content-Type: text/xml; charset=UTF-8";
            $header[] = "Content-Encoding: UTF-8";
            $header[] = "Accept-Encoding: gzip,deflate";
         
            $response = array();
            $ch = curl_init();
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
            
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
            curl_setopt( $ch, CURLOPT_URL, $post_url );
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt ($ch2, CURLOPT_ENCODING, "gzip,deflate");
            $response = curl_exec($ch);
            //$response = json_decode(curl_exec($ch),true);
            $curlinfo = curl_getinfo($ch);
           /* if(curl_exec($ch) === false)
            {
                echo 'Curl error: ' . curl_error($ch);
            }
            echo $response;
            exit();*/
            /*$response = '';*/
            return $response;

        }


        /*
         * funtion to get the list of hotels
         */
	       function Carlist_oneway($arrayInfo){

            $username = "TESTCHAINS";
            $password = "TESTCHAINS";
            


            $pickup_date = $arrayInfo['pickup_date'];
            $pickup_time_hour = $arrayInfo['pickup_time_hour'];
            $pickup_time_min = $arrayInfo['pickup_time_min'];
            $adult = $arrayInfo['adult'];
            $child = $arrayInfo['child'];
            $pickup_terminal = $arrayInfo['pickup_terminal'];
            $location_latitude = $arrayInfo['location_latitude'];
            $location_longitude = $arrayInfo['location_longitude'];
            $hoteltitle = $arrayInfo['hoteltitle'];
            $address = $arrayInfo['address'];
            $hotellocaion = $arrayInfo['hotellocaion'];
            $zipcode = $arrayInfo['zipcode'];
            $ccode = $arrayInfo['ccode'];


            $adult_cust = '';
            $child_cust = '';
            if ( $adult > 0){

                  for($ad=0; $ad < $adult; $ad++){
                      $adult_cust .= '<Customer type="AD">30</Customer>';
                  }
              }

              if ( $child > 0){
                  for($ch = 0; $ch < $child; $ch ++){
                      $child_cust .= '<Customer type="CH"></Customer>';
                  }
              }

            $hotel_beds_post = '<TransferValuedAvailRQ echoToken="DummyEchoToken"
                      sessionId="134132121"
                      xmlns="http://www.hotelbeds.com/schemas/2005/06/messages"
                      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                      xsi:schemaLocation="http://www.hotelbeds.com/schemas/2005/06/messages TransferValuedAvailRQ.xsd"
                      version="2013/12">
                      <Language>ENG</Language>
                      <Credentials>
                          <User>'.$username.'</User>
                          <Password>'.$password.'</Password>
                      </Credentials>
                      <AvailData type="IN">
                          <ServiceDate date="'.$pickup_date.'" time="'.$pickup_time_hour.$pickup_time_min.'" />
                          <Occupancy>
                              <AdultCount>'.$adult.'</AdultCount>
                              <ChildCount>'.$child.'</ChildCount>
                              <GuestList>'.
                              $adult_cust.
                              $child_cust.
                        '</GuestList>
                        </Occupancy>
                        <PickupLocation xsi:type="ProductTransferTerminal">
                            <Code>'.$pickup_terminal.'</Code>
                            <DateTime date="'.$pickup_date.'" time="'.$pickup_time_hour.$pickup_time_min.'" />
                        </PickupLocation>
                        <DestinationLocation xsi:type="ProductTransferGPSPoint">
                            <Coordinates latitude="'.$location_latitude.'" longitude="'.$location_longitude.'" />
                            <Description>'.$hoteltitle.'</Description>
                            <Address>'.$address.'</Address>
                            <City>'.$hotellocaion.'</City>
                            <ZipCode>'.$zipcode.'</ZipCode>
                            <Country>'.$ccode.'</Country>
                        </DestinationLocation>
                    </AvailData>
                    <ReturnContents>Y</ReturnContents>
                </TransferValuedAvailRQ>';

              /*var_dump($hotel_beds_post);
              exit();*/
              error_reporting(-1);
              echo "asdas";
              $my_file = 'test_xml_car.txt';

              $handle = fopen($my_file, 'w+');
              fwrite($handle, $hotel_beds_post);
              fclose($handle);
              echo $final_data1 = simplexml_load_string($hotel_beds_post);
              print_r($final_data1);
              exit();
            $car_data =  $this->apiCall($hotel_beds_post);
            
            $final_data = simplexml_load_string($car_data);
            
            return str_replace('@', '', json_encode($final_data));
	       }

 

     
}