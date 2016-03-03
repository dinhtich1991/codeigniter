<?php
class Product_model extends CI_Model {

	public function __construct()
	{
			parent::__construct();
	}

	public function get_item($id){
		$item = $this->db->select('id, price, total, title, attribute_id, image')->from('article_item')->where(array('id' => $id))->get()->row_array();
		return $item;
	}
}
    