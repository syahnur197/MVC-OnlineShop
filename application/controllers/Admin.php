<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends My_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('account_model');
        $this->load->model('admin_model');
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('cart_model');
        $this->load->model('contact_model');
        $this->load->model('user_model');
    }
    
    public function index()
    {
        $this->gate_model->admin_gate();
        $data['newMessagesCount'] = $this->contact_model->getNewMessagesCount();
        $data['messages'] = $this->contact_model->getMessages();
        $this->load->view('layout/dashboard/header', array('title' => 'Admin Dashboard'));
        $this->loadSidebar(null, null);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('layout/dashboard/footer');
    }
    
    public function read_message($message_id)
    {
        $this->gate_model->admin_gate();
        $this->contact_model->readMessage($message_id);
        $data['message'] = $this->contact_model->getMessage($message_id)->row();
        $this->load->view('layout/dashboard/header', array('title' => 'Admin Dashboard'));
        $this->loadSidebar(null, null);
        $this->load->view('admin/read_message', $data);
        $this->load->view('layout/dashboard/footer');
    }
    
    public function view_users()
    {
        $this->gate_model->admin_gate();
        $data["userlist"] = $this->admin_model->get_users();
        $this->load->view('layout/dashboard/header', array('title' => 'View Users'));
        $this->loadSidebar("show_user", "manage_user_active");
        $this->load->view('admin/userlist', $data);
        $this->load->view('layout/dashboard/footer');
    }
    
    public function view_product()
    {
        $this->gate_model->admin_gate();
        $data["productlist"] = $this->product_model->getAllProducts();
        $data["categories"] = $this->category_model->getAllCategoriesWithSubCategories();
        $this->load->view('layout/dashboard/header', array("title" => "View Products"));
        $this->loadSidebar("show_product", "manage_product_active");
        $this->load->view('admin/view_product',$data);
        $this->load->view('layout/dashboard/footer');
    }
    
    public function ban_user()
    {
        $userId = $_GET['userId'];
        $ban = $this->admin_model->banUser($userId);
        if ($ban) $arr = array('message' => 'Success');
        else $arr = array('message' => 'Fail');
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        echo json_encode($arr);
    }
    
    public function unban_user()
    {
        $userId = $_GET['userId'];
        $unban = $this->admin_model->unbanUser($userId);
        if ($unban) $arr = array('message' => 'Success');
        else  $arr = array('message' => 'Fail');
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        echo json_encode($arr);
    }
    
    public function add_product()
    {
        $this->gate_model->admin_gate();
        $data["categories"] = $this->category_model->getAllCategoriesWithSubCategories();
        $this->load->view('layout/dashboard/header', array("title" => "Add Product"));
        $this->loadSidebar("show_product", "add_product_active");
        $this->load->view('admin/add_product',$data);
        $this->load->view('layout/dashboard/footer');
    }
    
    public function edit_product($product_id)
    {
        $this->gate_model->admin_gate();
        $data['product'] = $this->product_model->getProduct($product_id)->row();
        $data["categories"] = $this->category_model->getAllCategoriesWithSubCategories();
        $data["product_id"] = $product_id;
        $image_link = $this->product_model->getProductImageLink($product_id);
        if (count($image_link) == 0){
            $data["image_link"] = 'style/assets/images/no_image.png';
        } else {
            $data["image_link"] = $image_link;
        }
        $this->load->view('layout/dashboard/header', array("title" => "Edit Product"));
        $this->loadSidebar("show_product", "manage_product_active");
        $this->load->view('admin/edit_product',$data);
        $this->load->view('layout/dashboard/footer');
    }
    
    public function view_category()
    {
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
    
    public function manage_category($category_id)
    {
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
    
    public function add_category()
    {
        $this->gate_model->admin_gate();
        $data["parent_categories"] = $this->category_model->getAllParentCategories()->result();
        $data["categories"] = $this->category_model->getAllCategoriesWithSubCategories();
        $this->load->view('layout/dashboard/header', array("title" => "Add Category"));
        $this->loadSidebar("show_category", "add_category_active");
        $this->load->view('admin/add_category',$data);
        $this->load->view('layout/dashboard/footer');
    }
    
    public function manage_order()
    {
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
    
    public function manage_cart()
    {
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
    
    public function view_cart($cart_id)
    {
        $this->gate_model->admin_gate();
        $data['cart'] = $this->cart_model->getCartDetail($cart_id);
        $data['products'] = $this->cart_model->getProductsInCart($cart_id);
        $data['totalPrice'] = $this->cart_model->getTotalCartPrice($cart_id);
        $this->load->view('layout/dashboard/header', array("title" => "View Cart"));
        $this->loadSidebar("show_order", "manage_cart_active");
        $this->load->view("admin/view_cart", $data);
        $this->load->view('layout/dashboard/footer');
    }

    public function view_order($cart_id)
    {
        $this->gate_model->admin_gate();
        $data['cart'] = $this->cart_model->getCartDetail($cart_id);
        $data['products'] = $this->cart_model->getProductsInCart($cart_id);
        $data['totalPrice'] = $this->cart_model->getTotalCartPrice($cart_id);
        $data['shippingAddress'] = $this->user_model->get_shipping_address($data['cart']->user_id)->row();
        $this->load->view('layout/dashboard/header', array("title" => "View Cart"));
        $this->loadSidebar("show_order", "manage_order_active");
        $this->load->view("admin/view_order", $data);
        $this->load->view('layout/dashboard/footer');
    }	
}
