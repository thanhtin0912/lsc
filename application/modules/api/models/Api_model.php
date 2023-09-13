<?php
class Api_model extends CI_Model {
	private $module 		= 'quote_custom';
	private $table_cate			= 'categories';
	private $table_inven		= 'inventory';
	private $table_inven_his				= 'inventory_history';
	private $table_pro		= 'products';
	private $table_quote		= 'quote';
	private $table_quote_custom		= 'quote_custom';
	private $table_store		= 'stores';

	function getProducts($store, $name =''){
		$this->db->select('p.*, i.value as inventory, i.note as note');
		$this->db->where('p.status', 1);
		$this->db->where('p.delete', 0);
		$this->db->where('i.storeId', $store);
		$this->db->where('p.`name` LIKE "%'.$name.'%"');
		$this->db->where('FIND_IN_SET('.$store.', p.useStore)');
		$this->db->order_by('p.order','DESC');
		$this->db->from(PREFIX.$this->table_pro." p");
		$this->db->join(PREFIX.$this->table_inven." i", 'i.productId = p.id', "left");
		$query = $this->db->get();

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}



	function totalprice($objectid){
		$this->db->select_sum('price');
		$this->db->where('objectid',$objectid);
		$query = $this->db->get(PREFIX.$this->table);
		return $query->result();
	}

	function updatetotalprice($total,$objectid,$nexttime){
		$this->db->set('totalprice',$total);
		$this->db->set('nexttime',$nexttime);
		$this->db->where('id',$objectid);
		$this->db->update(PREFIX.$this->table_obj);
		return true;
		
	}

	function getExportQuotetoDate($proId, $storeId, $fromDate, $toDate){
		$this->db->select('*');
		$this->db->where('productId', $proId);
		$this->db->where('storeId', $storeId);
		$this->db->where('checkDate >=', date('Y-m-d 00:00:00', strtotime($fromDate)));
		$this->db->where('checkDate <=', date('Y-m-d 23:59:59', strtotime($toDate)));
		$query = $this->db->get('inventory_quote');
		
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function saveManagement($perm=''){
		$status = false;
		if($this->input->post('hiddenIdAdmincp')==0){

			//Kiểm tra đã tồn tại chưa?
			$data = array(
				'isCustom'=> trim($this->input->post('isCustomAdmincp', true)),
				'from'=> date('Y-m-d 00:00:00', strtotime($this->input->post('from', true))),
				'to'=> date('Y-m-d 23:59:59', strtotime($this->input->post('to', true))),
				'rate'=> trim($this->input->post('rateAdmincp', true)),
				'storeId'=> $this->input->post('storeAdmincp', true),
				'days'=> trim($this->input->post('daysAdmincp', true)),
				'created'=> date('Y-m-d H:i:s',time()),
			);
			if($this->db->insert(PREFIX.$this->table_quote_custom,$data)){
				modules::run('admincp/saveLog',$this->module,$this->db->insert_id(),'Add new','Add new');
				$status = true;
			}
		} else {

			$data = array(
				'isCustom'=> trim($this->input->post('isCustomAdmincp', true)),
				'from'=> date('Y-m-d 00:00:00', strtotime($this->input->post('from', true))),
				'to'=> date('Y-m-d 23:59:59', strtotime($this->input->post('to', true))),
				'rate'=> trim($this->input->post('rateAdmincp', true)),
				'days'=> trim($this->input->post('daysAdmincp', true)),
				'created'=> date('Y-m-d H:i:s',time()),
			);

			modules::run('admincp/saveLog',$this->module,$this->input->post('hiddenIdAdmincp'),'','Update',$data);
			$this->db->where('storeId', $this->input->post('storeAdmincp', true));
			$this->db->update(PREFIX.$this->table_quote_custom,$data);
			$status = true;

		}
		if ($status) {
			$quoteProducts = $this->input->post('valueAdmincp[]', true);
			if (count($quoteProducts) > 0) {
				foreach ($quoteProducts as $key => $value) {
					$data = array(
						'value'=> $value,
						'updated'=> date('Y-m-d H:i:s',time()),
					);
					$this->db->where('storeId', $this->input->post('storeAdmincp', true));
					$this->db->where('productId', $key);
					$this->db->update($this->table_quote,$data);
				}
				return true;
			}
			return true;
		}
		return false;
	}

	function getDataStore() {
		$this->db->select('s.*, c.from as fromDate , c.to as toDate, c.isCustom, c.days, c.rate, c.storeId');
		$this->db->where('s.isTest', 0);
		$this->db->where('s.isMain', 0);
		$this->db->where('s.status', 1);
		$this->db->where('s.delete', 0);
		$this->db->order_by('order','DESC');
		$this->db->from(PREFIX.$this->table_store." s");
		$this->db->join(PREFIX.$this->table_quote_custom." c", 'c.storeId = s.id', "left");
		$query = $this->db->get();

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function getDataStoreMain() {
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->where('delete',0);
		$this->db->where('isMain',1);
		$this->db->from(PREFIX.$this->table_store);
		$query = $this->db->get();

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function getTotalValue($proId, $mainStore) {
		$this->db->select_sum('value');
		$this->db->where('storeId !=', $mainStore);
		$this->db->where('productId', $proId);
		$this->db->from(PREFIX.$this->table_quote);
		$query = $this->db->get();

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function totalImportCH($proId, $storeId, $date){
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

	function totalExportKho($proId, $mainKho, $date, $storeId){
		$this->db->select_sum('adjQty');
		$this->db->where('newQty < prevQty');
		$this->db->where('is_remove', 0);
		$this->db->where('productId', $proId);
		$this->db->where('storeId', $mainKho);
		$this->db->where('mainStore', $storeId);
		$this->db->where('created >=', date('Y-m-d 20:00:01', strtotime($date . "-1 days")));
		$this->db->where('created <=', date('Y-m-d 19:59:59', strtotime($date)));
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
		$this->db->select_sum('adjQty');
		$this->db->where('newQty < prevQty');
		$this->db->where('is_remove', 0);
		$this->db->where('productId', $proId);
		$this->db->where('storeId', $storeId);
		$this->db->where('created >=', date('Y-m-d 00:00:00', strtotime($date . "-1 days")));
		$this->db->where('created <=', date('Y-m-d 23:59:59', strtotime($date . "-1 days")));
		$this->db->where('status',1);
		$this->db->where('delete',0);
		$query = $this->db->get('inventory_history');
		
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function totalCheckDate($proId, $storeId, $date){
		$this->db->select_sum('value');
		$this->db->where('productId', $proId);
		$this->db->where('storeId', $storeId);
		$this->db->where('checkDate >=', date('Y-m-d 00:00:00', strtotime($date . "-1 days")));
		$this->db->where('checkDate <=', date('Y-m-d 23:59:59', strtotime($date . "-1 days")));
		// $this->db->where('status',1);
		// $this->db->where('delete',0);
		$query = $this->db->get('inventory_quote');
		
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function getDetailVerifyId($id){
		$date= date('Y-m-d H:i:s',time());
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->where('created >=', date('Y-m-d 00:00:01', strtotime($date)));
		$this->db->where('created <=', date('Y-m-d 23:59:59', strtotime($date)));
		$this->db->where('status',0);
		$this->db->where('delete',0);
		$query = $this->db->get('move_products');
		
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
			if($this->db->update($this->table_inven,$data)){
				$logInventory  = array (
					'productId' => $id,
					'storeId'  	=> $store,
					'customerId'=> $userId,
					'prevQty' => $getinventory[0]->value,
					'adjQty' => $qty,
					'newQty' => $getinventory[0]->value + $qty,
					'created'=> date('Y-m-d H:i:s',time()),
				);
				if($this->db->insert($this->table_inven_his, $logInventory)){
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
			if($this->db->update($this->table_inven,$data)){
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
				if($this->db->insert($this->table_inven_his, $logInventory)){
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
			if($this->db->update($this->table_inven,$data)){
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
				if($this->db->insert($this->table_inven_his, $logInventory)){
					return true;
				} 
				return true;
			}
		}
	}

	/*--------------------END FRONTEND--------------------*/
}