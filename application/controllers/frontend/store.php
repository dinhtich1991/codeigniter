<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store extends MY_Controller {

	 public function __construct(){
		parent::__construct();
		$this->auth = $this->my_auth->check();
		$this->load->helper(array('form', 'url'));
	}
    
	public function index(){
		
		
		$data['seo']['title'] = 'Hệ thống cửa hàng';
		$data['data']['user'] = $this->auth;
		$data['data']['user_face'] = $this->session->userdata('data[user_face]');
		$data['template'] = 'frontend/store/store';
	    $this->load->view('frontend/layout/home',$data);
	}
	
	
}