<?php
class Connections_model extends CI_Model {
	private $module = 'connections';
	private $table = 'connections';

	function getsearchContent($limit,$page){
		$this->db->select('*');
		$this->db->limit($limit,$page);
		$this->db->order_by('delete','ASC');
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
	
	function saveManagement($fileName=''){
		if($this->input->post('hiddenIdAdmincp')==0){
			$data = array(
				'name'=> trim($this->input->post('nameAdmincp', true)),
				'ip'=> trim($this->input->post('ipAdmincp', true)),
				'status'=> $this->input->post('statusAdmincp'),
				'created'=> date('Y-m-d H:i:s',time()),
			);
			if($this->db->insert(PREFIX.$this->table,$data)){
				modules::run('admincp/saveLog',$this->module,$this->db->insert_id(),'Add new','Add new');
				return true;
			}
		}else{
			$result = $this->getDetailManagement($this->input->post('hiddenIdAdmincp'));
			$data = array(
				'name'=> trim($this->input->post('nameAdmincp', true)),
				'ip'=> trim($this->input->post('ipAdmincp', true)),
				'status'=> $this->input->post('statusAdmincp'),
			);
			modules::run('admincp/saveLog',$this->module,$this->input->post('hiddenIdAdmincp'),'','Update',$result,$data);
			$this->db->where('id',$this->input->post('hiddenIdAdmincp'));
			if($this->db->update(PREFIX.$this->table,$data)){
				return true;
			}
		}
		return false;
	}
	
	/*----------------------FRONTEND----------------------*/
	function getData(){
		$this->db->select('*');
		$this->db->where('status',1);
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