<?php
class History_model extends CI_Model {
	private $module = 'history';
	private $table = 'inventory_history';
	private $table_cate = 'stores';
	private $table_pro = 'products';
	private $table_cus = 'users';


	function getsearchContent($limit,$page){
		$this->db->select('i.*, c.name as store_name, p.name as product_name');
		$this->db->limit($limit,$page);
		$this->db->order_by('i.delete','ASC');
		$this->db->order_by($this->input->post('func_order_by'),$this->input->post('order_by'));
		if($this->input->post('title')!=''){
			$this->db->like('p.name', $this->input->post('title'));
		}
		if($this->input->post('url')!=''){
			$this->db->like('c.name', $this->input->post('url'));
		}
		if($this->input->post('name')!=''){
			$this->db->like('i.created', $this->input->post('name'));
		}

		if($this->input->post('status')!= 2){
			$this->db->where('i.status', $this->input->post('status'));
		}
		if($this->input->post('showData') != 2) {
			$this->db->where('i.delete', $this->input->post('showData'));
		}
		
		$this->db->from(PREFIX.$this->table." i");
		$this->db->join(PREFIX.$this->table_cate." c", 'c.id = i.storeId', "left");
		$this->db->join(PREFIX.$this->table_pro." p", 'p.id = i.ProductId', "left");
		$query = $this->db->get();

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function getTotalsearchContent(){
		$this->db->select('i.*, c.name as store_name, p.name as product_name');
		if($this->input->post('title')!=''){
			$this->db->like('p.name', $this->input->post('title'));
		}
		if($this->input->post('url')!=''){
			$this->db->like('c.name', $this->input->post('url'));
		}
		if($this->input->post('name')!=''){
			$this->db->like('i.created', $this->input->post('name'));
		}
		if($this->input->post('status')!= 2){
			$this->db->where('i.status', $this->input->post('status'));
		}
		if($this->input->post('showData') != 2) {
			$this->db->where('i.delete', $this->input->post('showData'));
		}
		
		$this->db->from(PREFIX.$this->table." i");
		$this->db->join(PREFIX.$this->table_cate." c", 'c.id = i.storeId', "left");
		$this->db->join(PREFIX.$this->table_pro." p", 'p.id = i.ProductId', "left");
		$query = $this->db->count_all_results();

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

	function getDataToSelect(){
		$this->db->select('*');
		$this->db->where('status',1);
		$query = $this->db->get(PREFIX.$this->table);
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
		
		$this->db->where('delete',0);
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