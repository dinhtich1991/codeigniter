<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	private $auth;
    public function __construct(){
		parent::__construct();
		$this->auth = $this->my_auth->check();
		 $this->load->helper('url');
		$this->load->library('session');
	}
    
	public function index($lang = 'vi'){
		$data['data']['user'] = $this->auth;
		$this->my_frontend->lang($lang);
		$slider = $this->db->select('image1, image2, image3, image4, image5 ')->from('slider')->get()->row_array();
		$data['data']['_slider'] = $slider;
		
		//$this->load->library('facebook'); // Automatically picks appId and secret from config
        // OR
        // You can pass different one like this
        //$this->load->library('facebook', array(
        //    'appId' => 'APP_ID',
        //    'secret' => 'SECRET',
        //    ));
		//$this->load->library('base_facebook');
		//$user = $this->facebook->getUser();
        
       // if ($user) {
        //    try {
        //       $data['user_profile'] = $this->facebook->api('/me');
        //    } catch (FacebookApiException $e) {
        //        $user = null;
        //    }
			//print_r($data['user_profile']);
        //}else {
        //    $this->facebook->destroySession();
			
        //}

        //if($user){
		//	$temp = $_REQUEST;
		//	$data['data']['user_face'] = $temp;
		$data['data']['user_face'] = $this->session->userdata('data[user_face]');
        
        
		
		
		$data['seo']['title'] = 'Trang chủ Gen Việt';
		$data['template'] = 'frontend/home/index';
		$this->load->view('frontend/layout/home',$data?$data:NULL);
		
	}

    

    public function logout(){

        $this->load->library('facebook');

        // Logs off session from website
        $this->facebook->destroySession();
        // Make sure you destory website session as well.

        redirect('/');
    }
    
}

