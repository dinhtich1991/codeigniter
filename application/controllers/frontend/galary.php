<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Galary extends MY_Controller {

	 public function __construct(){
		parent::__construct();
		$this->auth = $this->my_auth->check();
	}
    
	public function bst($catid = 2, $page = 1){
		$catid = (int)$catid;
		
		$bst = $this->db->where(array('id' => $catid, 'publish' => 1))->from('galary_bst')->get()->row_array();
		$this->my_frontend->lang($bst['lang']);
		$_lang = $this->session->userdata('_lang');
		$_item = $this->db->select('galary_bstdetail.title, galary_bstdetail.created, galary_bstdetail.image_content')->from('galary_bst')->join('galary_bstdetail','galary_bstdetail.parentid = galary_bst.id')->get()->result_array();
		if(!isset($bst) || empty($bst)) $this->my_string->php_redirect(BASE_URL);
		$author = $this->db->select('id, username, fullname, google_author')->where(array('id' => $bst['userid_created']))->from('user')->get()->row_array();
		if(!isset($author) && count($author) == 0) $this->my_string->php_redirect(BASE_URL);
		
		
		
		//echo $_lang; die;
		$config = $this->my_frontend->pagination();
		$config['first_url'] = $this->my_frontend->canonical($bst['route'], $bst['alias'], $bst['id'], 'b', FALSE).TT_URL_SUFFIX;
		$config['base_url'] = $this->my_frontend->canonical($bst['route'], $bst['alias'], $bst['id'], 'b', FALSE).'/trang-';
		if($bst['rgt'] - $bst['rgt'] == 1){
			$config['total_rows'] = $this->db->from('galary_bstdetail')->where(array('lang' => $_lang, 'publish' => 1, 'parentid' => $catid))->count_all_results();
		}
		else{
			$_children = $this->my_nestedset->children('galary_bst', array(
			'lft >=' => $bst['lft'],
			'rgt <=' => $bst['rgt'],
			));
			$config['total_rows'] = $this->db->from('galary_bstdetail')->where(array('lang' => $_lang, 'publish' => 1))->where_in('parentid', $_children)->count_all_results();
		}
		//echo $config['total_rows']; die;
		$_totalpage = ceil($config['total_rows']/$config['per_page']);
		$page = ($page <= 1)?1:$page;
		$page = ($page > $_totalpage)?$_totalpage:$page;
		$config['cur_page'] = $page;
		//echo $config['cur_page'];
		if($config['total_rows'] > 0){
			$this->pagination->initialize($config);
			$data['data']['_pagination'] = $this->pagination->create_links();
			
			if($bst['rgt'] - $bst['rgt'] == 1){
				$data['data']['_list'] = $this->db->select('id, title, alias, route, parentid, image_content, image, description, created')->from('galary_bstdetail')->where(array('lang' => $_lang, 'parentid' =>$catid, 'publish' => 1))->limit($config['per_page'],($page -1) * $config['per_page'])->order_by('order desc, id desc')->get()->result_array();	
			}
			else{
				$data['data']['_list'] = $this->db->select('id, title, alias, route, parentid, image_content, image, description, created')->from('galary_bstdetail')->where(array('lang' => $_lang, 'publish' => 1))->where_in('parentid', $_children)->limit($config['per_page'],($page -1) * $config['per_page'])->order_by('order desc, id desc')->get()->result_array();
			}
			
		}
		//print_r($data['data']['_list']); die;
		$data['data']['_config'] = $config;
		$data['data']['_page'] = $page;
		$seo_page = ($page > 1)?'Trang '.$page:'';
		$data['seo']['title'] = !empty($bst['meta_title'])?$bst['meta_title'].$seo_page:$bst['title'].$seo_page;
		$data['seo']['keywords'] = $bst['meta_keyword'];
		$data['seo']['description'] = (!empty($bst['meta_description'])?$bst['meta_description']:strip_tags($bst['description'])).$seo_page;
		if($page > 1){
			$data['seo']['canonical'] = $this->my_frontend->canonical($bst['route'], $bst['alias'], $bst['id'], '68', FALSE).'/trang-'.$page;
		}
		else{
			$data['seo']['canonical'] = $this->my_frontend->canonical($bst['route'], $bst['alias'], $bst['id'], '68');
		}
		
		$fullurl = current(explode('?',$this->my_string->fullurl()));
		//if($fullurl != $data['seo']['canonical']) $this->my_string->php_redirect($data['seo']['canonical']);
		$data['data']['_breadcrumb'] = $config;
		$data['data']['_bst'] = $bst;
		$data['data']['_item'] = $_item;
		$data['data']['_author'] = $author;
		//print_r($bst);die;
		// Tạo link prev-next cho SEO
		$data['data']['_children'] = ($bst['rgt'] - $bst['lft'] > 1)?$this->db->select('id, title, route, alias')->from('galary_bst')->where(array('parentid' => $catid, 'publish' => 1))->get()->result_array():NULL;
		if($page == 2) $data['seo']['rel_prev'] = $config['first_url'];
		else if($page > 2) $data['seo']['rel_prev'] = $config['base_url'].($page - 1).TT_URL_SUFFIX;
		if($page < $_totalpage) $data['seo']['rel_next'] = $config['base_url'].($page + 1).TT_URL_SUFFIX;
		$data['data']['user'] = $this->auth;
		$data['template'] = 'frontend/galary/bst';
		$this->load->view('frontend/layout/home',$data);
	}

    public function bstdetail($itemid = 1){
		$itemid = (int)$itemid;
		$bstdetail = $this->db->where(array('id' => $itemid, 'publish' => 1))->from('galary_bstdetail')->get()->row_array();
		
		$temp = explode(',',$bstdetail['relative']);
		$relative[] = NULL;
		foreach($temp as $key => $val){
			if(isset($val) && !empty($val)){
				$relative[] = $this->db->select('title, id, image_content, created')->where(array('title' => trim($val)))->from('galary_bstdetail')->get()->row_array();
			}
		}
		/*
		foreach($relative as $key => $val){
			if(isset($val) && !empty($val)){
				$tam[] = $val['id'];
			}
		}
		foreach($tam as $key => $val){
			
		}
		*/
		//print_r($re);die;
		//echo $bstdetail['relative']; die;	
		
		if(!isset($bstdetail) && count($bstdetail) == 0) $this->my_string->php_redirect(BASE_URL);
		$author = $this->db->select('id, username, fullname, google_author')->where(array('id' => $bstdetail['userid_created']))->from('user')->get()->row_array();
		if(!isset($author) && count($author) == 0) $this->my_string->php_redirect(BASE_URL);
		$bst = $this->db->where(array('id' => $bstdetail['parentid'], 'publish' => 1))->from('galary_bst')->get()->row_array();
		if(!isset($bst) && count($bst) == 0) $this->my_string->php_redirect(BASE_URL);
		$author = $this->db->select('id, username, fullname, google_author')->where(array('id' => $bst['userid_created']))->from('user')->get()->row_array();
		if(!isset($author) && count($author) == 0) $this->my_string->php_redirect(BASE_URL);
		$this->my_frontend->lang($bst['lang']);
		$_lang = $this->session->userdata('_lang');
		
		if($this->input->post('comment')){
            
            $_post = $this->input->post('data');
            $data['data']['_post'] = $_post;
			$this->form_validation->set_error_delimiters('<li>','</li>');
            $this->form_validation->set_rules('data[fullname]','Họ tên','trim|required');
            $this->form_validation->set_rules('data[email]','Email','trim|required');
            $this->form_validation->set_rules('data[content]','Nội dung','trim|required');
            
			if($this->form_validation->run() == TRUE){
                $_post = $this->my_string->allow_post($_post,array('fullname','email','content'));
                $_post['created'] = gmdate('Y-m-d H:i:s',time() + 7*3600);  
                $_post['param'] = 'galary/bstdetail/'.$itemid;  
				$this->db->insert('comment',$_post);
                $this->my_string->js_redirect('Phản hồi thành công!', $this->my_frontend->canonical($bstdetail['route'], $bstdetail['alias'], $bstdetail['id'], '88'));
            }
            
        }
		//echo $_lang; die;
		
		$data['seo']['title'] = !empty($bstdetail['meta_title'])?$bstdetail['meta_title']:$bstdetail['title'];
		$data['seo']['keywords'] = $bstdetail['meta_keyword'];
		$data['seo']['description'] = (!empty($bstdetail['meta_description'])?$bstdetail['meta_description']:strip_tags($bstdetail['description']));
		$data['seo']['canonical'] = $this->my_frontend->canonical($bstdetail['route'], $bstdetail['alias'], $bstdetail['id'], '88');
		
		$fullurl = current(explode('?',$this->my_string->fullurl()));
		//if($fullurl != $data['seo']['canonical']) $this->my_string->php_redirect($data['seo']['canonical']);
		$data['data']['_bstdetail'] = $bstdetail;
		$data['data']['_relative'] = $relative;
		$data['data']['_bst'] = $bst;
		$data['data']['_author'] = $author;
		
		// Tạo link prev-next cho SEO
		$data['data']['_children'] = ($bst['rgt'] - $bst['lft'] > 1)?$this->db->select('id, title, route, alias')->from('galary_bst')->where(array('parentid' => $item['parentid'], 'publish' => 1))->get()->result_array():NULL;
		$data['data']['user'] = $this->auth;
		$data['template'] = 'frontend/galary/bstdetail';
		$this->load->view('frontend/layout/home',$data);
	}
    
}

