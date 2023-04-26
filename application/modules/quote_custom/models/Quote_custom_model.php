<?php
class Quote_custom_model extends CI_Model {
	private $module 		= 'quote_custom';
	private $table_cate			= 'categories';
	private $table_inven		= 'inventory';
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
		$this->db->where('s.status',1);
		$this->db->where('s.delete',0);
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
	
	/*----------------------FRONTEND----------------------*/
	function getData(){
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->order_by('created','DESC');
		$query = $this->db->get(PREFIX.$this->table_quote_custom);

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