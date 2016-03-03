<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store extends MY_Controller {

	private $auth;
    public function __construct(){
		parent::__construct();
		$this->auth = $this->my_auth->check();
		if($this->auth == NULL) $this->my_string->php_redirect(BASE_URL.'backend/home/index');
		$this->my_auth->allow($this->auth, 'backend/store');
	}
    
	public function index(){
		
		$this->my_auth->allow($this->auth, 'backend/store/index');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$continue = $this->input->get('continue');
		
		
	    $data['seo']['title'] = 'Hệ thống cửa hàng';
		$_lang = $this->session->userdata('_lang');
		$data['data']['_list'] = $this->db->from('store')->where(array('lang' => $_lang))->get()->result_array();
		$data['data']['auth'] = $this->auth;
	    $data['template'] = 'backend/store/index';
	    $this->load->view('backend/layout/home',isset($data)?$data:NULL);
        
    }
	
	public function add(){
        
	    $this->my_auth->allow($this->auth, 'backend/store/add');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$data['seo']['title'] = 'Thêm hệ thống store';
		$continue = $this->input->get('continue');
		if($this->input->post('add')){
            
            $_post = $this->input->post('data');
			
            $data['data']['_post'] = $_post;
			$this->form_validation->set_error_delimiters('<li>','</li>');
            $this->form_validation->set_rules('data[name]','Tên hệ thống store','trim|required');
            
            if($this->form_validation->run() == TRUE){
                
				$_post = $this->my_string->allow_post($_post,array('name', 'public'));
               // print_r($_post); die;
			    $_post['created'] = gmdate('Y-m-d H:i:s',time() + 7*3600);  
                $_post['lang'] = $this->session->userdata('_lang'); 
                $this->db->insert('store',$_post);
                $this->my_string->js_redirect('Thêm hệ thống store thành công!', !empty($continue)?base64_decode($continue):BASE_URL.'backend/store/index');
            }
            
        }
		else{
			$_post['public'] = 1;
			$data['data']['_post'] = $_post;
		}
	 
	   $data['data']['auth'] = $this->auth;
	   $data['template'] = 'backend/store/add';
	   $this->load->view('backend/layout/home',$data);
        
    }
    
	public function edit($id){
        $this->my_auth->allow($this->auth, 'backend/store/edit');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$store = $this->db->where(array('id' => $id))->from('store')->get()->row_array();
		if(!isset($store) && count($store) == 0) $this->my_string->php_redirect(BASE_URL.'backend/store/index');
		if($store['lang'] != $this->session->userdata('_lang')) $this->my_string->js_redirect('Ngôn ngữ không phù hợp', !empty($continue)?base64_decode($continue):BASE_URL.'backend/store/index');
		$_post = $store;
	    $data['seo']['title'] = 'Sửa hệ thống store';
		$data['data']['auth'] = $this->auth;
		if($this->input->post('edit')){
            
            $_post = $this->input->post('data');
            $data['data']['_post'] = $_post;
			$this->form_validation->set_error_delimiters('<li>','</li>');
            
            $this->form_validation->set_rules('data[name]','Tên hệ thống store','trim|required');
            
            
			if($this->form_validation->run() == TRUE){
                $_post = $this->my_string->allow_post($_post,array('name', 'public'));
                $_post['updated'] = gmdate('Y-m-d H:i:s',time() + 7*3600);  
                $this->db->where(array('id' =>$id))->update('store',$_post);
                $this->my_string->js_redirect('Sửa hệ thống store thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/store/index');
            }
            
        }
		else{
			$data['data']['_post'] = $store;
		}
	 
	   $data['data']['auth'] = $this->auth;
	   $data['template'] = 'backend/store/edit';
	   $this->load->view('backend/layout/home',$data);
        
    }
	
    public function del($id){
        $this->my_auth->allow($this->auth, 'backend/store/del');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$store = $this->db->where(array('id' => $id))->from('store')->get()->row_array();
		if($store['lang'] != $this->session->userdata('_lang')) $this->my_string->js_redirect('Ngôn ngữ không phù hợp', BASE_URL.'backend/store/index');
		if(!isset($store) && count($store) == 0) $this->my_string->php_redirect(BASE_URL.'backend/store/index');
		
		$this->db->delete('store',array('id' =>$id));
		$this->my_string->js_redirect('Xóa hệ thống store thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/store/index');
    }
	
	
	public function set($field, $id){
        $this->my_auth->allow($this->auth, 'backend/store/set');
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$store = $this->db->where(array('id' => $id))->from('store')->get()->row_array();
		if(!isset($store) && count($store) == 0) $this->my_string->php_redirect(BASE_URL.'backend/store/index');
		
		if(!isset($store[$field])) $this->my_string->php_redirect(BASE_URL.'backend/store/index');
		
		$this->db->where(array('id' =>$id))->update('store',array($field =>(($store[$field] ==1)?0:1)));
        $this->my_string->js_redirect('Đồi trạng cáo thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/store/index');
	}
	
	
	public function item($page = 1){
		$this->my_auth->allow($this->auth, 'backend/store/item');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$continue = $this->input->get('continue');
		$_lang = $this->session->userdata('_lang');
		$parentid = (int)$this->input->get('parentid');
		
		
		//print_r($_parentid); die;
		//$store = $this->db->from('store_detail')->join('store', 'store.id = store_detail.store_id');

	    $data['seo']['title'] = 'Chi tiết hệ thống store';
		
		
		$data['data']['_list'] = $this->db->from('store_detail')->where(array('lang' => $_lang))->get()->result_array();
		
		$data['data']['_parentid'] = $parentid;
		$data['data']['auth'] = $this->auth;
	    //$data['data']['_show']['parentid'] = $this->my_nestedset->dropdown('store_category', NULL, 'item');
	    $data['template'] = 'backend/store/item';
	    $this->load->view('backend/layout/home',isset($data)?$data:NULL);
        
    }
	
	
	public function additem(){
		$this->my_auth->allow($this->auth, 'backend/store/additem');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$continue = $this->input->get('continue');
		$_lang = $this->session->userdata('_lang');
		$temp = $this->db->select('id, name')->from('store')->where(array('lang' => $_lang))->get()->result_array();
		foreach($temp as $key => $val){
			$_parentid[$val['id']] = $val['name']; 
		}
		if($this->input->post('add')){
            
            $_post = $this->input->post('data');
            //print_r($_post); die;
			$this->form_validation->set_error_delimiters('<li>','</li>');
            //$_post['userid_created'] = $this->auth['id'];  
            $this->form_validation->set_rules('data[name]','Tên thuộc tính','trim|required');
            $this->form_validation->set_rules('data[store_id]','Nhóm thuộc tính','trim|required|is_natural_no_zero');
            $data['data']['_post'] = $_post;
			if($this->form_validation->run() == TRUE){
                $_post = $this->my_string->allow_post($_post,array('name','store_id','lang'));
                $_post['created'] = gmdate('Y-m-d H:i:s',time() + 7*3600);  
                $_post['lang'] = $this->session->userdata('_lang'); 
				$this->db->insert('store_detail',$_post);
                $this->my_string->js_redirect('Thêm bài viết thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/store/item');
            }
            
        }
		else{
			//$_post['timer'] = ($_post['timer'] !='1970-01-01 07:00:00')?gmdate('H:i:s d/m/Y', strtotime($_post['timer']) + 7*3600):'';
			$_post['publish'] = 1;
			$data['data']['_post'] = $_post;
		}
		$data['seo']['title'] = 'Thêm bài viết';
		$data['data']['auth'] = $this->auth;
		$data['data']['_show']['parentid'] = $_parentid;
		$data['template'] = 'backend/store/additem';
		$this->load->view('backend/layout/home',isset($data)?$data:NULL);
	
	 }
	 
	 public function check_route($route, $old_route){
		return $this->my_route->_route($route, isset($old_route)?$old_route:NULL);
	 }
	 
	public function edititem($id){
        $this->my_auth->allow($this->auth, 'backend/store/edititem');
		if($this->auth['index_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$_lang = $this->session->userdata('_lang');
		$temp = $this->db->select('id, name')->from('store')->where(array('lang' => $_lang))->get()->result_array();
		foreach($temp as $key => $val){
			$_parentid[$val['id']] = $val['name']; 
		}
		$item = $this->db->where(array('id' => $id))->from('store_detail')->get()->row_array();
		if($item['lang'] != $this->session->userdata('_lang')) $this->my_string->js_redirect('Ngôn ngữ không phù hợp', !empty($continue)?base64_decode($continue):BASE_URL.'backend/store/item');
		if(!isset($item) && count($item) == 0) $this->my_string->php_redirect(BASE_URL.'backend/store/item');
		$_post = $item;
		//echo $item['userid_created']; die;
	    //print_r($this->auth); die;
		
		if($this->auth['index_allow'] == 1 && count($this->auth['index_content'])  && in_array('backend/store/edititem/self', $this->auth['index_content']) == TRUE && $this->auth['id'] != $item['userid_created']) $this->my_string->js_redirect('Không được sửa bài của người khác', !empty($continue)?base64_decode($continue):BASE_URL.'backend/store/item');
		
		
		$data['seo']['title'] = 'Sửa thuộc tính';
		$data['data']['auth'] = $this->auth;
		if($this->input->post('edit')){
            
            $_post = $this->input->post('data');
            $data['data']['_post'] = $_post;
			$this->form_validation->set_error_delimiters('<li>','</li>');
            
            $this->form_validation->set_rules('data[name]','Tiêu đề','trim|required');
            $this->form_validation->set_rules('data[store_id]','Nhóm thuộc tính','trim|required|is_natural_no_zero');
			
           if($this->form_validation->run() == TRUE){
			  
                $_post = $this->my_string->allow_post($_post,array('title','parentid','tags','route','image','description','content','publish','highlight','timer','source','meta_title','meta_keyword','meta_description'));
                $_post['updated'] = gmdate('Y-m-d H:i:s',time() + 7*3600);  
                $this->db->where(array('id' =>$id))->update('store_detail',$_post);
                 
				$this->my_string->js_redirect('Sửa thuộc tính thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/store/item');
            }
            
        }
		else{
			$data['data']['_post'] = $item;
		}
	 
	   $data['data']['_show']['parentid'] = $parentid;
	   $data['template'] = 'backend/store/edititem';
	   $this->load->view('backend/layout/home',$data);
        
    }
	
	public function delitem($id){
        $this->my_auth->allow($this->auth, 'backend/store/delitem');
		if($this->auth['index_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$item = $this->db->where(array('id' => $id))->from('store_detail')->get()->row_array();
		if(!isset($item) && count($item) == 0) $this->my_string->php_redirect(BASE_URL.'backend/store/item');
		
		$this->db->delete('store_detail',array('id' =>$id));
	    $this->my_string->js_redirect('Xóa thuộc tính thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/store/item');
    }
	
	
	public function setitem($field, $id){
        $this->my_auth->allow($this->auth, 'backend/store/set');
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$item = $this->db->where(array('id' => $id))->from('store_detail')->get()->row_array();
		if(!isset($item) && count($item) == 0) $this->my_string->php_redirect(BASE_URL.'backend/store/item');
		
		if(!isset($item[$field])) $this->my_string->php_redirect(BASE_URL.'backend/store/item');
		
		$this->db->where(array('id' =>$id))->update('store_detail',array($field =>(($item[$field] ==1)?0:1)));
        $this->my_string->js_redirect('Đồi trạng cáo thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/store/item');
	}
}

