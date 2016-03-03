<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller {

	private $auth;
    public function __construct(){
		parent::__construct();
		$this->auth = $this->my_auth->check();
	}
    
	public function index()
	{
	   
	   $data['template'] = 'backend/auth/login';
	   $this->load->view('backend/layout/login',isset($data)?$data:NULL);
    	
	}
    
    public function login(){
        
        if($this->auth != NULL) 
            $this->my_string->php_redirect(BASE_URL.'backend/home/index');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
        $data['seo']['title'] = 'Đăng Nhập Hệ Thống';
        if($this->input->post('login')){
            
            $_post = $this->input->post('data');
            $data['data']['post'] = $_post;
            $this->form_validation->set_error_delimiters('<li>','</li>');
            
            $this->form_validation->set_rules('data[Username]','Tên Đăng Nhập','trim|required|min_length[3]|max_length[20]|regex_match[/^[a-z0-9]+$/]|callback_username_check');
            $this->form_validation->set_rules('data[Password]','Mật Khẩu','trim|required|callback_password_check['.$_post['Username'].']');
            
            if($this->form_validation->run() == TRUE){
				$user = $this->db->select('username, password, salt')->where(array('username' => $_post['Username']))->from('user')->get()->row_array();
				$remember = (int)$this->input->post('remember');
				if($remember == 1){
					setcookie(TT_PREFIX.'_user_logged',$this->my_string->encode_cookie(json_encode($user)),time()+7*24*3600,'/'); 
				}
				else{
					$this->session->set_userdata('auth', json_encode($user));
				}
				
				$this->db->where(array('username' =>$_post['Username']))->update('user',array('login'=>gmdate('Y-m-d H:i:s',time() + 7*3600)));
				$this->my_string->js_redirect('Đăng nhập thành công!',BASE_URL.'backend/home/index'); 
				
            }
        }
	   $data['template'] = 'backend/auth/login';
	   $this->load->view('backend/layout/login',$data);
        
    }
    
    public function username_check($username){
        
        $count = $this->db->where(array('username' => $username))->from('user')->count_all_results();
        if($count == 0){
            $this->form_validation->set_message('username_check', '%s không tồn tại');
            return FALSE;
        }
        else return TRUE;
        
    }
    public function password_check($password, $username){
      
     if($this->username_check($username) == TRUE){
        $user = $this->db->select('username, password, salt, groupid')->where(array('username' => $username))->from('user')->get()->row_array();
        
        $password = $this->my_string->encryption_password($user['username'], $password, $user['salt']);
        
        if($password != $user['password'] ){
            $this->form_validation->set_message('password_check','%s không đúng!');
            return false;
        }
		$group = $this->db->select('title, allow, group')->where(array('id' => $user['groupid']))->from('user_group')->get()->row_array();
		//print_r(); die;
		$_group = array(
			'group_allow' => $group['allow'],
			'group_title' => $group['title'],
			'group_content' => $this->my_string->trim_array(explode("\n", $group['group'])),
		);
		
		$this->my_auth->allow($_group, 'backend/auth/login');
        return TRUE;
     }  
        
    }
    public function logout(){
        
        if($this->auth == NULL) $this->my_string->php_redirect(BASE_URL.'backend/auth/login');
        $this->session->sess_destroy();
		setcookie(TT_PREFIX.'_user_logged', NULL,time() - 3600,'/'); 
        $this->my_string->php_redirect(BASE_URL.'backend/auth/login');
    }
    
    public function forgot(){

        if($this->auth != NULL) $this->my_string->php_redirect(BASE_URL.'backend/auth/login');
        

        $data['seo']['title'] = 'Quên mật khẩu';
        
        if($this->input->post('forgot'))
        {
            $_post = $this->input->post('data');
            $data['data']['post'] = $_post;
            $this->form_validation->set_error_delimiters('<li>','</li>');
            
            $this->form_validation->set_rules('data[email]','Email','trim|required|valid_email|callback_email_check');
            
            if($this->form_validation->run() == TRUE){
              
               $_code = $this->my_string->random(10,TRUE);
               $_post =$this->my_string->allow_post($_post,array('email'));
                         
             }$this->db->where(array('email' => $_post['email']))->update('user',array(
                'forgot_time' => time()+3600,
                'forgot_code' => $_code,
             ));
             
             $this->my_common->sentmail(array(
                'name' =>'Ta Tich',
                'from' =>'dinhtich91@gmail.com',
                'password' =>'wifwuikqoquqtkvq',
                'to' => $_post['email'],
                'subject' => 'Mã xác nhận quên thông tin tài khoản cho email '.$_post['email'],
                'message' => 'Click vào link: ' .BASE_URL.'backend/auth/reset/?email='.urlencode($_post['email']).'&code='.urlencode($_code),
                
             ));
             
             
             $this->my_string->js_redirect('Gửi mã xác nhận thành công!',BASE_URL.'backend/auth/login'); 
        }   
	   $data['template'] = 'backend/auth/forgot';
	   $this->load->view('backend/layout/home',$data);
        
    }
    
    
    public function email_check($email){
        
        $count = $this->db->where(array('email' => $email))->from('user')->count_all_results();
        if($count == 0){
            $this->form_validation->set_message('email_check', '%s không tồn tại');
            return FALSE;
        }
        else return TRUE;
        
    }
    
    public function reset(){

        if($this->auth != NULL) $this->my_string->js_redirect('Tài khoản của bạn đã đăng nhập!',BASE_URL.'backend/home/index');
        

        $data['seo']['title'] = 'Reset thông tin tài khoản';
        $email = $this->input->get('email');
        $code = $this->input->get('code');
         if(isset($code) && !empty($code) && isset($email) && !empty($email)){
           $_password = '';
            $user = $this->db->select('username, email, forgot_code, forgot_time')->from('user')->where(array('email' =>$email,'forgot_code' =>$code))->get()->row_array();
          if(!isset($user) || count($user) == 0)
                $this->my_string->js_redirect('Email không hợp lệ',BASE_URL.'backend/home/index');
           if($user['forgot_time'] <=time())
                $this->my_string->js_redirect('Mã xác nhận hết hạn',BASE_URL.'backend/home/index');
          
          $_post['password'] = $this->my_string->random(5,TRUE);
             $_password = $_post['password'];
          $_post['salt'] = $this->my_string->random(69,TRUE);
          $_post['password'] = $this->my_string->encryption_password($user['username'],$_post['password'],$_post['salt']);
          $_post['update'] = gmdate('Y-m-d H:i:s',time() + 7*3600);
          $_post['forgot_code'] = '';
          $_post['forgot_time'] = '';
          $this->db->where(array('username' =>$user['username']))->update('user',$_post);
          
          $this->my_common->sentmail(array(
                'name' =>'Ta Tich',
                'from' =>'dinhtich91@gmail.com',
                'password' =>'wifwuikqoquqtkvq',
                'to' => $email,
                'subject' => 'Thông tin tài khoản '.$email,
                'message' => 'Thông tin tài khoản <br />Username: '.$user['username'].'<br /> Password: '.$_password.'<br /> Sau khi đăng nhập nên đổi mật khẩu của mình',
                
             ));
           $this->my_string->js_redirect('Đã gửi mật khẩu mới vào mail của bạn!', BASE_URL.'backend/home/index');
         }
         else{
            $this->my_string->js_redirect('Email hoặc mã xác nhận không hợp lệ!', BASE_URL.'backend/home/index');
         }
         
	   
        
    }
    
    public function create_admin(){
        
        
        $count = $this->db->from('user')->count_all_results();
        if($count >=1){
            header('location:'.BASE_URL);
        }
        
        $data['seo']['title'] = 'Dang Nhap He Thong';
        if($this->input->post('create')){
            
            $_post = $this->input->post('data');
            $data['data']['post'] = $_post;
            $this->form_validation->set_error_delimiters('<li>','</li>');
            
            $this->form_validation->set_rules('data[Username]','Tên Đăng Nhập','trim|required|min_length[3]|max_length[20]|regex_match[/^[a-z0-9]+$/]|callback_check_Username');
            $this->form_validation->set_rules('data[Password]','Mật Khẩu','trim|required');
            $this->form_validation->set_rules('data[Email]','Email','trim|required|valid_email');
            
            if($this->form_validation->run() == TRUE){
                $_post = $this->my_string->allow_post($_post,array('Username','Password','Email'));
                $_post['salt'] =  $this->my_string->random(69,TRUE);
                $_post['Password'] =  $this->my_string->encryption_password($_post['Username'], $_post['Password'],$_post['salt']);
                $_post['created'] = gmdate('Y-m-d H:i:s',time() + 7*3600);  
                
                $this->db->insert('user',$_post);
                $this->my_string->js_redirect('Tạo tài khoản thành công!',BASE_URL);
            }
            
        }
	   $data['create'] = 'backend/auth/create-admin';
	   $this->load->view('backend/layout/home',$data);
        
    }
    
    
    
}

