<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Attribute extends MY_Controller {

	private $auth;
    public function __construct(){
		parent::__construct();
		$this->auth = $this->my_auth->check();
		if($this->auth == NULL) $this->my_string->php_redirect(BASE_URL.'backend/home/index');
		$this->my_auth->allow($this->auth, 'backend/attribute');
	}
    
	public function index($page = 1){
		
	}
    public function group(){
		
		$this->my_auth->allow($this->auth, 'backend/attribute/group');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$continue = $this->input->get('continue');
		
		
	    $data['seo']['title'] = 'Nhóm thuộc tính';
		$_lang = $this->session->userdata('_lang');
		$data['data']['_list'] = $this->db->from('attribute_group')->where(array('lang' => $_lang))->get()->result_array();
		$data['data']['auth'] = $this->auth;
	    $data['template'] = 'backend/attribute/group';
	    $this->load->view('backend/layout/home',isset($data)?$data:NULL);
        
    }
	
	public function add(){
        
	    $this->my_auth->allow($this->auth, 'backend/attribute/add');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$data['seo']['title'] = 'Thêm thuộc tính';
		$continue = $this->input->get('continue');
		if($this->input->post('add')){
            
            $_post = $this->input->post('data');
            $data['data']['_post'] = $_post;
			$this->form_validation->set_error_delimiters('<li>','</li>');
            $this->form_validation->set_rules('data[name]','Tên nhóm thuộc tính','trim|required');
            
            if($this->form_validation->run() == TRUE){
                $_post = $this->my_string->allow_post($_post,array('name'));
                $_post['created'] = gmdate('Y-m-d H:i:s',time() + 7*3600);  
                $_post['lang'] = $this->session->userdata('_lang'); 
                $this->db->insert('attribute_group',$_post);
                $this->my_string->js_redirect('Thêm thuộc tính thành công!', !empty($continue)?base64_decode($continue):BASE_URL.'backend/attribute/group');
            }
            
        }
		else{
			$_post['publish'] = 1;
			$data['data']['_post'] = $_post;
		}
	 
	   $data['data']['auth'] = $this->auth;
	   $data['template'] = 'backend/attribute/add';
	   $this->load->view('backend/layout/home',$data);
        
    }
    
	public function edit($id){
        $this->my_auth->allow($this->auth, 'backend/attribute/edit');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$attribute = $this->db->where(array('id' => $id))->from('attribute_group')->get()->row_array();
		if(!isset($attribute) && count($attribute) == 0) $this->my_string->php_redirect(BASE_URL.'backend/attribute/group');
		if($attribute['lang'] != $this->session->userdata('_lang')) $this->my_string->js_redirect('Ngôn ngữ không phù hợp', !empty($continue)?base64_decode($continue):BASE_URL.'backend/attribute/index');
		$_post = $attribute;
	    $data['seo']['title'] = 'Sửa thuộc tính';
		$data['data']['auth'] = $this->auth;
		if($this->input->post('edit')){
            
            $_post = $this->input->post('data');
            $data['data']['_post'] = $_post;
			$this->form_validation->set_error_delimiters('<li>','</li>');
            
            $this->form_validation->set_rules('data[name]','Tên nhóm thuộc tính','trim|required');
            
            
			if($this->form_validation->run() == TRUE){
                $_post = $this->my_string->allow_post($_post,array('name'));
                $_post['updated'] = gmdate('Y-m-d H:i:s',time() + 7*3600);  
                $this->db->where(array('id' =>$id))->update('attribute',$_post);
                $this->my_string->js_redirect('Sửa thuộc tính thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/attribute/group');
            }
            
        }
		else{
			$data['data']['_post'] = $attribute;
		}
	 
	   $data['data']['auth'] = $this->auth;
	   $data['template'] = 'backend/attribute/edit';
	   $this->load->view('backend/layout/home',$data);
        
    }
	
    public function del($id){
        $this->my_auth->allow($this->auth, 'backend/attribute/del');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$attribute = $this->db->where(array('id' => $id))->from('attribute_group')->get()->row_array();
		if($attribute['lang'] != $this->session->userdata('_lang')) $this->my_string->js_redirect('Ngôn ngữ không phù hợp', BASE_URL.'backend/attribute/group');
		if(!isset($attribute) && count($attribute) == 0) $this->my_string->php_redirect(BASE_URL.'backend/attribute/group');
		
		$this->db->delete('attribute_group',array('id' =>$id));
		$this->my_string->js_redirect('Xóa thuộc tính thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/attribute/group');
    }
	
	
	public function set($field, $id){
        $this->my_auth->allow($this->auth, 'backend/attribute/set');
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$attribute = $this->db->where(array('id' => $id))->from('attribute_group')->get()->row_array();
		if(!isset($attribute) && count($attribute) == 0) $this->my_string->php_redirect(BASE_URL.'backend/attribute/group');
		
		if(!isset($attribute[$field])) $this->my_string->php_redirect(BASE_URL.'backend/attribute/group');
		
		$this->db->where(array('id' =>$id))->update('attribute_group',array($field =>(($attribute[$field] ==1)?0:1)));
        $this->my_string->js_redirect('Đồi trạng cáo thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/attribute/group');
	}
	
	
	public function item($page = 1){
		$this->my_auth->allow($this->auth, 'backend/attribute/item');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$continue = $this->input->get('continue');
		$_lang = $this->session->userdata('_lang');
		$parentid = (int)$this->input->get('parentid');
		
		
		//print_r($_parentid); die;
		//$attribute = $this->db->from('attribute_item')->join('attribute_group', 'attribute_group.id = attribute_item.attribute_id');

	    $data['seo']['title'] = 'Thuộc tính';
		
		
		$data['data']['_list'] = $this->db->from('attribute_item')->where(array('lang' => $_lang))->get()->result_array();
		
		$data['data']['_parentid'] = $parentid;
		$data['data']['auth'] = $this->auth;
	    //$data['data']['_show']['parentid'] = $this->my_nestedset->dropdown('attribute_category', NULL, 'item');
	    $data['template'] = 'backend/attribute/item';
	    $this->load->view('backend/layout/home',isset($data)?$data:NULL);
        
    }
	
	
	public function additem(){
		$this->my_auth->allow($this->auth, 'backend/attribute/additem');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$continue = $this->input->get('continue');
		$_lang = $this->session->userdata('_lang');
		$temp = $this->db->select('id, name')->from('attribute_group')->where(array('lang' => $_lang))->get()->result_array();
		foreach($temp as $key => $val){
			$_parentid[$val['id']] = $val['name']; 
		}
		if($this->input->post('add')){
            
            $_post = $this->input->post('data');
            //print_r($_post); die;
			$this->form_validation->set_error_delimiters('<li>','</li>');
            //$_post['userid_created'] = $this->auth['id'];  
            $this->form_validation->set_rules('data[name]','Tên thuộc tính','trim|required');
            $this->form_validation->set_rules('data[attribute_id]','Nhóm thuộc tính','trim|required|is_natural_no_zero');
            $data['data']['_post'] = $_post;
			if($this->form_validation->run() == TRUE){
                $_post = $this->my_string->allow_post($_post,array('name','attribute_id','lang'));
                $_post['created'] = gmdate('Y-m-d H:i:s',time() + 7*3600);  
                $_post['lang'] = $this->session->userdata('_lang'); 
				$this->db->insert('attribute_item',$_post);
                $this->my_string->js_redirect('Thêm bài viết thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/attribute/item');
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
		$data['template'] = 'backend/attribute/additem';
		$this->load->view('backend/layout/home',isset($data)?$data:NULL);
	
	 }
	 
	 public function check_route($route, $old_route){
		return $this->my_route->_route($route, isset($old_route)?$old_route:NULL);
	 }
	 
	public function edititem($id){
        $this->my_auth->allow($this->auth, 'backend/attribute/edititem');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$_lang = $this->session->userdata('_lang');
		$temp = $this->db->select('id, name')->from('attribute_group')->where(array('lang' => $_lang))->get()->result_array();
		foreach($temp as $key => $val){
			$_parentid[$val['id']] = $val['name']; 
		}
		$item = $this->db->where(array('id' => $id))->from('attribute_item')->get()->row_array();
		if($item['lang'] != $this->session->userdata('_lang')) $this->my_string->js_redirect('Ngôn ngữ không phù hợp', !empty($continue)?base64_decode($continue):BASE_URL.'backend/attribute/item');
		if(!isset($item) && count($item) == 0) $this->my_string->php_redirect(BASE_URL.'backend/attribute/item');
		$_post = $item;
		//echo $item['userid_created']; die;
	    //print_r($this->auth); die;
		
		if($this->auth['group_allow'] == 1 && count($this->auth['group_content'])  && in_array('backend/attribute/edititem/self', $this->auth['group_content']) == TRUE && $this->auth['id'] != $item['userid_created']) $this->my_string->js_redirect('Không được sửa bài của người khác', !empty($continue)?base64_decode($continue):BASE_URL.'backend/attribute/item');
		
		
		$data['seo']['title'] = 'Sửa thuộc tính';
		$data['data']['auth'] = $this->auth;
		if($this->input->post('edit')){
            
            $_post = $this->input->post('data');
            $data['data']['_post'] = $_post;
			$this->form_validation->set_error_delimiters('<li>','</li>');
            
            $this->form_validation->set_rules('data[name]','Tiêu đề','trim|required');
            $this->form_validation->set_rules('data[attribute_id]','Nhóm thuộc tính','trim|required|is_natural_no_zero');
			
           if($this->form_validation->run() == TRUE){
			  
                $_post = $this->my_string->allow_post($_post,array('title','parentid','tags','route','image','description','content','publish','highlight','timer','source','meta_title','meta_keyword','meta_description'));
                $_post['updated'] = gmdate('Y-m-d H:i:s',time() + 7*3600);  
                $this->db->where(array('id' =>$id))->update('attribute_item',$_post);
                 
				$this->my_string->js_redirect('Sửa thuộc tính thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/attribute/item');
            }
            
        }
		else{
			$data['data']['_post'] = $item;
		}
	 
	   $data['data']['_show']['parentid'] = $parentid;
	   $data['template'] = 'backend/attribute/edititem';
	   $this->load->view('backend/layout/home',$data);
        
    }
	
	public function delitem($id){
        $this->my_auth->allow($this->auth, 'backend/attribute/delitem');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$item = $this->db->where(array('id' => $id))->from('attribute_item')->get()->row_array();
		if(!isset($item) && count($item) == 0) $this->my_string->php_redirect(BASE_URL.'backend/attribute/item');
		
		$this->db->delete('attribute_item',array('id' =>$id));
	    $this->my_string->js_redirect('Xóa thuộc tính thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/attribute/item');
    }
	
	
	public function setitem($field, $id){
        $this->my_auth->allow($this->auth, 'backend/attribute/set');
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$item = $this->db->where(array('id' => $id))->from('attribute_item')->get()->row_array();
		if(!isset($item) && count($item) == 0) $this->my_string->php_redirect(BASE_URL.'backend/attribute/item');
		
		if(!isset($item[$field])) $this->my_string->php_redirect(BASE_URL.'backend/attribute/item');
		
		$this->db->where(array('id' =>$id))->update('attribute_item',array($field =>(($item[$field] ==1)?0:1)));
        $this->my_string->js_redirect('Đồi trạng cáo thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/attribute/item');
	}
}

