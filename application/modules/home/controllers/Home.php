<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends MX_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->helper('language');
		$this->lang->load('general');
		$this->load->model('home/Home_model','home');
		$this->load->model('infos/Infos_model','info');
		$this->load->library('session');

		if($this->uri->segment(1)!='dang-nhap'){
			if(!$this->session->userdata('userStaff')){
				header('Location: '.PATH_URL.'dang-nhap');
				exit;
			}
		}
		$this->template->set_template('default');
		$this->template->write('title','Admin Control Panel');
	}
	
	/*------------------------------------ API ------------------------------------*/
	
	public function index(){
		//teamplate
		$this->template->write_view('content','index');
		$this->template->render();
	}

	public function login(){
		if(!empty($_POST)){
			$info = $this->info->getData();
			$checkip = $info[0]->checkLogin;
			if ($checkip) {
				$checkip = $this->home->checkIP($this->input->post('ip'));
			} else {
				$checkip = true;
			}
			
			if ($checkip) { 
				if(md5($this->input->post('pass'))==$this->home->checkLogin($this->input->post('user'))){
					$info = $this->home->getInfo($this->input->post('user'));
					$this->session->set_userdata('userStaff', $info);
					print 1;
				}else{
					print $this->security->get_csrf_hash();
				}
				exit;
			} else {
				print $this->security->get_csrf_hash();
			}
		}else{
			$this->load->view('FRONTEND/login');
		}
	}

	function logout(){
		$this->session->unset_userdata('userStaff');
		header('Location: '.PATH_URL.'dang-nhap');
	}

	public function import(){
		$data['products'] = $this->home->getProducts($this->session->userdata('userStaff')[0]->storeId);
		$this->template->write_view('content','import', $data);
		$this->template->render();
	}

	public function export(){
		//teamplate
		$data['products'] = $this->home->getProducts($this->session->userdata('userStaff')[0]->storeId);
		$this->template->write_view('content','export', $data);
		$this->template->render();
	}

	public function remove(){
		//teamplate
		$data['productsIsRemove'] = $this->home->productsIsRemove($this->session->userdata('userStaff')[0]->storeId);
		$this->template->write_view('content','remove', $data);
		$this->template->render();
	}

	public function orderApp(){
		//teamplate
		$this->template->write_view('content','orderApp');
		$this->template->render();
	}

	public function inventoryStore(){
		//teamplate
		$this->load->model('stores/stores_model');
		$this->load->model('compare/compare_model');
		$compareInventoryStore = array();
		$products =$this->home->getSelectedViewProducts($this->session->userdata('userStaff')[0]->storeId);
		$stores =$this->stores_model->getData();

		if ($products) {
			foreach ($products as $key => $p) {
				$object = new StdClass;
				$object->productName = $p->name;
				foreach ($stores as $key => $s) {
					$inventoryProductStore = $this->compare_model->getInventory($s->id, $p->id);
					$storeid = $s->id;
					$object->$storeid = $inventoryProductStore[0]->value;
				}
				$compareInventoryStore[] = $object;
			}
		}
		
		$data['compare'] = $compareInventoryStore;
		$data['stores'] = $stores;
		$this->template->write_view('content','inventory', $data);
		$this->template->render();
	}

	public function history(){
		$this->template->write_view('content','history');
		$this->template->render();
	}

	public function importInventory(){
		//teamplate
		if(!empty($_POST)){
			$id = $_POST['productId'];
			$qty = $_POST['qty'];
			$updateInventory = $this->home->updateImportInventory($id, $qty);
			if ($updateInventory) {
				print 'success.'.$this->security->get_csrf_hash();
				exit;
			}
		} 
	}

	public function importListQtyPruoduct(){
		//teamplate
		$products = $this->home->getProducts($this->session->userdata('userStaff')[0]->storeId);
		$count = 0;
		foreach ($products as $key => $p) {
			$changedQty = $_POST['qty'.$p->id];
			if ($changedQty && $changedQty > 0) {
				$updateInventory = $this->home->updateImportInventory($p->id, $changedQty);
				if ($updateInventory) {
					$count = $count + 1;
				}
			}
		}

		if($count > 0){
			print 'success.'.$count.'.'.$this->security->get_csrf_hash();
			exit;
		} 
	}

	public function exportInventory(){
		//teamplate
		if(!empty($_POST)){
			$id = $_POST['productId'];
			$qty = $_POST['qty'];
			$updateInventory = $this->home->updateExportInventory($id, $qty);
			if ($updateInventory) {
				print 'success.'.$this->security->get_csrf_hash();
				exit;
			}
		} 
	}

	public function exportListQtyPruoduct() {
		$products = $this->home->getProducts($this->session->userdata('userStaff')[0]->storeId);
		$count = 0;
		$mainStore = $_POST['mainStore'] ? $_POST['mainStore'] : NULL;
		foreach ($products as $key => $p) {
			if (isset($_POST['qty'.$p->id]) && $_POST['qty'.$p->id] > 0) {
				$updateInventory = $this->home->updateExportInventory($p->id, $_POST['qty'.$p->id], $mainStore);
				if ($updateInventory) {
					$count = $count + 1;
				}
			}
		}

		if($count > 0){
			print 'success.'.$count.'.'.$this->security->get_csrf_hash();
			exit;
		} 
	}

	public function removeInventory(){
		//teamplate
		if(!empty($_POST)){
			$updateInventory = $this->home->updateRemoveInventory();
			if ($updateInventory) {
				print 'success.'.$this->security->get_csrf_hash();
				exit;
			}
		} 
	}
	public function ajaxSearchImportProduct (){
		if(!empty($_POST)){
			$data['products'] = $this->home->getProducts($this->session->userdata('userStaff')[0]->storeId, $_POST['name']);
			$this->load->view("ajaxSearchImportProduct",$data);
		}
	}
	public function ajaxSearchExportProduct (){
		if(!empty($_POST)){
			$data['products'] = $this->home->getProducts($this->session->userdata('userStaff')[0]->storeId, $_POST['name']);
			$this->load->view("ajaxSearchExportProduct",$data);
		}
	}

	public function ajaxSearchRemoveProduct (){
		if(!empty($_POST)){
			$data['productsIsRemove'] = $this->home->productsIsRemove($this->session->userdata('userStaff')[0]->storeId, $_POST['name']);
			$this->load->view("ajaxSearchRemoveProduct",$data);
		}
	}



	public function searchHistoryInventory(){
		$this->load->library('AdminPagination');
		$config['total_rows'] = $this->home->searchHistoryInventoryTotal();
		$config['per_page'] = $_POST["per_page"];
		$config['num_links'] = 3;
		$config['func_ajax'] = 'searchHistoryInventory';
		$config['start'] = $_POST["start"];
		$this->adminpagination->initialize($config);

		$result = $this->home->searchHistoryInventory($config['per_page'], $config['start']);

		$data = array(
			'result'=>$result,
			'per_page'=> $_POST["per_page"],
			'start'=> $_POST["start"],
			'total'=>$config['total_rows'],
		);
		$this->load->view('ajaxSearchHistoryInventory',$data);
	}

	public function saveNoteInventory(){
		//teamplate
		if(!empty($_POST)){
			$id = $_POST['productId'];
			$note = $_POST['note'];
			$updateNoteInventory = $this->home->updateNoteInventory($id, $note);
			if ($updateNoteInventory) {
				$res = array(
			        "return"=> true,
			        "csrf_hash" => $this->security->get_csrf_hash(),
			        "data"=> nl2br($note)
			    ) ;
			    echo json_encode($res);
			} else {
				exit;
			}
		} 
	}

	public function loadNoteProductofStore(){
		//teamplate
		if(!empty($_POST)){
			$id = $_POST['productId'];
			$data = $this->home->getNoteProductofStore($id);
			if ($data) {
				$data[0]->note = str_replace("<br />", "", $data[0]->note);
			    $res = array(
			        "return"=> true,
			        "csrf_hash" => $this->security->get_csrf_hash(),
			        "data"=> $data
			    ) ;
			    echo json_encode($res);
			}
		} 
	}

	public function main_info(){
		//teamplate
		$this->load->view('main-store/info.php');
	}

	public function main_import(){
		$data['products'] = $this->home->getProducts($this->session->userdata('userStaff')[0]->storeId);
		$this->template->write_view('content', 'main-store/import', $data);
		$this->template->render();
	}

	public function main_export(){
		//teamplate
		$data['products'] = $this->home->getProducts($this->session->userdata('userStaff')[0]->storeId);
		$data['stores'] = $this->home->getListOtherStore($this->session->userdata('userStaff')[0]->storeId);
		$this->template->write_view('content', 'main-store/export', $data);
		$this->template->render();
	}

	public function ajaxSearchExportMainStore (){
		if(!empty($_POST)){
			$compareEstimatesOrderStore = array();
			$products = $this->home->getProducts($this->session->userdata('userStaff')[0]->storeId, $_POST['name']);
			$store = $_POST['store'];
			if ($products && !empty($store)) {
				foreach ($products as $key => $p) {
					$object = new StdClass;
					$object->id = $p->id;
					$object->name = $p->name;
					$object->inventory = $p->inventory;
					$object->note = $p->note;

					$inventoryForStore = 0;
					$quoteForStore = 0;

					$inventoryProductStore = $this->home->getInventory($p->id, $store);
					// var_dump($inventoryProductStore);
					if($inventoryProductStore) {
						$inventoryForStore = $inventoryProductStore[0]->value;
					}
					// var_dump($inventoryForStore);
					$quoteProductStore = $this->home->getQuote($p->id, $store);
					if($quoteProductStore) {
						$quoteForStore = $quoteProductStore[0]->value;
					}
					// var_dump($quoteForStore);
					$sumEstimates = $quoteForStore - $inventoryForStore;
					
					$object->estimates = $sumEstimates;

					$compareEstimatesOrderStore[] = $object;
					// exit();
				}
			}
			$data['products'] = $compareEstimatesOrderStore ? $compareEstimatesOrderStore : []; 

			$this->load->view("main-store/ajaxSearchExportMainStore", $data);
		}
	}

	public function search_history(){
		$this->template->write_view('content','search_history');
		$this->template->render();
	}

	/*------------------------------------ End API --------------------------------*/

}