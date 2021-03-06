<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model {

	private $module = 'home';
	private $table_banner 		= 'tbl_banners';
	private $table_cata 		= 'tbl_catagories';
	private $table_product 		= 'tbl_products';
	private $table_project 		= 'tbl_projects';
	private $table_static 		= 'tbl_static_pages';
	private $table_news 		= 'tbl_news';
	private $table_comments 	= 'tbl_comments';
	private $table_site 		= 'tbl_infos';
	private $table_service 		= 'tbl_services';
	private $table_parent		= 'tbl_cataparent';
	private $table_staffs		= 'tbl_staffs';
	private $table_seo 			= 'tbl_seo';
	private $table_contact 		= 'mil_contact';

	function getInfoSite(){
		$this->db->select('*');
		$query = $this->db->get(PREFIX.$this->table_site);
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function getList4LatestNews(){
		$this->db->select('n.*, c.name_vn as cata_vn, c.name_en as cata_en,');
		$this->db->where('n.status',1);
		$this->db->where('n.delete',0);
		$this->db->order_by('n.id','DESC');
		$this->db->limit('4');
		$this->db->from(PREFIX.$this->table_news." n");
		$this->db->join(PREFIX.$this->table_cata." c", 'c.id = n.type', "left");
		$query = $this->db->get();
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}	
	}

	function getList8LatestProducts(){
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->order_by('created','DESC');
		$this->db->limit('18');
		$query = $this->db->get(PREFIX.$this->table_product);
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}	
	}

	function getDataCataParent(){
		$this->db->select('*');
		$this->db->where('delete',0);
		$query = $this->db->get(PREFIX.$this->table_parent);
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function getListImages(){
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->order_by('created','DESC');
		$this->db->limit('7');
		$query = $this->db->get(PREFIX.$this->table_comments);
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}	
	}


	function getDataCatagories($type){
	    $this->db->select('n.*, COUNT(c.type) total');
		$this->db->group_by('n.id');
		$this->db->where('n.cataid',$type);
		$this->db->where('n.status',1);
		$this->db->where('n.delete',0);
		$this->db->from(PREFIX.$this->table_cata." n");
		$this->db->join(PREFIX.$this->table_product." c", 'c.type = n.id ', "left");	
		$query = $this->db->get();
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function getListProjecttoHome(){
		$this->db->select('p.*,c.name_vn as cataname_vn, c.name_en as cataname_en');
		$this->db->where('p.status',1);
		$this->db->order_by('p.created','DESC');
		$this->db->limit('8');
		$this->db->from(PREFIX.$this->table_cata." c");
		$this->db->join(PREFIX.$this->table_project." p", 'c.id = p.type', "left");
		$query = $this->db->get();

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function getListServices(){
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->where('delete',0);
		$this->db->order_by('order','ASC');
		$query = $this->db->get(PREFIX.$this->table_service);
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}	
	}

	function getDataPages($type){
		$this->db->select('*');
		$this->db->where('slug',$type);
		$query = $this->db->get(PREFIX.$this->table_static);
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}


	function searchAllNews($limit,$page){
		$this->db->select('n.*,c.name_vn as cataname_vn, c.name_en as cataname_en');
		$this->db->limit($limit,$page);
		$this->db->where('n.status',1);
		$this->db->order_by('n.created','DESC');
		$this->db->from(PREFIX.$this->table_news." n");
		$this->db->join(PREFIX.$this->table_cata." c", 'c.id = n.type', "left");
		$query = $this->db->get();

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function searchAllNewsTotal(){
		$this->db->select('n.id');
		$this->db->where('n.status',1);
		$this->db->from(PREFIX.$this->table_news." n");
		$this->db->join(PREFIX.$this->table_cata." c", 'n.type = c.id ', "left");
		$query = $this->db->count_all_results();
		if($query > 0){
			return $query;
		}else{
			return false;
		}
	}

	function getDetailNews($link){
		$this->db->select('n.*,c.name_vn as cata_vn, c.name_en as cata_en');
		$this->db->where('n.status',1);
		$this->db->where('n.slug',$link);
		$this->db->from(PREFIX.$this->table_news." n");
		$this->db->join(PREFIX.$this->table_cata." c", 'n.type = c.id ', "left");
		
		$query = $this->db->get();
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function searchAllLibraries($limit,$page){
		$this->db->select('*');
		$this->db->limit($limit,$page);
		$this->db->where('status',1);
		$this->db->where('delete',0);
		$this->db->order_by('created','DESC');
		$this->db->from(PREFIX.$this->table_project);
		$query = $this->db->get();

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function searchAllLibrariesTotal(){
		$this->db->select('id');
		$this->db->where('status',1);
		$this->db->where('delete',0);
		$this->db->order_by('created','DESC');
		$this->db->from(PREFIX.$this->table_project);
		$query = $this->db->count_all_results();
		if($query > 0){
			return $query;
		}else{
			return false;
		}
	}

	function getDetailService($link){
		$this->db->where('status',1);
		$this->db->where('slug',$link);
		$this->db->from(PREFIX.$this->table_service);
		$query = $this->db->get();
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function getListNewsLike($link){
		$this->db->select('n.*,c.name_vn as cataname_vn, c.name_en as cataname_en');
		$this->db->where('n.status',1);
		$this->db->where('n.slug !=',$link);	
		$this->db->order_by('n.created','DESC');
		$this->db->limit('6');
		$this->db->from(PREFIX.$this->table_news." n");
		$this->db->join(PREFIX.$this->table_cata." c", 'n.type = c.id ', "left");
		
		$query = $this->db->get();
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}	
	}

	function getTopStaffs(){
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->where('delete',0);
		$this->db->order_by('created','DESC');
		$this->db->limit('4');
		$this->db->from(PREFIX.$this->table_staffs);
		$query = $this->db->get();
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}	
	}

	function getListProjecttoProject(){
		$this->db->select('p.*,c.name_vn as cataname_vn, c.name_en as cataname_en');
		$this->db->where('p.status',1);
		$this->db->order_by('p.created','DESC');
		$this->db->limit('48');
		$this->db->from(PREFIX.$this->table_cata." c");
		$this->db->join(PREFIX.$this->table_project." p", 'c.id = p.type', "left");
		$query = $this->db->get();

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function getDetailProject($link){
		$this->db->select('n.*,c.name_vn as cataname_vn, c.name_en as cataname_en');
		$this->db->where('n.status',1);
		$this->db->where('n.slug',$link);
		$this->db->from(PREFIX.$this->table_project." n");
		$this->db->join(PREFIX.$this->table_cata." c", 'n.type = c.id ', "left");
		
		$query = $this->db->get();
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function getDetailProjectID($id){
		$this->db->select('urlVideo');
		$this->db->where('status',1);
		$this->db->where('id',$id);
		$this->db->from(PREFIX.$this->table_project);
		$query = $this->db->get();
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function getListProjectsLike($link,$type){
		$this->db->select('n.*,c.name_vn as cataname_vn, c.name_en as cataname_en');
		$this->db->where('n.status',1);
		$this->db->where('n.slug !=',$link);	
		$this->db->where('n.type',$type);
		$this->db->order_by('n.created','DESC');
		$this->db->limit('3');
		$this->db->from(PREFIX.$this->table_project." n");
		$this->db->join(PREFIX.$this->table_cata." c", 'n.type = c.id ', "left");
		
		$query = $this->db->get();
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}	
	}

	//product
	function searchAllProducts($link,$limit,$page){
		$this->db->select('n.*,c.name_vn as cataname_vn, c.name_en as cataname_en');
		$this->db->limit($limit,$page);
		$this->db->where('c.slug',$link);
		$this->db->where('n.status',1);
		$this->db->where('n.delete',0);
		$this->db->order_by('n.created','DESC');
		$this->db->from(PREFIX.$this->table_product." n");
		$this->db->join(PREFIX.$this->table_cata." c", 'c.id = n.type', "left");
		$query = $this->db->get();

		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function searchAllProductsTotal($link){
		$this->db->select('n.*,c.name_vn as cataname_vn, c.name_en as cataname_en');
		$this->db->where('c.slug',$link);
		$this->db->where('n.status',1);
		$this->db->where('n.delete',0);
		$this->db->from(PREFIX.$this->table_product." n");
		$this->db->join(PREFIX.$this->table_cata." c", 'n.type = c.id ', "left");
		$query = $this->db->count_all_results();
		if($query > 0){
			return $query;
		}else{
			return false;
		}
	}

	function getDetailProduct($link){
		$this->db->select('n.*,c.name_vn as cataname_vn, c.name_en as cataname_en, c.slug as cataslug');
		$this->db->where('n.status',1);
		$this->db->where('n.slug',$link);
		$this->db->from(PREFIX.$this->table_product." n");
		$this->db->join(PREFIX.$this->table_cata." c", 'n.type = c.id ', "left");
		
		$query = $this->db->get();
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}

	function getListProductsLike($link,$type){
		$this->db->select('n.*,c.name_vn as cataname_vn, c.name_en as cataname_en');
		$this->db->where('n.status',1);
		$this->db->where('n.slug !=',$link);
		$this->db->where('n.type',$type);	
		$this->db->order_by('n.created','DESC');
		$this->db->limit('8');
		$this->db->from(PREFIX.$this->table_product." n");
		$this->db->join(PREFIX.$this->table_cata." c", 'n.type = c.id ', "left");
		
		$query = $this->db->get();
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}	
	}
	////
	function getListCatagories($id){
		$this->db->select('n.*, COUNT(c.type) total');
		$this->db->group_by('n.id');
		$this->db->where('n.cataid','CATA_PRODUCT');
		$this->db->where('n.status',1);
		$this->db->where('n.delete',0);
		$this->db->where('n.type',$id);
		$this->db->from(PREFIX.$this->table_cata." n");
		$this->db->join(PREFIX.$this->table_product." c", 'c.type = n.id ', "left");	
		$query = $this->db->get();
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}	
	}

	function getList4ProductOfCatagories(){
		$this->db->select('n.*');
		$this->db->group_by('n.name_vn');
		$this->db->order_by('n.type,n.id','DESC');
		$this->db->where('n.status',1);
		$this->db->where('n.delete',0);
		$this->db->having('COUNT(*) <', 4);
		$this->db->from(PREFIX.$this->table_product." n");
		$this->db->join(PREFIX.$this->table_cata." n2", 'n.type = n2.type and n.id < n2.id', "left");	
		$query = $this->db->get();
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}	
	}


	function getDetailCatagories($link){
		$this->db->select('*');
		$this->db->where('cataid','CATA_PRODUCT');
		$this->db->where('status',1);
		$this->db->where('delete',0);
		$this->db->where('slug',$link);
		$this->db->from(PREFIX.$this->table_cata);
		$query = $this->db->get();
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}


	function getInfoSeoPage($slug){
		$this->db->select('*');
		$this->db->where('slug', $slug);
		$this->db->from(PREFIX.$this->table_seo);
		$query = $this->db->get();
		if($query->result()){
			$res = $query->result();
			return $res[0];
		}else{
			return false;
		}
	}

	public function saveInfoContact(){
		$description = '';
		$subject = '';
		if($_POST["isType"] == true){
			$description = $_POST["old"];
			$subject = 'Th??ng tin h??? tr??? t?? v???n.';
		} else {
			$description = $_POST["description"];
			$subject = 'Li??n h??? h??? tr???.';
		}
		$data = array(
			'name'			=> $_POST["name"],
			'phone'			=> $_POST["phone"],
			'email'			=> $_POST["mail"],
			'description'	=> $description,
			'subject'		=> $subject,
			'status'		=> 1,
			'bcc'			=> 'letsstartcenter@gmail.com',
			'created'		=> date('Y-m-d H:i:s',time()),
		);

		if($this->db->insert(PREFIX.$this->table_contact,$data)){
			$id = $this->db->insert_id();
			
			$this->load->helper('language');
			$this->lang->load('general');
			$config = array(
		    	'protocol' => 'smtp',
	            'smtp_host' => 'ssl://smtp.gmail.com',
	            'smtp_port' => '465',
	            'smtp_user' => 'server.k2office@gmail.com',
	            'smtp_pass' => 'erishczexsgvsbru'//Nh??? ????nh ????ng user v?? pass nh??
			);

			$this->load->library('Email',$config);
			$this->email->set_mailtype("html");
			$this->email->set_newline("\r\n");

			$this->email->from("server.k2office@gmail.com','K??? n??ng s???ng v?? ngo???i ng??? Let's Start.");
			$this->email->to($data["email"]);
			$this->email->bcc('thanhtin0912@gmail.com');
			$this->email->subject($data['subject']);

			if($_POST["isType"] === true){
				$data['isCheck'] = true ;
			} else {
				$data['isCheck'] = false;
			}
			
			$body=$this->load->view('mail_contact', $data, true);
			$this->email->message($body);
			$this->email->send();
			if($this->updateBodyContact($id, $body)){
				return true;
			}
		} else {
			return false;
		}
	}

	public function updateBodyContact($id, $body){
		$this->db->where('id',$id);
		$data=array(
			"content"=> $body
		);
		$this->db->update(PREFIX.$this->table_contact, $data);  
		return true;
	}

	

}
?>