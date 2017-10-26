<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Shop extends CI_Controller {


	public function __construct() {
		parent::__construct();
		$this->load->model('category_model');
		$this->load->model('product_model');
		$active = array(
			"home" => null,
			"about" => null,
			"contact" => null
		);
	}
	
	public function index() {
		
		$categoryData = $this->category_model->getAllCategoriesWithSubCategories();
		$sixProducts = $this->product_model->getActiveProduct();
		$active = array(
			"home" => null,
			"about" => null,
			"contact" => null
		);
		$active['home'] = "active";
		$this->load->view('layout/shop/header', $active);
		$this->load->view('shop/home', array('categoryData' => $categoryData, 'sixProducts' => $sixProducts));
		$this->load->view('layout/shop/footer');
	}
	
	public function product($product_id) {
		$data['product'] = $this->product_model->getProduct($product_id)->row();
		$active = array(
			"home" => null,
			"about" => null,
			"contact" => null
		);
		$active['home'] = "active";
		$this->load->view('layout/shop/header', $active);
		$this->load->view('shop/product_page', $data);
		$this->load->view('layout/shop/footer');
	}
	
	public function about() {
		$active = array(
			"home" => null,
			"about" => null,
			"contact" => null
		);
		$active['about'] = "active";
		$this->load->view('layout/shop/header', $active);
		$this->load->view('shop/about_page');
		$this->load->view('layout/shop/footer');
	}
	
	public function contact() {
		$active = array(
			"home" => null,
			"about" => null,
			"contact" => null
		);
		$active['contact'] = "active";
		$this->load->view('layout/shop/header', $active);
		$this->load->view('shop/contact');
		$this->load->view('layout/shop/footer');
	}

}
?>