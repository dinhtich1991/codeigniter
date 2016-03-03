<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tag extends MY_Controller {

	private $auth;
    public function __construct(){
		parent::__construct();
		$this->auth = $this->my_auth->check();
		if($this->auth == NULL) $this->my_string->php_redirect(BASE_URL.'backend/home/index');
		$this->my_auth->allow($this->auth, 'backend/tag');
	}
    
    public function index($page = 1){
		
		$this->my_auth->allow($this->auth, 'backend/tag/index');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$sort = $this->my_common->sort_orderby($this->input->get('sort_field'),$this->input->get('sort_value'));
		
		$config = $this->my_common->backend_pagination();
		$config['base_url'] = 'backend/tag/index';
		
		if(!empty($keyword)){
			$config['total_rows'] = $this->db->from('tag')->like('title',$keyword)->count_all_results();
		}
		else{
			$config['total_rows'] = $this->db->from('tag')->count_all_results();
		}
		
		$_totalpage = ceil($config['total_rows']/$config['per_page']);
		$page = ($page > $_totalpage)?$_totalpage:$page;
		
		$config['uri_segment'] = 4;
		$config['suffix'] = (isset($sort) && count($sort))?'?sort_field='.$sort['field'].'&sort_value='.$sort['value']:'';
		$config['suffix'] = $config['suffix'].(!empty($keyword)?'&keyword='.$keyword:'');
		$config['first_url'] = $config['base_url'].$config['suffix'];
		if($config['total_rows'] > 0){
			$this->pagination->initialize($config);
			$data['data']['pagination'] = $this->pagination->create_links();
			if(!empty($keyword)){
				$data['data']['_list'] = $this->db->from('tag')->like('title',$keyword)->limit($config['per_page'],($page -1) * $config['per_page'])->order_by($sort['field'].' '.$sort['value'])->get()->result_array();
			}
			else{
				$data['data']['_list'] = $this->db->from('tag')->limit($config['per_page'],($page -1) * $config['per_page'])->order_by($sort['field'].' '.$sort['value'])->get()->result_array();
			}
		}
		$data['seo']['title'] = 'Chủ đề';
		$keyword = $this->input->get('keyword');
		$data['data']['_page'] = $page;
		$data['data']['_sort'] = $sort;
		$data['data']['_keyword'] = $keyword;
		$data['data']['_config'] = $config;
	   $data['data']['auth'] = $this->auth;
	   $data['template'] = 'backend/tag/index';
	   $this->load->view('backend/layout/home',isset($data)?$data:NULL);
        
    }
	
	public function add(){
        if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
	    $this->my_auth->allow($this->auth, 'backend/tag/add');
		$data['seo']['title'] = 'Thêm quảng cáo';
		$data['data']['auth'] = $this->auth;
		$continue = $this->input->get('continue');
		if($this->input->post('add')){
            
            $_post = $this->input->post('data');
            $data['data']['_post'] = $_post;
			$this->form_validation->set_error_delimiters('<li>','</li>');
            $_post['userid_created'] = $this->auth['id'];  
            $this->form_validation->set_rules('data[title]','Tiêu đề','trim|required|callback_check_title');
            if($this->form_validation->run() == TRUE){
                $_post = $this->my_string->allow_post($_post,array('title', 'publish','description','meta_title','meta_keyword','meta_description'));
                
				$_post['created'] = gmdate('Y-m-d H:i:s',time() + 7*3600);  
                $_post['userid_created'] = $this->auth['id'];  
				$_post['alias'] = $this->my_string->alias($_post['title']); 
				$this->db->insert('tag',$_post);
                $this->my_string->js_redirect('Thêm chủ đề thành công!', !empty($continue)?base64_decode($continue):BASE_URL.'backend/tag/index');
            }
            
        }
		else{
			$_post['publish'] = 1;
			$data['data']['_post'] = $_post;
		}
	 
	   
	   $data['template'] = 'backend/tag/add';
	   $this->load->view('backend/layout/home',$data);
        
    }
    
	public function edit($id){
        $this->my_auth->allow($this->auth, 'backend/tag/edit');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$tag = $this->db->where(array('id' => $id))->from('tag')->get()->row_array();
		if(!isset($tag) && count($tag) == 0) $this->my_string->php_redirect(BASE_URL.'backend/tag/index');
		$_post = $tag;
	    $data['seo']['title'] = 'Sửa chủ đề';
		$data['data']['auth'] = $this->auth;
		if($this->input->post('edit')){
            
            $_post = $this->input->post('data');
            $data['data']['_post'] = $_post;
			$this->form_validation->set_error_delimiters('<li>','</li>');
            
            $this->form_validation->set_rules('data[title]','Tiêu đề','trim|required|callback_check_title['.$tag['title'].']');
            
			if($this->form_validation->run() == TRUE){
                $_post = $this->my_string->allow_post($_post,array('title','publish','description','meta_title','meta_keyword','meta_description'));
                $_post['updated'] = gmdate('Y-m-d H:i:s',time() + 7*3600);  
                $_post['alias'] = $this->my_string->alias($_post['title']);
				$_post['userid_updated'] = $this->auth['id'];  
				$this->db->where(array('id' =>$id))->update('tag',$_post);
                $this->my_string->js_redirect('Sửa chủ đề thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/tag/index');
            }
            
        }
		else{
			
			$data['data']['_post'] = $tag;
		}
	 
	   
	   $data['template'] = 'backend/tag/edit';
	   $this->load->view('backend/layout/home',$data);
        
    }
	
    public function del($id){
        $this->my_auth->allow($this->auth, 'backend/tag/del');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$tag = $this->db->where(array('id' => $id))->from('tag')->get()->row_array();
		if(!isset($tag) && count($tag) == 0) $this->my_string->php_redirect(BASE_URL.'backend/tag/index');
		
		$this->db->delete('tag',array('id' =>$id));
		$this->my_string->js_redirect('Xóa chủ đề thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/tag/index');
    }
	public function check_title($title, $old_title){
		if(empty($old_title)){
			$count = $this->db->from('tag')->where(array('alias' => $this->my_string->alias($title)))->count_all_results();
		}
		else{
			$count = $this->db->from('tag')->where(array('alias' => $this->my_string->alias($title), 'alias !=' => $this->my_string->alias($old_title)))->count_all_results();
		}
		if($count > 0){
			$this->form_validation->set_message('check_title','Chủ đề đã tồn tại');
			return FALSE;
		}
		return TRUE;
	}
	
	public function set($field, $id){
        $this->my_auth->allow($this->auth, 'backend/tag/set');
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$tag = $this->db->where(array('id' => $id))->from('tag')->get()->row_array();
		if(!isset($tag) && count($tag) == 0) $this->my_string->php_redirect(BASE_URL.'backend/tag/index');
		
		if(!isset($tag[$field])) $this->my_string->php_redirect(BASE_URL.'backend/tag/index');
		
		$this->db->where(array('id' =>$id))->update('tag',array($field =>(($tag[$field] ==1)?0:1)));
        $this->my_string->js_redirect('Đồi trạng cáo thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/tag/index');
	}
	public function suggest($char = ''){
		$this->my_tags->suggest($char);
	}
	public function insert(){
		$item = $this->input->post('item');
		$list = $this->input->post('list');
		$this->my_tags->insert($item, $list);
	}
}

