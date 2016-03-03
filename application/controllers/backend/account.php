<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MY_Controller {

	private $auth;
    public function __construct(){
		parent::__construct();
		$this->auth = $this->my_auth->check();
		$this->my_auth->allow($this->auth, 'backend/account');
	}
    
    
    public function info(){
        $this->my_auth->allow($this->auth, 'backend/account/info');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
        if($this->auth == NULL) 
            $this->my_string->php_redirect(BASE_URL.'backend/home/index');
      
		
		$user = $this->db->where(array('username' => $this->auth['username']))->from('user')->get()->row_array();
		if(!isset($user) || count($user) == 0)$this->my_string->php_redirect(BASE_URL.'backend/home/index');
	   
	   $data['seo']['title'] = 'Thay đổi thông tin tài khoản';
        $_post = $user;
		if($this->input->post('change')){
            
            $_post = $this->input->post('data');
            $data['data']['post'] = $_post;
            $this->form_validation->set_error_delimiters('<li>','</li>');
            
			$this->form_validation->set_rules('data[email]','Email','trim|required|valid_email|callback_email_check');
			
            if($this->form_validation->run() == TRUE){
              
              $_post = $this->my_string->allow_post($_post, array('email','fullname'));
			  
			  $_post['update'] = gmdate('Y-m-d H:i:s',time() + 7*3600);
			  $this->db->where(array('username' =>$user['username']))->update('user',$_post);
          
			   $this->my_string->js_redirect('Thay đổi thông tin thành công!',BASE_URL.'backend/auth/login'); 
                
            }
        }
		$data['data']['_post'] = $_post;
		$data['data']['auth'] = $this->auth;
	   $data['template'] = 'backend/account/info';
	   $this->load->view('backend/layout/home',$data);
        
    }
	
	public function password(){
        $this->my_auth->allow($this->auth, 'backend/account/password');
        if($this->auth == NULL) 
            $this->my_string->php_redirect(BASE_URL.'backend/home/index');
        $user = $this->db->where(array('username' => $this->auth['username']))->from('user')->get()->row_array();
		if(!isset($user) || count($user) == 0)$this->my_string->php_redirect(BASE_URL.'backend/home/index');
	   
		$data['seo']['title'] = 'Thay đổi mật khẩu';
        if($this->input->post('change')){
            
            $_post = $this->input->post('data');
            $data['data']['post'] = $_post;
            $this->form_validation->set_error_delimiters('<li>','</li>');
            
            $this->form_validation->set_rules('data[oldpassword]','Mật khẩu cũ','trim|required|callback_oldpassword_check');
             
			$this->form_validation->set_rules('data[newpassword]','Mật khẩu mới','trim|required');
			$this->form_validation->set_rules('data[renewpassword]','Xác nhận mật khẩu cũ','trim|required|matches[data[newpassword]]');
			
            if($this->form_validation->run() == TRUE){
                $_temp = $_post;
			    unset($_post);
				$_post['password'] = $_temp['newpassword'];
				$_post['salt'] = $this->my_string->random(69,TRUE);
				$_post['password'] = $this->my_string->encryption_password($user['username'],$_post['password'],$_post['salt']);
				$_post['update'] = gmdate('Y-m-d H:i:s',time() + 7*3600);
				$this->db->where(array('username' =>$user['username']))->update('user',$_post);
				$this->my_string->js_redirect('Thay đổi mật khẩu thành công!',BASE_URL.'backend/auth/login'); 
               
            }
        }
		$data['data']['auth'] = $this->auth;
	   $data['template'] = 'backend/account/password';
	   $this->load->view('backend/layout/home',$data);
        
    }
	
	public function email_check($email = null){
		
		$count = $this->db->where(array('email' =>$email, 'email !=' => $this->auth['email']))->from('user')->count_all_results();
		if($count > 0){
			$this->form_validation->set_message('email_check', 'Email '.$email.' đã tồn tại');
			return FALSE;
		}
		return TRUE;	
	}
    public function oldpassword_check($oldpassword = null){
		
		$user = $this->db->from('user')->where(array('id' =>$this->auth['id']))->get()->row_array();
		$oldpassword = $this->my_string->encryption_password($user['username'],$oldpassword, $user['salt']);
		if($user['password'] != $oldpassword){
			$this->form_validation->set_message('oldpassword_check', 'Password không chính xác');
			return FALSE;
		}
		return TRUE;	
	}
    
}

