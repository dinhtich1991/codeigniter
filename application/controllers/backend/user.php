<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {

	private $auth;
    public function __construct(){
		parent::__construct();
		$this->auth = $this->my_auth->check();
		if($this->auth == NULL) $this->my_string->php_redirect(BASE_URL.'backend/home/index');
		$this->my_auth->allow($this->auth, 'backend/user');
	}
    
    public function group($page = 1){
		
		$this->my_auth->allow($this->auth, 'backend/user/group');
       if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		if($this->input->post('sort')){
			$_order = $this->input->post('order');
			if(isset($_order) && count($_order)){
				foreach($_order as $key =>$val){
					$_data[] = array(
						'id' =>$key,
						'order' =>(int)$val,
						'updated' => gmdate('Y-m-d H:i:s', time()+ 7*3600),
					);
				}
				$this->db->update_batch('user_group',$_data,'id');
				$this->my_string->js_redirect('Sắp xếp thành công!',BASE_URL.'backend/user/group');
			}
		}
		
		$sort = $this->my_common->sort_orderby($this->input->get('sort_field'),$this->input->get('sort_value'));
		
	    $data['seo']['title'] = 'Nhóm thành viên';
		
		$keyword = $this->input->get('keyword');
		$config = $this->my_common->backend_pagination();
		$config['base_url'] = 'backend/user/group';
		
		if(!empty($keyword)){
			$config['total_rows'] = $this->db->from('user_group')->like('title',$keyword)->count_all_results();
		}
		else{
			$config['total_rows'] = $this->db->from('user_group')->count_all_results();
		}
		
		$config['uri_segment'] = 4;
		$config['suffix'] = (isset($sort) && count($sort))?'?sort_field='.$sort['field'].'&sort_value='.$sort['value']:'';
		$config['suffix'] = $config['suffix'].(!empty($keyword)?'&keyword='.$keyword:'');
		$config['first_url'] = $config['base_url'].$config['suffix'];
		$this->pagination->initialize($config);
		$data['data']['pagination'] = $this->pagination->create_links();
		
		
		if(!empty($keyword)){
			$data['data']['_list'] = $this->db->from('user_group')->like('title',$keyword)->limit($config['per_page'],($page -1) * $config['per_page'])->order_by($sort['field'].' '.$sort['value'])->get()->result_array();
		}
		else{
			$data['data']['_list'] = $this->db->from('user_group')->limit($config['per_page'],($page -1) * $config['per_page'])->order_by($sort['field'].' '.$sort['value'])->get()->result_array();
		}
		$data['data']['_page'] = $page;
		$data['data']['_sort'] = $sort;
		$data['data']['_keyword'] = $keyword;
		$data['data']['_config'] = $config;
	   $data['data']['auth'] = $this->auth;
	   $data['template'] = 'backend/user/group';
	   $this->load->view('backend/layout/home',isset($data)?$data:NULL);
        
    }
	
	public function addgroup(){
        if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
	    $this->my_auth->allow($this->auth, 'backend/user/addgroup');
		$data['seo']['title'] = 'Thêm nhóm thành viên';
		$data['data']['auth'] = $this->auth;
		if($this->input->post('add')){
            
            $_post = $this->input->post('data');
            $data['data']['_post'] = $_post;
			$this->form_validation->set_error_delimiters('<li>','</li>');
            $_post['userid_created'] = $this->auth['id'];  
            $this->form_validation->set_rules('data[title]','Tiêu đề','trim|required');
            if($this->form_validation->run() == TRUE){
                $_post = $this->my_string->allow_post($_post,array('title','allow','group'));
                $_post['created'] = gmdate('Y-m-d H:i:s',time() + 7*3600);  
                
                $this->db->insert('user_group',$_post);
                $this->my_string->js_redirect('Thêm thành viên thành công!',BASE_URL.'backend/user/addgroup');
            }
            
        }
		else{
			$_post['allow'] = 0;
			$data['data']['_post'] = $_post;
		}
	 
	   
	   $data['template'] = 'backend/user/addgroup';
	   $this->load->view('backend/layout/home',$data);
        
    }
    
	public function editgroup($id){
        $this->my_auth->allow($this->auth, 'backend/user/editgroup');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$id = (int)$id;
		$group = $this->db->where(array('id' => $id))->from('user_group')->get()->row_array();
		if(!isset($group) && count($group) == 0) $this->my_string->php_redirect(BASE_URL.'backend/home/index');
		$_post = $group;
	    $data['seo']['title'] = 'Sửa nhóm thành viên';
		$data['data']['auth'] = $this->auth;
		if($this->input->post('edit')){
            
            $_post = $this->input->post('data');
            $data['data']['_post'] = $_post;
			$this->form_validation->set_error_delimiters('<li>','</li>');
            
            $this->form_validation->set_rules('data[title]','Tiêu đề','trim|required');
            if($this->form_validation->run() == TRUE){
                $_post = $this->my_string->allow_post($_post,array('title','allow','group'));
                $_post['updated'] = gmdate('Y-m-d H:i:s',time() + 7*3600);  
                $_post['userid_updated'] = $this->auth['id'];  
				$this->db->where(array('id' =>$id))->update('user_group',$_post);
                $this->my_string->js_redirect('Sửa thành viên thành công!',BASE_URL.'backend/user/group');
            }
            
        }
		else{
			$data['data']['_post'] = $group;
		}
	 
	   
	   $data['template'] = 'backend/user/editgroup';
	   $this->load->view('backend/layout/home',$data);
        
    }
	
    public function delgroup($id){
        $this->my_auth->allow($this->auth, 'backend/user/delgroup');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$id = (int)$id;
		$group = $this->db->where(array('id' => $id))->from('user_group')->get()->row_array();
		if(!isset($group) && count($group) == 0) $this->my_string->php_redirect(BASE_URL.'backend/home/index');
		
		$count = $this->db->where(array('groupid' => $group['id']))->from('user')->count_all_results();
		if($count > 0) $this->my_string->js_redirect('Nhóm '.$group['title'].'vẫn còn thành viên',BASE_URL.'backend/user/group');
		$this->db->delete('user_group',array('id' =>$id));
		$this->my_string->js_redirect('Xóa nhóm thành viên thành công!',BASE_URL.'backend/user/group');
    }
    
	
	public function index($page = 1){
		
		$this->my_auth->allow($this->auth, 'backend/user/index');
		$continue = $this->input->get('continue');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		
		$sort = $this->my_common->sort_orderby($this->input->get('sort_field'),$this->input->get('sort_value'));
		
	    $data['seo']['title'] = 'Thành viên';
		$keyword = $this->input->get('keyword');
		$groupid = (int)$this->input->get('groupid');
		$config = $this->my_common->backend_pagination();
		$config['base_url'] = 'backend/user/index';
		
		if(!empty($keyword) && $groupid == 0){
			$_sql = 'SELECT * FROM '.TT_DB_PREFIX.'user WHERE (`username` LIKE ? OR `email` LIKE ? OR `fullname` LIKE ?)';
			$_param = array('%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%');
			$config['total_rows'] = $this->db->query($_sql, $_param)->num_rows(); 
		}
		
		else if(empty($keyword) && $groupid > 0){
			$config['total_rows'] = $this->db->from('user')->where(array('groupid' => $groupid))->count_all_results();
		}
		else if(!empty($keyword) && $groupid > 0){
			
			$_sql = 'SELECT * FROM '.TT_DB_PREFIX.'user WHERE `groupid` = ? AND (`username` LIKE ? OR `email` LIKE ? OR `fullname` LIKE ?)';
			$_param = array($groupid, '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%');
			$config['total_rows'] = $this->db->query($_sql, $_param)->num_rows(); 
		}
		else{
			$config['total_rows'] = $this->db->from('user')->count_all_results();
		}
		
		$_totalpage = ceil($config['total_rows']/$config['per_page']);
		$page = ($page > $_totalpage)?$_totalpage:$page;
		
		$config['uri_segment'] = 4;
		$config['suffix'] = (isset($sort) && count($sort))?'?sort_field='.$sort['field'].'&sort_value='.$sort['value']:'';
		$config['suffix'] = $config['suffix'].(($groupid > 0)?'&groupid='.$groupid:'');
		$config['suffix'] = $config['suffix'].(!empty($keyword)?'&keyword='.$keyword:'');
		$config['first_url'] = $config['base_url'].$config['suffix'];
		
		if($config['total_rows'] > 0){
			$this->pagination->initialize($config);
			$data['data']['pagination'] = $this->pagination->create_links();
			
			if(!empty($keyword) && $groupid == 0){
				$_sql = 'SELECT * FROM '.TT_DB_PREFIX.'user WHERE(`username` LIKE ? OR `email` LIKE ? OR `fullname` LIKE ?) ORDER BY `'.$sort['field'].'` '.$sort['value'].' LIMIT '.(($page - 1) * $config['per_page']).', '.$config['per_page'];
				$_param = array('%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%');
				$data['data']['_list'] = $this->db->query($_sql, $_param)->result_array(); 
			}
			
			else if(empty($keyword) && $groupid > 0){
				$data['data']['_list'] = $this->db->from('user')->where(array('groupid' =>$groupid))->limit($config['per_page'],($page -1) * $config['per_page'])->order_by($sort['field'].' '.$sort['value'])->get()->result_array();
			}
			else if(!empty($keyword) && $groupid > 0){
				$_sql = 'SELECT * FROM '.TT_DB_PREFIX.'user WHERE `groupid` = ? AND (`username` LIKE ? OR `email` LIKE ? OR `fullname` LIKE ?) ORDER BY `'.$sort['field'].'` '.$sort['value'].' LIMIT '.(($page - 1) * $config['per_page']).', '.$config['per_page'];
				$_param = array($groupid, '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%');
				$data['data']['_list'] = $this->db->query($_sql, $_param)->result_array(); 
			}
			else{
				$data['data']['_list'] = $this->db->from('user')->limit($config['per_page'],($page -1) * $config['per_page'])->order_by($sort['field'].' '.$sort['value'])->get()->result_array();
			}
			
		}
		//print_r($data['data']['_list']); die;
		$data['data']['_page'] = $page;
		$data['data']['_sort'] = $sort;
		$data['data']['_keyword'] = $keyword;
		$data['data']['_groupid'] = $groupid;
		$data['data']['_config'] = $config;
	    $data['data']['auth'] = $this->auth;
	    $_group =$this->db->select('id, title')->from('user_group')->get()->result_array();
		if(isset($_group) && count($_group)){
			$data['data']['_show']['groupid'][0] = '----'; 
			foreach($_group as $key => $val){
				$data['data']['_show']['groupid'][$val['id']] = $val['title'];
			}
		}
	   //$data['data']['_show']['groupid'] = $this->my_nestedset->dropdown('user_group', NULL, 'item');
	    $data['template'] = 'backend/user/index';
	    $this->load->view('backend/layout/home',isset($data)?$data:NULL);
        
    }
	
	public function add(){
        if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
	    $this->my_auth->allow($this->auth, 'backend/user/add');
		$data['seo']['title'] = 'Thêm thành viên';
		$data['data']['auth'] = $this->auth;
		$groupid = (int)$this->input->get('groupid');
		$data['data']['_groupid'] = $groupid;
		$_group =$this->db->select('id, title')->from('user_group')->get()->result_array();
		if(isset($_group) && count($_group)){
			$data['data']['_show']['groupid'][0] = '----'; 
			foreach($_group as $key => $val){
				$data['data']['_show']['groupid'][$val['id']] = $val['title'];
			}
		}
		if($this->input->post('add')){
            
            $_post = $this->input->post('data');
            $data['data']['_post'] = $_post;
			$this->form_validation->set_error_delimiters('<li>','</li>');
            $this->form_validation->set_rules('data[Username]','Tên Đăng Nhập','trim|required|min_length[3]|max_length[20]|regex_match[/^[a-z0-9]+$/]|callback_check_Username');
            $this->form_validation->set_rules('data[Password]','Mật Khẩu','trim|required');
            $this->form_validation->set_rules('data[repassword]','Xác nhận mật khẩu','trim|required|matches[data[Password]]');
			$this->form_validation->set_rules('data[Email]','Email','trim|required|valid_email|callback_check_email');
            $this->form_validation->set_rules('data[groupid]','Nhóm thành viên','trim|required|is_natural_no_zero');
			//echo $_post['fullname']; die;
			if($this->form_validation->run() == TRUE){
                $_post = $this->my_string->allow_post($_post,array('Username','Password','Email','groupid','fullname'));
				$_post['salt'] =  $this->my_string->random(69,TRUE);
				$_post['Password'] =  $this->my_string->encryption_password($_post['Username'], $_post['Password'],$_post['salt']);
				$_post['created'] = gmdate('Y-m-d H:i:s',time() + 7*3600);  
                $this->db->insert('user',$_post);
                $this->my_string->js_redirect('Tạo tài khoản thành công!',BASE_URL.'backend/user/index');
			}
            
        }
		else{
			$_post['publish'] = 1;
			$data['data']['_post'] = $_post;
		}
		
	    $data['template'] = 'backend/user/add';
	    $this->load->view('backend/layout/home',$data);
        
    }
	
	public function check_email($email, $old_email){
		if(isset($old_email) &&!empty($old_email)){
			$count = $this->db->where(array('email' => $email, 'email !=' => $old_email))->from('user')->count_all_results();
		}
		else{
			$count = $this->db->where(array('email' => $email))->from('user')->count_all_results();
		}
		if(isset($count) && $count > 0){
			$this->form_validation->set_message('check_email','%s đã tồn tại');
			return false;
		}
		return true;
	 }
	 
	public function edit($id){
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
        $this->my_auth->allow($this->auth, 'backend/user/edit');
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$user = $this->db->where(array('id' => $id))->from('user')->get()->row_array();
		//print_r($user); die;
		//echo $user['email'];die;
		if(!isset($user) && count($user) == 0) $this->my_string->php_redirect(BASE_URL.'backend/user/index');
		$data['seo']['title'] = 'Sửa thành viên';
		$data['data']['auth'] = $this->auth;
		$_group =$this->db->select('id, title')->from('user_group')->get()->result_array();
		if(isset($_group) && count($_group)){
			$data['data']['_show']['groupid'][0] = '----'; 
			foreach($_group as $key => $val){
				$data['data']['_show']['groupid'][$val['id']] = $val['title'];
			}
		}
		if($this->input->post('edit')){
            
            $_post = $this->input->post('data');
            $data['data']['_post'] = $_post;
			$this->form_validation->set_error_delimiters('<li>','</li>');
			$this->form_validation->set_rules('data[email]','email','trim|required|valid_email|callback_check_email['.$user['email'].']');
            $this->form_validation->set_rules('data[groupid]','Nhóm thành viên','trim|required|is_natural_no_zero');
			if($this->form_validation->run() == TRUE){
			   $_post = $this->my_string->allow_post($_post,array('email','groupid'));
                $this->db->where(array('id' =>$id))->update('user',$_post);
                $this->my_string->js_redirect('Sửa thành viên thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/user/index');
            }
            
        }
		else{
			
			$data['data']['_post'] = $user;
		}
	 
	   $data['data']['_username'] = $this->auth['username'];
	   $data['template'] = 'backend/user/edit';
	   $this->load->view('backend/layout/home',$data);
        
    }
	
	public function del($id){
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
        $this->my_auth->allow($this->auth, 'backend/user/del');
		$id = (int)$id;
		$count = $this->db->where(array('userid_created' => $id))->from('article_item')->count_all_results();
		if($count > 0) $this->my_string->js_redirect('Thành viên vẫn còn bài viết', BASE_URL.'backend/user/index');
		if($id == $this->auth['id']) $this->my_string->js_redirect('Không thể xóa chính mình', BASE_URL.'backend/user/index');
		
		$this->db->delete('user',array('id' =>$id));
		$this->my_string->js_redirect('Xóa danh mục thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/user/index');
    }
	
}

