<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('language');
		$this->lang->load('general');
		$this->load->model('api/Api_model','api');
		$this->load->library('session');
		
	}
	
	/*------------------------------------ API ------------------------------------*/
	
	public function getStores(){
    	$req = $this->home->getStores();
		foreach ($req as $key => $item) {
			$req[$key]->image = DIR_UPLOAD_STORES.$item->image;
		}
		echo json_encode($req);
	}

	function apiAutoSetupQuote() {
		$stores = $this->api->getDataStore();
		if ($stores) {
			foreach ($stores as $key => $s) {
				if ($s->days > 0) {
					$toDate = date('Y-m-d',time());
					$days = $s->days;
					$fromDate =  date('Y-m-d', strtotime($toDate . "-".$days. "days"));
					$products = $this->api->getProducts($s->id);
					if($products) {
						$count = 0;
						foreach ($products as $key => $p) {
						    $rate = $s->rate;
							// total xuất từ kho chính qua cửa hàng
							$quotetoDate = $this->api->getExportQuotetoDate($p->id, $s->id, $fromDate, $toDate);
							if ($p->isRateStore && $p->rateStore > 0) {
        						$rate = $p->rateStore;
        					}
							if ($quotetoDate) {
								$sum = 0;
								foreach ($quotetoDate as $key => $q) {
									$sum = $sum + $q->value;
								}
								$cal = number_format((float)($sum/$days) + (float)((($sum/$days) * $rate)/100), 0 );
								$value = 1;
								if($cal > 1) {
									$value = $cal;
								}
								$data = array(
									'value'=> $value,
									'valueMin'=> number_format($value* ($s->percenLimitExportSecord/100), 0),
									'updated'=> date('Y-m-d H:i:s',time()),
								);
								$this->db->where('storeId', $s->id);
								$this->db->where('productId', $p->id);
								if($this->db->update('quote',$data)) {
									$count++;
								}
							}
						}
										
					}
				}
			}
			
		}
		$storeMain = $this->api->getDataStoreMain();
		if ($storeMain) {
			$products = $this->api->getProducts($storeMain[0]->id);
			if($products) {
				foreach ($products as $key => $p) {
					$totalValue = $this->api->getTotalValue($p->id, $storeMain[0]->id);
					$value = 0;
					if ($totalValue) {
						$value = $totalValue[0]->value;
						if($storeMain[0]->percenQuoteMain > 0 && $totalValue[0]->value) {
							$value = number_format($totalValue[0]->value + (($totalValue[0]->value*$storeMain[0]->percenQuoteMain)/100),0);
						}
						if(($p->isRateStoreMain && $p->rateStoreMain > 0) && $totalValue[0]->value) {
							$value = number_format($totalValue[0]->value + (($totalValue[0]->value*$p->rateStoreMain)/100),0);
						}
						$data = array(
							'value'=> $value,
							'valueMin'=> number_format($value* ($storeMain[0]->percenLimitExportSecord/100), 0),
							'updated'=> date('Y-m-d H:i:s',time()),
						);
						$this->db->where('storeId', $storeMain[0]->id);
						$this->db->where('productId', $p->id);
						$this->db->update('quote', $data);
					}
				}
			}
		}
		$cronData  = array (
			'name' => "apiAutoSetupQuote",
			'note'  	=> "Tính toán định mức mỗi ngày",
			'status'  	=> 1,
			'created'=> date('Y-m-d H:i:s',time()),
		);
		echo json_encode($cronData);	
		$this->db->insert('cron', $cronData);
		exit;
	}

	public function apiCheckInputDataImport() {
		$stores = $this->api->getDataStore();
		$date = date('Y-m-d',time());
		$arrData = array();
		foreach ($stores as $key => $s) {
			$products = $this->api->getProducts($s->id, null);
			$storeId = $s->id;
			$storeData = new StdClass;
			$storeData->name = $s->name;
			$mainStore = $this->api->getDataStoreMain()[0]->id;
			if ($products) {
				$arrCompare = array();
				foreach ($products as $key => $p) {
					// total xuất từ kho chính qua cửa hàng
					$object = new StdClass;
					$object->name = $p->name;
					$object->totalImportCH = 0;
					$object->totalExportKho = 0;
					$totalImportCH = $this->api->totalImportCH($p->id, $storeId, $date);
					if($totalImportCH && $totalImportCH[0]->adjQty) {
						$object->totalImportCH = $totalImportCH[0]->adjQty;
					}
					$totalExportKho = $this->api->totalExportKho($p->id, $mainStore, $date, $storeId);
					if($totalExportKho && $totalExportKho[0]->adjQty) {
						$object->totalExportKho = $totalExportKho[0]->adjQty;
					}

					$object->totalChange = $object->totalExportKho - $object->totalImportCH;
					if ($object->totalChange != 0) {
						$arrCompare[] = $object;
					}
				}
				$storeData->products = $arrCompare;
				
			}
			$arrData[] = $storeData;
		}

		$data  = array (
			'name' => "KT xuất cửa hàng",
			'note'  	=> serialize($arrData),
			'created'=> date('Y-m-d H:i:s',time()),
		);
		if($this->db->insert('notification', $data)){
			$cronData  = array (
				'name' => "checkInputDataImport",
				'note'  	=> "kiểm tra nhập",
				'created'=> date('Y-m-d H:i:s',time()),
			);
			$this->db->insert('cron', $cronData);

			$mes = '';
			foreach ($arrData as $key => $s) {
				if (count($s->products) > 0) {
					$mes .= "-----------------------------";
					$mes .= " \n ";
					$mes .= '<code>'.$s->name. ' chênh lệch</code>';
					$mes .= " \n ";
					foreach ($s->products as $key => $p) {
						$mes .= '<b>'.$p->name.': '.$p->totalChange.'</b>';
						$mes .= " \n ";
					}
				} else {
					$mes .= "-----------------------------";
					$mes .= " \n ";
					$mes .= '<code>'.$s->name. ' chênh lệch: không có.</code>';
					$mes .= " \n ";
				}
			}

			if($mes!='') {
				$chat_id = '-974528858';
				$content = '<strong>Thông báo kiểm tra NHẬN - ' .date('Y-m-d H:i:s',time()). '! </strong>';
				$content .= " \n ";
				$content .= $mes;
				$content .= '<code>From '. PATH_URL.'</code>';
				$data = $this->telegram_lib->sendmsg($content, $chat_id);
			}
		} else {
			$cronData  = array (
				'name' => "checkInputDataImport",
				'note'  	=> "kiểm tra nhập",
				'status'  	=> 0,
				'created'=> date('Y-m-d H:i:s',time()),
			);
			$this->db->insert('cron', $cronData);
		}
		return true;
	}

	public function apiCheckInputDataExport() {
		$stores = $this->api->getDataStore();
		$date = date('Y-m-d H:i:s',time());
		$arrData = array();
		foreach ($stores as $key => $s) {
			$products = $this->api->getProducts($s->id, null);
			$storeId = $s->id;
			$storeData = new StdClass;
			$storeData->name = $s->name;
			if ($products) {
				$arrCompare = array();
				foreach ($products as $key => $p) {
					$object = new StdClass;
					$object->name = $p->name;
					$object->totalExport = 0;
					$object->totalCheck = 0;
					$totalExport = $this->api->totalExportDate($p->id, $storeId, $date);
					if($totalExport && $totalExport[0]->adjQty > 0) {
						$object->totalExport = $totalExport[0]->adjQty;
					}
					
					$totalCheck = $this->api->totalCheckDate($p->id, $storeId, $date);
					if($totalCheck && $totalCheck[0]->value > 0) {
						$object->totalCheck = $totalCheck[0]->value;
					}

					$object->totalChange = $object->totalExport - $object->totalCheck;
					if ($object->totalChange != 0) {
						$arrCompare[] = $object;
					}
				}
				$storeData->products = $arrCompare;
			}
			$arrData[] = $storeData;
		}

		$data  = array (
			'name' => "KT nhập cửa hàng",
			'note'  	=> serialize($arrData),
			'created'=> date('Y-m-d H:i:s',time()),
		);
		if($this->db->insert('notification', $data)){
			$cronData  = array (
				'name' => "checkInputDataExport",
				'note'  	=> "kiểm tra xuất",
				'created'=> date('Y-m-d H:i:s',time()),
			);
			$this->db->insert('cron', $cronData);
			$mes = '';
			foreach ($arrData as $key => $s) {
				if (count($s->products) > 0) {
					$mes .= "-----------------------------";
					$mes .= " \n ";
					$mes .= '<code>'.$s->name. ' chênh lệch</code>';
					$mes .= " \n ";
					foreach ($s->products as $key => $p) {
						$mes .= '<b>'.$p->name.': '.$p->totalChange.'</b>';
						$mes .= " \n ";
					}
				} else {
					$mes .= "-----------------------------";
					$mes .= " \n ";
					$mes .= '<code>'.$s->name. ' chênh lệch: không có.</code>';
					$mes .= " \n ";
				}
			}

			if($mes!='') {
				$chat_id = '-998428325';
				$content = '<strong>Thông báo kiểm tra XUẤT - ' .date('Y-m-d H:i:s',time()). '! </strong>';
				$content .= " \n ";
				$content .= $mes;
				$content .= '<code>From '. PATH_URL.'</code>';
				$data = $this->telegram_lib->sendmsg($content, $chat_id);
			}
		} else {
			$cronData  = array (
				'name' => "checkInputDataExport",
				'note'  	=> "kiểm tra xuất",
				'status'  	=> 0,
				'created'=> date('Y-m-d H:i:s',time()),
			);
			$this->db->insert('cron', $cronData);
		}
		return true;
	}
	/*------------------------------------ End API --------------------------------*/

}