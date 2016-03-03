<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
	
	public $_config;
	
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Saigon');
		
		//print_r($_SERVER); die;
		
		// Lang
		$_lang = 'vi';
		//Config
		$_data = $this->db->select('keyword, value_'.$_lang)->from('config')->where(array('publish' => 1))->get()->result_array();
		
		if(isset($_data) &&count($_data)){
			foreach($_data as $key => $val){
				$this->_config[$val['keyword']] = $val['value_'.$_lang];
			}
		}
		//print_r($_data); die;
	}
	
}