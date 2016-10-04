<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Attraction extends MX_Controller
{
    private $data = array();
    private $validlang;
    
    function __construct(){
        modules::load('front');
        //$this->load->helper("member");
        $this->data['app_settings']    = $this->settings_model->get_settings_data();
        $this->data['geo']             = $this->load->get_var('geolib');
        $this->data['phone']           = $this->load->get_var('phone');
        $this->data['contactemail']    = $this->load->get_var('contactemail');
        $this->data['contact_address'] = $this->load->get_var('contact_address');
        $this->data['usersession']     = $this->session->userdata('pt_logged_customer');
        
        
        $pageslugg       = $this->uri->segment(1);
        $this->validlang = pt_isValid_language($pageslugg);
        if ($this->validlang) {
            $this->data['lang_set'] = $pageslugg;
        } else {
            $this->data['lang_set'] = $this->session->userdata('set_lang');
        }
        
        
        $defaultlang = pt_get_default_language();
        
        if (empty($this->data['lang_set'])) {
            $this->data['lang_set'] = $defaultlang;
        }
        
        
        $this->data['eancheckin']  = date("m/d/Y", strtotime("+1 days"));
        $this->data['eancheckout'] = date("m/d/Y", strtotime("+2 days"));
        $this->load->library('session');
        $this->load->model('top_destinations/top_destinations_model');
        $this->load->library('attraction/attraction_lib');
        $this->load->model('admin/accounts_model');
        $this->load->model('attraction_model');
        $profile = $this->accounts_model->get_profile_details($this->session->userdata('pt_logged_customer'));
        $this->data['profile'] = $profile;
        /*$this->session->set_userdata('is_gb_done','true1');*/
      
        
    }
    
    public function index(){
        
        $this->lang->load("front", $this->data['lang_set']);
        $pageslug = $this->uri->segment(1);
        $secondslug = $this->uri->segment(2);
        $this->load->library('sliders_lib');
        $this->data['sliderlib'] = $this->sliders_lib;
        
        $langid      = $this->session->userdata('set_lang');
        $defaultlang = pt_get_default_language();
        if (empty($langid)) {
            $langid = $defaultlang;
        }
        if ($this->validlang) {
            $pageslug = $this->uri->segment(2);
            //var_dump($pageslug);
            
        }
        $check = $this->cms_model->check($pageslug);
        
        if ($pageslug == 'attraction' || $this->validlang && empty($secondslug)) {
            
            $this->load->model('admin/special_offers_model');
            $activeModules = array();
            //$this->data['featuredSection']['modules'] = array();
            
            $this->data['divCol'] = $divCol;
            
            $this->data['checkin']       = date($this->data['app_settings'][0]->date_f, strtotime('+' . CHECKIN_SPAN . ' day', time()));
            $this->data['checkout']      = date($this->data['app_settings'][0]->date_f, strtotime('+' . CHECKOUT_SPAN . ' day', time()));
            $this->data['dohopusername'] = $dohopsettings[0]->cid;
            $this->data['cartrawlerid']  = $cartrawlersettings[0]->cid;
            $this->data['affiliate']     = $bookingsettings[0]->cid;
            $this->data['ishome']        = "1";
            $this->data['main_content']  = 'index';
            $this->data['langurl']       = base_url() . "{langid}";
            $this->data['page_title']    = $this->data['app_settings'][0]->home_title;
            $this->data['dest'] = $this->top_destinations_model->all_destinations();
            /*echo json_encode($this->data['dest']);
            exit();*/
            $this->theme->view('attraction/attraction', $this->data);
        } else {
            Error_404($this->data);
        }
        
    }
    
    function error(){
        $this->data['page_title'] = trans("0268");
        $this->theme->view('404', $this->data);
    }

    function city(){
        /*error_reporting(-1);*/
        $id =   $this->uri->segment(3);
        $this->load->model('blog/blog_model');
        $this->load->helper('blog/blog_front');
        $b_Data = $this->blog_model->list_posts_front_by_dest_id('','','',$id);
        $this->data['b_Data'] = $b_Data;
        /*$r_a = array(" ","\n","<br>");*/
        /*echo str_replace($r_a, '',  json_encode($b_Data));
        exit();*/
        $this->data['dest'] = $this->top_destinations_model->all_destinations($id);
        $this->data['dest_img'] = $this->top_destinations_model->all_dest_images($id);
       
        $datetime = new DateTime('tomorrow');
        $datetime->modify('+1 day');
        $checkIn =  $datetime->format('m/d/Y');

        $datetime = new DateTime('tomorrow');
        $datetime->modify('+2 day');
        $checkOut =  $datetime->format('m/d/Y');

        $dest_data = $this->data['dest'][0];
        $latitude = $dest_data->latitude;
        $longitude = $dest_data->longitude;
        
        $city=$dest_data->name;
        $adults="1";
        $lat=$latitude;
        $long=$longitude;
        $room="1";
        $search="search";
        $childages="";
        $child="0";
        
        $hotel_data = modules::run('ean/ajax_call_attr', $city,$checkIn,$checkOut,$adults,$lat,$long,$room,$childages,$child);
        
        $limit = 9;
        $attraction_data =  $this->attraction_lib->attraction_for_city($latitude,$longitude,$checkIn,$checkOut,$limit);
        
        $this->data['to_do'] = $attraction_data;
        $this->data['id'] = $id;
        $this->data['to_stay'] = $hotel_data;
        $this->data['lat'] = $lat;
        $this->data['long'] = $long;
        
    	$this->theme->view('attraction/city', $this->data);
    }

    function listing(){
        $lat = '36.1699412';
        $long = '-115.13982959999998';
        $adults = '1';
        $child = '1';

    	$this->theme->view('attraction/attraction_listing', $this->data);
    }

    function details(){
        
        $id =   $this->uri->segment(3);
        $code =   $this->uri->segment(4);
        $latitude =   $this->input->get('lat');
        $longitude =   $this->input->get('long');
        $adults =   $this->input->get('adults');
        $child =   $this->input->get('child');
        $checkin =   $this->input->get('checkIn');
        $child_allow =   $this->input->get('child_allow');
        
        $this->data['dest'] = $this->top_destinations_model->all_destinations($id);
       /*echo $this->data['dest'][0]->detail_back_img;
        echo json_encode($this->data['dest']);
        exit();*/
        $attraction_data =  $this->attraction_lib->attraction_by_code($code,$adults,$child,$checkIn,$child_allow);
        $this->data['data'] = $attraction_data;
        $this->data['latitude'] = $this->data['dest'][0]->latitude;
        $this->data['longitude'] = $this->data['dest'][0]->longitude;
        $this->data['trip_data'] = '';
        if($attraction_data->content->geolocation->latitude){
            $lat = $attraction_data->content->geolocation->latitude;
            $long = $attraction_data->content->geolocation->longitude;
            $attractions_name = $attraction_data->name;
            $trip_data =  $this->attraction_lib->tripadvisor_review($lat,$long,$trip_data);
            $this->data['trip_data'] = json_decode($trip_data);
        }
        /*echo json_encode($attraction_data);
        exit();*/
        /*exit();
        $this->data['to_do'] = $attraction_data;*/
    	$this->theme->view('attraction/attraction_details', $this->data);
    }

    function details_2(){
        /*error_reporting(-1);*/
        //$id =   $this->uri->segment(3);
        $code =   $this->input->get('code');
        $latitude =   $this->input->get('lat');
        $longitude =   $this->input->get('long');
        $adults =   $this->input->get('adults');
        $child =   $this->input->get('child');
        $checkin =   $this->input->get('checkIn');
        $child_allow =   $this->input->get('child_allow');
        //$this->data['dest'] = $this->top_destinations_model->all_destinations($id);
       /*echo $this->data['dest'][0]->detail_back_img;
        echo json_encode($this->data['dest']);
        exit();*/
        $attraction_data =  $this->attraction_lib->attraction_by_code($code,$adults,$child,$checkIn,$child_allow);
        $this->data['data'] = $attraction_data;
        $this->data['code'] = $code;
        $this->data['latitude'] = isset($latitude) ? $latitude : $this->data['dest'][0]->latitude;
        $this->data['longitude'] = isset($longitude) ? $longitude : $this->data['dest'][0]->longitude;
        $this->data['trip_data'] = '';
        if($attraction_data->content->geolocation->latitude){
            $lat = $attraction_data->content->geolocation->latitude;
            $long = $attraction_data->content->geolocation->longitude;
            $attractions_name = $attraction_data->name;
            $trip_data =  $this->attraction_lib->tripadvisor_review($lat,$long,$trip_data);
            $this->data['trip_data'] = json_decode($trip_data);
        }
        /*echo json_encode($attraction_data);
        exit();*/
        /*exit();
        $this->data['to_do'] = $attraction_data;*/
        $this->theme->view('attraction/attraction_details_2', $this->data);
    }

    

    function invoice(){
        /*error_reporting(-1);*/
        $this->load->helper('member_helper');
        $profile = check_is_member($this->session->userdata('pt_logged_customer'));
        
        $id =   $this->uri->segment(3);
        $attr_data = $this->attraction_model->get_attr_booking($id);
        /*echo json_encode($attr_data);
        exit();*/
        $this->data['invoice'] = $attr_data;
    	$this->theme->view('attraction/invoice', $this->data);

         
    }

    function booking_paid_paystand(){
        $pay_data = $this->input->post('pay_data');
        $pt_attr_booking_id = $this->input->post('pt_attr_booking_id');
        $booking_ref_no = $this->input->post('booking_ref_no');

        $this->attraction_model->update_payment_status($pay_data,$pt_attr_booking_id,$booking_ref_no);

    }

    function invoice_paid(){
        $this->theme->view('attraction/invoice_paid', $this->data);
    }

    function search(){
        /*echo json_encode($this->input->get());*/
        $latitude = $this->input->get('lat');
        $longitude = $this->input->get('long');
        $adults  = $this->input->get('adults');
        $child = $this->input->get('child');
        $checkIn = $this->input->get('checkIn');
        $limit = 50;

        $attraction_data =  $this->attraction_lib->attraction_for_city($latitude,$longitude,$checkIn,$checkIn,$limit);
        $this->data['attr'] = $attraction_data;
        $this->data['child'] = $child;
        $this->data['adults'] = $adults;
        $this->data['latitude'] = $latitude;
        $this->data['longitude'] = $longitude;
        /*echo json_encode($attraction_data);
        exit();*/
        /*echo "asdas";*/
        $this->theme->view('attraction/attraction_listing', $this->data);
    }
    
    
    
    function html2canvasproxy(){
        $this->load->helper('html2canvas_helper');
        html2canvasproxy_h();
    }
}
