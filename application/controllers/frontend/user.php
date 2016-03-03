<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {

	 public function __construct(){
		parent::__construct();
		$this->auth = $this->my_auth->check();
	}
    
	public function login(){
		if($this->auth != NULL) $this->my_string->php_redirect(BASE_URL);
		if(isset($_REQUEST['email']) && isset($_REQUEST['pass'])){
			$_username = $_REQUEST['email'];
			$_password = $_REQUEST['pass']; 
			$user = $this->db->select('username, password, salt')->where(array('username' => $_username))->from('user')->get()->row_array();
			if(isset($user) && !empty($user)){
				if($_username == $user['username']){
					$password = $this->my_string->encryption_password($user['username'], $_password, $user['salt']);
				}
				if($password == $user['password']){
					$this->session->set_userdata('auth', json_encode($user));
					//$temp = $this->session->userdata('user');
					//print_r($temp); die;
					$this->my_string->js_redirect('Đăng nhập thành công!',BASE_URL);
				}
				else{
					echo 'Tài khoản hoặc mật khẩu không đúng!';
				}
			}
			else{
				echo 'Tài khoản hoặc mật khẩu không đúng!';
			}
		}
		
	
		
	}
	
	public function loginfb(){
		$temp = $_REQUEST;
		$this->session->set_userdata('data[user_face]', $temp);
		$this->my_string->php_redirect(BASE_URL);
	}
	
	public function logout(){
		$this->session->sess_destroy();
		$this->load->library('facebook');
		// Logs off session from website
        $this->facebook->destroySession();
		setcookie(TT_PREFIX.'_user_logged', NULL,time() - 3600,'/'); 
        $this->my_string->php_redirect(BASE_URL);
	}
	public function forgot(){
		if($this->auth != NULL) $this->my_string->php_redirect(BASE_URL);
        $data['seo']['title'] = 'Quên mật khẩu';
		
		if($this->input->post('forgot'))
        {
			$_post = $this->input->post('data');
            $data['data']['post'] = $_post;
            $this->form_validation->set_error_delimiters('<li>','</li>');
            
            $this->form_validation->set_rules('data[email]','Email','trim|required|valid_email|callback_email_check');
            
            if($this->form_validation->run() == TRUE){
              
               $_code = $this->my_string->random(10,TRUE);
			   $_post = $this->my_string->allow_post($_post,array('email'));
                         
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
                'message' => 'Click vào link: ' .BASE_URL.'frontend/user/reset/?email='.urlencode($_post['email']).'&code='.urlencode($_code),
                
             ));
             
             
             $this->my_string->js_redirect('Gửi mã xác nhận thành công!',BASE_URL); 
        }
		
		$data['template'] = 'frontend/account/forgot';
	    $this->load->view('frontend/layout/home',$data);
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

        if($this->auth != NULL) $this->my_string->js_redirect('Tài khoản của bạn đã đăng nhập!',BASE_URL);
        

        $data['seo']['title'] = 'Reset thông tin tài khoản';
        $email = $this->input->get('email');
        $code = $this->input->get('code');
         if(isset($code) && !empty($code) && isset($email) && !empty($email)){
           $_password = '';
            $user = $this->db->select('username, email, forgot_code, forgot_time')->from('user')->where(array('email' =>$email,'forgot_code' =>$code))->get()->row_array();
          if(!isset($user) || count($user) == 0)
                $this->my_string->js_redirect('Email không hợp lệ',BASE_URL.'frontend/home/index');
           if($user['forgot_time'] <=time())
                $this->my_string->js_redirect('Mã xác nhận hết hạn',BASE_URL.'frontend/home/index');
          
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
           $this->my_string->js_redirect('Đã gửi mật khẩu mới vào mail của bạn!', BASE_URL.'frontend/home/index');
         }
         else{
            $this->my_string->js_redirect('Email hoặc mã xác nhận không hợp lệ!', BASE_URL.'frontend/home/index');
         }
    }
	
	public function info(){
        if($this->auth == NULL) 
            $this->my_string->php_redirect(BASE_URL);
      
		
		$user = $this->db->where(array('username' => $this->auth['username']))->from('user')->get()->row_array();
		if(!isset($user) || count($user) == 0)$this->my_string->php_redirect(BASE_URL);
	   
	   $data['seo']['title'] = 'Thay đổi thông tin tài khoản';
        $_post = $user;
		if($this->input->post('change')){
            
            $_post = $this->input->post('data');
            $data['data']['post'] = $_post;
            $this->form_validation->set_error_delimiters('<li>','</li>');
            
			$this->form_validation->set_rules('data[email]','Email','trim|required|valid_email|callback_email_check');
			
            if($this->form_validation->run() == TRUE){
              
				$_post = $this->my_string->allow_post($_post, array('email','fullname','birth','sex','password'));
				$_post['update'] = gmdate('Y-m-d H:i:s',time() + 7*3600);
				$this->db->where(array('username' =>$user['username']))->update('user',$_post);
				$this->my_string->js_redirect('Thay đổi thông tin thành công!',BASE_URL.'frontend/user/info'); 
            }
        }
		$data['data']['_post'] = $_post;
		$data['data']['user'] = $this->auth;
	   $data['template'] = 'frontend/account/info';
	   $this->load->view('frontend/layout/home',$data);
        
    }
	public function changefullname(){
		$temp = $_REQUEST['name'];
		$user = $this->auth;
		if(isset($temp) && !empty($temp)){
			$this->db->where(array('username' =>$user['username']))->update('user',array('fullname' => $temp));
		}
		$post = $this->db->select('fullname')->from('user')->where(array('username' => $this->auth))->get()->row_array();
		echo $post['fullname'];
		
	}
	public function changeemail(){
		$temp = $_REQUEST['email'];
		$user = $this->auth;
		if(isset($temp) && !empty($temp)){
			$this->db->where(array('username' =>$user['username']))->update('user',array('email' => $temp));
		}
		$post = $this->db->select('email')->from('user')->where(array('username' => $this->auth))->get()->row_array();
		echo $post['email'];
		
	}
	public function changesex(){
		$temp = $_REQUEST['sex'];
		$user = $this->auth;
		if(isset($temp) && !empty($temp)){
			$this->db->where(array('username' =>$user['username']))->update('user',array('sex' => $temp));
		}
		$post = $this->db->select('sex')->from('user')->where(array('username' => $this->auth))->get()->row_array();
		echo $post['sex'];
		
	}
	public function changebirth(){
		$temp = $_REQUEST['birth'];
		$user = $this->auth;
		if(isset($temp) && !empty($temp)){
			$this->db->where(array('username' =>$user['username']))->update('user',array('sex' => $temp));
		}
		$post = $this->db->select('sex')->from('user')->where(array('username' => $this->auth))->get()->row_array();
		echo $post['sex'];
		
	}
	public function changepassword(){
		if(isset($_REQUEST['pass_old'])){
			$_passold = $_REQUEST['pass_old'];
		}
		if(isset($_REQUEST['pass_new'])){
			$_passnew = $_REQUEST['pass_new'];
		}
		if(isset($_REQUEST['pass_renew'])){
			$_passrenew = $_REQUEST['pass_renew'];
		}
		if(!isset($_passold) || empty($_passold)){
			echo 'Xin điền mật khẩu cũ <br />';
			return FALSE;
		}
		else if(!isset($_passnew) || empty($_passnew)){
			echo 'Xin điền mật khẩu mới<br />';
			return FALSE;
		}
		else if(!isset($_passrenew) || empty($_passrenew)){
			echo 'Xin điền xác nhận mật khẩu mới<br />';
			return FALSE;
		}
		if(isset($_passold) && isset($_passnew) && isset($_passrenew)){
			$user = $this->db->where(array('username' => $this->auth['username']))->from('user')->get()->row_array();
			$oldpassword = $this->my_string->encryption_password($user['username'],$_passold, $user['salt']);
			if($user['password'] != $oldpassword){
				echo 'Mật khẩu cũ không đúng!';
				return FALSE;
			}
			if($_passnew != $_passrenew){
				echo 'Xác nhận không giống nhau!';
				return FALSE;
			}
			else{
				$_post['salt'] = $this->my_string->random(69,TRUE);
				$_post['password'] = $this->my_string->encryption_password($user['username'],$_passnew,$_post['salt']);
				$_post['update'] = gmdate('Y-m-d H:i:s',time() + 7*3600);
				$this->db->where(array('username' =>$user['username']))->update('user',$_post);
				//echo $_post['password'];
			}
		}
	}
	
}

