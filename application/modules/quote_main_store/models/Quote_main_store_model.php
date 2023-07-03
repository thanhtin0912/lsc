<?php
class Quote_main_store_model extends CI_Model {
	private $module 		= 'quote_main_store';
	private $table_cate			= 'categories';
	private $table_inven		= 'inventory';
	private $table_pro		= 'products';
	private $table_quote		= 'quote';
	private $table_quote_detail		= 'quote_detail';

	function getAllProductInventory($store) {
		$this->db->select('p.*, i.value as inventory, q.value as quote, q.valueMin as quoteMin, 0 as import, 0 as export');
		$this->db->where('q.storeId', $store);
		$this->db->where('i.storeId', $store);
		$this->db->where('FIND_IN_SET('.$store.', p.useStore)');
		$this->db->where('p.status', 1);
		$this->db->where('p.delete', 0);
		$this->db->order_by('p.order','DESC');
		$this->db->from(PREFIX.$this->table_pro." p");
		$this->db->join(PREFIX.$this->table_inven." i", 'p.id = i.productId', "left");
		$this->db->join(PREFIX.$this->table_quote." q", 'p.id = q.productId', "left");
		$query = $this->db->get();
		
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

	function totalRemoveToday($proId, $storeId, $date){
		$this->db->select_sum('adjQty');
		$this->db->where('newQty < prevQty');
		$this->db->where('is_remove', 1);
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

	

	
	function getTotalsearchContent(){
		if($this->input->post('timerange')!=''){
			$date= date('Y-m-d H:i:s',time());
			$dateplus = date('Y-m-d', strtotime($date. ' + '.$this->input->post('timerange').' days'));
		}else{
			$date='';
			$dateplus ='';
		}
		
		$this->db->select('n.*,m.fullname as customer, s.fullname as staff');
		if($this->input->post('name')!=''){
			$this->db->where('(n.`code` LIKE "%'.$this->input->post('name').'%")');
		}
		if($this->input->post('slug')!=''){
			$this->db->where('(m.`fullname` LIKE "%'.$this->input->post('slug').'%")');
		}
		if($this->input->post('title')!=''){
			$this->db->where('(s.`fullname` LIKE "%'.$this->input->post('title').'%")');
		}
		if($date!='' && $dateplus==''){
			$this->db->where('n.nexttime >= "'.$date.'"');
		}
		if($date=='' && $dateplus!=''){
			$this->db->where('n.nexttime <= "'.$dateplus.'"');
		}
		if($date!='' && $dateplus!=''){
			$this->db->where('n.nexttime >= "'.$date.'"');
			$this->db->where('n.nexttime <= "'.$dateplus.'"');
		}
		if($this->input->post('status')!= 2){
			$this->db->where('n.status', $this->input->post('status'));
		}
		if($this->input->post('showData') != 2) {
			$this->db->where('n.delete', $this->input->post('showData'));
		}
		$this->db->from(PREFIX.$this->table." n");
		$this->db->join(PREFIX.$this->table_obj." m", 'm.id = n.objectid', "left");
		$this->db->join(PREFIX.$this->table_staff." s", 's.id = n.staffid', "left");
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

	
	/*----------------------FRONTEND----------------------*/
	function getData(){
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->order_by('created','DESC');
		$query = $this->db->get(PREFIX.$this->table);

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	function getDataAll(){
		$this->db->select('1');
		$this->db->where('status',1);
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