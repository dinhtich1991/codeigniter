<?php

if ( ! function_exists('frontend_menu'))
{
	function frontend_menu($param =''){
	   $CI =& get_instance();
	   $_lang = $CI->session->userdata('_lang');
	   $menu = $CI->db->where(array('publish' => 1, 'lang' => $_lang))->from('menu')->order_by('order asc, id asc')->get()->result_array();
	   $str = '';
	   if(isset($menu) && count($menu)){
		   $str = '<ul class="main">';
		   foreach($menu as $keyMain => $valMain){
			   if(!empty($valMain['url'])){
				   $str = $str.'<li><a href="'.$valMain['url'].'" title="'.htmlspecialchars($valMain['title']).'">'.$valMain['title'].'</a></li>';
			   }
			   else if(!empty($valMain['module']) && $valMain['module_id'] > 0){
				  // echo $valMain['module_id']; die;
				   if($valMain['module'] == 'article_category'){
					$str = $str.frontend_menu_article_category($param['article_category'], $valMain['module_id']);
				   }
			   }
		   }
		   $str = $str.'</ul>';
	   }
	   return $str;
	}
}

if ( ! function_exists('frontend_submenu'))
{
	function frontend_submenu($param =''){
	   $CI =& get_instance();
	   $_lang = $CI->session->userdata('_lang');
	   $menu = $CI->db->where(array('publish' => 1, 'lang' => $_lang))->from('submenu')->order_by('order asc, id asc')->get()->result_array();
	   $str = '';
	   if(isset($menu) && count($menu)){
		   $str = '<ul>';
		   foreach($menu as $keyMain => $valMain){
			   if(!empty($valMain['url'])){
				   $str = $str.'<li><a href="'.$valMain['url'].'" title="'.htmlspecialchars($valMain['title']).'">'.$valMain['title'].'</a></li>';
			   }
			   else if(!empty($valMain['module']) && $valMain['module_id'] > 0){
				  // echo $valMain['module_id']; die;
				   if($valMain['module'] == 'article_category'){
					$str = $str.frontend_submenu_article_category($param['article_category'], $valMain['module_id']);
				   }
			   }
		   }
		   $str = $str.'</ul>';
	   }
	   return $str;
	}
}

if ( ! function_exists('frontend_submenu_article_category'))
{
	function frontend_submenu_article_category($data, $id = 0){
		if(isset($data) && count($data)){
			// main
			$_tempMain = '';
			foreach($data as $keyMain => $valMain){
				if($valMain['id'] == $id){
					$_tempMain = $_tempMain.'<li><a href="'.frontend_link_menu($valMain['route'], $valMain['alias'], $valMain['id'], '68').'" title="'.htmlspecialchars($valMain['title']).'">'.$valMain['title'].'</a>';
					
					// item
					$_tempItem = '';
					foreach($data as $keyItem => $valItem){
						if($valMain['id'] == $valItem['parentid']){
							$_tempItem = $_tempItem.'<li><a href="'.frontend_link_menu($valItem['route'], $valItem['alias'], $valItem['id'], '68').'" title="'.htmlspecialchars($valItem['title']).'">'.$valItem['title'].'</a>';
							//SUB
							$_tempSub = '';
							foreach($data as $keySub => $valSub){
								if($valItem['id'] == $valSub['parentid']){
									$_tempSub = $_tempSub.'<li><a href="'.frontend_link_menu($valSub['route'], $valSub['alias'], $valSub['id'], '68').'" title="'.htmlspecialchars($valSub['title']).'">'.$valSub['title'].'</a>';
									// Cap 4
									$_tempChildren = '';
									foreach($data as $key => $val){
										if($valSub['id'] == $val['parentid']){
											$_tempChildren = $_tempChildren.'<li><a href="'.frontend_link_menu($val['route'], $val['alias'], $val['id'], '68').'" title="'.htmlspecialchars($val['title']).'">'.$val['title'].'</a>';
										}
										continue;
									}
									$_tempChildren = !empty($_tempChildren)?'<ul>'.$_tempChildren.'</ul>':'';
									$_tempSub = $_tempSub.$_tempChildren.'</li>';
								}
								continue;
							}
							$_tempSub = !empty($_tempSub)?'<ul>'.$_tempSub.'</ul>':'';
							$_tempItem = $_tempItem.$_tempSub.'</li>';
						}
						continue;
					}
					$_tempItem = !empty($_tempItem)?'<ul>'.$_tempItem.'</ul>':'';
					$_tempMain = $_tempMain.$_tempItem.'</li>';
				}
				continue;
			}
			return $_tempMain;
			
			//$_tempItem = '';
			foreach($data as $keyItem => $valItem){
				$_tempItem = $_tempItem.'';
			}
			//return !empty($_tempItem)?'<ul class="item">'.$_tempItem.'</ul>':'';
		}
	}
}

if ( ! function_exists('frontend_menu_article_category'))
{
	function frontend_menu_article_category($data, $id = 0){
		if(isset($data) && count($data)){
			// main
			$_tempMain = '';
			foreach($data as $keyMain => $valMain){
				if($valMain['id'] == $id){
					$_tempMain = $_tempMain.'<li class=main><a href="'.frontend_link_menu($valMain['route'], $valMain['alias'], $valMain['id'], '68').'" title="'.htmlspecialchars($valMain['title']).'" class="main">'.$valMain['title'].'</a>';
					
					// item
					$_tempItem = '';
					foreach($data as $keyItem => $valItem){
						if($valMain['id'] == $valItem['parentid']){
							$_tempItem = $_tempItem.'<li class=item><a href="'.frontend_link_menu($valItem['route'], $valItem['alias'], $valItem['id'], '68').'" title="'.htmlspecialchars($valItem['title']).'" class="item">'.$valItem['title'].'</a>';
							//SUB
							$_tempSub = '';
							foreach($data as $keySub => $valSub){
								if($valItem['id'] == $valSub['parentid']){
									$_tempSub = $_tempSub.'<li class=sub><a href="'.frontend_link_menu($valSub['route'], $valSub['alias'], $valSub['id'], '68').'" title="'.htmlspecialchars($valSub['title']).'" class="sub">'.$valSub['title'].'</a>';
									// Cap 4
									$_tempChildren = '';
									foreach($data as $key => $val){
										if($valSub['id'] == $val['parentid']){
											$_tempChildren = $_tempChildren.'<li class=children><a href="'.frontend_link_menu($val['route'], $val['alias'], $val['id'], '68').'" title="'.htmlspecialchars($val['title']).'" class="children">'.$val['title'].'</a>';
										}
										continue;
									}
									$_tempChildren = !empty($_tempChildren)?'<ul class="children">'.$_tempChildren.'</ul>':'';
									$_tempSub = $_tempSub.$_tempChildren.'</li>';
								}
								continue;
							}
							$_tempSub = !empty($_tempSub)?'<ul class="sub">'.$_tempSub.'</ul>':'';
							$_tempItem = $_tempItem.$_tempSub.'</li>';
						}
						continue;
					}
					$_tempItem = !empty($_tempItem)?'<ul class="item">'.$_tempItem.'</ul>':'';
					$_tempMain = $_tempMain.$_tempItem.'</li>';
				}
				continue;
			}
			return $_tempMain;
			
			//$_tempItem = '';
			foreach($data as $keyItem => $valItem){
				$_tempItem = $_tempItem.'';
			}
			//return !empty($_tempItem)?'<ul class="item">'.$_tempItem.'</ul>':'';
		}
	}
}

if ( ! function_exists('frontend_menu_getdata'))
{
	function frontend_menu_getdata($table = 'article_category'){
	   $CI =& get_instance();
	   $_lang = $CI->session->userdata('_lang');
	   $menu = $CI->db->select('id, title, parentid, alias, route')->where(array('publish' => 1, 'lang' => $_lang))->from($table)->order_by('order asc, id asc')->get()->result_array();
	   return $menu;
	}
}

if ( ! function_exists('frontend_link_menu'))
{
	function frontend_link_menu($route, $alias, $id, $module){
	   if(!empty($route)) return $route.TT_URL_SUFFIX;
	   else return $alias.'-'.$module.$id.TT_URL_SUFFIX;
	}
}
if ( ! function_exists('frontend_breadcrumb'))
{
	function frontend_breadcrumb($table ='', $param = NULL, $type = 'category'){
		$CI =& get_instance();
		$breadcrumb = '';
		$category = $CI->db->select('id, title, route, alias')->where($param)->order_by('lft', 'asc')->from($table)->get()->result_array();
		$breadcrumb = '<ul class="breadcrumb">';
		$breadcrumb = $breadcrumb.'<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a rel="nofollow" href="." title="Trang chủ" itemprop="url"><span itemprop="title">Trang chủ</span></a></li>';
		if(isset($category) && count($category)){
			$total = count($category);
			foreach($category as $key => $val){
				$breadcrumb = $breadcrumb.'<li class="spacebar">></li>';
				if($type == 'category') $h = ($total - $key);
				else if($type == 'item') $h = ($total - $key + 1);
				else if($type == 'bst') $h = ($total - $key);
				else if($type == 'bstdetail') $h = ($total - $key + 1);
				$h = ($h > 6)?'6':$h;
				$breadcrumb = $breadcrumb.'<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><h'.$h.'><a href="'.frontend_link_menu($val['route'], $val['alias'], $val['id'], '68').'" title="'.htmlspecialchars($val['title']).'" itemprop="url"><span itemprop="title">'.htmlspecialchars($val['title']).'</span></a></h'.$h.'></li>';
			}
		}
		$breadcrumb = $breadcrumb.'</ul>';
		return $breadcrumb;
	}
}


