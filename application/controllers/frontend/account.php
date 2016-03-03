<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MY_Controller {

	 public function __construct(){
		parent::__construct();
		$this->auth = $this->my_auth->check();
	}
    
	public function register(){
		if($this->auth != NULL) $this->my_string->php_redirect(BASE_URL);
		$_lang = $this->session->userdata('_lang');
		$_city = $this->db->select('id, tentinhthanh')->from('tinhthanh')->get()->result_array();
		if($this->input->post('add')){
			$_post = $this->input->post('data');
            
			$this->form_validation->set_error_delimiters('<li>','</li>');
			$this->form_validation->set_rules('data[username]','Tên đăng nhập','trim|required|callback_check_username');
			$this->form_validation->set_rules('data[email]','Email','trim|required|valid_email|callback_check_email');
            $this->form_validation->set_rules('data[fullname]','Họ và tên','trim|required');
            $this->form_validation->set_rules('data[password]','Mật Khẩu','trim|required');
            $this->form_validation->set_rules('data[repassword]','Xác nhận mật khẩu','trim|required|matches[data[password]]');
			$this->form_validation->set_rules('data[address]','Địa chỉ','trim|required');
			$this->form_validation->set_rules('data[city]','Thành phố','trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('data[phone]','Điện thoại','trim|required');
			
            $data['data']['_post'] = $_post;
			/*
			if(isset($_post['quanhuyen']) && count($_post['quanhuyen']) && isset($_post['tinhthanh']) &&count($_post['tinhthanh'])){
				$temp1 = $_post['tinhthanh'];
				$quanhuyen = $_post['quanhuyen'];
				$temp3 = $this->my_frontend->get_name_city($temp1);
				foreach($temp3 as $temp)
					$tinhthanh = $temp;
				$_post['address'] = $_post['address'].', '.$quanhuyen.', '.$tinhthanh;
				//echo $_post['address']; die;
				
			}	
			*/
			if(isset($_post['city']) && !empty($_post['city'])){
				$temp3 = $this->my_frontend->get_name_city($_post['city']);
				foreach($temp3 as $temp)
					$$_post['city'] = $temp;
			}
			if($this->form_validation->run() == TRUE){
                $_post = $this->my_string->allow_post($_post,array('username','fullname','email','content','password','address','city','district','phone'));
				$_post['salt'] =  $this->my_string->random(69,TRUE);
				$_post['password'] =  $this->my_string->encryption_password($_post['username'], $_post['password'],$_post['salt']);
				$_post['created'] = gmdate('Y-m-d H:i:s',time() + 7*3600);  
				$_post['groupid'] = 1; 
                $this->db->insert('user',$_post);
                $this->my_string->js_redirect('Tạo tài khoản thành công!',BASE_URL.'frontend/home/index');
			}
            
        }
		$data['data']['_city'] = $_city;
		$data['seo']['title'] = 'Đăng ký tài khoản';
		$data['template'] = 'frontend/account/register';
		$this->load->view('frontend/layout/home',$data);
	}

    public function loadcity(){
		$temp = $_REQUEST['city'];
		$district = $this->db->select('id, tenquanhuyen')->from('quanhuyen')->where(array('matinhthanh' => $temp))->get()->result_array();
		$str = '<select class="form-control" name="data[district]">';
		foreach($district as $key => $val){
			$str = $str.'<option value="'.$val['tenquanhuyen'].'">'.$val['tenquanhuyen'].'</option>';
		}
		$str = $str.'</select>';
		echo $str;
	}
    
	public function check_email($email = null){
		
		$count = $this->db->where(array('email' =>$email))->from('user')->count_all_results();
		if($count > 0){
			$this->form_validation->set_message('check_email', 'Email '.$email.' đã tồn tại');
			return FALSE;
		}
		return TRUE;	
	}
	public function check_username($username = null){
		
		$count = $this->db->where(array('username' =>$username))->from('user')->count_all_results();
		if($count > 0){
			$this->form_validation->set_message('check_username', 'Tên đăng nhập '.$username.' đã tồn tại');
			return FALSE;
		}
		return TRUE;	
	}
	
}

