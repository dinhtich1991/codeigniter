<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends MY_Controller {

	private $auth;
    public function __construct(){
		parent::__construct();
		$this->auth = $this->my_auth->check();
	}
    
	public function gioithieu($lang = 'vi'){
		
		$this->load->view('frontend/layout/home',isset($data)?$data:NULL);
		
	}

    
    
}

