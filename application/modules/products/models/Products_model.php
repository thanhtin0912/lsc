<?php
class Products_model extends CI_Model {
	private $module = 'products';
	private $table = 'products';
	private $table_cate = 'categories';
	private $table_quote = 'quote';
	private $table_inven = 'inventory';

	function getsearchContent($limit,$page){
		$this->db->select('n.*, c.name as cate_name');
		$this->db->limit($limit,$page);
		$this->db->order_by('n.delete','ASC');
		$this->db->order_by('n.'.$this->input->post('func_order_by'),$this->input->post('order_by'));
		if($this->input->post('title')!=''){
			$this->db->where('(n.`name` LIKE "%'.$this->input->post('title').'%")');
		}
		if($this->input->post('cate_name')!=''){
			$this->db->where('(n.`type` LIKE "%'.$this->input->post('cate_name').'%")');
		}
		if($this->input->post('status') != 2){
			$this->db->where('n.status', $this->input->post('status'));
		}
		if($this->input->post('showData') != 2) {
			$this->db->where('n.delete', $this->input->post('showData'));
		}
		$this->db->from(PREFIX.$this->table." n");
		$this->db->join(PREFIX.$this->table_cate." c", 'n.type = c.id', "left");
		$query = $this->db->get();

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function getTotalsearchContent(){
		$this->db->select('n.*, c.name as cate_name');
		if($this->input->post('title')!=''){
			$this->db->where('(n.`name` LIKE "%'.$this->input->post('title').'%")');
		}
		if($this->input->post('cate_name')!=''){
			$this->db->where('(n.`type` LIKE "%'.$this->input->post('cate_name').'%")');
		}
		if($this->input->post('status') != 2){
			$this->db->where('n.status', $this->input->post('status'));
		}
		if($this->input->post('showData') != 2) {
			$this->db->where('n.delete', $this->input->post('showData'));
		}
		$this->db->from(PREFIX.$this->table." n");
		$this->db->join(PREFIX.$this->table_cate." c", 'n.type = c.id', "left");
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

	function getDetailManagementBySlug($slug){
		$this->db->select('*');
		$this->db->where('slug',$slug);
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
				'code'=> trim($this->input->post('codeAdmincp', true)),
				'order'=> trim($this->input->post('orderAdmincp', true)),
				'slug'=> trim($this->input->post('slugAdmincp', true)),
				'image'=> trim($fileName['image']),
				'type'=> trim($this->input->post('cateAdmincp', true)),
				'unit'=> trim($this->input->post('unitAdmincp', true)),
				'price'=> trim($this->input->post('priceAdmincp', true)),
				'description'=> trim($this->input->post('descriptionAdmincp', true)),
				'viewAll'=> trim($this->input->post('viewAllAdmincp', true)),
				'is_remove'=> trim($this->input->post('cancelAdmincp', true)),
				'useStore'=> implode(',',$this->input->post('useStoreAdmincp', true)),
				'isRateStore'=> trim($this->input->post('isRateStoreAdmincp', true)),
				'rateStore'=> trim($this->input->post('rateStoreAdmincp', true)),
				'isRateStoreMain'=> trim($this->input->post('isRateStoreMainAdmincp', true)),
				'rateStoreMain'=> trim($this->input->post('rateStoreMainAdmincp', true)),
				'isEffectStoreMain'=> trim($this->input->post('isEffectStoreMainAdmincp', true)),
				'effectStoreMain'=> trim($this->input->post('effectStoreMainAdmincp', true)),
				'status'=> $this->input->post('statusAdmincp'),
				'created'=> date('Y-m-d H:i:s',time()),
			);
			if($this->db->insert(PREFIX.$this->table,$data)){
				$id = $this->db->insert_id();
				modules::run('admincp/saveLog',$this->module, $id,'Add new','Add new');
				
				$quotes = $this->input->post('storeAdmincp[]', true);
				if (count($quotes) > 0) {
					foreach ($quotes as $key => $quote) {
						$data = array(
							'productId'=> $id,
							'storeId'=> $key,
							'value'=> $quote,
							'created'=> date('Y-m-d H:i:s',time()),
						);
						$this->db->insert(PREFIX.$this->table_quote, $data);

						$invenData = array(
							'productId'=> $id,
							'storeId'=> $key,
							'value'=> 0,
							'created'=> date('Y-m-d H:i:s',time()),
						);
						$this->db->insert(PREFIX.$this->table_inven, $invenData);
					}
				}

				return true;
			}
		}else{
			$result = $this->getDetailManagement($this->input->post('hiddenIdAdmincp'));
			//Xử lý xóa hình khi update thay đổi hình
			if($fileName['image']==''){
				$fileName['image'] = $result[0]->image;
			}else{
				@unlink(BASEFOLDER.DIR_UPLOAD_PRODUCT.$result[0]->image);
			}
			$data = array(
				'name'=> trim($this->input->post('nameAdmincp', true)),
				'code'=> trim($this->input->post('codeAdmincp', true)),
				'order'=> trim($this->input->post('orderAdmincp', true)),
				'slug'=> trim($this->input->post('slugAdmincp', true)),
				'image'=> trim($fileName['image']),
				'type'=> trim($this->input->post('cateAdmincp', true)),
				'unit'=> trim($this->input->post('unitAdmincp', true)),
				'price'=> trim($this->input->post('priceAdmincp', true)),
				'description'=> trim($this->input->post('descriptionAdmincp', true)),
				'viewAll'=> trim($this->input->post('viewAllAdmincp', true)),
				'is_remove'=> trim($this->input->post('cancelAdmincp', true)),
				'isRateStore'=> trim($this->input->post('isRateStoreAdmincp', true)),
				'rateStore'=> trim($this->input->post('rateStoreAdmincp', true)),
				'isRateStoreMain'=> trim($this->input->post('isRateStoreMainAdmincp', true)),
				'rateStoreMain'=> trim($this->input->post('rateStoreMainAdmincp', true)),
				'isEffectStoreMain'=> trim($this->input->post('isEffectStoreMainAdmincp', true)),
				'effectStoreMain'=> trim($this->input->post('effectStoreMainAdmincp', true)),
				'useStore'=> implode(',',$this->input->post('useStoreAdmincp', true)),
				'status'=> $this->input->post('statusAdmincp'),
			);
			modules::run('admincp/saveLog',$this->module,$this->input->post('hiddenIdAdmincp'),'','Update',$result,$data);
			$this->db->where('id',$this->input->post('hiddenIdAdmincp'));
			if($this->db->update(PREFIX.$this->table,$data)){
				$quotes = $this->input->post('storeAdmincp[]', true);
				foreach ($quotes as $key => $quote) {
					$checkDataQuote = $this->checkDataQuote($this->input->post('hiddenIdAdmincp'), $key);
					if ($checkDataQuote) {
						$data =  array(
							'value' => $quote, 
							'updated'=> date('Y-m-d H:i:s',time())
						);
						$this->db->where('productId',$this->input->post('hiddenIdAdmincp'));
						$this->db->where('storeId', $key);
						$this->db->update(PREFIX.$this->table_quote, $data);
					} else {
						$data = array(
							'productId'=> trim($this->input->post('hiddenIdAdmincp', true)),
							'storeId'=> $key,
							'value'=> $quote,
							'created'=> date('Y-m-d H:i:s',time()),
						);
						$this->db->insert(PREFIX.$this->table_quote, $data);

					}

					$checkDataInventory = $this->checkDataInventory($this->input->post('hiddenIdAdmincp'), $key);
					if(!$checkDataInventory) {
						$invenData = array(
							'productId'=> trim($this->input->post('hiddenIdAdmincp', true)),
							'storeId'=> $key,
							'value'=> 0,
							'created'=> date('Y-m-d H:i:s',time()),
						);
						$this->db->insert(PREFIX.$this->table_inven, $invenData);
					}
				}
				return true;
			}
		}
		return false;
	}



	function checkSlug($slug,$id=0){
		$this->db->select('id');
		$this->db->where('slug',$slug);
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
	
	function checkData($title,$id=0){
		$this->db->select('id');
		$this->db->where('name',$title);
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
	function checkDataQuote($productId, $storeId){
		$this->db->select('id');
		$this->db->where('productId',$productId);
		$this->db->where('storeId',$storeId);
		$query = $this->db->get(PREFIX.$this->table_quote);
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	

	function checkDataInventory($productId, $storeId){
		$this->db->select('id');
		$this->db->where('productId',$productId);
		$this->db->where('storeId',$storeId);
		$query = $this->db->get(PREFIX.$this->table_inven);
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function getDataQuote($productId){
		$this->db->select('*');
		$this->db->where('productId',$productId);
		$query = $this->db->get(PREFIX.$this->table_quote);
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
		$query = $this->db->get(PREFIX.$this->table);

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function getDataHighlight($amount){
		$this->db->select('*');
		$this->db->limit($amount);
		$this->db->where('status',1);
		$this->db->where('highlight',1);
		$this->db->order_by('created','DESC');
		$query = $this->db->get(PREFIX.$this->table);

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function getDataHighlightDetail($id, $amount){
		$this->db->select('*');
		$this->db->limit($amount);
		$this->db->where('status',1);
		$this->db->where('highlight',1);
		$this->db->where_not_in('id',array($id));
		$this->db->order_by('created','DESC');
		$query = $this->db->get(PREFIX.$this->table);

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	function getCateDel(){
		$this->db->select('id');
		$this->db->where('delete', 1);
		$query = $this->db->get(PREFIX.$this->table_category);

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

	function getCommonTinhTrang(){
		$this->db->select('*');
		$this->db->where('commontype','TINHTRANG');
		$query = $this->db->get(PREFIX.$this->table_comm);
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function getCommonBodyType(){
		$this->db->select('*');
		$this->db->where('commontype','BODYTYPE');
		$query = $this->db->get(PREFIX.$this->table_comm);
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	/*--------------------END FRONTEND--------------------*/
}