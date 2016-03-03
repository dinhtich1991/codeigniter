<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends MY_Controller {

	public $auth;
    public function __construct(){
		parent::__construct();
		$this->auth = $this->my_auth->check();
		if($this->auth == NULL) $this->my_string->php_redirect(BASE_URL.'backend/home/index');
		$this->my_auth->allow($this->auth, 'backend/article');
		$this->my_route->create();
	}
    
    public function category(){
		$this->my_auth->allow($this->auth, 'backend/article/category');
		//print_r($this->_config);
		if($this->input->post('sort')){
			$_order = $this->input->post('order');
			if(isset($_order) && count($_order) >= 2){
				foreach($_order as $key =>$val){
					$_data[] = array(
						'id' =>$key,
						'order' =>(int)$val,
					);
				}
				$this->db->update_batch('article_category',$_data,'id');
				$this->my_string->js_redirect('Sắp xếp thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/article/category');
			}
			else{
				$this->my_string->js_redirect('Chọn 2 đối tượng trở lên để sắp xếp!',BASE_URL.'backend/article/category');
			}
		}
		$data['seo']['title'] = 'Danh mục bài viết';
		$data['data']['auth'] = $this->auth;
		$this->my_nestedset->set('article_category');
		$data['data']['_list'] = $this->my_nestedset->data('article_category');
		
		$data['template'] = 'backend/article/category';
		$this->load->view('backend/layout/home',isset($data)?$data:NULL);
	}
	
	 public function addcategory(){
		$this->my_auth->allow($this->auth, 'backend/article/category');
		$this->my_nestedset->check_empty('article_category');

		
		$data['seo']['title'] = 'Thêm danh mục';
		$data['data']['auth'] = $this->auth;
		
		if($this->input->post('add')){
            
            $_post = $this->input->post('data');
            $data['data']['_post'] = $_post;
			$this->form_validation->set_error_delimiters('<li>','</li>');
            $_post['userid_created'] = $this->auth['id'];  
            $this->form_validation->set_rules('data[title]','Tiêu đề','trim|required');
            $this->form_validation->set_rules('data[parentid]','Node cha','trim|required|is_natural_no_zero');
            if(isset($_post['route']) && !empty($_post['route'])){
				 $this->form_validation->set_rules('data[route]','URL tùy biến','trim|required|callback_check_route');
				$_post['route'] = $this->my_string->alias($_post['route']);
			}
			if($this->form_validation->run() == TRUE){
                $_post = $this->my_string->allow_post($_post,array('title','parentid','route','description','publish','meta_title','meta_keyword','meta_description'));
                $_post['lang'] = $this->session->userdata('_lang');
				$_post['created'] = gmdate('Y-m-d H:i:s',time() + 7*3600);  
                $_post['userid_created'] = $this->auth['id'];  
				$_post['alias'] = $this->my_string->alias($_post['title']); 
                $this->db->insert('article_category',$_post);
				 if(isset($_post['route']) && !empty($_post['route'])){
					$this->my_route->insert(array(
						'url' => $_post['route'],
						'param' => 'article/category'.$this->db->insert_id(),
						'created' => gmdate('Y-m-d H:i:s',time() + 7*3600),
					));
				 }
                $this->my_string->js_redirect('Thêm danh mục thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/article/category');
            }
            
        }
		else{
			$_post['publish'] = 1;
			$data['data']['_post'] = $_post;
		}
		$data['data']['_show']['parentid'] = $this->my_nestedset->dropdown('article_category', NULL, 'category');
		$data['template'] = 'backend/article/addcategory';
		$this->load->view('backend/layout/home',isset($data)?$data:NULL);
	
	 }
	public function editcategory($id){
        $this->my_auth->allow($this->auth, 'backend/article/editcategory');
		$id = (int)$id;
		$category = $this->db->where(array('id' => $id))->from('article_category')->get()->row_array();
		if(!isset($category) && count($category) == 0) $this->my_string->php_redirect(BASE_URL.'backend/article/category');
		if($category['lang'] != $this->session->userdata('_lang')) $this->my_string->js_redirect('Ngôn ngữ không phù hợp', !empty($continue)?base64_decode($continue):BASE_URL.'backend/article/category');
		$_post = $category;
	    if($category['level'] == 0) $this->my_string->js_redirect('Không được phép sửa Root.',BASE_URL.'backend/article/category');
		$data['seo']['title'] = 'Sửa danh mục';
		$data['data']['auth'] = $this->auth;
		if($this->input->post('edit')){
            
            $_post = $this->input->post('data');
            $data['data']['_post'] = $_post;
			$this->form_validation->set_error_delimiters('<li>','</li>');
            $this->form_validation->set_rules('data[title]','Tiêu đề','trim|required');
            $this->form_validation->set_rules('data[parentid]','Node cha','trim|required|is_natural_no_zero|callback_check_parentid['.$id.']');
            if(isset($_post['route']) && !empty($_post['route'])){
				 $this->form_validation->set_rules('data[route]','URL tùy biến','trim|required|callback_check_route['.$category['route'].']');
				$_post['route'] = $this->my_string->alias($_post['route']);
			}
			if($this->form_validation->run() == TRUE){
                $_post = $this->my_string->allow_post($_post,array('title','parentid','route','description','publish','meta_title','meta_keyword','meta_description'));
                $_post['updated'] = gmdate('Y-m-d H:i:s',time() + 7*3600);  
                $_post['userid_updated'] = $this->auth['id'];
				$_post['alias'] = $this->my_string->alias($_post['title']); 
				$this->db->where(array('id' =>$id))->update('article_category',$_post);
				$this->my_route->update('article/category/'.$id, $_post['route']);
				
                $this->my_string->js_redirect('Sửa quảng cáo thành công!',BASE_URL.'backend/article/category');
            }
            
        }
		else{
			$data['data']['_post'] = $category;
		}
		$data['data']['auth'] = $this->auth;
	   $data['data']['_show']['parentid'] = $this->my_nestedset->dropdown('article_category', NULL, 'category');
	   $data['template'] = 'backend/article/editcategory';
	   $this->load->view('backend/layout/home',$data);
        
    }
	
	public function check_parentid($parentid, $catid){
		$parentid = (int)$parentid;
		$catid = (int)$catid;
		return $this->my_nestedset->check_parentid('article_category',$parentid, $catid);
	}
    
	public function delcategory($id){
        $this->my_auth->allow($this->auth, 'backend/article/delcategory');
		$id = (int)$id;
		$category = $this->db->where(array('id' => $id))->from('article_category')->get()->row_array();
		if($category['lang'] != $this->session->userdata('_lang')) $this->my_string->js_redirect('Ngôn ngữ không phù hợp', BASE_URL.'backend/article/category');
		if(!isset($category) && count($category) == 0) $this->my_string->php_redirect(BASE_URL.'backend/article/category');
		if($category['level'] == 0) $this->my_string->js_redirect('Không được phép xóa Root.',BASE_URL.'backend/article/category');
		
		$count = count($this->my_nestedset->children('article_category', array(
			'lft >' => $category['lft'],
			'rgt <' => $category['rgt'],
		)));
		if($count > 0) $this->my_string->js_redirect('Vẫn còn chuyên mục con.',BASE_URL.'backend/article/category');
		
		$count = $this->db->from('article_item')->where(array('parentid' => $id))->count_all_results();
		if($count > 0) $this->my_string->js_redirect('Vẫn còn bài viết', BASE_URL.'backend/article/category');
		
		$this->db->delete('article_category',array('id' =>$id));
		$this->my_string->js_redirect('Xóa danh mục thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/article/category');
    }
	
	public function setcategory($field, $id){
        $this->my_auth->allow($this->auth, 'backend/article/setcategory');
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$category = $this->db->where(array('id' => $id))->from('article_category')->get()->row_array();
		if(!isset($category) && count($category) == 0) $this->my_string->php_redirect(BASE_URL.'backend/article/category');
		
		if(!isset($category[$field])) $this->my_string->php_redirect(BASE_URL.'backend/article/category');
		
		$this->db->where(array('id' =>$id))->update('article_category',array($field =>(($category[$field] ==1)?0:1)));
        $this->my_string->js_redirect('Đồi trạng cáo thành công!',BASE_URL.'backend/article/category');
	}
	
	public function item($page = 1){
		
		$this->my_auth->allow($this->auth, 'backend/article/item');
		$continue = $this->input->get('continue');
		if($this->input->post('sort')){
			$_order = $this->input->post('order');
			if(isset($_order) && count($_order) >= 2){
				foreach($_order as $key =>$val){
					$_data[] = array(
						'id' =>$key,
						'order' =>(int)$val,
					);
				}
				$this->db->update_batch('article_item',$_data,'id');
				$this->my_string->js_redirect('Sắp xếp thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/article/item');
			}
			else{
				$this->my_string->js_redirect('Chọn 2 đối tượng trở lên để sắp xếp!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/article/item');
			}
		}
		if($this->input->post('del')){
			$_checkbox = $this->input->post('checkbox');
			if(isset($_checkbox) && count($_checkbox) >= 2){
				$temp = null;
				foreach($_checkbox as $key =>$val){
					$temp[] = $key;
				}
				if(count($temp)){
					$this->db->where_in('id',$temp)->delete('article_item');
					$this->my_string->js_redirect('Xóa dữ liệu thành công!',BASE_URL.'backend/article/item');
				}
			}
			else{
				$this->my_string->js_redirect('Chọn 2 đối tượng trở lên để xóa!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/article/item');
			}
		}
		
		$sort = $this->my_common->sort_orderby($this->input->get('sort_field'),$this->input->get('sort_value'));
		
	    $data['seo']['title'] = 'Bài viết';
		$_lang = $this->session->userdata('_lang');
		$keyword = $this->input->get('keyword');
		$parentid = (int)$this->input->get('parentid');
		$config = $this->my_common->backend_pagination();
		$config['base_url'] = 'backend/article/item';
		
		if(!empty($keyword) && $parentid ==0){
			$_sql = 'SELECT * FROM '.TT_DB_PREFIX.'article_item WHERE `lang` = ? AND `parentid` = ? AND (`title` LIKE ? OR `description` LIKE ? OR `content` LIKE ?)';
			$_param = array($_lang, $parentid, '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%');
			$config['total_rows'] = $this->db->query($_sql, $_param)->num_rows(); 
		}
		
		else if(empty($keyword) && $parentid > 0){
			$config['total_rows'] = $this->db->from('article_item')->where(array('lang' => $_lang))->where(array('parentid' => $parentid))->count_all_results();
		}
		else if(!empty($keyword) && $parentid > 0){
			$_sql = 'SELECT * FROM '.TT_DB_PREFIX.'article_item WHERE `lang` = ? AND `parentid` = ? AND (`title` LIKE ? OR `description` LIKE ? OR `content` LIKE ?)';
			$_param = array($_lang, $parentid, '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%');
			$config['total_rows'] = $this->db->query($_sql, $_param)->num_rows(); 
		}
		else{
			$config['total_rows'] = $this->db->from('article_item')->where(array('lang' => $_lang))->count_all_results();
		}
		//echo $config['total_rows']; die;
		$_totalpage = ceil($config['total_rows']/$config['per_page']);
		$page = ($page > $_totalpage)?$_totalpage:$page;
		
		$config['cur_page'] = $page;
		$config['suffix'] = (isset($sort) && count($sort))?'?sort_field='.$sort['field'].'&sort_value='.$sort['value']:'';
		$config['suffix'] = $config['suffix'].(($parentid > 0)?'&parentid='.$parentid:'');
		$config['suffix'] = $config['suffix'].(!empty($keyword)?'&keyword='.$keyword:'');
		$config['first_url'] = $config['base_url'].$config['suffix'];
		
		if($config['total_rows'] > 0){
			$this->pagination->initialize($config);
			$data['data']['pagination'] = $this->pagination->create_links();
			if(!empty($keyword) && $parentid == 0){
				$_sql = 'SELECT * FROM '.TT_DB_PREFIX.'article_item WHERE `lang` = ? AND (`title` LIKE ? OR `description` LIKE ? OR `content` LIKE ?) ORDER_BY `'.$sort['field'].'` '.$sort['value'].' LIMIT '.(($page - 1) * $config['per_page']).', '.$config['per_page'];
				$_param = array($_lang, $parentid, '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%');
				$data['data']['_list'] = $this->db->query($_sql, $_param)->result_array(); 
			}
			else if(empty($keyword) && $parentid > 0){
				$data['data']['_list'] = $this->db->from('article_item')->where(array('lang' => $_lang))->where(array('parentid' =>$parentid))->limit($config['per_page'],($page -1) * $config['per_page'])->order_by($sort['field'].' '.$sort['value'])->get()->result_array();
			}
			else if(!empty($keyword) && $parentid > 0){
				$_sql = 'SELECT * FROM '.TT_DB_PREFIX.'article_item WHERE `lang` = ? AND `parentid` = ? AND (`title` LIKE ? OR `description` LIKE ? OR `content` LIKE ?) ORDER_BY `'.$sort['field'].'` '.$sort['value'].' LIMIT '.(($page - 1) * $config['per_page']).', '.$config['per_page'];
				$_param = array($_lang, $parentid, '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%');
				$data['data']['_list'] = $this->db->query($_sql, $_param)->result_array(); 
			}
			else{
				$data['data']['_list'] = $this->db->from('article_item')->where(array('lang' => $_lang))->limit($config['per_page'],($page -1) * $config['per_page'])->order_by($sort['field'].' '.$sort['value'])->get()->result_array();
			}
		}
		//print_r($data['data']['_list']); die;
		$data['data']['_page'] = $page;
		$data['data']['_sort'] = $sort;
		$data['data']['_keyword'] = $keyword;
		$data['data']['_parentid'] = $parentid;
		$data['data']['_config'] = $config;
	   $data['data']['auth'] = $this->auth;
	   $data['data']['_show']['parentid'] = $this->my_nestedset->dropdown('article_category', NULL, 'item');
	   $data['template'] = 'backend/article/item';
	   $this->load->view('backend/layout/home',isset($data)?$data:NULL);
        
    }
	
	
	public function additem(){
		$this->my_auth->allow($this->auth, 'backend/article/additem');
		$continue = $this->input->get('continue');
		$_lang = $this->session->userdata('_lang');
		$attribute = $this->db->select('id, name')->from('attribute_group')->where(array('lang' => $_lang))->get()->result_array();
		
		if($this->input->post('add')){
            
            $_post = $this->input->post('data');
            
			$this->form_validation->set_error_delimiters('<li>','</li>');
            //$_post['userid_created'] = $this->auth['id'];  
            $this->form_validation->set_rules('data[title]','Tiêu đề','trim|required');
			$this->form_validation->set_rules('data[parentid]','Danh muc','trim|required');
            if(isset($_post['route']) && !empty($_post['route'])){
				$this->form_validation->set_rules('data[route]','URL tùy biến','trim|required|callback_check_route');
				$_post['route'] = $this->my_string->alias($_post['route']);
			}
			$data['data']['_post'] = $_post;
			$_post['attribute_id'] = '';
			for($a = 0; $a<10; $a++){
				$_post['attribute_id'] = $_post['attribute_id'].(isset($_post['thuoctinh'.$a.''])?($_post['thuoctinh'.$a.''].','):'');
			}
			echo $_post['attribute_id']; die;
			if($this->form_validation->run() == TRUE){
                $_post = $this->my_string->allow_post($_post,array('title','tags','parentid','attribute_id','attribute_item_id','image','description','route','content','publish','highlight','timer','source','meta_title','meta_keyword','meta_description'));
                $_post['timer'] = !empty( $_post['timer'])?gmdate('Y-m-d H:i:s',strtotime(str_replace('/','-',$_post['timer'])) + 7*3600):'';  
				$_post['created'] = gmdate('Y-m-d H:i:s',time() + 7*3600);  
                $_post['userid_created'] = $this->auth['id'];  
				$_post['tags'] = !empty($_post['tags'])?','.str_replace(', ', ',', $_post['tags']).',':'';
                $_post['alias'] = $this->my_string->alias($_post['title']); 
				$_post['lang'] = $this->session->userdata('_lang'); 
				
				$this->db->insert('article_item',$_post);
                $this->my_tags->insert_list($_post['tags']);
				 if(isset($_post['route']) && !empty($_post['route'])){
					$this->my_route->insert(array(
						'url' => $_post['route'],
						'param' => 'article/item/'.$this->db->insert_id(),
						'created' => gmdate('Y-m-d H:i:s',time() + 7*3600),
					));
				 }
				$this->my_string->js_redirect('Thêm bài viết thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/article/item');
            }
            
        }
		else{
			//$_post['timer'] = ($_post['timer'] !='1970-01-01 07:00:00')?gmdate('H:i:s d/m/Y', strtotime($_post['timer']) + 7*3600):'';
			$_post['publish'] = 1;
			$data['data']['_post'] = $_post;
		}
		$data['seo']['title'] = 'Thêm bài viết';
		$data['data']['auth'] = $this->auth;
		$data['data']['attribute'] = $attribute;
		$data['data']['_show']['parentid'] = $this->my_nestedset->dropdown('article_category', NULL, 'item');
		$data['template'] = 'backend/article/additem';
		$this->load->view('backend/layout/home',isset($data)?$data:NULL);
	
	 }
	 
	 public function check_route($route, $old_route){
		return $this->my_route->_route($route, isset($old_route)?$old_route:NULL);
	 }
	 
	public function edititem($id){
        $this->my_auth->allow($this->auth, 'backend/article/edititem');
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$item = $this->db->where(array('id' => $id))->from('article_item')->get()->row_array();
		if($item['lang'] != $this->session->userdata('_lang')) $this->my_string->js_redirect('Ngôn ngữ không phù hợp', !empty($continue)?base64_decode($continue):BASE_URL.'backend/article/item');
		if(!isset($item) && count($item) == 0) $this->my_string->php_redirect(BASE_URL.'backend/article/item');
		$_post = $item;
		//echo $item['userid_created']; die;
	    //print_r($this->auth); die;
		
		if($this->auth['group_allow'] == 1 && count($this->auth['group_content'])  && in_array('backend/article/edititem/self', $this->auth['group_content']) == TRUE && $this->auth['id'] != $item['userid_created']) $this->my_string->js_redirect('Không được sửa bài của người khác', !empty($continue)?base64_decode($continue):BASE_URL.'backend/article/item');
		
		
		$data['seo']['title'] = 'Sửa bài viết';
		$data['data']['auth'] = $this->auth;
		if($this->input->post('edit')){
            
            $_post = $this->input->post('data');
            $data['data']['_post'] = $_post;
			$this->form_validation->set_error_delimiters('<li>','</li>');
            
            $this->form_validation->set_rules('data[title]','Tiêu đề','trim|required');
            $this->form_validation->set_rules('data[parentid]','Danh mục','trim|required|is_natural_no_zero');
			if(isset($_post['route']) && !empty($_post['route'])){
				 $this->form_validation->set_rules('data[route]','URL tùy biến','trim|required|callback_check_route['.$item['route'].']');
				$_post['route'] = $this->my_string->alias($_post['route']);
			}
           if($this->form_validation->run() == TRUE){
			  
                $_post = $this->my_string->allow_post($_post,array('title','parentid','tags','route','image','description','content','publish','highlight','meta_title','meta_keyword','meta_description'));
                //$_post['timer'] = gmdate('Y-m-d H:i:s',strtotime(str_replace('/','-',$_post['timer'])) + 7*3600); 
                $_post['updated'] = gmdate('Y-m-d H:i:s',time() + 7*3600);  
                $_post['userid_updated'] = $this->auth['id'];  
				$_post['tags'] = !empty($_post['tags'])?','.str_replace(', ', ',', $_post['tags']).',':'';
				$_post['alias'] = $this->my_string->alias($_post['title']); 
				$this->db->where(array('id' =>$id))->update('article_item',$_post);
                $this->my_tags->insert_list($_post['tags']);
				$this->my_route->update('article/item/'.$id, $_post['route']);
				 
				$this->my_string->js_redirect('Sửa bài viết thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/article/item');
            }
            
        }
		else{
			//$item['timer'] = ($item['timer'] != '0000-00-00 00:00:00')?gmdate('H:i:s m/d/Y',strtotime(str_replace('-','/',$item['timer'])) + 7*3600):'';
			$item['tags'] = !empty($item['tags'])?str_replace(',',', ',substr(substr($item['tags'],1),0,-1)):'';
			$data['data']['_post'] = $item;
		}
	 
	   $data['data']['_show']['parentid'] = $this->my_nestedset->dropdown('article_category', NULL, 'item');
	   $data['template'] = 'backend/article/edititem';
	   $this->load->view('backend/layout/home',$data);
        
    }
	
	public function delitem($id){
        $this->my_auth->allow($this->auth, 'backend/article/delitem');
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$item = $this->db->where(array('id' => $id))->from('article_item')->get()->row_array();
		if(!isset($item) && count($item) == 0) $this->my_string->php_redirect(BASE_URL.'backend/article/item');
		
		$this->db->delete('article_item',array('id' =>$id));
	    $this->my_string->js_redirect('Xóa bài viết thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/article/item');
    }
	
	
	public function setitem($field, $id){
        $this->my_auth->allow($this->auth, 'backend/article/set');
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$item = $this->db->where(array('id' => $id))->from('article_item')->get()->row_array();
		if(!isset($item) && count($item) == 0) $this->my_string->php_redirect(BASE_URL.'backend/article/item');
		
		if(!isset($item[$field])) $this->my_string->php_redirect(BASE_URL.'backend/article/item');
		
		$this->db->where(array('id' =>$id))->update('article_item',array($field =>(($item[$field] ==1)?0:1)));
        $this->my_string->js_redirect('Đồi trạng cáo thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/article/item');
	}
	
}

