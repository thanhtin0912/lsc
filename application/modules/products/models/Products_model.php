<?php
class Products_model extends CI_Model {
	private $module = 'products';
	private $table = 'tbl_products';
	private $table_category = 'tbl_catagories';

	function getsearchContent($limit,$page){
		$this->db->select('n.*, c.name_vn as cate_name');
		$this->db->limit($limit,$page);
		$this->db->order_by('n.delete','ASC');
		$this->db->order_by($this->input->post('func_order_by'),$this->input->post('order_by'));
		$this->db->where('c.cataid','CATA_PRODUCT');
		if($this->input->post('title')!=''){
			$this->db->where('(n.`name_vn` LIKE "%'.$this->input->post('title').'%")');
		}
		if($this->input->post('cate_name')!=''){
			$this->db->where('(c.`name_vn` LIKE "%'.$this->input->post('cate_name').'%")');
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')==''){
			$this->db->where('n.created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
		}
		if($this->input->post('dateFrom')=='' && $this->input->post('dateTo')!=''){
			$this->db->where('n.created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')!=''){
			$this->db->where('n.created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
			$this->db->where('n.created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		if($this->input->post('status') != 2){
			$this->db->where('n.status', $this->input->post('status'));
		}
		if($this->input->post('showData') != 2) {
			$this->db->where('n.delete', $this->input->post('showData'));
		}
		$this->db->from(PREFIX.$this->table." n");
		$this->db->join(PREFIX.$this->table_category." c", 'c.id = n.type', "left");
		$query = $this->db->get();

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function getTotalsearchContent(){
		$this->db->select('n.*, c.name_vn as cate_name');
		$this->db->where('c.cataid','CATA_PRODUCT');
		if($this->input->post('title')!=''){
			$this->db->where('(n.`name_vn` LIKE "%'.$this->input->post('title').'%")');
		}
		if($this->input->post('cate_name')!=''){
			$this->db->where('(c.`name_vn` LIKE "%'.$this->input->post('cate_name').'%")');
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')==''){
			$this->db->where('n.created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
		}
		if($this->input->post('dateFrom')=='' && $this->input->post('dateTo')!=''){
			$this->db->where('n.created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')!=''){
			$this->db->where('n.created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
			$this->db->where('n.created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		if($this->input->post('status') != 2){
			$this->db->where('n.status', $this->input->post('status'));
		}
		if($this->input->post('showData') != 2) {
			$this->db->where('n.delete', $this->input->post('showData'));
		}
		$this->db->from(PREFIX.$this->table." n");
		$this->db->join(PREFIX.$this->table_category." c", 'c.id = n.type', "left");
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
	
	// function saveManagement($imagesName='',$fileName=''){
	function saveManagement($fileName=''){
		if($this->input->post('hiddenIdAdmincp')==0){
			//Kiểm tra đã tồn tại chưa?
			$checkData = $this->checkData($this->input->post('titleAdmincp'));
			if($checkData){
				print 'error-title-exists.'.$this->security->get_csrf_hash();
				exit;
			}

			$checkSlug = $this->checkSlug($this->input->post('slugAdmincp'));
			if($checkSlug){
				print 'error-slug-exists.'.$this->security->get_csrf_hash();
				exit;
			}

			$data = array(
				'name_vn'=> trim($this->input->post('name_vnAdmincp', true)),
				'name_en'=> trim($this->input->post('name_enAdmincp', true)),
				'slug'=> trim($this->input->post('slugAdmincp', true)),
				'type'=> trim($this->input->post('cateAdmincp', true)),
				'avata'=> trim($fileName['avata']),
				// 'images'=> serialize($imagesName),
				'price'=> trim($this->input->post('priceAdmincp', true)),
				'review'=> trim($this->input->post('reviewAdmincp', true)),
				'description_vn'=> trim($this->input->post('description_vnAdmincp')),
				'description_en'=> trim($this->input->post('description_enAdmincp')),
				'content_vn'=> trim($this->input->post('content_vnAdmincp')),
				'content_en'=> trim($this->input->post('content_enAdmincp')),
				'status'=> $this->input->post('statusAdmincp'),
				'created'=> date('Y-m-d H:i:s',time()),
			);
			if($this->db->insert(PREFIX.$this->table,$data)){
				modules::run('admincp/saveLog',$this->module,$this->db->insert_id(),'Add new','Add new');
				return true;
			}
		}else{
			$result = $this->getDetailManagement($this->input->post('hiddenIdAdmincp'));

			//Xử lý xóa hình khi update thay đổi hình
			// if(empty($imagesName)){
			// 	$imagesName = unserialize($result[0]->images);
			// }else{
			// 	$delimages = unserialize($result[0]->images);
			// 	foreach ($delimages as $key => $value) {
			// 		@unlink(BASEFOLDER.DIR_UPLOAD_PRODUCT.$delimages[$key]);
			// 	}
			// }
			if($fileName['avata']==''){
				$fileName['avata'] = $result[0]->avata;
			}else{
				@unlink(BASEFOLDER.DIR_UPLOAD_PRODUCT.$result[0]->avata);
			}


			//Kiểm tra đã tồn tại chưa?
			if($result[0]->name_vn!=$this->input->post('name_vnAdmincp')){
				$checkData = $this->checkData($this->input->post('name_vnAdmincp'),$this->input->post('hiddenIdAdmincp'));
				if($checkData){
					print 'error-title-exists.'.$this->security->get_csrf_hash();
					exit;
				}
			}

			if($result[0]->slug!=$this->input->post('slugAdmincp')){
				$checkSlug = $this->checkSlug($this->input->post('slugAdmincp'),$this->input->post('hiddenIdAdmincp'));
				if($checkSlug){
					print 'error-slug-exists.'.$this->security->get_csrf_hash();
					exit;
				}
			}
			
			$data = array(
				'name_vn'=> trim($this->input->post('name_vnAdmincp', true)),
				'name_en'=> trim($this->input->post('name_enAdmincp', true)),
				'slug'=> trim($this->input->post('slugAdmincp', true)),
				'type'=> trim($this->input->post('cateAdmincp', true)),
				'avata'=> trim($fileName['avata']),
				// 'images'=> serialize($imagesName),
				'price'=> trim($this->input->post('priceAdmincp', true)),
				'review'=> trim($this->input->post('reviewAdmincp', true)),
				'description_vn'=> trim($this->input->post('description_vnAdmincp')),
				'description_en'=> trim($this->input->post('description_enAdmincp')),
				'content_vn'=> trim($this->input->post('content_vnAdmincp')),
				'content_en'=> trim($this->input->post('content_enAdmincp')),
				'status'=> $this->input->post('statusAdmincp')
			);
			modules::run('admincp/saveLog',$this->module,$this->input->post('hiddenIdAdmincp'),'','Update',$result,$data);
			$this->db->where('id',$this->input->post('hiddenIdAdmincp'));
			if($this->db->update(PREFIX.$this->table,$data)){
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
		$this->db->where('name_vn',$title);
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

	function getDataCategory(){
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->where('cataid','CATA_PRODUCT');
		$this->db->where('delete',0);
		$this->db->order_by('created','DESC');
		$query = $this->db->get(PREFIX.$this->table_category);

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	/*----------------------FRONTEND----------------------*/
	function getData($limit,$page){
		$this->db->select('n.*,c.name_vn as cate_name_vn,c.name_en as cate_name_en');
		$this->db->where('n.status',1);
		$this->db->limit($limit,$page);
		$this->db->order_by('n.created','DESC');
		$this->db->from(PREFIX.$this->table." n");
		$this->db->join(PREFIX.$this->table_category." c", 'c.id = n.type', "left");
		$query = $this->db->get();

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function getDetailData($link){
		$arr = explode("-", $link);
        $n= count($arr) - 1;
        $id = $arr[$n];

		$this->db->select('n.*,c.name_vn as cate_name_vn,c.name_en as cate_name_en');
		$this->db->where('n.status',1);
		$this->db->where('n.id',$id);
		$this->db->from(PREFIX.$this->table." n");
		$this->db->join(PREFIX.$this->table_category." c", 'c.id = n.type', "left");
		$query = $this->db->get();

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function getThreeDataLatest(){
		$this->db->select('n.*,c.name_vn as cate_name_vn,c.name_en as cate_name_en');
		$this->db->where('n.status',1);
		$this->db->order_by('created','DESC');
		$this->db->limit('3');
		$this->db->from(PREFIX.$this->table." n");
		$this->db->join(PREFIX.$this->table_category." c", 'c.id = n.type', "left");
		$query = $this->db->get();

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
	/*--------------------END FRONTEND--------------------*/
}