<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Galary extends MY_Controller {

	public $auth;
    public function __construct(){
		parent::__construct();
		$this->auth = $this->my_auth->check();
		if($this->auth == NULL) $this->my_string->php_redirect(BASE_URL.'backend/home/index');
		$this->my_auth->allow($this->auth, 'backend/galary');
		$this->my_route->create();
		$this->load->library('my_nestedset_galary');
		$this->load->library('my_galary');
	}
    
    public function bst(){
		$this->my_auth->allow($this->auth, 'backend/galary/bst');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
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
				$this->db->update_batch('galary_bst',$_data,'id');
				$this->my_string->js_redirect('Sắp xếp thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/galary/bst');
			}
			else{
				$this->my_string->js_redirect('Chọn 2 đối tượng trở lên để sắp xếp!',BASE_URL.'backend/galary/bst');
			}
		}
		$data['seo']['title'] = 'Danh mục bài viết';
		$data['data']['auth'] = $this->auth;
		$this->my_nestedset_galary->set('galary_bst');
		$data['data']['_list'] = $this->my_nestedset_galary->data('galary_bst');
		
		$data['template'] = 'backend/galary/bst';
		$this->load->view('backend/layout/home',isset($data)?$data:NULL);
	}
	
	 public function addbst(){
		$this->my_auth->allow($this->auth, 'backend/galary/bst');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$this->my_nestedset_galary->check_empty('galary_bst');

		
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
                $this->db->insert('galary_bst',$_post);
				 if(isset($_post['route']) && !empty($_post['route'])){
					$this->my_route->insert(array(
						'url' => $_post['route'],
						'param' => 'galary/bst'.$this->db->insert_id(),
						'created' => gmdate('Y-m-d H:i:s',time() + 7*3600),
					));
				 }
                $this->my_string->js_redirect('Thêm danh mục thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/galary/bst');
            }
            
        }
		else{
			$_post['publish'] = 1;
			$data['data']['_post'] = $_post;
		}
		$data['data']['_show']['parentid'] = $this->my_nestedset_galary->dropdown('galary_bst', NULL, 'bst');
		$data['template'] = 'backend/galary/addbst';
		$this->load->view('backend/layout/home',isset($data)?$data:NULL);
	
	 }
	public function editbst($id){
        $this->my_auth->allow($this->auth, 'backend/galary/editbst');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$id = (int)$id;
		$bst = $this->db->where(array('id' => $id))->from('galary_bst')->get()->row_array();
		if(!isset($bst) && count($bst) == 0) $this->my_string->php_redirect(BASE_URL.'backend/galary/bst');
		if($bst['lang'] != $this->session->userdata('_lang')) $this->my_string->js_redirect('Ngôn ngữ không phù hợp', !empty($continue)?base64_decode($continue):BASE_URL.'backend/galary/bst');
		$_post = $bst;
	    if($bst['level'] == 0) $this->my_string->js_redirect('Không được phép sửa Root.',BASE_URL.'backend/galary/bst');
		$data['seo']['title'] = 'Sửa danh mục';
		$data['data']['auth'] = $this->auth;
		if($this->input->post('edit')){
            
            $_post = $this->input->post('data');
            $data['data']['_post'] = $_post;
			$this->form_validation->set_error_delimiters('<li>','</li>');
            $this->form_validation->set_rules('data[title]','Tiêu đề','trim|required');
            $this->form_validation->set_rules('data[parentid]','Node cha','trim|required|is_natural_no_zero|callback_check_parentid['.$id.']');
            if(isset($_post['route']) && !empty($_post['route'])){
				 $this->form_validation->set_rules('data[route]','URL tùy biến','trim|required|callback_check_route['.$bst['route'].']');
				$_post['route'] = $this->my_string->alias($_post['route']);
			}
			if($this->form_validation->run() == TRUE){
                $_post = $this->my_string->allow_post($_post,array('title','parentid','route','description','publish','meta_title','meta_keyword','meta_description'));
                $_post['updated'] = gmdate('Y-m-d H:i:s',time() + 7*3600);  
                $_post['userid_updated'] = $this->auth['id'];
				$_post['alias'] = $this->my_string->alias($_post['title']); 
				$this->db->where(array('id' =>$id))->update('galary_bst',$_post);
				$this->my_route->update('galary/bst/'.$id, $_post['route']);
				
                $this->my_string->js_redirect('Sửa quảng cáo thành công!',BASE_URL.'backend/galary/bst');
            }
            
        }
		else{
			$data['data']['_post'] = $bst;
		}
		$data['data']['auth'] = $this->auth;
	   $data['data']['_show']['parentid'] = $this->my_nestedset_galary->dropdown('galary_bst', NULL, 'bst');
	   $data['template'] = 'backend/galary/editbst';
	   $this->load->view('backend/layout/home',$data);
        
    }
	
	public function check_parentid($parentid, $catid){
		$parentid = (int)$parentid;
		$catid = (int)$catid;
		return $this->my_nestedset_galary->check_parentid('galary_bst',$parentid, $catid);
	}
    
	public function delbst($id){
        $this->my_auth->allow($this->auth, 'backend/galary/delbst');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$id = (int)$id;
		$bst = $this->db->where(array('id' => $id))->from('galary_bst')->get()->row_array();
		if($bst['lang'] != $this->session->userdata('_lang')) $this->my_string->js_redirect('Ngôn ngữ không phù hợp', BASE_URL.'backend/galary/bst');
		if(!isset($bst) && count($bst) == 0) $this->my_string->php_redirect(BASE_URL.'backend/galary/bst');
		if($bst['level'] == 0) $this->my_string->js_redirect('Không được phép xóa Root.',BASE_URL.'backend/galary/bst');
		
		$count = count($this->my_nestedset_galary->children('galary_bst', array(
			'lft >' => $bst['lft'],
			'rgt <' => $bst['rgt'],
		)));
		if($count > 0) $this->my_string->js_redirect('Vẫn còn chuyên mục con.',BASE_URL.'backend/galary/bst');
		
		$count = $this->db->from('galary_bstdetail')->where(array('parentid' => $id))->count_all_results();
		if($count > 0) $this->my_string->js_redirect('Vẫn còn bài viết', BASE_URL.'backend/galary/bst');
		
		$this->db->delete('galary_bst',array('id' =>$id));
		$this->my_string->js_redirect('Xóa danh mục thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/galary/bst');
    }
	
	public function setbst($field, $id){
        $this->my_auth->allow($this->auth, 'backend/galary/setbst');
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$bst = $this->db->where(array('id' => $id))->from('galary_bst')->get()->row_array();
		if(!isset($bst) && count($bst) == 0) $this->my_string->php_redirect(BASE_URL.'backend/galary/bst');
		
		if(!isset($bst[$field])) $this->my_string->php_redirect(BASE_URL.'backend/galary/bst');
		
		$this->db->where(array('id' =>$id))->update('galary_bst',array($field =>(($bst[$field] ==1)?0:1)));
        $this->my_string->js_redirect('Đồi trạng cáo thành công!',BASE_URL.'backend/galary/bst');
	}
	
	public function bstdetail($page = 1){
		
		$this->my_auth->allow($this->auth, 'backend/galary/bstdetail');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
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
				$this->db->update_batch('galary_bstdetail',$_data,'id');
				$this->my_string->js_redirect('Sắp xếp thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/galary/bstdetail');
			}
			else{
				$this->my_string->js_redirect('Chọn 2 đối tượng trở lên để sắp xếp!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/galary/bstdetail');
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
					$this->db->where_in('id',$temp)->delete('galary_bstdetail');
					$this->my_string->js_redirect('Xóa dữ liệu thành công!',BASE_URL.'backend/galary/bstdetail');
				}
			}
			else{
				$this->my_string->js_redirect('Chọn 2 đối tượng trở lên để xóa!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/galary/bstdetail');
			}
		}
		
		$sort = $this->my_common->sort_orderby($this->input->get('sort_field'),$this->input->get('sort_value'));
		
	    $data['seo']['title'] = 'Bài viết';
		$_lang = $this->session->userdata('_lang');
		$keyword = $this->input->get('keyword');
		$parentid = (int)$this->input->get('parentid');
		$config = $this->my_common->backend_pagination();
		$config['base_url'] = 'backend/galary/bstdetail';
		
		if(!empty($keyword) && $parentid ==0){
			$_sql = 'SELECT * FROM '.TT_DB_PREFIX.'galary_bstdetail WHERE `lang` = ? AND `parentid` = ? AND (`title` LIKE ? OR `description` LIKE ? OR `content` LIKE ?)';
			$_param = array($_lang, $parentid, '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%');
			$config['total_rows'] = $this->db->query($_sql, $_param)->num_rows(); 
		}
		
		else if(empty($keyword) && $parentid > 0){
			$config['total_rows'] = $this->db->from('galary_bstdetail')->where(array('lang' => $_lang))->where(array('parentid' => $parentid))->count_all_results();
		}
		else if(!empty($keyword) && $parentid > 0){
			$_sql = 'SELECT * FROM '.TT_DB_PREFIX.'galary_bstdetail WHERE `lang` = ? AND `parentid` = ? AND (`title` LIKE ? OR `description` LIKE ? OR `content` LIKE ?)';
			$_param = array($_lang, $parentid, '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%');
			$config['total_rows'] = $this->db->query($_sql, $_param)->num_rows(); 
		}
		else{
			$config['total_rows'] = $this->db->from('galary_bstdetail')->where(array('lang' => $_lang))->count_all_results();
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
				$_sql = 'SELECT * FROM '.TT_DB_PREFIX.'galary_bstdetail WHERE `lang` = ? AND (`title` LIKE ? OR `description` LIKE ? OR `content` LIKE ?) ORDER_BY `'.$sort['field'].'` '.$sort['value'].' LIMIT '.(($page - 1) * $config['per_page']).', '.$config['per_page'];
				$_param = array($_lang, $parentid, '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%');
				$data['data']['_list'] = $this->db->query($_sql, $_param)->result_array(); 
			}
			else if(empty($keyword) && $parentid > 0){
				$data['data']['_list'] = $this->db->from('galary_bstdetail')->where(array('lang' => $_lang))->where(array('parentid' =>$parentid))->limit($config['per_page'],($page -1) * $config['per_page'])->order_by($sort['field'].' '.$sort['value'])->get()->result_array();
			}
			else if(!empty($keyword) && $parentid > 0){
				$_sql = 'SELECT * FROM '.TT_DB_PREFIX.'galary_bstdetail WHERE `lang` = ? AND `parentid` = ? AND (`title` LIKE ? OR `description` LIKE ? OR `content` LIKE ?) ORDER_BY `'.$sort['field'].'` '.$sort['value'].' LIMIT '.(($page - 1) * $config['per_page']).', '.$config['per_page'];
				$_param = array($_lang, $parentid, '%'.$keyword.'%', '%'.$keyword.'%', '%'.$keyword.'%');
				$data['data']['_list'] = $this->db->query($_sql, $_param)->result_array(); 
			}
			else{
				$data['data']['_list'] = $this->db->from('galary_bstdetail')->where(array('lang' => $_lang))->limit($config['per_page'],($page -1) * $config['per_page'])->order_by($sort['field'].' '.$sort['value'])->get()->result_array();
			}
		}
		//print_r($data['data']['_list']); die;
		$data['data']['_page'] = $page;
		$data['data']['_sort'] = $sort;
		$data['data']['_keyword'] = $keyword;
		$data['data']['_parentid'] = $parentid;
		$data['data']['_config'] = $config;
	   $data['data']['auth'] = $this->auth;
	   $data['data']['_show']['parentid'] = $this->my_nestedset_galary->dropdown('galary_bst', NULL, 'bstdetail');
	   $data['template'] = 'backend/galary/bstdetail';
	   $this->load->view('backend/layout/home',isset($data)?$data:NULL);
        
    }
	
	
	public function addbstdetail(){
		$this->my_auth->allow($this->auth, 'backend/galary/addbstdetail');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$continue = $this->input->get('continue');
		$data['seo']['title'] = 'Thêm bài viết';
		$data['data']['auth'] = $this->auth;
		
		if($this->input->post('add')){
            
            $_post = $this->input->post('data');
            
			$this->form_validation->set_error_delimiters('<li>','</li>');
            //$_post['userid_created'] = $this->auth['id'];  
            $this->form_validation->set_rules('data[title]','Tiêu đề','trim|required');
            $this->form_validation->set_rules('data[parentid]','Danh mục','trim|required|is_natural_no_zero');
            if(isset($_post['route']) && !empty($_post['route'])){
				$this->form_validation->set_rules('data[route]','URL tùy biến','trim|required|callback_check_route');
				$_post['route'] = $this->my_string->alias($_post['route']);
			}
			$str = '';
			if(isset($_post['image']) && !empty($_post['image']))
			{
				$temp = $_post['image'];
				foreach($temp as $key => $val){
					if(isset($val) && !empty($val)){
						$str = $str.','.$val;
					}
				}
				$_post['image'] = $str;
			}
			$data['data']['_post'] = $_post;
			if($this->form_validation->run() == TRUE){
				$_post = $this->my_string->allow_post($_post,array('title','relative','tags','parentid','image_content','image','description','route','content','publish','highlight','timer','source','meta_title','meta_keyword','meta_description'));
                $_post['timer'] = !empty( $_post['timer'])?gmdate('Y-m-d H:i:s',strtotime(str_replace('/','-',$_post['timer'])) + 7*3600):'';  
				$_post['created'] = gmdate('Y-m-d H:i:s',time() + 7*3600);  
                $_post['userid_created'] = $this->auth['id'];  
				$_post['tags'] = !empty($_post['tags'])?','.str_replace(', ', ',', $_post['tags']).',':'';
                $_post['alias'] = $this->my_string->alias($_post['title']); 
				$_post['lang'] = $this->session->userdata('_lang'); 
				
				$this->db->insert('galary_bstdetail',$_post);
                $this->my_galary->insert_list($_post['tags']);
				 if(isset($_post['route']) && !empty($_post['route'])){
					$this->my_route->insert(array(
						'url' => $_post['route'],
						'param' => 'galary/bstdetail/'.$this->db->insert_id(),
						'created' => gmdate('Y-m-d H:i:s',time() + 7*3600),
					));
				 }
				$this->my_string->js_redirect('Thêm bài viết thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/galary/bstdetail');
            }
            
        }
		else{
			//$_post['timer'] = ($_post['timer'] !='1970-01-01 07:00:00')?gmdate('H:i:s d/m/Y', strtotime($_post['timer']) + 7*3600):'';
			$_post['publish'] = 1;
			$data['data']['_post'] = $_post;
		}
		$data['data']['_show']['parentid'] = $this->my_nestedset_galary->dropdown('galary_bst', NULL, 'bstdetail');
		$data['template'] = 'backend/galary/addbstdetail';
		$this->load->view('backend/layout/home',isset($data)?$data:NULL);
	
	 }
	 
	 public function check_route($route, $old_route){
		return $this->my_route->_route($route, isset($old_route)?$old_route:NULL);
	 }
	 
	public function editbstdetail($id){
        $this->my_auth->allow($this->auth, 'backend/galary/editbstdetail');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$bstdetail = $this->db->where(array('id' => $id))->from('galary_bstdetail')->get()->row_array();
		if($bstdetail['lang'] != $this->session->userdata('_lang')) $this->my_string->js_redirect('Ngôn ngữ không phù hợp', !empty($continue)?base64_decode($continue):BASE_URL.'backend/galary/bstdetail');
		if(!isset($bstdetail) && count($bstdetail) == 0) $this->my_string->php_redirect(BASE_URL.'backend/galary/bstdetail');
		$_post = $bstdetail;
		//echo $bstdetail['userid_created']; die;
	    //print_r($this->auth); die;
		
		if($this->auth['group_allow'] == 1 && count($this->auth['group_content'])  && in_array('backend/galary/editbstdetail/self', $this->auth['group_content']) == TRUE && $this->auth['id'] != $bstdetail['userid_created']) $this->my_string->js_redirect('Không được sửa bài của người khác', !empty($continue)?base64_decode($continue):BASE_URL.'backend/galary/bstdetail');
		
		
		$data['seo']['title'] = 'Sửa bài viết';
		$data['data']['auth'] = $this->auth;
		if($this->input->post('edit')){
            
            $_post = $this->input->post('data');
            $data['data']['_post'] = $_post;
			$this->form_validation->set_error_delimiters('<li>','</li>');
            
            $this->form_validation->set_rules('data[title]','Tiêu đề','trim|required');
            $this->form_validation->set_rules('data[parentid]','Danh mục','trim|required|is_natural_no_zero');
			if(isset($_post['route']) && !empty($_post['route'])){
				 $this->form_validation->set_rules('data[route]','URL tùy biến','trim|required|callback_check_route['.$bstdetail['route'].']');
				$_post['route'] = $this->my_string->alias($_post['route']);
			}
			$str = '';
			if(isset($_post['image']) && !empty($_post['image']))
			{
				$temp = $_post['image'];
				foreach($temp as $key => $val){
					if(isset($val) && !empty($val)){
						$str = $str.','.$val;
					}
				}
			}
			$_post['image'] = $str;
           if($this->form_validation->run() == TRUE){
			  
                $_post = $this->my_string->allow_post($_post,array('title','relative','parentid','tags','route','image_content','image','description','content','publish','highlight','timer','source','meta_title','meta_keyword','meta_description'));
                $_post['timer'] = gmdate('Y-m-d H:i:s',strtotime(str_replace('/','-',$_post['timer'])) + 7*3600); 
                $_post['updated'] = gmdate('Y-m-d H:i:s',time() + 7*3600);  
                $_post['userid_updated'] = $this->auth['id'];  
				$_post['tags'] = !empty($_post['tags'])?','.str_replace(', ', ',', $_post['tags']).',':'';
				$_post['alias'] = $this->my_string->alias($_post['title']); 
				$this->db->where(array('id' =>$id))->update('galary_bstdetail',$_post);
                $this->my_tags->insert_list($_post['tags']);
				$this->my_route->update('galary/bstdetail/'.$id, $_post['route']);
				 
				$this->my_string->js_redirect('Sửa bài viết thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/galary/bstdetail');
            }
            
        }
		else{
			$bstdetail['timer'] = ($bstdetail['timer'] != '0000-00-00 00:00:00')?gmdate('H:i:s m/d/Y',strtotime(str_replace('-','/',$bstdetail['timer'])) + 7*3600):'';
			$bstdetail['tags'] = !empty($bstdetail['tags'])?str_replace(',',', ',substr(substr($bstdetail['tags'],1),0,-1)):'';
			$data['data']['_post'] = $bstdetail;
		}
	 
	   $data['data']['_show']['parentid'] = $this->my_nestedset_galary->dropdown('galary_bst', NULL, 'bstdetail');
	   $data['template'] = 'backend/galary/editbstdetail';
	   $this->load->view('backend/layout/home',$data);
        
    }
	
	public function delbstdetail($id){
        $this->my_auth->allow($this->auth, 'backend/galary/delbstdetail');
		if($this->auth['group_id'] == 1) $this->my_string->php_redirect(BASE_URL);
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$bstdetail = $this->db->where(array('id' => $id))->from('galary_bstdetail')->get()->row_array();
		if(!isset($bstdetail) && count($bstdetail) == 0) $this->my_string->php_redirect(BASE_URL.'backend/galary/bstdetail');
		
		$this->db->delete('galary_bstdetail',array('id' =>$id));
	    $this->my_string->js_redirect('Xóa bài viết thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/galary/bstdetail');
    }
	
	
	public function setbstdetail($field, $id){
        $this->my_auth->allow($this->auth, 'backend/galary/set');
		$id = (int)$id;
		$continue = $this->input->get('continue');
		$bstdetail = $this->db->where(array('id' => $id))->from('galary_bstdetail')->get()->row_array();
		if(!isset($bstdetail) && count($bstdetail) == 0) $this->my_string->php_redirect(BASE_URL.'backend/galary/bstdetail');
		
		if(!isset($bstdetail[$field])) $this->my_string->php_redirect(BASE_URL.'backend/galary/bstdetail');
		
		$this->db->where(array('id' =>$id))->update('galary_bstdetail',array($field =>(($bstdetail[$field] ==1)?0:1)));
        $this->my_string->js_redirect('Đồi trạng cáo thành công!',!empty($continue)?base64_decode($continue):BASE_URL.'backend/galary/bstdetail');
	}
	
	public function suggest($char = ''){
		$this->my_galary->suggest($char);
	}
	public function insert(){
		$item = $this->input->post('item');
		$list = $this->input->post('list');
		$this->my_galary->insert($item, $list);
	}
	
}

