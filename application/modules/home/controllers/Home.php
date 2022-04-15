<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('language');
		$this->lang->load('general');

		$this->load->model('banners/Banners_model','banners');
		$this->load->model('home/Home_model','home');
		$this->load->library('session');
		
	}
	
	/*------------------------------------ FRONTEND ------------------------------------*/
	public function index(){
		$data['info'] = $this->home->getInfoSite();
		$data['services'] = $this->home->getListServices();
		// 
		$data['banner'] = $this->banners->getData();
		$data['services'] = $this->home->getListServices();
		$data['comments'] = $this->home->getListImages();
		$data['staffs'] = $this->home->getTopStaffs();
		$data['news'] = $this->home->getList4LatestNews();
		//
		$this->template->write('title','Cty TNHH Hải Dương');
		$this->template->write_view('content','index',$data);
		$this->template->render();
	}

	public function about(){
		$data['info'] = $this->home->getInfoSite();
		$data['services'] = $this->home->getListServices();
		// 
		$data['pages'] = $this->home->getDataPages('GIOITHIEU');
		//
		$this->template->write('title','Giới thiệu - Cty TNHH Hải Dương');
		$this->template->write_view('content','about',$data);
		$this->template->render();
	}

	public function design(){
		$data['info'] = $this->home->getInfoSite();
		$data['services'] = $this->home->getListServices();
		// 
		$data['pages'] = $this->home->getDataPages('THIETKE');
		//
		$this->template->write('title','Thiết kế- Cty TNHH Hải Dương');
		$this->template->write_view('content','design',$data);
		$this->template->render();
	}

		public function construct(){
			$data['info'] = $this->home->getInfoSite();
			$data['services'] = $this->home->getListServices();
		// 
		$data['pages'] = $this->home->getDataPages('XAYDUNG');
		//
		$this->template->write('title','Xây dựng - Cty TNHH Hải Dương');
		$this->template->write_view('content','construct',$data);
		$this->template->render();
	}

	public function contact(){
		$data['info'] = $this->home->getInfoSite();
		$data['services'] = $this->home->getListServices();
		// 
		$data['pages'] = $this->home->getDataPages('LIENHE');
		//
		$this->template->write('title','Liên hệ - Cty TNHH Hải Dương');
		$this->template->write_view('content','contact',$data);
		$this->template->render();
	}


	public function news(){
		//template
		$data['info'] = $this->home->getInfoSite();
		$data['services'] = $this->home->getListServices();
		//
		//
		$this->template->write('title','Tin tức - Cty TNHH Hải Dương');
		$this->template->write_view('content','news',$data);
		$this->template->render();
	}

	public function showAllNews(){
		$this->load->library('AdminPagination');
		$config['total_rows'] = $this->home->searchAllNewsTotal();
		$config['per_page'] = $_POST["per_page"];
		$config['num_links'] = 3;
		$config['func_ajax'] = 'showAllNews';
		$config['start'] = $_POST["start"];
		$this->adminpagination->initialize($config);

		$result = $this->home->searchAllNews($config['per_page'],$config['start']);
		$data = array(
			'result'=>$result,
			'per_page'=>$_POST["per_page"],
			'start'=>$_POST["start"],
			'total'=>$config['total_rows']
		);
		$this->load->view('ajax_viewSearchNews',$data);
	}


	public function news_detail($link){
		//teamplate
		$data['info'] = $this->home->getInfoSite();
		$data['newsfooter'] = $this->home->getList3LatestNews();
		$data['services'] = $this->home->getListServices();
		$data['cataproduct'] = $this->home->getListCatagories();
		$data['cataparent'] = $this->home->getDataCataParent();
        // 
		$data['news'] = $this->home->getDetailNews($link);
		$news = $this->home->getDetailNews($link);
		$data['likenews'] = $this->home->getListNewsLike($link);
        //
		$this->template->write('title',$news[0]->title_vn);
		$this->template->write_view('content','news-detail',$data);
		$this->template->render();
	}

	public function services_detail($link){
		//teamplate
		$data['info'] = $this->home->getInfoSite();
		$data['newsfooter'] = $this->home->getList3LatestNews();
		$data['services'] = $this->home->getListServices();
		$data['cataparent'] = $this->home->getDataCataParent();
        // 
		$data['result'] = $this->home->getDetailService($link);
		$result = $this->home->getDetailService($link);
		$data['cataproduct'] = $this->home->getDataCatagories('CATA_PRODUCT');
        //
		$this->template->write('title',$result[0]->title_vn);
		$this->template->write_view('content','service-detail',$data);
		$this->template->render();
	}

	public function projects(){
		//template
		$data['info'] = $this->home->getInfoSite();
		$data['newsfooter'] = $this->home->getList3LatestNews();
		$data['services'] = $this->home->getListServices();
		$data['cataproduct'] = $this->home->getDataCatagories('CATA_PRODUCT');
				$data['cataparent'] = $this->home->getDataCataParent();
		//
		$data['cataproject'] = $this->home->getDataCatagories('CATA_PROJECT');
		$data['listproject'] = $this->home->getListProjecttoProject();
		//
		$this->template->write('title','Dự sán - Cty CP TK & XD Hương Việt');
		$this->template->write_view('content','project',$data);
		$this->template->render();
	}

	public function project_detail($link){
		//teamplate
		$data['info'] = $this->home->getInfoSite();
		$data['newsfooter'] = $this->home->getList3LatestNews();
		$data['services'] = $this->home->getListServices();
		$data['cataproduct'] = $this->home->getDataCatagories('CATA_PRODUCT');
		$data['cataparent'] = $this->home->getDataCataParent();
        // 
		$data['project'] = $this->home->getDetailProject($link);
		$project = $this->home->getDetailProject($link);
		$data['listimages'] =unserialize($project[0]->images);

		$data['likeprojects'] = $this->home->getListProjectsLike($link,$project[0]->type);
        //
		$this->template->write('title',$project[0]->name_vn);
		$this->template->write_view('content','project-detail',$data);
		$this->template->render();
	}

	public function products(){
		//template
		$data['info'] = $this->home->getInfoSite();
		$data['newsfooter'] = $this->home->getList3LatestNews();
		$data['services'] = $this->home->getListServices();
		$data['cataparent'] = $this->home->getDataCataParent();
		//
		$data['cataproduct'] = $this->home->getDataCatagories('CATA_PRODUCT');
		$data['listproduct'] = $this->home->getList4ProductOfCatagories();
		//
		$this->template->write('title','Products - Cty TNHH Hải Dương ');
		$this->template->write_view('content','product',$data);
		$this->template->render();
	}

	public function showAllProducts(){
		$link = $_POST["link"];
		$this->load->library('AdminPagination');
		$config['total_rows'] = $this->home->searchAllProductsTotal($link);
		$config['per_page'] = $_POST["per_page"];
		$config['num_links'] = 3;
		$config['func_ajax'] = 'showAllProducts';
		$config['start'] = $_POST["start"];
		$this->adminpagination->initialize($config);

		$result = $this->home->searchAllProducts($link,$config['per_page'],$config['start']);
		$data = array(
			'result'=>$result,
			'per_page'=>$_POST["per_page"],
			'start'=>$_POST["start"],
			'total'=>$config['total_rows']
		);
		$this->load->view('ajax_viewSearchProducts',$data);
	}


	public function product_detail($link){
		//teamplate
		$data['info'] = $this->home->getInfoSite();
		$data['newsfooter'] = $this->home->getList3LatestNews();
		$data['services'] = $this->home->getListServices();
		$data['cataparent'] = $this->home->getDataCataParent();
        // 
		$data['cataproduct'] = $this->home->getDataCatagories('CATA_PRODUCT');
		$data['product'] = $this->home->getDetailProduct($link);
		$product = $this->home->getDetailProduct($link);
		$data['likeproducts'] = $this->home->getListProductsLike($link,$product[0]->type);
		$data['listimages'] =unserialize($product[0]->images);
        //
		$this->template->write('title',$product[0]->name_vn);
		$this->template->write_view('content','product-detail',$data);
		$this->template->render();
	}

	public function catagory($link){
		//template
		$data['info'] = $this->home->getInfoSite();
		$data['newsfooter'] = $this->home->getList3LatestNews();
		$data['services'] = $this->home->getListServices();
		$data['cataparent'] = $this->home->getDataCataParent();
		//
		$data['detailcata'] = $this->home->getDetailCatagories($link);
		$detailcata =$this->home->getDetailCatagories($link);
		$data['cataproduct'] = $this->home->getListCatagories($detailcata[0]->type);
		//
		$this->template->write('title',$detailcata[0]->name_vn);
		$this->template->write_view('content','cata',$data);
		$this->template->render();
	}

	public function InfoContact(){
		$data = array(
			'name'		=> $_POST["name"],
			'mail'			=> $_POST["mail"],
			'phone'		=> $_POST["phone"],
			'message'		=> $_POST["message"]
		);
		if($data){
			$this->load->helper('language');
			$this->lang->load('general');
			$config = array(
		    	'protocol' => 'smtp',
	            'smtp_host' => 'ssl://smtp.gmail.com',
	            'smtp_port' => '465',
	            'smtp_user' => 'server.k2office@gmail.com',
	            'smtp_pass' => 'erishczexsgvsbru'//Nhớ đánh đúng user và pass nhé
			);


			$this->load->library('Email',$config);
			$this->email->set_mailtype("html");
			$this->email->set_newline("\r\n");

			$this->email->from('server.k2office@gmail.com','Hai Duong');
			$this->email->to($_POST["mail"]);
			$this->email->bcc('diennd.hds@gmail.com');
			$this->email->subject('Message from Website haiduongengineer.com');
			$body=$this->load->view('message',$data,true);
			$this->email->message($body);
			$this->email->send();
			return true;
			print 'success.'.$this->security->get_csrf_hash();
			exit;
		}else{
			print 'error.'.$this->security->get_csrf_hash();
			exit;
		}
	}

	/*------------------------------------ End FRONTEND --------------------------------*/

}