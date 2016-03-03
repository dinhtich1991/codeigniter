<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_auth {

	private $CI;
	
	public function __construct()
	{
		 $this->CI =&get_instance();
	}
	public function check(){
		if(isset($_COOKIE[TT_PREFIX.'_user_logged']) && !empty($_COOKIE[TT_PREFIX.'_user_logged'])){
			$cookie = $_COOKIE[TT_PREFIX.'_user_logged'];
			$cookie = json_decode($this->CI->my_string->decode_cookie($cookie), TRUE);
			
			$user = $this->CI->db->select('id, username, password, salt, email, fullname, groupid')->where(array('username' => $cookie['username']))->from('user')->get()->row_array();
			//$group = explode("\n",$group['group']);
			//$group = $this->CI->my_string->trim_array(explode("\n",$group['group']));
			//print_r($group);die;
			if(isset($user) && count($user)){
				$group = $this->CI->db->select('title, allow, group')->where(array('id' => $user['groupid']))->from('user_group')->get()->row_array();
			
				if($cookie['username'] == $user['username']){
					setcookie(TT_PREFIX.'_user_logged',$this->CI->my_string->encode_cookie(json_encode(array(
						'username' =>$user['username'],
						'password' =>$user['password'],
						'salt' =>$user['salt'],
					))),time()+7*24*3600,'/');
					//setcookie(TT_PREFIX.'_folder',$this->CI->my_string->encode_folder($user['username']),time()+7*24*3600,'/');
					return array(
						'id' =>$user['id'],
						'username' =>$user['username'],
						'email' =>$user['email'],
						'fullname' =>$user['fullname'],
						'group_id' =>$user['groupid'],
						'group_title' =>$group['title'],
						'group_allow' =>$group['allow'],
						'group_content' =>$this->CI->my_string->trim_array(explode("\n",$group['group'])),
					);
				}
				
			}
		}
		else{
			$auth = $this->CI->session->userdata('auth');
			if(!isset($auth) || empty($auth)) return NULL;
			$auth = json_decode($auth, TRUE);
			$user = $this->CI->db->select('id, username, password, salt, email, fullname, groupid')->where(array('username' => $auth['username']))->from('user')->get()->row_array();
			if(!isset($user) || empty($user)) return NULL;
			$group = $this->CI->db->select('title, allow, group')->where(array('id' => $user['groupid']))->from('user_group')->get()->row_array();
			return array(
						'id' =>$user['id'],
						'username' =>$user['username'],
						'email' =>$user['email'],
						'fullname' =>$user['fullname'],
						'group_id' =>$user['groupid'],
						'group_title' =>$group['title'],
						'group_allow' =>$group['allow'],
						'group_content' =>$this->CI->my_string->trim_array(explode("\n",$group['group'])),
					);
		}
		
	
		/*
		if(isset($_COOKIE[TT_PREFIX.'_user_logged']) && !empty($_COOKIE[TT_PREFIX.'_user_logged'])){
			$cookie = $_COOKIE[TT_PREFIX.'_user_logged'];
			$cookie = json_decode($this->CI->my_string->decode_cookie($cookie), TRUE);
			
			$user = $this->CI->db->select('id, username, password, salt, email, fullname, groupid')->where(array('username' => $cookie['username']))->from('user')->get()->row_array();
			//$group = explode("\n",$group['group']);
			//$group = $this->CI->my_string->trim_array(explode("\n",$group['group']));
			//print_r($group);die;
			if(isset($user) && count($user)){
				$group = $this->CI->db->select('title, allow, group')->where(array('id' => $user['groupid']))->from('user_group')->get()->row_array();
			
				if($cookie['username'] == $user['username']){
					setcookie(TT_PREFIX.'_user_logged',$this->CI->my_string->encode_cookie(json_encode(array(
						'username' =>$user['username'],
						'password' =>$user['password'],
						'salt' =>$user['salt'],
					))),time()+7*24*3600,'/');
					//$_SESSION['username'] = $user['username'];
					//echo $_SESSION['username'];
					//setcookie(TT_PREFIX.'_folder',$this->CI->my_string->encode_folder($user['username']),time()+7*24*3600,'/');
					return array(
						'id' =>$user['id'],
						'username' =>$user['username'],
						'email' =>$user['email'],
						'fullname' =>$user['fullname'],
						'group_title' =>$group['title'],
						'group_allow' =>$group['allow'],
						'group_content' =>$this->CI->my_string->trim_array(explode("\n",$group['group'])),
					);
				}
				
			}
		}
		return NULL;
		*/
		//return NULL;
	}
	
	public function allow($auth, $url){
		//print_r($auth['group_content']); die;
		if($auth['group_allow'] ==1){
			if(!isset($auth['group_content']) && count($auth['group_content']) == 0){
				$this->CI->my_string->js_redirect('Bạn không đủ quyền truy cập!',BASE_URL.'backend/home/index');
			}
			if(isset($auth['group_content']) && in_array($url,$auth['group_content']) == FALSE){
				$this->CI->my_string->js_redirect('Bạn không đủ quyền truy cập!',BASE_URL.'backend/home/index');
			}
		}
		//không cho phép
		if($auth['group_allow'] ==0){
			if(isset($auth['group_content']) && in_array($url,$auth['group_content']) == TRUE){
				$this->CI->my_string->js_redirect('Bạn không đủ quyền truy cập!',BASE_URL.'backend/home/index');
			}
		}
	}
    
}