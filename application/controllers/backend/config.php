<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config extends MY_Controller {

	private $auth;
    public function __construct(){
		parent::__construct();
		$this->auth = $this->my_auth->check();
		if($this->auth == NULL) 
            $this->my_string->php_redirect(BASE_URL.'backend/home/index');
		$this->my_auth->allow($this->auth, 'backend/config');
	}
    
    
    public function index($group = 'frontend'){
        $this->my_auth->allow($this->auth, 'backend/config/index');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
        if(!isset($group) || empty($group))
			$this->my_string->php_redirect(BASE_URL.'backend/home/index');
		$_lang = $this->session->userdata('_lang');
		$config = $this->db->select('keyword,value_'.$_lang.',type,label')->where(array('group' => $group))->from('config')->get()->result_array();
		if(!isset($config) || count($config) == 0)$this->my_string->php_redirect(BASE_URL.'backend/home/index');
	   
	   $data['seo']['title'] = 'Cấu hình hệ thống';
	   
	   $_allow_post = NULL;
	   foreach($config as $key => $val){
		   $_allow_post[] = $val['keyword'];
	   }
	   
	   if($this->input->post('change')){
            
            $_post = $this->input->post('data');
            $data['data']['_post'] = $_post;
			
            $_post = $this->my_string->allow_post($_post,$_allow_post);
			$_data = NULL;
			
			foreach($_post as $keyPost => $valPost){
				$_data[] = array(
					'keyword' => $keyPost,
					'value_'.$_lang => $valPost,
					'update' => gmdate('Y-m-d H:i:s',time() + 7*3600),
				);
			}
			$this->db->update_batch('config',$_data,'keyword');
			$this->my_string->js_redirect('Cấu hình hệ thống thành công!',BASE_URL.'backend/config/index'); 
		}
        
		$data['data']['_config'] = $config;
		$data['data']['_group'] = $group;
		$data['data']['auth'] = $this->auth;
	    $data['template'] = 'backend/config/index';
	    $this->load->view('backend/layout/home',$data);
        
    }   
}

