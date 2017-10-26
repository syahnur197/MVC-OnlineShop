<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CART extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('cart_model');
		$this->load->model('gate_model');
	}


    // Testing
    public function getTotalCartPrice($cart_id) {
        echo "$ ".$this->cart_model->getTotalCartPrice($cart_id);
    } 

    public function addToCart() {
        // $this->gate_model->ajax_gate();
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        if ($this->session->userdata('usertype') != 'user' && $this->session->userdata('usertype') != 'admin') {
            $message = "Need to login first!";
            $array = array("success" => false, "message" => $message, "title" => "Warning!");
        } elseif ($this->session->userdata('usertype') == 'admin') {
            $message = "You are the admin!";
            $array = array("success" => false, "message" => $message, "title" => "Warning!");
         }else {
            if ($this->cart_model->hasActiveCart()) {
                $cart_id = $this->cart_model->getUserActiveCartID();
            } else {
                $cart_id = $this->cart_model->addNewCart();
            }
            $insert = $this->cart_model->addProductToCart($cart_id, $product_id, $quantity);
            if ($insert) {
                $message = "Add product successfully";
                $array = array (
                    "success" => true,
                    "message" => $message,
                    "title" => "Success!"
                );
            } else {
                    $message = "Fail to add product";
                    $array = array (
                        "success" => false,
                        "message" => $message,
                        "title" => "Warning!"
                    );
            }
        }
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        echo json_encode($array);
    }
}