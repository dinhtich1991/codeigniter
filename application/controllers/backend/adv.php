<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adv extends MY_Controller {

	private $auth;
    public function __construct(){
		parent::__construct();
		$this->auth = $this->my_auth->check();
		if($this->auth == NULL) $this->my_string->php_redirect(BASE_URL.'backend/home/index');
		$this->my_auth->allow($this->auth, 'backend/adv');
	}
    
    public function index($page = 1){
		
		$this->my_auth->allow($this->auth, 'backend/adv/index');
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
				$this->db->update_batch('adv',$_data,'id');
				$this->my_string->js_redirect('Sắp xếp thành công!', !empty($continue)?base64_decode($continue):BASE_URL.'backend/adv/index');
			}
		}
		
		$sort = $this->my_common->sort_orderby($this->input->get('sort_field'),$this->input->get('sort_value'));
		
	    $data['seo']['title'] = 'Quảng cáo';
		$_lang = $this->session->userdata('_lang');
		$keyword = $this->input->get('keyword');
		$config = $this->my_common->backend_pagination();
		$config['base_url'] = 'backend/adv/index';
		
		if(!empty($keyword)){
			$config['total_rows'] = $this->db->from('adv')->like('title',$keyword)->where(array('lang' => $_lang))->count_all_results();
		}
		else{
			$config['total_rows'] = $this->db->from('adv')->where(array('lang' => $_lang))->count_all_results();
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
				$data['data']['_list'] = $this->db->from('adv')->like('title',$keyword)->where(array('lang' => $_lang))->limit($config['per_page'],($page -1) * $config['per_page'])->order_by($sort['field'].' '.$sort['value'])->get()->result_array();
			}
			else{
				$data['data']['_list'] = $this->db->from('adv')->where(array('lang' => $_lang))->limit($config['per_page'],($page -1) * $config['per_page'])->order_by($sort['field'].' '.$sort['value'])->get()->result_array();
			}
		}
		
		$data['data']['_page'] = $page;
		$data['data']['_sort'] = $sort;
		$data['data']['_keyword'] = $keyword;
		$data['data']['_config'] = $config;
	   $data['data']['auth'] = $this->auth;
	   $data['template'] = 'backend/adv/index';
	   $this->load->view('backend/layout/home',isset($data)?$data:NULL);
        
    }
	
	public function add(){
        
	    $this->my_auth->allow($this->auth, 'backend/adv/add');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$data['seo']['title'] = 'Thêm quảng cáo';
		$data['data']['auth'] = $this->auth;
		$continue = $this->input->get('continue');
		if($this->input->post('add')){
            
            $_post = $this->input->post('data');
            $data['data']['_post'] = $_post;
			$this->form_validation->set_error_delimiters('<li>','</li>');
            $_post['userid_created'] = $this->auth['id'];  
            $this->form_validation->set_rules('data[title]','Tiêu đề','trim|required');
            $this->form_validation->set_rules('data[time_start]','Ngày bắt đầu','trim|required|callback_check_date['.json_encode(array('time_start' =>$_post['time_start'],'time_end' => $_post['time_end'])).']');
            $this->form_validation->set_rules('data[time_end]','ngày kết thúc','trim|required');
            $this->form_validation->set_rules('data[content]','Nội dung','trim|required');
            $this->form_validation->set_rules('data[position]','Vị trí','trim|required');
            
			if($this->form_validation->run() == TRUE){
                $_post = $this->my_string->allow_post($_post,array('title','content','position','time_start','time_end','publish'));
                $_post['time_start'] = gmdate('Y-m-d H:i:s',strtotime(str_replace('/','-',$_post['time_start'])) + 7*3600);  
                $_post['time_end'] = gmdate('Y-m-d H:i:s',strtotime(str_replace('/','-',$_post['time_end'])) + 7*3600);  
                
				$_post['created'] = gmdate('Y-m-d H:i:s',time() + 7*3600);  
                $_post['userid_created'] = $this->auth['id'];  
				$_post['lang'] = $this->session->userdata('_lang'); 
                $this->db->insert('adv',$_post);
                $this->my_string->js_redirect('Thêm quảng cáo thành công!', !empty($continue)?base64_decode($continue):BASE_URL.'backend/adv/index');
            }
            
        }
		else{
			$_post['publish'] = 1;
			$data['data']['_post'] = $_post;
		}
	 
	   
	   $data['template'] = 'backend/adv/add';
	   $this->load->view('backend/layout/home',$data);
        
    }
    
	public function edit($id){
        $this->my_auth->allow($this->auth, 'backend/adv/edit');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$adv = $this->db->where(array('id' => $id))->from('adv')->get()->row_array();
		if(!isset($adv) && count($adv) == 0) $this->my_string->php_redirect(BASE_URL.'backend/adv/index');
		if($adv['lang'] != $this->session->userdata('_lang')) $this->my_string->js_redirect('Ngôn ngữ không phù hợp', !empty($continue)?base64_decode($continue):BASE_URL.'backend/adv/index');
		$_post = $adv;
	    $data['seo']['title'] = 'Sửa quảng cáo';
		$data['data']['auth'] = $this->auth;
		if($this->input->post('edit')){
            
            $_post = $this->input->post('data');
            $data['data']['_post'] = $_post;
			$this->form_validation->set_error_delimiters('<li>','</li>');
            
            $this->form_validation->set_rules('data[title]','Tiêu đề','trim|required');
            $this->form_validation->set_rules('data[time_start]','Ngày bắt đầu','trim|required|callback_check_date['.json_encode(array('time_start' =>$_post['time_start'],'time_end' => $_post['time_end'])).']');
            $this->form_validation->set_rules('data[time_end]','ngày kết thúc','trim|required');
            
			$this->form_validation->set_rules('data[content]','Nội dung','trim|required');
            $this->form_validation->set_rules('data[position]','Vị trí','trim|required');
            
			if($this->form_validation->run() == TRUE){
                $_post = $this->my_string->allow_post($_post,array('title','content','position','time_start','time_end','publish'));
                $_post['updated'] = gmdate('Y-m-d H:i:s',time() + 7*3600);  
                $_post['time_start'] = gmdate('Y-m-d H:i:s',strtotime(str_replace('/','-',$_post['time_start'])) + 7*3600);  
                $_post['time_end'] = gmdate('Y-m-d H:i:s',strtotime(str_replace('/','-',$_post['time_end'])) + 7*3600);  
                
				$_post['userid_updated'] = $this->auth['id'];  
				$this->db->where(array('id' =>$id))->update('adv',$_post);
                $this->my_string->js_redirect('Sửa quảng cáo thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/adv/index');
            }
            
        }
		else{
			$adv['time_start'] = ($adv['time_start'] !='1970-01-01 07:00:00')?gmdate('H:i:s d/m/Y', strtotime($adv['time_start']) + 7*3600):'';
			$adv['time_end'] = ($adv['time_end'] !='1970-01-01 07:00:00')?gmdate('H:i:s d/m/Y', strtotime($adv['time_end']) + 7*3600):'';
			
			$data['data']['_post'] = $adv;
		}
	 
	   
	   $data['template'] = 'backend/adv/edit';
	   $this->load->view('backend/layout/home',$data);
        
    }
	
    public function del($id){
        $this->my_auth->allow($this->auth, 'backend/adv/del');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$adv = $this->db->where(array('id' => $id))->from('adv')->get()->row_array();
		if($adv['lang'] != $this->session->userdata('_lang')) $this->my_string->js_redirect('Ngôn ngữ không phù hợp', BASE_URL.'backend/adv/index');
		if(!isset($adv) && count($adv) == 0) $this->my_string->php_redirect(BASE_URL.'backend/adv/index');
		
		$this->db->delete('adv',array('id' =>$id));
		$this->my_string->js_redirect('Xóa nhóm thành viên thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/adv/index');
    }
	public function check_date($title,$date){
		$date = json_decode($date, TRUE);
		
		if(isset($date['time_start']) && !empty($date['time_start']) && isset($date['time_end']) && !empty($date['time_end']) &&(strtotime(str_replace('/','-',$date['time_start'])) + 7*3600) > (strtotime(str_replace('/','-',$date['time_end'])) + 7*3600)){
			$this->form_validation->set_message('check_date','Ngày kết thúc phải lớn hơn ngày bắt đầu!');
			return FALSE;
		}
	}
	
	public function set($field, $id){
        $this->my_auth->allow($this->auth, 'backend/adv/set');
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$adv = $this->db->where(array('id' => $id))->from('adv')->get()->row_array();
		if(!isset($adv) && count($adv) == 0) $this->my_string->php_redirect(BASE_URL.'backend/adv/index');
		
		if(!isset($adv[$field])) $this->my_string->php_redirect(BASE_URL.'backend/adv/index');
		
		$this->db->where(array('id' =>$id))->update('adv',array($field =>(($adv[$field] ==1)?0:1)));
        $this->my_string->js_redirect('Đồi trạng cáo thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/adv/index');
	}
}

