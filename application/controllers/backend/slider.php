<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class slider extends MY_Controller {

	private $auth;
    public function __construct(){
		parent::__construct();
		$this->auth = $this->my_auth->check();
		if($this->auth == NULL) $this->my_string->php_redirect(BASE_URL.'backend/home/index');
		$this->my_auth->allow($this->auth, 'backend/slider');
	}
    
    public function index($page = 1){
		
		$this->my_auth->allow($this->auth, 'backend/slider/index');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$continue = $this->input->get('continue');
		
		
		$sort = $this->my_common->sort_orderby($this->input->get('sort_field'),$this->input->get('sort_value'));
		
	    $data['seo']['title'] = 'slider';
		$config = $this->my_common->backend_pagination();
		$config['base_url'] = 'backend/slider/index';
		$config['total_rows'] = $this->db->from('slider')->count_all_results();
		$_totalpage = ceil($config['total_rows']/$config['per_page']);
		$page = ($page > $_totalpage)?$_totalpage:$page;
		$config['uri_segment'] = 4;
		$data['data']['_list'] = $this->db->from('slider')->get()->result_array();
		$data['data']['_config'] = $config;
	   $data['data']['auth'] = $this->auth;
	   $data['template'] = 'backend/slider/index';
	   $this->load->view('backend/layout/home',isset($data)?$data:NULL);
        
    }
	
	public function add(){
        
	    $this->my_auth->allow($this->auth, 'backend/slider/add');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$data['seo']['title'] = 'Thêm slider';
		$data['data']['auth'] = $this->auth;
		$continue = $this->input->get('continue');
		if($this->input->post('add')){
            
            $_post = $this->input->post('data');
            $data['data']['_post'] = $_post;
			$this->form_validation->set_error_delimiters('<li>','</li>');
            $_post['userid_created'] = $this->auth['id'];  
			$this->form_validation->set_rules('data[title]','Tiêu đề','trim|required');
            $this->form_validation->set_rules('data[image1]','Hình ảnh','trim|required');
            if($this->form_validation->run() == TRUE){
                $_post = $this->my_string->allow_post($_post,array('image1','image2','image3','image4','image5','publish'));
               $_post['created'] = gmdate('Y-m-d H:i:s',time() + 7*3600);  
                $_post['userid_created'] = $this->auth['id'];  
				$this->db->insert('slider',$_post);
                $this->my_string->js_redirect('Thêm slider thành công!', !empty($continue)?base64_decode($continue):BASE_URL.'backend/slider/index');
            }
            
        }
		else{
			$_post['publish'] = 1;
			$data['data']['_post'] = $_post;
		}
	 
	   
	   $data['template'] = 'backend/slider/add';
	   $this->load->view('backend/layout/home',$data);
        
    }
    
	public function edit($id){
        $this->my_auth->allow($this->auth, 'backend/slider/edit');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$id = (int)$id;
		$slider = $this->db->where(array('id' => $id))->from('slider')->get()->row_array();
		if(!isset($slider) && count($slider) == 0) $this->my_string->php_redirect(BASE_URL.'backend/slider/index');
		$_post = $slider;
	    $data['seo']['title'] = 'Sửa slider';
		$data['data']['auth'] = $this->auth;
		if($this->input->post('edit')){
            
            $_post = $this->input->post('data');
            $data['data']['_post'] = $_post;
			$this->form_validation->set_error_delimiters('<li>','</li>');
            
            $this->form_validation->set_rules('data[title]','Tiêu đề','trim|required');
            $this->form_validation->set_rules('data[image1]','Hình ảnh','trim|required');
			
			if($this->form_validation->run() == TRUE){
                $_post = $this->my_string->allow_post($_post,array('image1','image2','image3','image4','image5','publish'));
                $_post['updated'] = gmdate('Y-m-d H:i:s',time() + 7*3600);  
               $_post['userid_updated'] = $this->auth['id'];  
				$this->db->where(array('id' =>$id))->update('slider',$_post);
                $this->my_string->js_redirect('Sửa slider thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/slider/index');
            }
            
        }
		else{
			
			$data['data']['_post'] = $slider;
		}
	 
	   
	   $data['template'] = 'backend/slider/edit';
	   $this->load->view('backend/layout/home',$data);
        
    }
	
    public function del($id){
        $this->my_auth->allow($this->auth, 'backend/slider/del');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$slider = $this->db->where(array('id' => $id))->from('slider')->get()->row_array();
		if(!isset($slider) && count($slider) == 0) $this->my_string->php_redirect(BASE_URL.'backend/slider/index');
		
		$this->db->delete('slider',array('id' =>$id));
		$this->my_string->js_redirect('Xóa slider thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/slider/index');
    }
	
	
	public function set($field, $id){
        $this->my_auth->allow($this->auth, 'backend/slider/set');
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$slider = $this->db->where(array('id' => $id))->from('slider')->get()->row_array();
		if(!isset($slider) && count($slider) == 0) $this->my_string->php_redirect(BASE_URL.'backend/slider/index');
		
		if(!isset($slider[$field])) $this->my_string->php_redirect(BASE_URL.'backend/slider/index');
		
		$this->db->where(array('id' =>$id))->update('slider',array($field =>(($slider[$field] ==1)?0:1)));
        $this->my_string->js_redirect('Đồi trạng thái thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/slider/index');
	}
}

