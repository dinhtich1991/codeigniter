<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subarticle extends MY_Controller {

	 public function __construct(){
		parent::__construct();
		$this->auth = $this->my_auth->check();
	}
    
	public function category($catid = 0, $page = 1){
		$catid = (int)$catid;
		$category = $this->db->where(array('id' => $catid, 'publish' => 1))->from('article_category')->get()->row_array();
		if(!isset($category) && count($category) == 0) $this->my_string->php_redirect(BASE_URL);
		$author = $this->db->select('id, username, fullname, google_author')->where(array('id' => $category['userid_created']))->from('user')->get()->row_array();
		if(!isset($author) && count($author) == 0) $this->my_string->php_redirect(BASE_URL);
		
		$this->my_frontend->lang($category['lang']);
		$_lang = $this->session->userdata('_lang');
		
		//echo $_lang; die;
		$config = $this->my_frontend->pagination();
		$config['first_url'] = $this->my_frontend->canonical($category['route'], $category['alias'], $category['id'], '68', FALSE).TT_URL_SUFFIX;
		$config['base_url'] = $this->my_frontend->canonical($category['route'], $category['alias'], $category['id'], '68', FALSE).'/trang-';
		if($category['rgt'] - $category['rgt'] == 1){
			$config['total_rows'] = $this->db->from('article_item')->where(array('lang' => $_lang, 'publish' => 1, 'parentid' => $catid))->count_all_results();
		}
		else{
			$_children = $this->my_nestedset->children('article_category', array(
			'lft >=' => $category['lft'],
			'rgt <=' => $category['rgt'],
			));
			$config['total_rows'] = $this->db->from('article_item')->where(array('lang' => $_lang, 'publish' => 1))->where_in('parentid', $_children)->count_all_results();
		}
		//echo $config['total_rows']; die;
		$_totalpage = ceil($config['total_rows']/$config['per_page']);
		$page = ($page <= 1)?1:$page;
		$page = ($page > $_totalpage)?$_totalpage:$page;
		$config['cur_page'] = $page;
		//echo $config['cur_page'];
		if($config['total_rows'] > 0){
			$this->pagination->initialize($config);
			$data['data']['pagination'] = $this->pagination->create_links();
			
			if($category['rgt'] - $category['rgt'] == 1){
				$data['data']['_list'] = $this->db->select('id, title, alias, route, parentid, image, description, created')->from('article_item')->where(array('lang' => $_lang, 'parentid' =>$catid, 'publish' => 1))->limit($config['per_page'],($page -1) * $config['per_page'])->order_by('order desc, id desc')->get()->result_array();	
			}
			else{
				$data['data']['_list'] = $this->db->select('id, title, alias, route, parentid, image, description, created')->from('article_item')->where(array('lang' => $_lang, 'publish' => 1))->where_in('parentid', $_children)->limit($config['per_page'],($page -1) * $config['per_page'])->order_by('order desc, id desc')->get()->result_array();
			}
			
		}
		//print_r($data['data']['_list']); die;
		$data['data']['_config'] = $config;
		$data['data']['_page'] = $page;
		$seo_page = ($page > 1)?'Trang '.$page:'';
		$data['seo']['title'] = !empty($category['meta_title'])?$category['meta_title'].$seo_page:$category['title'].$seo_page;
		$data['seo']['keywords'] = $category['meta_keyword'];
		$data['seo']['description'] = (!empty($category['meta_description'])?$category['meta_description']:strip_tags($category['description'])).$seo_page;
		if($page > 1){
			$data['seo']['canonical'] = $this->my_frontend->canonical($category['route'], $category['alias'], $category['id'], '68', FALSE).'/trang-'.$page;
		}
		else{
			$data['seo']['canonical'] = $this->my_frontend->canonical($category['route'], $category['alias'], $category['id'], '68');
		}
		
		$fullurl = current(explode('?',$this->my_string->fullurl()));
		//if($fullurl != $data['seo']['canonical']) $this->my_string->php_redirect($data['seo']['canonical']);
		$data['data']['_breadcrumb'] = $config;
		$data['data']['_category'] = $category;
		$data['data']['_author'] = $author;
		$data['data']['user'] = $this->auth;
		// Tạo link prev-next cho SEO
		$data['data']['_children'] = ($category['rgt'] - $category['lft'] > 1)?$this->db->select('id, title, route, alias')->from('article_category')->where(array('parentid' => $catid, 'publish' => 1))->get()->result_array():NULL;
		if($page == 2) $data['seo']['rel_prev'] = $config['first_url'];
		else if($page > 2) $data['seo']['rel_prev'] = $config['base_url'].($page - 1).TT_URL_SUFFIX;
		if($page < $_totalpage) $data['seo']['rel_next'] = $config['base_url'].($page + 1).TT_URL_SUFFIX;
		
		$data['template'] = 'frontend/article/category';
		$this->load->view('frontend/layout/home',$data);
	}

    public function item($itemid = 0){
		$itemid = (int)$itemid;
		$item = $this->db->where(array('id' => $itemid, 'publish' => 1))->from('article_item')->get()->row_array();
		if(!isset($item) && count($item) == 0) $this->my_string->php_redirect(BASE_URL);
		$author = $this->db->select('id, username, fullname, google_author')->where(array('id' => $item['userid_created']))->from('user')->get()->row_array();
		if(!isset($author) && count($author) == 0) $this->my_string->php_redirect(BASE_URL);
		$category = $this->db->where(array('id' => $item['parentid'], 'publish' => 1))->from('article_category')->get()->row_array();
		if(!isset($category) && count($category) == 0) $this->my_string->php_redirect(BASE_URL);
		$author = $this->db->select('id, username, fullname, google_author')->where(array('id' => $category['userid_created']))->from('user')->get()->row_array();
		if(!isset($author) && count($author) == 0) $this->my_string->php_redirect(BASE_URL);
		$this->my_frontend->lang($category['lang']);
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
                $_post['param'] = 'article/item/'.$itemid;  
				$this->db->insert('comment',$_post);
                $this->my_string->js_redirect('Phản hồi thành công!', $this->my_frontend->canonical($item['route'], $item['alias'], $item['id'], '88'));
            }
            
        }
		//echo $_lang; die;
		
		$data['seo']['title'] = !empty($item['meta_title'])?$item['meta_title']:$item['title'];
		$data['seo']['keywords'] = $item['meta_keyword'];
		$data['seo']['description'] = (!empty($item['meta_description'])?$item['meta_description']:strip_tags($item['description']));
		$data['seo']['canonical'] = $this->my_frontend->canonical($item['route'], $item['alias'], $item['id'], '88');
		
		$fullurl = current(explode('?',$this->my_string->fullurl()));
		//if($fullurl != $data['seo']['canonical']) $this->my_string->php_redirect($data['seo']['canonical']);
		$data['data']['_item'] = $item;
		$data['data']['_category'] = $category;
		$data['data']['_author'] = $author;
		$data['data']['user'] = $this->auth;
		// Tạo link prev-next cho SEO
		$data['data']['_children'] = ($category['rgt'] - $category['lft'] > 1)?$this->db->select('id, title, route, alias')->from('article_category')->where(array('parentid' => $item['parentid'], 'publish' => 1))->get()->result_array():NULL;
		
		$data['template'] = 'frontend/article/item';
		$this->load->view('frontend/layout/home',$data);
	}
    
}

