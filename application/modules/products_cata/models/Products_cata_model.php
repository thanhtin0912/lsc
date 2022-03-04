<?php
class Products_cata_model extends CI_Model {
	private $module = 'products_cata';
	private $table = 'tbl_catagories';
	private $table_cata = 'tbl_cataparent';

	function getsearchContent($limit,$page){
		$this->db->select('c.*, p.name_vn as cate_name');
		$this->db->limit($limit,$page);
		$this->db->order_by('c.delete','ASC');
		$this->db->order_by($this->input->post('func_order_by'),$this->input->post('order_by'));
		$this->db->where('c.cataid','CATA_PRODUCT');
		if($this->input->post('name')!=''){
			$this->db->where('(c.`name_vn` LIKE "%'.$this->input->post('name').'%")');
		}
		if($this->input->post('cate_name')!=''){
			$this->db->where('(p.`name_vn` LIKE "%'.$this->input->post('cate_name').'%")');
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')==''){
			$this->db->where('c.created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
		}
		if($this->input->post('dateFrom')=='' && $this->input->post('dateTo')!=''){
			$this->db->where('c.created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')!=''){
			$this->db->where('c.created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
			$this->db->where('c.created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		if($this->input->post('status') != 2){
			$this->db->where('c.status', $this->input->post('status'));
		}
		if($this->input->post('showData') != 2) {
			$this->db->where('c.delete', $this->input->post('showData'));
		}
		$this->db->from(PREFIX.$this->table." c");
		$this->db->join(PREFIX.$this->table_cata." p", 'p.id = c.type', "left");
		$query = $this->db->get();

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function getTotalsearchContent(){
		$this->db->select('c.*, p.name_vn as cate_name');
		$this->db->where('c.cataid','CATA_PRODUCT');
		if($this->input->post('name')!=''){
			$this->db->where('(c.`name_vn` LIKE "%'.$this->input->post('name').'%")');
		}
		if($this->input->post('cate_name')!=''){
			$this->db->where('(p.`name_vn` LIKE "%'.$this->input->post('cate_name').'%")');
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')==''){
			$this->db->where('c.created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
		}
		if($this->input->post('dateFrom')=='' && $this->input->post('dateTo')!=''){
			$this->db->where('c.created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		if($this->input->post('dateFrom')!='' && $this->input->post('dateTo')!=''){
			$this->db->where('c.created >= "'.date('Y-m-d 00:00:00',strtotime($this->input->post('dateFrom'))).'"');
			$this->db->where('c.created <= "'.date('Y-m-d 23:59:59',strtotime($this->input->post('dateTo'))).'"');
		}
		if($this->input->post('status') != 2){
			$this->db->where('c.status', $this->input->post('status'));
		}
		if($this->input->post('showData') != 2) {
			$this->db->where('c.delete', $this->input->post('showData'));
		}
		$this->db->from(PREFIX.$this->table." c");
		$this->db->join(PREFIX.$this->table_cata." p", 'p.id = c.type', "left");
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
			//check name exist
			$checkName = $this->checkName($this->input->post('nameAdmincp'),0);
			if($checkName){
				print 'error-name-exists.'.$this->security->get_csrf_hash();
				exit;
			}

			//check slug exist
			$checkSlug = $this->checkSlug($this->input->post('slugAdmincp'),0);
			if($checkSlug){
				print 'error-slug-exists.'.$this->security->get_csrf_hash();
				exit;
			}

			$data = array(
				'cataid'=> 'CATA_PRODUCT',
				'name_vn'=> trim($this->input->post('nameAdmincp', true)),
				'name_en'=> trim($this->input->post('name_enAdmincp', true)),
				'slug'=> trim($this->input->post('slugAdmincp', true)),
				'type'=> trim($this->input->post('cateAdmincp', true)),
								'avata'=> trim($fileName['avata']),
				'status'=> $this->input->post('statusAdmincp'),
				'created'=> date('Y-m-d H:i:s',time()),
			);

			if($this->db->insert(PREFIX.$this->table,$data)){
				modules::run('admincp/saveLog',$this->module,$this->db->insert_id(),'Add new','Add new');
				return true;
			}
		}else{
			$result = $this->getDetailManagement($this->input->post('hiddenIdAdmincp'));
			//check name exist
			if($result[0]->name_vn!=$this->input->post('nameAdmincp')){
				$checkName = $this->checkName($this->input->post('nameAdmincp'),$this->input->post('hiddenIdAdmincp'));
				if($checkName){
					print 'error-name-exists.'.$this->security->get_csrf_hash();
					exit;
				}
			}

			//check slug exist
			if($result[0]->slug!=$this->input->post('slugAdmincp')){
				$checkSlug = $this->checkSlug($this->input->post('slugAdmincp'),$this->input->post('hiddenIdAdmincp'));
				if($checkSlug){
					print 'error-slug-exists.'.$this->security->get_csrf_hash();
					exit;
				}
			}

			if($fileName['avata']==''){
				$fileName['avata'] = $result[0]->avata;
			}else{
				@unlink(BASEFOLDER.DIR_UPLOAD_CATA.$result[0]->avata);
			}

			$data = array(
				'cataid'=> 'CATA_PRODUCT',
				'name_vn'=> trim($this->input->post('nameAdmincp', true)),
				'name_en'=> trim($this->input->post('name_enAdmincp', true)),
				'slug'=> trim($this->input->post('slugAdmincp', true)),
				'type'=> trim($this->input->post('cateAdmincp', true)),
				'avata'=> trim($fileName['avata']),
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

	function checkName($name,$id=0){
		$this->db->select('id');
		$this->db->where('name_vn',$name);
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
	
	function getDataCategory(){
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->where('delete',0);
		$this->db->order_by('created','DESC');
		$query = $this->db->get(PREFIX.$this->table_cata);

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
	function getDataAll(){
		$this->db->select('1');
		$this->db->where('cataid','CATA_PRODUCT');
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
		$this->db->where('cataid','CATA_PRODUCT');
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