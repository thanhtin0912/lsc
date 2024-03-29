<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends MX_Controller {

	private $module = 'products';
	private $table = 'products';
	function __construct(){
		parent::__construct();
		$this->load->model($this->module.'_model','model');
		$this->load->model('admincp_modules/admincp_modules_model');
		if($this->uri->segment(1)=='admincp'){
			if($this->uri->segment(2)!='login'){
				if(!$this->session->userdata('userInfo')){
					header('Location: '.PATH_URL_ADMIN.'login');
					return false;
				}
				$get_module = $this->admincp_modules_model->check_modules($this->uri->segment(2));
				$this->session->set_userdata('ID_Module',$get_module[0]->id);
				$this->session->set_userdata('Name_Module',$get_module[0]->name);
			}
			$this->template->set_template('admin');
			$this->template->write('title','Admin Control Panel');
		}
	}
	/*------------------------------------ Admin Control Panel ------------------------------------*/
	public function admincp_index(){
		modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'r',0);
		$default_func = 'order';
		$default_sort = 'DESC';
		$this->load->model('categories/categories_model');
		$data = array(
			'module'=>$this->module,
			'module_name'=>$this->session->userdata('Name_Module'),
			'default_func'=>$default_func,
			'default_sort'=>$default_sort,
			'cates' => $this->categories_model->getDataCommonCode('PRODUCT'),
		);
		$this->template->write_view('content','BACKEND/index',$data);
		$this->template->render();
	}
	
	
	public function admincp_update($id=0){
		$this->load->model('categories/categories_model');
		$this->load->model('stores/stores_model');
		if($id==0){
			modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'w',0);
		}else{
			modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'r',0);
		}
		$result[0] = array();
		$quotes = array();

		if($id!=0){
			$result = $this->model->getDetailManagement($id);
			$quotes = $this->model->getDataQuote($id);
		}
		$data = array(
			'result'=>$result[0],
			'cates' => $this->categories_model->getDataCommonCode('PRODUCT'),
			'units' => $this->categories_model->getDataCommonCode('UNIT'),
			'stores' => $this->stores_model->getData(),
			'quotes' => $quotes,
			'module'=>$this->module,
			'id'=>$id
		);
		$this->template->write_view('content','BACKEND/ajax_editContent',$data);
		$this->template->render();
	}

	public function admincp_save(){
		$perm = modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'w',1);
		if($perm=='permission-denied'){
			print $perm.'.'.$this->security->get_csrf_hash();
			exit;
		}
		if($_POST){
			// Upload Image
			$fileName = array(
                    'image'=>'',
                );
			if($_FILES){
				foreach($fileName as $k=>$v){
					if(isset($_FILES['fileAdmincp']['error'][$k]) && $_FILES['fileAdmincp']['error'][$k]!=4){
						$typeFileImage = strtolower(substr($_FILES['fileAdmincp']['type'][$k],0,5));
						if($typeFileImage == 'image'){
							$tmp_name[$k] = $_FILES['fileAdmincp']["tmp_name"][$k];
							$file_name[$k] = $_FILES['fileAdmincp']['name'][$k];
							$ext = strtolower(substr($file_name[$k], -4, 4));
							$fileName[$k] = date('Y').'/'.date('m').'/'.md5(time().'_'.SEO(substr($file_name[$k],0,-4))).$ext;
						}else{
							print 'error-file-upload.'.$this->security->get_csrf_hash();
							exit;
						}
					}
				}
			}
			//End Upload Image
			if($this->model->saveManagement($fileName)){
				//Upload Image
				if($_FILES){
					$upload_path = BASEFOLDER.DIR_UPLOAD_PRODUCT;
					check_dir_upload($upload_path);
					foreach($fileName as $k=>$v){
						if(isset($_FILES['fileAdmincp']['error'][$k]) && $_FILES['fileAdmincp']['error'][$k]!=4){
							move_uploaded_file($tmp_name[$k], $upload_path.$fileName[$k]);
						}
					}
				}
				//End Upload Image
				if($this->input->post('hiddenIdAdmincp')==0){
					print 'redirect.'.$this->security->get_csrf_hash();
					exit;
				}
				else {
					print 'success.'.$this->security->get_csrf_hash();
					exit;
				}
			}
		}
	}

	
	public function admincp_count($target = 2){
		modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'r',0);
		$sumAll = $this->model->getDataAll();
		$sumPublish = $this->model->getDataPublish();
		$data = array(
			'totalAll'=>$sumAll,
			'totalPublish'=>$sumPublish,
			'target'=>$target,
		);
		$this->load->view('BACKEND/ajax_loadCount',$data);
	}
	
	public function admincp_restore(){
		$perm = modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'d',1);
		if($perm=='permission-denied'){
			print $perm;
			exit;
		}
		if($this->input->post('id')){
			$data = array(
				'delete' => 0
			);
			$id = $this->input->post('id');
			$result = $this->model->getDetailManagement($id);
			$cateDels = $this->model->getCateDel();
			$listCates = array();
			foreach ($cateDels as $key => $cateDel) {
				// pr($parentDel->id);
				if(!in_array($cateDel->id, $listCates)){
					array_push($listCates, $cateDel->id);
				}
			}
			foreach ($result as $key => $value) {
				if($value->delete == 1){
					if(in_array($value->cate_id, $listCates)){
						print 'permission-denied.'.$this->security->get_csrf_hash();
						exit;
					}
					else{
						modules::run('admincp/saveLog',$this->module,$id,'Restore','Restore');
						$this->db->where('id',$id);
						if($this->db->update(PREFIX.$this->table,$data)){
							print $this->security->get_csrf_hash();
							exit;
						}
					}
				}
				else{
					print $this->security->get_csrf_hash();
					exit;
				}
			}
		}
	}
	
	public function admincp_delete(){
		$perm = modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'d',1);
		if($perm=='permission-denied'){
			print $perm;
			exit;
		}
		if($this->input->post('id')){
			$data = array(
				'delete' => 1
			);
			$id = $this->input->post('id');
			$result = $this->model->getDetailManagement($id);
			foreach ($result as $key => $value) {
				if($value->delete == 0){
					modules::run('admincp/saveLog',$this->module,$id,'Trash','Trash');
					$this->db->where('id',$id);
					if($this->db->update(PREFIX.$this->table,$data)){
						print $this->security->get_csrf_hash();
						exit;
					}
				}
				else{
					modules::run('admincp/saveLog',$this->module,$id,'Delete','Delete');
					$this->db->where('id',$id);
					if($this->db->delete(PREFIX.$this->table)){
						@unlink(BASEFOLDER.DIR_UPLOAD_PRODUCT.$result[0]->image);
						print $this->security->get_csrf_hash();
						exit;
					}
				}
			}
		}
	}
	


	public function admincp_ajaxLoadContent(){
		$this->load->library('AdminPagination');
		$config['total_rows'] = $this->model->getTotalsearchContent();
		$config['per_page'] = $this->input->post('per_page');
		$config['num_links'] = 3;
		$config['func_ajax'] = 'searchContent';
		$config['start'] = $this->input->post('start');
		$this->adminpagination->initialize($config);

		$result = $this->model->getsearchContent($config['per_page'],$this->input->post('start'));
		// var_dump($result); exit();
		$data = array(
			'result'=>$result,
			'per_page'=>$this->input->post('per_page'),
			'start'=>$this->input->post('start'),
			'module'=>$this->module,
			'total'=>$config['total_rows']
		);
		$this->session->set_userdata('start',$this->input->post('start'));
		$this->load->view('BACKEND/ajax_loadContent',$data);
	}
	
	public function admincp_ajaxUpdateStatus(){
		$perm = modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'w',1);
		if($perm=='permission-denied'){
			print '<script type="text/javascript">show_perm_denied()</script>';
			$status = $this->input->post('status');
			$data = array(
				'status'=>$status
			);
		}else{
			if($this->input->post('status')==0){
				$status = 1;
			}else{
				$status = 0;
			}
			$data = array(
				'status'=>$status
			);
			modules::run('admincp/saveLog',$this->module,$this->input->post('id'),'status','update',$this->input->post('status'),$status);
			$this->db->where('id', $this->input->post('id'));
			$this->db->update(PREFIX.$this->table, $data);
		}
		
		$update = array(
			'status'=>$status,
			'id'=>$this->input->post('id'),
			'module'=>$this->module
		);
		$this->load->view('BACKEND/ajax_updateStatus',$update);
	}

	public function admincp_getAllCatagoriesLV2(){
		$parent                 = $_POST['parent'];
		$req = $this->model->getAllCatagoriesLV2($parent);
		if($req['Return']==1){
			echo 'success*'.$this->security->get_csrf_hash().'*'.json_encode($req);
			exit;
		}else{
			echo 'Error*'.$this->security->get_csrf_hash();
			exit;
		}
	}

	public function admincp_getImagesProduct(){
		$objid                 = $_POST['objid'];
		$req = $this->model->getImagesProduct($objid);
		if($req['Return']==1){
			echo 'success*'.$this->security->get_csrf_hash().'*'.json_encode($req);
			exit;
		}else{
			echo 'Error*'.$this->security->get_csrf_hash();
			exit;
		}
	}
	/*------------------------------------ End Admin Control Panel --------------------------------*/

	public function detail($slug){
		$data["item"] = $this->model->getDetailManagementBySlug($slug);
		$data["list_highlight"] = $this->model->getDataHighlightDetail($data["item"][0]->id, 4);
		$this->template->write('title',$data["item"][0]->seo_title);
		$this->template->write('meta_keywords',$data["item"][0]->seo_keywords);
		$this->template->write('meta_description',$data["item"][0]->seo_description);
		$this->template->write('meta_url', PATH_URL . "du-an/" . $slug);
		$this->template->write('meta_image', PATH_URL . DIR_UPLOAD_PRO_FILES . $data["item"][0]->image);
		$this->template->write_view('content','FRONTEND/detail', $data);
		$this->template->render();
	}
}