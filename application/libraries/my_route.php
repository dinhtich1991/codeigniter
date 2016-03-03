<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_route {

	private $CI;
	
	public function __construct()
	{
		 $this->CI =&get_instance();
	}
	
	public function insert($param){
		if(isset($param) && count($param) >= 2){
			$this->CI->db->insert('route',$param);
		}
	}
	
	public function update($param, $url){
		if(isset($url) && !empty($url)){
			$count = $this->CI->db->where(array('param' => $param))->from('route')->count_all_results();
			if($count >=1 ){
				$this->CI->db->where(array('param' => $param))->update('route', array(
					'url' => $url,
					'updated' => gmdate('Y-m-d H:i:s', time() + 7*3600),
				));
			}
			else{
				$this->insert(array(
					'url' => $url,
					'param' => $param,
					'created' => gmdate('Y-m-d H:i:s', time() + 7*3600),
				));
			}
		}
		else{
			$this->CI->db->delete('route',array('param' => $param));
		}
	}
	
	public function create(){
		$_data = $this->CI->db->select('url, param')->from('route')->get()->result_array();
		if(isset($_data) && count($_data)){
			$file = 'route';
			$this->CI->load->library('ftp');
			//$config['hostname'] = $this->CI->_config['ftp_hostname'];
			//$config['username'] = $this->CI->_config['ftp_username'];
			//$config['password'] = $this->CI->_config['ftp_password'];
			//$config['debug'] = TRUE;
			//$this->CI->ftp->connect($config);
			//$this->CI->ftp->chmod($file, 0777);
			$str = '<?php'."\n";
			foreach($_data as $key => $val){
				$_temp = explode('/', $val['param']);
				if(in_array('category', $_temp) == TRUE || in_array('bst', $_temp) == TRUE)
					$str = $str . '$route[\''.$val['url'].'/trang-(\d+)\'] = \'frontend/'.$val['param'].'/$1\';'."\n";
				$str = $str . '$route[\''.$val['url'].'\'] = \'frontend/'.$val['param'].'\';'."\n";
			}
			$fm = fopen($file, 'w');
			if(fwrite($fm, $str)){
				//$this->ftp->chmod($file, 0755);
				//$this->ftp->close();
			}
		}
	}
	
	public function _route($route, $old_route){
		
		$route = $this->CI->my_string->alias($route);
		if(isset($old_route) &&!empty($old_route)){
			$count = $this->CI->db->where(array('url' => $route, 'url !=' => $old_route))->from('route')->count_all_results();
		}
		else{
			$count = $this->CI->db->where(array('url' => $route))->from('route')->count_all_results();
		}
		if(isset($count) && $count > 0){
			$this->CI->form_validation->set_message('check_route','%s đã tồn tại');
			return false;
		}
		return true;
	 }
	
}