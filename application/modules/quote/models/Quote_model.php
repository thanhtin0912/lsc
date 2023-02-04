<?php
class Quote_model extends CI_Model {
	private $module = 'quote';
	private $table = 'stores';
	private $table_quo = 'quote';
	private $table_pro = 'products';

	function getsearchContent($limit,$page){
		$this->db->select('*');
		$this->db->limit($limit,$page);
		$this->db->order_by('delete','ASC');
		$this->db->order_by($this->input->post('func_order_by'),$this->input->post('order_by'));
		if($this->input->post('title')!=''){
			$this->db->like('name', $this->input->post('title'));
		}

		if($this->input->post('status')!= 2){
			$this->db->where('status', $this->input->post('status'));
		}
		if($this->input->post('showData') != 2) {
			$this->db->where('delete', $this->input->post('showData'));
		}
		
		$this->db->from(PREFIX.$this->table);
		$query = $this->db->get();

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function getTotalsearchContent(){
		$this->db->select('*');
		if($this->input->post('title')!=''){
			$this->db->like('name', $this->input->post('title'));
		}
		if($this->input->post('status')!= 2){
			$this->db->where('status', $this->input->post('status'));
		}
		if($this->input->post('showData') != 2) {
			$this->db->where('delete', $this->input->post('showData'));
		}
		
		$this->db->from(PREFIX.$this->table);
		$query = $this->db->count_all_results();

		if($query > 0){
			return $query;
		}else{
			return false;
		}
	}
	
	function getAllProducts($id){
		$this->db->select('q.*, p.name');
		$this->db->where('q.storeId',$id);
		$this->db->where('FIND_IN_SET('.$id.', p.useStore)');
		$this->db->order_by('p.order','DESC');
		$this->db->from(PREFIX.$this->table_quo." q");
		$this->db->join(PREFIX.$this->table_pro." p", 'p.id = q.productId', "left");
		$query = $this->db->get();
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function saveManagement($perm=''){
		if($this->input->post('hiddenIdAdmincp')==0){
			//Kiểm tra đã tồn tại chưa?
			$checkData = $this->checkData($this->input->post('nameAdmincp'));
			if($checkData){
				print 'error-name-exists';
				exit;
			}
		}else{
			$quoteProducts = $this->input->post('valueAdmincp[]', true);
			if (count($quoteProducts) > 0) {
				foreach ($quoteProducts as $key => $value) {
					$valueMin = $this->input->post('valueMinAdmincp['.$key.']',true);
					$min = 0;
					if($valueMin && $valueMin !='') {
						$min = $valueMin;
					}
					$data = array(
						'value'=> $value,
						'valueMin'=> $min,
						'updated'=> date('Y-m-d H:i:s',time()),
					);
					$this->db->where('id', $key);
					$this->db->update($this->table_quo,$data);
				}
				return true;
			}
		}
		return false;
	}
	
	function getData(){
		$this->db->select('q.*');
		$this->db->where('q.status',1);
		$this->db->where('s.code', 'STORE');
		$this->db->order_by('q.created','ASC');
		$this->db->from(PREFIX.$this->table." q");
		$this->db->join(PREFIX.$this->table_com." s", 's.id = q.commonId', "left");
		$query = $this->db->get();

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function getDataToSelect(){
		$this->db->select('q.*');
		$this->db->where('q.status',1);
		$this->db->where('s.code', 'STORE');
		$this->db->from(PREFIX.$this->table." q");
		$this->db->join(PREFIX.$this->table_com." s", 's.id = q.commonId', "left");
		$query = $this->db->get();
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function getDataAll(){
		$this->db->select('1');
		$this->db->where('s.code', 'STORE');
		$this->db->from(PREFIX.$this->table." q");
		$this->db->join(PREFIX.$this->table_com." s", 's.id = q.commonId', "left");
		$query = $this->db->count_all_results();
		if($query>0){
			return $query;
		}
		else{
			return 0;
		}
	}
	function getDataPublish(){
		$this->db->select('1');
		$this->db->where('q.delete',0);
		$this->db->where('s.code', 'STORE');
		$this->db->from(PREFIX.$this->table." q");
		$this->db->join(PREFIX.$this->table_com." s", 's.id = q.commonId', "left");
		$query = $this->db->count_all_results();

		if($query>0){
			return $query;
		}
		else{
			return 0;
		}
	}
	
}