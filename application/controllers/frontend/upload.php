<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends MY_Controller {

	 public function __construct(){
		parent::__construct();
		$this->auth = $this->my_auth->check();
		$this->load->helper(array('form', 'url'));
	}
    
	public function user(){
		$config['upload_path'] = 'upload/user';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '200';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['overwrite']  = TRUE;
		$config['file_name']  = $this->auth['username'];
		
		$this->load->library('upload', $config);
		
		
		if ( ! $this->upload->do_upload())
		{
			$this->my_string->php_redirect(BASE_URL.'frontend/user/info');
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$this->load->view('frontend/user/upload_success', $data);
		}
	}
	
	
}