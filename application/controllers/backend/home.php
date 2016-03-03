<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	private $auth;
    public function __construct(){
		parent::__construct();
		$this->auth = $this->my_auth->check();
	}
    
	public function index($lang = 'vi'){
		$this->my_frontend->lang($lang);
		if($this->auth == NULL) $this->my_string->php_redirect(BASE_URL.'backend/auth/login');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$data['data']['auth'] = $this->auth;
		$data['template'] = 'backend/home/index';
		$this->load->view('backend/layout/home',isset($data)?$data:NULL);
	   
       }
    public function lang($lang = 'vi'){
		$continue = $this->input->get('continue');
		if(!empty($lang) && in_array($lang,array('jp','vi','en'))){
			$this->session->set_userdata('_lang', $lang);
			$this->my_string->js_redirect('Chuyển đổi ngôn ngữ thành công', !empty($continue)?base64_decode($continue):BASE_URL.'backend/home/index');
		}
		else{
			$this->my_string->js_redirect('Ngôn ngữ không tồn tại', BASE_URL.'backend/home/index');
		}
    }

    
    
}

