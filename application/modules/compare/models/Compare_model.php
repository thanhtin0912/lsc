<?php
class Compare_model extends CI_Model {
	private $module = 'compare';

	
	function getAllProducts(){
		$this->db->select('id, name');
		$this->db->where('status',1);
		$this->db->where('delete',0);
		$this->db->order_by('order','DESC');
		$query = $this->db->get('products');
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}


	function getInventory($storeId, $productId) {
		$this->db->select('id, value');
		$this->db->where('storeId', $storeId);
		$this->db->where('productId', $productId);
		$query = $this->db->get('inventory');
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function getQuote($storeId, $productId) {
		$this->db->select('id, value');
		$this->db->where('storeId', $storeId);
		$this->db->where('productId', $productId);
		$query = $this->db->get('quote');
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	
	function checkData($title,$id=0){
		$this->db->select('id');
		$this->db->where('title',$title);
		if($id!=0){
			$this->db->where_not_in('id',array($id));
		}
		$this->db->limit(1);
		$query = $this->db->get(PREFIX.$this->table);

		if($query->result()){
			return true;
		}else{
			return false;
		}
	}
	


	/*--------------------END FRONTEND--------------------*/
}