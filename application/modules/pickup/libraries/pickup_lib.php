<?php

class Pickup_lib { 
/**
* Protected variables
*/
	protected $ci = NULL; //codeigniter instance
	protected $db; //database instatnce instance
	


	function __construct() {
			

	}

	function apiCall($url,$post_data){
           
        $url = str_replace(" ", '%20', $url);
        
        $sharedSecret = 'hggeuz3MDA';
        $apiKey = 'f9bbeebs72n6fdfduny2gnvp';
        $signature = hash("sha256", $apiKey.$sharedSecret.time());
        
        $header[] = "Accept: application/json";
        $header[] = "Content-Type: application/json";
        $header[] = "Api-key: ".$apiKey;
        $header[] = "X-Signature: ".$signature;
        
        $response = array();
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
        curl_setopt($ch,CURLOPT_ENCODING , "gzip");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $response = curl_exec($ch);
        
        $curlinfo = curl_getinfo($ch);
        /*if(curl_exec($ch) === false)
        {
            echo 'Curl error: ' . curl_error($ch);
        }*/
        /*echo $response;
        exit();*/
        return $response;

    }

    function apiCall_put($url,$post_data){
           
        $url = str_replace(" ", '%20', $url);
        
        $sharedSecret = 'hggeuz3MDA';
        $apiKey = 'f9bbeebs72n6fdfduny2gnvp';
        $signature = hash("sha256", $apiKey.$sharedSecret.time());
        
        $header[] = "Accept: application/json";
        $header[] = "Content-Type: application/json";
        $header[] = "Api-key: ".$apiKey;
        $header[] = "X-Signature: ".$signature;
        
        $response = array();
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
        curl_setopt($ch,CURLOPT_ENCODING , "gzip");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $response = curl_exec($ch);
        
        $curlinfo = curl_getinfo($ch);
        /*if(curl_exec($ch) === false)
        {
            echo 'Curl error: ' . curl_error($ch);
        }*/
        
        return $response;

    }

    function apiCall_get_trip($url){
            
            $ch = curl_init();
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
            curl_setopt($ch,CURLOPT_ENCODING , "gzip");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt( $ch, CURLOPT_URL, $url );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            //$response = curl_exec($ch);

            $curlinfo = curl_getinfo($ch);

            if(curl_exec($ch) === false)
            {
              $response = array();
                //echo 'Curl error: ' . curl_error($ch);
            }
            //$response = json_decode($response);
            //print_r($response);
            return $response;

    }



    function attraction_for_city($latitude,$longitude,$checkIn,$checkOut,$limit){
    	$datetime = new DateTime($checkIn);
        $checkIn =  $datetime->format('Y-m-d');

        $datetime = new DateTime($checkOut);
        $checkOut =  $datetime->format('Y-m-d');

        $searchitem['type'] = "gps";
        $searchitem['latitude'] = $latitude;
        $searchitem['longitude'] = $longitude;
        $post_data['filters'][]['searchFilterItems'][] = $searchitem;
        $post_data['from'] = $checkIn;
        $post_data['to'] = $checkOut;
        $post_data['language'] = "en";
        $post_data['pagination']['itemsPerPage'] = $limit;
        $post_data['pagination']['page'] = 1;
        $post_data['order'] = "DEFAULT";

        $url = 'https://api.test.hotelbeds.com/activity-api/3.0/activities';

        $attraction_data =  $this->apiCall($url,$post_data);
        $attraction_data = json_decode($attraction_data);
        $attraction_data = $attraction_data->activities;
        /*print_r($attraction_data);*/
        /*return */
        return $attraction_data;
    	
    }

    function attraction_by_code($code,$adults,$child,$checkIn,$child_allow){
        if($checkIn){
            $datetime = new DateTime($checkIn);
            $datetime->modify('+0 day');
            $datetime1 = new DateTime($checkIn);
            $datetime1->modify('+1 day');
        }else{
            $datetime = new DateTime('tomorrow');
            $datetime->modify('+0 day');
            $datetime1 = new DateTime('tomorrow');
            $datetime1->modify('+1 day');
        }

        $checkIn =  $datetime->format('Y-m-d');
        $checkOut =  $datetime1->format('Y-m-d');

        $post_data['code'] = $code;
        $post_data['from'] = $checkIn;
        $post_data['to'] = $checkOut;
        $post_data['language'] = "en";
        for ($i=0; $i < $adults ; $i++) { 
            $post_data['paxes'][]['age'] = 25;
        }
        if($child_allow == 1){
             for ($i=0; $i < $child ; $i++) { 
                $post_data['paxes'][]['age'] = 15;
            }
        }
        /*echo json_encode($post_data);*/
        $url = 'https://api.test.hotelbeds.com/activity-api/3.0/activities/details/full';
        
        $attraction_data =  $this->apiCall($url,$post_data);
       /* echo "<br>";
        echo "<br>";

        echo $attraction_data;
        exit();
        exit();*/
       /* exit();*/
        $attraction_data = json_decode($attraction_data);
        $attraction_data = $attraction_data->activity;
        /*print_r($attraction_data);*/

        /*return */
        return $attraction_data;
    	
    }

    function attraction_booking($input_data,$profile){
        
        /*echo json_encode($input_data);
        exit();*/
        $profile = (array)$profile[0];
        $datetime = new DateTime($input_data['checkin']);
        $datetime->modify('+0 day');
        $checkIn =  $datetime->format('Y-m-d');
        $post_data['language'] = 'en';
        $post_data['clientReference'] = 'TestAgenciaXisco';
        $post_data['holder']['name'] = $profile['ai_first_name'];
        $post_data['holder']['title'] = 'Mr';
        $post_data['holder']['email'] = $profile['accounts_email'];
        $post_data['holder']['address'] = $profile['ai_address_1'];
        $post_data['holder']['zipCode'] = $profile['ai_postal_code'];
        $post_data['holder']['mailing'] = true;
        $post_data['holder']['mailUpdDate'] = '2015-05-05';
        $post_data['holder']['country'] = $profile['ai_country'];
        $post_data['holder']['surname'] = $profile['ai_last_name'];
        $post_data['holder']['telephones'][] = $profile['ai_mobile'];

        $activities->preferedLanguage = 'en';
        $activities->serviceLanguage = 'en';
        $activities->rateKey = $input_data['rateKey'];
        $activities->from = $checkIn;
        $activities->to = $checkIn;
        $activities->paxes = array();

        $adults = $input_data['adults'];
        $child = $input_data['child'];

        for ($i=0; $i < count($input_data['guest_details']) ; $i++) { 
           $pax2[$i]['age'] = '25';
           $pax2[$i]['name'] = $input_data['guest_details'][$i];
           $pax2[$i]['type'] = 'ADULT';
           $pax2[$i]['surname'] = 'x';
        }

        for ($j=0; $j < count($input_data['kids_details']) ; $j++) { 
           $pax1[$j]['age'] = '15';
           $pax1[$j]['name'] = $input_data['kids_details'][$j];
           $pax1[$j]['type'] = 'CHILD';
           $pax1[$j]['surname'] = 'x';
        }

        $pax = array_merge($pax2,$pax1);
        $activities->paxes = $pax;        
        $post_data['activities'][] = $activities;

        $url = 'https://api.test.hotelbeds.com/activity-api/3.0/bookings';
        /*echo json_encode($post_data);
        echo "\n";*/
        /*exit();*/
        $booking_data =  $this->apiCall_put($url,$post_data);
        /*echo $booking_data;
        exit();*/

        return $booking_data;
    }

     function tripadvisor_review($latitude,$longitude,$attractions_name){
          /*echo $hotel_name;
          echo $latitude;
          echo $longitude;*/
          $api_key = '9c13b7bbcaab47118d769679511537a7';
          $attractions_name =  urlencode($attractions_name);
          $url = 'http://api.tripadvisor.com/api/partner/2.0/location_mapper/'.$latitude.','.$longitude.'?key='.$api_key.'-mapper&category=hotels&q='.$attractions_name;
          $res_data = $this->apiCall_get_trip($url);
          //echo $res_data;
          $res_data = json_decode($res_data);

          $location_id = $res_data->data[0]->location_id;
          

          $url1 = 'http://api.tripadvisor.com/api/partner/2.0/location/'.$location_id.'?key='.$api_key;
          $res_data_1 = $this->apiCall_get_trip($url1);

         /* $res_data_1 = json_decode($res_data_1);

          $reviews = $res_data_1->reviews;

          $reviews = json_encode($reviews);*/

          return $res_data_1;
            //http://api.tripadvisor.com/api/partner/2.0/location_mapper/36.169799,-115.143684?key=9c13b7bbcaab47118d769679511537a7-mapper&category=hotels&q=Four%20Queens%20Hotel%20%26%20Casino
            //http://api.tripadvisor.com/api/partner/2.0/location/91816?key=9c13b7bbcaab47118d769679511537a7     

        }

}