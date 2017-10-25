<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Shop extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('category_model');
		$this->load->model('product_model');
	}

	public function index() {

		$categoryData = $this->category_model->getAllCategoriesWithSubCategories();
		$sixProducts = $this->product_model->getActiveProduct();

		$this->load->view('layout/shop/header');
		$this->load->view('shop/home', array('categoryData' => $categoryData, 'sixProducts' => $sixProducts));
		$this->load->view('layout/shop/footer');
	}

	public function product($product_id) {
		$data['product'] = $this->product_model->getProduct($product_id)->row();
		$this->load->view('layout/shop/header');
		$this->load->view('shop/product_page', $data);
		$this->load->view('layout/shop/footer');
	}

}
?>