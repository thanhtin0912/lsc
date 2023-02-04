<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends MX_Controller {

	private $module = 'report';
	private $table = 'usr_services';
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
		$default_func = 'created';
		$default_sort = 'DESC';
		$this->load->model('stores/stores_model');
		$data = array(
			'module'=>$this->module,
			'module_name'=>$this->session->userdata('Name_Module'),
			'default_func'=>$default_func,
			'default_sort'=>$default_sort,
			'cates' => $this->stores_model->getData(),
		);
		$this->template->write_view('content','BACKEND/index',$data);
		$this->template->render();
	}
	
	
	public function admincp_update($id=0){
		$this->load->model('customers/customers_model');
		$this->load->model('staff/staff_model');
		if($id==0){
			modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'w',0);
		}else{
			modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'r',0);
		}
		$result[0] = array();
		if($id!=0){
			$result = $this->model->getDetailManagement($id);
		}
		$data = array(
			'result'=>$result[0],
			'customer' =>$this->customers_model->getData(),
			'staff' =>$this->staff_model->getData(),
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
			if($this->model->saveManagement()){
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
			foreach ($result as $key => $value) {
				if($value->delete == 1){
					modules::run('admincp/saveLog',$this->module,$id,'Restore','Restore');
					$this->db->where('id',$id);
					if($this->db->update(PREFIX.$this->table,$data)){
						// $this->db->where('cate_id',$value->id);
						// $this->db->update(PREFIX.'news',$data);
						print $this->security->get_csrf_hash();
						exit;
					}
				}else{
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
						print $this->security->get_csrf_hash();
						exit;
					}
				}
			}
		}
	}
	
	public function admincp_ajaxLoadContent(){
		$products = $this->model->getAllProductInventory($_POST['store']);
		if($_POST['date']) {
			$date = $_POST['date'];
		} else {
			$date = date('Y-m-d H:i:s',time());
		}
		foreach ($products as $key => $pro) {

			$totalImport = $this->model->totalImportToday($pro->id, $_POST['store'], $date);
			$totalExport = $this->model->totalExportToday($pro->id, $_POST['store'], $date);
			$totalRemove = $this->model->totalRemoveToday($pro->id, $_POST['store'], $date);
			if ($totalImport[0]->adjQty) {
				$pro->import = floatval($totalImport[0]->adjQty);
			}
			if ($totalExport[0]->adjQty) {
				$pro->export = floatval($totalExport[0]->adjQty);
			}

			if ($totalRemove[0] !=  NULL) {
				$pro->remove = floatval($totalRemove[0]->adjQty);
			} else {
				$pro->remove = 0;
			}
		}
		$data = array (
			'products' => $products,
		);
		$this->load->view('BACKEND/ajax_loadContent', $data);
	}
	
	public function admincp_ajaxUpdateStatus(){
		$perm = modules::run('admincp/chk_perm',$this->session->userdata('ID_Module'),'w',1);
		$result = $this->model->getDetailManagement($this->input->post('id'));
		$info['result'] = $result;
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

	public function loadlist() {
		$data["list"] = $this->model->getData();
		echo json_encode($data);
		exit;
	}
	/*------------------------------------ End Admin Control Panel --------------------------------*/
}