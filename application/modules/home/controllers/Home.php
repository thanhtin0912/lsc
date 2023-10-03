<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends MX_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->helper('language');
		$this->lang->load('general');
		$this->load->model('home/Home_model','home');
		$this->load->model('infos/Infos_model','info');
		$this->load->library('session');
		$this->load->helper('cookie');

		if($this->uri->segment(1)!='dang-nhap'){
			if(!$this->session->userdata('userStaff')){
				header('Location: '.PATH_URL.'dang-nhap');
				exit;
			}
			else {
				$userSes = $this->session->userdata('userStaff');
				$check = $this->home->getInfoSession($userSes[0]->phone, get_cookie('ci_session'));
				if(!$check) {
					echo '<script language="javascript">';
					echo 'alert("Tài khoản đã được đăng nhập thiết bị khác.")';
					echo '</script>';
					echo '<script language="javascript">';
					echo "window.location.href = '" .PATH_URL. "dang-nhap';";
					echo '</script>';
					exit;
				}
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

	function getRandomNumber($n) {
		$characters = '0123456789';
		$randomString = '';
		for ($i = 0; $i < $n; $i++) {
			$index = rand(0, strlen($characters) - 1);
			$randomString .= $characters[$index];
		}
		return $randomString;
	}

	function login(){
		if(!empty($_POST)){
			$info = $this->home->getCommonData();
			if($this->input->post('verify') && $this->input->post('verify') != '') {
				$info = $this->home->getInfoCode($this->input->post('verify'));
				if ($info) {
					$session_id = get_cookie('ci_session');
					
					$data = array(
						'code' => null,
						'session' => $session_id
					);
					$this->db->where('phone', $info[0]->phone);
					$this->db->update('users' ,$data);

					$newInfo = $this->home->getInfo($info[0]->phone);
					$this->session->set_userdata('userStaff', $newInfo);
					$res = array(
						"status"=> true,
						"csrf_hash" => $this->security->get_csrf_hash(),
					);
					echo json_encode($res);
					exit;
				} else {
					$res = array(
						"mes"=> 'Mã xác nhận không chính xác',
						"status"=> false,
						"csrf_hash" => $this->security->get_csrf_hash(),
					);
					echo json_encode($res);
					exit;
				}
			} else {
				if(md5($this->input->post('pass'))==$this->home->checkLogin($this->input->post('user'))){
					$codeVerify =  $this->getRandomNumber(4);
					// update session of device login
					if($info[0]->isVerify && $info[0]->codeVerify != '') {
						$codeVerify =  $info[0]->codeVerify;
					}
					$data = array(
						'code' => $codeVerify
					);
					$this->db->where('phone', $this->input->post('user'));
					// $info = null;
					if($this->db->update('users' ,$data)){
						if(!$info[0]->isVerify) {
							$info = $this->home->getInfo($this->input->post('user'));
							$mes = '';
							$mes .= '<b>Tên NV: '.$info[0]->name.'</b>';
							$mes .= " \n ";
							$mes .= '<b>Cửa hàng: '.$info[0]->store_name.'</b>';
							$mes .= " \n ";
							$mes .= '<b>Địa chỉ IP: '.$this->input->post('ip').'</b>';
							$mes .= " \n ";
							$mes .= '<b>--------------------------------------</b>';
							$mes .= " \n ";
							$mes .= '<b>'.$codeVerify.'</b>';
							$mes .= " \n ";
							$mes .= '<b>--------------------------------------</b>';
							$mes .= " \n ";
							$this->loginVerify($mes);
						}

						$res = array(
							"status"=> true,
							"csrf_hash" => $this->security->get_csrf_hash(),
						);
						echo json_encode($res);
						exit();
					} else {
						$res = array(
							"mes"=> 'Tài khoản hoặc mật khẩu không đúng.',
							"status"=> false,
							"csrf_hash" => $this->security->get_csrf_hash(),
						);
						echo json_encode($res);
					}
					exit;
				} else {
					$res = array(
						"mes"=> 'Tài khoản hoặc mật khẩu không đúng.',
						"status"=> false,
						"csrf_hash" => $this->security->get_csrf_hash(),
					);
					echo json_encode($res);
				}			
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

	public function moveProductToStore(){
		$data['products'] = $this->home->getProducts($this->session->userdata('userStaff')[0]->storeId);
		$data['stores'] = $this->home->getListOtherStore($this->session->userdata('userStaff')[0]->storeId);
		$this->template->write_view('content','moveProduct', $data);
		$this->template->render();
	}

	public function ajaxSearchMoveProductStore (){
		$data['products'] = $this->home->getProducts($this->session->userdata('userStaff')[0]->storeId, $_POST['name']);
		$this->load->view("ajaxMoveProductStore", $data);
	}

	public function historyMoveProductToStore(){
		$data['history'] = $this->home->getMoveProduct();
		$this->template->write_view('content','moveProductHistory', $data);
		$this->template->render();
	}
	public function moveProductStore() {
		if(!empty($_POST)){
			$id = $_POST['productId'];
			$qty = $_POST['qty'];
			$toStore = $_POST['store'];
			$mes = '';

			$this->load->model('products/products_model');
			$this->load->model('stores/stores_model');
			$product =$this->products_model->getDetailManagement($_POST['productId']);
			$fromStoreDetail = $this->stores_model->getDetailManagement($this->session->userdata('userStaff')[0]->storeId);
			$toStoreDetail = $this->stores_model->getDetailManagement($toStore);
			$data = array(
				'productId' => $id,
				'qty' => $qty,
				'fromStore' => $this->session->userdata('userStaff')[0]->storeId,
				'toStore' => $toStore,
				'customerId' => $this->session->userdata('userStaff')[0]->id,
				'created'=> date('Y-m-d H:i:s',time()),
			);
			$saveMoveProduct = $this->home->saveMoveProduct($data);
			if ($saveMoveProduct) {
				$mes = '<b>'.$product[0]->name.': '.$_POST['qty'].'</b>';
				$mes .= " \n ";
				$mes .= '<b>['.$fromStoreDetail[0]->name.'] chuyển cho ['.$toStoreDetail[0]->name.']</b>';
				$mes .= " \n ";
				$mes .= '<b>Nhân viên: '.$this->session->userdata('userStaff')[0]->name.'</b>';
				$mes .= " \n ";
				$mes .= '<a href="https://kho.leotea.vn/api/verifyPage?id='.$saveMoveProduct.'">Xác nhận</a>';
				$mes .= " \n ";
				if($mes!='') {
					$this->sendMessageVerify($mes);
				}
				print 'success.'.$this->security->get_csrf_hash();
				exit;
			}
		} 
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
			$mes = '';
			$userSes = $this->session->userdata('userStaff');
			$inventoryNow = $this->home->updateImportInventory($id, $qty, $userSes[0]->storeId, $userSes[0]->id);
			if ($inventoryNow) {
				$this->load->model('products/products_model');
				$product =$this->products_model->getDetailManagement($_POST['productId']);
				if($this->session->userdata('userStaff')[0]->isMain) {
					$mes = '<b>'.$product[0]->name.': '.$_POST['qty'].'</b>';
					$mes .= " \n ";
					$mes .= '<b>Tồn kho: ' .$inventoryNow.'</b>';
					$mes .= " \n ";
					if($mes!='') {
						$this->sendImportMessageTelegram($mes, 1);
					}
				}
				print 'success.'.$this->security->get_csrf_hash();
				exit;
			}
		} 
	}
	public function formatStringImportProduct() {
		$arr = preg_split("/(\r\n|\n|\r|\.)/", rtrim($_POST['mes']));
		// var_dump($arr);exit();
		if (count($arr) > 0) {
			$arrError = [];
			$arrProduct = [];
			$products = $this->home->getProducts($this->session->userdata('userStaff')[0]->storeId);
			foreach ($arr as $key => $item) {
				$list = mb_split(":", ltrim(rtrim($item)));
				$qty = (float)ltrim(rtrim($list[1]));
				if(count($list) === 2 && $qty > 0) {
					$slugProduct = $this->slug($list[0]);
					$count = 0;
					$object = new StdClass;
					foreach ($products as $key => $p) {
						if($p->slug === $slugProduct){
							$count = $count + 1;
							$object->id = $p->id;
							$object->name = ltrim(rtrim($list[0]));
							$object->qty = $qty;
							$arrProduct[] = $object;
						}
					}
					if($count === 0) {
						$arrError[] = $item;
						$req = array(
							'arrError' => $arrError,
							'token' => $this->security->get_csrf_hash(),
							'status' => 0
						);
						print json_encode($req);
						exit;
					}
				} else {
					$arrError[] = $item;
					$req = array(
						'arrError' => $arrError,
						'token' => $this->security->get_csrf_hash(),
						'status' => 0
					);
					print json_encode($req);
					exit;
				}

			}
			if(count($arrProduct) === count($arr) && $arrProduct) {
				$count = 0;
				$mes = '';
				$userSes = $this->session->userdata('userStaff');
				foreach ($arrProduct as $key => $a) {
					$inventoryNow = $this->home->updateImportInventory($a->id, $a->qty, $userSes[0]->storeId, $userSes[0]->id);
					if ($inventoryNow) {
						$mes .= '<b>'.$a->name.': '.$a->qty.' - Tồn kho: ' .$inventoryNow.'</b>';
						$mes .= " \n ";
						$count = $count + 1;
					}
				}
				if($count > 0){
					if($mes!='') {
						$this->sendImportMessageTelegram($mes, $count);
					}
					$req = array(
						'count' => $count,
						'token' => $this->security->get_csrf_hash(),
						'status' => 1
					);
					print json_encode($req);
					exit;
				} 
			}
		}
		exit();
	}

	function slug($str)
	{
		$str = trim(mb_strtolower($str));
		$str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
		$str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
		$str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
		$str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
		$str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
		$str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
		$str = preg_replace('/(đ)/', 'd', $str);
		$str = preg_replace('/[^a-z0-9-\s]/', '', $str);
		$str = preg_replace('/([\s]+)/', '-', $str);
		return $str;
	}
	public function importListQtyPruoduct(){
		//teamplate
		$products = $this->home->getProducts($this->session->userdata('userStaff')[0]->storeId);
		$count = 0;
		$mes = '';
		foreach ($products as $key => $p) {
			$changedQty = $_POST['qty'.$p->id];
			if ($changedQty && $changedQty > 0) {
				$updateInventory = $this->home->updateImportInventory($p->id, $changedQty);
				if ($updateInventory) {
					$mes .= '<b>'.$p->name.': '.$changedQty.'</b>';
					$mes .= " \n ";
					$count = $count + 1;
				}
			}
		}

		if($count > 0){
			if($mes!='') {
				$this->sendImportMessageTelegram($mes, 1);
			}
			print 'success.'.$count.'.'.$this->security->get_csrf_hash();
			exit;
		} 
	}

	public function exportInventory(){
		//teamplate
		if(!empty($_POST)){
			$id = $_POST['productId'];
			$qty = $_POST['qty'];
			$mainStore = NULL;
			$mes = '';
			if (!empty($_POST['mainStore'])) {
				$mainStore = $_POST['mainStore'];
				$this->load->model('products/products_model');
				$product =$this->products_model->getDetailManagement($_POST['productId']);
				$mes = '<b>'.$product[0]->name.': '.$_POST['qty'].'</b>';
				$mes .= " \n ";
			}
			$userSes = $this->session->userdata('userStaff');
			$updateInventory = $this->home->updateExportInventory($id, $qty, $mainStore, $userSes[0]->storeId, $userSes[0]->id);
			if ($updateInventory) {
				if($mes!='') {
					$this->sendMessageTelegram($mes, $mainStore, 1);
				}
				print 'success.'.$this->security->get_csrf_hash();
				exit;
			}
		} 
	}

	public function exportListQtyPruoduct() {
		$products = $this->home->getProducts($this->session->userdata('userStaff')[0]->storeId);
		$count = 0;
		$mainStore =  $_POST['mainStore'];
		$mes = '';
		if ($mainStore || $mainStore != '') {
			foreach ($products as $key => $p) {
				if (isset($_POST['qty'.$p->id]) && $_POST['qty'.$p->id] > 0) {
					$userSes = $this->session->userdata('userStaff');
					$updateInventory = $this->home->updateExportInventory($p->id, $_POST['qty'.$p->id], $mainStore, $userSes[0]->storeId, $userSes[0]->id);
					if ($updateInventory) {
						$count = $count + 1;
						$new = '<b>'.$p->name.': '.$_POST['qty'.$p->id].'</b>';
						$quoteProductStore = $this->home->getQuote($p->id, $_POST['mainStore']);
						if ($quoteProductStore && $quoteProductStore[0]->value > $p->inventory) {
							$thieu = $quoteProductStore[0]->value  - $_POST['qty'.$p->id];
							$new = '<b>'.$p->name.': '.$_POST['qty'.$p->id].' (Thiếu ' .$thieu. ')</b>';
						}
						$mes .= $new;
						$mes .= " \n ";
					}
				} else {
					if (isset($_POST['thieu'.$p->id]) && $_POST['thieu'.$p->id] > 0) {
						$mes .= '<b>'.$p->name.': 0 (Thiếu '.$_POST['thieu'.$p->id].')</b>';
						$mes .= " \n ";
					}
				}
			}

			if($count > 0){
				if($mes!='' && $mainStore) {
					$this->sendMessageTelegram($mes, $mainStore, $count);
				}
				print 'success.'.$count.'.'.$this->security->get_csrf_hash();
				
			} 
		} else {
			print 'fail'.$this->security->get_csrf_hash();
			exit;
		}

	}

	public function removeInventory(){
		//teamplate
		if(!empty($_POST)){
			$userSes = $this->session->userdata('userStaff');
			$updateInventory = $this->home->updateRemoveInventory($_POST['productId'], $_POST['qty'], $userSes[0]->storeId, $userSes[0]->id);
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
		// 
		$this->load->model('stores/stores_model');
		$stores =$this->stores_model->getData();
		// 
		$result = $this->home->searchHistoryInventory($config['per_page'], $config['start']);

		$data = array(
			'result'=>$result,
			'per_page'=> $_POST["per_page"],
			'start'=> $_POST["start"],
			'total'=>$config['total_rows'],
			'stores'=>$stores,
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
					$object->inventory = (float)$p->inventory;
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
			$data['products'] = $compareEstimatesOrderStore;

			$this->load->view("main-store/ajaxSearchExportMainStore", $data);
		}
	}

	public function main_export2(){
		//teamplate
		$data['products'] = $this->home->getProducts($this->session->userdata('userStaff')[0]->storeId);
		$data['stores'] = $this->home->getListOtherStore($this->session->userdata('userStaff')[0]->storeId);
		$this->template->write_view('content', 'main-store/export2', $data);
		$this->template->render();
	}

	public function ajaxSearchExport2MainStore (){
		if(!empty($_POST)){
			$compareEstimatesOrderStore = array();
			$products = $this->home->getProducts($this->session->userdata('userStaff')[0]->storeId, $_POST['name']);
			$store = $_POST['store'];
			if ($products && !empty($store)) {
				foreach ($products as $key => $p) {
					$object = new StdClass;
					$object->id = $p->id;
					$object->name = $p->name;
					$object->inventory = (float)$p->inventory;
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
						$quoteForStore = $quoteProductStore[0]->valueMin;
					}
					// var_dump($quoteForStore);
					$sumEstimates = $quoteForStore - $inventoryForStore;
					$object->valueMin = $quoteForStore;
					$object->estimates = $sumEstimates;

					$compareEstimatesOrderStore[] = $object;
					// exit();
				}
			}
			$data['products'] = $compareEstimatesOrderStore;

			$this->load->view("main-store/ajaxSearchExport2MainStore", $data);
		}
	}

	public function search_history(){
		$this->template->write_view('content','search_history');
		$this->template->render();
	}

	function ajaxSearchHistory() {
		if(!empty($_POST)){
			$products = $this->home->getProducts($this->session->userdata('userStaff')[0]->storeId, $_POST['name']);
			if($_POST['date']) {
				$date = date("Y-m-d H:i:s", strtotime($_POST['date']));
			} else {
				exit; 
			}
			$storeId = $this->session->userdata('userStaff')[0]->storeId;
			if ($products) {
				$historyDate = array();
				foreach ($products as $key => $p) {
					$imported = $this->home->totalImportDate($p->id, $storeId, $date);
					$exported = $this->home->totalExportdate($p->id, $storeId, $date);
					if ($imported || $exported) {
						$object = new StdClass;
						$object->import = serialize($imported);
						$object->export = serialize($exported);
						$object->name = $p->name;
						$object->totalImport = $this->home->totalImportToday($p->id, $storeId, $date)[0]->adjQty;
						$object->totalExport = $this->home->totalExportToday($p->id, $storeId, $date)[0]->adjQty;
						$historyDate[] = $object;
					}
				}
				$data['products'] = $historyDate; 
				$this->load->view("ajaxSearchDate", $data);
			}
		}
	}
	public function check_export(){
		//teamplate
		$data['stores'] = $this->home->getListOtherStore($this->session->userdata('userStaff')[0]->storeId);
		$this->template->write_view('content', 'main-store/check_export', $data);
		$this->template->render();
	}

	public function ajaxSearchExportProductFromStore() {
		if(!empty($_POST)){
			$products = $this->home->getProducts($_POST['store']);
			if($_POST['date']) {
				$date = date("Y-m-d H:i:s", strtotime($_POST['date']));
			} else {
				exit; 
			}
			$storeId = $_POST['store'];
			if ($products) {
				$historyDate = array();
				foreach ($products as $key => $p) {	
					$object = new StdClass;
					$object->id = $p->id;
					$object->name = $p->name;
					$exported = $this->home->totalExportdate($p->id, $storeId, $date);
					if ($exported) {
						$object->totalExport = $this->home->totalExportToday($p->id, $storeId, $date)[0]->adjQty;
					} else {
						$object->totalExport = 0;
					}
					$historyDate[] = $object;
				}
				$data['products'] = $historyDate; 
				$this->load->view("main-store/ajaxSearchExportProductFromStore", $data);
			}
		}
	}
		
	public function importListQtyCheckStore(){
		//teamplate
		$products = $this->home->getProducts($_POST['store']);
		$count = 0;
		$store = $_POST['store'];
		$date = date("Y-m-d H:i:s", strtotime($_POST['date']));
		foreach ($products as $key => $p) {
			$qty = $_POST['qty'.$p->id];
			if ($qty && $qty > 0) {
				$insertInventoryQuote = $this->home->insertInventoryQuote($p->id, $qty, $store, $date);
				if ($insertInventoryQuote) {
					$count = $count + 1;
				}
			}
		}

		if($count > 0){
			print 'success.'.$count.'.'.$this->security->get_csrf_hash();
			exit;
		} 
	}

	public function importQtyCheckStore(){
		//teamplate
		if(!empty($_POST)){
			$id = $_POST['productId'];
			$qty = $_POST['qty'];
			$store = $_POST['store'];
			$date = date("Y-m-d H:i:s", strtotime($_POST['date']));
			$insertInventoryQuote = $this->home->insertInventoryQuote($id, $qty, $store, $date);
			if ($insertInventoryQuote) {
				print 'success.'.$this->security->get_csrf_hash();
				exit;
			}
		} 
	}
		
	public function mainStoreInventory() {
		$data['stores'] = $this->home->getListOtherStore($this->session->userdata('userStaff')[0]->storeId);
		$data['products'] = $this->loadMainStoreInventory();
		$this->template->write_view('content', 'main-store/hangcan', $data);
		$this->template->render();
	}

	public function loadMainStoreInventory(){
		$this->load->model('stores/stores_model');
		$this->load->model('quote_main_store/quote_main_store_model');
		$products = $this->quote_main_store_model->getAllProductInventory($this->session->userdata('userStaff')[0]->storeId, '');
		$date = date('Y-m-d H:i:s',time());
		$mainStore = $this->stores_model->getDetailManagement($this->session->userdata('userStaff')[0]->storeId);
		foreach ($products as $key => $pro) {
			$cal = 0;
			if($pro->quote > 0) {
				$cal = number_format((($pro->quote - $pro->inventory)/($pro->quote)),2);
			}
			$pro->percen = $cal*100;
			if ($pro->percen > $mainStore[0]->percenCompareMin) {
				$pro->notify = true;
			} else {
				$pro->notify = false;
			}
			$pro->effect = 0;
			if ($pro->isEffectStoreMain && $pro->effectStoreMain > 0) {
				$pro->effect = number_format((($pro->quote - $pro->inventory)/$pro->effectStoreMain),1);
			}
		}
		uasort($products, function ($a, $b) {
			return $a->percen < $b->percen;
		});
		return $products;
	}
	/*------------------------------------ End API --------------------------------*/
	public function sendMessageTelegram($body, $store, $total){
		$chat_id = '-998428325';
		$this->load->model('stores/stores_model');
		$store =$this->stores_model->getDetailManagement($store);
		$content = '<strong>Nhập hàng cho - '.$store[0]->name. ' - ' .date('Y-m-d H:i:s',time()). '! </strong>';
		$content .= " \n ";
		$content .= $body;
		$content .= '<code>Tổng sản phẩm: '. $total.'</code>';
		$content .= " \n ";
		$content .= '<code>From '. PATH_URL.'</code>';
		$data = $this->telegram_lib->sendmsg($content, $chat_id);
    }

	public function sendImportMessageTelegram($body, $total){
		$chat_id = '-998428325';
		$content = '<strong>Nhập hàng kho - ' .date('Y-m-d H:i:s',time()). '! </strong>';
		$content .= " \n ";
		$content .= $body;
		$content .= '<code>Tổng sản phẩm: '. $total.'</code>';
		$content .= " \n ";
		$content .= '<code>From '. PATH_URL.'</code>';
		$data = $this->telegram_lib->sendmsg($content, $chat_id);
    }

	public function sendMessageVerify($body){
		$chat_id = '-955132579';
		$content = '<strong>Thông tin chuyển hàng cần xác nhận - ' .date('Y-m-d H:i:s',time()). '! </strong>';
		$content .= " \n ";
		$content .= $body;
		$content .= '<code>From '. PATH_URL.'</code>';
		$data = $this->telegram_lib->sendmsg($content, $chat_id);
    }

	public function loginVerify($body){
		$chat_id = '-955132579';
		$content = '<strong>Thông tin đăng nhập cần xác nhận - ' .date('Y-m-d H:i:s',time()). '! </strong>';
		$content .= " \n ";
		$content .= $body;
		$content .= '<code>From '. PATH_URL.'</code>';
		$data = $this->telegram_lib->sendmsg($content, $chat_id);
    }

	
}