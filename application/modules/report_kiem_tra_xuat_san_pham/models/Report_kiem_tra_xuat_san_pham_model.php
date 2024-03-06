<?php
class Report_kiem_tra_xuat_san_pham_model extends CI_Model {
	private $module = 'report_kiem_tra_xuat_san_pham';
	private $table = 'users';
	private $table_product = 'products';
	private $table_inventory_quote = 'inventory_quote';
	private $table_stores = 'stores';

	function getsearchContent($limit,$page){
		$this->db->select('i.*, p.name as productName, s.name as storeName');
		$this->db->limit($limit,$page);
		$this->db->order_by('i.checkDate','DESC');
		if($this->input->post('name')!=''){
			$this->db->like('p.name', $this->input->post('name'));
		}
		if($this->input->post('cate_name')!=''){
			$this->db->where('i.storeId', $this->input->post('cate_name'));
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')==''){
			$this->db->where('i.checkDate >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
		}
		if($this->input->post('dateFrom')=='' && $this->input->post('dateTo')!=''){
			$this->db->where('i.checkDate <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')!=''){
			$this->db->where('i.checkDate >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
			$this->db->where('i.checkDate <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		$this->db->where('i.status',1);
		$this->db->where('i.delete',0);
		$this->db->from(PREFIX.$this->table_inventory_quote." i");
		$this->db->join(PREFIX.$this->table_product." p", 'i.productId = p.id', "left");
		$this->db->join(PREFIX.$this->table_stores." s", 'i.storeId = s.id', "left");
		$query = $this->db->get();
		
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function getTotalsearchContent(){
		$this->db->select('*');
		if($this->input->post('name')!=''){
			$this->db->where('(p.`name` LIKE "%'.$this->input->post('name').'%")');
		}
		if($this->input->post('cate_name')!=''){
			$this->db->where('i.storeId', $this->input->post('cate_name'));
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')==''){
			$this->db->where('i.checkDate >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
		}
		if($this->input->post('dateFrom')=='' && $this->input->post('dateTo')!=''){
			$this->db->where('i.checkDate <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')!=''){
			$this->db->where('i.checkDate >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
			$this->db->where('i.checkDate <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		$this->db->where('i.status',1);
		$this->db->where('i.delete',0);
		$this->db->from(PREFIX.$this->table_inventory_quote." i");
		$this->db->join(PREFIX.$this->table_product." p", 'p.id = i.productId', "left");
		$this->db->join(PREFIX.$this->table_stores." s", 'i.storeId = s.id', "left");
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
			$checkData = $this->checkData($this->input->post('phoneAdmincp'));
			if($checkData){
				print 'error-phone-exists';
				exit;
			}
			
			$data = array(
				'phone'=> $this->input->post('phoneAdmincp'),
				'password'=> md5($this->input->post('passAdmincp')),
				'name'=> $this->input->post('nameAdmincp'),
				'address'=> $this->input->post('addressAdmincp'),
				'email'=> $this->input->post('emailAdmincp'),
				'storeId'=> $this->input->post('storeAdmincp'),
				'isCheck'=> $this->input->post('isCheckAdmincp'),
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
			if($result[0]->phone!=$this->input->post('phoneAdmincp')){
				$checkData = $this->checkData($this->input->post('phoneAdmincp'));
				if($checkData){
					print 'error-phone-exists';
					exit;
				}
			}
			
			if($this->input->post('passAdmincp')==''){
				$pass = $result[0]->password;
			}else{
				$pass = md5($this->input->post('passAdmincp'));
			}
            // check đăng xuất 			
			if($this->input->post('logoutAdmincp')){
				$session  = '';
			}else{
				$session = $result[0]->session;
			}

			$data = array(
				'phone'=> $this->input->post('phoneAdmincp'),
				'password'=> $pass,
				'name'=> $this->input->post('nameAdmincp'),
				'address'=> $this->input->post('addressAdmincp'),
				'email'=> $this->input->post('emailAdmincp'),
				'storeId'=> $this->input->post('storeAdmincp'),
				'session'=> $session,
				'isCheck'=> $this->input->post('isCheckAdmincp'),
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

	function checkData($phone,$id=0){
		$this->db->select('id');
		$this->db->where('phone',$phone);
		
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