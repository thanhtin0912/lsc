<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MX_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('language');
		$this->lang->load('general');

		$this->load->model('banners/Banners_model', 'banners');
		$this->load->model('home/Home_model', 'home');
		$this->load->library('session');
	}

	/*------------------------------------ FRONTEND ------------------------------------*/
	public function index()
	{
		$data['info'] = $this->home->getInfoSite();
		$data['services'] = $this->home->getListServices();
		// 
		$data['banner'] = $this->banners->getData();
		$data['services'] = $this->home->getListServices();
		$data['comments'] = $this->home->getListImages();
		$data['staffs'] = $this->home->getTopStaffs();
		$data['news'] = $this->home->getList4LatestNews();
		//
		$this->template->write('title',$data["info"][0]->name);
		$this->template->write('meta_description',$data["info"][0]->description_vn);
		$this->template->write('meta_url', PATH_URL);
		$this->template->write('meta_image', PATH_URL . DIR_UPLOAD_BANNER . $data["banner"][0]->image);

		$this->template->write_view('content', 'index', $data);
		$this->template->render();
	}

	public function about()
	{
		$data['info'] = $this->home->getInfoSite();
		$data['services'] = $this->home->getListServices();
		// 
		$data['seo'] = $this->home->getInfoSeoPage('about');
		$data['page'] = $this->home->getDataPages('about');
		$data['staffs'] = $this->home->getTopStaffs();
		//
		$this->template->write('title',$data["seo"]->seo_title);
		$this->template->write('meta_description',$data["seo"]->seo_description);
		$this->template->write('meta_url', $data["seo"]->slug);
		$this->template->write('meta_image', PATH_URL . DIR_UPLOAD_SEOS . $data["seo"]->image);
		$this->template->write_view('content', 'about', $data);
		$this->template->render();
	}


	public function library()
	{
		$data['info'] = $this->home->getInfoSite();
		$data['services'] = $this->home->getListServices();
		// 
		$data['page'] = $this->home->getInfoSeoPage('library');
		//
		$this->template->write('title',$data["page"]->seo_title);
		$this->template->write('meta_description',$data["page"]->seo_description);
		$this->template->write('meta_url', $data["page"]->slug);
		$this->template->write('meta_image', PATH_URL . DIR_UPLOAD_SEOS . $data["page"]->image);
		$this->template->write_view('content', 'library', $data);
		$this->template->render();
	}
	
	public function showAllLibraries()
	{
		$this->load->library('AdminPagination');
		$config['total_rows'] = $this->home->searchAllLibrariesTotal();
		$config['per_page'] = $_POST["per_page"];
		$config['num_links'] = 3;
		$config['func_ajax'] = 'showAllLibraries';
		$config['start'] = $_POST["start"];
		$this->adminpagination->initialize($config);

		$result = $this->home->searchAllLibraries($config['per_page'], $config['start']);
		
		$data = array(
			'result' => $result,
			'per_page' => $_POST["per_page"],
			'start' => $_POST["start"],
			'total' => $config['total_rows']
		);
		$this->load->view('ajax_viewSearchLibraries', $data);
	}

	public function library_detail($link)
	{
		//teamplate
		$data['info'] = $this->home->getInfoSite();
		$data['services'] = $this->home->getListServices();
		// 
		$data['news'] = $this->home->getDetailNews($link);
		$news = $this->home->getDetailNews($link);
		// $data['likenews'] = $this->home->getListNewsLike($link);
		//
		$this->template->write('title', $news[0]->title_vn);
		$this->template->write_view('content', 'news-detail', $data);
		$this->template->render();
	}
	public function contact()
	{
		$data['info'] = $this->home->getInfoSite();
		$data['services'] = $this->home->getListServices();
		// 
		$data['seo'] = $this->home->getInfoSeoPage('contact');
		$data['page'] = $this->home->getDataPages('contact');
		//
		$this->template->write('title',$data["seo"]->seo_title);
		$this->template->write('meta_description',$data["seo"]->seo_description);
		$this->template->write('meta_url', $data["seo"]->slug);
		$this->template->write('meta_image', PATH_URL . DIR_UPLOAD_SEOS . $data["seo"]->image);
		$this->template->write_view('content', 'contact', $data);
		$this->template->render();
	}


	public function news()
	{
		//template
		$data['info'] = $this->home->getInfoSite();
		$data['services'] = $this->home->getListServices();
		//
		$data['seo'] = $this->home->getInfoSeoPage('news');
		//
		$this->template->write('title',$data["seo"]->seo_title);
		$this->template->write('meta_description',$data["seo"]->seo_description);
		$this->template->write('meta_url', $data["seo"]->slug);
		$this->template->write('meta_image', PATH_URL . DIR_UPLOAD_SEOS . $data["seo"]->image);
		$this->template->write_view('content', 'news', $data);
		$this->template->render();
	}

	public function showAllNews()
	{
		$this->load->library('AdminPagination');
		$config['total_rows'] = $this->home->searchAllNewsTotal();
		$config['per_page'] = $_POST["per_page"];
		$config['num_links'] = 3;
		$config['func_ajax'] = 'showAllNews';
		$config['start'] = $_POST["start"];
		$this->adminpagination->initialize($config);

		$result = $this->home->searchAllNews($config['per_page'], $config['start']);
		$data = array(
			'result' => $result,
			'per_page' => $_POST["per_page"],
			'start' => $_POST["start"],
			'total' => $config['total_rows']
		);
		$this->load->view('ajax_viewSearchNews', $data);
	}


	public function news_detail($link)
	{
		//teamplate
		$data['info'] = $this->home->getInfoSite();
		$data['services'] = $this->home->getListServices();
		// 
		$data['news'] = $this->home->getDetailNews($link);
		$data['likenews'] = $this->home->getListNewsLike($link);
		//
		$this->template->write('title', $data['news'][0]->title_vn);
		$this->template->write('meta_description', $data['news'][0]->description_vn);
		$this->template->write('meta_url', $data['news'][0]->slug);
		$this->template->write('meta_image', PATH_URL . DIR_UPLOAD_NEWS . $data['news'][0]->image);
		$this->template->write_view('content', 'news-detail', $data);
		$this->template->render();
	}

	public function services_detail($link)
	{
		//teamplate
		$data['info'] = $this->home->getInfoSite();
		$data['services'] = $this->home->getListServices();
		// 
		$data['result'] = $this->home->getDetailService($link);
		//
		$this->template->write('title', $data['result'][0]->title_vn);
		$this->template->write('meta_description', $data['result'][0]->description_vn);
		$this->template->write('meta_url', $data['result'][0]->slug);
		$this->template->write('meta_image', PATH_URL . DIR_UPLOAD_SERVICES . $data['result'][0]->image);
		$this->template->write_view('content', 'service-detail', $data);
		$this->template->render();
	}

	public function projects()
	{
		//template
		$data['info'] = $this->home->getInfoSite();
		$data['services'] = $this->home->getListServices();
		//
		$data['cataproject'] = $this->home->getDataCatagories('CATA_PROJECT');
		$data['listproject'] = $this->home->getListProjecttoProject();
		//
		$this->template->write('title', 'Dự sán - Cty CP TK & XD Hương Việt');
		$this->template->write_view('content', 'project', $data);
		$this->template->render();
	}

	public function project_detail($link)
	{
		//teamplate
		$data['info'] = $this->home->getInfoSite();
		$data['newsfooter'] = $this->home->getList3LatestNews();
		$data['services'] = $this->home->getListServices();
		$data['cataproduct'] = $this->home->getDataCatagories('CATA_PRODUCT');
		$data['cataparent'] = $this->home->getDataCataParent();
		// 
		$data['project'] = $this->home->getDetailProject($link);
		$project = $this->home->getDetailProject($link);
		$data['listimages'] = unserialize($project[0]->images);

		$data['likeprojects'] = $this->home->getListProjectsLike($link, $project[0]->type);
		//
		$this->template->write('title', $project[0]->name_vn);
		$this->template->write_view('content', 'project-detail', $data);
		$this->template->render();
	}

	public function products()
	{
		//template
		$data['info'] = $this->home->getInfoSite();
		$data['newsfooter'] = $this->home->getList3LatestNews();
		$data['services'] = $this->home->getListServices();
		$data['cataparent'] = $this->home->getDataCataParent();
		//
		$data['cataproduct'] = $this->home->getDataCatagories('CATA_PRODUCT');
		$data['listproduct'] = $this->home->getList4ProductOfCatagories();
		//
		$this->template->write('title', 'Products - Cty TNHH Hải Dương ');
		$this->template->write_view('content', 'product', $data);
		$this->template->render();
	}

	public function showAllProducts()
	{
		$link = $_POST["link"];
		$this->load->library('AdminPagination');
		$config['total_rows'] = $this->home->searchAllProductsTotal($link);
		$config['per_page'] = $_POST["per_page"];
		$config['num_links'] = 3;
		$config['func_ajax'] = 'showAllProducts';
		$config['start'] = $_POST["start"];
		$this->adminpagination->initialize($config);

		$result = $this->home->searchAllProducts($link, $config['per_page'], $config['start']);
		$data = array(
			'result' => $result,
			'per_page' => $_POST["per_page"],
			'start' => $_POST["start"],
			'total' => $config['total_rows']
		);
		$this->load->view('ajax_viewSearchProducts', $data);
	}


	public function product_detail($link)
	{
		//teamplate
		$data['info'] = $this->home->getInfoSite();
		$data['newsfooter'] = $this->home->getList3LatestNews();
		$data['services'] = $this->home->getListServices();
		$data['cataparent'] = $this->home->getDataCataParent();
		// 
		$data['cataproduct'] = $this->home->getDataCatagories('CATA_PRODUCT');
		$data['product'] = $this->home->getDetailProduct($link);
		$product = $this->home->getDetailProduct($link);
		$data['likeproducts'] = $this->home->getListProductsLike($link, $product[0]->type);
		$data['listimages'] = unserialize($product[0]->images);
		//
		$this->template->write('title', $product[0]->name_vn);
		$this->template->write_view('content', 'product-detail', $data);
		$this->template->render();
	}

	public function catagory($link)
	{
		//template
		$data['info'] = $this->home->getInfoSite();
		$data['newsfooter'] = $this->home->getList3LatestNews();
		$data['services'] = $this->home->getListServices();
		$data['cataparent'] = $this->home->getDataCataParent();
		//
		$data['detailcata'] = $this->home->getDetailCatagories($link);
		$detailcata = $this->home->getDetailCatagories($link);
		$data['cataproduct'] = $this->home->getListCatagories($detailcata[0]->type);
		//
		$this->template->write('title', $detailcata[0]->name_vn);
		$this->template->write_view('content', 'cata', $data);
		$this->template->render();
	}


	public function saveInfoContact(){
		$res = $this->home->saveInfoContact();
		if ($res){
			$data = array(
				"status"=> true,
				"msg"=> $this->security->get_csrf_hash()
			);
		} else {
			$data = array(
				"status"=> false,
				"msg"=> $this->security->get_csrf_hash(),
			);
		}
		print json_encode($data);
		exit();
	}
	public function getDetailProject() {
		$res = $this->home->getDetailProjectID($_POST["id"]);
		if ($res){
			$data = array(
				"status"=> true,
				"data" => $res,
				"msg"=> $this->security->get_csrf_hash()
			);
		} else {
			$data = array(
				"status"=> false,
				"msg"=> $this->security->get_csrf_hash(),
			);
		}
		print json_encode($data);
		exit();
	}
	

	/*------------------------------------ End FRONTEND --------------------------------*/
}
