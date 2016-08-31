<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hb_lib {

        public  $cid;
        public  $ci;
        public  $rev;
    	  public  $apiKey;
        public  $local;
    	  public  $currency;
        public  $customerUserAgent;
        public  $customerIpAddress;
        public $apiurl;
        public $bookingurl;
        public $apistr;
        public $homePagePopularCity;
        public $homePagePopularCount;
        public $homePageFeaturedCity;
        public $homePageFeaturedCount;
        public $relatedCount;
        public $baseUrl;
        public $secret;
        public $sig;
        public $itinUrl;


      	function __construct($_apiKey = "n2cxz49a5vd9u9verw3afva7" ,$_local = "en_US",$_currency = "USD"){
            

      	}



        /*
         * function for API call using curl
         */
        function apiCall($url,$post_data){
            

           /* exit();*/
            $url = str_replace(" ", '%20', $url);
            $sharedSecret = 't8qZYfnceE';
            $apiKey = '7evpxa7utyytvj48y3fp75rj1';
            $signature = hash("sha256", $apiKey.$sharedSecret.time());
            $header[] = "Accept: application/json";
            $header[] = "Content-Type: application/json";
            $header[] = "Api-key: ".$apiKey;
            $header[] = "X-Signature: ".$signature;
            /*echo json_encode($header);
             echo "<br>";
             echo "<br>";*/
           /*echo json_encode($post_data);
           exit();*/
           /* echo "<br>";
            echo "<br>";
            exit();*/

            $ch = curl_init();
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
            curl_setopt($ch,CURLOPT_ENCODING , "gzip");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
            curl_setopt( $ch, CURLOPT_URL, $url );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            //$response = json_decode(curl_exec($ch),true);
            $response = curl_exec($ch);

            $curlinfo = curl_getinfo($ch);
            /*echo json_encode($post_data);
            if(curl_exec($ch) === false)
            {
                echo 'Curl error: ' . curl_error($ch);
            }*/
            /*echo "<br>";
            echo "<br>";
              echo $response;
            echo "<br>";
              exit();*/
            /*echo $response;
            exit();*/
            return $response;

        }

        function apiCall_get($url){
           /* echo $url;
            exit();*/
            $url = str_replace(" ", '%20', $url);
            $sharedSecret = 't8qZYfnceE';
            $apiKey = '7evpxa7utyytvj48y3fp75rj';
            $signature = hash("sha256", $apiKey.$sharedSecret.time());
            $header[] = "Accept: application/json";
            $header[] = "Content-Type: application/json";
            $header[] = "Api-key: ".$apiKey;
            $header[] = "X-Signature: ".$signature;
            $ch = curl_init();
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
            curl_setopt($ch,CURLOPT_ENCODING , "gzip");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt( $ch, CURLOPT_URL, $url );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            $response = curl_exec($ch);
            //$response = curl_exec($ch);

            $curlinfo = curl_getinfo($ch);

            if(curl_exec($ch) === false)
            {
                //echo 'Curl error: ' . curl_error($ch);
            }
            $response = json_decode($response);
            /*print_r($response);*/
            return $response;

        }

        function apiCall_get_trip($url){
            
            $ch = curl_init();
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
            curl_setopt($ch,CURLOPT_ENCODING , "gzip");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt( $ch, CURLOPT_URL, $url );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            $response = curl_exec($ch);
            //$response = curl_exec($ch);

            $curlinfo = curl_getinfo($ch);

            if(curl_exec($ch) === false)
            {
                //echo 'Curl error: ' . curl_error($ch);
            }
            //$response = json_decode($response);
            //print_r($response);
            return $response;

        }



        /*
         * funtion to get the list of hotels
         */
	       function HotelLists($arrayInfo){

            $lat = $arrayInfo['lat'];
            $long = $arrayInfo['long'];
            $checkIn = $arrayInfo['checkIn'];
            
            $checkOut = $arrayInfo['checkOut'];
            
            $rooms = $arrayInfo['room'];
            $adults = $arrayInfo['adults'];
            $room_guest = $adults / $rooms;

            $child = isset($arrayInfo['child']) && $arrayInfo['child'] != null ? $arrayInfo['child'] : 0;
            $childAges = explode(',', $arrayInfo['childAges']) ;

            $date1 = new DateTime($checkIn);
            $date2 = new DateTime($checkOut);

            $diff = $date2->diff($date1)->format("%a");

            $hotel_beds_post['stay']['checkIn'] = date("Y-m-d", strtotime($checkIn));
            $hotel_beds_post['stay']['checkOut'] = date("Y-m-d", strtotime($checkOut));
            $hotel_beds_post['stay']['shiftDays'] = $diff;

            $a = 0;
            /*echo $rooms;
            exit();*/
           /* for ($room_Data=0; $room_Data < $rooms ; $room_Data++) { */
                $hotel_beds_post['occupancies'][$a]['rooms'] =  $rooms;
                $hotel_beds_post['occupancies'][$a]['adults'] = $adults;
                $hotel_beds_post['occupancies'][$a]['children'] = $child;


            
              
                for ($i=0; $i < $adults  ; $i++) { 
                  $paxes[$i]['type'] = 'AD';
                  $paxes[$i]['age'] = 30;
                }
            

                for ($j=0; $j < $child ; $j++) { 
                  $paxes[$j+$i]['type'] = 'CH';
                  $paxes[$j+$i]['age'] = $childAges[$j];
                }
                $hotel_beds_post['occupancies'][$a]['paxes'] = $paxes;

            /*
            }*/

            /*$hotel_beds_post['occupancies'] = $TT;*/
            $hotel_beds_post['geolocation']['longitude'] = $long;
            $hotel_beds_post['geolocation']['latitude'] = $lat;
            $hotel_beds_post['geolocation']['radius'] = 50;
            $hotel_beds_post['geolocation']['unit'] = 'km';

            /*echo json_encode($hotel_beds_post);
            exit();*/
            $url = 'https://api.test.hotelbeds.com/hotel-api/1.0/hotels';

            return $this->apiCall($url,$hotel_beds_post);
	       }

         function getHomePageFeaturedHotels($arrayInfo){


            $datetime = new DateTime('tomorrow');
            $datetime->modify('+1 day');
            $checkIn =  $datetime->format('Y-m-d');

            $datetime = new DateTime('tomorrow');
            $datetime->modify('+3 day');
            $checkOut =  $datetime->format('Y-m-d');
            

            $rooms = 1;
            $adults = 1;
            /*$child = isset($arrayInfo['child']) && $arrayInfo['child'] != null ? $arrayInfo['child'] : 0;
            $childAges = explode(',', $arrayInfo['childAges']) ;*/

            $date1 = new DateTime($checkIn);
            $date2 = new DateTime($checkOut);

            $diff = $date2->diff($date1)->format("%a");

            $hotel_beds_post['stay']['checkIn'] = date("Y-m-d", strtotime($checkIn));
            $hotel_beds_post['stay']['checkOut'] = date("Y-m-d", strtotime($checkOut));
            $hotel_beds_post['stay']['shiftDays'] = $diff;

            $a = 0;
           /*echo $rooms;
            exit();*/
           /* for ($room_Data=0; $room_Data < $rooms ; $room_Data++) { */
                $hotel_beds_post['occupancies'][$a]['rooms'] =  $rooms;
                $hotel_beds_post['occupancies'][$a]['adults'] = $adults;
                $hotel_beds_post['occupancies'][$a]['children'] = $child;


            
              
                for ($i=0; $i < $adults  ; $i++) { 
                  $paxes[$i]['type'] = 'AD';
                  $paxes[$i]['age'] = 30;
                }
            

                for ($j=0; $j < $child ; $j++) { 
                  $paxes[$j+$i]['type'] = 'CH';
                  $paxes[$j+$i]['age'] = $childAges[$j];
                }
                $hotel_beds_post['occupancies'][$a]['paxes'] = $paxes;

            /*
            }*/

            /*$hotel_beds_post['occupancies'] = $TT;*/
            $hotel_beds_post['destination']['code'] = 'LVS';
            
            $url = 'https://api.test.hotelbeds.com/hotel-api/1.0/hotels';

             $featuredHotels_data =  $this->apiCall($url,$hotel_beds_post);
            //exit();
            $featuredHotels_data = json_decode($featuredHotels_data);
            if(isset($featuredHotels_data->hotels->hotels)){

              //for ($i=0; $i < count($featuredHotels_data->hotels->hotels) ; $i++) { 
              for ($i=0; $i < 6 ; $i++) { 
                  $base = $featuredHotels_data->hotels->hotels;
                  $code = $base[$i]->code;
                  $res_data[$i]->code = $code;
                  $res_data[$i]->title = $base[$i]->name;
                  $res_data[$i]->stars = '</i></i></i></i></i>';
                  $res_data[$i]->location = $base[$i]->destinationName;
                  $res_data[$i]->currCode = $base[$i]->currency;
                  $res_data[$i]->price = $base[$i]->minRate;

                  $res_data[$i]->slug = 'http://localhost/tarzango/properties/hbhotel/'.$code.'?adults='.$adults.'&checkin='.$checkIn.'&checkout='.$checkOut;

                  $res_data[$i]->rating = '';

                  $img_code[] = $code;
                  //$H_details = $this->Hotel_details($code);
                 

                  $res_data[$i]->thumbnail = '';
                  /*$img_main_url = 'http://photos.hotelbeds.com/giata/bigger/';
                  if(isset($H_details->hotel)){
                    $thumb = $H_details->hotel->images[0]->path;
                    $res_data[$i]->thumbnail = $img_main_url.$thumb;
                  }*/
                  /*echo json_encode($H_details);
                  exit();*/
              }

            }
            $img_main_url = 'http://photos.hotelbeds.com/giata/bigger/';

             $H_details = $this->HotelImage_list($img_code);

             for ($j=0; $j < count($H_details->hotels) ; $j++) { 
                for ($k=0; $k < count($res_data) ; $k++) { 
                  /*echo $H_details->hotels[$j]->code ."==". $res_data[$k]->code;
                  echo "<br>";*/
                  if($H_details->hotels[$j]->code == $res_data[$k]->code){
                     $thumb = $H_details->hotels[$j]->images[0]->path;
                    $res_data[$k]->thumbnail = $img_main_url.$thumb;
                  }
                }
             }

            /* echo json_encode($res_data);
                  exit();*/
            $final_Data->hotels = $res_data;
            $final_Data->errorMsg = '';
            return $final_Data;
            /*echo json_encode($res_data);
            exit();*/
         }

         function get_hotel_by_code($arrayInfo){
            

              $hotelId = $arrayInfo['hotelId'];
              
              $checkIn = $arrayInfo['checkIn'];
              $checkOut = $arrayInfo['checkOut'];
              $rooms = $arrayInfo['room'];
              $adults = $arrayInfo['adults'];
              
              $child = isset($arrayInfo['childAges']) ? $arrayInfo['childAges'] : "";
              if($child != ""){
                $childAges = explode(',', $child);
              }else{
                $childAges = array();
              }

              
              $child = count($childAges) > 0 ? count($childAges) : 0 ;
              
              $date1 = new DateTime($checkIn);
              $date2 = new DateTime($checkOut);

              $diff = $date2->diff($date1)->format("%a");

              $hotel_beds_post['stay']['checkIn'] = date("Y-m-d", strtotime($checkIn));
              $hotel_beds_post['stay']['checkOut'] = date("Y-m-d", strtotime($checkOut));
              $hotel_beds_post['stay']['shiftDays'] = $diff;

              $a = 0;
                /*echo $rooms;
                exit();*/
               /* for ($room_Data=0; $room_Data < $rooms ; $room_Data++) { */
                $hotel_beds_post['occupancies'][$a]['rooms'] =  $rooms;
                $hotel_beds_post['occupancies'][$a]['adults'] = $adults;
                $hotel_beds_post['occupancies'][$a]['children'] = $child;


            
              
                for ($i=0; $i < $adults  ; $i++) { 
                  $paxes[$i]['type'] = 'AD';
                  $paxes[$i]['age'] = 30;
                }
            

                for ($j=0; $j < $child ; $j++) { 
                  $paxes[$j+$i]['type'] = 'CH';
                  $paxes[$j+$i]['age'] = $childAges[$j];
                }
                $hotel_beds_post['occupancies'][$a]['paxes'] = $paxes;

            

            /*$hotel_beds_post['occupancies'] = $TT;*/

              $hotel_beds_post['hotels']['hotel'][] = $hotelId;
              
              
               $url = 'https://api.test.hotelbeds.com/hotel-api/1.0/hotels';
              /*echo "<br>";
              echo "<br>";
              print_r($hotel_beds_post);
              exit();*/
              $api_Data =  $this->apiCall($url,$hotel_beds_post);
              /*exit();*/
              $reviews_data = $this->tripadvisor_review($arrayInfo['latitude'],$arrayInfo['longitude'],$arrayInfo['hotel_name']);
              
              $api_Data = json_decode($api_Data);

              $api_Data->reviews = json_decode($reviews_data->reviews);
              $api_Data->tripadvisor = json_decode($reviews_data);
              
              return json_encode($api_Data);
              
         }

        function tripadvisor_review($latitude,$longitude,$hotel_name){
          /*echo $hotel_name;
          echo $latitude;
          echo $longitude;*/
          $api_key = '9c13b7bbcaab47118d769679511537a7';
          $hotel_name =  urlencode($hotel_name);
          $url = 'http://api.tripadvisor.com/api/partner/2.0/location_mapper/'.$latitude.','.$longitude.'?key='.$api_key.'-mapper&category=hotels&q='.$hotel_name;
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

        function HotelImage_list($arrayInfo){

            /*print_r($arrayInfo);*/
            
            $hotel_data = implode(",", $arrayInfo);


            $url = 'https://api.test.hotelbeds.com/hotel-content-api/1.0/hotels';
            // exit();

            //$str = $url.'?fields=name,description,address,coordinates,postalCode,city,email,images&language=EN&codes='.$hotel_data;
            $str = $url.'?fields=all&language=EN&codes='.$hotel_data;
           
               
            $image_data =  $this->apiCall_get($str);


           // Define the custom sort function
           function custom_sort_1($a,$b) {
                return $a->order > $b ->order;
           }

            for ($i=0; $i < count($image_data->hotels) ; $i++) { 
                $hotel_img_data = $image_data->hotels[$i]->images;
                $sort_Data = usort($hotel_img_data, "custom_sort_1");

                $image_data->hotels[$i]->images = $hotel_img_data;
           
            }
            
            return $image_data;
          }

          function checkrates($arrayInfo){
            //echo json_encode($arrayInfo);

            $ratekey = $arrayInfo['rateKey'];

            $hotel_beds_post['rooms'][]['rateKey'] = $ratekey;
              
             /* echo json_encode($hotel_beds_post);
              exit();*/
            $url = 'https://api.test.hotelbeds.com/hotel-api/1.0/checkrates';

            return $this->apiCall($url,$hotel_beds_post);

          }

          function Hotel_details($hotel_code){
           
              $url = 'https://api.test.hotelbeds.com/hotel-content-api/1.0/hotels/'.$hotel_code.'?language=ENG';

              return $this->apiCall_get($url);
          }

          function HotelRoomReservation($arrayInfo){
              

              $adults = $arrayInfo['adults'];
              
              /*$cs = isset($arrayInfo['child']) && $arrayInfo['child'] != "" ? $arrayInfo['child'] : "0";
              $cc = explode(",", $cs);
              $child = count($cc);*/


              $child = isset($arrayInfo['child']) ? $arrayInfo['child'] : "";
              if($child != ""){
                $childAges = explode(',', $child);
              }else{
                $childAges = array();
              }

              
              $child = count($childAges) > 0 ? count($childAges) : 0 ;
              
              $a = 0;

              $firstName = $arrayInfo['firstName'];
              $lastName = $arrayInfo['lastName'];
              $hotel_beds_post['holder']['name'] = $firstName;
              $hotel_beds_post['holder']['surname'] = $lastName;
              $hotel_beds_post['rooms'][$a]['rateKey'] = $arrayInfo['ratekey'];

              for ($i=0; $i < $adults ; $i++) { 
                  $paxes[$i]['roomId'] = '1';
                  $paxes[$i]['type'] = 'AD';
                  $paxes[$i]['age'] = 30;
                  $paxes[$i]['name'] = $firstName;
                  $paxes[$i]['surname'] = $lastName;
              }

              for ($j=0; $j < $child ; $j++) { 
                  $paxes[$j+$i]['roomId'] = '1';
                  $paxes[$j+$i]['type'] = 'CH';
                  $paxes[$j+$i]['age'] = $childAges[$j];
                  $paxes[$j+$i]['name'] = 'Child of '.$firstName;
                  $paxes[$j+$i]['surname'] = $lastName;
              }

              $hotel_beds_post['rooms'][$a]['paxes'] = $paxes;
              $hotel_beds_post['clientReference'] = 'HOTELBEDS USA';

              //echo json_encode($hotel_beds_post);

              $url = 'https://api.test.hotelbeds.com/hotel-api/1.0/bookings';

              return $this->apiCall($url,$hotel_beds_post);
          }

     
}