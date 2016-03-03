<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_frontend {

	private $CI;
	
	public function __construct()
	{
		 $this->CI =&get_instance();
	}
	
	public function lang($lang = 'vi'){
		if($lang == 'vi'){
			$this->CI->session->set_userdata('_lang', 'vi');
		}
		else{
			if(!empty($lang) && in_array($lang, array('jp', 'en'))){
				$this->CI->session->set_userdata('_lang', $lang);
			}
		}
		$_lang = $this->CI->session->userdata('_lang');
		$this->CI->lang->load('lang_international', $_lang);
		return $_lang;
	}
	
	public function canonical($route, $alias, $id, $module, $suffix = TRUE){
	   if($suffix == TRUE){
			if(!empty($route)) return BASE_URL.$route.TT_URL_SUFFIX;
			else return BASE_URL.$alias.'-'.$module.$id.TT_URL_SUFFIX;  
	   }
	   else{
			if(!empty($route)) return BASE_URL.$route;
			else return BASE_URL.$alias.'-'.$module.$id;  
	   }
	   
	}
	
	public function pagination(){
		
		$param['base_url']			= ''; // The page we are linking to
		$param['prefix']			= ''; // A custom prefix added to the path.
		$param['suffix']			= TT_URL_SUFFIX; // A custom suffix added to the path.

		$param['total_rows']		=  0; // Total number of items (database results)
		$param['per_page']			=  3; // Max number of items you want shown per page
		$param['num_links']			=  2; // Number of "digit" links to show before/after the currently viewed page
		$param['cur_page']			=  0; // The current page being viewed
		$param['use_page_numbers']	= TRUE; // Use page number for segment instead of offset
		$param['first_link']		= 'Trang đầu';
		$param['next_link']			= '&raquo;';
		$param['prev_link']			= '&laquo;';
		$param['last_link']			= 'Trang cuối';
		$param['uri_segment']		= 4;
		$param['full_tag_open']		= '';
		$param['full_tag_close']	= '';
		$param['first_tag_open']	= '<li>';
		$param['first_tag_close']	= '</li>';
		$param['last_tag_open']		= '<li>';
		$param['last_tag_close']	= '</li>';
		$param['first_url']			= ''; // Alternative URL for the First Page.
		$param['cur_tag_open']		= '<li class = "active">';
		$param['cur_tag_close']		= '</li>';
		$param['next_tag_open']		= '<li>';
		$param['next_tag_close']	= '</li>';
		$param['prev_tag_open']		= '<li>';
		$param['prev_tag_close']	= '</li>';
		$param['num_tag_open']		= '<li>';
		$param['num_tag_close']		= '</li>';
		$param['bar']				= FALSE;
		
		return $param;
	}
	
	public function pagination_category(){
		
		$param['base_url']			= ''; // The page we are linking to
		$param['prefix']			= ''; // A custom prefix added to the path.
		$param['suffix']			= TT_URL_SUFFIX; // A custom suffix added to the path.

		$param['total_rows']		=  0; // Total number of items (database results)
		$param['per_page']			=  6; // Max number of items you want shown per page
		$param['num_links']			=  2; // Number of "digit" links to show before/after the currently viewed page
		$param['cur_page']			=  0; // The current page being viewed
		$param['use_page_numbers']	= TRUE; // Use page number for segment instead of offset
		$param['first_link']		= 'Trang đầu';
		$param['next_link']			= '&raquo;';
		$param['prev_link']			= '&laquo;';
		$param['last_link']			= 'Trang cuối';
		$param['uri_segment']		= 4;
		$param['full_tag_open']		= '<ul>';
		$param['full_tag_close']	= '</ul>';
		$param['first_tag_open']	= '<li>';
		$param['first_tag_close']	= '</li>';
		$param['last_tag_open']		= '<li>';
		$param['last_tag_close']	= '</li>';
		$param['first_url']			= ''; // Alternative URL for the First Page.
		$param['cur_tag_open']		= '<li class = "active">';
		$param['cur_tag_close']		= '</li>';
		$param['next_tag_open']		= '<li>';
		$param['next_tag_close']	= '</li>';
		$param['prev_tag_open']		= '<li>';
		$param['prev_tag_close']	= '</li>';
		$param['num_tag_open']		= '<li>';
		$param['num_tag_close']		= '</li>';
		$param['bar']				= FALSE;
		
		return $param;
	}
	
	function get_name_city($id){
		return $this->CI->db->select('TenTinhThanh')->from('tinhthanh')->where(array('ID' => $id))->get()->row_array();
	}
	
}