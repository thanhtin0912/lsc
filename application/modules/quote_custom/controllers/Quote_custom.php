<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quote_custom extends MX_Controller {

	private $module = 'quote_custom';
	private $table = 'quote';
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
		$this->load->model('categories/categories_model');	
		$data = array(
			'module'=>$this->module,
			'module_name'=>$this->session->userdata('Name_Module'),
			'default_func'=>$default_func,
			'default_sort'=>$default_sort,
			'cates' => $this->model->getDataStore(),
			'days' => $this->categories_model->getDataCommonCode('DAYS'),
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
			'module'=>$this->module,
			'id'=>$id
		);
		echo json_encode($data);
		exit;
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
	

	public function admincp_ajaxLoadContent(){
		if (isset($_POST['store'])) {
			$products = $this->model->getProducts($_POST['store']);

			$fromDate = date('Y-m-d',time());
			$toDate = date('Y-m-d',time());
			
			$storeId = $_POST['store'];
			$days = 1; 
			if ($_POST['days']) {
				$days = (float)$_POST['days'];
				$fromDate =  date('Y-m-d', strtotime($toDate . "-".$days. "days"));
			} else {
				$fromDate = $_POST['from'];
				$toDate = $_POST['to'];

				$diff =  abs(strtotime($_POST['to']) - strtotime($_POST['from']));
				$years = floor($diff / (365*60*60*24));
				$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
				$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));				
			}
			if ($products) {
				$arrProduct = array();
				$rate = 0;
				foreach ($products as $key => $p) {
				    if(isset($_POST['rate'])) {
        				$rate = $_POST['rate'];
        			}
					// total xuất từ kho chính qua cửa hàng
					$quotetoDate = $this->model->getExportQuotetoDate($p->id, $storeId, $fromDate, $toDate);
					$object = new StdClass;
					$object->id = $p->id;
					$object->name = $p->name;
					$object->value = 1;
					if ($p->isRateStore && $p->rateStore > 0) {
						$rate = $p->rateStore;
					}
					if ($quotetoDate) {
						$sum = 0;
						foreach ($quotetoDate as $key => $q) {
							$sum = $sum + $q->value;
						}
						$cal = number_format((float)($sum/($days)) + (float)((($sum/($days)) * $rate)/100), 0 );
						if($cal < 1) {
							$object->value = 1;
						} else {
							$object->value = $cal;
						}
						$object->rate = $rate;
						$object->sum = $sum;
					}
					$arrCompare[] = $object;
				}
				$data['results'] = $arrCompare; 
				$data['module'] = $this->module;
				$this->load->view('BACKEND/ajax_loadContent', $data);
			}
		}

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
	/*------------------------------------ End Admin Control Panel --------------------------------*/
}