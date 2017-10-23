<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('account_model');
		$this->load->model('admin_model');
		$this->load->model('product_model');
		$this->load->model('category_model');
		$this->load->model('cart_model');
	}

	public function index()	{
		$this->gate_model->admin_gate();
		$this->load->view('layout/dashboard/header', array('title' => 'Admin Dashboard'));
		$this->loadSidebar(null, null);
		$this->load->view('admin/dashboard');
		$this->load->view('layout/dashboard/footer');
	}
	
	public function view_users() {
		$this->gate_model->admin_gate();
		$data["userlist"] = $this->admin_model->get_users();
		$this->load->view('layout/dashboard/header', array('title' => 'View Users'));
		$this->loadSidebar("show_user", "manage_user_active");
		$this->load->view('admin/userlist', $data);
		$this->load->view('layout/dashboard/footer');
	}
	
	public function view_product() {
		$this->gate_model->admin_gate();
		$data["productlist"] = $this->product_model->getAllProducts();
		$data["categories"] = $this->category_model->getAllCategoriesWithSubCategories();
		$this->load->view('layout/dashboard/header', array("title" => "View Products"));
		$this->loadSidebar("show_product", "manage_product_active");
		$this->load->view('admin/view_product',$data);
		$this->load->view('layout/dashboard/footer');
	}
	
	public function ban_user() {
		$userId = $_GET['userId'];
		$ban = $this->admin_model->banUser($userId);
		if ($ban) $arr = array('message' => 'Success');
		else $arr = array('message' => 'Fail');
		header('Access-Control-Allow-Origin: *');
		header('Content-Type: application/json');
		echo json_encode($arr);
	}
	
	public function unban_user(){
		$userId = $_GET['userId'];
		$unban = $this->admin_model->unbanUser($userId);
		if ($unban) $arr = array('message' => 'Success');
		else  $arr = array('message' => 'Fail');
		header('Access-Control-Allow-Origin: *');
		header('Content-Type: application/json');
		echo json_encode($arr);
	}
	
	public function add_product() {
		$this->gate_model->admin_gate();
		// $data["productlist"] = $this->product_model->getAllProducts();
		$data["categories"] = $this->category_model->getAllCategoriesWithSubCategories();
		$this->load->view('layout/dashboard/header', array("title" => "Add Product"));
		$this->loadSidebar("show_product", "add_product_active");
		$this->load->view('admin/add_product',$data);
		$this->load->view('layout/dashboard/footer');
	}
	
	public function edit_product($product_id) {
		$this->gate_model->admin_gate();
		$data['product'] = $this->product_model->getProduct($product_id)->row();
		$data["categories"] = $this->category_model->getAllCategoriesWithSubCategories();
		$data["product_id"] = $product_id;
		$this->load->view('layout/dashboard/header', array("title" => "Edit Product"));
		$this->loadSidebar("show_product", "manage_product_active");
		$this->load->view('admin/edit_product',$data);
		$this->load->view('layout/dashboard/footer');
	}
	
	public function view_category() {
		$this->gate_model->admin_gate();
		$data["subcategorylist"] = $this->category_model->getAllSubCategories()->result();
		foreach($data["subcategorylist"] as $d) {
			if ($d->parent_category_id == 0) {
				$d->parent_category_name = "No Parent";
			}
		}
		$this->load->view('layout/dashboard/header', array("title" => "View Categories"));
		$this->loadSidebar("show_category", "manage_category_active");
		$this->load->view('admin/view_category',$data);
		$this->load->view('layout/dashboard/footer');
	}
	
	public function manage_category($category_id) {
		$this->gate_model->admin_gate();
		$data["category"] = $this->category_model->getCategoryData($category_id);
		$data["parent_categories"] = $this->category_model->getAllParentCategories()->result();
		$data["category_id"] = $category_id;
		$data["productlist"] = $this->product_model->getCategoryProduct($category_id);
		$data["categories"] = $this->category_model->getAllCategoriesWithSubCategories();
		$this->load->view('layout/dashboard/header', array("title" => "Manage Categories"));
		$this->loadSidebar("show_category", "manage_category_active");
		$this->load->view('admin/manage_category',$data);
		$this->load->view('layout/dashboard/footer');
	}	
	
	public function add_category() {
		$this->gate_model->admin_gate();
		$data["parent_categories"] = $this->category_model->getAllParentCategories()->result();
		$data["categories"] = $this->category_model->getAllCategoriesWithSubCategories();
		$this->load->view('layout/dashboard/header', array("title" => "Add Category"));
		$this->loadSidebar("show_category", "add_category_active");
		$this->load->view('admin/add_category',$data);
		$this->load->view('layout/dashboard/footer');
	}
	
	public function manage_order() {
		$this->gate_model->admin_gate();
		
		$orders = $this->cart_model->getAllOrders()->result();
		foreach($orders as $order) {
			$order->totalPrice = $this->cart_model->getTotalCartPrice($order->cart_id);
		}
		$data["orders"] = $orders;
		$this->load->view('layout/dashboard/header', array("title" => "Manage Orders"));
		$this->loadSidebar("show_order", "manage_order_active");
		$this->load->view("admin/manage_order", $data);
		$this->load->view('layout/dashboard/footer');
	}
	
	public function manage_cart() {
		$this->gate_model->admin_gate();
		$carts = $this->cart_model->getAllActiveCarts()->result();
		foreach($carts as $cart) {
			$cart->totalPrice = $this->cart_model->getTotalCartPrice($cart->cart_id);
		}
		
		$data["carts"] = $carts;
		$this->load->view('layout/dashboard/header', array("title" => "Manage Cart"));
		$this->loadSidebar("show_order", "manage_cart_active");
		$this->load->view("admin/manage_cart", $data);
		$this->load->view('layout/dashboard/footer');
	}
	
	public function view_cart($cart_id) {
		$this->gate_model->admin_gate();
		$data['cart'] = $this->cart_model->getCartDetail($cart_id);
		$data['products'] = $this->cart_model->getProductsInCart($cart_id);
		$data['totalPrice'] = $this->cart_model->getTotalCartPrice($cart_id);
		// header('Access-Control-Allow-Origin: *');
		// header('Content-Type: application/json');
		// echo json_encode($data);
		$this->load->view('layout/dashboard/header', array("title" => "View Cart"));
		$this->loadSidebar("show_order", "manage_cart_active");
		$this->load->view("admin/view_cart", $data);
		$this->load->view('layout/dashboard/footer');
	}

	public function view_order($cart_id) {
		$this->gate_model->admin_gate();
		$data['cart'] = $this->cart_model->getCartDetail($cart_id);
		$data['products'] = $this->cart_model->getProductsInCart($cart_id);
		$data['totalPrice'] = $this->cart_model->getTotalCartPrice($cart_id);
		// header('Access-Control-Allow-Origin: *');
		// header('Content-Type: application/json');
		// echo json_encode($data);
		$this->load->view('layout/dashboard/header', array("title" => "View Cart"));
		$this->loadSidebar("show_order", "manage_cart_active");
		$this->load->view("admin/view_order", $data);
		$this->load->view('layout/dashboard/footer');
	}
	
	public function loadSidebar($shownNav, $activedNav) {
		$showUser = null;
		$showProduct = null;
		$showCategory = null;
		$showOrder = null;
		$manageUserActive = null;
		$manageProductActive = null;
		$manageCategoryActive = null;
		$manageOrderActive = null;
		$manageCartActive = null;
		$addProductActive = null;
		$addCategoryActive = null;
		
		if($shownNav == "show_user") {$showUser = "show";}
		elseif($shownNav == "show_product") {$showProduct = "show";}
		elseif($shownNav == "show_category") {$showCategory = "show";}
		elseif($shownNav == "show_order") {$showOrder = "show";}
		
		if($activedNav == "manage_user_active") {$manageUserActive = "active"; }
		if($activedNav == "manage_product_active") {$manageProductActive = "active"; }
		if($activedNav == "manage_category_active") {$manageCategoryActive = "active"; }
		if($activedNav == "manage_order_active") {$manageOrderActive = "active"; }
		if($activedNav == "manage_cart_active") {$manageCartActive = "active"; }
		if($activedNav == "add_product_active") {$addProductActive = "active"; }
		if($activedNav == "add_category_active") {$addCategoryActive = "active"; }
		$this->load->view('layout/dashboard/sidebar', array(
			"show_user" => $showUser,
			"show_product" => $showProduct,
			"show_category" => $showCategory,
			"show_order" => $showOrder,
			"manage_user_active" => $manageUserActive,
			"manage_product_active" => $manageProductActive,
			"manage_category_active" => $manageCategoryActive,
			"manage_order_active" => $manageOrderActive,
			"manage_cart_active" => $manageCartActive,
			"add_product_active" => $addProductActive,
			"add_category_active" => $addCategoryActive
		));

	}
	
}