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
	private $tbl_inven_quote				= 'inventory_quote';
	private $tbl_move				= 'move_products';
	
	function getCommonData(){
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->where('delete',0);
		$this->db->limit(1);
		$query = $this->db->get('infos');
        //echo $this->db->last_query();
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	
	function checkLogin($user){
		$this->db->select('c.*');
		$this->db->where('c.phone', $user);
		$this->db->where('c.status', 1);
		$this->db->where('c.isCheck', 0);
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
	
	
	function getInfoCode($code){
		$this->db->select('c.*, s.name as store_name, s.isMain');
		$this->db->where('c.code', $code);
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
	
	function getInfoSession($phone, $ses){
		$this->db->select('id');
		$this->db->where('session', $ses);
		$this->db->where('phone', $phone);

		$this->db->from(PREFIX.$this->tbl_customer);
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
	


	function updateImportInventory($id, $qty, $store, $userId) {
		$getinventory = $this->getinventory($id, $store);
		if ($getinventory) {
			$data = array(
				'value'=> $getinventory[0]->value + $qty,
				'update'=> date('Y-m-d H:i:s',time()),
			);
			$this->db->where('productId',$id);
			$this->db->where('storeId',$store);
			if($this->db->update($this->tbl_inven,$data)){
				$logInventory  = array (
					'productId' => $id,
					'storeId'  	=> $store,
					'customerId'=> $userId,
					'prevQty' => $getinventory[0]->value,
					'adjQty' => $qty,
					'newQty' => $getinventory[0]->value + $qty,
					'created'=> date('Y-m-d H:i:s',time()),
				);
				if($this->db->insert($this->tbl_inven_his, $logInventory)){
					return $getinventory[0]->value + $qty;
				} 
			}
		}

	}

	function updateExportInventory($id, $qty, $mainStore='', $store, $userId) {
		$getinventory = $this->getinventory($id, $store);
		if ($getinventory) {
			$data = array(
				'value'=> $getinventory[0]->value - $qty,
				'update'=> date('Y-m-d H:i:s',time()),
			);
			$this->db->where('productId',$id);
			$this->db->where('storeId', $store);
			if($this->db->update($this->tbl_inven,$data)){
				$logInventory  = array (
					'productId' => $id,
					'storeId'  	=> $store,
					'customerId'=> $userId,
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
	
	function updateRemoveInventory($productId, $qty, $store, $userId) {
		$getinventory = $this->getinventory($productId, $store);
		if ($getinventory) {
			$data = array(
				'value'=> $getinventory[0]->value - $qty,
				'update'=> date('Y-m-d H:i:s',time()),
			);
			$this->db->where('productId', $productId);
			$this->db->where('storeId', $store);
			if($this->db->update($this->tbl_inven,$data)){
				$logInventory  = array (
					'productId' => $productId,
					'storeId'  	=> $store,
					'customerId'=> $userId,
					'prevQty' => $getinventory[0]->value,
					'adjQty' => $qty,
					'newQty' => $getinventory[0]->value - $qty,
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
		$this->db->order_by('i.id','DESC');
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
		$this->db->select('id, value, valueMin');
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
		$this->db->where('status',1);
		$this->db->where('delete',0);
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
		$this->db->where('status',1);
		$this->db->where('delete',0);
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
		$this->db->where('status',1);
		$this->db->where('delete',0);
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
		$this->db->where('status',1);
		$this->db->where('delete',0);
		$query = $this->db->get('inventory_history');
		
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function insertInventoryQuote($id, $qty, $store, $date) {
		$logInventory  = array (
			'productId' => $id,
			'value'  	=> $qty,
			'checkDate'=> $date,
			'storeId' => $store,
			'created'=> date('Y-m-d H:i:s',time()),
		);
		if($this->db->insert($this->tbl_inven_quote, $logInventory)){
			return true;
		} 
	}
	
	function saveMoveProduct($data) {
		if($this->db->insert('move_products' , $data)){
			return $this->db->insert_id();
		} 
	}

	function getMoveProduct() {
		$this->db->select('i.*, p.name as product_name, s.name as store_name');
		$this->db->limit(20);
		$this->db->where('i.customerId', $this->session->userdata('userStaff')[0]->id);
		$this->db->order_by('i.created','DESC');
		$this->db->from(PREFIX.$this->tbl_move." i");
		$this->db->join(PREFIX.$this->tbl_store." s", 'i.toStore = s.id', "left");
		$this->db->join(PREFIX.$this->tbl_products." p", 'i.productId = p.id', "left");
		$query = $this->db->get();

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function insertMissingProduct($list, $store, $user) {
		$data  = array (
			'missing' => serialize($list),
			'storeId'  	=> $store,
			'exportBy'=> $user,
			'dateExport' => date('Y-m-d H:i:s',time()),
			'created'=> date('Y-m-d H:i:s',time()),
		);
		if($this->db->insert('history_missing_export', $data)){
			return true;
		} 
	}
	function getMissingProduct($store){
		$date = date("Y-m-d H:i:s", time());
		$this->db->select('*');
		$this->db->where('storeId', $store);
		$this->db->where('dateExport >=', date('Y-m-d 21:00:00', strtotime($date . "-1 days")));
		$this->db->where('dateExport <=', date('Y-m-d 20:59:59', strtotime($date)));
		$this->db->limit(1);
		$query = $this->db->get('history_missing_export');
		
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
}
?>