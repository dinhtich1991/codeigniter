<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends MY_Controller {

	 public function __construct(){
		parent::__construct();
		$this->auth = $this->my_auth->check();
		$this->load->library('cart');
		$this->load->helper('url');
		//$this->load->library('session');
	}
    
	public function index(){
		$_auth = $this->session->userdata('data[user_face]');
		if($this->auth == NULL && !isset($_auth))  $this->my_string->js_redirect('Vui lòng đăng nhập!',BASE_URL);
		if($this->input->post('cart')){
			$_post = $this->input->post('data');
			$color = $this->db->select('id, name')->from('attribute_item')->where(array('id' => $_post['thuoctinh0']))->get()->row_array();
			$size = $this->db->select('id, name')->from('attribute_item')->where(array('id' => $_post['thuoctinh1']))->get()->row_array();
			//print_r($attri); die;
			$options = array(
				'Màu sắc' => $color['name'],
				'Size' => $size['name']
			);
			$data = array(
			   'id'      => $_post['id'],
			   'qty'     => $_post['qty'],
			   'price'   => $_post['price'],
			   'name'    => $_post['name'],
			   'options' => $options
			);
			$this->cart->insert($data);
			//sprint_r($data); die;
		}
		
		
		/*
		//if($this->auth == NULL) $this->my_string->php_redirect(BASE_URL);
		$this->load->model('cart/product_model');
		$items = $this->product_model->get_item($id);
		$item = $this->db->where(array('id' => $id))->from('article_item')->get()->row_array();
		$_temp = explode(',',$item['attribute_id']);
		if(isset($_temp) && !empty($_temp)){
			$att = '';
			foreach($_temp as $key => $val){
				$att[] = $this->db->select('id, name, attribute_id')->where(array('id' => trim($val)))->from('attribute_item')->get()->row_array();
			}
			//print_r($att); die;
			$tam = array_pop($att);
			foreach($att as $k => $v){
				if(isset($att) && !empty($att)){
					//echo $v['attribute_id']; 
					$tt[] = $this->db->select('id, name')->from('attribute_group')->where(array('id' =>$v['attribute_id']))->get()->row_array();
					
				}
			}
			//print_r($att); 
			//print_r($tt); die;
			foreach($tt as $key => $val){
				foreach($att as $k => $v){
					if($val['id'] == $v['attribute_id']){
						$options[$val['name']] = $v['name']; 
					}
				}
			}
			
		}
		*/
		
		
		//$this->session->set_userdata('cart', $data);
		$data['data']['user'] = $this->auth;
		$data['template'] = 'frontend/cart/index';
		$this->load->view('frontend/layout/home',$data?$data:NULL);
	}
	
	public function delete_item($rowid = 0){
		$data = array(
			'rowid' => $rowid,
			'qty' => 0
		);
		$this->cart->update($data);
		redirect('frontend/cart/index');
	}
	
	public function update(){
		$cart_info = $_POST['cart'] ;
		//print_r($cart_info); die;
		foreach( $cart_info as $id => $cart)
		{
			$data = array(
			'rowid' => $cart['rowid'],
			'qty' => $cart['qty']
			);       
			$this->cart->update($data);
		}
		
		//print_r($data); die;
	   redirect('frontend/cart/index');
}
	
}