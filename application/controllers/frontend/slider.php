<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slider extends MY_Controller {

	 public function __construct(){
		parent::__construct();
	}
    
    public function index(){
		
		$_lang = $this->session->userdata('_lang');
		
		//echo $_lang; die;
		
		$slider = $this->db->select('image1, image2, image3, image4, image5 ')->from('slider')->get()->result_array();
		$data['data']['_slider'] = $slider;
		
		print_r($data);die;
		
		$this->load->view('frontend/home/index',$data?$data:NULL);
	}
    
}

