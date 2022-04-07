<?php
class Mailbox_model extends CI_Model {
	private $module = 'mailbox';
	private $table = 'mil_contact';

	function getsearchContent($limit,$page){
		$this->db->select('*');
		$this->db->limit($limit,$page);
		$this->db->order_by('delete','ASC');
		$this->db->order_by($this->input->post('func_order_by'),$this->input->post('order_by'));
		if($this->input->post('name')!=''){
			$this->db->where('(`name` LIKE "%'.$this->input->post('name').'%")');
		}
		if($this->input->post('status')!= 2){
			$this->db->where('status', $this->input->post('status'));
		}
		$query = $this->db->get(PREFIX.$this->table);

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function getTotalsearchContent(){
		$this->db->select('*');
		if($this->input->post('name')!=''){
			$this->db->where('(`name` LIKE "%'.$this->input->post('name').'%")');
		}
		if($this->input->post('content')!=''){
			$this->db->where('(`discription` LIKE "%'.$this->input->post('content').'%")');
		}
		if($this->input->post('status')!= 2){
			$this->db->where('status', $this->input->post('status'));
		}
		$query = $this->db->count_all_results(PREFIX.$this->table);

		if($query > 0){
			return $query;
		}else{
			return false;
		}
	}
	
	function getDetailManagement($id){
		$this->db->select('*');
		$this->db->where('id',$id);
		$query = $this->db->get(PREFIX.$this->table);

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	


	
	/*----------------------FRONTEND----------------------*/
	function getData(){
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->order_by('created','ASC');
		$query = $this->db->get(PREFIX.$this->table);

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function getDataCommonDiscount(){
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->where('commontype','DISCOUNT');
		$query = $this->db->get(PREFIX.$this->table_commons);

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function getDataAll(){
		$this->db->select('1');
		$query = $this->db->count_all_results(PREFIX.$this->table);

		if($query>0){
			return $query;
		}
		else{
			return 0;
		}
	}
	function getDataPublish(){
		$this->db->select('1');
		$query = $this->db->count_all_results(PREFIX.$this->table);

		if($query>0){
			return $query;
		}
		else{
			return 0;
		}
	}
	/*--------------------END FRONTEND--------------------*/
}