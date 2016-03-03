<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_string {

	private $CI;
	
	public function __construct()
	{
		 $this->CI =&get_instance();
	}
	public function random($leng = 10, $char = FALSE){
		
		if($char == FALSE) $s = 'ABCDEFGHIJKMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz0123456789!@#$%^&*()';
		else $s = 'ABCDEFGHIJKMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz0123456789';
		mt_srand((double)microtime() * 1000000);
		$salt = '';
		for($i = 0; $i < $leng ; $i++){
			
			$salt = $salt . substr($s, (mt_rand() %(strlen($s))), 1);
			
		}
		return $salt;
	}
	
	public function encryption_password($username ,$password = '',$salt = ''){
		
		return md5($salt.$username.md5($username.$salt.md5($password).$username.$salt).$salt);
		
	}
    
    public function encode_cookie($cookie){
		
		return $this->random(10).base64_encode($cookie);
		
	}
    
    public function decode_cookie($cookie){
		
		return base64_decode(substr($cookie,10));
		
	}
	
	public function encode_folder($cookie){
		
		return $this->random(10).base64_encode($cookie);
		
	}
	public function decode_folder($cookie){
		
		return base64_decode(substr($cookie,10));
		
	}
	
	
	
	
	public function allow_post($param, $allow){
		
		$_temp = NULL;
		if(isset($param) && count($param) && isset($allow) && count($allow)){
			foreach($param as $key => $val){
				if(in_array($key, $allow) == TRUE){
					$_temp[$key] = trim($val);
				}
			}
			return $_temp;
		
		}
	
	return $param;
	
	}
    public function php_redirect($url){
		
		header('location:'.$url);
	   die;
	} 
    
    public function js_redirect($alert, $url){
		
		die('<script type="text/javascript">alert(\''.$alert.'\'); location.href=\''.$url.'\'</script>');
	
	}
	public function js_reload($alert){
		
		die('<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><script type="text/javascript">alert(\''.$alert.'\'); location.reload();</script>');
	
	}
	public function trim_array($arr){
		$_arr = NULL;
		if(isset($arr) && count($arr)){
			
			foreach($arr as $key => $val){
				$val = trim($val);
				if(empty($val)) continue;
				$_arr[] = $val;
			}
			
		}
		return $_arr;
	}	
    public function removeutf8($str = NULL){
		$chars = array(
			'a' => array('ă','â','ạ','à','ả','á','ã','ắ','ằ','ẳ','ẵ','ặ','ấ','ầ','ẩ','ẫ','ậ'),
			'e' => array('é','è','ẻ','ẽ','ẹ','ê','ế','ề','ể','ễ','ệ'),
			'i' => array('í','ì','ỉ','ị','ĩ'),
			'o' => array('ó','ò','ỏ','õ','ọ','ố','ồ','ổ','ỗ','ộ','ớ','ờ','ở','ỡ','ợ','ô','ơ'),
			'u' => array('ú','ù','ụ','ủ','ũ','ứ','ừ','ử','ữ','ự','ư'),
			'y' => array('ý','ỳ','ỷ','ỵ','ỹ'),
			'd' => array('đ','Đ'),
			'-' => array(' '),
		);
		foreach($chars as $key => $arr){
			foreach($arr as $val){
				$str = str_replace($val, $key, $str);
			}
		}
		return $str;
	}
	public function alias($str = NULL){
		$str = $this->removeutf8($str);
		$str = preg_replace('/[^a-zA-Z0-9-]/i', '', $str);
		$str = str_replace(array(
			'---------------',
			'--------------',
			'-------------',
			'------------',
			'-----------',
			'----------',
			'---------',
			'--------',
			'-------',
			'------',
			'-----',
			'----',
			'---',
			'--',
			),
			'-',
			$str
		);
		$str = str_replace(array(
			'---------------',
			'--------------',
			'-------------',
			'------------',
			'-----------',
			'----------',
			'---------',
			'--------',
			'-------',
			'------',
			'-----',
			'----',
			'---',
			'--',
			),
			'-',
			$str
		);
		if(!empty($str)){
			if($str[strlen($str)-1] == '-'){
				$str = substr($str, 0, -1);
			}
			if($str[0] == '-'){
				$str = substr($str, 1);
			}
		}
		return strtolower($str);
		
	}
	
	public function fullurl(){
		return ('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']).((!empty($_SERVER['QUERY_STRING']))?('?'.$_SERVER['QUERY_STRING']):'');
	}
    
}