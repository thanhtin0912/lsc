<?php
class Quote_detail_model extends CI_Model {
	private $module = 'quote_detail';
	private $table = 'quote_detail';
	private $table_pro = 'products';
	private $table_cate = 'categories';

	function getsearchContent($limit,$page){
		$this->db->select('q.*, p.name as pro_name, c.name as store_name');
		$this->db->limit($limit,$page);
		$this->db->order_by('q.delete','ASC');
		$this->db->order_by($this->input->post('func_order_by'),$this->input->post('order_by'));
		if($this->input->post('username')!=''){
			$this->db->where('(p.name LIKE "%'.$this->input->post('username').'%")');
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')==''){
			$this->db->where('q.created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
		}
		if($this->input->post('dateFrom')=='' && $this->input->post('dateTo')!=''){
			$this->db->where('q.created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')!=''){
			$this->db->where('q.created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
			$this->db->where('q.created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		if($this->input->post('status') != 2){
			$this->db->where('q.status', $this->input->post('status'));
		}
		if($this->input->post('showData') != 2) {
			$this->db->where('q.delete', $this->input->post('showData'));
		}
		$this->db->from(PREFIX.$this->table." q");
		$this->db->join(PREFIX.$this->table_pro." p", 'p.id = q.productId', "left");
		$this->db->join(PREFIX.$this->table_cate." c", 'c.id = q.storeId', "left");
		$query = $this->db->get();
		
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function getTotalsearchContent(){
		$this->db->select('*');
		if($this->input->post('username')!=''){
			$this->db->where('(p.name LIKE "%'.$this->input->post('username').'%")');
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')==''){
			$this->db->where('q.created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
		}
		if($this->input->post('dateFrom')=='' && $this->input->post('dateTo')!=''){
			$this->db->where('q.created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')!=''){
			$this->db->where('q.created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
			$this->db->where('q.created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		if($this->input->post('status') != 2){
			$this->db->where('q.status', $this->input->post('status'));
		}
		if($this->input->post('showData') != 2) {
			$this->db->where('q.delete', $this->input->post('showData'));
		}
		$this->db->from(PREFIX.$this->table." q");
		$this->db->join(PREFIX.$this->table_pro." p", 'p.id = q.productId', "left");
		$this->db->join(PREFIX.$this->table_cate." c", 'c.id = q.storeId', "left");

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
		$query = $this->db->get($this->table);
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

			$data = array(
				'name'=> $this->input->post('nameAdmincp'),
				'value'=> $this->input->post('valueAdmincp'),
				'from'=> date('Y-m-d 00:00:01', strtotime($this->input->post('fromAdmincp'))),
				'to'=> date('Y-m-d 23:59:59', strtotime($this->input->post('toAdmincp'))),
				'storeId'=> $this->input->post('storeAdmincp'),
				'productId'=> $this->input->post('productAdmincp'),
				'status'=> $this->input->post('statusAdmincp'),
				'created'=> date('Y-m-d H:i:s',time()),
			);
			if($this->db->insert($this->table,$data)){
				modules::run('admincp/saveLog',$this->module,$this->db->insert_id(),'Add new','Add new');
				return true;
			}
		}else{
			$result = $this->getDetailManagement($this->input->post('hiddenIdAdmincp'));
			//Kiểm tra đã tồn tại chưa?
			if($result[0]->name!=$this->input->post('nameAdmincp')){
				$checkData = $this->checkData($this->input->post('nameAdmincp'));
				if($checkData){
					print 'error-name-exists';
					exit;
				}
			}
			$data = array(
				'name'=> $this->input->post('nameAdmincp'),
				'value'=> $this->input->post('valueAdmincp'),
				'from'=> date('Y-m-d 00:00:01', strtotime($this->input->post('fromAdmincp'))),
				'to'=> date('Y-m-d 23:59:59', strtotime($this->input->post('toAdmincp'))),
				'storeId'=> $this->input->post('storeAdmincp'),
				'productId'=> $this->input->post('productAdmincp'),
				'status'=> $this->input->post('statusAdmincp')
			);
			modules::run('admincp/saveLog',$this->module,$this->input->post('hiddenIdAdmincp'),'','Update',$result,$data);
			$this->db->where('id',$this->input->post('hiddenIdAdmincp'));
			if($this->db->update($this->table,$data)){
				return true;
			}
		}
		return false;
	}
	
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

	function checkData($name,$id=0){
		$this->db->select('id');
		$this->db->where('name',$name);
		
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
	
	
}