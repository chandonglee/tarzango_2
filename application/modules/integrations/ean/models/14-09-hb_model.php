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

        $booking_data = json_decode($booking_data[0]);
        /*print_r($booking_data);
        exit();*/
        $this->data['result'] = $booking_data;
            /*exit();*/
            /*$this->data['result'] = "success";
            $confirmation = array();*/

            //echo "Asdas";

            $error = $this->data['result']->error;
            $bookresponse = $this->data['result']->booking;

            if (!empty ($error)) {

                $data['msg'] = $error->message;
                $data['result'] = "fail";
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
                
                
                //$bookresponse = (object)array_merge((array)$booking_data , $a_hot_loc);
                /*print_r($bookresponse);
                exit();*/

                $insertdata = array('user' => $user, 
                                    'checkin' => $this->input->post('checkin'),
                                    'checkout' => $this->input->post('checkout'),
                                    'hotel' => $this->input->post('hotel'),
                                    'thumbnail' => $this->input->post('thumbnail'),
                                    /*'location' => $this->input->post('location'),*/
                                    'stars' => $this->input->post('hotelstars'),
                                    'hotelname' => $this->input->post('hotelname'),
                                    'roomname' => $this->input->post('roomname'),
                                    'roomtotal' => $totalamount / 1,
                                    'tax' => 0,
                                    'total' => $totalamount,
                                    'email' => $this->input->post('email'),
                                    'itineraryid' => $itid,
                                    'confirmation' => $confirmation,
                                    'nights' => $diff,
                                    'currency' => '$',
                                    'bookResponse' => json_encode($bookresponse));

                $aaa = $this->insert_booking_final($insertdata);
                print_r($aaa);
                exit();
                $this->db->where('book_itineraryid',$itid);
                $res = $this->db->get('pt_ean_booking')->result();
                $rrr = json_decode($res);
                $inv_id = $res[0]->book_id;
                
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

        return $booking_Data;
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

    }
  


}