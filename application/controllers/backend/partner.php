<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Partner extends MY_Controller {

	private $auth;
    public function __construct(){
		parent::__construct();
		$this->auth = $this->my_auth->check();
		if($this->auth == NULL) $this->my_string->php_redirect(BASE_URL.'backend/home/index');
		$this->my_auth->allow($this->auth, 'backend/partner');
	}
    
    public function index($page = 1){
		
		$this->my_auth->allow($this->auth, 'backend/partner/index');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$continue = $this->input->get('continue');
		if($this->input->post('sort')){
			$_order = $this->input->post('order');
			if(isset($_order) && count($_order)){
				foreach($_order as $key =>$val){
					$_data[] = array(
						'id' =>$key,
						'order' =>(int)$val,
					);
				}
				$this->db->update_batch('partner',$_data,'id');
				$this->my_string->js_redirect('Sắp xếp thành công!', !empty($continue)?base64_decode($continue):BASE_URL.'backend/partner/index');
			}
		}
		
		$sort = $this->my_common->sort_orderby($this->input->get('sort_field'),$this->input->get('sort_value'));
		
	    $data['seo']['title'] = 'Đối tác';
		$keyword = $this->input->get('keyword');
		$config = $this->my_common->backend_pagination();
		$config['base_url'] = 'backend/partner/index';
		
		if(!empty($keyword)){
			$config['total_rows'] = $this->db->from('partner')->like('title',$keyword)->count_all_results();
		}
		else{
			$config['total_rows'] = $this->db->from('partner')->count_all_results();
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
				$data['data']['_list'] = $this->db->from('partner')->like('title',$keyword)->limit($config['per_page'],($page -1) * $config['per_page'])->order_by($sort['field'].' '.$sort['value'])->get()->result_array();
			}
			else{
				$data['data']['_list'] = $this->db->from('partner')->limit($config['per_page'],($page -1) * $config['per_page'])->order_by($sort['field'].' '.$sort['value'])->get()->result_array();
			}
		}
		
		$data['data']['_page'] = $page;
		$data['data']['_sort'] = $sort;
		$data['data']['_keyword'] = $keyword;
		$data['data']['_config'] = $config;
	   $data['data']['auth'] = $this->auth;
	   $data['template'] = 'backend/partner/index';
	   $this->load->view('backend/layout/home',isset($data)?$data:NULL);
        
    }
	
	public function add(){
        
	    $this->my_auth->allow($this->auth, 'backend/partner/add');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$data['seo']['title'] = 'Thêm đối tác';
		$data['data']['auth'] = $this->auth;
		$continue = $this->input->get('continue');
		if($this->input->post('add')){
            
            $_post = $this->input->post('data');
            $data['data']['_post'] = $_post;
			$this->form_validation->set_error_delimiters('<li>','</li>');
            $_post['userid_created'] = $this->auth['id'];  
            $this->form_validation->set_rules('data[title]','Tiêu đề','trim|required');
            if($this->form_validation->run() == TRUE){
                $_post = $this->my_string->allow_post($_post,array('title','url','image','publish'));
               
				$_post['created'] = gmdate('Y-m-d H:i:s',time() + 7*3600);  
                $_post['userid_created'] = $this->auth['id'];  
				$this->db->insert('partner',$_post);
                $this->my_string->js_redirect('Thêm Đối tác thành công!', !empty($continue)?base64_decode($continue):BASE_URL.'backend/partner/index');
            }
            
        }
		else{
			$_post['publish'] = 1;
			$data['data']['_post'] = $_post;
		}
	 
	   
	   $data['template'] = 'backend/partner/add';
	   $this->load->view('backend/layout/home',$data);
        
    }
    
	public function edit($id){
        $this->my_auth->allow($this->auth, 'backend/partner/edit');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$partner = $this->db->where(array('id' => $id))->from('partner')->get()->row_array();
		if(!isset($partner) && count($partner) == 0) $this->my_string->php_redirect(BASE_URL.'backend/partner/index');
		$_post = $partner;
	    $data['seo']['title'] = 'Sửa đối tác';
		$data['data']['auth'] = $this->auth;
		if($this->input->post('edit')){
            
            $_post = $this->input->post('data');
            $data['data']['_post'] = $_post;
			$this->form_validation->set_error_delimiters('<li>','</li>');
            
            $this->form_validation->set_rules('data[title]','Tiêu đề','trim|required');
            
			if($this->form_validation->run() == TRUE){
                $_post = $this->my_string->allow_post($_post,array('title','url','image','publish'));
                $_post['updated'] = gmdate('Y-m-d H:i:s',time() + 7*3600);  
               
				$_post['userid_updated'] = $this->auth['id'];  
				$this->db->where(array('id' =>$id))->update('partner',$_post);
                $this->my_string->js_redirect('Sửa đối tác thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/partner/index');
            }
            
        }
		else{
			
			$data['data']['_post'] = $partner;
		}
	 
	   
	   $data['template'] = 'backend/partner/edit';
	   $this->load->view('backend/layout/home',$data);
        
    }
	
    public function del($id){
        $this->my_auth->allow($this->auth, 'backend/partner/del');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$partner = $this->db->where(array('id' => $id))->from('partner')->get()->row_array();
		if(!isset($partner) && count($partner) == 0) $this->my_string->php_redirect(BASE_URL.'backend/partner/index');
		
		$this->db->delete('partner',array('id' =>$id));
		$this->my_string->js_redirect('Xóa đối tác thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/partner/index');
    }
	
	
	public function set($field, $id){
        $this->my_auth->allow($this->auth, 'backend/partner/set');
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$partner = $this->db->where(array('id' => $id))->from('partner')->get()->row_array();
		if(!isset($partner) && count($partner) == 0) $this->my_string->php_redirect(BASE_URL.'backend/partner/index');
		
		if(!isset($partner[$field])) $this->my_string->php_redirect(BASE_URL.'backend/partner/index');
		
		$this->db->where(array('id' =>$id))->update('partner',array($field =>(($partner[$field] ==1)?0:1)));
        $this->my_string->js_redirect('Đồi trạng thái thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/partner/index');
	}
}

