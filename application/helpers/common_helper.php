<?php

if ( ! function_exists('common_valuepost'))
{
	function common_valuepost($value)
	{
	   return !empty($value)?htmlspecialchars($value):'';
	}
}

if ( ! function_exists('common_showerror'))
{
	function common_showerror($error)
	{
	   return (isset($error) && !empty($error))?'<ul class="error">'.$error.'</ul>':'';
	}
}
if ( ! function_exists('common_fullurl'))
{
	function common_fullurl()
	{
		return ('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']).((!empty($_SERVER['QUERY_STRING']))?('?'.$_SERVER['QUERY_STRING']):'');
	}
}
if ( ! function_exists('get_user'))
{
	function get_user($id, $select){
	   $CI =& get_instance();
	   $user = $CI->db->select($select)->where(array('id' =>$id))->from('user')->get()->row_array();
	   if(isset($user) && count($user)){
		   return $user;
	   }
	   else{
		   return NULL;
	   }
	}
}

if ( ! function_exists('get_category'))
{
	function get_category($table, $select, $param){
	   $CI =& get_instance();
	   $category = $CI->db->select($select)->where($param)->from($table)->get()->row_array();
	   if(isset($category) && count($category)){
		   return $category;
	   }
	   else{
		   return NULL;
	   }
	}
}

if ( ! function_exists('get_attribute'))
{
	function get_attribute($table, $select, $param){
	   $CI =& get_instance();
	   $attribute = $CI->db->select($select)->where($param)->from($table)->get()->row_array();
	   if(isset($attribute) && count($attribute)){
		   return $attribute;
	   }
	   else{
		   return NULL;
	   }
	}
}

if ( ! function_exists('get_attribute_item'))
{
	function get_attribute_item($param){
	   $CI =& get_instance();
	   $attribute = $CI->db->select('id, name')->where(array('attribute_id' => $param))->from('attribute_item')->get()->result_array();
	   if(isset($attribute) && count($attribute)){
		   foreach($attribute as $key => $val){
			   $temp[$val['id']] = $val['name'];
		   }
		   return $temp;
	   }
	   else{
		   return NULL;
	   }
	}
}



if ( ! function_exists('get_count_post'))
{
	function get_count_post($table, $param){
	   $CI =& get_instance();
	   $count = $CI->db->where($param)->from($table)->count_all_results();
	   return $count;
	}
}

if ( ! function_exists('get_count_user_group'))
{
	function get_count_user_group($param){
	   $CI =& get_instance();
	   $count = $CI->db->where($param)->from('user')->count_all_results();
	   return $count;
	}
}

if ( ! function_exists('get_count_item'))
{
	function get_count_item($table,$param){
	   $CI =& get_instance();
	   $count = $CI->db->where($param)->from($table)->count_all_results();
	   return $count;
	}
}

if ( ! function_exists('get_count_bstdetail'))
{
	function get_count_bstdetail($table,$param){
	   $CI =& get_instance();
	   $count = $CI->db->where($param)->from($table)->count_all_results();
	   return $count;
	}
}

if ( ! function_exists('get_link_sort'))
{
	
	
	function get_link_sort($param){
		$str='';
		$co = 0;
		if(isset($param) && count($param)){
			if($param['field'] == $param['sort_field']){
				$param['sort_value'] = ($param['sort_value'] == 'asc')?'desc':'asc';
				$co = 1;
			}
			else{
				$param['sort_field'] = $param['field'];
				$param['sort_value'] = 'asc';
			}
			
			foreach($param as $key => $val){
				if($key == 'base_url'){
					$str = $val;
				}
				else if($key =='page'){
					$str = $str.(($val >1)?('/'.$val):'').'?';
				}
				else if(in_array($key,array('field','title'))){
					continue;
				}
				else{
					$str = $str.$key.'='.$val.'&';
				}
			}
		}
		return '<a href="'.substr($str, 0, -1).'">'.$param['title'].(($co ==1)?'<img src="public/template/backend/images/'.$param['sort_value'].'.png" />':'').'</a>';
	}
}
