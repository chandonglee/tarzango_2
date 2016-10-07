<?php
class Hb_model extends CI_Model{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('ean/hb_lib');
        /*$this->load->model('ean/ean_model');*/
    }
    public function test(){
        return $this->hb_lib->test_qwe();
    }

    function insert_booking($insertdata){

        $this->db->insert('pt_payment_data',$insertdata);

    }

    public function do_booking($input_data){
        $arrayInfo = array();
       /* echo json_encode($input_data);
        exit();*/
        $arrayInfo['room'] = $input_data['room'];
        $arrayInfo['rateKey'] = $input_data['subitemid'];
        $arrayInfo['ratekey'] = $input_data['subitemid'];
        $arrayInfo['adults'] = $input_data['adults'];
        $arrayInfo['child'] = $input_data['child'];
        $arrayInfo['firstName'] = $input_data['guest_name'][0];
        $arrayInfo['lastName'] = $input_data['guest_name'][0];
        

        $checkinDate = $input_data['checkin'];
                    $checkoutDate = $input_data['checkout'];
                    $date1 = new DateTime($checkinDate);
                    $date2 = new DateTime($checkoutDate);

                    $diff = $date2->diff($date1)->format("%a");
                    

        $rates_Data = $this->hb_lib->checkrates($arrayInfo);
        
        $booking_data = $this->hb_lib->HotelRoomReservation($arrayInfo);

        /*print_r($booking_data);*/
        $string = preg_replace("/[\r\n]+/", " ", $booking_data[0]);
        $json = utf8_encode($string);
        $booking_data_1 = json_decode($json);
        /*
        print_r($booking_data_1);
        exit();*/
        $H_data['result'] = $booking_data_1;
            /*exit();*/
            /*$H_data['result'] = "success";
            $confirmation = array();*/

            //echo "Asdas";

            $error = $H_data['result']->error;
            $bookresponse = $H_data['result']->booking;

            if (!empty ($error)) {

                $data['msg'] = $error->message;
                $data['result'] = "fail";
            } else {
                $itid = $H_data['result']->booking->reference;

                $confirmation = $H_data['result']->booking->reference;
                $H_data['itineraryID'] = $itid;
                $H_data['confirmationNumber'] = $confirmation;
                $H_data['nonRefundable'] = '';
                //$H_data['checkInInstructions'] = $H_data['result']->booking->hotel->rooms[0]->rates->[0]->rateComments;
                $H_data['checkInInstructions'] = $H_data['result']->booking->hotel->rooms;
                //$H_data['cancellationPolicy'] = $H_data['result']->booking->hotel->rooms[0]->rates->[0]->cancellationPolicies;
                $totalCharge = $H_data['result']->booking->totalNet;
                if(empty($totalCharge)){
                    $totalCharge = $H_data['result']->booking->totalSellingRate;
                }

                $total = $totalCharge;
                $H_data['grandTotal'] = $total;
                $H_data['currency'] = '$';
                $H_data['surchargeTotal'] = '';
                $H_data['nightlyRateTotal'] = '';

                $H_data['msg'] = trans("0336");
                $room_name = $H_data['result']->booking->hotel->rooms[0]->name;
                //$H_data['msg'] = $H_data['msg'] = print_r($H_data['result']->HotelRoomReservationResponse);
                if(!empty($confirmation)){
                        $H_data['result'] = "success";
                }else{
                        $H_data['result'] = "fail";
                }

            }
            
            if ($itid > 1 && !empty($confirmation)) {
                //if (empty($confirmation)) {
                $totalamount = $this->input->post('total');
                
                
                //$bookresponse = (object)array_merge((array)$booking_data , $a_hot_loc);
                /*print_r($bookresponse);
                exit();*/
                $user = isset($input_data[0]->accounts_id) ? $input_data[0]->accounts_id : 17;
                $insertdata = array('user' => $user, 
                                    'checkin' => $this->input->post('checkin'),
                                    'checkout' => $this->input->post('checkout'),
                                    'hotel' => $this->input->post('hotel'),
                                    'thumbnail' => $this->input->post('thumbnail'),
                                    'location' => $this->input->post('location'),
                                    'stars' => $this->input->post('stars'),
                                    'hotelname' => $this->input->post('hotelname'),
                                    'roomname' => $room_name,
                                    'roomtotal' => $totalamount / 1,
                                    'tax' => 0,
                                    'total' => $totalamount,
                                    'email' => $input_data[0]->accounts_email,
                                    'itineraryid' => $itid,
                                    'confirmation' => $confirmation,
                                    'nights' => $diff,
                                    'currency' => '$',
                                    'bookResponse' => json_encode($bookresponse));

               /* print_r($insertdata);
                exit();*/
                $aaa = $this->insert_booking_final($insertdata);
                /*echo $this->db->last_query();
                exit();*/
                $this->db->where('book_itineraryid',$itid);
                $res = $this->db->get('pt_ean_booking')->result();
                $rrr = json_decode($res);
                $inv_id = $res[0]->book_id;
                
                $arrKeys = array();
                $arrVals = array();
                $surrInfo = $rrr->totalNet;

                $insertdata_extra = array(
                                        'booking_id' => $inv_id,
                                        'extra_data' => json_encode($this->input->post()),
                                        );
                $this->load->helper('member');
                add_pickup_detail_hb($inv_id,json_encode($this->input->post()));

                if(empty($surrInfo)){
                    $surrInfo = $rrr->totalSellingRate;
                }

                $H_data['SalesTax'] = '';
                $H_data['HotelOccupancyTax'] = '';
                $H_data['TaxAndServiceFee'] = '10';
                /*$H_data['extra_data'] = $extra_data;*/

                $bookingResult = array("error" => "no", 'url' => base_url().'invoice?eid='.$inv_id.'&sessid='.$itid);
                //redirect(base_url().'invoice?eid='.$inv_id.'&sessid='.$itid);
               
            }else{
                $bookingResult = array("error" => "yes", 'msg' => 'Try again');
            }

        return json_encode($bookingResult);
    }
    public function do_booking_login($input_data){
        $arrayInfo = array();
       /* echo json_encode($input_data);
        exit();*/
        $arrayInfo['room'] = $input_data['room'];
        $arrayInfo['rateKey'] = $input_data['subitemid'];
        $arrayInfo['ratekey'] = $input_data['subitemid'];
        $arrayInfo['adults'] = $input_data['adults'];
        $arrayInfo['child'] = $input_data['child'];
        $arrayInfo['firstName'] = $input_data['guest_name'][0];
        $arrayInfo['lastName'] = $input_data['guest_name'][0];
        

        $checkinDate = $input_data['checkin'];
                    $checkoutDate = $input_data['checkout'];
                    $date1 = new DateTime($checkinDate);
                    $date2 = new DateTime($checkoutDate);

                    $diff = $date2->diff($date1)->format("%a");
                    

        $rates_Data = $this->hb_lib->checkrates($arrayInfo);
        
        $booking_data = $this->hb_lib->HotelRoomReservation($arrayInfo);

        /*print_r($booking_data);*/
        $string = preg_replace("/[\r\n]+/", " ", $booking_data[0]);
        $json = utf8_encode($string);
        $booking_data_1 = json_decode($json);
        /*
        print_r($booking_data_1);
        exit();*/
        $H_data['result'] = $booking_data_1;
            /*exit();*/
            /*$H_data['result'] = "success";
            $confirmation = array();*/

            //echo "Asdas";

            $error = $H_data['result']->error;
            $bookresponse = $H_data['result']->booking;

            if (!empty ($error)) {

                $data['msg'] = $error->message;
                $data['result'] = "fail";
            } else {
                $itid = $H_data['result']->booking->reference;

                $confirmation = $H_data['result']->booking->reference;
                $H_data['itineraryID'] = $itid;
                $H_data['confirmationNumber'] = $confirmation;
                $H_data['nonRefundable'] = '';
                //$H_data['checkInInstructions'] = $H_data['result']->booking->hotel->rooms[0]->rates->[0]->rateComments;
                $H_data['checkInInstructions'] = $H_data['result']->booking->hotel->rooms;
                //$H_data['cancellationPolicy'] = $H_data['result']->booking->hotel->rooms[0]->rates->[0]->cancellationPolicies;
                $totalCharge = $H_data['result']->booking->totalNet;
                if(empty($totalCharge)){
                    $totalCharge = $H_data['result']->booking->totalSellingRate;
                }

                $total = $totalCharge;
                $H_data['grandTotal'] = $total;
                $H_data['currency'] = '$';
                $H_data['surchargeTotal'] = '';
                $H_data['nightlyRateTotal'] = '';

                $H_data['msg'] = trans("0336");
                $room_name = $H_data['result']->booking->hotel->rooms[0]->name;
                //$H_data['msg'] = $H_data['msg'] = print_r($H_data['result']->HotelRoomReservationResponse);
                if(!empty($confirmation)){
                        $H_data['result'] = "success";
                }else{
                        $H_data['result'] = "fail";
                }

            }
            
            if ($itid > 1 && !empty($confirmation)) {
                //if (empty($confirmation)) {
                $totalamount = $this->input->post('total');
                
                
                //$bookresponse = (object)array_merge((array)$booking_data , $a_hot_loc);
                /*print_r($bookresponse);
                exit();*/
                $user = isset($input_data[0]->accounts_id) ? $input_data[0]->accounts_id : 17;
                $insertdata = array('user' => $user, 
                                    'checkin' => $this->input->post('checkin'),
                                    'checkout' => $this->input->post('checkout'),
                                    'hotel' => $this->input->post('hotel'),
                                    'thumbnail' => $this->input->post('thumbnail'),
                                    'location' => $this->input->post('location'),
                                    'stars' => $this->input->post('stars'),
                                    'hotelname' => $this->input->post('hotelname'),
                                    'roomname' => $room_name,
                                    'roomtotal' => $totalamount / 1,
                                    'tax' => 0,
                                    'total' => $totalamount,
                                    'email' => $input_data[0]->accounts_email,
                                    'itineraryid' => $itid,
                                    'confirmation' => $confirmation,
                                    'nights' => $diff,
                                    'currency' => '$',
                                    'bookResponse' => json_encode($bookresponse));

               /* print_r($insertdata);
                exit();*/
                $aaa = $this->insert_booking_final($insertdata);
                $this->db->where('book_itineraryid',$itid);
                $res = $this->db->get('pt_ean_booking')->result();
                $rrr = json_decode($res);
                $inv_id = $res[0]->book_id;
                
                $arrKeys = array();
                $arrVals = array();
                $surrInfo = $rrr->totalNet;

                $insertdata_extra = array(
                                        'booking_id' => $inv_id,
                                        'extra_data' => json_encode($this->input->post()),
                                        );
                $this->load->helper('member');
                add_pickup_detail_hb($inv_id,json_encode($this->input->post()));

                if(empty($surrInfo)){
                    $surrInfo = $rrr->totalSellingRate;
                }

                $H_data['SalesTax'] = '';
                $H_data['HotelOccupancyTax'] = '';
                $H_data['TaxAndServiceFee'] = '10';
                /*$H_data['extra_data'] = $extra_data;*/
                $bookingResult = array("error" => "no", 'url' => base_url().'invoice?eid='.$inv_id.'&sessid='.$itid);
                //redirect(base_url().'invoice?eid='.$inv_id.'&sessid='.$itid);
               
            }else{
                $bookingResult = array("error" => "yes", 'msg' => 'Try again');
            }

        return json_encode($bookingResult);
    }

function insert_booking_final($insertdata){

        $data = array(
          'book_user' => $insertdata['user'],
          'book_checkin' => $insertdata['checkin'],
          'book_checkout' => $insertdata['checkout'],
          'book_hotelid' => $insertdata['hotel'],
          'book_hotel' => $insertdata['hotelname'],
          'book_stars' => $insertdata['stars'],
          'book_location' => $insertdata['location'],
          'book_roomname' => $insertdata['roomname'],
          'book_roomtotal' => $insertdata['roomtotal'],
          'book_tax' => $insertdata['tax'],
          'book_total' => $insertdata['total'],
          'book_currency' => $insertdata['currency'],
          'book_email' => $insertdata['email'],
          'book_itineraryid' => $insertdata['itineraryid'],
          'book_confirmation' => $insertdata['confirmation'],
          'book_nights' => $insertdata['nights'],
          'book_thumbnail' => $insertdata['thumbnail'],
          'book_date' => time(),
          'book_response' => $insertdata['bookResponse']
        );

        $this->db->insert('pt_ean_booking',$data);
        return $this->db->insert_id();
    }
  


}