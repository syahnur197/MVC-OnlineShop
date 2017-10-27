<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class My_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();
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
	
	public function loadUserSidebar($shownNav, $activedNav) {
		$showProfile = null;
		$showCartOrder = null;
		
		$changeDetailActive = null;
		$changePasswordActive = null;
		
		$yourCartActive = null;
		$yourOrderActive = null;
		
		if($shownNav == "show_profile") {$showProfile = "show";}
		elseif($shownNav == "show_cart_order") {$showCartOrder = "show";}
		
		if($activedNav == "change_detail_active") {$changeDetailActive = "active"; }
		if($activedNav == "change_password_active") {$changePasswordActive = "active"; }
		if($activedNav == "your_cart_active") {$yourCartActive = "active"; }
		if($activedNav == "your_order_active") {$yourOrderActive = "active"; }

		$this->load->view('layout/user/sidebar', array(
			"show_profile" => $showProfile,
			"show_cart_order" => $showCartOrder,
			"change_detail_active" => $changeDetailActive,
			"change_password_active" => $changePasswordActive,
			"your_cart_active" => $yourCartActive,
			"your_order_active" => $yourOrderActive
		));
	}
}