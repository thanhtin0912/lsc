<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model {
	private $module = 'stores';
	private $tbl_products			= 'products';
	private $tbl_cate				= 'categories';
	private $tbl_customer			= 'users';
	private $tbl_order				= 'orders';
	private $tbl_store				= 'stores';
	private $tbl_inven				= 'inventory';
	private $tbl_inven_his				= 'inventory_history';
	private $tbl_conn				= 'connections';

	function checkLogin($user){
		$this->db->select('c.*');
		$this->db->where('c.phone', $user);
		$this->db->where('c.status', 1);
		$this->db->where('c.delete', 0);
		$this->db->from(PREFIX.$this->tbl_customer." c");
		$this->db->join(PREFIX.$this->tbl_store." s", 's.id = c.storeID', "left");
		$query = $this->db->get();
		
		foreach ($query->result() as $row){
			$pass = $row->password;
		}
		
		if(!empty($pass)){
			return $pass;
		}else{
			return false;
		}
	}

	function checkIP($ip){
		$this->db->select('*');
		$this->db->where('ip', $ip);
		$this->db->where('status', 1);
		$this->db->where('delete', 0);

		$this->db->from(PREFIX.$this->tbl_conn);
		$query = $this->db->get();
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function getInfo($user){
		$this->db->select('c.*, s.name as store_name, s.isMain');
		$this->db->where('c.phone', $user);
		$this->db->where('c.status', 1);
		$this->db->where('c.delete', 0);

		$this->db->from(PREFIX.$this->tbl_customer." c");
		$this->db->join(PREFIX.$this->tbl_store." s", 's.id = c.storeID', "left");
		$query = $this->db->get();

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function getProducts($store, $name =''){
		$this->db->select('p.*, i.value as inventory, i.note as note');
		$this->db->where('p.status', 1);
		$this->db->where('p.delete', 0);
		$this->db->where('i.storeId', $store);
		$this->db->where('p.`name` LIKE "%'.$name.'%"');
		$this->db->where('FIND_IN_SET('.$store.', p.useStore)');
		$this->db->order_by('p.order','DESC');
		$this->db->from(PREFIX.$this->tbl_products." p");
		$this->db->join(PREFIX.$this->tbl_inven." i", 'i.productId = p.id', "left");
		$query = $this->db->get();

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}


	function productsIsRemove($store, $name =''){
		$this->db->select('p.*, i.value as inventory');
		$this->db->where('p.status', 1);
		$this->db->where('p.delete', 0);
		$this->db->where('p.is_remove', 1);
		$this->db->where('i.storeId', $store);
		$this->db->like('p.name', $name);
		$this->db->where('FIND_IN_SET('.$store.', p.useStore)');
		$this->db->order_by('p.order','DESC');
		$this->db->from(PREFIX.$this->tbl_products." p");
		$this->db->join(PREFIX.$this->tbl_inven." i", 'i.productId = p.id', "left");
		$query = $this->db->get();

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function getSelectedViewProducts($store){
		$this->db->select('p.*, i.value as inventory');
		$this->db->where('p.status', 1);
		$this->db->where('p.delete', 0);
		$this->db->where('i.storeId', $store);
		$this->db->where('p.viewAll', 1);
		$this->db->where('FIND_IN_SET('.$store.', p.useStore)');
		$this->db->order_by('p.order','DESC');
		$this->db->from(PREFIX.$this->tbl_products." p");
		$this->db->join(PREFIX.$this->tbl_inven." i", 'i.productId = p.id', "left");
		$query = $this->db->get();

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	

	function updateImportInventory($id, $qty) {
		$getinventory = $this->getinventory($id, $this->session->userdata('userStaff')[0]->storeId);
		if ($getinventory) {
			$data = array(
				'value'=> $getinventory[0]->value + $qty,
				'update'=> date('Y-m-d H:i:s',time()),
			);
			$this->db->where('productId',$id);
			$this->db->where('storeId',$this->session->userdata('userStaff')[0]->storeId);
			if($this->db->update($this->tbl_inven,$data)){
				$logInventory  = array (
					'productId' => $id,
					'storeId'  	=> $this->session->userdata('userStaff')[0]->storeId,
					'customerId'=> $this->session->userdata('userStaff')[0]->id,
					'prevQty' => $getinventory[0]->value,
					'adjQty' => $qty,
					'newQty' => $getinventory[0]->value + $qty,
					'created'=> date('Y-m-d H:i:s',time()),
				);
				if($this->db->insert($this->tbl_inven_his, $logInventory)){
					return true;
				} 
				return true;
			}
		}

	}

	function updateExportInventory($id, $qty, $mainStore='') {
		$getinventory = $this->getinventory($id, $this->session->userdata('userStaff')[0]->storeId);
		if ($getinventory) {
			$data = array(
				'value'=> $getinventory[0]->value - $qty,
				'update'=> date('Y-m-d H:i:s',time()),
			);
			$this->db->where('productId',$id);
			$this->db->where('storeId',$this->session->userdata('userStaff')[0]->storeId);
			if($this->db->update($this->tbl_inven,$data)){
				$logInventory  = array (
					'productId' => $id,
					'storeId'  	=> $this->session->userdata('userStaff')[0]->storeId,
					'customerId'=> $this->session->userdata('userStaff')[0]->id,
					'prevQty' => $getinventory[0]->value,
					'adjQty' => $qty,
					'newQty' => $getinventory[0]->value - $qty,
					'mainStore' => $mainStore,
					'created'=> date('Y-m-d H:i:s',time()),
				);
				if($this->db->insert($this->tbl_inven_his, $logInventory)){
					return true;
				} 
				return true;
			}
		}

	}
	
	function updateRemoveInventory() {
		$getinventory = $this->getinventory($_POST['productId'], $this->session->userdata('userStaff')[0]->storeId);
		if ($getinventory) {
			$data = array(
				'value'=> $getinventory[0]->value - $_POST['qty'],
				'update'=> date('Y-m-d H:i:s',time()),
			);
			$this->db->where('productId',$_POST['productId']);
			$this->db->where('storeId',$this->session->userdata('userStaff')[0]->storeId);
			if($this->db->update($this->tbl_inven,$data)){
				$logInventory  = array (
					'productId' => $_POST['productId'],
					'storeId'  	=> $this->session->userdata('userStaff')[0]->storeId,
					'customerId'=> $this->session->userdata('userStaff')[0]->id,
					'prevQty' => $getinventory[0]->value,
					'adjQty' => $_POST['qty'],
					'newQty' => $getinventory[0]->value - $_POST['qty'],
					'is_remove' => 1,
					'created'=> date('Y-m-d H:i:s',time()),
				);
				if($this->db->insert($this->tbl_inven_his, $logInventory)){
					return true;
				} 
				return true;
			}
		}

	}

	function getinventory($proID, $storeId)
	{
		$this->db->select('*');
		$this->db->where('productId',$proID);
		$this->db->where('storeId', $storeId);
		$this->db->where('status',1);
		$this->db->order_by('created','ASC');
		$query = $this->db->get(PREFIX.$this->tbl_inven);

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function searchHistoryInventory($limit,$page){
		$this->db->select('i.*, p.name as product_name, p.unit');
		$this->db->limit($limit,$page);
		if($_POST["name"]!=''){
			$this->db->like('p.name', $_POST["name"]);
		}
		$this->db->where('i.storeId', $this->session->userdata('userStaff')[0]->storeId);
		$this->db->where('i.customerId', $this->session->userdata('userStaff')[0]->id);
		$this->db->order_by('i.created','DESC');
		$this->db->from(PREFIX.$this->tbl_inven_his." i");
		$this->db->join(PREFIX.$this->tbl_products." p", 'p.id = i.productId', "left");
		$query = $this->db->get();

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function searchHistoryInventoryTotal(){
		$this->db->select('i.*, p.name as product_name, p.unit');
		if($_POST["name"]!=''){
			$this->db->like('p.name', $_POST["name"]);
		}
		$this->db->where('i.storeId', $this->session->userdata('userStaff')[0]->storeId);
		$this->db->where('i.customerId', $this->session->userdata('userStaff')[0]->id);
		$this->db->from(PREFIX.$this->tbl_inven_his." i");
		$this->db->join(PREFIX.$this->tbl_products." p", 'p.id = i.productId', "left");
		$query = $this->db->count_all_results();
		if($query > 0){
			return $query;
		}else{
			return false;
		}
	}

	function getNoteProductofStore($proID) {
		$this->db->select('i.*, p.name');
		$this->db->where('i.productId',$proID);
		$this->db->where('i.storeId', $this->session->userdata('userStaff')[0]->storeId);
		$this->db->where('i.status',1);
		$this->db->from(PREFIX.$this->tbl_inven." i");
		$this->db->join(PREFIX.$this->tbl_products." p", 'i.productId = p.id', "left");
		$query = $this->db->get();

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function updateNoteInventory($id, $note) {
		$getinventory = $this->getinventory($id, $this->session->userdata('userStaff')[0]->storeId);
		if ($getinventory) {
			$data = array(
				'note'=> nl2br($note),
				'update'=> date('Y-m-d H:i:s',time()),
			);
			$this->db->where('productId',$id);
			$this->db->where('storeId',$this->session->userdata('userStaff')[0]->storeId);
			if($this->db->update($this->tbl_inven,$data)){
				return true;
			}
		}
	}


	function getQuote($productId, $storeId) {
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

	function getListOtherStore($storeId) {
		$this->db->select('*');
		$this->db->where('id !=', $storeId);
		$query = $this->db->get('stores');
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function totalImportDate($proId, $storeId, $date){
		$this->db->select('adjQty, created');
		$this->db->where('newQty > prevQty');
		$this->db->where('productId', $proId);
		$this->db->where('storeId', $storeId);
		$this->db->where('created >=', date('Y-m-d 00:00:01', strtotime($date)));
		$this->db->where('created <=', date('Y-m-d 23:59:59', strtotime($date)));
		$query = $this->db->get('inventory_history');
		
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	function totalExportDate($proId, $storeId, $date){
		$this->db->select('adjQty, created');
		$this->db->where('newQty < prevQty');
		$this->db->where('is_remove', 0);
		$this->db->where('productId', $proId);
		$this->db->where('storeId', $storeId);
		$this->db->where('created >=', date('Y-m-d 00:00:01', strtotime($date)));
		$this->db->where('created <=', date('Y-m-d 23:59:59', strtotime($date)));
		$query = $this->db->get('inventory_history');
		
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function totalImportToday($proId, $storeId, $date){
		$this->db->select_sum('adjQty');
		$this->db->where('newQty > prevQty');
		$this->db->where('productId', $proId);
		$this->db->where('storeId', $storeId);
		$this->db->where('created >=', date('Y-m-d 00:00:01', strtotime($date)));
		$this->db->where('created <=', date('Y-m-d 23:59:59', strtotime($date)));
		$query = $this->db->get('inventory_history');
		
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	function totalExportToday($proId, $storeId, $date){
		$this->db->select_sum('adjQty');
		$this->db->where('newQty < prevQty');
		$this->db->where('is_remove', 0);
		$this->db->where('productId', $proId);
		$this->db->where('storeId', $storeId);
		$this->db->where('created >=', date('Y-m-d 00:00:01', strtotime($date)));
		$this->db->where('created <=', date('Y-m-d 23:59:59', strtotime($date)));
		$query = $this->db->get('inventory_history');
		
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
}
?>