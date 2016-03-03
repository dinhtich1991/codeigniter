<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Intro extends MY_Controller {

	private $auth;
    public function __construct(){
		parent::__construct();
		$this->auth = $this->my_auth->check();
	}
    
	public function index(){
		
		
		
		
		$data['data']['user'] = $this->auth;
		$data['data']['user_face'] = $this->session->userdata('data[user_face]');
		$data['seo']['title'] = 'Giới thiệu';
		$data['template'] = 'frontend/intro/index';
		$this->load->view('frontend/layout/home',isset($data)?$data:NULL);
		
	}

    
    
}

